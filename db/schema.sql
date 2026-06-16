-- =====================================================
-- Portfolio DB schema
-- Idempotent: safe to re-run any time.
-- Apply with:  mysql -u root < db/schema.sql
-- =====================================================

CREATE DATABASE IF NOT EXISTS portfolio_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE portfolio_db;

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
