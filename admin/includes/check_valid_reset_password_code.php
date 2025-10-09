<?php
if (!isset($_GET['code'])) {
    header('location: login.php');
    exit();
}

// There is a code here

$params = array('code' => $_GET['code']);
// Check if code is valid
$check_query = $pdo->prepare($check_reset_password_code_query);
if (!$check_query->execute($params)) {
    exit();
}

if ($check_query->rowCount() == 1) {
    $account = $check_query->fetch(PDO::FETCH_ASSOC);
    extract($account);
}
