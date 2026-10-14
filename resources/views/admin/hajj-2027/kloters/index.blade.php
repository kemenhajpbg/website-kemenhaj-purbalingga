@extends('admin.layout')

@section('title', 'Kelola Informasi Kloter Haji 2027')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <div>
            <h2 style="margin:0;">Informasi Kloter Jemaah Haji Purbalingga</h2>
            <p style="margin:4px 0 0;color:var(--admin-muted);font-size:0.85rem;">
                Kelola kelompok terbang resmi (SOC). Jika belum ditetapkan, jangan membuat data fiktif.
            </p>
        </div>
        <div style="display:flex;gap:8px;">
            <a href="{{ route('admin.jemaah-2027.dashboard') }}" class="btn btn-secondary btn-sm">← Dashboard</a>
            <a href="{{ route('admin.jemaah-2027.kloters.create') }}" class="btn btn-primary btn-sm">+ Tambah Kloter</a>
        </div>
    </div>

    <div style="background:#fff8e1;border-left:4px solid #b78103;padding:12px 16px;border-radius:4px;margin-bottom:20px;font-size:0.85rem;color:#78350f;">
        <strong>Aturan Resmi:</strong> Bila belum ada penetapan kloter resmi dari Kanwil Kemenag/Kemenhaj, set status kloter menjadi <em>"Belum Ditetapkan"</em> atau kosongkan daftar kloter. Halaman publik akan secara otomatis menampilkan pengumuman: <em>"Informasi kloter akan diperbarui setelah penetapan resmi."</em>
    </div>

    <div class="admin-card" style="padding:0;overflow:hidden;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Nomor Kloter</th>
                        <th>Jemaah</th>
                        <th>Embarkasi</th>
                        <th>Masuk Asrama</th>
                        <th>Keberangkatan</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th style="width:140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kloters as $k)
                        <tr>
                            <td><strong>{{ $k->nomor_kloter }}</strong></td>
                            <td style="font-weight:600;">
                                {{ $k->jumlah_jemaah > 0 ? number_format($k->jumlah_jemaah, 0, ',', '.') . ' orang' : '—' }}
                            </td>
                            <td>{{ $k->embarkasi ?? 'SOC (Solo)' }}</td>
                            <td style="font-size:0.82rem;">{{ $k->tanggal_masuk_asrama?->format('d/m/Y H:i') ?? '—' }}</td>
                            <td style="font-size:0.82rem;">{{ $k->tanggal_keberangkatan?->format('d/m/Y H:i') ?? '—' }}</td>
                            <td>
                                <span class="badge-status {{ $k->status === 'Belum Ditetapkan' ? 'badge-neutral' : ($k->status === 'Terjadwal' ? 'badge-info' : ($k->status === 'Sudah Berangkat' ? 'badge-warning' : 'badge-success')) }}">
                                    {{ $k->status }}
                                </span>
                            </td>
                            <td style="font-size:0.82rem;color:var(--admin-muted);max-width:200px;">{{ $k->keterangan ?? '—' }}</td>
                            <td>
                                <a href="{{ route('admin.jemaah-2027.kloters.edit', $k) }}" class="btn btn-secondary btn-sm">Ubah</a>
                                <form action="{{ route('admin.jemaah-2027.kloters.destroy', $k) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus data kloter ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align:center;color:var(--admin-muted);padding:24px;">Belum ada penetapan kloter.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
