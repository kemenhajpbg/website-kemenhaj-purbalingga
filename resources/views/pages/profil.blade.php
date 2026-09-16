@extends('layouts.app')

@section('pageTitle', 'Profil Kantor — ' . ($siteTitle ?? 'Kementerian Haji dan Umrah Kabupaten Purbalingga'))

@section('content')

@include('partials.site-top', [
    'pageHeading' => 'Profil Kantor',
    'pageSubheading' => 'Kenali lebih dekat Kementerian Haji dan Umrah Kabupaten Purbalingga',
])

<section class="profile-page-section">
    <div class="container">
        @php
            $numberedIndex = 1;
        @endphp
        <div class="profile-list">
            @forelse ($sections as $index => $item)
                @if (Illuminate\Support\Str::slug($item->title) === 'struktur-organisasi')
                    <div class="profile-item profile-item--full-width" id="struktur-organisasi-section">
                        <!-- Header Card -->
                        <div class="officials-header-card">
                            <h2>Pejabat</h2>
                            <p>Pejabat struktural Kementerian Haji dan Umrah</p>
                        </div>
                        
                        @if (isset($officials) && $officials->isNotEmpty())
                            <div class="officials-grid">
                                @foreach ($officials as $official)
                                    <div class="official-card">
                                        <div class="official-photo-wrapper">
                                            @if ($official->image)
                                                <img src="{{ asset($official->image) }}" alt="{{ $official->name }}" class="official-photo">
                                            @else
                                                <div class="official-photo-placeholder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="official-info">
                                            <div class="official-name">{{ $official->name }}</div>
                                            <div class="official-position">{{ $official->position }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @else
                    <div class="profile-item @if($numberedIndex % 2 == 0) profile-item--reverse @endif">
                        <div class="profile-item-content">
                            <h2 class="profile-item-title">
                                <span class="profile-item-number">0{{ $numberedIndex++ }}</span>
                                {{ $item->title }}
                            </h2>
                            <div class="profile-item-text">
                                {!! nl2br(e($item->content)) !!}
                            </div>
                        </div>
                        
                        @if ($item->video_url || $item->image)
                            <div class="profile-item-media">
                                @if ($item->video_url)
                                    <div class="profile-video-wrapper">
                                        <iframe 
                                            src="{{ $item->video_url }}" 
                                            title="{{ $item->title }}"
                                            frameborder="0" 
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                @elseif ($item->image)
                                    <div class="profile-image-wrapper">
                                        <img src="{{ asset($item->image) }}" alt="{{ $item->title }}">
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                @endif
            @empty
                <div class="profile-empty">
                    <p>Informasi profil kantor sedang diperbarui.</p>
                    <a href="{{ route('home') }}" class="btn btn--sm" style="margin-top: 12px; display: inline-block;">Kembali ke Beranda</a>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
