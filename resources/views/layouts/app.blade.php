<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6TN3N5VBYE"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-6TN3N5VBYE');
    </script>
    
    <!-- Essential Meta Tags -->
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- SEO Meta Tags -->
    <title>@yield('title', 'Tokelo Foso - Creative Portfolio | Web Developer & Designer')</title>
    <meta name="description" content="@yield('description', 'Tokelo Foso - Professional web developer and creative designer. Explore my portfolio of innovative web solutions, creative designs, and digital experiences.')">
    <meta name="keywords" content="@yield('keywords', 'Tokelo Foso, web developer, creative designer, portfolio, web design, frontend developer, UI/UX designer')">
    <meta name="author" content="Tokelo Foso">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="language" content="English">
    <meta name="revisit-after" content="7 days">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="@yield('canonical', url()->current())">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('og_title', 'Tokelo Foso - Creative Portfolio | Web Developer & Designer')">
    <meta property="og:description" content="@yield('og_description', 'Professional web developer and creative designer. Explore my portfolio of innovative web solutions and creative designs.')">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:site_name" content="Tokelo Foso Portfolio">
    <meta property="og:image" content="@yield('og_image', asset('images/tokelo-foso-og-image.jpg'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Tokelo Foso - Creative Portfolio">
    <meta property="og:locale" content="en_US">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'Tokelo Foso - Creative Portfolio | Web Developer & Designer')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Professional web developer and creative designer. Explore my portfolio of innovative web solutions.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/tokelo-foso-twitter-card.jpg'))">
    <meta name="twitter:image:alt" content="Tokelo Foso Portfolio">
    <meta name="twitter:site" content="@tokelofoso">
    <meta name="twitter:creator" content="@tokelofoso">
    
    <!-- Favicon and Icons -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    
    <!-- Preconnect to External Domains -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    
    <!-- DNS Prefetch -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="//cdn.jsdelivr.net">
    
    <!-- Fonts with font-display optimization -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Critical CSS should be inlined here for better performance -->
    <style>
        /* Critical CSS - inline the most important styles */
        body { font-family: 'Inter', sans-serif; margin: 0; padding: 0; }
        .site-header { position: fixed; top: 0; width: 100%; z-index: 1000; }
        /* Add other critical styles here */
    </style>

    <!-- Non-critical CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup/1.1.0/magnific-popup.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    <!-- Structured Data - JSON-LD -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Person",
        "name": "Tokelo Foso",
        "jobTitle": "Web Developer & Creative Designer",
        "url": "{{ url('/') }}",
        "sameAs": [
            "https://linkedin.com/in/tokelofoso",
            "https://github.com/tokelofoso",
            "https://twitter.com/tokelofoso"
        ],
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "Maseru",
            "addressCountry": "Lesotho"
        },
        "knowsAbout": [
            "Web Development",
            "Frontend Development",
            "UI/UX Design",
            "Creative Design",
            "JavaScript",
            "HTML",
            "CSS"
        ]
    }
    </script>
    
    <!-- Additional Structured Data for Portfolio -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "Tokelo Foso Portfolio",
        "url": "{{ url('/') }}",
        "description": "Professional portfolio showcasing web development and creative design work",
        "author": {
            "@type": "Person",
            "name": "Tokelo Foso"
        },
        "potentialAction": {
            "@type": "SearchAction",
            "target": "{{ url('/') }}?search={search_term_string}",
            "query-input": "required name=search_term_string"
        }
    }
    </script>
    
    @yield('styles')
    @stack('head-scripts')
</head>
<body itemscope itemtype="https://schema.org/WebPage">
    <!-- Skip to main content for accessibility -->
    <a href="#main-content" class="sr-only sr-only-focusable">Skip to main content</a>
    
    @include('partials.header')
    
    <main id="main-content" role="main">
        @yield('content')
    </main>
    
    @include('partials.footer')
    
    <!-- Scroll to top button with proper accessibility -->
    <div class="scroll-to-top" aria-label="Scroll to top">
        <a href="#hero" class="scroll-top-btn" aria-label="Scroll to top of page">
            <i class="fas fa-arrow-up" aria-hidden="true"></i>
        </a>
    </div>

    <!-- WhatsApp contact button -->
    <a href="https://wa.me/26668231628" class="whatsapp-float" target="_blank" rel="noopener noreferrer" aria-label="Contact via WhatsApp">
        <i class="fab fa-whatsapp" aria-hidden="true"></i>
    </a>

    <!-- Audio player with proper accessibility -->
    <footer class="audio-player-bar fixed-bottom bg-dark text-white p-3 shadow-lg d-none" id="siteAudioPlayer" role="contentinfo">
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

    <!-- Scripts with proper loading optimization -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup/1.1.0/jquery.magnific-popup.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/isotope/3.0.6/isotope.pkgd.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imagesloaded/4.1.4/imagesloaded.pkgd.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script>
        // Optimized initialization with proper loading
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS with better performance
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    easing: 'ease-in-out',
                    once: true,
                    offset: 100,
                    disable: window.innerWidth < 768 // Disable on mobile for performance
                });
            }

            // Initialize Swiper with lazy loading
            if (document.querySelector('.swiper-container') && typeof Swiper !== 'undefined') {
                const swiper = new Swiper('.swiper-container', {
                    loop: true,
                    lazy: true,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                });
            }

            // Theme initialization
            const savedTheme = localStorage.getItem('theme') || 'dark';
            document.body.classList.add(`${savedTheme}-theme`);
            const themeIcon = document.getElementById('theme-icon');
            if (themeIcon) {
                themeIcon.textContent = savedTheme === 'dark' ? '🌙' : '🌞';
            }
        });

        // Optimized smooth scrolling
        document.addEventListener('click', function(e) {
            if (e.target.matches('a[href^="#"]')) {
                e.preventDefault();
                const target = document.querySelector(e.target.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });

        // Throttled scroll handler for better performance
        let ticking = false;
        function updateScrollElements() {
            const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
            const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            
            // Scroll progress
            const scrollProgressElement = document.querySelector('.scroll-progress');
            if (scrollProgressElement) {
                const scrollProgress = (scrollTop / scrollHeight) * 100;
                scrollProgressElement.style.width = scrollProgress + '%';
            }
            
            // Navbar effect
            const siteHeader = document.querySelector('.site-header');
            if (siteHeader) {
                siteHeader.classList.toggle('scrolled', scrollTop > 100);
            }
            
            // Scroll-to-top button
            const scrollTopButton = document.querySelector('.scroll-to-top');
            if (scrollTopButton) {
                scrollTopButton.classList.toggle('active', scrollTop > 300);
            }
            
            ticking = false;
        }

        window.addEventListener('scroll', function() {
            if (!ticking) {
                requestAnimationFrame(updateScrollElements);
                ticking = true;
            }
        }, { passive: true });

        // Scroll-to-top functionality
        const scrollTopBtn = document.querySelector('.scroll-to-top .scroll-top-btn');
        if (scrollTopBtn) {
            scrollTopBtn.addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }

        // Intersection Observer for animations
        const observerOptions = { 
            threshold: 0.1, 
            rootMargin: '0px 0px -50px 0px' 
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                }
            });
        }, observerOptions);

        // Observe sections
        document.querySelectorAll('.section').forEach(section => {
            observer.observe(section);
        });

        // Skills animation with performance optimization
        const skillsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const items = entry.target.querySelectorAll('.skill-item');
                    items.forEach((item, index) => {
                        setTimeout(() => {
                            item.classList.add('animate');
                        }, index * 100);
                    });
                }
            });
        }, { threshold: 0.2 });

        document.querySelectorAll('.skills-list').forEach(list => {
            skillsObserver.observe(list);
        });

        // Timeline animation
        document.querySelectorAll('.timeline-block').forEach((block, index) => {
            observer.observe(block);
            block.style.transitionDelay = `${index * 0.1}s`;
        });

        // Global Audio Player functions
        function playGlobalAudio(title, url) {
            const audioBar = document.getElementById('siteAudioPlayer');
            const audioTitle = document.getElementById('audioTitle');
            const audioTrackName = document.getElementById('audioTrackName');
            const audioSource = document.getElementById('audioSource');
            const globalAudio = document.getElementById('globalAudio');

            audioTitle.textContent = "Now Playing:";
            audioTrackName.textContent = title;
            audioSource.src = url;
            globalAudio.load();
            globalAudio.play().catch(e => console.log('Audio playback failed:', e));
            audioBar.classList.remove('d-none');
        }

        // Theme Toggle functionality
        function toggleTheme() {
            const body = document.body;
            const icon = document.getElementById('theme-icon');
            if (body.classList.contains('dark-theme')) {
                body.classList.replace('dark-theme', 'light-theme');
                localStorage.setItem('theme', 'light');
                if (icon) icon.textContent = '🌞';
            } else {
                body.classList.replace('light-theme', 'dark-theme');
                localStorage.setItem('theme', 'dark');
                if (icon) icon.textContent = '🌙';
            }
        }

        // Service Worker registration for PWA (optional)
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/sw.js').then(function(registration) {
                    console.log('SW registered: ', registration);
                }).catch(function(registrationError) {
                    console.log('SW registration failed: ', registrationError);
                });
            });
        }
    </script>
    
    <style>
        /* Enhanced CSS with performance optimizations */
        
        /* Critical CSS should be moved to inline styles in head */
        
        /* Floating WhatsApp Button */
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            will-change: transform;
        }

        .whatsapp-float:hover {
            color: #FFF;
            transform: scale(1.1);
            box-shadow: 0 0 20px rgba(37,211,102,0.8);
        }

        .whatsapp-float:focus {
            outline: 2px solid #25d366;
            outline-offset: 2px;
        }

        /* Scroll to top button */
        .scroll-to-top {
            position: fixed;
            bottom: 110px;
            right: 40px;
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
        }

        .scroll-to-top.active {
            opacity: 1;
            visibility: visible;
        }

        .scroll-top-btn {
            width: 50px;
            height: 50px;
            background-color: var(--primary-color, #007bff);
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 22px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            transition: transform 0.3s ease-in-out, background-color 0.3s ease-in-out;
            will-change: transform;
        }

        .scroll-top-btn:hover {
            background-color: var(--primary-dark, #0056b3);
            transform: scale(1.1);
            color: #FFF;
        }

        .scroll-top-btn:focus {
            outline: 2px solid var(--primary-color, #007bff);
            outline-offset: 2px;
        }

        /* Accessibility improvements */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        .sr-only-focusable:active,
        .sr-only-focusable:focus {
            position: static;
            width: auto;
            height: auto;
            overflow: visible;
            clip: auto;
            white-space: normal;
        }

        /* Performance optimizations */
        * {
            box-sizing: border-box;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        /* Reduce motion for accessibility */
        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* Dark/Light theme base styles */
        .light-theme {
            --bg-color: #ffffff;
            --text-color: #333333;
            --primary-color: #007bff;
        }

        .dark-theme {
            --bg-color: #1a1a1a;
            --text-color: #ffffff;
            --primary-color: #0d6efd;
        }
    </style>
    
    @yield('scripts')
    @stack('body-scripts')
</body>
</html>