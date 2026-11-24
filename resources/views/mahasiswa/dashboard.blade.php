@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')
@section('heading', 'Dashboard Mahasiswa')

@section('content')

<style>
    .student-dashboard {
        color: #263248;
    }

    /* WELCOME HERO */
    .student-welcome {
        position: relative;
        overflow: hidden;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        padding: 32px;
        min-height: 235px;
        border-radius: 20px;
        color: #fff;
        background: linear-gradient(120deg, #172554, #3730a3, #4f46e5);
        margin-bottom: 24px;
    }

    .student-welcome::before {
        content: "";
        position: absolute;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        border: 1px solid rgba(255,255,255,.10);
        right: 60px;
        top: -180px;
    }

    .student-welcome::after {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(255,255,255,.06);
        right: -60px;
        bottom: -130px;
    }

    .welcome-content {
        position: relative;
        z-index: 2;
    }

    .welcome-eyebrow {
        display: inline-block;
        color: #c7d2fe;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.3px;
        margin-bottom: 15px;
    }

    .student-welcome h2 {
        font-size: 25px;
        font-weight: 500;
        margin-bottom: 3px;
        color: #fff;
    }

    .student-welcome h3 {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 12px;
        color: #fff;
    }

    .student-welcome p {
        max-width: 500px;
        color: #dbeafe;
        font-size: 13px;
        line-height: 1.8;
        margin-bottom: 22px;
    }

    .student-welcome .btn {
        padding: 11px 20px;
        border-radius: 10px !important;
        font-size: 12px;
        font-weight: 750;
        transition: .2s;
    }

    .student-welcome .btn:hover {
        transform: translateY(-2px);
    }

    .welcome-cap {
        position: absolute;
        right: 65px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 125px;
        color: rgba(255,255,255,.13);
        z-index: 1;
    }

    /* SUMMARY */
    .student-summary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .summary-card {
        background: #fff;
        border: 1px solid #edf0f5;
        border-radius: 16px;
        padding: 19px;
        display: flex;
        align-items: center;
        gap: 15px;
        box-shadow: 0 4px 15px rgba(15,23,42,.035);
    }

    .summary-icon {
        width: 47px;
        height: 47px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        font-size: 21px;
    }

    .summary-icon.purple {
        color: #4f46e5;
        background: #eef2ff;
    }

    .summary-icon.green {
        color: #059669;
        background: #ecfdf5;
    }

    .summary-card h4 {
        color: #1e293b;
        font-size: 23px;
        font-weight: 800;
        margin: 0;
    }

    .summary-card p {
        color: #94a3b8;
        font-size: 11px;
        margin: 4px 0 0;
    }

    /* GENERAL PANEL */
    .student-panel {
        height: 100%;
        padding: 23px;
        background: #fff;
        border: 1px solid #edf0f5;
        border-radius: 17px;
        box-shadow: 0 4px 15px rgba(15,23,42,.035);
    }

    .student-panel-heading {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 22px;
    }

    .student-panel-heading h5 {
        font-size: 16px;
        font-weight: 800;
        color: #263248;
        margin: 0;
    }

    .student-panel-heading p {
        font-size: 12px;
        color: #94a3b8;
        margin: 5px 0 0;
    }

    .result-status {
        padding: 6px 11px;
        border-radius: 20px;
        background: #ecfdf5;
        color: #059669;
        font-size: 10px;
        font-weight: 750;
        white-space: nowrap;
    }

    /* RESULT CARD */
    .result-highlight {
        padding: 20px;
        border-radius: 14px;
        background: linear-gradient(120deg, #eef2ff, #f5f3ff);
        border: 1px solid #e0e7ff;
        margin-bottom: 22px;
    }

    .result-highlight .result-label {
        color: #6366f1;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .7px;
        text-transform: uppercase;
        margin-bottom: 9px;
    }

    .result-highlight h3 {
        color: #312e81;
        font-size: 23px;
        font-weight: 800;
        margin-bottom: 7px;
    }

    .result-highlight p {
        color: #64748b;
        font-size: 12px;
        margin: 0;
    }

    .result-comparison-title {
        color: #334155;
        font-size: 13px;
        font-weight: 750;
        margin-bottom: 17px;
    }

    .result-score {
        margin-bottom: 19px;
    }

    .result-score:last-child {
        margin-bottom: 5px;
    }

    .result-score-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
        font-size: 12px;
        font-weight: 700;
    }

    .result-score-top .ai-label {
        color: #4f46e5;
    }

    .result-score-top .cyber-label {
        color: #059669;
    }

    .result-track {
        width: 100%;
        height: 9px;
        background: #edf0f5;
        border-radius: 20px;
        overflow: hidden;
    }

    .result-progress {
        height: 100%;
        border-radius: 20px;
    }

    .result-progress.ai {
        background: linear-gradient(90deg, #6366f1, #818cf8);
    }

    .result-progress.cyber {
        background: linear-gradient(90deg, #059669, #34d399);
    }

    .result-note {
        display: flex;
        gap: 10px;
        align-items: flex-start;
        padding: 13px;
        border-radius: 11px;
        background: #f8fafc;
        color: #64748b;
        font-size: 11px;
        line-height: 1.7;
        margin-top: 20px;
    }

    .result-note i {
        color: #6366f1;
        font-size: 15px;
        margin-top: 1px;
    }

    .result-detail-button {
        width: 100%;
        margin-top: 20px;
        padding: 11px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 750;
    }

    /* EMPTY RESULT */
    .result-empty {
        padding: 28px 18px;
        border-radius: 14px;
        border: 1px dashed #dbe2ed;
        background: #f8fafc;
        text-align: center;
    }

    .result-empty-icon {
        width: 57px;
        height: 57px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        border-radius: 17px;
        background: #eef2ff;
        color: #6366f1;
        font-size: 25px;
    }

    .result-empty h6 {
        color: #334155;
        font-size: 14px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .result-empty p {
        color: #94a3b8;
        font-size: 12px;
        line-height: 1.7;
        max-width: 350px;
        margin: 0 auto 17px;
    }

    /* QUICK ACTION */
    .quick-panel {
        display: flex;
        flex-direction: column;
    }

    .quick-panel h5 {
        font-size: 16px;
        font-weight: 800;
        color: #263248;
        margin-bottom: 6px;
    }

    .quick-description {
        color: #94a3b8;
        font-size: 12px;
        margin-bottom: 18px;
    }

    .quick-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 12px;
        margin-bottom: 10px;
        border: 1px solid #edf0f5;
        border-radius: 12px;
        text-decoration: none;
        transition: .2s;
    }

    .quick-link:hover {
        background: #f8faff;
        border-color: #c7d2fe;
        transform: translateX(3px);
    }

    .quick-link-icon {
        width: 41px;
        height: 41px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: #eef2ff;
        color: #4f46e5;
        font-size: 18px;
    }

    .quick-link-icon.green {
        background: #ecfdf5;
        color: #059669;
    }

    .quick-link-text {
        min-width: 0;
        flex: 1;
    }

    .quick-link-text b {
        display: block;
        color: #334155;
        font-size: 12px;
        font-weight: 750;
        margin-bottom: 4px;
    }

    .quick-link-text small {
        display: block;
        color: #94a3b8;
        font-size: 10px;
        line-height: 1.5;
    }

    .quick-link-arrow {
        color: #94a3b8;
        font-size: 15px;
    }

    /* INFORMATION PANEL */
    .student-information {
        display: flex;
        gap: 13px;
        align-items: flex-start;
        padding: 17px;
        margin-top: 18px;
        background: #f8fafc;
        border: 1px solid #edf0f5;
        border-radius: 13px;
    }

    .student-information i {
        color: #4f46e5;
        font-size: 20px;
    }

    .student-information b {
        display: block;
        color: #334155;
        font-size: 12px;
        margin-bottom: 5px;
    }

    .student-information p {
        color: #94a3b8;
        font-size: 11px;
        line-height: 1.7;
        margin: 0;
    }

    @media (max-width: 768px) {
        .student-welcome {
            min-height: auto;
            padding: 25px;
        }

        .student-welcome h2 {
            font-size: 21px;
        }

        .student-welcome h3 {
            font-size: 27px;
        }

        .welcome-cap {
            right: 15px;
            font-size: 80px;
            opacity: .6;
        }

        .student-panel {
            padding: 18px;
        }
    }

    @media (max-width: 480px) {
        .student-welcome {
            padding: 22px;
        }

        .student-welcome h3 {
            font-size: 23px;
            overflow-wrap: anywhere;
        }

        .welcome-cap {
            display: none;
        }

        .student-summary {
            grid-template-columns: 1fr;
        }

        .student-panel-heading {
            flex-direction: column;
        }
    }
</style>

<div class="student-dashboard">

    {{-- WELCOME SECTION --}}
    <section class="student-welcome">

        <div class="welcome-content">

            <span class="welcome-eyebrow">
                DASHBOARD MAHASISWA · STT-NF
            </span>

            <h2>Selamat Datang,</h2>

            <h3>{{ str($m->nama)->title() }}</h3>

            <p>
                Temukan bidang peminatan yang sesuai dengan minat dan
                pilihan mata kuliah Anda. Mulai analisis untuk mengetahui
                rekomendasi peminatan.
            </p>

            <a
                class="btn btn-light text-primary"
                href="{{ route('mahasiswa.penilaian') }}"
            >
                {{ $jumlahPilihan > 0 ? 'Ubah Pilihan Mata Kuliah' : 'Mulai Pilih Mata Kuliah' }}

                <i class="bi bi-arrow-right ms-2"></i>
            </a>

        </div>

        <i class="bi bi-mortarboard-fill welcome-cap"></i>

    </section>

    {{-- RINGKASAN MAHASISWA --}}
    <div class="student-summary">

        <div class="summary-card">

            <div class="summary-icon purple">
                <i class="bi bi-journal-check"></i>
            </div>

            <div>
                <h4>{{ $jumlahPilihan }}</h4>
                <p>Mata kuliah dipilih</p>
            </div>

        </div>

        <div class="summary-card">

            <div class="summary-icon green">
                <i class="bi bi-stars"></i>
            </div>

            <div>
                <h4>{{ $hasil ? 'Tersedia' : 'Belum Ada' }}</h4>
                <p>Status rekomendasi</p>
            </div>

        </div>

    </div>

    {{-- KONTEN UTAMA --}}
    <div class="row g-3">

        {{-- HASIL REKOMENDASI --}}
        <div class="col-lg-8">

            <section class="student-panel">

                <div class="student-panel-heading">

                    <div>
                        <h5>Hasil Rekomendasi Anda</h5>

                        <p>
                            Ringkasan hasil analisis pilihan mata kuliah.
                        </p>
                    </div>

                    @if($hasil)
                        <span class="result-status">
                            <i class="bi bi-check-circle-fill me-1"></i>
                            Rekomendasi tersedia
                        </span>
                    @endif

                </div>

                @if($hasil)

                    @php
                        $aiPersen = max(0, min(100, (float) ($hasil->ai_persen ?? 0)));
                        $cyberPersen = max(0, min(100, (float) ($hasil->cyber_persen ?? 0)));
                    @endphp

                    {{-- HASIL UTAMA --}}
                    <div class="result-highlight">

                        <div class="result-label">
                            <i class="bi bi-stars me-1"></i>
                            Rekomendasi Peminatan Anda
                        </div>

                        <h3>{{ $hasil->hasil }}</h3>

                        <p>
                            Berdasarkan {{ $jumlahPilihan }} mata kuliah
                            yang telah Anda pilih.
                        </p>

                    </div>

                    {{-- PERBANDINGAN SKOR --}}
                    <div class="result-comparison-title">
                        Perbandingan Kecocokan Peminatan
                    </div>

                    <div class="result-score">

                        <div class="result-score-top">
                            <span class="ai-label">
                                <i class="bi bi-robot me-1"></i>
                                Artificial Intelligence
                            </span>

                            <span class="ai-label">
                                {{ number_format($aiPersen, 2) }}%
                            </span>
                        </div>

                        <div class="result-track">
                            <div
                                class="result-progress ai"
                                style="width: {{ $aiPersen }}%;">
                            </div>
                        </div>

                    </div>

                    <div class="result-score">

                        <div class="result-score-top">
                            <span class="cyber-label">
                                <i class="bi bi-shield-lock me-1"></i>
                                Cyber Security
                            </span>

                            <span class="cyber-label">
                                {{ number_format($cyberPersen, 2) }}%
                            </span>
                        </div>

                        <div class="result-track">
                            <div
                                class="result-progress cyber"
                                style="width: {{ $cyberPersen }}%;">
                            </div>
                        </div>

                    </div>

                    <div class="result-note">
                        <i class="bi bi-info-circle-fill"></i>

                        <span>
                            Persentase menunjukkan tingkat kecocokan
                            masing-masing peminatan berdasarkan hasil
                            analisis pilihan mata kuliah Anda.
                        </span>
                    </div>

                    <a
                        href="{{ route('mahasiswa.hasil') }}"
                        class="btn btn-outline-primary result-detail-button"
                    >
                        <i class="bi bi-eye me-2"></i>
                        Lihat Detail Rekomendasi
                    </a>

                @else

                    {{-- BELUM ADA REKOMENDASI --}}
                    <div class="result-empty">

                        <div class="result-empty-icon">
                            <i class="bi bi-lightbulb"></i>
                        </div>

                        <h6>Anda Belum Memiliki Rekomendasi</h6>

                        <p>
                            Silakan pilih beberapa mata kuliah yang Anda minati.
                            Sistem akan melakukan analisis untuk memberikan
                            rekomendasi antara Artificial Intelligence dan Cyber Security.
                        </p>

                        <a
                            href="{{ route('mahasiswa.penilaian') }}"
                            class="btn btn-primary btn-sm px-4"
                        >
                            <i class="bi bi-plus-circle me-2"></i>
                            Pilih Mata Kuliah
                        </a>

                    </div>

                @endif

            </section>

        </div>

        {{-- LANGKAH BERIKUTNYA --}}
        <div class="col-lg-4">

            <section class="student-panel quick-panel">

                <h5>Langkah Berikutnya</h5>

                <p class="quick-description">
                    Lanjutkan aktivitas Anda pada sistem rekomendasi.
                </p>

                <a
                    href="{{ route('mahasiswa.penilaian') }}"
                    class="quick-link"
                >

                    <div class="quick-link-icon">
                        <i class="bi bi-ui-checks"></i>
                    </div>

                    <div class="quick-link-text">
                        <b>Pilih Mata Kuliah</b>
                        <small>Centang mata kuliah yang diminati.</small>
                    </div>

                    <i class="bi bi-chevron-right quick-link-arrow"></i>

                </a>

                <a
                    href="{{ route('mahasiswa.hasil') }}"
                    class="quick-link"
                >

                    <div class="quick-link-icon green">
                        <i class="bi bi-stars"></i>
                    </div>

                    <div class="quick-link-text">
                        <b>Lihat Rekomendasi</b>
                        <small>Periksa hasil kecocokan peminatan.</small>
                    </div>

                    <i class="bi bi-chevron-right quick-link-arrow"></i>

                </a>

                {{-- INFORMASI SISTEM --}}
                <div class="student-information">

                    <i class="bi bi-info-circle-fill"></i>

                    <div>
                        <b>Informasi Sistem</b>

                        <p>
                            Sistem menyediakan rekomendasi dua bidang
                            peminatan, yaitu Artificial Intelligence
                            dan Cyber Security.
                        </p>
                    </div>

                </div>

            </section>

        </div>

    </div>

</div>

@endsection
