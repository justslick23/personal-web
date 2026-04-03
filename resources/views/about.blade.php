@extends('layouts.app')

@section('title', 'About — Tokelo Foso')

@push('head')
<style>
.mb-label { display: block; margin-bottom: 1rem; }

.scroll-reveal {
    opacity: 0; transform: translateY(28px);
    transition: opacity 0.65s ease, transform 0.65s ease;
}
.scroll-reveal.revealed { opacity: 1; transform: translateY(0); }
.scroll-reveal-delay-1 { transition-delay: 0.12s; }
.scroll-reveal-delay-2 { transition-delay: 0.24s; }

/* ── My Story ── */
.ab-story { padding: var(--section-pad); background: var(--clr-bg); }
.ab-story__layout {
    display: grid;
    grid-template-columns: 280px 1fr;
    border: 1px solid var(--clr-border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    min-height: 520px;
}
.ab-story__companies {
    background: var(--clr-bg-card);
    border-right: 1px solid var(--clr-border);
    padding: 2.5rem 1.5rem;
    display: flex; flex-direction: column;
}
.ab-story__section-tag {
    display: inline-flex; align-items: center; gap: 0.5rem;
    font-family: var(--font-sans);
    font-size: 0.65rem; font-weight: 700; letter-spacing: 0.15em;
    text-transform: uppercase; color: var(--clr-text-muted);
    border: 1px solid var(--clr-border); border-radius: 50px;
    padding: 0.32rem 0.85rem; margin-bottom: 2rem; width: fit-content;
}
.ab-story__section-tag i { color: var(--clr-accent); font-size: 0.65rem; }
.ab-story__company-item {
    display: flex; align-items: center; gap: 0.85rem;
    padding: 1rem 0.9rem; border-radius: var(--radius-md);
    cursor: pointer; transition: background 0.2s, border-color 0.2s;
    border: 1px solid transparent; margin-bottom: 0.2rem;
}
.ab-story__company-item:hover { background: var(--clr-surface); border-color: var(--clr-border); }
.ab-story__company-item.is-active { background: var(--clr-surface); border-color: var(--clr-border-accent); }
.ab-co-logo {
    width: 38px; height: 38px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.95rem; flex-shrink: 0;
}
.ab-co-logo--green  { background: rgba(0,230,118,0.15);  color: var(--clr-accent); }
.ab-co-logo--orange { background: rgba(249,115,22,0.15); color: #f97316; }
.ab-co-logo--purple { background: rgba(139,92,246,0.15); color: #8b5cf6; }
.ab-co-logo--blue   { background: rgba(99,102,241,0.15); color: #6366f1; }
.ab-co-name { font-family: var(--font-sans); font-size: 0.84rem; font-weight: 600; color: var(--clr-text); line-height: 1.2; }
.ab-co-period { font-family: var(--font-sans); font-size: 0.7rem; color: var(--clr-text-muted); margin-top: 0.1rem; }
.ab-story__detail {
    padding: 2.75rem 3rem; display: flex; flex-direction: column;
    background: var(--clr-bg);
}
.ab-story__headline {
    font-family: var(--font-sans);
    font-size: clamp(1.5rem, 2.4vw, 2.2rem); font-weight: 700;
    color: var(--clr-text); line-height: 1.2; letter-spacing: -0.02em; margin-bottom: 2rem;
}
.ab-story__headline .dim { color: var(--clr-text-muted); font-weight: 300; }
.ab-tabs {
    display: inline-flex; gap: 0;
    background: var(--clr-surface); border: 1px solid var(--clr-border);
    border-radius: 50px; padding: 4px; margin-bottom: 2rem;
}
.ab-tab {
    font-family: var(--font-sans); font-size: 0.78rem; font-weight: 600;
    padding: 0.48rem 1.25rem; border-radius: 50px; border: none;
    cursor: pointer; transition: all 0.22s ease;
    background: transparent; color: var(--clr-text-muted);
}
.ab-tab.is-active { background: var(--clr-accent); color: var(--clr-bg); }
.ab-entries { display: none; flex-direction: column; }
.ab-entries.is-active { display: flex; }
.ab-entry {
    display: grid; grid-template-columns: 16px 1fr;
    gap: 0 1.1rem; padding: 1.2rem 0;
    border-bottom: 1px solid var(--clr-border); transition: opacity 0.3s ease;
}
.ab-entry:last-child { border-bottom: none; }
.ab-entry.is-dimmed { opacity: 0.3; }
.ab-entry__line { position: relative; display: flex; flex-direction: column; align-items: center; }
.ab-entry__dot {
    width: 11px; height: 11px; border-radius: 50%;
    background: var(--clr-accent); box-shadow: 0 0 0 3px rgba(0,230,118,0.15);
    flex-shrink: 0; margin-top: 0.32rem;
}
.ab-entry__connector {
    width: 1px; flex: 1; min-height: 40px;
    background: linear-gradient(to bottom, var(--clr-border-accent), transparent); margin-top: 4px;
}
.ab-entry:last-child .ab-entry__connector { display: none; }
.ab-entry__title { font-family: var(--font-sans); font-size: 0.95rem; font-weight: 700; color: var(--clr-text); margin-bottom: 0.35rem; }
.ab-entry__desc { font-family: var(--font-sans); font-size: 0.855rem; font-weight: 300; color: var(--clr-text-muted); line-height: 1.65; margin-bottom: 0.65rem; }
.ab-entry__badge {
    display: inline-flex; align-items: center; gap: 0.45rem;
    font-family: var(--font-sans); font-size: 0.72rem; font-weight: 500; color: var(--clr-text-muted);
    background: var(--clr-surface); border: 1px solid var(--clr-border);
    border-radius: var(--radius-sm); padding: 0.3rem 0.7rem;
}
.ab-entry__badge i { color: var(--clr-accent); font-size: 0.65rem; }

/* ── Expertise ── */
.ab-expertise { padding: var(--section-pad); background: var(--clr-bg-alt); }
.ab-expertise__title {
    font-family: var(--font-sans);
    font-size: clamp(2rem, 4.5vw, 3.5rem); font-weight: 700;
    letter-spacing: -0.03em; color: var(--clr-text); line-height: 1.05; margin-bottom: 3.5rem;
}
.ab-expertise__title .dim { color: var(--clr-text-muted); font-weight: 300; }
.ab-expertise__cols {
    display: grid; grid-template-columns: repeat(3, 1fr);
    border: 1px solid var(--clr-border); border-radius: var(--radius-lg); overflow: hidden;
}
.ab-expertise__col {
    padding: 2.25rem 2rem 2.5rem;
    border-right: 1px solid var(--clr-border);
    background: var(--clr-bg-card); transition: background 0.3s;
}
.ab-expertise__col:last-child { border-right: none; }
.ab-expertise__col:hover { background: var(--clr-surface); }
.ab-expertise__col-head {
    display: flex; align-items: center; justify-content: space-between;
    padding-bottom: 1.1rem; border-bottom: 1px solid var(--clr-border); margin-bottom: 1.6rem;
}
.ab-expertise__col-label { font-family: var(--font-sans); font-size: 0.62rem; font-weight: 700; letter-spacing: 0.16em; text-transform: uppercase; color: var(--clr-text-dim); }
.ab-expertise__col-icon { width: 20px; height: 20px; border: 1px solid var(--clr-border); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--clr-text-muted); font-size: 0.55rem; }
.ab-expertise__list { display: flex; flex-direction: column; gap: 0.85rem; }
.ab-expertise__item { font-family: var(--font-sans); font-size: 0.92rem; font-weight: 400; color: var(--clr-text-muted); transition: color 0.2s; cursor: default; }
.ab-expertise__item:hover { color: var(--clr-text); }
.ab-philosophy {
    margin-top: 1.75rem; padding: 3rem 3.5rem;
    background: var(--clr-bg-card); border: 1px solid var(--clr-border); border-radius: var(--radius-lg);
}
.ab-philosophy p { font-family: var(--font-sans); font-size: clamp(0.95rem, 1.6vw, 1.15rem); font-weight: 400; line-height: 1.8; color: var(--clr-text); }
.ab-philosophy p .dim { color: var(--clr-text-muted); font-weight: 300; }

/* ── Tools ── */
.ab-tools { padding: var(--section-pad); background: var(--clr-bg); }
.ab-tools__card { border: 1px solid var(--clr-border); border-radius: var(--radius-lg); overflow: hidden; }
.ab-tools__header { padding: 2.75rem 3rem 2.5rem; border-bottom: 1px solid var(--clr-border); }
.ab-tools__eyebrow {
    display: inline-flex; align-items: center; gap: 0.5rem;
    font-family: var(--font-sans); font-size: 0.65rem; font-weight: 700; letter-spacing: 0.15em;
    text-transform: uppercase; color: var(--clr-text-muted);
    border: 1px solid var(--clr-border); border-radius: 50px;
    padding: 0.32rem 0.85rem; margin-bottom: 1.25rem; width: fit-content;
}
.ab-tools__eyebrow i { color: var(--clr-accent); }
.ab-tools__title { font-family: var(--font-sans); font-size: clamp(1.8rem, 3.5vw, 2.75rem); font-weight: 700; letter-spacing: -0.025em; color: var(--clr-text); line-height: 1.1; }
.ab-tools__title .dim { color: var(--clr-text-muted); font-weight: 300; }
.ab-tools__sub { font-family: var(--font-sans); font-size: 0.9rem; font-weight: 300; color: var(--clr-text-muted); line-height: 1.7; max-width: 540px; margin-top: 0.75rem; }
.ab-tools__grid { display: grid; grid-template-columns: repeat(3, 1fr); }
.ab-tool {
    display: flex; align-items: center; gap: 1rem;
    padding: 1.5rem 2rem;
    border-right: 1px solid var(--clr-border); border-bottom: 1px solid var(--clr-border);
    transition: background 0.22s; cursor: default;
}
.ab-tool:hover { background: var(--clr-surface); }
.ab-tool:nth-child(3n)        { border-right: none; }
.ab-tool:nth-last-child(-n+3) { border-bottom: none; }
.ab-tool__icon { width: 46px; height: 46px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0; border: 1px solid var(--clr-border); }
.ab-tool__icon--figma   { background: #1a1a1a;  color: #f24e1e; }
.ab-tool__icon--ps      { background: #001524;  color: #31a8ff; }
.ab-tool__icon--ai      { background: #200000;  color: #ff9a00; }
.ab-tool__icon--github  { background: #161b22;  color: #e6edf3; }
.ab-tool__icon--laravel { background: #1a0800;  color: #ff2d20; }
.ab-tool__icon--react   { background: #061522;  color: #61dafb; }
.ab-tool__icon--vscode  { background: #0a0f16;  color: #007acc; }
.ab-tool__icon--mysql   { background: #00131f;  color: #00758f; }
.ab-tool__icon--linux   { background: #141400;  color: #fcc624; }
.ab-tool__name { font-family: var(--font-sans); font-size: 0.95rem; font-weight: 600; color: var(--clr-text); line-height: 1.2; }
.ab-tool__cat  { font-family: var(--font-sans); font-size: 0.73rem; font-weight: 400; color: var(--clr-text-muted); margin-top: 0.1rem; }
.ab-tools__footer {
    padding: 1.25rem 2rem; border-top: 1px solid var(--clr-border);
    background: var(--clr-bg-card); display: flex; align-items: center; gap: 0.75rem;
}
.ab-tools__footer-dots { display: flex; gap: 3px; }
.ab-tools__footer-dot  { width: 5px; height: 5px; border-radius: 50%; background: var(--clr-text-dim); }
.ab-tools__footer-note { font-family: var(--font-sans); font-size: 0.73rem; font-weight: 500; letter-spacing: 0.04em; color: var(--clr-text-dim); text-transform: uppercase; }
.ab-tools__footer-note strong { color: var(--clr-text-muted); }

/* ── CTA ── */
.ab-cta { padding: 5rem 0; background: var(--clr-bg); border-top: 1px solid var(--clr-border); }
.ab-cta__inner { display: flex; align-items: center; justify-content: space-between; gap: 3rem; flex-wrap: wrap; }
.ab-cta__headline { font-family: var(--font-serif); font-size: clamp(2rem, 3.5vw, 3.2rem); font-weight: 300; line-height: 1.1; letter-spacing: -0.02em; color: var(--clr-text); }
.ab-cta__headline em { font-style: italic; color: var(--clr-accent); }
.ab-cta__actions { display: flex; gap: 1rem; flex-wrap: wrap; align-items: center; }
.mn-btn--lg { padding: 1rem 2rem; font-size: 0.875rem; }

@media (max-width: 1024px) {
    .ab-story__layout { grid-template-columns: 1fr; }
    .ab-story__companies { border-right: none; border-bottom: 1px solid var(--clr-border); flex-direction: row; flex-wrap: wrap; gap: 0.4rem; padding: 1.5rem; }
    .ab-story__section-tag { display: none; }
    .ab-story__company-item { flex: 1 1 140px; }
    .ab-expertise__cols { grid-template-columns: 1fr; }
    .ab-expertise__col { border-right: none !important; border-bottom: 1px solid var(--clr-border); }
    .ab-expertise__col:last-child { border-bottom: none; }
    .ab-tools__grid { grid-template-columns: repeat(2, 1fr); }
    .ab-tool:nth-child(3n)        { border-right: 1px solid var(--clr-border); }
    .ab-tool:nth-child(2n)        { border-right: none; }
    .ab-tool:nth-last-child(-n+3) { border-bottom: 1px solid var(--clr-border); }
    .ab-tool:nth-last-child(-n+2) { border-bottom: none; }
}
@media (max-width: 768px) {
    .ab-story__detail { padding: 2rem 1.5rem; }
    .ab-philosophy { padding: 2rem 1.5rem; }
    .ab-tools__header { padding: 2rem 1.5rem; }
    .ab-tools__grid { grid-template-columns: 1fr; }
    .ab-tool { border-right: none !important; }
    .ab-tool:nth-last-child(-n+2) { border-bottom: 1px solid var(--clr-border) !important; }
    .ab-tool:last-child { border-bottom: none !important; }
    .ab-cta__inner { flex-direction: column; align-items: flex-start; }
}
</style>
@endpush

@section('content')

@include('partials.page-header', [
    'title'    => 'About Me',
    'subtitle' => 'Software developer and graphic designer, based in Maseru.',
    'theme'    => 'about',
    'breadcrumbs' => [
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'About'],
    ]
])

{{-- IDENTITY --}}
<section class="mn-section ab-identity mn-grain">
    <div class="mn-container">
        <div class="ab-identity__grid">

            <div class="ab-identity__visual scroll-reveal">
                <div class="ab-identity__frame">
                    <img src="{{ asset('images/Myself.jpg') }}" alt="Tokelo Foso"
                         onerror="this.src='https://ui-avatars.com/api/?name=Tokelo+Foso&size=600&background=1c1c1c&color=00e676&bold=true&format=svg'">
                    <div class="ab-identity__frame-badge">
                        <span class="ab-identity__frame-dot"></span>
                        <span class="t-eyebrow">Maseru, Lesotho</span>
                    </div>
                </div>
                <div class="ab-stat-card ab-stat-card--a scroll-reveal scroll-reveal-delay-1">
                    <span class="ab-stat-card__num">50<sup>+</sup></span>
                    <span class="ab-stat-card__lbl">Projects</span>
                </div>
                <div class="ab-stat-card ab-stat-card--b scroll-reveal scroll-reveal-delay-2">
                    <span class="ab-stat-card__num">5<sup>+</sup></span>
                    <span class="ab-stat-card__lbl">Yrs Exp</span>
                </div>
            </div>

            <div class="ab-identity__copy scroll-reveal">
                <span class="t-eyebrow mb-label">Who I Am</span>
                <h2 class="ab-identity__headline">
                    I build <em>software</em><br>
                    and design the things<br>
                    <span class="ab-identity__outline">around it.</span>
                </h2>
                <p class="ab-identity__body">
                    I'm Tokelo, a developer and designer at Computer Business Solutions in Maseru.
                    My day-to-day is mostly Laravel backends, database work, and React frontends —
                    with Figma and the Adobe suite on the design side of things.
                </p>
                <p class="ab-identity__body">
                    Having both skills in one person tends to make things smoother. I can take a
                    project from a rough idea to a finished, working product without much getting
                    lost along the way.
                </p>
                <div class="ab-chips">
                    <div class="ab-chip"><i class="fas fa-map-marker-alt"></i> Maseru, Lesotho</div>
                    <div class="ab-chip"><i class="fas fa-graduation-cap"></i> BSc Computer Science</div>
                    <div class="ab-chip"><i class="fas fa-code"></i> Full-Stack Dev</div>
                    <div class="ab-chip"><i class="fas fa-pen-ruler"></i> Graphic Design</div>
                    <div class="ab-chip"><i class="fas fa-language"></i> English · Sesotho</div>
                    <div class="ab-chip"><i class="fas fa-music"></i> Music Producer</div>
                </div>
                <div class="ab-identity__actions">
                    <a href="{{ route('download.cv') }}" class="mn-btn mn-btn--primary" target="_blank">
                        <i class="fas fa-download"></i> Download CV
                    </a>
                    <a href="{{ route('contact') }}" class="mn-btn mn-btn--outline">
                        <i class="fas fa-paper-plane"></i> Get In Touch
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- MY STORY --}}
<section class="ab-story mn-grain" id="story">
    <div class="mn-container">
        <div class="ab-story__layout scroll-reveal">

            <div class="ab-story__companies">
                <div class="ab-story__section-tag"><i class="fas fa-circle-dot"></i> My Story</div>

                @php
                $companies = [
                    ['id'=>'cbs-dev',    'name'=>'Computer Business Solutions', 'period'=>'Apr 2026 – Present', 'logo'=>'green',  'icon'=>'fas fa-code',          'tab'=>'work'],
                    ['id'=>'cbs-design', 'name'=>'Computer Business Solutions', 'period'=>'2022 – Mar 2026',    'logo'=>'green',  'icon'=>'fas fa-pen-ruler',      'tab'=>'work'],
                    ['id'=>'osmium',     'name'=>'Osmium Lesotho',              'period'=>'2021 – 2022',        'logo'=>'orange', 'icon'=>'fas fa-gem',            'tab'=>'work'],
                    ['id'=>'monash',     'name'=>'Monash University',           'period'=>'2018 – 2020',        'logo'=>'purple', 'icon'=>'fas fa-graduation-cap', 'tab'=>'edu'],
                    ['id'=>'machabeng',  'name'=>'Machabeng College',           'period'=>'2014 – 2016',        'logo'=>'blue',   'icon'=>'fas fa-school',         'tab'=>'edu'],
                ];
                @endphp

                @foreach($companies as $co)
                <div class="ab-story__company-item {{ $loop->first ? 'is-active' : '' }}"
                     data-id="{{ $co['id'] }}" data-tab="{{ $co['tab'] }}">
                    <div class="ab-co-logo ab-co-logo--{{ $co['logo'] }}">
                        <i class="{{ $co['icon'] }}"></i>
                    </div>
                    <div>
                        <div class="ab-co-name">{{ $co['name'] }}</div>
                        <div class="ab-co-period">{{ $co['period'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="ab-story__detail">
                <h2 class="ab-story__headline">
                    Where I've worked<br>
                    <span class="dim">and where I studied</span>
                </h2>

                <div class="ab-tabs">
                    <button class="ab-tab is-active" data-tab="work">Work</button>
                    <button class="ab-tab" data-tab="edu">Education</button>
                </div>

                <div class="ab-entries is-active" id="entries-work">
                    <div class="ab-entry" data-id="cbs-dev">
                        <div class="ab-entry__line">
                            <div class="ab-entry__dot"></div>
                            <div class="ab-entry__connector"></div>
                        </div>
                        <div>
                            <div class="ab-entry__title">Software Developer — Computer Business Solutions</div>
                            <p class="ab-entry__desc">Building full-stack web applications for clients across multiple sectors. Mostly Laravel on the backend, React or vanilla JS on the front, with MySQL underneath. I handle everything from database design to deployment.</p>
                            <span class="ab-entry__badge"><i class="fas fa-arrow-trend-up"></i> Standardised our Laravel scaffolding — cut project setup time significantly.</span>
                        </div>
                    </div>
                    <div class="ab-entry" data-id="cbs-design">
                        <div class="ab-entry__line">
                            <div class="ab-entry__dot"></div>
                            <div class="ab-entry__connector"></div>
                        </div>
                        <div>
                            <div class="ab-entry__title">Web Designer — Computer Business Solutions</div>
                            <p class="ab-entry__desc">Designed web interfaces and brand assets for clients in various industries. Focused on keeping things consistent, responsive, and actually pleasant to look at.</p>
                            <span class="ab-entry__badge"><i class="fas fa-arrow-trend-up"></i> Led design on 20+ client web projects end to end.</span>
                        </div>
                    </div>
                    <div class="ab-entry" data-id="osmium">
                        <div class="ab-entry__line">
                            <div class="ab-entry__dot"></div>
                            <div class="ab-entry__connector"></div>
                        </div>
                        <div>
                            <div class="ab-entry__title">Graphic Designer — Osmium Lesotho</div>
                            <p class="ab-entry__desc">Created logos, marketing materials, and social content for local and regional clients. Print and digital, mostly working with small businesses that needed a proper visual identity.</p>
                            <span class="ab-entry__badge"><i class="fas fa-arrow-trend-up"></i> Delivered brand identity packages for 30+ SME clients.</span>
                        </div>
                    </div>
                </div>

                <div class="ab-entries" id="entries-edu">
                    <div class="ab-entry" data-id="monash">
                        <div class="ab-entry__line">
                            <div class="ab-entry__dot"></div>
                            <div class="ab-entry__connector"></div>
                        </div>
                        <div>
                            <div class="ab-entry__title">BSc Computer Science — Monash University</div>
                            <p class="ab-entry__desc">Specialised in Mobile Systems and Software Development. Final-year project was a cross-platform task management app in React Native — got a distinction for it.</p>
                            <span class="ab-entry__badge"><i class="fas fa-medal"></i> Graduated 2020 · Mobile Systems specialisation.</span>
                        </div>
                    </div>
                    <div class="ab-entry" data-id="machabeng">
                        <div class="ab-entry__line">
                            <div class="ab-entry__dot"></div>
                            <div class="ab-entry__connector"></div>
                        </div>
                        <div>
                            <div class="ab-entry__title">IGCSE — Machabeng College</div>
                            <p class="ab-entry__desc">Finished with distinctions in Maths and Computer Science. Also ran the school's IT club and put together the first inter-house coding challenge.</p>
                            <span class="ab-entry__badge"><i class="fas fa-medal"></i> Distinction in Mathematics &amp; Computer Science.</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

{{-- EXPERTISE --}}
<section class="ab-expertise mn-grain" id="expertise">
    <div class="mn-container">

        <div class="scroll-reveal" style="margin-bottom:3.5rem;">
            <div class="ab-story__section-tag" style="margin-bottom:1.25rem;">
                <i class="fas fa-crosshairs"></i> What I Do
            </div>
            <h2 class="ab-expertise__title">
                Areas I work <span class="dim">in</span>
            </h2>
        </div>

        <div class="ab-expertise__cols scroll-reveal">
            <div class="ab-expertise__col">
                <div class="ab-expertise__col-head">
                    <span class="ab-expertise__col-label">[Backend & Systems]</span>
                    <div class="ab-expertise__col-icon"><i class="fas fa-plus"></i></div>
                </div>
                <ul class="ab-expertise__list">
                    <li class="ab-expertise__item">Full-Stack Web Development</li>
                    <li class="ab-expertise__item">Laravel API Architecture</li>
                    <li class="ab-expertise__item">Database Design &amp; Optimisation</li>
                    <li class="ab-expertise__item">RESTful APIs &amp; Microservices</li>
                    <li class="ab-expertise__item">Server Management &amp; Linux</li>
                    <li class="ab-expertise__item">Oracle Cloud Infrastructure</li>
                    <li class="ab-expertise__item">Auth Systems &amp; Secure Coding</li>
                </ul>
            </div>
            <div class="ab-expertise__col">
                <div class="ab-expertise__col-head">
                    <span class="ab-expertise__col-label">[Frontend & Mobile]</span>
                    <div class="ab-expertise__col-icon"><i class="fas fa-plus"></i></div>
                </div>
                <ul class="ab-expertise__list">
                    <li class="ab-expertise__item">React &amp; Vue 3</li>
                    <li class="ab-expertise__item">Responsive HTML5 / CSS3</li>
                    <li class="ab-expertise__item">JavaScript &amp; Node.js</li>
                    <li class="ab-expertise__item">WordPress Theme Development</li>
                    <li class="ab-expertise__item">Android App Development</li>
                    <li class="ab-expertise__item">Performance Optimisation</li>
                    <li class="ab-expertise__item">Accessible UI</li>
                </ul>
            </div>
            <div class="ab-expertise__col">
                <div class="ab-expertise__col-head">
                    <span class="ab-expertise__col-label">[Design & Branding]</span>
                    <div class="ab-expertise__col-icon"><i class="fas fa-plus"></i></div>
                </div>
                <ul class="ab-expertise__list">
                    <li class="ab-expertise__item">UI/UX Design — Figma</li>
                    <li class="ab-expertise__item">Brand Identity</li>
                    <li class="ab-expertise__item">High-Fidelity Prototyping</li>
                    <li class="ab-expertise__item">Photoshop &amp; Illustrator</li>
                    <li class="ab-expertise__item">Grid &amp; Layout Systems</li>
                    <li class="ab-expertise__item">Motion &amp; Interaction Design</li>
                    <li class="ab-expertise__item">Print &amp; Digital Collateral</li>
                </ul>
            </div>
        </div>

        <div class="ab-philosophy scroll-reveal">
            <p>
                I care about the details — the kind that most people don't notice until they're missing.
                Whether it's how a form behaves on a slow connection or how a logo holds up at
                small sizes, the small things tend to be what separates something that works from
                something that feels right.
                <span class="dim"> I'm not interested in shipping fast and fixing later.
                I'd rather take the time to do it properly the first time.</span>
            </p>
        </div>

    </div>
</section>

{{-- TOOLS --}}
<section class="ab-tools mn-grain" id="tools">
    <div class="mn-container">
        <div class="ab-tools__card scroll-reveal">
            <div class="ab-tools__header">
                <div class="ab-tools__eyebrow"><i class="fas fa-screwdriver-wrench"></i> My Stack</div>
                <h2 class="ab-tools__title">Tools I <span class="dim">actually use</span></h2>
                <p class="ab-tools__sub">
                    Not an exhaustive list — just the ones I reach for on most projects.
                </p>
            </div>

            @php
            $tools = [
                ['name'=>'Figma',       'cat'=>'UI Design',         'icon'=>'fab fa-figma',    'color'=>'figma'],
                ['name'=>'Photoshop',   'cat'=>'Image Editing',     'icon'=>'fas fa-image',    'color'=>'ps'],
                ['name'=>'Illustrator', 'cat'=>'Vector Design',     'icon'=>'fas fa-pen-nib',  'color'=>'ai'],
                ['name'=>'GitHub',      'cat'=>'Version Control',   'icon'=>'fab fa-github',   'color'=>'github'],
                ['name'=>'Laravel',     'cat'=>'PHP Framework',     'icon'=>'fab fa-laravel',  'color'=>'laravel'],
                ['name'=>'React',       'cat'=>'Frontend Library',  'icon'=>'fab fa-react',    'color'=>'react'],
                ['name'=>'VS Code',     'cat'=>'Code Editor',       'icon'=>'fas fa-code',     'color'=>'vscode'],
                ['name'=>'MySQL',       'cat'=>'Database',          'icon'=>'fas fa-database', 'color'=>'mysql'],
                ['name'=>'Linux',       'cat'=>'Server OS',         'icon'=>'fab fa-linux',    'color'=>'linux'],
            ];
            @endphp

            <div class="ab-tools__grid">
                @foreach($tools as $tool)
                <div class="ab-tool">
                    <div class="ab-tool__icon ab-tool__icon--{{ $tool['color'] }}">
                        <i class="{{ $tool['icon'] }}"></i>
                    </div>
                    <div>
                        <div class="ab-tool__name">{{ $tool['name'] }}</div>
                        <div class="ab-tool__cat">{{ $tool['cat'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="ab-tools__footer">
                <div class="ab-tools__footer-dots">
                    @for($i = 0; $i < 5; $i++)<div class="ab-tools__footer-dot"></div>@endfor
                </div>
                <span class="ab-tools__footer-note">
                    Plus <strong>10+ more</strong> across design, development and infrastructure
                </span>
            </div>
        </div>
    </div>
</section>



@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const revealObs = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) { e.target.classList.add('revealed'); revealObs.unobserve(e.target); }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.scroll-reveal').forEach(el => revealObs.observe(el));

    const tabs        = document.querySelectorAll('.ab-tab');
    const entryGroups = document.querySelectorAll('.ab-entries');
    const coItems     = document.querySelectorAll('.ab-story__company-item');

    function clearDimmed() {
        document.querySelectorAll('.ab-entry.is-dimmed').forEach(e => e.classList.remove('is-dimmed'));
    }

    function switchTab(targetTab) {
        tabs.forEach(t => t.classList.toggle('is-active', t.dataset.tab === targetTab));
        entryGroups.forEach(g => g.classList.remove('is-active'));
        document.getElementById('entries-' + targetTab)?.classList.add('is-active');
        coItems.forEach(co => co.classList.toggle('is-active', co.dataset.tab === targetTab));
        clearDimmed();
    }

    tabs.forEach(tab => tab.addEventListener('click', function () { switchTab(this.dataset.tab); }));

    coItems.forEach(co => {
        co.addEventListener('click', function () {
            const coTab = this.dataset.tab;
            const coId  = this.dataset.id;
            switchTab(coTab);
            coItems.forEach(c => c.classList.remove('is-active'));
            this.classList.add('is-active');
            document.querySelectorAll('#entries-' + coTab + ' .ab-entry').forEach(entry => {
                entry.classList.toggle('is-dimmed', entry.dataset.id !== coId);
            });
        });
    });

});
</script>
@endsection