<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\PilihanMataKuliah;
use App\Models\Rekomendasi;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $fillable = [
        'nim',
        'nama',
        'program_studi',
        'angkatan',
        'email',
    ];

    // Relasi mahasiswa dengan akun user
    public function user()
    {
        return $this->hasOne(User::class, 'mahasiswa_id', 'id');
    }

    // Relasi mahasiswa dengan pilihan mata kuliah
    public function pilihanMataKuliah()
    {
        return $this->hasMany(
            PilihanMataKuliah::class,
            'mahasiswa_id',
            'id'
        );
    }

    // Relasi mahasiswa dengan hasil rekomendasi
    public function rekomendasi()
    {
        return $this->hasOne(
            Rekomendasi::class,
            'mahasiswa_id',
            'id'
        );
    }
}
