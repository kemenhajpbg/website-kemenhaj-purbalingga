@extends('layouts.app')

@section('pageTitle', 'Info Jemaah Haji Purbalingga 2027 | Kemenhaj Purbalingga')
@section('pageDescription', 'Informasi persiapan calon jemaah haji Kabupaten Purbalingga Tahun 1448 H / 2027 M, meliputi progres persiapan, biometrik, verifikasi, kloter, pengumuman, dan panduan jemaah.')
@section('ogTitle', 'Info Jemaah Haji Purbalingga 2027 | Kemenhaj Purbalingga')
@section('ogDescription', 'Pusat Informasi Persiapan Calon Jemaah Haji Kabupaten Purbalingga Tahun 1448 H / 2027 M.')

@section('content')
<div class="hajj-page">

    {{-- TOP NAVBAR --}}
    @include('partials.site-top', ['hideSlope' => true])

    {{-- BAGIAN 1: HERO SECTION --}}
    <section class="hajj-hero">
        <div class="container">
            <div class="hajj-hero-content">
                <div class="hajj-hero-badge">
                    <span style="font-size:1.15rem;" aria-hidden="true">🕋</span>
                    <span>Informasi Resmi Terpadu Penyelenggaraan Haji</span>
                </div>

                <h1 class="hajj-hero-title">INFO JEMAAH HAJI PURBALINGGA 2027</h1>
                
                <div class="hajj-hero-year">1448 H / 2027 M</div>

                <p class="hajj-hero-subtitle">
                    Pusat Informasi Persiapan Calon Jemaah Haji Kabupaten Purbalingga Tahun 1448 H / 2027 M.<br>
                    <span style="font-size:0.9em;opacity:0.9;">"Informasi diperbarui secara berkala oleh Kementerian Haji dan Umrah Kabupaten Purbalingga."</span>
                </p>

                <div class="hajj-hero-meta">
                    <div class="hajj-hero-meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span>Terakhir diperbarui: <strong>{{ $lastUpdatedFormatted }}</strong></span>
                    </div>
                    <div class="hajj-hero-meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span>Data Agregat Resmi</span>
                    </div>
                </div>

                <div style="margin-top:10px;">
                    <a href="#progres-persiapan" class="btn-hajj-cta">
                        <span>Lihat Progres Persiapan</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="hajj-hero-slope" aria-hidden="true"></div>
    </section>

    {{-- BAGIAN 2: STATISTIK UTAMA --}}
    <section class="hajj-section" id="statistik-utama">
        <div class="container">
            <div class="hajj-section-header">
                <span class="hajj-section-tag">Statistik Agregat Jemaah</span>
                <h2 class="hajj-section-title">Data Calon Jemaah Haji Purbalingga 2027</h2>
                <p class="hajj-section-desc">
                    Gambaran umum kuota estimasi dan komposisi jemaah haji Kabupaten Purbalingga untuk keberangkatan 1448 H / 2027 M.
                </p>
            </div>

            <div class="hajj-stat-grid">
                <!-- 1. Total Jemaah -->
                <div class="hajj-stat-card">
                    <span class="hajj-stat-icon" aria-hidden="true">👥</span>
                    <div class="hajj-stat-num {{ empty($stat?->total_jemaah) ? 'hajj-stat-num--pending' : '' }}">
                        {{ !empty($stat?->total_jemaah) ? number_format($stat->total_jemaah, 0, ',', '.') : 'Menunggu Penetapan' }}
                    </div>
                    <div class="hajj-stat-label">Jumlah Calon Jemaah</div>
                    <div class="hajj-stat-sub">Estimasi Kuota Purbalingga</div>
                </div>

                <!-- 2. Jumlah Kecamatan -->
                <div class="hajj-stat-card">
                    <span class="hajj-stat-icon" aria-hidden="true">🏘️</span>
                    <div class="hajj-stat-num">
                        {{ $stat?->total_kecamatan ?? 18 }}
                    </div>
                    <div class="hajj-stat-label">Jumlah Kecamatan</div>
                    <div class="hajj-stat-sub">Seluruh Purbalingga</div>
                </div>

                <!-- 3. Jemaah Laki-laki -->
                <div class="hajj-stat-card">
                    <span class="hajj-stat-icon" aria-hidden="true">👨</span>
                    <div class="hajj-stat-num {{ empty($stat?->jemaah_pria) ? 'hajj-stat-num--pending' : '' }}">
                        {{ !empty($stat?->jemaah_pria) ? number_format($stat->jemaah_pria, 0, ',', '.') : 'Menunggu Penetapan' }}
                    </div>
                    <div class="hajj-stat-label">Jemaah Laki-laki</div>
                    <div class="hajj-stat-sub">Calon jemaah pria</div>
                </div>

                <!-- 4. Jemaah Perempuan -->
                <div class="hajj-stat-card">
                    <span class="hajj-stat-icon" aria-hidden="true">👩</span>
                    <div class="hajj-stat-num {{ empty($stat?->jemaah_wanita) ? 'hajj-stat-num--pending' : '' }}">
                        {{ !empty($stat?->jemaah_wanita) ? number_format($stat->jemaah_wanita, 0, ',', '.') : 'Menunggu Penetapan' }}
                    </div>
                    <div class="hajj-stat-label">Jemaah Perempuan</div>
                    <div class="hajj-stat-sub">Calon jemaah wanita</div>
                </div>

                <!-- 5. Jemaah Lansia -->
                <div class="hajj-stat-card">
                    <span class="hajj-stat-icon" aria-hidden="true">👴</span>
                    <div class="hajj-stat-num {{ empty($stat?->jemaah_lansia) ? 'hajj-stat-num--pending' : '' }}">
                        {{ !empty($stat?->jemaah_lansia) ? number_format($stat->jemaah_lansia, 0, ',', '.') : 'Menunggu Penetapan' }}
                    </div>
                    <div class="hajj-stat-label">Jemaah Lansia</div>
                    <div class="hajj-stat-sub">Prioritas Layanan Khusus</div>
                </div>

                <!-- 6. Jumlah Kloter -->
                <div class="hajj-stat-card">
                    <span class="hajj-stat-icon" aria-hidden="true">✈️</span>
                    <div class="hajj-stat-num {{ empty($stat?->total_kloter) ? 'hajj-stat-num--pending' : '' }}">
                        {{ !empty($stat?->total_kloter) ? $stat->total_kloter . ' Kloter' : 'Menunggu Penetapan' }}
                    </div>
                    <div class="hajj-stat-label">Jumlah Kloter</div>
                    <div class="hajj-stat-sub">Embarkasi Solo (SOC)</div>
                </div>
            </div>

            @if ($stat?->keterangan)
                <div style="margin-top:20px;text-align:center;font-size:0.88rem;color:#64748b;font-style:italic;">
                    * {{ $stat->keterangan }}
                </div>
            @endif
        </div>
    </section>

    {{-- BAGIAN 3: PROGRES PERSIAPAN HAJI 2027 --}}
    <section class="hajj-section hajj-section--alt" id="progres-persiapan">
        <div class="container">
            <div class="hajj-section-header">
                <span class="hajj-section-tag">Tahapan & Capaian</span>
                <h2 class="hajj-section-title">PROGRES PERSIAPAN HAJI 2027</h2>
                <p class="hajj-section-desc">
                    Pantau perkembangan 8 tahapan inti persiapan calon jemaah haji Kabupaten Purbalingga secara transparan dan berkala.
                </p>
            </div>

            <div class="hajj-stage-grid">
                @forelse ($stages as $index => $stage)
                    <div class="hajj-stage-card">
                        <div class="hajj-stage-card-header">
                            <div>
                                <div class="hajj-stage-index">Tahap {{ $stage->urutan ?: ($index + 1) }}</div>
                                <h3 class="hajj-stage-card-title">{{ $stage->nama_tahapan }}</h3>
                            </div>
                            <span class="badge-status {{ $stage->status === 'Selesai' ? 'badge-success' : ($stage->status === 'Sedang Berlangsung' ? 'badge-warning' : ($stage->status === 'Menunggu Penetapan' ? 'badge-info' : 'badge-neutral')) }}">
                                {{ $stage->status }}
                            </span>
                        </div>

                        <div class="hajj-progress-wrap">
                            <div class="hajj-progress-info">
                                <span style="color:#64748b;font-weight:500;">Capaian</span>
                                <span class="hajj-progress-percent">{{ $stage->persentase }}%</span>
                            </div>
                            <div class="admin-progress-track" style="height:10px;">
                                <div class="admin-progress-bar" style="width:{{ $stage->persentase }}%;"></div>
                            </div>
                        </div>

                        <p class="hajj-stage-desc">
                            {{ $stage->keterangan ?? 'Tahapan dalam proses koordinasi dan persiapan teknis.' }}
                        </p>

                        <div class="hajj-stage-footer">
                            <span>Status: <strong>{{ $stage->status }}</strong></span>
                            @if ($stage->tanggal_update)
                                <span>Update: {{ $stage->tanggal_update->format('d/m/Y') }}</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <p style="text-align:center;color:#64748b;grid-column:1/-1;">Data tahapan persiapan sedang dipersiapkan oleh petugas.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- BAGIAN 5: PROGRES BIOMETRIK (DITEMPATKAN DI ATAS AGAR TERUS TERPANTAU) --}}
    @if ($biometric)
        <section class="hajj-section" id="biometrik">
            <div class="container">
                <div class="hajj-biometric-banner">
                    <div class="hajj-biometric-header">
                        <div>
                            <div style="display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,0.2);padding:3px 12px;border-radius:999px;font-size:0.78rem;font-weight:600;margin-bottom:8px;">
                                <span>📱</span>
                                <span>Aplikasi Bio Visa</span>
                            </div>
                            <h3>PROGRES BIOMETRIK JEMAAH HAJI 2027</h3>
                            <p style="margin:4px 0 0;opacity:0.9;font-size:0.88rem;max-width:640px;">
                                {{ $biometric->keterangan ?? 'Perekaman biometrik Bio Visa mandiri smartphone atau dengan pendampingan petugas di kantor Kemenhaj Purbalingga.' }}
                            </p>
                        </div>
                        @if ($biometric->tanggal_update)
                            <div style="font-size:0.8rem;background:rgba(0,0,0,0.2);padding:6px 14px;border-radius:999px;">
                                Terakhir diperbarui: {{ $biometric->tanggal_update->format('d/m/Y') }}
                            </div>
                        @endif
                    </div>

                    <div class="hajj-biometric-grid">
                        <div class="hajj-biometric-big-stat">
                            <div class="percent">{{ $biometric->persentase }}%</div>
                            <div style="font-size:0.9rem;font-weight:600;letter-spacing:0.02em;">Perekaman Selesai</div>
                            <div style="font-size:0.78rem;opacity:0.8;margin-top:4px;">{{ number_format($biometric->sudah_biometrik, 0, ',', '.') }} dari {{ number_format($biometric->target, 0, ',', '.') }} jemaah</div>
                        </div>

                        <div>
                            <div style="margin-bottom:8px;display:flex;justify-content:space-between;font-size:0.88rem;font-weight:600;">
                                <span>Progres Perekaman Bio Visa Mandiri</span>
                                <span>{{ $biometric->persentase }}%</span>
                            </div>
                            <div class="admin-progress-track" style="height:16px;background:rgba(255,255,255,0.2);">
                                <div class="admin-progress-bar" style="width:{{ min(100, $biometric->persentase) }}%;background:linear-gradient(90deg, #ffd54f, #c5d84a);"></div>
                            </div>

                            <div class="hajj-biometric-numbers">
                                <div class="hajj-biometric-num-card">
                                    <div class="n-val">{{ number_format($biometric->target, 0, ',', '.') }}</div>
                                    <div class="n-lbl">Target Jemaah</div>
                                </div>
                                <div class="hajj-biometric-num-card" style="border-left:3px solid #ffd54f;">
                                    <div class="n-val" style="color:#ffd54f;">{{ number_format($biometric->sudah_biometrik, 0, ',', '.') }}</div>
                                    <div class="n-lbl">Sudah Biometrik</div>
                                </div>
                                <div class="hajj-biometric-num-card" style="border-left:3px solid #ff8a8a;">
                                    <div class="n-val" style="color:#ffd0d0;">{{ number_format($biometric->belum_biometrik, 0, ',', '.') }}</div>
                                    <div class="n-lbl">Belum Biometrik</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- BAGIAN 4: REKAPITULASI VERIFIKASI --}}
    <section class="hajj-section hajj-section--alt" id="verifikasi">
        <div class="container">
            <div class="hajj-section-header">
                <span class="hajj-section-tag">Validasi Berkas & Porsi</span>
                <h2 class="hajj-section-title">REKAPITULASI VERIFIKASI CALON JEMAAH</h2>
                <p class="hajj-section-desc">
                    Hasil verifikasi berkas, kesiapan fisik, status kesehatan, dan administrasi calon jemaah haji menurut tahapan verifikasi resmi.
                </p>
            </div>

            <div class="hajj-verif-card-group">
                @forelse ($verifications as $v)
                    <div class="hajj-verif-box">
                        <div class="hajj-verif-header">
                            <div>
                                <h3>{{ $v->nama_tahap }}</h3>
                                @if ($v->tanggal_update)
                                    <span style="font-size:0.75rem;color:#94a3b8;">Diperbarui: {{ $v->tanggal_update->format('d/m/Y') }}</span>
                                @endif
                            </div>
                            <div class="hajj-verif-total">
                                Total: <strong>{{ number_format($v->total, 0, ',', '.') }}</strong> Jemaah
                            </div>
                        </div>

                        <div class="hajj-verif-metrics">
                            <div class="hajj-verif-metric-item is-siap">
                                <div class="val" style="color:#2e7d32;">{{ number_format($v->siap, 0, ',', '.') }}</div>
                                <div class="lbl">Siap Berangkat</div>
                            </div>

                            <div class="hajj-verif-metric-item is-ditunda">
                                <div class="val" style="color:#b78103;">{{ number_format($v->ditunda, 0, ',', '.') }}</div>
                                <div class="lbl">Ditunda</div>
                            </div>

                            <div class="hajj-verif-metric-item is-wafat">
                                <div class="val" style="color:#c62828;">{{ number_format($v->meninggal, 0, ',', '.') }}</div>
                                <div class="lbl">Meninggal Dunia</div>
                            </div>

                            <div class="hajj-verif-metric-item is-blm">
                                <div class="val" style="color:#475569;">{{ number_format($v->sudah_berhaji_belum_memenuhi, 0, ',', '.') }}</div>
                                <div class="lbl">Sudah Berhaji / Belum Memenuhi</div>
                            </div>
                        </div>

                        @if ($v->keterangan)
                            <p style="font-size:0.84rem;color:#64748b;margin:0;line-height:1.5;">
                                {{ $v->keterangan }}
                            </p>
                        @endif
                    </div>
                @empty
                    <p style="text-align:center;color:#64748b;grid-column:1/-1;">Belum ada data rekapitulasi verifikasi.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- BAGIAN 6: SEBARAN PER KECAMATAN --}}
    <section class="hajj-section" id="sebaran-kecamatan">
        <div class="container">
            <div class="hajj-section-header">
                <span class="hajj-section-tag">Sebaran Wilayah</span>
                <h2 class="hajj-section-title">SEBARAN CALON JEMAAH HAJI PER KECAMATAN</h2>
                <p class="hajj-section-desc">
                    Distribusi calon jemaah haji estimasi 2027 di 18 kecamatan se-Kabupaten Purbalingga.
                </p>
            </div>

            <div class="hajj-district-layout">
                <!-- Visual Bar Chart -->
                <div class="hajj-district-card">
                    <h3 style="margin:0 0 16px;font-size:1.1rem;color:#0d4f48;font-weight:700;">Grafik Sebaran per Kecamatan</h3>
                    <div style="position:relative;height:420px;width:100%;">
                        <canvas id="districtChart"></canvas>
                    </div>
                </div>

                <!-- Tabel Detail & Total Otomatis -->
                <div class="hajj-district-card" style="padding:0;overflow:hidden;">
                    <div style="padding:18px 20px;border-bottom:1px solid #e2ebe8;display:flex;justify-content:space-between;align-items:center;">
                        <h3 style="margin:0;font-size:1.1rem;color:#0d4f48;font-weight:700;">Tabel Sebaran Kecamatan</h3>
                        <span style="font-size:0.85rem;color:#64748b;">Total: <strong>{{ number_format($totalDistrictPilgrims, 0, ',', '.') }}</strong> Jemaah</span>
                    </div>

                    <div class="table-responsive" style="max-height:420px;overflow-y:auto;">
                        <table class="admin-table" style="margin:0;">
                            <thead>
                                <tr>
                                    <th style="width:50px;text-align:center;">No</th>
                                    <th>Kecamatan</th>
                                    <th style="text-align:right;">Jumlah Jemaah</th>
                                    <th style="text-align:right;width:90px;">Persentase</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($districts as $idx => $d)
                                    @php
                                        $pct = $totalDistrictPilgrims > 0 ? round(($d->jumlah_jemaah / $totalDistrictPilgrims) * 100, 1) : 0;
                                    @endphp
                                    <tr>
                                        <td style="text-align:center;color:#64748b;font-size:0.82rem;">{{ $idx + 1 }}</td>
                                        <td><strong>{{ $d->nama_kecamatan }}</strong></td>
                                        <td style="text-align:right;font-weight:700;color:#0d4f48;">{{ number_format($d->jumlah_jemaah, 0, ',', '.') }} orang</td>
                                        <td style="text-align:right;font-size:0.82rem;color:#64748b;">{{ $pct }}%</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" style="text-align:center;color:#64748b;">Data kecamatan belum tersedia.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr style="background:#f1f5f9;font-weight:700;">
                                    <td colspan="2" style="text-align:right;">TOTAL KESELURUHAN:</td>
                                    <td style="text-align:right;color:#0a7a6f;font-size:1.05rem;">{{ number_format($totalDistrictPilgrims, 0, ',', '.') }} orang</td>
                                    <td style="text-align:right;">100%</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- BAGIAN 7: TIMELINE --}}
    <section class="hajj-section hajj-section--alt" id="timeline">
        <div class="container">
            <div class="hajj-section-header">
                <span class="hajj-section-tag">Agenda Perjalanan</span>
                <h2 class="hajj-section-title">TIMELINE PERSIAPAN JEMAAH HAJI 2027</h2>
                <p class="hajj-section-desc">
                    Alur tahapan dari persiapan dokumen, pemeriksaan kesehatan, manasik, hingga keberangkatan menuju Tanah Suci.
                </p>
            </div>

            <div class="hajj-timeline-wrap">
                @forelse ($timelines as $t)
                    <div class="hajj-timeline-item {{ $t->status === 'Selesai' ? 'is-selesai' : ($t->status === 'Berlangsung' ? 'is-berlangsung' : '') }}">
                        <div class="hajj-timeline-node">
                            @if ($t->status === 'Selesai')
                                ✓
                            @elseif ($t->status === 'Berlangsung')
                                ●
                            @else
                                ○
                            @endif
                        </div>
                        <div class="hajj-timeline-content">
                            <div class="hajj-timeline-top">
                                <h3 class="hajj-timeline-title">{{ $t->nama_tahap }}</h3>
                                <div style="display:flex;align-items:center;gap:10px;">
                                    <span class="hajj-timeline-date">{{ $t->tanggal }}</span>
                                    <span class="badge-status {{ $t->status === 'Selesai' ? 'badge-success' : ($t->status === 'Berlangsung' ? 'badge-warning' : 'badge-neutral') }}" style="font-size:0.72rem;">
                                        {{ $t->status }}
                                    </span>
                                </div>
                            </div>
                            @if ($t->deskripsi)
                                <p class="hajj-timeline-desc">{{ $t->deskripsi }}</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <p style="text-align:center;color:#64748b;">Timeline persiapan sedang disusun oleh tim operasional.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- BAGIAN 8: INFORMASI KLOTER --}}
    <section class="hajj-section" id="kloter">
        <div class="container">
            <div class="hajj-section-header">
                <span class="hajj-section-tag">Kelompok Terbang (Kloter)</span>
                <h2 class="hajj-section-title">INFORMASI KLOTER JEMAAH HAJI PURBALINGGA</h2>
                <p class="hajj-section-desc">
                    Jadwal masuk asrama haji dan waktu penerbangan jemaah haji Kabupaten Purbalingga Embarkasi Solo (SOC).
                </p>
            </div>

            @php
                $validKloters = $kloters->where('status', '!=', 'Belum Ditetapkan');
            @endphp

            @if ($validKloters->isEmpty())
                <div style="background:#fff8e1;border:1px solid #fde68a;border-radius:var(--radius-lg);padding:32px 24px;text-align:center;max-width:680px;margin:0 auto;box-shadow:0 4px 16px rgba(0,0,0,0.03);">
                    <div style="font-size:2.4rem;margin-bottom:10px;" aria-hidden="true">✈️</div>
                    <h3 style="margin:0 0 8px;font-size:1.2rem;color:#78350f;font-weight:700;">Informasi Kloter Belum Ditetapkan</h3>
                    <p style="margin:0;font-size:0.95rem;color:#92400e;line-height:1.5;">
                        "Informasi kloter akan diperbarui setelah penetapan resmi oleh Kementerian Agama / Kementerian Haji dan Umrah."
                    </p>
                    <div style="margin-top:16px;font-size:0.8rem;color:#b45309;">
                        Penetapan nomor kloter, jadwal kumpul koper, dan jadwal masuk Asrama Haji Donohudan akan diumumkan menjelang musim keberangkatan.
                    </div>
                </div>
            @else
                <div class="hajj-kloter-grid">
                    @foreach ($validKloters as $k)
                        <div class="hajj-kloter-card">
                            <div class="hajj-kloter-header">
                                <span class="hajj-kloter-num">{{ $k->nomor_kloter }}</span>
                                <span class="badge-status {{ $k->status === 'Terjadwal' ? 'badge-info' : ($k->status === 'Sudah Berangkat' ? 'badge-warning' : 'badge-success') }}">
                                    {{ $k->status }}
                                </span>
                            </div>

                            <div class="hajj-kloter-details">
                                <div class="hajj-kloter-row">
                                    <span style="color:#64748b;">Jumlah Jemaah:</span>
                                    <strong>{{ number_format($k->jumlah_jemaah, 0, ',', '.') }} orang</strong>
                                </div>
                                <div class="hajj-kloter-row">
                                    <span style="color:#64748b;">Embarkasi:</span>
                                    <strong>{{ $k->embarkasi ?? 'SOC (Solo)' }}</strong>
                                </div>
                                <div class="hajj-kloter-row">
                                    <span style="color:#64748b;">Masuk Asrama:</span>
                                    <strong>{{ $k->tanggal_masuk_asrama?->format('d M Y, H:i') ?? '—' }} WIB</strong>
                                </div>
                                <div class="hajj-kloter-row">
                                    <span style="color:#64748b;">Keberangkatan:</span>
                                    <strong>{{ $k->tanggal_keberangkatan?->format('d M Y, H:i') ?? '—' }} WIB</strong>
                                </div>
                            </div>

                            @if ($k->keterangan)
                                <div style="font-size:0.82rem;color:#64748b;background:#f8faf9;padding:8px 10px;border-radius:6px;line-height:1.4;">
                                    {{ $k->keterangan }}
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- BAGIAN 9: PRIORITAS LAYANAN JEMAAH --}}
    <section class="hajj-section hajj-section--alt" id="layanan-jemaah">
        <div class="container">
            <div class="hajj-section-header">
                <span class="hajj-section-tag">Pelayanan Prima</span>
                <h2 class="hajj-section-title">PRIORITAS LAYANAN JEMAAH</h2>
                <p class="hajj-section-desc">
                    Komitmen Kementerian Haji dan Umrah Kabupaten Purbalingga dalam mendampingi seluruh kebutuhan fisik, administrasi, dan ibadah calon jemaah.
                </p>
            </div>

            <div class="hajj-service-grid">
                @forelse ($services as $srv)
                    <div class="hajj-service-card">
                        <div class="hajj-service-icon-wrap" aria-hidden="true">
                            @if ($srv->icon === 'elderly')
                                👴
                            @elseif ($srv->icon === 'disability')
                                ♿
                            @elseif ($srv->icon === 'companion')
                                🤝
                            @elseif ($srv->icon === 'health')
                                🩺
                            @elseif ($srv->icon === 'manasik')
                                📖
                            @else
                                🕋
                            @endif
                        </div>
                        <h4>{{ $srv->judul }}</h4>
                        <p>{{ $srv->deskripsi }}</p>
                    </div>
                @empty
                    <p style="text-align:center;color:#64748b;grid-column:1/-1;">Informasi layanan jemaah sedang disiapkan.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- BAGIAN 10: PENGUMUMAN HAJI 2027 --}}
    @if ($announcements->isNotEmpty())
        <section class="hajj-section" id="pengumuman">
            <div class="container">
                <div class="hajj-section-header">
                    <span class="hajj-section-tag">Pemberitahuan Resmi</span>
                    <h2 class="hajj-section-title">PENGUMUMAN HAJI 2027</h2>
                    <p class="hajj-section-desc">
                        Informasi edaran resmi, jadwal penting, dan pengumuman mendesak bagi calon jemaah haji Kabupaten Purbalingga.
                    </p>
                </div>

                <div class="hajj-news-grid">
                    @foreach ($announcements as $a)
                        <div class="hajj-announcement-card">
                            <div class="hajj-announcement-date">
                                📅 {{ $a->tanggal_publikasi?->format('d F Y') ?? '—' }}
                            </div>
                            <h4>{{ $a->judul }}</h4>
                            <p class="hajj-announcement-text">
                                {{ Str::limit(strip_tags($a->isi), 150) }}
                            </p>
                            <div style="display:flex;justify-content:space-between;align-items:center;margin-top:auto;padding-top:12px;border-top:1px solid #f1f5f9;">
                                <a href="{{ route('info.jemaah.2027.pengumuman', $a->slug) }}" style="color:var(--admin-primary);font-weight:600;font-size:0.85rem;text-decoration:none;">
                                    Baca Selengkapnya →
                                </a>
                                @if ($a->file_lampiran)
                                    <a href="{{ asset($a->file_lampiran) }}" target="_blank" style="color:#b8860b;font-size:0.8rem;text-decoration:underline;">
                                        Unduh Lampiran
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- BAGIAN 11: BERITA HAJI 2027 (MENGGUNAKAN SISTEM BERITA EXISTING) --}}
    @if ($newsList->isNotEmpty())
        <section class="hajj-section hajj-section--alt" id="berita">
            <div class="container">
                <div class="hajj-section-header">
                    <span class="hajj-section-tag">Warta & Kabar Terkini</span>
                    <h2 class="hajj-section-title">BERITA HAJI 2027</h2>
                    <p class="hajj-section-desc">
                        Kumpulan berita dan liputan kegiatan seputar persiapan jemaah haji Kabupaten Purbalingga.
                    </p>
                </div>

                <div class="hajj-news-grid">
                    @foreach ($newsList as $item)
                        <article class="hajj-announcement-card" style="padding:0;overflow:hidden;">
                            @if ($item->display_image)
                                <img src="{{ asset($item->display_image) }}" alt="{{ $item->title }}" style="width:100%;height:180px;object-fit:cover;" loading="lazy">
                            @endif
                            <div style="padding:18px;display:flex;flex-direction:column;flex-grow:1;">
                                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
                                    <span style="font-size:0.75rem;color:#94a3b8;">{{ $item->published_at?->format('d M Y') ?? '—' }}</span>
                                    @if ($item->category)
                                        <span class="badge-status badge-success" style="font-size:0.7rem;">{{ $item->category }}</span>
                                    @endif
                                </div>
                                <h4 style="margin:0 0 8px;">
                                    <a href="{{ route('berita.show', $item->slug) }}" style="color:inherit;text-decoration:none;">
                                        {{ $item->title }}
                                    </a>
                                </h4>
                                <p style="font-size:0.85rem;color:#4b5563;line-height:1.5;margin-bottom:14px;flex-grow:1;">
                                    {{ Str::limit($item->excerpt ?: strip_tags($item->content), 120) }}
                                </p>
                                <a href="{{ route('berita.show', $item->slug) }}" style="color:var(--teal-dark);font-weight:600;font-size:0.85rem;text-decoration:none;margin-top:auto;">
                                    Baca Berita Lengkap →
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div style="text-align:center;margin-top:20px;">
                    <a href="{{ route('berita.index') }}" class="btn btn-secondary" style="background:#ffffff;border:1px solid #cbd5e1;padding:12px 28px;border-radius:999px;font-weight:600;">
                        Lihat Semua Berita →
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- BAGIAN 12: PANDUAN & DOWNLOAD DOKUMEN --}}
    <section class="hajj-section" id="panduan">
        <div class="container">
            <div class="hajj-section-header">
                <span class="hajj-section-tag">Pusat Unduhan</span>
                <h2 class="hajj-section-title">PANDUAN & DOKUMEN JEMAAH</h2>
                <p class="hajj-section-desc">
                    Unduh buku panduan persiapan haji, buku saku manasik, juknis rekam bio visa, dan dokumen resmi keberangkatan haji 2027.
                </p>
            </div>

            <div class="hajj-doc-list">
                @forelse ($documents as $doc)
                    <div class="hajj-doc-item">
                        <div class="hajj-doc-info">
                            <div class="hajj-doc-icon" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                            </div>
                            <div class="hajj-doc-meta">
                                <h4>{{ $doc->judul }}</h4>
                                <p>
                                    <span style="font-weight:600;color:#0d4f48;">{{ $doc->kategori }}</span>
                                    @if ($doc->file_size)
                                        • {{ $doc->file_size }}
                                    @endif
                                    @if ($doc->tanggal)
                                        • {{ $doc->tanggal->format('d/m/Y') }}
                                    @endif
                                </p>
                                @if ($doc->deskripsi)
                                    <p style="margin-top:3px;color:#64748b;">{{ $doc->deskripsi }}</p>
                                @endif
                            </div>
                        </div>

                        <a href="{{ route('info.jemaah.2027.download', $doc) }}" class="btn-doc-download">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>
                            <span>Download</span>
                        </a>
                    </div>
                @empty
                    <p style="text-align:center;color:#64748b;grid-column:1/-1;">Belum ada dokumen yang diunggah.</p>
                @endforelse
            </div>
        </div>
    </section>

</div>

{{-- Load Chart.js for Responsive District Bar Chart --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('districtChart');
        if (ctx && typeof Chart !== 'undefined') {
            const districtNames = @json($districts->pluck('nama_kecamatan'));
            const pilgrimCounts = @json($districts->pluck('jumlah_jemaah'));

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: districtNames,
                    datasets: [{
                        label: 'Jumlah Calon Jemaah',
                        data: pilgrimCounts,
                        backgroundColor: 'rgba(13, 154, 140, 0.85)',
                        borderColor: '#0a7a6f',
                        borderWidth: 1.5,
                        borderRadius: 6,
                        hoverBackgroundColor: '#ffd54f',
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    indexAxis: window.innerWidth < 768 ? 'y' : 'x',
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y !== undefined 
                                        ? context.parsed.y + ' orang jemaah'
                                        : context.parsed.x + ' orang jemaah';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 11
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f1f5f9'
                            },
                            ticks: {
                                stepSize: 5
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endsection
