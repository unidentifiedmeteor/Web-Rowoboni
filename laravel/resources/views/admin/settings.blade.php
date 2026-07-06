@extends('admin.layouts.app')

@section('title', 'Pengaturan')

@section('content')

<div class="space-y-8">

    {{-- HEADER --}}
    <div>
        <h1 class="text-3xl font-bold text-slate-800">
            Pengaturan
        </h1>

        <p class="mt-2 text-slate-500">
            Kelola informasi website dan pembayaran Desa Wisata Rowoboni.
        </p>
    </div>


    {{-- SUCCESS --}}
    @if(session('success'))

        <div class="flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-green-700">

            <i class="fa-solid fa-circle-check"></i>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- ERROR --}}
    @if($errors->any())

        <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-red-700">

            <div class="flex items-center gap-3 font-semibold">

                <i class="fa-solid fa-circle-exclamation"></i>

                Data gagal disimpan.

            </div>

            <ul class="mt-3 list-inside list-disc text-sm">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form action="/admin/settings/update" method="POST">

        @csrf


        <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">


            {{-- INFORMASI WEBSITE --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm">

                <div class="border-b border-slate-100 px-6 py-5">

                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-100 text-blue-600">

                            <i class="fa-solid fa-globe"></i>

                        </div>

                        <div>

                            <h2 class="font-bold text-slate-800">
                                Informasi Website
                            </h2>

                            <p class="text-sm text-slate-500">
                                Informasi utama Desa Wisata Rowoboni.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="space-y-5 p-6">


                    {{-- NAMA WEBSITE --}}
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Website
                        </label>

                        <input
                            type="text"
                            name="site_name"
                            value="{{ old('site_name', $setting->site_name ?? 'Desa Wisata Rowoboni') }}"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                            required>

                    </div>


                    {{-- EMAIL --}}
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', $setting->email ?? '') }}"
                            placeholder="rowoboni@example.com"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                    </div>


                    {{-- WHATSAPP --}}
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Nomor WhatsApp
                        </label>

                        <input
                            type="text"
                            name="whatsapp"
                            value="{{ old('whatsapp', $setting->whatsapp ?? '') }}"
                            placeholder="628123456789"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                    </div>


                    {{-- ALAMAT --}}
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Alamat
                        </label>

                        <textarea
                            name="address"
                            rows="4"
                            placeholder="Alamat Desa Wisata Rowoboni"
                            class="w-full resize-none rounded-xl border border-slate-200 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('address', $setting->address ?? '') }}</textarea>

                    </div>


                    {{-- DESKRIPSI --}}
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Deskripsi Singkat
                        </label>

                        <textarea
                            name="description"
                            rows="5"
                            placeholder="Deskripsi singkat Desa Wisata Rowoboni..."
                            class="w-full resize-none rounded-xl border border-slate-200 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('description', $setting->description ?? '') }}</textarea>

                    </div>

                </div>

            </div>


            {{-- PEMBAYARAN --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm">

                <div class="border-b border-slate-100 px-6 py-5">

                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-purple-100 text-purple-600">

                            <i class="fa-solid fa-building-columns"></i>

                        </div>

                        <div>

                            <h2 class="font-bold text-slate-800">
                                Informasi Pembayaran
                            </h2>

                            <p class="text-sm text-slate-500">
                                Rekening tujuan pembayaran wisatawan.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="space-y-5 p-6">


                    {{-- BANK --}}
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Bank
                        </label>

                        <input
                            type="text"
                            name="bank_name"
                            value="{{ old('bank_name', $setting->bank_name ?? '') }}"
                            placeholder="Contoh: BCA"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-100">

                    </div>


                    {{-- NOMOR REKENING --}}
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Nomor Rekening
                        </label>

                        <input
                            type="text"
                            name="account_number"
                            value="{{ old('account_number', $setting->account_number ?? '') }}"
                            placeholder="1234567890"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-100">

                    </div>


                    {{-- PEMILIK --}}
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Atas Nama
                        </label>

                        <input
                            type="text"
                            name="account_name"
                            value="{{ old('account_name', $setting->account_name ?? '') }}"
                            placeholder="Nama pemilik rekening"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none transition focus:border-purple-500 focus:ring-2 focus:ring-purple-100">

                    </div>


                    {{-- INFO --}}
                    <div class="rounded-xl border border-blue-100 bg-blue-50 p-5">

                        <div class="flex gap-3">

                            <i class="fa-solid fa-circle-info mt-1 text-blue-500"></i>

                            <div>

                                <p class="font-semibold text-blue-700">
                                    Informasi Pembayaran
                                </p>

                                <p class="mt-1 text-sm leading-relaxed text-blue-600">
                                    Data rekening ini nantinya dapat ditampilkan pada halaman pembayaran wisatawan.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- BUTTON SIMPAN --}}
        <div class="mt-6 flex justify-end">

            <button
                type="submit"
                class="flex items-center gap-2 rounded-xl bg-blue-600 px-7 py-3 font-semibold text-white shadow-sm transition hover:bg-blue-700">

                <i class="fa-solid fa-floppy-disk"></i>

                Simpan Pengaturan

            </button>

        </div>

    </form>

</div>

@endsection