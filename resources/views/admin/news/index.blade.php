@extends('admin.layout')

@section('title', 'Kelola Berita')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <h2 style="margin:0;">Kelola Berita</h2>
        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">+ Tambah Berita</a>
    </div>

    <div class="admin-card" style="padding:0;overflow:hidden;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($newsList as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->published_at?->format('d/m/Y') ?? '—' }}</td>
                        <td>{{ $item->is_published ? 'Terbit' : 'Draft' }}</td>
                        <td>
                            @if ($item->is_published)
                                <a href="{{ route('berita.show', $item->slug) }}" class="btn btn-secondary btn-sm" target="_blank">Lihat</a>
                            @endif
                            <a href="{{ route('admin.berita.edit', $item) }}" class="btn btn-secondary btn-sm">Ubah</a>
                            <form action="{{ route('admin.berita.destroy', $item) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus berita ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center;color:#5c6b66;">Belum ada berita.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
