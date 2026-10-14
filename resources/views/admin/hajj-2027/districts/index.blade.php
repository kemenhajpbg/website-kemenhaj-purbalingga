@extends('admin.layout')

@section('title', 'Sebaran Jemaah per Kecamatan 2027')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <div>
            <h2 style="margin:0;">Sebaran Calon Jemaah per Kecamatan</h2>
            <p style="margin:4px 0 0;color:var(--admin-muted);font-size:0.85rem;">
                Kelola kuota dan sebaran estimasi jemaah haji 2027 pada 18 kecamatan se-Kabupaten Purbalingga.
            </p>
        </div>
        <div style="display:flex;gap:8px;">
            <a href="{{ route('admin.jemaah-2027.dashboard') }}" class="btn btn-secondary btn-sm">← Dashboard</a>
            <a href="{{ route('admin.jemaah-2027.districts.create') }}" class="btn btn-primary btn-sm">+ Tambah Kecamatan</a>
        </div>
    </div>

    <div style="display:flex;align-items:center;justify-content:space-between;background:#e8f5e9;border:1px solid #c8e6c9;padding:12px 20px;border-radius:10px;margin-bottom:20px;">
        <div style="display:flex;align-items:center;gap:12px;">
            <span style="font-size:1.5rem;">🏘️</span>
            <div>
                <strong style="color:#2e7d32;font-size:0.95rem;">Total Keseluruhan Jemaah Kecamatan Aktif</strong>
                <div style="font-size:0.82rem;color:#475569;">Dihitung otomatis dari seluruh kecamatan aktif</div>
            </div>
        </div>
        <div style="font-size:1.8rem;font-weight:700;color:#2e7d32;">
            {{ number_format($totalPilgrims, 0, ',', '.') }} <span style="font-size:0.9rem;font-weight:500;">Jemaah</span>
        </div>
    </div>

    <div class="admin-card" style="padding:0;overflow:hidden;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width:60px;">Urutan</th>
                        <th>Nama Kecamatan</th>
                        <th style="width:180px;">Jumlah Jemaah</th>
                        <th style="width:120px;">Kontribusi (%)</th>
                        <th style="width:90px;">Status</th>
                        <th style="width:140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($districts as $d)
                        @php
                            $persen = $totalPilgrims > 0 ? round(($d->jumlah_jemaah / $totalPilgrims) * 100, 1) : 0;
                        @endphp
                        <tr>
                            <td style="text-align:center;font-weight:600;">{{ $d->urutan }}</td>
                            <td><strong>{{ $d->nama_kecamatan }}</strong></td>
                            <td style="font-size:1rem;font-weight:700;color:var(--admin-primary-dark);">
                                {{ number_format($d->jumlah_jemaah, 0, ',', '.') }} orang
                            </td>
                            <td>
                                <div style="display:flex;align-items:center;gap:6px;">
                                    <div class="admin-progress-track" style="flex-grow:1;height:6px;margin:0;">
                                        <div class="admin-progress-bar" style="width:{{ min(100, $persen * 3) }}%;"></div>
                                    </div>
                                    <span style="font-size:0.8rem;color:var(--admin-muted);min-width:34px;">{{ $persen }}%</span>
                                </div>
                            </td>
                            <td>
                                @if ($d->aktif)
                                    <span style="color:#2e7d32;font-size:0.8rem;font-weight:600;">Aktif</span>
                                @else
                                    <span style="color:#c62828;font-size:0.8rem;">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.jemaah-2027.districts.edit', $d) }}" class="btn btn-secondary btn-sm">Ubah</a>
                                <form action="{{ route('admin.jemaah-2027.districts.destroy', $d) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus kecamatan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;color:var(--admin-muted);padding:24px;">Belum ada data kecamatan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
