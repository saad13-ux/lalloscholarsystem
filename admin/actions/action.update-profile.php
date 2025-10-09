<?php
require '../../includes/pdo_conn.php';
require '../includes/admin_query_set.php';
require '../includes/session_variables.php';
require '../../includes/functions.php';


$redirect_header = 'location: ../dashboard.php';


      // Set the timezone to Philippines
      date_default_timezone_set('Asia/Manila');

if (isset($_POST['update_profile'])) {
    extract($_POST);
    if (empty($first_name || empty($middle_name) || empty($last_name) || empty($username) || empty($email))) {
        $_SESSION['error'] = "Empty fields not allowed!";
        header($redirect_header);
        return;
    }
    $params = allowOnly($_POST, ["username", "email", "first_name", "middle_name", "last_name"]);

     // check if there is a new uploaded image
    if (!empty($_FILES['image']['name'])) {
        // unique filename
        $image_filename = time() . '_' . basename($_FILES['image']['name']);
        $image_target_dir = "../../resources/admin_profile/" . $image_filename;
        $tmp = $_FILES['image']['tmp_name'];

        $params = array_merge($params, ['image_filename' => $image_filename, 'image_mime_type' => $_FILES['image']['type']]);

        // get existing image file name
        $stmt = $pdo->query("SELECT image_filename FROM admin WHERE admin_id=$_SESSION[$session_id]");
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        $existing_img_filename = $row->image_filename;
    }


    $sql = createUpdateSql('admin', $params, 'admin_id');
    $params['admin_id'] = $_SESSION[$session_id];
    $query = $pdo->prepare($sql);
    if ($query->execute($params)) {
         // remove existing image and upload the new image
        if (isset($image_target_dir)) {
            if (file_exists("../../resources/admin_profile/" . $existing_img_filename)) {
                unlink("../../resources/admin_profile/" . $existing_img_filename);
            }
            move_uploaded_file($tmp, $image_target_dir);
        }

        $username =  $_SESSION[$session_username]; // Assuming username is stored in the session
        $activity_log = "$username updated his profile";
        $log_params = ['activity' => $activity_log, 'timestamp' => date('Y-m-d H:i:s')];
        $log_sql = createInsertSql('activity_logs', $log_params);
        $log_query = $pdo->prepare($log_sql);
        $log_query->execute($log_params);

        // updated
        $_SESSION[$session_username] = $username;
        $_SESSION[$session_fname] = $first_name;
        $_SESSION[$session_mname] = $middle_name;
        $_SESSION[$session_lname] = $last_name;
        $_SESSION[$session_email] = $email;
        $_SESSION['success'] = "Profile updated successfully!";
        header($redirect_header);
        return;
    } else {
        $_SESSION['error'] = "Something went wrong, please try again.";
        header($redirect_header);
        return;
    }
}
