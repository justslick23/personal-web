@extends('layouts.app')

@section('content')

{{-- =============================================
     HERO SECTION
============================================== --}}
<section class="mn-hero mn-grain">

    <div class="mn-hero__bg">
        <div class="mn-hero__bg-noise"></div>
        <div class="mn-hero__bg-glow"></div>
    </div>

    <div class="mn-hero__tag">
        <div class="mn-hero__tag-dot"></div>
        <span class="mn-hero__tag-text">Maseru, Lesotho</span>
    </div>

    <div class="mn-hero__content">

        <div class="mn-hero__label">
            <span class="t-eyebrow">Developer &amp; Graphic Designer</span>
        </div>

        <h1 class="mn-hero__headline">
            I build things<br>
            for the <em>web</em> and<br>
            make them <span class="outline">look good</span>
        </h1>

        <div class="mn-hero__bottom">
         

            <div class="mn-hero__meta">
                <a href="#portfolio" class="mn-btn mn-btn--primary">
                    <i class="fas fa-arrow-down"></i>
                    See My Work
                </a>
                <a href="#contact" class="mn-btn mn-btn--outline">
                    Say Hello
                    <i class="fas fa-arrow-right"></i>
                </a>

                <div class="mn-hero__scroll" onclick="document.getElementById('about').scrollIntoView({behavior:'smooth'})">
                    <div class="mn-hero__scroll-line"></div>
                    <span class="mn-hero__scroll-label">Scroll</span>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- =============================================
     STATS STRIP
============================================== --}}
<div class="mn-stats">
    <div class="mn-stat">
        <span class="mn-stat__num"><span class="counter-value" data-count="50">0</span><sup>+</sup></span>
        <span class="mn-stat__label">Projects Done</span>
    </div>
    <div class="mn-stat">
        <span class="mn-stat__num"><span class="counter-value" data-count="5">0</span><sup>+</sup></span>
        <span class="mn-stat__label">Years Working</span>
    </div>
    <div class="mn-stat">
        <span class="mn-stat__num"><span class="counter-value" data-count="25">0</span><sup>+</sup></span>
        <span class="mn-stat__label">Clients Helped</span>
    </div>
</div>

{{-- =============================================
     ABOUT SECTION
============================================== --}}
<section id="about" class="mn-section mn-section--alt mn-grain">
    <div class="mn-container">

        <div class="mn-about">

            <div class="mn-about__visual" data-aos="fade-right">
                <div class="mn-about__img-wrap">
                    <img src="{{ asset('images/Myself.jpg') }}"
                         alt="Tokelo Foso"
                         onerror="this.src='https://ui-avatars.com/api/?name=Tokelo+Foso&size=600&background=1c1c1c&color=00e676&bold=true&format=svg'">
                    <div class="mn-about__img-label">
                        <span class="mn-about__img-dot"></span>
                        <span class="t-eyebrow" style="color:var(--clr-text)">Tokelo Foso</span>
                    </div>
                </div>
            </div>

            <div class="mn-about__text" data-aos="fade-left">
                <span class="t-eyebrow" style="display:flex;align-items:center;gap:.75rem;margin-bottom:1.5rem">
                    <i class="fas fa-circle" style="font-size:.4rem;color:var(--clr-accent)"></i>
                    A bit about me
                </span>

                <h2>
                    I'm <em>Tokelo</em> — I write<br>
                    code and design the<br>
                    things around it.
                </h2>

                <p>
                    I work as a developer and designer at Computer Business Solutions in Maseru.
                    Day to day that means building web apps in Laravel, designing interfaces in
                    Figma, and making sure the two ends up feeling like one thing rather than two.
                </p>
                <p>
                    Having both skills means I don't have to hand a design off to someone else
                    and hope it comes back intact — I build what I design.
                </p>

                <div class="mn-about__info">
                    <div class="mn-about__info-item">
                        <div class="mn-about__info-label">Experience</div>
                        <div class="mn-about__info-val">5+ Years</div>
                    </div>
                    <div class="mn-about__info-item">
                        <div class="mn-about__info-label">Location</div>
                        <div class="mn-about__info-val">Maseru, Lesotho</div>
                    </div>
                    <div class="mn-about__info-item">
                        <div class="mn-about__info-label">Role</div>
                        <div class="mn-about__info-val">Software Developer</div>
                    </div>
                    <div class="mn-about__info-item">
                        <div class="mn-about__info-label">Focus</div>
                        <div class="mn-about__info-val">Web Dev &amp; Design</div>
                    </div>
                </div>

                <div class="mn-about__actions">
                    <a href="{{ route('download.cv') }}" class="mn-btn mn-btn--primary" target="_blank">
                        <i class="fas fa-download"></i>
                        Download CV
                    </a>
                    <a href="#contact" class="mn-btn mn-btn--outline">
                        Get In Touch
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- =============================================
     SKILLS SECTION
============================================== --}}
<section class="mn-section mn-grain">
    <div class="mn-container">

        <div class="mn-section-header" data-aos="fade-up">
            <div>
                <span class="t-eyebrow" style="margin-bottom:.75rem;display:block">What I Work With</span>
                <h2 class="mn-section-title">Tools &amp; Tech<br>I Use <em>Daily</em></h2>
            </div>
            <a href="#portfolio" class="mn-section-link">See my work</a>
        </div>

        @php
        $skills = [
            ['name' => 'HTML5',      'icon' => 'fab fa-html5'],
            ['name' => 'CSS3',       'icon' => 'fab fa-css3-alt'],
            ['name' => 'JavaScript', 'icon' => 'fab fa-js-square'],
            ['name' => 'React',      'icon' => 'fab fa-react'],
            ['name' => 'PHP',        'icon' => 'fab fa-php'],
            ['name' => 'Laravel',    'icon' => 'fab fa-laravel'],
            ['name' => 'Adobe CC',   'icon' => 'fas fa-palette'],
            ['name' => 'Figma',      'icon' => 'fas fa-pen-nib'],
        ];
        @endphp

        <div class="mn-skills-grid" data-aos="fade-up" data-aos-delay="100">
            @foreach($skills as $skill)
            <div class="mn-skill-item">
                <i class="{{ $skill['icon'] }} mn-skill-icon"></i>
                <span class="mn-skill-name">{{ $skill['name'] }}</span>
            </div>
            @endforeach
        </div>

    </div>
</section>
{{-- =============================================
     PORTFOLIO SECTION
============================================== --}}
<section id="portfolio" class="mn-section mn-section--alt mn-grain">
    <div class="mn-container">

        <div class="mn-section-header" data-aos="fade-up">
            <div>
                <span class="t-eyebrow" style="margin-bottom:.75rem;display:block">Work</span>
                <h2 class="mn-section-title">Some Things<br>I've <em>Built</em></h2>
                <p style="color:var(--clr-text-muted);margin-top:.75rem;max-width:420px">
                    A mix of web apps, design work, and the odd side project.
                </p>
            </div>
            @if($portfolioItems->isNotEmpty())
                <a href="{{ route('portfolio') }}" class="mn-section-link">All projects</a>
            @endif
        </div>

        <div class="mn-portfolio-filters" data-aos="fade-up">
            <button class="mn-filter-btn active" data-filter="all">Everything</button>
            <button class="mn-filter-btn" data-filter="Graphic Design">Graphic Design</button>
            <button class="mn-filter-btn" data-filter="Software Dev">Software Dev</button>
        </div>

        @if($portfolioItems->isNotEmpty())
        <div class="mn-portfolio-grid" data-aos="fade-up">
            @foreach($portfolioItems as $item)
            @php
                $fallback  = 'https://placehold.co/800x600/161616/00e676?text=' . urlencode($item->title ?? 'Project') . '&font=raleway';
                $imagePath = $item->image
                    ? asset('storage/' . $item->image)
                    : $fallback;
            @endphp
            <div class="mn-portfolio-card" data-category="{{ $item->category ?? 'uncategorized' }}">
                <a href="{{ $imagePath }}"
                   data-lightbox="portfolio"
                   data-title="{{ $item->title ?? '' }}{{ $item->category ? ' — ' . $item->category : '' }}"
                   class="mn-portfolio-card__lightbox-trigger">
                    <img src="{{ $imagePath }}"
                         alt="{{ $item->title ?? 'Portfolio Item' }}"
                         onerror="this.onerror=null;this.src='{{ $fallback }}'">
                    <div class="mn-portfolio-card__overlay">
                        <span class="mn-portfolio-card__cat">{{ $item->category ?? 'Design' }}</span>
                        <h5 class="mn-portfolio-card__title">{{ $item->title ?? 'Untitled' }}</h5>
                        <span class="mn-portfolio-card__zoom">
                            <i class="fas fa-expand"></i> View
                        </span>
                    </div>
                </a>
                @if(!empty($item->link))
                    <a href="{{ $item->link }}" class="mn-portfolio-card__ext-link" target="_blank" rel="noopener">
                        Visit Project <i class="fas fa-arrow-up-right-from-square"></i>
                    </a>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <div style="text-align:center;padding:6rem 2rem" data-aos="fade-up">
            <i class="fas fa-folder-open" style="font-size:3rem;color:var(--clr-text-dim);margin-bottom:1.5rem;display:block"></i>
            <h4 style="font-family:var(--font-serif);font-size:1.75rem;font-weight:300;color:var(--clr-text);margin-bottom:.75rem">Nothing here yet</h4>
            <p style="color:var(--clr-text-muted)">Projects are on the way — check back soon.</p>
        </div>
        @endif

    </div>
</section>

{{-- =============================================
     CONTACT SECTION
============================================== --}}
<section id="contact" class="mn-section mn-grain">
    <div class="mn-container">

        <div class="mn-contact">

            <div data-aos="fade-right">
                <span class="t-eyebrow" style="display:flex;align-items:center;gap:.75rem;margin-bottom:1.5rem">
                    <i class="fas fa-circle" style="font-size:.4rem;color:var(--clr-accent)"></i>
                    Get In Touch
                </span>

                <h2 style="font-family:var(--font-serif);font-size:clamp(2.5rem,5vw,4rem);font-weight:300;line-height:1.05;letter-spacing:-0.02em;color:var(--clr-text);margin-bottom:1.5rem">
                    Have something<br>
                    to <em style="font-style:italic;color:var(--clr-accent)">talk about?</em>
                </h2>

                <p style="font-size:1rem;line-height:1.75;color:var(--clr-text-muted);margin-bottom:3rem">
                    Whether it's a question, a project idea, or just a hello —
                    drop me a message and I'll get back to you.
                </p>

                <div class="mn-contact__links">
                    <a href="mailto:hello@tokelofoso.online" class="mn-contact__link">
                        <div class="mn-contact__link-icon"><i class="fas fa-envelope"></i></div>
                        <div>
                            <div class="mn-contact__link-label">Email</div>
                            <div class="mn-contact__link-val">hello@tokelofoso.online</div>
                        </div>
                    </a>
                    <a href="tel:+26668231628" class="mn-contact__link">
                        <div class="mn-contact__link-icon"><i class="fas fa-phone"></i></div>
                        <div>
                            <div class="mn-contact__link-label">Phone</div>
                            <div class="mn-contact__link-val">(+266) 6823 1628</div>
                        </div>
                    </a>
                    <div class="mn-contact__link">
                        <div class="mn-contact__link-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <div class="mn-contact__link-label">Location</div>
                            <div class="mn-contact__link-val">Ha Matala Phase 2, Maseru</div>
                        </div>
                    </div>
                </div>
            </div>

            <div data-aos="fade-left">

                @if(session('success'))
                    <div class="mn-alert mn-alert--success">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mn-alert mn-alert--error">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST" class="mn-form">
                    @csrf
                    <div class="mn-form__row">
                        <div class="mn-form__group">
                            <label class="mn-form__label" for="name">Your Name</label>
                            <input class="mn-form__input" type="text" name="name" id="name"
                                   placeholder="John Doe" value="{{ old('name') }}" required>
                        </div>
                        <div class="mn-form__group">
                            <label class="mn-form__label" for="email">Your Email</label>
                            <input class="mn-form__input" type="email" name="email" id="email"
                                   placeholder="john@example.com" value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="mn-form__group">
                        <label class="mn-form__label" for="message">Your Message</label>
                        <textarea class="mn-form__textarea" name="message" id="message"
                                  rows="7" placeholder="What's on your mind?"
                                  required>{{ old('message') }}</textarea>
                    </div>
                    <div class="mn-form__group">
                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                    </div>
                    <button type="submit" class="mn-btn mn-btn--primary mn-form__submit">
                        <i class="fas fa-paper-plane"></i>
                        Send Message
                    </button>
                </form>
            </div>

        </div>

        <div class="mn-contact-strip">
            <div class="mn-contact-strip__item">
                <i class="fas fa-phone mn-contact-strip__icon"></i>
                <span class="mn-contact-strip__label">Phone</span>
                <span class="mn-contact-strip__val">(+266) 6823 1628</span>
            </div>
            <div class="mn-contact-strip__item">
                <i class="fas fa-envelope mn-contact-strip__icon"></i>
                <span class="mn-contact-strip__label">Email</span>
                <span class="mn-contact-strip__val">hello@tokelofoso.online</span>
            </div>
            <div class="mn-contact-strip__item">
                <i class="fas fa-map-marker-alt mn-contact-strip__icon"></i>
                <span class="mn-contact-strip__label">Location</span>
                <span class="mn-contact-strip__val">Maseru, Lesotho</span>
            </div>
            <div class="mn-contact-strip__item">
                <i class="fas fa-clock mn-contact-strip__icon"></i>
                <span class="mn-contact-strip__label">Working Hours</span>
                <span class="mn-contact-strip__val">Mon–Fri, 08:00–17:00 (CAT)</span>
            </div>
        </div>

    </div>
</section>

@endsection

@push('body-scripts')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush

@section('scripts')
<script>
(function () {
    'use strict';

    document.readyState === 'loading'
        ? document.addEventListener('DOMContentLoaded', init)
        : init();

    function init() {
        initPortfolioFilter();
        initCounters();
        initScrollReveal();
    }

    function initPortfolioFilter() {
        const btns  = document.querySelectorAll('.mn-filter-btn');
        const cards = document.querySelectorAll('.mn-portfolio-card');
        if (!btns.length || !cards.length) return;

        btns.forEach(btn => {
            btn.addEventListener('click', function () {
                btns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                const filter = this.dataset.filter;
                cards.forEach(card => {
                    const show = filter === 'all' || card.dataset.category === filter;
                    if (show) {
                        card.style.display = '';
                        requestAnimationFrame(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        });
                    } else {
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(16px)';
                        setTimeout(() => { card.style.display = 'none'; }, 350);
                    }
                });
            });
        });
    }

    function initCounters() {
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;
                const el     = entry.target;
                const target = parseInt(el.dataset.count, 10);
                if (isNaN(target)) return;
                let current = 0;
                const step  = target / 60;
                const timer = setInterval(() => {
                    current = Math.min(current + step, target);
                    el.textContent = Math.floor(current);
                    if (current >= target) clearInterval(timer);
                }, 20);
                observer.unobserve(el);
            });
        }, { threshold: 0.5 });
        document.querySelectorAll('.counter-value').forEach(el => observer.observe(el));
    }

    function initScrollReveal() {
        const els = document.querySelectorAll('[data-aos]');
        if (!els.length) return;
        const observer = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.style.opacity = '1';
                    e.target.style.transform = 'none';
                    observer.unobserve(e.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
        els.forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(24px)';
            el.style.transition = 'opacity .7s ease, transform .7s ease';
            const delay = el.dataset.aosDelay ? parseInt(el.dataset.aosDelay) : 0;
            el.style.transitionDelay = delay + 'ms';
            observer.observe(el);
        });
    }

})();
</script>
@endsection