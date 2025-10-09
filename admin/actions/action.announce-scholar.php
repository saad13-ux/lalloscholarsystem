<?php
require '../../includes/pdo_conn.php';
require '../includes/session_variables.php';
require '../../includes/functions.php';

header('location: ../announcement.php');


if (isset($_POST['announce-scholar'])) {
    $app_id = $_POST['application_id'];
    $scholarship_type = $_POST['scholarship_type'];
    $claim_date = $_POST['claim_date'];

     // Set the timezone to Philippines
     date_default_timezone_set('Asia/Manila');
    
     $currentDateTime = new DateTime();
     $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');
 

    if ($app_id == '' || $claim_date == '') {
        $_SESSION['error'] = 'Missing required fields.';
        return;
    }

    $params = allowOnly($_POST, ['claim_date']);
    $sql = createUpdateSql('user_application', $params, 'application_id');
    $params['application_id'] = $app_id;
    $qry = $pdo->prepare($sql);
    if ($qry->execute($params)) {
        $name= $_POST['beneficiary_name'];
        $username =  $_SESSION[$session_username];
        $activity_log = "$username post release schedule of $scholarship_type scholarship on $claim_date of $name";
        $log_params = ['activity' => $activity_log, 'timestamp' => $formattedDateTime];
        $log_sql = createInsertSql('activity_logs', $log_params);
        $log_query = $pdo->prepare($log_sql);
        $log_query->execute($log_params);

        $_SESSION['success'] = "Release schedule has been announced successfully!";
        return;

    } else {
        $_SESSION['error'] = "Something went wrong, please try again.";
        return;
    }
}


