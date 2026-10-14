@extends('admin.layout')

@section('title', 'Dashboard Info Jemaah 2027')

@section('content')
    <!-- Header Banner -->
    <div style="background:linear-gradient(135deg, #0a7a6f 0%, #0d4f48 60%, #5c6b18 100%);color:#fff;border-radius:16px;padding:28px;margin-bottom:24px;box-shadow:0 10px 25px rgba(10,122,111,0.2);">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:16px;">
            <div>
                <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.15);padding:4px 12px;border-radius:999px;font-size:0.8rem;font-weight:600;margin-bottom:10px;border:1px solid rgba(255,255,255,0.25);">
                    <span>🕋</span>
                    <span>Pusat Kendali Jemaah Haji 1448 H / 2027 M</span>
                </div>
                <h1 style="margin:0 0 8px;font-size:1.6rem;font-weight:700;">Dashboard Info Jemaah 2027</h1>
                <p style="margin:0;opacity:0.9;font-size:0.9rem;max-width:700px;line-height:1.5;">
                    Ringkasan persiapan calon jemaah haji Kabupaten Purbalingga. Seluruh perubahan data pada dashboard ini langsung otomatis terhubung dengan halaman publik.
                </p>
            </div>
            <div style="text-align:right;">
                <div style="font-size:0.75rem;opacity:0.85;text-transform:uppercase;letter-spacing:0.05em;">Terakhir Diperbarui</div>
                <div style="font-size:1.05rem;font-weight:700;color:#ffd54f;margin-top:2px;">{{ $lastUpdatedFormatted }}</div>
                <div style="margin-top:12px;">
                    <a href="{{ route('info.jemaah.2027') }}" target="_blank" class="btn" style="background:#ffd54f;color:#1a1a1a;font-weight:700;padding:8px 16px;font-size:0.85rem;display:inline-flex;align-items:center;gap:6px;">
                        <span>Lihat Halaman Publik</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Ringkasan Statistik Utama -->
    <h3 style="margin:0 0 14px;font-size:1.05rem;color:var(--admin-primary-dark);font-weight:600;">Ringkasan Data Statistik Utama</h3>
    <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(180px, 1fr));gap:14px;margin-bottom:24px;">
        <div class="admin-card" style="padding:16px;margin:0;">
            <div style="color:var(--admin-muted);font-size:0.78rem;font-weight:600;text-transform:uppercase;">Total Calon Jemaah</div>
            <div style="font-size:1.75rem;font-weight:700;color:var(--admin-primary-dark);margin:4px 0;">
                {{ $stat?->total_jemaah ? number_format($stat->total_jemaah, 0, ',', '.') : 'Menunggu Penetapan' }}
            </div>
            <div style="font-size:0.75rem;color:var(--admin-muted);">Alokasi kuota estimasi</div>
        </div>

        <div class="admin-card" style="padding:16px;margin:0;">
            <div style="color:var(--admin-muted);font-size:0.78rem;font-weight:600;text-transform:uppercase;">Laki-laki</div>
            <div style="font-size:1.75rem;font-weight:700;color:#0284c7;margin:4px 0;">
                {{ $stat?->jemaah_pria ? number_format($stat->jemaah_pria, 0, ',', '.') : '—' }}
            </div>
            <div style="font-size:0.75rem;color:var(--admin-muted);">Calon jemaah pria</div>
        </div>

        <div class="admin-card" style="padding:16px;margin:0;">
            <div style="color:var(--admin-muted);font-size:0.78rem;font-weight:600;text-transform:uppercase;">Perempuan</div>
            <div style="font-size:1.75rem;font-weight:700;color:#ec4899;margin:4px 0;">
                {{ $stat?->jemaah_wanita ? number_format($stat->jemaah_wanita, 0, ',', '.') : '—' }}
            </div>
            <div style="font-size:0.75rem;color:var(--admin-muted);">Calon jemaah wanita</div>
        </div>

        <div class="admin-card" style="padding:16px;margin:0;">
            <div style="color:var(--admin-muted);font-size:0.78rem;font-weight:600;text-transform:uppercase;">Jemaah Lansia</div>
            <div style="font-size:1.75rem;font-weight:700;color:#eab308;margin:4px 0;">
                {{ $stat?->jemaah_lansia ? number_format($stat->jemaah_lansia, 0, ',', '.') : '—' }}
            </div>
            <div style="font-size:0.75rem;color:var(--admin-muted);">Prioritas layanan khusus</div>
        </div>

        <div class="admin-card" style="padding:16px;margin:0;">
            <div style="color:var(--admin-muted);font-size:0.78rem;font-weight:600;text-transform:uppercase;">Kecamatan Terdata</div>
            <div style="font-size:1.75rem;font-weight:700;color:#10b981;margin:4px 0;">
                {{ $districtsCount }} <span style="font-size:0.9rem;font-weight:500;">kecamatan</span>
            </div>
            <div style="font-size:0.75rem;color:var(--admin-muted);">Total jemaah: {{ number_format($districtsTotalPilgrims, 0, ',', '.') }}</div>
        </div>

        <div class="admin-card" style="padding:16px;margin:0;">
            <div style="color:var(--admin-muted);font-size:0.78rem;font-weight:600;text-transform:uppercase;">Kloter Ditetapkan</div>
            <div style="font-size:1.75rem;font-weight:700;color:#8b5cf6;margin:4px 0;">
                {{ $stat?->total_kloter ?? ($klotersCount > 0 ? $klotersCount : 'Belum Ditetapkan') }}
            </div>
            <div style="font-size:0.75rem;color:var(--admin-muted);">Embarkasi Solo (SOC)</div>
        </div>
    </div>

    <!-- Ringkasan Biometrik & Progres Persiapan -->
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:24px;">
        <!-- Card Biometrik -->
        <div class="admin-card" style="margin:0;">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
                <h3 style="margin:0;font-size:1rem;color:var(--admin-primary-dark);">Progres Perekaman Biometrik</h3>
                <a href="{{ route('admin.jemaah-2027.biometrics.edit') }}" class="btn btn-secondary btn-sm">Perbarui Data</a>
            </div>
            <div style="display:flex;align-items:baseline;gap:8px;margin-bottom:8px;">
                <span style="font-size:2rem;font-weight:700;color:var(--admin-primary);">{{ $biometric ? $biometric->persentase : 0 }}%</span>
                <span style="color:var(--admin-muted);font-size:0.9rem;">
                    ({{ $biometric ? number_format($biometric->sudah_biometrik, 0, ',', '.') : 0 }} dari {{ $biometric ? number_format($biometric->target, 0, ',', '.') : 0 }} jemaah)
                </span>
            </div>
            <div class="admin-progress-track" style="height:12px;">
                <div class="admin-progress-bar" style="width:{{ $biometric ? min(100, $biometric->persentase) : 0 }}%;"></div>
            </div>
            <div style="display:flex;justify-content:space-between;font-size:0.8rem;color:var(--admin-muted);margin-top:10px;">
                <span>Belum Biometrik: <strong>{{ $biometric ? number_format($biometric->belum_biometrik, 0, ',', '.') : 0 }}</strong> jemaah</span>
                <span>Update: {{ $biometric?->tanggal_update?->format('d/m/Y') ?? '—' }}</span>
            </div>
        </div>

        <!-- Card Progres Persiapan -->
        <div class="admin-card" style="margin:0;">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
                <h3 style="margin:0;font-size:1rem;color:var(--admin-primary-dark);">Ringkasan 8 Tahapan Persiapan</h3>
                <a href="{{ route('admin.jemaah-2027.stages.index') }}" class="btn btn-secondary btn-sm">Kelola Tahapan</a>
            </div>
            <div style="display:flex;flex-direction:column;gap:8px;max-height:160px;overflow-y:auto;padding-right:4px;">
                @forelse ($stages as $stage)
                    <div style="display:flex;justify-content:space-between;align-items:center;padding:6px 0;border-bottom:1px solid #f1f5f9;font-size:0.85rem;">
                        <span style="font-weight:500;">{{ $stage->nama_tahapan }}</span>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <span class="badge-status {{ $stage->status === 'Selesai' ? 'badge-success' : ($stage->status === 'Sedang Berlangsung' ? 'badge-warning' : 'badge-neutral') }}" style="font-size:0.72rem;">
                                {{ $stage->status }}
                            </span>
                            <span style="font-weight:700;min-width:35px;text-align:right;">{{ $stage->persentase }}%</span>
                        </div>
                    </div>
                @empty
                    <p style="color:var(--admin-muted);font-size:0.85rem;margin:0;">Belum ada tahapan persiapan.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Menu Links to All 10 Submodules -->
    <h3 style="margin:0 0 14px;font-size:1.05rem;color:var(--admin-primary-dark);font-weight:600;">Akses Cepat Pengelolaan Info Jemaah 2027</h3>
    <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));gap:14px;">
        <a href="{{ route('admin.jemaah-2027.stats.edit') }}" class="dashboard-card" style="border-left:4px solid #b8860b;">
            <h4>2. Statistik Jemaah</h4>
            <p>Kelola angka agregat total jemaah, pria, wanita, lansia, dan kloter.</p>
        </a>

        <a href="{{ route('admin.jemaah-2027.stages.index') }}" class="dashboard-card" style="border-left:4px solid #0d9a8c;">
            <h4>3. Progres Persiapan</h4>
            <p>Kelola 8 tahapan persiapan haji, persentase (0–100%), dan status tahapan.</p>
        </a>

        <a href="{{ route('admin.jemaah-2027.verifications.index') }}" class="dashboard-card" style="border-left:4px solid #0284c7;">
            <h4>4. Rekapitulasi Verifikasi</h4>
            <p>Tambah dan edit Tahap I, Tahap II, dst. (siap, tunda, wafat, dsb.).</p>
        </a>

        <a href="{{ route('admin.jemaah-2027.biometrics.edit') }}" class="dashboard-card" style="border-left:4px solid #8a9a28;">
            <h4>5. Progres Biometrik</h4>
            <p>Update target dan jumlah jemaah selesai rekam Bio Visa (persentase otomatis).</p>
        </a>

        <a href="{{ route('admin.jemaah-2027.districts.index') }}" class="dashboard-card" style="border-left:4px solid #10b981;">
            <h4>6. Sebaran Kecamatan</h4>
            <p>Kelola jumlah jemaah per 18 kecamatan di Purbalingga (grafik & tabel otomatis).</p>
        </a>

        <a href="{{ route('admin.jemaah-2027.timelines.index') }}" class="dashboard-card" style="border-left:4px solid #6366f1;">
            <h4>7. Timeline Persiapan</h4>
            <p>Kelola alur jadwal dan tahapan persiapan dari awal hingga keberangkatan.</p>
        </a>

        <a href="{{ route('admin.jemaah-2027.kloters.index') }}" class="dashboard-card" style="border-left:4px solid #ec4899;">
            <h4>8. Informasi Kloter</h4>
            <p>Kelola jadwal kloter resmi (ditampilkan rapi jika sudah ditetapkan).</p>
        </a>

        <a href="{{ route('admin.jemaah-2027.announcements.index') }}" class="dashboard-card" style="border-left:4px solid #f59e0b;">
            <h4>9. Pengumuman Haji 2027</h4>
            <p>Buat dan publikasikan surat edaran atau pengumuman penting bagi calon jemaah.</p>
        </a>

        <a href="{{ route('admin.jemaah-2027.documents.index') }}" class="dashboard-card" style="border-left:4px solid #0ea5e9;">
            <h4>10. Panduan & Dokumen</h4>
            <p>Upload buku panduan, form, berkas persyaratan, dan juknis untuk didownload jemaah.</p>
        </a>

        <a href="{{ route('admin.jemaah-2027.services.index') }}" class="dashboard-card" style="border-left:4px solid #14b8a6;">
            <h4>11. Layanan Prioritas</h4>
            <p>Kelola poin layanan khusus jemaah lansia, disabilitas, pendampingan, dan manasik.</p>
        </a>
    </div>
@endsection
