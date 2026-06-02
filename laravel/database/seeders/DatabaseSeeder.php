<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Pastikan kode pengisian data ini berada tepat di dalam fungsi run()
        Destination::create([
            'name' => 'Dermaga Asri Rowoboni',
            'slug' => 'dermaga-asri-rowoboni',
            'category' => 'Wisata Alam',
            'description' => 'Nikmati pemandangan indah langsung menghadap Rawa Pening.',
            'price' => 10000,
            'location' => 'Kecamatan Banyubiru, Kab. Semarang',
            'image' => null,
        ]);

        Destination::create([
            'name' => 'Kuliner Olahan Ikan Rowoboni',
            'slug' => 'kuliner-olahan-ikan-rowoboni',
            'category' => 'Kuliner',
            'description' => 'Sajian kuliner khas ikan segar.',
            'price' => 25000,
            'location' => 'Kecamatan Banyubiru, Kab. Semarang',
            'image' => null,
        ]);
    }
}
