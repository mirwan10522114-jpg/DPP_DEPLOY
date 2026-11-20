<?php

declare(strict_types=1);

$pageTitle = 'Galeri — Dunia Pool & Pond';
$activeNav = 'galeri';
$showPreFooterCta = true;

$galleryImages = get_company_gallery_images();

$pageScripts = <<<'HTML'
<script>
    (function () {
        const triggers = Array.from(document.querySelectorAll('[data-gallery-index]'));
        const modal = document.getElementById('galleryLightbox');
        const modalImg = document.getElementById('galleryLightboxImg');
        const closeBtn = document.getElementById('galleryLightboxClose');
        const prevBtn = document.getElementById('galleryLightboxPrev');
        const nextBtn = document.getElementById('galleryLightboxNext');

        if (!modal || !modalImg || triggers.length === 0) return;

        let currentIndex = 0;

        function showImage(index) {
            currentIndex = (index + triggers.length) % triggers.length;
            const target = triggers[currentIndex];
            modalImg.src = target.getAttribute('data-gallery-src') || '';
            modalImg.alt = target.getAttribute('data-gallery-alt') || '';
        }

        function openLightbox(index) {
            showImage(index);
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function closeLightbox() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        triggers.forEach((btn, idx) => {
            btn.addEventListener('click', () => openLightbox(idx));
        });

        if (closeBtn) closeBtn.addEventListener('click', closeLightbox);
        if (prevBtn) prevBtn.addEventListener('click', (e) => { e.stopPropagation(); showImage(currentIndex - 1); });
        if (nextBtn) nextBtn.addEventListener('click', (e) => { e.stopPropagation(); showImage(currentIndex + 1); });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeLightbox();
            }
        });

        document.addEventListener('keydown', (e) => {
            if (modal.classList.contains('hidden')) return;
            if (e.key === 'Escape') closeLightbox();
            else if (e.key === 'ArrowLeft') showImage(currentIndex - 1);
            else if (e.key === 'ArrowRight') showImage(currentIndex + 1);
        });
    })();
</script>
HTML;

require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/header.php';
?>

<main class="flex-grow" id="main-content">
    <?= render_page_hero(
        'GALERI PERUSAHAAN',
        'COMPANY GALLERY',
        'Galeri Dunia Pool & Pond',
        'Dunia Pool & Pond Gallery',
        'Kumpulan visual konstruksi kolam renang, ruang mesin, renovasi, pengolahan air, desain 3D, serta perlengkapan kolam renang resmi Dunia Pool & Pond.',
        'Visual collection of swimming pool construction, mechanical rooms, renovations, water treatment, 3D designs, and official equipment by Dunia Pool & Pond.',
        'images/proyek/proyek-4-cihideung'
    ) ?>

    <!-- PURE IMAGE MASONRY GALLERY (ZERO CAPTIONS) -->
    <section class="py-12 sm:py-16 bg-cream-50">
        <div class="max-w-[1340px] mx-auto px-4 sm:px-6 lg:px-10">
            <div class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-4 space-y-4">
                <?php foreach ($galleryImages as $idx => $item): ?>
                    <button
                        aria-label="<?= e($item['alt']) ?>"
                        class="group block w-full break-inside-avoid rounded-xl overflow-hidden bg-white border border-[#EAE5DC] shadow-card-soft hover:shadow-card-hover transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-gold-400 cursor-zoom-in"
                        data-gallery-alt="<?= e($item['alt']) ?>"
                        data-gallery-index="<?= (int) $idx ?>"
                        data-gallery-src="<?= e($item['src']) ?>"
                        type="button"
                    >
                        <img
                            alt="<?= e($item['alt']) ?>"
                            class="w-full h-auto block object-cover group-hover:scale-[1.03] transition-transform duration-300"
                            loading="lazy"
                            src="<?= e($item['src']) ?>"
                        />
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- PURE IMAGE LIGHTBOX MODAL -->
    <div
        aria-label="Pratinjau Gambar Galeri"
        aria-modal="true"
        class="hidden fixed inset-0 z-[100] bg-navy-950/95 backdrop-blur-sm items-center justify-center p-4 sm:p-8"
        id="galleryLightbox"
        role="dialog"
    >
        <button
            aria-label="Tutup"
            class="absolute top-4 right-4 sm:top-6 sm:right-6 w-11 h-11 rounded-full bg-white/10 hover:bg-gold-400 text-white hover:text-navy-950 flex items-center justify-center transition-colors focus:outline-none focus:ring-2 focus:ring-gold-400"
            id="galleryLightboxClose"
            type="button"
        >
            <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                <path d="M18 6 6 18M6 6l12 12" />
            </svg>
        </button>

        <button
            aria-label="Gambar Sebelumnya"
            class="absolute left-3 sm:left-6 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/10 hover:bg-gold-400 text-white hover:text-navy-950 flex items-center justify-center transition-colors focus:outline-none focus:ring-2 focus:ring-gold-400"
            id="galleryLightboxPrev"
            type="button"
        >
            <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                <path d="m15 18-6-6 6-6" />
            </svg>
        </button>

        <img
            alt=""
            class="max-w-[90vw] max-h-[86vh] w-auto h-auto object-contain rounded-xl shadow-2xl select-none"
            id="galleryLightboxImg"
            src=""
        />

        <button
            aria-label="Gambar Berikutnya"
            class="absolute right-3 sm:right-6 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/10 hover:bg-gold-400 text-white hover:text-navy-950 flex items-center justify-center transition-colors focus:outline-none focus:ring-2 focus:ring-gold-400"
            id="galleryLightboxNext"
            type="button"
        >
            <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                <path d="m9 18 6-6-6-6" />
            </svg>
        </button>
    </div>
</main>

<?php
require __DIR__ . '/../includes/footer.php';
