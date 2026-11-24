<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Periksa apakah login menggunakan email Admin
        if (filter_var($data['login'], FILTER_VALIDATE_EMAIL)) {

            $credentials = [
                'email' => $data['login'],
                'password' => $data['password'],
                'role' => 'admin',
            ];

        } else {

            // Login Mahasiswa menggunakan NIM
            $user = User::where('role', 'mahasiswa')
                ->whereHas('mahasiswa', function ($query) use ($data) {
                    $query->where('nim', $data['login']);
                })
                ->first();

            if (!$user) {
                return back()
                    ->withErrors([
                        'login' => 'NIM tidak ditemukan.',
                    ])
                    ->onlyInput('login');
            }

            $credentials = [
                'id' => $user->id,
                'password' => $data['password'],
                'role' => 'mahasiswa',
            ];
        }

        if (!Auth::attempt(
            $credentials,
            $request->boolean('remember')
        )) {
            return back()
                ->withErrors([
                    'login' => 'Email/NIM atau password salah.',
                ])
                ->onlyInput('login');
        }

        $request->session()->regenerate();

        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('mahasiswa.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Anda berhasil keluar.');
    }
}
