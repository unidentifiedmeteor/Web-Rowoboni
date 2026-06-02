<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Wisata Rowoboni</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800">

    {{-- NAVBAR --}}
<nav class="bg-blue-50 shadow-sm sticky top-0 z-50">
    <div class="max-w-6xl mx-auto px-12 py-4 flex items-center justify-between">

        {{-- Kiri: Logo --}}
        <a href="{{ url('/') }}" class="font-bold text-lg leading-tight text-blue-900">
            Desa<br>Rowoboni
        </a>

        {{-- Tengah: Menu --}}
        <div class="flex gap-20">
            <a href="#profil" class="hover:text-blue-600 transition">Profil</a>
            <a href="#wisata" class="hover:text-blue-600 transition">Wisata</a>
            <a href="#galeri" class="hover:text-blue-600 transition">Galeri</a>
        </div>

        {{-- Kanan: Pesan Tiket --}}
        <a href="#wisata" class="bg-blue-600 text-white px-5 py-2 rounded-full hover:bg-blue-700 transition font-medium">
            Pesan Tiket
        </a>

    </div>
</nav>


    {{-- CONTENT --}}
    @yield('content')

    {{-- FOOTER --}}
    <footer class="bg-gray-100 text-center py-6 mt-12 text-sm text-gray-500">
        Lupa footernya gimana nanti cek
    </footer>

</body>
</html>