<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri_wisata';

    protected $primaryKey = 'id_galeri';

    protected $fillable = [
        'file_media'
    ];
}