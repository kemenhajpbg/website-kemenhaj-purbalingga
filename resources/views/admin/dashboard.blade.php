@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <!-- Welcome Banner Card -->
    <div class="dashboard-welcome-banner">
        <div class="dashboard-welcome-content">
            <h1>Selamat Datang di Panel Admin</h1>
            <p>Sistem Informasi Terpadu & Manajemen Konten Portal Kementerian Haji dan Umrah Kabupaten Purbalingga. Kelola semua fitur, data, dan informasi publik Anda dari dashboard ini.</p>
        </div>
    </div>

    <!-- Quick Stats Metric Widgets -->
    <div class="dashboard-stats-row">
        <div class="stat-widget-card">
            <div class="stat-widget-icon icon-news">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                </svg>
            </div>
            <div class="stat-widget-info">
                <span class="stat-count">{{ $newsCount }}</span>
                <span class="stat-label">Total Berita</span>
            </div>
        </div>
        <div class="stat-widget-card">
            <div class="stat-widget-icon icon-services">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.015a2.993 2.993 0 0 0 2.25 1.015c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.5a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75h-3.5a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                </svg>
            </div>
            <div class="stat-widget-info">
                <span class="stat-count">{{ $servicesCount }}</span>
                <span class="stat-label">Mall Layanan</span>
            </div>
        </div>
        <div class="stat-widget-card">
            <div class="stat-widget-icon icon-officials">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.109A9.342 9.342 0 0 1 12 20.25a9.343 9.343 0 0 1-3-1.013v-.11c0-1.112-.285-2.16-.786-3.07M12 15.75a6.002 6.002 0 0 0-4.121-5.592M12 15.75a6.002 6.002 0 0 1 4.121-5.592m0 0a3.97 3.97 0 0 1-.035-.373c0-2.208-1.792-4-4-4s-4 1.792-4 4c0 .125.006.248.018.37M12 20.25a9.38 9.38 0 0 1-2.625-.372 9.337 9.337 0 0 1-4.121.952 4.125 4.125 0 0 1 7.533-2.493M4.5 19.5A3.375 3.375 0 0 1 7.875 16.125a3.371 3.371 0 0 1 1.76.494M20.25 19.5A3.375 3.375 0 0 0 16.875 16.125a3.371 3.371 0 0 0-1.76.494" />
                </svg>
            </div>
            <div class="stat-widget-info">
                <span class="stat-count">{{ $officialsCount }}</span>
                <span class="stat-label">Struktur Pejabat</span>
            </div>
        </div>
        <div class="stat-widget-card">
            <div class="stat-widget-icon icon-gallery">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
            </div>
            <div class="stat-widget-info">
                <span class="stat-count">{{ $galleryCount }}</span>
                <span class="stat-label">Galeri Foto</span>
            </div>
        </div>
    </div>

    <!-- Quick Navigation Title -->
    <h3 class="dashboard-section-title">Menu Navigasi Cepat</h3>

    <!-- Quick Nav Navigation Cards Grid -->
    <div class="dashboard-grid">
        <a href="{{ route('admin.content.edit') }}" class="dashboard-card-premium">
            <div class="dashboard-card-icon icon-content">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 0 0-2.225.445l-3.269 2.18A2.25 2.25 0 0 0 3 20.626V6.75A2.25 2.25 0 0 1 5.25 4.5h13.5A2.25 2.25 0 0 1 21 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-3.14l-2.06-2.06c-.15-.15-.3-.282-.472-.396l-3.598-2.392Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 9h6M9 12.5h3" />
                </svg>
            </div>
            <div class="dashboard-card-body">
                <h4>Konten Website</h4>
                <p>Kelola logo, foto banner hero, CTA banner, lokasi dinas, dan kontak WhatsApp.</p>
            </div>
        </a>

        <a href="{{ route('admin.layanan.index') }}" class="dashboard-card-premium">
            <div class="dashboard-card-icon icon-services">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.015a2.993 2.993 0 0 0 2.25 1.015c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.5a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75h-3.5a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                </svg>
            </div>
            <div class="dashboard-card-body">
                <h4>Mall Layanan</h4>
                <p>Tambah, edit, atau hapus link pendaftaran, pembatalan, and pelimpahan porsi haji.</p>
            </div>
        </a>

        <a href="{{ route('admin.berita.index') }}" class="dashboard-card-premium">
            <div class="dashboard-card-icon icon-news">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                </svg>
            </div>
            <div class="dashboard-card-body">
                <h4>Berita & Pengumuman</h4>
                <p>Publikasikan informasi kegiatan dinas, manasik haji, and pengumuman terbaru.</p>
            </div>
        </a>

        <a href="{{ route('admin.profil.index') }}" class="dashboard-card-premium">
            <div class="dashboard-card-icon icon-profile">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A4.866 4.866 0 0 0 7.97 21.03C9.306 21.03 10.62 21 12 21s2.694.03 4.03-.03a4.866 4.866 0 0 0 4.193-4.536 60.438 60.438 0 0 0-.49-6.348N12 8.5V4.5a2.25 2.25 0 0 0-2.25-2.25h-3.5A2.25 2.25 0 0 0 4 4.5v4m8-4.5h.008v.008h-.008V4.5Z" />
                </svg>
            </div>
            <div class="dashboard-card-body">
                <h4>Profil Kantor</h4>
                <p>Kelola isi halaman profil utama seperti Sejarah Singkat dan Visi & Misi.</p>
            </div>
        </a>

        <a href="{{ route('admin.pejabat.index') }}" class="dashboard-card-premium">
            <div class="dashboard-card-icon icon-officials">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.109A9.342 9.342 0 0 1 12 20.25a9.343 9.343 0 0 1-3-1.013v-.11c0-1.112-.285-2.16-.786-3.07M12 15.75a6.002 6.002 0 0 0-4.121-5.592M12 15.75a6.002 6.002 0 0 1 4.121-5.592m0 0a3.97 3.97 0 0 1-.035-.373c0-2.208-1.792-4-4-4s-4 1.792-4 4c0 .125.006.248.018.37M12 20.25a9.38 9.38 0 0 1-2.625-.372 9.337 9.337 0 0 1-4.121.952 4.125 4.125 0 0 1 7.533-2.493M4.5 19.5A3.375 3.375 0 0 1 7.875 16.125a3.371 3.371 0 0 1 1.76.494M20.25 19.5A3.375 3.375 0 0 0 16.875 16.125a3.371 3.371 0 0 0-1.76.494" />
                </svg>
            </div>
            <div class="dashboard-card-body">
                <h4>Struktur Organisasi</h4>
                <p>Daftarkan pejabat struktural, urutan susunan, and perbarui foto profil resmi.</p>
            </div>
        </a>

        <a href="{{ route('admin.galeri.index') }}" class="dashboard-card-premium">
            <div class="dashboard-card-icon icon-gallery">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
            </div>
            <div class="dashboard-card-body">
                <h4>Galeri Dokumentasi</h4>
                <p>Unggah foto kegiatan pelayanan haji and dokumentasi bimbingan manasik.</p>
            </div>
        </a>

        <a href="{{ route('admin.hajj-stats.edit') }}" class="dashboard-card-premium">
            <div class="dashboard-card-icon icon-stats">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                </svg>
            </div>
            <div class="dashboard-card-body">
                <h4>Data Jemaah Haji</h4>
                <p>Input statistik tahunan jemaah haji reguler, masa tunggu, and grafik grafik siskohat.</p>
            </div>
        </a>

        <a href="{{ route('home') }}" class="dashboard-card-premium view-web-card" target="_blank">
            <div class="dashboard-card-icon icon-web">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                </svg>
            </div>
            <div class="dashboard-card-body">
                <h4>Kunjungi Website</h4>
                <p>Buka halaman depan website Kemenhaj Purbalingga di tab browser baru.</p>
            </div>
        </a>
    </div>
@endsection
