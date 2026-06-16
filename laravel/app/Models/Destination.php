<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category',
        'description',
        'price',
        'location',
        'image',
    ];

    protected $casts = [
        'price' => 'integer',
    ];

    /**
     * Format harga ke Rupiah.
     */
    public function formattedPrice(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * URL gambar — fallback ke placeholder kalau kosong.
     */
    public function imageUrl(): string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return 'https://placehold.co/800x500/dbeafe/93c5fd?text=' . urlencode($this->name);
    }
}