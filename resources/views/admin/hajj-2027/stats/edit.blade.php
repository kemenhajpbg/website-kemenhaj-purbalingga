@extends('admin.layout')

@section('title', 'Kelola Statistik Jemaah Haji 2027')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <div>
            <h2 style="margin:0;">Statistik Utama Jemaah 2027</h2>
            <p style="margin:4px 0 0;color:var(--admin-muted);font-size:0.85rem;">
                Kelola data statistik agregat calon jemaah haji Kabupaten Purbalingga Tahun 1448 H / 2027 M.
            </p>
        </div>
        <a href="{{ route('admin.jemaah-2027.dashboard') }}" class="btn btn-secondary btn-sm">← Kembali ke Dashboard</a>
    </div>

    <form method="POST" action="{{ route('admin.jemaah-2027.stats.update') }}" class="admin-card">
        @csrf
        @method('PUT')

        <div style="background:#f8fafc;border-left:4px solid var(--admin-primary);padding:12px 16px;border-radius:4px;margin-bottom:20px;font-size:0.85rem;color:#334155;">
            <strong>Catatan Petugas:</strong> Jika angka belum ditetapkan secara resmi oleh Kementerian Agama / Pemerintah, Anda dapat mengosongkan kolom atau mengisi nilai 0. Sistem akan otomatis menampilkan <em>"Menunggu Penetapan"</em> di halaman publik (tidak menampilkan angka fiktif).
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="total_jemaah">Total Calon Jemaah (Orang)</label>
                <input type="number" id="total_jemaah" name="total_jemaah" value="{{ old('total_jemaah', $stat->total_jemaah) }}" min="0" placeholder="Kosongkan jika menunggu penetapan">
                <small style="color:var(--admin-muted);font-size:0.8rem;">Contoh: 375</small>
            </div>

            <div class="form-group">
                <label for="total_kecamatan">Jumlah Kecamatan (Kecamatan)</label>
                <input type="number" id="total_kecamatan" name="total_kecamatan" value="{{ old('total_kecamatan', $stat->total_kecamatan ?? 18) }}" min="0">
                <small style="color:var(--admin-muted);font-size:0.8rem;">Kabupaten Purbalingga memiliki 18 kecamatan</small>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="jemaah_pria">Jumlah Jemaah Laki-laki (Orang)</label>
                <input type="number" id="jemaah_pria" name="jemaah_pria" value="{{ old('jemaah_pria', $stat->jemaah_pria) }}" min="0" placeholder="Kosongkan jika belum ditetapkan">
            </div>

            <div class="form-group">
                <label for="jemaah_wanita">Jumlah Jemaah Perempuan (Orang)</label>
                <input type="number" id="jemaah_wanita" name="jemaah_wanita" value="{{ old('jemaah_wanita', $stat->jemaah_wanita) }}" min="0" placeholder="Kosongkan jika belum ditetapkan">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="jemaah_lansia">Jumlah Jemaah Lansia (Orang)</label>
                <input type="number" id="jemaah_lansia" name="jemaah_lansia" value="{{ old('jemaah_lansia', $stat->jemaah_lansia) }}" min="0" placeholder="Kosongkan jika belum ditetapkan">
                <small style="color:var(--admin-muted);font-size:0.8rem;">Jemaah lansia (usia 65 tahun ke atas) prioritas layanan</small>
            </div>

            <div class="form-group">
                <label for="total_kloter">Jumlah Kloter (Kelompok Terbang)</label>
                <input type="number" id="total_kloter" name="total_kloter" value="{{ old('total_kloter', $stat->total_kloter) }}" min="0" placeholder="Kosongkan jika belum ditetapkan">
                <small style="color:var(--admin-muted);font-size:0.8rem;">Jika belum ada penetapan resmi kloter, kosongkan agar muncul "Menunggu Penetapan"</small>
            </div>
        </div>

        <div class="form-group">
            <label for="keterangan">Keterangan Tambahan / Catatan Resmi (Opsional)</label>
            <textarea id="keterangan" name="keterangan" rows="3" placeholder="Contoh: Estimasi alokasi kuota sementara berdasarkan nomor urut porsi provinsi Jawa Tengah.">{{ old('keterangan', $stat->keterangan) }}</textarea>
        </div>

        <div class="form-check">
            <input type="checkbox" id="is_published" name="is_published" value="1" @checked(old('is_published', $stat->is_published))>
            <label for="is_published" style="margin:0;font-weight:600;">Tampilkan statistik pada halaman publik</label>
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-primary">Simpan Perubahan Statistik</button>
            <a href="{{ route('admin.jemaah-2027.dashboard') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
