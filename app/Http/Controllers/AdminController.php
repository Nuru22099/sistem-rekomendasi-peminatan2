<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\Peminatan;
use App\Models\Rekomendasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    
    // DASHBOARD ADMIN

    public function dashboard()
    {
        $jumlahMahasiswa = Mahasiswa::count();
        $jumlahMk = MataKuliah::where('aktif', true)->count();
        $jumlahPeminatan = Peminatan::count();
        $jumlahRekomendasi = Rekomendasi::count();

        $aktivitas = Rekomendasi::with('mahasiswa')
            ->latest()
            ->take(6)
            ->get();

        $jumlahAi = Rekomendasi::where(
            'hasil',
            'Artificial Intelligence'
        )->count();

        $jumlahCyber = Rekomendasi::where(
            'hasil',
            'Cyber Security'
        )->count();

        $totalHasil = $jumlahAi + $jumlahCyber;

        $persenAi = $totalHasil > 0
            ? round(($jumlahAi / $totalHasil) * 100, 1)
            : 0;

        $persenCyber = $totalHasil > 0
            ? round(($jumlahCyber / $totalHasil) * 100, 1)
            : 0;

        return view('admin.dashboard', compact(
            'jumlahMahasiswa',
            'jumlahMk',
            'jumlahPeminatan',
            'jumlahRekomendasi',
            'aktivitas',
            'jumlahAi',
            'jumlahCyber',
            'persenAi',
            'persenCyber'
        ));
    }

    // DATA MAHASISWA

    public function mahasiswa()
    {
        $data = Mahasiswa::with('user')->latest()->paginate(15);

        return view('admin.mahasiswa', compact('data'));
    }

    // TAMBAH MAHASISWA

    public function simpanMahasiswa(Request $request)
    {
        $data = $request->validate([
            'nim' => 'required|unique:mahasiswa,nim',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'angkatan' => 'nullable|integer',
        ]);

        DB::transaction(function () use ($data) {

            $mahasiswa = Mahasiswa::create([
                'nim' => $data['nim'],
                'nama' => $data['nama'],
                'email' => $data['email'],
                'angkatan' => $data['angkatan'] ?? date('Y'),
            ]);

            User::create([
                'name' => $mahasiswa->nama,
                'email' => $data['email'],
                'password' => Hash::make($mahasiswa->nim),
                'role' => 'mahasiswa',
                'mahasiswa_id' => $mahasiswa->id,
            ]);
        });

        return back()->with(
            'success',
            'Mahasiswa dan akun berhasil ditambahkan. Kata sandi awal menggunakan NIM.'
        );
    }

    // EDIT MAHASISWA

    public function updateMahasiswa(Request $request, Mahasiswa $mahasiswa)
    {
        // Ambil akun yang terhubung dengan mahasiswa
        $user = $mahasiswa->user;

        $userId = $user?->id;

        $emailRule = 'required|email|unique:users,email';

        if ($userId) {
            $emailRule .= ',' . $userId;
        }

        $data = $request->validate([
            'nim' => 'required|string|unique:mahasiswa,nim,' . $mahasiswa->id,
            'nama' => 'required|string|max:255',
            'email' => $emailRule,
            'angkatan' => 'nullable|integer',
        ]);

        DB::transaction(function () use ($data, $mahasiswa, $user) {

            // Update data mahasiswa
            $mahasiswa->update([
                'nim' => $data['nim'],
                'nama' => $data['nama'],
                'email' => $data['email'],
                'angkatan' => $data['angkatan'] ?? null,
            ]);

            // Update akun login mahasiswa
            if ($user) {
                $user->update([
                    'name' => $data['nama'],
                    'email' => $data['email'],
                ]);
            } else {
                // Buat akun jika belum tersedia
                User::create([
                    'name' => $data['nama'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['nim']),
                    'role' => 'mahasiswa',
                    'mahasiswa_id' => $mahasiswa->id,
                ]);
            }
        });

        return back()->with(
            'success',
            'Data mahasiswa berhasil diperbarui.'
        );
    }


    // HAPUS MAHASISWA

    public function hapusMahasiswa(Mahasiswa $mahasiswa)
    {
        $mahasiswa->user()->delete();
        $mahasiswa->delete();

        return back()->with(
            'success',
            'Data mahasiswa berhasil dihapus.'
        );
    }

    // DATA MATA KULIAH

    public function mataKuliah()
    {
        $data = MataKuliah::orderBy('semester')
            ->orderBy('id')
            ->paginate(10);

        return view('admin.mata-kuliah', compact('data'));
    }

    // TAMBAH MATA KULIAH

    public function simpanMk(Request $request)
    {
        $data = $request->validate([
            'kode' => 'required|unique:mata_kuliah,kode',
            'nama' => 'required|string|max:255',
            'nama_inggris' => 'nullable|string|max:255',
            'semester' => 'required|integer|min:1',
            'sks' => 'required|integer|min:1|max:6',
            'deskripsi' => 'nullable|string',

            // Kategori relevansi mata kuliah
            'kategori' => 'required|in:ai,cyber,keduanya,tidak_ada',
        ]);

        $kategori = $data['kategori'];
        unset($data['kategori']);

        // Penanda kategori, bukan bobot perhitungan
        $data['bobot_ai'] = in_array(
            $kategori,
            ['ai', 'keduanya']
        ) ? 1 : 0;

        $data['bobot_cyber'] = in_array(
            $kategori,
            ['cyber', 'keduanya']
        ) ? 1 : 0;

        $data['aktif'] = true;

        MataKuliah::create($data);

        return back()->with(
            'success',
            'Mata kuliah berhasil ditambahkan.'
        );
    }


    // EDIT MATA KULIAH

    public function updateMK(Request $request, MataKuliah $mataKuliah)
    {
        $data = $request->validate([
            'kode' => 'required|string|max:50|unique:mata_kuliah,kode,' . $mataKuliah->id,
            'nama' => 'required|string|max:255',
            'nama_inggris' => 'nullable|string|max:255',
            'semester' => 'required|integer|min:1',
            'sks' => 'required|integer|min:1|max:6',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|in:ai,cyber,keduanya,tidak_ada',
        ]);

        $kategori = $data['kategori'];

        // Hapus kategori karena tidak disimpan langsung
        unset($data['kategori']);

        // Atur penanda kategori AI
        $data['bobot_ai'] = in_array(
            $kategori,
            ['ai', 'keduanya']
        ) ? 1 : 0;

        // Atur penanda kategori Cyber Security
        $data['bobot_cyber'] = in_array(
            $kategori,
            ['cyber', 'keduanya']
        ) ? 1 : 0;

        // Update data mata kuliah
        $mataKuliah->update($data);

        return back()->with(
            'success',
            'Data mata kuliah berhasil diperbarui.'
        );
    }


    // NONAKTIFKAN MATA KULIAH

    public function hapusMk(MataKuliah $mataKuliah)
    {
        $mataKuliah->update([
            'aktif' => false,
        ]);

        return back()->with(
            'success',
            'Mata kuliah berhasil dinonaktifkan.'
        );
    }

    // DATA PEMINATAN

    public function peminatan()
    {
        $data = Peminatan::all();

        return view('admin.peminatan', compact('data'));
    }


    // TAMBAH PEMINATAN

    public function simpanPeminatan(Request $request)
    {
        $data = $request->validate([
            'kode' => 'required|string|max:50|unique:peminatan,kode',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'warna' => 'nullable|in:primary,success,info,warning,danger,secondary',
        ]);

        Peminatan::create($data);

        return back()->with(
            'success',
            'Data peminatan berhasil ditambahkan.'
        );
    }

    // EDIT PEMINATAN

    public function updatePeminatan(Request $request, Peminatan $peminatan)
    {
        $data = $request->validate([
            'kode' => 'required|string|max:50|unique:peminatan,kode,' . $peminatan->id,
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'warna' => 'nullable|in:primary,success,info,warning,danger,secondary',
        ]);

        $peminatan->update($data);

        return back()->with(
            'success',
            'Data peminatan berhasil diperbarui.'
        );
    }

    // HAPUS PEMINATAN

    public function hapusPeminatan(Peminatan $peminatan)
    {
        // Cegah penghapusan jika sudah digunakan rekomendasi
        if (Rekomendasi::where('peminatan_id', $peminatan->id)->exists()) {
            return back()->with(
                'error',
                'Peminatan tidak dapat dihapus karena sudah digunakan dalam data rekomendasi.'
            );
        }

        $peminatan->delete();

        return back()->with(
            'success',
            'Data peminatan berhasil dihapus.'
        );
    }


    // DATA REKOMENDASI

    public function rekomendasi()
    {
        $data = Rekomendasi::with('mahasiswa')
            ->latest()
            ->paginate(20);

        return view('admin.rekomendasi', compact('data'));
    }

    // LAPORAN

    public function laporan()
    {
        return $this->rekomendasi();
    }
}
