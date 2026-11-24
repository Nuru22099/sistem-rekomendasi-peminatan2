<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\PilihanMataKuliah;
use App\Models\Rekomendasi;
use App\Services\RekomendasiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class MahasiswaController extends Controller
{
    private function profil()
    {
        return auth()->user()->mahasiswa;
    }

    public function dashboard()
    {
        $m = $this->profil();
        $hasil = Rekomendasi::where('mahasiswa_id', $m->id)->first();
        $jumlahPilihan = PilihanMataKuliah::where('mahasiswa_id', $m->id)->count();

        return view('mahasiswa.dashboard', compact('m', 'hasil', 'jumlahPilihan'));
    }

    public function form()
    {
        $m = $this->profil();
        $mataKuliah = MataKuliah::where('aktif', true)
            ->orderBy('semester')
            ->orderBy('nama')
            ->get();

        $terpilih = PilihanMataKuliah::where('mahasiswa_id', $m->id)
            ->pluck('mata_kuliah_id')
            ->all();

        return view('mahasiswa.penilaian', compact('m', 'mataKuliah', 'terpilih'));
    }

    public function simpan(Request $request, RekomendasiService $service)
    {
        $m = $this->profil();

        $data = $request->validate([
            'mata_kuliah_ids' => ['required', 'array', 'min:1'],
            'mata_kuliah_ids.*' => ['required', 'integer', 'distinct', 'exists:mata_kuliah,id'],
        ], [
            'mata_kuliah_ids.required' => 'Pilih minimal satu mata kuliah.',
            'mata_kuliah_ids.min' => 'Pilih minimal satu mata kuliah.',
            'mata_kuliah_ids.*.distinct' => 'Terdapat pilihan mata kuliah yang duplikat.',
        ]);

        $ids = array_map('intval', $data['mata_kuliah_ids']);
        $jumlahAktif = MataKuliah::where('aktif', true)->whereIn('id', $ids)->count();

        if ($jumlahAktif !== count($ids)) {
            throw ValidationException::withMessages([
                'mata_kuliah_ids' => 'Salah satu mata kuliah sudah tidak aktif. Muat ulang halaman dan pilih kembali.',
            ]);
        }

        DB::transaction(function () use ($m, $ids, $service) {
            PilihanMataKuliah::where('mahasiswa_id', $m->id)
                ->whereNotIn('mata_kuliah_id', $ids)
                ->delete();

            foreach ($ids as $id) {
                PilihanMataKuliah::updateOrCreate(
                    ['mahasiswa_id' => $m->id, 'mata_kuliah_id' => $id],
                    []
                );
            }

            // Menghitung ulang setiap kali mahasiswa menyimpan perubahan pilihan.
            $service->proses($m);
        });

        return redirect()
            ->route('mahasiswa.hasil')
            ->with('success', 'Pilihan mata kuliah berhasil disimpan dan rekomendasi telah dihitung ulang.');
    }

    public function hasil()
    {
        $m = $this->profil();
        $hasil = Rekomendasi::where('mahasiswa_id', $m->id)->first();

        return view('rekomendasi.hasil', compact('m', 'hasil'));
    }
}
