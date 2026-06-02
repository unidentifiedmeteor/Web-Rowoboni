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

Route::get('/booking/create', function() {
    return 'Halaman booking form belum!';
})->name('booking.create');