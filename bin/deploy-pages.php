<?php

/**
 * Push ./dist to the GitHub Pages repository.
 *
 * Usage:  php bin/deploy-pages.php
 *         composer deploy:pages
 */

declare(strict_types=1);

$root     = dirname(__DIR__);
$dist     = $root . '/dist';
$repoUrl  = 'https://github.com/TheSam912/TheSam912.github.io.git';
$workDir  = sys_get_temp_dir() . '/thesam912-github-pages-deploy';
$branch   = 'main';

function info(string $message): void
{
    echo "  · {$message}\n";
}

function ok(string $message): void
{
    echo "  ✓ {$message}\n";
}

function fail(string $message): never
{
    fwrite(STDERR, "  ✗ {$message}\n");
    exit(1);
}

function run(string $command, string $cwd): void
{
    $descriptor = [
        0 => ['pipe', 'r'],
        1 => ['pipe', 'w'],
        2 => ['pipe', 'w'],
    ];

    $process = proc_open($command, $descriptor, $pipes, $cwd);

    if (!is_resource($process)) {
        fail("Could not run: {$command}");
    }

    fclose($pipes[0]);
    $stdout = stream_get_contents($pipes[1]);
    $stderr = stream_get_contents($pipes[2]);
    fclose($pipes[1]);
    fclose($pipes[2]);

    $exitCode = proc_close($process);

    if ($exitCode !== 0) {
        fail(trim($command . "\n" . $stdout . "\n" . $stderr));
    }
}

if (!is_file($dist . '/index.html')) {
    fail('dist/index.html not found. Run: composer build:pages');
}

info('Preparing deploy workspace...');

if (is_dir($workDir)) {
    run('git fetch origin', $workDir);
    run("git checkout {$branch}", $workDir);
    run("git reset --hard origin/{$branch}", $workDir);
} else {
    run('git clone --depth 1 --branch ' . escapeshellarg($branch) . ' '
        . escapeshellarg($repoUrl) . ' ' . escapeshellarg($workDir), sys_get_temp_dir());
}

info('Replacing site files...');

$keep = ['.git'];

foreach (scandir($workDir) ?: [] as $entry) {
    if ($entry === '.' || $entry === '..' || in_array($entry, $keep, true)) {
        continue;
    }

    $path = $workDir . DIRECTORY_SEPARATOR . $entry;

    if (is_dir($path)) {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($iterator as $item) {
            $item->isDir() ? rmdir($item->getPathname()) : unlink($item->getPathname());
        }

        rmdir($path);
        continue;
    }

    unlink($path);
}

/** @param list<string> $skipBasenames */
$copyTree = static function (string $source, string $destination) use (&$copyTree): void {
    if (is_file($source)) {
        $dir = dirname($destination);

        if (!is_dir($dir) && !mkdir($dir, 0755, true)) {
            fail("Could not create directory: {$dir}");
        }

        if (!copy($source, $destination)) {
            fail("Could not copy {$source}");
        }

        return;
    }

    if (!is_dir($source)) {
        fail("Missing path: {$source}");
    }

    if (!is_dir($destination) && !mkdir($destination, 0755, true)) {
        fail("Could not create directory: {$destination}");
    }

    foreach (scandir($source) ?: [] as $entry) {
        if ($entry === '.' || $entry === '..') {
            continue;
        }

        $copyTree(
            $source . DIRECTORY_SEPARATOR . $entry,
            $destination . DIRECTORY_SEPARATOR . $entry
        );
    }
};

foreach (scandir($dist) ?: [] as $entry) {
    if ($entry === '.' || $entry === '..') {
        continue;
    }

    $copyTree($dist . DIRECTORY_SEPARATOR . $entry, $workDir . DIRECTORY_SEPARATOR . $entry);
}

info('Committing and pushing...');
run('git add -A', $workDir);
run('git status --short', $workDir);

$status = shell_exec('cd ' . escapeshellarg($workDir) . ' && git status --porcelain');

if (trim((string) $status) === '') {
    ok('GitHub Pages site is already up to date.');
    exit(0);
}

run('git commit -m ' . escapeshellarg('Deploy new portfolio site'), $workDir);
run('git push origin ' . escapeshellarg($branch), $workDir);

ok('Deployed to https://github.com/TheSam912/TheSam912.github.io');
ok('Live site: https://thesam912.github.io/');
