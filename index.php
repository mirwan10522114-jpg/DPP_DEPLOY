<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/helpers.php';

$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$rawPath = parse_url($requestUri, PHP_URL_PATH);
$decodedPath = rawurldecode(is_string($rawPath) ? $rawPath : '/');
$decodedBase = rawurldecode(app_base_path());

if ($decodedBase !== '' && stripos($decodedPath, $decodedBase) === 0) {
    $decodedPath = substr($decodedPath, strlen($decodedBase));
}

$route = '/' . trim($decodedPath, '/');
if ($route === '/index.php') {
    $route = '/';
}

// Redirect sub-alias & kompatibilitas rute lama secara bersih
$redirects = [
    '/konsultasi'                        => '/kontak',
    '/faq'                               => '/manajemen-proyek#faq',
    '/perusahaan-kami'                   => '/layanan',
    '/portofolio'                        => '/proyek',
    '/gallery'                           => '/galeri',
    '/investor'                          => '/manajemen-proyek',
    '/karir'                             => '/tentang-kami',
    '/berita'                            => '/proyek',
    '/layanan/sistem-sirkulasi-filtrasi' => '/layanan#sirkulasi-filtrasi',
    '/layanan/konstruksi-kolam-renang'   => '/layanan#konstruksi-kolam',
    '/layanan/desain-konsultasi'         => '/layanan#desain-konsultasi',
    '/layanan/perawatan-kolam'           => '/layanan#perawatan-kolam',
    '/layanan/pengolahan-air'            => '/layanan#pengolahan-air',
    '/produk/pompa-sirkulasi'            => '/produk#pompa',
    '/produk/pompa-kolam'                => '/produk#pompa',
    '/produk/sand-filter'                => '/produk#filter',
    '/produk/skimmer-box'                => '/produk#fittings',
    '/produk/fitting-kolam'              => '/produk#fittings',
];

if (isset($redirects[$route])) {
    header('Location: ' . app_url($redirects[$route]), true, 302);
    exit;
}

switch ($route) {
    case '/':
    case '/beranda':
        require __DIR__ . '/pages/beranda.php';
        break;

    case '/tentang-kami':
        require __DIR__ . '/pages/tentang.php';
        break;

    case '/layanan':
        require __DIR__ . '/pages/layanan.php';
        break;

    case '/proyek':
        require __DIR__ . '/pages/proyek.php';
        break;

    case '/galeri':
        require __DIR__ . '/pages/galeri.php';
        break;

    case '/manajemen-proyek':
        require __DIR__ . '/pages/manajemen.php';
        break;

    case '/produk':
        require __DIR__ . '/pages/produk.php';
        break;

    case '/kontak':
        require __DIR__ . '/pages/kontak.php';
        break;

    case '/kebijakan-privasi':
        $legalMode = 'privacy';
        require __DIR__ . '/pages/legal.php';
        break;

    case '/ketentuan-layanan':
        $legalMode = 'terms';
        require __DIR__ . '/pages/legal.php';
        break;

    case '/sitemap':
        $legalMode = 'sitemap';
        require __DIR__ . '/pages/legal.php';
        break;

    default:
        require __DIR__ . '/pages/404.php';
        break;
}
