@extends('admin.layout')

@section('title', $article->exists ? 'Ubah Berita' : 'Tambah Berita')

@section('content')
    <h2 style="margin-top:0;">{{ $article->exists ? 'Ubah Berita' : 'Tambah Berita' }}</h2>

    <form method="POST" action="{{ $article->exists ? route('admin.berita.update', $article) : route('admin.berita.store') }}" enctype="multipart/form-data" class="admin-card">
        @csrf
        @if ($article->exists)
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" id="title" name="title" value="{{ old('title', $article->title) }}" required>
        </div>

        <div class="form-group">
            <label for="excerpt">Ringkasan (opsional)</label>
            <textarea id="excerpt" name="excerpt" rows="2" maxlength="500">{{ old('excerpt', $article->excerpt) }}</textarea>
        </div>

        <div class="form-group">
            <label for="content">Isi berita</label>
            <textarea id="content" name="content" rows="10" required>{{ old('content', $article->content) }}</textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="published_at">Tanggal terbit</label>
                <input type="datetime-local" id="published_at" name="published_at"
                    value="{{ old('published_at', $article->published_at?->format('Y-m-d\TH:i') ?? now()->format('Y-m-d\TH:i')) }}">
            </div>
            <div class="form-group">
                <label>&nbsp;</label>
                <div class="form-check" style="margin-top:10px;">
                    <input type="checkbox" id="is_published" name="is_published" value="1" @checked(old('is_published', $article->exists ? $article->is_published : true))>
                    <label for="is_published" style="margin:0;">Publikasikan</label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="image_file">Gambar sampul {{ $article->exists ? '(kosongkan jika tidak diganti)' : '' }}</label>
            <input type="file" id="image_file" name="image_file" accept="image/*">
            @if ($article->image)
                <img src="{{ asset($article->image) }}" alt="" class="preview-img" style="max-height:120px;margin-top:8px;">
            @endif
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
