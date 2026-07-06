@extends('admin.layouts.app')

@section('title', 'Kelola Booking')

@section('content')

<div class="space-y-8">

    {{-- HEADER --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Kelola Booking
            </h1>

            <p class="mt-2 text-slate-500">
                Kelola pesanan dan verifikasi pembayaran wisatawan.
            </p>

        </div>

        <div class="flex items-center gap-3 rounded-xl bg-blue-50 px-4 py-3 text-blue-700">

            <i class="fa-solid fa-ticket text-xl"></i>

            <div>

                <p class="text-xs text-blue-500">
                    Total Booking
                </p>

                <p class="font-bold">
                    {{ $totalBooking }} Pesanan
                </p>

            </div>

        </div>

    </div>


    {{-- NOTIFIKASI --}}
    @if(session('success'))

        <div class="flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-green-700">

            <i class="fa-solid fa-circle-check"></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- CARD STATISTIK --}}
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">


        {{-- PENDING --}}
        <div class="rounded-2xl border-l-4 border-yellow-400 bg-white p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-500">
                        Pending
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-slate-800">
                        {{ $pending }}
                    </h2>

                    <p class="mt-2 text-xs text-slate-400">
                        Menunggu Verifikasi
                    </p>

                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-yellow-100">

                    <i class="fa-solid fa-clock text-2xl text-yellow-500"></i>

                </div>

            </div>

        </div>


        {{-- PAID --}}
        <div class="rounded-2xl border-l-4 border-green-500 bg-white p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-500">
                        Terverifikasi
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-slate-800">
                        {{ $paid }}
                    </h2>

                    <p class="mt-2 text-xs text-slate-400">
                        Pembayaran Diterima
                    </p>

                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-green-100">

                    <i class="fa-solid fa-circle-check text-2xl text-green-600"></i>

                </div>

            </div>

        </div>


        {{-- TOTAL --}}
        <div class="rounded-2xl border-l-4 border-blue-500 bg-white p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-500">
                        Total Booking
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-slate-800">
                        {{ $totalBooking }}
                    </h2>

                    <p class="mt-2 text-xs text-slate-400">
                        Semua Pesanan
                    </p>

                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-blue-100">

                    <i class="fa-solid fa-ticket text-2xl text-blue-600"></i>

                </div>

            </div>

        </div>


        {{-- PENDAPATAN --}}
        <div class="rounded-2xl border-l-4 border-purple-500 bg-white p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-500">
                        Pendapatan
                    </p>

                    <h2 class="mt-2 text-xl font-bold text-slate-800">

                        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}

                    </h2>

                    <p class="mt-2 text-xs text-slate-400">
                        Booking Terverifikasi
                    </p>

                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-purple-100">

                    <i class="fa-solid fa-wallet text-2xl text-purple-600"></i>

                </div>

            </div>

        </div>

    </div>


    {{-- FILTER --}}
    <div class="rounded-2xl bg-white p-6 shadow-sm">

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">


            {{-- SEARCH --}}
            <div class="relative">

                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                <input
                    type="text"
                    id="searchBooking"
                    placeholder="Cari nama atau email..."
                    class="w-full rounded-xl border border-slate-200 py-3 pl-11 pr-4 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

            </div>


            {{-- STATUS --}}
            <select
                id="filterStatus"
                class="rounded-xl border border-slate-200 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                <option value="">
                    Semua Status
                </option>

                <option value="pending">
                    Pending
                </option>

                <option value="paid">
                    Terverifikasi
                </option>

            </select>


            {{-- TANGGAL --}}
            <input
                type="date"
                id="filterTanggal"
                class="rounded-xl border border-slate-200 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

        </div>

    </div>


    {{-- TABEL BOOKING --}}
    <div class="overflow-hidden rounded-2xl bg-white shadow-sm">

        <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">

            <div>

                <h2 class="text-lg font-bold text-slate-800">
                    Daftar Booking
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Data booking wisatawan yang masuk.
                </p>

            </div>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">
                            Pemesan
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">
                            Wisata
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">
                            Tanggal
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">
                            Total
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">
                            Bukti Transfer
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">
                            Status
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase text-slate-500">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody id="bookingTable">

                    @forelse($booking as $item)

                        <tr
                            class="booking-row border-t border-slate-100 transition hover:bg-slate-50"

                            data-search="{{ strtolower($item->nama . ' ' . $item->email) }}"

                            data-status="{{ strtolower($item->status) }}"

                            data-tanggal="{{ $item->tanggal_kunjungan }}">


                            {{-- PEMESAN --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 font-bold text-blue-600">

                                        {{ strtoupper(substr($item->nama, 0, 1)) }}

                                    </div>


                                    <div>

                                        <p class="font-semibold text-slate-700">

                                            {{ $item->nama }}

                                        </p>

                                        <p class="text-xs text-slate-400">

                                            {{ $item->email }}

                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- WISATA --}}
                            <td class="px-6 py-4">

                                <p class="font-medium text-slate-700">

                                    {{ $item->destination->name }}

                                </p>

                            </td>


                            {{-- TANGGAL --}}
                            <td class="px-6 py-4 text-sm text-slate-600">

                                <div class="flex items-center gap-2">

                                    <i class="fa-regular fa-calendar text-slate-400"></i>

                                    {{ $item->tanggal_kunjungan }}

                                </div>

                            </td>


                            {{-- TOTAL --}}
                            <td class="px-6 py-4">

                                <p class="font-semibold text-slate-700">

                                    Rp {{ number_format($item->total_harga, 0, ',', '.') }}

                                </p>

                            </td>

                           {{-- BUKTI TRANSFER --}}
                            <td class="px-6 py-4">

                                @if($item->bukti_transfer)

                                    <button
                                        type="button"
                                        onclick="lihatBukti('{{ asset($item->bukti_transfer) }}')"
                                        class="flex items-center gap-2 rounded-lg bg-blue-50 px-3 py-2 text-sm font-semibold text-blue-600 transition hover:bg-blue-600 hover:text-white">

                                        <i class="fa-solid fa-image"></i>

                                        Lihat Bukti

                                    </button>

                                @else

                                    <span class="inline-flex items-center gap-2 rounded-lg bg-red-50 px-3 py-2 text-sm text-red-500">

                                        <i class="fa-solid fa-circle-xmark"></i>

                                        Belum Ada

                                    </span>

                                @endif

                            </td>

                            {{-- STATUS --}}
                            <td class="px-6 py-4">

                                @if($item->status == 'Pending')

                                    <span class="inline-flex items-center gap-2 rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">

                                        <span class="h-2 w-2 rounded-full bg-yellow-500"></span>

                                        Pending

                                    </span>

                                @elseif($item->status == 'Paid')

                                    <span class="inline-flex items-center gap-2 rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">

                                        <span class="h-2 w-2 rounded-full bg-green-500"></span>

                                        Terverifikasi

                                    </span>

                                @else

                                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">

                                        {{ $item->status }}

                                    </span>

                                @endif

                            </td>


                            {{-- AKSI --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center justify-center gap-2">


                                    @if($item->status == 'Pending')

                            @if($item->bukti_transfer)

                                <a
                                    href="/admin/booking/approve/{{ $item->id_booking }}"
                                    onclick="return confirm('Yakin bukti pembayaran sudah benar dan ingin memverifikasi booking {{ $item->nama }}?')"
                                    class="flex h-10 w-10 items-center justify-center rounded-lg bg-green-50 text-green-600 transition hover:bg-green-500 hover:text-white"
                                    title="Verifikasi Pembayaran">

                                    <i class="fa-solid fa-check"></i>

                                </a>

                            @else

                                <button
                                    type="button"
                                    disabled
                                    class="flex h-10 w-10 cursor-not-allowed items-center justify-center rounded-lg bg-slate-100 text-slate-400"
                                    title="Bukti transfer belum dikirim">

                                    <i class="fa-solid fa-lock"></i>

                                </button>

                            @endif

                        @else

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-green-50 text-green-600"
                            title="Sudah Terverifikasi">

                            <i class="fa-solid fa-circle-check"></i>

                        </div>

                    @endif


                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="px-6 py-16 text-center">

                                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-blue-50">

                                    <i class="fa-solid fa-ticket text-2xl text-blue-500"></i>

                                </div>

                                <h3 class="mt-4 font-bold text-slate-700">
                                    Belum Ada Booking
                                </h3>

                                <p class="mt-2 text-sm text-slate-500">
                                    Booking wisatawan akan muncul di halaman ini.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>
{{-- MODAL BUKTI TRANSFER --}}
<div
    id="modalBukti"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 p-4">

    <div class="w-full max-w-3xl overflow-hidden rounded-2xl bg-white shadow-2xl">

        {{-- HEADER MODAL --}}
        <div class="flex items-center justify-between border-b border-slate-100 px-6 py-4">

            <div>

                <h3 class="text-lg font-bold text-slate-800">
                    Bukti Transfer
                </h3>

                <p class="text-sm text-slate-500">
                    Periksa bukti pembayaran sebelum melakukan verifikasi.
                </p>

            </div>

            <button
                type="button"
                onclick="tutupBukti()"
                class="flex h-10 w-10 items-center justify-center rounded-lg text-slate-500 transition hover:bg-slate-100">

                <i class="fa-solid fa-xmark"></i>

            </button>

        </div>


        {{-- GAMBAR --}}
        <div class="flex max-h-[70vh] items-center justify-center overflow-auto bg-slate-100 p-6">

            <img
                id="gambarBukti"
                src=""
                alt="Bukti Transfer"
                class="max-h-[65vh] max-w-full rounded-xl object-contain">

        </div>

    </div>

</div>
@endsection


@push('scripts')

<script>

function lihatBukti(url) {

    const modal = document.getElementById('modalBukti');

    const gambar = document.getElementById('gambarBukti');

    gambar.src = url;

    modal.classList.remove('hidden');

    modal.classList.add('flex');

}


function tutupBukti() {

    const modal = document.getElementById('modalBukti');

    const gambar = document.getElementById('gambarBukti');

    modal.classList.remove('flex');

    modal.classList.add('hidden');

    gambar.src = '';

}

const searchBooking = document.getElementById('searchBooking');

const filterStatus = document.getElementById('filterStatus');

const filterTanggal = document.getElementById('filterTanggal');

const bookingRows = document.querySelectorAll('.booking-row');


function filterBooking() {

    const search = searchBooking.value.toLowerCase();

    const status = filterStatus.value.toLowerCase();

    const tanggal = filterTanggal.value;


    bookingRows.forEach(function(row) {

        const rowSearch = row.dataset.search;

        const rowStatus = row.dataset.status;

        const rowTanggal = row.dataset.tanggal;


        const cocokSearch =
            rowSearch.includes(search);


        const cocokStatus =
            status === '' ||
            rowStatus === status;


        const cocokTanggal =
            tanggal === '' ||
            rowTanggal === tanggal;


        if (
            cocokSearch &&
            cocokStatus &&
            cocokTanggal
        ) {

            row.style.display = '';

        } else {

            row.style.display = 'none';

        }

    });

}


searchBooking.addEventListener('input', filterBooking);

filterStatus.addEventListener('change', filterBooking);

filterTanggal.addEventListener('change', filterBooking);

</script>

@endpush