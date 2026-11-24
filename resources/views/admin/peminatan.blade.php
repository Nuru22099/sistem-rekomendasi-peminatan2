
@extends('layouts.app')

@section('title', 'Data Peminatan')
@section('heading', 'Data Peminatan')

@section('content')

<style>
    .specialization-page {
        color: #263248;
    }

    .specialization-header {
        background: linear-gradient(120deg, #172554, #3730a3, #4f46e5);
        color: #fff;
        padding: 28px;
        border-radius: 20px;
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }

    .specialization-header::after {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(255,255,255,.07);
        right: -50px;
        top: -90px;
    }

    .specialization-header h3 {
        font-size: 23px;
        font-weight: 750;
        margin-bottom: 8px;
        position: relative;
        z-index: 1;
    }

    .specialization-header p {
        color: rgba(255,255,255,.78);
        margin-bottom: 0;
        position: relative;
        z-index: 1;
    }

    .specialization-header .btn {
        position: relative;
        z-index: 2;
        border-radius: 10px;
        padding: 10px 17px;
        font-weight: 600;
    }

    .specialization-summary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .summary-card {
        background: #fff;
        border: 1px solid #edf0f5;
        border-radius: 16px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 15px;
        box-shadow: 0 4px 15px rgba(15, 23, 42, .035);
    }

    .summary-icon {
        width: 48px;
        height: 48px;
        border-radius: 13px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 22px;
        font-weight: 750;
        flex-shrink: 0;
    }

    .summary-icon.blue {
        background: #eef2ff;
        color: #4f46e5;
    }

    .summary-icon.green {
        background: #ecfdf5;
        color: #059669;
    }

    .summary-card h4 {
        font-size: 23px;
        font-weight: 750;
        margin: 0;
        color: #1e293b;
    }

    .summary-card p {
        color: #94a3b8;
        font-size: 12px;
        margin: 3px 0 0;
    }

    .specialization-panel {
        background: #fff;
        border: 1px solid #edf0f5;
        border-radius: 17px;
        padding: 22px;
        box-shadow: 0 4px 15px rgba(15, 23, 42, .035);
        margin-bottom: 22px;
    }

    .panel-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .panel-heading h5 {
        font-size: 16px;
        font-weight: 750;
        color: #263248;
        margin: 0;
    }

    .panel-heading p {
        font-size: 12px;
        color: #94a3b8;
        margin: 5px 0 0;
    }

    .specialization-form {
        background: #f8fafc;
        border: 1px solid #e8edf5;
        border-radius: 15px;
        padding: 22px;
        margin-bottom: 22px;
    }

    .specialization-form .form-label {
        font-size: 13px;
        font-weight: 650;
        color: #475569;
        margin-bottom: 7px;
    }

    .specialization-form .form-control,
    .specialization-form .form-select {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 10px 12px;
        font-size: 13px;
        box-shadow: none;
    }

    .specialization-form .form-control:focus,
    .specialization-form .form-select:focus {
        border-color: #818cf8;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, .10);
    }

    .specialization-card {
        background: #fff;
        border: 1px solid #e9edf4;
        border-radius: 17px;
        padding: 22px;
        height: 100%;
        transition: .2s ease;
        box-shadow: 0 4px 14px rgba(15, 23, 42, .025);
        position: relative;
        overflow: hidden;
    }

    .specialization-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(15, 23, 42, .07);
        border-color: #c7d2fe;
    }

    .specialization-card::before {
        content: "";
        position: absolute;
        height: 4px;
        left: 0;
        right: 0;
        top: 0;
        background: linear-gradient(90deg, #4f46e5, #818cf8);
    }

    .specialization-card.card-success::before {
        background: linear-gradient(90deg, #059669, #34d399);
    }

    .specialization-card.card-info::before {
        background: linear-gradient(90deg, #0284c7, #38bdf8);
    }

    .specialization-card.card-warning::before {
        background: linear-gradient(90deg, #d97706, #fbbf24);
    }

    .specialization-card.card-danger::before {
        background: linear-gradient(90deg, #dc2626, #f87171);
    }

    .specialization-card.card-secondary::before {
        background: linear-gradient(90deg, #64748b, #94a3b8);
    }

    .specialization-card-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 20px;
    }

    .specialization-symbol {
        width: 47px;
        height: 47px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        background: #eef2ff;
        color: #4f46e5;
        font-size: 18px;
        font-weight: 800;
    }

    .specialization-card h5 {
        font-size: 17px;
        font-weight: 750;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .specialization-code {
        font-size: 11px;
        font-weight: 750;
        padding: 6px 11px;
        border-radius: 20px;
        white-space: nowrap;
    }

    .specialization-description {
        min-height: 55px;
        color: #64748b;
        font-size: 13px;
        line-height: 1.7;
        margin-bottom: 18px;
        overflow-wrap: anywhere;
    }

    .specialization-card hr {
        border-color: #edf0f5;
        margin: 18px 0;
    }

    .specialization-actions {
        display: flex;
        gap: 8px;
        align-items: center;
        flex-wrap: wrap;
    }

    .specialization-actions .btn {
        border-radius: 8px;
        font-size: 12px;
        font-weight: 650;
        padding: 7px 13px;
    }

    .edit-box {
        background: #f8fafc;
        border: 1px solid #e5eaf2;
        border-radius: 13px;
        padding: 18px;
    }

    .edit-box h6 {
        font-size: 14px;
        font-weight: 750;
        color: #334155;
    }

    .edit-box .form-label {
        font-size: 12px;
        font-weight: 650;
        color: #475569;
    }

    .edit-box .form-control,
    .edit-box .form-select {
        border-radius: 9px;
        font-size: 13px;
        border-color: #e2e8f0;
        box-shadow: none;
    }

    .search-specialization {
        position: relative;
        width: 250px;
        max-width: 100%;
    }

    .search-specialization input {
        width: 100%;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 9px 13px 9px 36px;
        outline: none;
        font-size: 12px;
    }

    .search-specialization input:focus {
        border-color: #818cf8;
    }

    .search-specialization span {
        position: absolute;
        left: 12px;
        top: 9px;
        color: #94a3b8;
    }

    .empty-specialization {
        padding: 45px 20px;
        text-align: center;
        border: 1px dashed #dbe2ed;
        background: #f8fafc;
        border-radius: 15px;
    }

    .empty-specialization .empty-icon {
        font-size: 35px;
        color: #94a3b8;
        margin-bottom: 12px;
    }

    .empty-specialization h6 {
        font-weight: 750;
        color: #334155;
    }

    .empty-specialization p {
        color: #94a3b8;
        font-size: 13px;
        margin-bottom: 0;
    }

    .specialization-alert {
        border-radius: 11px;
        font-size: 13px;
    }

    @media (max-width: 768px) {
        .specialization-header {
            padding: 22px;
        }

        .specialization-header h3 {
            font-size: 19px;
        }

        .specialization-panel {
            padding: 16px;
        }

        .specialization-card {
            padding: 18px;
        }

        .search-specialization {
            width: 100%;
        }
    }
</style>

<div class="specialization-page">

    {{-- HEADER --}}
    <div class="specialization-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <div class="small mb-2" style="color: #c7d2fe;">
                    ADMINISTRATOR / MASTER DATA
                </div>

                <h3>Kelola Data Peminatan</h3>

                <p>
                    Atur informasi peminatan yang tersedia untuk mahasiswa
                    Teknik Informatika STT-NF.
                </p>
            </div>

            <button
                type="button"
                class="btn btn-light"
                data-bs-toggle="collapse"
                data-bs-target="#formTambah"
                aria-expanded="{{ $errors->any() ? 'true' : 'false' }}">
                + Tambah Peminatan
            </button>
        </div>
    </div>

    {{-- SUMMARY --}}
    <div class="specialization-summary">

        <div class="summary-card">
            <div class="summary-icon blue">P</div>
            <div>
                <h4>{{ $data->count() }}</h4>
                <p>Data peminatan ditampilkan</p>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon green">TI</div>
            <div>
                <h4>STT-NF</h4>
                <p>Teknik Informatika</p>
            </div>
        </div>

    </div>

    {{-- PESAN SUKSES --}}
    @if(session('success'))
        <div class="alert alert-success specialization-alert">
            <strong>Berhasil!</strong> {{ session('success') }}
        </div>
    @endif

    {{-- PESAN ERROR --}}
    @if(session('error'))
        <div class="alert alert-danger specialization-alert">
            <strong>Gagal!</strong> {{ session('error') }}
        </div>
    @endif

    {{-- PESAN VALIDASI --}}
    @if($errors->any())
        <div class="alert alert-danger specialization-alert">
            <strong>Periksa kembali data yang dimasukkan:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM TAMBAH PEMINATAN --}}
    <div class="collapse {{ $errors->any() ? 'show' : '' }}" id="formTambah">
        <div class="specialization-panel">

            <div class="panel-heading">
                <div>
                    <h5>Tambah Peminatan Baru</h5>
                    <p>Lengkapi informasi peminatan di bawah ini.</p>
                </div>
            </div>

            <form
                method="POST"
                action="{{ route('admin.peminatan.simpan') }}"
                class="specialization-form">

                @csrf

                <div class="row g-3">

                    <div class="col-md-4">
                        <label class="form-label">Kode Peminatan</label>
                        <input
                            type="text"
                            name="kode"
                            class="form-control"
                            placeholder="Contoh: AI"
                            value="{{ old('kode') }}"
                            required>
                    </div>

                    <div class="col-md-8">
                        <label class="form-label">Nama Peminatan</label>
                        <input
                            type="text"
                            name="nama"
                            class="form-control"
                            placeholder="Masukkan nama peminatan"
                            value="{{ old('nama') }}"
                            required>
                    </div>

                    <div class="col-md-5">
                        <label class="form-label">Warna Identitas</label>
                        <select name="warna" class="form-select">
                            <option value="">-- Pilih Warna --</option>
                            <option value="primary" @selected(old('warna') == 'primary')>Biru</option>
                            <option value="success" @selected(old('warna') == 'success')>Hijau</option>
                            <option value="info" @selected(old('warna') == 'info')>Biru Muda</option>
                            <option value="warning" @selected(old('warna') == 'warning')>Kuning</option>
                            <option value="danger" @selected(old('warna') == 'danger')>Merah</option>
                            <option value="secondary" @selected(old('warna') == 'secondary')>Abu-abu</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Deskripsi Peminatan</label>
                        <textarea
                            name="deskripsi"
                            class="form-control"
                            rows="4"
                            placeholder="Jelaskan gambaran umum peminatan...">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div class="col-12 d-flex gap-2 flex-wrap">
                        <button type="submit" class="btn btn-primary px-4">
                            Simpan Peminatan
                        </button>

                        <button
                            type="button"
                            class="btn btn-light border px-4"
                            data-bs-toggle="collapse"
                            data-bs-target="#formTambah">
                            Batal
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    {{-- DAFTAR PEMINATAN --}}
    <div class="specialization-panel">

        <div class="panel-heading">
            <div>
                <h5>Daftar Peminatan</h5>
                <p>Informasi dan pengelolaan data peminatan.</p>
            </div>

            <div class="search-specialization">
                <span>⌕</span>
                <input
                    type="text"
                    id="searchPeminatan"
                    placeholder="Cari nama atau kode...">
            </div>
        </div>

        <div class="row g-3" id="listPeminatan">

            @forelse($data as $p)

                @php
                    $warna = in_array($p->warna, [
                        'primary',
                        'success',
                        'info',
                        'warning',
                        'danger',
                        'secondary'
                    ]) ? $p->warna : 'primary';
                @endphp

                <div
                    class="col-md-6 specialization-item"
                    data-search="{{ strtolower($p->nama . ' ' . $p->kode . ' ' . ($p->deskripsi ?? '')) }}">

                    <div class="specialization-card card-{{ $warna }}">

                        {{-- INFORMASI PEMINATAN --}}
                        <div class="specialization-card-top">

                            <div class="specialization-symbol">
                                {{ strtoupper(substr($p->kode, 0, 2)) }}
                            </div>

                            <span class="specialization-code text-bg-{{ $warna }}">
                                {{ $p->kode }}
                            </span>

                        </div>

                        <h5>{{ $p->nama }}</h5>

                        <p class="specialization-description">
                            {{ $p->deskripsi ?: 'Belum ada deskripsi peminatan.' }}
                        </p>

                        <hr>

                        {{-- TOMBOL AKSI --}}
                        <div class="specialization-actions">

                            <button
                                type="button"
                                class="btn btn-outline-warning"
                                data-bs-toggle="collapse"
                                data-bs-target="#editPeminatan{{ $p->id }}">
                                Edit Data
                            </button>

                            <form
                                method="POST"
                                action="{{ route('admin.peminatan.hapus', $p) }}"
                                onsubmit="return confirm('Yakin ingin menghapus peminatan {{ $p->nama }}?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-outline-danger">
                                    Hapus
                                </button>

                            </form>

                        </div>

                        {{-- FORM EDIT --}}
                        <div class="collapse mt-3" id="editPeminatan{{ $p->id }}">

                            <div class="edit-box">

                                <h6 class="mb-3">Edit Informasi Peminatan</h6>

                                <form
                                    method="POST"
                                    action="{{ route('admin.peminatan.update', $p) }}"
                                    class="row g-3">

                                    @csrf
                                    @method('PUT')

                                    <div class="col-md-4">
                                        <label class="form-label">Kode Peminatan</label>
                                        <input
                                            type="text"
                                            name="kode"
                                            class="form-control"
                                            value="{{ $p->kode }}"
                                            required>
                                    </div>

                                    <div class="col-md-8">
                                        <label class="form-label">Nama Peminatan</label>
                                        <input
                                            type="text"
                                            name="nama"
                                            class="form-control"
                                            value="{{ $p->nama }}"
                                            required>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Warna Identitas</label>
                                        <select name="warna" class="form-select">
                                            <option value="primary" @selected($p->warna == 'primary')>Biru</option>
                                            <option value="success" @selected($p->warna == 'success')>Hijau</option>
                                            <option value="info" @selected($p->warna == 'info')>Biru Muda</option>
                                            <option value="warning" @selected($p->warna == 'warning')>Kuning</option>
                                            <option value="danger" @selected($p->warna == 'danger')>Merah</option>
                                            <option value="secondary" @selected($p->warna == 'secondary')>Abu-abu</option>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea
                                            name="deskripsi"
                                            class="form-control"
                                            rows="4">{{ $p->deskripsi }}</textarea>
                                    </div>

                                    <div class="col-12 d-flex gap-2 flex-wrap">
                                        <button type="submit" class="btn btn-success btn-sm px-3">
                                            Simpan Perubahan
                                        </button>

                                        <button
                                            type="button"
                                            class="btn btn-secondary btn-sm px-3"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#editPeminatan{{ $p->id }}">
                                            Batal
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            @empty

                <div class="col-12">
                    <div class="empty-specialization">
                        <div class="empty-icon">◇</div>
                        <h6>Belum Ada Data Peminatan</h6>
                        <p>Silakan tambahkan data peminatan melalui tombol tambah peminatan.</p>
                    </div>
                </div>

            @endforelse

            {{-- HASIL PENCARIAN KOSONG --}}
            <div class="col-12 d-none" id="searchEmpty">
                <div class="empty-specialization">
                    <div class="empty-icon">⌕</div>
                    <h6>Data Tidak Ditemukan</h6>
                    <p>Coba gunakan kata kunci atau kode peminatan lainnya.</p>
                </div>
            </div>

        </div>
    </div>

</div>

{{-- PENCARIAN DATA --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchPeminatan');
        const items = document.querySelectorAll('.specialization-item');
        const searchEmpty = document.getElementById('searchEmpty');

        if (!searchInput) return;

        searchInput.addEventListener('input', function () {
            const keyword = this.value.toLowerCase().trim();
            let visibleCount = 0;

            items.forEach(function (item) {
                const searchText = item.getAttribute('data-search') || '';
                const match = searchText.includes(keyword);

                item.classList.toggle('d-none', !match);

                if (match) {
                    visibleCount++;
                }
            });

            if (searchEmpty) {
                searchEmpty.classList.toggle(
                    'd-none',
                    visibleCount > 0 || items.length === 0
                );
            }
        });
    });
</script>

@endsection
