<?php

/**
 * Send a contact-form notification to the site owner.
 */
function send_contact_notification(string $name, string $email, string $message): bool
{
    $to = trim((string) env('CONTACT_NOTIFY_EMAIL', 'The.Sam.Nolan1998@gmail.com'));

    if ($to === '' || !filter_var($to, FILTER_VALIDATE_EMAIL)) {
        error_log('[contact] CONTACT_NOTIFY_EMAIL is missing or invalid.');
        return false;
    }

    $host = preg_replace('/[^a-zA-Z0-9.-]/', '', (string) ($_SERVER['HTTP_HOST'] ?? 'localhost')) ?: 'localhost';
    $from = trim((string) env('MAIL_FROM', "portfolio@{$host}"));

    $subject = 'New portfolio message from ' . $name;
    $body    = "You received a new message from your portfolio contact form.\n\n"
             . "Name: {$name}\n"
             . "Email: {$email}\n\n"
             . "Message:\n{$message}\n";

    $headers = [
        'MIME-Version: 1.0',
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . $from,
        'Reply-To: ' . $email,
        'X-Mailer: PHP/' . PHP_VERSION,
    ];

    return mail($to, $subject, $body, implode("\r\n", $headers));
}
