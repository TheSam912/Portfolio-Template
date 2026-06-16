<?php

/**
 * First-time setup: ensure a usable .env exists.
 * Called by `composer setup` before db:reset.
 */

declare(strict_types=1);

$root        = dirname(__DIR__);
$envFile     = "{$root}/.env";
$envExample  = "{$root}/.env.example";

if (!is_file($envExample)) {
    fwrite(STDERR, "  ✗ Missing .env.example — your repo is incomplete.\n");
    exit(1);
}

if (is_file($envFile)) {
    echo "  · .env already exists — leaving it untouched.\n";
} else {
    copy($envExample, $envFile);
    echo "  ✓ Created .env from .env.example.\n";
    echo "    Edit it now if your local DB credentials differ from the defaults.\n";
}
