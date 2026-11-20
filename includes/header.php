<?php

declare(strict_types=1);

$activeNav = $activeNav ?? 'beranda';

$navItems = [
    ['key' => 'beranda',   'label' => 'Beranda',          'label_en' => 'Home',        'href' => app_url('/')],
    ['key' => 'tentang',   'label' => 'Tentang Kami',     'label_en' => 'About Us',    'href' => app_url('/tentang-kami')],
    ['key' => 'layanan',   'label' => 'Layanan',          'label_en' => 'Services',    'href' => app_url('/layanan')],
    ['key' => 'proyek',    'label' => 'Proyek',           'label_en' => 'Projects',    'href' => app_url('/proyek')],
    ['key' => 'galeri',    'label' => 'Galeri',           'label_en' => 'Gallery',     'href' => app_url('/galeri')],
    ['key' => 'manajemen', 'label' => 'Manajemen Proyek', 'label_en' => 'Project SOP', 'href' => app_url('/manajemen-proyek')],
    ['key' => 'produk',    'label' => 'Produk',           'label_en' => 'Products',    'href' => app_url('/produk')],
    ['key' => 'kontak',    'label' => 'Kontak',           'label_en' => 'Contact',     'href' => app_url('/kontak')],
];
?>
<header class="sticky top-0 z-50 w-full bg-navy-900/95 backdrop-blur-md border-b border-white/[0.07] transition-colors duration-200">
    <div class="max-w-[1340px] mx-auto px-5 sm:px-8 lg:px-10 h-20 flex items-center justify-between gap-4">
        <!-- Brand Logo -->
        <a aria-label="Dunia Pool &amp; Pond — Beranda" class="shrink-0 rounded-md focus:outline-none focus:ring-2 focus:ring-gold-400 focus:ring-offset-2 focus:ring-offset-navy-900" href="<?= e(app_url('/')) ?>">
            <?= render_brand_logo() ?>
        </a>

        <!-- Desktop Navigation -->
        <nav aria-label="Navigasi Utama" class="hidden xl:flex items-center gap-5">
            <?php foreach ($navItems as $item): ?>
                <?php $isActive = ($activeNav === $item['key']); ?>
                <a
                    <?= $isActive ? 'aria-current="page"' : '' ?>
                    class="relative py-2 text-[13.5px] font-medium tracking-wide whitespace-nowrap transition-colors duration-150 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold-400 rounded-sm <?= $isActive ? 'text-gold-400 font-semibold' : 'text-white/85 hover:text-gold-400' ?>"
                    data-i18n-en="<?= e($item['label_en']) ?>"
                    data-i18n-id="<?= e($item['label']) ?>"
                    href="<?= e($item['href']) ?>"
                >
                    <span><?= e($item['label']) ?></span>
                    <?php if ($isActive): ?>
                        <span aria-hidden="true" class="absolute left-1/2 -translate-x-1/2 -bottom-0.5 w-5 h-[2px] rounded-full bg-gold-400"></span>
                    <?php endif; ?>
                </a>
            <?php endforeach; ?>
        </nav>

        <!-- Right CTA & Language Selector -->
        <div class="flex items-center gap-2.5 shrink-0">
            <a
                class="hidden sm:inline-flex items-center justify-center gap-2 bg-gold-400 hover:bg-gold-300 text-navy-950 font-semibold text-xs px-4 h-10 rounded-md shadow-sm transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-gold-300 focus:ring-offset-2 focus:ring-offset-navy-900"
                href="<?= e(app_url('/kontak')) ?>"
            >
                <span data-i18n-en="Consult Now" data-i18n-id="Konsultasi Proyek">Konsultasi Proyek</span>
                <?= render_icon('whatsapp-chat', 'w-4 h-4 text-navy-950') ?>
            </a>

            <!-- Language Switcher Dropdown -->
            <div class="relative">
                <button
                    aria-expanded="false"
                    aria-haspopup="true"
                    aria-label="Pilih bahasa"
                    class="inline-flex items-center justify-center gap-2 h-10 px-3 rounded-md border border-white/25 hover:border-gold-400/70 text-white text-xs font-medium transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-gold-400"
                    id="langDropdownBtn"
                    type="button"
                >
                    <svg aria-hidden="true" class="lang-flag-id w-5 h-3.5 rounded-[2px] ring-1 ring-white/25 overflow-hidden shrink-0" viewBox="0 0 24 16" xmlns="http://www.w3.org/2000/svg">
                        <rect width="24" height="8" fill="#CE1126" />
                        <rect y="8" width="24" height="8" fill="#FFFFFF" />
                    </svg>
                    <svg aria-hidden="true" class="lang-flag-en hidden w-5 h-3.5 rounded-[2px] ring-1 ring-white/25 overflow-hidden shrink-0" viewBox="0 0 24 16" xmlns="http://www.w3.org/2000/svg">
                        <rect width="24" height="16" fill="#012169" />
                        <path d="M0 0L24 16M24 0L0 16" stroke="#FFFFFF" stroke-width="3.2" />
                        <path d="M0 0L24 16M24 0L0 16" stroke="#C8102E" stroke-width="1.4" />
                        <path d="M12 0V16M0 8H24" stroke="#FFFFFF" stroke-width="4.8" />
                        <path d="M12 0V16M0 8H24" stroke="#C8102E" stroke-width="2.6" />
                    </svg>
                    <span id="currentLangLabel">ID</span>
                    <svg aria-hidden="true" class="w-3.5 h-3.5 text-white/75" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" viewBox="0 0 16 16">
                        <path d="M4 6l4 4 4-4" />
                    </svg>
                </button>
                <div
                    aria-labelledby="langDropdownBtn"
                    class="hidden absolute right-0 mt-2 w-44 rounded-lg bg-navy-850 border border-white/15 shadow-xl py-1 z-50 text-xs text-white"
                    id="langDropdownMenu"
                    role="menu"
                >
                    <button class="w-full px-3.5 py-2.5 text-left hover:bg-white/10 flex items-center justify-between gap-2 font-medium text-gold-400 transition-colors" data-set-lang="id" role="menuitem" type="button">
                        <span class="inline-flex items-center gap-2.5">
                            <svg aria-hidden="true" class="w-5 h-3.5 rounded-[2px] ring-1 ring-white/25 overflow-hidden shrink-0" viewBox="0 0 24 16" xmlns="http://www.w3.org/2000/svg">
                                <rect width="24" height="8" fill="#CE1126" />
                                <rect y="8" width="24" height="8" fill="#FFFFFF" />
                            </svg>
                            <span>Indonesia (ID)</span>
                        </span>
                        <span class="lang-check-id">✓</span>
                    </button>
                    <button class="w-full px-3.5 py-2.5 text-left hover:bg-white/10 flex items-center justify-between gap-2 font-medium text-white/85 transition-colors" data-set-lang="en" role="menuitem" type="button">
                        <span class="inline-flex items-center gap-2.5">
                            <svg aria-hidden="true" class="w-5 h-3.5 rounded-[2px] ring-1 ring-white/25 overflow-hidden shrink-0" viewBox="0 0 24 16" xmlns="http://www.w3.org/2000/svg">
                                <rect width="24" height="16" fill="#012169" />
                                <path d="M0 0L24 16M24 0L0 16" stroke="#FFFFFF" stroke-width="3.2" />
                                <path d="M0 0L24 16M24 0L0 16" stroke="#C8102E" stroke-width="1.4" />
                                <path d="M12 0V16M0 8H24" stroke="#FFFFFF" stroke-width="4.8" />
                                <path d="M12 0V16M0 8H24" stroke="#C8102E" stroke-width="2.6" />
                            </svg>
                            <span>English (EN)</span>
                        </span>
                        <span class="lang-check-en hidden">✓</span>
                    </button>
                </div>
            </div>

            <!-- Mobile Hamburger Button -->
            <button
                aria-controls="mobileNavDrawer"
                aria-expanded="false"
                aria-label="Buka menu navigasi"
                class="xl:hidden inline-flex items-center justify-center w-10 h-10 rounded-md border border-white/20 text-white hover:border-gold-400 hover:text-gold-400 transition-colors focus:outline-none focus:ring-2 focus:ring-gold-400"
                id="mobileMenuBtn"
                type="button"
            >
                <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" viewBox="0 0 24 24">
                    <path d="M4 7h16M4 12h16M4 17h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Drawer -->
    <div class="hidden xl:hidden bg-navy-900 border-t border-white/10 px-5 sm:px-8 py-4 space-y-1.5 shadow-2xl" id="mobileNavDrawer">
        <?php foreach ($navItems as $item): ?>
            <?php $isActive = ($activeNav === $item['key']); ?>
            <a
                <?= $isActive ? 'aria-current="page"' : '' ?>
                class="block px-3 py-2.5 rounded-md text-sm font-medium transition-colors <?= $isActive ? 'bg-white/[0.06] text-gold-400 font-semibold border-l-2 border-gold-400' : 'text-white/85 hover:bg-white/[0.04] hover:text-gold-400' ?>"
                data-i18n-en="<?= e($item['label_en']) ?>"
                data-i18n-id="<?= e($item['label']) ?>"
                href="<?= e($item['href']) ?>"
            >
                <?= e($item['label']) ?>
            </a>
        <?php endforeach; ?>
        <div class="pt-3 border-t border-white/10 sm:hidden">
            <a class="w-full inline-flex items-center justify-center gap-2 bg-gold-400 hover:bg-gold-300 text-navy-950 font-semibold text-xs px-4 h-10 rounded-md transition-colors" href="<?= e(app_url('/kontak')) ?>">
                <span data-i18n-en="Consult Now" data-i18n-id="Konsultasi Proyek">Konsultasi Proyek</span>
                <?= render_icon('whatsapp-chat', 'w-4 h-4 text-navy-950') ?>
            </a>
        </div>
    </div>
</header>
