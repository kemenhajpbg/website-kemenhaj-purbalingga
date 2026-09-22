@extends('layouts.app')

@section('pageTitle', 'Berita — ' . ($siteTitle ?? 'Kementerian Haji dan Umrah Kabupaten Purbalingga'))

@section('content')

@include('partials.site-top', [
    'pageHeading' => 'Berita & Informasi',
    'pageSubheading' => 'Update kegiatan dan layanan Kementerian Haji dan Umrah Kabupaten Purbalingga',
])

<section class="news-section">
    <div class="container">
        @if ($news->isEmpty())
            <div class="news-empty">
                <p>Belum ada berita yang dipublikasikan.</p>
                <a href="{{ route('home') }}" class="btn btn--sm">Kembali ke Beranda</a>
            </div>
        @else
            <div class="news-grid">
                @foreach ($news as $article)
                    <article class="news-card">
                        <a href="{{ route('berita.show', $article->slug) }}" class="news-card-link">
                            <div class="news-card-image">
                                @php $cardImg = $article->display_image ?? $article->image; @endphp
                                @if ($cardImg)
                                    <img src="{{ asset($cardImg) }}" alt="{{ $article->title }}">
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
                                <h2>{{ $article->title }}</h2>
                                <p>{{ $article->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($article->content), 120) }}</p>
                                <span class="news-card-more">Baca selengkapnya →</span>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>

            @if ($news->hasPages())
                <div class="news-pagination">
                    {{ $news->links('pagination.news') }}
                </div>
            @endif
        @endif
    </div>
</section>

@endsection
