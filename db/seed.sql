-- =====================================================
-- Seed data — idempotent (safe to re-run).
-- Apply with:  composer db:reset
-- =====================================================

USE portfolio_db;

-- ---- Settings (all text + media paths) --------------
INSERT INTO settings (setting_key, setting_value, setting_group) VALUES
('site_title', 'Sam Nolan — Portfolio', 'seo'),
('meta_description', 'Full Stack Developer focused on building exceptional digital experiences with clean code and modern technologies.', 'seo'),

('hero_badge', 'Software Engineer', 'hero'),
('hero_title_line_1', 'Building Digital Products', 'hero'),
('hero_title_line_2', 'With Clean Code', 'hero'),
('hero_title_line_3', 'And Smart Solutions', 'hero'),
('hero_description', 'Full Stack Developer focused on building exceptional digital experiences with clean code and modern technologies.', 'hero'),
('hero_btn_primary', 'View My Work', 'hero'),
('hero_btn_secondary', 'Download CV', 'hero'),
('hero_image', 'assets/images/hero.webp', 'media'),

('stats_section_visible', '1', 'stats'),

('about_tag', 'ABOUT ME', 'about'),
('about_title_line_1', 'Passionate About Building', 'about'),
('about_title_line_2', 'Modern Digital Solutions', 'about'),
('about_title_line_3', 'With Precision.', 'about'),
('about_description', 'I''m Sobhan (Sam), Motivated and experienced website and mobile app developer with expertise in Flutter, Android (Java), Laravel, and Vue.JS. Skilled in backend development, RESTful APIs (Node.js / PHP), and database management (SQL & NoSQL). I specialize in creating responsive, high-performance applications, boosting project efficiency by 25% at the initial stage.\n\nPassionate about problem-solving, innovation, and continuous learning. I thrive in team environments, collaborating toward shared goals while constantly expanding my technical expertise.', 'about'),
('about_name_label', 'Name', 'about'),
('about_name_value', 'Sam Nolan', 'about'),
('about_email_label', 'Email', 'about'),
('about_email_value', 'The.Sam.Nolan1998@gmail.com', 'about'),
('about_degree_label', 'Degree', 'about'),
('about_degree_value', 'Master''s in Cybersecurity', 'about'),
('about_location_label', 'Location', 'about'),
('about_location_value', 'Available Worldwide', 'about'),
('about_availability_label', 'Availability', 'about'),
('about_availability_value', 'Available For Projects', 'about'),

('services_tag', 'WHAT I DO', 'services'),
('services_title_line_1', 'Turning ideas into powerful', 'services'),
('services_title_line_2', 'digital products.', 'services'),

('skills_tag', 'TECH STACK', 'skills'),
('skills_title_line_1', 'Technologies I Use To Build', 'skills'),
('skills_title_line_2', 'Modern Products.', 'skills'),

('experience_tag', 'EXPERIENCE', 'experience'),
('experience_title_line_1', 'Professional', 'experience'),
('experience_title_line_2', 'Journey.', 'experience'),

('portfolio_tag', 'PORTFOLIO', 'portfolio'),
('portfolio_title_line_1', 'Selected', 'portfolio'),
('portfolio_title_line_2', 'Projects.', 'portfolio'),

('contact_tag', 'LET''S WORK TOGETHER', 'contact'),
('contact_title_line_1', 'Have a project in mind?', 'contact'),
('contact_title_line_2', 'Let''s build it together.', 'contact'),
('contact_name_placeholder', 'Your Name', 'contact'),
('contact_email_placeholder', 'Your Email', 'contact'),
('contact_message_placeholder', 'Tell me about your project...', 'contact'),
('contact_button', 'Send Message', 'contact'),
('contact_info_tag', 'CONTACT INFO', 'contact'),
('contact_email', 'The.Sam.Nolan1998@gmail.com', 'contact'),
('contact_linkedin', 'https://linkedin.com/in/sam912', 'contact'),
('contact_linkedin_text', 'Linkedin.com/in/sam912', 'contact'),
('contact_github', 'https://github.com/TheSam912', 'contact'),
('contact_github_text', 'Github.com/TheSam912', 'contact'),
('contact_location', 'Remote / Worldwide', 'contact'),

('footer_copyright', '© 2025 Sam Nolan. All rights reserved.', 'footer'),
('footer_github', 'https://github.com/TheSam912', 'footer'),
('footer_linkedin', 'https://linkedin.com/in/sam912', 'footer'),
('footer_email', 'The.Sam.Nolan1998@gmail.com', 'footer'),

('navbar_cta_text', 'Get In Touch', 'navbar'),
('text_logo_image', 'assets/images/textlogo.png', 'media'),
('logo_image', 'assets/images/logo.png', 'media'),
('banner_image', 'assets/images/banner3.webp', 'media'),
('footer_wave_image', 'assets/images/footer-wave.webp', 'media'),
('resume_file', 'assets/files/Sobhan-Resume.pdf', 'media'),

('modal_success_title', 'Message Sent Successfully', 'modal'),
('modal_success_text', 'Thank you for your message. I will get back to you as soon as possible.', 'modal'),
('modal_success_button', 'Awesome', 'modal')
ON DUPLICATE KEY UPDATE
    setting_value = VALUES(setting_value),
    setting_group = VALUES(setting_group);

-- ---- Stats -------------------------------------------
DELETE FROM stats WHERE id BETWEEN 1 AND 4;
INSERT INTO stats (id, icon_class, count_value, label_text, sort_order) VALUES
(1, 'fa-solid fa-code',      '80+', 'Projects Completed',   10),
(2, 'fa-solid fa-star',      '98%', 'Client Satisfaction',  20),
(3, 'fa-solid fa-users',     '20+', 'Happy Clients',        30),
(4, 'fa-solid fa-briefcase', '7+',  'Years Experience',     40);

-- ---- Services ----------------------------------------
DELETE FROM services WHERE id BETWEEN 1 AND 4;
INSERT INTO services (id, title, description, icon_class, sort_order) VALUES
(1, 'Cross-Platform Apps', 'Developing high-performance applications using Flutter for both Android and iOS, ensuring a consistent user experience across platforms.', 'fa-solid fa-mobile-screen', 10),
(2, 'Native Apps', 'Building robust and feature-rich native Android apps with Java, tailored to meet your specific requirements.', 'fa-solid fa-code', 20),
(3, 'Backend Development', 'Creating secure and scalable RESTful APIs and managing databases (SQL and NoSQL) to build a reliable backend for your applications.', 'fa-solid fa-database', 30),
(4, 'App Redesign & Optimization', 'Redesigning, optimizing, and upgrading existing apps with modern methods to enhance performance and usability.', 'fa-solid fa-gears', 40);

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
DELETE FROM experience_bullets WHERE experience_id IN (1, 2);
DELETE FROM experiences WHERE id IN (1, 2);

INSERT INTO experiences (id, date_range, position, company, sort_order) VALUES
(1, 'Oct 2023 — Present', 'PHP Laravel & Vue.js Developer', 'Corefinity (Destinology)', 10),
(2, 'Jan 2025 — Mar 2025', 'Fullstack Developer', 'WooCom Ecommerce (Startup)', 20);

INSERT INTO experience_bullets (experience_id, content, sort_order) VALUES
(1, 'Developed and maintained a holiday search and booking platform using Laravel and Vue.js.', 10),
(1, 'Built destination discovery, filtering, and booking flows for flights and accommodations.', 20),
(1, 'Integrated Laravel APIs and reusable Vue.js components to improve performance and user experience.', 30),
(2, 'Built a responsive e-commerce platform across web, mobile, and tablet devices.', 10),
(2, 'Converted Figma designs into adaptive and production-ready interfaces.', 20),
(2, 'Developed a Firebase-powered admin panel with Auth and Firestore integration.', 30);

-- ---- Projects ----------------------------------------
INSERT IGNORE INTO projects (title, slug, description, image_path, project_url, sort_order) VALUES
('Holiday Booking Platform', 'project-1', 'A holiday search & booking platform built with Laravel and Vue.js.', 'assets/images/portfolio/project-1.webp', NULL, 10),
('E-commerce Storefront', 'project-2', 'Responsive e-commerce platform across web, mobile and tablet.', 'assets/images/portfolio/project-2.webp', NULL, 20),
('Admin Dashboard', 'project-3', 'Firebase-powered admin panel with Auth and Firestore integration.', 'assets/images/portfolio/project-3.webp', NULL, 30),
('Mobile App UI', 'project-4', 'Cross-platform Flutter app — iOS & Android.', 'assets/images/portfolio/project-4.webp', NULL, 40),
('Native Android App', 'project-5', 'Feature-rich native Android app written in Java.', 'assets/images/portfolio/project-5.webp', NULL, 50),
('Backend API', 'project-6', 'Secure RESTful API with managed SQL & NoSQL stores.', 'assets/images/portfolio/project-6.webp', NULL, 60);

-- ---- Admin user (password: changeme123) --------------
-- Change immediately after first login via Admin → Account.
INSERT INTO admin_users (username, password_hash) VALUES
('admin', '$2y$12$KdmmC6uhEStJA96QkNSZQe2gOz4yVjotsU67CBbNnIt68O6Rw7fnq')
ON DUPLICATE KEY UPDATE username = username;
