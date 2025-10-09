<?php
session_start();

require '../includes/pdo_conn.php';
require '../includes/user_query_set.php';
require '../includes/session_variables.php';
require '../includes/functions.php';

// Set the timezone to Philippines
date_default_timezone_set('Asia/Manila');

// Load Composer autoload for PHPMailer
require __DIR__ . '/../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// ===== PHPMailer function =====
function sendEmail($to, $toName, $subject, $bodyHtml, $bodyAlt = null) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'insess013@gmail.com';
        $mail->Password   = 'huzc rsqh eugb tkmb';  // App Password
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

// ===== Handle login =====
if (isset($_POST['login_user'])) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $login_time = time() - 3600;

    $insert_query = "SELECT COUNT(*) AS total_count FROM ip_details WHERE ip=:ip AND login_time>:login_time";
    $query = $pdo->prepare($insert_query);
    $query->bindParam(':ip', $ip);
    $query->bindParam(':login_time', $login_time);
    $query->execute();
    $res = $query->fetch(PDO::FETCH_ASSOC);
    $count = $res['total_count'];
    $three= 3;

    if ($count == $three) {
        $_SESSION['error'] = "Your account has been blocked. Please try after 1 hour.";
        header('Location: ../login.php');
        exit();
    }

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Username and password are required.";
        header('Location: ../login.php');
        exit();
    }

    $params = ['username' => $username];
    $query = $pdo->prepare($login_user_query);
    $res = $query->execute($params);

    if ($res && $query->rowCount() == 1) {
        $account = $query->fetch(PDO::FETCH_ASSOC);

        if ($account['blocked'] == 0) {
            if (password_verify($password, $account['password'])) {

                // Clear IP attempts
                $pdo->prepare("DELETE FROM ip_details")->execute();

                // Set session
                // Set session
foreach ($account as $key => $value) {
    if ($key == 'password') continue;
    $_SESSION[$session_prefix . $key] = $value;
}

// Add a plain session for easier navbar checks
if (isset($_SESSION[$session_user_id])) {
    $_SESSION['user_id'] = $_SESSION[$session_user_id];
}

$_SESSION['success'] = "Successfully logged in as $username.";


                // ===== Email verification step =====
                if (!$_SESSION[$session_email_verified]) {
                    $r_code = generateRandomCode();

                    // Save verification code
                    $params = ['email_vcode' => $r_code, 'user_id' => $_SESSION[$session_user_id]];
                    $query = $pdo->prepare($set_user_email_vcode);
                    $res = $query->execute($params);
                    if (!($res && $query->rowCount() == 1)) {
                        $_SESSION['error'] = 'We could not complete your request.';
                        exit();
                    }

                    $_SESSION[$session_email_vcode] = $r_code;

                    // Prepare HTML email
                    $htmlBody = "
                    <html>
                    <body style='font-family: Helvetica, Arial, sans-serif; background-color:rgb(22, 110, 47); margin:0; padding:0;'>
                        <table style='width:100%;'>
                            <tr>
                                <td align='center'>
                                    <table style='max-width:600px; background:white; padding:20px; border-radius:10px;'>
                                        <tr>
                                            <td style='text-align:center;'>
                                                <h1>Verification Code</h1>
                                                <p>Please use the code below to verify your login:</p>
                                                <p style='font-size:130%; font-weight:bold;'>$r_code</p>
                                                <p>If you didn’t request this, you can ignore this email.</p>
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

                    $sent = sendEmail($_SESSION[$session_email], $username, 'Verify your login', $htmlBody);

                    if ($sent) {
                        header('Location: ../verification.php');
                        exit();
                    } else {
                        $_SESSION['error'] = "We could not send the verification email. Please try again later.";
                        header('Location: ../login.php');
                        exit();
                    }
                }

                // Redirect to dashboard if email already verified
                header("Location: ../dashboard.php");
                exit();

            } else {
                // Incorrect password
                $count++;
                $remaining_attempts = 3 - $count;

                if ($remaining_attempts == 0) {
                    $_SESSION['error'] = "Your account has been blocked. Please try after 1 hour.";
                } else {
                    $_SESSION['error'] = "Please enter valid details. $remaining_attempts attempts remaining";
                }

                $login_time = time();
                $insert_query = "INSERT INTO ip_details (ip, login_time) VALUES (:ip, :loginTime)";
                $query = $pdo->prepare($insert_query);
                $query->bindParam(':ip', $ip);
                $query->bindParam(':loginTime', $login_time);
                $query->execute();

                header('Location: ../login.php');
                exit();
            }

        } else {
            $_SESSION['error'] = 'Your account has been blocked. Please contact the administrator.';
            header('Location: ../login.php');
            exit();
        }

    } else {
        $_SESSION['error'] = 'No account found.';
        header('Location: ../login.php');
        exit();
    }
}
