@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto px-6 py-12">

    {{-- Breadcrumb --}}
    <a href="{{ url('/') }}"
       class="inline-flex items-center gap-2 text-sm text-blue-600 hover:text-blue-800 transition mb-8">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali ke beranda
    </a>

    {{-- Header --}}
    <div class="text-center mb-8">
        <span class="inline-block text-xs font-semibold text-blue-600 bg-blue-50 border border-blue-100 px-3 py-1 rounded-full uppercase tracking-wide mb-3">
            {{ $destination->category }}
        </span>
        <h1 class="text-3xl font-bold text-blue-900 mb-3">{{ $destination->name }}</h1>
        <div class="flex items-center justify-center gap-4 text-sm text-gray-400">
            <span class="flex items-center gap-1">
                {{-- Ikon lokasi --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                {{ $destination->location }}
            </span>
            <span class="text-blue-200">|</span>
            <span class="text-green-600 font-semibold">
                {{ $destination->formattedPrice() }} <span class="text-gray-400 font-normal">/ orang</span>
            </span>
        </div>
    </div>

    {{-- Foto Utama --}}
    <div class="rounded-2xl overflow-hidden mb-10 border border-blue-100">
        <img src="{{ $destination->imageUrl() }}"
             alt="{{ $destination->name }}"
             class="w-full object-cover max-h-96">
    </div>

    {{-- Deskripsi --}}
    <div class="prose prose-blue max-w-none text-gray-600 leading-relaxed mb-12">
        {!! nl2br(e($destination->description)) !!}
    </div>

    {{-- CTA Pesan Tiket --}}
    <div class="border-t border-blue-100 pt-10 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div>
            <div class="text-sm text-gray-400">Harga tiket masuk</div>
            <div class="text-2xl font-bold text-green-600">
                {{ $destination->formattedPrice() }}
                <span class="text-sm font-normal text-gray-400">/ orang</span>
            </div>
        </div>
        <a href="{{ route('booking.create', ['destination' => $destination->id]) }}"
           class="bg-blue-600 text-white px-8 py-3 rounded-full font-semibold hover:bg-blue-700 transition text-sm">
            Pesan Tiket Sekarang →
        </a>
    </div>

</div>

@endsection