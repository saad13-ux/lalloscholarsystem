<?php

if (isset($_GET['code']) && $_GET['code'] != '') {
    // 1. Check if reset code is in the database
    $params = array('code' => trim($_GET['code']));
    $query = $pdo->prepare($check_reset_password_code_query);
    if (!$query->execute($params)) {
        $_SESSION['error'] = "Unknown error occurred.";
        header('location: login.php');
        exit();
    }
    // 2. If not valid, error is "Invalid or expired reset code."
    if ($query->rowCount() != 1) {
        $_SESSION['error'] = 'Invalid or expired reset code.';
        header('location: login.php');
        exit();
    }
}

if (isset($_POST['reset_password'])) {
    $error_redirect = "location: reset-password.php?code=$code";
    extract($_POST);
    if (empty($password)) {
        $_SESSION['error'] = 'Please provide password.';
        header($error_redirect);
        exit();
    }
    if ($password != $confirm_password) {
        $_SESSION['error'] = 'Passwords do not match.';
        header($error_redirect);
        exit();
    }
    
    try {
        $pdo->beginTransaction();
        $params = array('id' => $id, 'password' => password_hash($password, PASSWORD_DEFAULT));
        $update_query = $pdo->prepare($update_user_password_query);
        $update_query->execute($params);
        $pdo->commit();
        $_SESSION['success'] = 'Password updated successfully!';
        header('location: login.php');
        exit();
    } catch (Exception $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollback();
        }
        $_SESSION['error'] = 'Unknown error occurred.' . $e;
        header($error_redirect);
        exit();
    }
}
