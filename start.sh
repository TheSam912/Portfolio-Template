#!/usr/bin/env bash
# Zero-dependency starter (no Composer needed).
#   ./start.sh           - run dev server on http://localhost:8000
#   ./start.sh 9000      - run on a custom port

set -euo pipefail

cd "$(dirname "$0")"

PORT="${1:-8000}"

if [ ! -f .env ] && [ -f .env.example ]; then
    cp .env.example .env
    echo "  ✓ Created .env from .env.example. Edit it if your DB credentials differ."
fi

printf '\n  Portfolio site  →  http://localhost:%s\n  Admin panel     →  http://localhost:%s/%s\n  Press Ctrl+C to stop.\n\n' "$PORT" "$PORT" "${ADMIN_PATH:-samadminpanel}"

exec php -S "localhost:${PORT}" router.php
