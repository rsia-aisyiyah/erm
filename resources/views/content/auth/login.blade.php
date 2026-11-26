<!doctype html>
<html lang="id" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistem Informasi Elektronik Rekam Medis (ERM) - RSIA Aisyiyah Pekajangan">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk | ERM RSIA Aisyiyah Pekajangan</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/rsiap.ico') }}">

    <!-- Google Fonts: Plus Jakarta Sans (Modern Shadcn Typography) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', '-apple-system', 'sans-serif'],
                    },
                    colors: {
                        border: 'hsl(214.3 31.8% 91.4%)',
                        input: 'hsl(214.3 31.8% 91.4%)',
                        ring: 'hsl(160 84% 39%)',
                        background: 'hsl(0 0% 100%)',
                        foreground: 'hsl(222.2 84% 4.9%)',
                        primary: {
                            DEFAULT: '#059669', // emerald-600
                            foreground: '#ffffff',
                            hover: '#047857',
                        },
                        muted: {
                            DEFAULT: 'hsl(210 40% 96.1%)',
                            foreground: 'hsl(215.4 16.3% 46.9%)',
                        },
                        card: {
                            DEFAULT: '#ffffff',
                            foreground: 'hsl(222.2 84% 4.9%)',
                        },
                    },
                }
            }
        }
    </script>

    <style>
        * {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        /* Subtle modern dot-grid background for auth container */
        .bg-grid-pattern {
            background-image: radial-gradient(rgba(148, 163, 184, 0.25) 1px, transparent 1px);
            background-size: 24px 24px;
        }

        /* Smooth focus ring like Shadcn UI */
        .shadcn-input:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(5, 150, 105, 0.2);
            border-color: #059669;
        }

        /* Animation for error alerts */
        @keyframes fadeInSlide {
            from {
                opacity: 0;
                transform: translateY(-6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeInSlide 0.25s ease-out forwards;
        }
    </style>
</head>

<body class="h-full bg-zinc-50 text-zinc-900 antialiased selection:bg-emerald-500 selection:text-white">

    <div class="min-h-screen w-full flex flex-col lg:grid lg:grid-cols-12">

        <!-- ========================================================================
             LEFT HERO PANEL (Desktop & Tablet Large)
             Displays Bright Hospital Facade, Live Clock, and System Highlights
             ======================================================================== -->
        <div
            class="relative hidden lg:flex lg:col-span-6 xl:col-span-7 flex-col justify-between p-10 xl:p-14 overflow-hidden bg-slate-900 text-white select-none">
            <!-- Background Image: Brightened Hospital Facade -->
            <div class="absolute inset-0 bg-cover bg-center filter brightness-105 contrast-[1.02] saturate-[1.05] scale-100 transition-transform duration-1000"
                style="background-image: url('{{ asset('img/fasad-depan.jpeg') }}');">
            </div>

            <!-- Soft Lighter Gradient Overlay (Photo remains bright and clearly visible) -->
            <div
                class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-slate-900/40 to-slate-900/20 backdrop-blur-[0.5px]">
            </div>

            <!-- Soft Ambient Light Glow -->
            <div
                class="absolute -top-24 -left-24 w-96 h-96 bg-emerald-500/25 rounded-full blur-3xl pointer-events-none">
            </div>
            <div class="absolute bottom-10 right-10 w-80 h-80 bg-teal-500/15 rounded-full blur-3xl pointer-events-none">
            </div>

            <!-- Top Header: Hospital Brand, Live Clock, & System Status -->
            <div class="relative z-10 flex items-center justify-between gap-4">
                <div class="flex items-center gap-3.5">
                    <div class="p-2 bg-white/95 rounded-xl shadow-md backdrop-blur-md flex items-center justify-center">
                        <img src="{{ asset('img/LOGO RSIA AISYIAH.png') }}" alt="Logo RSIA" class="h-8 w-auto">
                    </div>
                    <div>
                        <h2 class="text-sm font-semibold tracking-wide text-white leading-tight drop-shadow-sm">RSIA
                            Aisyiyah Pekajangan</h2>
                        <p class="text-xs text-emerald-300 font-medium drop-shadow-sm">Kabupaten Pekalongan</p>
                    </div>
                </div>

                <!-- Live Clock & Date Badge (Desktop) -->
                <div class="flex items-center gap-3">
                    <div
                        class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-medium bg-slate-950/70 text-slate-200 border border-white/20 backdrop-blur-md shadow-sm">
                        <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span id="liveDateDesktop" class="text-slate-200">Memuat tanggal...</span>
                        <span class="w-1 h-1 rounded-full bg-emerald-400"></span>
                        <span id="liveTimeDesktop" class="font-mono font-semibold text-emerald-300">--:--:-- WIB</span>
                    </div>

                    <div
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium bg-emerald-500/25 text-emerald-200 border border-emerald-400/30 backdrop-blur-md">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>Aktif</span>
                    </div>
                </div>
            </div>

            <!-- Center Showcase: Glass Container for optimal readability over bright photo -->
            <div class="relative z-10 my-auto py-8 max-w-xl">
                <div class="p-6 sm:p-8 rounded-2xl bg-slate-950/50 backdrop-blur-md border border-white/15 shadow-2xl">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-medium bg-emerald-500/20 text-emerald-300 border border-emerald-400/30 backdrop-blur-md mb-4">
                        <svg class="w-3.5 h-3.5 text-emerald-400" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <span>Elektronik Rekam Medis (ERM)</span>
                    </div>

                    <h1 class="text-2xl xl:text-3xl font-extrabold tracking-tight text-white leading-snug">
                        Pelayanan Medis yang Cepat, Akurat, & Terintegrasi.
                    </h1>

                    <p class="mt-3 text-sm text-slate-200 leading-relaxed font-normal">
                        Platform rekam medis terpadu untuk efisiensi dokumentasi klinis, riwayat CPPT, asuhan
                        keperawatan, serta integrasi langsung ke ekosistem SatuSehat Kemenkes dan BPJS Kesehatan.
                    </p>

                    <!-- Feature Badges (Shadcn style micro-cards) -->
                    <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div class="p-3 rounded-xl bg-white/10 border border-white/15 backdrop-blur-md">
                            <div class="text-emerald-400 mb-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <h4 class="text-xs font-semibold text-white">Ranap & Rajal</h4>
                            <p class="text-[11px] text-slate-300 mt-0.5">CPPT, SOAP, Resume</p>
                        </div>

                        <div class="p-3 rounded-xl bg-white/10 border border-white/15 backdrop-blur-md">
                            <div class="text-emerald-400 mb-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                </svg>
                            </div>
                            <h4 class="text-xs font-semibold text-white">SatuSehat & BPJS</h4>
                            <p class="text-[11px] text-slate-300 mt-0.5">VClaim & Bridging</p>
                        </div>

                        <div class="p-3 rounded-xl bg-white/10 border border-white/15 backdrop-blur-md">
                            <div class="text-emerald-400 mb-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <h4 class="text-xs font-semibold text-white">Audit & Keamanan</h4>
                            <p class="text-[11px] text-slate-300 mt-0.5">Enkripsi & Privasi Data</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Footer: Hospital Motto & Copyright (Tanpa Unsur Akreditasi) -->
            <div class="relative z-10 flex items-center justify-between pt-5 border-t border-white/15">
                <div class="flex items-center gap-3">
                    <div
                        class="w-8 h-8 rounded-lg bg-emerald-500/25 border border-emerald-400/30 flex items-center justify-center text-emerald-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-100">Pelayanan Kesehatan Terpadu</p>
                        <p class="text-[11px] text-slate-300">Ramah, Cepat, Amanah, dan Profesional</p>
                    </div>
                </div>

                <p class="text-xs text-slate-300 font-medium">&copy; {{ date('Y') }} RSIA Aisyiyah Pekajangan</p>
            </div>
        </div>


        <!-- ========================================================================
             RIGHT AUTH PANEL (Shadcn UI Card & Login Form)
             ======================================================================== -->
        <div
            class="w-full lg:col-span-6 xl:col-span-5 flex flex-col justify-center items-center p-6 sm:p-10 lg:p-12 min-h-screen bg-zinc-50/70 bg-grid-pattern relative">

            <!-- Mobile Top Header (Visible only on mobile/tablet) -->
            <div class="lg:hidden w-full max-w-md mb-5 flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="p-1.5 bg-white rounded-lg shadow-sm border border-zinc-200">
                        <img src="{{ asset('img/LOGO RSIA AISYIAH.png') }}" alt="Logo" class="h-6 w-auto">
                    </div>
                    <div>
                        <span class="text-xs font-bold text-zinc-900 tracking-tight block">RSIA Aisyiyah
                            Pekajangan</span>
                        <span class="text-[10px] text-emerald-600 font-semibold block">Sistem Rekam Medis (ERM)</span>
                    </div>
                </div>
                <span
                    class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Online
                </span>
            </div>

            <!-- Shadcn Card Container -->
            <div
                class="w-full max-w-md bg-white border border-zinc-200/90 rounded-2xl shadow-xl shadow-zinc-950/5 p-7 sm:p-9 relative">

                <!-- Card Header -->
                <div class="flex flex-col space-y-2 mb-5">
                    <!-- Brand Mark / Logo -->
                    <div class="flex items-center justify-center mb-1">
                        <img src="{{ asset('img/LOGO RSIA AISYIAH.png') }}" alt="RSIA Aisyiyah Pekajangan"
                            class="h-14 sm:h-16 w-auto object-contain">
                    </div>

                    <div class="text-center pt-1">
                        <h2 class="text-2xl font-bold tracking-tight text-zinc-900">
                            Masuk ke Akun ERM
                        </h2>
                        <p class="text-sm text-zinc-500 mt-1">
                            Silakan masukkan Nomor Induk Karyawan & kata sandi Anda.
                        </p>
                    </div>
                </div>

                <!-- Error Alert (Shadcn Alert Destructive) -->
                @if (session()->has('error'))
                    <div class="mb-5 flex items-start gap-3 p-3.5 text-sm text-red-700 bg-red-50/90 border border-red-200/80 rounded-xl animate-fade-in"
                        role="alert">
                        <svg class="w-5 h-5 flex-shrink-0 text-red-500 mt-0.5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <div class="flex-1">
                            <h5 class="text-xs font-semibold uppercase tracking-wider text-red-800">Autentikasi Gagal
                            </h5>
                            <p class="text-xs text-red-600 mt-0.5 leading-relaxed">{{ session()->get('error') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Login Form -->
                <form action="{{ url('/login') }}" method="POST" id="loginForm" class="space-y-4">
                    @csrf

                    <!-- Field: Nomor Induk Karyawan (Username) -->
                    <div class="space-y-1.5">
                        <label for="username"
                            class="block text-xs font-semibold uppercase tracking-wider text-zinc-700">
                            Nomor Induk Karyawan (NIK)
                        </label>
                        <div class="relative">
                            <div
                                class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input type="text"
                                class="w-full h-11 pl-10 pr-4 text-sm text-zinc-900 bg-white border border-zinc-200 rounded-lg placeholder:text-zinc-400 shadcn-input transition-all duration-150"
                                id="username" name="username" placeholder="Contoh: 1.101.1112" autocomplete="off"
                                autofocus required value="{{ old('username') }}">
                        </div>
                    </div>

                    <!-- Field: Password -->
                    <div class="space-y-1.5">
                        <div class="flex items-center justify-between">
                            <label for="password"
                                class="block text-xs font-semibold uppercase tracking-wider text-zinc-700">
                                Kata Sandi
                            </label>
                            <button type="button" onclick="openHelpModal()"
                                class="text-xs text-zinc-400 hover:text-emerald-600 transition-colors cursor-pointer">
                                Bantuan IT?
                            </button>
                        </div>
                        <div class="relative">
                            <div
                                class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input type="password"
                                class="w-full h-11 pl-10 pr-11 text-sm text-zinc-900 bg-white border border-zinc-200 rounded-lg placeholder:text-zinc-400 shadcn-input transition-all duration-150"
                                id="password" name="password" placeholder="••••••••"
                                autocomplete="current-password" required>
                            <button type="button" id="togglePassword" aria-label="Tampilkan / sembunyikan password"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-zinc-400 hover:text-zinc-600 transition-colors cursor-pointer">
                                <!-- Eye Icon (Visible state) -->
                                <svg id="eyeIcon" class="w-4 h-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <!-- Eye Off Icon (Hidden state) -->
                                <svg id="eyeOffIcon" class="w-4 h-4 hidden" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Security Info Note (Shadcn Subtle Card) -->
                    <div
                        class="rounded-lg bg-zinc-50 border border-zinc-200/70 p-2.5 flex items-center gap-2.5 text-[11px] text-zinc-500">
                        <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <span>Seluruh sesi & akses rekam medis diawasi serta tercatat dalam audit log.</span>
                    </div>

                    <!-- Submit Button (Shadcn Primary Button) -->
                    <button type="submit" id="submitBtn"
                        class="w-full h-11 inline-flex items-center justify-center gap-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white text-sm font-semibold shadow-sm shadow-emerald-700/25 focus:outline-none focus:ring-2 focus:ring-emerald-600/30 transition-all duration-150 cursor-pointer group">
                        <span id="btnText">Masuk ke ERM</span>
                        <svg id="btnArrow"
                            class="w-4 h-4 text-emerald-100 transition-transform duration-150 group-hover:translate-x-1"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                        <svg id="btnSpinner" class="w-4 h-4 text-white animate-spin hidden" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                    </button>
                </form>

                <!-- Card Footer: Security & Legal (Tanpa Unsur Akreditasi) -->
                <div class="mt-6 pt-5 border-t border-zinc-100 text-center">
                    <div class="flex items-center justify-center gap-2 text-[11px] text-zinc-400">
                        <svg class="w-3.5 h-3.5 text-zinc-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <span>Koneksi Aman Terenkripsi SSL/TLS</span>
                    </div>
                    <p class="text-[11px] text-zinc-400 mt-2">
                        &copy; 2024 - {{ date('Y') }} RSIA Aisyiyah Pekajangan
                    </p>
                </div>
            </div>

            <!-- Bottom Subtitle / Info -->
            <p class="text-xs text-zinc-400 mt-6 text-center">
                Sistem Informasi Manajemen Rumah Sakit &bull; Elektronik Rekam Medis
            </p>
        </div>
    </div>

    <!-- ========================================================================
         MODAL BANTUAN IT (Shadcn Dialog)
         ======================================================================== -->
    <div id="helpModal"
        class="fixed inset-0 z-50 bg-slate-900/40 backdrop-blur-sm hidden items-center justify-center p-4">
        <div
            class="w-full max-w-sm bg-white rounded-2xl border border-zinc-200 shadow-2xl p-6 relative animate-fade-in">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-zinc-900">Bantuan Akses & Akun</h3>
                </div>
                <button type="button" onclick="closeHelpModal()"
                    class="text-zinc-400 hover:text-zinc-600 text-sm p-1 rounded-lg hover:bg-zinc-100 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <p class="text-xs text-zinc-600 leading-relaxed mb-4">
                Jika Anda lupa password, akun terkunci, atau belum memiliki Nomor Induk Karyawan (NIK) terdaftar di ERM,
                silakan hubungi unit <strong>Sistem Informasi & Teknologi /IT RSIA Aisyiyah Pekajangan</strong>:
            </p>

            <div class="space-y-2 bg-zinc-50 p-3 rounded-xl border border-zinc-200/70 text-xs text-zinc-700">
                <div class="flex items-center justify-between">
                    <span class="text-zinc-500">Unit:</span>
                    <span class="font-semibold text-zinc-900">EDP / SIMRS</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-zinc-500">Ekstensi Telepon:</span>
                    <span class="font-semibold text-emerald-700">Ext. 115 / IT</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-zinc-500">Format NIK:</span>
                    <span class="font-mono text-zinc-800">Contoh: 1.101.1112</span>
                </div>
            </div>

            <div class="mt-5">
                <button type="button" onclick="closeHelpModal()"
                    class="w-full h-10 rounded-lg bg-zinc-900 hover:bg-zinc-800 text-white text-xs font-semibold transition-colors cursor-pointer">
                    Mengerti
                </button>
            </div>
        </div>
    </div>

    <!-- ========================================================================
         SCRIPTS: Live Clock, LocalStorage Reset, Show/Hide Password, and Submit State
         ======================================================================== -->
    <script type="text/javascript">
        // 1. Live Real-Time Clock & Date (Indonesian Format)
        function updateLiveClock() {
            const now = new Date();

            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                'Oktober', 'November', 'Desember'
            ];
            const monthsShort = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

            const dayName = days[now.getDay()];
            const date = now.getDate();
            const monthName = months[now.getMonth()];
            const monthShort = monthsShort[now.getMonth()];
            const year = now.getFullYear();

            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const timeFull = `${hours}:${minutes}:${seconds} WIB`;
            const timeSimple = `${hours}:${minutes}:${seconds}`;

            const dateDesktop = `${dayName}, ${date} ${monthShort} ${year}`;
            const dateCard = `${dayName}, ${date} ${monthShort}`;

            const elDateDesk = document.getElementById('liveDateDesktop');
            const elTimeDesk = document.getElementById('liveTimeDesktop');
            const elClockCard = document.getElementById('liveClockCard');
            const elDateCard = document.getElementById('liveDateCard');

            if (elDateDesk) elDateDesk.textContent = dateDesktop;
            if (elTimeDesk) elTimeDesk.textContent = timeFull;
            if (elClockCard) elClockCard.textContent = timeSimple;
            if (elDateCard) elDateCard.textContent = dateCard;
        }

        // Initialize clock immediately and run every second
        updateLiveClock();
        setInterval(updateLiveClock, 1000);

        // 2. Reset LocalStorage keys on login screen as per hospital ERM requirements
        document.addEventListener("DOMContentLoaded", () => {
            localStorage.removeItem('pasien');
            localStorage.removeItem('kamar');
            localStorage.removeItem('nm_pasien');
            localStorage.removeItem('tanggal');
            localStorage.removeItem('tgl_awal');
            localStorage.removeItem('tgl_akhir');
            localStorage.removeItem('tanggal');
            localStorage.removeItem('spesialis');
            localStorage.removeItem('dokter');
            localStorage.removeItem('riwayat');
            localStorage.removeItem('tgl_pertama');
            localStorage.removeItem('tgl_kedua');
        });

        // 3. Toggle Password Visibility
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        const eyeOffIcon = document.getElementById('eyeOffIcon');

        if (toggleBtn && passwordInput) {
            toggleBtn.addEventListener('click', function() {
                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    eyeIcon.classList.add("hidden");
                    eyeOffIcon.classList.remove("hidden");
                } else {
                    passwordInput.type = "password";
                    eyeIcon.classList.remove("hidden");
                    eyeOffIcon.classList.add("hidden");
                }
                passwordInput.focus();
            });
        }

        // 4. Prevent Double Submit & Show Loading State
        const loginForm = document.getElementById('loginForm');
        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const btnArrow = document.getElementById('btnArrow');
        const btnSpinner = document.getElementById('btnSpinner');

        if (loginForm && submitBtn) {
            loginForm.addEventListener('submit', function() {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-80', 'cursor-not-allowed');
                btnText.textContent = 'Memverifikasi...';
                if (btnArrow) btnArrow.classList.add('hidden');
                if (btnSpinner) btnSpinner.classList.remove('hidden');
            });
        }

        // 5. Modal IT Help controls
        function openHelpModal() {
            const modal = document.getElementById('helpModal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        function closeHelpModal() {
            const modal = document.getElementById('helpModal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        // Close modal when clicking outside of it
        const helpModal = document.getElementById('helpModal');
        if (helpModal) {
            helpModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeHelpModal();
                }
            });
        }
    </script>
</body>

</html>
