<?php
require '../../includes/pdo_conn.php';
require '../includes/admin_query_set.php';
require '../includes/session_variables.php';
require '../../includes/functions.php';


      // Set the timezone to Philippines
      date_default_timezone_set('Asia/Manila');
      
$redirect_header = 'location: ../dashboard.php';

if (isset($_POST['change_password'])) {
    extract($_POST);
    if (empty($old_password) || empty($new_password) || empty($confirm_password)) {
        $_SESSION['error'] = "Empty fields not allowed!";
        header($redirect_header);
        return;
    }
    // 0 compare new_password and confirm_password if they match
    if ($new_password != $confirm_password) {
        $_SESSION['error'] = "Passwords do not match!";
        header($redirect_header);
        return;
    }
    // 1. check if old_password is correct
    $params = array('username' => $_SESSION[$session_username]);
    $query = $pdo->prepare($login_admin_query);
    $res = $query->execute($params);
    if ($res && $query->rowCount() == 1) {
        // Username matched a record
        $account = $query->fetch(PDO::FETCH_OBJ);
        if (password_verify($old_password, $account->password)) {
            // 3. If old_password is correct
            $params = array('id' => $_SESSION[$session_id], 'password' => password_hash($new_password, PASSWORD_DEFAULT));
            $update_query = $pdo->prepare($update_admin_password_query);
            if ($update_query->execute($params)) {

                $username =  $_SESSION[$session_username];
                $activity_log = "$username update his password";
                $log_params = ['activity' => $activity_log, 'timestamp' => date('Y-m-d H:i:s')];
                $log_sql = createInsertSql('activity_logs', $log_params);
                $log_query = $pdo->prepare($log_sql);
                $log_query->execute($log_params);

                $_SESSION['success'] = "Password updated successfully!";
                header($redirect_header);
                return;
            }
            $_SESSION['error'] = "Unknown error while updating password.";
            header($redirect_header);
            return;
        } else {
            // 2. If old_password is not correct, set error on session
            $_SESSION['error'] = "Password incorrect!";
            header($redirect_header);
            return;
        }
    }
}
