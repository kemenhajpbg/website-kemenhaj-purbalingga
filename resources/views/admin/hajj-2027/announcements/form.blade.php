@extends('admin.layout')

@section('title', $announcement->exists ? 'Ubah Pengumuman' : 'Tambah Pengumuman')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <h2 style="margin:0;">{{ $announcement->exists ? 'Ubah Pengumuman' : 'Tambah Pengumuman' }}</h2>
        <a href="{{ route('admin.jemaah-2027.announcements.index') }}" class="btn btn-secondary btn-sm">← Kembali ke Daftar</a>
    </div>

    <form method="POST" action="{{ $announcement->exists ? route('admin.jemaah-2027.announcements.update', $announcement) : route('admin.jemaah-2027.announcements.store') }}" enctype="multipart/form-data" class="admin-card">
        @csrf
        @if ($announcement->exists)
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="judul">Judul Pengumuman *</label>
            <input type="text" id="judul" name="judul" value="{{ old('judul', $announcement->judul) }}" required placeholder="Contoh: Jadwal Perekaman Bio Visa Mandiri Calon Jemaah Haji 2027">
        </div>

        <div class="form-group">
            <label for="isi">Isi Lengkap Pengumuman *</label>
            <textarea id="isi" name="isi" rows="8" required placeholder="Tuliskan isi pengumuman resmi di sini...">{{ old('isi', $announcement->isi) }}</textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="tanggal_publikasi">Tanggal Publikasi</label>
                <input type="date" id="tanggal_publikasi" name="tanggal_publikasi" value="{{ old('tanggal_publikasi', $announcement->tanggal_publikasi?->format('Y-m-d') ?? now()->format('Y-m-d')) }}">
            </div>

            <div class="form-group">
                <label for="status">Status Publikasi *</label>
                <select id="status" name="status" class="form-group input" style="width:100%;padding:10px 12px;border:1px solid var(--admin-border);border-radius:8px;" required>
                    <option value="Published" @selected(old('status', $announcement->status) === 'Published')>Published (Terbit)</option>
                    <option value="Draft" @selected(old('status', $announcement->status) === 'Draft')>Draft (Draf)</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="thumbnail_file">Gambar Sampul / Thumbnail (Opsional)</label>
                <input type="file" id="thumbnail_file" name="thumbnail_file" accept="image/*">
                @if ($announcement->thumbnail)
                    <div style="margin-top:8px;">
                        <img src="{{ asset($announcement->thumbnail) }}" alt="Thumbnail" style="max-height:80px;border-radius:6px;border:1px solid #ddd;">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="attachment_file">Berkas Lampiran PDF / Dokumen (Opsional)</label>
                <input type="file" id="attachment_file" name="attachment_file" accept=".pdf,.doc,.docx,.xls,.xlsx,.zip">
                @if ($announcement->file_lampiran)
                    <div style="margin-top:8px;font-size:0.85rem;">
                        Lampiran saat ini: <a href="{{ asset($announcement->file_lampiran) }}" target="_blank" style="color:var(--admin-primary);text-decoration:underline;">Lihat Berkas</a>
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="urutan">Nomor Urutan Tampilan *</label>
            <input type="number" id="urutan" name="urutan" value="{{ old('urutan', $announcement->urutan) }}" required>
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-primary">Simpan Pengumuman</button>
            <a href="{{ route('admin.jemaah-2027.announcements.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
