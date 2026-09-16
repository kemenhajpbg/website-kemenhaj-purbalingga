@php
    $s = $s ?? [];
@endphp

<header class="page-top">
    <div class="container">
        <div class="page-top-inner">
            <a href="{{ route('home') }}" class="site-brand site-brand--compact">
                <img src="{{ asset($s['image_logo_kemenhaj'] ?? 'images/logo-kemenhaj.png') }}" alt="Kemenhaj Purbalingga" class="site-brand-logo">
                <span class="site-brand-text">
                    <span>{{ $s['brand_line_1'] ?? 'Kementerian Haji dan Umrah' }}</span>
                    <span>{{ $s['brand_line_2'] ?? 'Kabupaten Purbalingga' }}</span>
                </span>
            </a>
            <nav class="site-nav" aria-label="Navigasi utama">
                <a href="{{ route('home') }}" @class(['site-nav-link', 'is-active' => request()->routeIs('home')])>Beranda</a>
                <a href="{{ route('profil') }}" @class(['site-nav-link', 'is-active' => request()->routeIs('profil')])>Profil</a>
                <a href="{{ route('berita.index') }}" @class(['site-nav-link', 'is-active' => request()->routeIs('berita.*')])>Berita</a>
                <a href="{{ route('galeri.index') }}" @class(['site-nav-link', 'is-active' => request()->routeIs('galeri.*')])>Galeri</a>
                <a href="https://haji.go.id/regulasi" target="_blank" rel="noopener noreferrer" class="site-nav-link">Regulasi</a>
            </nav>
        </div>
        @isset($pageHeading)
            <div class="page-top-heading">
                <h1>{{ $pageHeading }}</h1>
                @isset($pageSubheading)
                    <p>{{ $pageSubheading }}</p>
                @endisset
            </div>
        @endisset
    </div>
    <div class="page-top-slope" aria-hidden="true"></div>
</header>
