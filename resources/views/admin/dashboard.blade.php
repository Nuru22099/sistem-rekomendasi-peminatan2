@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('heading', 'Dashboard Admin')

@section('content')

<style>
    :root {
        --primary: #4f46e5;
        --primary-light: #eef2ff;
        --dark: #172554;
        --muted: #64748b;
        --surface: #ffffff;
        --border: #e9edf5;
    }

    .dashboard-modern {
        color: #1e293b;
        padding-bottom: 30px;
    }

    /* HEADER */
    .welcome-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .welcome-header h2 {
        font-size: 23px;
        font-weight: 750;
        margin: 0;
        color: #172554;
    }

    .welcome-header p {
        color: #94a3b8;
        font-size: 13px;
        margin: 5px 0 0;
    }

    .admin-label {
        background: #eef2ff;
        color: #4f46e5;
        padding: 9px 15px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 700;
    }

    /* HERO */
    .hero-modern {
        position: relative;
        overflow: hidden;
        padding: 35px;
        border-radius: 22px;
        background: linear-gradient(120deg, #172554, #3730a3 65%, #6366f1);
        color: white;
        margin-bottom: 25px;
        min-height: 215px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .hero-modern::before {
        content: "";
        position: absolute;
        width: 280px;
        height: 280px;
        right: 15%;
        top: -170px;
        border: 1px solid rgba(255,255,255,.15);
        border-radius: 50%;
        box-shadow: 0 0 0 35px rgba(255,255,255,.04),
                    0 0 0 70px rgba(255,255,255,.03);
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-tag {
        font-size: 11px;
        letter-spacing: 2px;
        color: #c7d2fe;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .hero-modern h1 {
        font-size: clamp(24px, 3vw, 34px);
        font-weight: 800;
        line-height: 1.25;
        margin-bottom: 10px;
    }

    .hero-modern h1 span {
        color: #a5b4fc;
    }

    .hero-modern p {
        font-size: 13px;
        color: #dbeafe;
        margin-bottom: 18px;
    }

    .hero-button {
        display: inline-block;
        text-decoration: none;
        background: white;
        color: #3730a3;
        padding: 10px 17px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 700;
        transition: .25s;
    }

    .hero-button:hover {
        background: #e0e7ff;
        color: #312e81;
        transform: translateY(-2px);
    }

    .hero-icon {
        position: relative;
        z-index: 2;
        width: 145px;
        height: 145px;
        border-radius: 35px;
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.2);
        display: flex;
        align-items: center;
        justify-content: center;
        transform: rotate(-8deg);
    }

    .hero-icon i {
        font-size: 75px;
        color: #c7d2fe;
    }

    /* STATISTICS */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 17px;
        margin-bottom: 25px;
    }

    .stat-card-modern {
        background: white;
        border: 1px solid var(--border);
        border-radius: 17px;
        padding: 20px;
        text-decoration: none;
        color: inherit;
        display: block;
        transition: .25s;
    }

    .stat-card-modern:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(15,23,42,.07);
        color: inherit;
        border-color: #c7d2fe;
    }

    .stat-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 17px;
    }

    .stat-icon-modern {
        width: 43px;
        height: 43px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .stat-blue { background: #eef2ff; color: #4f46e5; }
    .stat-green { background: #ecfdf5; color: #059669; }
    .stat-purple { background: #f5f3ff; color: #7c3aed; }
    .stat-orange { background: #fff7ed; color: #ea580c; }

    .stat-arrow {
        color: #cbd5e1;
        font-size: 16px;
    }

    .stat-card-modern h2 {
        font-size: 29px;
        font-weight: 800;
        margin: 0 0 4px;
        color: #172554;
    }

    .stat-card-modern span {
        font-size: 12px;
        color: #94a3b8;
        font-weight: 600;
    }

    /* PANELS */
    .dashboard-grid {
        display: grid;
        grid-template-columns: 0.9fr 1.4fr;
        gap: 20px;
    }

    .modern-panel {
        background: white;
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 23px;
        min-width: 0;
    }

    .panel-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 23px;
        gap: 10px;
    }

    .panel-title h5 {
        font-size: 15px;
        font-weight: 750;
        color: #172554;
        margin: 0;
    }

    .panel-title p {
        color: #94a3b8;
        font-size: 11px;
        margin: 5px 0 0;
    }

    /* PEMINATAN */
    .interest-content {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 25px;
        min-height: 185px;
    }

    .interest-circle {
        width: 145px;
        height: 145px;
        border-radius: 50%;
        background: conic-gradient(
            #6366f1 0% 50%,
            #06b6d4 50% 100%
        );
        display: flex;
        justify-content: center;
        align-items: center;
        flex-shrink: 0;
    }

    .interest-inner {
        width: 105px;
        height: 105px;
        border-radius: 50%;
        background: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .interest-inner strong {
        font-size: 28px;
        color: #172554;
    }

    .interest-inner small {
        color: #94a3b8;
        font-size: 10px;
    }

    .interest-legend p {
        display: flex;
        align-items: center;
        gap: 9px;
        font-size: 12px;
        color: #475569;
        margin-bottom: 16px;
    }

    .legend-color {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .interest-legend small {
        display: block;
        color: #94a3b8;
        font-size: 10px;
        margin-top: 3px;
    }

    /* ACTIVITY */
    .activity-link {
        color: #4f46e5;
        font-size: 11px;
        font-weight: 700;
        text-decoration: none;
    }

    .activity-item {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 13px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 39px;
        height: 39px;
        background: #eef2ff;
        color: #4f46e5;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 16px;
    }

    .activity-info {
        flex: 1;
        min-width: 0;
    }

    .activity-info h6 {
        font-size: 12px;
        font-weight: 700;
        margin: 0 0 4px;
        color: #334155;
    }

    .activity-info p {
        font-size: 11px;
        color: #94a3b8;
        margin: 0;
    }

    .activity-time {
        font-size: 10px;
        color: #94a3b8;
        white-space: nowrap;
    }

    .empty-activity {
        text-align: center;
        padding: 35px 10px;
        color: #94a3b8;
    }

    .empty-activity i {
        font-size: 35px;
        display: block;
        margin-bottom: 10px;
        color: #c7d2fe;
    }

    .empty-activity p {
        font-size: 12px;
    }

    /* RESPONSIVE */
    @media(max-width: 1100px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }

    @media(max-width: 576px) {
        .hero-modern {
            padding: 25px 20px;
        }

        .hero-icon {
            display: none;
        }

        .stats-grid {
            gap: 10px;
        }

        .stat-card-modern {
            padding: 15px;
        }

        .stat-card-modern h2 {
            font-size: 24px;
        }

        .interest-content {
            flex-direction: column;
        }

        .modern-panel {
            padding: 17px;
        }

        .activity-time {
            font-size: 9px;
        }
    }
</style>

<div class="dashboard-modern">

    {{-- HEADER --}}
    <div class="welcome-header">
        <div>
            <h2>Overview Dashboard</h2>
            <p>Selamat datang di panel administrasi sistem rekomendasi.</p>
        </div>

        <div class="admin-label">
            <i class="bi bi-shield-check"></i>
            Administrator
        </div>
    </div>

    {{-- HERO --}}
    <section class="hero-modern">
        <div class="hero-content">
            <div class="hero-tag">
                STT-NF · TEKNIK INFORMATIKA
            </div>

            <h1>
                Sistem Rekomendasi<br>
                <span>Mata Kuliah Peminatan</span>
            </h1>

            <p>
                Membantu mahasiswa menentukan peminatan
                berdasarkan hasil analisis nilai mata kuliah.
            </p>

            <a href="{{ route('admin.rekomendasi') }}"
               class="hero-button">
                <i class="bi bi-graph-up-arrow"></i>
                Lihat Rekomendasi
            </a>
        </div>

        <div class="hero-icon">
            <i class="bi bi-cpu-fill"></i>
        </div>
    </section>

    {{-- STATISTIK --}}
    <div class="stats-grid">

        @foreach([
            [
                'people-fill',
                $jumlahMahasiswa,
                'Total Mahasiswa',
                'stat-blue',
                'admin.mahasiswa'
            ],
            [
                'book-half',
                $jumlahMk,
                'Mata Kuliah',
                'stat-green',
                'admin.mk'
            ],
            [
                'mortarboard-fill',
                $jumlahPeminatan,
                'Data Peminatan',
                'stat-purple',
                'admin.peminatan'
            ],
            [
                'graph-up-arrow',
                $jumlahRekomendasi,
                'Total Rekomendasi',
                'stat-orange',
                'admin.rekomendasi'
            ]
        ] as $s)

            <a href="{{ route($s[4]) }}"
               class="stat-card-modern">

                <div class="stat-top">
                    <div class="stat-icon-modern {{ $s[3] }}">
                        <i class="bi bi-{{ $s[0] }}"></i>
                    </div>

                    <i class="bi bi-arrow-up-right stat-arrow"></i>
                </div>

                <h2>{{ $s[1] }}</h2>
                <span>{{ $s[2] }}</span>

            </a>

        @endforeach

    </div>

    {{-- PANEL DASHBOARD --}}
    <div class="dashboard-grid">

        {{-- STATISTIK PEMINATAN --}}
        <section class="modern-panel">

            <div class="panel-title">
                <div>
                    <h5>Distribusi Peminatan</h5>
                    <p>Komposisi bidang rekomendasi</p>
                </div>

                <i class="bi bi-pie-chart-fill text-primary"></i>
            </div>

            <div class="interest-content">

                <div class="interest-circle">
                    <div class="interest-inner">
                        <strong>2</strong>
                        <small>Peminatan</small>
                    </div>
                </div>

                <div class="interest-legend">

                    <p>
                        <i class="legend-color"
                           style="background:#6366f1"></i>
                        <span>
                            Artificial Intelligence
                            <small>Bidang kecerdasan buatan</small>
                        </span>
                    </p>

                    <p>
                        <i class="legend-color"
                           style="background:#06b6d4"></i>
                        <span>
                            Cyber Security
                            <small>Bidang keamanan siber</small>
                        </span>
                    </p>

                </div>
            </div>

        </section>

        {{-- AKTIVITAS --}}
        <section class="modern-panel">

            <div class="panel-title">
                <div>
                    <h5>Aktivitas Terbaru</h5>
                    <p>Riwayat rekomendasi mahasiswa</p>
                </div>

                <a href="{{ route('admin.rekomendasi') }}"
                   class="activity-link">
                    Lihat Semua
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            @forelse($aktivitas as $a)

                <div class="activity-item">

                    <div class="activity-icon">
                        <i class="bi bi-person-check-fill"></i>
                    </div>

                    <div class="activity-info">
                        <h6>
                            {{ optional($a->mahasiswa)->nama ?? 'Mahasiswa' }}
                        </h6>

                        <p>
                            NIM:
                            {{ optional($a->mahasiswa)->nim ?? '-' }}
                            · Proses rekomendasi
                        </p>
                    </div>

                    <div class="activity-time">
                        {{ $a->created_at?->diffForHumans() ?? '-' }}
                    </div>

                </div>

            @empty

                <div class="empty-activity">
                    <i class="bi bi-inbox"></i>
                    <p>Belum ada aktivitas rekomendasi.</p>
                </div>

            @endforelse

        </section>

    </div>

</div>

@endsection
