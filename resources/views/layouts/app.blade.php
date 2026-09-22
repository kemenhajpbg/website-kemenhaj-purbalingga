<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('pageTitle', $siteTitle ?? 'Kementerian Haji dan Umrah Kabupaten Purbalingga')</title>
    <meta name="description" content="@hasSection('pageDescription')@yield('pageDescription')@else{{ 'Kementerian Haji dan Umrah Kabupaten Purbalingga — Layanan digital haji dan umrah.' }}@endif">
    <meta name="application-name" content="{{ $siteTitle ?? 'Kementerian Haji dan Umrah Kabupaten Purbalingga' }}">
    <link rel="icon" type="image/png" href="{{ $siteFavicon ?? asset('images/logo-kemenhaj.png') }}">
    <link rel="apple-touch-icon" href="{{ $siteFavicon ?? asset('images/logo-kemenhaj.png') }}">
    <meta name="hajj-waiting-period" content="{{ $waitingPeriod }}">

    <!-- Open Graph / WhatsApp / Facebook / Telegram -->
    <meta property="og:site_name" content="{{ $siteTitle ?? 'Kementerian Haji dan Umrah Kabupaten Purbalingga' }}">
    <meta property="og:type" content="@yield('ogType', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('ogTitle', $siteTitle ?? 'Kementerian Haji dan Umrah Kabupaten Purbalingga')">
    <meta property="og:description" content="@yield('ogDescription', 'Kementerian Haji dan Umrah Kabupaten Purbalingga — Layanan digital haji dan umrah.')">
    <meta property="og:image" content="@yield('ogImage', $siteFavicon ?? asset('images/logo-kemenhaj.png'))">
    <meta property="og:image:secure_url" content="@yield('ogImage', $siteFavicon ?? asset('images/logo-kemenhaj.png'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="@yield('ogTitle', $siteTitle ?? 'Kementerian Haji dan Umrah Kabupaten Purbalingga')">

    <!-- Twitter / X -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="@yield('ogTitle', $siteTitle ?? 'Kementerian Haji dan Umrah Kabupaten Purbalingga')">
    <meta name="twitter:description" content="@yield('ogDescription', 'Kementerian Haji dan Umrah Kabupaten Purbalingga — Layanan digital haji dan umrah.')">
    <meta name="twitter:image" content="@yield('ogImage', $siteFavicon ?? asset('images/logo-kemenhaj.png'))">

    @yield('meta')

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body @class(['page-home' => request()->routeIs('home')])>

    @yield('content')

    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <!-- Col 1: About & Info -->
                <div class="footer-col footer-col--about">
                    <div class="footer-brand">
                        <img src="{{ $siteFavicon }}" alt="Logo Kemenhaj" class="footer-logo">
                        <div class="footer-brand-text">
                            <h3>{{ $s['brand_line_1'] ?? 'Kementerian Haji dan Umrah' }}</h3>
                            <p>{{ $s['brand_line_2'] ?? 'Kabupaten Purbalingga' }}</p>
                        </div>
                    </div>
                    <p class="footer-desc">
                        Layanan digital resmi untuk penyelenggaraan dan pendaftaran haji serta umrah di wilayah Kabupaten Purbalingga.
                    </p>
                    <div class="footer-contact-info">
                        <a href="mailto:{{ $s['contact_email'] ?? 'seksiphupbg@gmail.com' }}" class="footer-contact-link">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                            <span>{{ $s['contact_email'] ?? 'seksiphupbg@gmail.com' }}</span>
                        </a>
                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $s['contact_phone'] ?? '082225020837') }}" target="_blank" rel="noopener noreferrer" class="footer-contact-link">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.956 1.347c-.24.338-.69.42-1.022.24a12.055 12.055 0 0 1-7.143-7.143c-.18-.332-.098-.782.24-1.022l1.347-.956c.362-.271.527-.733.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                            </svg>
                            <span>WhatsApp: {{ $s['contact_phone'] ?? '0822-2502-0837' }}</span>
                        </a>
                    </div>
                </div>

                <!-- Col 2: Services -->
                <div class="footer-col footer-col--services">
                    <h4 class="footer-title">Mall Layanan</h4>
                    <ul class="footer-links">
                        @if(!empty($footerServices) && $footerServices->count() > 0)
                            @foreach($footerServices as $service)
                                <li>
                                    <a href="{{ $service->url ?: '#' }}" @if($service->url && $service->url !== '#') target="_blank" rel="noopener noreferrer" @endif>
                                        {{ $service->title }}
                                    </a>
                                </li>
                            @endforeach
                        @else
                            <li><a href="#">Pendaftaran</a></li>
                            <li><a href="#">Pelimpahan</a></li>
                            <li><a href="#">Pembatalan</a></li>
                            <li><a href="#">Konsultasi</a></li>
                        @endif
                    </ul>
                </div>

                <!-- Col 3: Address & Social Media -->
                <div class="footer-col footer-col--info">
                    <h4 class="footer-title">Alamat & Sosial Media</h4>
                    <div class="footer-address">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        <p>{{ $s['contact_address'] ?? 'Jl. DI Panjaitan No.15, Purbalingga Lor, Kec. Purbalingga, Kabupaten Purbalingga, Jawa Tengah 53311' }}</p>
                    </div>
                    <div class="footer-socials">
                        <a href="https://instagram.com/kemenhajpurbalingga" target="_blank" rel="noopener noreferrer" class="social-btn" title="Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                            </svg>
                            <span>@kemenhajpurbalingga</span>
                        </a>
                        <a href="https://www.tiktok.com/@kemenhajpurbalingga" target="_blank" rel="noopener noreferrer" class="social-btn" title="TikTok">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.02 1.73 4.12 1.12 1.09 2.63 1.63 4.16 1.64v3.98c-1.63-.02-3.23-.48-4.59-1.39-.33-.24-.63-.51-.9-.81-.08 1.71-.16 3.42-.23 5.13-.1 1.83-.73 3.65-1.87 5.08-1.57 1.94-4.04 3.04-6.52 2.85-2.45-.19-4.73-1.66-5.83-3.89-1.35-2.73-.89-6.26 1.15-8.49 1.48-1.62 3.68-2.42 5.86-2.14V9.69c-1.23-.23-2.54.12-3.47.97-.98.9-1.29 2.37-.77 3.55.51 1.17 1.76 1.91 3.03 1.84 1.3-.07 2.41-.98 2.76-2.23.16-1.07.09-2.15.11-3.23.01-3.59.02-7.18.02-10.77z"/>
                            </svg>
                            <span>@kemenhajpurbalingga</span>
                        </a>
                    </div>
                </div>

                <!-- Col 4: Aduan -->
                <div class="footer-col footer-col--aduan">
                    <h4 class="footer-title">Aduan</h4>
                    <p class="footer-desc" style="font-size: 0.8rem; margin-bottom: 12px;">
                        Ketik laporan atau aduan Anda di bawah untuk langsung dikirim ke WhatsApp kami.
                    </p>
                    <div class="aduan-form">
                        <textarea id="aduanMessage" placeholder="Ketik aduan Anda di sini..." rows="2" class="aduan-textarea"></textarea>
                        <button id="btnAduan" class="btn-aduan">Kirim ke WhatsApp</button>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} {{ $s['site_title'] ?? 'Kementerian Haji dan Umrah Kabupaten Purbalingga' }}. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>

    @auth
        <a href="{{ route('admin.dashboard') }}" class="admin-access-btn" title="Dashboard Admin">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94(this is not modified, keeping exact source line code)..." />
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
            Login
        </a>
    @else
        <a href="{{ route('admin.login') }}" class="admin-access-btn" title="Login Admin">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
            </svg>
            Login
        </a>
    @endauth

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btnAduan = document.getElementById('btnAduan');
            const aduanMessage = document.getElementById('aduanMessage');
            if (btnAduan && aduanMessage) {
                btnAduan.addEventListener('click', function () {
                    const message = aduanMessage.value.trim();
                    if (message === '') {
                        alert('Silakan ketik aduan Anda terlebih dahulu.');
                        return;
                    }
                    const rawPhone = "{{ $s['contact_phone'] ?? '082225020837' }}";
                    const cleanPhone = rawPhone.replace(/\D/g, '');
                    let formattedPhone = cleanPhone;
                    if (cleanPhone.startsWith('0')) {
                        formattedPhone = '62' + cleanPhone.substring(1);
                    }
                    const url = `https://wa.me/${formattedPhone}?text=${encodeURIComponent(message)}`;
                    window.open(url, '_blank');
                    aduanMessage.value = '';
                });
            }
        });
    </script>

    @stack('scripts')
</body>
</html>