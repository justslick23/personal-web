<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6TN3N5VBYE"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){ dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'G-6TN3N5VBYE');
    </script>

    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('title', 'Tokelo Foso - Creative Portfolio | Web Developer & Designer')</title>
    <meta name="description" content="@yield('description', 'Tokelo Foso - Professional web developer and creative designer. Explore my portfolio of innovative web solutions, creative designs, and digital experiences.')">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <!-- Fonts & CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <!-- Critical CSS -->
    <style>
        body { font-family: 'Inter', sans-serif; margin: 0; padding: 0; }
        .site-header { position: fixed; top: 0; width: 100%; z-index: 1000; }
        .scroll-to-top {
            position: fixed; bottom: 90px; right: 20px; display: none; z-index: 999;
        }
        .scroll-to-top a {
            display: flex; align-items: center; justify-content: center;
            width: 45px; height: 45px; background: #007bff; color: #fff;
            border-radius: 50%; text-decoration: none; font-size: 18px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.3);
            transition: background 0.3s;
        }
        .scroll-to-top a:hover { background: #0056b3; }

        .whatsapp-float {
            position: fixed; bottom: 20px; right: 20px;
            width: 55px; height: 55px; background-color: #25d366; color: #fff;
            border-radius: 50%; display: flex; align-items: center;
            justify-content: center; font-size: 28px; z-index: 1000;
            box-shadow: 0 2px 6px rgba(0,0,0,0.3);
            transition: transform 0.2s;
        }
        .whatsapp-float:hover { transform: scale(1.1); }
    </style>

    @stack('head-scripts')
</head>
<body itemscope itemtype="https://schema.org/WebPage">

    <a href="#main-content" class="visually-hidden-focusable">Skip to main content</a>

    @include('partials.header')

    <main id="main-content" role="main">
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Scroll to top button -->
    <div class="scroll-to-top" aria-label="Scroll to top">
        <a href="#main-content" class="scroll-top-btn" aria-label="Scroll to top of page">
            <i class="fas fa-arrow-up" aria-hidden="true"></i>
        </a>
    </div>

    <!-- WhatsApp contact -->
    <a href="https://wa.me/26668231628" class="whatsapp-float" target="_blank" rel="noopener" aria-label="Contact via WhatsApp">
        <i class="fab fa-whatsapp" aria-hidden="true"></i>
    </a>

    <!-- Audio player -->
    <footer class="audio-player-bar fixed-bottom bg-dark text-white p-3 shadow-lg d-none" id="siteAudioPlayer">
        <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
            <div class="track-info d-flex align-items-center">
                <strong id="audioTitle" class="me-2">Now Playing:</strong>
                <span id="audioTrackName" aria-live="polite"></span>
            </div>
            <audio id="globalAudio" controls class="w-100 w-md-50" preload="none">
                <source id="audioSource" src="" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div>
    </footer>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('scripts.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Scroll to top functionality -->
    <script>
        const scrollBtn = document.querySelector('.scroll-to-top');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) scrollBtn.style.display = 'block';
            else scrollBtn.style.display = 'none';
        });
        document.querySelector('.scroll-top-btn').addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>

    @yield('scripts')
    @stack('body-scripts')
</body>
</html>
