<?php
require '../../includes/pdo_conn.php';
require '../includes/session_variables.php';
require '../../includes/functions.php';

$redirect_header = 'location: ../scholarships.php';

if (isset($_POST['edit_scholarship'])) {

    extract($_POST);

    if (empty($scholarship_id)) {
        $_SESSION['error'] = "Something went wrong, please try again.";
        header($redirect_header);
        return;
    }
    // check for empty fields
    if (empty($scholarship_type) || empty($amount) || empty($description)) {
        $_SESSION['error'] = "Empty fields not allowed!";
        header($redirect_header);
        return;
    }

    // Extract the start_date and end_date separately
    $date_range = $_POST['date_range'];
    list($start_date, $end_date) = explode(' - ', $date_range);

    $params = allowOnly($_POST, ['scholarship_type', 'amount', 'description']);

    $params['start_date'] = $start_date;
    $params['end_date'] = $end_date;

    // check if there is a new uploaded image
    if (!empty($_FILES['image']['name'])) {
        // unique filename
        $image_filename = time() . '_' . basename($_FILES['image']['name']);
        $image_target_dir = "../../resources/image/" . $image_filename;
        $tmp = $_FILES['image']['tmp_name'];

        $params = array_merge($params, ['image_filename' => $image_filename, 'image_mime_type' => $_FILES['image']['type']]);

        // get existing image file name
        $stmt = $pdo->query("SELECT image_filename FROM scholarship WHERE scholarship_id=$scholarship_id");
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        $existing_img_filename = $row->image_filename;
    }

    $sql = createUpdateSql('scholarship', $params, 'scholarship_id');
    $params['scholarship_id'] = $_POST['scholarship_id'];

    $query = $pdo->prepare($sql);

    if ($query->execute($params)) {
        // remove existing image and upload the new image
        if (isset($image_target_dir)) {
            if (file_exists("../../resources/image/" . $existing_img_filename)) {
                unlink("../../resources/image/" . $existing_img_filename);
            }
            move_uploaded_file($tmp, $image_target_dir);
        }

        // Update the requirement names in requirement_data table
        if (!empty($_POST['requirement_id']) && !empty($_POST['scholarship_id']) && !empty($_POST['requirement_name'])) {
            $requirementIds = $_POST['requirement_id'];
            $requirementNames = $_POST['requirement_name'];

            // Assuming requirement_ids and scholarship_ids have the same length
            $numRequirements = count($requirementIds);

            // Update the requirement names in requirement_data table
            for ($i = 0; $i < $numRequirements; $i++) {
                $requirementId = $requirementIds[$i];
                $requirementName = $requirementNames[$i];

                $requirementDataSql = "UPDATE requirement_data SET requirement_name = :requirement_name
                                       WHERE scholarship_id = :scholarship_id AND requirement_id = :requirement_id";
                $requirementDataParams = ['requirement_name' => $requirementName, 'scholarship_id' => $scholarship_id, 'requirement_id' => $requirementId];
                $requirementDataQuery = $pdo->prepare($requirementDataSql);
                $requirementDataQuery->execute($requirementDataParams);
            }
        }

        // Insert new data into the requirement_data table
        if (!empty($_POST['req_name'])) {
            $newRequirements = $_POST['req_name'];

            foreach ($newRequirements as $newRequirement) {
                if (!empty($newRequirement)) {
                    $params = ['requirement_name' => $newRequirement, 'scholarship_id' => $scholarship_id];
                    $sql = createInsertSql('requirement_data', $params);
                    $query = $pdo->prepare($sql);

                    if (!$query->execute($params)) {
                        throw new Exception("Could not insert additional requirement.");
                    }
                }
            }
        }

        $scholarship_name = $_POST['scholarship_type'];
        $username =  $_SESSION[$session_username]; // Assuming username is stored in the session
        $activity_log = "$username updated scholarship with the named $scholarship_name";
        $log_params = ['activity' => $activity_log, 'timestamp' => date('Y-m-d H:i:s')];
        $log_sql = createInsertSql('activity_logs', $log_params);
        $log_query = $pdo->prepare($log_sql);
        $log_query->execute($log_params);

        $_SESSION['success'] = "1 record successfully updated!";
        header($redirect_header);
        return;
    } else {
        $_SESSION['error'] = "Something went wrong, please try again.";
        header($redirect_header);
        return;
    }
}
?>
