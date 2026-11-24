<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PilihanMataKuliah extends Model
{
    protected $table = 'pilihan_mata_kuliah';

    protected $fillable = [
        'mahasiswa_id',
        'mata_kuliah_id',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }
}
