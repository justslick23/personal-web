@extends('layouts.app')

@section('content')
<style>
/* ═══════════════════════════════════════
   HERO AI WIDGET
═══════════════════════════════════════ */
.hero-ai {
    margin-bottom: 2.5rem;
    max-width: 580px;
}

.hero-ai__bar {
    display: flex;
    align-items: center;
    gap: 0.55rem;
    margin-bottom: 0.6rem;
}

.hero-ai__avatar {
    width: 22px; height: 22px;
    border-radius: 6px;
    background: var(--clr-accent);
    display: flex; align-items: center; justify-content: center;
    color: #000;
    flex-shrink: 0;
}

.hero-ai__label {
    font-family: var(--font-sans);
    font-size: 0.67rem;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--clr-text-muted);
}

.hero-ai__pulse {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--clr-accent);
    animation: aiPulse 2s ease-in-out infinite;
}

@keyframes aiPulse {
    0%,100% { opacity: 1; transform: scale(1); }
    50%      { opacity: 0.3; transform: scale(0.6); }
}

@keyframes aiSpin {
    to { transform: rotate(360deg); }
}

.hero-ai__input-wrap {
    display: flex;
    align-items: center;
    gap: 0;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: var(--radius-pill);
    padding: 0.2rem 0.2rem 0.2rem 1.1rem;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.hero-ai__input-wrap:focus-within {
    border-color: var(--clr-accent);
    box-shadow: 0 0 0 3px var(--clr-accent-dim);
}

.hero-ai__input {
    flex: 1;
    background: transparent;
    border: none;
    outline: none;
    color: var(--clr-text);
    font-family: var(--font-sans);
    font-size: 0.875rem;
    font-weight: 400;
    padding: 0.55rem 0;
    min-width: 0;
}

.hero-ai__input::placeholder { color: var(--clr-text-dim); }

.hero-ai__send {
    width: 34px; height: 34px;
    border-radius: 50%;
    background: var(--clr-accent);
    border: none;
    display: flex; align-items: center; justify-content: center;
    color: #000;
    cursor: pointer;
    flex-shrink: 0;
    transition: background 0.2s, transform 0.15s;
}

.hero-ai__send:hover:not(:disabled) {
    background: #fff;
    transform: scale(1.08);
}

.hero-ai__send:disabled { opacity: 0.6; cursor: not-allowed; }

/* Suggestion chips */
.hero-ai__chips {
    display: flex;
    flex-wrap: wrap;
    gap: 0.4rem;
    margin-top: 0.65rem;
}

.hero-ai__chip {
    font-family: var(--font-sans);
    font-size: 0.72rem;
    font-weight: 500;
    color: var(--clr-text-muted);
    background: transparent;
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: var(--radius-pill);
    padding: 0.3rem 0.8rem;
    cursor: pointer;
    transition: color 0.2s, border-color 0.2s, background 0.2s;
    white-space: nowrap;
}

.hero-ai__chip:hover {
    color: var(--clr-accent);
    border-color: var(--clr-accent);
    background: var(--clr-accent-dim);
}

/* Answer box */
.hero-ai__answer {
    margin-top: 0.85rem;
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.09);
    border-radius: var(--radius-md);
    padding: 1rem 1.25rem;
    animation: aiFadeIn 0.3s ease;
}

@keyframes aiFadeIn {
    from { opacity: 0; transform: translateY(6px); }
    to   { opacity: 1; transform: translateY(0); }
}

.hero-ai__answer-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 0.65rem;
}

.hero-ai__answer-who {
    display: flex;
    align-items: center;
    gap: 0.45rem;
    font-family: var(--font-sans);
    font-size: 0.65rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--clr-accent);
}

.hero-ai__answer-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--clr-accent);
}

.hero-ai__answer-close {
    background: none;
    border: none;
    color: var(--clr-text-dim);
    cursor: pointer;
    padding: 2px;
    display: flex; align-items: center; justify-content: center;
    transition: color 0.2s;
    border-radius: 4px;
}
.hero-ai__answer-close:hover { color: var(--clr-text); }

.hero-ai__answer-text {
    font-family: var(--font-sans);
    font-size: 0.875rem;
    font-weight: 300;
    line-height: 1.75;
    color: var(--clr-text-muted);
    margin: 0;
    white-space: pre-wrap;
}

/* Search used badge */
.hero-ai__search-tag {
    display: none;
    align-items: center;
    gap: 0.35rem;
    margin-top: 0.65rem;
    font-family: var(--font-sans);
    font-size: 0.62rem;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--clr-text-dim);
    border-top: 1px solid rgba(255,255,255,0.05);
    padding-top: 0.65rem;
}

.hero-ai__search-tag svg { color: var(--clr-text-dim); }

/* Light mode */
[data-theme="light"] .hero-ai__input-wrap {
    background: rgba(0,0,0,0.03);
    border-color: rgba(0,0,0,0.1);
}
[data-theme="light"] .hero-ai__input-wrap:focus-within {
    border-color: var(--clr-accent);
}
[data-theme="light"] .hero-ai__input { color: var(--clr-text); }
[data-theme="light"] .hero-ai__input::placeholder { color: var(--clr-text-dim); }
[data-theme="light"] .hero-ai__chip {
    border-color: rgba(0,0,0,0.1);
}
[data-theme="light"] .hero-ai__answer {
    background: rgba(0,0,0,0.02);
    border-color: rgba(0,0,0,0.08);
}
[data-theme="light"] .hero-ai__send {
    background: var(--clr-accent);
    color: #fff;
}
    </style>
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

         {{-- ── AI Ask Widget ── --}}
         <div class="hero-ai" id="hero-ai">

            <div class="hero-ai__bar">
                <div class="hero-ai__avatar">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/>
                    </svg>
                </div>
                <span class="hero-ai__label">Ask about Tokelo</span>
                <span class="hero-ai__pulse"></span>
            </div>

            <div class="hero-ai__input-wrap">
                <input type="text" class="hero-ai__input" id="hero-ai-input"
                       placeholder="e.g. What tech does Tokelo use? What music has he released?"
                       maxlength="300" autocomplete="off">
                <button class="hero-ai__send" id="hero-ai-send" aria-label="Ask">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M2 21l21-9L2 3v7l15 2-15 2z"/>
                    </svg>
                </button>
            </div>

            <div class="hero-ai__chips">
                <button class="hero-ai__chip" data-q="What does Tokelo do?">What does Tokelo do?</button>
                <button class="hero-ai__chip" data-q="What tech stack does he use?">Tech stack?</button>
                <button class="hero-ai__chip" data-q="Tell me about Just Slick">Just Slick?</button>
                <button class="hero-ai__chip" data-q="What projects has he worked on?">Projects?</button>
                <button class="hero-ai__chip" data-q="How can I contact Tokelo?">Contact?</button>
            </div>

            <div class="hero-ai__answer" id="hero-ai-answer" style="display:none;">
                <div class="hero-ai__answer-header">
                    <div class="hero-ai__answer-who">
                        <span class="hero-ai__answer-dot"></span>
                        Tokelo AI
                    </div>
                    <button class="hero-ai__answer-close" id="hero-ai-close" aria-label="Close">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                        </svg>
                    </button>
                </div>
                <p class="hero-ai__answer-text" id="hero-ai-text"></p>
                <div class="hero-ai__search-tag" id="hero-ai-search-tag">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                    </svg>
                    Includes web search results
                </div>
            </div>

        </div>
        {{-- ── End AI Widget ── --}}

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
    ['name' => 'HTML5',       'icon' => 'fab fa-html5'],
    ['name' => 'CSS3',        'icon' => 'fab fa-css3-alt'],
    ['name' => 'JavaScript',  'icon' => 'fab fa-js-square'],
    ['name' => 'React',       'icon' => 'fab fa-react'],
    ['name' => 'Vue 3',       'icon' => 'fab fa-vuejs'],
    ['name' => 'PHP',         'icon' => 'fab fa-php'],
    ['name' => 'Laravel',     'icon' => 'fab fa-laravel'],
    ['name' => 'Node.js',     'icon' => 'fab fa-node-js'],
    ['name' => 'Java',        'icon' => 'fab fa-java'],
    ['name' => 'Android',     'icon' => 'fab fa-android'],
    ['name' => 'WordPress',   'icon' => 'fab fa-wordpress'],
    ['name' => 'MySQL',       'icon' => 'fas fa-database'],
    ['name' => 'Linux',       'icon' => 'fab fa-linux'],
    ['name' => 'GitHub',      'icon' => 'fab fa-github'],
    ['name' => 'Adobe CC',    'icon' => 'fas fa-palette'],
    ['name' => 'Figma',       'icon' => 'fas fa-pen-nib'],
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
        initAI();
    }

    // ── Existing functions (unchanged) ──────────────────────
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

    // ── AI Widget ───────────────────────────────────────────
    function initAI() {
        const input     = document.getElementById('hero-ai-input');
        const sendBtn   = document.getElementById('hero-ai-send');
        const answerBox = document.getElementById('hero-ai-answer');
        const answerTxt = document.getElementById('hero-ai-text');
        const closeBtn  = document.getElementById('hero-ai-close');
        const searchTag = document.getElementById('hero-ai-search-tag');
        const chips     = document.querySelectorAll('.hero-ai__chip');

        if (!input) return;

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

        function setLoading(on) {
            sendBtn.disabled = on;
            sendBtn.innerHTML = on
                ? '<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" style="animation:aiSpin 0.8s linear infinite"><path d="M12 2a10 10 0 0 1 10 10h-2a8 8 0 0 0-8-8V2z"/></svg>'
                : '<svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M2 21l21-9L2 3v7l15 2-15 2z"/></svg>';
        }

        function typewrite(text, el, speed) {
            el.textContent = '';
            let i = 0;
            const timer = setInterval(() => {
                el.textContent += text[i];
                i++;
                if (i >= text.length) clearInterval(timer);
            }, speed || 18);
        }

        function ask(question) {
            if (!question.trim()) return;

            input.value = question;
            setLoading(true);
            answerBox.style.display = 'none';

            fetch('{{ route("ask.tokelo") }}', {
                method:  'POST',
                headers: {
                    'Content-Type':     'application/json',
                    'X-CSRF-TOKEN':     csrfToken,
                    'Accept':           'application/json',
                },
                body: JSON.stringify({ question: question.trim() }),
            })
            .then(r => r.json())
            .then(data => {
                answerBox.style.display = 'block';
                // Typewriter effect for real-time feel
                typewrite(data.answer || 'No answer returned.', answerTxt, 16);
                // Show search badge if Gemini used web search
                if (searchTag) {
                    searchTag.style.display = data.search_used ? 'inline-flex' : 'none';
                }
                answerBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            })
            .catch(() => {
                answerBox.style.display = 'block';
                answerTxt.textContent = 'Something went wrong. Please try again.';
            })
            .finally(() => setLoading(false));
        }

        // Send on button click
        sendBtn.addEventListener('click', () => ask(input.value));

        // Send on Enter
        input.addEventListener('keydown', e => {
            if (e.key === 'Enter') ask(input.value);
        });

        // Close answer
        closeBtn?.addEventListener('click', () => {
            answerBox.style.display = 'none';
            input.value = '';
        });

        // Suggestion chips
        chips.forEach(chip => {
            chip.addEventListener('click', () => ask(chip.dataset.q));
        });
    }

})();
</script>
@endsection