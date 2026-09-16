@extends('layouts.app')

@section('pageTitle', 'Galeri Kegiatan — ' . ($siteTitle ?? 'Kementerian Haji dan Umrah Kabupaten Purbalingga'))

@section('content')

@include('partials.site-top', [
    'pageHeading' => 'Galeri Kegiatan',
    'pageSubheading' => 'Dokumentasi visual berbagai kegiatan dan pelayanan Kementerian Haji dan Umrah Kabupaten Purbalingga',
])

<section class="gallery-page-section">
    <div class="container">
        @if($galleries->isEmpty())
            <div class="gallery-empty">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="empty-icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
                <p>Dokumentasi foto belum tersedia.</p>
                <a href="{{ route('home') }}" class="btn btn--sm" style="margin-top: 16px; display: inline-block;">Kembali ke Beranda</a>
            </div>
        @else
            <div class="gallery-grid">
                @foreach ($galleries as $item)
                    <div class="gallery-card" data-title="{{ $item->title }}" data-description="{{ $item->description }}" data-image="{{ asset($item->image) }}" data-date="{{ $item->created_at->translatedFormat('d M Y') }}">
                        <div class="gallery-card-image-wrap">
                            <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="gallery-card-image" loading="lazy">
                            <div class="gallery-card-overlay">
                                <span class="gallery-zoom-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.637 10.637ZM10.5 7.5v6m3-3h-6" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="gallery-card-info">
                            <span class="gallery-card-date">{{ $item->created_at->translatedFormat('d M Y') }}</span>
                            <h3 class="gallery-card-title">{{ $item->title }}</h3>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- Lightbox Modal -->
<div id="lightboxModal" class="lightbox-modal" aria-hidden="true" role="dialog">
    <button class="lightbox-close" aria-label="Tutup Galeri">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
    </button>
    <div class="lightbox-content-wrap">
        <div class="lightbox-image-box">
            <img id="lightboxImage" src="" alt="">
        </div>
        <div class="lightbox-info-box">
            <span id="lightboxDate" class="lightbox-date"></span>
            <h2 id="lightboxTitle" class="lightbox-title"></h2>
            <p id="lightboxDescription" class="lightbox-desc"></p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const galleryCards = document.querySelectorAll('.gallery-card');
        const modal = document.getElementById('lightboxModal');
        const modalImg = document.getElementById('lightboxImage');
        const modalTitle = document.getElementById('lightboxTitle');
        const modalDesc = document.getElementById('lightboxDescription');
        const modalDate = document.getElementById('lightboxDate');
        const closeBtn = document.querySelector('.lightbox-close');

        function openLightbox(card) {
            const title = card.getAttribute('data-title');
            const desc = card.getAttribute('data-description');
            const image = card.getAttribute('data-image');
            const date = card.getAttribute('data-date');

            modalImg.src = image;
            modalImg.alt = title;
            modalTitle.textContent = title;
            modalDate.textContent = date;
            
            if (desc && desc.trim() !== '') {
                modalDesc.textContent = desc;
                modalDesc.style.display = 'block';
            } else {
                modalDesc.style.display = 'none';
            }

            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
            
            // Clear contents after transition
            setTimeout(() => {
                modalImg.src = '';
                modalTitle.textContent = '';
                modalDesc.textContent = '';
                modalDate.textContent = '';
            }, 300);
        }

        galleryCards.forEach(card => {
            card.addEventListener('click', function () {
                openLightbox(card);
            });
        });

        closeBtn.addEventListener('click', closeLightbox);

        // Close on backdrop click (click outside content)
        modal.addEventListener('click', function (e) {
            if (e.target === modal || e.target.classList.contains('lightbox-content-wrap')) {
                closeLightbox();
            }
        });

        // Close on Escape key press
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && modal.classList.contains('is-open')) {
                closeLightbox();
            }
        });
    });
</script>

@endsection
