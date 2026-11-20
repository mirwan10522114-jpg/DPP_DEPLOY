<?php

declare(strict_types=1);

$pageTitle = 'Hubungi Kami & Konsultasi Teknis — Dunia Pool & Pond';
$activeNav = 'kontak';
$showPreFooterCta = false;
$mapsUrl = 'https://www.google.com/maps/place/Alat+Kolam+Renang+Bandung+Barat/data=!4m2!3m1!1s0x2e68e331a6058d93:0x6f8552486c06e786?sa=X&ved=1t:242&hl=id&ictx=111';

require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/header.php';
?>

<main class="flex-grow" id="main-content">
    <?= render_page_hero(
        'HUBUNGI SPESIALIS',
        'CONTACT SPECIALIST',
        'Mulai Rencanakan Kebutuhan Kolam Renang Anda',
        'Start Planning Your Swimming Pool Requirements',
        'Sampaikan rincian ukuran lahan, rencana renovasi kebocoran, atau spesifikasi peralatan yang Anda cari. Tim teknis kami merespons langsung melalui saluran resmi.',
        'Provide your property dimensions, pool renovation challenges, or equipment specifications. Our engineering team responds directly via our official channels.',
        'images/hero/kolam-villa'
    ) ?>

    <section class="py-16 sm:py-20 bg-cream-50">
        <div class="max-w-[1260px] mx-auto px-5 sm:px-8 lg:px-10 grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            <!-- Kolom Kiri: Informasi Kantor & Google Maps -->
            <div class="lg:col-span-5 space-y-6">
                <div class="bg-navy-900 text-white rounded-2xl p-7 sm:p-8 space-y-5 shadow-lg">
                    <h2 class="font-serif text-2xl font-semibold text-gold-400" data-i18n-en="Office &amp; Business Location" data-i18n-id="Kantor &amp; Lokasi Usaha">Kantor &amp; Lokasi Usaha</h2>
                    <div class="space-y-4 text-xs sm:text-sm text-white/80">
                        <div>
                            <p class="text-white font-semibold mb-1" data-i18n-en="Official Address" data-i18n-id="Alamat Resmi">Alamat Resmi</p>
                            <p class="leading-relaxed">
                                Gg. Karya Bakti No. 24, RT.05/RW.22, Kertamulya,<br />
                                Kec. Padalarang, Kabupaten Bandung Barat,<br />
                                Jawa Barat 40553, Indonesia
                            </p>
                        </div>
                        <div>
                            <p class="text-white font-semibold mb-1" data-i18n-en="Official Telephone / WhatsApp" data-i18n-id="Telepon / WhatsApp Resmi">Telepon / WhatsApp Resmi</p>
                            <p>
                                <a class="text-gold-400 hover:text-gold-300 font-bold text-base transition-colors" href="https://wa.me/6282118075560" rel="noopener noreferrer" target="_blank">
                                    0821-1807-5560 (+62 821-1807-5560)
                                </a>
                            </p>
                        </div>
                        <div>
                            <p class="text-white font-semibold mb-1" data-i18n-en="Operating Hours" data-i18n-id="Jam Operasional">Jam Operasional</p>
                            <p data-i18n-en="Monday – Saturday, 08:00 – 17:00 WIB (Since Aug 10, 1997)" data-i18n-id="Senin – Sabtu, 08:00 – 17:00 WIB (Sejak 10 Agustus 1997)">Senin – Sabtu, 08:00 – 17:00 WIB (Sejak 10 Agustus 1997)</p>
                        </div>
                        <div>
                            <p class="text-white font-semibold mb-1" data-i18n-en="Official Channels &amp; Documentation" data-i18n-id="Saluran Resmi &amp; Dokumentasi">Saluran Resmi &amp; Dokumentasi</p>
                            <div class="flex flex-wrap gap-3 pt-1">
                                <a class="underline hover:text-gold-400 transition-colors" href="https://www.instagram.com/duniapoolnpond/" rel="noopener noreferrer" target="_blank">Instagram: @duniapoolnpond</a>
                                <span class="text-white/30">•</span>
                                <a class="underline hover:text-gold-400 transition-colors" href="https://youtu.be/I52l1338954?si=0qZSMHI5d7VRCQGS" rel="noopener noreferrer" target="_blank" data-i18n-en="Official YouTube" data-i18n-id="YouTube Resmi">YouTube Resmi</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Peta Lokasi Google Maps Bisnis -->
                <div class="bg-white border border-[#EAE5DC] rounded-2xl overflow-hidden shadow-card-soft">
                    <div class="aspect-[16/9] w-full bg-navy-900/5 border-b border-[#EFECE5] overflow-hidden">
                        <iframe
                            allowfullscreen=""
                            class="w-full h-full border-0"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps/embed?origin=mfe&amp;pb=!1m3!2m1!1sAlat+Kolam+Renang+Bandung+Barat,+Padalarang!6i15!3m1!1sid!5m1!1sid"
                            title="Peta Lokasi Alat Kolam Renang Bandung Barat — Padalarang"
                        ></iframe>
                    </div>
                    <div class="p-5 space-y-3">
                        <div>
                            <p class="text-sm font-bold text-navy-900">Alat Kolam Renang Bandung Barat — Dunia Pool &amp; Pond</p>
                            <p class="text-xs text-[#556275] mt-0.5 leading-relaxed" data-i18n-en="Serving pool construction &amp; maintenance in Greater Bandung, West Java, intercity projects, and nationwide equipment shipments across Indonesia." data-i18n-id="Melayani konstruksi &amp; perawatan wilayah Bandung Raya, Jawa Barat &amp; proyek antar kota, serta pengiriman peralatan ke seluruh Indonesia.">
                                Melayani konstruksi &amp; perawatan wilayah Bandung Raya, Jawa Barat &amp; proyek antar kota, serta pengiriman peralatan ke seluruh Indonesia.
                            </p>
                        </div>
                        <a
                            class="inline-flex w-full items-center justify-center gap-2 h-10 px-4 rounded-md bg-navy-900 hover:bg-navy-700 text-white text-xs font-semibold transition-colors"
                            href="<?= e($mapsUrl) ?>"
                            rel="noopener noreferrer"
                            target="_blank"
                        >
                            <span data-i18n-en="Open in Google Maps" data-i18n-id="Buka di Google Maps Bisnis">Buka di Google Maps Bisnis</span>
                            <?= render_icon('arrow-right', 'w-3.5 h-3.5 text-gold-400') ?>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Formulir Konsultasi WhatsApp Interaktif -->
            <div class="lg:col-span-7 bg-white border border-[#EAE5DC] rounded-2xl p-7 sm:p-9 shadow-card-soft">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-5 mb-6 border-b border-[#EFECE5]">
                    <div>
                        <h2 class="font-serif text-2xl font-semibold text-navy-900" data-i18n-en="Technical Consultation &amp; Survey Form" data-i18n-id="Formulir Konsultasi &amp; Survei Teknis">Formulir Konsultasi &amp; Survei Teknis</h2>
                        <p class="text-xs sm:text-sm text-[#556275] mt-1" data-i18n-en="Fill in your property specifications or equipment requirements to connect directly with official WhatsApp." data-i18n-id="Isi ringkas spesifikasi lahan atau kebutuhan peralatan untuk terhubung langsung ke WhatsApp resmi.">Isi ringkas spesifikasi lahan atau kebutuhan peralatan untuk terhubung langsung ke WhatsApp resmi.</p>
                    </div>
                    <span class="px-3 py-1 rounded-md bg-[#FCF9F2] border border-[#EADAB8] text-[11px] font-bold uppercase tracking-wider text-gold-700 self-start sm:self-auto shrink-0" data-i18n-en="Official WhatsApp" data-i18n-id="WhatsApp Resmi">
                        WhatsApp Resmi
                    </span>
                </div>

                <div class="hidden mb-6 p-4 rounded-xl bg-[#ECFDF3] border border-[#ABEFC6] text-[#067647] text-xs sm:text-sm font-medium" id="contactSuccessAlert" role="status" data-i18n-en="Consultation draft ready! Redirecting you to the official WhatsApp of Dunia Pool &amp; Pond (+62 821-1807-5560)." data-i18n-id="Draf konsultasi telah disiapkan dan diarahkan ke sambungan resmi WhatsApp Dunia Pool &amp; Pond (0821-1807-5560).">
                    Draf konsultasi telah disiapkan dan diarahkan ke sambungan resmi WhatsApp Dunia Pool &amp; Pond (0821-1807-5560).
                </div>

                <form class="space-y-4" id="dppWaForm">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-navy-900 mb-1.5" for="fullName" data-i18n-en="Full Name *" data-i18n-id="Nama Lengkap *">Nama Lengkap *</label>
                            <input class="w-full h-11 px-3.5 rounded-lg border border-[#D4D9E2] text-sm focus:border-navy-900 focus:ring-navy-900" id="fullName" placeholder="Contoh: Budi Santoso" data-i18n-placeholder-id="Contoh: Budi Santoso" data-i18n-placeholder-en="E.g., John Smith" required type="text" />
                            <p class="text-[#B42318] text-xs mt-1 hidden" id="errName" data-i18n-en="Please enter your full name (minimum 2 characters)." data-i18n-id="Mohon isi nama lengkap minimal 2 karakter.">Mohon isi nama lengkap minimal 2 karakter.</p>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-navy-900 mb-1.5" for="location" data-i18n-en="City / Project Location" data-i18n-id="Kota / Lokasi Proyek">Kota / Lokasi Proyek</label>
                            <input class="w-full h-11 px-3.5 rounded-lg border border-[#D4D9E2] text-sm focus:border-navy-900 focus:ring-navy-900" id="location" placeholder="Contoh: Padalarang / Bandung / Lembang" data-i18n-placeholder-id="Contoh: Padalarang / Bandung / Lembang" data-i18n-placeholder-en="E.g., Padalarang / Bandung / Jakarta" type="text" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-navy-900 mb-1.5" for="needType" data-i18n-en="Service / Requirement *" data-i18n-id="Pilihan Kebutuhan *">Pilihan Kebutuhan *</label>
                            <select class="w-full h-11 px-3.5 rounded-lg border border-[#D4D9E2] text-sm focus:border-navy-900 focus:ring-navy-900" id="needType">
                                <option value="Jasa Konstruksi Kolam Baru" data-i18n-en="New Swimming Pool Construction" data-i18n-id="Jasa Konstruksi Kolam Baru">Jasa Konstruksi Kolam Baru</option>
                                <option value="Jasa Renovasi & Perbaikan Kebocoran" data-i18n-en="Pool Renovation & Leak Repair" data-i18n-id="Renovasi &amp; Perbaikan Kebocoran">Renovasi &amp; Perbaikan Kebocoran</option>
                                <option value="Sistem Sirkulasi & Filtrasi" data-i18n-en="Circulation & Filtration System" data-i18n-id="Sistem Sirkulasi &amp; Filtrasi">Sistem Sirkulasi &amp; Filtrasi</option>
                                <option value="Perawatan Berkala & Bahan Kimia" data-i18n-en="Routine Maintenance & Water Chemicals" data-i18n-id="Perawatan Berkala &amp; Kimia Air">Perawatan Berkala &amp; Kimia Air</option>
                                <option value="Pembelian Peralatan / Suku Cadang" data-i18n-en="Equipment / Spare Parts Purchase" data-i18n-id="Pembelian Peralatan / Suku Cadang">Pembelian Peralatan / Suku Cadang</option>
                                <option value="Konsultasi Teknis Lainnya" data-i18n-en="Other Technical Consultation" data-i18n-id="Konsultasi Teknis Lainnya">Konsultasi Teknis Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-navy-900 mb-1.5" for="relatedService" data-i18n-en="Circulation Type / Product Unit" data-i18n-id="Tipe Sirkulasi / Unit Produk">Tipe Sirkulasi / Unit Produk</label>
                            <input class="w-full h-11 px-3.5 rounded-lg border border-[#D4D9E2] text-sm focus:border-navy-900 focus:ring-navy-900" id="relatedService" placeholder="Contoh: Sistem Overflow / Pompa Hayward" data-i18n-placeholder-id="Contoh: Sistem Overflow / Pompa Hayward" data-i18n-placeholder-en="E.g., Overflow System / Hayward Pump" type="text" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-navy-900 mb-1.5" for="userMessage" data-i18n-en="Message / Project Scope *" data-i18n-id="Pesan / Uraian Kebutuhan *">Pesan / Uraian Kebutuhan *</label>
                        <textarea class="w-full px-3.5 py-2.5 rounded-lg border border-[#D4D9E2] text-sm focus:border-navy-900 focus:ring-navy-900" id="userMessage" placeholder="Jelaskan perkiraan ukuran lahan/kolam, kendala kebocoran, atau tipe mesin & suku cadang yang dicari..." data-i18n-placeholder-id="Jelaskan perkiraan ukuran lahan/kolam, kendala kebocoran, atau tipe mesin & suku cadang yang dicari..." data-i18n-placeholder-en="Describe approximate pool size, leakage issues, or specific equipment & spare parts needed..." required rows="4"></textarea>
                        <p class="text-[#B42318] text-xs mt-1 hidden" id="errMsg" data-i18n-en="Please describe your requirements (minimum 10 characters)." data-i18n-id="Tuliskan uraian kebutuhan minimal 10 karakter.">Tuliskan uraian kebutuhan minimal 10 karakter.</p>
                    </div>

                    <div class="pt-2 flex flex-col sm:flex-row gap-3">
                        <button class="flex-1 inline-flex items-center justify-center gap-2.5 bg-gold-400 hover:bg-gold-300 text-navy-950 font-semibold text-xs sm:text-sm px-7 h-11 rounded-md shadow-sm transition-colors" type="submit">
                            <span data-i18n-en="Continue to Official WhatsApp" data-i18n-id="Lanjutkan ke WhatsApp Resmi">Lanjutkan ke WhatsApp Resmi</span>
                            <?= render_icon('whatsapp-chat', 'w-4 h-4') ?>
                        </button>
                        <button class="inline-flex items-center justify-center gap-2 bg-cream-50 hover:bg-cream-100 text-navy-900 border border-[#E6DFD1] font-semibold text-xs sm:text-sm px-5 h-11 rounded-md transition-colors" id="copyMsgBtn" type="button">
                            <span data-i18n-en="Copy Message Format" data-i18n-id="Salin Format Pesan">Salin Format Pesan</span>
                        </button>
                    </div>

                    <p class="text-xs text-[#7A8596] pt-1" data-i18n-en="Communications are handled directly via official WhatsApp 0821-1807-5560 without third-party middlemen." data-i18n-id="Komunikasi ditangani langsung melalui sambungan resmi WhatsApp 0821-1807-5560 tanpa perantara.">
                        Komunikasi ditangani langsung melalui sambungan resmi WhatsApp <strong class="text-navy-900">0821-1807-5560</strong> tanpa perantara.
                    </p>
                    <p class="text-xs text-[#067647] font-semibold hidden" id="copyAlert" data-i18n-en="✓ Consultation message copied to clipboard." data-i18n-id="✓ Teks pesan konsultasi berhasil disalin ke papan klip.">
                        ✓ Teks pesan konsultasi berhasil disalin ke papan klip.
                    </p>
                </form>
            </div>
        </div>
    </section>
</main>

<?php
$pageScripts = <<<'HTML'
<script>
    (function () {
        const form = document.getElementById('dppWaForm');
        const copyBtn = document.getElementById('copyMsgBtn');

        function isEn() {
            return document.documentElement.lang === 'en';
        }

        function buildMessage() {
            const name = document.getElementById('fullName').value.trim();
            const need = document.getElementById('needType').value;
            const related = document.getElementById('relatedService').value.trim();
            const location = document.getElementById('location').value.trim();
            const message = document.getElementById('userMessage').value.trim();

            if (isEn()) {
                let text = "Hello Dunia Pool & Pond,\n\n";
                text += `Name: ${name}\n`;
                text += `Requirement: ${need}\n`;
                if (related) text += `Related System/Product: ${related}\n`;
                if (location) text += `Project Location: ${location}\n`;
                text += `\nMessage:\n${message}\n\n`;
                text += "Reference: Official Website Dunia Pool & Pond";
                return text;
            }

            let text = "Halo Dunia Pool & Pond,\n\n";
            text += `Nama: ${name}\n`;
            text += `Kebutuhan: ${need}\n`;
            if (related) text += `Tipe/Produk Terkait: ${related}\n`;
            if (location) text += `Lokasi Proyek: ${location}\n`;
            text += `\nPesan:\n${message}\n\n`;
            text += "Referensi: Website Resmi Dunia Pool & Pond";
            return text;
        }

        function validate() {
            const name = document.getElementById('fullName').value.trim();
            const message = document.getElementById('userMessage').value.trim();
            const errName = document.getElementById('errName');
            const errMsg = document.getElementById('errMsg');
            let ok = true;

            if (name.length < 2) {
                errName.classList.remove('hidden');
                ok = false;
            } else {
                errName.classList.add('hidden');
            }

            if (message.length < 10) {
                errMsg.classList.remove('hidden');
                ok = false;
            } else {
                errMsg.classList.add('hidden');
            }

            return ok;
        }

        form?.addEventListener('submit', function (e) {
            e.preventDefault();
            if (!validate()) return;
            const encoded = encodeURIComponent(buildMessage());
            document.getElementById('contactSuccessAlert')?.classList.remove('hidden');
            window.open(`https://wa.me/6282118075560?text=${encoded}`, '_blank', 'noopener,noreferrer');
        });

        copyBtn?.addEventListener('click', function () {
            if (!validate()) return;
            const text = buildMessage();
            const alertEl = document.getElementById('copyAlert');
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(text).then(() => {
                    alertEl.classList.remove('hidden');
                    setTimeout(() => alertEl.classList.add('hidden'), 4000);
                });
            }
        });
    })();
</script>
HTML;

require __DIR__ . '/../includes/footer.php';
