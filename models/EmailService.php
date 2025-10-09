<?php
// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailService
{
    private $mailer;
    private $email;
    private $from_name;

    public function __construct()
    {
        // Load environment variables
        $this->loadEnv();

        $this->email = getenv('SMTP_EMAIL');
        $this->from_name = getenv('APP_NAME');

        $this->mailer = new PHPMailer(true);

        $this->mailer->isSMTP();
        $this->mailer->Host = getenv('SMTP_HOST');
        $this->mailer->Port = getenv('SMTP_PORT');
        $this->mailer->SMTPAuth = true;
        $this->mailer->SMTPSecure = 'tls';

        $this->mailer->Username = $this->email;
        $this->mailer->Password = getenv('SMTP_PASSWORD');
    }

    private function loadEnv()
    {
        $envPath = dirname(__DIR__) . '/.env';


        if (!file_exists($envPath)) {
            throw new Exception(".env file not found at $envPath");
        }

        $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue; // skip comments
            }
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value, " \t\n\r\0\x0B\"'");
            putenv("$key=$value");
        }
    }

    public function sendHtmlEmail(string $to_email, string $subject, string $body): bool
    {
        $this->mailer->setFrom($this->email, $this->from_name);
        $this->mailer->addAddress($to_email);

        $this->mailer->isHTML(true);
        $this->mailer->Subject = $subject;
        $this->mailer->Body = $body;

        try {
            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
