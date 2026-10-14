@extends('admin.layout')

@section('title', $stage->exists ? 'Ubah Tahapan Persiapan' : 'Tambah Tahapan Persiapan')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <h2 style="margin:0;">{{ $stage->exists ? 'Ubah Tahapan Persiapan' : 'Tambah Tahapan Persiapan' }}</h2>
        <a href="{{ route('admin.jemaah-2027.stages.index') }}" class="btn btn-secondary btn-sm">← Kembali ke Daftar</a>
    </div>

    <form method="POST" action="{{ $stage->exists ? route('admin.jemaah-2027.stages.update', $stage) : route('admin.jemaah-2027.stages.store') }}" class="admin-card">
        @csrf
        @if ($stage->exists)
            @method('PUT')
        @endif

        <div class="form-row">
            <div class="form-group">
                <label for="nama_tahapan">Nama Tahapan *</label>
                <input type="text" id="nama_tahapan" name="nama_tahapan" value="{{ old('nama_tahapan', $stage->nama_tahapan) }}" required placeholder="Contoh: Biometrik / Paspor / Manasik">
            </div>

            <div class="form-group">
                <label for="persentase">Persentase (0–100%) *</label>
                <input type="number" id="persentase" name="persentase" value="{{ old('persentase', $stage->persentase) }}" min="0" max="100" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="status">Status Tahapan *</label>
                <select id="status" name="status" class="form-group input" style="width:100%;padding:10px 12px;border:1px solid var(--admin-border);border-radius:8px;" required>
                    @foreach (\App\Models\Hajj2027Stage::STATUS_OPTIONS as $opt)
                        <option value="{{ $opt }}" @selected(old('status', $stage->status) === $opt)>{{ $opt }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tanggal_update">Tanggal Update Status</label>
                <input type="date" id="tanggal_update" name="tanggal_update" value="{{ old('tanggal_update', $stage->tanggal_update?->format('Y-m-d') ?? now()->format('Y-m-d')) }}">
            </div>
        </div>

        <div class="form-group">
            <label for="keterangan">Keterangan / Catatan Singkat</label>
            <textarea id="keterangan" name="keterangan" rows="3" placeholder="Contoh: Perekaman Bio Visa mandiri dan terpadu di kantor Kemenhaj Purbalingga.">{{ old('keterangan', $stage->keterangan) }}</textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="urutan">Nomor Urut Tampilan *</label>
                <input type="number" id="urutan" name="urutan" value="{{ old('urutan', $stage->urutan) }}" required>
            </div>

            <div class="form-group">
                <label>&nbsp;</label>
                <div class="form-check" style="margin-top:10px;">
                    <input type="checkbox" id="aktif" name="aktif" value="1" @checked(old('aktif', $stage->aktif))>
                    <label for="aktif" style="margin:0;font-weight:600;">Aktifkan tahapan ini</label>
                </div>
            </div>
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-primary">Simpan Tahapan</button>
            <a href="{{ route('admin.jemaah-2027.stages.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
