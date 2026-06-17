<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/env.php';

$adminPath = trim((string) env('ADMIN_PATH', 'samadminpanel'), '/');

echo "\n";
echo "  Portfolio site  →  http://localhost:8000\n";
echo "  Admin panel     →  http://localhost:8000/{$adminPath}\n";
echo "  Press Ctrl+C to stop.\n\n";
