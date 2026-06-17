<?php

/**
 * Tiny zero-dependency .env loader.
 * Populates $_ENV / $_SERVER / getenv(). Existing values are not overwritten,
 * so real environment variables (e.g. set in production) take precedence.
 */

if (!function_exists('load_env')) {

    function load_env(string $path): void
    {
        if (!is_readable($path)) {
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {

            $trimmed = trim($line);

            if ($trimmed === '' || str_starts_with($trimmed, '#')) {
                continue;
            }

            if (!str_contains($trimmed, '=')) {
                continue;
            }

            [$key, $value] = explode('=', $trimmed, 2);

            $key   = trim($key);
            $value = trim($value);

            // Strip optional surrounding quotes
            if (
                strlen($value) >= 2 &&
                ((str_starts_with($value, '"') && str_ends_with($value, '"')) ||
                 (str_starts_with($value, "'") && str_ends_with($value, "'")))
            ) {
                $value = substr($value, 1, -1);
            }

            // Strip inline comments after a value (only if not quoted)
            if (str_contains($value, '#')) {
                $value = trim(preg_replace('/\s+#.*$/', '', $value));
            }

            // .env is the source of truth when the file exists (overrides stale shell vars).
            $_ENV[$key]    = $value;
            $_SERVER[$key] = $value;
            putenv("$key=$value");
        }
    }
}

if (!function_exists('env')) {

    function env(string $key, $default = null)
    {
        if (array_key_exists($key, $_ENV)) {
            return $_ENV[$key];
        }

        $value = getenv($key);

        return $value === false ? $default : $value;
    }
}

load_env(__DIR__ . '/../.env');
