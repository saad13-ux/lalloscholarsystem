<?php
require '../includes/pdo_conn.php';
require '../includes/user_query_set.php';
require '../includes/functions.php';
require '../includes/session_variables.php';

header("Location: ../dashboard.php");

if (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];
    $params = array('user_id' => $user_id);

    // Retrieve image filename from the database
    $get_user_image_query = "SELECT image_filename FROM user WHERE user_id = :user_id";
    $query = $pdo->prepare($get_user_image_query);
    $query->execute($params);
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $image_filename = $row['image_filename'];

    // Delete the user record
    $delete_user_query = "DELETE FROM user WHERE user_id = :user_id";

    $delete_query = $pdo->prepare($delete_user_query);
    $res = $delete_query->execute($params);

    if ($res && $delete_query->rowCount() == 1) {
        // Successfully delete record
        $_SESSION['success'] = "Account Deleted Successfully";

        // Unlink the image file if it exists
        if (!empty($image_filename) && file_exists("../resources/profile/" . $image_filename)) {
            unlink("../resources/profile/" . $image_filename);
        }
        header("Location: ../login.php");

        exit();
    }
    $_SESSION['error'] = "Deleted Record Failed";
    exit();
}
