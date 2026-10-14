@extends('admin.layout')

@section('title', $document->exists ? 'Ubah Dokumen Panduan' : 'Upload Dokumen Baru')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <h2 style="margin:0;">{{ $document->exists ? 'Ubah Dokumen Panduan' : 'Upload Dokumen Baru' }}</h2>
        <a href="{{ route('admin.jemaah-2027.documents.index') }}" class="btn btn-secondary btn-sm">← Kembali ke Daftar</a>
    </div>

    <form method="POST" action="{{ $document->exists ? route('admin.jemaah-2027.documents.update', $document) : route('admin.jemaah-2027.documents.store') }}" enctype="multipart/form-data" class="admin-card">
        @csrf
        @if ($document->exists)
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="judul">Judul Dokumen *</label>
            <input type="text" id="judul" name="judul" value="{{ old('judul', $document->judul) }}" required placeholder="Contoh: Buku Saku Panduan Persiapan Haji 1448 H / 2027 M">
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="kategori">Kategori Dokumen *</label>
                <select id="kategori" name="kategori" class="form-group input" style="width:100%;padding:10px 12px;border:1px solid var(--admin-border);border-radius:8px;" required>
                    @foreach (\App\Models\Hajj2027Document::CATEGORY_OPTIONS as $cat)
                        <option value="{{ $cat }}" @selected(old('kategori', $document->kategori) === $cat)>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tanggal">Tanggal Terbit / Dokumen</label>
                <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', $document->tanggal?->format('Y-m-d') ?? now()->format('Y-m-d')) }}">
            </div>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi Singkat / Isi Dokumen</label>
            <textarea id="deskripsi" name="deskripsi" rows="3" placeholder="Contoh: Petunjuk teknis perekaman biometrik Bio Visa mandiri untuk calon jemaah.">{{ old('deskripsi', $document->deskripsi) }}</textarea>
        </div>

        <div class="form-group">
            <label for="document_file">
                File Dokumen {{ $document->exists ? '(kosongkan jika tidak mengganti file)' : '*' }}
            </label>
            <input type="file" id="document_file" name="document_file" accept=".pdf,.doc,.docx,.xls,.xlsx,.zip,.ppt,.pptx" {{ $document->exists ? '' : 'required' }}>
            <small style="color:var(--admin-muted);font-size:0.8rem;display:block;margin-top:4px;">
                Format didukung: PDF, DOCX, XLSX, ZIP. Maksimal ukuran file: 15 MB.
            </small>
            @if ($document->file)
                <div style="margin-top:8px;font-size:0.85rem;background:#f8fafc;padding:8px 12px;border-radius:6px;border:1px solid #e2e8f0;">
                    File tersimpan: <strong>{{ $document->file_name ?: basename($document->file) }}</strong> ({{ $document->file_size }}) — 
                    <a href="{{ asset($document->file) }}" target="_blank" style="color:var(--admin-primary);text-decoration:underline;">Unduh file saat ini</a>
                </div>
            @endif
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="status">Status Dokumen *</label>
                <select id="status" name="status" class="form-group input" style="width:100%;padding:10px 12px;border:1px solid var(--admin-border);border-radius:8px;" required>
                    <option value="Aktif" @selected(old('status', $document->status) === 'Aktif')>Aktif (Dapat diunduh publik)</option>
                    <option value="Nonaktif" @selected(old('status', $document->status) === 'Nonaktif')>Nonaktif (Disembunyikan)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="urutan">Nomor Urutan Tampilan *</label>
                <input type="number" id="urutan" name="urutan" value="{{ old('urutan', $document->urutan) }}" required>
            </div>
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-primary">Simpan Dokumen</button>
            <a href="{{ route('admin.jemaah-2027.documents.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
