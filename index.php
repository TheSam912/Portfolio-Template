<?php

require_once __DIR__ . '/config/env.php';
require_once __DIR__ . '/config/helpers.php';
require_once __DIR__ . '/config/content.php';

if (is_debug()) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    ini_set('display_errors', '0');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sam Nolan — Portfolio</title>

    <meta name="description" content="<?= e($content['hero_description']); ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="image" href="assets/images/hero.webp" fetchpriority="high">

    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/animations.css">

    <script defer src="assets/js/main.js"></script>

</head>

<body>

    <?php include __DIR__ . '/components/navbar.php'; ?>
    <?php include __DIR__ . '/components/hero.php'; ?>
    <?php include __DIR__ . '/components/stats.php'; ?>
    <?php include __DIR__ . '/components/about.php'; ?>
    <?php include __DIR__ . '/components/services.php'; ?>
    <?php include __DIR__ . '/components/banner.php'; ?>
    <?php include __DIR__ . '/components/skills.php'; ?>
    <?php include __DIR__ . '/components/experiences.php'; ?>
    <?php include __DIR__ . '/components/portfolio.php'; ?>
    <?php include __DIR__ . '/components/contact.php'; ?>
    <?php include __DIR__ . '/components/footer.php'; ?>

    <!-- SUCCESS MODAL -->

    <div class="success-modal" id="successModal">

        <div class="success-modal-content">

            <div class="success-icon">

                <i class="fa-solid fa-check"></i>

            </div>

            <h3>Message Sent Successfully</h3>

            <p>
                Thank you for your message.
                I will get back to you as soon as possible.
            </p>

            <button id="closeModal" type="button">

                Awesome

            </button>

        </div>

    </div>

</body>

</html>
