<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Wisata Rowoboni</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800">

    {{-- NAVBAR USER --}}
    <header class="sticky top-0 z-50 border-b border-slate-200 bg-blue-50/95 backdrop-blur">

        <nav class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">

            {{-- LOGO --}}
            <a href="/" class="text-xl font-bold leading-tight text-blue-900">
                Desa<br>
                Rowoboni
            </a>

            {{-- MENU --}}
            <div class="hidden items-center gap-16 md:flex">

                <a href="/#profil"
                   class="text-slate-700 transition hover:text-blue-600">
                    Profil
                </a>

                <a href="/#wisata"
                   class="text-slate-700 transition hover:text-blue-600">
                    Wisata
                </a>

                <a href="/#galeri"
                   class="text-slate-700 transition hover:text-blue-600">
                    Galeri
                </a>

            </div>

            {{-- TOMBOL --}}
            <a href="/#wisata"
               class="rounded-full bg-blue-600 px-6 py-3 font-semibold text-white transition hover:bg-blue-700">

                Pesan Tiket

            </a>

        </nav>

    </header>


    {{-- CONTENT --}}
    @yield('content')


    {{-- FOOTER --}}
    <footer class="bg-blue-50 border-t border-blue-100 mt-12">
    <div class="max-w-6xl mx-auto px-12 py-8 grid grid-cols-1 md:grid-cols-3 gap-8 text-sm text-blue-900">

        {{-- Kiri: Nama Desa --}}
        <div class="flex items-center">
            <span class="font-bold">Desa Rowoboni</span>
        </div>

        {{-- Tengah: Alamat --}}
        <div class="flex items-start gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mt-0.5 flex-shrink-0 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span>
                Jl Brawijaya KM 5 Muncul,<br>
                Desa Rowoboni, Kec. Banyubiru,<br>
                Kab. Semarang
            </span>
        </div>

        {{-- Kanan: Kontak --}}
        <div>
            <p class="font-bold mb-2">Hubungi Kami</p>
            <div class="space-y-1.5">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="18" height="18" rx="5" stroke-linecap="round" stroke-linejoin="round" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.5 6.5h.01" />
                    </svg>
                    <span>@pemerintahdesarowoboni</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h2.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-1.498.749a11.042 11.042 0 005.516 5.516l.75-1.498a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <span>(0298) 86052179</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span>dsrowoboni@gmail.com</span>
                </div>
            </div>
        </div>

    </div>
</footer>
</body>
</html>