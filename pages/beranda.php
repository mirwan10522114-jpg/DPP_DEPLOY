<?php

declare(strict_types=1);

$pageTitle = 'Dunia Pool & Pond — The Pool Specialist Sejak 1997';
$activeNav = 'beranda';
$showPreFooterCta = true;

$allServices = get_all_services();
$projects = get_featured_projects();
$productCategories = get_product_categories();
$brands = get_brand_catalog();
$heroImg = resolve_image('images/hero/kolam-villa', resolve_image('images/hero/kolam-utama'));
$bannerCutoutImg = resolve_image('images/banner/tim-teknisi-cutout', resolve_image('images/banner/tim-teknisi'));
$bannerBgImg = resolve_image('images/layanan/01-desain-konsultasi');
$mapsBannerUrl = 'https://www.google.com/maps/place/Alat+Kolam+Renang+Bandung+Barat/data=!4m2!3m1!1s0x2e68e331a6058d93:0x6f8552486c06e786?sa=X&ved=1t:242&hl=id&ictx=111';

$stats = [
    [
        'icon'     => 'stat-building',
        'value'    => '27+ Thn',
        'label'    => 'Pengalaman Sejak - 1997',
        'label_en' => 'Experience Since Aug 10, 1997',
    ],
    [
        'icon'     => 'stat-team',
        'value'    => '8 Layanan',
        'label'    => 'Konstruksi, Sirkulasi & Perawatan',
        'label_en' => 'Construction, Filtration & Care',
    ],
    [
        'icon'     => 'stat-globe',
        'value'    => '11',
        'label'    => 'Kategori Peralatan & Kimia Air',
        'label_en' => 'Equipment & Chemical Categories',
    ],
    [
        'icon'     => 'stat-chart',
        'value'    => '15',
        'label'    => 'Merek Pengadaan Resmi Dunia',
        'label_en' => 'Official Global Equipment Brands',
    ],
];

$pillars = [
    [
        'icon'     => 'visi-target',
        'title'    => 'Sistem Sirkulasi & Filtrasi',
        'title_en' => 'Circulation & Filtration',
        'desc'     => 'Perhitungan jalur pipa PVC kelas AW, Total Dynamic Head (TDH), debit pompa, dan turnover rate 4–6 jam sesuai volume kolam.',
        'desc_en'  => 'Precision PVC AW piping, Total Dynamic Head (TDH), pump flow rate, and 4–6 hour turnover calculation tailored to pool volume.',
    ],
    [
        'icon'     => 'misi-eye',
        'title'    => 'Transparansi RAB',
        'title_en' => 'Transparent Budgeting',
        'desc'     => 'Rincian spesifikasi pekerjaan struktur, waterproofing, material finishing, dan merek mesin tercantum jelas tanpa biaya tersembunyi.',
        'desc_en'  => 'Detailed civil specs, waterproofing, finishing materials, and equipment brands stated clearly upfront with zero hidden costs.',
    ],
    [
        'icon'     => 'nilai-diamond',
        'title'    => 'Garansi & Purna Jual',
        'title_en' => 'Warranty & After-Sales',
        'desc'     => 'Dilengkapi uji tekan hydrostatic 2.5–3 bar, uji rendam 3×24 jam, berita acara serah terima, serta jaminan suku cadang resmi.',
        'desc_en'  => 'Backed by 2.5–3 bar hydrostatic pipe testing, 3×24h soak test, handover certification, and genuine spare parts support.',
    ],
];

require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/header.php';
?>

<main class="flex-grow" id="main-content">
    <!-- SECTION 1: HERO (FULL 1 LAYAR PENUH / 100SVH) -->
    <section class="relative overflow-hidden bg-navy-900 -mt-20 pt-20 min-h-[100svh] flex flex-col text-white">
        <!-- Background Pool Photograph + Multi-layer Directional Overlays -->
        <div aria-hidden="true" class="pointer-events-none absolute inset-0 z-0">
            <?php if ($heroImg !== ''): ?>
                <img
                    alt=""
                    class="w-full h-full object-cover object-right opacity-95"
                    fetchpriority="high"
                    src="<?= e($heroImg) ?>"
                />
            <?php endif; ?>
            <!-- Left-to-right readability gradient -->
            <div class="absolute inset-0" style="background: linear-gradient(90deg, #09182B 0%, rgba(9, 24, 43, 0.94) 40%, rgba(9, 24, 43, 0.56) 68%, rgba(9, 24, 43, 0.16) 100%);"></div>
            <!-- Top navbar blend & bottom stats grounding gradient -->
            <div class="absolute inset-0" style="background: linear-gradient(180deg, rgba(9, 24, 43, 0.74) 0%, rgba(9, 24, 43, 0.08) 24%, rgba(9, 24, 43, 0.22) 68%, rgba(9, 24, 43, 0.90) 92%, #09182B 100%);"></div>
        </div>

        <div class="w-full max-w-[1340px] mx-auto px-5 sm:px-8 lg:px-10 relative z-10 flex-1 flex flex-col justify-between py-8 sm:py-9 lg:py-10">
            <!-- Hero Main Copy (Vertically Centered in Upper Space) -->
            <div class="max-w-3xl lg:max-w-4xl xl:max-w-5xl my-auto py-2">
                <p
                    class="text-gold-400 text-sm sm:text-[15px] font-semibold tracking-wide mb-3"
                    data-i18n-en="The Pool Specialist — Build, Design, Maintenance &amp; Sales Since 1997"
                    data-i18n-id="The Pool Specialist — Build, Design, Maintenance &amp; Sales Sejak 1997"
                >
                    The Pool Specialist — Build, Design, Maintenance &amp; Sales Sejak 1997
                </p>
                <h1 class="font-serif font-semibold text-3xl sm:text-4xl md:text-5xl lg:text-[52px] xl:text-[56px] text-white leading-[1.14] tracking-tight">
                    <span class="sm:whitespace-nowrap inline-block" data-i18n-en="Professional Swimming Pool" data-i18n-id="Solusi Kolam Renang">Solusi Kolam Renang</span><br class="hidden sm:inline" />
                    <span class="sm:whitespace-nowrap inline-block"><span data-i18n-en="Engineering &amp; " data-i18n-id="Profesional &amp; ">Profesional &amp; </span><span class="text-gold-400" data-i18n-en="Solutions." data-i18n-id="Terpercaya.">Terpercaya.</span></span>
                </h1>
                <p
                    class="text-white/85 text-sm sm:text-[16px] leading-[1.68] mt-4 max-w-[620px]"
                    data-i18n-en="Dunia Pool &amp; Pond delivers circulation &amp; filtration engineering, swimming pool construction &amp; renovation, genuine equipment supply, and integrated pool water care in Padalarang, West Bandung."
                    data-i18n-id="Dunia Pool &amp; Pond melayani perencanaan sistem sirkulasi &amp; filtrasi, konstruksi &amp; renovasi kolam renang, pengadaan mesin orisinil, serta perawatan air terpadu di Padalarang, Bandung Barat."
                >
                    Dunia Pool &amp; Pond melayani perencanaan sistem sirkulasi &amp; filtrasi, konstruksi &amp; renovasi kolam renang, pengadaan mesin orisinil, serta perawatan air terpadu di Padalarang, Bandung Barat.
                </p>

                <!-- Dual Hero CTA -->
                <div class="mt-7 flex flex-wrap items-center gap-3.5 sm:gap-4">
                    <a
                        class="inline-flex items-center justify-center gap-2.5 bg-gold-400 hover:bg-gold-300 text-navy-950 font-semibold text-xs sm:text-[14px] px-6 sm:px-7 h-11 sm:h-12 rounded-md shadow-md transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-gold-300 focus:ring-offset-2 focus:ring-offset-navy-900"
                        href="<?= e(app_url('/kontak')) ?>"
                    >
                        <span data-i18n-en="Consult Your Pool" data-i18n-id="Konsultasi Proyek">Konsultasi Proyek</span>
                        <?= render_icon('arrow-right', 'w-4 h-4') ?>
                    </a>
                    <a
                        class="inline-flex items-center justify-center gap-3 bg-navy-900/55 hover:bg-white/10 border border-white/35 hover:border-gold-400/75 text-white font-medium text-xs sm:text-[14px] px-5 sm:px-6 h-11 sm:h-12 rounded-md backdrop-blur-sm transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-gold-400"
                        href="<?= e(app_url('/produk')) ?>"
                    >
                        <span data-i18n-en="Explore 11 Product Categories" data-i18n-id="Katalog 11 Kategori Produk">Katalog 11 Kategori Produk</span>
                        <?= render_icon('sec-properti', 'w-4 h-4 text-gold-400') ?>
                    </a>
                </div>
            </div>

            <!-- Hero Key Metrics Strip (Anchored Cleanly Above Bottom Viewport Edge) -->
            <div class="pt-5 grid grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-10 w-full max-w-5xl">
                <?php foreach ($stats as $st): ?>
                    <div class="flex items-start gap-3.5 sm:gap-4">
                        <div class="text-gold-400 shrink-0 mt-0.5">
                            <?= render_icon($st['icon'], 'w-9 h-9 sm:w-10 sm:h-10') ?>
                        </div>
                        <div>
                            <p class="text-white font-sans font-bold text-xl sm:text-2xl lg:text-[26px] leading-none tracking-tight">
                                <?= e($st['value']) ?>
                            </p>
                            <p
                                class="text-white/80 text-xs sm:text-[13px] leading-snug mt-1.5 max-w-[175px]"
                                data-i18n-en="<?= e($st['label_en']) ?>"
                                data-i18n-id="<?= e($st['label']) ?>"
                            >
                                <?= e($st['label']) ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- SECTION BANNER KONSULTASI LAHAN & BANNER LAYANAN DPP (SEBELUM PROFIL PERUSAHAAN) -->
    <section aria-label="Evaluasi Lahan dan Layanan Dunia Pool &amp; Pond" class="py-12 sm:py-16 bg-cream-50 border-b border-[#EFECE5] reveal-up">
        <div class="max-w-[1260px] mx-auto px-5 sm:px-8 lg:px-10 space-y-8">
            <!-- BANNER 1: Evaluasi Lahan & Tata Letak (Praktisi Lapangan) -->
            <div class="relative rounded-2xl overflow-hidden bg-navy-900 border border-navy-800 shadow-[0_22px_50px_-12px_rgba(9,24,43,0.38)]">
                <!-- Layer 1: Subtle Architectural Pool Blueprint Photo Texture + Deep Navy Gradient -->
                <div aria-hidden="true" class="pointer-events-none absolute inset-0 z-0">
                    <?php if ($bannerBgImg !== ''): ?>
                        <img alt="" class="w-full h-full object-cover opacity-[0.14] mix-blend-luminosity" loading="lazy" src="<?= e($bannerBgImg) ?>" />
                    <?php endif; ?>
                    <div class="absolute inset-0" style="background: linear-gradient(115deg, rgba(7, 19, 34, 0.96) 0%, rgba(9, 24, 43, 0.89) 48%, rgba(12, 31, 56, 0.94) 100%);"></div>
                </div>

                <!-- Layer 2: Dynamic Gold & Thin White Geometric Shapes -->
                <svg aria-hidden="true" class="pointer-events-none select-none absolute inset-0 w-full h-full z-0" preserveAspectRatio="xMidYMid slice" viewBox="0 0 1260 440" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient id="dppBannerGold" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#F0CB7E" />
                            <stop offset="55%" stop-color="#DFB465" />
                            <stop offset="100%" stop-color="#B8893A" />
                        </linearGradient>
                        <radialGradient id="dppGlowRight" cx="72%" cy="48%" r="42%">
                            <stop offset="0%" stop-color="#DFB465" stop-opacity="0.16" />
                            <stop offset="100%" stop-color="#09182B" stop-opacity="0" />
                        </radialGradient>
                    </defs>

                    <rect width="1260" height="440" fill="url(#dppGlowRight)" />
                    <path d="M490 0 C505 58, 558 78, 622 52 C668 33, 708 14, 748 0 Z" fill="url(#dppBannerGold)" />
                    <path d="M470 0 C488 74, 550 98, 630 66 C682 45, 725 20, 772 0" stroke="#FFFFFF" stroke-opacity="0.45" stroke-width="1.35" />
                    <path d="M0 352 L225 230 L275 440 L0 440 Z" fill="url(#dppBannerGold)" />
                    <circle cx="312" cy="278" r="142" fill="url(#dppBannerGold)" />
                    <line x1="0" y1="330" x2="202" y2="220" stroke="#FFFFFF" stroke-opacity="0.52" stroke-width="1.35" />
                    <path d="M192 174 A 156 156 0 0 1 466 312" stroke="#FFFFFF" stroke-opacity="0.48" stroke-width="1.35" />

                    <?php for ($r = 0; $r < 5; $r++): ?>
                        <?php for ($c = 0; $c < 5; $c++): ?>
                            <circle cx="<?= 36 + $c * 16 ?>" cy="<?= 184 + $r * 16 ?>" r="2.3" fill="#DFB465" fill-opacity="0.78" />
                        <?php endfor; ?>
                    <?php endfor; ?>

                    <?php for ($r = 0; $r < 6; $r++): ?>
                        <?php for ($c = $r; $c < 6; $c++): ?>
                            <circle cx="<?= 1146 + $c * 16 ?>" cy="<?= 26 + $r * 16 ?>" r="2.3" fill="#DFB465" fill-opacity="0.82" />
                        <?php endfor; ?>
                    <?php endfor; ?>

                    <line x1="765" y1="440" x2="1260" y2="252" stroke="#FFFFFF" stroke-opacity="0.38" stroke-width="1.35" />
                    <line x1="815" y1="440" x2="1260" y2="271" stroke="#DFB465" stroke-opacity="0.30" stroke-width="1" />
                </svg>

                <!-- Top-Left Social Follow Cluster -->
                <div class="hidden md:block absolute left-7 top-6 z-20">
                    <p
                        class="text-[10px] font-bold uppercase tracking-[0.2em] text-white/90 mb-2"
                        data-i18n-en="OFFICIAL CHANNELS"
                        data-i18n-id="SALURAN RESMI"
                    >
                        SALURAN RESMI
                    </p>
                    <div class="flex items-center gap-2">
                        <a aria-label="WhatsApp Resmi" class="w-8 h-8 rounded-full bg-gold-400 hover:bg-gold-300 text-navy-950 flex items-center justify-center shadow-sm transition-transform hover:scale-105" href="https://wa.me/6282118075560" rel="noopener noreferrer" target="_blank">
                            <?= render_icon('whatsapp-chat', 'w-4 h-4') ?>
                        </a>
                        <a aria-label="Instagram @duniapoolnpond" class="w-8 h-8 rounded-full bg-gold-400 hover:bg-gold-300 text-navy-950 flex items-center justify-center shadow-sm transition-transform hover:scale-105" href="https://www.instagram.com/duniapoolnpond/" rel="noopener noreferrer" target="_blank">
                            <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4H7.6m9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8 1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5 5 5 0 0 1-5 5 5 5 0 0 1-5-5 5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3 3 3 0 0 0 3 3 3 3 0 0 0 3-3 3 3 0 0 0-3-3Z" />
                            </svg>
                        </a>
                        <a aria-label="YouTube Dunia Pool &amp; Pond" class="w-8 h-8 rounded-full bg-gold-400 hover:bg-gold-300 text-navy-950 flex items-center justify-center shadow-sm transition-transform hover:scale-105" href="https://youtu.be/I52l1338954?si=0qZSMHI5d7VRCQGS" rel="noopener noreferrer" target="_blank">
                            <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M23.5 6.19a3.02 3.02 0 0 0-2.12-2.14C19.5 3.55 12 3.55 12 3.55s-7.5 0-9.38.5A3.02 3.02 0 0 0 .5 6.19C0 8.07 0 12 0 12s0 3.93.5 5.81a3.02 3.02 0 0 0 2.12 2.14c1.88.5 9.38.5 9.38.5s7.5 0 9.38-.5a3.02 3.02 0 0 0 2.12-2.14C24 15.93 24 12 24 12s0-3.93-.5-5.81ZM9.55 15.57V8.43L15.82 12l-6.27 3.57Z" />
                            </svg>
                        </a>
                        <a aria-label="Google Maps Dunia Pool &amp; Pond" class="w-8 h-8 rounded-full bg-gold-400 hover:bg-gold-300 text-navy-950 flex items-center justify-center shadow-sm transition-transform hover:scale-105" href="<?= e($mapsBannerUrl) ?>" rel="noopener noreferrer" target="_blank">
                            <svg aria-hidden="true" class="w-4 h-4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M12 21s-7-5.6-7-11a7 7 0 1 1 14 0c0 5.4-7 11-7 11Z" />
                                <circle cx="12" cy="10" r="2.5" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Layer 3: Main Foreground Grid (Cutout Engineer Left + Editorial Gold/White Copy Right) -->
                <div class="relative z-10 grid grid-cols-1 md:grid-cols-12 items-center">
                    <div class="md:col-span-5 relative self-end flex justify-center md:justify-end pt-4 md:pt-2 px-4 md:pl-8 md:pr-1 order-2 md:order-1">
                        <?php if ($bannerCutoutImg !== ''): ?>
                            <img
                                alt="Spesialis Konstruksi &amp; Konsultasi Lahan Dunia Pool &amp; Pond"
                                class="relative z-10 w-[265px] sm:w-[310px] lg:w-[352px] h-auto object-contain object-bottom select-none"
                                loading="lazy"
                                src="<?= e($bannerCutoutImg) ?>"
                                style="filter: drop-shadow(0 0 10px rgba(3, 9, 18, 0.85)) drop-shadow(0 10px 24px rgba(3, 9, 18, 0.72)) drop-shadow(-6px 6px 16px rgba(3, 9, 18, 0.50));"
                            />
                            <div aria-hidden="true" class="pointer-events-none absolute inset-x-0 bottom-0 h-10 bg-gradient-to-t from-[#071322]/55 via-[#071322]/15 to-transparent z-20"></div>
                        <?php endif; ?>
                    </div>

                    <div class="md:col-span-7 p-7 sm:p-10 lg:py-11 lg:pl-8 lg:pr-12 space-y-4 order-1 md:order-2">
                        <div>
                            <span
                                class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-gold-400/15 border border-gold-400/45 text-[11px] font-bold uppercase tracking-[0.16em] text-gold-300"
                                data-i18n-en="SITE &amp; LAYOUT EVALUATION"
                                data-i18n-id="EVALUASI LAHAN &amp; TATA LETAK"
                            >
                                EVALUASI LAHAN &amp; TATA LETAK
                            </span>
                        </div>

                        <h2 class="leading-[1.15] tracking-tight">
                            <span
                                class="block font-serif font-medium text-xl sm:text-2xl lg:text-[27px] text-white/95"
                                data-i18n-en="Optimize Your Property &amp; Transform"
                                data-i18n-id="Optimalkan Luasan Pekarangan Anda"
                            >
                                Optimalkan Luasan Pekarangan Anda
                            </span>
                            <span
                                class="block font-sans font-extrabold uppercase text-2xl sm:text-3xl lg:text-[36px] text-gold-400 tracking-tight mt-1"
                                data-i18n-en="INTO A FUNCTIONAL POOL"
                                data-i18n-id="MENJADI KOLAM RENANG"
                            >
                                MENJADI KOLAM RENANG
                            </span>
                            <span
                                class="block font-serif italic font-semibold text-lg sm:text-xl lg:text-[23px] text-white/90 mt-0.5"
                                data-i18n-en="Engineered with Precision Since 1997"
                                data-i18n-id="Fungsional, Estetis &amp; Bebas Bocor"
                            >
                                Fungsional, Estetis &amp; Bebas Bocor
                            </span>
                        </h2>

                        <p
                            class="text-white/80 text-xs sm:text-[13.5px] leading-relaxed max-w-xl"
                            data-i18n-en="Whether a compact plunge pool on limited space or a spacious perimeter overflow design, our team maps out pool dimensions, pump room placement, and a realistic budget before construction begins."
                            data-i18n-id="Baik lahan terbatas untuk plunge pool minimalis maupun pekarangan luas berkonsep overflow, tim kami membantu memetakan dimensi kolam, posisi ruang mesin, dan estimasi anggaran yang realistis sebelum konstruksi dimulai."
                        >
                            Baik lahan terbatas untuk plunge pool minimalis maupun pekarangan luas berkonsep overflow, tim kami membantu memetakan dimensi kolam, posisi ruang mesin, dan estimasi anggaran yang realistis sebelum konstruksi dimulai.
                        </p>

                        <div class="pt-3 flex flex-col sm:flex-row sm:items-end justify-between gap-5">
                            <a
                                class="group inline-flex items-center gap-3 bg-gold-400 hover:bg-gold-300 text-navy-950 font-bold text-xs sm:text-[13px] uppercase tracking-wider h-12 pl-2 pr-6 rounded-full shadow-lg transition-all duration-200 self-start focus:outline-none focus:ring-2 focus:ring-gold-300 focus:ring-offset-2 focus:ring-offset-navy-900"
                                href="<?= e(dpp_wa_url('Halo Dunia Pool & Pond, saya ingin berkonsultasi rancangan kolam renang untuk lahan saya.')) ?>"
                                rel="noopener noreferrer"
                                target="_blank"
                            >
                                <span class="w-8 h-8 rounded-full bg-white text-navy-950 flex items-center justify-center shadow-sm group-hover:translate-x-0.5 transition-transform shrink-0">
                                    <?= render_icon('arrow-right', 'w-4 h-4') ?>
                                </span>
                                <span data-i18n-en="Discuss Site Layout" data-i18n-id="Diskusikan Rancangan Lahan">Diskusikan Rancangan Lahan</span>
                            </a>

                            <div class="sm:text-right">
                                <a class="block font-sans font-extrabold text-lg sm:text-[21px] text-gold-400 hover:text-gold-300 tracking-wide leading-none transition-colors" href="https://wa.me/6282118075560" rel="noopener noreferrer" target="_blank">
                                    0821-1807-5560
                                </a>
                                <span
                                    class="block text-[10.5px] font-semibold uppercase tracking-[0.15em] text-white/80 mt-1"
                                    data-i18n-en="DIRECT WHATSAPP CONSULTATION"
                                    data-i18n-id="KONSULTASI WHATSAPP LANGSUNG"
                                >
                                    KONSULTASI WHATSAPP LANGSUNG
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BANNER 2: Kartu Profil Layanan, Alamat Kantor & Kontak Agus Setiawan (Tema Navy & Emas) -->
            <div class="relative rounded-2xl overflow-hidden bg-navy-900 border border-navy-800 shadow-[0_22px_50px_-12px_rgba(9,24,43,0.38)]">
                <!-- Layer 1: Subtle Architectural Pool Blueprint Photo Texture + Deep Navy Gradient -->
                <div aria-hidden="true" class="pointer-events-none absolute inset-0 z-0">
                    <?php if ($bannerBgImg !== ''): ?>
                        <img alt="" class="w-full h-full object-cover opacity-[0.14] mix-blend-luminosity" loading="lazy" src="<?= e($bannerBgImg) ?>" />
                    <?php endif; ?>
                    <div class="absolute inset-0" style="background: linear-gradient(115deg, rgba(7, 19, 34, 0.96) 0%, rgba(9, 24, 43, 0.89) 48%, rgba(12, 31, 56, 0.94) 100%);"></div>
                </div>

                <!-- Layer 2: Dynamic Gold & Thin White Geometric Shapes (Centered Composition) -->
                <svg aria-hidden="true" class="pointer-events-none select-none absolute inset-0 w-full h-full z-0" preserveAspectRatio="xMidYMid slice" viewBox="0 0 1260 520" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient id="dppBannerGold2" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#F0CB7E" />
                            <stop offset="55%" stop-color="#DFB465" />
                            <stop offset="100%" stop-color="#B8893A" />
                        </linearGradient>
                        <radialGradient id="dppGlowCenter2" cx="50%" cy="22%" r="44%">
                            <stop offset="0%" stop-color="#DFB465" stop-opacity="0.16" />
                            <stop offset="100%" stop-color="#09182B" stop-opacity="0" />
                        </radialGradient>
                    </defs>

                    <rect width="1260" height="520" fill="url(#dppGlowCenter2)" />
                    <!-- Top-Left & Bottom-Left Restrained Gold Corner Accents -->
                    <path d="M0 0 L215 0 C172 48, 102 72, 0 88 Z" fill="url(#dppBannerGold2)" fill-opacity="0.22" />
                    <path d="M0 438 L185 362 L225 520 L0 520 Z" fill="url(#dppBannerGold2)" fill-opacity="0.65" />
                    <line x1="0" y1="418" x2="170" y2="348" stroke="#FFFFFF" stroke-opacity="0.38" stroke-width="1.25" />

                    <!-- Left Vertical Dot Matrix -->
                    <?php for ($r = 0; $r < 5; $r++): ?>
                        <?php for ($c = 0; $c < 4; $c++): ?>
                            <circle cx="<?= 32 + $c * 16 ?>" cy="<?= 175 + $r * 16 ?>" r="2.2" fill="#DFB465" fill-opacity="0.72" />
                        <?php endfor; ?>
                    <?php endfor; ?>

                    <!-- Top-Right Corner Triangular Gold Dot Matrix -->
                    <?php for ($r = 0; $r < 6; $r++): ?>
                        <?php for ($c = $r; $c < 6; $c++): ?>
                            <circle cx="<?= 1146 + $c * 16 ?>" cy="<?= 26 + $r * 16 ?>" r="2.2" fill="#DFB465" fill-opacity="0.80" />
                        <?php endfor; ?>
                    <?php endfor; ?>

                    <!-- Bottom-Right Architectural Diagonal Framing Lines -->
                    <line x1="820" y1="520" x2="1260" y2="342" stroke="#FFFFFF" stroke-opacity="0.35" stroke-width="1.3" />
                    <line x1="868" y1="520" x2="1260" y2="362" stroke="#DFB465" stroke-opacity="0.28" stroke-width="1" />
                </svg>

                <!-- Top-Left Official Channels (Desktop) -->
                <div class="hidden lg:block absolute left-8 top-7 z-20">
                    <p
                        class="text-[10px] font-bold uppercase tracking-[0.2em] text-white/85 mb-2"
                        data-i18n-en="OFFICIAL CHANNELS"
                        data-i18n-id="SALURAN RESMI"
                    >
                        SALURAN RESMI
                    </p>
                    <div class="flex items-center gap-2">
                        <a aria-label="WhatsApp Resmi" class="w-8 h-8 rounded-full bg-gold-400 hover:bg-gold-300 text-navy-950 flex items-center justify-center shadow-sm transition-transform hover:scale-105" href="https://wa.me/6282118075560" rel="noopener noreferrer" target="_blank">
                            <?= render_icon('whatsapp-chat', 'w-4 h-4') ?>
                        </a>
                        <a aria-label="Instagram @duniapoolnpond" class="w-8 h-8 rounded-full bg-gold-400 hover:bg-gold-300 text-navy-950 flex items-center justify-center shadow-sm transition-transform hover:scale-105" href="https://www.instagram.com/duniapoolnpond/" rel="noopener noreferrer" target="_blank">
                            <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4H7.6m9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8 1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5 5 5 0 0 1-5 5 5 5 0 0 1-5-5 5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3 3 3 0 0 0 3 3 3 3 0 0 0 3-3 3 3 0 0 0-3-3Z" />
                            </svg>
                        </a>
                        <a aria-label="YouTube Dunia Pool &amp; Pond" class="w-8 h-8 rounded-full bg-gold-400 hover:bg-gold-300 text-navy-950 flex items-center justify-center shadow-sm transition-transform hover:scale-105" href="https://youtu.be/I52l1338954?si=0qZSMHI5d7VRCQGS" rel="noopener noreferrer" target="_blank">
                            <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M23.5 6.19a3.02 3.02 0 0 0-2.12-2.14C19.5 3.55 12 3.55 12 3.55s-7.5 0-9.38.5A3.02 3.02 0 0 0 .5 6.19C0 8.07 0 12 0 12s0 3.93.5 5.81a3.02 3.02 0 0 0 2.12 2.14c1.88.5 9.38.5 9.38.5s7.5 0 9.38-.5a3.02 3.02 0 0 0 2.12-2.14C24 15.93 24 12 24 12s0-3.93-.5-5.81ZM9.55 15.57V8.43L15.82 12l-6.27 3.57Z" />
                            </svg>
                        </a>
                        <a aria-label="Google Maps Dunia Pool &amp; Pond" class="w-8 h-8 rounded-full bg-gold-400 hover:bg-gold-300 text-navy-950 flex items-center justify-center shadow-sm transition-transform hover:scale-105" href="<?= e($mapsBannerUrl) ?>" rel="noopener noreferrer" target="_blank">
                            <svg aria-hidden="true" class="w-4 h-4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M12 21s-7-5.6-7-11a7 7 0 1 1 14 0c0 5.4-7 11-7 11Z" />
                                <circle cx="12" cy="10" r="2.5" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Layer 3: Centered Logo Top + 8 Services Below + Clean Bottom Address & Contact Row -->
                <div class="relative z-10 p-7 sm:p-10 lg:px-12 lg:py-10 flex flex-col items-center space-y-7">
                    <!-- Top-Center: Transparent Official DPP Logo + Wordmark -->
                    <div class="flex flex-col items-center text-center">
                        <img
                            alt="Logo Resmi Dunia Pool &amp; Pond — The Pool Specialist"
                            class="w-[165px] sm:w-[195px] h-auto object-contain select-none"
                            loading="lazy"
                            src="<?= e(resolve_image('images/brand/logo-dpp', app_url('/images/brand/logo-dpp.png'))) ?>"
                            style="filter: drop-shadow(0 6px 18px rgba(4, 12, 24, 0.72)) drop-shadow(0 0 1px rgba(255, 255, 255, 0.35));"
                        />
                        <span class="font-sans font-extrabold text-xl sm:text-2xl lg:text-[26px] text-white tracking-[0.08em] uppercase leading-none mt-3" style="text-shadow: 0 2px 10px rgba(4, 12, 24, 0.85);">
                            DUNIA POOL &amp; POND
                        </span>
                        <span class="font-serif italic font-bold text-base sm:text-lg text-gold-300 leading-tight mt-1" style="text-shadow: 0 2px 8px rgba(4, 12, 24, 0.85);">
                            The Pool Specialist
                        </span>
                        <span class="font-serif font-semibold text-xs sm:text-[13px] text-white/90 tracking-wide mt-0.5" style="text-shadow: 0 1px 6px rgba(4, 12, 24, 0.85);">
                            Build, Design, Maintenance &amp; Sales
                        </span>
                        <span
                            class="mt-4 inline-flex items-center gap-2 px-4 py-1 rounded-full bg-gold-400/15 border border-gold-400/45 text-[10.5px] font-bold uppercase tracking-[0.16em] text-gold-300"
                            data-i18n-en="8 INTEGRATED POOL SERVICES"
                            data-i18n-id="8 LAYANAN TERPADU KAMI"
                        >
                            8 LAYANAN TERPADU KAMI
                        </span>
                    </div>

                    <!-- Middle: 8 Official Services Below Logo (Symmetrical 4x2 Grid) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 w-full">
                        <?php foreach (get_all_services() as $bSvc): ?>
                            <a
                                class="group flex items-center gap-3 px-4 py-3 rounded-xl bg-navy-950/75 hover:bg-gold-400 text-white hover:text-navy-950 border border-gold-400/35 hover:border-gold-300 shadow-sm transition-all duration-150 text-left"
                                href="<?= e(app_url('/layanan#' . $bSvc['slug'])) ?>"
                            >
                                <span class="w-6 h-6 rounded-md bg-gold-400/20 group-hover:bg-navy-950/15 text-gold-400 group-hover:text-navy-950 font-sans font-extrabold text-[11px] flex items-center justify-center shrink-0">
                                    <?= e($bSvc['num']) ?>
                                </span>
                                <span
                                    class="font-sans font-bold text-xs sm:text-[12.5px] tracking-wide uppercase leading-snug"
                                    data-i18n-en="<?= e($bSvc['title_en']) ?>"
                                    data-i18n-id="<?= e($bSvc['title']) ?>"
                                >
                                    <?= e($bSvc['title']) ?>
                                </span>
                            </a>
                        <?php endforeach; ?>
                    </div>

                    <!-- Bottom Row: Office Address (Left) + AGUS SETIAWAN & WhatsApp 0821 1807 5560 (Right) -->
                    <div class="w-full pt-5 border-t border-white/15 flex flex-col md:flex-row md:items-center justify-between gap-6">
                        <div class="bg-navy-950/80 backdrop-blur-md border border-gold-400/40 rounded-xl px-4 py-3.5 shadow-lg">
                            <div class="inline-block bg-gold-400 text-navy-950 font-extrabold text-[10.5px] uppercase tracking-wider px-3.5 py-1 rounded-sm mb-2 shadow-xs" style="clip-path: polygon(0 0, 92% 0, 100% 100%, 0% 100%); padding-right: 1.25rem;">
                                <span data-i18n-en="Office Address :" data-i18n-id="Office Address :">Office Address :</span>
                            </div>
                            <p class="font-sans font-extrabold text-xs sm:text-[13px] text-white leading-snug tracking-wide uppercase">
                                Gg. Karya Bakti No. 24, RT.05/RW.22, Kertamulya,<br />
                                Kec. Padalarang, Bandung, Jawa Barat 40553
                            </p>
                        </div>

                        <div class="flex flex-col md:items-end shrink-0">
                            <p class="font-sans font-extrabold text-base sm:text-lg lg:text-xl text-gold-400 tracking-[0.14em] uppercase">
                                AGUS SETIAWAN
                            </p>
                            <a
                                class="mt-2 group inline-flex items-center gap-3 bg-navy-950/80 hover:bg-gold-400 text-white hover:text-navy-950 border border-gold-400/60 px-5 py-2.5 rounded-full shadow-lg transition-all duration-200"
                                href="<?= e(dpp_wa_url('Halo Pak Agus Setiawan (Dunia Pool & Pond), saya ingin berkonsultasi mengenai kebutuhan kolam renang.')) ?>"
                                rel="noopener noreferrer"
                                target="_blank"
                            >
                                <span class="w-9 h-9 rounded-full bg-[#25D366] text-white flex items-center justify-center shadow-md shrink-0 group-hover:scale-105 transition-transform">
                                    <?= render_icon('whatsapp-chat', 'w-5 h-5') ?>
                                </span>
                                <span class="font-sans font-extrabold text-xl sm:text-2xl lg:text-[26px] tracking-wider leading-none">
                                    0821 1807 5560
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2: TENTANG KAMI (3 PILAR KOMITMEN TEKNIS) -->
    <section class="py-16 sm:py-20 bg-white reveal-up" id="tentang-kami">
        <div class="max-w-[1260px] mx-auto px-5 sm:px-8 lg:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-8 items-center">
                <!-- Left Intro Column -->
                <div class="lg:col-span-4 pr-0 lg:pr-4">
                    <p
                        class="text-[11px] font-bold uppercase tracking-[0.16em] text-gold-600"
                        data-i18n-en="COMPANY PROFILE"
                        data-i18n-id="PROFIL PERUSAHAAN"
                    >
                        PROFIL PERUSAHAAN
                    </p>
                    <h2
                        class="font-serif font-semibold text-2xl sm:text-3xl lg:text-[32px] text-navy-900 leading-[1.22] mt-2"
                        data-i18n-en="One Specialist for Every Pool Requirement"
                        data-i18n-id="Satu Spesialis untuk Berbagai Kebutuhan Kolam"
                    >
                        Satu Spesialis untuk Berbagai Kebutuhan Kolam
                    </h2>
                    <p
                        class="text-[#556275] text-xs sm:text-[13.5px] leading-relaxed mt-4"
                        data-i18n-en="Founded on August 10, 1997 in Padalarang, West Bandung Regency, Dunia Pool &amp; Pond handles planning, construction, circulation &amp; filtration systems, genuine equipment procurement, routine care, and after-sales support."
                        data-i18n-id="Berdiri pada 10 Agustus 1997 di Padalarang, Kabupaten Bandung Barat, Dunia Pool &amp; Pond menangani perencanaan, konstruksi, sistem sirkulasi &amp; filtrasi, pengadaan peralatan, perawatan berkala, serta dukungan purna jual."
                    >
                        Berdiri pada 10 Agustus 1997 di Padalarang, Kabupaten Bandung Barat, Dunia Pool &amp; Pond menangani perencanaan, konstruksi, sistem sirkulasi &amp; filtrasi, pengadaan peralatan, perawatan berkala, serta dukungan purna jual.
                    </p>
                    <div class="mt-6">
                        <a
                            class="inline-flex items-center justify-center gap-2.5 bg-navy-900 hover:bg-navy-700 text-white font-semibold text-xs px-5 h-10 rounded-md shadow-sm transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-navy-900 focus:ring-offset-2"
                            href="<?= e(app_url('/tentang-kami')) ?>"
                        >
                            <span data-i18n-en="Learn More" data-i18n-id="Selengkapnya">Selengkapnya</span>
                            <?= render_icon('arrow-right', 'w-4 h-4') ?>
                        </a>
                    </div>
                </div>

                <!-- Right 3 Value Cards -->
                <div class="lg:col-span-8 grid grid-cols-1 sm:grid-cols-3 gap-5">
                    <?php foreach ($pillars as $pil): ?>
                        <article class="bg-white border border-[#EFECE5] rounded-xl px-5 py-7 text-center shadow-card-soft hover:shadow-card-hover hover:-translate-y-0.5 transition-all duration-200 flex flex-col items-center">
                            <div class="w-14 h-14 rounded-full bg-[#FCF9F2] border border-[#EADAB8] flex items-center justify-center text-gold-600 mb-4">
                                <?= render_icon($pil['icon'], 'w-6 h-6') ?>
                            </div>
                            <h3
                                class="font-serif font-bold text-lg text-navy-900 mb-2.5"
                                data-i18n-en="<?= e($pil['title_en']) ?>"
                                data-i18n-id="<?= e($pil['title']) ?>"
                            >
                                <?= e($pil['title']) ?>
                            </h3>
                            <p
                                class="text-xs leading-relaxed text-[#556275]"
                                data-i18n-en="<?= e($pil['desc_en']) ?>"
                                data-i18n-id="<?= e($pil['desc']) ?>"
                            >
                                <?= e($pil['desc']) ?>
                            </p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: LINGKUP LAYANAN & SPESIALISASI KAMI (8 KARTU LENGKAP DARK NAVY) -->
    <section class="py-16 sm:py-20 bg-cream-50 border-t border-b border-[#F0ECE2] reveal-up" id="layanan-kami">
        <div class="max-w-[1260px] mx-auto px-5 sm:px-8 lg:px-10">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
                <div>
                    <p
                        class="text-[11px] font-bold uppercase tracking-[0.16em] text-gold-600"
                        data-i18n-en="SCOPE OF SERVICES"
                        data-i18n-id="LINGKUP LAYANAN KAMI"
                    >
                        LINGKUP LAYANAN KAMI
                    </p>
                    <h2
                        class="font-serif font-semibold text-2xl sm:text-3xl lg:text-[32px] text-navy-900 leading-tight mt-1.5"
                        data-i18n-en="All 8 Integrated Services. One Engineering Standard."
                        data-i18n-id="8 Layanan Terpadu untuk Setiap Tahap Kolam Anda."
                    >
                        8 Layanan Terpadu untuk Setiap Tahap Kolam Anda.
                    </h2>
                </div>
                <a
                    class="inline-flex items-center gap-2 text-xs font-bold text-navy-900 hover:text-gold-600 transition-colors self-start sm:self-auto shrink-0"
                    href="<?= e(app_url('/layanan')) ?>"
                >
                    <span data-i18n-en="View Full Service Specifications" data-i18n-id="Lihat Detail Lengkap Layanan">Lihat Detail Lengkap Layanan</span>
                    <?= render_icon('arrow-right', 'w-4 h-4') ?>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 lg:gap-6">
                <?php foreach ($allServices as $svc): ?>
                    <article class="group rounded-2xl overflow-hidden bg-[#0B1C31] shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-200 flex flex-col">
                        <!-- Top Service Photograph -->
                        <div class="relative h-44 sm:h-48 w-full overflow-hidden bg-navy-800">
                            <?php if ($svc['img'] !== ''): ?>
                                <img
                                    alt="<?= e($svc['title']) ?>"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    loading="lazy"
                                    src="<?= e($svc['img']) ?>"
                                />
                            <?php endif; ?>
                            <span class="absolute top-3 left-3 inline-flex items-center justify-center px-2.5 py-0.5 rounded-md bg-navy-950/85 border border-gold-400/40 text-[11px] font-extrabold text-gold-400 tracking-wider backdrop-blur-xs">
                                <?= e($svc['num']) ?>
                            </span>
                            <div aria-hidden="true" class="absolute inset-0 bg-gradient-to-t from-[#0B1C31]/55 via-transparent to-transparent"></div>
                        </div>

                        <!-- Overlapping White Circular Sector Icon -->
                        <div class="-mt-6 ml-5 w-11 h-11 rounded-full bg-white border border-[#EAE5DC] shadow-md flex items-center justify-center text-navy-900 relative z-10 shrink-0">
                            <?= render_icon($svc['icon'], 'w-5 h-5') ?>
                        </div>

                        <!-- Dark Navy Card Body -->
                        <div class="px-5 pt-3.5 pb-5 flex-1 flex flex-col justify-between">
                            <div>
                                <h3
                                    class="text-[15.5px] font-bold text-white leading-snug"
                                    data-i18n-en="<?= e($svc['title_en']) ?>"
                                    data-i18n-id="<?= e($svc['title']) ?>"
                                >
                                    <?= e($svc['title']) ?>
                                </h3>
                                <p
                                    class="text-xs text-white/75 leading-relaxed mt-2 mb-4 line-clamp-3"
                                    data-i18n-en="<?= e($svc['desc_en']) ?>"
                                    data-i18n-id="<?= e($svc['desc']) ?>"
                                >
                                    <?= e($svc['desc']) ?>
                                </p>
                            </div>
                            <a
                                class="inline-flex items-center gap-2 text-xs font-semibold text-gold-400 group-hover:text-gold-300 transition-colors focus:outline-none focus-visible:underline"
                                href="<?= e(app_url('/layanan#' . $svc['slug'])) ?>"
                            >
                                <span data-i18n-en="View Service" data-i18n-id="Lihat Layanan">Lihat Layanan</span>
                                <?= render_icon('arrow-right', 'w-4 h-4 text-white/85 group-hover:translate-x-0.5 transition-transform') ?>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- SECTION 4: DOKUMENTASI PROYEK PILIHAN -->
    <section class="py-16 sm:py-20 bg-white reveal-up" id="proyek">
        <div class="max-w-[1260px] mx-auto px-5 sm:px-8 lg:px-10">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-9">
                <div>
                    <p
                        class="text-[11px] font-bold uppercase tracking-[0.16em] text-gold-600"
                        data-i18n-en="DOCUMENTED PORTFOLIO"
                        data-i18n-id="PORTOFOLIO PROYEK"
                    >
                        PORTOFOLIO PROYEK
                    </p>
                    <h2
                        class="font-serif font-semibold text-2xl sm:text-3xl lg:text-[31px] text-navy-900 leading-tight mt-1.5"
                        data-i18n-en="Representative Pool Construction &amp; Renovation Projects"
                        data-i18n-id="Dokumentasi Pekerjaan Konstruksi, Renovasi &amp; Ruang Mesin"
                    >
                        Dokumentasi Pekerjaan Konstruksi, Renovasi &amp; Ruang Mesin
                    </h2>
                </div>
                <a
                    class="inline-flex items-center gap-2 text-xs font-bold text-navy-900 hover:text-gold-600 transition-colors self-start sm:self-auto shrink-0"
                    href="<?= e(app_url('/proyek')) ?>"
                >
                    <span data-i18n-en="View Projects &amp; 3D Video" data-i18n-id="Lihat Proyek &amp; Video 3D">Lihat Proyek &amp; Video 3D</span>
                    <?= render_icon('arrow-right', 'w-4 h-4') ?>
                </a>
            </div>

            <?php
            $totalProjectsCount = count($projects);
            $homeProjects = array_slice($projects, 0, 6);
            ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-7 gap-y-8">
                <?php foreach ($homeProjects as $proj): ?>
                    <article class="group flex items-start gap-4">
                        <a
                            aria-label="<?= e($proj['title']) ?>"
                            class="w-28 h-28 sm:w-[128px] sm:h-[128px] rounded-xl overflow-hidden shrink-0 <?= ($proj['img_fit'] ?? 'cover') === 'contain' ? 'bg-white border border-[#EAE5DC] p-1.5' : 'bg-navy-900/5' ?> shadow-sm block focus:outline-none focus:ring-2 focus:ring-gold-500"
                            href="<?= e(app_url('/proyek#' . $proj['slug'])) ?>"
                        >
                            <?php if ($proj['img'] !== ''): ?>
                                <img
                                    alt="<?= e($proj['title']) ?>"
                                    class="w-full h-full <?= ($proj['img_fit'] ?? 'cover') === 'contain' ? 'object-contain' : (($proj['img_fit'] ?? 'cover') === 'full' ? 'object-cover object-bottom' : 'object-cover') ?> group-hover:scale-105 transition-transform duration-300"
                                    loading="lazy"
                                    src="<?= e($proj['img']) ?>"
                                />
                            <?php endif; ?>
                        </a>
                        <div class="min-w-0 flex-1">
                            <span class="block text-[11px] font-semibold text-gold-600 mb-1">
                                <?php if (!empty($proj['location'])): ?><?= e($proj['location']) ?> • <?php endif; ?><span data-i18n-en="<?= e($proj['badge_en']) ?>" data-i18n-id="<?= e($proj['badge']) ?>"><?= e($proj['badge']) ?></span>
                            </span>
                            <h3 class="text-[13.5px] font-bold text-navy-900 group-hover:text-gold-600 leading-snug line-clamp-2 transition-colors">
                                <a
                                    data-i18n-en="<?= e($proj['title_en']) ?>"
                                    data-i18n-id="<?= e($proj['title']) ?>"
                                    href="<?= e(app_url('/proyek#' . $proj['slug'])) ?>"
                                >
                                    <?= e($proj['title']) ?>
                                </a>
                            </h3>
                            <p
                                class="text-[12px] text-[#5D697A] leading-relaxed mt-1.5 mb-2.5 line-clamp-2"
                                data-i18n-en="<?= e($proj['excerpt_en']) ?>"
                                data-i18n-id="<?= e($proj['excerpt']) ?>"
                            >
                                <?= e($proj['excerpt']) ?>
                            </p>
                            <a
                                class="inline-flex items-center gap-1.5 text-[11.5px] font-bold text-navy-900 group-hover:text-gold-600 transition-colors"
                                href="<?= e(app_url('/proyek#' . $proj['slug'])) ?>"
                            >
                                <span data-i18n-en="Project Details" data-i18n-id="Lihat Dokumentasi">Lihat Dokumentasi</span>
                                <?= render_icon('arrow-right', 'w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform') ?>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <div class="mt-10 pt-2 flex flex-col items-center justify-center gap-3 text-center">
                <a
                    class="inline-flex items-center justify-center gap-2.5 px-7 py-3.5 rounded-full bg-navy-900 hover:bg-navy-800 text-white text-sm font-bold shadow-md hover:shadow-lg border border-gold-400/40 transition-all duration-200 group"
                    href="<?= e(app_url('/proyek')) ?>"
                >
                    <span data-i18n-en="View All Documentation" data-i18n-id="Lihat Semua Dokumentasi">Lihat Semua Dokumentasi</span>
                    <span class="px-2 py-0.5 rounded-full bg-gold-400/20 text-gold-300 text-xs font-extrabold"><?= $totalProjectsCount ?></span>
                    <?= render_icon('arrow-right', 'w-4 h-4 text-gold-400 group-hover:translate-x-0.5 transition-transform') ?>
                </a>
                <p
                    class="text-xs text-[#64748B]"
                    data-i18n-en="Showing 6 of <?= $totalProjectsCount ?> documented pool construction, renovation &amp; maintenance projects"
                    data-i18n-id="Menampilkan 6 dari <?= $totalProjectsCount ?> dokumentasi proyek konstruksi, renovasi &amp; perawatan kolam"
                >
                    Menampilkan 6 dari <?= $totalProjectsCount ?> dokumentasi proyek konstruksi, renovasi &amp; perawatan kolam
                </p>
            </div>
        </div>
    </section>

    <!-- SECTION 5: KATALOG UNGGULAN & 15 MEREK PENGADAAN RESMI -->
    <section class="py-16 sm:py-20 bg-cream-50 border-t border-[#F0ECE2] reveal-up" id="katalog-produk">
        <div class="max-w-[1260px] mx-auto px-5 sm:px-8 lg:px-10 space-y-12">
            <!-- Featured Product Categories -->
            <div>
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
                    <div>
                        <p
                            class="text-[11px] font-bold uppercase tracking-[0.16em] text-gold-600"
                            data-i18n-en="EQUIPMENT &amp; CHEMICAL SUPPLY"
                            data-i18n-id="PENGADAAN PERALATAN &amp; KIMIA"
                        >
                            PENGADAAN PERALATAN &amp; KIMIA
                        </p>
                        <h2
                            class="font-serif font-semibold text-2xl sm:text-3xl lg:text-[31px] text-navy-900 leading-tight mt-1.5"
                            data-i18n-en="Complete Pool Equipment, Chemicals &amp; Spare Parts"
                            data-i18n-id="Peralatan Orisinil untuk Melengkapi Sistem Kolam Anda"
                        >
                            Peralatan Orisinil untuk Melengkapi Sistem Kolam Anda
                        </h2>
                    </div>
                    <a
                        class="inline-flex items-center gap-2 text-xs font-bold text-navy-900 hover:text-gold-600 transition-colors self-start sm:self-auto shrink-0"
                        href="<?= e(app_url('/produk')) ?>"
                    >
                        <span data-i18n-en="Open All 11 Product Categories" data-i18n-id="Buka Semua 11 Kategori Produk">Buka Semua 11 Kategori Produk</span>
                        <?= render_icon('arrow-right', 'w-4 h-4') ?>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($productCategories as $cat): ?>
                        <a class="group bg-white border border-[#EAE5DC] hover:border-gold-400 rounded-2xl overflow-hidden shadow-card-soft hover:shadow-card-hover hover:-translate-y-0.5 transition-all duration-200 flex flex-col" href="<?= e($cat['href']) ?>">
                            <div class="relative w-full aspect-[4/3] bg-white border-b border-[#F0ECE2] p-4 flex items-center justify-center overflow-hidden">
                                <img
                                    alt="<?= e($cat['name_id']) ?>"
                                    class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300"
                                    loading="lazy"
                                    src="<?= e($cat['img']) ?>"
                                />
                                <span class="absolute top-3 left-3 inline-flex items-center gap-1.5 bg-navy-900 text-white px-2.5 py-1 rounded-md text-[11px] font-semibold shadow-sm">
                                    <span class="text-gold-400 font-bold"><?= e($cat['num']) ?></span>
                                    <span data-i18n-en="<?= e($cat['name_en']) ?>" data-i18n-id="<?= e($cat['name_id']) ?>"><?= e($cat['name_id']) ?></span>
                                </span>
                            </div>
                            <div class="p-5 sm:p-6 flex-1 flex flex-col justify-between">
                                <div>
                                    <p class="text-[10.5px] font-bold uppercase tracking-[0.14em] text-gold-600" data-i18n-en="Category <?= e($cat['num']) ?>" data-i18n-id="Kategori <?= e($cat['num']) ?>">Kategori <?= e($cat['num']) ?></p>
                                    <h3 class="font-serif text-lg font-bold text-navy-900 group-hover:text-gold-600 transition-colors mt-1 leading-snug" data-i18n-en="<?= e($cat['name_en']) ?>" data-i18n-id="<?= e($cat['name_id']) ?>"><?= e($cat['name_id']) ?></h3>
                                    <p class="text-xs sm:text-[13px] text-[#5D697A] leading-relaxed mt-2" data-i18n-en="<?= e($cat['short_desc_en'] ?? $cat['short_desc']) ?>" data-i18n-id="<?= e($cat['short_desc']) ?>"><?= e($cat['short_desc']) ?></p>
                                </div>
                                <div class="mt-4 pt-3.5 border-t border-[#F0ECE2] flex items-center justify-between text-xs font-bold text-navy-900 group-hover:text-gold-600 transition-colors">
                                    <span data-i18n-en="View Category Details" data-i18n-id="Lihat Detail Kategori">Lihat Detail Kategori</span>
                                    <?= render_icon('arrow-right', 'w-4 h-4 text-gold-600 group-hover:translate-x-0.5 transition-transform') ?>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- 15 Official Brands Grid -->
            <div class="pt-4 border-t border-[#E8E2D5]">
                <div class="mb-6">
                    <p
                        class="text-[11px] font-bold uppercase tracking-[0.16em] text-gold-600"
                        data-i18n-en="AUTHORIZED PARTNER BRANDS"
                        data-i18n-id="MITRA MEREK PENGADAAN"
                    >
                        MITRA MEREK PENGADAAN
                    </p>
                    <h3
                        class="font-serif font-semibold text-xl sm:text-2xl text-navy-900 mt-1"
                        data-i18n-en="15 Trusted Equipment, Chemical &amp; Mosaic Brands"
                        data-i18n-id="15 Merek Peralatan, Kimia &amp; Material Kolam Resmi"
                    >
                        15 Merek Peralatan, Kimia &amp; Material Kolam Resmi
                    </h3>
                </div>
                <?= render_brand_logo_grid($brands) ?>
            </div>
        </div>
    </section>
</main>

<?php
require __DIR__ . '/../includes/footer.php';
