<?php

declare(strict_types=1);

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/repository.php';

$repository   = new ContentRepository($pdo);
$content      = $repository->getContent();
$stats        = $repository->getStats();
$services     = $repository->getServices();
$skills       = $repository->getSkills();
$experiences  = $repository->getExperiences();
