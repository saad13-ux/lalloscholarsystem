<?php
session_start();

// === Step 1: Include config and database connection ===
require realpath(__DIR__ . '/../includes/config.php');
require realpath(__DIR__ . '/../includes/pdo_conn.php');

// === Step 2: Check if form submitted ===
if (isset($_POST['bulk_announce'])) {


  $application_ids = $_POST['application_ids'] ?? '';


    $remarks = trim($_POST['remarks']);

    if (empty($application_ids)) {
        $_SESSION['error'] = "No scholars selected for bulk announcement.";
        header("Location: " . BASE_URL . "announcement.php");
        exit;
    }

    // Support multiple IDs (comma-separated string from bulk modal)
    $ids = array_filter(array_map('intval', explode(',', $application_ids)));

    try {
        $pdo->beginTransaction();

        // === Step 3: Prepare SQL to set claim_date now, optionally remarks ===
    
                $sql = "UPDATE user_application 
        SET claimed = 1, claim_date = NOW(), remarks = :remarks 
        WHERE application_id = :id";

        $stmt = $pdo->prepare($sql);

        foreach ($ids as $id) {
            $stmt->execute([
                ':remarks' => $remarks,
                ':id' => $id
            ]);
        }

        $pdo->commit();

        $_SESSION['success'] = "Bulk announcement created for " . count($ids) . " scholars.";
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
