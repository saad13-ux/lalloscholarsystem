<?php
// delete_requirement.php

require '../../includes/pdo_conn.php';
require '../../includes/functions.php';
require '../includes/session_variables.php';

// Set the timezone to Philippines
date_default_timezone_set('Asia/Manila');

try {
    $params = allowOnly($_POST, ['id']);

    $Rnamequery = $pdo->prepare("SELECT r.requirement_name, s.scholarship_type FROM requirement_data as r inner join scholarship as s on r.scholarship_id = s.scholarship_id WHERE requirement_id = :id");
    $Rnamequery->execute($params);

    $row = $Rnamequery->fetch(PDO::FETCH_ASSOC);
    $requirementName = $row['requirement_name'];

    $scholarship_type = $row['scholarship_type'];


    $query = $pdo->prepare("DELETE FROM requirement_data WHERE requirement_id = :id");
    $query->execute($params);

    if ($query->rowCount() > 0) {
        $username = $_SESSION[$session_username]; // Assuming username is stored in the session
        $activity_log = "$username deleted scholarship requirement with the named $requirementName of $scholarship_type";
        $log_params = ['activity' => $activity_log, 'timestamp' => date('Y-m-d H:i:s')];

        $log_query = "INSERT INTO activity_logs (activity, timestamp) VALUES (:activity, :timestamp)";
        $stmt = $pdo->prepare($log_query);
        $stmt->execute($log_params);

        echo 'success';
    } else {
        // Deletion failed
        echo 'error';
    }
} catch (Exception $e) {
    echo 'error: ' . $e->getMessage();
}
?>
