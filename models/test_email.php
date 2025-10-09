<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/EmailService.php';

$service = new EmailService();

try {
    $service->sendHtmlEmail(
        "jodienrile@example.com", 
        "Test Email from LGU ALLO SCHOLARSHIP SYSTEM", 
        "<h1>Hello!</h1><p>This is a test email.</p>"
    );
    echo "Email sent successfully!";
} catch (Exception $e) {
    echo "Failed to send email. Error: " . $e->getMessage();
}
