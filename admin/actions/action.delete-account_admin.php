<?php

require '../../includes/pdo_conn.php';
require '../includes/admin_query_set.php';
require '../includes/session_variables.php';
require '../../includes/functions.php';

header("Location: ../dashboard.php");

      // Set the timezone to Philippines
      date_default_timezone_set('Asia/Manila');

if (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];
    $params = array('user_id' => $user_id);
    $username_delete = $_POST['username'];

    // Retrieve image filename from the database
    $get_user_image_query = "SELECT image_filename FROM admin WHERE admin_id = :user_id";
    $query = $pdo->prepare($get_user_image_query);
    $query->execute($params);
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $image_filename = $row['image_filename'];

    // Delete the user record
    $delete_user_query = "DELETE FROM admin WHERE admin_id = :user_id";

    $delete_query = $pdo->prepare($delete_user_query);
    $res = $delete_query->execute($params);

    if ($res && $delete_query->rowCount() == 1) {
        // Unlink the image file if it exists
        $username = $_SESSION[$session_username];
        $activity_log = "$username deleted his account ";
        $log_params = ['activity' => $activity_log, 'timestamp' => date('Y-m-d H:i:s')];
        $log_sql = createInsertSql('activity_logs', $log_params);
        $log_query = $pdo->prepare($log_sql);
        $log_query->execute($log_params);

        // Successfully delete record
        $_SESSION['success'] = "Account Deleted Successfully";

        if (!empty($image_filename)) {
            $image_path = "../../resources/admin_profile/" . $image_filename;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }

        header("Location: ../login.php");
        exit();
    }
    $_SESSION['error'] = "Deleted Record Failed";
    exit();
}
