@extends('admin.layout')

@section('title', 'Mall Layanan')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <div>
            <h2 style="margin:0 0 4px;">Mall Layanan</h2>
            <p style="margin:0;font-size:0.85rem;color:var(--admin-muted);">Kelola tombol layanan yang tampil di Mall Layanan (Website Utama) berupa Halaman Khusus atau Tautan Luar.</p>
        </div>
        <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <a href="{{ route('admin.layanan.create', ['type' => 'page']) }}" class="btn btn-primary" style="display:inline-flex;align-items:center;gap:6px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                + Tambah Halaman Layanan
            </a>
            <a href="{{ route('admin.layanan.create', ['type' => 'link']) }}" class="btn btn-secondary">
                + Tambah Tautan Luar (Link)
            </a>
        </div>
    </div>

    <div class="admin-card" style="padding:0;overflow:hidden;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width:50px;">#</th>
                        <th style="width:70px;">Icon</th>
                        <th>Judul Layanan / Halaman</th>
                        <th style="width:130px;">Tipe</th>
                        <th>Tujuan / Data Halaman</th>
                        <th style="width:90px;">Status</th>
                        <th style="width:170px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($services as $service)
                        <tr>
                            <td>{{ $service->sort_order }}</td>
                            <td>
                                <img src="{{ asset($service->icon) }}" alt="{{ $service->title }}" style="width:36px;height:36px;object-fit:contain;background:#f5f8f7;padding:4px;border-radius:6px;">
                            </td>
                            <td>
                                <strong>{{ $service->title }}</strong>
                                @if($service->isPage() && $service->slug)
                                    <div style="font-size:0.75rem;color:#0d9a8c;margin-top:2px;">
                                        /layanan/{{ $service->slug }}
                                    </div>
                                @endif
                            </td>
                            <td>
                                @if($service->isPage())
                                    <span style="display:inline-block;padding:3px 8px;border-radius:999px;font-size:0.75rem;font-weight:600;background:#e6f7f5;color:#0a7a6f;">
                                        Halaman Khusus
                                    </span>
                                @else
                                    <span style="display:inline-block;padding:3px 8px;border-radius:999px;font-size:0.75rem;font-weight:600;background:#f1f5f9;color:#475569;">
                                        Tautan Luar
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($service->isPage())
                                    <div style="font-size:0.82rem;line-height:1.4;">
                                        <div><span style="color:#5c6b66;">Verifikasi:</span> <strong>{{ number_format($service->total_verified, 0, ',', '.') }}</strong> jemaah</div>
                                        @if($service->document_path)
                                            <div style="margin-top:3px;">
                                                <a href="{{ asset($service->document_path) }}" target="_blank" style="color:#b8860b;font-weight:600;font-size:0.78rem;text-decoration:none;display:inline-flex;align-items:center;gap:4px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                    </svg>
                                                    {{ $service->document_name ?: 'Dokumen PDF' }} ({{ $service->document_size ?? 'PDF' }})
                                                </a>
                                            </div>
                                        @else
                                            <span style="color:#94a3b8;font-size:0.75rem;">Tanpa dokumen</span>
                                        @endif
                                    </div>
                                @else
                                    <span style="max-width:220px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;display:inline-block;font-size:0.82rem;color:#5c6b66;">
                                        {{ $service->url ?: '—' }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($service->is_active)
                                    <span style="color:#10b981;font-weight:600;font-size:0.82rem;">Aktif</span>
                                @else
                                    <span style="color:#94a3b8;font-size:0.82rem;">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <div style="display:flex;gap:6px;align-items:center;">
                                    @if($service->isPage() && $service->slug)
                                        <a href="{{ route('layanan.show', $service->slug) }}" target="_blank" class="btn btn-sm" style="background:#eef7f6;color:#0a7a6f;border:1px solid #c2e5e1;padding:4px 8px;" title="Lihat Halaman Publik">
                                            Lihat
                                        </a>
                                    @elseif($service->url && $service->url !== '#')
                                        <a href="{{ $service->url }}" target="_blank" class="btn btn-sm" style="background:#f8fafc;color:#475569;border:1px solid #e2e8f0;padding:4px 8px;" title="Buka Link">
                                            Buka
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.layanan.edit', $service) }}" class="btn btn-secondary btn-sm" style="padding:4px 10px;">Ubah</a>
                                    <form action="{{ route('admin.layanan.destroy', $service) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus {{ $service->isPage() ? 'halaman' : 'layanan' }} ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" style="padding:4px 10px;">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center;padding:36px 16px;color:#5c6b66;">
                                Belum ada layanan atau halaman yang ditambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
