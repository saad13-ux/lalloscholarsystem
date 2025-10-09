<?php
require '../includes/pdo_conn.php';
require '../includes/user_query_set.php';
require '../includes/functions.php';

$response = array();

if (isset($_POST['sign'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['Npassword'];
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $errorEmpty = false;
    $errorEmail = false;
    $errorPassword = false;

    if (empty($username) || empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($confirm_password)) {
        $response['error'] = 'Fill all fields.';
        $errorEmpty = true;
    } else {
        // Check if username exists
        $params = allowOnly($_POST, ['username']);
        $check_duplicate_username_sql = 'SELECT user_id FROM user WHERE username=:username';
        $check_duplicate_query = $pdo->prepare($check_duplicate_username_sql);
        if ($check_duplicate_query->execute($params) && $check_duplicate_query->rowCount() > 0) {
            $response['error'] = 'Username already exists.';
            $errorEmpty = true;
        }

        if ($password != $confirm_password) {
            $response['error'] = 'Passwords do not match.';
            $errorPassword = true;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response['error'] = 'Invalid email format.';
            $errorEmail = true;
        } else {
            // Check if email exists
            $params = allowOnly($_POST, ['email']);
            $check_duplicate_email_sql = 'SELECT user_id FROM user WHERE email=:email';
            $check_duplicate_query = $pdo->prepare($check_duplicate_email_sql);
            if ($check_duplicate_query->execute($params) && $check_duplicate_query->rowCount() > 0) {
                $response['error'] = 'Email already exists.';
                $errorEmpty = true;
            }
        }

        if (!$errorEmpty && !$errorEmail && !$errorPassword) {
            $params = allowOnly($_POST, ['username', 'password', 'email', 'first_name', 'last_name']);
            $params['password'] = password_hash($password, PASSWORD_DEFAULT);

            $sql = createInsertSql('user', $params);
            $query = $pdo->prepare($sql);
            if ($query->execute($params)) {
                $response['success'] = 'User registration successful! Please Log in to complete your profile';
                
            } else {
                $response['error'] = 'There was an error with user registration.';
            }
        }
    }
} else {
    $response['error'] = 'Invalid request.';
}

echo json_encode($response);
?>
