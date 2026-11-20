<?php

declare(strict_types=1);

$pageTitle = $pageTitle ?? 'Dunia Pool & Pond — The Pool Specialist Sejak 1997';
$metaDescription = $metaDescription ?? 'Dunia Pool & Pond adalah spesialis konstruksi kolam renang, sistem sirkulasi & filtrasi, pengadaan peralatan filter & pompa, bahan kimia, serta perawatan kolam sejak 1997 di Padalarang, Bandung Barat.';
$bodyClass = $bodyClass ?? 'bg-white text-navy-900 font-sans antialiased selection:bg-gold-400/30 selection:text-navy-950 flex flex-col min-h-screen';
?>
<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title><?= e($pageTitle) ?></title>
    <meta content="<?= e($metaDescription) ?>" name="description" />
    <link href="<?= e(resolve_image('images/brand/favicon-dpp', app_url('/images/brand/favicon-dpp.png'))) ?>" rel="icon" type="image/png" />

    <!-- Google Fonts: Playfair Display (Editorial Serif) & Plus Jakarta Sans (Corporate UI Sans) -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,600&amp;family=Plus+Jakarta+Sans:wght@400;500;600;700&amp;display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: {
                            950: '#071322',
                            900: '#09182B',
                            850: '#0A1C32',
                            800: '#0E223B',
                            700: '#162F4F',
                        },
                        gold: {
                            300: '#EDD093',
                            400: '#DFB465',
                            500: '#CFA04E',
                            600: '#B8893A',
                            700: '#966D28',
                        },
                        cream: {
                            50: '#FBFAF8',
                            100: '#F6F2EA',
                            200: '#EDE6D8',
                        }
                    },
                    fontFamily: {
                        serif: ['"Playfair Display"', 'Georgia', 'Cambria', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'system-ui', '-apple-system', 'Segoe UI', 'sans-serif'],
                    },
                    boxShadow: {
                        'card-soft': '0 4px 24px rgba(9, 24, 43, 0.045)',
                        'card-hover': '0 14px 34px rgba(9, 24, 43, 0.09)',
                    }
                }
            }
        };
    </script>
    <style>
        @media (prefers-reduced-motion: no-preference) {
            .reveal-up {
                opacity: 0;
                transform: translateY(18px);
                transition: opacity 0.6s cubic-bezier(0.22, 1, 0.36, 1), transform 0.6s cubic-bezier(0.22, 1, 0.36, 1);
            }
            .reveal-up.is-visible {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-2TE1QECCQB"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-2TE1QECCQB');
    </script>
</head>
<body class="<?= e($bodyClass) ?>">
<a class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-[100] focus:px-4 focus:py-2 focus:rounded-md focus:bg-gold-400 focus:text-navy-900 focus:font-semibold focus:text-sm focus:shadow-lg" href="#main-content">
    Lewati ke konten utama
</a>
