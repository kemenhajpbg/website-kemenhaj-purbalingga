@extends('admin.layout')

@section('title', 'Kelola Progres Biometrik Haji 2027')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <div>
            <h2 style="margin:0;">Progres Biometrik Bio Visa 2027</h2>
            <p style="margin:4px 0 0;color:var(--admin-muted);font-size:0.85rem;">
                Kelola target dan capaian perekaman biometrik Bio Visa jemaah haji Kabupaten Purbalingga.
            </p>
        </div>
        <a href="{{ route('admin.jemaah-2027.dashboard') }}" class="btn btn-secondary btn-sm">← Kembali ke Dashboard</a>
    </div>

    <!-- Live Preview Box -->
    <div class="admin-card" style="background:#f8fafc;border:1px dashed #cbd5e1;margin-bottom:20px;">
        <h3 style="margin:0 0 10px;font-size:0.95rem;color:var(--admin-primary-dark);">Pratinjau Otomatis (Live Preview)</h3>
        <div style="display:flex;align-items:baseline;gap:12px;flex-wrap:wrap;">
            <div>
                <span id="previewPersentase" style="font-size:2.2rem;font-weight:700;color:var(--admin-primary);">{{ $biometric->persentase }}%</span>
            </div>
            <div style="font-size:0.95rem;color:#334155;">
                <span id="previewSudah" style="font-weight:700;">{{ number_format($biometric->sudah_biometrik, 0, ',', '.') }}</span> selesai dari target 
                <span id="previewTarget" style="font-weight:700;">{{ number_format($biometric->target, 0, ',', '.') }}</span> jemaah.
            </div>
            <div style="margin-left:auto;font-size:0.85rem;color:var(--admin-muted);">
                Sisa belum biometrik: <strong id="previewBelum" style="color:#b78103;">{{ number_format($biometric->belum_biometrik, 0, ',', '.') }}</strong> jemaah
            </div>
        </div>
        <div class="admin-progress-track" style="height:12px;margin-top:12px;">
            <div id="previewBar" class="admin-progress-bar" style="width:{{ min(100, $biometric->persentase) }}%;"></div>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.jemaah-2027.biometrics.update') }}" class="admin-card">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group">
                <label for="target">Target Total Jemaah Biometrik *</label>
                <input type="number" id="target" name="target" value="{{ old('target', $biometric->target) }}" min="0" required oninput="calcBiometrics()">
                <small style="color:var(--admin-muted);font-size:0.8rem;">Target kuota calon jemaah yang wajib rekam Bio Visa</small>
            </div>

            <div class="form-group">
                <label for="sudah_biometrik">Jumlah Jemaah Sudah Biometrik *</label>
                <input type="number" id="sudah_biometrik" name="sudah_biometrik" value="{{ old('sudah_biometrik', $biometric->sudah_biometrik) }}" min="0" required oninput="calcBiometrics()">
                <small style="color:var(--admin-muted);font-size:0.8rem;">Jumlah jemaah yang telah terverifikasi di aplikasi Bio Visa</small>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="tanggal_update">Tanggal Pembaruan Terakhir</label>
                <input type="date" id="tanggal_update" name="tanggal_update" value="{{ old('tanggal_update', $biometric->tanggal_update?->format('Y-m-d') ?? now()->format('Y-m-d')) }}">
            </div>

            <div class="form-group">
                <label>&nbsp;</label>
                <div class="form-check" style="margin-top:10px;">
                    <input type="checkbox" id="aktif" name="aktif" value="1" @checked(old('aktif', $biometric->aktif))>
                    <label for="aktif" style="margin:0;font-weight:600;">Aktifkan data biometrik ini</label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="keterangan">Keterangan / Informasi Teknis Biometrik</label>
            <textarea id="keterangan" name="keterangan" rows="3" placeholder="Contoh: Proses perekaman bio visa secara daring mandiri dan layanan asistensi di kantor Kemenhaj Purbalingga.">{{ old('keterangan', $biometric->keterangan) }}</textarea>
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-primary">Simpan Progres Biometrik</button>
            <a href="{{ route('admin.jemaah-2027.dashboard') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>

    <script>
        function calcBiometrics() {
            const target = parseInt(document.getElementById('target').value) || 0;
            const sudah = parseInt(document.getElementById('sudah_biometrik').value) || 0;
            const belum = Math.max(0, target - sudah);
            const persen = target > 0 ? ((sudah / target) * 100).toFixed(1) : '0';

            document.getElementById('previewTarget').textContent = target.toLocaleString('id-ID');
            document.getElementById('previewSudah').textContent = sudah.toLocaleString('id-ID');
            document.getElementById('previewBelum').textContent = belum.toLocaleString('id-ID');
            document.getElementById('previewPersentase').textContent = persen + '%';
            document.getElementById('previewBar').style.width = Math.min(100, persen) + '%';
        }
    </script>
@endsection
