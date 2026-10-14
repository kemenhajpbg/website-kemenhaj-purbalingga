@extends('admin.layout')

@section('title', 'Kelola Progres Persiapan Haji 2027')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <div>
            <h2 style="margin:0;">Progres Persiapan Haji 2027</h2>
            <p style="margin:4px 0 0;color:var(--admin-muted);font-size:0.85rem;">
                Kelola 8 tahapan resmi persiapan haji (persentase, status, keterangan, dan tanggal update).
            </p>
        </div>
        <div style="display:flex;gap:8px;">
            <a href="{{ route('admin.jemaah-2027.dashboard') }}" class="btn btn-secondary btn-sm">← Dashboard</a>
            <a href="{{ route('admin.jemaah-2027.stages.create') }}" class="btn btn-primary btn-sm">+ Tambah Tahapan</a>
        </div>
    </div>

    <div class="admin-card" style="padding:0;overflow:hidden;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width:60px;">Urutan</th>
                        <th>Nama Tahapan</th>
                        <th style="width:160px;">Persentase</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>Tgl Update</th>
                        <th style="width:70px;">Status</th>
                        <th style="width:140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($stages as $stage)
                        <tr>
                            <td style="text-align:center;font-weight:600;">{{ $stage->urutan }}</td>
                            <td><strong>{{ $stage->nama_tahapan }}</strong></td>
                            <td>
                                <div style="display:flex;align-items:center;gap:8px;">
                                    <div class="admin-progress-track" style="flex-grow:1;height:8px;margin:0;">
                                        <div class="admin-progress-bar" style="width:{{ $stage->persentase }}%;"></div>
                                    </div>
                                    <span style="font-weight:700;font-size:0.82rem;min-width:32px;">{{ $stage->persentase }}%</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge-status {{ $stage->status === 'Selesai' ? 'badge-success' : ($stage->status === 'Sedang Berlangsung' ? 'badge-warning' : ($stage->status === 'Menunggu Penetapan' ? 'badge-info' : 'badge-neutral')) }}">
                                    {{ $stage->status }}
                                </span>
                            </td>
                            <td style="font-size:0.82rem;color:var(--admin-muted);max-width:240px;">{{ $stage->keterangan ?? '—' }}</td>
                            <td style="font-size:0.82rem;">{{ $stage->tanggal_update?->format('d/m/Y') ?? '—' }}</td>
                            <td>
                                @if ($stage->aktif)
                                    <span style="color:#2e7d32;font-size:0.8rem;font-weight:600;">Aktif</span>
                                @else
                                    <span style="color:#c62828;font-size:0.8rem;">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.jemaah-2027.stages.edit', $stage) }}" class="btn btn-secondary btn-sm">Ubah</a>
                                <form action="{{ route('admin.jemaah-2027.stages.destroy', $stage) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus tahapan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align:center;color:var(--admin-muted);padding:24px;">Belum ada tahapan persiapan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
