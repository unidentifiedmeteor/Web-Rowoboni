@extends('layouts.app')

@section('content')
<div id="booking-form-page">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

    #booking-form-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    #booking-form-page .font-display {
        font-family: 'Fraunces', serif;
    }
</style>

<main class="py-16 px-6 max-w-2xl mx-auto bg-[#F0F6F4]">
    <div class="bg-white border border-[#E3EEEC] rounded-3xl shadow-xl shadow-[#0D3B4F]/10 p-8 md:p-10">

        <!-- Judul Form -->
        <div class="text-center mb-10">
            <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#1C6E8C] bg-[#F0F6F4] border border-[#CFE3DF] px-3 py-1 rounded-full uppercase tracking-wide mb-4">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="3"/>
                    <circle cx="12" cy="12" r="8" stroke-opacity="0.5"/>
                </svg>
                Booking
            </span>
            <h2 class="font-display text-2xl md:text-3xl font-semibold text-[#0D3B4F]">
                Formulir Pemesanan Tiket
            </h2>
        </div>

        <form
        action="/booking/store"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-5 text-sm text-[#3B4E52]">
        @csrf

        <input
        type="hidden"
        name="destination_id"
        value="{{ $destination->id }}">

            <!-- Destinasi Wisata -->
            <div class="grid grid-cols-3 items-center">
                <label class="font-semibold text-[#0D3B4F]">Destinasi Wisata</label>
                <div class="col-span-2 flex items-center gap-2">
                    <span class="hidden md:inline text-[#8B9C9A]">:</span>
                    <select name="destination_id" id="destination-select" class="w-full bg-[#F7FAF9] border border-[#E3EEEC] rounded-lg p-2.5 focus:outline-none focus:border-[#1C6E8C] transition">
                        <option value="{{ $destination->id ?? '' }}" data-price="{{ $destination->price ?? 0 }}">
                            {{ $destination->name ?? 'Dermaga Asri Rowoboni' }}
                        </option>
                    </select>
                </div>
            </div>

            <!-- Nama Lengkap -->
            <div class="grid grid-cols-3 items-center">
                <label class="font-semibold text-[#0D3B4F]">Nama lengkap</label>
                <div class="col-span-2 flex items-center gap-2">
                    <span class="hidden md:inline text-[#8B9C9A]">:</span>
                    <input type="text" name="nama" required class="w-full bg-[#F7FAF9] border border-[#E3EEEC] rounded-lg p-2.5 focus:outline-none focus:border-[#1C6E8C] transition">
                </div>
            </div>

            <!-- Alamat Email -->
            <div class="grid grid-cols-3 items-center">
                <label class="font-semibold text-[#0D3B4F]">Alamat email</label>
                <div class="col-span-2 flex items-center gap-2">
                    <span class="hidden md:inline text-[#8B9C9A]">:</span>
                    <input type="email" name="email" required class="w-full bg-[#F7FAF9] border border-[#E3EEEC] rounded-lg p-2.5 focus:outline-none focus:border-[#1C6E8C] transition">
                </div>
            </div>

            <!-- Nomor HP -->
            <div class="grid grid-cols-3 items-center">
                <label class="font-semibold text-[#0D3B4F]">Nomor HP</label>
                <div class="col-span-2 flex items-center gap-2">
                    <span class="hidden md:inline text-[#8B9C9A]">:</span>
                    <input
                    type="text"
                    name="no_hp"
                    required
                    class="w-full bg-[#F7FAF9] border border-[#E3EEEC] rounded-lg p-2.5 focus:outline-none focus:border-[#1C6E8C] transition">
                </div>
            </div>

            <!-- Tanggal -->
            <div class="grid grid-cols-3 items-center">
                <label class="font-semibold text-[#0D3B4F]">Tanggal</label>
                <div class="col-span-2 flex flex-col gap-2">
                    <div class="col-span-2 flex items-center gap-2">
                        <span class="hidden md:inline text-[#8B9C9A]">:</span>
                        <input type="date" name="tanggal_kunjungan" required class="w-full bg-[#F7FAF9] border border-[#E3EEEC] rounded-lg p-2.5 focus:outline-none focus:border-[#1C6E8C] transition">
                    </div>
                    @error('tanggal_kunjungan')
                        <div class="text-red-500 text-sm mt-1 pl-4">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Jumlah Tiket dengan tombol + dan - -->
            <div class="grid grid-cols-3 items-center">
                <label class="font-semibold text-[#0D3B4F]">Jumlah tiket</label>
                <div class="col-span-2 flex items-center gap-2">
                    <span class="hidden md:inline text-[#8B9C9A]">:</span>
                    <div class="flex items-center">
                        <button type="button" id="btn-minus" class="w-9 h-9 bg-[#EAF3F1] hover:bg-[#DCEAE7] text-[#0D3B4F] font-bold rounded-l-full flex items-center justify-center transition">-</button>
                        <input type="number" name="jumlah_tiket" id="num-people" value="1" min="1" readonly class="w-12 h-9 text-center bg-[#F7FAF9] border-y border-[#E3EEEC] font-semibold text-[#0D3B4F] focus:outline-none">
                        <button type="button" id="btn-plus" class="w-9 h-9 bg-[#EAF3F1] hover:bg-[#DCEAE7] text-[#0D3B4F] font-bold rounded-r-full flex items-center justify-center transition">+</button>
                    </div>
                </div>
            </div>

            <!-- Total yang Harus Dibayar (Dinamis Otomatis) -->
            <div class="pt-4 border-t border-dashed border-[#E3EEEC]">
                <p class="font-semibold text-[#0D3B4F]">
                    Total yang harus dibayar : <span class="text-[#3F7D52] text-lg font-bold font-display" id="total-display">Rp {{ number_format($destination->price ?? 10000, 0, ',', '.') }}</span>
                </p>
            </div>

            
            <!-- Tombol Kirim -->
            <div class="flex justify-end pt-4">
                <button type="submit" class="group/btn inline-flex items-center gap-2 bg-[#1C6E8C] text-white px-8 py-3 rounded-full hover:bg-[#0D3B4F] transition-colors duration-300 font-semibold tracking-wide">
                    Kirim
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="transition-transform duration-300 group-hover/btn:translate-x-1">
                        <path d="M5 12h14M13 6l6 6-6 6"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</main>
</div>

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