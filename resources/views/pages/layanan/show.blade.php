@extends('layouts.app')

@php
    $shareUrl = url()->current();
    $shareTitle = $service->title . ' — Mall Layanan Kemenhaj Purbalingga';
    $shareDesc = $service->description ?: 'Informasi data total jemaah haji dan berkas dokumen resmi di Kabupaten Purbalingga.';
@endphp

@section('pageTitle', $service->title . ' — ' . ($siteTitle ?? 'Kementerian Haji dan Umrah Kabupaten Purbalingga'))
@section('pageDescription', $shareDesc)
@section('ogTitle', $shareTitle)
@section('ogDescription', $shareDesc)

@section('content')

@include('partials.site-top', [
    'pageHeading' => $service->title,
    'pageSubheading' => $service->description ?: 'Portal Informasi Resmi Mall Layanan Kantor Kementerian Haji dan Umrah Kabupaten Purbalingga'
])

<div class="service-page-wrapper">
    <div class="container">
        {{-- BREADCRUMB & BACK --}}
        <div class="service-page-nav">
            <a href="{{ route('home') }}" class="service-back-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                Kembali ke Beranda
            </a>
            <div class="service-page-badge">
                <span class="badge-dot"></span>
                Mall Layanan Resmi
            </div>
        </div>

        {{-- HEADER INFO CARD --}}
        <section class="service-header-card">
            <div class="service-header-icon-wrap">
                <img src="{{ asset($service->icon) }}" alt="{{ $service->title }}" class="service-header-icon">
            </div>
            <div class="service-header-content">
                <span class="service-kemenhaj-tag">Kantor Kementerian Haji & Umrah Kab. Purbalingga</span>
                <h1 class="service-main-title">{{ $service->title }}</h1>
                @if ($service->description)
                    <p class="service-desc-text">{{ $service->description }}</p>
                @endif
                <div class="service-header-actions">
                    @if ($service->document_path)
                        <a href="#dokumen-resmi" class="btn btn--primary-gold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                            Lihat Dokumen PDF
                        </a>
                    @endif
                    <a href="#data-statistik" class="btn btn--outline-teal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                        </svg>
                        Rincian Data Jemaah
                    </a>
                </div>
            </div>
        </section>

        {{-- SEKSI 2: DATA TOTAL JEMAAH HAJI --}}
        <section id="data-statistik" class="service-stats-section">
            <div class="service-section-heading">
                <span class="service-section-eyebrow">Rekapitulasi Data</span>
                <h2 class="service-section-title">Data Total Jemaah Haji</h2>
                <p class="service-section-sub">Informasi data verifikasi jemaah haji yang akan berangkat, status kesiapan, tunda, pelimpahan, dan sebaran wilayah.</p>
            </div>

            {{-- 6 METRIC CARDS --}}
            <div class="hajj-metric-grid">
                {{-- CARD 1: TOTAL VERIFIKASI (FEATURED) --}}
                <div class="hajj-metric-card hajj-metric-card--featured">
                    <div class="metric-top">
                        <div class="metric-icon-wrap icon-verify">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                            </svg>
                        </div>
                        <span class="metric-tag tag-green">Terverifikasi</span>
                    </div>
                    <span class="metric-label">Jumlah Total Verifikasi Jemaah yang Akan Berangkat</span>
                    <strong class="metric-value">{{ number_format($service->total_verified, 0, ',', '.') }}</strong>
                    <span class="metric-hint">Total berkas jemaah terverifikasi</span>
                </div>

                {{-- CARD 2: SIAP BERANGKAT --}}
                <div class="hajj-metric-card">
                    <div class="metric-top">
                        <div class="metric-icon-wrap icon-ready">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                            </svg>
                        </div>
                        <span class="metric-tag tag-emerald">Siap</span>
                    </div>
                    <span class="metric-label">Siap Berangkat</span>
                    <strong class="metric-value text-emerald">{{ number_format($service->ready_count, 0, ',', '.') }}</strong>
                    <span class="metric-hint">Jemaah siap jadwal musim haji</span>
                </div>

                {{-- CARD 3: TUNDA --}}
                <div class="hajj-metric-card">
                    <div class="metric-top">
                        <div class="metric-icon-wrap icon-delayed">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <span class="metric-tag tag-amber">Tunda</span>
                    </div>
                    <span class="metric-label">Tunda Berangkat</span>
                    <strong class="metric-value text-amber">{{ number_format($service->delayed_count, 0, ',', '.') }}</strong>
                    <span class="metric-hint">Penundaan karena alasan tertentu</span>
                </div>

                {{-- CARD 4: MENINGGAL DUNIA --}}
                <div class="hajj-metric-card">
                    <div class="metric-top">
                        <div class="metric-icon-wrap icon-deceased">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </div>
                        <span class="metric-tag tag-slate">Wafat</span>
                    </div>
                    <span class="metric-label">Meninggal Dunia</span>
                    <strong class="metric-value text-slate">{{ number_format($service->deceased_count, 0, ',', '.') }}</strong>
                    <span class="metric-hint">Jemaah wafat sebelum keberangkatan</span>
                </div>

                {{-- CARD 5: BELUM 18 TAHUN --}}
                <div class="hajj-metric-card">
                    <div class="metric-top">
                        <div class="metric-icon-wrap icon-young">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                        <span class="metric-tag tag-blue">&lt; 18 Th</span>
                    </div>
                    <span class="metric-label">Belum 18 Tahun</span>
                    <strong class="metric-value text-blue">{{ number_format($service->under_18_count, 0, ',', '.') }}</strong>
                    <span class="metric-hint">Calon jemaah usia di bawah 18 tahun</span>
                </div>

                {{-- CARD 6: PELIMPAHAN --}}
                <div class="hajj-metric-card">
                    <div class="metric-top">
                        <div class="metric-icon-wrap icon-transfer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                            </svg>
                        </div>
                        <span class="metric-tag tag-gold">Pelimpahan</span>
                    </div>
                    <span class="metric-label">Pelimpahan Nomor Porsi</span>
                    <strong class="metric-value text-gold">{{ number_format($service->transfer_count, 0, ',', '.') }}</strong>
                    <span class="metric-hint">Pelimpahan karena sakit atau wafat</span>
                </div>
            </div>

            {{-- SEBARAN 18 KECAMATAN PURBALINGGA --}}
            <div class="service-districts-box">
                <div class="districts-header">
                    <div>
                        <h3 class="districts-title">Total Jemaah Per Kecamatan di Purbalingga</h3>
                        <p class="districts-sub">Rincian data sebaran calon jemaah haji pada 18 kecamatan di wilayah Kabupaten Purbalingga.</p>
                    </div>
                    <div class="districts-total-pill">
                        <span class="pill-label">Total Keseluruhan Kecamatan:</span>
                        <strong class="pill-number">{{ number_format($service->total_district_count, 0, ',', '.') }} Jemaah</strong>
                    </div>
                </div>

                {{-- GRAFIK KECAMATAN (CHART.JS) --}}
                <div class="districts-chart-container">
                    <h4 class="chart-subtitle">Grafik Distribusi Jemaah 18 Kecamatan</h4>
                    <div style="height:320px;position:relative;">
                        <canvas id="districtChart" aria-label="Grafik Sebaran Jemaah 18 Kecamatan"></canvas>
                    </div>
                </div>

                {{-- TABEL 18 KECAMATAN --}}
                <div class="districts-table-wrap">
                    <table class="districts-table">
                        <thead>
                            <tr>
                                <th style="width:60px;">No</th>
                                <th>Nama Kecamatan</th>
                                <th style="width:200px;">Jumlah Jemaah</th>
                                <th style="width:140px;">Persentase</th>
                                <th>Distribusi Visual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($districts as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <strong>{{ $item['name'] }}</strong>
                                    </td>
                                    <td>
                                        <span class="district-count-val">{{ number_format($item['count'], 0, ',', '.') }}</span> orang
                                    </td>
                                    <td>
                                        <span class="district-pct-badge">{{ $item['percentage'] }}%</span>
                                    </td>
                                    <td>
                                        <div class="district-progress-bar-bg">
                                            <div class="district-progress-bar-fill" style="width: {{ min(100, max(2, $item['percentage'] * 2)) }}%;"></div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" style="text-align:right;font-weight:700;">Total 18 Kecamatan:</td>
                                <td style="font-weight:700;color:var(--teal-dark,#0a7a6f);">
                                    {{ number_format($service->total_district_count, 0, ',', '.') }} orang
                                </td>
                                <td style="font-weight:700;">100%</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </section>

        {{-- SEKSI 3: DOKUMEN RESMI (PDF) --}}
        <section id="dokumen-resmi" class="service-document-section">
            <div class="service-section-heading">
                <span class="service-section-eyebrow">Dokumen Resmi</span>
                <h2 class="service-section-title">Dokumen Pendukung & Regulasi</h2>
                <p class="service-section-sub">Berkas resmi berformat PDF yang dapat diunduh atau dipratinjau secara langsung.</p>
            </div>

            @if ($service->document_path)
                <div class="document-card-container">
                    <div class="document-card">
                        <div class="document-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.625 1.5H9a3.75 3.75 0 0 1 3.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 0 1 3.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 0 1-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875ZM12.75 12a.75.75 0 0 0-1.5 0v4.69l-1.72-1.72a.75.75 0 0 0-1.06 1.06l3 3a.75.75 0 0 0 1.06 0l3-3a.75.75 0 1 0-1.06-1.06l-1.72 1.72V12Z" clip-rule="evenodd" />
                                <path d="M14.25 5.25a5.23 5.23 0 0 0-1.279-3.434 9.768 9.768 0 0 1 6.963 6.963A5.23 5.23 0 0 0 16.5 7.5h-1.875a.375.375 0 0 1-.375-.375V5.25Z" />
                            </svg>
                        </div>
                        <div class="document-info">
                            <span class="document-badge-type">Format: Dokumen PDF</span>
                            <h3 class="document-title">{{ $service->document_name ?: 'Dokumen Resmi' }}</h3>
                            <p class="document-meta">
                                <span>Ukuran: <strong>{{ $service->document_size ?? 'PDF' }}</strong></span>
                                <span>•</span>
                                <span>Kemenhaj Purbalingga</span>
                            </p>
                        </div>
                        <div class="document-actions">
                            <a href="{{ asset($service->document_path) }}" download class="btn btn--download">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                                Unduh PDF
                            </a>
                            <a href="{{ asset($service->document_path) }}" target="_blank" rel="noopener noreferrer" class="btn btn--preview">
                                Buka di Tab Baru &nearr;
                            </a>
                        </div>
                    </div>

                    {{-- PDF PREVIEW VIEWER --}}
                    <div class="pdf-viewer-wrap">
                        <div class="pdf-viewer-header">
                            <span>Pratinjau Dokumen PDF:</span>
                            <strong>{{ $service->document_name ?: 'Dokumen PDF' }}</strong>
                        </div>
                        <iframe src="{{ asset($service->document_path) }}#toolbar=1" class="pdf-viewer-iframe" title="{{ $service->document_name ?: 'Dokumen PDF' }}"></iframe>
                    </div>
                </div>
            @else
                <div class="document-empty-card">
                    <div class="empty-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </div>
                    <h4>Belum Ada Dokumen Terlampir</h4>
                    <p>Berkas PDF resmi belum diunggah untuk layanan ini. Silakan hubungi petugas layanan jika membutuhkan dokumen pendukung terkait.</p>
                </div>
            @endif
        </section>

        {{-- SEKSI 4: LAYANAN LAINNYA DI MALL LAYANAN --}}
        @if ($otherServices->isNotEmpty())
            <section class="other-services-section">
                <div class="service-section-heading">
                    <span class="service-section-eyebrow">Eksplorasi Layanan</span>
                    <h2 class="service-section-title">Layanan Lainnya di Mall Layanan</h2>
                </div>
                <div class="service-grid">
                    @foreach ($otherServices as $item)
                        <a href="{{ $item->target_url }}" class="service-card" @if($item->isExternal()) target="_blank" rel="noopener noreferrer" @endif>
                            <img src="{{ asset($item->icon) }}" alt="{{ $item->title }}">
                            <h4>{{ $item->title }}</h4>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</div>

{{-- SCRIPT INISIALISASI GRAFIK CHART.JS UNTUK 18 KECAMATAN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('districtChart');
        if (!ctx) return;

        const districtLabels = @json(array_column($districts, 'name'));
        const districtCounts = @json(array_column($districts, 'count'));

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: districtLabels,
                datasets: [{
                    label: 'Jumlah Jemaah (Orang)',
                    data: districtCounts,
                    backgroundColor: [
                        '#0d9a8c', '#6d7c1e', '#b8860b', '#0a7a6f', '#8a9a28',
                        '#c9a227', '#0d4f48', '#5c6b18', '#d4af37', '#14b8a6',
                        '#a8c03a', '#eab308', '#0284c7', '#10b981', '#f59e0b',
                        '#6366f1', '#8b5cf6', '#ec4899'
                    ],
                    borderRadius: 6,
                    borderWidth: 0,
                    maxBarThickness: 36
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#0d4f48',
                        titleFont: { family: 'Poppins', size: 13, weight: 'bold' },
                        bodyFont: { family: 'Poppins', size: 12 },
                        padding: 12,
                        cornerRadius: 8,
                        callbacks: {
                            label: function (context) {
                                return context.raw + ' Jemaah';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: {
                            font: { family: 'Poppins', size: 11 },
                            maxRotation: 45,
                            minRotation: 30
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0, 0, 0, 0.05)' },
                        ticks: {
                            font: { family: 'Poppins', size: 11 },
                            precision: 0
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
