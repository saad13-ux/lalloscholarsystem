<?php
require '../../includes/pdo_conn.php';
require '../includes/admin_query_set.php';
require '../includes/session_variables.php';
require '../../includes/functions.php';

header('location: ../feedback.php');

if (isset($_POST['mark_read'])) {
        $email = $_POST['email']; 
    if (empty($_POST['feedback_id'])) {
        $_SESSION['error'] = "No feedback ID specified, cannot update.";
        return;
    }
    $params = allowOnly($_POST, ["feedback_id"]);
    $sql = "UPDATE feedback SET status=1 WHERE feedback_id=:feedback_id";
    $query = $pdo->prepare($sql);
    if ($query->execute($params)) {

        $username =  $_SESSION[$session_username];
        $activity_log = "$username read feedback of $email";
        $log_params = ['activity' => $activity_log, 'timestamp' => date('Y-m-d H:i:s')];
        $log_sql = createInsertSql('activity_logs', $log_params);
        $log_query = $pdo->prepare($log_sql);
        $log_query->execute($log_params);
        // updated
        $_SESSION['success'] = "Feedback successfully marked as read!";
        return;
    } else {
        $_SESSION['error'] = "Something went wrong, please try again.";
        return;
    }
}
