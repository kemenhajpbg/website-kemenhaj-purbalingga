@extends('admin.layout')

@section('title', 'Profil Kantor')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <h2 style="margin:0;">Profil Kantor</h2>
        <a href="{{ route('admin.profil.create') }}" class="btn btn-primary">+ Tambah Bagian</a>
    </div>

    <div class="admin-card" style="padding:0;overflow:hidden;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">Urutan</th>
                        <th>Judul Bagian</th>
                        <th>Video Profil</th>
                        <th>Gambar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sections as $item)
                        <tr>
                            <td>{{ $item->sort_order }}</td>
                            <td><strong>{{ $item->title }}</strong></td>
                            <td>
                                @if ($item->video_url)
                                    <span style="color:var(--teal); font-size: 0.85rem;">Ada (YouTube)</span>
                                @else
                                    <span style="color:#888; font-size: 0.85rem;">—</span>
                                @endif
                            </td>
                            <td>
                                @if ($item->image)
                                    <img src="{{ asset($item->image) }}" alt="" style="max-height: 40px; border-radius: var(--radius-sm); border: 1px solid #ddd;">
                                @else
                                    <span style="color:#888; font-size: 0.85rem;">—</span>
                                @endif
                            </td>
                            <td>{{ $item->is_active ? 'Aktif' : 'Non-aktif' }}</td>
                            <td>
                                <a href="{{ route('admin.profil.edit', $item) }}" class="btn btn-secondary btn-sm">Ubah</a>
                                <form action="{{ route('admin.profil.destroy', $item) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus bagian profil ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;color:#5c6b66;padding: 24px;">Belum ada bagian profil. Silakan tambah baru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
