@extends('admin.layout')

@section('title', $district->exists ? 'Ubah Data Kecamatan' : 'Tambah Kecamatan')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <h2 style="margin:0;">{{ $district->exists ? 'Ubah Data Kecamatan' : 'Tambah Kecamatan' }}</h2>
        <a href="{{ route('admin.jemaah-2027.districts.index') }}" class="btn btn-secondary btn-sm">← Kembali ke Daftar</a>
    </div>

    <form method="POST" action="{{ $district->exists ? route('admin.jemaah-2027.districts.update', $district) : route('admin.jemaah-2027.districts.store') }}" class="admin-card">
        @csrf
        @if ($district->exists)
            @method('PUT')
        @endif

        <div class="form-row">
            <div class="form-group">
                <label for="nama_kecamatan">Nama Kecamatan *</label>
                <input type="text" id="nama_kecamatan" name="nama_kecamatan" value="{{ old('nama_kecamatan', $district->nama_kecamatan) }}" required placeholder="Contoh: Purbalingga / Kalimanah / Bobotsari">
            </div>

            <div class="form-group">
                <label for="jumlah_jemaah">Jumlah Calon Jemaah (Orang) *</label>
                <input type="number" id="jumlah_jemaah" name="jumlah_jemaah" value="{{ old('jumlah_jemaah', $district->jumlah_jemaah) }}" min="0" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="urutan">Nomor Urut Tampilan *</label>
                <input type="number" id="urutan" name="urutan" value="{{ old('urutan', $district->urutan) }}" required>
            </div>

            <div class="form-group">
                <label>&nbsp;</label>
                <div class="form-check" style="margin-top:10px;">
                    <input type="checkbox" id="aktif" name="aktif" value="1" @checked(old('aktif', $district->aktif))>
                    <label for="aktif" style="margin:0;font-weight:600;">Aktifkan kecamatan ini</label>
                </div>
            </div>
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-primary">Simpan Kecamatan</button>
            <a href="{{ route('admin.jemaah-2027.districts.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
