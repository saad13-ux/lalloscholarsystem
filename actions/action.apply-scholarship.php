<?php
require '../includes/pdo_conn.php';
require '../includes/user_query_set.php';
require '../includes/session_variables.php';
require '../includes/functions.php';
require '../models/FileUploadService.php';

header("location: ../scholarships.php");

if (isset($_POST['apply_scholarship'])) {
    $type = $_POST['type'];

    if ($type == 'old') {
        $required_fields = [
            'scholarship_id',
            'b_fname',
            'b_lname',
            'zipcode',
            'barangay',
            'municipality',
            'province',
            'region',
            'school_name',
            'school_year',
            'year_level',
            'semester',
            'b_gender',
            'b_dob',
            'b_pob',
            'b_monthly_income',
            'mobile_number',
            'religion',
            'nationality',
            'b_civil_status',
            'type'
        ];
    } else {
        $required_fields = [
            'scholarship_id',
            'b_fname',
            'b_lname',
            'zipcode',
            'barangay',
            'municipality',
            'province',
            'region',
            'school_name',
            'school_year',
            'year_level',
            'semester',
            'b_gender',
            'b_dob',
            'b_pob',
            'b_monthly_income',
            'mobile_number',
            'religion',
            'nationality',
            'b_civil_status',
            'type'
        ];
    }

    $family_comp = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'dob',
        'civil_status',
        'relationship',
        'highest_education',
        'skill_occupation',
        'est_monthly_income'
    ];

    $files= [
        'file_name'
    ];

    $max_size = 10485760;
    $target_directory = __DIR__ . "/../resources/files";

    $allowedDocumentTypes = [
        'application/pdf' => 'pdf',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
        'image/jpeg' => 'jpg',
        'image/png' => 'png'
    ];

    $allowedImageTypes = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png'
    ];

    $uploadService = new FileUploadService();
    $uploadService->setMaxSize($max_size);
    $uploadService->setFileTypes($allowedDocumentTypes);
    $uploadService->setTargetDirectory($target_directory);

    if ($type == 'old') {
        $expected_files = ['file_file'];
    } else {
        $expected_files = ['file_file'];
    }

    foreach ($expected_files as $expected_file) {
      if (!isset($_FILES[$expected_file])) {
          $error = "Missing required file";
          $_SESSION['error'] = $error;
          echo $error;
          return;
        }
   }

    try {
        $uploaded_files = [];
        foreach ($expected_files as $expected_file) {
            $files_count = count($_FILES[$expected_file]['name']);

            for ($i = 0; $i < $files_count; $i++) {
                $tmp_name = $_FILES[$expected_file]['tmp_name'][$i];
                $file_name = $_FILES[$expected_file]['name'][$i];

                // 1. Check file size
                if (!$uploadService->isValidFileSize($tmp_name)) {
                    $_SESSION['error'] = "File size should not be larger than 10MB.";
                    echo "File size should not be larger than 10MB.";
                    return;
                }

                // 2. Check file type
                $file_type = $uploadService->getFileType($tmp_name);
                if (!$uploadService->isAllowedFileType($file_type)) {
                    $_SESSION['error'] = "File type is not allowed.";
                    echo "File type is not allowed.";
                    return;
                }

                // 3. Generate unique file name
                $new_filename = $uploadService->generateUniqueName($file_name);

                // 4. Move the file to the target directory
                $uploadService->moveFileToTargetDirectory($tmp_name, $new_filename, $file_type);
                $uploaded_files[$expected_file][] = array(
                    'file_name' => $new_filename . "." . $uploadService->getFileExtension($file_type),
                    'mime_type' => $file_type
                );
            }
        }
        echo 'Upload Success';

        $pdo->beginTransaction();
        // 0. Check if there is existing beneficiary on same scholarship
        $check_params = allowOnly($_POST, ['b_fname', 'b_mname', 'b_lname', 'b_ext_name', 'scholarship_id', 'school_year', 'semester', 'scholarship_id']);
        $check_sql = "SELECT application_id FROM user_application WHERE concat(b_fname, b_mname, b_lname, b_ext_name) LIKE concat(:b_fname, :b_mname, :b_lname, :b_ext_name) AND school_year=:school_year AND semester = :semester AND scholarship_id=:scholarship_id";
        $check_query = $pdo->prepare($check_sql);
        $check_query->execute($check_params);

        if ($check_query->rowCount() > 0) {
            $_SESSION['error'] = "You has been already applied on this scholarship.";
            return;
        }
        $date = date('Y-m-d H:i:s');
        if ($type == 'old') {
            // 1. Insert to user application
            $params = allowOnly($_POST, $required_fields);
            $params['b_ext_name'] = $_POST['b_ext_name'] ?? "";
            $params['b_mname'] = $_POST['b_mname'] ?? "";
            $params['user_id'] = $_SESSION[$session_user_id];
            $params['date_applied'] = $date;

            $sql = createInsertSql('user_application', $params);
            $query = $pdo->prepare($sql);
            $query->execute($params);

            // 2. Loop through family members
            $application_id = $pdo->lastInsertId(); // CORRECT application_id
            $members = count($_POST['first_name']);
            
            for ($i = 0; $i < $members; $i++) {
                if ($_POST['first_name'][$i] == "") {
                    continue;
                }
                $params = arrayAllowOnly($_POST, $family_comp, $i);
                $params['application_id'] = $application_id;
                $sql = createInsertSql('beneficiary_family_comp', $params);
                $query = $pdo->prepare($sql);
                if (!$query->execute($params)) {
                    throw new Exception("Could not insert beneficiary family composition.");
                }
            }

            // 3. Insert requirement files - FIXED: Use the CORRECT application_id
            $req_count = count($_POST['file_name']);

            for ($a = 0; $a < $req_count; $a++) {
                if ($_POST['file_name'][$a] == "") {
                    continue;
                }

                $params = arrayAllowOnly($_POST, $files, $a);
                $params['application_id'] = $application_id; // FIX: Use correct application_id, not lastInsertId()
                $params['file_file'] = $uploaded_files['file_file'][$a]['file_name'];
                $params['file_type'] = $uploaded_files['file_file'][$a]['mime_type'];

                $sql = createInsertSql('requirement_files', $params);
                $query = $pdo->prepare($sql);

                if (!$query->execute($params)) {
                    throw new Exception("Could not insert requirement file.");
                }
            }
        } else {
            // 1. Insert to user application
            $params = allowOnly($_POST, $required_fields);
            $params['b_ext_name'] = $_POST['b_ext_name'] ?? "";
            $params['b_mname'] = $_POST['b_mname'] ?? "";
            $params['user_id'] = $_SESSION[$session_user_id];
            $params['date_applied'] = $date;

            $sql = createInsertSql('user_application', $params);
            $query = $pdo->prepare($sql);
            $query->execute($params);

            // 2. Loop through family members
            $application_id = $pdo->lastInsertId(); // CORRECT application_id
            $members = count($_POST['first_name']);
            
            for ($i = 0; $i < $members; $i++) {
                if ($_POST['first_name'][$i] == "") {
                    continue;
                }
                $params = arrayAllowOnly($_POST, $family_comp, $i);
                $params['application_id'] = $application_id;
                $sql = createInsertSql('beneficiary_family_comp', $params);
                $query = $pdo->prepare($sql);
                if (!$query->execute($params)) {
                    throw new Exception("Could not insert beneficiary family composition.");
                }
            }

            // 3. Insert requirement files - FIXED: Use the CORRECT application_id
            $req_count = count($_POST['file_name']);

            for ($a = 0; $a < $req_count; $a++) {
                if ($_POST['file_name'][$a] == "") {
                    continue;
                }

                $params = arrayAllowOnly($_POST, $files, $a);
                $params['application_id'] = $application_id; // FIX: Use correct application_id, not lastInsertId()
                $params['file_file'] = $uploaded_files['file_file'][$a]['file_name'];
                $params['file_type'] = $uploaded_files['file_file'][$a]['mime_type'];

                $sql = createInsertSql('requirement_files', $params);
                $query = $pdo->prepare($sql);

                if (!$query->execute($params)) {
                    throw new Exception("Could not insert requirement file.");
                }
            }
        }

        // insert new notification
        $notif_params = array('message' => 'New application from ' . $_SESSION[$session_prefix . 'email'] . '!');
        $insert_notif_sql = "INSERT INTO `admin_notification`(`type`, `message`) VALUES(1, :message);";
        $insert_notif_qry = $pdo->prepare($insert_notif_sql);
        $insert_notif_qry->execute($notif_params);

        $pdo->commit();
        $_SESSION['success'] = "Your application has been submitted successfully.";
    } catch (Exception $ex) {
        echo "Internal server error: " . $ex->getMessage();

        if ($pdo->inTransaction()) {
            $pdo->rollback();
        }
        dd($ex->getMessage());
        $_SESSION['error'] = "Something went wrong, please try again.";
        return;
    }
}
?>