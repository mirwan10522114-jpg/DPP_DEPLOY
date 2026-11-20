<?php

declare(strict_types=1);

$legalMode = $legalMode ?? 'privacy';
$titles = [
    'privacy' => 'Kebijakan Privasi',
    'terms'   => 'Ketentuan Layanan',
    'sitemap' => 'Sitemap',
];
$heading = $titles[$legalMode] ?? $titles['privacy'];
$pageTitle = $heading . ' — Dunia Pool & Pond';
$activeNav = '';
$showPreFooterCta = false;

require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/header.php';
?>

<main class="flex-grow py-16 sm:py-20 bg-cream-50" id="main-content">
    <div class="max-w-3xl mx-auto px-5 sm:px-8">
        <div class="bg-white border border-[#EAE5DC] rounded-2xl p-7 sm:p-10 shadow-card-soft space-y-5">
            <?php if ($legalMode === 'sitemap'): ?>
                <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-gold-600">PETA SITUS</p>
                <h1 class="font-serif text-2xl sm:text-3xl font-semibold text-navy-900">Sitemap Dunia Pool &amp; Pond</h1>
                <ul class="space-y-2.5 text-sm text-navy-900 pt-2">
                    <li><a class="hover:text-gold-600 font-medium underline" href="<?= e(app_url('/')) ?>">Beranda — Dunia Pool &amp; Pond (Sejak 1997)</a></li>
                    <li><a class="hover:text-gold-600 font-medium underline" href="<?= e(app_url('/tentang-kami')) ?>">Tentang Kami — Profil, Visi Misi &amp; Standar Teknis</a></li>
                    <li><a class="hover:text-gold-600 font-medium underline" href="<?= e(app_url('/layanan')) ?>">Layanan Kami — 8 Layanan Terpadu &amp; Sistem Sirkulasi</a></li>
                    <li><a class="hover:text-gold-600 font-medium underline" href="<?= e(app_url('/proyek')) ?>">Portofolio Proyek &amp; Video Desain 3D</a></li>
                    <li><a class="hover:text-gold-600 font-medium underline" href="<?= e(app_url('/galeri')) ?>">Galeri Foto Perusahaan Dunia Pool &amp; Pond</a></li>
                    <li><a class="hover:text-gold-600 font-medium underline" href="<?= e(app_url('/manajemen-proyek')) ?>">Manajemen Proyek (7 Tahap SOP) &amp; Tanya Jawab (FAQ)</a></li>
                    <li><a class="hover:text-gold-600 font-medium underline" href="<?= e(app_url('/produk')) ?>">Katalog Produk — 11 Kategori Peralatan &amp; 15 Merek Resmi</a></li>
                    <li><a class="hover:text-gold-600 font-medium underline" href="<?= e(app_url('/kontak')) ?>">Kontak &amp; Formulir Konsultasi WhatsApp (0821-1807-5560)</a></li>
                    <li><a class="hover:text-gold-600 font-medium underline" href="<?= e(app_url('/kebijakan-privasi')) ?>">Kebijakan Privasi</a></li>
                    <li><a class="hover:text-gold-600 font-medium underline" href="<?= e(app_url('/ketentuan-layanan')) ?>">Ketentuan Layanan</a></li>
                </ul>
            <?php elseif ($legalMode === 'terms'): ?>
                <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-gold-600">DOKUMEN LAYANAN</p>
                <h1 class="font-serif text-2xl sm:text-3xl font-semibold text-navy-900">Ketentuan Layanan</h1>
                <p class="text-xs sm:text-sm text-[#556275]">Panduan umum konsultasi teknis, pengadaan peralatan, dan pengerjaan proyek konstruksi kolam renang Dunia Pool &amp; Pond.</p>
                <div class="space-y-4 pt-2 text-sm text-[#4A5668] leading-relaxed">
                    <div>
                        <h2 class="font-bold text-navy-900 mb-1">1. Konsultasi &amp; Rekomendasi Teknis</h2>
                        <p>Rekomendasi spesifikasi pompa, sand filter, dan jalur perpipaan pada situs web bersifat panduan awal. Penentuan tipe akhir wajib diverifikasi berdasarkan ukuran kolam riil, jarak ruang mesin, dan elevasi konstruksi di lapangan.</p>
                    </div>
                    <div>
                        <h2 class="font-bold text-navy-900 mb-1">2. Ketersediaan Peralatan &amp; Suku Cadang</h2>
                        <p>Ketersediaan unit merek seperti AstralPool, Hayward, Pentair, Emaux, DAB, Waterco, maupun material keramik/mozaik menyesuaikan stok resmi pada saat konfirmasi pemesanan.</p>
                    </div>
                    <div>
                        <h2 class="font-bold text-navy-900 mb-1">3. Pelaksanaan Proyek &amp; Garansi</h2>
                        <p>Lingkup pekerjaan konstruksi, renovasi, jadwal pengerjaan, serta ketentuan garansi struktur dan kebocoran dituangkan secara tertulis dalam dokumen Rencana Anggaran Biaya (RAB), kontrak kerja, dan berita acara serah terima proyek.</p>
                    </div>
                </div>
            <?php else: ?>
                <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-gold-600">DOKUMEN PRIVASI</p>
                <h1 class="font-serif text-2xl sm:text-3xl font-semibold text-navy-900">Kebijakan Privasi</h1>
                <p class="text-xs sm:text-sm text-[#556275]">Penanganan informasi konsultasi teknis dan kontak resmi Dunia Pool &amp; Pond.</p>
                <div class="space-y-4 pt-2 text-sm text-[#4A5668] leading-relaxed">
                    <div>
                        <h2 class="font-bold text-navy-900 mb-1">1. Pengumpulan Informasi Konsultasi</h2>
                        <p>Situs web Dunia Pool &amp; Pond tidak menyimpan data pribadi pengunjung ke dalam basis data pelacakan otomatis. Seluruh informasi yang Anda isikan pada formulir konsultasi hanya diformat di peramban Anda untuk disalurkan langsung ke WhatsApp resmi kami (+62 821-1807-5560).</p>
                    </div>
                    <div>
                        <h2 class="font-bold text-navy-900 mb-1">2. Penggunaan Informasi Proyek</h2>
                        <p>Detail dimensi kolam, lokasi proyek, dan kebutuhan peralatan yang Anda kirimkan melalui WhatsApp digunakan secara eksklusif untuk keperluan analisis teknis sirkulasi kolam, penyusunan Rencana Anggaran Biaya (RAB), serta penjadwalan survei lapangan.</p>
                    </div>
                    <div>
                        <h2 class="font-bold text-navy-900 mb-1">3. Kerahasiaan Data Klien</h2>
                        <p>Kami menghormati privasi setiap klien dan tidak menjual, menyewakan, atau membagikan informasi kontak maupun dokumentasi properti pribadi kepada pihak ketiga di luar lingkup pengerjaan proyek yang disepakati.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php
require __DIR__ . '/../includes/footer.php';
