<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LOKET ANTRIAN FARMASI</title>

        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

        <style>
            * {
                box-sizing: border-box;
            }

            html,
            body {
                width: 100%;
                height: 100%;
                margin: 0;
                overflow: hidden;
                font-family: Arial, Helvetica, sans-serif;
            }

            body {
                background: #eef2f7;
            }

            .no-scrollbar::-webkit-scrollbar {
                display: none;
            }

            .no-scrollbar {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }

            .queue-scroll {
                min-height: 0;
                overflow-y: auto;
                overscroll-behavior: contain;
            }

            .queue-row {
                transition: background-color .2s ease;
            }

            .queue-row.is-called {
                background: #fef08a !important;
            }

            .queue-row.is-called td:first-child {
                box-shadow: inset 6px 0 0 #eab308;
            }

            .ticker-track {
                display: inline-block;
                white-space: nowrap;
                padding-left: 100%;
                animation: ticker 32s linear infinite;
            }

            @keyframes ticker {
                from {
                    transform: translateX(0);
                }

                to {
                    transform: translateX(-100%);
                }
            }

            @media (max-height: 820px) {
                .video-frame {
                    max-height: 220px;
                }

                .serving-card {
                    min-height: 112px !important;
                }

                .clock-card {
                    padding-top: .55rem !important;
                    padding-bottom: .55rem !important;
                }

                .queue-table th {
                    padding-top: .65rem !important;
                    padding-bottom: .65rem !important;
                }

                .queue-table td {
                    padding-top: .55rem !important;
                    padding-bottom: .55rem !important;
                }
            }

            @media (max-width: 1100px) {

                html,
                body {
                    overflow: auto;
                }

                #app {
                    min-height: 100vh;
                    height: auto;
                }

                .main-layout {
                    grid-template-columns: 1fr !important;
                }

                .queue-card {
                    min-height: 520px;
                }
            }
        </style>
    </head>

    <body>
        <!-- Aktivasi audio: diperlukan oleh browser sebelum suara dapat diputar otomatis -->
        <div id="start-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/80 p-5">
            <div class="w-full max-w-md rounded-3xl bg-white p-8 text-center shadow-2xl">
                <div class="mx-auto mb-5 flex h-20 w-20 items-center justify-center rounded-2xl bg-blue-100 text-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10v4h4l5 4V6l-5 4H3Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 9a5 5 0 0 1 0 6m2-9a9 9 0 0 1 0 12" />
                    </svg>
                </div>
                <p class="text-2xl font-extrabold text-slate-800">Loket Antrian Farmasi</p>
                <p class="mt-3 text-base leading-relaxed text-slate-500">Tekan tombol mulai untuk mengaktifkan suara panggilan antrean.</p>
                <button id="start-button" type="button" class="mt-7 w-full rounded-xl bg-blue-600 px-6 py-4 text-lg font-bold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-700">
                    Mulai Tampilan
                </button>
            </div>
        </div>

        <div id="app" class="h-screen w-screen overflow-hidden">
            <div class="mx-auto flex h-full w-full max-w-[2560px] flex-col gap-3 p-4 xl:gap-4 xl:p-5 2xl:p-6">

                <!-- Header -->
                <header class="flex shrink-0 items-center justify-between rounded-2xl bg-slate-900 px-6 py-4 text-white shadow-lg">
                    <div class="flex items-center gap-4">
                        <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-blue-500/20 text-blue-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 5.5A2.5 2.5 0 0 1 6.5 3h11A2.5 2.5 0 0 1 20 5.5v13a2.5 2.5 0 0 1-2.5 2.5h-11A2.5 2.5 0 0 1 4 18.5v-13Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 8h8M8 12h8M8 16h5" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-extrabold tracking-wide xl:text-3xl 2xl:text-4xl">LOKET ANTRIAN FARMASI</p>
                            <p class="mt-1 text-sm font-medium tracking-widest text-slate-300 xl:text-base">INFORMASI ANTRIAN DAN PENYERAHAN OBAT</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 rounded-full border border-emerald-400/30 bg-emerald-400/10 px-4 py-2">
                        <span class="h-3 w-3 animate-pulse rounded-full bg-emerald-400"></span>
                        <span class="text-sm font-bold tracking-wider text-emerald-300 xl:text-base">INFORMASI REAL-TIME</span>
                    </div>
                </header>

                <!-- Konten utama -->
                <main class="main-layout grid min-h-0 flex-1 grid-cols-[minmax(340px,0.82fr)_minmax(0,2.18fr)] gap-3 xl:gap-4">

                    <!-- Panel kiri: video, panggilan aktif, ringkasan, jam -->
                    <aside class="flex min-h-0 flex-col gap-3 xl:gap-4">
                        <div class="video-frame w-full shrink-0 overflow-hidden rounded-2xl bg-slate-900 shadow-md">
                            <iframe
                                src="https://www.youtube-nocookie.com/embed/b1LeOAgtan0?si=TjwMPD6JYDpDQ4GQ&controls=0&autoplay=1&mute=1&rel=0"
                                class="aspect-video w-full"
                                title="Daftar Periksa Hanya dengan E-KTP/NIK"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin"
                                allowfullscreen>
                            </iframe>
                        </div>

                        <section class="serving-card flex min-h-[142px] shrink-0 flex-col justify-center rounded-2xl border-2 border-blue-200 bg-white p-4 shadow-md xl:p-5">
                            <div class="mb-2 flex items-center justify-between gap-2">
                                <p class="text-sm font-extrabold tracking-widest text-blue-700 xl:text-base">PANGGILAN SEKARANG</p>
                                <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-bold text-blue-700 xl:text-sm">LOKET FARMASI</span>
                            </div>
                            <p id="nm_pasien" class="truncate text-2xl font-extrabold leading-tight text-slate-900 xl:text-3xl 2xl:text-4xl">Belum ada panggilan</p>
                            <p class="mt-2 text-base font-semibold text-slate-500 xl:text-lg">No. Resep: <span id="no_resep" class="font-mono font-extrabold text-slate-800">-</span></p>
                        </section>

                        <section class="grid shrink-0 grid-cols-2 gap-3">
                            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-3 shadow-sm xl:p-4">
                                <div class="flex items-center gap-2">
                                    <span class="h-3 w-3 rounded-full bg-emerald-500"></span>
                                    <p class="text-sm font-extrabold text-emerald-800 xl:text-base">NON-RACIKAN</p>
                                </div>
                                <p id="cnon_racik" class="mt-1 text-4xl font-extrabold leading-none text-emerald-700 xl:text-5xl">0</p>
                                <p class="mt-2 text-xs font-semibold text-emerald-800 xl:text-sm">Selesai: <span id="nrselesai">0</span></p>
                            </div>
                            <div class="rounded-2xl border border-amber-200 bg-amber-50 p-3 shadow-sm xl:p-4">
                                <div class="flex items-center gap-2">
                                    <span class="h-3 w-3 rounded-full bg-amber-500"></span>
                                    <p class="text-sm font-extrabold text-amber-800 xl:text-base">RACIKAN</p>
                                </div>
                                <p id="cracik" class="mt-1 text-4xl font-extrabold leading-none text-amber-700 xl:text-5xl">0</p>
                                <p class="mt-2 text-xs font-semibold text-amber-800 xl:text-sm">Selesai: <span id="rselesai">0</span></p>
                            </div>
                        </section>

                        <section class="clock-card mt-auto shrink-0 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-center shadow-md xl:px-5 xl:py-4">
                            <p id="tglnow" class="text-base font-bold capitalize text-slate-500 xl:text-lg"></p>
                            <p id="jamnow" class="mt-1 font-mono text-4xl font-extrabold tracking-wider text-slate-900 xl:text-5xl 2xl:text-6xl"></p>
                        </section>
                    </aside>

                    <!-- Panel kanan: satu tabel antrean dengan label kategori berwarna -->
                    <section class="queue-card flex min-h-0 flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-md">
                        <div class="flex shrink-0 flex-wrap items-center justify-between gap-3 border-b border-slate-200 bg-slate-100 px-4 py-3 xl:px-5">
                            <div>
                                <p class="text-xl font-extrabold tracking-wide text-slate-800 xl:text-2xl 2xl:text-3xl">DAFTAR ANTREAN RESEP</p>
                                <p class="mt-1 text-xs font-medium text-slate-500 xl:text-sm">Antrean Non-Racikan dan Racikan dalam satu daftar</p>
                            </div>
                            <div class="flex flex-wrap items-center gap-2 xl:gap-3">
                                <span class="rounded-full bg-emerald-100 px-3 py-2 text-xs font-extrabold text-emerald-800 xl:text-sm">● NON-RACIKAN</span>
                                <span class="rounded-full bg-amber-100 px-3 py-2 text-xs font-extrabold text-amber-800 xl:text-sm">● RACIKAN</span>
                                <span class="rounded-xl bg-slate-800 px-3 py-2 text-right text-white">
                                    <span class="block text-[10px] font-semibold text-slate-300 xl:text-xs">TOTAL ANTREAN</span>
                                    <span id="total_antrean" class="block text-xl font-extrabold leading-tight xl:text-2xl">0</span>
                                </span>
                            </div>
                        </div>

                        <div class="queue-scroll no-scrollbar min-h-0 flex-1">
                            <table class="queue-table w-full table-fixed border-collapse">
                                <thead class="sticky top-0 z-10 bg-slate-200 text-slate-800 shadow-sm">
                                    <tr>
                                        <th class="w-[13%] border-b border-slate-300 px-2 py-3 text-center text-xs font-extrabold xl:text-sm 2xl:text-base">NO. RESEP</th>
                                        <th class="w-[22%] border-b border-slate-300 px-2 py-3 text-left text-xs font-extrabold xl:text-sm 2xl:text-base">NAMA PASIEN</th>
                                        <th class="w-[19%] border-b border-slate-300 px-2 py-3 text-left text-xs font-extrabold xl:text-sm 2xl:text-base">POLIKLINIK ASAL</th>
                                        <th class="w-[12%] border-b border-slate-300 px-1 py-3 text-center text-xs font-extrabold xl:text-sm 2xl:text-base">JAM RESEP</th>
                                        <th class="w-[13%] border-b border-slate-300 px-1 py-3 text-center text-xs font-extrabold xl:text-sm 2xl:text-base">KATEGORI</th>
                                        <th class="w-[11%] border-b border-slate-300 px-1 py-3 text-center text-xs font-extrabold xl:text-sm 2xl:text-base">STATUS</th>
                                        <th class="w-[10%] border-b border-slate-300 px-1 py-3 text-center text-xs font-extrabold xl:text-sm 2xl:text-base">JAM SELESAI</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_antrian">
                                    <tr>
                                        <td colspan="7" class="px-3 py-8 text-center text-sm text-slate-400">Memuat data antrean...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="flex shrink-0 items-center justify-between border-t border-slate-200 bg-slate-50 px-4 py-2 text-xs font-semibold text-slate-600 xl:text-sm">
                            <span>Jumlah resep yang sedang menunggu</span>
                            <span id="total_menunggu" class="font-extrabold text-slate-800">0 resep</span>
                        </div>
                    </section>
                </main>

                <!-- Informasi waktu tunggu -->
                <footer class="flex h-12 shrink-0 items-center overflow-hidden rounded-xl border border-blue-200 bg-blue-50 shadow-sm xl:h-14">
                    <div class="flex h-full shrink-0 items-center bg-blue-700 px-4 text-sm font-extrabold tracking-wider text-white xl:px-6 xl:text-base">INFORMASI</div>
                    <div class="min-w-0 flex-1 overflow-hidden text-lg font-extrabold xl:text-xl 2xl:text-2xl">
                        <div class="ticker-track text-slate-800">
                            WAKTU TUNGGU RESEP <span class="text-amber-600">RACIKAN MAKSIMAL 1 JAM</span>
                            <span class="mx-8 text-slate-400">•</span>
                            WAKTU TUNGGU RESEP <span class="text-emerald-700">NON-RACIKAN MAKSIMAL 30 MENIT</span>
                            <span class="mx-8 text-slate-400">•</span>
                            TERIMA KASIH ATAS KESABARAN ANDA
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <script>
            let activeAudio = null;
            let lastProcessedTrigger = '';
            let isLoadingAntrian = false;

            const audioBaseUrl = "{{ url('/antrian/suara') }}";

            function putarSpeechSynthesis(text) {
                try {
                    window.speechSynthesis.cancel();
                    window.speechSynthesis.resume();
                    const utter = new SpeechSynthesisUtterance(text);
                    utter.lang = 'id-ID';
                    window.speechSynthesis.speak(utter);
                } catch (e) {
                    console.error('[TTS] SpeechSynthesis tidak tersedia:', e);
                }
            }

            function ngomong(text) {
                if (!text || !text.trim()) return;

                try {
                    if (activeAudio) {
                        activeAudio.pause();
                        activeAudio = null;
                    }

                    activeAudio = new Audio(audioBaseUrl + '?text=' + encodeURIComponent(text));
                    activeAudio.onended = function() {
                        activeAudio = null;
                    };
                    activeAudio.onerror = function(err) {
                        console.error('[TTS] Audio MP3 gagal, menggunakan SpeechSynthesis:', err);
                        activeAudio = null;
                        putarSpeechSynthesis(text);
                    };

                    const playPromise = activeAudio.play();
                    if (playPromise !== undefined) {
                        playPromise.catch(function(err) {
                            console.warn('[TTS] Audio perlu aktivasi browser:', err);
                            $('#start-modal').removeClass('hidden').show();
                        });
                    }
                } catch (err) {
                    console.error('[TTS] Gagal memutar audio:', err);
                    putarSpeechSynthesis(text);
                }
            }

            function highlightResep(no_resep) {
                if (!no_resep || no_resep === '-') return;

                $('.queue-row').removeClass('is-called');
                const $row = $('.queue-row').filter(function() {
                    return String($(this).attr('data-no-resep')) === String(no_resep);
                }).addClass('is-called');

                if ($row.length) {
                    $row[0].scrollIntoView({
                        behavior: 'smooth',
                        block: 'center',
                        inline: 'nearest'
                    });
                }
            }

            function prosesPanggilanSekarang() {
                const currentTrigger = localStorage.getItem('panggil_trigger') || '';
                const no_resep = localStorage.getItem('no_panggil') || '-';
                const raw_nm_pasien = localStorage.getItem('nm_pasien') || '';

                if (currentTrigger && currentTrigger === lastProcessedTrigger) return;
                if (currentTrigger) lastProcessedTrigger = currentTrigger;

                $('#no_resep').text(no_resep);
                $('#nm_pasien').text(raw_nm_pasien ? sensorNamaPasien(raw_nm_pasien) : 'Belum ada panggilan');
                highlightResep(no_resep);

                if (raw_nm_pasien.trim() !== '') {
                    const namaPanggil = raw_nm_pasien.toLowerCase().split(',')[0].trim();
                    ngomong(namaPanggil + '. Silahkan menuju loket penyerahan obat.');
                }
            }

            window.addEventListener('storage', function(e) {
                if (e.key === 'panggil_trigger' || e.key === 'panggil' || e.key === 'no_panggil') {
                    prosesPanggilanSekarang();
                } else if (e.key === 'resep_selesai_trigger') {
                    getData();
                }
            });

            // Samarkan nama untuk tampilan publik di layar TV.
            // Dua kata pertama menampilkan maksimal 3 huruf; kata berikutnya disamarkan seluruhnya.
            // Panjang hasil dibatasi maksimal 20 karakter, termasuk elipsis.
            function sensorNamaPasien(nama, maxKarakter = 20) {
                const value = String(nama ?? '').trim();
                if (!value || value === '-') return value || '-';

                const hasil = value.split(/\s+/).map(function(word, index) {
                    const huruf = Array.from(word);

                    if (index >= 3) {
                        return '*'.repeat(huruf.length);
                    }

                    return huruf.slice(0, 3).join('') +
                        '*'.repeat(Math.max(0, huruf.length - 3));
                }).join(' ');

                const karakter = Array.from(hasil);
                if (karakter.length > maxKarakter) {
                    return karakter.slice(0, maxKarakter - 1).join('').trimEnd() + '';
                }

                return hasil;
            }

            function kategoriRacikan(value) {
                const kategori = String(value || '').trim().toUpperCase().replace(/[-_]/g, ' ').replace(/\s+/g, ' ');
                return kategori === 'RACIKAN';
            }

            function ambilNamaPoliklinik(item) {
                // nm_poli adalah nama field utama yang diharapkan dari endpoint.
                // Alias disediakan agar tetap kompatibel jika penamaan field API berbeda.
                return item.nm_poli ??
                    item.nm_poliklinik ??
                    item.nama_poli ??
                    item.poliklinik ??
                    item.poli_asal ??
                    item.nm_poli_asal ??
                    '-';
            }

            function buatBaris(item, noPanggil) {
                const noResep = String(item.no_resep ?? '-');
                const status = String(item.status_obat ?? 'MENUNGGU').trim();
                const selesai = status.toUpperCase() === 'SELESAI';
                const racikan = kategoriRacikan(item.category_obat);
                const kategoriLabel = racikan ? 'RACIKAN' : 'NON-RACIKAN';
                const sedangDipanggil = noResep === String(noPanggil || '');

                const $row = $('<tr>', {
                    class: 'queue-row border-b border-slate-100 text-slate-700' + (sedangDipanggil ? ' is-called' : '')
                }).attr('data-no-resep', noResep);

                $('<td>', {
                        class: 'break-words px-2 py-4 text-center font-mono text-sm font-extrabold xl:text-base 2xl:text-lg'
                    })
                    .text(noResep).appendTo($row);

                $('<td>', {
                        class: 'break-words px-2 py-4 text-left text-sm font-semibold leading-snug xl:text-base 2xl:text-lg'
                    })
                    .text(sensorNamaPasien(item.nm_pasien ?? '-')).appendTo($row);

                const $td = $('<td>', {
                    class: 'break-words px-2 py-3 text-left text-xs font-semibold leading-snug text-slate-600 xl:text-sm 2xl:text-base'
                });

                $('<div>', {
                        class: 'font-bold text-slate-700'
                    })
                    .text(ambilNamaPoliklinik(item))
                    .appendTo($td);

                $('<div>', {
                        class: 'mt-1 text-[11px] font-normal text-slate-500 xl:text-xs'
                    })
                    .text(item.dokter || '-')
                    .appendTo($td);

                $td.appendTo($row);

                $('<td>', {
                        class: 'px-1 py-4 text-center font-mono text-xs xl:text-sm 2xl:text-base'
                    })
                    .text(item.jam_peresepan ?? '-').appendTo($row);

                const $kategoriCell = $('<td>', {
                    class: 'px-1 py-4 text-center'
                });
                $('<span>', {
                    class: racikan ?
                        'inline-block rounded-full bg-amber-100 px-2 py-1 text-[10px] font-extrabold text-amber-800 ring-1 ring-inset ring-amber-300 xl:text-xs 2xl:text-sm' : 'inline-block rounded-full bg-emerald-100 px-2 py-1 text-[10px] font-extrabold text-emerald-800 ring-1 ring-inset ring-emerald-300 xl:text-xs 2xl:text-sm'
                }).text(kategoriLabel).appendTo($kategoriCell);
                $row.append($kategoriCell);

                const $statusCell = $('<td>', {
                    class: 'px-1 py-4 text-center'
                });
                $('<span>', {
                    class: selesai ?
                        'inline-block rounded-full bg-emerald-100 px-2 py-1 text-[10px] font-extrabold text-emerald-700 xl:text-xs 2xl:text-sm' : 'inline-block rounded-full bg-orange-100 px-2 py-1 text-[10px] font-extrabold text-orange-700 xl:text-xs 2xl:text-sm'
                }).text(status || 'MENUNGGU').appendTo($statusCell);
                $row.append($statusCell);

                $('<td>', {
                        class: 'px-1 py-4 text-center font-mono text-xs text-slate-600 xl:text-sm 2xl:text-base'
                    })
                    .text(item.jam_penyerahan || '-').appendTo($row);

                return $row;
            }

            function renderTabel(items, noPanggil) {
                const $tbody = $('#tbody_antrian').empty();
                if (!items.length) {
                    $('<tr>').append(
                        $('<td>', {
                            colspan: 7,
                            class: 'px-3 py-10 text-center text-sm font-medium text-slate-400 xl:text-base'
                        })
                        .text('Belum ada antrean resep')
                    ).appendTo($tbody);
                    return;
                }

                items.forEach(function(item) {
                    $tbody.append(buatBaris(item, noPanggil));
                });
            }

            function getData() {
                if (isLoadingAntrian) return;
                isLoadingAntrian = true;

                $.ajax({
                    url: '/erm/get/antrian',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        const daftar = Array.isArray(data) ? data : [];
                        const noPanggil = localStorage.getItem('no_panggil') || '';
                        const racikan = daftar.filter(item => kategoriRacikan(item.category_obat));
                        const nonRacikan = daftar.filter(item => !kategoriRacikan(item.category_obat));

                        // Semua kategori ditampilkan dalam satu tabel; warna label membedakan jenis resep.
                        renderTabel(daftar, noPanggil);

                        const nonRacikSelesai = nonRacikan.filter(item => String(item.status_obat || '').trim().toUpperCase() === 'SELESAI').length;
                        const racikSelesai = racikan.filter(item => String(item.status_obat || '').trim().toUpperCase() === 'SELESAI').length;
                        const nonRacikMenunggu = nonRacikan.length - nonRacikSelesai;
                        const racikMenunggu = racikan.length - racikSelesai;
                        const totalMenunggu = nonRacikMenunggu + racikMenunggu;

                        $('#cnon_racik').text(nonRacikan.length);
                        $('#nrselesai').text(nonRacikSelesai);
                        $('#cracik').text(racikan.length);
                        $('#rselesai').text(racikSelesai);
                        $('#total_antrean').text(daftar.length);
                        $('#total_menunggu').text(totalMenunggu + ' resep');

                        if (noPanggil) highlightResep(noPanggil);
                    },
                    error: function(xhr, status, error) {
                        console.error('[ANTRIAN] Gagal mengambil data:', status, error);
                    },
                    complete: function() {
                        isLoadingAntrian = false;
                    }
                });
            }

            function appendTglWaktu() {
                const now = new Date();
                $('#tglnow').text(new Intl.DateTimeFormat('id-ID', {
                    weekday: 'long',
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric',
                    timeZone: 'Asia/Jakarta'
                }).format(now));
                $('#jamnow').text(new Intl.DateTimeFormat('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: false,
                    timeZone: 'Asia/Jakarta'
                }).format(now));
            }

            $(document).ready(function() {
                if (window.speechSynthesis && window.speechSynthesis.onvoiceschanged !== undefined) {
                    window.speechSynthesis.onvoiceschanged = function() {
                        window.speechSynthesis.getVoices();
                    };
                }

                if (!navigator.userActivation || !navigator.userActivation.hasBeenActive) {
                    $('#start-modal').show();
                } else {
                    $('#start-modal').hide();
                }

                $('#start-button').on('click', function() {
                    sessionStorage.setItem('app_started', 'true');
                    $('#start-modal').hide();
                    try {
                        window.speechSynthesis.resume();
                    } catch (e) {}
                    ngomong('Selamat datang di loket antrian farmasi. Silahkan tunggu panggilan nomor resep anda.');
                });

                $(document).on('click', function() {
                    try {
                        if (window.speechSynthesis && window.speechSynthesis.paused) {
                            window.speechSynthesis.resume();
                        }
                    } catch (e) {}
                });

                $('#no_resep').text(localStorage.getItem('no_panggil') || '-');
                const namaAktif = localStorage.getItem('nm_pasien') || '';
                $('#nm_pasien').text(namaAktif ? sensorNamaPasien(namaAktif) : 'Belum ada panggilan');

                getData();
                setInterval(getData, 4000);

                appendTglWaktu();
                setInterval(appendTglWaktu, 1000);

                // Fallback untuk perubahan localStorage ketika event storage tidak diterima.
                setInterval(function() {
                    const trigger = localStorage.getItem('panggil_trigger') || '';
                    const panggilStatus = localStorage.getItem('panggil');
                    if (panggilStatus === 'yes' && trigger && trigger !== lastProcessedTrigger) {
                        prosesPanggilanSekarang();
                    }
                }, 1000);
            });
        </script>
    </body>

</html>
