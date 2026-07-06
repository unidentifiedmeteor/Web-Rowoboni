<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'email',
        'whatsapp',
        'address',
        'description',
        'bank_name',
        'account_number',
        'account_name',
    ];
}