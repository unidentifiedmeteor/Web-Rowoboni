<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Desa Wisata Rowoboni</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>

    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
</head>

<body class="bg-slate-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-72 bg-slate-900 text-white flex flex-col">

        <!-- Logo -->
        <div class="p-6 border-b border-slate-700">

            <div class="flex items-center gap-4">

                <div class="w-14 h-14 rounded-xl bg-blue-600 flex items-center justify-center">

                    <i class="fa-solid fa-tree text-2xl"></i>

                </div>

                <div>

                    <h1 class="text-xl font-bold">
                        Rowoboni
                    </h1>

                    <p class="text-sm text-slate-400">
                        Admin Panel
                    </p>

                </div>

            </div>

        </div>

        <!-- Menu -->
        <div class="flex-1 flex flex-col justify-between">

            <div class="px-4 py-6">

                <p class="text-xs uppercase text-slate-500 mb-3 tracking-widest">
                    MENU
                </p>

                <div class="space-y-2">

                    <!-- Dashboard -->
                    <a href="/admin/dashboard"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('admin/dashboard')
                        ? 'bg-blue-600 text-white'
                        : 'text-slate-300 hover:bg-slate-800' }}">

                        <i class="fa-solid fa-house w-5 text-center"></i>

                        Dashboard

                    </a>

                    <!-- Wisata -->
                    <a href="/admin/wisata"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('admin/wisata*')
                        ? 'bg-blue-600 text-white'
                        : 'text-slate-300 hover:bg-slate-800' }}">

                        <i class="fa-solid fa-mountain-sun w-5 text-center"></i>

                        Kelola Wisata

                    </a>

                    <!-- Galeri -->
                    <a href="/admin/galeri"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('admin/galeri*')
                        ? 'bg-blue-600 text-white'
                        : 'text-slate-300 hover:bg-slate-800' }}">

                        <i class="fa-solid fa-images w-5 text-center"></i>

                        Kelola Galeri

                    </a>

                    <!-- Booking -->
                    <a href="/admin/booking"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('admin/booking*')
                        ? 'bg-blue-600 text-white'
                        : 'text-slate-300 hover:bg-slate-800' }}">

                        <i class="fa-solid fa-ticket w-5 text-center"></i>

                        Kelola Booking

                    </a>

                    <!-- Pengaturan -->
                    <a href="/admin/settings"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('admin/settings*')
                        ? 'bg-blue-600 text-white'
                        : 'text-slate-300 hover:bg-slate-800' }}">

                        <i class="fa-solid fa-gear w-5 text-center"></i>

                        Pengaturan

                    </a>

                </div>

            </div>

            <!-- Footer Sidebar -->
            <div>

                <div class="border-t border-slate-700 px-6 py-4">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center">

                            <i class="fa-solid fa-user"></i>

                        </div>

                        <div>

                            <h4 class="font-semibold">

                                {{ session('admin_name') }}

                            </h4>

                            <p class="text-xs text-slate-400">

                                Administrator

                            </p>

                        </div>

                    </div>

                </div>

                <div class="px-4 pb-4">

                    <a href="/admin/logout"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-red-300 hover:bg-red-600 hover:text-white transition">

                        <i class="fa-solid fa-right-from-bracket w-5 text-center"></i>

                        Logout

                    </a>

                </div>

            </div>

        </div>

    </aside>

    <!-- CONTENT -->
    <div class="flex-1 flex flex-col">

        <!-- Header -->
        <header class="bg-white shadow-sm px-8 py-5 flex justify-between items-center">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">

                    @yield('title')

                </h2>

                <p class="text-gray-500 text-sm">

                    Selamat datang di Dashboard Admin Desa Wisata Rowoboni

                </p>

            </div>

        </header>

        <!-- Isi Halaman -->
        <main class="flex-1 p-8">

            @yield('content')

        </main>

    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
@stack('scripts')
</body>
</html>