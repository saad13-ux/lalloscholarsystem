<?php
require '../../includes/pdo_conn.php';
require '../includes/session_variables.php';
require '../../includes/functions.php';

header('location: ../scholarships.php');
if (isset($_POST['add_scholarship'])) {

    $requirement_name = ['requirement_name'];

    
     // Set the timezone to Philippines
     date_default_timezone_set('Asia/Manila');
    
     $currentDateTime = new DateTime();
     $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');


    $check_empty = hasEmptyFields($_POST, ['scholarship_type', 'amount', 'description', 'date_range']);
    if ($check_empty) {
        $_SESSION['error'] = $check_empty . ' must not be empty.';
        return;
    }
    $dates = explode(" - ", $_POST['date_range']);

    // unique filename
    $image_filename = time() . '_' . basename($_FILES['image']['name']);
    $image_target_dir = "../../resources/image/" . $image_filename;
    $tmp = $_FILES['image']['tmp_name'];

      if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Move uploaded file to the target directory
        move_uploaded_file($tmp, $image_target_dir);
        $image_mime_type = $_FILES['image']['type'];
    } else {
        // Set default image filename and MIME type
        $image_filename = 'default.jpg';
        $image_target_dir = "../../resources/image/" . $image_filename;
        $image_mime_type = 'image/.jpg';
    }

    $params = allowOnly($_POST, ['scholarship_type', 'amount', 'description']);
    $params = array_merge($params, ['image_filename' => $image_filename, 'image_mime_type' => $_FILES['image']['type'], 'dt_created' => date('Y-m-d')]);
    $params['start_date'] = date("Y-m-d H:i:s", strtotime($dates[0]));
    $params['end_date'] = date("Y-m-d H:i:s", strtotime($dates[1]));
    $sql = createInsertSql('scholarship', $params);
    $query = $pdo->prepare($sql);


    if ($query->execute($params)) {
        move_uploaded_file($tmp, $image_target_dir);

                $scholarship_id = $pdo->lastInsertId();
                $requirement = count($_POST['requirement_name']);

                for ($a = 0 ; $a < $requirement; $a++) {
                    if ($_POST['requirement_name'][$a] == "") {
                    continue;
                }
                $params = arrayAllowOnly($_POST, $requirement_name, $a);
                $params['scholarship_id'] = $scholarship_id;
                $sql = createInsertSql('requirement_data', $params);
                $query = $pdo->prepare($sql);
                if (!$query->execute($params)) {
                    throw new Exception("Could not insert additional requirement.");
                }


            }

        $scholarship_name = $_POST['scholarship_type'];
        $username =  $_SESSION[$session_username]; // Assuming username is stored in the session
        $activity_log = "$username added new scholarship with the named $scholarship_name";
        $log_params = ['activity' => $activity_log, 'timestamp' => $formattedDateTime];
        $log_sql = createInsertSql('activity_logs', $log_params);
        $log_query = $pdo->prepare($log_sql);
        $log_query->execute($log_params);



        $_SESSION['success'] = "1 record successfully added!";
        return;
    } else {
        $_SESSION['error'] = "Something went wrong, please try again.";
        return;
    }
}
