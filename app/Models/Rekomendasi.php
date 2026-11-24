<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekomendasi extends Model
{
    protected $table = 'rekomendasi';

    protected $fillable = [
        'mahasiswa_id',
        'ai_persen',
        'cyber_persen',
        'hasil',
        'detail',
    ];

    // Konversi kolom detail JSON menjadi array
    protected function casts(): array
    {
        return [
            'detail' => 'array',
        ];
    }

    // Relasi ke Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}