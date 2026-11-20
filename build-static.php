<?php

declare(strict_types=1);

/**
 * Generator output HTML statis ke folder dist/ untuk deployment Vercel / static hosting.
 * Jalankan: php build-static.php
 */

$routes = [
    'beranda'           => ['file' => 'index.html', 'page' => '/pages/beranda.php'],
    'tentang-kami'      => ['file' => 'tentang-kami.html', 'page' => '/pages/tentang.php'],
    'layanan'           => ['file' => 'layanan.html', 'page' => '/pages/layanan.php'],
    'proyek'            => ['file' => 'proyek.html', 'page' => '/pages/proyek.php'],
    'galeri'            => ['file' => 'galeri.html', 'page' => '/pages/galeri.php'],
    'manajemen-proyek'  => ['file' => 'manajemen-proyek.html', 'page' => '/pages/manajemen.php'],
    'produk'            => ['file' => 'produk.html', 'page' => '/pages/produk.php'],
    'kontak'            => ['file' => 'kontak.html', 'page' => '/pages/kontak.php'],
    'kebijakan-privasi' => ['file' => 'kebijakan-privasi.html', 'page' => '/pages/legal.php', 'legalMode' => 'privacy'],
    'ketentuan-layanan' => ['file' => 'ketentuan-layanan.html', 'page' => '/pages/legal.php', 'legalMode' => 'terms'],
    'sitemap'           => ['file' => 'sitemap.html', 'page' => '/pages/legal.php', 'legalMode' => 'sitemap'],
    '404'               => ['file' => '404.html', 'page' => '/pages/404.php'],
];

if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    exit('Forbidden');
}

foreach ($argv as $arg) {
    if (strpos($arg, '--render=') === 0) {
        $key = substr($arg, strlen('--render='));
        if (!isset($routes[$key])) {
            fwrite(STDERR, "Unknown route key: {$key}\n");
            exit(1);
        }

        $_SERVER['DOCUMENT_ROOT'] = '';
        $_SERVER['REQUEST_URI'] = '/' . ($key === 'beranda' ? '' : $key);
        require_once __DIR__ . '/includes/helpers.php';

        $spec = $routes[$key];
        if (isset($spec['legalMode'])) {
            $legalMode = $spec['legalMode'];
        }

        ob_start();
        require __DIR__ . $spec['page'];
        $html = ob_get_clean();

        if (!is_string($html) || trim($html) === '') {
            fwrite(STDERR, "Empty output for {$key}\n");
            exit(1);
        }

        echo $html;
        exit(0);
    }
}

$distDir = __DIR__ . DIRECTORY_SEPARATOR . 'dist';
if (!is_dir($distDir) && !mkdir($distDir, 0775, true) && !is_dir($distDir)) {
    fwrite(STDERR, "Failed to create dist directory\n");
    exit(1);
}

$phpBin = escapeshellarg(PHP_BINARY);
$script = escapeshellarg(__FILE__);

foreach ($routes as $key => $spec) {
    $routeKey = (string) $key;
    $cmd = $phpBin . ' ' . $script . ' --render=' . escapeshellarg($routeKey);
    $proc = proc_open($cmd, [0 => ['pipe', 'r'], 1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes, __DIR__);
    if (!is_resource($proc)) {
        fwrite(STDERR, "Failed to spawn worker for {$routeKey}\n");
        exit(1);
    }
    fclose($pipes[0]);
    $stdout = stream_get_contents($pipes[1]);
    $stderr = stream_get_contents($pipes[2]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    $exitCode = proc_close($proc);

    if ($exitCode !== 0 || !is_string($stdout) || stripos($stdout, '<!DOCTYPE html>') === false) {
        fwrite(STDERR, "Render failed for {$routeKey} (exit={$exitCode}): {$stderr}\n");
        exit(1);
    }

    if (preg_match('/\b(Fatal error|Parse error|Warning:|Notice:)\b/i', $stderr . "\n" . $stdout, $m)) {
        fwrite(STDERR, "PHP error detected while rendering {$routeKey}: {$m[0]}\n{$stderr}\n");
        exit(1);
    }

    $outPath = $distDir . DIRECTORY_SEPARATOR . $spec['file'];
    if (file_put_contents($outPath, $stdout) === false) {
        fwrite(STDERR, "Failed writing {$outPath}\n");
        exit(1);
    }

    echo sprintf("[OK] %s -> dist/%s (%d bytes)\n", $routeKey, $spec['file'], strlen($stdout));
}
