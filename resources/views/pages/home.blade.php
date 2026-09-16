@extends('layouts.app')

@section('content')

@php
    $line = fn (string $text) => nl2br(e($text));
@endphp

{{-- HERO --}}
<section class="hero">
    <div class="container">
        <div class="hero-top-bar">
            <a href="{{ route('home') }}" class="site-brand">
                <img src="{{ asset($s['image_logo_kemenhaj'] ?? 'images/logo-kemenhaj.png') }}" alt="Kemenhaj Purbalingga" class="site-brand-logo">
                <span class="site-brand-text">
                    <span>{{ $s['brand_line_1'] ?? 'Kementerian Haji dan Umrah' }}</span>
                    <span>{{ $s['brand_line_2'] ?? 'Kabupaten Purbalingga' }}</span>
                </span>
            </a>
            <nav class="site-nav site-nav--hero" aria-label="Navigasi utama">
                <a href="{{ route('home') }}" class="site-nav-link is-active">Beranda</a>
                <a href="{{ route('profil') }}" class="site-nav-link">Profil</a>
                <a href="{{ route('berita.index') }}" class="site-nav-link">Berita</a>
                <a href="{{ route('galeri.index') }}" class="site-nav-link">Galeri</a>
                <a href="https://haji.go.id/regulasi" target="_blank" rel="noopener noreferrer" class="site-nav-link">Regulasi</a>
            </nav>
        </div>

        <div class="hero-wrapper">
            <div class="hero-left">
                <div class="hero-photo-wrap">
                    <img src="{{ asset($s['image_hero_pejabat'] ?? 'images/pejabat.png') }}" alt="Pejabat Kantor Kemenhaj Purbalingga"
                        class="hero-photo">
                </div>
            </div>

            <div class="hero-right">
                <h1 class="hero-title">{{ $s['hero_title'] ?? 'Sugeng Rawuh' }}</h1>
                <p class="hero-subtitle">{!! $line($s['hero_subtitle'] ?? "Layanan Digital Kantor Kementerian Haji dan Umrah\nKabupaten Purbalingga") !!}</p>

                <div class="satuhaji-box">
                    <img src="{{ asset($s['image_satuhaji'] ?? 'images/satuhaji.png') }}" alt="Logo Satu Haji" class="satuhaji-logo">
                    <div class="satuhaji-content">
                        <h3>{{ $s['satuhaji_title'] ?? 'APLIKASI SATUHAJI' }}</h3>
                        <p>{{ $s['satuhaji_description'] ?? '' }}</p>
                        @if (!empty($s['satuhaji_button_url']))
                            <a href="{{ $s['satuhaji_button_url'] }}" class="btn btn--sm" target="_blank" rel="noopener noreferrer">{{ $s['satuhaji_button_text'] ?? 'Klik disini' }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-slope" aria-hidden="true"></div>
</section>

{{-- MALL LAYANAN --}}
<section class="mall-section">
    <div class="container">
        <h2 class="mall-title">{{ $s['mall_title'] ?? 'Mall Layanan' }}</h2>

        <div class="service-grid">
            @foreach ($services as $service)
                <a href="{{ $service->url ?: '#' }}" class="service-card" @if($service->url && $service->url !== '#') target="_blank" rel="noopener noreferrer" @endif>
                    <img src="{{ asset($service->icon) }}" alt="">
                    <h4>{{ $service->title }}</h4>
                </a>
            @endforeach
        </div>
    </div>
</section>

@include('partials.hajj-stats-section')

{{-- BERITA --}}
@if ($latestNews->isNotEmpty())
<section class="home-news-section">
    <div class="container">
        <div class="section-heading">
            <h2 class="section-heading-title">Berita Terbaru</h2>
            <a href="{{ route('berita.index') }}" class="btn btn--outline">Lihat Semua Berita</a>
        </div>

        <div class="news-grid">
            @foreach ($latestNews as $article)
                <article class="news-card">
                    <a href="{{ route('berita.show', $article->slug) }}" class="news-card-link">
                        <div class="news-card-image">
                            @if ($article->image)
                                <img src="{{ asset($article->image) }}" alt="{{ $article->title }}">
                            @else
                                <div class="news-card-placeholder" aria-hidden="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5v9m-4.5-4.5h9M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </div>
                            @endif
                            <span class="news-card-date">{{ $article->published_at?->translatedFormat('d M Y') }}</span>
                        </div>
                        <div class="news-card-body">
                            <h3>{{ $article->title }}</h3>
                            <p>{{ $article->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($article->content), 100) }}</p>
                            <span class="news-card-more">Baca selengkapnya →</span>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="cta-section">
    <div class="container">
        <div class="cta-box">
            <h2 class="cta-title">
                {{ $s['cta_title_line1'] ?? 'Cek Estimasi' }}<br>
                {{ $s['cta_title_line2'] ?? 'Keberangkatan anda' }}
            </h2>
            @if (!empty($s['cta_url']))
                <a href="{{ $s['cta_url'] }}" class="btn btn--cta" target="_blank" rel="noopener noreferrer">{{ $s['cta_button_text'] ?? 'Klik disini' }}</a>
            @endif
        </div>
    </div>
</section>

{{-- LOKASI --}}
<section class="location-section">
    <div class="container">
        <div class="location-panel">
            <h2 class="location-heading">
                <span class="location-heading-line" aria-hidden="true"></span>
                LOKASI KANTOR
            </h2>

            <div class="location-grid">
                <div class="contact-box">
                    <div class="contact-item">
                        <span class="contact-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                        </span>
                        <div>
                            <strong>Alamat</strong>
                            <p>{{ $s['contact_address'] ?? '' }}</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                        </span>
                        <div>
                            <strong>Email</strong>
                            <p><a href="mailto:{{ $s['contact_email'] ?? '' }}">{{ $s['contact_email'] ?? '' }}</a></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.956 1.347c-.24.338-.69.42-1.022.24a12.055 12.055 0 0 1-7.143-7.143c-.18-.332-.098-.782.24-1.022l1.347-.956c.362-.271.527-.733.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                            </svg>
                        </span>
                        <div>
                            <strong>Kontak</strong>
                            <p><a href="tel:{{ preg_replace('/\D/', '', $s['contact_phone'] ?? '') }}">{{ $s['contact_phone'] ?? '' }}</a></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </span>
                        <div>
                            <strong>Waktu layanan</strong>
                            <p>{!! $line($s['contact_hours'] ?? '') !!}</p>
                        </div>
                    </div>
                </div>

                <div class="map-wrap">
                    <iframe title="Peta Lokasi Kantor"
                        src="{{ $s['map_embed_url'] ?? '' }}"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                    @if (!empty($s['map_external_url']))
                        <a href="{{ $s['map_external_url'] }}" target="_blank" rel="noopener noreferrer" class="btn btn--map">{{ $s['map_button_text'] ?? 'Lokasi' }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
    @vite(['resources/js/hajj-stats.js'])
@endpush
