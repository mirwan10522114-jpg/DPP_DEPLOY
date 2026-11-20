<?php

declare(strict_types=1);

$pageTitle = 'Portofolio & Dokumentasi Proyek — Dunia Pool & Pond';
$activeNav = 'proyek';
$showPreFooterCta = true;

$projects = get_featured_projects();
$projectVideo = resolve_video('video/kolam-ts-villa-cisarua', 'video');

require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/header.php';
?>

<main class="flex-grow" id="main-content">
    <?= render_page_hero(
        'PORTOFOLIO PROYEK',
        'PROJECT PORTFOLIO',
        'Dokumentasi Pekerjaan Konstruksi, Renovasi & Filtrasi',
        'Documented Pool Construction, Renovation & Filtration Works',
        'Dokumentasi pengerjaan kolam renang residensial, vila swasta, dan fasilitas komersial dengan standar pengerjaan konstruksi presisi serta pengujian sistem sirkulasi di Bandung Raya dan sekitarnya.',
        'Documented pool engineering across private villas, luxury residences, and commercial facilities with rigorous pipe pressure testing in Greater Bandung and surrounding areas.',
        'images/proyek/proyek-4-cihideung'
    ) ?>

    <section class="py-16 sm:py-20 bg-white">
        <div class="max-w-[1260px] mx-auto px-5 sm:px-8 lg:px-10 space-y-10">
            <?php if ($projectVideo['src'] !== ''): ?>
                <!-- Video Showcase Desain 3D & Render Realistis -->
                <div class="rounded-2xl overflow-hidden border border-[#EAE5DC] bg-navy-900 text-white shadow-xl" id="video-3d">
                    <div class="grid grid-cols-1 lg:grid-cols-12 items-stretch">
                        <div class="lg:col-span-8 bg-navy-950 flex items-center justify-center overflow-hidden">
                            <video
                                class="w-full h-full aspect-video object-cover"
                                controls
                                playsinline
                                poster="<?= e($projectVideo['poster']) ?>"
                                preload="metadata"
                            >
                                <source src="<?= e($projectVideo['src']) ?>" type="<?= e($projectVideo['type']) ?>" />
                                Browser Anda belum mendukung pemutar video HTML5.
                            </video>
                        </div>
                        <div class="lg:col-span-4 p-7 sm:p-8 flex flex-col justify-between gap-6 border-t lg:border-t-0 lg:border-l border-white/10">
                            <div class="space-y-3.5">
                                <span class="inline-block text-[11px] font-bold uppercase tracking-[0.16em] text-gold-400" data-i18n-en="3D DESIGN &amp; REALISTIC RENDERING" data-i18n-id="DESAIN 3D &amp; RENDER REALISTIS">
                                    DESAIN 3D &amp; RENDER REALISTIS
                                </span>
                                <h3 class="font-serif text-xl sm:text-2xl font-semibold text-white leading-snug" data-i18n-en="3D Visualization &amp; Pool View — TS Villa" data-i18n-id="Visualisasi 3D &amp; View Kolam TS Villa">
                                    Visualisasi 3D &amp; View Kolam TS Villa
                                </h3>
                                <p class="text-xs sm:text-sm text-white/75 leading-relaxed" data-i18n-en="Animated 3D architectural preview ranging from circulation piping schematics and balancing tank integration to full photorealistic night ambience." data-i18n-id="Pratinjau animasi desain 3D mulai dari skematik sistem perpipaan sirkulasi dan balancing tank hingga hasil render realistis suasana kolam siap pakai di malam hari.">
                                    Pratinjau animasi desain 3D mulai dari skematik sistem perpipaan sirkulasi dan balancing tank hingga hasil render realistis suasana kolam siap pakai di malam hari.
                                </p>
                                <ul class="space-y-2 pt-1 text-xs text-white/85">
                                    <li class="flex items-start gap-2">
                                        <span class="text-gold-400 font-bold">✓</span>
                                        <span data-i18n-en="3D schematics of circulation piping &amp; balancing tank" data-i18n-id="Skematik 3D jalur pipa sirkulasi &amp; balancing tank">Skematik 3D jalur pipa sirkulasi &amp; balancing tank</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="text-gold-400 font-bold">✓</span>
                                        <span data-i18n-en="Simulation of mosaic tiling, decking, and submersible LED lighting" data-i18n-id="Simulasi material mozaik, dek tepi, &amp; pencahayaan LED bawah air">Simulasi material mozaik, dek tepi, &amp; pencahayaan LED bawah air</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="text-gold-400 font-bold">✓</span>
                                        <span data-i18n-en="Full HD 1080p local documentation video" data-i18n-id="Video dokumentasi lokal resolusi Full HD 1080p">Video dokumentasi lokal resolusi Full HD 1080p</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="pt-4 border-t border-white/10">
                                <a
                                    class="inline-flex w-full items-center justify-center gap-2 bg-gold-400 hover:bg-gold-300 text-navy-950 font-semibold text-xs px-5 h-11 rounded-md transition-colors"
                                    href="<?= e(dpp_wa_url('Halo Dunia Pool & Pond, saya ingin berkonsultasi pembuatan Desain 3D & Konstruksi Kolam Renang.')) ?>"
                                    rel="noopener noreferrer"
                                    target="_blank"
                                >
                                    <span data-i18n-en="Consult 3D Pool Design" data-i18n-id="Konsultasikan Desain 3D Kolam">Konsultasikan Desain 3D Kolam</span>
                                    <?= render_icon('arrow-right', 'w-4 h-4') ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php foreach ($projects as $proj): ?>
                <?php
                $fitMode = $proj['img_fit'] ?? 'cover';
                $isContain = $fitMode === 'contain';
                $isFull = $fitMode === 'full';
                $waProjectLabel = !empty($proj['location'])
                    ? $proj['title'] . ' (' . $proj['location'] . ')'
                    : $proj['title'];
                ?>
                <article class="grid grid-cols-1 md:grid-cols-12 gap-7 p-6 sm:p-8 rounded-2xl border border-[#EFECE5] bg-cream-50/40 shadow-card-soft items-center" id="<?= e($proj['slug']) ?>">
                    <div class="md:col-span-5 rounded-xl overflow-hidden <?= $isFull ? 'bg-white border border-[#EAE5DC]' : ($isContain ? 'aspect-[4/3] bg-white border border-[#EAE5DC] p-3 flex items-center justify-center' : 'aspect-[4/3] bg-navy-900/10') ?>">
                        <?php if ($proj['img'] !== ''): ?>
                            <img alt="<?= e($proj['title']) ?>" class="w-full <?= $isFull ? 'h-auto object-contain' : ($isContain ? 'h-full object-contain' : 'h-full object-cover') ?>" loading="lazy" src="<?= e($proj['img']) ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="md:col-span-7 flex flex-col justify-center space-y-3.5">
                        <div class="flex flex-wrap items-center gap-2.5 text-xs">
                            <span class="px-2.5 py-1 rounded bg-[#FCF9F2] border border-[#EADAB8] text-gold-700 font-semibold" data-i18n-en="<?= e($proj['badge_en']) ?>" data-i18n-id="<?= e($proj['badge']) ?>"><?= e($proj['badge']) ?></span>
                            <span class="px-2.5 py-1 rounded bg-white border border-[#E6DFD1] text-navy-900 font-semibold" data-i18n-en="<?= e($proj['type_en']) ?>" data-i18n-id="<?= e($proj['type']) ?>"><?= e($proj['type']) ?></span>
                            <?php if (!empty($proj['location'])): ?>
                                <span class="text-[#7A8596] font-medium">📍 <?= e($proj['location']) ?></span>
                            <?php endif; ?>
                        </div>
                        <h2 class="font-serif text-xl sm:text-2xl font-semibold text-navy-900 leading-snug" data-i18n-en="<?= e($proj['title_en']) ?>" data-i18n-id="<?= e($proj['title']) ?>">
                            <?= e($proj['title']) ?>
                        </h2>
                        <p class="text-sm text-[#4A5668] leading-relaxed" data-i18n-en="<?= e($proj['body_en'] ?? $proj['body']) ?>" data-i18n-id="<?= e($proj['body']) ?>">
                            <?= e($proj['body']) ?>
                        </p>
                        <div class="pt-2 flex flex-wrap items-center justify-between gap-3 border-t border-[#EAE5DC]">
                            <span class="text-xs font-semibold text-navy-900" data-i18n-en="<?= e($proj['scope_en']) ?>" data-i18n-id="<?= e($proj['scope']) ?>"><?= e($proj['scope']) ?></span>
                            <a
                                class="inline-flex items-center gap-2 text-xs font-bold text-gold-700 hover:text-navy-900 transition-colors"
                                href="<?= e(dpp_wa_url('Halo Dunia Pool & Pond, saya tertarik berkonsultasi untuk proyek serupa: ' . $waProjectLabel . '.')) ?>"
                                rel="noopener noreferrer"
                                target="_blank"
                            >
                                <span data-i18n-en="Consult Similar Project" data-i18n-id="Konsultasikan Proyek Serupa">Konsultasikan Proyek Serupa</span>
                                <?= render_icon('arrow-right', 'w-3.5 h-3.5') ?>
                            </a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php
require __DIR__ . '/../includes/footer.php';
