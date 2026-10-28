-- =====================================================
-- Seed data — mirrors resume (Sobhan_Daroogheh.pdf)
-- Apply with:  composer db:reset
-- =====================================================

USE portfolio_db;

-- ---- Profile ----
INSERT INTO settings (setting_key, setting_value, setting_group) VALUES
('short_summary', 'Software & Website Developer with 8+ years of experience turning product requirements into responsive, high-performance web and mobile applications (Flutter, Laravel, Vue.js, Node.js).', 'profile'),
('about_summary', 'Software & Website Developer with 8+ years of experience turning product requirements into responsive, high-performance web and mobile applications (Flutter, Laravel, Vue.js, Node.js). Track record of shipping production platforms that lifted engagement and revenue by up to 45% and cut delivery time through reusable, well-architected components. Brings a rare second skill set to development teams: hands-on SEO and GEO (Generative Engine Optimization), ensuring products are not only well-built but discoverable — in traditional search and in AI-driven answer engines. Backed by a Master''s in Cybersecurity and a consistent record of delivering in fast-moving agile teams.', 'profile'),
('resume_file', 'assets/files/Sobhan-Resume.pdf', 'profile'),
('contact_email', 'The.Sam.Nolan1998@gmail.com', 'profile'),
('contact_linkedin', 'https://linkedin.com/in/sam912', 'profile'),
('contact_linkedin_text', 'linkedin.com/in/sam912', 'profile'),
('contact_github', 'https://github.com/TheSam912', 'profile'),
('contact_github_text', 'github.com/TheSam912', 'profile'),
('contact_location', 'Remote / Worldwide', 'profile')
ON DUPLICATE KEY UPDATE
    setting_value = VALUES(setting_value),
    setting_group = VALUES(setting_group);

-- ---- Skills (admin mirror; site uses config/core-skills.php) ----
DELETE FROM skills;
INSERT INTO skills (id, name, icon_path, sort_order) VALUES
(1,  'Flutter',       'assets/images/skills/flutter.png', 10),
(2,  'React Native',  'assets/images/skills/js.png',      20),
(3,  'Firebase',      'assets/images/skills/js.png',      30),
(4,  'Laravel',       'assets/images/skills/laravel.png', 40),
(5,  'Vue.js',        'assets/images/skills/vue.png',     50),
(6,  'Node.js',       'assets/images/skills/nodejs.png',  60),
(7,  'MongoDB',       'assets/images/skills/mongodb.png', 70),
(8,  'Docker',        'assets/images/skills/docker.png',  80),
(9,  'AWS',           'assets/images/skills/aws.png',     90),
(10, 'Git',           'assets/images/skills/git.png',    100),
(11, 'Figma',         'assets/images/skills/figma.png',  110),
(12, 'TypeScript',    'assets/images/skills/js.png',     120),
(13, 'PHP',           'assets/images/skills/php.png',    130),
(14, 'MySQL',         'assets/images/skills/mysql.png',  140);

-- ---- Experiences (resume order, newest first) ----
DELETE FROM experience_bullets;
DELETE FROM experiences;

INSERT INTO experiences (id, date_range, position, company, sort_order) VALUES
(1,  'Sep 2026 — Present',  'Mobile Application Developer (Android & iOS)', 'Fanavaran', 10),
(2,  'Apr 2026 — Present',  'Freelance Software & Website Developer', 'Self-Employed', 20),
(3,  'Oct 2025 — Apr 2026', 'PHP Laravel & Vue.js Developer', 'Corefinity (Destinology)', 30),
(4,  'Jan 2025 — Mar 2025', 'Fullstack Developer', 'WooCom Ecommerce (Startup)', 40),
(5,  'Sep 2023 — Mar 2024', 'Flutter Application Developer', 'NIU Nature (Healthcare App)', 50),
(6,  'Oct 2019 — Sep 2022', 'Relocation & Academic Preparation', 'Iran → Italy', 60),
(7,  'Oct 2018 — Oct 2019', 'Flutter Application Developer', 'IRIC', 70),
(8,  'Oct 2018 — Oct 2019', 'Android Application Developer', 'Dade Gostar GHOMES', 80),
(9,  'Oct 2016 — Oct 2017', 'Android Application Developer', 'Graph', 90),
(10, 'Jun 2016 — Sep 2016', 'Android Developer (Internship)', 'Mana (Greenweb)', 100);

INSERT INTO experience_bullets (experience_id, content, sort_order) VALUES
(1, 'Rebuilding the company''s Android and iOS app from the ground up with React Native, collaborating with the IT team to improve the existing product.', 10),
(1, 'Developed a dedicated CLI to manage the application project and support development workflows.', 20),
(1, 'Published the Android app on Google Play and submitted the iOS app to the App Store, where it is currently under review.', 30),
(1, 'Contribute to website and backend development alongside primary mobile application responsibilities.', 40),
(2, 'Delivering project-based Laravel, Vue.js, and Flutter development for international clients on a contract basis.', 10),
(2, 'Founded and currently operate three personal business ventures, applying hands-on full-stack development and SEO/GEO strategy to build and grow them from the ground up.', 20),
(3, 'Engineered core booking flows — destination discovery, search/filtering, flights, accommodation and extras — for a large-scale holiday platform used by thousands of travellers, built with Laravel and Vue.js.', 10),
(3, 'Raised UX consistency across devices by building a library of reusable Vue.js components, cutting future feature build-time for the team.', 20),
(3, 'Kept production stable while shipping new features weekly, integrating backend APIs and database logic in Laravel within a fast-moving agile workflow.', 30),
(4, 'Took a startup from Figma concept to a live, fully responsive e-commerce site and app across web, mobile and tablet in under three months.', 10),
(4, 'Gave the founders real-time control of the business by building a custom Firebase-powered admin panel with secure auth and Firestore-backed order/customer data.', 20),
(5, 'Delivered a healthcare app built around daily programs from German physicians, lifting user engagement by 30% through Apple/Google authentication and in-app purchase integration.', 10),
(5, 'Designed and shipped a health-monitoring dashboard that drove a 45% surge in engagement and a 20% revenue boost within the first six months.', 20),
(6, 'Completed IELTS certification, official document translation/legalization, and visa processing in preparation for postgraduate study abroad.', 10),
(7, 'Turned user testing into product decisions, redesigning the UX of a smart-home kit app to grow positive reviews by 35% and daily active users by 60%.', 10),
(7, 'Cut support tickets by 20% by pairing gamification and social-sharing features with a structured user-training program.', 20),
(8, 'Led a multidisciplinary team building a telemedicine platform that reduced patient no-shows by 20% and lifted satisfaction scores by 15% within six months.', 10),
(8, 'Extended the platform across four verticals: hospital management, e-commerce, drug store, and blood-donation coordination.', 20),
(9, 'Took ownership of an e-commerce app build end-to-end and modernized a legacy Basic4Android system still in daily use.', 10),
(9, 'Grew the team''s capability by mentoring two junior developers in Android programming while designing the UI for a new card-management product.', 20),
(10, 'Shipped a feature-rich Android app that drove a 10% increase in monthly sales within five months of launch.', 10),
(10, 'Sharpened go-to-market targeting through competitor research, lifting click-through rates 20% and conversions 15% in three months.', 20);

-- ---- Featured projects (resume Featured Projects + Wealthio) ----
DELETE FROM projects;

INSERT INTO projects (id, title, slug, description, image_path, project_url, sort_order) VALUES
(1, 'Onzyro', 'onzyro', 'Premium Persian footwear e-commerce — RTL Next.js storefront with catalog, checkout, wishlist, and admin showcase. Live demo on Vercel.', 'assets/images/portfolio/project-onzyro.webp', 'https://ecommerce-shoes-swart.vercel.app/', 5),
(2, 'Vesta', 'vesta', 'Premium Persian watch e-commerce — RTL Next.js storefront with studio catalog media, product detail, and admin demo. Live showcase on Vercel.', 'assets/images/portfolio/project-vesta.webp', 'https://ecommerce-watch-five.vercel.app/', 8),
(3, 'Destinology.co.uk', 'destinology', 'Large-scale holiday booking platform (PHP Laravel, Vue.js) with dynamic destination search, filtering, and package selection, built and maintained alongside the Corefinity team.', 'assets/images/portfolio/project-6.webp', 'https://www.destinology.co.uk/', 10),
(4, 'NIU Nature', 'niu-nature', 'Production healthcare app with backend-integrated dynamic content, shipped and maintained for a live App Store audience.', 'assets/images/portfolio/project-2.webp', 'https://www.niu-nature.app/', 20),
(5, 'WooCom Flutter E-Commerce', 'woocom', 'Fully responsive e-commerce app for web, tablet and mobile, with a Firebase backend for auth, product management and orders.', 'assets/images/portfolio/project-1.webp', 'https://thesam912.github.io/woocom', 30),
(6, 'Wealthio', 'wealthio', 'Founded and built Wealthio as a personal business venture, owning product development from UI/UX design to backend implementation. Progressive Web App with a Next.js frontend and a PHP/Laravel backend.', 'assets/images/portfolio/project-wealthio.webp', 'https://wealthio.ir/', 50);

-- ---- Admin user (password: changeme123) --------------
INSERT INTO admin_users (username, password_hash) VALUES
('admin', '$2y$12$KdmmC6uhEStJA96QkNSZQe2gOz4yVjotsU67CBbNnIt68O6Rw7fnq')
ON DUPLICATE KEY UPDATE username = username;
