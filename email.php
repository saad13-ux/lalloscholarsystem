<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer autoload
require __DIR__ . '/vendor/autoload.php';

/**
 * Function to send an email via PHPMailer
 *
 * @param string $to Recipient email address
 * @param string $toName Recipient name
 * @param string $subject Email subject
 * @param string $bodyHtml HTML content of the email
 * @param string|null $bodyAlt Optional plain text version
 * @return bool True if sent successfully, false otherwise
 */
function sendEmail($to, $toName, $subject, $bodyHtml, $bodyAlt = null) {
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';                 // Set the SMTP server
        $mail->SMTPAuth   = true;                             // Enable SMTP authentication
        $mail->Username   = 'insess013@gmail.com';           // SMTP username
        $mail->Password   = 'huzc rsqh eugb tkmb';           // SMTP password (App Password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption
        $mail->Port       = 587;                             // TCP port for TLS

        //Recipients
        $mail->setFrom('insess013@gmail.com', 'LGU Lal-lo Scholarship System');
        $mail->addAddress($to, $toName);

        //Content
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

// Example usage
$sent = sendEmail(
    'jdz.ugc13@gmail.com', 
    'John Doe', 
    'Test Email via PHPMailer', 
    '<h1>Hello World</h1><p>This is a test email sent using PHPMailer with TLS on port 587.</p>'
);

if ($sent) {
    echo "Email sent successfully!";
} else {
    echo "Failed to send email.";
}
