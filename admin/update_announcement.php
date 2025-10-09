<?php
require __DIR__ . '/includes/check_session.php';
require __DIR__ . '/../includes/config.php';

if(isset($_POST['update_announcement'])) {
    $id = intval($_POST['id']);
    $title = trim($_POST['title']);
    $message = trim($_POST['message']);
    $expires_at = !empty($_POST['expires_at']) ? $_POST['expires_at'] : NULL;

    $stmt = $pdo->prepare("UPDATE general_announcements SET title = ?, message = ?, expires_at = ? WHERE id = ?");
    $stmt->execute([$title, $message, $expires_at, $id]);

    header("Location: general_announcement.php?updated=1");
    exit;
}
