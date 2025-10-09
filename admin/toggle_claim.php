<?php
session_start();

// === Step 1: Include config and database connection ===
require realpath(__DIR__ . '/../includes/config.php');
require realpath(__DIR__ . '/../includes/pdo_conn.php');

// === Step 2: Handle AJAX request ===
if (isset($_POST['application_id'])) {
    $id = intval($_POST['application_id']);

    try {
        // Get current status
        $stmt = $pdo->prepare("SELECT claimed FROM user_application WHERE application_id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $newStatus = $row['claimed'] ? 0 : 1;

            // Update claimed + claim_date
            if ($newStatus === 1) {
                $update = $pdo->prepare("UPDATE user_application 
                                         SET claimed = 1, claim_date = NOW() 
                                         WHERE application_id = ?");
            } else {
                $update = $pdo->prepare("UPDATE user_application 
                                         SET claimed = 0, claim_date = NULL 
                                         WHERE application_id = ?");
            }

            if ($update->execute([$id])) {
                echo json_encode([
                    'success' => true,
                    'claimed' => $newStatus,
                    'message' => $newStatus ? "Scholar marked as Claimed" : "Scholar marked as Unclaimed"
                ]);
                exit;
            }
        }

        echo json_encode(['success' => false, 'message' => 'Record not found.']);
        exit;

    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => "Database error: " . $e->getMessage()]);
        exit;
    }

} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
    exit;
}
