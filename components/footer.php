<?php

/** @var array $content */

?>

<!-- ===================================
     FOOTER IMAGE
=================================== -->

<section class="footer-wave">

    <img
        src="./assets/images/footer-wave.webp"
        alt="Footer Wave">

</section>


<!-- ===================================
     FOOTER
=================================== -->

<footer class="footer-section">

    <div class="footer-wrapper">

        <!-- LOGO -->

        <a href="#hero" class="footer-logo">

            <img
                src="./assets/images/logo.png"
                alt="Sam Nolan Logo">

        </a>


        <!-- COPYRIGHT -->

        <div class="footer-copy">

            <?= $content['footer_copyright']; ?>

        </div>


        <!-- SOCIALS -->

        <div class="footer-socials">

            <a
                href="<?= $content['footer_github']; ?>"
                target="_blank">

                <i class="fa-brands fa-github"></i>

            </a>

            <a
                href="<?= $content['footer_linkedin']; ?>"
                target="_blank">

                <i class="fa-brands fa-linkedin-in"></i>

            </a>

            <a
                href="mailto:<?= $content['footer_email']; ?>">

                <i class="fa-solid fa-envelope"></i>

            </a>

        </div>

    </div>

</footer>