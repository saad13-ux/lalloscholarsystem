<?php
require '../includes/pdo_conn.php';
require '../includes/user_query_set.php';
require '../includes/session_variables.php';
require '../includes/functions.php';

if (isset($_POST['change_password'])) {
    extract($_POST);

    if (empty($old_password) || empty($new_password) || empty($confirm_password)) {
        $_SESSION['error'] = "Empty fields not allowed!";
        header('location: ../dashboard.php');
        exit;
    }

    if ($new_password != $confirm_password) {
        $_SESSION['error'] = "Passwords do not match!";
        header('location: ../dashboard.php');
        exit;
    }

    // 1. check if old_password is correct
    $params = [':username' => $_SESSION[$session_username]];
    $query = $pdo->prepare($login_user_query);
    $res   = $query->execute($params);

    if ($res && $query->rowCount() == 1) {
        $account = $query->fetch(PDO::FETCH_OBJ);

        if (password_verify($old_password, $account->password)) {
            
            $params = [
                ':id'       => $_SESSION[$session_user_id],
                ':password' => password_hash($new_password, PASSWORD_DEFAULT)
            ];

            $update_query = $pdo->prepare($update_user_password_query);

            if ($update_query->execute($params)) {
                $_SESSION['success'] = "Password updated successfully!";
            } else {
                $_SESSION['error'] = "Unknown error while updating password.";
            }
        } else {
            $_SESSION['error'] = "Old password incorrect!";
        }
    } else {
        $_SESSION['error'] = "User not found!";
    }
}

header('location: ../dashboard.php');
exit;
