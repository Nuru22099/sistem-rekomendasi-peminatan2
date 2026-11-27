@extends('layouts.app')

@section('title', 'Login - Sistem Rekomendasi STT-NF')

@section('guest')

<style>
    .login-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 35px 20px;
        background:
            radial-gradient(circle at 10% 10%, rgba(99, 102, 241, .25), transparent 30%),
            radial-gradient(circle at 90% 90%, rgba(14, 165, 233, .20), transparent 30%),
            linear-gradient(135deg, #0f172a, #172554, #1e3a8a);
        font-family: 'Segoe UI', sans-serif;
    }

    .login-card {
        width: 100%;
        max-width: 1000px;
        min-height: 590px;
        display: grid;
        grid-template-columns: 1.02fr .98fr;
        background: #fff;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 30px 80px rgba(0, 0, 0, .28);
    }

    /* PANEL INFORMASI */

    .login-info {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        height: 100%;
        padding: 40px;

    background:
        linear-gradient(
            rgba(20, 39, 90, 0.78),
            rgba(76, 112, 194, 0.82)
        ),
        url('https://nurulfikri.ac.id/wp-content/uploads/slider/cache/b9cdbba1a0e7c5c45cc35ca06eaebf93/Banner-Web-1-scaled.webp');

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;

            color: #f27a18;
    }

    .login-info::before {
        content: "";
        position: absolute;
        width: 340px;
        height: 340px;
        border: 1px solid rgba(255,255,255,.10);
        border-radius: 50%;
        right: -150px;
        top: -120px;
    }

    .login-info::after {
        content: "";
        position: absolute;
        width: 280px;
        height: 280px;
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 50%;
        right: -100px;
        bottom: -140px;
    }

    .login-info-content {
        position: relative;
        z-index: 2;
    }

    .login-brand {
        display: flex;
        align-items: center;
        gap: 13px;
        margin-bottom: 55px;
    }

    .login-logo {
        width: 54px;
        height: 54px;
        flex-shrink: 0;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255,255,255,.15);
        border: 1px solid rgba(255,255,255,.18);
        font-size: 27px;
        color: #fff;
    }

    .login-brand-text strong {
        display: block;
        font-size: 14px;
        font-weight: 750;
        letter-spacing: .3px;
    }

    .login-brand-text span {
        display: block;
        font-size: 11px;
        color: #bfdbfe;
        margin-top: 3px;
    }

    .login-kicker {
        display: inline-block;
        background: rgba(255,255,255,.12);
        color: #dbeafe;
        border: 1px solid rgba(255,255,255,.13);
        border-radius: 30px;
        padding: 7px 13px;
        font-size: 10px;
        font-weight: 750;
        letter-spacing: 1px;
        margin-bottom: 20px;
    }

    .login-info h2 {
        font-size: 30px;
        line-height: 1.35;
        font-weight: 800;
        margin-bottom: 17px;
    }

    .login-info h2 span {
        color: #93c5fd;
    }

    .login-info-description {
        color: #dbeafe;
        font-size: 13px;
        line-height: 1.9;
        max-width: 390px;
        margin-bottom: 28px;
    }

    .login-feature-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-top: 5px;
    }

    .login-feature {
        display: flex;
        align-items: center;
        gap: 12px;
        color: #eff6ff;
        font-size: 13px;
    }

    .login-feature-icon {
        width: 35px;
        height: 35px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: rgba(255,255,255,.13);
        color: #bfdbfe;
        font-size: 16px;
    }

    .login-info-footer {
        margin-top: 55px;
        padding-top: 18px;
        border-top: 1px solid rgba(255,255,255,.15);
        color: #bfdbfe;
        font-size: 11px;
        position: relative;
        z-index: 2;
    }

    /* PANEL FORM LOGIN */

    .brand-logo {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        margin: 0 auto 5px;
    }

    .logo-sttnf {
        display: block;
        width: 85px;
        height: 85px;
        object-fit: contain;
        margin: 0 auto;
    }

    /* JUDUL LOGIN */
    .login-form-area h3 {
        color: #172554;
        font-size: 27px;
        font-weight: 800;
        margin-bottom: 8px;
        text-align: center;
    }

    .login-subtitle {
        color: #94a3b8;
        font-size: 13px;
        margin-bottom: 30px;
        line-height: 1.7;
        text-align: center;
    }

    .login-form-area {
        padding: 55px 52px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    
    .login-form-area .form-label {
        display: block;
        color: #334155;
        font-size: 12px;
        font-weight: 750;
        margin-bottom: 9px;
    }

    .login-input-wrapper {
        position: relative;
    }

    .login-input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 16px;
        pointer-events: none;
    }

    .login-input {
        width: 100%;
        height: 48px;
        padding: 10px 43px;
        border: 1px solid #e2e8f0;
        border-radius: 11px;
        outline: none;
        background: #f8fafc;
        color: #1e293b;
        font-size: 13px;
        transition: .2s;
        box-sizing: border-box;
    }

    .login-input::placeholder {
        color: #aab4c2;
    }

    .login-input:focus {
        background: #fff;
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, .09);
    }

    .password-toggle {
        position: absolute;
        right: 13px;
        top: 50%;
        transform: translateY(-50%);
        border: none;
        background: transparent;
        color: #94a3b8;
        padding: 3px;
        cursor: pointer;
        font-size: 16px;
    }

    .password-toggle:hover {
        color: #4f46e5;
    }

    .login-remember {
        display: flex;
        align-items: center;
        gap: 9px;
        color: #64748b;
        font-size: 12px;
        cursor: pointer;
    }

    .login-remember input {
        width: 15px;
        height: 15px;
        accent-color: #4f46e5;
        cursor: pointer;
    }

    .login-button {
        width: 100%;
        height: 49px;
        border: none;
        border-radius: 11px;
        background: linear-gradient(100deg, #3730a3, #4f46e5);
        color: #fff;
        font-size: 14px;
        font-weight: 750;
        transition: .2s;
        box-shadow: 0 7px 15px rgba(79, 70, 229, .18);
    }

    .login-button:hover {
        background: linear-gradient(100deg, #312e81, #4338ca);
        transform: translateY(-1px);
        box-shadow: 0 10px 20px rgba(79, 70, 229, .24);
    }

    .login-button:active {
        transform: scale(.99);
    }

    .login-security-note {
        display: flex;
        align-items: flex-start;
        gap: 9px;
        color: #94a3b8;
        font-size: 11px;
        line-height: 1.6;
        margin-top: 22px;
    }

    .login-security-note i {
        color: #10b981;
        font-size: 14px;
        margin-top: 1px;
    }

    .login-footer {
        border-top: 1px solid #edf0f5;
        margin-top: 30px;
        padding-top: 20px;
        text-align: center;
        color: #94a3b8;
        font-size: 11px;
        line-height: 1.8;
    }

    .login-alert {
        border-radius: 10px;
        font-size: 12px;
        margin-bottom: 18px;
    }

    /* RESPONSIVE */

    @media (max-width: 800px) {
        .login-card {
            max-width: 520px;
            grid-template-columns: 1fr;
        }

        .login-info {
            padding: 30px;
        }

        .login-brand {
            margin-bottom: 30px;
        }

        .login-info h2 {
            font-size: 23px;
        }

        .login-info-description {
            margin-bottom: 15px;
        }

        .login-feature-list {
            display: none;
        }

        .login-info-footer {
            margin-top: 25px;
        }

        .login-form-area {
            padding: 38px 30px;
        }
    }

    @media (max-width: 420px) {
        .login-page {
            padding: 15px;
        }

        .login-info {
            padding: 28px;
        }

        .login-form-area {
            padding: 30px 23px;
        }

        .login-info h2 {
            font-size: 21px;
        }

        .login-form-area h3 {
            font-size: 24px;
        }
    }
</style>

<div class="login-page">

    <div class="login-card">

        {{-- PANEL INFORMASI SISTEM --}}
        <div class="login-info">

            <div class="login-info-content">

                <div class="login-brand">

                    <div class="login-logo">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>

                    <div class="login-brand-text">
                        <strong>STT TERPADU NURUL FIKRI</strong>
                        <strong>Teknik Informatika</strong>
                    </div>

                </div>

                <div class="login-kicker">
                    STUDENT SPECIALIZATION SYSTEM
                </div>

                <h2>
                    Sistem Rekomendasi
                    <span>Mata Kuliah Peminatan</span>
                </h2>

                <p class="login-info-description">
                    Bantu menentukan pilihan peminatan berdasarkan hasil
                    analisis nilai mata kuliah. Temukan bidang yang sesuai
                    dengan kemampuan dan potensi akademik.
                </p>

                <div class="login-feature-list">

                    <div class="login-feature">
                        <div class="login-feature-icon">
                            <i class="bi bi-robot"></i>
                        </div>

                        <span>Artificial Intelligence</span>
                    </div>

                    <div class="login-feature">
                        <div class="login-feature-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>

                        <span>Cyber Security</span>
                    </div>

                    <div class="login-feature">
                        <div class="login-feature-icon">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>

                        <span>Analisis nilai mata kuliah berbasis Rule-Based</span>
                    </div>

                </div>

            </div>

            <div class="login-info-footer">
                <i class="bi bi-building me-1"></i>
                Sekolah Tinggi Teknologi Terpadu Nurul Fikri
            </div>

        </div>

        {{-- PANEL FORM LOGIN --}}
        <div class="login-form-area">

            <span class="brand-logo">
                    <img
                        src="https://assets.siakadcloud.com/uploads/sttnurulfikri/logoaplikasi/1405.jpg"
                        alt="Logo STT-NF"
                        class="logo-sttnf"
                    >
            </span>

                    <h3>Selamat Datang!</h3>

                    <p class="login-subtitle">
                        Masuk menggunakan akun admin atau akun mahasiswa
                        untuk mengakses sistem.
                    </p>

            {{-- PESAN SUKSES --}}
            @if(session('success'))
                <div class="alert alert-success login-alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            {{-- PESAN ERROR --}}
            @if($errors->any())
                <div class="alert alert-danger login-alert">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- FORM LOGIN --}}
            <form action="{{ route('login.proses') }}" method="POST">

                @csrf

                {{-- EMAIL / NIM --}}
                <div class="mb-3">

                    <label class="form-label" for="login">
                        Email Admin / NIM Mahasiswa
                    </label>

                    <div class="login-input-wrapper">

                        <i class="bi bi-person-badge login-input-icon"></i>

                        <input
                            type="text"
                            id="login"
                            name="login"
                            class="login-input"
                            value="{{ old('login') }}"
                            placeholder="Masukkan email atau NIM"
                            autocomplete="username"
                            required
                            autofocus
                        >

                    </div>
                </div>

                {{-- PASSWORD --}}
                <div class="mb-3">

                    <label class="form-label" for="password">
                        Password
                    </label>

                    <div class="login-input-wrapper">

                        <i class="bi bi-lock login-input-icon"></i>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="login-input"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            id="togglePassword"
                            aria-label="Tampilkan password"
                            aria-pressed="false">

                            <i class="bi bi-eye" id="passwordIcon"></i>

                        </button>

                    </div>
                </div>

                {{-- INGAT SAYA --}}
                <div class="d-flex justify-content-between align-items-center mb-4">

                    <label class="login-remember">
                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                            {{ old('remember') ? 'checked' : '' }}
                        >

                        <span>Ingat saya</span>
                    </label>

                </div>

                {{-- TOMBOL LOGIN --}}
                <button type="submit" class="login-button">
                    <i class="bi bi-box-arrow-in-right me-2"></i>
                    Masuk ke Sistem
                </button>

            </form>

            {{-- INFORMASI KEAMANAN --}}
            <div class="login-security-note">
                <i class="bi bi-shield-check"></i>

                <span>
                    Gunakan akun yang telah terdaftar untuk mengakses
                    sistem rekomendasi mata kuliah peminatan.
                </span>
            </div>

            {{-- FOOTER --}}
            <div class="login-footer">
                © {{ date('Y') }} STT Terpadu Nurul Fikri.
                <br>
                Sistem Rekomendasi Mata Kuliah Peminatan
            </div>

        </div>

    </div>

</div>

{{-- TOGGLE PASSWORD --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const passwordInput = document.getElementById('password');
        const toggleButton = document.getElementById('togglePassword');
        const passwordIcon = document.getElementById('passwordIcon');

        if (toggleButton && passwordInput && passwordIcon) {

            toggleButton.addEventListener('click', function () {

                const isPassword = passwordInput.type === 'password';

                passwordInput.type = isPassword ? 'text' : 'password';

                passwordIcon.className = isPassword
                    ? 'bi bi-eye-slash'
                    : 'bi bi-eye';

                toggleButton.setAttribute(
                    'aria-pressed',
                    isPassword ? 'true' : 'false'
                );

                toggleButton.setAttribute(
                    'aria-label',
                    isPassword ? 'Sembunyikan password' : 'Tampilkan password'
                );

            });
        }

    });
</script>

@endsection
