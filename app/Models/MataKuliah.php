<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';

    protected $fillable = [
        'kode', 'nama', 'nama_inggris', 'semester', 'sks',
        'deskripsi', 'bobot_ai', 'bobot_cyber', 'aktif',
    ];

    protected function casts(): array
    {
        return [
            'aktif' => 'boolean',
            'bobot_ai' => 'decimal:2',
            'bobot_cyber' => 'decimal:2',
        ];
    }

    public function pilihanMahasiswa()
    {
        return $this->hasMany(PilihanMataKuliah::class);
    }
}
