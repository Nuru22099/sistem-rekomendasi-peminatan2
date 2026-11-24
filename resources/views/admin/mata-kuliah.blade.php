@extends('layouts.app')

@section('title', 'Data Mata Kuliah')
@section('heading', 'Data Mata Kuliah')

@section('content')

<style>
    .course-page {
        color: #1e293b;
        padding-bottom: 30px;
    }

    .course-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 22px;
    }

    .course-header h2 {
        font-size: 23px;
        font-weight: 800;
        color: #172554;
        margin: 0;
    }

    .course-header p {
        font-size: 12px;
        color: #94a3b8;
        margin: 6px 0 0;
    }

    .btn-add-course {
        background: #4f46e5;
        color: white;
        border: none;
        border-radius: 10px;
        padding: 11px 17px;
        font-size: 12px;
        font-weight: 700;
        transition: .2s;
    }

    .btn-add-course:hover {
        background: #3730a3;
        color: white;
        transform: translateY(-2px);
    }

    /* SUMMARY */
    .course-summary {
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

    /* ALERT */
    .course-alert {
        border: none;
        border-radius: 11px;
        font-size: 12px;
        padding: 13px 16px;
    }

    /* FORM */
    .course-form {
        background: white;
        border: 1px solid #e0e7ff;
        padding: 22px;
        border-radius: 16px;
        margin-bottom: 22px;
        box-shadow: 0 5px 20px rgba(79,70,229,.04);
    }

    .course-form h5 {
        font-size: 15px;
        font-weight: 800;
        color: #172554;
        margin-bottom: 5px;
    }

    .course-form .form-description {
        color: #94a3b8;
        font-size: 11px;
        margin-bottom: 20px;
    }

    .course-form label {
        font-size: 11px;
        font-weight: 700;
        color: #475569;
        margin-bottom: 7px;
    }

    .course-form .form-control,
    .course-form .form-select {
        border: 1px solid #e2e8f0;
        border-radius: 9px;
        padding: 10px 12px;
        font-size: 12px;
    }

    .course-form .form-control:focus,
    .course-form .form-select:focus {
        border-color: #818cf8;
        box-shadow: 0 0 0 3px #eef2ff;
    }

    .btn-save {
        background: #4f46e5;
        color: white;
        border: none;
        border-radius: 9px;
        padding: 10px 18px;
        font-size: 12px;
        font-weight: 700;
    }

    .btn-save:hover {
        background: #3730a3;
        color: white;
    }

    .btn-cancel {
        background: #f1f5f9;
        color: #475569;
        border: none;
        border-radius: 9px;
        padding: 10px 18px;
        font-size: 12px;
        font-weight: 700;
    }

    /* TABLE PANEL */
    .course-panel {
        background: white;
        border: 1px solid #e9edf5;
        border-radius: 18px;
        padding: 22px;
    }

    .course-panel-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 20px;
    }

    .course-panel-header h5 {
        font-size: 15px;
        font-weight: 800;
        color: #172554;
        margin: 0;
    }

    .course-panel-header p {
        font-size: 11px;
        color: #94a3b8;
        margin: 5px 0 0;
    }

    .course-search {
        position: relative;
        width: 250px;
        max-width: 100%;
    }

    .course-search i {
        position: absolute;
        left: 12px;
        top: 11px;
        color: #94a3b8;
    }

    .course-search input {
        width: 100%;
        padding: 9px 12px 9px 35px;
        border: 1px solid #e2e8f0;
        border-radius: 9px;
        font-size: 12px;
        outline: none;
    }

    .course-search input:focus {
        border-color: #818cf8;
        box-shadow: 0 0 0 3px #eef2ff;
    }

    .course-table {
        white-space: nowrap;
        margin-bottom: 0;
    }

    .course-table thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .4px;
        padding: 14px 12px;
        border-bottom: 1px solid #e9edf5;
    }

    .course-table tbody td {
        padding: 15px 12px;
        vertical-align: middle;
        font-size: 12px;
        color: #475569;
        border-bottom: 1px solid #f1f5f9;
    }

    .course-table tbody tr:hover {
        background: #fafbff;
    }

    .course-code {
        display: inline-block;
        background: #eef2ff;
        color: #4f46e5;
        padding: 6px 9px;
        border-radius: 7px;
        font-weight: 800;
        font-size: 11px;
    }

    .course-name {
        color: #334155;
        font-weight: 700;
        white-space: normal;
        min-width: 150px;
    }

    .course-english {
        color: #94a3b8;
        font-size: 10px;
        display: block;
        margin-top: 4px;
        white-space: normal;
    }

    .semester-badge {
        background: #f1f5f9;
        color: #475569;
        padding: 6px 9px;
        border-radius: 7px;
        font-size: 11px;
        font-weight: 700;
    }

    .sks-badge {
        color: #059669;
        background: #ecfdf5;
        padding: 6px 9px;
        border-radius: 7px;
        font-size: 11px;
        font-weight: 700;
    }

    .category-badge {
        display: inline-block;
        padding: 7px 10px;
        border-radius: 7px;
        font-size: 10px;
        font-weight: 700;
    }

    .category-ai {
        background: #eef2ff;
        color: #4f46e5;
    }

    .category-cyber {
        background: #ecfeff;
        color: #0891b2;
    }

    .category-both {
        background: #f5f3ff;
        color: #7c3aed;
    }

    .category-none {
        background: #f1f5f9;
        color: #64748b;
    }

    .btn-disable {
        background: #fef2f2;
        color: #dc2626;
        border: none;
        border-radius: 8px;
        padding: 8px 11px;
        font-size: 10px;
        font-weight: 700;
    }

    .btn-disable:hover {
        background: #fee2e2;
        color: #b91c1c;
    }

    .empty-course {
        text-align: center;
        padding: 40px !important;
        color: #94a3b8 !important;
    }

    .empty-course i {
        font-size: 32px;
        display: block;
        margin-bottom: 10px;
        color: #c7d2fe;
    }

    .course-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 20px;
    }

    .course-footer small {
        color: #94a3b8;
        font-size: 11px;
    }

    .course-total {
        background: #eef2ff;
        color: #4338ca;
        padding: 9px 13px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 800;
    }

    .course-pagination svg {
        width: 18px;
    }

    @media(max-width: 768px) {
        .course-summary {
            grid-template-columns: repeat(2, 1fr);
        }

        .course-panel {
            padding: 15px;
        }
    }

    @media(max-width: 480px) {
        .course-summary {
            grid-template-columns: 1fr;
        }

        .course-header .btn-add-course {
            width: 100%;
        }

        .course-search {
            width: 100%;
        }
    }
</style>

<div class="course-page">

    {{-- HEADER --}}
    <div class="course-header">
        <div>
            <h2>Data Mata Kuliah</h2>
            <p>Kelola mata kuliah dan kategori peminatan Teknik Informatika.</p>
        </div>

        <button
            class="btn btn-add-course"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#formMk">

            <i class="bi bi-plus-lg me-1"></i>
            Tambah Mata Kuliah
        </button>
    </div>

    {{-- ALERT SUKSES --}}
    @if(session('success'))
        <div class="alert alert-success course-alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if(session('error'))
        <div class="alert alert-danger course-alert">
            <i class="bi bi-exclamation-circle-fill me-2"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- ALERT VALIDASI --}}
    @if($errors->any())
        <div class="alert alert-danger course-alert">
            <strong>Periksa kembali data yang dimasukkan:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- RINGKASAN --}}
    <div class="course-summary">

        <div class="summary-card">
            <div class="summary-icon blue">
                <i class="bi bi-book-fill"></i>
            </div>
            <div>
                <strong>{{ $data->total() ?? $data->count() }}</strong>
                <small>Total Mata Kuliah</small>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon green">
                <i class="bi bi-calendar3"></i>
            </div>
            <div>
                <strong>1 - 8</strong>
                <small>Rentang Semester</small>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon orange">
                <i class="bi bi-award-fill"></i>
            </div>
            <div>
                <strong>AI & Cyber</strong>
                <small>Bidang Peminatan</small>
            </div>
        </div>

    </div>

    {{-- FORM TAMBAH --}}
    <form
        id="formMk"
        class="collapse course-form"
        method="POST"
        action="{{ route('admin.mk.simpan') }}">

        @csrf

        <h5>
            <i class="bi bi-journal-plus text-primary me-2"></i>
            Tambah Mata Kuliah Baru
        </h5>

        <p class="form-description">
            Lengkapi informasi mata kuliah di bawah ini.
        </p>

        <div class="row g-3">

            <div class="col-md-4">
                <label>Kode Mata Kuliah</label>
                <input type="text"
                    class="form-control"
                    name="kode"
                    placeholder="Contoh: IF101"
                    value="{{ old('kode') }}"
                    required>
            </div>

            <div class="col-md-4">
                <label>Nama Mata Kuliah</label>
                <input type="text"
                    class="form-control"
                    name="nama"
                    placeholder="Nama mata kuliah"
                    value="{{ old('nama') }}"
                    required>
            </div>

            <div class="col-md-4">
                <label>Nama Bahasa Inggris</label>
                <input type="text"
                    class="form-control"
                    name="nama_inggris"
                    placeholder="English course name"
                    value="{{ old('nama_inggris') }}">
            </div>

            <div class="col-md-3">
                <label>Semester</label>
                <input type="number"
                    class="form-control"
                    name="semester"
                    min="1"
                    max="8"
                    value="{{ old('semester', 1) }}"
                    placeholder="Semester"
                    required>
            </div>

            <div class="col-md-3">
                <label>Jumlah SKS</label>
                <input type="number"
                    class="form-control"
                    name="sks"
                    min="1"
                    max="6"
                    value="{{ old('sks') }}"
                    placeholder="Jumlah SKS"
                    required>
            </div>

            <div class="col-md-6">
                <label>Kategori Mata Kuliah</label>
                <select name="kategori"
                    class="form-select"
                    required>

                    <option value="">-- Pilih Kategori --</option>

                    <option value="ai" @selected(old('kategori') == 'ai')>
                        Artificial Intelligence
                    </option>

                    <option value="cyber" @selected(old('kategori') == 'cyber')>
                        Cyber Security
                    </option>

                    <option value="keduanya" @selected(old('kategori') == 'keduanya')>
                        AI dan Cyber Security
                    </option>

                    <option value="tidak_ada" @selected(old('kategori') == 'tidak_ada')>
                        Tidak Termasuk Keduanya
                    </option>

                </select>
            </div>

            <div class="col-12">
                <label>Deskripsi Mata Kuliah</label>
                <textarea
                    class="form-control"
                    name="deskripsi"
                    placeholder="Masukkan deskripsi mata kuliah..."
                    rows="3">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-save">
                    <i class="bi bi-check-lg me-1"></i>
                    Simpan Mata Kuliah
                </button>

                <button type="button"
                    class="btn btn-cancel"
                    data-bs-toggle="collapse"
                    data-bs-target="#formMk">
                    Batal
                </button>
            </div>

        </div>
    </form>

    {{-- TABEL DATA --}}
    <section class="course-panel">

        <div class="course-panel-header">
            <div>
                <h5>Daftar Mata Kuliah</h5>
                <p>Informasi mata kuliah yang tersimpan di dalam sistem.</p>
            </div>

            <div class="course-search">
                <i class="bi bi-search"></i>
                <input type="text"
                    id="searchCourse"
                    placeholder="Cari kode atau mata kuliah...">
            </div>
        </div>

        <div class="table-responsive">

            <table class="table course-table">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Mata Kuliah</th>
                        <th>Semester</th>
                        <th>SKS</th>
                        <th>Kategori Peminatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody id="courseTableBody">

                    @forelse($data as $i => $mk)

                        <tr class="course-row">

                            <td>
                                {{ $data instanceof \Illuminate\Pagination\AbstractPaginator
                                    ? $data->firstItem() + $i
                                    : $i + 1 }}
                            </td>

                            <td>
                                <span class="course-code">
                                    {{ $mk->kode }}
                                </span>
                            </td>

                            <td>
                                <div class="course-name">
                                    {{ $mk->nama }}
                                </div>

                                <span class="course-english">
                                    {{ $mk->nama_inggris ?: '—' }}
                                </span>
                            </td>

                            <td>
                                <span class="semester-badge">
                                    Semester {{ $mk->semester }}
                                </span>
                            </td>

                            <td>
                                <span class="sks-badge">
                                    {{ $mk->sks }} SKS
                                </span>
                            </td>

                            <td>
                                @if($mk->bobot_ai == 1 && $mk->bobot_cyber == 1)

                                    <span class="category-badge category-both">
                                        <i class="bi bi-stars me-1"></i>
                                        AI dan Cyber
                                    </span>

                                @elseif($mk->bobot_ai == 1)

                                    <span class="category-badge category-ai">
                                        <i class="bi bi-robot me-1"></i>
                                        Artificial Intelligence
                                    </span>

                                @elseif($mk->bobot_cyber == 1)

                                    <span class="category-badge category-cyber">
                                        <i class="bi bi-shield-lock me-1"></i>
                                        Cyber Security
                                    </span>

                                @else

                                    <span class="category-badge category-none">
                                        Tidak Termasuk Keduanya
                                    </span>

                                @endif
                            </td>

                            <td>
                                <form
                                    method="POST"
                                    action="{{ route('admin.mk.hapus', $mk) }}"
                                    onsubmit="return confirm('Nonaktifkan mata kuliah ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="btn btn-disable">

                                        <i class="bi bi-archive me-1"></i>
                                        Nonaktifkan
                                    </button>
                                </form>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="empty-course">
                                <i class="bi bi-journal-x"></i>
                                Belum ada data mata kuliah.
                            </td>
                        </tr>

                    @endforelse

                    <tr id="searchEmpty" style="display:none">
                        <td colspan="7" class="empty-course">
                            Data mata kuliah tidak ditemukan.
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

        {{-- FOOTER --}}
        <div class="course-footer">

            <small>
                @if($data instanceof \Illuminate\Pagination\AbstractPaginator)
                    Menampilkan {{ $data->firstItem() ?? 0 }}
                    sampai {{ $data->lastItem() ?? 0 }}
                    dari {{ $data->total() }} mata kuliah
                @else
                    Total {{ $data->count() }} mata kuliah
                @endif
            </small>

            <div class="course-total">
                <i class="bi bi-calculator me-1"></i>
                Total SKS:

                {{ $data instanceof \Illuminate\Pagination\AbstractPaginator
                    ? $data->getCollection()->sum('sks')
                    : $data->sum('sks') }}
            </div>

        </div>

        {{-- PAGINATION --}}
        @if($data instanceof \Illuminate\Pagination\AbstractPaginator)
            <div class="course-pagination mt-3">
                {{ $data->links() }}
            </div>
        @endif

    </section>

</div>

{{-- PENCARIAN --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const search = document.getElementById('searchCourse');
        const rows = document.querySelectorAll('.course-row');
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

                if (match) visible++;
            });

            empty.style.display = visible === 0 ? '' : 'none';
        });

    });
</script>

@endsection
