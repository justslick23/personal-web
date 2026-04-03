<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- ── SEO ─────────────────────────────────────────── --}}
    {{-- FIX: was @endHasSection — correct closing tag is @endif --}}
    <title>@hasSection('title')@yield('title') — @endif Tokelo Foso · Designer &amp; Developer</title>
    <meta name="description" content="@yield('meta-description', 'Tokelo Foso — Creative Designer & Developer crafting digital experiences that balance aesthetics with clarity. Based in Maseru, Lesotho.')">
    <meta name="author" content="Tokelo Foso">
    <meta name="theme-color" content="#0d0d0d">

    {{-- ── Open Graph ──────────────────────────────────── --}}
    <meta property="og:type"        content="website">
    <meta property="og:title"       content="Tokelo Foso · Designer &amp; Developer">
    <meta property="og:description" content="Crafting interfaces, visuals, and digital products that balance aesthetics with clarity.">
    <meta property="og:image"       content="{{ asset('images/og-cover.jpg') }}">
    <meta property="og:url"         content="{{ url()->current() }}">
    <meta name="twitter:card"       content="summary_large_image">

    {{-- ── Favicon ─────────────────────────────────────── --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon"            href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css">
    {{-- ── Google Fonts ────────────────────────────────── --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400;1,500&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- ── Font Awesome 6 ─────────────────────────────── --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">

    {{-- ── App Stylesheet ──────────────────────────────── --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- ── Per-page head stack ────────────────────────── --}}
    @stack('head')
</head>

<body class="mn-body">

    {{-- Nav + mobile drawer --}}
    @include('partials.header')

    {{-- Main content --}}
    <main id="main-content">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    {{-- Body scripts pushed by child views (e.g. reCAPTCHA) --}}
    @include('partials.music-player')

    @stack('body-scripts')
{{-- 
  Replace the existing two <script> blocks at the bottom of app.blade.php
  (the drawer script and the theme-toggle script) with this single block.
--}}

<script>
    (function () {
        'use strict';
    
        /* ══════════════════════════════════════════════
           THEME TOGGLE
        ══════════════════════════════════════════════ */
        var currentTheme = localStorage.getItem('mn-theme') || 'dark';
    
        function applyTheme(theme) {
            document.documentElement.setAttribute('data-theme', theme);
            var icon = document.getElementById('mn-theme-icon');
            if (icon) {
                // moon = dark mode active, sun = light mode active
                icon.className = theme === 'dark' ? 'fas fa-moon' : 'fas fa-sun';
            }
            localStorage.setItem('mn-theme', theme);
            currentTheme = theme;
        }
    
        // Apply immediately (before DOM ready) to prevent flash
        applyTheme(currentTheme);
    
        // Wire up button once DOM is ready
        document.addEventListener('DOMContentLoaded', function () {
            var themeToggle = document.getElementById('mn-theme-toggle');
            if (themeToggle) {
                themeToggle.addEventListener('click', function () {
                    applyTheme(currentTheme === 'dark' ? 'light' : 'dark');
                });
            }
        });
    
        /* ══════════════════════════════════════════════
           STICKY NAV SHADOW
        ══════════════════════════════════════════════ */
        window.addEventListener('scroll', function () {
            var nav = document.getElementById('mn-nav');
            if (nav) nav.classList.toggle('scrolled', window.scrollY > 60);
        }, { passive: true });
    
        /* ══════════════════════════════════════════════
           MOBILE DRAWER
        ══════════════════════════════════════════════ */
        document.addEventListener('DOMContentLoaded', function () {
            var burger  = document.getElementById('mn-burger');
            var drawer  = document.getElementById('mn-drawer');
            var overlay = document.getElementById('mn-drawer-overlay');
            var closeBtn= document.getElementById('mn-drawer-close');
    
            function openDrawer() {
                if (!drawer) return;
                drawer.removeAttribute('hidden');
                burger && burger.setAttribute('aria-expanded', 'true');
                burger && burger.classList.add('open');
                document.body.style.overflow = 'hidden';
                // rAF so the browser registers the element before adding the class
                requestAnimationFrame(function () {
                    requestAnimationFrame(function () {
                        drawer.classList.add('is-open');
                    });
                });
            }
    
            function closeDrawer() {
                if (!drawer) return;
                drawer.classList.remove('is-open');
                burger && burger.setAttribute('aria-expanded', 'false');
                burger && burger.classList.remove('open');
                document.body.style.overflow = '';
    
                // Wait for panel slide-out transition then re-hide
                drawer.addEventListener('transitionend', function handler(e) {
                    // Only fire on the panel's transform transition, not overlay opacity
                    if (e.target === drawer.querySelector('.mn-drawer__panel')) {
                        drawer.setAttribute('hidden', '');
                        drawer.removeEventListener('transitionend', handler);
                    }
                });
            }
    
            if (burger)   burger.addEventListener('click', openDrawer);
            if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
            if (overlay)  overlay.addEventListener('click', closeDrawer);
    
            // Close on any drawer link click
            if (drawer) {
                drawer.querySelectorAll('.mn-drawer__link').forEach(function (link) {
                    link.addEventListener('click', closeDrawer);
                });
            }
    
            // Close on Escape
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    if (drawer && drawer.classList.contains('is-open')) closeDrawer();
                }
            });
    
            /* ══════════════════════════════════════════════
               SCROLL REVEAL
            ══════════════════════════════════════════════ */
            var revealObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        revealObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });
    
            document.querySelectorAll('.scroll-reveal').forEach(function (el) {
                revealObserver.observe(el);
            });
    
            /* ══════════════════════════════════════════════
               SKILL BAR ANIMATION
            ══════════════════════════════════════════════ */
            var barObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.querySelectorAll('.ab-bar__fill').forEach(function (bar) {
                            var w = bar.dataset.width;
                            setTimeout(function () { bar.style.width = w + '%'; }, 200);
                        });
                        barObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.3 });
    
            document.querySelectorAll('.ab-skill-panel').forEach(function (el) {
                barObserver.observe(el);
            });
    
            /* ══════════════════════════════════════════════
               SMOOTH ANCHOR SCROLL
            ══════════════════════════════════════════════ */
            document.querySelectorAll('a[href^="#"]').forEach(function (a) {
                a.addEventListener('click', function (e) {
                    var target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        e.preventDefault();
                        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                });
            });
    
            /* ══════════════════════════════════════════════
               CONTACT MEGA-MENU
            ══════════════════════════════════════════════ */
            var megaTrigger = document.getElementById('mn-contact-trigger');
            var megaPanel   = document.getElementById('mn-mega-panel');
    
            if (megaTrigger && megaPanel) {
                var hideTimer;
    
                function showMega() {
                    clearTimeout(hideTimer);
                    megaPanel.classList.add('is-open');
                    megaTrigger.classList.add('is-open');
                }
    
                function hideMega() {
                    hideTimer = setTimeout(function () {
                        megaPanel.classList.remove('is-open');
                        megaTrigger.classList.remove('is-open');
                    }, 120);
                }
    
                megaTrigger.addEventListener('mouseenter', showMega);
                megaTrigger.addEventListener('mouseleave', hideMega);
                megaPanel.addEventListener('mouseenter', showMega);
                megaPanel.addEventListener('mouseleave', hideMega);
    
                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape') hideMega();
                });
            }
        });
    
    })();
    </script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
    {{-- Per-page inline scripts from child views --}}
    @yield('scripts')

</body>
</html>