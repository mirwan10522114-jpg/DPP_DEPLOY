<?php

declare(strict_types=1);

$pageTitle = 'Tentang Kami — Dunia Pool & Pond (Sejak 1997)';
$activeNav = 'tentang';
$showPreFooterCta = true;

$painPoints = get_pain_points();
$brandLogoImg = resolve_image('images/brand/logo-dpp', app_url('/images/brand/logo-dpp.png'));

require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/header.php';
?>

<main class="flex-grow" id="main-content">
    <!-- Page Hero -->
    <?= render_page_hero(
        'TENTANG KAMI',
        'ABOUT US',
        'Spesialis Konstruksi & Sistem Sirkulasi Kolam Renang Sejak 1997',
        'Over Two Decades of Precision Swimming Pool Engineering',
        'Berbasis di Padalarang, Kabupaten Bandung Barat, Jawa Barat — mengutamakan ketelitian konstruksi kedap air, perhitungan debit sirkulasi terukur, dan peralatan orisinil bergaransi.',
        'Headquartered in Padalarang, West Bandung Regency, West Java — prioritizing watertight structural precision, calibrated water circulation, and certified original equipment.',
        'images/hero/kolam-utama'
    ) ?>

    <!-- Profil & Sejarah -->
    <section class="py-16 sm:py-20 bg-white">
        <div class="max-w-[1260px] mx-auto px-5 sm:px-8 lg:px-10 grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <div class="lg:col-span-7 space-y-5 text-sm sm:text-[15px] text-[#4A5668] leading-relaxed">
                <h2 class="font-serif text-2xl sm:text-3xl font-semibold text-navy-900" data-i18n-en="Dunia Pool &amp; Pond Overview" data-i18n-id="Sekilas Dunia Pool &amp; Pond">Sekilas Dunia Pool &amp; Pond</h2>
                <p data-i18n-en="Dunia Pool &amp; Pond was officially established on August 10, 1997 in Padalarang, West Bandung Regency, West Java. Starting as a dedicated local pool builder, we have continuously expanded to handle architectural &amp; circulation planning, reinforced concrete swimming pool and koi pond construction, pump room engineering, equipment procurement, routine maintenance, and after-sales service." data-i18n-id="Dunia Pool &amp; Pond berdiri resmi pada 10 Agustus 1997 di Padalarang, Kabupaten Bandung Barat, Jawa Barat. Berawal sebagai kontraktor kolam lokal, kami terus berkembang menangani perencanaan arsitektural &amp; sirkulasi, konstruksi sipil kolam renang dan kolam ikan hias, instalasi ruang mesin, pengadaan peralatan resmi, perawatan berkala, hingga dukungan purna jual.">
                    <strong class="text-navy-900">Dunia Pool &amp; Pond</strong> berdiri resmi pada <strong class="text-navy-900">10 Agustus 1997</strong> di Padalarang, Kabupaten Bandung Barat, Jawa Barat. Berawal sebagai kontraktor kolam lokal, kami terus berkembang menangani perencanaan arsitektural &amp; sirkulasi, konstruksi sipil kolam renang dan kolam ikan hias, instalasi ruang mesin, pengadaan peralatan resmi, perawatan berkala, hingga dukungan purna jual.
                </p>
                <p data-i18n-en="Every project adheres to structural and circulation precision: accurate shell reinforcement, multi-layer waterproofing membranes, mandatory Class AW PVC pipe hydrostatic pressure testing before concealment, and precise pump-to-filter matching to guarantee long-term water clarity and energy savings." data-i18n-id="Setiap pekerjaan kami berpedoman pada ketelitian konstruksi dan mekanikal air: pengerjaan struktur kolam yang terukur, pelapisan waterproofing menyeluruh, hydrostatic pressure test pipa PVC kelas AW sebelum penutupan jalur, serta penyelarasan kapasitas pompa dengan media filtrasi agar kejernihan air terjaga efisien dalam jangka panjang.">
                    Setiap pekerjaan kami berpedoman pada ketelitian konstruksi dan mekanikal air: pengerjaan struktur kolam yang terukur, pelapisan waterproofing menyeluruh, <em>hydrostatic pressure test</em> pipa PVC kelas AW sebelum penutupan jalur, serta penyelarasan kapasitas pompa dengan media filtrasi agar kejernihan air terjaga efisien dalam jangka panjang.
                </p>

                <!-- 4 Standar Teknis Korporasi -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-3">
                    <div class="p-4 rounded-xl bg-cream-50 border border-[#EFECE5]">
                        <p class="text-xl sm:text-2xl font-bold text-navy-900" data-i18n-en="Aug 10, 1997" data-i18n-id="- 1997">- 1997</p>
                        <p class="text-xs text-[#5D697A] mt-1" data-i18n-en="Est. (29+ Years)" data-i18n-id="Berdiri Resmi (29 Tahun+)">Berdiri Resmi (29 Tahun+)</p>
                    </div>
                    <div class="p-4 rounded-xl bg-cream-50 border border-[#EFECE5]">
                        <p class="text-xl sm:text-2xl font-bold text-navy-900" data-i18n-en="8 Services" data-i18n-id="8 Layanan">8 Layanan</p>
                        <p class="text-xs text-[#5D697A] mt-1" data-i18n-en="Build &amp; Maintenance" data-i18n-id="Solusi Konstruksi &amp; Perawatan">Solusi Konstruksi &amp; Perawatan</p>
                    </div>
                    <div class="p-4 rounded-xl bg-cream-50 border border-[#EFECE5]">
                        <p class="text-xl sm:text-2xl font-bold text-navy-900" data-i18n-en="3×24 Hours" data-i18n-id="Uji 3×24 Jam">Uji 3×24 Jam</p>
                        <p class="text-xs text-[#5D697A] mt-1" data-i18n-en="Pressure &amp; Soak Tests" data-i18n-id="Uji Tekan Pipa &amp; Rendam Bak">Uji Tekan Pipa &amp; Rendam Bak</p>
                    </div>
                    <div class="p-4 rounded-xl bg-cream-50 border border-[#EFECE5]">
                        <p class="text-xl sm:text-2xl font-bold text-navy-900" data-i18n-en="SNI / APSP" data-i18n-id="SNI / APSP">SNI / APSP</p>
                        <p class="text-xs text-[#5D697A] mt-1" data-i18n-en="TDH &amp; Turnover Sizing" data-i18n-id="Kalkulasi TDH &amp; Turnover Air">Kalkulasi TDH &amp; Turnover Air</p>
                    </div>
                </div>

                <!-- 3 Prinsip Kerja -->
                <div class="pt-4 space-y-3">
                    <div class="p-4 rounded-xl border border-[#EFECE5] bg-white shadow-card-soft flex flex-col sm:flex-row sm:items-baseline gap-1.5 sm:gap-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-gold-600 shrink-0 w-28" data-i18n-en="01 • MEASURED" data-i18n-id="01 • TERUKUR">01 • TERUKUR</span>
                        <p class="text-xs sm:text-sm text-[#4A5668]" data-i18n-en="Precision Circulation Engineering: Exact pipe dimensioning, pump flow curve matching, and turnover rate calculated strictly against total water cubic volume." data-i18n-id="Sistem Sirkulasi Presisi: Perhitungan jalur pipa, debit pompa, dan turnover rate sesuai volume kubikasi air kolam."><strong class="text-navy-900">Sistem Sirkulasi Presisi:</strong> Perhitungan jalur pipa, debit pompa, dan turnover rate sesuai volume kubikasi air kolam.</p>
                    </div>
                    <div class="p-4 rounded-xl border border-[#EFECE5] bg-white shadow-card-soft flex flex-col sm:flex-row sm:items-baseline gap-1.5 sm:gap-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-gold-600 shrink-0 w-28" data-i18n-en="02 • CLEAR" data-i18n-id="02 • JELAS">02 • JELAS</span>
                        <p class="text-xs sm:text-sm text-[#4A5668]" data-i18n-en="BOQ &amp; Material Transparency: Concrete specs, membrane waterproofing brands, and equipment models explicitly stated without hidden charges." data-i18n-id="Transparansi RAB &amp; Material: Spesifikasi beton, waterproofing, dan merek mesin tercantum tegas tanpa biaya tersembunyi."><strong class="text-navy-900">Transparansi RAB &amp; Material:</strong> Spesifikasi beton, waterproofing, dan merek mesin tercantum tegas tanpa biaya tersembunyi.</p>
                    </div>
                    <div class="p-4 rounded-xl border border-[#EFECE5] bg-white shadow-card-soft flex flex-col sm:flex-row sm:items-baseline gap-1.5 sm:gap-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-gold-600 shrink-0 w-28" data-i18n-en="03 • WARRANTY" data-i18n-id="03 • GARANSI">03 • GARANSI</span>
                        <p class="text-xs sm:text-sm text-[#4A5668]" data-i18n-en="Handover &amp; After-Sales: Formal testing protocols, self-maintenance client training, and long-term genuine OEM spare parts availability." data-i18n-id="Serah Terima &amp; Purna Jual: Dilengkapi berita acara pengujian, edukasi operasional mandiri, dan ketersediaan suku cadang resmi."><strong class="text-navy-900">Serah Terima &amp; Purna Jual:</strong> Dilengkapi berita acara pengujian, edukasi operasional mandiri, dan ketersediaan suku cadang resmi.</p>
                    </div>
                </div>
            </div>

            <!-- Right Column: Visi, Misi & Tim Spesialis -->
            <div class="lg:col-span-5 space-y-6">
                <div class="bg-navy-900 text-white rounded-2xl p-7 sm:p-8 space-y-6 shadow-xl">
                    <div>
                        <span class="text-[11px] font-bold uppercase tracking-[0.16em] text-gold-400" data-i18n-en="Corporate Vision" data-i18n-id="Visi Perusahaan">Visi Perusahaan</span>
                        <p class="font-serif text-lg font-medium text-white mt-2 leading-relaxed" data-i18n-en="To be Indonesia's most trusted pool and koi pond specialist partner, delivering zero-leak construction, energy-efficient circulation systems, and enduring after-sales technical support." data-i18n-id="Menjadi mitra spesialis kolam renang dan kolam hias terpercaya di Indonesia yang menghadirkan konstruksi bebas bocor, sirkulasi efisien, dan layanan purna jual berkesinambungan.">
                            Menjadi mitra spesialis kolam renang dan kolam hias terpercaya di Indonesia yang menghadirkan konstruksi bebas bocor, sirkulasi efisien, dan layanan purna jual berkesinambungan.
                        </p>
                    </div>
                    <div class="border-t border-white/10 pt-5">
                        <span class="text-[11px] font-bold uppercase tracking-[0.16em] text-gold-400" data-i18n-en="Mission &amp; Technical Commitments" data-i18n-id="Misi &amp; Komitmen Teknis">Misi &amp; Komitmen Teknis</span>
                        <ul class="mt-2.5 space-y-2.5 text-xs sm:text-sm text-white/80 leading-relaxed">
                            <li class="flex items-start gap-2.5">
                                <span class="text-gold-400 font-bold">•</span>
                                <span data-i18n-en="Enforce strict structural standards, seamless waterproofing barriers, and pressure-tested plumbing across all projects." data-i18n-id="Menerapkan standar pengerjaan konstruksi yang rapi, pelapisan kedap air, dan uji tekan perpipaan menyeluruh di setiap proyek.">Menerapkan standar pengerjaan konstruksi yang rapi, pelapisan kedap air, dan uji tekan perpipaan menyeluruh di setiap proyek.</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-gold-400 font-bold">•</span>
                                <span data-i18n-en="Provide genuine certified pumps, filters, chemicals, and spare parts sourced from 15 global partner brands." data-i18n-id="Menyediakan pengadaan peralatan pompa, filter, kimia, dan suku cadang dari 15 merek resmi bergaransi.">Menyediakan pengadaan peralatan pompa, filter, kimia, dan suku cadang dari 15 merek resmi bergaransi.</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-gold-400 font-bold">•</span>
                                <span data-i18n-en="Deliver transparent technical consultations, scheduled routine maintenance, and ongoing water chemistry education." data-i18n-id="Memberikan pendampingan konsultasi teknis, perawatan rutin, dan edukasi kualitas air secara transparan.">Memberikan pendampingan konsultasi teknis, perawatan rutin, dan edukasi kualitas air secara transparan.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <?php if ($brandLogoImg !== ''): ?>
                    <div class="bg-cream-50 border border-[#EAE5DC] rounded-2xl overflow-hidden shadow-card-soft grid grid-cols-1 sm:grid-cols-12 items-stretch">
                        <div class="sm:col-span-5 min-h-[180px] bg-white border-b sm:border-b-0 sm:border-r border-[#EAE5DC] flex flex-col items-center justify-center p-6 text-center">
                            <img alt="Logo Resmi Dunia Pool &amp; Pond" class="h-16 sm:h-[72px] w-auto object-contain" loading="lazy" src="<?= e($brandLogoImg) ?>" />
                            <span class="font-sans font-extrabold text-[11px] uppercase tracking-[0.14em] text-navy-900 mt-3 leading-none">DUNIA POOL &amp; POND</span>
                            <span class="text-[10px] font-semibold text-gold-700 tracking-wider uppercase mt-1">Est. 10 Agustus 1997</span>
                        </div>
                        <div class="sm:col-span-7 p-5 sm:p-6 flex flex-col justify-center space-y-2">
                            <p class="text-[10.5px] font-bold uppercase tracking-[0.15em] text-gold-600">THE POOL SPECIALIST</p>
                            <h3 class="font-serif font-semibold text-lg text-navy-900 leading-snug" data-i18n-en="Direct Field Practitioner Guidance" data-i18n-id="Pendampingan Langsung Praktisi Lapangan">Pendampingan Langsung Praktisi Lapangan</h3>
                            <p class="text-xs text-[#556275] leading-relaxed" data-i18n-en="Handled directly by our experienced technical team in Padalarang, West Bandung without third-party middlemen." data-i18n-id="Ditangani langsung oleh tim teknis berpengalaman di Padalarang, Bandung Barat tanpa perantara pihak ketiga.">
                                Ditangani langsung oleh tim teknis berpengalaman di Padalarang, Bandung Barat tanpa perantara pihak ketiga.
                            </p>
                            <div class="pt-1">
                                <a class="inline-flex items-center gap-1.5 text-xs font-bold text-navy-900 hover:text-gold-600 transition-colors" href="<?= e(dpp_wa_url('Halo Dunia Pool & Pond, saya ingin berkonsultasi mengenai rencana pembuatan / perbaikan kolam renang.')) ?>" rel="noopener noreferrer" target="_blank">
                                    <span data-i18n-en="Contact Technicians: 0821-1807-5560" data-i18n-id="Hubungi Teknisi: 0821-1807-5560">Hubungi Teknisi: 0821-1807-5560</span>
                                    <?= render_icon('arrow-right', 'w-3.5 h-3.5') ?>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Evaluasi Sebelum Memulai (4 Pain Points) -->
    <section class="py-16 sm:py-20 bg-cream-50 border-t border-[#EFECE5]">
        <div class="max-w-[1260px] mx-auto px-5 sm:px-8 lg:px-10">
            <div class="max-w-2xl mb-9">
                <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-gold-600" data-i18n-en="PRE-CONSTRUCTION EVALUATION" data-i18n-id="EVALUASI SEBELUM MEMULAI">EVALUASI SEBELUM MEMULAI</p>
                <h2 class="font-serif text-2xl sm:text-3xl font-semibold text-navy-900 mt-1.5" data-i18n-en="Avoid Common Pitfalls in Pool Construction" data-i18n-id="Hindari Kesalahan Teknis dalam Membangun Kolam Renang">Hindari Kesalahan Teknis dalam Membangun Kolam Renang</h2>
                <p class="text-xs sm:text-sm text-[#556275] leading-relaxed mt-2" data-i18n-en="Many property owners face staggering repair costs because initial construction lacked proper circulation sizing and structural waterproofing methods." data-i18n-id="Banyak pemilik properti mengalami pembengkakan biaya perbaikan akibat pengerjaan awal tanpa perhitungan sirkulasi dan struktur kedap air yang tepat.">
                    Banyak pemilik properti mengalami pembengkakan biaya perbaikan akibat pengerjaan awal tanpa perhitungan sirkulasi dan struktur kedap air yang tepat.
                </p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <?php foreach ($painPoints as $pt): ?>
                    <article class="bg-white border border-[#EFECE5] rounded-xl p-6 shadow-card-soft flex flex-col justify-between">
                        <div>
                            <div class="w-10 h-10 rounded-full bg-navy-900 text-gold-400 font-sans font-bold text-xs flex items-center justify-center mb-4">
                                <?= e($pt['num']) ?>
                            </div>
                            <h3 class="font-bold text-sm text-navy-900 leading-snug" data-i18n-en="<?= e($pt['title_en'] ?? $pt['title']) ?>" data-i18n-id="<?= e($pt['title']) ?>"><?= e($pt['title']) ?></h3>
                            <p class="text-xs text-[#556275] leading-relaxed mt-2.5" data-i18n-en="<?= e($pt['desc_en'] ?? $pt['desc']) ?>" data-i18n-id="<?= e($pt['desc']) ?>"><?= e($pt['desc']) ?></p>
                        </div>
                        <div class="mt-5 pt-3 border-t border-[#F0ECE2]">
                            <p class="text-[11.5px] font-semibold text-[#B42318] border-l-2 border-[#B42318] pl-2.5" data-i18n-en="<?= e($pt['risk_en'] ?? $pt['risk']) ?>" data-i18n-id="<?= e($pt['risk']) ?>">
                                <?= e($pt['risk']) ?>
                            </p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<?php
require __DIR__ . '/../includes/footer.php';
