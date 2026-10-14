@extends('admin.layout')

@section('title', 'Kelola Panduan & Dokumen Haji 2027')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <div>
            <h2 style="margin:0;">Panduan & Dokumen Jemaah Haji 2027</h2>
            <p style="margin:4px 0 0;color:var(--admin-muted);font-size:0.85rem;">
                Kelola file buku panduan, form persyaratan, checklist dokumen, dan regulasi unduhan publik.
            </p>
        </div>
        <div style="display:flex;gap:8px;">
            <a href="{{ route('admin.jemaah-2027.dashboard') }}" class="btn btn-secondary btn-sm">← Dashboard</a>
            <a href="{{ route('admin.jemaah-2027.documents.create') }}" class="btn btn-primary btn-sm">+ Upload Dokumen Baru</a>
        </div>
    </div>

    <div class="admin-card" style="padding:0;overflow:hidden;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width:60px;">Urutan</th>
                        <th>Judul Dokumen</th>
                        <th style="width:130px;">Kategori</th>
                        <th style="width:100px;">Ukuran File</th>
                        <th style="width:100px;">Diunduh</th>
                        <th style="width:80px;">Status</th>
                        <th style="width:160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($documents as $doc)
                        <tr>
                            <td style="text-align:center;font-weight:600;">{{ $doc->urutan }}</td>
                            <td>
                                <strong>{{ $doc->judul }}</strong>
                                <div style="font-size:0.75rem;color:var(--admin-muted);">
                                    {{ $doc->file_name ?: basename($doc->file) }}
                                </div>
                            </td>
                            <td>
                                <span class="badge-status badge-neutral">{{ $doc->kategori }}</span>
                            </td>
                            <td style="font-size:0.82rem;color:var(--admin-muted);">{{ $doc->file_size ?? '—' }}</td>
                            <td style="font-size:0.85rem;font-weight:600;color:var(--admin-primary);">
                                {{ number_format($doc->download_count, 0, ',', '.') }}x
                            </td>
                            <td>
                                @if ($doc->status === 'Aktif')
                                    <span style="color:#2e7d32;font-size:0.8rem;font-weight:600;">Aktif</span>
                                @else
                                    <span style="color:#c62828;font-size:0.8rem;">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ asset($doc->file) }}" target="_blank" class="btn btn-secondary btn-sm" title="Lihat/Download">Unduh</a>
                                <a href="{{ route('admin.jemaah-2027.documents.edit', $doc) }}" class="btn btn-secondary btn-sm">Ubah</a>
                                <form action="{{ route('admin.jemaah-2027.documents.destroy', $doc) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus dokumen ini? File fisik di server akan ikut terhapus.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center;color:var(--admin-muted);padding:24px;">Belum ada dokumen yang diunggah.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
