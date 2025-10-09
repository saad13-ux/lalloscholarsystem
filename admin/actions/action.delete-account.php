<?php

require '../../includes/pdo_conn.php';
require '../includes/admin_query_set.php';
require '../includes/session_variables.php';
require '../../includes/functions.php';

      // Set the timezone to Philippines
date_default_timezone_set('Asia/Manila');

header("Location: ../account.php");

if (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];
    $params = array('user_id' => $user_id);

    // Retrieve image filename from the database
    $get_user_image_query = "SELECT image_filename, username FROM user WHERE user_id = :user_id";
    $query = $pdo->prepare($get_user_image_query);
    $query->execute($params);
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $image_filename = $row['image_filename'];
    $username = $row['username'];

    // Delete the user record
    $delete_user_admin_query = "DELETE FROM user WHERE user_id = :user_id";

    $delete_query = $pdo->prepare($delete_user_admin_query);
    $res = $delete_query->execute($params);

    if ($res && $delete_query->rowCount() == 1) {

        $username_admin =  $_SESSION[$session_username];
        $activity_log = "$username_admin delete the account named $username ";
        $log_params = ['activity' => $activity_log, 'timestamp' => date('Y-m-d H:i:s')];
        $log_sql = createInsertSql('activity_logs', $log_params);
        $log_query = $pdo->prepare($log_sql);
        $log_query->execute($log_params);
        // Successfully delete record
        $_SESSION['success'] = "Record Deleted Successfully";

        // Unlink the image file if it exists
        if (!empty($image_filename) && file_exists("../../resources/profile/" . $image_filename)) {
            unlink("../../resources/profile/" . $image_filename);
        }

        exit();
    }
    $_SESSION['error'] = "Deleted Record Failed";
    exit();
}
