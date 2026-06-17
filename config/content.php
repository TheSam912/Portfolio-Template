<?php

declare(strict_types=1);

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/repository.php';

/** Static labels, titles, footer, stats, services — not in admin. */
$content = require __DIR__ . '/static.php';

/** Editable via admin: summary, CV, contact info. */
$repository  = new ContentRepository($pdo);
$profile     = $repository->getProfile();
$skills      = $repository->getSkills();
$experiences = $repository->getExperiences();
