<?php

require_once "config/database.php";

$stmt = $pdo->query("SELECT * FROM projects");

$projects = $stmt->fetchAll();

?>

<section id="portfolio" class="portfolio-section">

    <div class="portfolio-head">

        <span class="section-tag">

            <span class="tag-dot"></span>

            PORTFOLIO

        </span>

        <h2 class="portfolio-title">

            Selected

            <span>Projects.</span>

        </h2>

    </div>

    <div class="portfolio-grid">

        <div class="portfolio-item">

            <img
                src="assets/images/portfolio/project-1.webp"
                alt="Project"
            >

        </div>

        <div class="portfolio-item">

            <img
                src="assets/images/portfolio/project-2.webp"
                alt="Project"
            >

        </div>

        <div class="portfolio-item">

            <img
                src="assets/images/portfolio/project-3.webp"
                alt="Project"
            >

        </div>

        <div class="portfolio-item">

            <img
                src="assets/images/portfolio/project-4.webp"
                alt="Project"
            >

        </div>

        <div class="portfolio-item">

            <img
                src="assets/images/portfolio/project-5.webp"
                alt="Project"
            >

        </div>

        <div class="portfolio-item">

            <img
                src="assets/images/portfolio/project-6.webp"
                alt="Project"
            >

        </div>

    </div>

</section>