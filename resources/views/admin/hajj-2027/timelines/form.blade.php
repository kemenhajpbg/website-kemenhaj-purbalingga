@extends('admin.layout')

@section('title', $timeline->exists ? 'Ubah Agenda Timeline' : 'Tambah Agenda Timeline')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <h2 style="margin:0;">{{ $timeline->exists ? 'Ubah Agenda Timeline' : 'Tambah Agenda Timeline' }}</h2>
        <a href="{{ route('admin.jemaah-2027.timelines.index') }}" class="btn btn-secondary btn-sm">← Kembali ke Daftar</a>
    </div>

    <form method="POST" action="{{ $timeline->exists ? route('admin.jemaah-2027.timelines.update', $timeline) : route('admin.jemaah-2027.timelines.store') }}" class="admin-card">
        @csrf
        @if ($timeline->exists)
            @method('PUT')
        @endif

        <div class="form-row">
            <div class="form-group">
                <label for="nama_tahap">Nama Tahap Agenda *</label>
                <input type="text" id="nama_tahap" name="nama_tahap" value="{{ old('nama_tahap', $timeline->nama_tahap) }}" required placeholder="Contoh: Bimbingan Manasik Haji / Rekam Bio Visa">
            </div>

            <div class="form-group">
                <label for="tanggal">Waktu / Jadwal Pelaksanaan *</label>
                <input type="text" id="tanggal" name="tanggal" value="{{ old('tanggal', $timeline->tanggal) }}" required placeholder="Contoh: Maret - April 2027 / 15 Mei 2027">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="status">Status Agenda *</label>
                <select id="status" name="status" class="form-group input" style="width:100%;padding:10px 12px;border:1px solid var(--admin-border);border-radius:8px;" required>
                    @foreach (\App\Models\Hajj2027Timeline::STATUS_OPTIONS as $opt)
                        <option value="{{ $opt }}" @selected(old('status', $timeline->status) === $opt)>{{ $opt }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="urutan">Nomor Urutan Tampilan *</label>
                <input type="number" id="urutan" name="urutan" value="{{ old('urutan', $timeline->urutan) }}" required>
            </div>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi Agenda Pelaksanaan</label>
            <textarea id="deskripsi" name="deskripsi" rows="3" placeholder="Contoh: Bimbingan manasik haji intensif di tingkat KUA kecamatan dan Alun-alun Purbalingga.">{{ old('deskripsi', $timeline->deskripsi) }}</textarea>
        </div>

        <div class="form-check">
            <input type="checkbox" id="aktif" name="aktif" value="1" @checked(old('aktif', $timeline->aktif))>
            <label for="aktif" style="margin:0;font-weight:600;">Tampilkan agenda ini di timeline publik</label>
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-primary">Simpan Agenda Timeline</button>
            <a href="{{ route('admin.jemaah-2027.timelines.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
