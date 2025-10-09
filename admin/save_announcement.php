<?php
require __DIR__ . '/includes/check_session.php';
require __DIR__ . '/../includes/config.php';

if (isset($_POST['save_announcement'])) {
    $title = trim($_POST['title']);
    $message = trim($_POST['message']);
    $expires_at = !empty($_POST['expires_at']) ? $_POST['expires_at'] : NULL;

    $stmt = $pdo->prepare("INSERT INTO general_announcements (title, message, expires_at) VALUES (?, ?, ?)");
    $stmt->execute([$title, $message, $expires_at]);

    header("Location: general_announcement.php?success=1");

    exit;
}
