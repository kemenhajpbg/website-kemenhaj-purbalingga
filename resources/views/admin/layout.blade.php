<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — {{ $siteTitle ?? 'Kementerian Haji dan Umrah Kabupaten Purbalingga' }}</title>
    <link rel="icon" type="image/png" href="{{ $siteFavicon ?? asset('images/logo-kemenhaj.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/admin.css'])
</head>
<body class="admin-body">
    <div class="admin-wrapper">
        <aside class="admin-sidebar">
            <div class="admin-sidebar-brand">
                <img src="{{ $siteFavicon ?? asset('images/logo-kemenhaj.png') }}" alt="Logo Kemenhaj" class="admin-sidebar-logo">
                <div class="admin-sidebar-brand-text">
                    <h2>Panel Admin</h2>
                    <span>Kemenhaj Purbalingga</span>
                </div>
            </div>
            <nav class="admin-sidebar-nav">
                <a href="{{ route('admin.dashboard') }}" @class(['active' => request()->routeIs('admin.dashboard')])>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.content.edit') }}" @class(['active' => request()->routeIs('admin.content.*')])>
                    <span>Konten Website</span>
                </a>
                <a href="{{ route('admin.layanan.index') }}" @class(['active' => request()->routeIs('admin.layanan.*')])>
                    <span>Mall Layanan</span>
                </a>
                <a href="{{ route('admin.berita.index') }}" @class(['active' => request()->routeIs('admin.berita.*')])>
                    <span>Berita</span>
                </a>
                <a href="{{ route('admin.profil.index') }}" @class(['active' => request()->routeIs('admin.profil.*')])>
                    <span>Profil Kantor</span>
                </a>
                <a href="{{ route('admin.pejabat.index') }}" @class(['active' => request()->routeIs('admin.pejabat.*')])>
                    <span>Struktur Organisasi</span>
                </a>
                <a href="{{ route('admin.galeri.index') }}" @class(['active' => request()->routeIs('admin.galeri.*')])>
                    <span>Galeri</span>
                </a>
                <a href="{{ route('admin.hajj-stats.edit') }}" @class(['active' => request()->routeIs('admin.hajj-stats.*')])>
                    <span>Data Jemaah</span>
                </a>
                <div class="admin-sidebar-divider"></div>
                <a href="{{ route('home') }}" target="_blank" class="view-website-link">
                    <span>Lihat Website</span>
                </a>
                <form action="{{ route('admin.logout') }}" method="POST" class="admin-logout-form">
                    @csrf
                    <button type="submit" class="admin-logout-btn">Keluar</button>
                </form>
            </nav>
        </aside>

        <div class="admin-content">
            <header class="admin-topbar">
                <div style="display:flex;align-items:center;">
                    <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle Sidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                    <div class="admin-topbar-title">
                        Kementerian Haji & Umrah
                    </div>
                </div>
                <div class="admin-topbar-user">
                    <span>{{ auth()->user()->name ?? 'Administrator' }}</span>
                </div>
            </header>

            <main class="admin-main">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error">
                        <ul style="margin:0;padding-left:18px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Script for sidebar toggle on mobile -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggle = document.getElementById('sidebarToggle');
            const sidebar = document.querySelector('.admin-sidebar');
            if (toggle && sidebar) {
                toggle.addEventListener('click', function (e) {
                    e.stopPropagation();
                    sidebar.classList.toggle('is-visible');
                });

                // Close sidebar when clicking outside of it on mobile
                document.addEventListener('click', function (e) {
                    if (sidebar.classList.contains('is-visible') && !sidebar.contains(e.target) && e.target !== toggle) {
                        sidebar.classList.remove('is-visible');
                    }
                });
            }
        });
    </script>
</body>
</html>
