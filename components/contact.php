<?php

/** @var array $content */

?>

<section id="contact" class="contact-section">

    <div class="contact-wrapper">

        <!-- FORM -->

        <div class="contact-form">

            <span class="section-tag">

                <span class="tag-dot"></span>

                <?= $content['contact_tag']; ?>

            </span>

            <h2 class="contact-title">

                <?= $content['contact_title_line_1']; ?>

                <span>

                    <?= $content['contact_title_line_2']; ?>

                </span>

            </h2>

            <form
                id="contactForm"
                action="api/contact.php"
                method="POST"
                novalidate>

                <!-- Honeypot: hidden from humans, attractive to bots. -->
                <input
                    type="text"
                    name="_hp"
                    tabindex="-1"
                    autocomplete="off"
                    style="position:absolute;left:-9999px;width:1px;height:1px;opacity:0;"
                    aria-hidden="true">

                <div class="input-box">

                    <i class="fa-regular fa-user"></i>

                    <input
                        type="text"
                        name="name"
                        placeholder="<?= $content['contact_name_placeholder']; ?>"
                        maxlength="255"
                        required>

                </div>

                <div class="input-box">

                    <i class="fa-regular fa-envelope"></i>

                    <input
                        type="email"
                        name="email"
                        placeholder="<?= $content['contact_email_placeholder']; ?>"
                        required>

                </div>

                <div class="input-box textarea-box">

                    <i class="fa-regular fa-message"></i>

                    <textarea
                        name="message"
                        placeholder="<?= $content['contact_message_placeholder']; ?>"
                        required></textarea>

                </div>

                <button
                    type="submit"
                    class="primary-btn">

                    <?= $content['contact_button']; ?>

                </button>

            </form>

        </div>


        <!-- INFO BOX -->

        <div class="contact-info">

            <span class="section-tag">

                <span class="tag-dot"></span>

                <?= $content['contact_info_tag']; ?>

            </span>

            <div class="contact-links">

                <a
                    href="mailto:<?= $content['contact_email']; ?>"
                    class="contact-link">

                    <i class="fa-regular fa-envelope"></i>

                    <span>

                        <?= $content['contact_email']; ?>

                    </span>

                </a>

                <a
                    href="<?= $content['contact_linkedin']; ?>"
                    target="_blank"
                    class="contact-link">

                    <i class="fa-brands fa-linkedin-in"></i>

                    <span>

                        <?= $content['contact_linkedin_text']; ?>

                    </span>

                </a>

                <a
                    href="<?= $content['contact_github']; ?>"
                    target="_blank"
                    class="contact-link">

                    <i class="fa-brands fa-github"></i>

                    <span>

                        <?= $content['contact_github_text']; ?>

                    </span>

                </a>

                <div class="contact-link">

                    <i class="fa-solid fa-location-dot"></i>

                    <span>

                        <?= $content['contact_location']; ?>

                    </span>

                </div>

            </div>

        </div>

    </div>

</section>