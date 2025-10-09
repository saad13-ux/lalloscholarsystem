<?php
$server = "localhost";
$username = "root";
$password = "";
$db_name = "data_database_scholarshipedit";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    $pdo = new PDO("mysql:host=$server;dbname=$db_name", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $_SESSION['error'] = "Connection failed: " . $e->getMessage();
    echo $_SESSION['error'];
}
