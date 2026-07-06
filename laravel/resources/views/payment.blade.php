<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Pembayaran Booking</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>


<body class="min-h-screen bg-slate-100">

<div class="mx-auto max-w-4xl px-6 py-12">


    {{-- HEADER --}}

    <div class="mb-8 text-center">

        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-600 text-white shadow-lg">

            <i class="fa-solid fa-credit-card text-2xl"></i>

        </div>

        <h1 class="mt-5 text-3xl font-bold text-slate-800">

            Pembayaran Booking

        </h1>

        <p class="mt-2 text-slate-500">

            Selesaikan pembayaran dan upload bukti transfer.

        </p>

    </div>


    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">


        {{-- DETAIL BOOKING --}}

        <div class="rounded-2xl bg-white p-6 shadow-sm">

            <h2 class="text-lg font-bold text-slate-800">

                Detail Booking

            </h2>


            <div class="mt-6 space-y-5">


                <div>

                    <p class="text-xs text-slate-400">
                        Nama Pemesan
                    </p>

                    <p class="mt-1 font-semibold text-slate-700">

                        {{ $booking->nama }}

                    </p>

                </div>


                <div>

                    <p class="text-xs text-slate-400">
                        Destinasi Wisata
                    </p>

                    <p class="mt-1 font-semibold text-slate-700">

                        {{ $booking->destination->name }}

                    </p>

                </div>


                <div>

                    <p class="text-xs text-slate-400">
                        Jumlah Tiket
                    </p>

                    <p class="mt-1 font-semibold text-slate-700">

                        {{ $booking->jumlah_tiket }} Tiket

                    </p>

                </div>


                <div>

                    <p class="text-xs text-slate-400">
                        Tanggal Kunjungan
                    </p>

                    <p class="mt-1 font-semibold text-slate-700">

                        {{ $booking->tanggal_kunjungan }}

                    </p>

                </div>


                <div class="border-t border-slate-100 pt-5">

                    <p class="text-sm text-slate-500">

                        Total Pembayaran

                    </p>

                    <p class="mt-1 text-3xl font-bold text-blue-600">

                        Rp {{ number_format($booking->total_harga, 0, ',', '.') }}

                    </p>

                </div>


            </div>

        </div>



        {{-- UPLOAD PEMBAYARAN --}}

        <div class="rounded-2xl bg-white p-6 shadow-sm">


            <h2 class="text-lg font-bold text-slate-800">

                Upload Bukti Transfer

            </h2>


            <p class="mt-2 text-sm leading-relaxed text-slate-500">

                Silakan lakukan pembayaran sesuai total booking,
                kemudian upload screenshot bukti transfer.

            </p>


            <form
                action="/booking/payment/{{ $booking->id_booking }}/upload"
                method="POST"
                enctype="multipart/form-data"
                class="mt-6">

                @csrf


                <label
                    for="bukti_transfer"
                    class="flex min-h-56 cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50 p-6 text-center transition hover:border-blue-500 hover:bg-blue-50">


                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-blue-600">

                        <i class="fa-solid fa-cloud-arrow-up text-2xl"></i>

                    </div>


                    <p class="mt-4 font-semibold text-slate-700">

                        Pilih Screenshot Pembayaran

                    </p>


                    <p class="mt-2 text-xs text-slate-400">

                        JPG, JPEG, PNG atau WEBP

                    </p>


                    <input
                        type="file"
                        id="bukti_transfer"
                        name="bukti_transfer"
                        accept="image/*"
                        class="hidden"
                        required>

                </label>


                @error('bukti_transfer')

                    <p class="mt-2 text-sm text-red-500">

                        {{ $message }}

                    </p>

                @enderror


                <button
                    type="submit"
                    class="mt-6 flex w-full items-center justify-center gap-2 rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white transition hover:bg-blue-700">

                    <i class="fa-solid fa-paper-plane"></i>

                    Kirim Bukti Pembayaran

                </button>


            </form>

        </div>


    </div>

</div>

</body>

</html>