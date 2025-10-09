<?php
require '../includes/pdo_conn.php';
require './includes/admin_query_set.php';
require './includes/session_variables.php';
require '../includes/functions.php'; // Include the functions.php file where createInsertSql is defined


      // Set the timezone to Philippines
      date_default_timezone_set('Asia/Manila');

if (isset($_POST['login_admin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = 'Username and password are required.';
        header("location: login.php"); // Redirect back to the login page
        exit();
    } else {
        $params = array('username' => $username);
        $query = $pdo->prepare($login_admin_query);
        $res = $query->execute($params);
        if ($res && $query->rowCount() == 1) {
            // Successfully logged in
            $account = $query->fetch(PDO::FETCH_OBJ);
            if (password_verify($password, $account->password)) {
                $_SESSION['success'] = "Successfully logged in as $username.";
                $_SESSION[$session_username] = $account->username;
                $_SESSION[$session_fname] = $account->first_name;
                $_SESSION[$session_mname] = $account->middle_name;
                $_SESSION[$session_lname] = $account->last_name;
                $_SESSION[$session_email] = $account->email;
                $_SESSION[$session_id] = $account->admin_id;

                $username = $_SESSION[$session_username]; // Assuming username is stored in the session
                $activity_log = "$username login";
                $log_params = ['activity' => $activity_log, 'timestamp' => date('Y-m-d H:i:s')];
                $log_sql = createInsertSql('activity_logs', $log_params);
                $query = $pdo->prepare($log_sql);
                if ($query->execute($log_params)) {
                    header("location: dashboard.php");
                    exit();
                } else {
                    $_SESSION['error'] = 'Failed to insert activity log.';
                    header("location: login.php"); // Redirect back to the login page
                    exit();
                }
            } else {
                $_SESSION['error'] = 'Username or password incorrect.';
                header("location: login.php"); // Redirect back to the login page
                exit();
            }
        } else {
            $_SESSION['error'] = 'Username or password incorrect.';
            header("location: login.php"); // Redirect back to the login page
            exit();
        }
    }
}
