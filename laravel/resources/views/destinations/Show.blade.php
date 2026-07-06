@extends('layouts.app')

@section('content')

<div id="destination-detail-page">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

    #destination-detail-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    #destination-detail-page .font-display {
        font-family: 'Fraunces', serif;
    }
</style>

<div class="max-w-3xl mx-auto px-6 py-16">

    {{-- Breadcrumb --}}
    <a href="{{ url('/') }}"
       class="inline-flex items-center gap-2 text-sm font-semibold text-[#1C6E8C] hover:text-[#0D3B4F] transition mb-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali ke beranda
    </a>

    {{-- Header --}}
    <div class="text-center mb-10">
        <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold text-[#2F5D45] bg-[#EAF3EC] border border-[#D3E6DA] px-3 py-1 rounded-full uppercase tracking-wide mb-4">
            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="3"/>
                <circle cx="12" cy="12" r="8" stroke-opacity="0.5"/>
            </svg>
            {{ $destination->category }}
        </span>
        <h1 class="font-display text-3xl md:text-4xl font-semibold text-[#0D3B4F] mb-4 leading-tight">{{ $destination->name }}</h1>
        <div class="flex items-center justify-center gap-4 text-sm text-[#5B7480]">
            <span class="flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#1C6E8C]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                {{ $destination->location }}
            </span>
            <span class="text-[#CFE3DF]">|</span>
            <span class="text-[#3F7D52] font-bold font-display">
                {{ $destination->formattedPrice() }} <span class="text-[#8B9C9A] font-normal font-sans text-xs">/ orang</span>
            </span>
        </div>
    </div>

    {{-- Foto Utama --}}
    <div class="rounded-3xl overflow-hidden mb-12 border border-[#E3EEEC] shadow-xl shadow-[#0D3B4F]/10">
        <img src="{{ $destination->imageUrl() }}"
             alt="{{ $destination->name }}"
             class="w-full object-cover max-h-96">
    </div>

    {{-- Deskripsi --}}
    <div class="prose max-w-none text-[#5B7480] leading-relaxed mb-14">
        {!! nl2br(e($destination->description)) !!}
    </div>

    {{-- CTA Pesan Tiket --}}
    <div class="border-t border-[#E3EEEC] pt-10 flex flex-col sm:flex-row items-center justify-between gap-5">
        <div>
            <div class="text-xs text-[#6B7F80] uppercase tracking-wide font-semibold mb-1">Harga tiket masuk</div>
            <div class="text-2xl font-bold font-display text-[#3F7D52]">
                {{ $destination->formattedPrice() }}
                <span class="text-sm font-normal font-sans text-[#8B9C9A]">/ orang</span>
            </div>
        </div>
        <a href="{{ route('booking.create', ['destination' => $destination->id]) }}"
           class="group/btn inline-flex items-center gap-2 bg-[#1C6E8C] text-white px-8 py-3.5 rounded-full font-semibold hover:bg-[#0D3B4F] transition-colors duration-300 text-sm">
            Pesan Tiket Sekarang
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="transition-transform duration-300 group-hover/btn:translate-x-1">
                <path d="M5 12h14M13 6l6 6-6 6"/>
            </svg>
        </a>
    </div>

</div>
</div>

@endsection