<?php

/**
 * Contact form handler.
 *  1. Validate input
 *  2. Save to `messages` table
 *  3. Email the site owner (browser web3forms preferred; PHP mail() fallback)
 *  4. Reply with JSON { success: bool, message?: string }
 */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../config/mail.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['success' => false, 'message' => 'Method not allowed.'], 405);
}

// Honeypot — bots typically fill every field. Real users never see this one.
if (!empty($_POST['_hp'] ?? '')) {
    json_response(['success' => true]);
}

$name    = trim((string) ($_POST['name']    ?? ''));
$email   = trim((string) ($_POST['email']   ?? ''));
$message = trim((string) ($_POST['message'] ?? ''));

$errors = [];

if ($name === '' || mb_strlen($name) > 255) {
    $errors[] = 'Please enter your name.';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 255) {
    $errors[] = 'Please enter a valid email address.';
}

if ($message === '' || mb_strlen($message) > 5000) {
    $errors[] = 'Please enter a message (max 5000 characters).';
}

if (!empty($errors)) {
    json_response([
        'success' => false,
        'message' => implode(' ', $errors),
    ], 422);
}

try {

    $stmt = $pdo->prepare(
        "INSERT INTO messages (name, email, message, ip_address, user_agent)
         VALUES (?, ?, ?, ?, ?)"
    );

    $stmt->execute([
        $name,
        $email,
        $message,
        $_SERVER['REMOTE_ADDR']     ?? null,
        substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 512) ?: null,
    ]);

} catch (PDOException $e) {

    error_log('[contact] DB insert failed: ' . $e->getMessage());

    json_response([
        'success' => false,
        'message' => is_debug()
            ? 'DB error: ' . $e->getMessage()
            : 'Unable to save message. Please try again later.',
    ], 500);
}

// When web3forms is configured, email is delivered from the browser.
if (trim((string) env('WEB3FORMS_ACCESS_KEY', '')) === '') {
    if (!send_contact_notification($name, $email, $message)) {
        error_log('[contact] mail() failed for submission from ' . $email);

        json_response([
            'success' => false,
            'message' => 'Your message could not be sent. Please try again or email me directly.',
        ], 500);
    }
}

json_response(['success' => true]);
