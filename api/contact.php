<?php

/**
 * Contact form handler.
 *  1. Validate input
 *  2. Save to `messages` table
 *  3. (Optional) forward to web3forms for email delivery
 *  4. Reply with JSON { success: bool, message?: string }
 */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['success' => false, 'message' => 'Method not allowed.'], 405);
}

// Honeypot — bots typically fill every field. Real users never see this one.
if (!empty($_POST['_hp'] ?? '')) {
    // Pretend success so spammers don't retry.
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

// ---- Optional: forward to web3forms for email notification ----
$web3formsKey = env('WEB3FORMS_ACCESS_KEY', '');

if ($web3formsKey !== '' && function_exists('curl_init')) {

    $payload = json_encode([
        'access_key' => $web3formsKey,
        'subject'    => 'New portfolio contact: ' . $name,
        'name'       => $name,
        'email'      => $email,
        'message'    => $message,
    ], JSON_UNESCAPED_UNICODE);

    $ch = curl_init('https://api.web3forms.com/submit');

    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $payload,
        CURLOPT_HTTPHEADER     => [
            'Content-Type: application/json',
            'Accept: application/json',
        ],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 5,
        CURLOPT_CONNECTTIMEOUT => 3,
    ]);

    $response = curl_exec($ch);
    $errno    = curl_errno($ch);
    curl_close($ch);

    if ($errno !== 0) {
        // The DB save still succeeded — log and continue.
        error_log('[contact] web3forms forward failed: curl errno ' . $errno);
    }
}

json_response(['success' => true]);
