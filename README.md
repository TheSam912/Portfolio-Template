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

### 2. One-time setup

Pick whichever fits your machine — both do the same thing:

| Option | Command | Works on |
|---|---|---|
| **Composer** (recommended) | `composer setup` | macOS · Linux · Windows |
| Plain shell — Mac / Linux | `./start.sh` (after editing `.env` and seeding manually) | macOS · Linux |
| Plain shell — Windows | `start.bat` | Windows |

`composer setup` does three things in order: copies `.env.example` → `.env`, applies `db/schema.sql`, and seeds sample data. It is **idempotent** — safe to re-run after a `git pull`.

> Edit `.env` afterwards if your local MySQL credentials differ from the defaults.

### 3. Run the dev server

```bash
composer dev
```

…or, without Composer:

```bash
./start.sh        # mac / linux
start.bat         # windows
```

Open [http://localhost:8000](http://localhost:8000).

### 4. Hidden admin panel (manage all content)

After `composer setup`, open:

```
http://localhost:8000/<ADMIN_PATH>
```

Default path is in `.env`:

```
ADMIN_PATH=samadminpanel
```

**Change `ADMIN_PATH` to a long random string only you know** — this is your secret URL. Nobody can guess it unless they read your `.env`.

Default login (change immediately):

| Field | Value |
|---|---|
| Username | `admin` |
| Password | `changeme123` |

From the admin panel you can edit:

- All site text (hero, about, contact, footer, SEO…)
- Images & resume (upload or paste paths)
- Stats, services, skills (with logos), experience, projects
- Read/delete contact form messages
- Change your admin password

### Available commands

| Command | What it does |
|---|---|
| `composer dev` | Start the local PHP server on `:8000` (alias: `composer start`) |
| `composer setup` | First-time setup — creates `.env` and builds & seeds the DB |
| `composer db:schema` | Apply `db/schema.sql` |
| `composer db:seed` | Apply `db/seed.sql` |
| `composer db:reset` | schema + seed |
| `composer db:fresh` | **DROP** the database, then schema + seed (destructive) |

### Optional: shorter terminal command

If you want an even shorter one-liner from anywhere on your machine, add a personal alias.

**macOS / Linux** — append to `~/.zshrc` or `~/.bashrc`:

```bash
alias pf='cd ~/Desktop/development/theSam_Portfolio/Portfolio-Template && composer dev'
```

Then just run `pf` from any terminal.

**Windows (PowerShell)** — add to your `$PROFILE`:

```powershell
function pf { Set-Location 'C:\path\to\Portfolio-Template'; composer dev }
```

## Project structure

```
.
├── admin/                  # Hidden CMS (routed via ADMIN_PATH in .env)
├── api/
│   └── contact.php         # Saves contact form to DB + forwards to web3forms
├── assets/
│   ├── css/                # style.css, responsive.css, animations.css, admin.css
│   ├── uploads/            # Files uploaded via admin panel
│   ├── files/              # Resume PDF (default)
│   ├── images/             # Hero, portfolio, skills icons, etc.
│   └── js/main.js
├── components/             # PHP includes (one per page section)
├── config/
│   ├── content.php         # Loads all content from DB
│   ├── repository.php      # ContentRepository class
│   ├── database.php
│   ├── env.php
│   └── helpers.php
├── db/
│   ├── schema.sql
│   └── seed.sql
├── router.php              # Dev-server router (site + hidden admin)
└── index.php
```

## Editing content

**Everything is dynamic.** Use the hidden admin panel — no PHP files to edit for day-to-day changes.

- **Text & media paths**: Admin → Site Settings
- **Stats / Services / Skills / Experience / Projects**: dedicated admin pages with add/edit/delete
- **Contact submissions**: Admin → Messages
- **Fallback**: if the DB is empty, the site shows minimal fallback content instead of crashing

## Database schema

See `db/schema.sql`. Main tables:

- `settings` — all text labels, contact details, image paths
- `stats`, `services`, `skills`, `experiences`, `experience_bullets`
- `projects`, `messages`, `admin_users`

Both `schema.sql` and `seed.sql` are **idempotent** — safe to re-run.

## Working together

1. Pull `main`, copy `.env.example` → `.env`, fill in your local creds.
2. Re-run `composer db:reset` after every pull that changes `db/schema.sql` or `db/seed.sql`.
3. **Never** commit `.env`, secrets, or anything from `vendor/` — see `.gitignore`.
4. Both of you should use **different `ADMIN_PATH` values locally** if you want — but agree on one for production.
5. Schema changes go in `db/schema.sql`.

## Deployment notes

- `APP_DEBUG=0` and `APP_ENV=prod` in production — hides DB error details.
- Filesystems on Linux servers are case-sensitive. Image paths are all lowercase to match.
- `assets/js/main.js` is loaded with `defer` — no flash, no blocking parse.
