<?php
require '../includes/pdo_conn.php';
require '../includes/user_query_set.php';
require '../includes/session_variables.php';
require '../includes/functions.php';
require '../vendor/autoload.php';



header('location: ../verification.php');
if (isset($_POST['verify_email'])) {
    $email_vcode = $_POST['email_vcode'];
    if ($email_vcode !=$_SESSION[$session_email_vcode]) {
       $_SESSION['error'] = 'Invalid verification';
        return;
    }
     // Success, update the account to verified email
    $params = array('user_id' => $_SESSION[$session_user_id]);
    $set_user_email_verified = "UPDATE user SET email_verified = 1, active = 1, email_vcode = NULL where user_id=:user_id";
    $query = $pdo->prepare($set_user_email_verified);
    if ($query->execute($params) && $query->rowCount() == 1) {
        $_SESSION['success'] = "Email has been verified.";
        header("location: ../dashboard.php");
    } else {
        $_SESSION['error'] = "Something went wrong, please try again.";
        return;
    }
}
