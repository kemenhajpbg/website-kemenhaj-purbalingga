@extends('admin.layout')

@section('title', $service->exists ? 'Ubah Prioritas Layanan' : 'Tambah Prioritas Layanan')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <h2 style="margin:0;">{{ $service->exists ? 'Ubah Prioritas Layanan' : 'Tambah Prioritas Layanan' }}</h2>
        <a href="{{ route('admin.jemaah-2027.services.index') }}" class="btn btn-secondary btn-sm">← Kembali ke Daftar</a>
    </div>

    <form method="POST" action="{{ $service->exists ? route('admin.jemaah-2027.services.update', $service) : route('admin.jemaah-2027.services.store') }}" class="admin-card">
        @csrf
        @if ($service->exists)
            @method('PUT')
        @endif

        <div class="form-row">
            <div class="form-group">
                <label for="judul">Judul Layanan *</label>
                <input type="text" id="judul" name="judul" value="{{ old('judul', $service->judul) }}" required placeholder="Contoh: Layanan Khusus Jemaah Lansia">
            </div>

            <div class="form-group">
                <label for="icon">Tipe Icon</label>
                <select id="icon" name="icon" class="form-group input" style="width:100%;padding:10px 12px;border:1px solid var(--admin-border);border-radius:8px;">
                    <option value="elderly" @selected(old('icon', $service->icon) === 'elderly')>Lansia (elderly)</option>
                    <option value="disability" @selected(old('icon', $service->icon) === 'disability')>Disabilitas (disability)</option>
                    <option value="companion" @selected(old('icon', $service->icon) === 'companion')>Pendampingan / Mahram (companion)</option>
                    <option value="health" @selected(old('icon', $service->icon) === 'health')>Kesehatan & Fisik (health)</option>
                    <option value="manasik" @selected(old('icon', $service->icon) === 'manasik')>Manasik Haji (manasik)</option>
                    <option value="support" @selected(old('icon', $service->icon) === 'support')>Bantuan & Konsultasi (support)</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi Layanan *</label>
            <textarea id="deskripsi" name="deskripsi" rows="4" required placeholder="Jelaskan fasilitas dan pelayanan yang disediakan bagi jemaah...">{{ old('deskripsi', $service->deskripsi) }}</textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="urutan">Nomor Urutan Tampilan *</label>
                <input type="number" id="urutan" name="urutan" value="{{ old('urutan', $service->urutan) }}" required>
            </div>

            <div class="form-group">
                <label>&nbsp;</label>
                <div class="form-check" style="margin-top:10px;">
                    <input type="checkbox" id="aktif" name="aktif" value="1" @checked(old('aktif', $service->aktif))>
                    <label for="aktif" style="margin:0;font-weight:600;">Aktifkan layanan ini</label>
                </div>
            </div>
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-primary">Simpan Layanan</button>
            <a href="{{ route('admin.jemaah-2027.services.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
