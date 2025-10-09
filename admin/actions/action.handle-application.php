<?php
require '../../includes/pdo_conn.php';
require '../includes/admin_query_set.php';
require '../includes/session_variables.php';
require '../../includes/functions.php';

// Composer autoload for PHPMailer
require __DIR__ . '/../../vendor/autoload.php';

// Load EmailService class
require __DIR__ . '/../../models/EmailService.php';

// Set timezone
date_default_timezone_set('Asia/Manila');

// Redirect target
$redirectPage = '../application.php';

// ===== Reusable Email Template =====
function buildEmailHtml($content) {
    return "
    <html>
      <body style='font-family: Arial, sans-serif; background-color: #f4f6f9; margin: 0; padding: 0;'>
        <table align='center' width='600' cellpadding='0' cellspacing='0' style='background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); margin: 20px auto;'>
          <tr>
            <td style='background-color: #197023ff; padding: 20px; text-align: center; border-radius: 8px 8px 0 0;'>
              
              <h2 style='color: #ffffff; margin: 10px 0 0;'>LGU Lal-lo Scholarship Assistance</h2>
            </td>
          </tr>
          <tr>
            <td style='padding: 30px; color: #333333; line-height: 1.6;'>
              $content
            </td>
          </tr>
          <tr>
            <td style='background-color: #f1f1f1; text-align: center; padding: 15px; border-radius: 0 0 8px 8px; font-size: 12px; color: #666;'>
              <p>&copy; " . date('Y') . " LGU Lal-lo. All rights reserved.</p>
              <p>This is an automated message, please do not reply directly.</p>
            </td>
          </tr>
        </table>
      </body>
    </html>";
}

// ===== APPROVE APPLICATION =====
if (isset($_POST['approve_application'])) {
    $application_id = $_POST['application_id'];
    $scholarship_type = $_POST['scholarship_type'];
    $formattedDateTime = (new DateTime())->format('Y-m-d H:i:s');

    try {
        $pdo->beginTransaction();

        $query = $pdo->prepare("SELECT u.email, CONCAT(a.b_fname,' ', a.b_mname,' ', a.b_lname,' ', a.b_ext_name) AS fullname 
                                FROM user_application AS a 
                                INNER JOIN user AS u ON u.user_id = a.user_id 
                                WHERE a.application_id = :application_id");
        $query->execute(['application_id' => $application_id]);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $email = $row['email'];
        $name = $row['fullname'];

        $update_query = $pdo->prepare("UPDATE user_application 
                                       SET approved = 1, approved_datetime = :formattedDateTime 
                                       WHERE application_id = :application_id");
        $update_query->execute([
            'formattedDateTime' => $formattedDateTime,
            'application_id' => $application_id
        ]);

        $content = "
        <h1 style='color: #28a745;'>🎉 Congratulations, $name!</h1>
        <p>We are pleased to inform you that your <b>$scholarship_type</b> scholarship application has been <b style='color: #28a745;'>approved</b>.</p>
       
         <p>Please be advised that if you have received this email, you are required to personally submit all necessary documentary requirements at the LGU Lal-lo Municipal Hall, Local Youth Development Office.</p>

        <p>If you have any questions or concerns, feel free to contact us through the <strong>Feedback</strong> button in your account or via the <strong>Contact Us</strong> section on the system.</p>

         <p>Kindly wait for the official claim schedule announcement, which will be posted through the system and facebook page.</p>
         
         <p>Congratulation and wish you all the best in your journey!</p>
        
        <p style='margin-top:20px;'><strong>– Lal-lo Shines Even Brighter ✨</strong></p>
        ";

        (new EmailService())->sendHtmlEmail($email, "Your Application has Been Approved", buildEmailHtml($content));

        $username = $_SESSION[$session_username];
        $activity_log = "$username approved $scholarship_type scholarship for applicant $name";
        $log_params = ['activity' => $activity_log, 'timestamp' => date('Y-m-d H:i:s')];
        $pdo->prepare(createInsertSql('activity_logs', $log_params))->execute($log_params);

        $pdo->commit();
        $_SESSION['success'] = "Application Approved!";
    } catch (PDOException $e) {
        if ($pdo->inTransaction()) $pdo->rollBack();
        $_SESSION['error'] = "Something went wrong: " . $e->getMessage();
    }

    header("Location: $redirectPage");
    exit;
}

// ===== DECLINE APPLICATION =====
if (isset($_POST['decline_application'])) {
    $application_id = $_POST['application_id'];
    $scholarship_type = $_POST['scholarship_type'];
    $decline_reason = trim($_POST['reason_decline'] ?? '');
    $formattedDateTime = (new DateTime())->format('Y-m-d H:i:s');

    try {
        $pdo->beginTransaction();

        $query = $pdo->prepare("SELECT u.email, CONCAT(a.b_fname,' ', a.b_mname,' ', a.b_lname,' ', a.b_ext_name) AS fullname 
                                FROM user_application AS a 
                                INNER JOIN user AS u ON u.user_id = a.user_id 
                                WHERE a.application_id = :application_id");
        $query->execute(['application_id' => $application_id]);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $email = $row['email'];
        $name = $row['fullname'];

        $update_query = $pdo->prepare("UPDATE user_application 
                                       SET approved = 2, declined_datetime = :formattedDateTime, decline_reason = :decline_reason 
                                       WHERE application_id = :application_id");
        $update_query->execute([
            'formattedDateTime' => $formattedDateTime,
            'decline_reason' => $decline_reason,
            'application_id' => $application_id
        ]);

        if ($update_query->rowCount() == 1) {
            $content = "
            <h1 style='color: #dc3545;'>⚠️ Application Update</h1>
            <p>Hello <b>$name</b>,</p>
            <p>Thank you for applying for the <b>$scholarship_type</b> scholarship program. After careful review, we regret to inform you that your application has been <b style='color: #dc3545;'>declined</b>.</p>
            <p><b>Reason:</b> $decline_reason</p>
            <p>We encourage you to reapply in the future and explore other scholarship opportunities with us. Try reading other scholarship programs available and APPLY NOW.</p>
            <p>If you have any questions or concerns, feel free to contact us through the <strong>Feedback</strong> button in your account or via the <strong>Contact Us</strong> section on the system.</p>
            <p><strong>– Lal-lo Shines Even Brighter ✨</strong></p>
            ";

            (new EmailService())->sendHtmlEmail($email, "Your Application has Been Declined", buildEmailHtml($content));

            $username = $_SESSION[$session_username];
            $activity_log = "$username declined $scholarship_type scholarship for applicant $name (Reason: $decline_reason)";
            $log_params = ['activity' => $activity_log, 'timestamp' => date('Y-m-d H:i:s')];
            $pdo->prepare(createInsertSql('activity_logs', $log_params))->execute($log_params);

            $pdo->commit();
            $_SESSION['success'] = "Application Declined!";
        }
    } catch (PDOException $e) {
        if ($pdo->inTransaction()) $pdo->rollBack();
        $_SESSION['error'] = "Something went wrong: " . $e->getMessage();
    }

    header("Location: $redirectPage");
    exit;
}



// ===== PENDING APPLICATION =====
if (isset($_POST['ongoing_application'])) {
    $application_id = $_POST['application_id'];
    $scholarship_type = $_POST['scholarship_type'];
    $pending_reason = trim($_POST['reason_pending'] ?? '');
    $formattedDateTime = (new DateTime())->format('Y-m-d H:i:s');

    try {
        $pdo->beginTransaction();

        $query = $pdo->prepare("SELECT u.email, CONCAT(a.b_fname,' ', a.b_mname,' ', a.b_lname,' ', a.b_ext_name) AS fullname 
                                FROM user_application AS a 
                                INNER JOIN user AS u ON u.user_id = a.user_id 
                                WHERE a.application_id = :application_id");
        $query->execute(['application_id' => $application_id]);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $email = $row['email'];
        $name = $row['fullname'];

        $update_query = $pdo->prepare("UPDATE user_application 
                                       SET approved = 3, ongoing_datetime = :formattedDateTime, pending_reason = :pending_reason
                                       WHERE application_id = :application_id");
        $update_query->execute([
            'formattedDateTime' => $formattedDateTime,
            'pending_reason' => $pending_reason,
            'application_id' => $application_id
        ]);

        if ($update_query->rowCount() == 1) {
            $content = "
            <h1 style='color: #ffc107;'>⏳ Your Application is Under Review</h1>
            <p>Hello <b>$name</b>,</p>
            <p>Your <b>$scholarship_type</b> scholarship application is currently <b>pending review</b>.</p>
            <p><b>Reason:</b> $pending_reason</p>
            <p>Our committee is carefully processing your documents. We will notify you as soon as a decision has been made.</p>
            <p>Thank you for your patience and trust in our scholarship program.</p>
            <p><strong>– Lal-lo Shines Even Brighter ✨</strong></p>
            ";

            (new EmailService())->sendHtmlEmail($email, "Your Application is Pending Review", buildEmailHtml($content));

            $username = $_SESSION[$session_username];
            $activity_log = "$username set $scholarship_type scholarship for applicant $name to pending (Reason: $pending_reason)";
            $log_params = ['activity' => $activity_log, 'timestamp' => date('Y-m-d H:i:s')];
            $pdo->prepare(createInsertSql('activity_logs', $log_params))->execute($log_params);

            $pdo->commit();
            $_SESSION['success'] = "Application marked as Pending!";
        }
    } catch (PDOException $e) {
        if ($pdo->inTransaction()) $pdo->rollBack();
        $_SESSION['error'] = "Something went wrong: " . $e->getMessage();
    }

    header("Location: $redirectPage");
    exit;
}
