@extends('admin.layout')

@section('title', $official->exists ? 'Ubah Data Pejabat' : 'Tambah Pejabat')

@section('content')
    <h2 style="margin-top:0;">{{ $official->exists ? 'Ubah Data Pejabat' : 'Tambah Pejabat' }}</h2>

    <form method="POST" action="{{ $official->exists ? route('admin.pejabat.update', $official) : route('admin.pejabat.store') }}" enctype="multipart/form-data" class="admin-card">
        @csrf
        @if ($official->exists)
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="name">Nama Pejabat</label>
            <input type="text" id="name" name="name" value="{{ old('name', $official->name) }}" required placeholder="Contoh: H. Muhammad, S.Ag.">
        </div>

        <div class="form-group">
            <label for="position">Jabatan</label>
            <input type="text" id="position" name="position" value="{{ old('position', $official->position) }}" required placeholder="Contoh: Kepala Kantor Kemenag Purbalingga">
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="sort_order">Urutan Tampilan</label>
                <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $official->sort_order ?? 0) }}" min="0" required>
            </div>
            <div class="form-group">
                <label>&nbsp;</label>
                <div class="form-check" style="margin-top:10px;">
                    <input type="checkbox" id="is_active" name="is_active" value="1" @checked(old('is_active', $official->exists ? $official->is_active : true))>
                    <label for="is_active" style="margin:0;">Aktifkan Pejabat Ini</label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="image_file">Foto Pejabat {{ $official->exists ? '(kosongkan jika tidak diganti)' : '' }}</label>
            <input type="file" id="image_file" name="image_file" accept="image/*">
            @if ($official->image)
                <div style="margin-top: 10px;">
                    <img src="{{ asset($official->image) }}" alt="{{ $official->name }}" style="max-height: 120px; border-radius: var(--radius-sm); border: 1px solid #ddd;">
                </div>
            @endif
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.pejabat.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
