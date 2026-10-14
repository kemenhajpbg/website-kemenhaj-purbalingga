@extends('admin.layout')

@section('title', 'Prioritas Layanan Jemaah 2027')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <div>
            <h2 style="margin:0;">Prioritas Layanan Jemaah Haji 2027</h2>
            <p style="margin:4px 0 0;color:var(--admin-muted);font-size:0.85rem;">
                Kelola informasi layanan jemaah lansia, disabilitas, pendampingan, fisik, dan manasik.
            </p>
        </div>
        <div style="display:flex;gap:8px;">
            <a href="{{ route('admin.jemaah-2027.dashboard') }}" class="btn btn-secondary btn-sm">← Dashboard</a>
            <a href="{{ route('admin.jemaah-2027.services.create') }}" class="btn btn-primary btn-sm">+ Tambah Layanan</a>
        </div>
    </div>

    <div class="admin-card" style="padding:0;overflow:hidden;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width:60px;">Urutan</th>
                        <th>Judul Layanan</th>
                        <th style="width:100px;">Icon</th>
                        <th>Deskripsi</th>
                        <th style="width:80px;">Status</th>
                        <th style="width:140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($services as $srv)
                        <tr>
                            <td style="text-align:center;font-weight:600;">{{ $srv->urutan }}</td>
                            <td><strong>{{ $srv->judul }}</strong></td>
                            <td><span style="font-family:monospace;font-size:0.8rem;background:#f1f5f9;padding:2px 6px;border-radius:4px;">{{ $srv->icon }}</span></td>
                            <td style="font-size:0.85rem;color:var(--admin-muted);max-width:320px;">{{ $srv->deskripsi }}</td>
                            <td>
                                @if ($srv->aktif)
                                    <span style="color:#2e7d32;font-size:0.8rem;font-weight:600;">Aktif</span>
                                @else
                                    <span style="color:#c62828;font-size:0.8rem;">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.jemaah-2027.services.edit', $srv) }}" class="btn btn-secondary btn-sm">Ubah</a>
                                <form action="{{ route('admin.jemaah-2027.services.destroy', $srv) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus layanan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;color:var(--admin-muted);padding:24px;">Belum ada data prioritas layanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
