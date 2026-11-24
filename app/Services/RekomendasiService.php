<?php

namespace App\Services;

use App\Models\Mahasiswa;
use App\Models\PilihanMataKuliah;
use App\Models\Rekomendasi;
use RuntimeException;

class RekomendasiService
{
    /**
     * Rekomendasi berdasarkan jumlah mata kuliah yang dipilih.
     * Tidak menggunakan bobot, SKS, IPS, IPK, atau nilai mahasiswa.
     */
    public function proses(Mahasiswa $mahasiswa): Rekomendasi
    {
        $pilihan = PilihanMataKuliah::with('mataKuliah')
            ->where('mahasiswa_id', $mahasiswa->id)
            ->whereHas('mataKuliah', function ($query) {
                $query->where('aktif', true);
            })
            ->get();

        if ($pilihan->isEmpty()) {
            throw new RuntimeException(
                'Pilih minimal satu mata kuliah sebelum memproses rekomendasi.'
            );
        }

        $jumlahAi = 0;
        $jumlahCyber = 0;
        $detail = [];

        foreach ($pilihan as $item) {
            $mk = $item->mataKuliah;

            if (!$mk) {
                continue;
            }

            // Penanda kategori, bukan bobot.
            $relevanAi = (int) $mk->bobot_ai === 1;
            $relevanCyber = (int) $mk->bobot_cyber === 1;

            if ($relevanAi) {
                $jumlahAi++;
            }

            if ($relevanCyber) {
                $jumlahCyber++;
            }

            $kategori = [];

            if ($relevanAi) {
                $kategori[] = 'Artificial Intelligence';
            }

            if ($relevanCyber) {
                $kategori[] = 'Cyber Security';
            }

            if (empty($kategori)) {
                $kategori[] = 'Tidak termasuk kedua peminatan';
            }

            $detail[] = [
                'mata_kuliah_id' => $mk->id,
                'mata_kuliah' => $mk->nama,
                'kategori' => $kategori,
            ];
        }

        $totalKecocokan = $jumlahAi + $jumlahCyber;

        if ($totalKecocokan === 0) {
            $aiPersen = 0;
            $cyberPersen = 0;
            $hasil = 'Belum Dapat Direkomendasikan';
        } else {
            $aiPersen = round(
                ($jumlahAi / $totalKecocokan) * 100,
                2
            );

            $cyberPersen = round(
                ($jumlahCyber / $totalKecocokan) * 100,
                2
            );

            if ($jumlahAi > $jumlahCyber) {
                $hasil = 'Artificial Intelligence';
            } elseif ($jumlahCyber > $jumlahAi) {
                $hasil = 'Cyber Security';
            } else {
                $hasil = 'Rekomendasi Seimbang';
            }
        }

        return Rekomendasi::updateOrCreate(
            ['mahasiswa_id' => $mahasiswa->id],
            [
                'ai_persen' => $aiPersen,
                'cyber_persen' => $cyberPersen,
                'hasil' => $hasil,
                'detail' => [
                    'jumlah_ai' => $jumlahAi,
                    'jumlah_cyber' => $jumlahCyber,
                    'total_kecocokan' => $totalKecocokan,
                    'mata_kuliah' => $detail,
                ],
            ]
        );
    }
}
