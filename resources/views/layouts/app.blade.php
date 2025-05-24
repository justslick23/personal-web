<!DOCTYPE html>
<html lang="en">
<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6TN3N5VBYE"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-6TN3N5VBYE');
    </script>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tokelo Foso - Creative Portfolio Website')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup/1.1.0/magnific-popup.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    @yield('styles')
</head>
<body>
    @include('partials.header')
    
    <main>
        @yield('content')
    </main>
    
    @include('partials.footer')
    
    <div class="scroll-to-top">
        <a href="#hero" class="scroll-top-btn"><i class="fas fa-arrow-up"></i></a>
    </div>

    <a href="https://wa.me/26668231628" class="whatsapp-float" target="_blank" aria-label="Chat on WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <footer class="audio-player-bar fixed-bottom bg-dark text-white p-3 shadow-lg d-none" id="siteAudioPlayer">
        <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
            <div class="track-info d-flex align-items-center">
                <strong id="audioTitle" class="me-2">Now Playing:</strong>
                <span id="audioTrackName"></span>
            </div>
            <audio id="globalAudio" controls class="w-100 w-md-50">
                <source id="audioSource" src="" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script> <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/isotope/3.0.6/isotope.pkgd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imagesloaded/4.1.4/imagesloaded.pkgd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script> <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100 // Adjust offset as needed
        });

        // Initialize Swiper (ensure you have a .swiper-container in your HTML for this to work)
        // If you don't have a Swiper element, this code will just run without effect.
        if (document.querySelector('.swiper-container')) {
            const swiper = new Swiper('.swiper-container', {
                loop: true,
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

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Scroll progress indicator (assuming you have a .scroll-progress element)
        window.addEventListener('scroll', function() {
            const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
            const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrollProgressElement = document.querySelector('.scroll-progress');
            if (scrollProgressElement) {
                const scrollProgress = (scrollTop / scrollHeight) * 100;
                scrollProgressElement.style.width = scrollProgress + '%';
            }
            
            // Navbar effect (assuming .site-header exists)
            const siteHeader = document.querySelector('.site-header');
            if (siteHeader) {
                if (scrollTop > 100) {
                    siteHeader.classList.add('scrolled');
                } else {
                    siteHeader.classList.remove('scrolled');
                }
            }
            
            // Scroll-to-top button
            const scrollTopButton = document.querySelector('.scroll-to-top'); // Target the container
            if (scrollTopButton) {
                if (scrollTop > 300) {
                    scrollTopButton.classList.add('active');
                } else {
                    scrollTopButton.classList.remove('active');
                }
            }
        });

        // Scroll-to-top button functionality (using the corrected selector)
        document.querySelector('.scroll-to-top .scroll-top-btn').addEventListener('click', (e) => {
            e.preventDefault(); // Prevent default anchor behavior
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Intersection Observer for sections
        const sections = document.querySelectorAll('.section');
        const skillItems = document.querySelectorAll('.skill-item');
        const timelineBlocks = document.querySelectorAll('.timeline-block');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                }
            });
        }, { threshold: 0.1 });

        sections.forEach(section => observer.observe(section));

        // Skills animation
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

        document.querySelectorAll('.skills-list').forEach(list => skillsObserver.observe(list));

        // Timeline animation
        timelineBlocks.forEach((block, index) => {
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
            globalAudio.play();
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

        document.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme') || 'dark';
            document.body.classList.add(`${savedTheme}-theme`);
            const themeIcon = document.getElementById('theme-icon');
            if (themeIcon) {
                themeIcon.textContent = savedTheme === 'dark' ? '🌙' : '🌞';
            }
        });
    </script>
    
    <style>
        /* Floating WhatsApp Button */
.whatsapp-float {
    position: fixed;
    width: 60px;
    height: 60px;
    bottom: 40px; /* Adjust as needed */
    right: 40px; /* Adjust as needed */
    background-color: #25d366; /* WhatsApp green */
    color: #FFF;
    border-radius: 50px;
    text-align: center;
    font-size: 30px;
    box-shadow: 2px 2px 3px rgba(0,0,0,0.4);
    z-index: 1000; /* Ensure it's above other content */
    display: flex;
    justify-content: center;
    align-items: center;
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.whatsapp-float:hover {
    color: #FFF; /* Keep color white on hover */
    transform: scale(1.1); /* Slightly enlarge on hover */
    box-shadow: 0 0 15px rgba(37,211,102,0.7); /* Green glow */
}

/* Ensure Font Awesome is correctly linked and icons display */
.whatsapp-float i {
    margin-top: 0; /* Adjust icon vertical alignment if needed */
}

/* Basic styling for scroll-to-top button, similar to WhatsApp button */
.scroll-to-top {
    position: fixed;
    bottom: 110px; /* Position above WhatsApp button */
    right: 40px;
    z-index: 999; /* Slightly lower z-index than WhatsApp */
    opacity: 0; /* Hidden by default */
    visibility: hidden;
    transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
}

.scroll-to-top.active {
    opacity: 1;
    visibility: visible;
}

.scroll-top-btn {
    width: 50px; /* Slightly smaller than WhatsApp */
    height: 50px;
    background-color: var(--primary, #007bff); /* Use your primary color or a default */
    color: #FFF;
    border-radius: 50px;
    text-align: center;
    font-size: 22px;
    box-shadow: 2px 2px 3px rgba(0,0,0,0.4);
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    transition: transform 0.3s ease-in-out, background-color 0.3s ease-in-out;
}

.scroll-top-btn:hover {
    background-color: var(--primary-dark, #0056b3); /* Darker shade of primary on hover */
    transform: scale(1.1);
    color: #FFF;
}
    </style>
    @yield('scripts')
</body>
</html>