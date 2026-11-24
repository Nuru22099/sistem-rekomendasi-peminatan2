<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // TABEL MAHASISWA
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 20)->unique();
            $table->string('nama');
            $table->string('program_studi')
                ->default('Teknik Informatika');
            $table->unsignedSmallInteger('angkatan')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });

        // MENAMBAHKAN ROLE DAN RELASI MAHASISWA PADA USERS
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'mahasiswa'])
                ->default('mahasiswa');

            $table->foreignId('mahasiswa_id')
                ->nullable()
                ->unique()
                ->constrained('mahasiswa')
                ->nullOnDelete();
        });

        // TABEL MATA KULIAH
        Schema::create('mata_kuliah', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 20)->unique();
            $table->string('nama');
            $table->string('nama_inggris')->nullable();
            $table->unsignedTinyInteger('semester')->default(1);
            $table->unsignedTinyInteger('sks');
            $table->text('deskripsi')->nullable();
            $table->decimal('bobot_ai', 4, 2)->default(0.5);
            $table->decimal('bobot_cyber', 4, 2)->default(0.5);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });

        // TABEL PEMINATAN
        Schema::create('peminatan', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('warna', 20)->nullable();
            $table->timestamps();
        });

        // TABEL PENILAIAN MATA KULIAH (TIDAK DIGUNAKAN UNTUK REKOMENDASI)
        Schema::create('penilaian_mata_kuliah', function (Blueprint $table) {
            $table->id();

            $table->foreignId('mahasiswa_id')
                ->constrained('mahasiswa')
                ->cascadeOnDelete();

            $table->foreignId('mata_kuliah_id')
                ->constrained('mata_kuliah')
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('skor');
            $table->timestamps();

            $table->unique(['mahasiswa_id', 'mata_kuliah_id']);
        });

        // TABEL REKOMENDASI
        Schema::create('rekomendasi', function (Blueprint $table) {
            $table->id();

            $table->foreignId('mahasiswa_id')
                ->unique()
                ->constrained('mahasiswa')
                ->cascadeOnDelete();

            $table->decimal('ai_persen', 5, 2);
            $table->decimal('cyber_persen', 5, 2);
            $table->string('hasil');
            $table->json('detail')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['mahasiswa_id']);
            $table->dropUnique(['mahasiswa_id']);
            $table->dropColumn(['mahasiswa_id', 'role']);
        });

        Schema::dropIfExists('rekomendasi');
        Schema::dropIfExists('penilaian_mata_kuliah');
        Schema::dropIfExists('peminatan');
        Schema::dropIfExists('mata_kuliah');
        Schema::dropIfExists('mahasiswa');
    }
};