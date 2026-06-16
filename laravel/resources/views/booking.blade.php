@extends('layouts.app')

@section('content')
<main class="py-12 px-6 max-w-2xl mx-auto">
    <div class="bg-white border border-blue-100 rounded-2xl shadow-sm p-8">
        
        <!-- Judul Form -->
        <h2 class="text-xl font-bold text-blue-900 text-center mb-8 uppercase tracking-wide">
            Formulir Pemesanan Tiket
        </h2>

        <form action="#" method="POST" enctype="multipart/form-data" class="space-y-5 text-sm text-gray-700">
            @csrf

            <!-- Destinasi Wisata -->
            <div class="grid grid-cols-3 items-center">
                <label class="font-medium text-blue-950">Destinasi Wisata</label>
                <div class="col-span-2 flex items-center gap-2">
                    <span class="hidden md:inline">:</span>
                    <select name="destination_id" id="destination-select" class="w-full bg-gray-100 border border-gray-200 rounded-lg p-2 focus:outline-none focus:border-blue-600">
                        <option value="{{ $destination->id ?? '' }}" data-price="{{ $destination->price ?? 0 }}">
                            {{ $destination->name ?? 'Dermaga Asri Rowoboni' }}
                        </option>
                    </select>
                </div>
            </div>

            <!-- Nama Lengkap -->
            <div class="grid grid-cols-3 items-center">
                <label class="font-medium text-blue-950">Nama lengkap</label>
                <div class="col-span-2 flex items-center gap-2">
                    <span class="hidden md:inline">:</span>
                    <input type="text" name="name" required class="w-full bg-gray-100 border border-gray-200 rounded-lg p-2 focus:outline-none focus:border-blue-600">
                </div>
            </div>

            <!-- Alamat Email -->
            <div class="grid grid-cols-3 items-center">
                <label class="font-medium text-blue-950">Alamat email</label>
                <div class="col-span-2 flex items-center gap-2">
                    <span class="hidden md:inline">:</span>
                    <input type="email" name="email" required class="w-full bg-gray-100 border border-gray-200 rounded-lg p-2 focus:outline-none focus:border-blue-600">
                </div>
            </div>

            <!-- Tanggal -->
            <div class="grid grid-cols-3 items-center">
                <label class="font-medium text-blue-950">Tanggal</label>
                <div class="col-span-2 flex items-center gap-2">
                    <span class="hidden md:inline">:</span>
                    <input type="date" name="date" required class="w-full bg-gray-100 border border-gray-200 rounded-lg p-2 focus:outline-none focus:border-blue-600">
                </div>
            </div>

            <!-- Jumlah Tiket dengan tombol + dan - -->
            <div class="grid grid-cols-3 items-center">
                <label class="font-medium text-blue-950">Jumlah tiket</label>
                <div class="col-span-2 flex items-center gap-2">
                    <span class="hidden md:inline">:</span>
                    <div class="flex items-center gap-1">
                        <button type="button" id="btn-minus" class="w-8 h-8 bg-gray-200 hover:bg-gray-300 font-bold rounded-l-md flex items-center justify-center transition">-</button>
                        <input type="number" name="num_people" id="num-people" value="1" min="1" readonly class="w-12 h-8 text-center bg-gray-50 border-y border-gray-200 font-semibold focus:outline-none">
                        <button type="button" id="btn-plus" class="w-8 h-8 bg-gray-200 hover:bg-gray-300 font-bold rounded-r-md flex items-center justify-center transition">+</button>
                    </div>
                </div>
            </div>

            <!-- Total yang Harus Dibayar (Dinamis Otomatis) -->
            <div class="pt-4 border-t border-dashed border-gray-200">
                <p class="font-bold text-blue-900">
                    Total yang harus dibayar : <span class="text-green-600 text-lg" id="total-display">Rp {{ number_format($destination->price ?? 10000, 0, ',', '.') }}</span>
                </p>
            </div>

            <!-- Informasi Rekening Bank -->
            <div class="p-4 bg-gray-50 rounded-xl space-y-2 border border-gray-100">
                <p class="text-xs text-gray-500 italic mb-1">Silahkan transfer tepat sesuai nominal ke rekening resmi berikut:</p>
                <div class="grid grid-cols-3">
                    <span class="font-medium">Bank</span>
                    <span class="col-span-2">: Bank gtw</span>
                </div>
                <div class="grid grid-cols-3">
                    <span class="font-medium">Nomor Rekening</span>
                    <span class="col-span-2">: 1231313123</span>
                </div>
                <div class="grid grid-cols-3">
                    <span class="font-medium">Atas Nama</span>
                    <span class="col-span-2">: Kas Desa Wisata Rowoboni</span>
                </div>
            </div>

            <!-- Upload Bukti Transfer -->
            <div class="space-y-2">
                <label class="block font-medium text-blue-950">Upload foto/screenshot bukti transfer</label>
                <input type="file" name="payment_proof" accept="image/*" required class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
            </div>

            <!-- Tombol Kirim -->
            <div class="flex justify-end pt-4">
                <button type="button" class="bg-gray-800 text-white px-8 py-2 rounded-lg hover:bg-blue-900 transition font-medium tracking-wide">
                    Kirim
                </button>
            </div>
        </form>
    </div>
</main>

<!-- SCRIPT LIVE TOTAL HARGA & TOMBOL INCREMENT -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnMinus = document.getElementById('btn-minus');
        const btnPlus = document.getElementById('btn-plus');
        const numPeopleInput = document.getElementById('num-people');
        const totalDisplay = document.getElementById('total-display');
        const selectElement = document.getElementById('destination-select');

        // Mengambil harga tiket awal dari elemen option terpilih
        let ticketPrice = parseInt(selectElement.options[selectElement.selectedIndex].getAttribute('data-price')) || 10000;

        function updateTotal() {
            let count = parseInt(numPeopleInput.value);
            let total = count * ticketPrice;
            totalDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        btnMinus.addEventListener('click', function () {
            let current = parseInt(numPeopleInput.value);
            if (current > 1) {
                numPeopleInput.value = current - 1;
                updateTotal();
            }
        });

        btnPlus.addEventListener('click', function () {
            let current = parseInt(numPeopleInput.value);
            numPeopleInput.value = current + 1;
            updateTotal();
        });
    });
</script>
@endsection
