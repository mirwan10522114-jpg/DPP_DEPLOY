<?php

declare(strict_types=1);

http_response_code(404);
$pageTitle = 'Halaman Tidak Ditemukan — Dunia Pool & Pond';
$activeNav = '';
$showPreFooterCta = false;

require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/header.php';
?>

<main class="flex-grow py-20 bg-cream-50 flex items-center justify-center" id="main-content">
    <div class="max-w-md w-full mx-auto px-5 text-center space-y-4">
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-gold-600">HTTP 404</p>
        <h1 class="font-serif text-3xl font-semibold text-navy-900">Halaman Tidak Ditemukan</h1>
        <p class="text-sm text-[#556275] leading-relaxed">
            Maaf, halaman yang Anda tuju tidak tersedia atau telah dipindahkan di situs resmi Dunia Pool &amp; Pond.
        </p>
        <div class="pt-2 flex flex-wrap items-center justify-center gap-3">
            <a class="inline-flex items-center justify-center gap-2 bg-navy-900 hover:bg-navy-700 text-white text-xs font-semibold px-6 h-11 rounded-md transition-colors" href="<?= e(app_url('/')) ?>">
                <span>Kembali ke Beranda</span>
                <?= render_icon('arrow-right', 'w-4 h-4') ?>
            </a>
            <a class="inline-flex items-center justify-center gap-2 bg-gold-400 hover:bg-gold-300 text-navy-950 text-xs font-semibold px-5 h-11 rounded-md transition-colors" href="<?= e(app_url('/produk')) ?>">
                <span>Buka Katalog Produk</span>
            </a>
        </div>
    </div>
</main>

<?php
require __DIR__ . '/../includes/footer.php';
