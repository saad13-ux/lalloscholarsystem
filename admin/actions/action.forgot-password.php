<?php
session_start();

require './includes/admin_query_set.php';
require '../includes/pdo_conn.php';
require '../includes/functions.php';

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

// ===== Handle forgot password =====
if (isset($_POST['email']) && $_POST['email'] != '') {
    $params = ['email' => $_POST['email']];
    $query = $pdo->prepare($search_admin_email_query);
    $res = $query->execute($params);

    if ($res && $query->rowCount() == 1) {
        $account = $query->fetch(PDO::FETCH_OBJ);
        $id = $account->admin_id;
        $username = $account->username;
    } else {
        $_SESSION['error'] = "The provided email does not exist.";
        header('Location: forgot-password.php');
        exit();
    }

    // Generate random code & expiration date
    $r_str = generateRandomString();
    $three_days = date('Y-m-d', strtotime('+3 days'));

    // Save reset code in DB
    $params = ['password_reset_code' => $r_str, 'password_reset_valid' => $three_days, 'id' => $id];
    $query = $pdo->prepare($set_admin_reset_code_query);
    $res = $query->execute($params);

    if (!($res && $query->rowCount() == 1)) {
        $_SESSION['error'] = 'We could not complete your request.';
        header('Location: forgot-password.php');
        exit();
    }

    // Prepare HTML email
    $resetLink = "http://localhost/lalloscholarsystem/admin/reset-password.php?code=$r_str";

    $htmlBody = "
    <html>
    <body style='font-family: Helvetica, Arial, sans-serif; margin:0; padding:0; background-color:rgb(22,110,47);'>
        <table style='width:100%;'>
            <tr>
                <td align='center'>
                    <table style='max-width:600px; background:white; padding:20px; border-radius:10px;'>
                        <tr>
                            <td style='text-align:center;'>
                                <h1>Password Reset</h1>
                                <p>If you requested to reset your password, click the button below:</p>
                                <p style='margin: 1rem 0;'>
                                    <a href='$resetLink' target='_blank' style='padding:12px 24px; border-radius:4px; color:#FFF; background:#2B52F5; text-decoration:none;'>Secure your account</a>
                                </p>
                                <p>If you did not request this, ignore this email.</p>
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

    // Send email via PHPMailer
    $sent = sendEmail($_POST['email'], $username, 'Reset your admin password', $htmlBody);

    if ($sent) {
        $_SESSION['success'] = 'We have sent a reset link to your email!';
    } else {
        $_SESSION['error'] = 'We could not send the reset link. Please try again later.';
    }

    header('Location: forgot-password.php');
    exit();
}
