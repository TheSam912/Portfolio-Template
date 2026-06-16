-- =====================================================
-- Portfolio DB schema
-- Idempotent: safe to re-run any time.
-- Apply with:  composer db:schema   OR   mysql -u root < db/schema.sql
-- =====================================================

CREATE DATABASE IF NOT EXISTS portfolio_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE portfolio_db;

-- ---- Site settings (text + media paths) --------------
CREATE TABLE IF NOT EXISTS settings (
    setting_key   VARCHAR(100)  NOT NULL PRIMARY KEY,
    setting_value TEXT          NULL,
    setting_group VARCHAR(50)   NOT NULL DEFAULT 'general',
    updated_at    TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_settings_group (setting_group)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---- Stats counters ----------------------------------
CREATE TABLE IF NOT EXISTS stats (
    id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    icon_class    VARCHAR(100)  NOT NULL DEFAULT 'fa-solid fa-star',
    count_value   VARCHAR(20)   NOT NULL,
    label_text    VARCHAR(255)  NOT NULL,
    sort_order    INT           NOT NULL DEFAULT 0,
    is_published  TINYINT(1)    NOT NULL DEFAULT 1,
    INDEX idx_stats_published_sort (is_published, sort_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---- Services ----------------------------------------
CREATE TABLE IF NOT EXISTS services (
    id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title         VARCHAR(255)  NOT NULL,
    description   TEXT          NOT NULL,
    icon_class    VARCHAR(100)  NOT NULL DEFAULT 'fa-solid fa-code',
    sort_order    INT           NOT NULL DEFAULT 0,
    is_published  TINYINT(1)    NOT NULL DEFAULT 1,
    INDEX idx_services_published_sort (is_published, sort_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---- Skills (name + logo path) -----------------------
CREATE TABLE IF NOT EXISTS skills (
    id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name          VARCHAR(100)  NOT NULL,
    icon_path     VARCHAR(512)  NOT NULL,
    sort_order    INT           NOT NULL DEFAULT 0,
    is_published  TINYINT(1)    NOT NULL DEFAULT 1,
    INDEX idx_skills_published_sort (is_published, sort_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---- Work experience ---------------------------------
CREATE TABLE IF NOT EXISTS experiences (
    id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    date_range    VARCHAR(100)  NOT NULL,
    position      VARCHAR(255)  NOT NULL,
    company       VARCHAR(255)  NOT NULL,
    sort_order    INT           NOT NULL DEFAULT 0,
    is_published  TINYINT(1)    NOT NULL DEFAULT 1,
    INDEX idx_experiences_published_sort (is_published, sort_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS experience_bullets (
    id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    experience_id   INT UNSIGNED  NOT NULL,
    content         TEXT          NOT NULL,
    sort_order      INT           NOT NULL DEFAULT 0,
    CONSTRAINT fk_bullets_experience
        FOREIGN KEY (experience_id) REFERENCES experiences(id)
        ON DELETE CASCADE,
    INDEX idx_bullets_experience_sort (experience_id, sort_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---- Portfolio projects ------------------------------
CREATE TABLE IF NOT EXISTS projects (
    id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title         VARCHAR(255)  NOT NULL,
    slug          VARCHAR(255)  NOT NULL,
    description   TEXT          NULL,
    image_path    VARCHAR(512)  NOT NULL,
    project_url   VARCHAR(512)  NULL,
    sort_order    INT           NOT NULL DEFAULT 0,
    is_published  TINYINT(1)    NOT NULL DEFAULT 1,
    created_at    TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at    TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uniq_projects_slug (slug),
    INDEX idx_projects_published_sort (is_published, sort_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---- Contact form submissions ------------------------
CREATE TABLE IF NOT EXISTS messages (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(255)  NOT NULL,
    email       VARCHAR(255)  NOT NULL,
    message     TEXT          NOT NULL,
    ip_address  VARCHAR(45)   NULL,
    user_agent  VARCHAR(512)  NULL,
    created_at  TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_messages_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---- Admin users -------------------------------------
CREATE TABLE IF NOT EXISTS admin_users (
    id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username      VARCHAR(100)  NOT NULL,
    password_hash VARCHAR(255)  NOT NULL,
    created_at    TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uniq_admin_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
