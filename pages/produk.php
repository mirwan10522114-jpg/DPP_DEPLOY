<?php

declare(strict_types=1);

$pageTitle = 'Katalog 11 Kategori Peralatan & Material Kolam — Dunia Pool & Pond';
$activeNav = 'produk';
$showPreFooterCta = true;

$productCategories = get_product_categories();
$products = get_product_catalog();
$brands = get_brand_catalog();

require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/header.php';
?>

<main class="flex-grow" id="main-content">
    <!-- Page Hero -->
    <?= render_page_hero(
        'KATALOG PENGADAAN RESMI',
        'OFFICIAL PRODUCT CATALOG',
        'Katalog Peralatan, Bahan Kimia & Material Kolam Renang',
        '11 Categories of Swimming Pool Equipment, Chemicals & Materials',
        'Struktur 11 kategori pengadaan lengkap mulai dari pompa sirkulasi, sand filter, peralatan pembersih, kimia air, fitting plumbing, lampu LED IP68, pengolahan air, aksesori, pemanas & otomasi, finishing mozaik, hingga suku cadang resmi.',
        'Complete 11-category procurement structure from circulation pumps, sand filters, cleaning tools, pool chemicals, plumbing fittings, IP68 LED lights, water treatment, accessories, heating & automation, mosaic finishing, to genuine spare parts.',
        'images/layanan/05-instalasi-peralatan'
    ) ?>

    <section class="py-14 sm:py-16 bg-cream-50">
        <div class="max-w-[1260px] mx-auto px-5 sm:px-8 lg:px-10 space-y-10">
            <!-- Catatan Ketersediaan -->
            <div class="bg-white border border-[#EAE5DC] rounded-xl p-5 flex items-start gap-3.5 shadow-card-soft">
                <span class="w-8 h-8 rounded-full bg-[#FCF9F2] border border-[#EADAB8] text-gold-700 font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">i</span>
                <p class="text-xs sm:text-sm text-[#4A5668] leading-relaxed">
                    <strong class="text-navy-900" data-i18n-en="Catalog Availability Notice:" data-i18n-id="Catatan Ketersediaan Katalog:">Catatan Ketersediaan Katalog:</strong>
                    <span data-i18n-en=" The category list and product items below represent the standard procurement structure of Dunia Pool &amp; Pond. Contact our technical team via WhatsApp (0821-1807-5560) for real-time stock checks, sizing recommendations matched to your pool volume, and official price quotes." data-i18n-id=" Daftar kategori dan contoh produk di bawah merupakan struktur standar katalog pengadaan Dunia Pool &amp; Pond. Hubungi tim teknis kami via WhatsApp (0821-1807-5560) untuk pengecekan stok terbaru, rekomendasi kapasitas sesuai kubikasi kolam, dan penawaran harga resmi."> Daftar kategori dan contoh produk di bawah merupakan struktur standar katalog pengadaan <strong class="text-navy-900">Dunia Pool &amp; Pond</strong>. Hubungi tim teknis kami via WhatsApp (<strong class="text-navy-900">0821-1807-5560</strong>) untuk pengecekan stok terbaru, rekomendasi kapasitas sesuai kubikasi kolam, dan penawaran harga resmi.</span>
                </p>
            </div>

            <!-- Toolbar Pencarian & Penyaringan -->
            <div class="bg-white border border-[#EAE5DC] rounded-2xl p-5 sm:p-6 shadow-card-soft space-y-4">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                    <div class="relative flex-1 max-w-xl">
                        <label class="sr-only" for="catalog-search" data-i18n-en="Search products, brands, or subcategories" data-i18n-id="Cari produk, merek, atau subkategori">Cari produk, merek, atau subkategori</label>
                        <span class="pointer-events-none absolute inset-y-0 left-0 pl-3.5 flex items-center text-[#7A8596]">
                            <?= render_icon('search', 'w-4 h-4') ?>
                        </span>
                        <input
                            class="w-full h-11 pl-10 pr-4 rounded-lg border border-[#D4D9E2] text-sm text-navy-900 placeholder:text-[#7A8596] focus:border-navy-900 focus:ring-navy-900"
                            id="catalog-search"
                            placeholder="Cari produk, subkategori, atau merek (cth: variable speed, sand filter, kaporit, impeller)..."
                            data-i18n-placeholder-id="Cari produk, subkategori, atau merek (cth: variable speed, sand filter, kaporit, impeller)..."
                            data-i18n-placeholder-en="Search products, subcategories, or brands (e.g. variable speed, sand filter, chlorine, impeller)..."
                            type="text"
                        />
                    </div>
                    <div class="flex flex-wrap items-center gap-3">
                        <label class="sr-only" for="category-select" data-i18n-en="Select Product Category" data-i18n-id="Pilih Kategori Produk">Pilih Kategori Produk</label>
                        <select class="h-11 px-3.5 pr-9 rounded-lg border border-[#D4D9E2] text-sm text-navy-900 focus:border-navy-900 focus:ring-navy-900 min-w-[235px]" id="category-select">
                            <option value="all" data-i18n-en="All Categories (11)" data-i18n-id="Semua Kategori (11)">Semua Kategori (11)</option>
                            <?php foreach ($productCategories as $cat): ?>
                                <option value="<?= e($cat['slug']) ?>" data-i18n-en="<?= e($cat['num']) ?>. <?= e($cat['name_en']) ?>" data-i18n-id="<?= e($cat['num']) ?>. <?= e($cat['name_id']) ?>"><?= e($cat['num']) ?>. <?= e($cat['name_id']) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button
                            class="h-11 px-4 rounded-lg border border-[#EAE5DC] bg-cream-50 hover:bg-cream-100 text-xs font-semibold text-navy-900 transition-colors"
                            id="reset-filter-btn"
                            type="button"
                            data-i18n-en="Reset Filter"
                            data-i18n-id="Reset Filter"
                        >
                            Reset Filter
                        </button>
                    </div>
                </div>

                <!-- Quick Filter Pills -->
                <div class="pt-3.5 border-t border-[#F0ECE2] flex flex-wrap items-center gap-2">
                    <button class="category-pill h-8 px-3.5 rounded-md text-xs font-semibold bg-navy-900 text-gold-400 border border-navy-900 transition-colors" data-filter="all" data-i18n-en="All (<?= count($products) ?>)" data-i18n-id="Semua (<?= count($products) ?>)" type="button">
                        Semua (<?= count($products) ?>)
                    </button>
                    <?php foreach ($productCategories as $cat): ?>
                        <button class="category-pill h-8 px-3 rounded-md text-xs font-medium bg-cream-50 text-navy-900 border border-[#E6DFD1] hover:border-gold-400 transition-colors" data-filter="<?= e($cat['slug']) ?>" data-i18n-en="<?= e($cat['num']) ?>. <?= e($cat['name_en']) ?>" data-i18n-id="<?= e($cat['num']) ?>. <?= e($cat['name_id']) ?>" type="button">
                            <?= e($cat['num']) ?>. <?= e($cat['name_id']) ?>
                        </button>
                    <?php endforeach; ?>
                </div>

                <div class="pt-2 flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs text-[#5D697A]">
                    <span class="font-medium text-navy-900" id="result-counter" data-i18n-en="Showing <?= count($products) ?> product groups across 11 main categories" data-i18n-id="Menampilkan <?= count($products) ?> kelompok produk dari 11 kategori utama">
                        Menampilkan <?= count($products) ?> kelompok produk dari 11 kategori utama
                    </span>
                    <span data-i18n-en="Project Procurement, Retail &amp; Official WhatsApp Catalog" data-i18n-id="Pengadaan Proyek, Eceran &amp; Katalog WhatsApp Resmi">
                        Pengadaan Proyek, Eceran &amp; Katalog WhatsApp Resmi
                    </span>
                </div>
            </div>

            <!-- Grid 11 Kategori Produk Lengkap -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="product-grid">
                <?php foreach ($products as $prod): ?>
                    <?php
                    $waUrl = dpp_wa_url($prod['wa_text']);
                    $searchIndex = strtolower(implode(' ', [
                        $prod['title'],
                        $prod['title_en'],
                        $prod['category_id'],
                        $prod['category_en'],
                        $prod['brands'],
                        implode(' ', $prod['subcategories']),
                        implode(' ', $prod['subcategories_en'] ?? []),
                        $prod['desc'],
                        $prod['desc_en'] ?? '',
                        implode(' ', $prod['specs']),
                        implode(' ', $prod['specs_en'] ?? []),
                    ]));
                    ?>
                    <article
                        class="product-card bg-white border border-[#EAE5DC] hover:border-gold-400 rounded-2xl overflow-hidden shadow-card-soft hover:shadow-card-hover transition-all duration-200 flex flex-col justify-between"
                        data-category="<?= e($prod['category']) ?>"
                        data-search="<?= e($searchIndex) ?>"
                        id="<?= e($prod['category']) ?>"
                    >
                        <div>
                            <!-- Foto Produk Latar Putih -->
                            <div class="relative w-full aspect-[4/3] bg-white border-b border-[#F0ECE2] p-3 flex items-center justify-center overflow-hidden group">
                                <img
                                    alt="<?= e($prod['alt']) ?>"
                                    class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300"
                                    loading="lazy"
                                    src="<?= e($prod['img']) ?>"
                                />
                                <span class="absolute top-3 left-3 inline-flex items-center gap-1.5 bg-navy-900 text-white px-2.5 py-1 rounded-md text-[11px] font-semibold shadow-sm">
                                    <span class="text-gold-400 font-bold"><?= e($prod['num']) ?></span>
                                    <span data-i18n-en="<?= e($prod['category_en']) ?>" data-i18n-id="<?= e($prod['category_id']) ?>"><?= e($prod['category_id']) ?></span>
                                </span>
                            </div>

                            <div class="p-6 space-y-4">
                                <div>
                                    <p class="text-[10.5px] font-bold uppercase tracking-[0.14em] text-gold-600 mb-1" data-i18n-en="<?= e($prod['category_en']) ?>" data-i18n-id="<?= e($prod['category_id']) ?>">
                                        <?= e($prod['category_en']) ?>
                                    </p>
                                    <h2 class="font-serif font-bold text-lg text-navy-900 leading-snug" data-i18n-en="<?= e($prod['title_en']) ?>" data-i18n-id="<?= e($prod['title']) ?>">
                                        <?= e($prod['title']) ?>
                                    </h2>
                                    <p class="text-xs text-[#7A8596] mt-0.5 italic" data-i18n-en="<?= e($prod['title']) ?>" data-i18n-id="<?= e($prod['title_en']) ?>"><?= e($prod['title_en']) ?></p>
                                </div>

                                <!-- Merek Tersedia -->
                                <div class="bg-cream-50 border border-[#EAE5DC] rounded-lg px-3 py-2 text-xs">
                                    <span class="font-bold text-navy-900" data-i18n-en="Available Brands:" data-i18n-id="Merek Tersedia:">Merek Tersedia:</span>
                                    <span class="text-[#556275] ml-1"><?= e($prod['brands']) ?></span>
                                </div>

                                <!-- Subkategori -->
                                <div class="flex flex-wrap gap-1.5">
                                    <?php foreach ($prod['subcategories'] as $sIdx => $sub): ?>
                                        <?php $subEn = $prod['subcategories_en'][$sIdx] ?? $sub; ?>
                                        <span class="px-2.5 py-0.5 rounded bg-white border border-[#E6DFD1] text-[11px] font-semibold text-navy-900" data-i18n-en="<?= e($subEn) ?>" data-i18n-id="<?= e($sub) ?>">
                                            <?= e($sub) ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>

                                <!-- Deskripsi -->
                                <p class="text-xs sm:text-[13px] text-[#4A5668] leading-relaxed" data-i18n-en="<?= e($prod['desc_en'] ?? $prod['desc']) ?>" data-i18n-id="<?= e($prod['desc']) ?>">
                                    <?= e($prod['desc']) ?>
                                </p>

                                <!-- Spesifikasi Teknis -->
                                <div class="bg-[#FCFBF8] border border-[#EFECE5] rounded-xl p-3.5">
                                    <h3 class="text-[10.5px] font-bold uppercase tracking-wider text-gold-700 mb-2" data-i18n-en="Technical Specifications" data-i18n-id="Spesifikasi Teknis">
                                        Spesifikasi Teknis
                                    </h3>
                                    <ul class="space-y-1.5 text-xs text-[#4A5668]">
                                        <?php foreach ($prod['specs'] as $spIdx => $spec): ?>
                                            <?php $specEn = $prod['specs_en'][$spIdx] ?? $spec; ?>
                                            <li class="flex items-start gap-1.5">
                                                <span class="text-gold-600 font-bold">•</span>
                                                <span data-i18n-en="<?= e($specEn) ?>" data-i18n-id="<?= e($spec) ?>"><?= e($spec) ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Harga & CTA WhatsApp -->
                        <div class="p-6 pt-0 space-y-2.5">
                            <div class="flex items-center justify-between gap-2 text-xs border-t border-[#F0ECE2] pt-3 pb-1 text-[#5D697A]">
                                <span class="font-bold text-navy-900" data-i18n-en="Price Info:" data-i18n-id="Info Harga:">Info Harga:</span>
                                <span class="text-right" data-i18n-en="<?= e($prod['price_label_en'] ?? $prod['price_label']) ?>" data-i18n-id="<?= e($prod['price_label']) ?>"><?= e($prod['price_label']) ?></span>
                            </div>
                            <a
                                class="w-full h-11 bg-gold-400 hover:bg-gold-300 text-navy-950 font-semibold text-xs sm:text-[13px] rounded-md flex items-center justify-center gap-2 shadow-sm transition-colors"
                                href="<?= e($waUrl) ?>"
                                rel="noopener noreferrer"
                                target="_blank"
                            >
                                <span data-i18n-en="Inquire Price via WhatsApp" data-i18n-id="Tanya Harga via WhatsApp">Tanya Harga via WhatsApp</span>
                                <?= render_icon('whatsapp-chat', 'w-4 h-4') ?>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <!-- Empty State -->
            <div class="hidden py-14 px-6 text-center bg-white border border-[#EAE5DC] rounded-2xl shadow-card-soft" id="empty-state">
                <p class="text-xs font-bold uppercase tracking-widest text-gold-600 mb-1" data-i18n-en="CATALOG SEARCH" data-i18n-id="PENCARIAN KATALOG">PENCARIAN KATALOG</p>
                <h3 class="font-serif text-2xl font-semibold text-navy-900" data-i18n-en="Product Not Found" data-i18n-id="Produk Tidak Ditemukan">Produk Tidak Ditemukan</h3>
                <p class="text-xs sm:text-sm text-[#556275] max-w-md mx-auto mt-2 mb-5" data-i18n-en="No categories or brands match your search keywords. Please reset filters or contact our technical team for specific equipment inquiries." data-i18n-id="Tidak ada kategori atau merek yang sesuai kata kunci Anda. Silakan reset filter atau tanyakan tipe unit spesifik langsung kepada tim teknis kami.">
                    Tidak ada kategori atau merek yang sesuai kata kunci Anda. Silakan reset filter atau tanyakan tipe unit spesifik langsung kepada tim teknis kami.
                </p>
                <button class="inline-flex items-center justify-center h-10 px-5 rounded-md bg-navy-900 hover:bg-navy-700 text-white text-xs font-semibold transition-colors" onclick="resetAllFilters()" type="button" data-i18n-en="Display All 11 Categories" data-i18n-id="Tampilkan Semua 11 Kategori">
                    Tampilkan Semua 11 Kategori
                </button>
            </div>

            <!-- Daftar 15 Merek Resmi -->
            <div class="bg-white border border-[#EAE5DC] rounded-2xl p-6 sm:p-8 shadow-card-soft">
                <div class="mb-6">
                    <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-gold-600" data-i18n-en="OFFICIAL PROCUREMENT PARTNERS" data-i18n-id="MITRA PENGADAAN RESMI">MITRA PENGADAAN RESMI</p>
                    <h2 class="font-serif text-2xl font-semibold text-navy-900 mt-1" data-i18n-en="15 Authorized Equipment &amp; Material Brands" data-i18n-id="Daftar 15 Merek Peralatan &amp; Material Pengadaan">
                        Daftar 15 Merek Peralatan &amp; Material Pengadaan
                    </h2>
                    <p class="text-xs sm:text-sm text-[#556275] mt-1" data-i18n-en="Dunia Pool &amp; Pond partners directly with official distributor networks to guarantee genuine pumps, filters, chemicals, mosaics, and certified spare parts." data-i18n-id="Dunia Pool &amp; Pond bermitra dengan jaringan distribusi resmi untuk memastikan keaslian unit pompa, filter, kimia, mozaik, dan suku cadang.">
                        Dunia Pool &amp; Pond bermitra dengan jaringan distribusi resmi untuk memastikan keaslian unit pompa, filter, kimia, mozaik, dan suku cadang.
                    </p>
                </div>
                <?= render_brand_logo_grid($brands) ?>
                <p class="text-xs text-[#7A8596] mt-5" data-i18n-en="*Equipment selection and availability vary by series. Contact +62 821-1807-5560 for stock confirmation and part numbers." data-i18n-id="*Pilihan dan ketersediaan menyesuaikan tipe produk. Hubungi 0821-1807-5560 untuk konfirmasi stok dan nomor part suku cadang.">
                    *Pilihan dan ketersediaan menyesuaikan tipe produk. Hubungi 0821-1807-5560 untuk konfirmasi stok dan nomor part suku cadang.
                </p>
            </div>
        </div>
    </section>
</main>

<?php
$pageScripts = <<<'HTML'
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('catalog-search');
        const categorySelect = document.getElementById('category-select');
        const pills = document.querySelectorAll('.category-pill');
        const cards = document.querySelectorAll('.product-card');
        const counterText = document.getElementById('result-counter');
        const emptyState = document.getElementById('empty-state');
        const resetBtn = document.getElementById('reset-filter-btn');

        const legacyMap = {
            'lampu': 'lighting',
            'skimmer': 'fittings',
            'fitting': 'fittings',
            'mosaic': 'finishing'
        };

        function isEn() {
            return document.documentElement.lang === 'en';
        }

        function setActivePill(filterVal) {
            pills.forEach(p => {
                const isMatch = p.getAttribute('data-filter') === filterVal;
                p.classList.toggle('bg-navy-900', isMatch);
                p.classList.toggle('text-gold-400', isMatch);
                p.classList.toggle('border-navy-900', isMatch);
                p.classList.toggle('font-semibold', isMatch);

                p.classList.toggle('bg-cream-50', !isMatch);
                p.classList.toggle('text-navy-900', !isMatch);
                p.classList.toggle('border-[#E6DFD1]', !isMatch);
                p.classList.toggle('font-medium', !isMatch);
            });
        }

        function filterProducts() {
            const query = searchInput.value.toLowerCase().trim();
            const selectedCat = categorySelect.value;
            let visibleCount = 0;

            cards.forEach(card => {
                const cardCategory = card.getAttribute('data-category');
                const searchBlob = card.getAttribute('data-search') || '';
                const catMatch = (selectedCat === 'all') || (cardCategory === selectedCat);
                const textMatch = query === '' || searchBlob.includes(query);

                if (catMatch && textMatch) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });

            if (visibleCount > 0) {
                emptyState.classList.add('hidden');
                counterText.textContent = isEn()
                    ? `Showing ${visibleCount} of ${cards.length} main product categories`
                    : `Menampilkan ${visibleCount} dari ${cards.length} kategori produk utama`;
            } else {
                emptyState.classList.remove('hidden');
                counterText.textContent = isEn()
                    ? 'No products or subcategories matched your search criteria'
                    : 'Tidak ada produk atau subkategori yang sesuai kriteria pencarian';
            }
        }

        function applyCategoryFilter(rawFilterVal, shouldScroll = false) {
            const filterVal = legacyMap[rawFilterVal] || rawFilterVal;
            const validOption = [...categorySelect.options].some(o => o.value === filterVal);
            const targetVal = validOption ? filterVal : 'all';

            categorySelect.value = targetVal;
            setActivePill(targetVal);
            filterProducts();

            if (shouldScroll && targetVal !== 'all') {
                const grid = document.getElementById('product-grid');
                if (grid) {
                    const y = grid.getBoundingClientRect().top + window.scrollY - 105;
                    window.scrollTo({ top: Math.max(0, y), behavior: 'smooth' });
                }
            }
        }

        searchInput.addEventListener('input', filterProducts);
        categorySelect.addEventListener('change', () => {
            setActivePill(categorySelect.value);
            filterProducts();
        });

        pills.forEach(pill => {
            pill.addEventListener('click', () => applyCategoryFilter(pill.getAttribute('data-filter')));
        });

        window.resetAllFilters = function () {
            searchInput.value = '';
            applyCategoryFilter('all');
            if (window.location.hash) {
                history.replaceState(null, '', window.location.pathname + window.location.search);
            }
        };

        resetBtn.addEventListener('click', window.resetAllFilters);

        function applyHashFilter() {
            const paramCat = new URLSearchParams(window.location.search).get('kategori') || '';
            const hash = (window.location.hash.replace('#', '') || paramCat).toLowerCase();
            if (!hash) return;
            applyCategoryFilter(hash, true);
        }

        applyHashFilter();
        window.addEventListener('hashchange', applyHashFilter);

        // Update dynamic strings when language is switched
        window.addEventListener('dpp:langchange', () => {
            filterProducts();
        });
    });
</script>
HTML;

require __DIR__ . '/../includes/footer.php';
