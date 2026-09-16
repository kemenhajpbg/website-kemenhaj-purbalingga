@extends('admin.layout')

@section('title', 'Kelola Galeri')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <h2 style="margin:0;">Kelola Galeri</h2>
        <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary">+ Tambah Foto</a>
    </div>

    <div class="admin-card" style="padding:0;overflow:hidden;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width:100px;">Gambar</th>
                        <th>Judul Kegiatan</th>
                        <th>Deskripsi</th>
                        <th>Tanggal Unggah</th>
                        <th style="width:160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($galleries as $item)
                        <tr>
                            <td>
                                @if ($item->image)
                                    <img src="{{ asset($item->image) }}" alt="" style="width:80px;height:60px;object-fit:cover;border-radius:6px;border:1px solid #ccc;display:block;">
                                @else
                                    <div style="width:80px;height:60px;background:#eee;border-radius:6px;display:flex;align-items:center;justify-content:center;color:#999;font-size:10px;">No Image</div>
                                @endif
                            </td>
                            <td style="font-weight:600;">{{ $item->title }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($item->description, 100) ?: '—' }}</td>
                            <td>{{ $item->created_at?->format('d/m/Y H:i') ?? '—' }}</td>
                            <td>
                                <a href="{{ route('admin.galeri.edit', $item) }}" class="btn btn-secondary btn-sm">Ubah</a>
                                <form action="{{ route('admin.galeri.destroy', $item) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus foto galeri ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center;color:#5c6b66;padding:24px;">Belum ada foto galeri.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
