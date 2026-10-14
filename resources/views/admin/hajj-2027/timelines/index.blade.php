@extends('admin.layout')

@section('title', 'Kelola Timeline Persiapan Haji 2027')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <div>
            <h2 style="margin:0;">Timeline Persiapan Jemaah Haji 2027</h2>
            <p style="margin:4px 0 0;color:var(--admin-muted);font-size:0.85rem;">
                Kelola jadwal dan tahapan waktu persiapan jemaah dari awal hingga keberangkatan ke Tanah Suci.
            </p>
        </div>
        <div style="display:flex;gap:8px;">
            <a href="{{ route('admin.jemaah-2027.dashboard') }}" class="btn btn-secondary btn-sm">← Dashboard</a>
            <a href="{{ route('admin.jemaah-2027.timelines.create') }}" class="btn btn-primary btn-sm">+ Tambah Agenda Timeline</a>
        </div>
    </div>

    <div class="admin-card" style="padding:0;overflow:hidden;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width:60px;">Urutan</th>
                        <th>Tahapan Agenda</th>
                        <th style="width:180px;">Waktu / Tanggal</th>
                        <th style="width:130px;">Status</th>
                        <th>Deskripsi</th>
                        <th style="width:80px;">Aktif</th>
                        <th style="width:140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($timelines as $t)
                        <tr>
                            <td style="text-align:center;font-weight:600;">{{ $t->urutan }}</td>
                            <td><strong>{{ $t->nama_tahap }}</strong></td>
                            <td style="font-weight:500;color:var(--admin-primary-dark);">{{ $t->tanggal }}</td>
                            <td>
                                <span class="badge-status {{ $t->status === 'Selesai' ? 'badge-success' : ($t->status === 'Berlangsung' ? 'badge-warning' : 'badge-neutral') }}">
                                    {{ $t->status }}
                                </span>
                            </td>
                            <td style="font-size:0.85rem;color:var(--admin-muted);max-width:300px;">{{ $t->deskripsi ?? '—' }}</td>
                            <td>
                                @if ($t->aktif)
                                    <span style="color:#2e7d32;font-size:0.8rem;font-weight:600;">Aktif</span>
                                @else
                                    <span style="color:#c62828;font-size:0.8rem;">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.jemaah-2027.timelines.edit', $t) }}" class="btn btn-secondary btn-sm">Ubah</a>
                                <form action="{{ route('admin.jemaah-2027.timelines.destroy', $t) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus agenda ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center;color:var(--admin-muted);padding:24px;">Belum ada agenda timeline.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
