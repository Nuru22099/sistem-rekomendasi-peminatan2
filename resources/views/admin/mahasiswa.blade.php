@extends('layouts.app')

@section('title', 'Data Mahasiswa')
@section('heading', 'Data Mahasiswa')

@section('content')

<style>
    .student-page {
        color: #1e293b;
        padding-bottom: 30px;
    }

    .student-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 22px;
    }

    .student-header h2 {
        font-size: 23px;
        font-weight: 800;
        color: #172554;
        margin: 0;
    }

    .student-header p {
        font-size: 12px;
        color: #94a3b8;
        margin: 6px 0 0;
    }

    .btn-add-student {
        background: #4f46e5;
        color: white;
        border: none;
        border-radius: 10px;
        padding: 11px 17px;
        font-size: 12px;
        font-weight: 700;
        transition: .2s;
    }

    .btn-add-student:hover {
        background: #3730a3;
        color: white;
        transform: translateY(-2px);
    }

    .student-summary {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 22px;
    }

    .summary-card {
        background: white;
        border: 1px solid #e9edf5;
        padding: 18px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .summary-icon {
        width: 43px;
        height: 43px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 19px;
        flex-shrink: 0;
    }

    .summary-icon.blue {
        color: #4f46e5;
        background: #eef2ff;
    }

    .summary-icon.green {
        color: #059669;
        background: #ecfdf5;
    }

    .summary-icon.orange {
        color: #ea580c;
        background: #fff7ed;
    }

    .summary-card strong {
        display: block;
        font-size: 22px;
        font-weight: 800;
        color: #172554;
    }

    .summary-card small {
        color: #94a3b8;
        font-size: 11px;
    }

    .student-panel {
        background: white;
        border: 1px solid #e9edf5;
        border-radius: 18px;
        padding: 22px;
    }

    .student-panel-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 20px;
    }

    .student-panel-heading h5 {
        font-size: 15px;
        font-weight: 800;
        color: #172554;
        margin: 0;
    }

    .student-panel-heading p {
        color: #94a3b8;
        font-size: 11px;
        margin: 5px 0 0;
    }

    .student-search {
        position: relative;
        max-width: 260px;
        width: 100%;
    }

    .student-search i {
        position: absolute;
        left: 12px;
        top: 11px;
        color: #94a3b8;
    }

    .student-search input {
        width: 100%;
        padding: 9px 12px 9px 35px;
        border: 1px solid #e2e8f0;
        border-radius: 9px;
        font-size: 12px;
        outline: none;
    }

    .student-search input:focus {
        border-color: #818cf8;
        box-shadow: 0 0 0 3px #eef2ff;
    }

    .student-table {
        white-space: nowrap;
        margin-bottom: 0;
    }

    .student-table thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .5px;
        padding: 14px 13px;
        border-bottom: 1px solid #e9edf5;
    }

    .student-table tbody td {
        padding: 15px 13px;
        vertical-align: middle;
        font-size: 12px;
        color: #475569;
        border-bottom: 1px solid #f1f5f9;
    }

    .student-table tbody tr:hover {
        background: #fafbff;
    }

    .student-profile {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .student-avatar {
        width: 37px;
        height: 37px;
        border-radius: 11px;
        background: #eef2ff;
        color: #4f46e5;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 14px;
        font-weight: 800;
    }

    .student-name {
        font-weight: 700;
        color: #334155;
    }

    .student-email {
        font-size: 10px;
        color: #94a3b8;
        margin-top: 3px;
    }

    .nim-badge {
        background: #f1f5f9;
        color: #475569;
        border-radius: 6px;
        padding: 5px 8px;
        font-size: 11px;
        font-weight: 700;
    }

    .angkatan-badge {
        background: #ecfdf5;
        color: #059669;
        border-radius: 20px;
        padding: 5px 10px;
        font-size: 10px;
        font-weight: 700;
    }

    .action-button {
        width: 31px;
        height: 31px;
        border: none;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        transition: .2s;
    }

    .action-edit {
        background: #fff7ed;
        color: #ea580c;
    }

    .action-edit:hover {
        background: #ffedd5;
    }

    .action-delete {
        background: #fef2f2;
        color: #dc2626;
    }

    .action-delete:hover {
        background: #fee2e2;
    }

    .student-form {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 20px;
        border-radius: 14px;
        margin-bottom: 22px;
    }

    .student-form h6 {
        font-size: 14px;
        font-weight: 800;
        color: #172554;
        margin-bottom: 17px;
    }

    .student-form label {
        font-size: 11px;
        font-weight: 700;
        color: #475569;
        margin-bottom: 7px;
    }

    .student-form .form-control {
        border: 1px solid #e2e8f0;
        border-radius: 9px;
        padding: 10px 12px;
        font-size: 12px;
    }

    .student-form .form-control:focus {
        border-color: #818cf8;
        box-shadow: 0 0 0 3px #eef2ff;
    }

    .btn-save {
        background: #4f46e5;
        color: white;
        border: none;
        border-radius: 9px;
        padding: 9px 17px;
        font-size: 12px;
        font-weight: 700;
    }

    .btn-save:hover {
        background: #3730a3;
        color: white;
    }

    .btn-cancel {
        background: #e2e8f0;
        color: #475569;
        border: none;
        border-radius: 9px;
        padding: 9px 17px;
        font-size: 12px;
        font-weight: 700;
    }

    .edit-row td {
        background: #f8fafc;
        padding: 18px !important;
    }

    .empty-student {
        text-align: center;
        padding: 40px !important;
        color: #94a3b8 !important;
    }

    .empty-student i {
        display: block;
        font-size: 32px;
        margin-bottom: 10px;
        color: #c7d2fe;
    }

    .student-pagination {
        margin-top: 20px;
    }

    .student-pagination nav {
        display: flex;
        justify-content: flex-end;
    }

    .student-pagination svg {
        width: 18px;
    }

    @media(max-width: 768px) {
        .student-summary {
            grid-template-columns: repeat(2, 1fr);
        }

        .student-panel {
            padding: 15px;
        }
    }

    @media(max-width: 480px) {
        .student-summary {
            grid-template-columns: 1fr;
        }

        .student-header {
            align-items: flex-start;
        }

        .student-header .btn-add-student {
            width: 100%;
        }

        .student-search {
            max-width: 100%;
        }
    }
</style>

<div class="student-page">

    {{-- HEADER --}}
    <div class="student-header">
        <div>
            <h2>Data Mahasiswa</h2>
            <p>Kelola informasi dan data mahasiswa Teknik Informatika STT-NF.</p>
        </div>

        <button
            class="btn btn-add-student"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#formTambah">

            <i class="bi bi-plus-lg me-1"></i>
            Tambah Mahasiswa
        </button>
    </div>

    {{-- RINGKASAN --}}
    <div class="student-summary">

        <div class="summary-card">
            <div class="summary-icon blue">
                <i class="bi bi-people-fill"></i>
            </div>
            <div>
                <strong>{{ $data->total() }}</strong>
                <small>Total Mahasiswa</small>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon green">
                <i class="bi bi-mortarboard-fill"></i>
            </div>
            <div>
                <strong>STT-NF</strong>
                <small>Institusi Pendidikan</small>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon orange">
                <i class="bi bi-database-fill"></i>
            </div>
            <div>
                <strong>{{ $data->count() }}</strong>
                <small>Data Halaman Ini</small>
            </div>
        </div>

    </div>

    {{-- FORM TAMBAH --}}
    <form
        id="formTambah"
        class="collapse student-form"
        method="POST"
        action="{{ route('admin.mahasiswa.simpan') }}">

        @csrf

        <h6>
            <i class="bi bi-person-plus-fill text-primary me-2"></i>
            Tambah Data Mahasiswa
        </h6>

        <div class="row g-3">

            <div class="col-md-3">
                <label>NIM</label>
                <input type="text"
                    class="form-control"
                    name="nim"
                    placeholder="Masukkan NIM"
                    value="{{ old('nim') }}"
                    required>
            </div>

            <div class="col-md-3">
                <label>Nama Lengkap</label>
                <input type="text"
                    class="form-control"
                    name="nama"
                    placeholder="Masukkan nama"
                    value="{{ old('nama') }}"
                    required>
            </div>

            <div class="col-md-3">
                <label>Email</label>
                <input type="email"
                    class="form-control"
                    name="email"
                    placeholder="Masukkan email"
                    value="{{ old('email') }}"
                    required>
            </div>

            <div class="col-md-3">
                <label>Angkatan</label>
                <input type="number"
                    class="form-control"
                    name="angkatan"
                    placeholder="Contoh: 2022"
                    value="{{ old('angkatan') }}">
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-save">
                    <i class="bi bi-check-lg me-1"></i>
                    Simpan Mahasiswa
                </button>

                <button type="button"
                    class="btn btn-cancel"
                    data-bs-toggle="collapse"
                    data-bs-target="#formTambah">
                    Batal
                </button>
            </div>

        </div>
    </form>

    {{-- TABEL --}}
    <section class="student-panel">

        <div class="student-panel-heading">
            <div>
                <h5>Daftar Mahasiswa</h5>
                <p>Informasi mahasiswa yang terdaftar di dalam sistem.</p>
            </div>

            <div class="student-search">
                <i class="bi bi-search"></i>
                <input type="text"
                    id="searchMahasiswa"
                    placeholder="Cari mahasiswa...">
            </div>
        </div>

        <div class="table-responsive">

            <table class="table student-table">

                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Mahasiswa</th>
                        <th>Program Studi</th>
                        <th>Angkatan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody id="tabelMahasiswa">

                    @forelse($data as $m)

                        <tr class="student-data-row">

                            <td>
                                <span class="nim-badge">
                                    {{ $m->nim }}
                                </span>
                            </td>

                            <td>
                                <div class="student-profile">
                                    <div class="student-avatar">
                                        {{ strtoupper(substr($m->nama, 0, 1)) }}
                                    </div>

                                    <div>
                                        <div class="student-name">
                                            {{ $m->nama }}
                                        </div>

                                        <div class="student-email">
                                            {{ $m->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td>
                                {{ $m->program_studi ?? 'Teknik Informatika' }}
                            </td>

                            <td>
                                <span class="angkatan-badge">
                                    {{ $m->angkatan ?? '-' }}
                                </span>
                            </td>

                            <td>
                                <div class="d-flex justify-content-center gap-2">

                                    {{-- EDIT --}}
                                    <button
                                        type="button"
                                        class="action-button action-edit"
                                        title="Edit mahasiswa"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#editMahasiswa{{ $m->id }}">

                                        <i class="bi bi-pencil-square"></i>
                                    </button>

                                    {{-- HAPUS --}}
                                    <form
                                        method="POST"
                                        action="{{ route('admin.mahasiswa.hapus', $m) }}"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus mahasiswa ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="action-button action-delete"
                                            title="Hapus mahasiswa">

                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                        {{-- FORM EDIT --}}
                        <tr class="collapse edit-row"
                            id="editMahasiswa{{ $m->id }}">

                            <td colspan="5">

                                <div class="student-form mb-0">

                                    <h6>
                                        <i class="bi bi-pencil-square text-warning me-2"></i>
                                        Edit Data Mahasiswa
                                    </h6>

                                    <form
                                        method="POST"
                                        action="{{ route('admin.mahasiswa.update', $m) }}"
                                        class="row g-3">

                                        @csrf
                                        @method('PUT')

                                        <div class="col-md-3">
                                            <label>NIM</label>
                                            <input type="text"
                                                name="nim"
                                                class="form-control"
                                                value="{{ $m->nim }}"
                                                required>
                                        </div>

                                        <div class="col-md-3">
                                            <label>Nama Lengkap</label>
                                            <input type="text"
                                                name="nama"
                                                class="form-control"
                                                value="{{ $m->nama }}"
                                                required>
                                        </div>

                                        <div class="col-md-3">
                                            <label>Email</label>
                                            <input type="email"
                                                name="email"
                                                class="form-control"
                                                value="{{ $m->email }}"
                                                required>
                                        </div>

                                        <div class="col-md-3">
                                            <label>Angkatan</label>
                                            <input type="number"
                                                name="angkatan"
                                                class="form-control"
                                                value="{{ $m->angkatan }}">
                                        </div>

                                        <div class="col-12">
                                            <button type="submit"
                                                class="btn btn-save">
                                                <i class="bi bi-check-lg me-1"></i>
                                                Simpan Perubahan
                                            </button>

                                            <button type="button"
                                                class="btn btn-cancel"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#editMahasiswa{{ $m->id }}">
                                                Batal
                                            </button>
                                        </div>

                                    </form>

                                </div>

                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="empty-student">
                                <i class="bi bi-people"></i>
                                Belum ada data mahasiswa.
                            </td>
                        </tr>

                    @endforelse

                    <tr id="searchEmpty" style="display:none">
                        <td colspan="5" class="empty-student">
                            Data mahasiswa tidak ditemukan.
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        <div class="student-pagination">
            {{ $data->links() }}
        </div>

    </section>

</div>

{{-- PENCARIAN TABEL --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const search = document.getElementById('searchMahasiswa');
        const rows = document.querySelectorAll('.student-data-row');
        const empty = document.getElementById('searchEmpty');

        if (!search) return;

        search.addEventListener('input', function () {

            const keyword = this.value.toLowerCase().trim();
            let visible = 0;

            rows.forEach(row => {

                const match = row.textContent
                    .toLowerCase()
                    .includes(keyword);

                row.style.display = match ? '' : 'none';

                visible += match ? 1 : 0;

                // Sembunyikan juga form edit milik baris yang difilter.
                const editRow = row.nextElementSibling;

                if (editRow && editRow.classList.contains('edit-row')) {
                    if (!match) {
                        editRow.classList.remove('show');
                    }
                }
            });

            empty.style.display = visible === 0 ? '' : 'none';
        });

    });
</script>

@endsection
