@extends('layouts.app')

@section('pageTitle', $announcement->judul . ' — Info Jemaah Haji 2027 | Kemenhaj Purbalingga')
@section('pageDescription', Str::limit(strip_tags($announcement->isi), 150))
@section('ogTitle', $announcement->judul)
@section('ogDescription', Str::limit(strip_tags($announcement->isi), 150))

@section('content')
<div class="hajj-page">
    @include('partials.site-top', [
        'pageHeading' => 'Pengumuman Haji 2027',
        'pageSubheading' => 'Pusat Informasi Resmi Calon Jemaah Haji Kabupaten Purbalingga'
    ])

    <section class="hajj-section">
        <div class="container" style="max-width:820px;">
            <div style="margin-bottom:16px;">
                <a href="{{ route('info.jemaah.2027') }}#pengumuman" style="color:var(--teal-dark);font-size:0.88rem;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                    ← Kembali ke Info Jemaah 2027
                </a>
            </div>

            <article class="admin-card" style="padding:32px 28px;background:#ffffff;border:1px solid #e2ebe8;border-radius:var(--radius-lg);">
                <div style="display:flex;align-items:center;gap:10px;font-size:0.85rem;color:#64748b;margin-bottom:12px;">
                    <span>📅 {{ $announcement->tanggal_publikasi?->format('d F Y') ?? '—' }}</span>
                    <span>•</span>
                    <span class="badge-status badge-success">Pengumuman Resmi</span>
                </div>

                <h1 style="font-size:clamp(1.4rem, 3vw, 2rem);font-weight:800;color:#0d4f48;line-height:1.25;margin-bottom:20px;">
                    {{ $announcement->judul }}
                </h1>

                @if ($announcement->thumbnail)
                    <div style="margin-bottom:24px;border-radius:12px;overflow:hidden;">
                        <img src="{{ asset($announcement->thumbnail) }}" alt="{{ $announcement->judul }}" style="width:100%;max-height:420px;object-fit:cover;">
                    </div>
                @endif

                <div style="font-size:1rem;line-height:1.8;color:#334155;white-space:pre-line;margin-bottom:28px;">
                    {{ $announcement->isi }}
                </div>

                @if ($announcement->file_lampiran)
                    <div style="background:#f1f5f9;border-left:4px solid #0d9a8c;padding:16px 20px;border-radius:8px;display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;">
                        <div>
                            <strong style="color:#0d4f48;display:block;">Lampiran Dokumen Resmi</strong>
                            <span style="font-size:0.82rem;color:#64748b;">Silakan unduh dokumen surat edaran / lampiran berikut:</span>
                        </div>
                        <a href="{{ asset($announcement->file_lampiran) }}" target="_blank" class="btn-doc-download">
                            <span>Unduh Berkas Lampiran</span>
                        </a>
                    </div>
                @endif
            </article>

            @if ($recentAnnouncements->isNotEmpty())
                <div style="margin-top:40px;">
                    <h3 style="font-size:1.15rem;color:#0d4f48;margin-bottom:16px;">Pengumuman Lainnya</h3>
                    <div style="display:flex;flex-direction:column;gap:12px;">
                        @foreach ($recentAnnouncements as $r)
                            <a href="{{ route('info.jemaah.2027.pengumuman', $r->slug) }}" class="admin-card" style="padding:14px 18px;margin:0;text-decoration:none;display:flex;justify-content:space-between;align-items:center;transition:border-color 0.2s;">
                                <div>
                                    <h4 style="margin:0 0 4px;font-size:0.95rem;color:#1a1a1a;">{{ $r->judul }}</h4>
                                    <span style="font-size:0.75rem;color:#94a3b8;">{{ $r->tanggal_publikasi?->format('d/m/Y') }}</span>
                                </div>
                                <span style="color:var(--teal-dark);font-size:0.85rem;font-weight:600;">Lihat →</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
</div>
@endsection
