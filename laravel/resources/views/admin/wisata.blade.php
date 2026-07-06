@extends('admin.layouts.app')

@section('title', 'Kelola Wisata')

@section('content')

<div class="space-y-8">

    {{-- HEADER --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Kelola Wisata
            </h1>

            <p class="mt-2 text-slate-500">
                Tambah, edit, dan kelola destinasi wisata Desa Rowoboni.
            </p>
        </div>

        <div class="flex items-center gap-3 rounded-xl bg-blue-50 px-4 py-3 text-blue-700">

            <i class="fa-solid fa-mountain-sun text-xl"></i>

            <div>
                <p class="text-xs text-blue-500">
                    Total Destinasi
                </p>

                <p class="font-bold">
                    {{ $destinations->count() }} Wisata
                </p>
            </div>

        </div>

    </div>


    {{-- NOTIFIKASI --}}
    @if(session('success'))

        <div class="flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-green-700">

            <i class="fa-solid fa-circle-check"></i>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- FORM --}}
    <div class="overflow-hidden rounded-2xl bg-white shadow-sm">

        <div class="border-b border-slate-100 px-6 py-5">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl
                    {{ isset($editData) ? 'bg-yellow-100 text-yellow-600' : 'bg-blue-100 text-blue-600' }}">

                    <i class="fa-solid {{ isset($editData) ? 'fa-pen-to-square' : 'fa-plus' }}"></i>

                </div>

                <div>

                    <h2 class="text-lg font-bold text-slate-800">

                        @if(isset($editData))
                            Edit Destinasi Wisata
                        @else
                            Tambah Destinasi Wisata
                        @endif

                    </h2>

                    <p class="text-sm text-slate-500">

                        @if(isset($editData))
                            Perbarui informasi destinasi wisata.
                        @else
                            Masukkan informasi destinasi wisata baru.
                        @endif

                    </p>

                </div>

            </div>

        </div>


        <div class="p-6">

            @if(isset($editData))

                <form
                    action="/admin/wisata/update/{{ $editData->id }}"
                    method="POST"
                    enctype="multipart/form-data">

            @else

                <form
                    action="/admin/wisata/store"
                    method="POST"
                    enctype="multipart/form-data">

            @endif

                @csrf


                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">


                    {{-- NAMA --}}
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Wisata
                        </label>

                        <div class="relative">

                            <i class="fa-solid fa-mountain-sun absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name', $editData->name ?? '') }}"
                                placeholder="Masukkan nama wisata"
                                class="w-full rounded-xl border border-slate-200 py-3 pl-11 pr-4 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                                required>

                        </div>

                    </div>


                    {{-- KATEGORI --}}
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Kategori
                        </label>

                        <div class="relative">

                            <i class="fa-solid fa-layer-group absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                            <input
                                type="text"
                                name="category"
                                value="{{ old('category', $editData->category ?? '') }}"
                                placeholder="Contoh: Wisata Alam"
                                class="w-full rounded-xl border border-slate-200 py-3 pl-11 pr-4 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                                required>

                        </div>

                    </div>


                    {{-- HARGA --}}
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Harga Tiket
                        </label>

                        <div class="relative">

                            <span class="absolute left-4 top-1/2 -translate-y-1/2 font-semibold text-slate-400">
                                Rp
                            </span>

                            <input
                                type="number"
                                name="price"
                                value="{{ old('price', $editData->price ?? '') }}"
                                placeholder="Contoh: 15000"
                                class="w-full rounded-xl border border-slate-200 py-3 pl-12 pr-4 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                                required>

                        </div>

                    </div>


                    {{-- LOKASI --}}
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Lokasi
                        </label>

                        <div class="relative">

                            <i class="fa-solid fa-location-dot absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                            <input
                                type="text"
                                name="location"
                                value="{{ old('location', $editData->location ?? '') }}"
                                placeholder="Masukkan lokasi wisata"
                                class="w-full rounded-xl border border-slate-200 py-3 pl-11 pr-4 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                                required>

                        </div>

                    </div>


                    {{-- DESKRIPSI --}}
                    <div class="md:col-span-2">

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Deskripsi
                        </label>

                        <textarea
                            name="description"
                            rows="5"
                            placeholder="Tuliskan deskripsi destinasi wisata..."
                            class="w-full resize-none rounded-xl border border-slate-200 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                            required>{{ old('description', $editData->description ?? '') }}</textarea>

                    </div>


                    {{-- FOTO --}}
                    <div class="md:col-span-2">

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Foto Wisata
                        </label>

                        <div class="rounded-xl border-2 border-dashed border-slate-200 p-6 text-center transition hover:border-blue-400">

                            <i class="fa-solid fa-cloud-arrow-up mb-3 text-3xl text-blue-500"></i>

                            <p class="mb-3 text-sm text-slate-500">
                                Pilih foto destinasi wisata
                            </p>

                            <input
                                type="file"
                                name="image"
                                accept="image/*"
                                class="block w-full text-sm text-slate-500
                                file:mr-4 file:rounded-lg file:border-0
                                file:bg-blue-50 file:px-4 file:py-2
                                file:font-semibold file:text-blue-600
                                hover:file:bg-blue-100">

                        </div>

                    </div>

                </div>


                {{-- BUTTON --}}
                <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                    @if(isset($editData))

                        <a
                            href="/admin/wisata"
                            class="rounded-xl border border-slate-200 px-6 py-3 text-center font-semibold text-slate-600 transition hover:bg-slate-50">

                            Batal

                        </a>

                    @endif


                    <button
                        type="submit"
                        class="flex items-center justify-center gap-2 rounded-xl
                        {{ isset($editData) ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-blue-600 hover:bg-blue-700' }}
                        px-6 py-3 font-semibold text-white shadow-sm transition">

                        <i class="fa-solid {{ isset($editData) ? 'fa-floppy-disk' : 'fa-plus' }}"></i>

                        @if(isset($editData))
                            Simpan Perubahan
                        @else
                            Tambah Wisata
                        @endif

                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- DAFTAR WISATA --}}
    <div>

        <div class="mb-5">

            <h2 class="text-xl font-bold text-slate-800">
                Daftar Destinasi
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Semua destinasi wisata yang tersedia.
            </p>

        </div>


        @if($destinations->count() > 0)

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">

                @foreach($destinations as $item)

                    <div class="group overflow-hidden rounded-2xl bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">


                        {{-- GAMBAR --}}
                        <div class="relative h-52 overflow-hidden bg-slate-100">

                            <img
                                src="{{ $item->imageUrl() }}"
                                alt="{{ $item->name }}"
                                class="h-full w-full object-cover transition duration-500 group-hover:scale-105">


                            <div class="absolute left-4 top-4">

                                <span class="rounded-full bg-white/90 px-3 py-1 text-xs font-semibold text-blue-600 shadow-sm backdrop-blur">

                                    {{ $item->category }}

                                </span>

                            </div>

                        </div>


                        {{-- CONTENT --}}
                        <div class="p-5">

                            <h3 class="text-lg font-bold text-slate-800">

                                {{ $item->name }}

                            </h3>


                            <div class="mt-3 flex items-center gap-2 text-sm text-slate-500">

                                <i class="fa-solid fa-location-dot text-red-400"></i>

                                <span class="truncate">

                                    {{ $item->location }}

                                </span>

                            </div>


                            <p class="mt-3 line-clamp-2 text-sm leading-relaxed text-slate-500">

                                {{ $item->description }}

                            </p>


                            <div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-4">

                                <div>

                                    <p class="text-xs text-slate-400">
                                        Harga Tiket
                                    </p>

                                    <p class="font-bold text-green-600">

                                        Rp {{ number_format($item->price, 0, ',', '.') }}

                                    </p>

                                </div>


                                <div class="flex gap-2">

                                    <a
                                        href="/admin/wisata/edit/{{ $item->id }}"
                                        class="flex h-10 w-10 items-center justify-center rounded-lg bg-yellow-50 text-yellow-600 transition hover:bg-yellow-500 hover:text-white"
                                        title="Edit">

                                        <i class="fa-solid fa-pen-to-square"></i>

                                    </a>


                                    <a
                                        href="/admin/wisata/delete/{{ $item->id }}"
                                        onclick="return confirm('Yakin ingin menghapus wisata {{ $item->name }}?')"
                                        class="flex h-10 w-10 items-center justify-center rounded-lg bg-red-50 text-red-600 transition hover:bg-red-500 hover:text-white"
                                        title="Hapus">

                                        <i class="fa-solid fa-trash"></i>

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="rounded-2xl bg-white px-6 py-16 text-center shadow-sm">

                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-blue-50">

                    <i class="fa-solid fa-mountain-sun text-3xl text-blue-500"></i>

                </div>

                <h3 class="mt-5 text-lg font-bold text-slate-800">
                    Belum Ada Destinasi
                </h3>

                <p class="mt-2 text-sm text-slate-500">
                    Tambahkan destinasi wisata pertama menggunakan formulir di atas.
                </p>

            </div>

        @endif

    </div>

</div>

@endsection