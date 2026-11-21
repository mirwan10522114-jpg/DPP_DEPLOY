<?php

declare(strict_types=1);

/**
 * Menghitung base path aplikasi agar URL bekerja otomatis baik di root domain,
 * PHP built-in server, maupun subfolder Laragon.
 */
function app_base_path(): string
{
    static $cached = null;
    if ($cached !== null) {
        return $cached;
    }

    $docRootRaw = $_SERVER['DOCUMENT_ROOT'] ?? '';
    $docRoot = $docRootRaw !== '' ? realpath($docRootRaw) : false;
    $appRoot = realpath(__DIR__ . '/..');

    if ($docRoot !== false && $appRoot !== false) {
        $docNorm = str_replace('\\', '/', rtrim($docRoot, '\\/'));
        $appNorm = str_replace('\\', '/', rtrim($appRoot, '\\/'));
        if (stripos($appNorm, $docNorm) === 0) {
            $rel = trim(substr($appNorm, strlen($docNorm)), '/');
            if ($rel !== '') {
                $segments = array_map('rawurlencode', explode('/', $rel));
                $cached = '/' . implode('/', $segments);
                return $cached;
            }
        }
    }

    $cached = '';
    return $cached;
}

/**
 * Membentuk URL internal aplikasi yang aman terhadap subfolder maupun root.
 */
function app_url(string $path = '/'): string
{
    $base = app_base_path();
    if ($path === '' || $path === '/') {
        return $base !== '' ? $base . '/' : '/';
    }
    if ($path[0] === '#') {
        return ($base !== '' ? $base . '/' : '/') . $path;
    }
    $normalized = '/' . ltrim($path, '/');
    return $base . $normalized;
}

/**
 * Escape string aman untuk HTML.
 */
function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Mencari aset gambar lokal dengan cache-busting hash otomatis.
 */
function resolve_image(string $relativePathWithoutExt, string $fallbackUrl = ''): string
{
    $extensions = ['webp', 'jpg', 'jpeg', 'png', 'svg'];
    $rootDir = realpath(__DIR__ . '/..');
    if ($rootDir === false) {
        return $fallbackUrl;
    }

    $normalizedRel = trim(str_replace('\\', '/', $relativePathWithoutExt), '/');
    foreach ($extensions as $ext) {
        $candidate = $rootDir . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $normalizedRel . '.' . $ext);
        if (is_file($candidate)) {
            $hash = @md5_file($candidate);
            $ver = is_string($hash) ? ('?v=' . substr($hash, 0, 8)) : '';
            return app_url('/' . $normalizedRel . '.' . $ext) . $ver;
        }
    }

    return $fallbackUrl;
}

/**
 * Mencari file video lokal beserta MIME type & gambar poster yang tersedia.
 *
 * @return array{src:string, type:string, poster:string}
 */
function resolve_video(string $relativePathWithoutExt, string $dirFallback = 'video'): array
{
    $mimeMap = [
        'mp4'  => 'video/mp4',
        'webm' => 'video/webm',
        'm4v'  => 'video/mp4',
        'mov'  => 'video/quicktime',
    ];
    $rootDir = realpath(__DIR__ . '/..');
    $src = '';
    $type = '';

    if ($rootDir !== false) {
        $normalizedRel = trim(str_replace('\\', '/', $relativePathWithoutExt), '/');
        foreach ($mimeMap as $ext => $mime) {
            $candidate = $rootDir . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $normalizedRel . '.' . $ext);
            if (is_file($candidate)) {
                $src = app_url('/' . $normalizedRel . '.' . $ext);
                $type = $mime;
                break;
            }
        }

        if ($src === '' && $dirFallback !== '') {
            $dirRel = trim(str_replace('\\', '/', $dirFallback), '/');
            $dirAbs = $rootDir . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $dirRel);
            if (is_dir($dirAbs)) {
                $files = scandir($dirAbs);
                if ($files !== false) {
                    foreach ($mimeMap as $targetExt => $mime) {
                        foreach ($files as $file) {
                            if ($file === '.' || $file === '..') {
                                continue;
                            }
                            if (strtolower(pathinfo($file, PATHINFO_EXTENSION)) === $targetExt && is_file($dirAbs . DIRECTORY_SEPARATOR . $file)) {
                                $src = app_url('/' . $dirRel . '/' . rawurlencode($file));
                                $type = $mime;
                                break 2;
                            }
                        }
                    }
                }
            }
        }
    }

    $poster = resolve_image('video/kolam-ts-villa-cisarua-poster', resolve_image('images/hero/kolam-villa', ''));

    return [
        'src'    => $src,
        'type'   => $type,
        'poster' => $poster,
    ];
}

/**
 * Nomor WhatsApp resmi Dunia Pool & Pond.
 */
function dpp_wa_url(string $message = ''): string
{
    $base = 'https://wa.me/6282118075560';
    if ($message === '') {
        return $base;
    }
    return $base . '?text=' . rawurlencode($message);
}

/**
 * Render identitas brand DUNIA POOL & POND selaras UI Navy & Gold.
 * Di Header tampil murni tipografi bersih tanpa gambar logo; di Footer menampilkan logo resmi dpp.
 */
function render_brand_logo(string $size = 'default', bool $withLogo = false): string
{
    $titleClass = $size === 'sm' ? 'text-sm tracking-[0.14em]' : 'text-[15px] sm:text-[17px] tracking-[0.13em]';
    $subClass = $size === 'sm' ? 'text-[9px] tracking-[0.22em]' : 'text-[9.5px] sm:text-[10px] tracking-[0.24em]';

    if (!$withLogo) {
        return <<<HTML
    <span class="inline-flex flex-col text-left select-none">
        <span class="font-sans font-bold text-white uppercase leading-none {$titleClass}">DUNIA POOL &amp; POND</span>
        <span class="font-sans font-semibold text-gold-400/90 uppercase leading-none mt-1.5 {$subClass}">THE POOL SPECIALIST • 1997</span>
    </span>
HTML;
    }

    $badgeClass = $size === 'sm' ? 'h-8 px-2 py-1' : 'h-9 sm:h-10 px-2.5 py-1.5';
    $logoSrc = e(resolve_image('images/brand/logo-dpp', app_url('/images/brand/logo-dpp.png')));

    return <<<HTML
    <span class="inline-flex items-center gap-3 select-none">
        <span class="inline-flex items-center justify-center rounded-md bg-white border border-gold-400/40 shadow-sm shrink-0 {$badgeClass}">
            <img alt="" aria-hidden="true" class="h-full w-auto object-contain" src="{$logoSrc}" />
        </span>
        <span class="flex flex-col text-left">
            <span class="font-sans font-bold text-white uppercase leading-none {$titleClass}">DUNIA POOL &amp; POND</span>
            <span class="font-sans font-semibold text-gold-400/90 uppercase leading-none mt-1.5 {$subClass}">THE POOL SPECIALIST • 1997</span>
        </span>
    </span>
HTML;
}

/**
 * Render Page Hero pada halaman dalam dengan aksen geometris Navy & Gold yang elegan,
 * selaras dengan banner utama tanpa terlihat terlalu ramai.
 */
function render_page_hero(
    string $eyebrowId,
    string $eyebrowEn,
    string $titleId,
    string $titleEn,
    string $subtitleId,
    string $subtitleEnOrBg = '',
    string $bgImageRel = 'images/hero/kolam-utama'
): string {
    if (str_contains($subtitleEnOrBg, '/') || str_starts_with($subtitleEnOrBg, 'images/')) {
        $bgImageRel = $subtitleEnOrBg;
        $subtitleEn = '';
    } else {
        $subtitleEn = $subtitleEnOrBg;
    }

    $bgUrl = resolve_image($bgImageRel, '');
    $eyebrowIdEsc = e($eyebrowId);
    $eyebrowEnEsc = e($eyebrowEn);
    $titleIdEsc = e($titleId);
    $titleEnEsc = e($titleEn);
    $subtitleIdEsc = e($subtitleId);
    $subtitleEnEsc = e($subtitleEn !== '' ? $subtitleEn : $subtitleId);

    $bgMedia = '';
    if ($bgUrl !== '') {
        $bgSrc = e($bgUrl);
        $bgMedia = '<img alt="" class="w-full h-full object-cover object-right opacity-[0.14] mix-blend-luminosity" loading="eager" src="' . $bgSrc . '" />';
    }

    $dots = '';
    for ($r = 0; $r < 5; $r++) {
        for ($c = $r; $c < 5; $c++) {
            $cx = 1320 + $c * 16;
            $cy = 30 + $r * 16;
            $dots .= '<circle cx="' . $cx . '" cy="' . $cy . '" r="2.2" fill="#DFB465" fill-opacity="0.72" />';
        }
    }

    return <<<HTML
    <section class="relative overflow-hidden bg-navy-900 text-white py-16 sm:py-20 border-b border-white/10">
        <!-- Subtle Right-Side Photo Texture + Smooth Directional Navy Readability Gradient -->
        <div aria-hidden="true" class="pointer-events-none absolute inset-0 z-0">
            {$bgMedia}
            <div class="absolute inset-0" style="background: linear-gradient(95deg, #09182B 0%, rgba(9, 24, 43, 0.96) 52%, rgba(10, 28, 50, 0.82) 78%, rgba(9, 24, 43, 0.88) 100%);"></div>
        </div>

        <!-- Restrained Luxury Gold & Thin Contour Accents on Right Negative Space -->
        <svg aria-hidden="true" class="pointer-events-none select-none absolute inset-0 w-full h-full z-0" preserveAspectRatio="xMidYMid slice" viewBox="0 0 1440 320" fill="none" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="pageHeroGoldGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" stop-color="#F0CB7E" />
                    <stop offset="55%" stop-color="#DFB465" />
                    <stop offset="100%" stop-color="#B8893A" />
                </linearGradient>
                <radialGradient id="pageHeroGlow" cx="84%" cy="52%" r="34%">
                    <stop offset="0%" stop-color="#DFB465" stop-opacity="0.14" />
                    <stop offset="100%" stop-color="#09182B" stop-opacity="0" />
                </radialGradient>
            </defs>

            <rect width="1440" height="320" fill="url(#pageHeroGlow)" />

            <!-- Upper-Right Soft Organic Gold Swoop + Thin White Offset Contour -->
            <path d="M930 0 C948 48, 1005 66, 1072 42 C1116 26, 1152 10, 1188 0 Z" fill="url(#pageHeroGoldGrad)" fill-opacity="0.88" />
            <path d="M908 0 C930 64, 998 86, 1080 55 C1130 36, 1170 14, 1212 0" stroke="#FFFFFF" stroke-opacity="0.35" stroke-width="1.25" />

            <!-- Bottom-Right Warm Gold Corner Wedge + Subtle Arc & Diagonal Line -->
            <path d="M1185 320 L1440 205 L1440 320 Z" fill="url(#pageHeroGoldGrad)" fill-opacity="0.85" />
            <circle cx="1365" cy="315" r="108" stroke="#DFB465" stroke-opacity="0.28" stroke-width="1.25" />
            <line x1="1035" y1="320" x2="1440" y2="152" stroke="#FFFFFF" stroke-opacity="0.28" stroke-width="1.25" />
            <line x1="1085" y1="320" x2="1440" y2="173" stroke="#DFB465" stroke-opacity="0.25" stroke-width="1" />

            <!-- Subtle Top-Right Gold Dot Cluster -->
            {$dots}
        </svg>

        <div class="max-w-[1260px] mx-auto px-5 sm:px-8 lg:px-10 relative z-10">
            <div class="inline-flex items-center gap-2.5 mb-2.5">
                <span aria-hidden="true" class="w-6 h-[2px] rounded-full bg-gold-400"></span>
                <p class="text-gold-400 text-xs font-bold uppercase tracking-[0.18em]" data-i18n-en="{$eyebrowEnEsc}" data-i18n-id="{$eyebrowIdEsc}">{$eyebrowIdEsc}</p>
            </div>
            <h1 class="font-serif text-3xl sm:text-4xl lg:text-[42px] font-semibold leading-tight max-w-3xl" data-i18n-en="{$titleEnEsc}" data-i18n-id="{$titleIdEsc}">
                {$titleIdEsc}
            </h1>
            <p class="text-white/80 text-sm sm:text-base leading-relaxed mt-4 max-w-2xl" data-i18n-en="{$subtitleEnEsc}" data-i18n-id="{$subtitleIdEsc}">
                {$subtitleIdEsc}
            </p>
        </div>
    </section>
HTML;
}

/**
 * Render ikon SVG tipis presisi sesuai layanan kolam renang, statistik, dan nilai teknis.
 */
function render_icon(string $name, string $class = 'w-5 h-5'): string
{
    $icons = [
        'stat-building' => '<svg aria-hidden="true" class="' . $class . '" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="6" width="24" height="21" rx="2"/><path d="M4 12h24M10 4v4M22 4v4"/><path d="M9 17h4m6 0h4M9 22h4m6 0h4"/></svg>',
        'stat-team'     => '<svg aria-hidden="true" class="' . $class . '" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4L6 8.5v7c0 6.5 4.3 11.2 10 13 5.7-1.8 10-6.5 10-13v-7L16 4Z"/><path d="M11.5 16.2l3 3 6-6.2"/></svg>',
        'stat-globe'    => '<svg aria-hidden="true" class="' . $class . '" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="6" width="9" height="9" rx="1.5"/><rect x="18" y="6" width="9" height="9" rx="1.5"/><rect x="5" y="18" width="9" height="9" rx="1.5"/><rect x="18" y="18" width="9" height="9" rx="1.5"/></svg>',
        'stat-chart'    => '<svg aria-hidden="true" class="' . $class . '" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="16" cy="13" r="7.5"/><path d="M11.5 19.2L9.5 28l6.5-3.2L22.5 28l-2-8.8"/><path d="M13.3 13l1.9 1.9 3.7-3.8"/></svg>',
        'visi-target'   => '<svg aria-hidden="true" class="' . $class . '" viewBox="0 0 28 28" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 17c2.5-2.2 5-2.2 7.5 0s5 2.2 7.5 0 3.5-2 5-1"/><path d="M4 21.5c2.5-2.2 5-2.2 7.5 0s5 2.2 7.5 0 3.5-2 5-1"/><circle cx="14" cy="9.5" r="4"/><path d="M14 3.5v2M8 9.5h2m8 0h2"/></svg>',
        'misi-eye'      => '<svg aria-hidden="true" class="' . $class . '" viewBox="0 0 28 28" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="4" width="18" height="20" rx="2"/><path d="M9.5 9.5h9M9.5 14h9M9.5 18.5h5.5"/><path d="M17.5 18.5l1.5 1.5 3-3"/></svg>',
        'nilai-diamond' => '<svg aria-hidden="true" class="' . $class . '" viewBox="0 0 28 28" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M14 3.5L5.5 7.2v6.3c0 5.5 3.6 9.6 8.5 11 4.9-1.4 8.5-5.5 8.5-11V7.2L14 3.5Z"/><path d="M10.2 14l2.5 2.5 5.1-5.2"/></svg>',
        'sec-desain'    => '<svg aria-hidden="true" class="' . $class . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M3 20h18"/><path d="M5 16l6-11 6 11"/><path d="M7.5 12h7"/><circle cx="17.5" cy="6.5" r="2.5"/></svg>',
        'sec-konstruksi'=> '<svg aria-hidden="true" class="' . $class . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="13" width="8" height="6" rx="0.8"/><rect x="13" y="13" width="8" height="6" rx="0.8"/><rect x="7.5" y="6" width="9" height="6" rx="0.8"/><path d="M2 19h20"/></svg>',
        'sec-renovasi'  => '<svg aria-hidden="true" class="' . $class . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a4.5 4.5 0 0 0-5.9 5.9L4 17l3 3 4.8-4.8a4.5 4.5 0 0 0 5.9-5.9l-2.6 2.6-2-2 2.6-2.6Z"/></svg>',
        'sec-sirkulasi' => '<svg aria-hidden="true" class="' . $class . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 12a8 8 0 0 1 13.6-5.6L20 8.8"/><path d="M20 4.5v4.3h-4.3"/><path d="M20 12a8 8 0 0 1-13.6 5.6L4 15.2"/><path d="M4 19.5v-4.3h4.3"/></svg>',
        'sec-peralatan' => '<svg aria-hidden="true" class="' . $class . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3.2"/><path d="M12 3.5v2.3m0 12.4v2.3M3.5 12h2.3m12.4 0h2.3M6 6l1.6 1.6m8.8 8.8L18 18M18 6l-1.6 1.6M7.6 16.4L6 18"/></svg>',
        'sec-perawatan' => '<svg aria-hidden="true" class="' . $class . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3.5S6.5 10 6.5 14.2a5.5 5.5 0 0 0 11 0C17.5 10 12 3.5 12 3.5Z"/><path d="M9.8 14.8a2.5 2.5 0 0 0 2.5 2"/></svg>',
        'sec-properti'  => '<svg aria-hidden="true" class="' . $class . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M3 16.5c2-1.8 4-1.8 6 0s4 1.8 6 0 4-1.8 6 0"/><path d="M3 20c2-1.8 4-1.8 6 0s4 1.8 6 0 4-1.8 6 0"/><path d="M7 13V6.5a2 2 0 0 1 4 0V8m3 5V6.5a2 2 0 0 1 4 0V8"/><path d="M7 9.5h7"/></svg>',
        'arrow-right'   => '<svg aria-hidden="true" class="' . $class . '" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M4 10h12m0 0l-4-4m4 4l-4 4"/></svg>',
        'whatsapp-chat' => '<svg aria-hidden="true" class="' . $class . '" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2m.01 1.67c2.2 0 4.26.86 5.82 2.42a8.225 8.225 0 0 1 2.41 5.83c0 4.54-3.7 8.23-8.24 8.23-1.48 0-2.93-.39-4.19-1.15l-.3-.17-3.12.82.83-3.04-.2-.32a8.188 8.188 0 0 1-1.26-4.38c.01-4.54 3.7-8.24 8.25-8.24M8.53 7.33c-.16 0-.43.06-.66.31-.22.25-.87.86-.87 2.07 0 1.22.89 2.39 1 2.56.14.17 1.76 2.67 4.25 3.73.59.27 1.05.42 1.41.53.59.19 1.13.16 1.56.1.48-.07 1.46-.6 1.67-1.18.21-.58.21-1.07.15-1.18-.07-.1-.23-.16-.48-.27-.25-.14-1.47-.74-1.69-.82-.23-.08-.37-.12-.56.12-.16.25-.64.81-.78.97-.15.17-.29.19-.53.07-.26-.13-1.06-.39-2-1.23-.74-.66-1.23-1.47-1.38-1.72-.12-.24-.01-.39.11-.5.11-.11.27-.29.37-.44.13-.14.17-.25.25-.41.08-.17.04-.31-.02-.43-.06-.11-.56-1.35-.77-1.84-.2-.48-.4-.42-.56-.43-.14 0-.3-.01-.47-.01Z"/></svg>',
        'check-circle'  => '<svg aria-hidden="true" class="' . $class . '" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="10" r="7.5"/><path d="M6.8 10.2l2.1 2.1 4.4-4.5"/></svg>',
        'search'        => '<svg aria-hidden="true" class="' . $class . '" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="9" r="5.8"/><path d="M13.5 13.5L17 17"/></svg>',
    ];

    return $icons[$name] ?? '';
}

/**
 * 6 Lingkup Spesialisasi Utama Dunia Pool & Pond (untuk 6-Card Grid Beranda & Footer).
 *
 * @return array<int, array<string, mixed>>
 */
function get_portfolio_sectors(): array
{
    return [
        [
            'slug'      => 'desain-konsultasi',
            'icon'      => 'sec-desain',
            'title'     => 'Desain & Konsultasi',
            'title_en'  => 'Design & Consultation',
            'short'     => 'Tata letak kolam 3D, kalkulasi pola sirkulasi air, serta evaluasi kontur lahan.',
            'short_en'  => '3D pool layout, circulation flow planning, and site contour evaluation.',
            'img'       => resolve_image('images/layanan/01-desain-konsultasi'),
            'href'      => app_url('/layanan#desain-konsultasi'),
            'cta_id'    => 'Lihat Layanan',
            'cta_en'    => 'View Service',
        ],
        [
            'slug'      => 'konstruksi-kolam',
            'icon'      => 'sec-konstruksi',
            'title'     => 'Konstruksi Kolam Renang',
            'title_en'  => 'Pool Construction',
            'short'     => 'Pengerjaan struktur kolam, sistem pemipaan, waterproofing berlapis, hingga finishing mozaik.',
            'short_en'  => 'Reinforced pool construction, integrated plumbing, waterproofing, and mosaic finishing.',
            'img'       => resolve_image('images/layanan/02-konstruksi-kolam'),
            'href'      => app_url('/layanan#konstruksi-kolam'),
            'cta_id'    => 'Lihat Layanan',
            'cta_en'    => 'View Service',
        ],
        [
            'slug'      => 'renovasi-perbaikan',
            'icon'      => 'sec-renovasi',
            'title'     => 'Renovasi & Perbaikan',
            'title_en'  => 'Renovation & Repair',
            'short'     => 'Penanganan kebocoran struktur, penggantian mozaik/nat, dan peremajaan jalur pipa.',
            'short_en'  => 'Structural leak injection, mosaic re-tiling, and manifold pipe rejuvenation.',
            'img'       => resolve_image('images/layanan/03-renovasi-perbaikan'),
            'href'      => app_url('/layanan#renovasi-perbaikan'),
            'cta_id'    => 'Lihat Layanan',
            'cta_en'    => 'View Service',
        ],
        [
            'slug'      => 'sirkulasi-filtrasi',
            'icon'      => 'sec-sirkulasi',
            'title'     => 'Sirkulasi & Filtrasi',
            'title_en'  => 'Circulation & Filtration',
            'short'     => 'Perancangan sistem skimmer & overflow, kalkulasi TDH, sand filter, & uji tekan pipa.',
            'short_en'  => 'Skimmer & overflow engineering, TDH calculation, sand filter, & pressure testing.',
            'img'       => resolve_image('images/layanan/04-sirkulasi-filtrasi'),
            'href'      => app_url('/layanan#sirkulasi-filtrasi'),
            'cta_id'    => 'Lihat Layanan',
            'cta_en'    => 'View Service',
        ],
        [
            'slug'      => 'instalasi-peralatan',
            'icon'      => 'sec-peralatan',
            'title'     => 'Peralatan & Suku Cadang',
            'title_en'  => 'Equipment & Spare Parts',
            'short'     => 'Pengadaan 11 kategori pompa, filter, lampu LED IP68, pemanas, & spare part 15 merek.',
            'short_en'  => 'Supply & installation of pumps, filters, IP68 LED lights, heaters, & genuine parts.',
            'img'       => resolve_image('images/layanan/05-instalasi-peralatan'),
            'href'      => app_url('/produk'),
            'cta_id'    => 'Buka Katalog',
            'cta_en'    => 'View Catalog',
        ],
        [
            'slug'      => 'perawatan-kimia',
            'icon'      => 'sec-perawatan',
            'title'     => 'Perawatan & Kimia Air',
            'title_en'  => 'Maintenance & Water Care',
            'short'     => 'Vacuuming rutin, backwash filter, kontrol pH & klorin, serta penjernihan air kolam.',
            'short_en'  => 'Routine vacuuming, filter backwash, pH/chlorine balancing, and water treatment.',
            'img'       => resolve_image('images/layanan/06-perawatan-kolam'),
            'href'      => app_url('/layanan#perawatan-kolam'),
            'cta_id'    => 'Lihat Layanan',
            'cta_en'    => 'View Service',
        ],
    ];
}

/**
 * 8 Layanan Lengkap Dunia Pool & Pond (sesuai DPP BARU).
 *
 * @return array<int, array<string, mixed>>
 */
function get_all_services(): array
{
    return [
        [
            'num'        => '01',
            'slug'       => 'desain-konsultasi',
            'icon'       => 'sec-desain',
            'title'      => 'Desain & Konsultasi',
            'title_en'   => 'Design & Consultation',
            'desc'       => 'Pembahasan kebutuhan kolam, konsep tata letak 3D, pola sirkulasi air, serta pemilihan peralatan awal sesuai kondisi lahan.',
            'desc_en'    => 'Comprehensive pool planning, 3D architectural visualization, circulation & filtration schematics, and equipment selection tailored to your property terrain.',
            'bullets'    => [
                'Peninjauan ukuran area, kontur tanah, dan akses ruang mesin',
                'Pemilihan konsep sirkulasi (skimmer, overflow, atau semi-overflow)',
                'Rekomendasi awal pompa, filter, serta kebutuhan kelistrikan',
            ],
            'bullets_en' => [
                'On-site evaluation of dimensions, land topography, and pump room access',
                'System selection between skimmer box, perimeter overflow, or negative edge',
                'Early sizing of pump flow rates, filtration capacity, and power infrastructure',
            ],
            'tags'       => ['Gambar Kerja 3D', 'Evaluasi Kontur Lahan', 'Kalkulasi Awal RAB'],
            'tags_en'    => ['3D Working Drawings', 'Terrain Elevation Study', 'Transparent BOQ Estimate'],
            'img'        => resolve_image('images/layanan/01-desain-konsultasi'),
            'wa_text'    => 'Halo Dunia Pool & Pond, saya ingin berkonsultasi mengenai Desain & Rancangan Kolam Renang.',
        ],
        [
            'num'        => '02',
            'slug'       => 'konstruksi-kolam',
            'icon'       => 'sec-konstruksi',
            'title'      => 'Konstruksi Kolam Renang',
            'title_en'   => 'Swimming Pool Construction',
            'desc'       => 'Pengerjaan struktur konstruksi kolam, aplikasi waterproofing menyeluruh, koordinasi pemipaan sejak tahap awal, hingga pekerjaan finishing.',
            'desc_en'    => 'Reinforced structural pool engineering, multi-layer waterproofing membrane applications, embedded plumbing coordination, and exquisite tile finishing.',
            'bullets'    => [
                'Pengerjaan pembesian dan pengecoran struktur bak kolam beserta lapisan kedap air',
                'Koordinasi pipa hisap, jalur balik, dan main drain terintegrasi pada struktur',
                'Pemasangan mozaik/ubin kolam beserta uji pengisian air 3×24 jam',
            ],
            'bullets_en' => [
                'Rebar reinforcement, monolithic shell casting, and dual waterproofing',
                'Embedded suction, return inlet, and anti-vortex main drain installation',
                'Porcelain mosaic tiling, coping stone installation, and 72-hour static water testing',
            ],
            'tags'       => ['Konstruksi Terukur', 'Waterproofing Berlapis', 'Garansi Struktur & Bocor'],
            'tags_en'    => ['Precision Engineering', 'Multi-Layer Membrane', 'Structural Warranty'],
            'img'        => resolve_image('images/layanan/02-konstruksi-kolam'),
            'wa_text'    => 'Halo Dunia Pool & Pond, saya ingin berkonsultasi mengenai Jasa Konstruksi Kolam Renang Baru.',
        ],
        [
            'num'        => '03',
            'slug'       => 'renovasi-perbaikan',
            'icon'       => 'sec-renovasi',
            'title'      => 'Renovasi & Perbaikan',
            'title_en'   => 'Pool Renovation & Structural Repair',
            'desc'       => 'Penanganan kebocoran struktural, penggantian pelapis mozaik atau keramik, peremajaan jalur pipa, dan penataan ulang ruang mesin.',
            'desc_en'    => 'Targeted structural leak repairs, cracked concrete epoxy injections, mosaic re-tiling, plumbing line renewals, and pump room modernization.',
            'bullets'    => [
                'Pemeriksaan sumber rembesan, injeksi retak struktur, dan perbaikan nat',
                'Penggantian lapisan finishing serta perbaikan dinding dan dasar kolam',
                'Peningkatan sistem pemipaan, pompa, filter, dan panel kontrol',
            ],
            'bullets_en' => [
                'Acoustic and dye leak detection, high-pressure epoxy injection, and acid-proof regrouting',
                'Full removal and replacement of hollow mosaics, waterproofing repair, and coping re-leveling',
                'Pipe manifold retrofits, pump upgrades, and modernized electrical automation panels',
            ],
            'tags'       => ['Injeksi Antibocor', 'Re-finishing Mozaik', 'Peremajaan Ruang Mesin'],
            'tags_en'    => ['Leak Injection', 'Mosaic Re-Finishing', 'Pump Room Overhaul'],
            'img'        => resolve_image('images/layanan/03-renovasi-perbaikan'),
            'wa_text'    => 'Halo Dunia Pool & Pond, saya ingin berkonsultasi mengenai Renovasi & Perbaikan Kebocoran Kolam.',
        ],
        [
            'num'        => '04',
            'slug'       => 'sirkulasi-filtrasi',
            'icon'       => 'sec-sirkulasi',
            'title'      => 'Sistem Sirkulasi & Filtrasi',
            'title_en'   => 'Circulation & Filtration System',
            'desc'       => 'Desain sirkulasi skimmer atau overflow presisi, kalkulasi Total Dynamic Head (TDH), instalasi pompa, sand filter, serta gutter balancing tank.',
            'desc_en'    => 'Precision circulation design for skimmer and overflow pools, Total Dynamic Head (TDH) friction loss mapping, pump sizing, sand filter installation, and balancing tank integration.',
            'bullets'    => [
                'Kalkulasi debit sirkulasi (m³/jam) dan siklus turnover air 4–6 jam',
                'Instalasi manifold pipa PVC AW bertekanan tinggi dan anti-vortex drain',
                'Hydrostatic pressure test pipa 2.5–3.0 bar sebelum pengecoran bak',
            ],
            'bullets_en' => [
                'Precise turnover calculation (4–6 hours) to eliminate stagnant zones and dead spots',
                'Class AW high-pressure PVC manifold routing with safety anti-vortex drain covers',
                'Mandatory 2.5–3.0 bar hydrostatic pressure testing prior to concrete casting',
            ],
            'tags'       => ['Kalkulasi TDH & Turnover', 'Pipa PVC Kelas AW', 'Hydrostatic Test 2.5–3 Bar'],
            'tags_en'    => ['TDH & Turnover Sizing', 'Class AW Pressure PVC', '2.5–3.0 Bar Pressure Test'],
            'img'        => resolve_image('images/layanan/04-sirkulasi-filtrasi'),
            'wa_text'    => 'Halo Dunia Pool & Pond, saya ingin konsultasi layanan Sistem Sirkulasi & Filtrasi Kolam.',
        ],
        [
            'num'        => '05',
            'slug'       => 'instalasi-peralatan',
            'icon'       => 'sec-peralatan',
            'title'      => 'Instalasi Peralatan Kolam',
            'title_en'   => 'Pool Mechanical & Electrical Installation',
            'desc'       => 'Pemasangan unit pompa sirkulasi, sand atau cartridge filter, salt chlorinator, lampu LED underwater IP68, serta panel kendali otomatis.',
            'desc_en'    => 'Turnkey installation of circulation pumps, commercial sand filters, salt chlorination cells, IP68 underwater LED lighting, and automated control panels.',
            'bullets'    => [
                'Penyelarasan kapasitas daya pompa (HP) dengan diameter tabung filter',
                'Instalasi lampu bawah air kedap IP68 12V AC beserta trafo step-down aman',
                'Pengkabelan panel kelistrikan dengan ELCB proteksi arus bocor & timer otomatis',
            ],
            'bullets_en' => [
                'Harmonized pump motor power (HP/kW) matched to filter tank surface area and media weight',
                'Submersible IP68 LED lights powered via safety-isolated 12V AC step-down transformers',
                'Electrical panel assembly featuring ELCB ground-fault breakers and programmable schedule timers',
            ],
            'tags'       => ['Pompa & Sand Filter', 'Underwater LED IP68 12V', 'Panel Kontrol Timer'],
            'tags_en'    => ['Pump & Sand Filter', 'IP68 Submersible LED', 'Timer Automation Panel'],
            'img'        => resolve_image('images/layanan/05-instalasi-peralatan'),
            'wa_text'    => 'Halo Dunia Pool & Pond, saya ingin berkonsultasi mengenai Instalasi Peralatan Mesin & Lampu Kolam.',
        ],
        [
            'num'        => '06',
            'slug'       => 'perawatan-kolam',
            'icon'       => 'sec-perawatan',
            'title'      => 'Perawatan Kolam Berkala',
            'title_en'   => 'Routine Pool Maintenance',
            'desc'       => 'Pembersihan rutin fisik dasar dan dinding kolam, pemeriksaan keranjang skimmer & strainer pompa, serta kontrol kejernihan air berkala.',
            'desc_en'    => 'Scheduled professional physical cleaning, bottom vacuuming, wall brushing, pump strainer servicing, and regular water clarity verification.',
            'bullets'    => [
                'Vacuuming endapan dasar kolam dan penyikatan dinding serta bibir coping',
                'Pembilasan berkala sand filter (backwash & rinse) sesuai tekanan manometer',
                'Pembersihan leaf skimmer, keranjang strainer, serta pengecekan aliran sirkulasi',
            ],
            'bullets_en' => [
                'Sediment floor vacuuming, algae wall scrubbing, and coping tile cleaning',
                'Multiport valve backwash and rinse cycles calibrated against pressure gauge readings',
                'Debris clearing from skimmer baskets and pump strainers with flow inspection',
            ],
            'tags'       => ['Vacuuming & Brushing', 'Backwash & Rinse Filter', 'Kunjungan Rutin Terjadwal'],
            'tags_en'    => ['Vacuuming & Brushing', 'Backwash & Rinse Cycles', 'Scheduled Routine Visits'],
            'img'        => resolve_image('images/layanan/06-perawatan-kolam'),
            'wa_text'    => 'Halo Dunia Pool & Pond, saya ingin menanyakan paket Perawatan Rutin (Maintenance) Kolam Renang.',
        ],
        [
            'num'        => '07',
            'slug'       => 'pengolahan-air',
            'icon'       => 'sec-perawatan',
            'title'      => 'Pengolahan Air & Bahan Kimia',
            'title_en'   => 'Water Treatment & Chemical Balancing',
            'desc'       => 'Pengujian parameter pH dan kadar klorin, penjernihan air keruh atau berlumut hijau, serta penyeimbangan kimiawi air yang aman bagi perenang.',
            'desc_en'    => 'Comprehensive pool water testing (pH, free chlorine, cyanuric acid), green pool shock treatments, flocculation, and swimmer-safe chemical balancing.',
            'bullets'    => [
                'Pengukuran kadar pH ideal (7.2–7.6) dan residu klorin bebas terkalibrasi',
                'Penanganan shock treatment, algaecide anti-lumut, dan koagulan penjernih',
                'Suplai klorin granular/tablet TCCA 90%, kaporit, soda ash, dan clarifier',
            ],
            'bullets_en' => [
                'Calibrated testing of optimal pH (7.2–7.6), free available chlorine, and alkalinity',
                'Targeted shock treatments, algaecide dosing, and coagulants for crystal-clear clarity',
                'Direct supply of 90% TCCA chlorine tablets, granular chlorine, soda ash, and clarifiers',
            ],
            'tags'       => ['Uji pH 7.2–7.6 & Klorin', 'Penjernihan Air Hijau/Keruh', 'Suplai TCCA 90% & Clarifier'],
            'tags_en'    => ['Calibrated pH & Chlorine', 'Green Water Recovery', 'Certified Chemical Supply'],
            'img'        => resolve_image('images/layanan/07-pengolahan-air'),
            'wa_text'    => 'Halo Dunia Pool & Pond, saya ingin konsultasi Pengolahan Air & Bahan Kimia Kolam Renang.',
        ],
        [
            'num'        => '08',
            'slug'       => 'purna-jual',
            'icon'       => 'sec-peralatan',
            'title'      => 'Purna Jual & Dukungan Teknis',
            'title_en'   => 'After-Sales & Technical Support',
            'desc'       => 'Inspeksi berkala mekanikal elektrikal ruang mesin, troubleshooting penurunan tekanan atau suara bising pompa, serta ketersediaan suku cadang.',
            'desc_en'    => 'Routine mechanical and electrical inspections, troubleshooting pump noise or pressure drops, emergency repairs, and genuine replacement spare parts.',
            'bullets'    => [
                'Deteksi kebocoran mechanical seal, kavitasi pompa, atau kerusakan multiport valve',
                'Penggantian suku cadang resmi (impeller, mechanical seal, o-ring, media pasir silika)',
                'Konsultasi langsung tim teknis untuk keandalan operasional jangka panjang',
            ],
            'bullets_en' => [
                'Diagnostic testing for shaft seal leaks, pump cavitation, and multiport spider gasket wear',
                'OEM spare part replacements (impellers, mechanical seals, O-rings, silica sand media)',
                'Direct access to our senior engineering technicians for long-term operational reliability',
            ],
            'tags'       => ['Troubleshooting Pompa', 'Penggantian Media Pasir', 'Suku Cadang Orisinil'],
            'tags_en'    => ['Pump Diagnostics', 'Filter Media Renewal', 'Genuine Spare Parts'],
            'img'        => resolve_image('images/layanan/08-purna-jual'),
            'wa_text'  => 'Halo Dunia Pool & Pond, saya membutuhkan Dukungan Teknis / Servis Ruang Mesin & Suku Cadang.',
        ],
    ];
}

/**
 * Dokumentasi Proyek Representatif Dunia Pool & Pond.
 *
 * @return array<int, array<string, string>>
 */
function get_featured_projects(): array
{
    return [
        [
            'slug'       => 'private-pool-semi-overflow-cihideung-parongpong',
            'location'   => 'Cihideung, Parongpong, Bandung Barat',
            'badge'      => 'Sistem Semi-Overflow',
            'badge_en'   => 'Semi-Overflow System',
            'type'       => 'Private Pool',
            'type_en'    => 'Private Pool',
            'scope'      => 'Lingkup: Konstruksi Private Pool & Semi-Overflow',
            'scope_en'   => 'Scope: Private Pool Construction & Semi-Overflow',
            'title'      => 'Konstruksi Private Pool Sistem Semi-Overflow',
            'title_en'   => 'Private Pool Construction with Semi-Overflow Circulation',
            'excerpt'    => 'Pembangunan private pool memanjang dengan sistem sirkulasi semi-overflow, finishing mozaik biru, batu alam bibir kolam, dan area dek kayu.',
            'excerpt_en' => 'Elongated private pool construction featuring a semi-overflow circulation system, blue mosaic tiling, natural stone coping, and timber decking.',
            'body'       => 'Cihideung, Parongpong, Bandung Barat — Pengerjaan konstruksi private pool berdesain memanjang di kawasan sejuk Bandung Barat dengan sistem sirkulasi semi-overflow yang menjaga kejernihan permukaan air secara merata. Pekerjaan mencakup struktur bak kolam kedap air, instalasi saluran limpahan semi-overflow dan balancing tank, uji tekan perpipaan PVC kelas AW, serta pemasangan mozaik kolam, batu alam tepi, dan penyelarasan area dek kayu.',
            'body_en'    => 'Cihideung, Parongpong, West Bandung — Construction of an elongated private lap pool in the highlands of West Bandung utilizing a semi-overflow circulation system for continuous surface skimming. Scope included watertight reinforced shell construction, semi-overflow gutter and balancing tank integration, Class AW PVC pressure testing, blue pool mosaic finishing, natural stone coping, and seamless timber deck integration.',
            'img'        => resolve_image('images/proyek/proyek-4-cihideung'),
        ],
        [
            'slug'       => 'instalasi-ruang-mesin-ciumbuleuit-bandung',
            'location'   => 'Ciumbuleuit, Kota Bandung',
            'badge'      => 'Instalasi Ruang Mesin',
            'badge_en'   => 'Pump Room Installation',
            'type'       => 'Private Pool',
            'type_en'    => 'Private Pool',
            'scope'      => 'Lingkup: Instalasi Ruang Mesin, Pompa & Sand Filter',
            'scope_en'   => 'Scope: Pump Room, Circulation Pump & Sand Filter Installation',
            'title'      => 'Instalasi Ruang Mesin & Sistem Sirkulasi Kolam Renang',
            'title_en'   => 'Swimming Pool Pump Room & Circulation System Installation',
            'excerpt'    => 'Pemasangan unit pompa sirkulasi, tabung sand filter, perakitan manifold valve PVC kelas AW, dan uji fungsi ruang mesin kolam.',
            'excerpt_en' => 'Installation of circulation pump, sand filter tank, Class AW PVC manifold valve assembly, and full pump room commissioning.',
            'body'       => 'Ciumbuleuit, Kota Bandung — Pengerjaan instalasi ruang mesin serta penyelarasan sistem sirkulasi dan filtrasi pada kolam renang pribadi di kawasan Ciumbuleuit, Kota Bandung. Lingkup teknis meliputi perakitan jalur pemipaan hisap dan distribusi menggunakan pipa PVC kelas AW, pemasangan pompa sirkulasi dan tabung sand filter media pasir silika, penataan ball valve & check valve di ruang mesin, hingga pengujian kejernihan aliran air.',
            'body_en'    => 'Ciumbuleuit, Bandung City — Mechanical pump room installation and circulation filtration setup for a private swimming pool in Ciumbuleuit, Bandung. Technical scope included Class AW PVC suction and return manifold assembly, circulation pump and silica-media sand filter installation, ball valve and check valve routing inside the equipment chamber, and full water clarity flow testing.',
            'img'        => resolve_image('images/proyek/proyek-5-ciumbuleuit'),
        ],
        [
            'slug'       => 'jasa-desain-kolam-semi-overflow',
            'location'   => '',
            'badge'      => 'Jasa Desain & Skematik 3D',
            'badge_en'   => '3D Pool Design & Schematic',
            'type'       => 'Sistem Semi-Overflow',
            'type_en'    => 'Semi-Overflow System',
            'scope'      => 'Lingkup: Desain 3D, Jalur Pemipaan & Ruang Mesin',
            'scope_en'   => 'Scope: 3D Pool Layout, Piping Schematic & Pump Room',
            'title'      => 'Jasa Desain Kolam Renang Sistem Semi-Overflow',
            'title_en'   => 'Semi-Overflow Swimming Pool Design & Piping Schematic',
            'excerpt'    => 'Perancangan tata letak kolam semi-overflow 3D lengkap dengan jalur pipa return inlet, main drain, gutter limpahan, balancing tank, dan ruang mesin.',
            'excerpt_en' => 'Complete 3D semi-overflow pool layout detailing return inlet lines, main drains, perimeter gutter channel, balancing tank, and pump room.',
            'body'       => 'Perancangan teknis dan visualisasi 3 dimensi kolam renang bersistem sirkulasi semi-overflow. Desain memetakan secara presisi pembagian zona kedalaman kolam, penempatan titik return inlet distribusi air bersih, posisi main drain di dasar kolam, saluran parit limpahan (gutter) semi-overflow pada satu sisi memanjang, hingga skematik pemipaan terintegrasi menuju balancing tank serta ruang pompa dan sand filter.',
            'body_en'    => 'Comprehensive 3D technical design and schematic visualization for a semi-overflow swimming pool system. The engineering layout maps depth zone partitioning, directional return inlet placement, dual floor main drains, a continuous single-side semi-overflow gutter channel, and complete color-coded piping routes connecting to the balancing tank, circulation pump, and sand filter chamber.',
            'img'        => resolve_image('images/proyek/proyek-6-desain-semi-overflow'),
            'img_fit'    => 'contain',
        ],
        [
            'slug'       => 'water-treatment-laska-hotel-subang',
            'location'   => 'Laska Hotel Subang',
            'badge'      => 'Water Treatment',
            'badge_en'   => 'Water Treatment',
            'type'       => 'Hotel & Komersial',
            'type_en'    => 'Hotel & Commercial',
            'scope'      => 'Lingkup: Water Treatment & Penjernihan Air Kolam Hotel',
            'scope_en'   => 'Scope: Hotel Pool Water Treatment & Chemical Balancing',
            'title'      => 'Water Treatment & Penjernihan Air Kolam — Laska Hotel Subang',
            'title_en'   => 'Hotel Swimming Pool Water Treatment — Laska Hotel Subang',
            'excerpt'    => 'Penanganan water treatment, penyeimbangan parameter pH & klorin, serta pemeliharaan kejernihan air kolam renang hotel berstandar higienis.',
            'excerpt_en' => 'Professional water treatment, pH and active chlorine balancing, and crystal-clear water quality management for a commercial hotel pool.',
            'body'       => 'Laska Hotel Subang — Penanganan water treatment dan pemeliharaan kualitas air kolam renang komersial bersistem overflow pada fasilitas perhotelan. Pekerjaan meliputi penyeimbangan presisi kadar pH dan klorin aktif sesuai standar sanitasi perhotelan, perawatan kejernihan kristal hingga dasar mozaik terlihat tajam, pembersihan vakum fisik dan saluran overflow gutter, serta pemeriksaan sirkulasi filtrasi ruang mesin agar selalu siap melayani tamu hotel.',
            'body_en'    => 'Laska Hotel Subang — Comprehensive water treatment and water quality management for an overflow commercial swimming pool within a hospitality facility. Work encompassed precise pH and active chlorine sanitation balancing to hotel hygiene standards, crystal-clear water polishing down to the mosaic floor, physical vacuuming and perimeter overflow grating maintenance, and filtration flow verification.',
            'img'        => resolve_image('images/proyek/proyek-7-laska-hotel-subang'),
        ],
        [
            'slug'       => 'desain-skematik-sirkulasi-skimmer-cijagra-bandung',
            'location'   => 'Jl. Suryalaya Timur IV, Cijagra, Kota Bandung',
            'badge'      => 'Desain Skematik Sirkulasi',
            'badge_en'   => 'Circulation Schematic Design',
            'type'       => 'Sistem Skimmer Box',
            'type_en'    => 'Skimmer Box System',
            'scope'      => 'Lingkup: Skematik Sirkulasi Skimmer Box & Ruang Mesin',
            'scope_en'   => 'Scope: Skimmer Box Circulation Schematic & Pump Room',
            'title'      => 'Jasa Desain View Schematic Circulation System (Skimmer Box)',
            'title_en'   => 'View Schematic Circulation System Design (Skimmer Box)',
            'excerpt'    => 'Perancangan skematik sistem sirkulasi skimmer box lengkap dengan titik main drain, vacuum fitting, inlet fitting, lampu UWL, panel, dan jalur backwash.',
            'excerpt_en' => 'Technical circulation schematic for a skimmer box pool detailing main drain, vacuum fitting, return inlets, underwater lights, control panel, and backwash routing.',
            'body'       => 'Jl. Suryalaya Timur IV No. 20, Cijagra, Kota Bandung — Penyusunan gambar kerja View Schematic Circulation System untuk kolam renang bersistem Skimmer Box. Skematik memetakan secara terukur jalur hisap (Skimmer Box, Main Drain, dan Vacuum Fitting), jalur distribusi air bersih menuju 4 titik Inlet Fitting (IF), penempatan lampu bawah air (UWL), jalur pembuangan Backwash (BW), serta tata letak pompa, sand filter, dan panel kelistrikan 1-Phase di ruang mesin.',
            'body_en'    => 'Jl. Suryalaya Timur IV No. 20, Cijagra, Bandung City — Engineering preparation of a View Schematic Circulation System for a Skimmer Box swimming pool. The schematic maps suction lines (Skimmer Box, Main Drain, and Vacuum Fitting), clean water return lines across 4 directional Inlet Fittings (IF), underwater lighting (UWL) positions, Backwash (BW) discharge line, as well as the circulation pump, sand filter, and 1-Phase electrical control panel layout.',
            'img'        => resolve_image('images/proyek/proyek-8-skematik-skimmer-cijagra'),
            'img_fit'    => 'contain',
        ],
        [
            'slug'       => 'konstruksi-struktur-kolam-renang-kota-bandung',
            'location'   => 'Kota Bandung',
            'badge'      => 'Konstruksi Struktur',
            'badge_en'   => 'Structural Construction',
            'type'       => 'Pembangunan Baru',
            'type_en'    => 'New Pool Construction',
            'scope'      => 'Lingkup: Pembesian Struktur, Bekisting & Bak Kolam',
            'scope_en'   => 'Scope: Structural Rebar, Formwork & Pool Shell',
            'title'      => 'Konstruksi Struktur Bak Kolam Renang — Kota Bandung',
            'title_en'   => 'Swimming Pool Structural Shell Construction — Bandung City',
            'excerpt'    => 'Pengerjaan lantai kerja, perakitan pembesian balok sloof dan dinding struktur bak kolam renang sebelum tahap pengecoran kedap air.',
            'excerpt_en' => 'Sub-base preparation, structural floor beam grid and wall rebar assembly prior to monolithic watertight shell casting.',
            'body'       => 'Kota Bandung — Tahap pengerjaan konstruksi sipil dan struktur bak kolam renang mulai dari penggalian tanah, pembuatan pasangan dinding bekisting luar, lantai kerja, hingga perakitan pembesian balok sloof, tulang lantai, dan dinding kolom struktur secara presisi. Seluruh rangkaian tulangan struktur dan jalur pemipaan dasar dipersiapkan secara terukur sebelum proses pengecoran struktur monolit dan aplikasi lapisan waterproofing.',
            'body_en'    => 'Bandung City — Civil and structural swimming pool shell construction encompassing excavation, outer masonry formwork, sub-base leveling, and precision assembly of structural floor beams, slab reinforcement grids, and vertical wall columns. All structural rebar cages and embedded bottom piping routes are rigorously inspected prior to monolithic structural pouring and waterproofing application.',
            'img'        => resolve_image('images/proyek/proyek-9-konstruksi-kota-bandung'),
        ],
        [
            'slug'       => 'konstruksi-kolam-renang-tatar-teja-kencana-kotabaru-parahyangan',
            'location'   => 'Tatar Teja Kencana, Kota Baru Parahyangan',
            'badge'      => 'Jasa Konstruksi Kolam',
            'badge_en'   => 'Pool Construction Service',
            'type'       => 'Residensial',
            'type_en'    => 'Residential',
            'scope'      => 'Lingkup: Konstruksi Kolam, Saluran Overflow & Finishing',
            'scope_en'   => 'Scope: Pool Construction, Overflow Gutter & Tile Finishing',
            'title'      => 'Jasa Konstruksi Kolam Renang — Tatar Teja Kencana, Kota Baru Parahyangan',
            'title_en'   => 'Residential Swimming Pool Construction — Tatar Teja Kencana, Kota Baru Parahyangan',
            'excerpt'    => 'Pembangunan kolam renang residensial berkonsep semi-overflow dengan finishing ubin batu alam hijau, saluran gutter tepi, dan lampu bawah air.',
            'excerpt_en' => 'Residential semi-overflow swimming pool construction featuring natural green stone tile finishing, side overflow gutter trough, and underwater lighting.',
            'body'       => 'Tatar Teja Kencana, Kota Baru Parahyangan — Pengerjaan konstruksi kolam renang residensial secara menyeluruh di kawasan hunian Kota Baru Parahyangan. Lingkup pekerjaan mencakup pengecoran struktur bak kolam kedap air dan parit limpahan (overflow gutter) memanjang di sisi kanan, instalasi titik return inlet, main drain, serta lampu underwater di dinding kolam, hingga tahap pemasangan finishing ubin batu alam dan uji rendam kebocoran.',
            'body_en'    => 'Tatar Teja Kencana, Kota Baru Parahyangan — Turnkey residential swimming pool construction within the Kota Baru Parahyangan estate. Scope included watertight concrete shell casting with a continuous side overflow gutter channel, embedded wall return inlets, floor main drain, and submersible lighting fixtures, followed by precision natural green stone tiling and static water leak testing.',
            'img'        => resolve_image('images/proyek/proyek-10-kotabaru-parahyangan'),
        ],
        [
            'slug'       => 'renovasi-kolam-renang-buah-batu-bandung',
            'location'   => 'Buah Batu, Kota Bandung',
            'badge'      => 'Renovasi Kolam Renang',
            'badge_en'   => 'Swimming Pool Renovation',
            'type'       => 'Residensial',
            'type_en'    => 'Residential',
            'scope'      => 'Lingkup: Renovasi Struktur, Pemipaan & Bibir Kolam',
            'scope_en'   => 'Scope: Structural Renovation, Piping & Coping Overhaul',
            'title'      => 'Renovasi & Peremajaan Kolam Renang — Buah Batu, Kota Bandung',
            'title_en'   => 'Swimming Pool Structural & Piping Renovation — Buah Batu, Bandung',
            'excerpt'    => 'Pembongkaran bibir kolam lama, perbaikan jalur pemipaan sirkulasi, uji rendam kebocoran bak kolam, dan penataan ulang finishing.',
            'excerpt_en' => 'Demolition of old pool coping, circulation piping line renewal, static water leak immersion testing, and structural finishing overhaul.',
            'body'       => 'Buah Batu, Kota Bandung — Pengerjaan renovasi menyeluruh pada kolam renang residensial di kawasan Buah Batu. Lingkup teknis meliputi pembongkaran area bibir kolam (coping) dan jalur pipa lama yang mengalami kendala, penataan ulang saluran pemipaan sirkulasi di sekeliling bibir kolam, perbaikan lapisan kedap air, pelaksanaan uji rendam air untuk memastikan struktur bebas rembesan, hingga pemasangan kembali finishing tepi dan mozaik kolam.',
            'body_en'    => 'Buah Batu, Bandung City — Comprehensive renovation of a residential swimming pool in the Buah Batu area. Technical scope included demolition of deteriorated perimeter coping and aging plumbing lines, rerouting of perimeter circulation piping, waterproofing barrier restoration, static water immersion testing to verify zero structural seepage, and perimeter deck and mosaic re-finishing.',
            'img'        => resolve_image('images/proyek/proyek-11-renovasi-buah-batu'),
        ],
        [
            'slug'       => 'konstruksi-kolam-renang-pharmindo-cimahi',
            'location'   => 'Pharmindo, Cimahi',
            'badge'      => 'Konstruksi & Finishing',
            'badge_en'   => 'Construction & Finishing',
            'type'       => 'Residensial',
            'type_en'    => 'Residential',
            'scope'      => 'Lingkup: Konstruksi Bak, Waterproofing & Mozaik Kolam',
            'scope_en'   => 'Scope: Pool Shell, Waterproofing & Mosaic Tiling',
            'title'      => 'Konstruksi & Pemasangan Mozaik Kolam Renang — Pharmindo, Cimahi',
            'title_en'   => 'Swimming Pool Construction & Mosaic Finishing — Pharmindo, Cimahi',
            'excerpt'    => 'Pengerjaan plesteran kedap air, instalasi titik pemipaan dinding dan main drain dasar, serta pemasangan mozaik kolam renang.',
            'excerpt_en' => 'Watertight plastering, embedded wall return inlet and floor main drain piping, and precision blue pool mosaic tile installation.',
            'body'       => 'Pharmindo, Cimahi — Pengerjaan konstruksi dan tahap finishing bagian dalam bak kolam renang residensial di kawasan Pharmindo, Cimahi. Pekerjaan meliputi perataan plesteran struktur dan aplikasi lapisan waterproofing kedap air, penempatan pipa saluran inlet dinding serta pipa main drain di lantai dasar kolam, hingga pemasangan mozaik biru kolam renang menggunakan perekat khusus tahan tekanan air.',
            'body_en'    => 'Pharmindo, Cimahi — Residential swimming pool interior shell construction and mosaic finishing stage in Pharmindo, Cimahi. Work encompassed structural leveling and multi-layer waterproofing membrane application, positioning of embedded wall inlet nozzles and floor main drain plumbing, and precision turquoise-blue mosaic tiling using specialized submerged-grade tile adhesive.',
            'img'        => resolve_image('images/proyek/proyek-12-pharmindo-cimahi'),
        ],
        [
            'slug'       => 'konstruksi-kolam-semi-overflow-infinity-kotabaru-parahyangan',
            'location'   => 'Tatar Kumala Sinta, Kota Baru Parahyangan, Bandung Barat',
            'badge'      => 'Konstruksi & Skematik Sirkulasi',
            'badge_en'   => 'Pool Construction & Circulation',
            'type'       => 'Semi-Overflow Infinity',
            'type_en'    => 'Semi-Overflow Infinity',
            'scope'      => 'Lingkup: Skematik Sirkulasi, Konstruksi Infinity & Water Feature',
            'scope_en'   => 'Scope: Circulation Schematic, Infinity Pool & Waterfall Feature',
            'title'      => 'Konstruksi Kolam Renang Semi-Overflow Infinity — Kota Baru Parahyangan, Bandung Barat',
            'title_en'   => 'Semi-Overflow Infinity Pool Construction — Kota Baru Parahyangan, West Bandung',
            'excerpt'    => 'Perancangan skematik sirkulasi dan pembangunan kolam renang semi-overflow infinity lengkap dengan area sun-lounger shelf dan air terjun dinding.',
            'excerpt_en' => 'Circulation schematic design and construction of a semi-overflow infinity pool featuring an in-water sun-lounger shelf and wall waterfall feature.',
            'body'       => 'Tatar Kumala Sinta No. 103, Kota Baru Parahyangan, Bandung Barat — Pengerjaan terpadu mulai dari perancangan skematik sistem sirkulasi (jalur hisap Balancing Tank, Main Drain ganda, dan Vacuum Fitting menuju pompa & Sand Filter Multiport Valve, serta jalur distribusi Floor Inlet dan Waterfall) hingga realisasi konstruksi kolam renang Semi-Overflow Infinity. Kolam dilengkapi area dangkal (sun-lounger shelf) berlapis mozaik biru, fitur air terjun dinding (water feature), dan tepi infinity yang menghadap langsung ke lanskap hijau Bandung Barat.',
            'body_en'    => 'Tatar Kumala Sinta No. 103, Kota Baru Parahyangan, West Bandung — Integrated execution from circulation schematic engineering (mapping Balancing Tank, dual Main Drains, and Vacuum Fitting suction lines through the circulation pump and Multiport Sand Filter to Floor Inlets and Waterfall supply) to full Semi-Overflow Infinity pool construction. Features a shallow mosaic-tiled sun-lounger shelf, stainless wall waterfall feature, and an infinity edge overlooking the scenic West Bandung valley.',
            'img'        => resolve_image('images/proyek/proyek-13-tatar-kumala-sinta-kotabaru'),
            'img_fit'    => 'full',
        ],
        [
            'slug'       => 'konstruksi-kolam-renang-dago-kota-bandung',
            'location'   => 'Dago, Kota Bandung',
            'badge'      => 'Konstruksi & Mozaik',
            'badge_en'   => 'Construction & Mosaic',
            'type'       => 'Private Pool',
            'type_en'    => 'Private Pool',
            'scope'      => 'Lingkup: Konstruksi Kolam, Pemipaan & Finishing Mozaik',
            'scope_en'   => 'Scope: Pool Construction, Piping & Mosaic Finishing',
            'title'      => 'Konstruksi & Finishing Mozaik Kolam Renang — Dago, Kota Bandung',
            'title_en'   => 'Private Pool Construction & Mosaic Tiling — Dago, Bandung City',
            'excerpt'    => 'Pembangunan private pool halaman belakang lengkap dengan pelapisan waterproofing, instalasi fitting sirkulasi, dan pemasangan mozaik biru.',
            'excerpt_en' => 'Courtyard private pool construction featuring waterproofing application, circulation fitting installation, and royal-blue mosaic tiling.',
            'body'       => 'Dago, Kota Bandung — Pengerjaan konstruksi dan tahap pemasangan mozaik kolam renang pribadi (private plunge pool) pada area halaman rumah di kawasan Dago, Kota Bandung. Pekerjaan meliputi pengecoran struktur bak kolam kedap air, pelapisan membran waterproofing di seluruh dinding dan lantai, instalasi fitting pemipaan sirkulasi serta jalur kabel lampu bawah air, hingga pemasangan mozaik biru berpola gradasi secara presisi.',
            'body_en'    => 'Dago, Bandung City — Construction and mosaic tiling phase of a private courtyard plunge pool in Dago, Bandung. Technical execution encompassed watertight concrete shell construction, full interior waterproofing application, circulation fitting and underwater lighting conduit installation, and precision royal-blue blend mosaic tiling across walls and floors.',
            'img'        => resolve_image('images/proyek/proyek-14-konstruksi-dago-bandung'),
        ],
        [
            'slug'       => 'konstruksi-kolam-renang-pajajaran-kota-bandung',
            'location'   => 'Pajajaran, Kota Bandung',
            'badge'      => 'Konstruksi Kolam Renang',
            'badge_en'   => 'Swimming Pool Construction',
            'type'       => 'Residensial',
            'type_en'    => 'Residential',
            'scope'      => 'Lingkup: Konstruksi Kolam Lengkung, Skimmer & Batu Alam',
            'scope_en'   => 'Scope: Freeform Pool Construction, Skimmer & Natural Stone',
            'title'      => 'Konstruksi Kolam Renang Residensial — Pajajaran, Kota Bandung',
            'title_en'   => 'Freeform Residential Swimming Pool Construction — Pajajaran, Bandung',
            'excerpt'    => 'Pembangunan kolam renang residensial berdesain lengkung (freeform) dengan sistem skimmer box, mozaik biru, batu alam tepi, dan tangga stainless.',
            'excerpt_en' => 'Curved freeform residential swimming pool construction featuring a skimmer box system, royal-blue mosaic tiling, natural stone coping, and stainless ladder.',
            'body'       => 'Pajajaran, Kota Bandung — Pengerjaan konstruksi kolam renang residensial berdesain lengkung ergonomis (freeform curve) yang mengoptimalkan luasan halaman belakang rumah di kawasan Pajajaran, Kota Bandung. Lingkup pekerjaan mencakup pengecoran struktur bak kolam lengkung kedap air, instalasi sistem sirkulasi skimmer box dan main drain dasar, pemasangan mozaik biru kolam, penataan batu alam bibir kolam melengkung berpadu hamparan batu koral putih, serta instalasi tangga stainless steel.',
            'body_en'    => 'Pajajaran, Bandung City — Turnkey construction of a custom curved freeform residential swimming pool designed to maximize a backyard courtyard in Pajajaran, Bandung. Scope included watertight curved concrete shell casting, skimmer box and floor main drain circulation installation, vibrant royal-blue mosaic tiling, contoured natural stone coping bordered by white garden pebbles, and a stainless steel access ladder.',
            'img'        => resolve_image('images/proyek/proyek-15-pajajaran-kota-bandung'),
        ],
        [
            'slug'       => 'konstruksi-kolam-renang-dago-pakar-bandung',
            'location'   => 'Dago Pakar, Bandung',
            'badge'      => 'Konstruksi & Finishing Mozaik',
            'badge_en'   => 'Pool Construction & Mosaic',
            'type'       => 'Private Villa & Residensial',
            'type_en'    => 'Private Villa & Residential',
            'scope'      => 'Lingkup: Konstruksi Kolam, Mozaik, Dek Kayu & Heat Pump',
            'scope_en'   => 'Scope: Pool Construction, Mosaic Tiling, Wood Deck & Heat Pump',
            'title'      => 'Konstruksi Kolam Renang & Finishing Mozaik — Dago Pakar, Bandung',
            'title_en'   => 'Swimming Pool Construction & Mosaic Finishing — Dago Pakar, Bandung',
            'excerpt'    => 'Pembangunan kolam renang di kawasan Dago Pakar lengkap dengan finishing mozaik biru gradasi, tangga sudut, batu alam tepi, dek kayu, dan unit heat pump.',
            'excerpt_en' => 'Swimming pool construction in Dago Pakar featuring blue-blend mosaic tiling, corner entry steps, stone coping, timber decking, and pool heat pump unit.',
            'body'       => 'Dago Pakar, Bandung — Pengerjaan konstruksi kolam renang secara menyeluruh pada hunian di kawasan sejuk Dago Pakar, Bandung. Lingkup pekerjaan mencakup pengecoran struktur bak kolam kedap air beserta tangga sudut terintegrasi, pemasangan penuh mozaik biru gradasi dan pengisian nat tahan bahan kimia, instalasi titik return inlet dan main drain dasar, penyelesaian batu alam bibir kolam yang menyatu dengan area dek kayu, hingga integrasi unit pemanas air kolam (heat pump).',
            'body_en'    => 'Dago Pakar, Bandung — Complete swimming pool construction for a highland residence in Dago Pakar, Bandung. Scope included watertight concrete shell casting with integrated corner entry steps, full blue-blend mosaic tile installation with chemical-resistant grouting, wall return inlet and floor main drain fittings, natural stone coping seamlessly joined with timber plank decking, and pool heat pump heater integration.',
            'img'        => resolve_image('images/proyek/proyek-16-dago-pakar-bandung'),
        ],
        [
            'slug'       => 'konstruksi-kolam-renang-kotabaru-parahyangan-bandung-barat',
            'location'   => 'Kota Baru Parahyangan, Bandung Barat',
            'badge'      => 'Konstruksi & Uji Rendam',
            'badge_en'   => 'Pool Construction & Soak Test',
            'type'       => 'Residensial',
            'type_en'    => 'Residential',
            'scope'      => 'Lingkup: Konstruksi, Finishing Batu Alam & Uji Rendam',
            'scope_en'   => 'Scope: Pool Construction, Natural Stone Tiling & Soak Test',
            'title'      => 'Konstruksi & Uji Rendam Kolam Renang — Kota Baru Parahyangan, Bandung Barat',
            'title_en'   => 'Swimming Pool Construction & Static Leak Test — Kota Baru Parahyangan, West Bandung',
            'excerpt'    => 'Pemasangan ubin batu alam hijau, instalasi lampu bawah air & return inlet dinding, saluran gutter semi-overflow, serta uji rendam bak kolam.',
            'excerpt_en' => 'Natural green stone tile finishing, wall-mounted underwater LED & return inlet installation, semi-overflow gutter channel, and static water leak testing.',
            'body'       => 'Kota Baru Parahyangan, Bandung Barat — Tahap penyelesaian pemasangan ubin batu alam hijau (natural green stone), instalasi lampu bawah air (underwater LED), titik return inlet dinding, serta main drain lantai dasar pada proyek konstruksi kolam renang residensial bersistem semi-overflow. Sebelum serah terima, bak kolam dan saluran parit limpahan (gutter) melalui pengujian rendam air statis secara menyeluruh untuk memastikan ketahanan struktur dan waterproofing bebas bocor.',
            'body_en'    => 'Kota Baru Parahyangan, West Bandung — Final interior tiling and static water testing phase of a residential semi-overflow swimming pool. Technical execution covered natural green stone tile installation across the pool shell and overflow wall, embedded submersible LED fixtures, directional return inlets, and floor main drain fitting, followed by a full static water soak test to verify watertight structural integrity.',
            'img'        => resolve_image('images/proyek/proyek-17-konstruksi-kotabaru-parahyangan'),
        ],
        [
            'slug'       => 'konstruksi-kolam-renang-kota-cimahi',
            'location'   => 'Cimahi, Kota Cimahi',
            'badge'      => 'Konstruksi & Supervisi Lapangan',
            'badge_en'   => 'Pool Construction & Site Supervision',
            'type'       => 'Residensial',
            'type_en'    => 'Residential',
            'scope'      => 'Lingkup: Galian, Bekisting Bata & Struktur Kolam',
            'scope_en'   => 'Scope: Excavation, Masonry Formwork & Pool Structure',
            'title'      => 'Konstruksi Awal & Supervisi Kolam Renang — Kota Cimahi',
            'title_en'   => 'Swimming Pool Excavation & Structural Construction — Cimahi City',
            'excerpt'    => 'Penggalian lahan, pemasangan dinding bata bekisting luar, dan perakitan kolom struktur kolam dengan pengawasan langsung praktisi lapangan.',
            'excerpt_en' => 'Site excavation, outer masonry formwork wall assembly, and structural column reinforcement under direct field practitioner supervision.',
            'body'       => 'Cimahi, Kota Cimahi — Pengerjaan tahap awal konstruksi kolam renang residensial mulai dari penggalian tanah sesuai elevasi kedalaman desain, pembuatan pasangan dinding bata merah sebagai bekisting luar permanen, hingga penempatan kolom tulangan struktur di setiap sudut bak kolam. Seluruh tahapan konstruksi diawasi langsung di lapangan oleh tim teknis Dunia Pool & Pond guna memastikan ketepatan dimensi dan kekuatan struktur.',
            'body_en'    => 'Cimahi, Cimahi City — Initial construction phase of a residential swimming pool covering site excavation to design depth elevations, permanent red-brick outer formwork masonry assembly, and corner structural column reinforcement placement. Every construction milestone is directly supervised on-site by Dunia Pool & Pond technical practitioners to guarantee dimensional accuracy and structural durability.',
            'img'        => resolve_image('images/proyek/proyek-18-konstruksi-kota-cimahi'),
        ],
        [
            'slug'       => 'renovasi-kolam-renang-purwakarta',
            'location'   => 'Purwakarta',
            'badge'      => 'Renovasi & Pemulihan Sistem',
            'badge_en'   => 'Pool Renovation & Overhaul',
            'type'       => 'Vila & Resort',
            'type_en'    => 'Villa & Resort',
            'scope'      => 'Lingkup: Renovasi Kolam, Peremajaan Filtrasi & Penjernihan',
            'scope_en'   => 'Scope: Pool Renovation, Filtration Overhaul & Water Recovery',
            'title'      => 'Renovasi & Pemulihan Sistem Kolam Renang — Purwakarta',
            'title_en'   => 'Swimming Pool Renovation & Filtration System Recovery — Purwakarta',
            'excerpt'    => 'Penanganan renovasi kolam renang utama dan kolam anak, pengurasan total, perbaikan nat & lapisan dinding, serta peremajaan sistem filtrasi.',
            'excerpt_en' => 'Complete renovation of a main pool and children wading pool including full drainage, tile & grout restoration, and filtration system overhaul.',
            'body'       => 'Purwakarta — Pengerjaan renovasi dan pemulihan fungsi kolam renang utama beserta kolam anak pada area vila di Purwakarta yang lama tidak beroperasi optimal. Lingkup pekerjaan mencakup pengurasan dan pembersihan total endapan bak kolam, pemeriksaan kebocoran struktur dan perbaikan nat mozaik, peremajaan jalur pemipaan sirkulasi, penggantian media pasir silika tabung sand filter serta servis pompa di ruang mesin, hingga proses water treatment awal sampai air kembali jernih.',
            'body_en'    => 'Purwakarta — Comprehensive renovation and system recovery for a main villa swimming pool and adjacent children wading pool in Purwakarta. Technical execution encompassed full basin drainage and sediment removal, structural leak inspection and mosaic regrouting, circulation plumbing rejuvenation, sand filter silica media replacement and pump servicing, followed by initial chemical water treatment to restore crystal clarity.',
            'img'        => resolve_image('images/proyek/proyek-19-renovasi-purwakarta'),
        ],
        [
            'slug'       => 'konstruksi-kolam-renang-buah-batu-bandung',
            'location'   => 'Buah Batu, Kota Bandung',
            'badge'      => 'Konstruksi & Finishing Keramik',
            'badge_en'   => 'Pool Construction & Tile Finishing',
            'type'       => 'Residensial',
            'type_en'    => 'Residential',
            'scope'      => 'Lingkup: Konstruksi Kolam, Undakan Dangkal & Finishing',
            'scope_en'   => 'Scope: Pool Construction, Stepped Shallow Zone & Tiling',
            'title'      => 'Konstruksi Kolam Renang Residensial — Buah Batu, Kota Bandung',
            'title_en'   => 'Residential Swimming Pool Construction — Buah Batu, Bandung',
            'excerpt'    => 'Pembangunan kolam renang residensial dengan dua level undakan zona dangkal, pemasangan keramik biru kolam, dan batu alam andesit tepi.',
            'excerpt_en' => 'Residential swimming pool construction featuring dual-level stepped shallow lounging tiers, light-blue pool tiling, and andesite stone coping.',
            'body'       => 'Buah Batu, Kota Bandung — Pengerjaan konstruksi dan penyelesaian akhir (finishing) kolam renang residensial dengan desain dua level undakan tangga lebar (zona dangkal ramah keluarga) yang menyatu dengan area berenang utama. Lingkup pekerjaan mencakup pengecoran struktur bak kolam kedap air, pemasangan keramik kolam biru muda berpola diagonal dengan aksen pembatas biru tua, pengisian nat tahan air, penataan batu alam andesit di bibir kolam, serta pembersihan akhir sebelum pengisian air bersih.',
            'body_en'    => 'Buah Batu, Bandung City — Construction and final tile finishing of a residential swimming pool designed with dual-level wide stepped shallow zones transitioning into the main deep swimming basin. Scope included watertight concrete shell casting, diagonal light-blue pool tile installation with dark-blue step nosing accents, chemical-resistant grouting, natural andesite stone perimeter coping, and pre-commissioning basin cleaning.',
            'img'        => resolve_image('images/proyek/proyek-20-konstruksi-buah-batu'),
        ],
        [
            'slug'       => 'water-treatment-penjernihan-kolam-subang',
            'location'   => 'Subang',
            'badge'      => 'Water Treatment & Pemulihan Air',
            'badge_en'   => 'Water Treatment & Algae Recovery',
            'type'       => 'Private Pool',
            'type_en'    => 'Private Pool',
            'scope'      => 'Lingkup: Pembasmian Lumut, Vacuum Endapan & Penjernihan',
            'scope_en'   => 'Scope: Algae Eradication, Sediment Vacuuming & Water Clarification',
            'title'      => 'Water Treatment & Pemulihan Air Kolam Hijau Berlumut — Subang',
            'title_en'   => 'Green Pool Algae Recovery & Water Treatment — Subang',
            'excerpt'    => 'Penanganan pemulihan air kolam renang yang berubah hijau berlumut melalui pemberian chemical terukur, penyikatan dinding, flokulasi, dan vacuum buang.',
            'excerpt_en' => 'Complete water recovery treatment for an algae-bloomed green swimming pool via shock sanitation, wall brushing, flocculation, and waste vacuuming.',
            'body'       => 'Subang — Penanganan pemulihan kualitas air (water treatment recovery) pada kolam renang pribadi yang mengalami pertumbuhan lumut hijau (algae bloom) di dinding tangga dan dasar kolam. Proses teknis meliputi penyesuaian kadar pH air, pemberian dosis shock chlorine dan algaecide pembasmi spora lumut, penyikatan menyeluruh pada permukaan dinding dan anak tangga, pengendapan partikel menggunakan flokulan/PAC, diikuti proses vacuum buang (waste) dan backwash sand filter hingga air kembali jernih sehat.',
            'body_en'    => 'Subang — Intensive water treatment recovery for a private freeform swimming pool affected by heavy green algae buildup along the entry steps and basin floor. Technical procedure included pH level correction, targeted shock chlorination and algaecide dosing to neutralize algae spores, thorough wall and step brushing, particle coagulation using PAC flocculant, followed by direct-to-waste floor vacuuming and sand filter backwashing to restore sparkling, hygienic water.',
            'img'        => resolve_image('images/proyek/proyek-21-water-treatment-subang'),
        ],
        [
            'slug'       => 'jasa-desain-3d-kolam-renang-kotabaru-parahyangan',
            'location'   => 'Kota Baru Parahyangan, Bandung Barat',
            'badge'      => 'Jasa Desain 3D & Pemipaan',
            'badge_en'   => '3D Pool & Piping Design',
            'type'       => 'Sistem Skimmer Box',
            'type_en'    => 'Skimmer Box System',
            'scope'      => 'Lingkup: Pemodelan 3D Kolam, Skimmer Box & Ruang Mesin',
            'scope_en'   => 'Scope: 3D Pool Modeling, Skimmer Box & Pump Room Layout',
            'title'      => 'Jasa Desain 3D Kolam Renang & Ruang Mesin — Kota Baru Parahyangan',
            'title_en'   => '3D Swimming Pool & Pump Room Engineering Design — Kota Baru Parahyangan',
            'excerpt'    => 'Pemodelan 3 dimensi struktur bak kolam, penempatan skimmer box, jalur pemipaan hisap & return inlet, serta tata letak pompa dan sand filter.',
            'excerpt_en' => '3D architectural and mechanical modeling of pool structure, skimmer box placement, suction & return piping routes, and pump room equipment layout.',
            'body'       => 'Kota Baru Parahyangan, Bandung Barat — Pengerjaan jasa desain dan pemodelan 3 dimensi (3D CAD/SketchUp) untuk perencanaan konstruksi kolam renang bersistem Skimmer Box beserta ruang mesin bawah tanah. Model 3D memvisualisasikan secara presisi dimensi struktur bak kolam, posisi main drain dan skimmer box, jalur pipa hisap (hijau) lengkap dengan susunan ball valve manifold, posisi pompa sirkulasi, tabung sand filter, jalur pembuangan backwash (cokelat), hingga distribusi pipa air bersih (biru) menuju 4 titik return inlet dinding.',
            'body_en'    => 'Kota Baru Parahyangan, West Bandung — 3D architectural and mechanical modeling service for a Skimmer Box swimming pool and underground pump room chamber. The 3D model visualizes exact structural shell dimensions, floor main drain and skimmer box positioning, color-coded green suction lines with manifold ball valves, circulation pump and sand filter placement, brown backwash waste discharge, and blue clean-water distribution piping across 4 directional wall return inlets.',
            'img'        => resolve_image('images/proyek/proyek-22-desain-3d-kotabaru-parahyangan'),
        ],
        [
            'slug'       => 'konstruksi-kolam-renang-kuningan-jakarta',
            'location'   => 'Jl. Kuningan, Jakarta',
            'badge'      => 'Konstruksi Kolam Renang',
            'badge_en'   => 'Swimming Pool Construction',
            'type'       => 'Private Pool',
            'type_en'    => 'Private Pool',
            'scope'      => 'Lingkup: Konstruksi Private Pool, Mozaik & Dek Kayu',
            'scope_en'   => 'Scope: Private Pool Construction, Mosaic Tiling & Wood Deck',
            'title'      => 'Konstruksi Kolam Renang Residensial — Jl. Kuningan, Jakarta',
            'title_en'   => 'Residential Private Pool Construction — Jl. Kuningan, Jakarta',
            'excerpt'    => 'Pembangunan private pool minimalis memanjang dengan finishing mozaik hijau toska, sistem sirkulasi jernih, dan area dek kayu.',
            'excerpt_en' => 'Minimalist elongated private pool construction featuring turquoise mosaic tile finishing, crystal-clear circulation, and timber decking.',
            'body'       => 'Jl. Kuningan, Jakarta — Pengerjaan konstruksi kolam renang pribadi (private lap pool) berdesain minimalis modern pada hunian di kawasan Jl. Kuningan, Jakarta. Lingkup pekerjaan mencakup pengecoran struktur bak kolam kedap air, aplikasi waterproofing berlapis, instalasi jalur pemipaan sirkulasi dan return inlet dinding, pemasangan penuh mozaik kolam bernuansa hijau toska hingga bibir kolam, pemasangan tangga stainless steel, serta penyelarasan dengan area dek kayu.',
            'body_en'    => 'Jl. Kuningan, Jakarta — Turnkey construction of a modern minimalist private lap pool for a residence in Jl. Kuningan, Jakarta. Technical execution covered watertight reinforced shell casting, multi-layer waterproofing application, circulation piping and wall return inlet installation, full turquoise mosaic tiling extending across the pool rim, stainless steel ladder fitting, and seamless integration with the adjacent timber deck.',
            'img'        => resolve_image('images/proyek/proyek-23-kuningan-jakarta'),
        ],
        [
            'slug'       => 'desain-skematik-sirkulasi-skimmer-cicalengka-bandung',
            'location'   => 'Cicalengka, Bandung',
            'badge'      => 'Desain Skematik Sirkulasi',
            'badge_en'   => 'Circulation Schematic Design',
            'type'       => 'Sistem Skimmer Box',
            'type_en'    => 'Skimmer Box System',
            'scope'      => 'Lingkup: Skematik Dual Skimmer Box, Pemipaan & Ruang Mesin',
            'scope_en'   => 'Scope: Dual Skimmer Box Schematic, Piping & Pump Room',
            'title'      => 'Jasa Desain Schematic Circulation System (Skimmer Box) — Cicalengka, Bandung',
            'title_en'   => 'Schematic Circulation System Design (Skimmer Box) — Cicalengka, Bandung',
            'excerpt'    => 'Perancangan skematik sistem sirkulasi dual skimmer box, dual main drain, 6 titik inlet fitting, vacuum fitting, lampu LED, dan ruang mesin.',
            'excerpt_en' => 'Technical circulation schematic featuring dual skimmer boxes, dual floor main drains, 6 return inlet fittings, vacuum point, LED lights, and pump room.',
            'body'       => 'Cicalengka, Bandung — Penyusunan gambar kerja Schematic Circulation System untuk kolam renang bersistem Skimmer Box dengan area tangga masuk menjorok (recessed steps). Skematik memetakan secara presisi jalur pemipaan hisap dari 2 unit Skimmer Box, 2 unit Main Drain dasar, dan 1 titik Vacuum Fitting menuju manifold 4-valve di ruang mesin, diproses melalui pompa sirkulasi dan Sand Filter, lalu didistribusikan secara merata ke 6 titik Inlet Fitting dinding & area tangga serta jalur pembuangan Backwash to Gutter.',
            'body_en'    => 'Cicalengka, Bandung — Engineering preparation of a Schematic Circulation System for a Skimmer Box swimming pool featuring a recessed entry step bay. The schematic maps suction lines from dual Skimmer Boxes, dual floor Main Drains, and a central Vacuum Fitting into a 4-valve pump room manifold, routing water through the circulation pump and Sand Filter to 6 directional Inlet Fittings across the main wall and step bay, alongside a dedicated Backwash to Gutter discharge line.',
            'img'        => resolve_image('images/proyek/proyek-24-skematik-skimmer-cicalengka'),
            'img_fit'    => 'contain',
        ],
        [
            'slug'       => 'water-treatment-before-after-kotabaru-parahyangan',
            'location'   => 'Kota Baru Parahyangan, Bandung Barat',
            'badge'      => 'Water Treatment (Before & After)',
            'badge_en'   => 'Water Treatment (Before & After)',
            'type'       => 'Private Pool',
            'type_en'    => 'Private Pool',
            'scope'      => 'Lingkup: Pemulihan Air Keruh Berlumut & Penjernihan Kristal',
            'scope_en'   => 'Scope: Green Water Recovery & Crystal Clarification',
            'title'      => 'Water Treatment & Penjernihan Air Kolam (Before–After) — Kota Baru Parahyangan',
            'title_en'   => 'Swimming Pool Water Treatment (Before & After) — Kota Baru Parahyangan',
            'excerpt'    => 'Transformasi pemulihan air kolam renang dari kondisi keruh hijau pekat (Before) hingga kembali jernih kristal menampakkan corak batu alam dasar kolam (After).',
            'excerpt_en' => 'Complete water recovery transforming a murky green algae pool (Before) back into crystal-clear water revealing the natural green stone floor tiles (After).',
            'body'       => 'Kota Baru Parahyangan, Bandung Barat — Dokumentasi hasil penanganan Water Treatment (Before & After) pada kolam renang pribadi berlapis batu alam hijau. Kondisi awal air kolam yang keruh hijau pekat akibat ketidakseimbangan pH dan pertumbuhan alga dipulihkan melalui tahapan shock treatment terukur, penyikatan dinding & bibir kolam, koagulasi endapan, vacuum buang, serta optimalisasi filtrasi ruang mesin hingga air kembali jernih kristal dan corak batu alam dasar kolam terlihat tajam.',
            'body_en'    => 'Kota Baru Parahyangan, West Bandung — Documented Before & After water treatment transformation for a private lap pool finished with natural green stone tiles. Initially opaque and dark green due to pH imbalance and algae growth, the water was completely restored through calibrated shock sanitation, thorough wall and floor brushing, particle flocculation, direct-to-waste vacuuming, and filtration cycle optimization until crystal clarity was achieved.',
            'img'        => resolve_image('images/proyek/proyek-25-water-treatment-kotabaru'),
            'img_fit'    => 'full',
        ],
        [
            'slug'       => 'jasa-desain-3d-kolam-renang-tatar-larangtapa-kotabaru-parahyangan',
            'location'   => 'Tatar Larangtapa, Kota Baru Parahyangan',
            'badge'      => 'Jasa Desain & Render 3D',
            'badge_en'   => '3D Pool Design & Rendering',
            'type'       => 'Private Lap Pool',
            'type_en'    => 'Private Lap Pool',
            'scope'      => 'Lingkup: Desain 3D Arsitektural, Simulasi Siang & Malam',
            'scope_en'   => 'Scope: 3D Architectural Rendering, Day & Night Lighting Simulation',
            'title'      => 'Jasa Desain 3D Kolam Renang — Tatar Larangtapa, Kota Baru Parahyangan',
            'title_en'   => '3D Swimming Pool Architectural Design — Tatar Larangtapa, Kota Baru Parahyangan',
            'excerpt'    => 'Visualisasi desain 3D realistis kolam renang memanjang (lap pool) lengkap dengan simulasi suasana siang hari dan pencahayaan lampu LED malam hari.',
            'excerpt_en' => 'Photorealistic 3D architectural rendering of an elongated private lap pool showcasing both daytime landscape and nighttime underwater LED lighting ambience.',
            'body'       => 'Tatar Larangtapa, Kota Baru Parahyangan — Pengerjaan jasa desain dan visualisasi render 3 dimensi (Day & Night Ambience) untuk perencanaan kolam renang pribadi berdesain memanjang (private lap pool). Desain memetakan proporsi kolam terhadap kemiringan taman hijau, dinding limpahan semi-overflow berlapis mozaik biru, area dek kayu (timber deck) untuk bersantai, serta simulasi tata titik pencahayaan lampu underwater LED di malam hari sebelum konstruksi dimulai.',
            'body_en'    => 'Tatar Larangtapa, Kota Baru Parahyangan — 3D architectural design and photorealistic day-and-night rendering service for an elongated private lap pool. The visualization maps the pool geometry across the landscaped lawn, blue-mosaic semi-overflow edge wall, adjacent timber lounging deck, and nighttime submersible LED lighting distribution prior to construction execution.',
            'img'        => resolve_image('images/proyek/proyek-26-desain-3d-tatar-larangtapa'),
            'img_fit'    => 'full',
        ],
        [
            'slug'       => 'konstruksi-pembesian-kolam-renang-kota-bandung',
            'location'   => 'Kota Bandung',
            'badge'      => 'Konstruksi & Pembesian',
            'badge_en'   => 'Pool Construction & Rebar',
            'type'       => 'Residensial',
            'type_en'    => 'Residential',
            'scope'      => 'Lingkup: Perakitan Tulangan Lantai, Balok & Dinding Kolam',
            'scope_en'   => 'Scope: Floor, Cross-Beam & Wall Rebar Assembly',
            'title'      => 'Konstruksi & Perakitan Pembesian Kolam Renang — Kota Bandung',
            'title_en'   => 'Swimming Pool Rebar & Structural Construction — Bandung City',
            'excerpt'    => 'Perakitan jaringan tulangan pembesian lantai dasar, balok pengaku melintang, dan dinding bak kolam renang residensial secara presisi.',
            'excerpt_en' => 'Precision assembly of floor reinforcement grids, transverse structural beams, and vertical wall rebar for a residential swimming pool.',
            'body'       => 'Kota Bandung — Pengerjaan tahap perakitan dan pengikatan jaringan tulangan pembesian struktur bak kolam renang residensial di Kota Bandung. Tim teknis merakit tulangan lantai dasar, balok pengaku melintang (cross-beam), serta tulangan dinding vertikal dengan jarak anyaman yang konsisten dan terukur di atas lantai kerja untuk menjamin kekuatan struktur menahan beban tekan hidrostatis air sebelum tahap bekisting dalam dan pengecoran.',
            'body_en'    => 'Bandung City — Structural rebar grid assembly and tying phase for a residential swimming pool basin in Bandung City. Our technical team assembled the floor reinforcement mesh, transverse stiffening beams, and vertical wall rebar cages with uniform grid spacing over the sub-base slab to ensure long-term structural strength against hydrostatic water pressure prior to inner formwork and concrete casting.',
            'img'        => resolve_image('images/proyek/proyek-27-pembesian-kolam-kota-bandung'),
        ],
        [
            'slug'       => 'water-treatment-kolam-renang-kota-bandung',
            'location'   => 'Kota Bandung',
            'badge'      => 'Water Treatment',
            'badge_en'   => 'Water Treatment',
            'type'       => 'Private Pool',
            'type_en'    => 'Private Pool',
            'scope'      => 'Lingkup: Shock Treatment, Flokulasi & Penjernihan Air',
            'scope_en'   => 'Scope: Shock Treatment, Flocculation & Water Clarification',
            'title'      => 'Water Treatment & Penjernihan Air Kolam — Kota Bandung',
            'title_en'   => 'Swimming Pool Water Treatment & Algae Recovery — Bandung City',
            'excerpt'    => 'Penanganan water treatment intensif pada air kolam renang hijau pekat tanpa kuras total melalui shock sanitasi, pengendapan PAC, dan vacuum buang.',
            'excerpt_en' => 'Intensive water treatment recovery for a dark-green algae pool via chemical shock sanitation, PAC flocculation, and direct-to-waste vacuuming.',
            'body'       => 'Kota Bandung — Penanganan khusus water treatment pada kolam renang residensial yang mengalami kondisi air berubah hijau pekat akibat ledakan populasi alga (algae bloom) dan kadar klorin bebas yang habis. Tim teknis melakukan pengujian parameter air, pemberian dosis shock treatment dan algaecide terukur, pengikatan partikel lumut mati menggunakan koagulan penjernih, diikuti penyedotan endapan dasar kolam (vacuum to waste) serta pembilasan media filter hingga air kembali jernih.',
            'body_en'    => 'Bandung City — Specialized water treatment intervention for a residential freeform swimming pool suffering from severe dark-green water caused by chlorine depletion and algae proliferation. Our technical team executed water chemistry testing, calibrated shock chlorination and algaecide treatment, suspended particle coagulation, direct-to-waste floor sediment vacuuming, and filter media backwashing to restore clean, balanced water.',
            'img'        => resolve_image('images/proyek/proyek-28-water-treatment-kota-bandung'),
        ],
        [
            'slug'       => 'renovasi-kolam-renang-dago-pakar-bandung',
            'location'   => 'Dago Pakar, Bandung',
            'badge'      => 'Renovasi Mozaik & Fitting',
            'badge_en'   => 'Mosaic & Fitting Renovation',
            'type'       => 'Private Villa & Residensial',
            'type_en'    => 'Private Villa & Residential',
            'scope'      => 'Lingkup: Re-Finishing Mozaik, Nat & Fitting Sirkulasi',
            'scope_en'   => 'Scope: Mosaic Re-Tiling, Regrouting & Circulation Fittings',
            'title'      => 'Renovasi Mozaik & Fitting Sirkulasi Kolam Renang — Dago Pakar, Bandung',
            'title_en'   => 'Swimming Pool Mosaic & Circulation Fitting Renovation — Dago Pakar, Bandung',
            'excerpt'    => 'Peremajaan pelapis mozaik biru kolam renang, perbaikan nat tahan klorin, serta pemasangan kembali wall inlet fitting dan skimmer.',
            'excerpt_en' => 'Swimming pool blue mosaic re-tiling, chlorine-resistant regrouting, and reinstallation of wall return inlet and skimmer fittings.',
            'body'       => 'Dago Pakar, Bandung — Pengerjaan renovasi interior bak kolam renang dan peremajaan komponen sirkulasi dinding pada hunian di kawasan Dago Pakar, Bandung. Lingkup pekerjaan mencakup perbaikan lapisan waterproofing, pemasangan mozaik biru gradasi pada dinding serta aksen garis lajur pada lantai kolam, pengisian ulang nat khusus bawah air tahan bahan kimia, hingga penyegelan presisi titik return inlet fitting dan vacuum fitting agar bebas dari rembesan.',
            'body_en'    => 'Dago Pakar, Bandung — Interior basin renovation and wall circulation fitting overhaul for a residential swimming pool in Dago Pakar, Bandung. Technical scope encompassed waterproofing membrane repair, blue-blend wall mosaic installation paired with custom floor lane accents, submerged-grade chemical-resistant regrouting, and watertight sealing of wall return inlet and vacuum fittings.',
            'img'        => resolve_image('images/proyek/proyek-29-renovasi-dago-pakar'),
        ],
        [
            'slug'       => 'konstruksi-kolam-renang-abah-hotel-subang',
            'location'   => 'Abah Hotel, Subang',
            'badge'      => 'Konstruksi Kolam Hotel',
            'badge_en'   => 'Hotel Pool Construction',
            'type'       => 'Hotel & Komersial',
            'type_en'    => 'Hotel & Commercial',
            'scope'      => 'Lingkup: Konstruksi Kolam Utama, Kolam Anak & Sistem Overflow',
            'scope_en'   => 'Scope: Main Pool, Wading Pool & Perimeter Overflow System',
            'title'      => 'Konstruksi Kolam Renang Komersial — Abah Hotel Subang',
            'title_en'   => 'Commercial Hotel Swimming Pool Construction — Abah Hotel Subang',
            'excerpt'    => 'Pembangunan kolam renang hotel bersistem full overflow lengkap dengan area kolam anak melingkar, finishing mozaik biru, dan grating gutter.',
            'excerpt_en' => 'Commercial hotel overflow swimming pool construction featuring an integrated semicircular children pool, blue mosaic tiling, and perimeter gutter grating.',
            'body'       => 'Abah Hotel, Subang — Pengerjaan konstruksi kolam renang fasilitas perhotelan dengan konsep sirkulasi Full Overflow yang memadukan kolam renang utama dan area kolam anak (wading/jacuzzi pool) berbentuk setengah lingkaran. Lingkup pekerjaan mencakup pengecoran struktur bak kolam berkapasitas komersial, instalasi saluran parit limpahan (overflow gutter) keliling beserta grill penutup ABS, pemasangan penuh mozaik biru gradasi, tangga stainless steel, hingga instalasi sistem filtrasi ruang mesin.',
            'body_en'    => 'Abah Hotel, Subang — Turnkey commercial swimming pool construction for a hospitality property utilizing a Full Perimeter Overflow system that integrates a main swimming basin with a semicircular children wading zone. Scope included commercial-grade watertight concrete shell casting, continuous perimeter overflow guttering with ABS grate covers, blue-blend mosaic tile finishing, stainless steel ladder installation, and high-capacity pump room filtration.',
            'img'        => resolve_image('images/proyek/proyek-30-abah-hotel-subang'),
        ],
        [
            'slug'       => 'instalasi-ruang-mesin-lembang-bandung-barat',
            'location'   => 'Lembang, Bandung Barat',
            'badge'      => 'Instalasi Ruang Mesin',
            'badge_en'   => 'Pump Room Installation',
            'type'       => 'Sistem Sirkulasi & Filtrasi',
            'type_en'    => 'Circulation & Filtration System',
            'scope'      => 'Lingkup: Sand Filter, Manifold Valve & Pemipaan Warna',
            'scope_en'   => 'Scope: Sand Filter, True-Union Manifold & Color-Coded Piping',
            'title'      => 'Instalasi Ruang Mesin & Manifold Sirkulasi — Lembang, Bandung Barat',
            'title_en'   => 'Pump Room & Color-Coded Manifold Installation — Lembang, West Bandung',
            'excerpt'    => 'Perakitan ruang mesin kolam renang dengan tabung sand filter fiberglass, manifold 6 true-union ball valve, dan pemipaan berkode warna presisi.',
            'excerpt_en' => 'Precision pool pump room assembly featuring a fiberglass sand filter vessel, 6 true-union ball valves, and color-coded suction/return piping.',
            'body'       => 'Lembang, Bandung Barat — Pengerjaan instalasi ruang mesin kolam renang secara rapi dan terstruktur di kawasan Lembang, Bandung Barat. Lingkup pekerjaan mencakup pemasangan tabung sand filter fiberglass bertekanan tinggi, perakitan manifold pipa PVC kelas AW dengan 6 unit true-union ball valve berstandar industri, serta pengecatan kode warna jalur pipa (hijau untuk jalur hisap, biru untuk jalur return inlet, merah untuk jalur fitur air, dan cokelat untuk jalur pembuangan backwash) agar pengoperasian dan perawatan ruang mesin menjadi sangat mudah.',
            'body_en'    => 'Lembang, West Bandung — Structured, clean pump room mechanical installation in Lembang, West Bandung. Technical execution covered high-pressure fiberglass sand filter tank installation, Class AW PVC manifold routing equipped with 6 industrial true-union ball valves, and systematic color-coding of pipe circuits (green suction manifold, blue return supply, red water-feature line, and brown backwash discharge) for effortless operation and maintenance.',
            'img'        => resolve_image('images/proyek/proyek-31-ruang-mesin-lembang'),
        ],
        [
            'slug'       => 'desain-3d-ruang-mesin-balancing-tank-kotabaru-parahyangan',
            'location'   => 'Kota Baru Parahyangan, Bandung Barat',
            'badge'      => 'Desain 3D Ruang Mesin',
            'badge_en'   => '3D Pump Room Design',
            'type'       => 'Ruang Mesin & Balancing Tank',
            'type_en'    => 'Pump Room & Balancing Tank',
            'scope'      => 'Lingkup: Pemodelan 3D Ruang Mesin, Balancing Tank & Pemipaan',
            'scope_en'   => 'Scope: 3D Pump Room, Balancing Tank & Piping Layout',
            'title'      => 'Jasa Desain 3D Ruang Mesin & Balancing Tank — Kota Baru Parahyangan',
            'title_en'   => '3D Pump Room & Balancing Tank Design — Kota Baru Parahyangan',
            'excerpt'    => 'Visualisasi 3D potongan atas ruang mesin terintegrasi dengan balancing tank berlapis keramik, lengkap dengan posisi pompa, sand filter, panel listrik, dan jalur pipa.',
            'excerpt_en' => 'Top-down 3D cutaway design of an integrated underground pump room and tiled balancing tank detailing pump, sand filter, electrical panel, and piping routes.',
            'body'       => 'Kota Baru Parahyangan, Bandung Barat — Pengerjaan desain dan pemodelan 3 dimensi (3D Cutaway) untuk perencanaan tata letak ruang mesin bawah tanah yang menyatu langsung dengan bak penampung air (Balancing Tank). Visualisasi 3D memetakan secara terukur penempatan pompa sirkulasi, tabung sand filter, panel kendali kelistrikan di dinding, susunan valve jalur hisap (hijau), jalur distribusi return (biru), jalur buang backwash (cokelat), serta integrasi pipa limpahan ke ruang balancing tank berlapis keramik.',
            'body_en'    => 'Kota Baru Parahyangan, West Bandung — Detailed 3D cutaway design and spatial engineering for an integrated underground pump room and tiled Balancing Tank chamber. The 3D model specifies exact positioning of the circulation pump, sand filter tank, wall-mounted electrical panel, color-coded green suction valves, blue clean-water return lines, brown backwash waste pipe, and overflow intake plumbing into the ceramic-lined balancing tank.',
            'img'        => resolve_image('images/proyek/proyek-32-desain-3d-ruang-mesin-kotabaru'),
        ],
        [
            'slug'       => 'konstruksi-kolam-renang-pangandaran',
            'location'   => 'Pangandaran, Jawa Barat',
            'badge'      => 'Konstruksi & Bekisting Struktur',
            'badge_en'   => 'Pool Structure & Formwork',
            'type'       => 'Resort & Residensial',
            'type_en'    => 'Resort & Residential',
            'scope'      => 'Lingkup: Pembesian Struktur, Bekisting Dalam & Pengecoran',
            'scope_en'   => 'Scope: Structural Rebar, Inner Formwork & Concrete Casting',
            'title'      => 'Konstruksi Struktur & Bekisting Kolam Renang — Pangandaran',
            'title_en'   => 'Swimming Pool Structural & Formwork Construction — Pangandaran',
            'excerpt'    => 'Pemasangan pembesian bak kolam memanjang, perakitan bekisting dalam dan penyangga skur presisi menjelang tahap pengecoran monolit.',
            'excerpt_en' => 'Structural rebar reinforcement and braced inner formwork assembly for an elongated swimming pool shell prior to monolithic concrete pouring.',
            'body'       => 'Pangandaran, Jawa Barat — Pengerjaan tahap struktur dan bekisting dalam (inner formwork & bracing) pada proyek konstruksi kolam renang berdimensi panjang di kawasan Pangandaran. Lingkup teknis meliputi perakitan jaringan tulangan lantai dan dinding struktur bak kolam, penempatan jalur pipa dasar, pemasangan bekisting dalam yang diperkuat sistem penyangga melintang (skur) secara presisi agar dinding bak kolam tetap lurus sempurna dan kedap air saat proses pengecoran monolit.',
            'body_en'    => 'Pangandaran, West Java — Structural reinforcement and heavy-duty inner formwork bracing phase for an elongated swimming pool construction in Pangandaran. Technical scope encompassed floor and vertical wall rebar cage assembly, embedded bottom piping setup, and precision-braced inner formwork engineered to maintain strict wall alignment and watertight integrity during monolithic concrete pouring.',
            'img'        => resolve_image('images/proyek/proyek-33-konstruksi-pangandaran'),
        ],
        [
            'slug'       => 'konstruksi-kolam-renang-infinity-jakarta',
            'location'   => 'Jakarta',
            'badge'      => 'Konstruksi & Pemipaan Infinity',
            'badge_en'   => 'Infinity Pool Construction',
            'type'       => 'Private Villa & Residensial',
            'type_en'    => 'Private Villa & Residential',
            'scope'      => 'Lingkup: Konstruksi Dinding Infinity, Batu Alam & Pemipaan',
            'scope_en'   => 'Scope: Infinity Wall Construction, Natural Stone & Piping',
            'title'      => 'Konstruksi Kolam Renang Infinity & Pemipaan — Jakarta',
            'title_en'   => 'Infinity Swimming Pool Construction & Piping — Jakarta',
            'excerpt'    => 'Pembangunan struktur bak kolam elevated infinity edge dengan finishing batu alam hijau, dinding luar andesit, serta jalur pemipaan PVC kelas AW.',
            'excerpt_en' => 'Elevated infinity-edge swimming pool construction featuring natural green stone interior tiling, dark andesite exterior cladding, and Class AW PVC piping.',
            'body'       => 'Jakarta — Pengerjaan konstruksi kolam renang berkonsep elevated infinity edge pada lahan berkontur. Lingkup pekerjaan mencakup pengecoran struktur dinding limpahan (infinity wall) kedap air, pemasangan ubin batu alam hijau pada bagian dalam kolam dan batu andesit gelap pada sisi luar dinding limpahan, pembuatan saluran bak penampung (catch basin), serta instalasi jalur pipa PVC kelas AW berdiameter besar menuju ruang mesin dan balancing tank bawah tanah.',
            'body_en'    => 'Jakarta — Construction of an elevated infinity-edge swimming pool engineered for sloped terrain. Scope included watertight concrete infinity wall casting, natural green stone tiling inside the pool basin paired with dark andesite stone cladding along the outer spillover face, lower catch basin construction, and large-diameter Class AW PVC piping routed to the underground balancing tank and pump chamber.',
            'img'        => resolve_image('images/proyek/proyek-34-konstruksi-jakarta'),
        ],
        [
            'slug'       => 'konstruksi-kolam-renang-purwakarta',
            'location'   => 'Purwakarta, Jawa Barat',
            'badge'      => 'Konstruksi Struktur & Pemipaan',
            'badge_en'   => 'Pool Structure & Piping',
            'type'       => 'Komersial & Residensial',
            'type_en'    => 'Commercial & Residential',
            'scope'      => 'Lingkup: Struktur Bak Kolam, Jalur Inlet & Gutter',
            'scope_en'   => 'Scope: Structural Pool Shell, Embedded Inlets & Overflow Gutter',
            'title'      => 'Konstruksi Struktur & Pemipaan Kolam Renang — Purwakarta',
            'title_en'   => 'Swimming Pool Structural Shell & Embedded Piping — Purwakarta',
            'excerpt'    => 'Pengecoran struktur bak kolam bertulang, penanaman rangkaian pipa return inlet dinding, dan persiapan saluran gutter overflow keliling.',
            'excerpt_en' => 'Reinforced pool basin casting, embedded wall return inlet pipe array installation, and perimeter overflow gutter reinforcement.',
            'body'       => 'Purwakarta, Jawa Barat — Pengerjaan konstruksi struktur bak kolam renang berdimensi besar di kawasan Purwakarta. Lingkup teknis meliputi pengecoran dinding dan dasar bak kolam bertulang yang kedap air, penanaman deretan pipa return inlet dan main drain terintegrasi langsung pada struktur dinding sebelum plesteran, serta persiapan tulangan stek untuk pembentukan saluran limpahan (overflow gutter) keliling sebelum tahap waterproofing dan finishing mozaik.',
            'body_en'    => 'Purwakarta, West Java — Large-format swimming pool structural shell construction in Purwakarta. Scope included watertight reinforced basin casting, precision alignment of embedded wall return inlet lines and floor main drain piping prior to plastering, and perimeter starter bar reinforcement for the continuous overflow gutter channel ahead of waterproofing and mosaic tiling.',
            'img'        => resolve_image('images/proyek/proyek-35-konstruksi-purwakarta'),
        ],
        [
            'slug'       => 'instalasi-water-heater-heat-pump-kolam-renang',
            'location'   => '',
            'badge'      => 'Instalasi Water Heater / Heat Pump',
            'badge_en'   => 'Pool Water Heater / Heat Pump',
            'type'       => 'Pemanas Air Kolam',
            'type_en'    => 'Pool Heating System',
            'scope'      => 'Lingkup: Pengadaan Unit Ariston Heat Pump, Bypass & Panel',
            'scope_en'   => 'Scope: Ariston Heat Pump Supply, Bypass Piping & Electrical',
            'title'      => 'Pengadaan & Instalasi Swimming Pool Heat Pump (Water Heater)',
            'title_en'   => 'Swimming Pool Heat Pump (Water Heater) Supply & Installation',
            'excerpt'    => 'Pengadaan unit resmi Ariston Swimming Pool Heat Pump lengkap dengan instalasi pipa bypass, proteksi kelistrikan, dan kalibrasi suhu air.',
            'excerpt_en' => 'Supply and turnkey installation of a genuine Ariston Swimming Pool Heat Pump with bypass plumbing, electrical safety protection, and temperature calibration.',
            'body'       => 'Pengadaan unit baru resmi Ariston Swimming Pool Heat Pump beserta pengerjaan instalasi pemanas air kolam renang secara menyeluruh. Lingkup pekerjaan mencakup penempatan unit di area terbuka berventilasi optimal, perakitan jalur pipa bypass 3-valve berbahan PVC kelas AW untuk pengaturan debit air panas yang aman bagi heat exchanger titanium, pemasangan pengaman kelistrikan terpisah (MCB/ELCB), serta pengujian kenaikan dan kestabilan suhu air kolam.',
            'body_en'    => 'Official supply and complete installation of a brand-new Ariston Swimming Pool Heat Pump water heating system. Technical scope encompassed unit placement in a well-ventilated zone, Class AW PVC 3-valve bypass manifold assembly to regulate safe water flow through the titanium heat exchanger, dedicated electrical circuit protection (MCB/ELCB), and full thermal commissioning for consistent warm water comfort.',
            'img'        => resolve_image('images/proyek/proyek-36-instalasi-water-heater-ariston'),
        ],
        [
            'slug'       => 'konstruksi-finishing-mozaik-kotabaru-parahyangan',
            'location'   => 'Kota Baru Parahyangan, Bandung Barat',
            'badge'      => 'Konstruksi & Pemasangan Mozaik',
            'badge_en'   => 'Pool Construction & Mosaic Tiling',
            'type'       => 'Private Pool',
            'type_en'    => 'Private Pool',
            'scope'      => 'Lingkup: Konstruksi Bak, Waterproofing & Mozaik Porselen',
            'scope_en'   => 'Scope: Pool Shell, Waterproofing & Porcelain Mosaic',
            'title'      => 'Konstruksi & Pemasangan Mozaik Kolam — Kota Baru Parahyangan',
            'title_en'   => 'Swimming Pool Construction & Porcelain Mosaic Tiling — Kota Baru Parahyangan',
            'excerpt'    => 'Pemasangan presisi mozaik porselen biru pada dinding dan dasar bak kolam renang elevated dengan pemandangan alam terbuka di Kota Baru Parahyangan.',
            'excerpt_en' => 'Precision blue porcelain mosaic tile installation across the walls and floor of an elevated pool overlooking scenic greenery in Kota Baru Parahyangan.',
            'body'       => 'Kota Baru Parahyangan, Bandung Barat — Tahap pengerjaan konstruksi dan pemasangan mozaik porselen biru pada bak kolam renang pribadi yang menghadap lanskap hijau terbuka. Pekerjaan mencakup perataan screed lantai kedap air, penyelarasan lubang main drain dasar, titik return inlet dan kabel lampu underwater pada dinding, serta pemasangan lembaran mozaik porselen secara rapi dan presisi menggunakan perekat khusus kolam renang.',
            'body_en'    => 'Kota Baru Parahyangan, West Bandung — Construction and precision blue porcelain mosaic tiling stage for an elevated private swimming pool overlooking open natural greenery. Scope encompassed watertight floor screed leveling, exact integration of the floor main drain sump, wall return inlet, and underwater light conduit, followed by methodical porcelain mosaic installation using submerged-grade pool tile adhesive.',
            'img'        => resolve_image('images/proyek/proyek-37-mozaik-kotabaru-parahyangan'),
        ],
        [
            'slug'       => 'konstruksi-kolam-renang-villa-subang',
            'location'   => 'Subang, Jawa Barat',
            'badge'      => 'Konstruksi & Pengawasan Lapangan',
            'badge_en'   => 'Pool Construction & Supervision',
            'type'       => 'Vila & Resort',
            'type_en'    => 'Villa & Resort',
            'scope'      => 'Lingkup: Pekerjaan Sipil, Pondasi & Bak Kolam Vila',
            'scope_en'   => 'Scope: Civil Groundwork, Foundation & Villa Pool Basin',
            'title'      => 'Konstruksi Kolam Renang Kawasan Vila — Subang, Jawa Barat',
            'title_en'   => 'Highland Villa Swimming Pool Construction — Subang, West Java',
            'excerpt'    => 'Pembangunan tahap sipil dan struktur awal kolam renang kawasan vila di perbukitan Subang dengan supervisi langsung di lokasi proyek.',
            'excerpt_en' => 'Early civil groundwork and structural basin construction for a highland villa resort swimming pool in Subang under direct on-site supervision.',
            'body'       => 'Subang, Jawa Barat — Pengerjaan konstruksi tahap sipil dan pembentukan struktur bak kolam renang pada kawasan vila perbukitan di Subang. Lingkup pekerjaan mencakup perataan kontur lahan miring, pemasangan pondasi penahan batu kali dan dinding bata bekisting luar, persiapan balok lantai struktur, serta pengawasan teknis langsung di lapangan oleh praktisi Dunia Pool & Pond.',
            'body_en'    => 'Subang, West Java — Civil groundwork and initial structural shell construction for a swimming pool within a scenic highland villa complex in Subang. Scope encompassed sloped terrain leveling, stone retaining foundations and outer masonry formwork walls, floor beam preparation, and direct on-site technical supervision by Dunia Pool & Pond practitioners.',
            'img'        => resolve_image('images/proyek/proyek-38-konstruksi-subang'),
        ],
        [
            'slug'       => 'maintenance-water-treatment-lembang',
            'location'   => 'Lembang, Bandung Barat',
            'badge'      => 'Maintenance & Water Treatment',
            'badge_en'   => 'Maintenance & Water Treatment',
            'type'       => 'Private Pool',
            'type_en'    => 'Private Pool',
            'scope'      => 'Lingkup: Sikat Dinding & Lantai, Vacuum, Shock Chemical & Penjernihan',
            'scope_en'   => 'Scope: Wall & Floor Brushing, Vacuuming, Shock Sanitation & Clarification',
            'title'      => 'Maintenance Kolam Renang & Water Treatment — Lembang, Bandung Barat',
            'title_en'   => 'Swimming Pool Maintenance & Water Treatment — Lembang, West Bandung',
            'excerpt'    => 'Penanganan pemulihan air keruh kecokelatan dan perawatan menyeluruh kolam renang semi-overflow hunian pribadi di kawasan Lembang, Bandung Barat.',
            'excerpt_en' => 'Full murky-water recovery, brushing, and chemical water treatment for a residential infinity-edge swimming pool in Lembang, West Bandung.',
            'body'       => 'Lembang, Bandung Barat — Layanan maintenance kolam renang dan water treatment pemulihan air keruh pada kolam renang hunian pribadi berdesain limpahan (infinity/overflow) di Lembang. Lingkup pengerjaan mencakup penyikatan menyeluruh permukaan dinding, lantai, dan bibir limpahan granit untuk mengangkat lumut serta endapan organik, pembersihan bak penampungan bawah, vacuum endapan, aplikasi chemical shock treatment dan flokulan secara terukur, serta penyeimbangan pH dan kadar klorin agar air kembali jernih berkilau dan aman digunakan.',
            'body_en'    => 'Lembang, West Bandung — Comprehensive swimming pool maintenance and heavy murky-water recovery treatment for a private residence infinity-edge pool in Lembang. Scope included thorough brushing of pool walls, floor, and dark granite overflow spillways to lift algae and organic sediment, lower catch-basin cleaning, vacuuming to waste, calibrated shock chlorination and flocculation dosing, plus final pH and chlorine balancing to restore crystal-clear, swim-ready water.',
            'img'        => resolve_image('images/proyek/proyek-39-maintenance-lembang'),
        ],
        [
            'slug'       => 'instalasi-ruang-mesin-pontianak-kalimantan',
            'location'   => 'Pontianak, Kalimantan Barat',
            'badge'      => 'Instalasi Ruang Mesin',
            'badge_en'   => 'Pump Room Installation',
            'type'       => 'Commercial & Pool System',
            'type_en'    => 'Commercial & Pool System',
            'scope'      => 'Lingkup: Sand Filter Hayward, Pompa Sirkulasi, Manifold & Panel Kontrol',
            'scope_en'   => 'Scope: Hayward Sand Filter, Circulation Pump, Manifold & Control Panel',
            'title'      => 'Instalasi Ruang Mesin & Sistem Filtrasi — Pontianak, Kalimantan Barat',
            'title_en'   => 'Pool Pump Room & Filtration System Installation — Pontianak, West Kalimantan',
            'excerpt'    => 'Pengerjaan instalasi ruang mesin kolam renang lengkap meliputi sand filter Hayward berkapasitas besar, pompa sirkulasi, jalur pipa PVC ber-valve, dan panel kontrol kelistrikan di Pontianak.',
            'excerpt_en' => 'Turnkey swimming pool pump room installation featuring a high-capacity Hayward sand filter, circulation pumps, true-union ball valve manifold, and electrical control panel in Pontianak, West Kalimantan.',
            'body'       => 'Pontianak, Kalimantan Barat — Pengerjaan proyek luar pulau untuk instalasi ruang mesin dan sistem sirkulasi filtrasi kolam renang di Pontianak, Kalimantan Barat. Lingkup pekerjaan mencakup pemasangan tabung sand filter Hayward berkapasitas besar lengkap dengan multiport valve, instalasi pompa sirkulasi di atas dudukan kokoh, perakitan manifold pipa PVC kelas tebal dengan true-union ball valve serta gantungan penyangga pipa, instalasi panel kontrol kelistrikan dinding beserta lampu indikator operasi, dan uji operasional tekanan serta aliran sistem secara menyeluruh.',
            'body_en'    => 'Pontianak, West Kalimantan — Inter-island swimming pool mechanical room and filtration system installation in Pontianak, West Kalimantan. Technical scope covered installation of a high-capacity Hayward fiberglass sand filter with multiport valve, heavy-duty circulation pump mounting, thick-wall PVC pipe manifold assembly with true-union ball valves and overhead pipe hangers, wall-mounted electrical control panel with operational indicator lights, and full pressure and circulation commissioning.',
            'img'        => resolve_image('images/proyek/proyek-40-ruang-mesin-pontianak'),
        ],
        [
            'slug'       => 'instalasi-water-heater-heat-pump-kolam-renang',
            'location'   => '',
            'badge'      => 'Instalasi Water Heater / Heat Pump',
            'badge_en'   => 'Pool Water Heater / Heat Pump',
            'type'       => 'Pemanas Air Kolam',
            'type_en'    => 'Pool Heating System',
            'scope'      => 'Lingkup: Pengadaan Unit Ariston Heat Pump, Bypass & Panel',
            'scope_en'   => 'Scope: Ariston Heat Pump Supply, Bypass Piping & Electrical',
            'title'      => 'Pengadaan & Instalasi Swimming Pool Heat Pump (Water Heater)',
            'title_en'   => 'Swimming Pool Heat Pump (Water Heater) Supply & Installation',
            'excerpt'    => 'Pengadaan unit resmi Ariston Swimming Pool Heat Pump lengkap dengan instalasi pipa bypass, proteksi kelistrikan, dan kalibrasi suhu air.',
            'excerpt_en' => 'Supply and turnkey installation of a genuine Ariston Swimming Pool Heat Pump with bypass plumbing, electrical safety protection, and temperature calibration.',
            'body'       => 'Pengadaan unit baru resmi Ariston Swimming Pool Heat Pump beserta pengerjaan instalasi pemanas air kolam renang secara menyeluruh. Lingkup pekerjaan mencakup penempatan unit di area terbuka berventilasi optimal, perakitan jalur pipa bypass 3-valve berbahan PVC kelas AW untuk pengaturan debit air panas yang aman bagi heat exchanger titanium, pemasangan pengaman kelistrikan terpisah (MCB/ELCB), serta pengujian kenaikan dan kestabilan suhu air kolam.',
            'body_en'    => 'Official supply and complete installation of a brand-new Ariston Swimming Pool Heat Pump water heating system. Technical scope encompassed unit placement in a well-ventilated zone, Class AW PVC 3-valve bypass manifold assembly to regulate safe water flow through the titanium heat exchanger, dedicated electrical circuit protection (MCB/ELCB), and full thermal commissioning for consistent warm water comfort.',
            'img'        => resolve_image('images/proyek/proyek-36-instalasi-water-heater-ariston'),
        ],
        [
            'slug'       => 'konstruksi-finishing-mozaik-kotabaru-parahyangan',
            'location'   => 'Kota Baru Parahyangan, Bandung Barat',
            'badge'      => 'Konstruksi & Pemasangan Mozaik',
            'badge_en'   => 'Pool Construction & Mosaic Tiling',
            'type'       => 'Private Pool',
            'type_en'    => 'Private Pool',
            'scope'      => 'Lingkup: Konstruksi Bak, Waterproofing & Mozaik Porselen',
            'scope_en'   => 'Scope: Pool Shell, Waterproofing & Porcelain Mosaic',
            'title'      => 'Konstruksi & Pemasangan Mozaik Kolam — Kota Baru Parahyangan',
            'title_en'   => 'Swimming Pool Construction & Porcelain Mosaic Tiling — Kota Baru Parahyangan',
            'excerpt'    => 'Pemasangan presisi mozaik porselen biru pada dinding dan dasar bak kolam renang elevated dengan pemandangan alam terbuka di Kota Baru Parahyangan.',
            'excerpt_en' => 'Precision blue porcelain mosaic tile installation across the walls and floor of an elevated pool overlooking scenic greenery in Kota Baru Parahyangan.',
            'body'       => 'Kota Baru Parahyangan, Bandung Barat — Tahap pengerjaan konstruksi dan pemasangan mozaik porselen biru pada bak kolam renang pribadi yang menghadap lanskap hijau terbuka. Pekerjaan mencakup perataan screed lantai kedap air, penyelarasan lubang main drain dasar, titik return inlet dan kabel lampu underwater pada dinding, serta pemasangan lembaran mozaik porselen secara rapi dan presisi menggunakan perekat khusus kolam renang.',
            'body_en'    => 'Kota Baru Parahyangan, West Bandung — Construction and precision blue porcelain mosaic tiling stage for an elevated private swimming pool overlooking open natural greenery. Scope encompassed watertight floor screed leveling, exact integration of the floor main drain sump, wall return inlet, and underwater light conduit, followed by methodical porcelain mosaic installation using submerged-grade pool tile adhesive.',
            'img'        => resolve_image('images/proyek/proyek-37-mozaik-kotabaru-parahyangan'),
        ],
        [
            'slug'       => 'konstruksi-kolam-renang-villa-subang',
            'location'   => 'Subang, Jawa Barat',
            'badge'      => 'Konstruksi & Pengawasan Lapangan',
            'badge_en'   => 'Pool Construction & Supervision',
            'type'       => 'Vila & Resort',
            'type_en'    => 'Villa & Resort',
            'scope'      => 'Lingkup: Pekerjaan Sipil, Pondasi & Bak Kolam Vila',
            'scope_en'   => 'Scope: Civil Groundwork, Foundation & Villa Pool Basin',
            'title'      => 'Konstruksi Kolam Renang Kawasan Vila — Subang, Jawa Barat',
            'title_en'   => 'Highland Villa Swimming Pool Construction — Subang, West Java',
            'excerpt'    => 'Pembangunan tahap sipil dan struktur awal kolam renang kawasan vila di perbukitan Subang dengan supervisi langsung di lokasi proyek.',
            'excerpt_en' => 'Early civil groundwork and structural basin construction for a highland villa resort swimming pool in Subang under direct on-site supervision.',
            'body'       => 'Subang, Jawa Barat — Pengerjaan konstruksi tahap sipil dan pembentukan struktur bak kolam renang pada kawasan vila perbukitan di Subang. Lingkup pekerjaan mencakup perataan kontur lahan miring, pemasangan pondasi penahan batu kali dan dinding bata bekisting luar, persiapan balok lantai struktur, serta pengawasan teknis langsung di lapangan oleh praktisi Dunia Pool & Pond.',
            'body_en'    => 'Subang, West Java — Civil groundwork and initial structural shell construction for a swimming pool within a scenic highland villa complex in Subang. Scope encompassed sloped terrain leveling, stone retaining foundations and outer masonry formwork walls, floor beam preparation, and direct on-site technical supervision by Dunia Pool & Pond practitioners.',
            'img'        => resolve_image('images/proyek/proyek-38-konstruksi-subang'),
        ],
        [
            'slug'       => 'maintenance-water-treatment-lembang',
            'location'   => 'Lembang, Bandung Barat',
            'badge'      => 'Maintenance & Water Treatment',
            'badge_en'   => 'Maintenance & Water Treatment',
            'type'       => 'Private Pool',
            'type_en'    => 'Private Pool',
            'scope'      => 'Lingkup: Sikat Dinding & Lantai, Vacuum, Shock Chemical & Penjernihan',
            'scope_en'   => 'Scope: Wall & Floor Brushing, Vacuuming, Shock Sanitation & Clarification',
            'title'      => 'Maintenance Kolam Renang & Water Treatment — Lembang, Bandung Barat',
            'title_en'   => 'Swimming Pool Maintenance & Water Treatment — Lembang, West Bandung',
            'excerpt'    => 'Penanganan pemulihan air keruh kecokelatan dan perawatan menyeluruh kolam renang semi-overflow hunian pribadi di kawasan Lembang, Bandung Barat.',
            'excerpt_en' => 'Full murky-water recovery, brushing, and chemical water treatment for a residential infinity-edge swimming pool in Lembang, West Bandung.',
            'body'       => 'Lembang, Bandung Barat — Layanan maintenance kolam renang dan water treatment pemulihan air keruh pada kolam renang hunian pribadi berdesain limpahan (infinity/overflow) di Lembang. Lingkup pengerjaan mencakup penyikatan menyeluruh permukaan dinding, lantai, dan bibir limpahan granit untuk mengangkat lumut serta endapan organik, pembersihan bak penampungan bawah, vacuum endapan, aplikasi chemical shock treatment dan flokulan secara terukur, serta penyeimbangan pH dan kadar klorin agar air kembali jernih berkilau dan aman digunakan.',
            'body_en'    => 'Lembang, West Bandung — Comprehensive swimming pool maintenance and heavy murky-water recovery treatment for a private residence infinity-edge pool in Lembang. Scope included thorough brushing of pool walls, floor, and dark granite overflow spillways to lift algae and organic sediment, lower catch-basin cleaning, vacuuming to waste, calibrated shock chlorination and flocculation dosing, plus final pH and chlorine balancing to restore crystal-clear, swim-ready water.',
            'img'        => resolve_image('images/proyek/proyek-39-maintenance-lembang'),
        ],
        [
            'slug'       => 'instalasi-ruang-mesin-pontianak-kalimantan',
            'location'   => 'Pontianak, Kalimantan Barat',
            'badge'      => 'Instalasi Ruang Mesin',
            'badge_en'   => 'Pump Room Installation',
            'type'       => 'Commercial & Pool System',
            'type_en'    => 'Commercial & Pool System',
            'scope'      => 'Lingkup: Sand Filter Hayward, Pompa Sirkulasi, Manifold & Panel Kontrol',
            'scope_en'   => 'Scope: Hayward Sand Filter, Circulation Pump, Manifold & Control Panel',
            'title'      => 'Instalasi Ruang Mesin & Sistem Filtrasi — Pontianak, Kalimantan Barat',
            'title_en'   => 'Pool Pump Room & Filtration System Installation — Pontianak, West Kalimantan',
            'excerpt'    => 'Pengerjaan instalasi ruang mesin kolam renang lengkap meliputi sand filter Hayward berkapasitas besar, pompa sirkulasi, jalur pipa PVC ber-valve, dan panel kontrol kelistrikan di Pontianak.',
            'excerpt_en' => 'Turnkey swimming pool pump room installation featuring a high-capacity Hayward sand filter, circulation pumps, true-union ball valve manifold, and electrical control panel in Pontianak, West Kalimantan.',
            'body'       => 'Pontianak, Kalimantan Barat — Pengerjaan proyek luar pulau untuk instalasi ruang mesin dan sistem sirkulasi filtrasi kolam renang di Pontianak, Kalimantan Barat. Lingkup pekerjaan mencakup pemasangan tabung sand filter Hayward berkapasitas besar lengkap dengan multiport valve, instalasi pompa sirkulasi di atas dudukan kokoh, perakitan manifold pipa PVC kelas tebal dengan true-union ball valve serta gantungan penyangga pipa, instalasi panel kontrol kelistrikan dinding beserta lampu indikator operasi, dan uji operasional tekanan serta aliran sistem secara menyeluruh.',
            'body_en'    => 'Pontianak, West Kalimantan — Inter-island swimming pool mechanical room and filtration system installation in Pontianak, West Kalimantan. Technical scope covered installation of a high-capacity Hayward fiberglass sand filter with multiport valve, heavy-duty circulation pump mounting, thick-wall PVC pipe manifold assembly with true-union ball valves and overhead pipe hangers, wall-mounted electrical control panel with operational indicator lights, and full pressure and circulation commissioning.',
            'img'        => resolve_image('images/proyek/proyek-40-ruang-mesin-pontianak'),
        ],
    ];
}

/**
 * 4 Evaluasi Kesalahan Umum Pembangunan Kolam (Pain Points DPP BARU).
 *
 * @return array<int, array<string, string>>
 */
function get_pain_points(): array
{
    return [
        [
            'num'      => '01',
            'title'    => 'Kontraktor Tidak Paham Desain & Sirkulasi',
            'title_en' => 'Contractors Lacking Design & Circulation Expertise',
            'desc'     => 'Memilih kontraktor yang tidak memahami tata letak dan sistem sirkulasi/plumbing justru menyulitkan perawatan harian dan memicu kebocoran struktural.',
            'desc_en'  => 'Hiring builders without pool circulation or plumbing expertise leads to severe daily maintenance issues, stagnant water, and structural cracks.',
            'risk'     => 'Risiko sirkulasi mati & struktur keropos',
            'risk_en'  => 'Stagnant flow & deteriorating shell risks',
        ],
        [
            'num'      => '02',
            'title'    => 'Biaya Pembuatan Kelewat Mahal',
            'title_en' => 'Overpriced Construction & Hidden Markups',
            'desc'     => 'Bahan sipil, semen waterproofing, maupun mesin finishing tidak sesuai spesifikasi dan mengalami markup berlebihan (overprice) tanpa kalkulasi transparan.',
            'desc_en'  => 'Civil materials, waterproofing membranes, and finishing equipment are poorly specified and subjected to excessive markups without transparent costing.',
            'risk'     => 'RAB tidak jelas & pembengkakan anggaran',
            'risk_en'  => 'Unclear BOQ & budget overruns',
        ],
        [
            'num'      => '03',
            'title'    => 'Pengerjaan Lama & Molor',
            'title_en' => 'Unpredictable Timelines & Severe Delays',
            'desc'     => 'Kinerja lamban dan jadwal proyek tidak pasti karena pelaksana tidak memiliki manajemen proyek serta SOP tahapan pengecoran dan uji tekan yang jelas.',
            'desc_en'  => 'Sluggish performance and undefined schedules arise when contractors lack formal project management, concrete cure SOPs, and pressure test phases.',
            'risk'     => 'Jadwal berantakan tanpa kepastian timeline',
            'risk_en'  => 'Disorganized timelines without delivery commitments',
        ],
        [
            'num'      => '04',
            'title'    => 'Finishing Buruk & Mudah Bocor',
            'title_en' => 'Substandard Finishing & Hidden Leakage',
            'desc'     => 'Menghabiskan ratusan juta rupiah namun nat keramik berantakan, plesteran retak, dan suara mesin bising akibat kesalahan diameter pipa hisap.',
            'desc_en'  => 'Hundreds of millions spent, yet tiles crack, plaster flakes, and pump motors scream due to incorrect suction pipe sizing and poor waterproofing.',
            'risk'     => 'Kebocoran fatal & kavitasi di kemudian hari',
            'risk_en'  => 'Severe leakage & irreversible pump cavitation',
        ],
    ];
}

/**
 * 7 Tahap Manajemen Proyek & SOP Konstruksi Kolam Renang (DPP BARU).
 *
 * @return array<int, array<string, string>>
 */
function get_timeline_steps(): array
{
    return [
        [
            'num'      => 'Tahap 01',
            'num_en'   => 'Stage 01',
            'title'    => 'Survey Lokasi & Analisis Lahan',
            'title_en' => 'Site Survey & Land Topography Analysis',
            'desc'     => 'Pengukuran kontur pekarangan, elevasi permukaan tanah, akses jalur pipa inlet/outlet, posisi ruang mesin, dan evaluasi daya dukung struktur tanah.',
            'desc_en'  => 'On-site measurement of land contours, ground elevations, piping route access, pump room positioning, and soil bearing capacity evaluation.',
        ],
        [
            'num'      => 'Tahap 02',
            'num_en'   => 'Stage 02',
            'title'    => 'Inisiasi & Desain Kolam 3D',
            'title_en' => '3D Architectural Design & Piping Schematics',
            'desc'     => 'Penyusunan gambar kerja arsitektur 3 dimensi, skematik isometrik jalur pemipaan sirkulasi, serta simulasi perbandingan sistem overflow vs skimmer.',
            'desc_en'  => 'Preparation of 3D architectural working models, isometric circulation piping schematics, and simulation of overflow vs. skimmer systems.',
        ],
        [
            'num'      => 'Tahap 03',
            'num_en'   => 'Stage 03',
            'title'    => 'Perencanaan & RAB Transparan',
            'title_en' => 'Detailed Planning & Transparent BOQ Estimate',
            'desc'     => 'Penyusunan Rencana Anggaran Biaya (RAB) terperinci tanpa hidden cost, penetapan spesifikasi material struktur & merek mesin pompa, serta jadwal kerja terukur.',
            'desc_en'  => 'Comprehensive Bill of Quantities (BOQ) with zero hidden fees, structural material specifications, pump brand selections, and an agreed timeline.',
        ],
        [
            'num'      => 'Tahap 04',
            'num_en'   => 'Stage 04',
            'title'    => 'Pelaksanaan Konstruksi & Waterproofing',
            'title_en' => 'Structural Construction & Dual Waterproofing',
            'desc'     => 'Penggalian tanah, pengerjaan struktur konstruksi bak kolam, instalasi jalur pemipaan, aplikasi waterproofing berlapis, dan pemasangan mozaik presisi.',
            'desc_en'  => 'Ground excavation, reinforced concrete casting, embedded plumbing routing, multi-layer elastomeric waterproofing, and precision mosaic tiling.',
        ],
        [
            'num'      => 'Tahap 05',
            'num_en'   => 'Stage 05',
            'title'    => 'Monitoring Proyek & Uji Tekan Pipa',
            'title_en' => 'Pressure Testing & 72-Hour Leak Inspection',
            'desc'     => 'Hydrostatic pressure test seluruh sambungan pipa plumbing pada 2.5–3.0 bar, dilanjutkan perendaman uji kebocoran bak kolam 3×24 jam sebelum finishing.',
            'desc_en'  => 'Hydrostatic pressure testing of all plumbing lines at 2.5–3.0 bar, followed by a continuous 3×24 hour pool shell water leakage test before finishing.',
        ],
        [
            'num'      => 'Tahap 06',
            'num_en'   => 'Stage 06',
            'title'    => 'Penyelesaian & Commissioning Mesin',
            'title_en' => 'Finishing & Mechanical Commissioning',
            'desc'     => 'Pengisian air perdana, penyeimbangan takaran chemical penjernih awal, pengoperasian pompa sirkulasi, sand filter multiport valve, dan lampu bawah air.',
            'desc_en'  => 'Initial water filling, startup chemical balance calibration, circulation pump startup, sand filter multiport valve commissioning, and underwater light checks.',
        ],
        [
            'num'      => 'Tahap 07',
            'num_en'   => 'Stage 07',
            'title'    => 'Serah Terima Proyek & Garansi Resmi',
            'title_en' => 'Project Handover & Warranty Certification',
            'desc'     => 'Penandatanganan Berita Acara serah terima, pelatihan operasional perawatan mandiri kepada pemilik, serta penyerahan sertifikat garansi struktur dan kebocoran.',
            'desc_en'  => 'Official handover protocol signing, hands-on routine maintenance briefing for the owner, and issuance of formal structural and leak warranty certificates.',
        ],
    ];
}

/**
 * Daftar 15 merek resmi peralatan & material pengadaan Dunia Pool & Pond.
 *
 * @return array<int, array{name:string, slug:string, img:string}>
 */
function get_brand_catalog(): array
{
    $items = [
        ['name' => 'Hayward',      'slug' => 'hayward'],
        ['name' => 'Pentair',      'slug' => 'pentair'],
        ['name' => 'Emaux',        'slug' => 'emaux'],
        ['name' => 'AstralPool',   'slug' => 'astral-pool'],
        ['name' => 'DAB',          'slug' => 'dab'],
        ['name' => 'Waterco',      'slug' => 'waterco'],
        ['name' => 'Venezia',      'slug' => 'venezia'],
        ['name' => 'York',         'slug' => 'york'],
        ['name' => 'Boost',        'slug' => 'boost'],
        ['name' => 'Viper Pool',   'slug' => 'viper-pool'],
        ['name' => 'Roman',        'slug' => 'roman'],
        ['name' => 'Roman Granit', 'slug' => 'roman-granit'],
        ['name' => 'Atena Tiles',  'slug' => 'atena'],
        ['name' => 'Mass',         'slug' => 'mass'],
        ['name' => 'Venus Tiles',  'slug' => 'venus'],
    ];

    $catalog = [];
    foreach ($items as $item) {
        $catalog[] = [
            'name' => $item['name'],
            'slug' => $item['slug'],
            'img'  => resolve_image('images/brands/' . $item['slug'], ''),
        ];
    }

    return $catalog;
}

/**
 * Render grid 15 logo merek resmi selaras dengan estetika Navy, Gold & Cream.
 *
 * @param array<int, array{name:string, slug:string, img:string}>|null $brands
 */
function render_brand_logo_grid(?array $brands = null): string
{
    $brands = $brands ?? get_brand_catalog();
    $cards = '';

    foreach ($brands as $brand) {
        $name = e($brand['name']);
        if ($brand['img'] !== '') {
            $media = '<img src="' . e($brand['img']) . '" alt="Logo ' . $name . '" loading="lazy" decoding="async" class="max-h-11 max-w-[140px] w-auto h-auto object-contain transition-transform duration-200 group-hover:scale-105" />';
        } else {
            $wordmark = e(strtoupper($brand['name']));
            $media = '<span class="font-sans font-extrabold tracking-[0.14em] text-navy-900 text-sm sm:text-base leading-none select-none">' . $wordmark . '</span>';
        }

        $cards .= '<div class="group bg-white border border-[#EAE5DC] hover:border-gold-400 rounded-xl px-3.5 py-3.5 flex flex-col items-center justify-between gap-2.5 min-h-[112px] shadow-card-soft hover:shadow-card-hover transition-all duration-200">'
            . '<div class="h-12 w-full flex items-center justify-center px-1 overflow-hidden">' . $media . '</div>'
            . '<span class="w-full pt-2 border-t border-[#F2EFE9] text-[11.5px] font-semibold text-[#556275] group-hover:text-navy-900 text-center leading-tight transition-colors">' . $name . '</span>'
            . '</div>';
    }

    return '<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3.5">' . $cards . '</div>';
}

/**
 * Daftar 11 kategori utama produk Dunia Pool & Pond.
 *
 * @return array<int, array<string, mixed>>
 */
function get_product_categories(): array
{
    return [
        [
            'num'           => '01',
            'slug'          => 'pompa',
            'featured'      => true,
            'name_id'       => 'Pompa Kolam Renang',
            'name_en'       => 'Swimming Pool Pump',
            'examples'      => ['Pompa Sirkulasi', 'Variable Speed Pump', 'Booster Pump'],
            'brands'        => 'AstralPool, Hayward, Pentair, Emaux, DAB, Venezia, York',
            'short_desc'    => 'Pompa sirkulasi hemat daya, variable speed pump, dan booster pump untuk debit filtrasi stabil kolam residensial maupun komersial.',
            'short_desc_en' => 'Energy-efficient circulation pumps, variable speed pumps, and booster pumps for steady residential and commercial filtration flow.',
            'href'          => app_url('/produk#pompa'),
            'img'           => resolve_image('images/produk/kat-01-pompa-kolam'),
        ],
        [
            'num'           => '02',
            'slug'          => 'filter',
            'featured'      => true,
            'name_id'       => 'Filter Kolam Renang',
            'name_en'       => 'Swimming Pool Filter',
            'examples'      => ['Sand Filter', 'Cartridge Filter', 'Multiport Valve', 'Media Filter'],
            'brands'        => 'AstralPool, Emaux, Hayward, Pentair, Waterco, Boost',
            'short_desc'    => 'Tabung sand filter fiberglass, cartridge filter presisi, multiport valve, pasir silika, dan media filtrasi kaca aktif.',
            'short_desc_en' => 'Fiberglass sand filter tanks, precision cartridge filters, 6-way multiport valves, silica sand, and activated glass media.',
            'href'          => app_url('/produk#filter'),
            'img'           => resolve_image('images/produk/kat-02-filter-kolam'),
        ],
        [
            'num'           => '03',
            'slug'          => 'cleaner',
            'featured'      => true,
            'name_id'       => 'Peralatan Pembersih',
            'name_en'       => 'Pool Cleaning Equipment',
            'examples'      => ['Vacuum Head', 'Vacuum Hose', 'Telescopic Pole', 'Leaf Skimmer', 'Pool Brush'],
            'brands'        => 'Hayward, Emaux, AstralPool, Pentair, Boost',
            'short_desc'    => 'Vacuum head, vacuum hose, telescopic pole, leaf skimmer, pool brush dinding alga, hingga unit robotic pool cleaner.',
            'short_desc_en' => 'Vacuum heads, floating hoses, telescopic poles, heavy-duty leaf skimmers, algae wall brushes, and robotic pool cleaners.',
            'href'          => app_url('/produk#cleaner'),
            'img'           => resolve_image('images/produk/kat-03-peralatan-pembersih'),
        ],
        [
            'num'           => '04',
            'slug'          => 'chemical',
            'featured'      => true,
            'name_id'       => 'Bahan Kimia Kolam',
            'name_en'       => 'Pool Chemical',
            'examples'      => ['Chlorine', 'Kaporit', 'pH Up', 'pH Down', 'Algaecide', 'Clarifier'],
            'brands'        => 'Viper Pool & Standar Pengolahan Air Resmi',
            'short_desc'    => 'Chlorine tablet & granular TCCA 90%, kaporit sanitasi, penyeimbang pH up/down, anti-lumut algaecide, serta clarifier penjernih air.',
            'short_desc_en' => '90% TCCA chlorine tablets & granules, sanitizers, pH up/down balancers, algaecide treatments, and water clarifiers.',
            'href'          => app_url('/produk#chemical'),
            'img'           => resolve_image('images/produk/kat-04-bahan-kimia'),
        ],
        [
            'num'           => '05',
            'slug'          => 'fittings',
            'featured'      => true,
            'name_id'       => 'Fitting & Plumbing',
            'name_en'       => 'Pool Fittings & Plumbing',
            'examples'      => ['Inlet Fitting', 'Main Drain', 'Vacuum Fitting', 'Skimmer Box', 'Pipa PVC', 'Valve'],
            'brands'        => 'Hayward, Emaux, AstralPool, Boost',
            'short_desc'    => 'Return inlet fitting, main drain cover anti-vortex, vacuum fitting, skimmer box ABS tebal, pipa PVC tekanan AW, serta ball & check valve.',
            'short_desc_en' => 'Return inlet fittings, anti-vortex main drains, vacuum points, heavy-duty ABS skimmer boxes, Class AW PVC pipes, and valves.',
            'href'          => app_url('/produk#fittings'),
            'img'           => resolve_image('images/produk/kat-05-fitting-plumbing'),
        ],
        [
            'num'           => '06',
            'slug'          => 'lighting',
            'featured'      => true,
            'name_id'       => 'Lampu Kolam Renang',
            'name_en'       => 'Pool Lighting',
            'examples'      => ['Underwater LED', 'Lampu RGB', 'Transformer 12V', 'Controller Lampu'],
            'brands'        => 'Emaux, AstralPool, Hayward, Boost',
            'short_desc'    => 'Lampu underwater LED IP68 warm white & RGB multicolor lengkap dengan trafo step-down 12V AC dan controller.',
            'short_desc_en' => 'IP68 submersible warm white & multicolor RGB LED pool lights complete with 12V AC step-down transformers and controllers.',
            'href'          => app_url('/produk#lighting'),
            'img'           => resolve_image('images/produk/kat-06-lampu-kolam'),
        ],
        [
            'num'           => '07',
            'slug'          => 'treatment',
            'featured'      => true,
            'name_id'       => 'Pengolahan Air Kolam',
            'name_en'       => 'Pool Water Treatment',
            'examples'      => ['Salt Chlorinator', 'Chemical Dosing Pump', 'UV Sterilizer', 'Ozone Generator'],
            'brands'        => 'Hayward, Pentair, AstralPool, Emaux',
            'short_desc'    => 'Sistem sterilisasi otomatis salt chlorinator, chemical dosing pump, UV sterilizer, dan ozone generator untuk kejernihan air higienis.',
            'short_desc_en' => 'Automated salt chlorinators, chemical dosing pumps, UV sterilizers, and ozone generators for hygienic, crystal-clear water.',
            'href'          => app_url('/produk#treatment'),
            'img'           => resolve_image('images/produk/kat-07-pengolahan-air'),
        ],
        [
            'num'           => '08',
            'slug'          => 'accessories',
            'featured'      => true,
            'name_id'       => 'Aksesori Kolam',
            'name_en'       => 'Pool Accessories',
            'examples'      => ['Tangga Kolam', 'Handrail', 'Overflow Grating', 'Shower Kolam'],
            'brands'        => 'Emaux, AstralPool, Hayward, Boost',
            'short_desc'    => 'Perlengkapan tepi & akses masuk kolam: tangga kolam stainless AISI 304/316, handrail, overflow grating gutter, dan shower bilas.',
            'short_desc_en' => 'Deckside & access fittings: AISI 304/316 stainless steel ladders, handrails, overflow gutter grating, and poolside showers.',
            'href'          => app_url('/produk#accessories'),
            'img'           => resolve_image('images/produk/kat-08-aksesori-kolam'),
        ],
        [
            'num'           => '09',
            'slug'          => 'heating',
            'featured'      => true,
            'name_id'       => 'Pemanas & Otomasi Kolam',
            'name_en'       => 'Pool Heating & Automation',
            'examples'      => ['Heat Pump', 'Pool Heater', 'Timer', 'Automation Controller'],
            'brands'        => 'Hayward, Pentair, AstralPool, Emaux',
            'short_desc'    => 'Unit inverter heat pump hemat listrik, pool heater air hangat, timer operasional pompa otomatis, dan panel automation controller.',
            'short_desc_en' => 'Energy-saving inverter heat pumps, warm-water pool heaters, automated pump timers, and smart automation controllers.',
            'href'          => app_url('/produk#heating'),
            'img'           => resolve_image('images/produk/kat-09-pemanas-otomasi'),
        ],
        [
            'num'           => '10',
            'slug'          => 'finishing',
            'featured'      => true,
            'name_id'       => 'Finishing & Waterproofing',
            'name_en'       => 'Pool Finishing & Waterproofing',
            'examples'      => ['Keramik Kolam', 'Mosaic Tile', 'Waterproofing', 'Tile Adhesive', 'Grout'],
            'brands'        => 'Roman, Roman Granit, Atena Tiles, Mass (Kuda Laut Mas), Venus Tiles',
            'short_desc'    => 'Keramik kolam & mosaic porselen rendah serap air lengkap dengan pelapis waterproofing, semen perekat tile adhesive, dan nat grout.',
            'short_desc_en' => 'Low-porosity porcelain pool tiles & glass mosaics paired with waterproofing membranes, tile adhesives, and chemical-resistant grout.',
            'href'          => app_url('/produk#finishing'),
            'img'           => resolve_image('images/produk/kat-10-finishing-waterproofing'),
        ],
        [
            'num'           => '11',
            'slug'          => 'spareparts',
            'featured'      => true,
            'name_id'       => 'Suku Cadang Kolam',
            'name_en'       => 'Pool Spare Parts',
            'examples'      => ['Impeller', 'Mechanical Seal', 'O-Ring', 'Gasket', 'Spare Part Pompa & Filter'],
            'brands'        => 'Hayward, Pentair, AstralPool, Emaux, DAB, Waterco, Venezia, York',
            'short_desc'    => 'Suku cadang mekanikal resmi untuk perawatan pompa & filter: impeller, mechanical seal, O-ring, gasket, handle multiport, dan pressure gauge.',
            'short_desc_en' => 'Genuine mechanical spare parts for pumps & filters: impellers, mechanical seals, O-rings, gaskets, multiport handles, and gauges.',
            'href'          => app_url('/produk#spareparts'),
            'img'           => resolve_image('images/produk/kat-11-suku-cadang'),
        ],
    ];
}

/**
 * Katalog detail 11 kategori produk lengkap beserta spesifikasi teknis & pesan WhatsApp.
 *
 * @return array<int, array<string, mixed>>
 */
function get_product_catalog(): array
{
    $categories = get_product_categories();
    $catMap = [];
    foreach ($categories as $c) {
        $catMap[$c['slug']] = $c;
    }

    return [
        [
            'num'              => '01',
            'category'         => 'pompa',
            'category_id'      => $catMap['pompa']['name_id'],
            'category_en'      => $catMap['pompa']['name_en'],
            'subcategories'    => ['Pompa Sirkulasi', 'Variable Speed Pump', 'Booster Pump'],
            'subcategories_en' => ['Circulation Pump', 'Variable Speed Pump', 'Booster Pump'],
            'title'            => 'Pompa Sirkulasi, Variable Speed & Booster Kolam',
            'title_en'         => 'Circulation, Variable Speed & Pool Booster Pumps',
            'brands'           => 'AstralPool, Hayward, Pentair, Emaux, DAB, Venezia, York',
            'img'              => $catMap['pompa']['img'],
            'alt'              => 'Pompa Kolam Renang (Swimming Pool Pump) berlatar belakang putih',
            'desc'             => 'Unit pompa sirkulasi self-priming dengan efisiensi motor tinggi, ketahanan terhadap klorin, dan performa stabil untuk filtrasi kolam residensial hingga komersial.',
            'desc_en'          => 'High-efficiency self-priming circulation pool pumps engineered with chlorine-resistant materials and continuous duty motors for residential and commercial filtration.',
            'specs'            => [
                'Varian Daya: 0.5 HP – 3.0+ HP (1-Phase 220V & 3-Phase 380V)',
                'Material Bodi: Termoplastik reinforced kaca dengan keranjang pre-filter',
                'Koneksi & Proteksi: Union 1.5"–2", Mechanical Seal Carbon/Ceramic, IP55',
            ],
            'specs_en'         => [
                'Power Range: 0.5 HP – 3.0+ HP (1-Phase 220V & 3-Phase 380V)',
                'Body Construction: Glass-reinforced thermoplastic with heavy-duty strainer basket',
                'Port & Protection: 1.5"–2" Quick Unions, Carbon/Ceramic Mechanical Seal, IP55',
            ],
            'price_label'      => 'Menyesuaikan kapasitas HP & tipe (Penawaran Resmi)',
            'price_label_en'   => 'Based on HP capacity & pump model (Official Quote)',
            'wa_text'          => 'Halo Dunia Pool & Pond, saya ingin tanya harga & ketersediaan kategori Pompa Kolam Renang (Sirkulasi / Variable Speed / Booster Pump).',
        ],
        [
            'num'              => '02',
            'category'         => 'filter',
            'category_id'      => $catMap['filter']['name_id'],
            'category_en'      => $catMap['filter']['name_en'],
            'subcategories'    => ['Sand Filter', 'Cartridge Filter', 'Multiport Valve', 'Media Filter'],
            'subcategories_en' => ['Sand Filter', 'Cartridge Filter', 'Multiport Valve', 'Filter Media'],
            'title'            => 'Tabung Sand Filter, Cartridge, Multiport Valve & Media',
            'title_en'         => 'Fiberglass Sand Filter, Cartridge Filter & Silica/Glass Media',
            'brands'           => 'AstralPool, Emaux, Hayward, Pentair, Waterco, Boost',
            'img'              => $catMap['filter']['img'],
            'alt'              => 'Filter Kolam Renang Fiberglass Top-Mount latar putih',
            'desc'             => 'Sistem penyaringan mekanis berkekuatan tekan tinggi berbahan komposit fiberglass maupun elemen cartridge, dipadukan media pasir silika murni atau media kaca aktif untuk air jernih kristal.',
            'desc_en'          => 'High-pressure mechanical filtration systems featuring composite fiberglass tanks and precision cartridge elements, loaded with pure silica sand or activated glass media.',
            'specs'            => [
                'Ukuran Tabung: Diameter 16" – 36" (Top-Mount & Side-Mount)',
                'Kelengkapan: Multiport Valve 6-Fungsi, Sight Glass, & Pressure Gauge',
                'Media Pengisian: Pasir Silika (Silica Sand) & Activated Glass Media',
            ],
            'specs_en'         => [
                'Tank Sizing: 16" – 36" Diameters (Top-Mount & Side-Mount Configurations)',
                'Valve & Instrumentation: 6-Way Multiport Valve, Sight Glass & Pressure Gauge',
                'Filtration Media: High-Purity Silica Sand & Eco-Friendly Activated Glass Media (AFM)',
            ],
            'price_label'      => 'Menyesuaikan diameter & merek (Penawaran Resmi)',
            'price_label_en'   => 'Based on tank diameter & brand (Official Quote)',
            'wa_text'          => 'Halo Dunia Pool & Pond, saya ingin tanya harga Filter Kolam Renang (Sand Filter / Cartridge Filter / Media Silika).',
        ],
        [
            'num'              => '03',
            'category'         => 'cleaner',
            'category_id'      => $catMap['cleaner']['name_id'],
            'category_en'      => $catMap['cleaner']['name_en'],
            'subcategories'    => ['Vacuum Head', 'Vacuum Hose', 'Telescopic Pole', 'Leaf Skimmer', 'Pool Brush'],
            'subcategories_en' => ['Vacuum Head', 'Vacuum Hose', 'Telescopic Pole', 'Leaf Skimmer', 'Pool Brush'],
            'title'            => 'Set Pembersih Manual & Robotic Pool Cleaner',
            'title_en'         => 'Manual Cleaning Sets & Robotic Pool Cleaners',
            'brands'           => 'Hayward, Emaux, AstralPool, Pentair, Boost',
            'img'              => $catMap['cleaner']['img'],
            'alt'              => 'Peralatan Pembersih Kolam Renang Lengkap latar putih',
            'desc'             => 'Rangkaian peralatan pemeliharaan kebersihan fisik dasar, dinding, dan permukaan air kolam—mulai dari set peralatan manual hingga robot pembersih otomatis bertenaga listrik.',
            'desc_en'          => 'Complete physical maintenance tools for pool floors, walls, and water line—ranging from heavy-duty manual vacuum equipment to autonomous robotic pool cleaners.',
            'specs'            => [
                'Set Manual: Vacuum Head 8–12 Roda, Selang Spiral 9m–15m, Stik Teleskopik',
                'Aksesoris Jaring & Sikat: Heavy-Duty Leaf Skimmer & Pool Wall Brush',
                'Opsi Otomatis: Robotic Pool Cleaner untuk pembersihan dasar & dinding',
            ],
            'specs_en'         => [
                'Manual Vacuum Kit: 8–12 Wheel Vacuum Head, 9m–15m Floating Hose, Telescopic Pole',
                'Maintenance Nets: Heavy-Duty Deep Leaf Skimmer & Algae Wall Cleaning Brush',
                'Smart Cleaners: Autonomous Robotic Pool Cleaners for floors, walls & water line',
            ],
            'price_label'      => 'Tersedia satuan maupun paket lengkap (Penawaran Resmi)',
            'price_label_en'   => 'Available individually or as complete sets (Official Quote)',
            'wa_text'          => 'Halo Dunia Pool & Pond, saya ingin tanya harga Peralatan Pembersih Kolam (Vacuum Set / Stik / Robotic).',
        ],
        [
            'num'              => '04',
            'category'         => 'chemical',
            'category_id'      => $catMap['chemical']['name_id'],
            'category_en'      => $catMap['chemical']['name_en'],
            'subcategories'    => ['Chlorine', 'Kaporit', 'pH Up', 'pH Down', 'Algaecide', 'Clarifier'],
            'subcategories_en' => ['Chlorine', 'Granular Sanitizer', 'pH Up', 'pH Down', 'Algaecide', 'Clarifier'],
            'title'            => 'Bahan Kimia Kolam: Chlorine, Kaporit, pH & Penjernih Air',
            'title_en'         => 'Pool Chemicals: Chlorine, Sanitizers, pH Balancers & Clarifiers',
            'brands'           => 'Viper Pool & Suplai Kimia Pengolahan Air Resmi',
            'img'              => $catMap['chemical']['img'],
            'alt'              => 'Bahan Kimia dan Penjernih Air Kolam Renang latar putih',
            'desc'             => 'Paket bahan kimia perawatan air untuk menjaga kadar klorin bebas, keseimbangan pH ideal (7.2–7.6), mencegah pertumbuhan lumut hijau, serta mengendapkan kekeruhan air kolam.',
            'desc_en'          => 'Certified water treatment chemicals ensuring proper active chlorine levels, stabilizing pH balance (7.2–7.6), inhibiting algae growth, and eliminating organic cloudiness.',
            'specs'            => [
                'Sanitasi: Tablet TCCA 90%, Klorin Granular 65%/90%, & Kaporit',
                'Penyeimbang Air: Soda Ash (pH Up), HCL/Dry Acid (pH Down)',
                'Pemulihan & Penjernihan: Algaecide, PAC, & Clarifier Penjernih Air',
            ],
            'specs_en'         => [
                'Sanitation Agents: 90% TCCA Slow Tablets, 65%/90% Granular Chlorine, & Shock Powder',
                'Water Balancers: Soda Ash / Sodium Carbonate (pH Up), Dry Acid / HCL (pH Down)',
                'Water Polishers: Concentrated Algaecide, Polyaluminium Chloride (PAC), & Clarifier',
            ],
            'price_label'      => 'Tersedia kemasan eceran, galon, & pail/drum (Penawaran Resmi)',
            'price_label_en'   => 'Available in retail packs, gallons, & 15–50kg drums (Official Quote)',
            'wa_text'          => 'Halo Dunia Pool & Pond, saya ingin tanya harga Bahan Kimia Kolam (Chlorine / Kaporit / pH Up-Down / Clarifier).',
        ],
        [
            'num'              => '05',
            'category'         => 'fittings',
            'category_id'      => $catMap['fittings']['name_id'],
            'category_en'      => $catMap['fittings']['name_en'],
            'subcategories'    => ['Inlet Fitting', 'Main Drain', 'Vacuum Fitting', 'Skimmer Box', 'Pipa PVC', 'Valve'],
            'subcategories_en' => ['Inlet Fitting', 'Main Drain', 'Vacuum Fitting', 'Skimmer Box', 'PVC Pipe', 'Valve'],
            'title'            => 'Skimmer Box, Return Inlet, Main Drain & Plumbing Valve',
            'title_en'         => 'Skimmer Boxes, Return Inlets, Main Drains & Plumbing Valves',
            'brands'           => 'Hayward, Emaux, AstralPool, Boost',
            'img'              => $catMap['fittings']['img'],
            'alt'              => 'Fitting dan Perlengkapan Plumbing Kolam Renang ABS latar putih',
            'desc'             => 'Komponen sirkulasi yang ditanam pada struktur dinding & lantai kolam serta jalur pemipaan ruang mesin berbahan ABS UV-stabilized dan PVC bertekanan untuk aliran air presisi.',
            'desc_en'          => 'Precision circulation fittings embedded in pool walls and floor structures alongside pump room piping, manufactured from UV-stabilized ABS and pressure PVC for smooth flow.',
            'specs'            => [
                'Wall & Floor Fittings: Return Inlet Directional, Vacuum Point, Main Drain Anti-Vortex',
                'Skimmer System: Heavy-Duty ABS Skimmer Box dengan keranjang penyaring daun',
                'Jalur Plumbing: Pipa PVC Kelas AW / Tekanan, True-Union Ball Valve & Check Valve',
            ],
            'specs_en'         => [
                'Wall & Floor Fittings: Directional Eyeball Inlets, Vacuum Suction Points, Anti-Vortex Drains',
                'Surface Skimming: Heavy-Duty ABS Skimmer Box with leaf strainer and weir flap',
                'Piping System: Class AW Pressure Pipes, True-Union Ball Valves & Non-Return Check Valves',
            ],
            'price_label'      => 'Menyesuaikan tipe ukuran inci & kebutuhan titik (Penawaran Resmi)',
            'price_label_en'   => 'Based on inch sizing & port requirements (Official Quote)',
            'wa_text'          => 'Halo Dunia Pool & Pond, saya ingin tanya harga Fitting & Plumbing Kolam (Skimmer Box / Inlet / Main Drain / Valve).',
        ],
        [
            'num'              => '06',
            'category'         => 'lighting',
            'category_id'      => $catMap['lighting']['name_id'],
            'category_en'      => $catMap['lighting']['name_en'],
            'subcategories'    => ['Underwater LED', 'Lampu RGB', 'Transformer', 'Controller Lampu'],
            'subcategories_en' => ['Underwater LED', 'RGB Light', '12V Transformer', 'Light Controller'],
            'title'            => 'Lampu Underwater LED, Lampu RGB & Trafo 12V',
            'title_en'         => 'Underwater LED Lights, RGB Systems & 12V Transformers',
            'brands'           => 'Emaux, AstralPool, Hayward, Boost',
            'img'              => $catMap['lighting']['img'],
            'alt'              => 'Lampu Bawah Air Kolam Renang Stainless LED IP68 latar putih',
            'desc'             => 'Penerangan bawah air tahan tekanan dengan standar kedap air IP68 penuh dan suplai tegangan rendah 12V AC demi keamanan total perenang di malam hari.',
            'desc_en'          => 'Pressure-sealed submersible lighting certified to full IP68 waterproof ratings and safe low-voltage 12V AC operation for optimal nighttime swimming safety.',
            'specs'            => [
                'Varian Cahaya: Warm White, Cool White, & RGB Multicolor Sinkronisasi',
                'Pemasangan & Material: Surface Mounted / Niche, Stainless Steel 316L & Resin',
                'Kelengkapan Daya: Waterproof Step-Down Transformer 12V AC & Controller RGB',
            ],
            'specs_en'         => [
                'Color Tones: 3000K Warm White, 6500K Cool White, & Synchronized RGB Multicolor',
                'Mounting & Housing: Surface Mounted / Slim Niche, AISI 316L Stainless Steel & Epoxy',
                'Power Supply: Outdoor Weatherproof Step-Down Transformer (220V/12V AC) & Controller',
            ],
            'price_label'      => 'Menyesuaikan watt & tipe instalasi (Penawaran Resmi)',
            'price_label_en'   => 'Based on wattage & installation type (Official Quote)',
            'wa_text'          => 'Halo Dunia Pool & Pond, saya ingin tanya harga Lampu Kolam Renang (Underwater LED / RGB / Transformer 12V).',
        ],
        [
            'num'              => '07',
            'category'         => 'treatment',
            'category_id'      => $catMap['treatment']['name_id'],
            'category_en'      => $catMap['treatment']['name_en'],
            'subcategories'    => ['Salt Chlorinator', 'Chemical Dosing Pump', 'UV Sterilizer', 'Ozone Generator'],
            'subcategories_en' => ['Salt Chlorinator', 'Chemical Dosing Pump', 'UV Sterilizer', 'Ozone Generator'],
            'title'            => 'Salt Chlorinator, Dosing Pump, UV Sterilizer & Ozone',
            'title_en'         => 'Salt Chlorinators, Dosing Pumps, UV Sterilizers & Ozone Systems',
            'brands'           => 'Hayward, Pentair, AstralPool, Emaux',
            'img'              => $catMap['treatment']['img'],
            'alt'              => 'Peralatan Pengolahan Air Otomatis Salt Chlorinator dan UV Sterilizer latar putih',
            'desc'             => 'Sistem disinfeksi dan pengolahan air otomatis untuk mengurangi bau klorin menyengat, mengotomatiskan takaran kimia, dan membasmi mikroorganisme tahan klorin secara kontinu.',
            'desc_en'          => 'Automated water sanitation solutions that eliminate chlorine smell, automate precise chemical dosing, and continuously neutralize chlorine-resistant pathogens.',
            'specs'            => [
                'Elektrolisis Garam: Salt Chlorinator dengan sel titanium & fitur self-cleaning',
                'Takaran Presisi: Peristaltic/Diaphragm Chemical Dosing Pump & sensor ORP/pH',
                'Sterilisasi Sekunder: Chamber UV-C Stainless & Ozone Generator komersial',
            ],
            'specs_en'         => [
                'Salt Electrolysis: Titanium Plate Salt Chlorinator with automated polarity self-cleaning',
                'Precision Dosing: Peristaltic/Diaphragm Auto Chemical Pump with ORP and pH probes',
                'Secondary Sanitation: Commercial Stainless UV-C Reactor & High-Yield Ozone Generator',
            ],
            'price_label'      => 'Menyesuaikan kubikasi air m³ kolam (Penawaran Resmi)',
            'price_label_en'   => 'Scaled to pool water volume in m³ (Official Quote)',
            'wa_text'          => 'Halo Dunia Pool & Pond, saya ingin tanya harga unit Pengolahan Air Kolam (Salt Chlorinator / Dosing Pump / UV Sterilizer).',
        ],
        [
            'num'              => '08',
            'category'         => 'accessories',
            'category_id'      => $catMap['accessories']['name_id'],
            'category_en'      => $catMap['accessories']['name_en'],
            'subcategories'    => ['Tangga Kolam', 'Handrail', 'Overflow Grating', 'Shower Kolam'],
            'subcategories_en' => ['Pool Ladder', 'Handrail', 'Overflow Grating', 'Poolside Shower'],
            'title'            => 'Tangga Stainless, Handrail, Overflow Grating & Shower',
            'title_en'         => 'Stainless Ladders, Handrails, Overflow Gratings & Showers',
            'brands'           => 'Emaux, AstralPool, Hayward, Boost',
            'img'              => $catMap['accessories']['img'],
            'alt'              => 'Aksesori Kolam Renang Tangga Stainless Handrail dan Overflow Grating latar putih',
            'desc'             => 'Kelengkapan arsitektural area basah dan tepi kolam untuk akses keluar-masuk perenang yang ergonomis serta pengamanan saluran limpasan overflow keliling.',
            'desc_en'          => 'Architectural perimeter fittings ensuring ergonomic poolside entry, safe handholds, and efficient surface water drainage along perimeter overflow gutters.',
            'specs'            => [
                'Tangga & Pegangan: Pipa Stainless Steel AISI 304/316 anti-karat (2–5 trap)',
                'Overflow Gutter: ABS Overflow Grating 1–3 pin anti-slip & tahan UV matahari',
                'Area Bilas: Poolside Outdoor Shower Stainless Steel dengan mixer & foot wash',
            ],
            'specs_en'         => [
                'Ladders & Rails: Marine Grade AISI 304/316 Stainless Steel with anti-slip rubber treads',
                'Overflow Gutter: Interlocking UV-stabilized ABS modular grating (1–3 pin designs)',
                'Rinse Fixtures: Freestanding Stainless Steel Outdoor Pool Shower with foot rinse faucet',
            ],
            'price_label'      => 'Menyesuaikan ukuran & ketebalan material (Penawaran Resmi)',
            'price_label_en'   => 'Based on dimensions & stainless steel gauge (Official Quote)',
            'wa_text'          => 'Halo Dunia Pool & Pond, saya ingin tanya harga Aksesori Kolam (Tangga Stainless / Handrail / Overflow Grating / Shower).',
        ],
        [
            'num'              => '09',
            'category'         => 'heating',
            'category_id'      => $catMap['heating']['name_id'],
            'category_en'      => $catMap['heating']['name_en'],
            'subcategories'    => ['Heat Pump', 'Pool Heater', 'Timer', 'Automation Controller'],
            'subcategories_en' => ['Heat Pump', 'Pool Heater', 'Timer Panel', 'Automation Controller'],
            'title'            => 'Heat Pump Pemanas Kolam, Timer & Automation Controller',
            'title_en'         => 'Pool Inverter Heat Pumps, Timers & Automation Controllers',
            'brands'           => 'Hayward, Pentair, AstralPool, Emaux, Panel PUIL',
            'img'              => $catMap['heating']['img'],
            'alt'              => 'Pemanas Air Kolam Inverter Heat Pump dan Panel Kontrol Timer Otomasi latar putih',
            'desc'             => 'Solusi pengendalian suhu air kolam yang nyaman sepanjang tahun menggunakan teknologi heat exchanger titanium serta pengatur jadwal operasional mesin secara otomatis.',
            'desc_en'          => 'Year-round comfortable water temperature control using high-efficiency titanium inverter heat pump technology paired with automated equipment timers.',
            'specs'            => [
                'Unit Pemanas: Inverter Heat Pump berkoefisien COP tinggi & Gas/Electric Heater',
                'Panel Otomasi: Timer sirkulasi pompa, kontaktor beban, ELCB pengaman arus bocor',
                'Kontrol Terintegrasi: Automation controller pengatur pompa, pemanas, & lampu',
            ],
            'specs_en'         => [
                'Heating Units: High-COP Inverter Pool Heat Pump with Titanium Heat Exchanger',
                'Automation Panels: Industrial schedule timers, magnetic contactors, and sensitive ELCBs',
                'Smart Integration: Smart pool controllers for synchronized pump, heater, and lighting',
            ],
            'price_label'      => 'Menyesuaikan target kenaikan suhu & daya listrik (Penawaran Resmi)',
            'price_label_en'   => 'Based on target water temp rise & electrical power (Official Quote)',
            'wa_text'          => 'Halo Dunia Pool & Pond, saya ingin tanya harga Pemanas & Otomasi Kolam (Heat Pump / Heater / Panel Timer).',
        ],
        [
            'num'              => '10',
            'category'         => 'finishing',
            'category_id'      => $catMap['finishing']['name_id'],
            'category_en'      => $catMap['finishing']['name_en'],
            'subcategories'    => ['Keramik Kolam', 'Mosaic Tile', 'Waterproofing', 'Tile Adhesive', 'Grout'],
            'subcategories_en' => ['Pool Tile', 'Mosaic Tile', 'Waterproofing', 'Tile Adhesive', 'Epoxy Grout'],
            'title'            => 'Mosaic Tile, Keramik Kolam, Waterproofing & Tile Adhesive',
            'title_en'         => 'Porcelain Mosaic, Pool Tiles, Waterproofing & Tile Adhesive',
            'brands'           => 'Roman, Roman Granit, Atena Tiles, Mass (Kuda Laut Mas), Venus Tiles',
            'img'              => $catMap['finishing']['img'],
            'alt'              => 'Material Finishing Kolam Renang Mosaic Tile Biru, Waterproofing Membrane & Semen Perekat latar putih',
            'desc'             => 'Material pelapis struktur kedap air (waterproofing) sekaligus finishing permukaan dinding dan dasar kolam yang tahan paparan air ber-klorin dan tekanan hidrostatis penuh.',
            'desc_en'          => 'Waterproofing barrier coatings combined with durable porcelain mosaics and submerged pool tiles resistant to constant chlorine exposure and full hydrostatic pressure.',
            'specs'            => [
                'Pelapis Struktur: Semen & membran waterproofing 2-komponen tahan tekanan air',
                'Ubin Finishing: Mosaic porselen (<0.5% water absorption) & keramik kolam khusus',
                'Perekat & Nat: Semen perekat tile adhesive area terendam & grout anti-asam/klorin',
            ],
            'specs_en'         => [
                'Structural Coating: 2-Component polymer-cement waterproofing membrane for hydrostatic head',
                'Finishing Tiles: Porcelain mosaic tiles (<0.5% water absorption) & specialized pool ceramics',
                'Adhesives & Grouting: Submersible-grade polymer tile adhesive & chemical-resistant epoxy grout',
            ],
            'price_label'      => 'Menyesuaikan luasan m² & motif ubin (Penawaran Resmi)',
            'price_label_en'   => 'Based on surface area m² & tile motif (Official Quote)',
            'wa_text'          => 'Halo Dunia Pool & Pond, saya ingin tanya harga & ketersediaan Material Finishing & Waterproofing (Mosaic / Keramik / Waterproofing / Perekat).',
        ],
        [
            'num'              => '11',
            'category'         => 'spareparts',
            'category_id'      => $catMap['spareparts']['name_id'],
            'category_en'      => $catMap['spareparts']['name_en'],
            'subcategories'    => ['Impeller', 'Mechanical Seal', 'O-Ring', 'Gasket', 'Spare Part Pompa & Filter'],
            'subcategories_en' => ['Impeller', 'Mechanical Seal', 'O-Ring', 'Gasket', 'Filter & Pump Spares'],
            'title'            => 'Impeller, Mechanical Seal, O-Ring, Gasket & Valve Parts',
            'title_en'         => 'Pump Impellers, Mechanical Seals, O-Rings & Multiport Spares',
            'brands'           => 'Hayward, Pentair, AstralPool, Emaux, DAB, Waterco, Venezia, York',
            'img'              => $catMap['spareparts']['img'],
            'alt'              => 'Suku Cadang Pompa dan Filter Kolam Renang Impeller Seal O-Ring latar putih',
            'desc'             => 'Komponen suku cadang orisinil pengganti untuk perbaikan cepat pompa sirkulasi dan tabung filter tanpa harus mengganti keseluruhan unit mesin utama.',
            'desc_en'          => 'Genuine OEM replacement parts for rapid servicing of circulation pumps and filter vessels, restoring peak performance without replacing full equipment sets.',
            'specs'            => [
                'Suku Cadang Pompa: Impeller Noryl/Bronze, Mechanical Seal, Strainer Basket, Tutup Pompa',
                'Seal & Karet: Lid O-Ring, Union O-Ring, Gasket Spider Valve anti-klorin',
                'Komponen Filter: Handle Multiport Valve, Lateral Arm Penahan Pasir, & Pressure Gauge',
            ],
            'specs_en'         => [
                'Pump Internals: Reinforced Noryl/Bronze Impellers, Carbon/Ceramic Seals, Strainer Baskets',
                'Gaskets & Seals: Pre-filter Lid O-Rings, Union Seals, Chlorine-Resistant Spider Gaskets',
                'Filter Spares: Multiport Valve Handles, Sand Retention Lateral Arms & Dual Pressure Gauges',
            ],
            'price_label'      => 'Menyesuaikan merek, seri, & nomor part unit (Penawaran Resmi)',
            'price_label_en'   => 'Based on brand, model & part number (Official Quote)',
            'wa_text'          => 'Halo Dunia Pool & Pond, saya sedang mencari Suku Cadang Kolam (Impeller / Mechanical Seal / O-Ring / Multiport Part).',
        ],
    ];
}

/**
 * Daftar FAQ Umum & Teknis Dunia Pool & Pond.
 *
 * @return array<int, array{q:string, a:string}>
 */
function get_general_faqs(): array
{
    return [
        [
            'q'    => 'Apakah Dunia Pool & Pond melayani pembangunan baru dan renovasi?',
            'q_en' => 'Does Dunia Pool & Pond handle both new pool construction and renovations?',
            'a'    => 'Ya, kami menangani proyek konstruksi dari nol (lahan mentah) serta renovasi total atau parsial, termasuk penanganan kebocoran struktur, pembongkaran mozaik rusak, dan pembaruan sistem pipa sirkulasi lama.',
            'a_en' => 'Yes, we execute brand-new pool construction from raw land as well as total or partial renovations, including structural crack injection, mosaic re-tiling, and pipe manifold renewals.',
        ],
        [
            'q'    => 'Bagaimana cara menentukan kapasitas pompa dan filter yang tepat?',
            'q_en' => 'How do you determine the correct pump and filter capacity?',
            'a'    => 'Kapasitas ditentukan berdasarkan total volume kubikasi air (panjang × lebar × kedalaman rata-rata) dan target waktu perputaran air (turnover rate normal 4–8 jam). Tim kami mengkalkulasikan ukuran flow rate (GPM/m³ per jam) yang akurat agar mesin tidak bekerja berlebih.',
            'a_en' => 'Capacity is sized by calculating total cubic water volume (L × W × average depth) and desired turnover time (4–6 hours). Our engineering team computes exact flow rate (m³/h) and Total Dynamic Head (TDH) so motors run at peak efficiency.',
        ],
        [
            'q'    => 'Apakah tersedia paket perawatan air dan maintenance berkala?',
            'q_en' => 'Are routine water care and maintenance packages available?',
            'a'    => 'Kami menyediakan opsi kunjungan perawatan rutin (1–2 kali seminggu) meliputi vacuuming endapan, pembersihan daun, sikat lumut, penyeimbangan kadar kimia air (pH & klorin), dan servis saringan mesin untuk area yang terjangkau.',
            'a_en' => 'We offer scheduled maintenance visits (1–2 times weekly) covering bottom vacuuming, wall brushing, water chemical testing (pH & free chlorine), and pump strainer basket cleaning in accessible service areas.',
        ],
        [
            'q'    => 'Bagaimana alur pemesanan atau konsultasi pembelian produk?',
            'q_en' => 'What is the ordering or consultation process for pool equipment?',
            'a'    => 'Anda dapat memilih kategori produk yang dibutuhkan di halaman Katalog Produk atau mengisi formulir konsultasi di halaman Kontak, maupun langsung menghubungi WhatsApp resmi kami di 0821-1807-5560 untuk konfirmasi spesifikasi dan ketersediaan stok.',
            'a_en' => 'You can select items from our online Product Catalog, submit a request on our Contact page, or message our official WhatsApp at +62 821-1807-5560 for instant stock checks and official quotes.',
        ],
        [
            'q'    => 'Apa saja yang perlu disiapkan sebelum berkonsultasi?',
            'q_en' => 'What details should I prepare before an initial consultation?',
            'a'    => 'Cukup siapkan lokasi umum proyek, estimasi dimensi luas lahan atau ukuran kolam saat ini, preferensi tipe sirkulasi (skimmer atau overflow), serta dokumentasi foto lokasi bila ada untuk mempermudah evaluasi awal.',
            'a_en' => 'Simply provide your project location, approximate yard dimensions or current pool size, preferred circulation type (skimmer or overflow), and site photos if available to accelerate preliminary evaluations.',
        ],
        [
            'q'    => 'Wilayah mana saja yang dicakup untuk pekerjaan proyek dan pengiriman?',
            'q_en' => 'What regions do you serve for construction projects and equipment delivery?',
            'a'    => 'Kami berbasis di Padalarang, Kabupaten Bandung Barat. Untuk konstruksi dan instalasi baru, kami melayani wilayah Bandung Raya, Jawa Barat, hingga proyek khusus antar kota. Pengiriman peralatan dan bahan kimia melayani pengiriman logistik ke berbagai wilayah di Indonesia.',
            'a_en' => 'We are based in Padalarang, West Bandung Regency. For pool construction and installations, we cover Greater Bandung, West Java, and selected intercity projects. Equipment and chemicals are shipped nationwide across Indonesia.',
        ],
        [
            'q'    => 'Berapa jam pompa kolam sebaiknya menyala dalam sehari?',
            'q_en' => 'How many hours should the pool pump run each day?',
            'a'    => 'Untuk kolam renang pribadi di iklim tropis, durasi optimal adalah 6 hingga 8 jam per hari, idealnya dibagi dalam dua siklus (misalnya 4 jam pagi dan 4 jam sore/malam) agar minimal 1 kali putaran penuh (1 full turnover) tercapai setiap hari.',
            'a_en' => 'For tropical residential pools, running 6 to 8 hours daily is optimal—preferably split into two 3–4 hour cycles (morning and evening)—to achieve at least 1 full water turnover per day.',
        ],
        [
            'q'    => 'Kapan media pasir filter (sand filter) perlu diganti atau di-backwash?',
            'q_en' => 'When should filter sand be backwashed or replaced?',
            'a'    => 'Backwash wajib dilakukan rutin setiap 1–2 minggu sekali atau saat jarum manometer filter naik 8–10 psi di atas tekanan normal bersih. Penggantian total media pasir silika direkomendasikan setiap 3 hingga 5 tahun.',
            'a_en' => 'Backwashing should be performed every 1–2 weeks or whenever the pressure gauge rises 8–10 psi above clean operating baseline. Complete silica sand replacement is recommended every 3 to 5 years.',
        ],
    ];
}

/**
 * Kumpulan seluruh foto galeri perusahaan yang dibaca otomatis dari satu folder khusus:
 *   images/galeri/
 *
 * Cukup tambahkan atau hapus file gambar (.jpg, .jpeg, .png, .webp, .gif, .avif)
 * di dalam folder images/galeri/ untuk memperbarui halaman /galeri.
 *
 * @return array<int, array<string, string>>
 */
function get_company_gallery_images(): array
{
    $galleryDir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'galeri';
    if (!is_dir($galleryDir)) {
        return [];
    }

    $entries = scandir($galleryDir);
    if (!is_array($entries)) {
        return [];
    }

    $allowedExts = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'avif'];
    $files = [];

    foreach ($entries as $entry) {
        if ($entry === '.' || $entry === '..' || strpos($entry, '.') === 0) {
            continue;
        }
        $fullPath = $galleryDir . DIRECTORY_SEPARATOR . $entry;
        if (!is_file($fullPath)) {
            continue;
        }
        $ext = strtolower(pathinfo($entry, PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedExts, true)) {
            continue;
        }
        $files[] = $entry;
    }

    natsort($files);

    $items = [];
    foreach ($files as $file) {
        $label = ucwords(trim((string) preg_replace('/[-_]+/', ' ', pathinfo($file, PATHINFO_FILENAME))));
        $items[] = [
            'src' => app_url('/images/galeri/' . rawurlencode($file)),
            'alt' => $label !== '' ? $label . ' — Dunia Pool & Pond' : 'Galeri Dunia Pool & Pond',
        ];
    }

    return $items;
}
