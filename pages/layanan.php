<?php

declare(strict_types=1);

$pageTitle = 'Layanan Konstruksi & Sistem Sirkulasi Kolam — Dunia Pool & Pond';
$activeNav = 'layanan';
$showPreFooterCta = true;

$services = get_all_services();
$pumpRoomImg = resolve_image('images/layanan/ruang-mesin');

$hydraulicPillars = [
    [
        'num'      => '01',
        'tag'      => 'Standar Sirkulasi Kolam',
        'tag_en'   => 'Pool Circulation Standards',
        'title'    => 'Kalkulasi Turnover Rate & TDH',
        'title_en' => 'Turnover Rate & TDH Calculations',
        'desc'     => 'Perhitungan matematis debit sirkulasi (m³/jam) berdasarkan kubikasi total air kolam. Dilengkapi kalkulasi Total Dynamic Head (TDH) yang memperhitungkan rugi gesek sambungan elbow, tee, check valve, dan elevasi ruang mesin.',
        'desc_en'  => 'Mathematical sizing of circulation flow rate (m³/h) based on total pool volume. Features Total Dynamic Head (TDH) calculations accounting for friction loss in elbows, tees, check valves, and pump room elevation.',
    ],
    [
        'num'      => '02',
        'tag'      => 'Silica Sand & AFM Glass',
        'tag_en'   => 'Silica Sand & Activated Glass',
        'title'    => 'Instalasi Pompa & Sand/Cartridge Filter',
        'title_en' => 'Pump & Sand/Cartridge Filter Installation',
        'desc'     => 'Penyelarasan kapasitas tabung filter (bobot pasir silika grade 16/30 atau Activated Glass Media) dengan kurva daya pompa (HP / kW) serta dudukan peredam getaran mesin.',
        'desc_en'  => 'Matching filter tank vessel capacity (16/30 grade silica sand or Activated Glass Media) with pump performance curves (HP/kW) and vibration-dampening bases.',
    ],
    [
        'num'      => '03',
        'tag'      => 'Pipa PVC Kelas AW',
        'tag_en'   => 'Class AW Pressure PVC',
        'title'    => 'Perpipaan Sirkulasi (Skimmer & Overflow)',
        'title_en' => 'Circulation Piping (Skimmer & Overflow)',
        'desc'     => 'Pemasangan rangkaian jalur suction (main drain, skimmer box, vacuum line) dan pipa discharge (return inlet). Untuk sistem overflow, integrasi parit gutter gravitasi menuju balancing tank.',
        'desc_en'  => 'Installation of suction lines (main drain, skimmer box, vacuum point) and discharge circuits (return inlets). For overflow pools, gravity gutter integration to balancing tanks.',
    ],
    [
        'num'      => '04',
        'tag'      => 'Anti-Entrapment Safety',
        'tag_en'   => 'Anti-Entrapment Safety Standards',
        'title'    => 'Fitting Distribusi & Anti-Vortex Safety',
        'title_en' => 'Distribution Fittings & Anti-Vortex Safety',
        'desc'     => 'Pemasangan main drain anti-vortex (mencegah bahaya sedotan pusaran bagi perenang), eyeball adjustable return inlet terarah, foot valve non-return, serta true-union ball valve tahan klorin.',
        'desc_en'  => 'Installation of anti-vortex drain covers to prevent swimmer entrapment, directional eyeball return inlets, non-return check valves, and chlorine-resistant union ball valves.',
    ],
];

$hydraulicSteps = [
    [
        'num'      => '1',
        'title'    => 'Analisis Debit & Volume Air',
        'title_en' => 'Flow Rate & Water Volume Analysis',
        'desc'     => 'Menentukan kapasitas kubikasi riil kolam renang, kecepatan aliran filtrasi (filtration rate ≤ 50 m³/h/m²), serta penentuan target siklus perputaran air (turnover time 4–6 jam).',
        'desc_en'  => 'Determining total pool cubic volume, target filtration velocity (≤ 50 m³/h/m²), and establishing a clean 4–6 hour turnover schedule.',
    ],
    [
        'num'      => '2',
        'title'    => 'Skematik Jalur Pipa & Valve Manifold',
        'title_en' => 'Piping Schematic & Manifold Valve Assembly',
        'desc'     => 'Penyusunan gambar kerja isometrik perpipaan lengkap dengan kemiringan pipa gravitasi dan posisi manifold valve pemisah jalur vacuum, skimmer, main drain, dan balancing tank.',
        'desc_en'  => 'Drafting isometric piping working drawings with calculated gravity slopes and a central manifold isolating vacuum, skimmer, main drain, and balancing tank lines.',
    ],
    [
        'num'      => '3',
        'title'    => 'Pemasangan & Penyambungan Tekanan Tinggi',
        'title_en' => 'High-Pressure Solvent-Weld Piping Installation',
        'desc'     => 'Penggunaan pipa PVC kelas AW dengan primer solven dan lem khusus pipa bertekanan heavy-duty. Seluruh permukaan sambungan dibersihkan secara presisi sebelum penyambungan.',
        'desc_en'  => 'Employing Class AW pressure-rated PVC with certified solvent cement and primers. All bonding surfaces are meticulously deburred and prepped prior to welding.',
    ],
    [
        'num'      => '4',
        'title'    => 'Hydrostatic Pressure Test (Prosedur Wajib)',
        'title_en' => 'Mandatory Hydrostatic Pressure Testing',
        'desc'     => 'Pemberian tekanan udara/air pada rentang 2.5 hingga 3.0 bar menggunakan pressure test pump selama minimal 24–48 jam sebelum pengecoran beton untuk menjamin 0% kebocoran tersembunyi.',
        'desc_en'  => 'Static pressure testing at 2.5 to 3.0 bar using pressure test pumps for 24–48 hours before concrete pouring to guarantee zero hidden leaks.',
    ],
    [
        'num'      => '5',
        'title'    => 'Commissioning & Uji Aliran Pompa Filter',
        'title_en' => 'Pump & Filter Flow Commissioning',
        'desc'     => 'Pengisian media pasir silika/kaca, pembilasan awal (initial backwash & rinse), pengetesan daya sedot, leveling aliran return inlet, dan pencatatan tekanan awal pada manometer.',
        'desc_en'  => 'Loading silica or glass media, initial backwash & rinse conditioning, suction flow testing, eyeball leveling, and recording baseline clean operating pressure.',
    ],
];

require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/header.php';
?>

<main class="flex-grow" id="main-content">
    <!-- Page Hero -->
    <?= render_page_hero(
        'LAYANAN KAMI',
        'OUR SERVICES',
        'Delapan Lingkup Pekerjaan Terpadu & Sistem Sirkulasi',
        'Eight Integrated Pool Services & Filtration Systems',
        'Pekerjaan terstruktur sejak perencanaan awal, konstruksi struktur kolam kedap air, sistem pemipaan ruang mesin, hingga perawatan kejernihan air berkelanjutan.',
        'Structured execution from initial planning, watertight pool structure construction, pump room circulation piping, to continuous water clarity maintenance.',
        'images/layanan/04-sirkulasi-filtrasi'
    ) ?>

    <!-- 8 Layanan Utama (Exact Split-Card UI) -->
    <section class="py-16 sm:py-20 bg-cream-50">
        <div class="max-w-[1260px] mx-auto px-5 sm:px-8 lg:px-10 space-y-8">
            <?php foreach ($services as $svc): ?>
                <article class="bg-white border border-[#EAE5DC] rounded-2xl overflow-hidden shadow-card-soft grid grid-cols-1 lg:grid-cols-12" id="<?= e($svc['slug']) ?>">
                    <div class="lg:col-span-5 relative min-h-[250px] bg-navy-900">
                        <?php if ($svc['img'] !== ''): ?>
                            <img alt="<?= e($svc['title']) ?>" class="w-full h-full object-cover" loading="lazy" src="<?= e($svc['img']) ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="lg:col-span-7 p-7 sm:p-9 flex flex-col justify-center space-y-4">
                        <div class="inline-flex items-center gap-2.5 text-gold-600 text-xs font-bold uppercase tracking-wider">
                            <span class="w-9 h-9 rounded-full bg-[#FCF9F2] border border-[#EADAB8] flex items-center justify-center text-navy-900">
                                <?= render_icon($svc['icon'], 'w-4 h-4') ?>
                            </span>
                            <span data-i18n-en="Service <?= e($svc['num']) ?> • <?= e($svc['title_en']) ?>" data-i18n-id="Layanan <?= e($svc['num']) ?> • <?= e($svc['title']) ?>">Layanan <?= e($svc['num']) ?> • <?= e($svc['title']) ?></span>
                        </div>
                        <h2 class="font-serif text-2xl sm:text-3xl font-semibold text-navy-900" data-i18n-en="<?= e($svc['title_en']) ?>" data-i18n-id="<?= e($svc['title']) ?>"><?= e($svc['title']) ?></h2>
                        <p class="text-sm text-[#4A5668] leading-relaxed" data-i18n-en="<?= e($svc['desc_en'] ?? $svc['desc']) ?>" data-i18n-id="<?= e($svc['desc']) ?>"><?= e($svc['desc']) ?></p>

                        <ul class="space-y-1.5 text-xs sm:text-sm text-[#556275]">
                            <?php foreach ($svc['bullets'] as $bIdx => $bullet): ?>
                                <?php $bulletEn = $svc['bullets_en'][$bIdx] ?? $bullet; ?>
                                <li class="flex items-start gap-2">
                                    <span class="text-gold-600 font-bold">•</span>
                                    <span data-i18n-en="<?= e($bulletEn) ?>" data-i18n-id="<?= e($bullet) ?>"><?= e($bullet) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <div class="pt-2 flex flex-wrap items-center justify-between gap-4 border-t border-[#F0ECE2]">
                            <div class="flex flex-wrap gap-2">
                                <?php foreach ($svc['tags'] as $tIdx => $tag): ?>
                                    <?php $tagEn = $svc['tags_en'][$tIdx] ?? $tag; ?>
                                    <span class="px-3 py-1 rounded-md bg-cream-50 border border-[#E6DFD1] text-[11.5px] font-semibold text-navy-900" data-i18n-en="<?= e($tagEn) ?>" data-i18n-id="<?= e($tag) ?>">
                                        <?= e($tag) ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                            <a
                                class="inline-flex items-center gap-2 bg-navy-900 hover:bg-navy-700 text-white text-xs font-semibold px-4 h-9 rounded-md transition-colors shrink-0"
                                href="<?= e(dpp_wa_url($svc['wa_text'])) ?>"
                                rel="noopener noreferrer"
                                target="_blank"
                            >
                                <span data-i18n-en="Consult This Service" data-i18n-id="Konsultasikan">Konsultasikan</span>
                                <?= render_icon('whatsapp-chat', 'w-3.5 h-3.5 text-gold-400') ?>
                            </a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Detail Rekayasa Sistem Sirkulasi & Filtrasi -->
    <section class="py-16 sm:py-20 bg-white border-t border-[#EFECE5]" id="detail-hidrolika">
        <div class="max-w-[1260px] mx-auto px-5 sm:px-8 lg:px-10 space-y-14">
            <!-- Intro & Ruang Mesin -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                <div class="lg:col-span-6 space-y-4">
                    <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-gold-600" data-i18n-en="CIRCULATION &amp; FILTRATION SPECIALIZATION" data-i18n-id="SPESIALISASI SISTEM SIRKULASI &amp; FILTRASI">SPESIALISASI SISTEM SIRKULASI &amp; FILTRASI</p>
                    <h2 class="font-serif text-2xl sm:text-3xl font-semibold text-navy-900 leading-snug" data-i18n-en="Why Precision Water Circulation is Essential?" data-i18n-id="Mengapa Sistem Sirkulasi yang Tepat Sangat Krusial?">
                        Mengapa Sistem Sirkulasi yang Tepat Sangat Krusial?
                    </h2>
                    <p class="text-sm text-[#4A5668] leading-relaxed" data-i18n-en="Many swimming pools face chronic cloudiness or excessive chemical costs not due to disinfectant shortages, but rather because of inaccurate circulation flow sizing and excessive pipe friction loss. Undersized piping forces pump motors beyond their peak efficiency point, triggering mechanical cavitation, overheating, and unnecessary electrical consumption." data-i18n-id="Banyak kolam renang mengalami masalah air keruh kronis atau pemborosan bahan kimia bukan karena kekurangan disinfektan, melainkan akibat kesalahan kalkulasi debit sirkulasi (flow rate) dan hambatan gesekan (friction loss) pipa. Pipa yang terlalu kecil memaksa motor pompa bekerja di luar titik efisiensi terbaiknya, memicu kavitasi mekanis, panas berlebih, dan boros listrik.">
                        Banyak kolam renang mengalami masalah air keruh kronis atau pemborosan bahan kimia bukan karena kekurangan disinfektan, melainkan akibat <strong class="text-navy-900">kesalahan kalkulasi debit sirkulasi (flow rate)</strong> dan hambatan gesekan (<em>friction loss</em>) pipa. Pipa yang terlalu kecil memaksa motor pompa bekerja di luar titik efisiensi terbaiknya, memicu kavitasi mekanis, panas berlebih, dan boros listrik.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5 pt-2">
                        <div class="p-4 rounded-xl bg-cream-50 border border-[#EFECE5]">
                            <p class="text-xs font-bold text-navy-900" data-i18n-en="Crystal Clarity" data-i18n-id="Kejernihan Kristal">Kejernihan Kristal</p>
                            <p class="text-[11.5px] text-[#556275] mt-1 leading-relaxed" data-i18n-en="4–6 hour turnover time filters 100% of water volume without dead spots." data-i18n-id="Turnover 4–6 jam menyaring 100% air tanpa area mati (dead spots).">Turnover 4–6 jam menyaring 100% air tanpa area mati (dead spots).</p>
                        </div>
                        <div class="p-4 rounded-xl bg-cream-50 border border-[#EFECE5]">
                            <p class="text-xs font-bold text-navy-900" data-i18n-en="Energy Efficiency" data-i18n-id="Hemat Daya Pompa">Hemat Daya Pompa</p>
                            <p class="text-[11.5px] text-[#556275] mt-1 leading-relaxed" data-i18n-en="Optimized pipe diameters minimize head loss and reduce electricity kWh." data-i18n-id="Diameter pipa terukur menekan beban head &amp; menghemat kWh listrik.">Diameter pipa terukur menekan beban head &amp; menghemat kWh listrik.</p>
                        </div>
                        <div class="p-4 rounded-xl bg-cream-50 border border-[#EFECE5]">
                            <p class="text-xs font-bold text-navy-900" data-i18n-en="Extended Media Life" data-i18n-id="Usia Media Filter">Usia Media Filter</p>
                            <p class="text-[11.5px] text-[#556275] mt-1 leading-relaxed" data-i18n-en="Balanced filtration and backwash rates protect silica and glass media." data-i18n-id="Kecepatan filtrasi &amp; backwash seimbang menjaga pasir silika awet.">Kecepatan filtrasi &amp; backwash seimbang menjaga pasir silika awet.</p>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-6">
                    <div class="rounded-2xl overflow-hidden border border-[#EAE5DC] bg-navy-900 shadow-card-soft">
                        <?php if ($pumpRoomImg !== ''): ?>
                            <img alt="Ruang Mesin Terintegrasi Standar Sirkulasi Dunia Pool &amp; Pond" class="w-full aspect-[16/10] object-cover" loading="lazy" src="<?= e($pumpRoomImg) ?>" />
                        <?php endif; ?>
                        <div class="px-5 py-4 bg-navy-900 text-white flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs">
                            <div>
                                <p class="font-bold text-gold-400" data-i18n-en="Integrated Pump Room Circulation Standards" data-i18n-id="Ruang Mesin Terintegrasi Standar Sirkulasi">Ruang Mesin Terintegrasi Standar Sirkulasi</p>
                                <p class="text-white/75 mt-0.5" data-i18n-en="Layout of suction, discharge, manifold valves, and pressurized filtration." data-i18n-id="Penataan pipa suction, discharge, manifold valve, &amp; filtrasi bertekanan.">Penataan pipa suction, discharge, manifold valve, &amp; filtrasi bertekanan.</p>
                            </div>
                            <span class="px-2.5 py-1 rounded bg-white/10 border border-white/15 text-[11px] font-semibold text-white shrink-0 self-start sm:self-auto" data-i18n-en="DIN &amp; ASTM D1785 Standards" data-i18n-id="Standar DIN &amp; ASTM D1785">
                                Standar DIN &amp; ASTM D1785
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4 Pilar Pekerjaan Hidrolika -->
            <div>
                <h3 class="font-serif text-2xl font-semibold text-navy-900 mb-6" data-i18n-en="4 Pillars of Circulation &amp; Filtration Engineering" data-i18n-id="4 Pilar Pekerjaan Sistem Sirkulasi &amp; Filtrasi">4 Pilar Pekerjaan Sistem Sirkulasi &amp; Filtrasi</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <?php foreach ($hydraulicPillars as $hp): ?>
                        <article class="p-6 rounded-xl border border-[#EFECE5] bg-cream-50/60 shadow-card-soft flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between gap-2 mb-3">
                                    <span class="w-9 h-9 rounded-full bg-navy-900 text-gold-400 font-bold text-xs flex items-center justify-center"><?= e($hp['num']) ?></span>
                                    <span class="px-2.5 py-1 rounded bg-white border border-[#E6DFD1] text-[11px] font-semibold text-gold-700" data-i18n-en="<?= e($hp['tag_en']) ?>" data-i18n-id="<?= e($hp['tag']) ?>"><?= e($hp['tag']) ?></span>
                                </div>
                                <h4 class="font-serif text-lg font-bold text-navy-900 mb-2" data-i18n-en="<?= e($hp['title_en']) ?>" data-i18n-id="<?= e($hp['title']) ?>"><?= e($hp['title']) ?></h4>
                                <p class="text-xs sm:text-sm text-[#556275] leading-relaxed" data-i18n-en="<?= e($hp['desc_en']) ?>" data-i18n-id="<?= e($hp['desc']) ?>"><?= e($hp['desc']) ?></p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Tabel Komparasi Skimmer vs Overflow -->
            <div>
                <div class="mb-5">
                    <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-gold-600" data-i18n-en="SYSTEM SELECTION GUIDE" data-i18n-id="PANDUAN PEMILIHAN SISTEM">PANDUAN PEMILIHAN SISTEM</p>
                    <h3 class="font-serif text-2xl font-semibold text-navy-900 mt-1" data-i18n-en="Technical Comparison: Skimmer Box vs Overflow System" data-i18n-id="Komparasi Teknis: Sistem Skimmer Box vs Sistem Overflow">Komparasi Teknis: Sistem Skimmer Box vs Sistem Overflow</h3>
                </div>
                <div class="overflow-x-auto border border-[#EAE5DC] rounded-2xl shadow-card-soft">
                    <table class="w-full text-left border-collapse text-xs sm:text-sm">
                        <thead>
                            <tr class="bg-navy-900 text-white">
                                <th class="p-4 font-semibold uppercase tracking-wider text-[11px] text-gold-400 w-1/4" data-i18n-en="Engineering Parameter" data-i18n-id="Parameter Rekayasa">Parameter Rekayasa</th>
                                <th class="p-4 font-semibold uppercase tracking-wider text-[11px] w-3/8" data-i18n-en="Skimmer Box System" data-i18n-id="Sistem Skimmer Box">Sistem Skimmer Box</th>
                                <th class="p-4 font-semibold uppercase tracking-wider text-[11px] w-3/8" data-i18n-en="Overflow / Semi-Overflow System" data-i18n-id="Sistem Overflow / Semi-Overflow">Sistem Overflow / Semi-Overflow</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#EFECE5] bg-white text-[#4A5668]">
                            <tr>
                                <td class="p-4 font-bold text-navy-900 bg-cream-50/70" data-i18n-en="Water Surface Level" data-i18n-id="Level Permukaan Air">Level Permukaan Air</td>
                                <td class="p-4" data-i18n-en="10–15 cm below pool upper rim (coping stone)." data-i18n-id="10–15 cm di bawah bibir atas kolam (coping stone).">10–15 cm di bawah bibir atas kolam (coping stone).</td>
                                <td class="p-4 font-medium text-navy-900" data-i18n-en="Flush seamlessly with coping or infinity negative edge." data-i18n-id="Rata sempurna dengan bibir kolam atau melimpah (infinity edge).">Rata sempurna dengan bibir kolam atau melimpah (infinity edge).</td>
                            </tr>
                            <tr>
                                <td class="p-4 font-bold text-navy-900 bg-cream-50/70" data-i18n-en="Space &amp; Tank Needs" data-i18n-id="Kebutuhan Ruang &amp; Tangki">Kebutuhan Ruang &amp; Tangki</td>
                                <td class="p-4" data-i18n-en="No balancing tank required; compact pump room." data-i18n-id="Tidak memerlukan Balancing Tank; ruang mesin lebih ringkas.">Tidak memerlukan Balancing Tank; ruang mesin lebih ringkas.</td>
                                <td class="p-4" data-i18n-en="Mandatory Balancing Tank (capacity 8–12% of total pool volume)." data-i18n-id="Wajib memiliki Balancing Tank (kapasitas 8–12% total volume kolam).">Wajib memiliki Balancing Tank (kapasitas 8–12% total volume kolam).</td>
                            </tr>
                            <tr>
                                <td class="p-4 font-bold text-navy-900 bg-cream-50/70" data-i18n-en="Gutter Drainage" data-i18n-id="Saluran Limpahan (Gutter)">Saluran Limpahan (Gutter)</td>
                                <td class="p-4" data-i18n-en="No perimeter gutters; utilizes wall skimmer boxes." data-i18n-id="Tanpa parit limpahan keliling; menggunakan kotak skimmer di dinding.">Tanpa parit limpahan keliling; menggunakan kotak skimmer di dinding.</td>
                                <td class="p-4" data-i18n-en="Features continuous perimeter drainage gutter with ABS grate covers." data-i18n-id="Dilengkapi parit gutter penampung keliling dengan grill penutup.">Dilengkapi parit gutter penampung keliling dengan grill penutup.</td>
                            </tr>
                            <tr>
                                <td class="p-4 font-bold text-navy-900 bg-cream-50/70" data-i18n-en="Surface Debris Removal" data-i18n-id="Pembersihan Permukaan Air">Pembersihan Permukaan Air</td>
                                <td class="p-4" data-i18n-en="Effective within skimmer box suction radius for compact sites." data-i18n-id="Efektif pada radius hisap kotak skimmer untuk lahan kompak.">Efektif pada radius hisap kotak skimmer untuk lahan kompak.</td>
                                <td class="p-4" data-i18n-en="Extremely rapid and uniform debris skimming across all sides." data-i18n-id="Sangat cepat dan merata menarik kotoran permukaan ke seluruh sisi.">Sangat cepat dan merata menarik kotoran permukaan ke seluruh sisi.</td>
                            </tr>
                            <tr>
                                <td class="p-4 font-bold text-navy-900 bg-cream-50/70" data-i18n-en="Investment &amp; Complexity" data-i18n-id="Investasi &amp; Kompleksitas Pipa">Investasi &amp; Kompleksitas Pipa</td>
                                <td class="p-4 font-semibold text-[#067647]" data-i18n-en="More economical, simpler plumbing, minimal evaporation." data-i18n-id="Lebih ekonomis, pemipaan ringkas, &amp; minim penguapan.">Lebih ekonomis, pemipaan ringkas, &amp; minim penguapan.</td>
                                <td class="p-4" data-i18n-en="Higher structural investment for balancing tank &amp; pipe manifolds." data-i18n-id="Investasi lebih tinggi untuk struktur balancing tank &amp; manifold pipa.">Investasi lebih tinggi untuk struktur balancing tank &amp; manifold pipa.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- 5 Tahapan Prosedur Pengerjaan & Pengujian Hidrolis -->
            <div>
                <div class="mb-5">
                    <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-gold-600" data-i18n-en="STANDARD OPERATING PROCEDURE" data-i18n-id="STANDARD OPERATING PROCEDURE">STANDARD OPERATING PROCEDURE</p>
                    <h3 class="font-serif text-2xl font-semibold text-navy-900 mt-1" data-i18n-en="5-Stage Piping Execution &amp; Pressure Testing Procedures" data-i18n-id="5 Tahapan Prosedur Pengerjaan &amp; Pengujian Pemipaan">5 Tahapan Prosedur Pengerjaan &amp; Pengujian Pemipaan</h3>
                </div>
                <div class="space-y-3.5">
                    <?php foreach ($hydraulicSteps as $hs): ?>
                        <div class="p-5 rounded-xl border border-[#EFECE5] bg-cream-50/50 flex items-start gap-4">
                            <span class="w-9 h-9 rounded-lg bg-navy-900 text-gold-400 font-bold text-sm flex items-center justify-center shrink-0">
                                <?= e($hs['num']) ?>
                            </span>
                            <div>
                                <h4 class="font-bold text-sm sm:text-base text-navy-900" data-i18n-en="<?= e($hs['title_en']) ?>" data-i18n-id="<?= e($hs['title']) ?>"><?= e($hs['title']) ?></h4>
                                <p class="text-xs sm:text-sm text-[#556275] leading-relaxed mt-1" data-i18n-en="<?= e($hs['desc_en']) ?>" data-i18n-id="<?= e($hs['desc']) ?>"><?= e($hs['desc']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
require __DIR__ . '/../includes/footer.php';
