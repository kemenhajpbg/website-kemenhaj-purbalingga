@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <h2 style="margin-top:0;">Dashboard</h2>
    <p style="color:#5c6b66;margin-bottom:24px;">Kelola seluruh konten website Kemenhaj Purbalingga dari sini.</p>

    <div class="dashboard-grid">
        <a href="{{ route('admin.content.edit') }}" class="dashboard-card">
            <h3>Konten Website</h3>
            <p>Logo, hero, Satu Haji, CTA, lokasi kantor, dan gambar.</p>
        </a>
        <a href="{{ route('admin.layanan.index') }}" class="dashboard-card">
            <h3>Mall Layanan</h3>
            <p>Tambah, ubah, atau hapus kartu layanan dan tautannya.</p>
        </a>
        <a href="{{ route('admin.berita.index') }}" class="dashboard-card">
            <h3>Berita</h3>
            <p>Kelola berita dan informasi kegiatan kantor.</p>
        </a>
        <a href="{{ route('admin.hajj-stats.edit') }}" class="dashboard-card">
            <h3>Data Jemaah Haji</h3>
            <p>Statistik jemaah reguler, grafik, dan masa tunggu.</p>
        </a>
        <a href="{{ route('home') }}" class="dashboard-card" target="_blank">
            <h3>Lihat Website</h3>
            <p>Buka halaman depan di tab baru.</p>
        </a>
    </div>
@endsection
