
<?php

require '../../includes/pdo_conn.php';
require '../includes/admin_query_set.php';
require '../includes/session_variables.php';
require '../../includes/functions.php';

      // Set the timezone to Philippines
      date_default_timezone_set('Asia/Manila');

header("Location: ../feedback.php");

if (isset($_POST['delete_feedback'])) {
    $feedback_id = $_POST['feedback_id'];
    $email = $_POST['email'];
    $params = array('feedback_id' => $feedback_id);
    $query = $pdo->prepare($delete_feedback_admin_query);
    $res = $query->execute($params);

    if ($res && $query->rowCount() == 1) {

        $username =  $_SESSION[$session_username];
        $activity_log = "$username delete feedback of $email";
        $log_params = ['activity' => $activity_log, 'timestamp' => date('Y-m-d H:i:s')];
        $log_sql = createInsertSql('activity_logs', $log_params);
        $log_query = $pdo->prepare($log_sql);
        $log_query->execute($log_params);

        // Successfully delete record
        $_SESSION['success'] = "Record Deleted Successfully";
        exit();
    }
    $_SESSION['error'] = "Deleted Record Failed";
   exit();
}
