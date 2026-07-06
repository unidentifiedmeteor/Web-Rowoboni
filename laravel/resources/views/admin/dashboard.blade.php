@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="space-y-8">

    <!-- Header -->
    <div>
        <h1 class="text-3xl font-bold text-slate-800">
            Dashboard 👋
        </h1>

        <p class="text-slate-500 mt-2">
            Selamat datang kembali di Admin Panel Desa Wisata Rowoboni.
        </p>
    </div>

    <!-- CARD -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <!-- Pending -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border-l-4 border-yellow-400 hover:shadow-lg transition">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-gray-500 text-sm">
                        Pending
                    </p>

                    <h2 class="text-3xl font-bold mt-2">
                        {{ $belumDicek }}
                    </h2>

                    <p class="text-xs text-gray-400 mt-2">
                        Menunggu Verifikasi
                    </p>

                </div>

                <div class="w-14 h-14 rounded-xl bg-yellow-100 flex items-center justify-center">

                    <i class="fa-solid fa-clock text-2xl text-yellow-500"></i>

                </div>

            </div>

        </div>

        <!-- Paid -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border-l-4 border-green-500 hover:shadow-lg transition">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-gray-500 text-sm">
                        Paid
                    </p>

                    <h2 class="text-3xl font-bold mt-2">
                        {{ $terverifikasi }}
                    </h2>

                    <p class="text-xs text-gray-400 mt-2">
                        Sudah Diverifikasi
                    </p>

                </div>

                <div class="w-14 h-14 rounded-xl bg-green-100 flex items-center justify-center">

                    <i class="fa-solid fa-circle-check text-2xl text-green-600"></i>

                </div>

            </div>

        </div>

        <!-- Booking -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border-l-4 border-blue-500 hover:shadow-lg transition">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-gray-500 text-sm">
                        Total Booking
                    </p>

                    <h2 class="text-3xl font-bold mt-2">
                        {{ $totalPesanan }}
                    </h2>

                    <p class="text-xs text-gray-400 mt-2">
                        Semua Booking
                    </p>

                </div>

                <div class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center">

                    <i class="fa-solid fa-ticket text-2xl text-blue-600"></i>

                </div>

            </div>

        </div>

        <!-- Income -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border-l-4 border-purple-500 hover:shadow-lg transition">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-gray-500 text-sm">
                        Pendapatan
                    </p>

                    <h2 class="text-2xl font-bold mt-2">

                        Rp {{ number_format($pendapatan ?? 0,0,',','.') }}

                    </h2>

                    <p class="text-xs text-gray-400 mt-2">
                        Booking Terverifikasi
                    </p>

                </div>

                <div class="w-14 h-14 rounded-xl bg-purple-100 flex items-center justify-center">

                    <i class="fa-solid fa-wallet text-2xl text-purple-600"></i>

                </div>

            </div>

        </div>

    </div>

    <!-- GRAFIK -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        <!-- Grafik Booking -->
        <div class="bg-white rounded-2xl shadow-sm p-6">

            <h3 class="font-bold text-lg mb-6">

                Booking Bulanan

            </h3>

          <div class="relative h-72">
                <canvas id="bookingChart"></canvas>
            </div>
        </div>

        <!-- Pie -->
        <div class="bg-white rounded-2xl shadow-sm p-6">

            <h3 class="font-bold text-lg mb-6">

                Status Booking

            </h3>

            <div class="relative h-72">
                <canvas id="statusChart"></canvas>
            </div>

        </div>

    </div>

    <!-- Booking Terbaru -->
    <div class="bg-white rounded-2xl shadow-sm">

        <div class="flex justify-between items-center p-6 border-b">

            <h3 class="font-bold text-lg">

                Booking Terbaru

            </h3>

            <a href="/admin/booking"
               class="text-blue-600 font-semibold hover:underline">

                Lihat Semua →

            </a>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-100">

                    <tr>

                        <th class="text-left px-6 py-4">Nama</th>

                        <th class="text-left px-6 py-4">Wisata</th>

                        <th class="text-left px-6 py-4">Tanggal</th>

                        <th class="text-left px-6 py-4">Status</th>

                    </tr>

                </thead>

                <tbody>

                @foreach($booking->take(5) as $item)

                    <tr class="border-t hover:bg-slate-50">

                        <td class="px-6 py-4">

                            {{ $item->nama }}

                        </td>

                        <td class="px-6 py-4">

                            {{ $item->destination->name }}

                        </td>

                        <td class="px-6 py-4">

                            {{ $item->tanggal_kunjungan }}

                        </td>

                        <td class="px-6 py-4">

                            @if($item->status == 'Pending')

                                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm">

                                    Pending

                                </span>

                            @else

                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">

                                    Paid

                                </span>

                            @endif

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>2

        </div>

    </div>

    @endsection


@push('scripts')

<script>

const bookingBulanan = @json($bookingPerBulan);

new Chart(document.getElementById('bookingChart'), {

    type: 'line',

    data: {

        labels: [
            'Jan','Feb','Mar','Apr','Mei','Jun',
            'Jul','Ags','Sep','Okt','Nov','Des'
        ],

        datasets: [{

            label: 'Booking',

            data: bookingBulanan,

            borderColor: '#2563EB',

            backgroundColor: 'rgba(37,99,235,.15)',

            fill: true,

            tension: 0.4

        }]

    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        plugins: {

            legend: {

                display: false

            }

        }

    }

});


new Chart(document.getElementById('statusChart'), {

    type: 'doughnut',

    data: {

        labels: [

            'Pending',

            'Paid'

        ],

        datasets: [{

            data: [

                {{ $belumDicek }},

                {{ $terverifikasi }}

            ],

            backgroundColor: [

                '#F59E0B',

                '#22C55E'

            ]

        }]

    },

    options: {

        responsive: true,

        maintainAspectRatio: false

    }

});

</script>

@endpush