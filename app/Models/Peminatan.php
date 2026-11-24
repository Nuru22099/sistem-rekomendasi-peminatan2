<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminatan extends Model
{
    protected $table = 'peminatan';

    protected $fillable = [
        'kode',
        'nama',
        'deskripsi',
        'warna',
    ];
}