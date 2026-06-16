# Sam Nolan — Portfolio Template

Personal portfolio site built with vanilla PHP + MySQL.

## Stack

- PHP 8.1+ (vanilla, no framework)
- MySQL 8.0+ / MariaDB 10.6+
- Plain CSS + JS — no build step

## One-time setup

### 1. Clone & install prerequisites

```bash
git clone https://github.com/ElaheMl/Portfolio-Template.git
cd Portfolio-Template
```

Make sure you have:
- `php --version` ≥ 8.1 (Laravel Herd or Homebrew works)
- `mysql --version` ≥ 8.0

> **macOS gotcha:** if you previously installed MySQL via the official DMG installer **and** Homebrew, both daemons fight over `/tmp/mysql.sock`. Stop the old DMG one:
> ```bash
> sudo launchctl bootout system /Library/LaunchDaemons/com.oracle.oss.mysql.mysqld.plist
> sudo pkill -9 -f /usr/local/mysql/bin/mysqld
> brew services restart mysql
> ```

### 2. Configure environment

```bash
cp .env.example .env
# Edit .env with your local DB credentials.
```

### 3. Create the database

```bash
mysql -u root < db/schema.sql
mysql -u root < db/seed.sql      # optional: sample data
```

### 4. Run the dev server

```bash
php -S localhost:8000
```

Open [http://localhost:8000](http://localhost:8000).

## Project structure

```
.
├── api/                    # Backend endpoints (POST handlers)
│   └── contact.php         # Saves contact form to DB + forwards to web3forms
├── assets/
│   ├── css/                # style.css, responsive.css
│   ├── files/              # Resume PDF
│   ├── images/             # Hero, portfolio, skills icons, etc.
│   └── js/main.js          # Front-end behavior (mobile menu, modal, form)
├── components/             # PHP includes (one per page section)
├── config/
│   ├── content.php         # All static text content
│   ├── database.php        # PDO connection (reads from .env)
│   ├── env.php             # Tiny .env loader
│   └── helpers.php         # `e()` for HTML escaping, etc.
├── db/
│   ├── schema.sql          # Database structure (idempotent)
│   └── seed.sql            # Sample portfolio rows
└── index.php               # Entry point
```

## Editing content

- **Text**: `config/content.php` — every string the site displays.
- **Portfolio projects**: rows in the `projects` table (managed via SQL or a future admin UI). If the table is empty, the site falls back to the 6 hardcoded webp images so it never looks broken.
- **Images**: drop into `assets/images/` and reference from the relevant component.

## Database schema

See `db/schema.sql`. Two tables:

- `messages` — contact-form submissions.
- `projects` — portfolio entries (title, description, image, optional URL, sort order, published flag).

Both `schema.sql` and `seed.sql` are **idempotent** — safe to re-run.

## Working together

1. Pull `main`, copy `.env.example` → `.env`, fill in your local creds.
2. Re-run `mysql -u root < db/schema.sql` after every pull (it's idempotent).
3. **Never** commit `.env`, secrets, or anything from `vendor/` — see `.gitignore`.
4. Schema changes go in `db/schema.sql` (and a follow-up `db/migrations/NNN-*.sql` if we ever need versioned migrations).

## Deployment notes

- `APP_DEBUG=0` and `APP_ENV=prod` in production — hides DB error details.
- Filesystems on Linux servers are case-sensitive. Image paths are all lowercase to match.
- `assets/js/main.js` is loaded with `defer` — no flash, no blocking parse.
