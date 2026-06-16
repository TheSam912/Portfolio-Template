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
