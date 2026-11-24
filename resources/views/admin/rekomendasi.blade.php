
@extends('layouts.app')

@section('title', 'Data Rekomendasi')
@section('heading', 'Data Rekomendasi')

@section('content')

<style>
    .recommendation-page {
        color: #263248;
    }

    .recommendation-hero {
        background: linear-gradient(120deg, #172554, #3730a3, #4f46e5);
        color: #fff;
        padding: 28px;
        border-radius: 20px;
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }

    .recommendation-hero::after {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(255,255,255,.07);
        right: -50px;
        top: -90px;
    }

    .recommendation-hero h3 {
        font-size: 23px;
        font-weight: 750;
        margin-bottom: 8px;
        position: relative;
        z-index: 1;
    }

    .recommendation-hero p {
        color: rgba(255,255,255,.78);
        font-size: 13px;
        margin: 0;
        position: relative;
        z-index: 1;
    }

    .recommendation-summary {
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
        font-size: 20px;
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

    .recommendation-panel {
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
        gap: 15px;
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

    .search-recommendation {
        position: relative;
        width: 260px;
        max-width: 100%;
    }

    .search-recommendation input {
        width: 100%;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 10px 13px 10px 36px;
        outline: none;
        font-size: 12px;
    }

    .search-recommendation input:focus {
        border-color: #818cf8;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, .08);
    }

    .search-recommendation span {
        position: absolute;
        left: 12px;
        top: 9px;
        color: #94a3b8;
        font-size: 17px;
    }

    .recommendation-table {
        margin-bottom: 0;
        vertical-align: middle;
        white-space: nowrap;
    }

    .recommendation-table thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 11px;
        font-weight: 750;
        text-transform: uppercase;
        letter-spacing: .4px;
        padding: 15px 14px;
        border-bottom: 1px solid #e9edf4;
    }

    .recommendation-table tbody td {
        padding: 16px 14px;
        border-color: #f1f5f9;
        font-size: 13px;
        color: #475569;
    }

    .recommendation-table tbody tr:hover {
        background: #fafbff;
    }

    .student-name {
        color: #263248;
        font-weight: 700;
        font-size: 13px;
        margin-bottom: 4px;
    }

    .student-nim {
        color: #94a3b8;
        font-size: 11px;
    }

    .score-wrapper {
        min-width: 125px;
    }

    .score-value {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 7px;
        font-size: 12px;
        font-weight: 750;
    }

    .score-value.ai {
        color: #4f46e5;
    }

    .score-value.cyber {
        color: #059669;
    }

    .score-track {
        width: 100%;
        height: 7px;
        background: #edf0f5;
        border-radius: 20px;
        overflow: hidden;
    }

    .score-progress {
        height: 100%;
        border-radius: 20px;
    }

    .score-progress.ai {
        background: linear-gradient(90deg, #6366f1, #818cf8);
    }

    .score-progress.cyber {
        background: linear-gradient(90deg, #059669, #34d399);
    }

    .result-badge {
        display: inline-block;
        padding: 7px 11px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 750;
    }

    .result-ai {
        color: #4338ca;
        background: #eef2ff;
    }

    .result-cyber {
        color: #047857;
        background: #ecfdf5;
    }

    .result-other {
        color: #475569;
        background: #f1f5f9;
    }

    .recommendation-date {
        color: #64748b;
        font-size: 12px;
    }

    .date-icon {
        color: #94a3b8;
        margin-right: 5px;
    }

    .empty-recommendation {
        padding: 50px 20px;
        text-align: center;
        border: 1px dashed #dbe2ed;
        background: #f8fafc;
        border-radius: 15px;
    }

    .empty-recommendation .empty-icon {
        font-size: 38px;
        color: #94a3b8;
        margin-bottom: 12px;
    }

    .empty-recommendation h6 {
        font-weight: 750;
        color: #334155;
    }

    .empty-recommendation p {
        color: #94a3b8;
        font-size: 13px;
        margin: 0;
    }

    .recommendation-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        padding-top: 18px;
        margin-top: 15px;
        border-top: 1px solid #edf0f5;
    }

    .recommendation-footer small {
        color: #94a3b8;
        font-size: 12px;
    }

    .recommendation-footer .pagination {
        margin: 0;
    }

    .recommendation-footer .page-link {
        color: #4f46e5;
        border-color: #e9edf4;
        font-size: 12px;
    }

    .recommendation-footer .active > .page-link {
        background: #4f46e5;
        border-color: #4f46e5;
        color: #fff;
    }

    .search-empty {
        display: none;
        padding: 30px 15px;
        text-align: center;
        color: #94a3b8;
        font-size: 13px;
    }

    @media (max-width: 768px) {
        .recommendation-hero {
            padding: 22px;
        }

        .recommendation-hero h3 {
            font-size: 19px;
        }

        .recommendation-panel {
            padding: 16px;
        }

        .search-recommendation {
            width: 100%;
        }
    }
</style>

<div class="recommendation-page">

    {{-- HEADER --}}
    <div class="recommendation-hero">
        <div class="small mb-2" style="color: #c7d2fe;">
            ADMINISTRATOR / HASIL ANALISIS
        </div>

        <h3>Riwayat Hasil Rekomendasi</h3>

        <p>
            Pantau hasil analisis dan rekomendasi peminatan mahasiswa
            berdasarkan nilai mata kuliah.
        </p>
    </div>

    {{-- RINGKASAN --}}
    <div class="recommendation-summary">

        <div class="summary-card">
            <div class="summary-icon blue">
                <span>R</span>
            </div>

            <div>
                <h4>
                    {{ method_exists($data, 'total') ? $data->total() : $data->count() }}
                </h4>
                <p>Total riwayat rekomendasi</p>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon green">
                <span>AI</span>
            </div>

            <div>
                <h4>2</h4>
                <p>Alternatif peminatan</p>
            </div>
        </div>

    </div>

    {{-- TABEL RIWAYAT REKOMENDASI --}}
    <div class="recommendation-panel">

        <div class="panel-heading">
            <div>
                <h5>Daftar Riwayat Rekomendasi</h5>
                <p>Data mahasiswa dan hasil perhitungan sistem.</p>
            </div>

            <div class="search-recommendation">
                <span>⌕</span>
                <input
                    type="text"
                    id="searchRecommendation"
                    placeholder="Cari nama atau NIM mahasiswa...">
            </div>
        </div>

        <div class="table-responsive">

            <table class="table table-hover recommendation-table">

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Mahasiswa</th>
                        <th>Artificial Intelligence</th>
                        <th>Cyber Security</th>
                        <th>Hasil Rekomendasi</th>
                        <th>Tanggal Analisis</th>
                    </tr>
                </thead>

                <tbody id="recommendationTableBody">

                    @forelse($data as $r)

                        @php
                            $nama = optional($r->mahasiswa)->nama ?? 'Mahasiswa';
                            $nim = optional($r->mahasiswa)->nim ?? '-';

                            $aiPersen = (float) $r->ai_persen;
                            $cyberPersen = (float) $r->cyber_persen;

                            $hasil = trim($r->hasil ?? '');
                            $hasilLower = strtolower($hasil);

                            if (
                                $hasilLower === 'ai' ||
                                str_contains($hasilLower, 'artificial intelligence')
                            ) {
                                $hasilClass = 'result-ai';
                            } elseif (str_contains($hasilLower, 'cyber')) {
                                $hasilClass = 'result-cyber';
                            } else {
                                $hasilClass = 'result-other';
                            }

                            $tanggal = $r->created_at
                                ? $r->created_at->format('d/m/Y H:i')
                                : '-';
                        @endphp

                        <tr
                            class="recommendation-row"
                            data-search="{{ strtolower($nama . ' ' . $nim . ' ' . $hasil) }}">

                            {{-- NOMOR --}}
                            <td>
                                <span class="text-muted">
                                    {{ method_exists($data, 'firstItem') ? $data->firstItem() + $loop->index : $loop->iteration }}
                                </span>
                            </td>

                            {{-- IDENTITAS MAHASISWA --}}
                            <td>
                                <div class="student-name">
                                    {{ $nama }}
                                </div>

                                <div class="student-nim">
                                    NIM: {{ $nim }}
                                </div>
                            </td>

                            {{-- PERSENTASE AI --}}
                            <td>
                                <div class="score-wrapper">
                                    <div class="score-value ai">
                                        <span>{{ number_format($aiPersen, 2) }}%</span>
                                    </div>

                                    <div class="score-track">
                                        <div
                                            class="score-progress ai"
                                            style="width: {{ max(0, min(100, $aiPersen)) }}%;">
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- PERSENTASE CYBER SECURITY --}}
                            <td>
                                <div class="score-wrapper">
                                    <div class="score-value cyber">
                                        <span>{{ number_format($cyberPersen, 2) }}%</span>
                                    </div>

                                    <div class="score-track">
                                        <div
                                            class="score-progress cyber"
                                            style="width: {{ max(0, min(100, $cyberPersen)) }}%;">
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- HASIL REKOMENDASI --}}
                            <td>
                                <span class="result-badge {{ $hasilClass }}">
                                    {{ $hasil ?: 'Belum ditentukan' }}
                                </span>
                            </td>

                            {{-- TANGGAL --}}
                            <td>
                                <span class="recommendation-date">
                                    <span class="date-icon">◷</span>
                                    {{ $tanggal }}
                                </span>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6">
                                <div class="empty-recommendation">
                                    <div class="empty-icon">◇</div>
                                    <h6>Belum Ada Riwayat Rekomendasi</h6>
                                    <p>
                                        Riwayat hasil analisis mahasiswa akan ditampilkan
                                        di halaman ini.
                                    </p>
                                </div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

            {{-- HASIL PENCARIAN KOSONG --}}
            <div class="search-empty" id="searchEmpty">
                Data rekomendasi tidak ditemukan.
            </div>

        </div>

        {{-- FOOTER DAN PAGINATION --}}
        @if($data->count() > 0)

            <div class="recommendation-footer">

                <small>
                    Menampilkan
                    {{ method_exists($data, 'firstItem') ? $data->firstItem() : 1 }}
                    –
                    {{ method_exists($data, 'lastItem') ? $data->lastItem() : $data->count() }}
                    dari
                    {{ method_exists($data, 'total') ? $data->total() : $data->count() }}
                    riwayat rekomendasi
                </small>

                @if(method_exists($data, 'links'))
                    {{ $data->links() }}
                @endif

            </div>

        @endif

    </div>

</div>

{{-- PENCARIAN DATA --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchRecommendation');
        const rows = document.querySelectorAll('.recommendation-row');
        const searchEmpty = document.getElementById('searchEmpty');

        if (!searchInput) return;

        searchInput.addEventListener('input', function () {
            const keyword = this.value.toLowerCase().trim();
            let visibleCount = 0;

            rows.forEach(function (row) {
                const searchText = row.getAttribute('data-search') || '';
                const match = searchText.includes(keyword);

                row.style.display = match ? '' : 'none';

                if (match) {
                    visibleCount++;
                }
            });

            if (searchEmpty) {
                searchEmpty.style.display =
                    rows.length > 0 && visibleCount === 0 ? 'block' : 'none';
            }
        });
    });
</script>

@endsection
