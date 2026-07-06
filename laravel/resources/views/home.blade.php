@extends('layouts.app')

@section('content')

@if(session('success'))

<div
    id="successNotification"
    class="fixed left-1/2 top-24 z-[9999] w-[90%] max-w-md
           -translate-x-1/2 -translate-y-10 opacity-0
           rounded-2xl border border-[#D3E6DA] bg-white p-5 shadow-xl
           transition-all duration-500 ease-out">

    <div class="flex items-start gap-4">

        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[#EAF3EC] text-[#3F7D52]">

            <i class="fa-solid fa-circle-check text-xl"></i>

        </div>

        <div class="flex-1">

            <h3 class="font-bold text-[#0D3B4F]">
                Bukti Pembayaran Berhasil Dikirim
            </h3>

            <p class="mt-1 text-sm leading-relaxed text-[#5B7480]">
                {{ session('success') }}
            </p>

        </div>

        <button
            type="button"
            onclick="tutupNotifikasi()"
            class="text-[#8B9C9A] transition hover:text-[#0D3B4F]">

            <i class="fa-solid fa-xmark"></i>

        </button>

    </div>


    {{-- PROGRESS BAR --}}
    <div class="absolute bottom-0 left-0 h-1 w-full overflow-hidden rounded-b-2xl">

        <div
            id="notificationProgress"
            class="h-full w-full origin-left bg-[#3F7D52]">
        </div>

    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const notification = document.getElementById('successNotification');

    const progress = document.getElementById('notificationProgress');


    // ANIMASI MASUK
    setTimeout(function () {

        notification.classList.remove(
            '-translate-y-10',
            'opacity-0'
        );

        notification.classList.add(
            'translate-y-0',
            'opacity-100'
        );

    }, 100);


    // ANIMASI PROGRESS BAR
    progress.style.transition = 'transform 5s linear';

    setTimeout(function () {

        progress.style.transform = 'scaleX(0)';

    }, 200);


    // HILANG OTOMATIS SETELAH 5 DETIK
    setTimeout(function () {

        tutupNotifikasi();

    }, 5200);

});


function tutupNotifikasi() {

    const notification = document.getElementById('successNotification');

    if (!notification) {
        return;
    }


    // ANIMASI KELUAR
    notification.classList.remove(
        'translate-y-0',
        'opacity-100'
    );

    notification.classList.add(
        '-translate-y-10',
        'opacity-0'
    );


    // HAPUS SETELAH ANIMASI SELESAI
    setTimeout(function () {

        notification.remove();

    }, 500);

}

</script>

@endif

@if(session('success'))

<script>
    setTimeout(function () {
        const notification = document.getElementById('successNotification');

        if (notification) {
            notification.style.opacity = '0';
            notification.style.transform = 'translate(-50%, -20px)';

            setTimeout(function () {
                notification.remove();
            }, 500);
        }
    }, 5000);
</script>

@endif

<div id="rowoboni-page">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

    #rowoboni-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    #rowoboni-page .font-display {
        font-family: 'Fraunces', serif;
    }
    #rowoboni-page .reveal {
        opacity: 0;
        transform: translateY(18px);
        transition: opacity .7s ease, transform .7s ease;
    }
    #rowoboni-page .reveal.is-visible {
        opacity: 1;
        transform: translateY(0);
    }
    @media (prefers-reduced-motion: reduce) {
        #rowoboni-page .reveal {
            opacity: 1;
            transform: none;
            transition: none;
        }
    }
</style>

{{-- SECTION 1: PROFIL DESA --}}
<section id="profil" class="relative py-20 md:py-28 px-6 bg-white overflow-hidden">
    <div class="absolute -top-24 -left-24 w-72 h-72 bg-[#1C6E8C]/5 rounded-full blur-3xl" aria-hidden="true"></div>
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-[#4C7A3D]/5 rounded-full blur-3xl" aria-hidden="true"></div>

    <div class="relative max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-16">
        <div class="w-full md:w-2/5 reveal">
            <div class="relative">
                <div class="aspect-[4/5] overflow-hidden rounded-[63%_37%_41%_59%/50%_45%_55%_50%] shadow-xl shadow-[#0D3B4F]/10">
                    <img src="https://placehold.co/480x600/dbeafe/93c5fd?text=Foto+Desa"
                         alt="Foto Desa Rowoboni"
                         class="w-full h-full object-cover">
                </div>
                <div class="absolute -bottom-6 -right-4 md:-right-8 bg-white rounded-2xl shadow-lg px-5 py-3.5 border border-[#E3EEEC] flex items-center gap-2.5">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1C6E8C" stroke-width="2" stroke-linecap="round" class="flex-shrink-0">
                        <path d="M2 17c2-2 4-2 6 0s4 2 6 0 4-2 6 0"/>
                        <path d="M2 12c2-2 4-2 6 0s4 2 6 0 4-2 6 0"/>
                    </svg>
                    <span class="text-xs font-semibold text-[#0D3B4F] whitespace-nowrap">Tepi Rawa Pening</span>
                </div>
            </div>
        </div>
        <div class="w-full md:w-3/5 reveal">
            <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#0D3B4F] bg-[#E7F1EF] border border-[#CFE3DF] px-3 py-1 rounded-full mb-5 tracking-wide uppercase">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="3"/>
                    <circle cx="12" cy="12" r="8" stroke-opacity="0.5"/>
                </svg>
                Kecamatan Banyubiru, Kab. Semarang
            </span>
            <h2 class="font-display text-4xl md:text-5xl font-semibold text-[#0D3B4F] mb-5 leading-tight">Desa Wisata Rowoboni</h2>
            <p class="text-[#5B7480] leading-8">
                {{ $setting->description ?? 'Deskripsi Desa Wisata Rowoboni belum tersedia.' }}
            </p>
            <div class="flex items-center gap-8 mt-8 pt-6 border-t border-[#E3EEEC]">
                <div>
                    <div class="font-display text-3xl font-semibold text-[#0D3B4F]">{{ $destinations->count() }}+</div>
                    <div class="text-xs text-[#6B7F80] mt-1">Destinasi wisata</div>
                </div>
                <div class="w-px h-10 bg-[#E3EEEC]"></div>
                <div>
                    <div class="font-display text-3xl font-semibold text-[#0D3B4F]">Rawa Pening</div>
                    <div class="text-xs text-[#6B7F80] mt-1">Keindahan alam utama</div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="bg-white" aria-hidden="true">
    <svg viewBox="0 0 1440 100" preserveAspectRatio="none" class="w-full h-14 md:h-20 block" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,40 C240,90 480,0 720,35 C960,70 1200,15 1440,45 L1440,100 L0,100 Z" fill="#F0F6F4"></path>
    </svg>
</div>

{{-- SECTION 2: DESTINASI WISATA --}}
<section id="wisata" class="py-20 px-6 bg-[#F0F6F4]">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-14 reveal">
            <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#1C6E8C] bg-white border border-[#CFE3DF] px-3 py-1 rounded-full uppercase tracking-wide mb-4">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="3"/>
                    <circle cx="12" cy="12" r="8" stroke-opacity="0.5"/>
                </svg>
                Jelajahi Rowoboni
            </span>
            <h2 class="font-display text-3xl md:text-4xl font-semibold text-[#0D3B4F] mb-3">Destinasi Wisata</h2>
            <p class="text-[#5B7480] text-sm max-w-md mx-auto">Temukan pengalaman terbaik di Desa Rowoboni</p>
        </div>

        <div class="flex flex-col gap-5">
            @forelse($destinations as $destination)
            <div class="group reveal bg-white rounded-3xl border border-[#E3EEEC] flex flex-col md:flex-row overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_24px_48px_-28px_rgba(13,59,79,0.28)] hover:border-[#BFE0DB]">
                <div class="w-full md:w-56 h-48 md:h-auto overflow-hidden flex-shrink-0">
                    <img src="{{ $destination->imageUrl() }}"
                         alt="{{ $destination->name }}"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                </div>
                <div class="p-6 flex flex-col justify-between flex-1">
                    <div>
                        <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold text-[#2F5D45] bg-[#EAF3EC] border border-[#D3E6DA] px-3 py-1 rounded-full uppercase tracking-wide mb-3">
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="3"/>
                                <circle cx="12" cy="12" r="8" stroke-opacity="0.5"/>
                            </svg>
                            {{ $destination->category }}
                        </span>
                        <h3 class="font-display text-xl font-semibold text-[#0D3B4F] mb-2">{{ $destination->name }}</h3>
                        <p class="text-[#5B7480] text-sm leading-relaxed line-clamp-2">{{ $destination->description }}</p>
                    </div>
                    <div class="flex items-center justify-between mt-5 pt-4 border-t border-[#EEF4F2]">
                        <div>
                            <span class="text-[#3F7D52] font-bold text-base font-display">{{ $destination->formattedPrice() }}</span>
                            <span class="text-[#8B9C9A] text-xs"> / orang</span>
                        </div>
                        <a href="{{ route('destinations.show', $destination) }}"
                           class="group/btn inline-flex items-center gap-1.5 text-sm font-semibold text-white bg-[#1C6E8C] hover:bg-[#0D3B4F] px-4 py-2.5 rounded-full transition-colors duration-300">
                            Lihat detail
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="transition-transform duration-300 group-hover/btn:translate-x-1">
                                <path d="M5 12h14M13 6l6 6-6 6"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="reveal text-center py-20 px-6 bg-white rounded-3xl border border-dashed border-[#CFE3DF]">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#9FC2BC" stroke-width="1.5" class="mx-auto mb-4">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M16 8l-3 7-2-2-3 7"/>
                </svg>
                <p class="text-[#5B7480] font-medium">Belum ada destinasi wisata tersedia.</p>
                <p class="text-[#8B9C9A] text-sm mt-1">Nantikan destinasi baru segera hadir.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<div class="bg-[#F0F6F4]" aria-hidden="true">
    <svg viewBox="0 0 1440 100" preserveAspectRatio="none" class="w-full h-14 md:h-20 block" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,45 C240,10 480,80 720,42 C960,5 1200,75 1440,38 L1440,100 L0,100 Z" fill="#FFFFFF"></path>
    </svg>
</div>

{{-- SECTION 3: GALERI --}}
<section id="galeri" class="py-20 px-6 bg-white">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-12 reveal">
            <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#1C6E8C] bg-[#F0F6F4] border border-[#CFE3DF] px-3 py-1 rounded-full uppercase tracking-wide mb-4">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="3"/>
                    <circle cx="12" cy="12" r="8" stroke-opacity="0.5"/>
                </svg>
                Momen di Rowoboni
            </span>
            <h2 class="font-display text-3xl md:text-4xl font-semibold text-[#0D3B4F] mb-3">Galeri</h2>
            <p class="text-[#5B7480] text-sm max-w-md mx-auto">Sekilas keindahan Desa Rowoboni</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 auto-rows-[140px] md:auto-rows-[170px]">
            @forelse($galeri as $foto)

    <div class="group relative overflow-hidden rounded-2xl reveal
        {{ $loop->index % 5 == 0 ? 'col-span-2 row-span-2' : '' }}">

        <img
            src="{{ asset($foto->file_media) }}"
            alt="Galeri Desa Rowoboni"
            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

        <div class="absolute inset-0 bg-gradient-to-t from-[#0D3B4F]/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
        </div>

    </div>

@empty

    <div class="col-span-2 md:col-span-4 py-12 text-center">

        <p class="text-[#5B7480]">
            Belum ada foto galeri.
        </p>

    </div>

@endforelse
        </div>
    </div>
</section>

</div>

<script>
(function () {
    var reveals = document.querySelectorAll('#rowoboni-page .reveal');
    reveals.forEach(function (el, i) {
        el.style.transitionDelay = (i % 6) * 70 + 'ms';
    });
    if ('IntersectionObserver' in window) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });
        reveals.forEach(function (el) { io.observe(el); });
    } else {
        reveals.forEach(function (el) { el.classList.add('is-visible'); });
    }
})();
</script>

@endsection