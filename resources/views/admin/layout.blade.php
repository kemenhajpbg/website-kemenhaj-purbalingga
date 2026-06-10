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
    <header class="admin-header">
        <h1>Panel Admin Kemenhaj</h1>
        <nav>
            <a href="{{ route('admin.dashboard') }}" @class(['active' => request()->routeIs('admin.dashboard')])>Dashboard</a>
            <a href="{{ route('admin.content.edit') }}" @class(['active' => request()->routeIs('admin.content.*')])>Konten Website</a>
            <a href="{{ route('admin.layanan.index') }}" @class(['active' => request()->routeIs('admin.layanan.*')])>Mall Layanan</a>
            <a href="{{ route('admin.berita.index') }}" @class(['active' => request()->routeIs('admin.berita.*')])>Berita</a>
            <a href="{{ route('admin.hajj-stats.edit') }}" @class(['active' => request()->routeIs('admin.hajj-stats.*')])>Data Jemaah</a>
            <a href="{{ route('home') }}" target="_blank">Lihat Website</a>
            <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Keluar</button>
            </form>
        </nav>
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
</body>
</html>
