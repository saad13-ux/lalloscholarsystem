<?php
session_start();

require '../../includes/pdo_conn.php';
require '../includes/admin_query_set.php';
require '../includes/session_variables.php';
require '../../includes/functions.php';

// Load Composer autoload for PHPMailer
require __DIR__ . '/../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Set timezone
date_default_timezone_set('Asia/Manila');

// ===== PHPMailer function =====
function sendEmail($to, $toName, $subject, $bodyHtml, $bodyAlt = null) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'insess013@gmail.com';
        $mail->Password   = 'huzc rsqh eugb tkmb'; // App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('insess013@gmail.com', 'LGU Lal-lo Scholarship System');
        $mail->addAddress($to, $toName);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $bodyHtml;
        $mail->AltBody = $bodyAlt ?? strip_tags($bodyHtml);

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Email could not be sent. Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}

// ===== Handle send feedback =====
if (isset($_POST['send_feedback'])) {
    $username = $_POST['username']; 
    $email = $_POST['email'];   
    $subject_message = $_POST['subject']; 
    $body_message = $_POST['body'];

    // Prepare HTML content
    $htmlBody = "
    <html>
    <body style='font-family: Helvetica, Arial, sans-serif; margin:0; padding:0; background-color:rgb(22,110,47);'>
        <table style='width:100%;'>
            <tr>
                <td align='center'>
                    <table style='max-width:600px; background:white; padding:20px; border-radius:10px;'>
                        <tr>
                            <td style='text-align:center;'>
                                <h1>Message</h1>
                                <p>Hello <strong style='font-size:130%;'>{$username}</strong>,</p>
                                <p>{$body_message}</p>
                                <p>Thanks,<br>Local Government Unit of Lal-lo</p>
                            </td>
                        </tr>
                    </table>
                    <p style='color:white; margin-top:10px; text-align:center;'>Lal-lo Shines Even Brighter ♥</p>
                </td>
            </tr>
        </table>
    </body>
    </html>
    ";

    $sent = sendEmail($email, $username, $subject_message, $htmlBody);

    if ($sent) {
        // Log activity
        $sessionUser = $_SESSION[$session_username] ?? 'Unknown';
        $activity_log = "$sessionUser replied to $email";
        $log_params = ['activity' => $activity_log, 'timestamp' => date('Y-m-d H:i:s')];
        $log_sql = createInsertSql('activity_logs', $log_params);
        $log_query = $pdo->prepare($log_sql);
        $log_query->execute($log_params);

        $_SESSION['success'] = "Successfully sent reply!";
    } else {
        $_SESSION['error'] = "Something went wrong. Please try again.";
    }

    header('Location: ../feedback.php');
    exit();
}
