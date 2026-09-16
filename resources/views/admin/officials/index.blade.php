@extends('admin.layout')

@section('title', 'Struktur Organisasi')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <h2 style="margin:0;">Struktur Organisasi (Pejabat)</h2>
        <a href="{{ route('admin.pejabat.create') }}" class="btn btn-primary">+ Tambah Pejabat</a>
    </div>

    <div class="admin-card" style="padding:0;overflow:hidden;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">Urutan</th>
                        <th>Foto</th>
                        <th>Nama Pejabat</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($officials as $item)
                        <tr>
                            <td>{{ $item->sort_order }}</td>
                            <td>
                                @if ($item->image)
                                    <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%; border: 1px solid #ddd;">
                                @else
                                    <div style="width: 50px; height: 50px; border-radius: 50%; background: #eaeaea; display: flex; align-items: center; justify-content: center; color: #888;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 24px; height: 24px;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td><strong>{{ $item->name }}</strong></td>
                            <td>{{ $item->position }}</td>
                            <td>{{ $item->is_active ? 'Aktif' : 'Non-aktif' }}</td>
                            <td>
                                <a href="{{ route('admin.pejabat.edit', $item) }}" class="btn btn-secondary btn-sm">Ubah</a>
                                <form action="{{ route('admin.pejabat.destroy', $item) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus data pejabat ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;color:#5c6b66;padding: 24px;">Belum ada data pejabat. Silakan tambah baru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
