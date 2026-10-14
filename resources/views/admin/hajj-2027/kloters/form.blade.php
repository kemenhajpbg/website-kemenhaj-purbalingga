@extends('admin.layout')

@section('title', $kloter->exists ? 'Ubah Data Kloter' : 'Tambah Kloter')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <h2 style="margin:0;">{{ $kloter->exists ? 'Ubah Data Kloter' : 'Tambah Kloter' }}</h2>
        <a href="{{ route('admin.jemaah-2027.kloters.index') }}" class="btn btn-secondary btn-sm">← Kembali ke Daftar</a>
    </div>

    <form method="POST" action="{{ $kloter->exists ? route('admin.jemaah-2027.kloters.update', $kloter) : route('admin.jemaah-2027.kloters.store') }}" class="admin-card">
        @csrf
        @if ($kloter->exists)
            @method('PUT')
        @endif

        <div class="form-row">
            <div class="form-group">
                <label for="nomor_kloter">Nomor / Nama Kloter *</label>
                <input type="text" id="nomor_kloter" name="nomor_kloter" value="{{ old('nomor_kloter', $kloter->nomor_kloter) }}" required placeholder="Contoh: SOC-42 / Kloter 18">
            </div>

            <div class="form-group">
                <label for="jumlah_jemaah">Jumlah Jemaah Purbalingga di Kloter Ini *</label>
                <input type="number" id="jumlah_jemaah" name="jumlah_jemaah" value="{{ old('jumlah_jemaah', $kloter->jumlah_jemaah) }}" min="0" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="embarkasi">Embarkasi</label>
                <input type="text" id="embarkasi" name="embarkasi" value="{{ old('embarkasi', $kloter->embarkasi ?? 'SOC (Solo)') }}" placeholder="SOC (Solo)">
            </div>

            <div class="form-group">
                <label for="status">Status Kloter *</label>
                <select id="status" name="status" class="form-group input" style="width:100%;padding:10px 12px;border:1px solid var(--admin-border);border-radius:8px;" required>
                    @foreach (\App\Models\Hajj2027Kloter::STATUS_OPTIONS as $opt)
                        <option value="{{ $opt }}" @selected(old('status', $kloter->status) === $opt)>{{ $opt }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="tanggal_masuk_asrama">Tanggal & Waktu Masuk Asrama Haji</label>
                <input type="datetime-local" id="tanggal_masuk_asrama" name="tanggal_masuk_asrama" value="{{ old('tanggal_masuk_asrama', $kloter->tanggal_masuk_asrama?->format('Y-m-d\TH:i')) }}">
            </div>

            <div class="form-group">
                <label for="tanggal_keberangkatan">Tanggal & Waktu Keberangkatan Terbang</label>
                <input type="datetime-local" id="tanggal_keberangkatan" name="tanggal_keberangkatan" value="{{ old('tanggal_keberangkatan', $kloter->tanggal_keberangkatan?->format('Y-m-d\TH:i')) }}">
            </div>
        </div>

        <div class="form-group">
            <label for="keterangan">Keterangan / Rincian Petugas Kloter</label>
            <textarea id="keterangan" name="keterangan" rows="3" placeholder="Contoh: Kloter gabungan Purbalingga dan Banjarnegara, didampingi 1 TPHI dan 1 TKHI.">{{ old('keterangan', $kloter->keterangan) }}</textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="urutan">Nomor Urutan Tampilan *</label>
                <input type="number" id="urutan" name="urutan" value="{{ old('urutan', $kloter->urutan) }}" required>
            </div>

            <div class="form-group">
                <label>&nbsp;</label>
                <div class="form-check" style="margin-top:10px;">
                    <input type="checkbox" id="aktif" name="aktif" value="1" @checked(old('aktif', $kloter->aktif))>
                    <label for="aktif" style="margin:0;font-weight:600;">Aktifkan informasi kloter ini</label>
                </div>
            </div>
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-primary">Simpan Kloter</button>
            <a href="{{ route('admin.jemaah-2027.kloters.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
