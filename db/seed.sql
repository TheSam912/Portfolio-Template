-- =====================================================
-- Sample data. Idempotent (uses INSERT IGNORE on slug).
-- Apply with:  mysql -u root < db/seed.sql
-- =====================================================

USE portfolio_db;

INSERT IGNORE INTO projects
    (title, slug, description, image_path, project_url, sort_order)
VALUES
    ('Holiday Booking Platform', 'project-1',
     'A holiday search & booking platform built with Laravel and Vue.js.',
     'assets/images/portfolio/project-1.webp', NULL, 10),

    ('E-commerce Storefront', 'project-2',
     'Responsive e-commerce platform across web, mobile and tablet.',
     'assets/images/portfolio/project-2.webp', NULL, 20),

    ('Admin Dashboard', 'project-3',
     'Firebase-powered admin panel with Auth and Firestore integration.',
     'assets/images/portfolio/project-3.webp', NULL, 30),

    ('Mobile App UI', 'project-4',
     'Cross-platform Flutter app — iOS & Android.',
     'assets/images/portfolio/project-4.webp', NULL, 40),

    ('Native Android App', 'project-5',
     'Feature-rich native Android app written in Java.',
     'assets/images/portfolio/project-5.webp', NULL, 50),

    ('Backend API', 'project-6',
     'Secure RESTful API with managed SQL & NoSQL stores.',
     'assets/images/portfolio/project-6.webp', NULL, 60);
