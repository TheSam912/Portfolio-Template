-- =====================================================
-- Seed data — idempotent (safe to re-run).
-- Apply with:  composer db:reset
-- =====================================================

USE portfolio_db;

-- ---- Profile (only editable text/contact fields) ----
INSERT INTO settings (setting_key, setting_value, setting_group) VALUES
('short_summary', 'Full Stack Developer focused on building exceptional digital experiences with clean code and modern technologies.', 'profile'),
('about_summary', 'I''m Sobhan (Sam), Motivated and experienced website and mobile app developer with expertise in Flutter, Android (Java), Laravel, and Vue.JS. Skilled in backend development, RESTful APIs (Node.js / PHP), and database management (SQL & NoSQL). I specialize in creating responsive, high-performance applications, boosting project efficiency by 25% at the initial stage.\n\nPassionate about problem-solving, innovation, and continuous learning. I thrive in team environments, collaborating toward shared goals while constantly expanding my technical expertise.', 'profile'),
('resume_file', 'assets/files/Sobhan-Resume.pdf', 'profile'),
('contact_email', 'The.Sam.Nolan1998@gmail.com', 'profile'),
('contact_linkedin', 'https://linkedin.com/in/sam912', 'profile'),
('contact_linkedin_text', 'Linkedin.com/in/sam912', 'profile'),
('contact_github', 'https://github.com/TheSam912', 'profile'),
('contact_github_text', 'Github.com/TheSam912', 'profile'),
('contact_location', 'Remote / Worldwide', 'profile')
ON DUPLICATE KEY UPDATE
    setting_value = VALUES(setting_value),
    setting_group = VALUES(setting_group);

-- ---- Skills ------------------------------------------
DELETE FROM skills WHERE id BETWEEN 1 AND 18;
INSERT INTO skills (id, name, icon_path, sort_order) VALUES
(1,  'Flutter',    'assets/images/skills/flutter.png',    10),
(2,  'PHP',        'assets/images/skills/php.png',        20),
(3,  'Laravel',    'assets/images/skills/laravel.png',    30),
(4,  'JavaScript', 'assets/images/skills/js.png',         40),
(5,  'HTML',       'assets/images/skills/html.png',       50),
(6,  'CSS',        'assets/images/skills/css.png',        60),
(7,  'Vue.js',     'assets/images/skills/vue.png',        70),
(8,  'Figma',      'assets/images/skills/figma.png',      80),
(9,  'Java',       'assets/images/skills/java.png',       90),
(10, 'MySQL',      'assets/images/skills/mysql.png',     100),
(11, 'MongoDB',    'assets/images/skills/mongodb.png',   110),
(12, 'Swift',      'assets/images/skills/swift.png',     120),
(13, 'WordPress',  'assets/images/skills/wordpress.png',130),
(14, 'Git',        'assets/images/skills/git.png',       140),
(15, 'Docker',     'assets/images/skills/docker.png',    150),
(16, 'Node.js',    'assets/images/skills/nodejs.png',    160),
(17, 'AWS',        'assets/images/skills/aws.png',       170),
(18, 'Bootstrap',  'assets/images/skills/bootstrap.png', 180);

-- ---- Experiences + bullets ---------------------------
DELETE FROM experience_bullets;
DELETE FROM experiences;

INSERT INTO experiences (id, date_range, position, company, sort_order) VALUES
(1, 'Oct 2025 — Apr 2026', 'PHP Laravel & Vue.js Developer', 'Corefinity (Destinology)', 10),
(2, 'Jan 2025 — Mar 2025', 'Fullstack Developer', 'WooCom Ecommerce (Startup)', 20),
(3, 'Sep 2023 — Mar 2024', 'Flutter Application Developer', 'NIU Nature Application', 30),
(4, 'Oct 2018 — Oct 2019', 'Flutter Application Developer', 'IRIC', 40),
(5, 'Oct 2018 — Oct 2019', 'Android Application Developer', 'Dade Gostar GHOMES', 50),
(6, 'Oct 2016 — Oct 2017', 'Android Application Developer', 'Graph', 60);

INSERT INTO experience_bullets (experience_id, content, sort_order) VALUES
(1, 'Developed and maintained a holiday search and booking platform using Laravel and Vue.js.', 10),
(1, 'Built core flows for destination discovery, search/filtering, and selecting flights, accommodation, and holiday extras.', 20),
(1, 'Implemented responsive, reusable UI components in Vue.js to improve UX across desktop and mobile.', 30),
(1, 'Integrated backend APIs and database logic in Laravel to support dynamic content and booking-related data.', 40),
(1, 'Collaborated with the Corefinity team in an agile workflow, delivering features, bug fixes, and production support.', 50),
(2, 'Built a responsive e-commerce website and mobile app for a startup.', 10),
(2, 'Converted Figma designs into a cross-platform experience (web/mobile/tablet) with adaptive layouts.', 20),
(2, 'Developed a custom Firebase-powered admin panel for real-time data management.', 30),
(2, 'Implemented Firebase Auth and Firestore for secure login and order/customer data storage.', 40),
(2, 'Delivered a dynamic, device-optimized UI for a smooth user experience.', 50),
(3, 'Collaborated with a team to launch a healthcare app offering daily programs from esteemed German physicians.', 10),
(3, 'Developed daily schedules with top German doctors, optimizing patient treatment plans and contributing to a 30% rise in positive patient feedback.', 20),
(3, 'Rolled out a health monitoring dashboard, driving a 45% surge in user engagement and a 20% boost in app revenue in the first half-year.', 30),
(3, 'Integrated Apple & Google authentication and in-app purchases, increasing user engagement by 30%.', 40),
(3, 'Introduced in-app purchase options for iOS and Android, contributing to a 35% growth in digital sales revenue.', 50),
(4, 'Enhanced the smart home kit app UX through iterative design improvements and user testing, achieving a 35% increase in positive reviews and 60% rise in daily active users.', 10),
(4, 'Rolled out user-focused enhancements including gamification and social sharing, resulting in a 15% increase in daily active users over six months.', 20),
(4, 'Executed a robust user training program, decreasing support tickets by 20% and enhancing platform satisfaction by 35%.', 30),
(5, 'Directed a multidisciplinary team in creating a telemedicine platform, reducing patient no-show rates by 20% and increasing satisfaction scores by 15%.', 10),
(5, 'Led hospital management app design and development.', 20),
(5, 'Delivered e-commerce solutions for healthcare clients.', 30),
(5, 'Built drug store and blood donation center applications.', 40),
(6, 'Mentored two colleagues in Android programming while enhancing company management systems.', 10),
(6, 'Led development of an e-commerce app and updated a legacy Basic4Android application.', 20),
(6, 'Designed UI for a card management app without backend support.', 30);

-- ---- Projects ----------------------------------------
INSERT IGNORE INTO projects (title, slug, description, image_path, project_url, sort_order) VALUES
('Holiday Booking Platform', 'project-1', 'A holiday search & booking platform built with Laravel and Vue.js.', 'assets/images/portfolio/project-1.webp', NULL, 10),
('E-commerce Storefront', 'project-2', 'Responsive e-commerce platform across web, mobile and tablet.', 'assets/images/portfolio/project-2.webp', NULL, 20),
('Admin Dashboard', 'project-3', 'Firebase-powered admin panel with Auth and Firestore integration.', 'assets/images/portfolio/project-3.webp', NULL, 30),
('Mobile App UI', 'project-4', 'Cross-platform Flutter app — iOS & Android.', 'assets/images/portfolio/project-4.webp', NULL, 40),
('Native Android App', 'project-5', 'Feature-rich native Android app written in Java.', 'assets/images/portfolio/project-5.webp', NULL, 50),
('Backend API', 'project-6', 'Secure RESTful API with managed SQL & NoSQL stores.', 'assets/images/portfolio/project-6.webp', NULL, 60);

-- ---- Admin user (password: changeme123) --------------
INSERT INTO admin_users (username, password_hash) VALUES
('admin', '$2y$12$KdmmC6uhEStJA96QkNSZQe2gOz4yVjotsU67CBbNnIt68O6Rw7fnq')
ON DUPLICATE KEY UPDATE username = username;
