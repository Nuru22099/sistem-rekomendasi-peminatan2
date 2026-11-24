<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenilaianMataKuliah extends Model
{
    protected $table = 'penilaian_mata_kuliah';

    protected $fillable = [
        'mahasiswa_id',
        'mata_kuliah_id',
        'skor',
    ];

    // Relasi ke MataKuliah
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }

    // Relasi ke Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}