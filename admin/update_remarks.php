<?php
session_start();

// === Step 1: Include config and database connection ===
require realpath(__DIR__ . '/../includes/config.php');
require realpath(__DIR__ . '/../includes/pdo_conn.php');

// === Step 2: Check if the form was submitted ===
if (isset($_POST['save_remarks'])) {

    // Sanitize input
    $remarks = trim($_POST['remarks']);
    $application_ids = $_POST['application_id'] ?? '';

    if (empty($application_ids)) {
        $_SESSION['error'] = "No application selected.";
        header("Location: " . BASE_URL . "announcement.php");
        exit;
    }

    // Support multiple IDs (comma-separated string from bulk action)
    $ids = array_filter(array_map('intval', explode(',', $application_ids)));

    try {
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("UPDATE user_application SET remarks = ? WHERE application_id = ?");
        foreach ($ids as $id) {
            $stmt->execute([$remarks, $id]);
        }

        $pdo->commit();
        $_SESSION['success'] = (count($ids) > 1)
            ? "Remarks updated for " . count($ids) . " scholars."
            : "Remarks updated successfully!";
    } catch (PDOException $e) {
        $pdo->rollBack();
        $_SESSION['error'] = "Database error: " . $e->getMessage();
    }

    header("Location: " . BASE_URL . "announcement.php");
    exit;

} else {
    $_SESSION['error'] = "Invalid request.";
    header("Location: " . BASE_URL . "announcement.php");
    exit;
}
