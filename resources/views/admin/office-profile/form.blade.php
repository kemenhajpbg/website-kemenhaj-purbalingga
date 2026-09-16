@extends('admin.layout')

@section('title', $section->exists ? 'Ubah Bagian Profil' : 'Tambah Bagian Profil')

@section('content')
    <h2 style="margin-top:0;">{{ $section->exists ? 'Ubah Bagian Profil' : 'Tambah Bagian Profil' }}</h2>

    <form method="POST" action="{{ $section->exists ? route('admin.profil.update', $section) : route('admin.profil.store') }}" enctype="multipart/form-data" class="admin-card">
        @csrf
        @if ($section->exists)
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="title">Judul Bagian</label>
            <input type="text" id="title" name="title" value="{{ old('title', $section->title) }}" required placeholder="Contoh: Sejarah Singkat, Visi & Misi">
        </div>

        <div class="form-group">
            <label for="content">Isi Konten</label>
            <textarea id="content" name="content" rows="10" required placeholder="Tulis deskripsi atau isi bagian profil di sini...">{{ old('content', $section->content) }}</textarea>
        </div>

        <div class="form-group">
            <label for="video_url">Tautan Video YouTube (opsional)</label>
            <input type="url" id="video_url" name="video_url" value="{{ old('video_url', $section->video_url) }}" placeholder="Contoh: https://www.youtube.com/embed/ZOrcZzBUxQI">
            <small style="color: #666; display: block; margin-top: 4px;">Gunakan format tautan embed YouTube agar dapat diputar langsung di halaman profil.</small>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="sort_order">Urutan Tampilan</label>
                <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $section->sort_order ?? 0) }}" min="0" required>
            </div>
            <div class="form-group">
                <label>&nbsp;</label>
                <div class="form-check" style="margin-top:10px;">
                    <input type="checkbox" id="is_active" name="is_active" value="1" @checked(old('is_active', $section->exists ? $section->is_active : true))>
                    <label for="is_active" style="margin:0;">Aktifkan Bagian Ini</label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="image_file">Gambar Lampiran {{ $section->exists ? '(kosongkan jika tidak diganti)' : '' }}</label>
            <input type="file" id="image_file" name="image_file" accept="image/*">
            @if ($section->image)
                <div style="margin-top: 10px;">
                    <img src="{{ asset($section->image) }}" alt="" style="max-height: 120px; border-radius: var(--radius-sm); border: 1px solid #ddd;">
                </div>
            @endif
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.profil.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
