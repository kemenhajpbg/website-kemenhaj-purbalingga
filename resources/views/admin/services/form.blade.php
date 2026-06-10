@extends('admin.layout')

@section('title', $service->exists ? 'Ubah Layanan' : 'Tambah Layanan')

@section('content')
    <h2 style="margin-top:0;">{{ $service->exists ? 'Ubah Layanan' : 'Tambah Layanan' }}</h2>

    <form method="POST" action="{{ $service->exists ? route('admin.layanan.update', $service) : route('admin.layanan.store') }}" enctype="multipart/form-data" class="admin-card">
        @csrf
        @if ($service->exists)
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="title">Judul layanan</label>
            <input type="text" id="title" name="title" value="{{ old('title', $service->title) }}" required>
        </div>

        <div class="form-group">
            <label for="url">URL tujuan</label>
            <input type="url" id="url" name="url" value="{{ old('url', $service->url) }}" placeholder="https://...">
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="sort_order">Urutan</label>
                <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}" min="0" required>
            </div>
            <div class="form-group">
                <label>&nbsp;</label>
                <div class="form-check" style="margin-top:10px;">
                    <input type="checkbox" id="is_active" name="is_active" value="1" @checked(old('is_active', $service->is_active))>
                    <label for="is_active" style="margin:0;">Tampilkan di website</label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="icon_file">Icon {{ $service->exists ? '(kosongkan jika tidak diganti)' : '' }}</label>
            <input type="file" id="icon_file" name="icon_file" accept="image/*" {{ $service->exists ? '' : '' }}>
            @if ($service->icon)
                <img src="{{ asset($service->icon) }}" alt="" class="preview-img">
            @endif
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.layanan.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
