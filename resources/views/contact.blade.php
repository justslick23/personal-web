@extends('layouts.app')

@section('title', 'Contact — Tokelo Foso')
@section('meta-description', 'Get in touch with Tokelo Foso.')

@section('content')

<header class="mn-page-header mn-page-header--contact">
    <div class="mn-page-header__blobs">
        <div class="mn-page-header__blob mn-page-header__blob--1"></div>
        <div class="mn-page-header__blob mn-page-header__blob--2"></div>
        <div class="mn-page-header__blob mn-page-header__blob--3"></div>
    </div>
    <div class="mn-page-header__noise"></div>
    <div class="mn-page-header__content">
        <h1 class="mn-page-header__title">Contact</h1>
        <p class="mn-page-header__subtitle">Have something to say? I'm listening.</p>
        <nav class="mn-page-header__breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <i class="fas fa-chevron-right"></i>
            <span class="current">Contact</span>
        </nav>
    </div>
</header>

<section class="ct-section">
    <div class="mn-container">
        <div class="ct-grid">

            {{-- LEFT: Map + Card --}}
            <div class="ct-map-wrapper scroll-reveal">
                <div class="ct-map-frame">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d27624.38093505!2d27.4673!3d-29.3167!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1e8c1a4c0a0b0b0b%3A0x0!2sMaseru%2C+Lesotho!5e0!3m2!1sen!2s!4v1700000000000"
                        allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Maseru, Lesotho">
                    </iframe>
                </div>
                <div class="ct-intro-card">
                    <p class="ct-intro-card__headline">Drop me a message</p>
                    <p class="ct-intro-card__body">
                        Whether it's about a project, a question, or just to say hi —
                        fill in the form and I'll get back to you when I can.
                    </p>
                    <div class="ct-intro-card__socials">
                        <a href="https://web.facebook.com/tokelo.foso" class="ct-intro-card__social" aria-label="Facebook" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.linkedin.com/in/tokelo-foso/" class="ct-intro-card__social" aria-label="LinkedIn" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://soundcloud.com/justslick23" class="ct-intro-card__social" aria-label="SoundCloud" target="_blank" rel="noopener"><i class="fab fa-soundcloud"></i></a>
                        <a href="https://www.instagram.com/slkstrgrm/" class="ct-intro-card__social" aria-label="Instagram" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>
                        <a href="https://x.com/slkstr_" class="ct-intro-card__social" aria-label="X" target="_blank" rel="noopener"><i class="fab fa-x-twitter"></i></a>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Form --}}
            <div class="ct-form-wrapper scroll-reveal scroll-reveal-delay-1">
                <div class="ct-form-heading">
                    <span class="t-eyebrow">Get In Touch</span>
                    <h2>Send me a <em>message</em></h2>
                </div>

                @if(session('success'))
                    <div class="ct-alert ct-alert--success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="ct-alert ct-alert--error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ session('error') }}
                    </div>
                @endif

                <form class="ct-form" action="{{ route('contact.submit') }}" method="POST" novalidate>
                    @csrf
                    <div class="ct-form-row">
                        <div class="ct-form-group">
                            <label class="ct-form-label" for="first_name">First name <span style="color:var(--clr-accent)">*</span></label>
                            <input class="mn-form__input @error('first_name') border-red @enderror"
                                   type="text" id="first_name" name="first_name"
                                   placeholder="First name" value="{{ old('first_name') }}" required>
                            @error('first_name')<span style="font-size:0.75rem;color:#ff5050;">{{ $message }}</span>@enderror
                        </div>
                        <div class="ct-form-group">
                            <label class="ct-form-label" for="last_name">Last name <span style="color:var(--clr-accent)">*</span></label>
                            <input class="mn-form__input @error('last_name') border-red @enderror"
                                   type="text" id="last_name" name="last_name"
                                   placeholder="Last name" value="{{ old('last_name') }}" required>
                            @error('last_name')<span style="font-size:0.75rem;color:#ff5050;">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="ct-form-group">
                        <label class="ct-form-label" for="email">Email <span style="color:var(--clr-accent)">*</span></label>
                        <input class="mn-form__input @error('email') border-red @enderror"
                               type="email" id="email" name="email"
                               placeholder="your@email.com" value="{{ old('email') }}" required>
                        @error('email')<span style="font-size:0.75rem;color:#ff5050;">{{ $message }}</span>@enderror
                    </div>
                    <div class="ct-form-group">
                        <label class="ct-form-label" for="message">Message <span style="color:var(--clr-accent)">*</span></label>
                        <textarea class="mn-form__textarea @error('message') border-red @enderror"
                                  id="message" name="message"
                                  placeholder="What's on your mind?" rows="5"
                                  required>{{ old('message') }}</textarea>
                        @error('message')<span style="font-size:0.75rem;color:#ff5050;">{{ $message }}</span>@enderror
                    </div>
                    <button type="submit" class="ct-submit-btn">
                        <i class="fas fa-paper-plane"></i>
                        Send Message
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

<div class="ct-strip">
    <div class="mn-container">
        <div class="ct-strip-grid">
            <div class="ct-strip-item scroll-reveal">
                <div class="ct-strip-icon"><i class="fas fa-phone"></i></div>
                <span class="ct-strip-label">Phone</span>
                <span class="ct-strip-val">(+266) 6823 1628</span>
            </div>
            <div class="ct-strip-item scroll-reveal scroll-reveal-delay-1">
                <div class="ct-strip-icon"><i class="fas fa-envelope"></i></div>
                <span class="ct-strip-label">Email</span>
                <span class="ct-strip-val">hello@tokelofoso.online</span>
            </div>
            <div class="ct-strip-item scroll-reveal scroll-reveal-delay-2">
                <div class="ct-strip-icon"><i class="fas fa-map-marker-alt"></i></div>
                <span class="ct-strip-label">Location</span>
                <span class="ct-strip-val">Maseru, Lesotho</span>
            </div>
            <div class="ct-strip-item scroll-reveal scroll-reveal-delay-3">
                <div class="ct-strip-icon"><i class="fas fa-clock"></i></div>
                <span class="ct-strip-label">Working Hours</span>
                <span class="ct-strip-val">Mon–Fri, 08:00–17:00 (CAT)</span>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
(function () {
    'use strict';
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                revealObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });
    document.querySelectorAll('.scroll-reveal').forEach(el => revealObserver.observe(el));

    const textarea = document.getElementById('message');
    if (textarea) {
        textarea.addEventListener('input', function () {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    }
})();
</script>
@endsection