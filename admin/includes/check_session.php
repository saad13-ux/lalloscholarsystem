<?php
require '../includes/pdo_conn.php';
require '../includes/functions.php';
require './includes/session_variables.php';
require './includes/admin_query_set.php';
$username = null;
$username = $_SESSION[$session_username] ?? null;
if ($username) {
    $params = array('username' => $username);
    $query = $pdo->prepare($login_admin_query);
    $res = $query->execute($params);
    if ($res && $query->rowCount() == 1) {
        // valid session
        $success = 'Restored session for ' . $username . ".";
    } else {
        // invalid session
        header("location: logout.php");
        exit();
    }
} else {
    header("location: logout.php");
    exit();
}
