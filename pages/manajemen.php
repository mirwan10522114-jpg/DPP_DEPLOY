<?php

declare(strict_types=1);

$pageTitle = 'Manajemen Proyek, SOP & Tanya Jawab — Dunia Pool & Pond';
$activeNav = 'manajemen';
$showPreFooterCta = true;

$timelineSteps = get_timeline_steps();
$faqs = get_general_faqs();

require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/header.php';
?>

<main class="flex-grow" id="main-content">
    <?= render_page_hero(
        'SOP & KONTROL KUALITAS',
        'PROJECT MANAGEMENT & SOP',
        'Manajemen Proyek Kolam Renang Terukur & Bergaransi',
        'Structured 7-Stage Swimming Pool Project Management',
        'Setiap tahapan dikerjakan secara sistematis dengan dokumentasi teknis, uji tekan perpipaan, uji rendam kebocoran, dan jadwal yang transparan.',
        'Every phase is systematically executed with detailed engineering documentation, hydrostatic pressure testing, leak immersion testing, and a transparent schedule.',
        'images/layanan/01-desain-konsultasi'
    ) ?>

    <section class="py-16 sm:py-20 bg-white">
        <div class="max-w-[1260px] mx-auto px-5 sm:px-8 lg:px-10 space-y-14">
            <!-- 3 Ikhtisar Standar Mutu (UI persis investor.php) -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="p-6 rounded-xl bg-cream-50 border border-[#EFECE5]">
                    <p class="text-xs font-bold uppercase tracking-wider text-gold-600" data-i18n-en="Structured Workflow" data-i18n-id="Tahapan Terstruktur">Tahapan Terstruktur</p>
                    <p class="font-serif text-3xl font-bold text-navy-900 mt-2" data-i18n-en="7 SOP Stages" data-i18n-id="7 Tahap SOP">7 Tahap SOP</p>
                    <p class="text-xs text-[#556275] mt-1" data-i18n-en="Site survey, 3D design, construction &amp; quality control" data-i18n-id="Survei, desain 3D, konstruksi &amp; kontrol mutu">Survei, desain 3D, konstruksi &amp; kontrol mutu</p>
                </div>
                <div class="p-6 rounded-xl bg-cream-50 border border-[#EFECE5]">
                    <p class="text-xs font-bold uppercase tracking-wider text-gold-600" data-i18n-en="Plumbing Pressure Test" data-i18n-id="Pengujian Jalur Pipa">Pengujian Jalur Pipa</p>
                    <p class="font-serif text-3xl font-bold text-navy-900 mt-2">2.5 – 3.0 Bar</p>
                    <p class="text-xs text-[#556275] mt-1" data-i18n-en="Hydrostatic pressure testing before concrete pour" data-i18n-id="Hydrostatic pressure test sebelum pengecoran">Hydrostatic pressure test sebelum pengecoran</p>
                </div>
                <div class="p-6 rounded-xl bg-cream-50 border border-[#EFECE5]">
                    <p class="text-xs font-bold uppercase tracking-wider text-gold-600" data-i18n-en="Leak Testing &amp; Handover" data-i18n-id="Uji Kebocoran &amp; Serah Terima">Uji Kebocoran &amp; Serah Terima</p>
                    <p class="font-serif text-3xl font-bold text-navy-900 mt-2" data-i18n-en="3 × 24 Hours" data-i18n-id="3 × 24 Jam">3 × 24 Jam</p>
                    <p class="text-xs text-[#556275] mt-1" data-i18n-en="Pool shell immersion test &amp; formal warranty certificate" data-i18n-id="Perendaman bak kolam &amp; sertifikat garansi resmi">Perendaman bak kolam &amp; sertifikat garansi resmi</p>
                </div>
            </div>

            <!-- 7 Tahap SOP Manajemen Proyek -->
            <div>
                <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-gold-600" data-i18n-en="EXECUTION WORKFLOW" data-i18n-id="ALUR PELAKSANAAN">ALUR PELAKSANAAN</p>
                <h2 class="font-serif text-2xl sm:text-3xl font-semibold text-navy-900 mt-1.5 mb-6" data-i18n-en="Dunia Pool &amp; Pond 7-Stage Project Management SOP" data-i18n-id="7 Tahapan Manajemen Proyek Dunia Pool &amp; Pond">7 Tahapan Manajemen Proyek Dunia Pool &amp; Pond</h2>
                <div class="divide-y divide-[#EFECE5] border border-[#EFECE5] rounded-2xl overflow-hidden shadow-card-soft">
                    <?php foreach ($timelineSteps as $idx => $step): ?>
                        <div class="p-6 sm:p-7 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white hover:bg-cream-50/70 transition-colors">
                            <div class="flex items-start gap-4 max-w-3xl">
                                <span class="w-11 h-11 rounded-full bg-navy-900 text-gold-400 font-sans font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">
                                    0<?= $idx + 1 ?>
                                </span>
                                <div>
                                    <span class="inline-block text-[11px] font-bold text-gold-600 uppercase tracking-wider" data-i18n-en="<?= e($step['num_en']) ?>" data-i18n-id="<?= e($step['num']) ?>"><?= e($step['num']) ?></span>
                                    <h3 class="text-base font-bold text-navy-900 mt-0.5" data-i18n-en="<?= e($step['title_en']) ?>" data-i18n-id="<?= e($step['title']) ?>"><?= e($step['title']) ?></h3>
                                    <p class="text-xs sm:text-sm text-[#556275] leading-relaxed mt-1.5" data-i18n-en="<?= e($step['desc_en']) ?>" data-i18n-id="<?= e($step['desc']) ?>"><?= e($step['desc']) ?></p>
                                </div>
                            </div>
                            <span class="text-[11px] font-semibold text-[#7A8596] uppercase tracking-wider shrink-0 md:pl-4" data-i18n-en="Step 0<?= $idx + 1 ?> / 0<?= count($timelineSteps) ?>" data-i18n-id="Langkah 0<?= $idx + 1 ?> / 0<?= count($timelineSteps) ?>">
                                Langkah 0<?= $idx + 1 ?> / 0<?= count($timelineSteps) ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- FAQ Lengkap -->
            <div id="faq">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                    <div class="lg:col-span-4 space-y-4">
                        <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-gold-600" data-i18n-en="TECHNICAL FAQ" data-i18n-id="TANYA JAWAB TEKNIS">TANYA JAWAB TEKNIS</p>
                        <h2 class="font-serif text-2xl sm:text-3xl font-semibold text-navy-900 leading-snug" data-i18n-en="Frequently Asked Questions (FAQ)" data-i18n-id="Pertanyaan yang Sering Diajukan (FAQ)">
                            Pertanyaan yang Sering Diajukan (FAQ)
                        </h2>
                        <p class="text-xs sm:text-sm text-[#556275] leading-relaxed" data-i18n-en="Information regarding new pool inquiries, leak renovations, pump &amp; filter sizing calculations, and our service coverage areas." data-i18n-id="Informasi seputar konsultasi proyek baru, renovasi kebocoran, perhitungan kapasitas pompa &amp; filter, hingga cakupan wilayah layanan kami.">
                            Informasi seputar konsultasi proyek baru, renovasi kebocoran, perhitungan kapasitas pompa &amp; filter, hingga cakupan wilayah layanan kami.
                        </p>
                        <div class="p-6 rounded-2xl bg-navy-900 text-white space-y-3.5 shadow-lg">
                            <p class="text-[11px] font-bold uppercase tracking-widest text-gold-400" data-i18n-en="Technical Consultation Desk" data-i18n-id="Meja Konsultasi Teknis">Meja Konsultasi Teknis</p>
                            <h3 class="font-serif text-lg font-semibold" data-i18n-en="Need Volume Calculations &amp; BOQ?" data-i18n-id="Butuh Hitungan Kubikasi &amp; RAB?">Butuh Hitungan Kubikasi &amp; RAB?</h3>
                            <p class="text-xs text-white/75 leading-relaxed" data-i18n-en="Contact our senior technical team in Padalarang, West Bandung directly to evaluate your land dimensions." data-i18n-id="Hubungi langsung tim teknisi kami di Padalarang, Bandung Barat untuk evaluasi ukuran lahan Anda.">
                                Hubungi langsung tim teknisi kami di Padalarang, Bandung Barat untuk evaluasi ukuran lahan Anda.
                            </p>
                            <a
                                class="inline-flex w-full items-center justify-center gap-2 bg-gold-400 hover:bg-gold-300 text-navy-950 font-semibold text-xs px-4 h-10 rounded-md transition-colors"
                                href="<?= e(dpp_wa_url('Halo Dunia Pool & Pond, saya ingin bertanya mengenai konsultasi teknis & RAB kolam renang.')) ?>"
                                rel="noopener noreferrer"
                                target="_blank"
                            >
                                <span data-i18n-en="Ask Technician via WhatsApp" data-i18n-id="Tanya Teknisi via WhatsApp">Tanya Teknisi via WhatsApp</span>
                                <?= render_icon('whatsapp-chat', 'w-4 h-4') ?>
                            </a>
                        </div>
                    </div>

                    <div class="lg:col-span-8 divide-y divide-[#EFECE5] border border-[#EAE5DC] rounded-2xl overflow-hidden bg-white shadow-card-soft">
                        <?php foreach ($faqs as $faq): ?>
                            <details class="group bg-white">
                                <summary class="flex items-center justify-between gap-4 cursor-pointer p-5 sm:p-6 text-sm sm:text-[15px] font-bold text-navy-900 hover:bg-cream-50 list-none select-none">
                                    <span data-i18n-en="<?= e($faq['q_en']) ?>" data-i18n-id="<?= e($faq['q']) ?>"><?= e($faq['q']) ?></span>
                                    <span aria-hidden="true" class="text-gold-600 font-bold text-lg group-open:rotate-45 transition-transform duration-150 shrink-0">+</span>
                                </summary>
                                <div class="px-5 sm:px-6 pb-6 text-xs sm:text-sm text-[#4A5668] leading-relaxed" data-i18n-en="<?= e($faq['a_en']) ?>" data-i18n-id="<?= e($faq['a']) ?>">
                                    <?= e($faq['a']) ?>
                                </div>
                            </details>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
require __DIR__ . '/../includes/footer.php';
