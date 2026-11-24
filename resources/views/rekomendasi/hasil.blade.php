@extends('layouts.app')

@section('title', 'Hasil Rekomendasi')
@section('heading', 'Hasil Rekomendasi')

@section('content')

<style>
    .student-result-page {
        color: #263248;
    }

    /* HEADER */
    .result-hero {
        position: relative;
        overflow: hidden;
        padding: 28px;
        border-radius: 20px;
        color: #fff;
        background: linear-gradient(120deg, #172554, #3730a3, #4f46e5);
        margin-bottom: 23px;
    }

    .result-hero::after {
        content: "";
        position: absolute;
        width: 230px;
        height: 230px;
        border-radius: 50%;
        background: rgba(255,255,255,.07);
        right: -55px;
        top: -110px;
    }

    .result-hero-content {
        position: relative;
        z-index: 1;
    }

    .result-eyebrow {
        display: inline-block;
        color: #c7d2fe;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.2px;
        margin-bottom: 12px;
    }

    .result-hero h3 {
        color: #fff;
        font-size: 23px;
        font-weight: 800;
        margin-bottom: 9px;
    }

    .result-hero p {
        color: #dbeafe;
        font-size: 13px;
        line-height: 1.8;
        max-width: 650px;
        margin: 0;
    }

    /* GENERAL PANEL */
    .result-panel {
        background: #fff;
        border: 1px solid #edf0f5;
        border-radius: 17px;
        padding: 23px;
        box-shadow: 0 4px 15px rgba(15,23,42,.035);
        margin-bottom: 20px;
    }

    .result-panel-heading {
        margin-bottom: 20px;
    }

    .result-panel-heading h5 {
        color: #263248;
        font-size: 16px;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .result-panel-heading p {
        color: #94a3b8;
        font-size: 12px;
        margin: 0;
        line-height: 1.7;
    }

    /* SUMMARY CARDS */
    .result-summary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 15px;
        margin-bottom: 22px;
    }

    .summary-card {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 18px;
        background: #fff;
        border: 1px solid #edf0f5;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(15,23,42,.03);
    }

    .summary-icon {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border-radius: 12px;
        background: #eef2ff;
        color: #4f46e5;
        font-size: 20px;
    }

    .summary-icon.green {
        background: #ecfdf5;
        color: #059669;
    }

    .summary-icon.blue {
        background: #eff6ff;
        color: #2563eb;
    }

    .summary-card h4 {
        color: #1e293b;
        font-size: 22px;
        font-weight: 800;
        margin: 0;
    }

    .summary-card p {
        color: #94a3b8;
        font-size: 11px;
        margin: 4px 0 0;
    }

    /* RECOMMENDATION RESULT */
    .result-outcome {
        padding: 22px;
        border: 1px solid #c7d2fe;
        border-radius: 15px;
        background: linear-gradient(120deg, #eef2ff, #f5f3ff);
        margin-bottom: 22px;
    }

    .outcome-label {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #6366f1;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .8px;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .result-outcome h2 {
        color: #312e81;
        font-size: 26px;
        font-weight: 850;
        margin-bottom: 8px;
    }

    .result-outcome p {
        color: #64748b;
        font-size: 12px;
        line-height: 1.7;
        margin: 0;
    }

    /* SCORE COMPARISON */
    .score-card {
        height: 100%;
        padding: 21px;
        border-radius: 15px;
        border: 1px solid #e8edf5;
        background: #fff;
        transition: .2s;
    }

    .score-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(15,23,42,.05);
    }

    .score-card.ai {
        border-top: 4px solid #6366f1;
    }

    .score-card.cyber {
        border-top: 4px solid #10b981;
    }

    .score-card-top {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .score-icon {
        width: 43px;
        height: 43px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 20px;
    }

    .score-card.ai .score-icon {
        background: #eef2ff;
        color: #4f46e5;
    }

    .score-card.cyber .score-icon {
        background: #ecfdf5;
        color: #059669;
    }

    .score-card h5 {
        color: #334155;
        font-size: 13px;
        font-weight: 800;
        margin: 0;
        line-height: 1.5;
    }

    .score-card small {
        display: block;
        color: #94a3b8;
        font-size: 10px;
        margin-top: 3px;
    }

    .score-number {
        font-size: 31px;
        font-weight: 850;
        margin-bottom: 12px;
    }

    .score-card.ai .score-number {
        color: #4f46e5;
    }

    .score-card.cyber .score-number {
        color: #059669;
    }

    .score-track {
        width: 100%;
        height: 9px;
        background: #edf0f5;
        border-radius: 20px;
        overflow: hidden;
    }

    .score-progress {
        height: 100%;
        border-radius: 20px;
    }

    .score-card.ai .score-progress {
        background: linear-gradient(90deg, #6366f1, #818cf8);
    }

    .score-card.cyber .score-progress {
        background: linear-gradient(90deg, #059669, #34d399);
    }

    .score-caption {
        display: flex;
        justify-content: space-between;
        margin-top: 9px;
        color: #94a3b8;
        font-size: 10px;
    }

    /* EXPLANATION */
    .method-note {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 16px;
        margin-top: 22px;
        background: #f8fafc;
        border: 1px solid #e8edf5;
        border-radius: 12px;
    }

    .method-note i {
        color: #4f46e5;
        font-size: 19px;
        margin-top: 1px;
    }

    .method-note strong {
        display: block;
        color: #334155;
        font-size: 12px;
        margin-bottom: 5px;
    }

    .method-note p {
        color: #64748b;
        font-size: 11px;
        line-height: 1.8;
        margin: 0;
    }

    /* COURSE TABLE */
    .course-table {
        margin-bottom: 0;
        vertical-align: middle;
    }

    .course-table thead th {
        padding: 14px;
        background: #f8fafc;
        border-bottom: 1px solid #e9edf4;
        color: #64748b;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .4px;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .course-table tbody td {
        padding: 15px 14px;
        border-color: #f1f5f9;
        color: #475569;
        font-size: 12px;
    }

    .course-table tbody tr:hover {
        background: #fafbff;
    }

    .course-number {
        width: 30px;
        height: 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: #f1f5f9;
        color: #64748b;
        font-size: 11px;
        font-weight: 750;
    }

    .course-table-name {
        color: #334155;
        font-weight: 750;
        font-size: 12px;
    }

    .category-badge {
        display: inline-block;
        padding: 6px 9px;
        margin: 2px 3px 2px 0;
        border-radius: 7px;
        background: #eef2ff;
        color: #4338ca;
        font-size: 10px;
        font-weight: 750;
    }

    .category-badge.ai {
        background: #eef2ff;
        color: #4338ca;
    }

    .category-badge.cyber {
        background: #ecfdf5;
        color: #047857;
    }

    .category-badge.other {
        background: #f1f5f9;
        color: #64748b;
    }

    .empty-table {
        padding: 30px 15px;
        text-align: center;
        color: #94a3b8;
        font-size: 12px;
    }

    /* ACTION BUTTON */
    .result-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        padding-top: 19px;
        margin-top: 20px;
        border-top: 1px solid #edf0f5;
    }

    .result-actions p {
        color: #94a3b8;
        font-size: 11px;
        margin: 0;
    }

    .result-actions .btn {
        border-radius: 10px;
        padding: 10px 16px;
        font-size: 12px;
        font-weight: 750;
    }

    /* EMPTY RESULT */
    .result-empty {
        padding: 45px 20px;
        background: #fff;
        border: 1px solid #edf0f5;
        border-radius: 17px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(15,23,42,.035);
    }

    .empty-icon {
        width: 65px;
        height: 65px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 17px;
        border-radius: 18px;
        color: #4f46e5;
        background: #eef2ff;
        font-size: 28px;
    }

    .result-empty h4 {
        color: #263248;
        font-size: 19px;
        font-weight: 800;
        margin-bottom: 9px;
    }

    .result-empty p {
        color: #94a3b8;
        font-size: 12px;
        line-height: 1.8;
        max-width: 430px;
        margin: 0 auto 20px;
    }

    .result-empty .btn {
        border-radius: 10px;
        padding: 10px 18px;
        font-size: 12px;
        font-weight: 750;
    }

    @media (max-width: 768px) {
        .result-hero {
            padding: 23px;
        }

        .result-hero h3 {
            font-size: 20px;
        }

        .result-panel {
            padding: 17px;
        }

        .result-actions {
            align-items: stretch;
        }

        .result-actions .btn {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .result-summary {
            grid-template-columns: 1fr;
        }

        .result-outcome h2 {
            font-size: 22px;
        }

        .score-number {
            font-size: 27px;
        }
    }
</style>

<div class="student-result-page">

    @if (!$hasil)

        {{-- HASIL BELUM TERSEDIA --}}
        <section class="result-empty">

            <div class="empty-icon">
                <i class="bi bi-lightbulb"></i>
            </div>

            <h4>Hasil Rekomendasi Belum Tersedia</h4>

            <p>
                Anda belum memilih mata kuliah yang diminati.
                Silakan pilih beberapa mata kuliah terlebih dahulu agar
                sistem dapat melakukan analisis dan memberikan rekomendasi
                peminatan Artificial Intelligence atau Cyber Security.
            </p>

            <a
                class="btn btn-primary"
                href="{{ route('mahasiswa.penilaian') }}"
            >
                <i class="bi bi-check2-square me-2"></i>
                Pilih Mata Kuliah
            </a>

        </section>

    @else

        @php
            $detail = $hasil->detail ?? [];

            $daftarMataKuliah = $detail['mata_kuliah'] ?? [];

            $jumlahPilihan = count($daftarMataKuliah);
            $jumlahAi = $detail['jumlah_ai'] ?? 0;
            $jumlahCyber = $detail['jumlah_cyber'] ?? 0;

            $aiPersen = max(0, min(100, (float) $hasil->ai_persen));
            $cyberPersen = max(0, min(100, (float) $hasil->cyber_persen));
        @endphp

        {{-- HEADER --}}
        <section class="result-hero">
            <div class="result-hero-content">

                <span class="result-eyebrow">
                    MAHASISWA / HASIL ANALISIS
                </span>

                <h3>Hasil Rekomendasi Peminatan</h3>

                <p>
                    Berikut hasil analisis berdasarkan {{ $jumlahPilihan }}
                    mata kuliah yang telah Anda pilih.
                    Pelajari perbandingan kecocokan kedua bidang peminatan.
                </p>

            </div>
        </section>

        {{-- RINGKASAN --}}
        <div class="result-summary">

            <div class="summary-card">
                <div class="summary-icon">
                    <i class="bi bi-book-half"></i>
                </div>

                <div>
                    <h4>{{ $jumlahPilihan }}</h4>
                    <p>Mata kuliah dipilih</p>
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-icon">
                    <i class="bi bi-robot"></i>
                </div>

                <div>
                    <h4>{{ $jumlahAi }}</h4>
                    <p>Kecocokan kategori AI</p>
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-icon green">
                    <i class="bi bi-shield-lock"></i>
                </div>

                <div>
                    <h4>{{ $jumlahCyber }}</h4>
                    <p>Kecocokan kategori Cyber Security</p>
                </div>
            </div>

        </div>

        {{-- HASIL UTAMA --}}
        <section class="result-panel">

            <div class="result-panel-heading">
                <h5>
                    <i class="bi bi-stars me-2 text-primary"></i>
                    Hasil Rekomendasi Anda
                </h5>

                <p>
                    Bidang peminatan yang direkomendasikan oleh sistem
                    berdasarkan pilihan mata kuliah.
                </p>
            </div>

            <div class="result-outcome">

                <div class="outcome-label">
                    <i class="bi bi-check-circle-fill"></i>
                    Rekomendasi Peminatan
                </div>

                <h2>{{ $hasil->hasil }}</h2>

                <p>
                    Hasil diperoleh dari pemetaan kategori mata kuliah
                    yang Anda pilih.
                </p>

            </div>

            {{-- PERBANDINGAN KEC0COKAN --}}
            <div class="row g-3">

                {{-- ARTIFICIAL INTELLIGENCE --}}
                <div class="col-md-6">

                    <div class="score-card ai">

                        <div class="score-card-top">

                            <div class="score-icon">
                                <i class="bi bi-cpu-fill"></i>
                            </div>

                            <div>
                                <h5>Artificial Intelligence</h5>
                                <small>Bidang kecerdasan buatan</small>
                            </div>

                        </div>

                        <div class="score-number">
                            {{ number_format((float) $hasil->ai_persen, 2) }}%
                        </div>

                        <div class="score-track">
                            <div
                                class="score-progress"
                                style="width: {{ $aiPersen }}%;">
                            </div>
                        </div>

                        <div class="score-caption">
                            <span>Tingkat kecocokan pilihan</span>
                            <span>{{ number_format($aiPersen, 2) }}%</span>
                        </div>

                    </div>

                </div>

                {{-- CYBER SECURITY --}}
                <div class="col-md-6">

                    <div class="score-card cyber">

                        <div class="score-card-top">

                            <div class="score-icon">
                                <i class="bi bi-shield-lock-fill"></i>
                            </div>

                            <div>
                                <h5>Cyber Security</h5>
                                <small>Bidang keamanan siber</small>
                            </div>

                        </div>

                        <div class="score-number">
                            {{ number_format((float) $hasil->cyber_persen, 2) }}%
                        </div>

                        <div class="score-track">
                            <div
                                class="score-progress"
                                style="width: {{ $cyberPersen }}%;">
                            </div>
                        </div>

                        <div class="score-caption">
                            <span>Tingkat kecocokan pilihan</span>
                            <span>{{ number_format($cyberPersen, 2) }}%</span>
                        </div>

                    </div>

                </div>

            </div>

            {{-- KETERANGAN METODE --}}
            <div class="method-note">

                <i class="bi bi-info-circle-fill"></i>

                <div>
                    <strong>Dasar Perhitungan Rekomendasi</strong>

                    <p>
                        Hasil dihitung berdasarkan pemetaan mata kuliah
                        pilihan ke kategori Artificial Intelligence dan
                        Cyber Security. Setiap mata kuliah diperhitungkan
                        berdasarkan kategori peminatannya, tanpa menggunakan
                        nilai akademik maupun bobot SKS.
                    </p>
                </div>

            </div>

        </section>

        {{-- DETAIL MATA KULIAH --}}
        <section class="result-panel">

            <div class="result-panel-heading">
                <h5>
                    <i class="bi bi-journal-check me-2 text-primary"></i>
                    Detail Mata Kuliah yang Dipilih
                </h5>

                <p>
                    Daftar mata kuliah beserta kategori peminatan
                    yang digunakan dalam proses analisis.
                </p>
            </div>

            <div class="table-responsive">

                <table class="table table-hover course-table">

                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Mata Kuliah</th>
                            <th>Kategori Peminatan</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($daftarMataKuliah as $item)

                            <tr>

                                <td>
                                    <span class="course-number">
                                        {{ $loop->iteration }}
                                    </span>
                                </td>

                                <td>
                                    <span class="course-table-name">
                                        {{ $item['mata_kuliah'] ?? '-' }}
                                    </span>
                                </td>

                                <td>

                                    @if(!empty($item['kategori']))

                                        @foreach($item['kategori'] as $kategori)

                                            @php
                                                $kategoriLower = strtolower($kategori);

                                                if (
                                                    str_contains($kategoriLower, 'artificial') ||
                                                    $kategoriLower === 'ai'
                                                ) {
                                                    $badgeClass = 'ai';
                                                } elseif (str_contains($kategoriLower, 'cyber')) {
                                                    $badgeClass = 'cyber';
                                                } else {
                                                    $badgeClass = 'other';
                                                }
                                            @endphp

                                            <span class="category-badge {{ $badgeClass }}">
                                                {{ $kategori }}
                                            </span>

                                        @endforeach

                                    @else

                                        <span class="category-badge other">
                                            Tidak ada kategori
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="3">
                                    <div class="empty-table">
                                        <i class="bi bi-inbox d-block fs-3 mb-2"></i>
                                        Belum ada detail mata kuliah.
                                    </div>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- TOMBOL AKSI --}}
            <div class="result-actions">

                <p>
                    Pilihan mata kuliah dapat diubah dan dianalisis kembali.
                </p>

                <a
                    href="{{ route('mahasiswa.penilaian') }}"
                    class="btn btn-outline-primary"
                >
                    <i class="bi bi-pencil-square me-2"></i>
                    Ubah Pilihan Mata Kuliah
                </a>

            </div>

        </section>

    @endif

</div>

@endsection
