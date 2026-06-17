<?php

/**
 * Build a static GitHub Pages export into ./dist
 *
 * Usage:  php bin/build-static.php
 *         composer build:pages
 */

declare(strict_types=1);

define('STATIC_BUILD', true);

$root = dirname(__DIR__);
$dist = $root . '/dist';

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

function remove_dir(string $dir): void
{
    if (!is_dir($dir)) {
        return;
    }

    $items = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST
    );

    foreach ($items as $item) {
        $item->isDir() ? rmdir($item->getPathname()) : unlink($item->getPathname());
    }

    rmdir($dir);
}

/** @param list<string> $skipBasenames */
function copy_tree(string $source, string $destination, array $skipBasenames = []): void
{
    if (!is_dir($source)) {
        fail("Missing directory: {$source}");
    }

    if (!is_dir($destination) && !mkdir($destination, 0755, true)) {
        fail("Could not create directory: {$destination}");
    }

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($source, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($iterator as $item) {
        $basename = $item->getBasename();

        if (in_array($basename, $skipBasenames, true)) {
            continue;
        }

        $target = $destination . DIRECTORY_SEPARATOR . $iterator->getSubPathName();

        if ($item->isDir()) {
            if (!is_dir($target) && !mkdir($target, 0755, true)) {
                fail("Could not create directory: {$target}");
            }
            continue;
        }

        if (!copy($item->getPathname(), $target)) {
            fail("Could not copy {$item->getPathname()}");
        }
    }
}

info('Cleaning dist/...');
remove_dir($dist);
mkdir($dist, 0755, true);

info('Rendering index.html from PHP...');

ob_start();

try {
    require $root . '/index.php';
} catch (Throwable $e) {
    ob_end_clean();
    fail('Render failed: ' . $e->getMessage());
}

$html = ob_get_clean();

if (trim($html) === '') {
    fail('Rendered HTML is empty.');
}

file_put_contents($dist . '/index.html', $html);
ok('index.html');

info('Copying frontend assets...');
copy_tree($root . '/assets/css', $dist . '/assets/css');
copy_tree($root . '/assets/js', $dist . '/assets/js', ['admin.js']);
copy_tree($root . '/assets/images', $dist . '/assets/images');
copy_tree($root . '/assets/files', $dist . '/assets/files');

if (is_dir($root . '/assets/uploads')) {
    copy_tree($root . '/assets/uploads', $dist . '/assets/uploads', ['.gitkeep']);
}

file_put_contents($dist . '/.nojekyll', '');
ok('assets copied');

file_put_contents(
    $dist . '/README.md',
    "# Sam Nolan — GitHub Pages\n\n"
    . "This site is generated from the PHP portfolio project.\n\n"
    . "Rebuild locally:\n\n"
    . "```bash\n"
    . "composer build:pages\n"
    . "composer deploy:pages\n"
    . "```\n"
);

ok('Static build ready in dist/');
