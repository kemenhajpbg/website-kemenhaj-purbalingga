@extends('admin.layout')

@section('title', 'Kelola Pengumuman Haji 2027')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <div>
            <h2 style="margin:0;">Pengumuman Haji 2027</h2>
            <p style="margin:4px 0 0;color:var(--admin-muted);font-size:0.85rem;">
                Kelola surat edaran, pengumuman penting, dan pemberitahuan resmi calon jemaah haji 2027.
            </p>
        </div>
        <div style="display:flex;gap:8px;">
            <a href="{{ route('admin.jemaah-2027.dashboard') }}" class="btn btn-secondary btn-sm">← Dashboard</a>
            <a href="{{ route('admin.jemaah-2027.announcements.create') }}" class="btn btn-primary btn-sm">+ Tambah Pengumuman</a>
        </div>
    </div>

    <div class="admin-card" style="padding:0;overflow:hidden;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width:60px;">Urutan</th>
                        <th>Judul Pengumuman</th>
                        <th style="width:120px;">Tgl Publikasi</th>
                        <th style="width:100px;">Lampiran</th>
                        <th style="width:100px;">Status</th>
                        <th style="width:140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($announcements as $a)
                        <tr>
                            <td style="text-align:center;font-weight:600;">{{ $a->urutan }}</td>
                            <td>
                                <strong>{{ $a->judul }}</strong>
                                <div style="font-size:0.75rem;color:var(--admin-muted);">slug: {{ $a->slug }}</div>
                            </td>
                            <td style="font-size:0.82rem;">{{ $a->tanggal_publikasi?->format('d/m/Y') ?? '—' }}</td>
                            <td>
                                @if ($a->file_lampiran)
                                    <a href="{{ asset($a->file_lampiran) }}" target="_blank" style="color:var(--admin-primary);font-size:0.8rem;text-decoration:underline;">Unduh File</a>
                                @else
                                    <span style="color:var(--admin-muted);font-size:0.8rem;">—</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge-status {{ $a->status === 'Published' ? 'badge-success' : 'badge-neutral' }}">
                                    {{ $a->status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.jemaah-2027.announcements.edit', $a) }}" class="btn btn-secondary btn-sm">Ubah</a>
                                <form action="{{ route('admin.jemaah-2027.announcements.destroy', $a) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus pengumuman ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;color:var(--admin-muted);padding:24px;">Belum ada pengumuman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
