@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#F0F6F4] px-6 py-12">

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <div class="mx-auto max-w-4xl">

        {{-- HEADER --}}
        <div class="mb-8 text-center">

            <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-2xl bg-[#1C6E8C] text-white shadow-lg">

                <i class="fa-solid fa-credit-card text-2xl"></i>

            </div>

            <h1 class="text-3xl font-bold text-[#0D3B4F]">
                Pembayaran Booking
            </h1>

            <p class="mt-2 text-[#5B7480]">
                Selesaikan pembayaran dan upload bukti transfer.
            </p>

        </div>


        {{-- CONTENT --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">


            {{-- DETAIL BOOKING --}}
            <div class="rounded-2xl border border-[#E3EEEC] bg-white p-6 shadow-sm">

                <h2 class="mb-6 text-lg font-bold text-[#0D3B4F]">
                    Detail Booking
                </h2>


                <div class="space-y-5">


                    {{-- NAMA --}}
                    <div>

                        <p class="text-xs text-[#8B9C9A]">
                            Nama Pemesan
                        </p>

                        <p class="mt-1 font-semibold text-[#16323D]">
                            {{ $booking->nama }}
                        </p>

                    </div>


                    {{-- DESTINASI --}}
                    <div>

                        <p class="text-xs text-[#8B9C9A]">
                            Destinasi Wisata
                        </p>

                        <p class="mt-1 font-semibold text-[#16323D]">
                            {{ $booking->destination->name }}
                        </p>

                    </div>


                    {{-- JUMLAH TIKET --}}
                    <div>

                        <p class="text-xs text-[#8B9C9A]">
                            Jumlah Tiket
                        </p>

                        <p class="mt-1 font-semibold text-[#16323D]">
                            {{ $booking->jumlah_tiket }} Tiket
                        </p>

                    </div>


                    {{-- TANGGAL --}}
                    <div>

                        <p class="text-xs text-[#8B9C9A]">
                            Tanggal Kunjungan
                        </p>

                        <p class="mt-1 font-semibold text-[#16323D]">
                            {{ $booking->tanggal_kunjungan }}
                        </p>

                    </div>


                    <hr class="border-[#E3EEEC]">


                    {{-- TOTAL --}}
                    <div>

                        <p class="text-sm text-[#5B7480]">
                            Total Pembayaran
                        </p>

                        <p class="mt-1 text-3xl font-bold text-[#3F7D52]">

                            Rp {{ number_format(
                                $booking->total_harga,
                                0,
                                ',',
                                '.'
                            ) }}

                        </p>

                    </div>

                </div>

            </div>



            {{-- PEMBAYARAN --}}
            <div class="rounded-2xl border border-[#E3EEEC] bg-white p-6 shadow-sm">

                <h2 class="text-lg font-bold text-[#0D3B4F]">
                    Upload Bukti Transfer
                </h2>

                <p class="mt-2 text-sm leading-relaxed text-[#5B7480]">
                    Silakan lakukan pembayaran sesuai total booking,
                    kemudian upload screenshot bukti transfer.
                </p>



                {{-- INFORMASI REKENING --}}
                <div class="mt-5 rounded-xl border border-[#D3E6DA] bg-[#EAF3EC] p-4">

                    <p class="mb-4 font-semibold text-[#0D3B4F]">
                        Informasi Pembayaran
                    </p>


                    <div class="space-y-3 text-sm">


                        <div class="flex justify-between gap-4">

                            <span class="text-[#5B7480]">
                                Bank
                            </span>

                             <span class="font-semibold uppercase text-[#16323D]">
                                {{ $setting->bank_name ?? '-' }}
                            </span>

                        </div>


                        <div class="flex justify-between gap-4">

                            <span class="text-[#5B7480]">
                                Nomor Rekening
                            </span>

                            <span class="font-semibold text-[#16323D]">
                                {{ $setting->account_number ?? '-' }}
                            </span>

                        </div>


                        <div class="flex justify-between gap-4">

                            <span class="text-right font-semibold text-[#16323D]">
                                {{ $setting->account_name?? '-' }}
                            </span>

                            <span class="text-right font-semibold text-[#16323D]">
                                Kas Desa Wisata Rowoboni
                            </span>

                        </div>

                    </div>

                </div>



                {{-- FORM UPLOAD --}}
                <form
                    action="/booking/payment/{{ $booking->id_booking }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="mt-5">

                    @csrf


                    {{-- UPLOAD BOX --}}
                   <label
    for="bukti_transfer"
    class="relative flex cursor-pointer flex-col items-center justify-center overflow-hidden rounded-2xl border-2 border-dashed border-[#CFE3DF] bg-[#F0F6F4] px-6 py-8 transition hover:border-[#1C6E8C] hover:bg-[#EAF3EC]">

    {{-- TAMPILAN SEBELUM PILIH GAMBAR --}}
    <div id="uploadPlaceholder" class="flex flex-col items-center">

        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-[#EAF3EC] text-[#1C6E8C]">

            <i class="fa-solid fa-cloud-arrow-up text-2xl"></i>

        </div>

        <p class="font-semibold text-[#16323D]">
            Pilih Screenshot Pembayaran
        </p>

        <p class="mt-2 text-xs text-[#8B9C9A]">
            JPG, JPEG, PNG atau WEBP
        </p>

    </div>


    {{-- PREVIEW GAMBAR --}}
    <div id="previewContainer" class="hidden w-full">

        <img
            id="previewGambar"
            src=""
            alt="Preview Bukti Transfer"
            class="mx-auto max-h-64 w-full rounded-xl object-contain">

        <p class="mt-3 text-center text-sm font-semibold text-[#1C6E8C]">
            Klik gambar untuk mengganti screenshot
        </p>

    </div>


    <input
        id="bukti_transfer"
        type="file"
        name="bukti_transfer"
        accept=".jpg,.jpeg,.png,.webp"
        required
        class="hidden">

</label>


                    {{-- ERROR --}}
                    @error('bukti_transfer')

                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>

                    @enderror



                    {{-- BUTTON --}}
                    <button
                        type="submit"
                        class="mt-5 flex w-full items-center justify-center gap-2 rounded-xl bg-[#1C6E8C] px-6 py-3 font-semibold text-white transition hover:bg-[#0D3B4F]">

                        <i class="fa-solid fa-paper-plane"></i>

                        Kirim Bukti Pembayaran

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>
<script>

const inputBukti = document.getElementById('bukti_transfer');
const previewGambar = document.getElementById('previewGambar');
const previewContainer = document.getElementById('previewContainer');
const uploadPlaceholder = document.getElementById('uploadPlaceholder');


inputBukti.addEventListener('change', function(event) {

    const file = event.target.files[0];

    if (file) {

        const reader = new FileReader();

        reader.onload = function(e) {

            previewGambar.src = e.target.result;

            uploadPlaceholder.classList.add('hidden');

            previewContainer.classList.remove('hidden');

        };

        reader.readAsDataURL(file);

    }

});

</script>

@endsection
