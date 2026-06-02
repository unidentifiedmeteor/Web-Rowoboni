<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DestinationController;
use App\Models\Destination;

// Home — kirim semua destinasi ke view
Route::get('/', function () {
    $destinations = Destination::all();
    return view('home', compact('destinations'));
});
 
// Detail destinasi
Route::get('/destinations/{destination}', [DestinationController::class, 'show'])
    ->name('destinations.show');

// Rute front-end sementara untuk menampilkan form booking baru
Route::get('/booking/create', function (\Illuminate\Http\Request $request) { // ✨ Ditambahkan \Illuminate\Http\ di depan Request
    
    // Mengambil data destinasi berdasarkan parameter ?destination=id di URL
    $destination = \App\Models\Destination::find($request->query('destination')) ?? \App\Models\Destination::first();
    
    // Membuka form booking sambil mengirimkan data destinasinya
    return view('booking', compact('destination'));
})->name('booking.create');
