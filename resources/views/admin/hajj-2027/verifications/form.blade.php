@extends('admin.layout')

@section('title', $verification->exists ? 'Ubah Data Verifikasi' : 'Tambah Tahap Verifikasi')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <h2 style="margin:0;">{{ $verification->exists ? 'Ubah Data Verifikasi' : 'Tambah Tahap Verifikasi' }}</h2>
        <a href="{{ route('admin.jemaah-2027.verifications.index') }}" class="btn btn-secondary btn-sm">← Kembali ke Daftar</a>
    </div>

    <form method="POST" action="{{ $verification->exists ? route('admin.jemaah-2027.verifications.update', $verification) : route('admin.jemaah-2027.verifications.store') }}" class="admin-card">
        @csrf
        @if ($verification->exists)
            @method('PUT')
        @endif

        <div class="form-row">
            <div class="form-group">
                <label for="nama_tahap">Nama Tahap Verifikasi *</label>
                <input type="text" id="nama_tahap" name="nama_tahap" value="{{ old('nama_tahap', $verification->nama_tahap) }}" required placeholder="Contoh: Tahap I / Tahap II / Tahap III">
            </div>

            <div class="form-group">
                <label for="total">Total Jemaah Diverifikasi *</label>
                <input type="number" id="total" name="total" value="{{ old('total', $verification->total) }}" min="0" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="siap" style="color:#2e7d32;">Jumlah Jemaah Siap *</label>
                <input type="number" id="siap" name="siap" value="{{ old('siap', $verification->siap) }}" min="0" required>
                <small style="color:var(--admin-muted);font-size:0.8rem;">Jemaah yang berkasnya lengkap dan siap lanjut tahapan</small>
            </div>

            <div class="form-group">
                <label for="ditunda" style="color:#b78103;">Jumlah Ditunda *</label>
                <input type="number" id="ditunda" name="ditunda" value="{{ old('ditunda', $verification->ditunda) }}" min="0" required>
                <small style="color:var(--admin-muted);font-size:0.8rem;">Jemaah yang mengajukan tunda keberangkatan</small>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="meninggal" style="color:#c62828;">Jumlah Meninggal Dunia *</label>
                <input type="number" id="meninggal" name="meninggal" value="{{ old('meninggal', $verification->meninggal) }}" min="0" required>
                <small style="color:var(--admin-muted);font-size:0.8rem;">Dapat diproses untuk pelimpahan porsi</small>
            </div>

            <div class="form-group">
                <label for="sudah_berhaji_belum_memenuhi">Sudah Berhaji / Belum Memenuhi Ketentuan *</label>
                <input type="number" id="sudah_berhaji_belum_memenuhi" name="sudah_berhaji_belum_memenuhi" value="{{ old('sudah_berhaji_belum_memenuhi', $verification->sudah_berhaji_belum_memenuhi) }}" min="0" required>
                <small style="color:var(--admin-muted);font-size:0.8rem;">Belum 10 tahun dari haji sebelumnya atau syarat belum lengkap</small>
            </div>
        </div>

        <div class="form-group">
            <label for="keterangan">Keterangan / Catatan Verifikasi</label>
            <textarea id="keterangan" name="keterangan" rows="3" placeholder="Contoh: Hasil verifikasi data awal calon jemaah estimasi keberangkatan 2027.">{{ old('keterangan', $verification->keterangan) }}</textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="tanggal_update">Tanggal Update Data</label>
                <input type="date" id="tanggal_update" name="tanggal_update" value="{{ old('tanggal_update', $verification->tanggal_update?->format('Y-m-d') ?? now()->format('Y-m-d')) }}">
            </div>

            <div class="form-group">
                <label for="urutan">Nomor Urutan Tampilan *</label>
                <input type="number" id="urutan" name="urutan" value="{{ old('urutan', $verification->urutan) }}" required>
            </div>
        </div>

        <div class="form-check">
            <input type="checkbox" id="aktif" name="aktif" value="1" @checked(old('aktif', $verification->aktif))>
            <label for="aktif" style="margin:0;font-weight:600;">Aktifkan data tahap verifikasi ini</label>
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-primary">Simpan Data Verifikasi</button>
            <a href="{{ route('admin.jemaah-2027.verifications.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
