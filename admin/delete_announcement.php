<?php
require __DIR__ . '/includes/check_session.php';
require __DIR__ . '/../includes/config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $pdo->prepare("DELETE FROM general_announcements WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: general_announcement.php?deleted=1");
    exit;
} else {
    // If no ID is provided, redirect back
    header("Location: general_announcement.php");
    exit;
}
