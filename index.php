<?php

require_once 'config/content.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Portfolio Template</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="stylesheet" href="assets/css/responsive.css">

</head>

<body>

    <?php include 'components/navbar.php'; ?>

    <?php include 'components/hero.php'; ?>

    <?php include 'components/stats.php'; ?>

    <?php include 'components/about.php'; ?>

    <?php include 'components/services.php'; ?>

    <?php include 'components/banner.php'; ?>

    <?php include 'components/skills.php'; ?>

    <?php include 'components/experiences.php'; ?>

    <?php include 'components/portfolio.php'; ?>

    <?php include 'components/contact.php'; ?>

    <?php include 'components/footer.php'; ?>


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

            <button id="closeModal">

                Awesome

            </button>

        </div>

    </div>

    <script>
        // ===========================
        // MOBILE MENU
        // ===========================

        const menuBtn = document.querySelector('.menu-toggle');

        const closeBtn = document.querySelector('.menu-close');

        const mobileMenu = document.querySelector('.mobile-menu');

        const overlay = document.querySelector('.nav-overlay');

        menuBtn.addEventListener('click', () => {

            mobileMenu.classList.add('active');

            overlay.classList.add('active');

        });

        closeBtn.addEventListener('click', () => {

            mobileMenu.classList.remove('active');

            overlay.classList.remove('active');

        });

        overlay.addEventListener('click', () => {

            mobileMenu.classList.remove('active');

            overlay.classList.remove('active');

        });


        // ===========================
        // SUCCESS MODAL
        // ===========================

        const modal = document.getElementById("successModal");

        const closeModal = document.getElementById("closeModal");

        if (closeModal) {

            // Close Button

            closeModal.addEventListener("click", () => {

                modal.classList.remove("active");

            });

            // Click Outside

            modal.addEventListener("click", (e) => {

                if (e.target === modal) {

                    modal.classList.remove("active");

                }

            });

            // ESC Key

            document.addEventListener("keydown", (e) => {

                if (e.key === "Escape") {

                    modal.classList.remove("active");

                }

            });

            // Auto Close

            setTimeout(() => {

                modal.classList.remove("active");

            }, 5000);

        }
    </script>

    <script>
        const contactForm = document.getElementById("contactForm");

        if (contactForm) {

            contactForm.addEventListener("submit", async (e) => {

                e.preventDefault();

                const formData = new FormData(contactForm);

                const response = await fetch(
                    "https://api.web3forms.com/submit", {
                        method: "POST",
                        body: formData
                    }
                );

                const result = await response.json();

                if (result.success) {

                    modal.classList.add("active");

                    contactForm.reset();

                    setTimeout(() => {

                        modal.classList.remove("active");

                    }, 5000);

                }

            });

        }
    </script>

</body>

</html>