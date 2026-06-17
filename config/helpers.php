<?php

/**
 * Tiny utility helpers.
 */

if (!function_exists('e')) {

    /**
     * HTML-escape a string for safe output inside HTML body / attributes.
     * Use everywhere you echo data that could become user-driven.
     */
    function e(?string $value): string
    {
        return htmlspecialchars($value ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}

if (!function_exists('json_response')) {

    /**
     * Send a JSON response and stop execution.
     */
    function json_response(array $payload, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }
}

if (!function_exists('is_debug')) {

    function is_debug(): bool
    {
        return (string) env('APP_DEBUG', '0') === '1';
    }
}

if (!function_exists('setting')) {

    /** Read a static key from config/static.php ($content). */
    function setting(string $key, string $default = ''): string
    {
        global $content;

        return (string) ($content[$key] ?? $default);
    }
}

if (!function_exists('profile')) {

    /** Read an editable profile field from the database ($profile). */
    function profile(string $key, string $default = ''): string
    {
        global $profile;

        return (string) ($profile[$key] ?? $default);
    }
}

if (!function_exists('admin_path')) {

    function admin_path(): string
    {
        return trim((string) env('ADMIN_PATH', 'samadminpanel'), '/');
    }
}

if (!function_exists('admin_url')) {

    function admin_url(string $subpath = ''): string
    {
        $base = '/' . admin_path();
        $subpath = trim($subpath, '/');

        return $subpath === '' ? $base : $base . '/' . $subpath;
    }
}

if (!function_exists('csrf_token')) {

    function csrf_token(): string
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (empty($_SESSION['_csrf'])) {
            $_SESSION['_csrf'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['_csrf'];
    }
}

if (!function_exists('csrf_verify')) {

    function csrf_verify(?string $token): bool
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        return is_string($token)
            && !empty($_SESSION['_csrf'])
            && hash_equals($_SESSION['_csrf'], $token);
    }
}

if (!function_exists('flash_set')) {

    function flash_set(string $type, string $message): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $_SESSION['_flash'] = ['type' => $type, 'message' => $message];
    }
}

if (!function_exists('flash_get')) {

    /** @return array{type:string,message:string}|null */
    function flash_get(): ?array
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (empty($_SESSION['_flash'])) {
            return null;
        }

        $flash = $_SESSION['_flash'];
        unset($_SESSION['_flash']);

        return $flash;
    }
}

if (!function_exists('slugify')) {

    function slugify(string $text): string
    {
        $text = strtolower(trim($text));
        $text = preg_replace('/[^a-z0-9]+/', '-', $text) ?? '';
        $text = trim($text, '-');

        return $text !== '' ? $text : 'item-' . bin2hex(random_bytes(4));
    }
}

if (!function_exists('handle_upload')) {

    /**
     * @param list<string> $allowed
     * @return array{ok:bool,path?:string,error?:string}
     */
    function handle_upload(string $field, string $subdir, array $allowed, int $maxBytes = 5_242_880): array
    {
        if (empty($_FILES[$field]['tmp_name']) || !is_uploaded_file($_FILES[$field]['tmp_name'])) {
            return ['ok' => false, 'error' => 'No file uploaded.'];
        }

        $file = $_FILES[$field];

        if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
            return ['ok' => false, 'error' => 'Upload failed.'];
        }

        if (($file['size'] ?? 0) > $maxBytes) {
            return ['ok' => false, 'error' => 'File is too large (max 5 MB).'];
        }

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime  = $finfo->file($file['tmp_name']) ?: '';

        if (!in_array($mime, $allowed, true)) {
            return ['ok' => false, 'error' => 'File type not allowed.'];
        }

        $extMap = [
            'image/jpeg'      => 'jpg',
            'image/png'       => 'png',
            'image/webp'      => 'webp',
            'image/gif'       => 'gif',
            'image/svg+xml'   => 'svg',
            'application/pdf' => 'pdf',
        ];

        $ext = $extMap[$mime] ?? 'bin';
        $dir = __DIR__ . '/../assets/uploads/' . trim($subdir, '/');

        if (!is_dir($dir) && !mkdir($dir, 0755, true)) {
            return ['ok' => false, 'error' => 'Could not create upload directory.'];
        }

        $filename = date('Ymd-His') . '-' . bin2hex(random_bytes(4)) . '.' . $ext;
        $dest     = $dir . '/' . $filename;

        if (!move_uploaded_file($file['tmp_name'], $dest)) {
            return ['ok' => false, 'error' => 'Could not save uploaded file.'];
        }

        return ['ok' => true, 'path' => 'assets/uploads/' . trim($subdir, '/') . '/' . $filename];
    }
}
