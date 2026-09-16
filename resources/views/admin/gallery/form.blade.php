@extends('admin.layout')

@section('title', $gallery->exists ? 'Ubah Foto Galeri' : 'Tambah Foto Galeri')

@section('content')
    <h2 style="margin-top:0;">{{ $gallery->exists ? 'Ubah Foto Galeri' : 'Tambah Foto Galeri' }}</h2>

    <form method="POST" action="{{ $gallery->exists ? route('admin.galeri.update', $gallery) : route('admin.galeri.store') }}" enctype="multipart/form-data" class="admin-card">
        @csrf
        @if ($gallery->exists)
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="title">Judul Kegiatan / Foto</label>
            <input type="text" id="title" name="title" value="{{ old('title', $gallery->title) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi (opsional)</label>
            <textarea id="description" name="description" rows="5">{{ old('description', $gallery->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="image_file">File Gambar {{ $gallery->exists ? '(kosongkan jika tidak diganti)' : '' }}</label>
            <input type="file" id="image_file" name="image_file" accept="image/*" {{ $gallery->exists ? '' : 'required' }}>
            @if ($gallery->image)
                <div style="margin-top:12px;">
                    <p style="margin-bottom:6px;font-size:0.85rem;color:#666;">Gambar saat ini:</p>
                    <img src="{{ asset($gallery->image) }}" alt="" class="preview-img" style="max-height:160px;border-radius:8px;border:1px solid #ccc;display:block;">
                </div>
            @endif
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
