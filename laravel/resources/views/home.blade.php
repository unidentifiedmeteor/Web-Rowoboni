@extends('layouts.app')

@section('content')

{{-- SECTION 1: PROFIL DESA --}}
<section id="profil" class="py-20 px-6">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-12">
        <div class="w-full md:w-2/5">
            <img
            src="{{ asset('images/profil_desa.jpg.jpeg') }}"
            alt="Desa Wisata Rowoboni"
            class="w-full h-full object-cover rounded-3xl">
        </div>
        <div class="w-full md:w-3/5">
            <span class="inline-block text-xs font-semibold text-blue-600 bg-blue-50 border border-blue-100 px-3 py-1 rounded-full mb-4 tracking-wide uppercase">
                Kecamatan Banyubiru, Kab. Semarang
            </span>
            <h2 class="text-3xl font-bold text-blue-900 mb-4">Desa Wisata Rowoboni</h2>
            <p class="text-gray-500 leading-relaxed">
                Desa Rowoboni terletak di Kecamatan Banyubiru, Kabupaten Semarang, Jawa Tengah.
                Dikelilingi oleh pemandangan alam yang asri dan budaya lokal yang kaya,
                desa ini menawarkan pengalaman wisata yang autentik dan berkesan bagi setiap
                pengunjung. Nikmati keindahan alam, keramahan warga, serta berbagai destinasi
                wisata menarik yang siap menyambut Anda.
            </p>
            <div class="flex gap-8 mt-8">
                <div>
                    <div class="text-2xl font-bold text-blue-900">{{ $destinations->count() }}+</div>
                    <div class="text-xs text-gray-400 mt-1">Destinasi wisata</div>
                </div>
                <div class="w-px bg-blue-100"></div>
                <div>
                    <div class="text-2xl font-bold text-blue-900">Rawa Pening</div>
                    <div class="text-xs text-gray-400 mt-1">Keindahan alam utama</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 2: DESTINASI WISATA --}}
<section id="wisata" class="py-20 px-6 bg-blue-50">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-3xl font-bold text-blue-900 text-center mb-2">Destinasi Wisata</h2>
        <p class="text-center text-gray-400 text-sm mb-12">Temukan pengalaman terbaik di Desa Rowoboni</p>

        <div class="flex flex-col gap-5">
            @forelse($destinations as $destination)
            <div class="bg-white rounded-2xl border border-blue-100 flex flex-col md:flex-row overflow-hidden">
                <img src="{{ $destination->imageUrl() }}"
                     alt="{{ $destination->name }}"
                     class="w-full md:w-52 object-cover flex-shrink-0 min-h-40">
                <div class="p-6 flex flex-col justify-between flex-1">
                    <div>
                        <span class="inline-block text-xs font-semibold text-blue-600 bg-blue-50 border border-blue-100 px-3 py-1 rounded-full uppercase tracking-wide mb-3">
                            {{ $destination->category }}
                        </span>
                        <h3 class="text-lg font-bold text-blue-900 mb-2">{{ $destination->name }}</h3>
                        <p class="text-gray-500 text-sm leading-relaxed line-clamp-2">{{ $destination->description }}</p>
                    </div>
                    <div class="flex items-center justify-between mt-5">
                        <div>
                            <span class="text-green-600 font-bold text-base">{{ $destination->formattedPrice() }}</span>
                            <span class="text-gray-400 text-xs"> / orang</span>
                        </div>
                        <a href="{{ route('destinations.show', $destination) }}"
                           class="text-sm font-semibold text-blue-600 bg-blue-50 border border-blue-100 px-4 py-2 rounded-full hover:bg-blue-100 transition">
                            Lihat detail →
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center text-gray-400 py-16">
                Belum ada destinasi wisata tersedia.
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- SECTION 3: GALERI --}}
<section id="galeri" class="py-20 px-6">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-3xl font-bold text-blue-900 text-center mb-2">Galeri</h2>
        <p class="text-center text-gray-400 text-sm mb-12">Sekilas keindahan Desa Rowoboni</p>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @forelse($galeri as $foto)
            <div class="aspect-square overflow-hidden rounded-2xl">
                <img
                src="{{ asset($foto->file_media) }}"
                alt="Galeri"
                class="w-full h-full object-cover hover:scale-105 transition duration-500">
            </div>
            @empty
            {{-- Placeholder sementara sebelum ada data galeri --}}
            @for($i = 1; $i <= 6; $i++)
            <div class="aspect-square overflow-hidden rounded-2xl">
                <img src="https://placehold.co/400x400/dbeafe/93c5fd?text=Foto+{{ $i }}"
                     alt="Galeri {{ $i }}"
                     class="w-full h-full object-cover hover:scale-105 transition duration-500">
            </div>
            @endfor
            @endforelse
        </div>
    </div>
</section>

@endsection