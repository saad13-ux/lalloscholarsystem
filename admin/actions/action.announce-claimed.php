<?php
require '../../includes/pdo_conn.php';
require '../includes/session_variables.php';
require '../../includes/functions.php';

header('Location: ../announcement.php');

if (isset($_POST['claimed']) && isset($_POST['application_id'])) {
    $application_id = $_POST['application_id'];
    $scholarship_type = $_POST['scholarship_type'];
    $name = $_POST['name'];
    // Set the timezone to Philippines
    date_default_timezone_set('Asia/Manila');

    $currentDateTime = new DateTime();
    $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');

    try {
        $pdo->beginTransaction();


        // Update the claimed status and claimed_datetime
        $update_query = $pdo->prepare("UPDATE user_application SET claimed = 1, claimed_datetime = :formattedDateTime WHERE application_id = :application_id");
        $update_query->bindParam(':formattedDateTime', $formattedDateTime);
        $update_query->bindParam(':application_id', $application_id, PDO::PARAM_INT);
        $update_query->execute();
        
        $username = $_SESSION[$session_username];
        $activity_log = "$username clicked claim status of $scholarship_type scholarship of $name";

        // Insert the activity log
        $log_params = [
            'activity' => $activity_log,
            'timestamp' =>$formattedDateTime
        ];
        $log_sql = createInsertSql('activity_logs', $log_params);
        $log_query = $pdo->prepare($log_sql);
        $log_query->execute($log_params);

        $pdo->commit();
        
        $_SESSION['success'] = "Allowance Claimed!";
    } catch (Exception $e) {
        $pdo->rollback();
        $_SESSION['error'] = "Failed to update user application: " . $e->getMessage();
    }
} else {
    $_SESSION['error'] = "Failed to update user application.";
}
?>
