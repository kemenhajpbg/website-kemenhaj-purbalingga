@extends('admin.layout')

@section('title', 'Rekapitulasi Verifikasi Calon Jemaah 2027')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <div>
            <h2 style="margin:0;">Rekapitulasi Verifikasi Calon Jemaah</h2>
            <p style="margin:4px 0 0;color:var(--admin-muted);font-size:0.85rem;">
                Kelola rekapitulasi data verifikasi jemaah (Tahap I, Tahap II, Tahap III, dst.).
            </p>
        </div>
        <div style="display:flex;gap:8px;">
            <a href="{{ route('admin.jemaah-2027.dashboard') }}" class="btn btn-secondary btn-sm">← Dashboard</a>
            <a href="{{ route('admin.jemaah-2027.verifications.create') }}" class="btn btn-primary btn-sm">+ Tambah Tahap Verifikasi</a>
        </div>
    </div>

    <div class="admin-card" style="padding:0;overflow:hidden;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Tahap</th>
                        <th>Total</th>
                        <th style="color:#2e7d32;">Siap</th>
                        <th style="color:#b78103;">Ditunda</th>
                        <th style="color:#c62828;">Wafat</th>
                        <th>Sudah Berhaji/BLM</th>
                        <th>Tgl Update</th>
                        <th>Status</th>
                        <th style="width:140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($verifications as $v)
                        <tr>
                            <td><strong>{{ $v->nama_tahap }}</strong></td>
                            <td style="font-weight:700;">{{ number_format($v->total, 0, ',', '.') }}</td>
                            <td style="color:#2e7d32;font-weight:600;">{{ number_format($v->siap, 0, ',', '.') }}</td>
                            <td style="color:#b78103;font-weight:600;">{{ number_format($v->ditunda, 0, ',', '.') }}</td>
                            <td style="color:#c62828;font-weight:600;">{{ number_format($v->meninggal, 0, ',', '.') }}</td>
                            <td>{{ number_format($v->sudah_berhaji_belum_memenuhi, 0, ',', '.') }}</td>
                            <td style="font-size:0.82rem;">{{ $v->tanggal_update?->format('d/m/Y') ?? '—' }}</td>
                            <td>
                                @if ($v->aktif)
                                    <span style="color:#2e7d32;font-size:0.8rem;font-weight:600;">Aktif</span>
                                @else
                                    <span style="color:#c62828;font-size:0.8rem;">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.jemaah-2027.verifications.edit', $v) }}" class="btn btn-secondary btn-sm">Ubah</a>
                                <form action="{{ route('admin.jemaah-2027.verifications.destroy', $v) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus data verifikasi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="text-align:center;color:var(--admin-muted);padding:24px;">Belum ada tahap verifikasi yang ditambahkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
