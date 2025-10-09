<?php
require '../includes/pdo_conn.php';
require './includes/admin_query_set.php';
require './includes/session_variables.php';
require '../includes/functions.php'; 

session_start();
$username = $_SESSION[$session_username]; // Assuming username is stored in the session
$activity_log = "$username logout";
$log_params = ['activity' => $activity_log, 'timestamp' => date('Y-m-d H:i:s')];
$log_sql = createInsertSql('activity_logs', $log_params);
$query = $pdo->prepare($log_sql);
if ($query->execute($log_params)) {
    session_destroy();
    header('location: login.php');
    exit();
} else {
    $_SESSION['error'] = 'Failed to insert activity log.';
    header('location: login.php');
    exit();
}
