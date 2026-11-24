@extends('layouts.app')

@section('title', 'Pilih Mata Kuliah')
@section('heading', 'Analisis Minat Mata Kuliah')

@section('content')

<style>
    .course-selection {
        color: #263248;
    }

    /* HEADER */
    .selection-hero {
        position: relative;
        overflow: hidden;
        padding: 28px;
        border-radius: 20px;
        color: #fff;
        background: linear-gradient(120deg, #172554, #3730a3, #4f46e5);
        margin-bottom: 23px;
    }

    .selection-hero::after {
        content: "";
        position: absolute;
        width: 230px;
        height: 230px;
        border-radius: 50%;
        background: rgba(255,255,255,.07);
        right: -55px;
        top: -110px;
    }

    .selection-hero-content {
        position: relative;
        z-index: 1;
    }

    .selection-hero .eyebrow {
        display: inline-block;
        color: #c7d2fe;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.2px;
        margin-bottom: 12px;
    }

    .selection-hero h3 {
        color: #fff;
        font-size: 23px;
        font-weight: 800;
        margin-bottom: 9px;
    }

    .selection-hero p {
        color: #dbeafe;
        font-size: 13px;
        line-height: 1.8;
        max-width: 650px;
        margin: 0;
    }

    /* SUMMARY */
    .selection-summary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
        gap: 15px;
        margin-bottom: 22px;
    }

    .selection-summary-card {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 18px;
        background: #fff;
        border: 1px solid #edf0f5;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(15,23,42,.03);
    }

    .selection-summary-icon {
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

    .selection-summary-icon.green {
        color: #059669;
        background: #ecfdf5;
    }

    .selection-summary-card h4 {
        color: #1e293b;
        font-size: 22px;
        font-weight: 800;
        margin: 0;
    }

    .selection-summary-card p {
        color: #94a3b8;
        font-size: 11px;
        margin: 3px 0 0;
    }

    /* MAIN PANEL */
    .selection-panel {
        background: #fff;
        border: 1px solid #edf0f5;
        border-radius: 17px;
        padding: 23px;
        box-shadow: 0 4px 15px rgba(15,23,42,.035);
    }

    .selection-panel-heading {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 20px;
    }

    .selection-panel-heading h5 {
        color: #263248;
        font-size: 16px;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .selection-panel-heading p {
        color: #94a3b8;
        font-size: 12px;
        line-height: 1.7;
        margin: 0;
    }

    .selection-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 12px;
        color: #4338ca;
        background: #eef2ff;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 750;
        white-space: nowrap;
    }

    /* SEARCH */
    .course-search {
        position: relative;
        width: 260px;
        max-width: 100%;
    }

    .course-search i {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }

    .course-search input {
        width: 100%;
        height: 41px;
        padding: 9px 12px 9px 36px;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        background: #fff;
        outline: none;
        color: #334155;
        font-size: 12px;
    }

    .course-search input:focus {
        border-color: #818cf8;
        box-shadow: 0 0 0 3px rgba(99,102,241,.08);
    }

    /* SELECTION STATUS */
    .selection-status {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        padding: 14px 16px;
        margin-bottom: 20px;
        border: 1px solid #e0e7ff;
        border-radius: 12px;
        background: #f5f7ff;
    }

    .selection-status-text {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #475569;
        font-size: 12px;
    }

    .selection-status-text i {
        color: #4f46e5;
        font-size: 17px;
    }

    .selection-status-text strong {
        color: #4338ca;
    }

    .selection-actions {
        display: flex;
        gap: 8px;
    }

    .selection-actions button {
        border: none;
        background: transparent;
        color: #4f46e5;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 6px;
    }

    .selection-actions button:hover {
        color: #312e81;
        text-decoration: underline;
    }

    /* COURSE CARD */
    .course-option {
        position: relative;
        display: flex;
        gap: 13px;
        width: 100%;
        height: 100%;
        min-height: 130px;
        padding: 17px;
        border: 1px solid #e5eaf2;
        border-radius: 14px;
        background: #fff;
        cursor: pointer;
        transition: .2s ease;
    }

    .course-option:hover {
        border-color: #a5b4fc;
        background: #fafaff;
        transform: translateY(-2px);
        box-shadow: 0 7px 17px rgba(79,70,229,.06);
    }

    .course-option:has(.course-checkbox:checked) {
        border-color: #818cf8;
        background: #f5f7ff;
        box-shadow: 0 0 0 2px rgba(99,102,241,.08);
    }

    .course-checkbox {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
        margin-top: 3px;
        cursor: pointer;
        accent-color: #4f46e5;
    }

    .course-information {
        min-width: 0;
        flex: 1;
    }

    .course-name {
        display: block;
        color: #263248;
        font-size: 13px;
        font-weight: 800;
        line-height: 1.5;
        margin-bottom: 7px;
    }

    .course-metadata {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-bottom: 9px;
    }

    .course-metadata span {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 7px;
        border-radius: 6px;
        background: #f1f5f9;
        color: #64748b;
        font-size: 10px;
        font-weight: 650;
    }

    .course-description {
        color: #94a3b8;
        font-size: 11px;
        line-height: 1.7;
        margin: 0;
        overflow-wrap: anywhere;
    }

    .course-check-icon {
        position: absolute;
        top: 13px;
        right: 13px;
        color: #4f46e5;
        font-size: 16px;
        opacity: 0;
        transition: .2s;
    }

    .course-option:has(.course-checkbox:checked) .course-check-icon {
        opacity: 1;
    }

    /* NO DATA */
    .course-empty {
        padding: 45px 20px;
        background: #f8fafc;
        border: 1px dashed #dbe2ed;
        border-radius: 14px;
        text-align: center;
    }

    .course-empty-icon {
        width: 57px;
        height: 57px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 14px;
        background: #eef2ff;
        color: #6366f1;
        border-radius: 16px;
        font-size: 24px;
    }

    .course-empty h6 {
        color: #334155;
        font-weight: 800;
        font-size: 14px;
    }

    .course-empty p {
        color: #94a3b8;
        font-size: 12px;
        margin: 0;
    }

    /* FOOTER */
    .selection-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        border-top: 1px solid #edf0f5;
        margin-top: 23px;
        padding-top: 20px;
    }

    .selection-hint {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        color: #94a3b8;
        font-size: 11px;
        line-height: 1.7;
        max-width: 430px;
    }

    .selection-hint i {
        color: #6366f1;
        font-size: 14px;
        margin-top: 1px;
    }

    .selection-submit {
        min-width: 220px;
        padding: 12px 18px;
        border: none;
        border-radius: 10px;
        color: #fff;
        background: linear-gradient(100deg, #3730a3, #4f46e5);
        font-size: 12px;
        font-weight: 750;
        box-shadow: 0 6px 14px rgba(79,70,229,.16);
        transition: .2s;
    }

    .selection-submit:hover:not(:disabled) {
        background: linear-gradient(100deg, #312e81, #4338ca);
        transform: translateY(-2px);
    }

    .selection-submit:disabled {
        background: #cbd5e1;
        cursor: not-allowed;
        box-shadow: none;
    }

    .selection-alert {
        border-radius: 11px;
        font-size: 12px;
    }

    .course-no-match {
        display: none;
        grid-column: 1 / -1;
    }

    @media (max-width: 768px) {
        .selection-hero {
            padding: 23px;
        }

        .selection-hero h3 {
            font-size: 20px;
        }

        .selection-panel {
            padding: 17px;
        }

        .selection-footer {
            align-items: stretch;
        }

        .selection-submit {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .selection-summary {
            grid-template-columns: 1fr;
        }

        .selection-panel-heading {
            flex-direction: column;
        }

        .course-search {
            width: 100%;
        }

        .selection-status {
            align-items: flex-start;
        }
    }
</style>

<div class="course-selection">

    {{-- HEADER --}}
    <section class="selection-hero">
        <div class="selection-hero-content">

            <span class="eyebrow">
                MAHASISWA / ANALISIS MINAT
            </span>

            <h3>Pilih Mata Kuliah yang Anda Minati</h3>

            <p>
                Pilih satu atau beberapa mata kuliah yang paling menarik bagi Anda.
                Sistem akan menganalisis pilihan tersebut untuk memberikan
                rekomendasi peminatan Artificial Intelligence atau Cyber Security.
            </p>

        </div>
    </section>

    {{-- RINGKASAN --}}
    <div class="selection-summary">

        <div class="selection-summary-card">

            <div class="selection-summary-icon">
                <i class="bi bi-book-half"></i>
            </div>

            <div>
                <h4 id="totalCourse">{{ $mataKuliah->count() }}</h4>
                <p>Total mata kuliah tersedia</p>
            </div>

        </div>

        <div class="selection-summary-card">

            <div class="selection-summary-icon green">
                <i class="bi bi-check2-square"></i>
            </div>

            <div>
                <h4 id="selectedCount">0</h4>
                <p>Mata kuliah dipilih</p>
            </div>

        </div>

    </div>

    {{-- PANEL PEMILIHAN --}}
    <section class="selection-panel">

        <div class="selection-panel-heading">

            <div>
                <h5>Daftar Mata Kuliah</h5>

                <p>
                    Centang mata kuliah sesuai minat dan ketertarikan Anda.
                    Pilihan dapat diubah kapan saja.
                </p>
            </div>

            <span class="selection-badge">
                <i class="bi bi-ui-checks"></i>
                Checklist Minat
            </span>

        </div>

        {{-- PESAN VALIDASI --}}
        @if($errors->any())
            <div class="alert alert-danger selection-alert">
                <i class="bi bi-exclamation-circle-fill me-2"></i>
                {{ $errors->first() }}
            </div>
        @endif

        {{-- PESAN SUKSES --}}
        @if(session('success'))
            <div class="alert alert-success selection-alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- FORM --}}
        <form
            method="POST"
            action="{{ route('mahasiswa.penilaian.simpan') }}"
            id="courseSelectionForm"
        >

            @csrf

            @php
                $pilihanLama = old('mata_kuliah_ids', $terpilih ?? []);
            @endphp

            {{-- STATUS PILIHAN --}}
            <div class="selection-status">

                <div class="selection-status-text">
                    <i class="bi bi-check-circle-fill"></i>

                    <span>
                        Anda memilih
                        <strong id="selectedCountText">0 mata kuliah</strong>
                    </span>
                </div>

                <div class="selection-actions">

                    <button type="button" id="selectAll">
                        Pilih Semua
                    </button>

                    <button type="button" id="clearAll">
                        Hapus Pilihan
                    </button>

                </div>

            </div>

            {{-- SEARCH --}}
            <div class="course-search mb-3">
                <i class="bi bi-search"></i>

                <input
                    type="text"
                    id="searchCourse"
                    placeholder="Cari nama atau kode mata kuliah..."
                    autocomplete="off"
                >
            </div>

            {{-- LIST MATA KULIAH --}}
            <div class="row g-3" id="courseList">

                @forelse($mataKuliah as $mk)

                    <div
                        class="col-md-6 course-item"
                        data-search="{{ strtolower($mk->nama . ' ' . $mk->kode . ' ' . ($mk->deskripsi ?? '') . ' semester ' . $mk->semester) }}"
                    >

                        <label
                            class="course-option"
                            for="mk-{{ $mk->id }}"
                        >

                            <input
                                class="course-checkbox"
                                type="checkbox"
                                id="mk-{{ $mk->id }}"
                                name="mata_kuliah_ids[]"
                                value="{{ $mk->id }}"
                                @checked(in_array($mk->id, $pilihanLama))
                            >

                            <span class="course-information">

                                <strong class="course-name">
                                    {{ $mk->nama }}
                                </strong>

                                <span class="course-metadata">

                                    <span>
                                        <i class="bi bi-hash"></i>
                                        {{ $mk->kode }}
                                    </span>

                                    <span>
                                        <i class="bi bi-calendar3"></i>
                                        Semester {{ $mk->semester }}
                                    </span>

                                    <span>
                                        <i class="bi bi-book"></i>
                                        {{ $mk->sks }} SKS
                                    </span>

                                </span>

                                @if($mk->deskripsi)
                                    <p class="course-description">
                                        {{ $mk->deskripsi }}
                                    </p>
                                @else
                                    <p class="course-description">
                                        Informasi mata kuliah tersedia di daftar kurikulum.
                                    </p>
                                @endif

                            </span>

                            <i class="bi bi-check-circle-fill course-check-icon"></i>

                        </label>

                    </div>

                @empty

                    <div class="col-12">

                        <div class="course-empty">

                            <div class="course-empty-icon">
                                <i class="bi bi-journal-x"></i>
                            </div>

                            <h6>Belum Ada Mata Kuliah</h6>

                            <p>
                                Belum ada mata kuliah aktif.
                                Silakan hubungi Admin untuk informasi lebih lanjut.
                            </p>

                        </div>

                    </div>

                @endforelse

                {{-- HASIL PENCARIAN KOSONG --}}
                <div class="course-no-match" id="courseNoMatch">

                    <div class="course-empty">
                        <div class="course-empty-icon">
                            <i class="bi bi-search"></i>
                        </div>

                        <h6>Mata Kuliah Tidak Ditemukan</h6>

                        <p>
                            Coba masukkan nama atau kode mata kuliah lainnya.
                        </p>
                    </div>

                </div>

            </div>

            {{-- FOOTER FORM --}}
            <div class="selection-footer">

                <div class="selection-hint">
                    <i class="bi bi-info-circle-fill"></i>

                    <span>
                        Minimal pilih satu mata kuliah. Setelah disimpan,
                        sistem akan menghitung ulang rekomendasi berdasarkan
                        pilihan terbaru Anda.
                    </span>
                </div>

                <button
                    class="selection-submit"
                    type="submit"
                    id="submitSelection"
                    @disabled($mataKuliah->isEmpty())
                >
                    <i class="bi bi-calculator me-2"></i>
                    Simpan Pilihan & Hitung Rekomendasi
                </button>

            </div>

        </form>

    </section>

</div>

{{-- INTERAKSI PILIHAN MATA KULIAH --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const checkboxes = document.querySelectorAll('.course-checkbox');
        const selectedCount = document.getElementById('selectedCount');
        const selectedCountText = document.getElementById('selectedCountText');
        const submitButton = document.getElementById('submitSelection');

        const selectAllButton = document.getElementById('selectAll');
        const clearAllButton = document.getElementById('clearAll');

        const searchInput = document.getElementById('searchCourse');
        const courseItems = document.querySelectorAll('.course-item');
        const noMatch = document.getElementById('courseNoMatch');

        function updateSelection() {
            const totalSelected = document.querySelectorAll(
                '.course-checkbox:checked'
            ).length;

            selectedCount.textContent = totalSelected;

            selectedCountText.textContent =
                totalSelected + ' mata kuliah';

            if (submitButton) {
                submitButton.disabled = totalSelected === 0;
            }
        }

        // PERUBAHAN CHECKBOX
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', updateSelection);
        });

        // PILIH SEMUA
        if (selectAllButton) {
            selectAllButton.addEventListener('click', function () {
                checkboxes.forEach(function (checkbox) {
                    const item = checkbox.closest('.course-item');

                    // Hanya memilih kartu yang sedang terlihat
                    if (item && item.style.display !== 'none') {
                        checkbox.checked = true;
                    }
                });

                updateSelection();
            });
        }

        // HAPUS SEMUA PILIHAN
        if (clearAllButton) {
            clearAllButton.addEventListener('click', function () {
                checkboxes.forEach(function (checkbox) {
                    checkbox.checked = false;
                });

                updateSelection();
            });
        }

        // PENCARIAN MATA KULIAH
        if (searchInput) {
            searchInput.addEventListener('input', function () {

                const keyword = this.value.toLowerCase().trim();
                let visibleCount = 0;

                courseItems.forEach(function (item) {

                    const searchText =
                        item.getAttribute('data-search') || '';

                    const match = searchText.includes(keyword);

                    item.style.display = match ? '' : 'none';

                    if (match) {
                        visibleCount++;
                    }
                });

                if (noMatch) {
                    noMatch.style.display =
                        visibleCount === 0 && courseItems.length > 0
                            ? 'block'
                            : 'none';
                }
            });
        }

        // HITUNG PILIHAN AWAL DARI DATA LAMA
        updateSelection();

    });
</script>

@endsection
