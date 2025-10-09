<?php
session_start();
require '../includes/pdo_conn.php';
require '../includes/user_query_set.php';
require '../includes/session_variables.php';
require '../includes/functions.php';

if (isset($_POST['send_feedback'])) {
    $required_fields = [
        'name',
        'email',
        'subject',
        'body',
    ];

    $has_empty_required = hasEmptyFields($_POST, $required_fields);
    if ($has_empty_required) {
        $_SESSION['error'] = $has_empty_required . ' is required.';
        header("Location: ../" . ($_POST['redirect'] ?? 'contact') . ".php");
        exit;
    }

    $params = allowOnly($_POST, $required_fields);
    $sql = createInsertSql('feedback', $params);
    $query = $pdo->prepare($sql);

    if ($query->execute($params) && $query->rowCount() == 1) {
        // Insert new admin notification
        $notif_params = ['message' => 'New feedback from ' . $params['email'] . '!'];
        $insert_notif_sql = "INSERT INTO `admin_notification`(`type`, `message`) VALUES(3, :message)";
        $insert_notif_qry = $pdo->prepare($insert_notif_sql);
        $insert_notif_qry->execute($notif_params);

        $_SESSION['success'] = "Feedback has been sent to admin!";
    } else {
        $_SESSION['error'] = "Something went wrong, please try again.";
    }
}

// Redirect back to the source page
$redirect_page = $_POST['redirect'] ?? 'contact';
header("Location: ../{$redirect_page}.php");
exit;
