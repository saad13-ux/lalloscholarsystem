<?php
session_start();

require 'includes/user_query_set.php';
require 'includes/pdo_conn.php';
require 'includes/functions.php';

// Load Composer autoload for PHPMailer
require __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Set the timezone to Philippines
date_default_timezone_set('Asia/Manila');

// ===== PHPMailer function =====
function sendEmail($to, $toName, $subject, $bodyHtml, $bodyAlt = null) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'insess013@gmail.com';        // SMTP username
        $mail->Password   = 'huzc rsqh eugb tkmb';        // SMTP app password
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
    // 1. Check if the email exists
    $params = ['email' => $_POST['email']];
    $query = $pdo->prepare($search_user_email_query);
    $res = $query->execute($params);

    if ($res && $query->rowCount() == 1) {
        $account = $query->fetch(PDO::FETCH_OBJ);
        $id = $account->user_id;
        $username = $account->username;
    } else {
        $_SESSION['error'] = 'The provided email does not exist in our database.';
        header("Location: forgot-password.php");
        exit();
    }

    // 2. Generate reset code
    $r_str = generateRandomString();
    $three_days = date('Y-m-d', strtotime('+3 days'));

    // 3. Save reset code to database
    $params = [
        'password_reset_code' => $r_str,
        'password_reset_valid' => $three_days,
        'user_id' => $id
    ];
    $query = $pdo->prepare($set_user_reset_code_query);
    $res = $query->execute($params);

    if (!($res && $query->rowCount() == 1)) {
        $_SESSION['error'] = 'We could not complete your request.';
        header("Location: forgot-password.php");
        exit();
    }

    // 4. Prepare email content
    $resetLink = "http://localhost/lalloscholarsystem/reset-password.php?code=$r_str";
    $htmlBody = "
    <html>
    <body style='font-family: Helvetica, Arial, sans-serif; background-color:rgb(22, 110, 47); padding:0; margin:0;'>
        <table style='width:100%;'>
            <tr>
                <td align='center'>
                    <table style='max-width:600px; background:white; padding:20px; border-radius:10px;'>
                        <tr>
                            <td style='text-align:center;'>
                                <h1>Password Reset</h1>
                                <p>Your account requested a password reset.</p>
                                <p>Click the button below to reset your password:</p>
                                <a href='$resetLink' target='_blank' 
                                   style='padding:12px 24px; background:#2c753d; color:#fff; border-radius:4px; text-decoration:none; display:inline-block;'>Reset Password</a>
                                <p>Thanks,<br>Local Government Unit of Lal-lo</p>
                            </td>
                        </tr>
                    </table>
                    <p style='color:white; margin-top:10px;'>Lal-lo Shines Even Brighter</p>
                </td>
            </tr>
        </table>
    </body>
    </html>";

    // 5. Send email
    $sent = sendEmail($_POST['email'], $username, 'Password Reset Request', $htmlBody);

    if ($sent) {
        $_SESSION['success'] = 'We have sent a reset link to your email!';
    } else {
        $_SESSION['error'] = 'We could not send the reset link, unknown error occurred.';
    }

    header("Location: forgot-password.php");
    exit();
}
