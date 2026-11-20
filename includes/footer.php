<?php

declare(strict_types=1);

$showPreFooterCta = $showPreFooterCta ?? true;
$sectors = get_portfolio_sectors();
$mapsUrl = 'https://www.google.com/maps/place/Alat+Kolam+Renang+Bandung+Barat/data=!4m2!3m1!1s0x2e68e331a6058d93:0x6f8552486c06e786?sa=X&ved=1t:242&hl=id&ictx=111';
?>

<?php if ($showPreFooterCta): ?>
    <!-- PRE-FOOTER COLLABORATION / CONSULTATION CTA BANNER -->
    <section class="relative overflow-hidden bg-[#081728] border-t border-b border-white/[0.08]">
        <!-- Subtle Golden Ambient Glow & Geometric Angular Monogram Motif on Right -->
        <div aria-hidden="true" class="pointer-events-none absolute inset-y-0 right-0 w-full max-w-xl overflow-hidden">
            <div class="absolute -right-12 -top-16 w-80 h-80 rounded-full bg-gold-400/15 blur-3xl"></div>
            <svg class="absolute right-0 bottom-0 h-full w-auto text-gold-400 opacity-30" viewBox="0 0 340 160" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M165 160L235 28L305 160H282L235 72L188 160H165Z" fill="url(#ctaChevron1)" />
                <path d="M235 160L298 42L361 160H338L298 85L258 160H235Z" fill="url(#ctaChevron2)" />
                <defs>
                    <linearGradient id="ctaChevron1" x1="235" y1="28" x2="235" y2="160" gradientUnits="userSpaceOnUse">
                        <stop offset="0%" stop-color="#E8C278" stop-opacity="0.85" />
                        <stop offset="100%" stop-color="#B8893A" stop-opacity="0.15" />
                    </linearGradient>
                    <linearGradient id="ctaChevron2" x1="298" y1="42" x2="298" y2="160" gradientUnits="userSpaceOnUse">
                        <stop offset="0%" stop-color="#DFB465" stop-opacity="0.55" />
                        <stop offset="100%" stop-color="#081728" stop-opacity="0" />
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <div class="max-w-[1260px] mx-auto px-5 sm:px-8 lg:px-10 py-11 sm:py-12 relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2
                    class="font-serif text-xl sm:text-2xl lg:text-[27px] font-semibold text-gold-400 leading-snug"
                    data-i18n-en="Optimize Your Property with a Precision-Engineered Pool"
                    data-i18n-id="Wujudkan Kolam Renang Berkualitas &amp; Bebas Bocor Bersama Spesialis"
                >
                    Wujudkan Kolam Renang Berkualitas &amp; Bebas Bocor Bersama Spesialis
                </h2>
                <p
                    class="text-white/80 text-xs sm:text-sm mt-1.5"
                    data-i18n-en="Consult your pool layout, circulation system, renovation, or equipment needs directly with our technical team since 1997."
                    data-i18n-id="Konsultasikan rancangan lahan, sistem sirkulasi, renovasi, maupun pengadaan mesin bersama tim teknis kami sejak 1997."
                >
                    Konsultasikan rancangan lahan, sistem sirkulasi, renovasi, maupun pengadaan mesin bersama tim teknis kami sejak 1997.
                </p>
            </div>
            <div class="shrink-0 flex flex-wrap items-center gap-3">
                <a
                    class="inline-flex items-center justify-center gap-2.5 bg-gold-400 hover:bg-gold-300 text-navy-950 font-semibold text-xs sm:text-sm px-6 h-11 rounded-md shadow-md transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-gold-300 focus:ring-offset-2 focus:ring-offset-navy-900"
                    href="<?= e(dpp_wa_url('Halo Dunia Pool & Pond, saya ingin berkonsultasi mengenai kebutuhan kolam renang.')) ?>"
                    rel="noopener noreferrer"
                    target="_blank"
                >
                    <span data-i18n-en="WhatsApp: 0821-1807-5560" data-i18n-id="WhatsApp: 0821-1807-5560">WhatsApp: 0821-1807-5560</span>
                    <?= render_icon('whatsapp-chat', 'w-4 h-4') ?>
                </a>
                <a
                    class="inline-flex items-center justify-center gap-2 border border-white/30 hover:border-gold-400 text-white hover:text-gold-300 font-medium text-xs sm:text-sm px-5 h-11 rounded-md transition-colors duration-150"
                    href="<?= e(app_url('/kontak')) ?>"
                >
                    <span data-i18n-en="Consultation Form" data-i18n-id="Formulir Konsultasi">Formulir Konsultasi</span>
                    <?= render_icon('arrow-right', 'w-4 h-4') ?>
                </a>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- MAIN CORPORATE FOOTER -->
<footer class="bg-navy-850 text-white mt-auto">
    <div class="max-w-[1260px] mx-auto px-5 sm:px-8 lg:px-10 pt-14 pb-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8">
            <!-- Column 1: Brand & Socials -->
            <div class="sm:col-span-2 lg:col-span-4 space-y-5 pr-0 lg:pr-6">
                <a aria-label="Dunia Pool &amp; Pond — Beranda" class="inline-block focus:outline-none focus:ring-2 focus:ring-gold-400 rounded-md" href="<?= e(app_url('/')) ?>">
                    <?= render_brand_logo('default', true) ?>
                </a>
                <p
                    class="text-white/70 text-xs sm:text-[13px] leading-relaxed max-w-xs"
                    data-i18n-en="Dunia Pool &amp; Pond is a swimming pool construction, circulation &amp; filtration engineering, equipment supply, and water maintenance specialist established on August 10, 1997."
                    data-i18n-id="Dunia Pool &amp; Pond adalah spesialis konstruksi kolam renang, sistem sirkulasi &amp; filtrasi, pengadaan peralatan filter &amp; pompa, serta pemeliharaan air profesional sejak 10 Agustus 1997."
                >
                    Dunia Pool &amp; Pond adalah spesialis konstruksi kolam renang, sistem sirkulasi &amp; filtrasi, pengadaan peralatan filter &amp; pompa, serta pemeliharaan air profesional sejak 10 Agustus 1997.
                </p>
                <div class="flex items-center gap-2.5 pt-1">
                    <!-- WhatsApp -->
                    <a aria-label="WhatsApp Resmi Dunia Pool &amp; Pond" class="w-9 h-9 rounded-full border border-white/25 hover:border-gold-400 hover:text-gold-400 text-white/85 flex items-center justify-center transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-gold-400" href="https://wa.me/6282118075560" rel="noopener noreferrer" target="_blank">
                        <?= render_icon('whatsapp-chat', 'w-4 h-4') ?>
                    </a>
                    <!-- Instagram -->
                    <a aria-label="Instagram @duniapoolnpond" class="w-9 h-9 rounded-full border border-white/25 hover:border-gold-400 hover:text-gold-400 text-white/85 flex items-center justify-center transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-gold-400" href="https://www.instagram.com/duniapoolnpond/" rel="noopener noreferrer" target="_blank">
                        <svg aria-hidden="true" class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                            <path d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4H7.6m9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8 1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5 5 5 0 0 1-5 5 5 5 0 0 1-5-5 5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3 3 3 0 0 0 3 3 3 3 0 0 0 3-3 3 3 0 0 0-3-3Z" />
                        </svg>
                    </a>
                    <!-- YouTube -->
                    <a aria-label="YouTube Dunia Pool &amp; Pond" class="w-9 h-9 rounded-full border border-white/25 hover:border-gold-400 hover:text-gold-400 text-white/85 flex items-center justify-center transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-gold-400" href="https://youtu.be/I52l1338954?si=0qZSMHI5d7VRCQGS" rel="noopener noreferrer" target="_blank">
                        <svg aria-hidden="true" class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                            <path d="M23.5 6.19a3.02 3.02 0 0 0-2.12-2.14C19.5 3.55 12 3.55 12 3.55s-7.5 0-9.38.5A3.02 3.02 0 0 0 .5 6.19C0 8.07 0 12 0 12s0 3.93.5 5.81a3.02 3.02 0 0 0 2.12 2.14c1.88.5 9.38.5 9.38.5s7.5 0 9.38-.5a3.02 3.02 0 0 0 2.12-2.14C24 15.93 24 12 24 12s0-3.93-.5-5.81ZM9.55 15.57V8.43L15.82 12l-6.27 3.57Z" />
                        </svg>
                    </a>
                    <!-- Google Maps -->
                    <a aria-label="Lokasi Google Maps Dunia Pool &amp; Pond" class="w-9 h-9 rounded-full border border-white/25 hover:border-gold-400 hover:text-gold-400 text-white/85 flex items-center justify-center transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-gold-400" href="<?= e($mapsUrl) ?>" rel="noopener noreferrer" target="_blank">
                        <svg aria-hidden="true" class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" viewBox="0 0 24 24">
                            <path d="M12 21s-7-5.6-7-11a7 7 0 1 1 14 0c0 5.4-7 11-7 11Z" />
                            <circle cx="12" cy="10" r="2.5" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Column 2: Navigasi -->
            <div class="lg:col-span-2 space-y-3.5">
                <h3 class="text-xs font-bold text-white tracking-wide" data-i18n-en="Navigation" data-i18n-id="Navigasi">Navigasi</h3>
                <ul class="space-y-2.5 text-xs text-white/70">
                    <li><a class="hover:text-gold-400 transition-colors" data-i18n-en="Home" data-i18n-id="Beranda" href="<?= e(app_url('/')) ?>">Beranda</a></li>
                    <li><a class="hover:text-gold-400 transition-colors" data-i18n-en="About Us" data-i18n-id="Tentang Kami" href="<?= e(app_url('/tentang-kami')) ?>">Tentang Kami</a></li>
                    <li><a class="hover:text-gold-400 transition-colors" data-i18n-en="Our Services" data-i18n-id="Layanan Kami" href="<?= e(app_url('/layanan')) ?>">Layanan Kami</a></li>
                    <li><a class="hover:text-gold-400 transition-colors" data-i18n-en="Project Portfolio" data-i18n-id="Dokumentasi Proyek" href="<?= e(app_url('/proyek')) ?>">Dokumentasi Proyek</a></li>
                    <li><a class="hover:text-gold-400 transition-colors" data-i18n-en="Gallery" data-i18n-id="Galeri" href="<?= e(app_url('/galeri')) ?>">Galeri</a></li>
                    <li><a class="hover:text-gold-400 transition-colors" data-i18n-en="Project SOP" data-i18n-id="Manajemen Proyek" href="<?= e(app_url('/manajemen-proyek')) ?>">Manajemen Proyek</a></li>
                    <li><a class="hover:text-gold-400 transition-colors" data-i18n-en="Product Catalog" data-i18n-id="Katalog Produk" href="<?= e(app_url('/produk')) ?>">Katalog Produk</a></li>
                    <li><a class="hover:text-gold-400 transition-colors" data-i18n-en="Contact Us" data-i18n-id="Kontak Teknis" href="<?= e(app_url('/kontak')) ?>">Kontak Teknis</a></li>
                </ul>
            </div>

            <!-- Column 3: Layanan Kami -->
            <div class="lg:col-span-2 space-y-3.5">
                <h3 class="text-xs font-bold text-white tracking-wide" data-i18n-en="Our Services" data-i18n-id="Layanan Kami">Layanan Kami</h3>
                <ul class="space-y-2.5 text-xs text-white/70">
                    <?php foreach ($sectors as $sec): ?>
                        <li>
                            <a
                                class="hover:text-gold-400 transition-colors"
                                data-i18n-en="<?= e($sec['title_en']) ?>"
                                data-i18n-id="<?= e($sec['title']) ?>"
                                href="<?= e($sec['href']) ?>"
                            ><?= e($sec['title']) ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Column 4: Katalog Produk -->
            <div class="lg:col-span-2 space-y-3.5">
                <h3 class="text-xs font-bold text-white tracking-wide" data-i18n-en="Product Catalog" data-i18n-id="Katalog Produk">Katalog Produk</h3>
                <ul class="space-y-2.5 text-xs text-white/70">
                    <li><a class="hover:text-gold-400 transition-colors" data-i18n-en="Swimming Pool Pumps" data-i18n-id="Pompa Kolam Renang" href="<?= e(app_url('/produk#pompa')) ?>">Pompa Kolam Renang</a></li>
                    <li><a class="hover:text-gold-400 transition-colors" data-i18n-en="Sand &amp; Cartridge Filters" data-i18n-id="Filter Kolam Renang" href="<?= e(app_url('/produk#filter')) ?>">Filter Kolam Renang</a></li>
                    <li><a class="hover:text-gold-400 transition-colors" data-i18n-en="Cleaning Equipment" data-i18n-id="Peralatan Pembersih" href="<?= e(app_url('/produk#cleaner')) ?>">Peralatan Pembersih</a></li>
                    <li><a class="hover:text-gold-400 transition-colors" data-i18n-en="Pool Chemicals" data-i18n-id="Bahan Kimia Kolam" href="<?= e(app_url('/produk#chemical')) ?>">Bahan Kimia Kolam</a></li>
                    <li><a class="hover:text-gold-400 transition-colors" data-i18n-en="LED Lights &amp; Fittings" data-i18n-id="Lampu &amp; Fitting Pipa" href="<?= e(app_url('/produk#lighting')) ?>">Lampu &amp; Fitting Pipa</a></li>
                    <li><a class="hover:text-gold-400 transition-colors" data-i18n-en="Mosaic &amp; Spare Parts" data-i18n-id="Mozaik &amp; Suku Cadang" href="<?= e(app_url('/produk#finishing')) ?>">Mozaik &amp; Suku Cadang</a></li>
                </ul>
            </div>

            <!-- Column 5: Kontak -->
            <div class="sm:col-span-2 lg:col-span-2 space-y-3.5">
                <h3 class="text-xs font-bold text-white tracking-wide" data-i18n-en="Official Contact" data-i18n-id="Kontak Resmi">Kontak Resmi</h3>
                <ul class="space-y-3 text-xs text-white/70">
                    <li class="flex items-start gap-2.5">
                        <svg aria-hidden="true" class="w-4 h-4 text-gold-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" viewBox="0 0 24 24">
                            <path d="M12 21s-7-5.6-7-11a7 7 0 1 1 14 0c0 5.4-7 11-7 11Z" />
                            <circle cx="12" cy="10" r="2.5" />
                        </svg>
                        <a class="leading-relaxed hover:text-gold-400 transition-colors" href="<?= e($mapsUrl) ?>" rel="noopener noreferrer" target="_blank">
                            Gg. Karya Bakti No. 24, RT.05/RW.22, Kertamulya,<br />
                            Kec. Padalarang, Kab. Bandung Barat 40553
                        </a>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <svg aria-hidden="true" class="w-4 h-4 text-gold-400 shrink-0" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" viewBox="0 0 24 24">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.58 2.81.7A2 2 0 0 1 22 16.92Z" />
                        </svg>
                        <a class="hover:text-gold-400 transition-colors font-semibold text-white/90" href="https://wa.me/6282118075560" rel="noopener noreferrer" target="_blank">0821-1807-5560 (WhatsApp)</a>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <svg aria-hidden="true" class="w-4 h-4 text-gold-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="9" />
                            <path d="M12 7v5l3 2" />
                        </svg>
                        <span data-i18n-en="Mon – Sat, 08:00 – 17:00 WIB" data-i18n-id="Senin – Sabtu, 08:00 – 17:00 WIB">Senin – Sabtu, 08:00 – 17:00 WIB</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bottom Copyright Bar -->
    <div class="border-t border-white/[0.08] bg-navy-900/70">
        <div class="max-w-[1260px] mx-auto px-5 sm:px-8 lg:px-10 py-4 flex flex-col sm:flex-row items-center justify-between gap-3 text-[11.5px] text-white/60">
            <p>© 1997–<?= e(date('Y')) ?> Dunia Pool &amp; Pond. The Pool Specialist — Padalarang, Bandung Barat.</p>
            <div class="flex flex-wrap items-center justify-center gap-3">
                <a class="hover:text-gold-400 transition-colors" href="<?= e(app_url('/sitemap')) ?>">Sitemap</a>
                <span aria-hidden="true" class="text-white/25">|</span>
                <a class="hover:text-gold-400 transition-colors" data-i18n-en="Privacy Policy" data-i18n-id="Kebijakan Privasi" href="<?= e(app_url('/kebijakan-privasi')) ?>">Kebijakan Privasi</a>
                <span aria-hidden="true" class="text-white/25">|</span>
                <a class="hover:text-gold-400 transition-colors" data-i18n-en="Terms of Service" data-i18n-id="Ketentuan Layanan" href="<?= e(app_url('/ketentuan-layanan')) ?>">Ketentuan Layanan</a>
            </div>
        </div>
    </div>
</footer>

<script>
    (function () {
        // Mobile Drawer
        const mobileBtn = document.getElementById('mobileMenuBtn');
        const mobileDrawer = document.getElementById('mobileNavDrawer');
        if (mobileBtn && mobileDrawer) {
            mobileBtn.addEventListener('click', () => {
                const isHidden = mobileDrawer.classList.toggle('hidden');
                mobileBtn.setAttribute('aria-expanded', String(!isHidden));
            });
        }

        // Language Switcher (ID / EN)
        const langBtn = document.getElementById('langDropdownBtn');
        const langMenu = document.getElementById('langDropdownMenu');
        const currentLangLabel = document.getElementById('currentLangLabel');

        function applyLanguage(lang) {
            const normalized = lang === 'en' ? 'en' : 'id';
            document.documentElement.lang = normalized;
            if (currentLangLabel) {
                currentLangLabel.textContent = normalized.toUpperCase();
            }

            // 1. Plain text translations
            document.querySelectorAll('[data-i18n-id]').forEach(el => {
                const text = el.getAttribute(normalized === 'en' ? 'data-i18n-en' : 'data-i18n-id');
                if (text !== null && text !== undefined) {
                    if (el.tagName === 'OPTION') {
                        el.textContent = text;
                    } else if (el.children.length === 1 && el.firstElementChild.tagName === 'SPAN' && !el.firstElementChild.hasAttribute('aria-hidden')) {
                        el.firstElementChild.textContent = text;
                    } else if (el.children.length === 0) {
                        el.textContent = text;
                    } else {
                        const firstSpan = el.querySelector(':scope > span:not([aria-hidden="true"])');
                        if (firstSpan) {
                            firstSpan.textContent = text;
                        } else {
                            el.textContent = text;
                        }
                    }
                }
            });

            // 2. Formatted HTML translations
            document.querySelectorAll('[data-i18n-html-id]').forEach(el => {
                const html = el.getAttribute(normalized === 'en' ? 'data-i18n-html-en' : 'data-i18n-html-id');
                if (html !== null && html !== undefined) {
                    el.innerHTML = html;
                }
            });

            // 3. Input & Textarea Placeholders
            document.querySelectorAll('[data-i18n-placeholder-id]').forEach(el => {
                const placeholder = el.getAttribute(normalized === 'en' ? 'data-i18n-placeholder-en' : 'data-i18n-placeholder-id');
                if (placeholder !== null && placeholder !== undefined) {
                    el.placeholder = placeholder;
                }
            });

            // 4. Title / Tooltip Attributes
            document.querySelectorAll('[data-i18n-title-id]').forEach(el => {
                const titleVal = el.getAttribute(normalized === 'en' ? 'data-i18n-title-en' : 'data-i18n-title-id');
                if (titleVal !== null && titleVal !== undefined) {
                    el.setAttribute('title', titleVal);
                }
            });

            // 5. Active indicator marks, flags & highlight color in dropdown
            document.querySelectorAll('.lang-check-id').forEach(el => el.classList.toggle('hidden', normalized !== 'id'));
            document.querySelectorAll('.lang-check-en').forEach(el => el.classList.toggle('hidden', normalized !== 'en'));
            document.querySelectorAll('.lang-flag-id').forEach(el => el.classList.toggle('hidden', normalized !== 'id'));
            document.querySelectorAll('.lang-flag-en').forEach(el => el.classList.toggle('hidden', normalized !== 'en'));
            document.querySelectorAll('[data-set-lang]').forEach(btn => {
                const isSelected = btn.getAttribute('data-set-lang') === normalized;
                btn.classList.toggle('text-gold-400', isSelected);
                btn.classList.toggle('text-white/85', !isSelected);
            });

            // 6. Persistence in localStorage & cookie (for server-side detection)
            try {
                localStorage.setItem('dpp_lang', normalized);
                document.cookie = "dpp_lang=" + normalized + ";path=/;max-age=31536000;SameSite=Lax";
            } catch (e) {}

            // 7. Dispatch event for dynamic page components
            try {
                window.dispatchEvent(new CustomEvent('dpp:langchange', { detail: { lang: normalized } }));
            } catch (e) {}
        }

        if (langBtn && langMenu) {
            langBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                const isHidden = langMenu.classList.toggle('hidden');
                langBtn.setAttribute('aria-expanded', String(!isHidden));
            });
            langMenu.querySelectorAll('[data-set-lang]').forEach(item => {
                item.addEventListener('click', () => {
                    applyLanguage(item.getAttribute('data-set-lang'));
                    langMenu.classList.add('hidden');
                    langBtn.setAttribute('aria-expanded', 'false');
                });
            });
            document.addEventListener('click', (e) => {
                if (!langMenu.contains(e.target) && !langBtn.contains(e.target)) {
                    langMenu.classList.add('hidden');
                    langBtn.setAttribute('aria-expanded', 'false');
                }
            });
        }

        try {
            const savedLang = localStorage.getItem('dpp_lang');
            if (savedLang === 'en') {
                applyLanguage('en');
            }
        } catch (e) {}

        // Subtle Scroll Reveal
        const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        const revealEls = document.querySelectorAll('.reveal-up');
        if (!prefersReduced && 'IntersectionObserver' in window && revealEls.length > 0) {
            const obs = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.08, rootMargin: '0px 0px -24px 0px' });

            revealEls.forEach(el => {
                if (el.getBoundingClientRect().top < window.innerHeight * 0.92) {
                    el.classList.add('is-visible');
                } else {
                    obs.observe(el);
                }
            });
        } else {
            revealEls.forEach(el => el.classList.add('is-visible'));
        }
    })();
</script>
<?php if (!empty($pageScripts)): ?>
    <?= $pageScripts ?>
<?php endif; ?>
</body>
</html>
