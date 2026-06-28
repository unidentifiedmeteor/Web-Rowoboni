<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booking';

    protected $primaryKey = 'id_booking';

    protected $fillable = [

        'destination_id',

        'nama',

        'email',

        'no_hp',

        'jumlah_tiket',

        'tanggal_kunjungan',

        'total_harga',

        'status'
    ];

    public function destination()
    {
        return $this->belongsTo(
            Destination::class,
            'destination_id'
        );
    }
}