-- =====================================================
-- Seed data — idempotent (safe to re-run).
-- Apply with:  composer db:reset
-- =====================================================

USE portfolio_db;

-- ---- Profile (only editable text/contact fields) ----
INSERT INTO settings (setting_key, setting_value, setting_group) VALUES
('short_summary', 'Software & Website Developer and SEO & GEO Specialist with 8+ years shipping high-performance web and mobile products.', 'profile'),
('about_summary', 'I''m Sobhan (Sam), a Software & Website Developer with 8+ years of experience turning product requirements into responsive, high-performance web and mobile applications (Flutter, Laravel, Vue.js, Node.js). I have a track record of shipping production platforms that lifted engagement and revenue by up to 45% and cut delivery time through reusable, well-architected components.\n\nI also bring hands-on SEO and GEO (Generative Engine Optimization), ensuring products are not only well-built but discoverable — in traditional search and in AI-driven answer engines. Backed by a Master''s in Cybersecurity and a consistent record of delivering in fast-moving agile teams.', 'profile'),
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
(2,  'Laravel',    'assets/images/skills/laravel.png',    20),
(3,  'Vue.js',     'assets/images/skills/vue.png',        30),
(4,  'PHP',        'assets/images/skills/php.png',        40),
(5,  'Node.js',    'assets/images/skills/nodejs.png',     50),
(6,  'JavaScript', 'assets/images/skills/js.png',         60),
(7,  'MySQL',      'assets/images/skills/mysql.png',      70),
(8,  'MongoDB',    'assets/images/skills/mongodb.png',    80),
(9,  'Docker',     'assets/images/skills/docker.png',     90),
(10, 'AWS',        'assets/images/skills/aws.png',       100),
(11, 'Git',        'assets/images/skills/git.png',       110),
(12, 'Figma',      'assets/images/skills/figma.png',     120),
(13, 'HTML',       'assets/images/skills/html.png',      130),
(14, 'CSS',        'assets/images/skills/css.png',       140),
(15, 'Java',       'assets/images/skills/java.png',      150),
(16, 'Swift',      'assets/images/skills/swift.png',     160),
(17, 'WordPress',  'assets/images/skills/wordpress.png',170),
(18, 'Bootstrap',  'assets/images/skills/bootstrap.png', 180);

-- ---- Experiences + bullets ---------------------------
DELETE FROM experience_bullets;
DELETE FROM experiences;

INSERT INTO experiences (id, date_range, position, company, sort_order) VALUES
(1, 'Sep 2026 — Present', 'Mobile Application Developer (Android & iOS)', 'Fanavaran', 10),
(2, 'Apr 2026 — Present', 'Freelance Software & Website Developer', 'Self-Employed', 20),
(3, 'Oct 2025 — Apr 2026', 'PHP Laravel & Vue.js Developer', 'Corefinity (Destinology)', 30),
(4, 'Jan 2025 — Mar 2025', 'Fullstack Developer', 'WooCom Ecommerce (Startup)', 40),
(5, 'Sep 2023 — Mar 2024', 'Flutter Application Developer', 'NIU Nature (Healthcare App)', 50),
(6, 'Oct 2018 — Oct 2019', 'Flutter Application Developer', 'IRIC', 60),
(7, 'Oct 2018 — Oct 2019', 'Android Application Developer', 'Dade Gostar GHOMES', 70),
(8, 'Oct 2016 — Oct 2017', 'Android Application Developer', 'Graph', 80);

INSERT INTO experience_bullets (experience_id, content, sort_order) VALUES
(1, 'Rebuilding the company''s Android and iOS app from the ground up with React Native, collaborating with the IT team to improve the existing product.', 10),
(1, 'Developed a dedicated CLI to manage the application project and support development workflows.', 20),
(1, 'Published the Android app on Google Play and submitted the iOS app to the App Store (currently under review).', 30),
(1, 'Contribute to website and backend development alongside primary mobile application responsibilities.', 40),
(2, 'Delivering project-based Laravel, Vue.js, and Flutter development for international clients on a contract basis.', 10),
(2, 'Founded and currently operate personal business ventures, applying full-stack development and SEO/GEO strategy to build and grow them from the ground up.', 20),
(3, 'Engineered core booking flows — destination discovery, search/filtering, flights, accommodation and extras — for a large-scale holiday platform used by thousands of travellers.', 10),
(3, 'Raised UX consistency across devices by building a library of reusable Vue.js components, cutting future feature build-time for the team.', 20),
(3, 'Kept production stable while shipping new features weekly, integrating backend APIs and database logic in Laravel within a fast-moving agile workflow.', 30),
(4, 'Took a startup from Figma concept to a live, fully responsive e-commerce site and app across web, mobile and tablet in under three months.', 10),
(4, 'Built a custom Firebase-powered admin panel with secure auth and Firestore-backed order/customer data for real-time business control.', 20),
(5, 'Delivered a healthcare app built around daily programs from German physicians, lifting user engagement by 30% through Apple/Google authentication and in-app purchase integration.', 10),
(5, 'Designed and shipped a health-monitoring dashboard that drove a 45% surge in engagement and a 20% revenue boost within the first six months.', 20),
(6, 'Redesigned the UX of a smart-home kit app based on user testing, growing positive reviews by 35% and daily active users by 60%.', 10),
(6, 'Cut support tickets by 20% by pairing gamification and social-sharing features with a structured user-training program.', 20),
(7, 'Led a multidisciplinary team building a telemedicine platform that reduced patient no-shows by 20% and lifted satisfaction scores by 15%.', 10),
(7, 'Extended the platform across four verticals: hospital management, e-commerce, drug store, and blood-donation coordination.', 20),
(8, 'Took ownership of an e-commerce app build end-to-end and modernized a legacy Basic4Android system still in daily use.', 10),
(8, 'Mentored two junior developers in Android programming while designing the UI for a new card-management product.', 20);

-- ---- Projects ----------------------------------------
DELETE FROM projects;

INSERT INTO projects (id, title, slug, description, image_path, project_url, sort_order) VALUES
(80, 'Wealthio', 'wealthio', 'Founder-built Progressive Web App with Next.js frontend and PHP/Laravel backend — product ownership from UI/UX design to backend implementation.', 'assets/images/portfolio/project-wealthio.webp', 'https://wealthio.ir', 5),
(6, 'Destinology', 'destinology', 'Large-scale holiday booking platform (Laravel, Vue.js) with dynamic destination search, filtering, and package selection — built with the Corefinity team.', 'assets/images/portfolio/project-6.webp', 'https://destinology.co.uk', 10),
(2, 'NIU Nature', 'niu-nature', 'Production healthcare app with backend-integrated dynamic content, shipped and maintained for a live App Store audience.', 'assets/images/portfolio/project-2.webp', NULL, 20),
(1, 'WooCom E-Commerce', 'woocom', 'Fully responsive e-commerce app for web, tablet and mobile, with a Firebase backend for auth, product management and orders.', 'assets/images/portfolio/project-1.webp', NULL, 30),
(3, 'TimeSync Healthcare AI', 'timesync', 'OpenAI-powered Flutter app delivering personalized health plans, backed by a Node.js/MongoDB service with Firebase real-time notifications.', 'assets/images/portfolio/project-3.webp', NULL, 40),
(4, 'IRIC Smart Home', 'iric-smart-home', 'Smart home control dashboard for rooms, devices, live camera, and climate — designed for tablet.', 'assets/images/portfolio/project-4.webp', NULL, 50),
(5, 'Recipe Finder', 'recipe-finder', 'Recipe discovery app with smart search, trending dishes, and an easy cook-friendly browsing experience.', 'assets/images/portfolio/project-5.webp', NULL, 60);

-- ---- Admin user (password: changeme123) --------------
INSERT INTO admin_users (username, password_hash) VALUES
('admin', '$2y$12$KdmmC6uhEStJA96QkNSZQe2gOz4yVjotsU67CBbNnIt68O6Rw7fnq')
ON DUPLICATE KEY UPDATE username = username;
