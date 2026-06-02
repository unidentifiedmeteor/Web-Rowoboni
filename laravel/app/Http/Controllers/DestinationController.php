<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    /**
     * Menampilkan daftar semua destinasi di halaman utama.
     */
    public function index()
    {
        // 1. Ambil semua data dari database
        $destinations = Destination::all();

        // 2. Kirim data ke file home.blade.php
        return view('home', compact('destinations'));
    }

    /**
     * Halaman detail destinasi wisata.
     */
    public function show(Destination $destination)
    {
        return view('destinations.show', compact('destination'));
    }
}
