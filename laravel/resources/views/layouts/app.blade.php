<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Wisata Rowoboni</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-display { font-family: 'Fraunces', serif; }
    </style>
</head>
<body class="bg-white text-[#16323D]">

    {{-- NAVBAR --}}
    <nav class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-[#E3EEEC]">
        <div class="max-w-6xl mx-auto px-6 md:px-12 py-4 flex items-center justify-between">

            {{-- Kiri: Logo --}}
            <a href="{{ url('/') }}" class="flex items-center gap-2 font-display font-semibold text-lg text-[#0D3B4F] leading-tight">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1C6E8C" stroke-width="2" stroke-linecap="round" class="flex-shrink-0">
                    <path d="M2 17c2-2 4-2 6 0s4 2 6 0 4-2 6 0"/>
                    <path d="M2 12c2-2 4-2 6 0s4 2 6 0 4-2 6 0"/>
                </svg>
                Desa Rowoboni
            </a>

            {{-- Tengah: Menu (desktop) --}}
            <div class="hidden md:flex items-center gap-10">
                <a href="{{ url('/#profil') }}" class="text-sm font-medium text-[#5B7480] hover:text-[#1C6E8C] transition-colors">Profil</a>
                <a href="{{ url('/#wisata') }}" class="text-sm font-medium text-[#5B7480] hover:text-[#1C6E8C] transition-colors">Wisata</a>
                <a href="{{ url('/#galeri') }}" class="text-sm font-medium text-[#5B7480] hover:text-[#1C6E8C] transition-colors">Galeri</a>
            </div>

            {{-- Kanan: Pesan Tiket + Hamburger --}}
            <div class="flex items-center gap-3">
                <a href="#wisata" class="hidden sm:inline-flex bg-[#1C6E8C] text-white text-sm font-semibold px-5 py-2.5 rounded-full hover:bg-[#0D3B4F] transition-colors">
                    Pesan Tiket
                </a>
                <button id="rowoboni-menu-btn" type="button"
                        class="md:hidden w-9 h-9 flex items-center justify-center"
                        aria-label="Buka menu" aria-expanded="false" aria-controls="rowoboni-mobile-menu">
                    <span id="rowoboni-menu-icon" class="block relative w-5 h-4">
                        <span class="absolute left-0 top-0 w-5 h-0.5 bg-[#0D3B4F] rounded-full transition-transform duration-300"></span>
                        <span class="absolute left-0 top-1/2 -translate-y-1/2 w-5 h-0.5 bg-[#0D3B4F] rounded-full transition-opacity duration-300"></span>
                        <span class="absolute left-0 bottom-0 w-5 h-0.5 bg-[#0D3B4F] rounded-full transition-transform duration-300"></span>
                    </span>
                </button>
            </div>
        </div>

        {{-- Menu (mobile) --}}
        <div id="rowoboni-mobile-menu" class="md:hidden hidden flex-col bg-white border-t border-[#E3EEEC] px-6 py-4">
            <a href="{{ url('/#profil') }}" class="py-2.5 text-sm font-medium text-[#5B7480] hover:text-[#1C6E8C] transition-colors">Profil</a>
            <a href="{{ url('/#wisata') }}" class="py-2.5 text-sm font-medium text-[#5B7480] hover:text-[#1C6E8C] transition-colors">Wisata</a>
            <a href="{{ url('/#galeri') }}" class="py-2.5 text-sm font-medium text-[#5B7480] hover:text-[#1C6E8C] transition-colors">Galeri</a>
            <a href="#wisata" class="mt-2 inline-flex justify-center bg-[#1C6E8C] text-white text-sm font-semibold px-5 py-2.5 rounded-full hover:bg-[#0D3B4F] transition-colors">
                Pesan Tiket
            </a>
        </div>
    </nav>

    {{-- CONTENT --}}
    @yield('content')

    {{-- Transisi bergelombang menuju footer --}}
    <div class="bg-white" aria-hidden="true">
        <svg viewBox="0 0 1440 100" preserveAspectRatio="none" class="w-full h-14 md:h-20 block" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,40 C240,90 480,0 720,35 C960,70 1200,15 1440,45 L1440,100 L0,100 Z" fill="#F0F6F4"></path>
        </svg>
    </div>

    {{-- FOOTER --}}
    <footer class="bg-[#F0F6F4]">
        <div class="max-w-6xl mx-auto px-6 md:px-12 py-10 grid grid-cols-1 md:grid-cols-3 gap-8 text-sm text-[#16323D]">

            {{-- Kiri: Nama Desa --}}
            <span class="font-display font-semibold text-[#0D3B4F]">
                {{ $setting->site_name ?? 'Desa Rowoboni' }}
            </span>

            {{-- Tengah: Alamat --}}
            <div class="flex items-start gap-2 text-[#5B7480]">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#1C6E8C] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>

                <div>
                    <p class="font-display font-semibold text-[#0D3B4F] mb-2">Alamat</p>
                    <span>{{ $setting->address ?? 'Alamat belum tersedia' }}</span>
                </div>
            </div>
            {{-- Kanan: Kontak --}}
            
            <div>
                <p class="font-display font-semibold text-[#0D3B4F] mb-2">Hubungi Kami</p>
                <div class="space-y-1.5 text-[#5B7480]">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#1C6E8C]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="18" height="18" rx="5" stroke-linecap="round" stroke-linejoin="round" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.5 6.5h.01" />
                        </svg>
                        @if(!empty($setting?->instagram))
                        <a
                            href="https://instagram.com/{{ ltrim($setting->instagram, '@') }}"
                            target="_blank"
                            class="hover:text-[#1C6E8C] transition">
                            {{ $setting->instagram }}
                        </a>
                    @else
                        <span>Instagram belum tersedia</span>
                    @endif
                    </div>
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#1C6E8C]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h2.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-1.498.749a11.042 11.042 0 005.516 5.516l.75-1.498a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        @if(!empty($setting?->whatsapp))
                            <a
                                href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp) }}"
                                target="_blank"
                                class="hover:text-[#1C6E8C] transition">
                                {{ $setting->whatsapp }}
                            </a>
                        @else
                            <span>WhatsApp belum tersedia</span>
                        @endif
                    </div>
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#1C6E8C]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        @if(!empty($setting?->email))
                            <a
                                href="mailto:{{ $setting->email }}"
                                class="hover:text-[#1C6E8C] transition">
                                {{ $setting->email }}
                            </a>
                        @else
                            <span>Email belum tersedia</span>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </footer>

    <script>
    (function () {
        var btn = document.getElementById('rowoboni-menu-btn');
        var menu = document.getElementById('rowoboni-mobile-menu');
        var bars = document.querySelectorAll('#rowoboni-menu-icon span');

        if (!btn || !menu) return;

        function setOpen(isOpen) {
            menu.classList.toggle('hidden', !isOpen);
            menu.classList.toggle('flex', isOpen);
            btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            btn.setAttribute('aria-label', isOpen ? 'Tutup menu' : 'Buka menu');
            if (bars.length === 3) {
                bars[0].style.transform = isOpen ? 'translateY(7px) rotate(45deg)' : '';
                bars[1].style.opacity = isOpen ? '0' : '1';
                bars[2].style.transform = isOpen ? 'translateY(-7px) rotate(-45deg)' : '';
            }
        }

        btn.addEventListener('click', function () {
            setOpen(menu.classList.contains('hidden'));
        });

        menu.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () { setOpen(false); });
        });

        window.addEventListener('resize', function () {
            if (window.innerWidth >= 768) setOpen(false);
        });
    })();
    </script>

</body>
</html>