@extends('layouts.app')

@php
    $shareUrl = url()->current();
    $shareTitle = $article->title;
    $shareDesc = $article->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($article->content), 160);
    $imagePath = $article->display_image ?? $article->image;
    $ogImage = $imagePath 
        ? (str_starts_with($imagePath, 'http') ? $imagePath : asset($imagePath))
        : ($siteFavicon ?? asset('images/logo-kemenhaj.png'));

    $ogImageType = 'image/jpeg';
    if ($imagePath) {
        $imgExt = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
        if ($imgExt === 'png') {
            $ogImageType = 'image/png';
        } elseif ($imgExt === 'webp') {
            $ogImageType = 'image/webp';
        }
    }

    $waShareUrl = 'https://api.whatsapp.com/send?text=' . rawurlencode($shareTitle . "\n\n" . $shareUrl);
@endphp

@section('pageTitle', $article->title . ' — ' . ($siteTitle ?? 'Kementerian Haji dan Umrah Kabupaten Purbalingga'))
@section('pageDescription', $shareDesc)
@section('ogType', 'article')
@section('ogTitle', $shareTitle)
@section('ogDescription', $shareDesc)
@section('ogImage', $ogImage)
@section('ogImageType', $ogImageType)

@section('meta')
    <meta property="article:published_time" content="{{ $article->published_at?->toIso8601String() }}">
    <meta property="article:section" content="Berita">
@endsection

@section('content')

@include('partials.site-top', ['pageHeading' => 'Berita'])

<section class="news-article-section">
    <div class="container container--narrow">
        <a href="{{ route('berita.index') }}" class="news-back">← Kembali ke Berita</a>

        <article class="news-article">
            <header class="news-article-header">
                <time datetime="{{ $article->published_at?->toDateString() }}">
                    {{ $article->published_at?->translatedFormat('l, d F Y') }}
                </time>
                <h1>{{ $article->title }}</h1>
                @if ($article->excerpt)
                    <p class="news-article-excerpt">{{ $article->excerpt }}</p>
                @endif

                {{-- Bar Tombol Bagikan (Bagian Atas) --}}
                <div class="news-share-bar news-share-bar--top">
                    <span class="news-share-label">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                        </svg>
                        Bagikan:
                    </span>
                    @include('partials.news-share-buttons', compact('shareUrl', 'shareTitle', 'waShareUrl'))
                </div>
            </header>

            @if ($imagePath)
                <div class="news-article-image">
                    <img src="{{ asset($imagePath) }}" alt="{{ $article->title }}">
                </div>
            @endif

            <div class="news-article-content">
                {!! nl2br(e($article->content)) !!}
            </div>

            {{-- Box Bagikan Berita (Bagian Bawah Artikel) --}}
            <footer class="news-article-footer">
                <div class="news-share-box">
                    <div class="news-share-box-info">
                        <span class="news-share-box-heading">Bagikan Berita Ini</span>
                        <span class="news-share-box-sub">Bantu sebarkan informasi resmi ini ke jemaah atau keluarga:</span>
                    </div>
                    @include('partials.news-share-buttons', compact('shareUrl', 'shareTitle', 'waShareUrl'))
                </div>
            </footer>
        </article>

        @if ($related->isNotEmpty())
            <aside class="news-related">
                <h2>Berita Lainnya</h2>
                <div class="news-related-grid">
                    @foreach ($related as $item)
                        <a href="{{ route('berita.show', $item->slug) }}" class="news-related-card">
                            <span class="news-related-date">{{ $item->published_at?->translatedFormat('d M Y') }}</span>
                            <span class="news-related-title">{{ $item->title }}</span>
                        </a>
                    @endforeach
                </div>
            </aside>
        @endif
    </div>
</section>

@endsection

