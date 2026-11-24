<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Sistem Rekomendasi') · STT-NF
    </title>

    {{-- BOOTSTRAP CSS --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    {{-- BOOTSTRAP ICONS --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >

    {{-- CUSTOM CSS --}}
    <link href="{{ asset('css/sttnf.css') }}" rel="stylesheet">

    @stack('styles')

    <style>
        /* ==============================
           GLOBAL
        ============================== */

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #f5f7fb;
            color: #263248;
        }

        .app-layout {
            min-height: 100vh;
            background: #f5f7fb;
        }

        /* ==============================
           SIDEBAR
        ============================== */

        .app-layout .sidebar {
            width: 265px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            background: #fff;
            border-right: 1px solid #edf0f5;
            box-shadow: 4px 0 20px rgba(15, 23, 42, .025);
            transition: transform .3s ease;
        }

        .app-layout .brand {
            min-height: 91px;
            padding: 19px 22px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            border-bottom: 1px solid #f1f3f7;
        }

        .logo-sttnf {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 12px;
        }

        .app-layout .brand-copy b {
            display: block;
            font-size: 16px;
            color: #172554;
            font-weight: 800;
            letter-spacing: .3px;
        }

        .app-layout .brand-copy small {
            display: block;
            color: #94a3b8;
            font-size: 10px;
            line-height: 1.5;
            margin-top: 3px;
        }

        /* ==============================
           SIDEBAR NAVIGATION
        ============================== */

        .app-layout .side-nav {
            flex: 1;
            padding: 23px 15px;
            overflow-y: auto;
        }

        .app-layout .nav-section-title {
            color: #a0aaba;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 0 12px;
            margin: 0 0 12px;
        }

        .app-layout .side-nav a {
            min-height: 45px;
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 11px 13px;
            margin-bottom: 6px;
            border-radius: 10px;
            color: #64748b;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: .2s ease;
        }

        .app-layout .side-nav a i {
            width: 20px;
            text-align: center;
            font-size: 17px;
        }

        .app-layout .side-nav a:hover {
            background: #f1f5ff;
            color: #4f46e5;
        }

        .app-layout .side-nav a.active {
            background: linear-gradient(100deg, #eef2ff, #f3f4ff);
            color: #4338ca;
            font-weight: 750;
            box-shadow: inset 3px 0 0 #4f46e5;
        }

        /* ==============================
           USER PROFILE SIDEBAR
        ============================== */

        .app-layout .sidebar-profile {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 17px 18px;
            border-top: 1px solid #edf0f5;
            background: #fff;
        }

        .app-layout .profile-avatar {
            width: 39px;
            height: 39px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eef2ff;
            color: #4f46e5;
            border-radius: 12px;
            font-size: 19px;
        }

        .app-layout .profile-details {
            min-width: 0;
        }

        .app-layout .sidebar-profile b {
            display: block;
            max-width: 165px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: #334155;
            font-size: 12px;
            font-weight: 750;
        }

        .app-layout .sidebar-profile small {
            display: block;
            max-width: 165px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: #94a3b8;
            font-size: 10px;
            margin-top: 3px;
        }

        /* ==============================
           MAIN CONTENT
        ============================== */

        .app-layout .main-shell {
            min-height: 100vh;
            margin-left: 265px;
            transition: margin .3s ease;
        }

        /* ==============================
           TOPBAR
        ============================== */

        .app-layout .topbar {
            height: 75px;
            position: sticky;
            top: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 0 30px;
            background: rgba(255,255,255,.96);
            border-bottom: 1px solid #edf0f5;
            backdrop-filter: blur(12px);
        }

        .app-layout .topbar-left,
        .app-layout .topbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .app-layout .topbar-left strong {
            color: #263248;
            font-size: 16px;
            font-weight: 750;
        }

        .app-layout .menu-toggle {
            width: 38px;
            height: 38px;
            display: none;
            align-items: center;
            justify-content: center;
            border: 1px solid #e5eaf2;
            border-radius: 9px;
            background: #fff;
            color: #475569;
            font-size: 21px;
        }

        .app-layout .notification {
            position: relative;
            color: #64748b;
            font-size: 17px;
            padding: 5px;
        }

        .app-layout .top-avatar {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eef2ff;
            color: #4f46e5;
            border-radius: 11px;
            font-size: 18px;
        }

        .app-layout .top-user {
            color: #475569;
            font-size: 12px;
            font-weight: 700;
        }

        .app-layout .logout-button {
            width: 37px;
            height: 37px;
            border: 1px solid #fee2e2;
            border-radius: 10px;
            background: #fff5f5;
            color: #dc2626;
            font-size: 17px;
            transition: .2s;
        }

        .app-layout .logout-button:hover {
            background: #fee2e2;
            color: #b91c1c;
        }

        /* ==============================
           PAGE CONTENT
        ============================== */

        .app-layout .page-content {
            padding: 27px 30px;
            min-height: calc(100vh - 75px);
        }

        .app-layout .page-content > .alert {
            border-radius: 11px;
            font-size: 13px;
        }

        /* ==============================
           SIDEBAR MOBILE OVERLAY
        ============================== */

        .sidebar-backdrop {
            display: none;
        }

        /* ==============================
           RESPONSIVE
        ============================== */

        @media (max-width: 992px) {

            .app-layout .sidebar {
                transform: translateX(-100%);
            }

            .app-layout .main-shell {
                margin-left: 0;
            }

            .app-layout .menu-toggle {
                display: flex;
            }

            body.sidebar-open .app-layout .sidebar {
                transform: translateX(0);
            }

            body.sidebar-open .sidebar-backdrop {
                display: block;
                position: fixed;
                inset: 0;
                z-index: 1040;
                background: rgba(15, 23, 42, .45);
            }

            .app-layout .topbar {
                padding: 0 20px;
            }

            .app-layout .page-content {
                padding: 22px 20px;
            }
        }

        @media (max-width: 576px) {

            .app-layout .topbar {
                height: 65px;
                padding: 0 14px;
            }

            .app-layout .topbar-left {
                gap: 10px;
            }

            .app-layout .topbar-left strong {
                font-size: 14px;
            }

            .app-layout .topbar-right {
                gap: 9px;
            }

            .app-layout .top-user {
                display: none;
            }

            .app-layout .notification {
                display: none;
            }

            .app-layout .page-content {
                padding: 17px 13px;
            }
        }
    </style>
</head>

<body>

    @auth

        @php
            $user = auth()->user();
            $isAdmin = $user->role === 'admin';
        @endphp

        <div class="app-layout">

            {{-- SIDEBAR --}}
            <aside class="sidebar" id="sidebar">

                {{-- BRAND --}}
                <a
                    class="brand"
                    href="{{ $isAdmin ? route('admin.dashboard') : route('mahasiswa.dashboard') }}"
                >
                    <span class="brand-logo">
                        <img
                            src="https://assets.siakadcloud.com/uploads/sttnurulfikri/logoaplikasi/1405.jpg"
                            alt="Logo STT-NF"
                            class="logo-sttnf"
                        >
                    </span>

                    <span class="brand-copy">
                        <small>
                            Sistem Rekomendasi
                            <br>
                            Mata Kuliah Peminatan
                        </small>
                    </span>
                </a>

                {{-- NAVIGASI --}}
                <nav class="side-nav">

                    @if($isAdmin)

                        <p class="nav-section-title">Menu Utama</p>

                        {{-- DASHBOARD --}}
                        <a
                            class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}"
                        >
                            <i class="bi bi-house-door-fill"></i>
                            <span>Dashboard</span>
                        </a>

                        <p class="nav-section-title mt-4">Master Data</p>

                        {{-- DATA MAHASISWA --}}
                        <a
                            class="{{ request()->routeIs('admin.mahasiswa*') ? 'active' : '' }}"
                            href="{{ route('admin.mahasiswa') }}"
                        >
                            <i class="bi bi-people-fill"></i>
                            <span>Data Mahasiswa</span>
                        </a>

                        {{-- DATA MATA KULIAH --}}
                        <a
                            class="{{ request()->routeIs('admin.mk*') ? 'active' : '' }}"
                            href="{{ route('admin.mk') }}"
                        >
                            <i class="bi bi-book-half"></i>
                            <span>Data Mata Kuliah</span>
                        </a>

                        {{-- DATA PEMINATAN --}}
                        <a
                            class="{{ request()->routeIs('admin.peminatan*') ? 'active' : '' }}"
                            href="{{ route('admin.peminatan') }}"
                        >
                            <i class="bi bi-star-fill"></i>
                            <span>Data Peminatan</span>
                        </a>

                        <p class="nav-section-title mt-4">Analisis</p>

                        {{-- REKOMENDASI --}}
                        <a
                            class="{{ request()->routeIs('admin.rekomendasi*') ? 'active' : '' }}"
                            href="{{ route('admin.rekomendasi') }}"
                        >
                            <i class="bi bi-lightbulb-fill"></i>
                            <span>Rekomendasi</span>
                        </a>

                        {{-- LAPORAN --}}
                        <a
                            class="{{ request()->routeIs('admin.laporan*') ? 'active' : '' }}"
                            href="{{ route('admin.laporan') }}"
                        >
                            <i class="bi bi-bar-chart-fill"></i>
                            <span>Laporan</span>
                        </a>

                    @else

                        <p class="nav-section-title">Menu Mahasiswa</p>

                        {{-- DASHBOARD MAHASISWA --}}
                        <a
                            class="{{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}"
                            href="{{ route('mahasiswa.dashboard') }}"
                        >
                            <i class="bi bi-house-door-fill"></i>
                            <span>Dashboard</span>
                        </a>

                        {{-- ANALISIS MATA KULIAH --}}
                        <a
                            class="{{ request()->routeIs('mahasiswa.penilaian*') ? 'active' : '' }}"
                            href="{{ route('mahasiswa.penilaian') }}"
                        >
                            <i class="bi bi-journal-check"></i>
                            <span>Analisis Mata Kuliah</span>
                        </a>

                        {{-- HASIL REKOMENDASI --}}
                        <a
                            class="{{ request()->routeIs('mahasiswa.hasil*') ? 'active' : '' }}"
                            href="{{ route('mahasiswa.hasil') }}"
                        >
                            <i class="bi bi-stars"></i>
                            <span>Hasil Rekomendasi</span>
                        </a>

                    @endif

                </nav>

                {{-- PROFIL PENGGUNA --}}
                <div class="sidebar-profile">

                    <div class="profile-avatar">
                        <i class="bi bi-person-fill"></i>
                    </div>

                    <div class="profile-details">
                        <b>{{ $user->name }}</b>

                        <small>
                            {{ $user->email }}
                        </small>
                    </div>

                </div>

            </aside>

            {{-- BACKDROP MOBILE --}}
            <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

            {{-- MAIN CONTENT --}}
            <main class="main-shell">

                {{-- TOPBAR --}}
                <header class="topbar">

                    <div class="topbar-left">

                        <button
                            class="menu-toggle"
                            type="button"
                            id="sidebarToggle"
                            aria-label="Buka navigasi"
                            aria-expanded="false"
                        >
                            <i class="bi bi-list"></i>
                        </button>

                        <strong>
                            @yield('heading', 'Dashboard')
                        </strong>

                    </div>

                    {{-- TOPBAR RIGHT --}}
                    <div class="topbar-right">

                        <span class="notification" title="Notifikasi">
                            <i class="bi bi-bell"></i>
                        </span>

                        <span class="top-avatar">
                            <i class="bi bi-person-fill"></i>
                        </span>

                        <span class="top-user">
                            {{ $isAdmin ? 'Administrator' : 'Mahasiswa' }}
                        </span>

                        {{-- LOGOUT --}}
                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                            onsubmit="return confirm('Apakah Anda yakin ingin keluar dari sistem?')"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="logout-button"
                                title="Logout"
                            >
                                <i class="bi bi-box-arrow-right"></i>
                            </button>

                        </form>

                    </div>

                </header>

                {{-- HALAMAN CONTENT --}}
                <div class="page-content">

                    {{-- PESAN SUKSES --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('success') }}

                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"
                                aria-label="Close"
                            ></button>
                        </div>
                    @endif

                    {{-- PESAN ERROR --}}
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="bi bi-exclamation-circle-fill me-2"></i>
                            {{ session('error') }}

                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"
                                aria-label="Close"
                            ></button>
                        </div>
                    @endif

                    {{-- PESAN VALIDASI --}}
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            {{ $errors->first() }}

                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"
                                aria-label="Close"
                            ></button>
                        </div>
                    @endif

                    {{-- ISI HALAMAN --}}
                    @yield('content')

                </div>

            </main>

        </div>

    @else

        {{-- HALAMAN GUEST / LOGIN --}}
        @yield('guest')

    @endauth

    {{-- BOOTSTRAP JAVASCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- SIDEBAR MOBILE --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const toggle = document.getElementById('sidebarToggle');
            const backdrop = document.getElementById('sidebarBackdrop');
            const sidebar = document.getElementById('sidebar');

            function closeSidebar() {
                document.body.classList.remove('sidebar-open');

                if (toggle) {
                    toggle.setAttribute('aria-expanded', 'false');
                    toggle.setAttribute('aria-label', 'Buka navigasi');
                }
            }

            function openSidebar() {
                document.body.classList.add('sidebar-open');

                if (toggle) {
                    toggle.setAttribute('aria-expanded', 'true');
                    toggle.setAttribute('aria-label', 'Tutup navigasi');
                }
            }

            if (toggle) {
                toggle.addEventListener('click', function () {
                    const isOpen = document.body.classList.contains('sidebar-open');

                    if (isOpen) {
                        closeSidebar();
                    } else {
                        openSidebar();
                    }
                });
            }

            if (backdrop) {
                backdrop.addEventListener('click', closeSidebar);
            }

            if (sidebar) {
                sidebar.querySelectorAll('.side-nav a').forEach(function (link) {
                    link.addEventListener('click', function () {
                        if (window.innerWidth <= 992) {
                            closeSidebar();
                        }
                    });
                });
            }

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    closeSidebar();
                }
            });

            window.addEventListener('resize', function () {
                if (window.innerWidth > 992) {
                    closeSidebar();
                }
            });

        });
    </script>

    @stack('scripts')

</body>
</html>
