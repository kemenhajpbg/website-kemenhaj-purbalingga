@extends('admin.layout')

@section('title', 'Mall Layanan')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <h2 style="margin:0;">Mall Layanan</h2>
        <a href="{{ route('admin.layanan.create') }}" class="btn btn-primary">+ Tambah Layanan</a>
    </div>

    <div class="admin-card" style="padding:0;overflow:hidden;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Icon</th>
                    <th>Judul</th>
                    <th>URL</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($services as $service)
                    <tr>
                        <td>{{ $service->sort_order }}</td>
                        <td><img src="{{ asset($service->icon) }}" alt=""></td>
                        <td>{{ $service->title }}</td>
                        <td style="max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                            {{ $service->url ?: '—' }}
                        </td>
                        <td>{{ $service->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                        <td>
                            <a href="{{ route('admin.layanan.edit', $service) }}" class="btn btn-secondary btn-sm">Ubah</a>
                            <form action="{{ route('admin.layanan.destroy', $service) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus layanan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center;color:#5c6b66;">Belum ada layanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
