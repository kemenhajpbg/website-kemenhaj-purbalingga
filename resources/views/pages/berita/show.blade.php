@extends('layouts.app')

@section('pageTitle', $article->title . ' — ' . ($siteTitle ?? 'Kementerian Haji dan Umrah Kabupaten Purbalingga'))

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
            </header>

            @if ($article->image)
                <div class="news-article-image">
                    <img src="{{ asset($article->image) }}" alt="{{ $article->title }}">
                </div>
            @endif

            <div class="news-article-content">
                {!! nl2br(e($article->content)) !!}
            </div>
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
