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
                action="https://api.web3forms.com/submit"
                method="POST">

                <input
                    type="hidden"
                    name="access_key"
                    value="6e41a5b2-6296-4585-a17c-d138aff39817">

                <div class="input-box">

                    <i class="fa-regular fa-user"></i>

                    <input
                        type="text"
                        name="name"
                        placeholder="<?= $content['contact_name_placeholder']; ?>"
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