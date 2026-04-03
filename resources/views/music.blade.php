@extends('layouts.app')

@section('title', 'Just Slick — Producer')

@push('head')
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Space+Mono:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
<style>

    /* ── Play hint overlay ── */
.js-record__play-hint {
    position: absolute; inset: 0;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    background: rgba(0,0,0,0);
    opacity: 0;
    transition: background .2s, opacity .2s;
    pointer-events: none;
}
.js-record:hover .js-record__play-hint {
    background: rgba(0,0,0,0.6);
    opacity: 1;
}

/* ── Track list ── */
.js-tracklist {
    margin-top: .85rem;
    border-top: 1px solid var(--js-border);
    padding-top: .6rem;
}
.js-track-row {
    display: flex; align-items: center; gap: .6rem;
    padding: .45rem .1rem;
    border-bottom: 1px solid rgba(255,255,255,0.03);
    cursor: pointer;
    transition: background .15s;
    border-radius: 2px;
}
.js-track-row:last-child { border-bottom: none; }
.js-track-row:hover { background: rgba(232,38,26,0.07); }
.js-track-row:hover .js-track-row__play { color: var(--js-red); }
.js-track-row__num {
    font-family: var(--js-mono); font-size: .55rem;
    color: var(--js-text-dim); letter-spacing: .06em;
    flex-shrink: 0; width: 1.5rem;
}
.js-track-row__title {
    font-family: var(--js-mono); font-size: .62rem;
    color: var(--js-text); flex: 1;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.js-track-row__dur {
    font-family: var(--js-mono); font-size: .55rem;
    color: var(--js-text-dim); flex-shrink: 0;
}
.js-track-row__play {
    color: var(--js-text-dim); flex-shrink: 0;
    display: flex; align-items: center;
    transition: color .15s;
}
/* ═══════════════════════════════════════════════════════════════
   JUST SLICK WORLD — scoped to .js-world
   Override the main site's CSS variables locally so both
   identities can live under the same layout shell.
═══════════════════════════════════════════════════════════════ */
.js-world {
    --js-bg:           #080808;
    --js-bg-alt:       #0e0e0e;
    --js-bg-card:      #121212;
    --js-border:       rgba(255,255,255,0.07);
    --js-border-hi:    rgba(255,255,255,0.13);
    --js-red:          #e8261a;
    --js-orange:       #f07028;
    --js-text:         #f0ede8;
    --js-text-mid:     #888880;
    --js-text-dim:     #3e3e3c;
    --js-display:      'Bebas Neue', sans-serif;
    --js-mono:         'Space Mono', monospace;

    background: var(--js-bg);
    color: var(--js-text);
}

/* Force dark look even when site is in light mode */
[data-theme="light"] .js-world { background: var(--js-bg); color: var(--js-text); }

/* ── Grain overlay ──────────────────────────────────── */
.js-grain {
    position: relative;
}
.js-grain::after {
    content: '';
    position: absolute; inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
    background-size: 180px;
    pointer-events: none;
    z-index: 0;
}
.js-grain > * { position: relative; z-index: 1; }

/* ══════════════════════════════════════════════════════
   BRIDGE BANNER — thin top bar linking to dev identity
══════════════════════════════════════════════════════ */
.js-bridge {
    display: flex; align-items: center; justify-content: space-between;
    gap: 1.5rem; flex-wrap: wrap;
    padding: 0.85rem clamp(1.5rem, 6vw, 4rem);
    background: var(--js-bg-card);
    border-bottom: 1px solid var(--js-border);
}
.js-bridge__left {
    display: flex; align-items: center; gap: 0.85rem;
}
.js-bridge__mark {
    display: inline-flex; align-items: center; justify-content: center;
    width: 26px; height: 26px;
    background: var(--clr-accent, #00e676);
    border-radius: 7px;
    font-family: var(--font-sans); font-size: 0.65rem; font-weight: 700;
    color: #080808;
    flex-shrink: 0;
}
.js-bridge__sep { width: 1px; height: 20px; background: var(--js-border-hi); }
.js-bridge__label {
    font-family: var(--js-mono); font-size: 0.65rem;
    letter-spacing: 0.08em; color: var(--js-text-dim);
}
.js-bridge__link {
    font-family: var(--js-mono); font-size: 0.65rem;
    letter-spacing: 0.08em; color: var(--clr-accent, #00e676);
    text-decoration: none;
    border-bottom: 1px solid rgba(0,230,118,0.3);
    padding-bottom: 1px;
    transition: border-color 0.2s;
}
.js-bridge__link:hover { border-color: var(--clr-accent, #00e676); }

/* ══════════════════════════════════════════════════════
   HERO
══════════════════════════════════════════════════════ */
.js-hero {
    min-height: calc(100svh - 56px);
    position: relative;
    display: flex; flex-direction: column; justify-content: flex-end;
    padding: 0 clamp(1.5rem, 6vw, 4rem) 4.5rem;
    border-bottom: 1px solid var(--js-border);
    overflow: hidden;
}

.js-hero__bg { position: absolute; inset: 0; z-index: 0; }

/* Vertical grid lines */
.js-hero__lines {
    position: absolute; inset: 0;
    background-image: repeating-linear-gradient(
        90deg,
        transparent,
        transparent calc(100% / 6 - 0.5px),
        rgba(255,255,255,0.022) calc(100% / 6 - 0.5px),
        rgba(255,255,255,0.022) calc(100% / 6)
    );
}
/* Red accent bar along top */
.js-hero__topbar {
    position: absolute; top: 0; left: 0; right: 0; height: 3px;
    background: var(--js-red);
}
/* Red glow from bottom */
.js-hero__glow {
    position: absolute; bottom: 0; left: 0; right: 0; height: 40vh;
    background: linear-gradient(to top, rgba(232,38,26,0.05) 0%, transparent 100%);
}

.js-hero__inner {
    position: relative; z-index: 2;
    display: grid;
    grid-template-columns: 1fr auto;
    align-items: flex-end;
    gap: 3rem;
}

/* Kicker */
.js-kicker {
    display: inline-flex; align-items: center; gap: 0.65rem;
    font-family: var(--js-mono); font-size: 0.68rem;
    letter-spacing: 0.14em; text-transform: uppercase;
    color: var(--js-red);
    margin-bottom: 1.5rem;
}
.js-kicker__dot {
    width: 6px; height: 6px; border-radius: 50%;
    background: var(--js-red);
    animation: jsPulse 2s ease-in-out infinite;
}
@keyframes jsPulse {
    0%,100% { opacity:1; transform:scale(1); }
    50%      { opacity:0.35; transform:scale(0.65); }
}

/* Display name */
.js-hero__name {
    font-family: var(--js-display);
    font-size: clamp(5.5rem, 18vw, 15rem);
    line-height: 0.86;
    letter-spacing: 0.01em;
    color: var(--js-text);
    margin-bottom: 2.5rem;
}
.js-hero__name em { color: var(--js-red); font-style: normal; }

/* Tagline */
.js-hero__desc {
    font-family: var(--js-mono); font-size: 0.74rem; line-height: 1.85;
    color: var(--js-text-mid);
    border-left: 2px solid var(--js-red);
    padding-left: 1rem;
    margin-bottom: 2.5rem;
    max-width: 38ch;
}
.js-hero__desc strong { color: var(--js-text); font-weight: 400; }

/* Hero actions */
.js-hero__actions { display: flex; gap: 0.85rem; flex-wrap: wrap; }

/* Right: hero stat stack */
.js-hero__stats { display: flex; flex-direction: column; gap: 2px; }
.js-stat {
    padding: 1rem 1.35rem;
    border: 1px solid var(--js-border);
    background: rgba(255,255,255,0.018);
    text-align: right;
}
.js-stat__num {
    font-family: var(--js-display); font-size: 2rem; line-height: 1;
    color: var(--js-text);
}
.js-stat__lbl {
    font-family: var(--js-mono); font-size: 0.58rem;
    letter-spacing: 0.1em; text-transform: uppercase;
    color: var(--js-text-dim); margin-top: 0.2rem;
}

/* ── JS Buttons ── */
.js-btn {
    display: inline-flex; align-items: center; gap: 0.6rem;
    font-family: var(--js-mono); font-size: 0.68rem;
    font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase;
    padding: 0.85rem 1.65rem;
    border-radius: 0;
    transition: all 0.2s ease;
    cursor: pointer; text-decoration: none;
}
.js-btn--primary { background: var(--js-red); color: #fff; border: 1px solid var(--js-red); }
.js-btn--primary:hover { background: #c01e14; border-color: #c01e14; }
.js-btn--ghost { background: transparent; color: var(--js-text); border: 1px solid var(--js-border-hi); }
.js-btn--ghost:hover { border-color: var(--js-text-mid); }

/* ══════════════════════════════════════════════════════
   TICKER
══════════════════════════════════════════════════════ */
.js-ticker {
    overflow: hidden;
    background: var(--js-bg-alt);
    border-bottom: 1px solid var(--js-border);
    padding: 0.72rem 0;
    white-space: nowrap;
}
.js-ticker__track {
    display: inline-flex;
    animation: jsTicker 30s linear infinite;
}
@keyframes jsTicker {
    from { transform: translateX(0); }
    to   { transform: translateX(-50%); }
}
.js-ticker__item {
    display: inline-flex; align-items: center; gap: 0.85rem;
    font-family: var(--js-display); font-size: 0.85rem;
    letter-spacing: 0.12em; color: var(--js-text-dim);
    padding: 0 2rem;
}
.js-ticker__item span { color: var(--js-red); font-size: 0.7rem; }

/* ══════════════════════════════════════════════════════
   SECTION COMMONS
══════════════════════════════════════════════════════ */
.js-section {
    padding: 5.5rem clamp(1.5rem, 6vw, 4rem);
    border-bottom: 1px solid var(--js-border);
}
.js-section--alt { background: var(--js-bg-alt); }

.js-section-head {
    display: flex; align-items: flex-end; justify-content: space-between;
    gap: 2rem; flex-wrap: wrap;
    padding-bottom: 2rem;
    border-bottom: 1px solid var(--js-border);
    margin-bottom: 3.5rem;
}
.js-section-label {
    font-family: var(--js-mono); font-size: 0.62rem;
    letter-spacing: 0.15em; text-transform: uppercase;
    color: var(--js-red); margin-bottom: 0.45rem;
}
.js-section-title {
    font-family: var(--js-display);
    font-size: clamp(3rem, 7.5vw, 6.5rem);
    line-height: 0.88; letter-spacing: 0.02em;
    color: var(--js-text);
}
.js-section-num {
    font-family: var(--js-display); font-size: 0.72rem;
    letter-spacing: 0.18em; color: var(--js-text-dim);
}

/* ══════════════════════════════════════════════════════
   BIO
══════════════════════════════════════════════════════ */
.js-bio { display: grid; grid-template-columns: 300px 1fr; gap: 5rem; align-items: start; }

.js-bio__card {
    background: var(--js-bg-card);
    border: 1px solid var(--js-border);
}
.js-bio__card-top {
    display: flex; align-items: center; gap: 1rem;
    padding: 1.75rem 1.5rem;
    border-bottom: 1px solid var(--js-border);
}
.js-bio__avatar {
    width: 56px; height: 56px;
    background: var(--js-red); flex-shrink: 0;
    overflow: hidden; display: flex; align-items: center; justify-content: center;
    font-family: var(--js-display); font-size: 1.5rem; color: #fff;
}
.js-bio__avatar img { width: 100%; height: 100%; object-fit: cover; }
.js-bio__alias {
    font-family: var(--js-display); font-size: 1.45rem; line-height: 1;
    color: var(--js-text);
}
.js-bio__real {
    font-family: var(--js-mono); font-size: 0.6rem;
    color: var(--js-text-dim); margin-top: 0.2rem;
    letter-spacing: 0.08em;
}
.js-bio__row {
    display: flex; justify-content: space-between; align-items: center;
    font-family: var(--js-mono); font-size: 0.68rem;
    padding: 0.7rem 1.5rem;
    border-bottom: 1px solid var(--js-border);
}
.js-bio__row:last-child { border-bottom: none; }
.js-bio__row-key { color: var(--js-text-dim); letter-spacing: 0.08em; }
.js-bio__row-val { color: var(--js-text); text-align: right; }
.js-bio__row-val--red { color: var(--js-red); }

.js-bio__text { display: flex; flex-direction: column; gap: 1.1rem; }
.js-bio__text p {
    font-family: var(--font-sans); font-size: 0.92rem; line-height: 1.85;
    color: var(--js-text-mid); font-weight: 300;
}
.js-bio__text p strong { color: var(--js-text); font-weight: 500; }

.js-award {
    display: flex; align-items: flex-start; gap: 1rem;
    border: 1px solid rgba(232,38,26,0.25);
    background: rgba(232,38,26,0.04);
    padding: 1.25rem 1.5rem;
    margin-top: 0.5rem;
}
.js-award__icon { color: var(--js-red); font-size: 1.2rem; flex-shrink: 0; margin-top: 0.1rem; }
.js-award__label {
    font-family: var(--js-mono); font-size: 0.65rem;
    letter-spacing: 0.1em; text-transform: uppercase;
    color: var(--js-red); margin-bottom: 0.3rem;
}
.js-award__body {
    font-family: var(--js-mono); font-size: 0.68rem;
    color: var(--js-text-mid); line-height: 1.65;
}

/* ══════════════════════════════════════════════════════
   DISCOGRAPHY
══════════════════════════════════════════════════════ */
.js-disco {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 1px;
    background: var(--js-border);
    border: 1px solid var(--js-border);
}
.js-record {
    background: var(--js-bg-card);
    transition: background 0.22s;
}
.js-record:hover { background: #181818; }

.js-record__art {
    aspect-ratio: 1; position: relative;
    background: #1a1a1a;
    border-bottom: 1px solid var(--js-border);
    display: flex; align-items: center; justify-content: center;
    overflow: hidden;
}
.js-record__art img { width: 100%; height: 100%; object-fit: cover; display: block; }
.js-record__initial {
    font-family: var(--js-display); font-size: 5.5rem; line-height: 1;
    color: rgba(255,255,255,0.05);
}
.js-record__initial--red { color: rgba(232,38,26,0.12); }
.js-record__type {
    position: absolute; top: 0.75rem; left: 0.75rem;
    font-family: var(--js-mono); font-size: 0.58rem;
    letter-spacing: 0.1em; text-transform: uppercase;
    color: var(--js-red);
    background: rgba(8,8,8,0.75);
    padding: 0.25rem 0.6rem;
}
.js-record__body { padding: 1.1rem 1.35rem; }
.js-record__title {
    font-family: var(--js-display); font-size: 1.25rem;
    letter-spacing: 0.04em; color: var(--js-text);
    line-height: 1.1; margin-bottom: 0.35rem;
}
.js-record__meta {
    font-family: var(--js-mono); font-size: 0.62rem;
    color: var(--js-text-dim); letter-spacing: 0.06em;
}
.js-record__meta em { color: var(--js-red); font-style: normal; }

/* Streaming strip */
.js-stream {
    display: flex; align-items: center; gap: 1.5rem; flex-wrap: wrap;
    margin-top: 1.5rem;
    border: 1px solid var(--js-border);
    background: var(--js-bg-card);
    padding: 1.5rem 2rem;
}
.js-stream__icon { color: var(--js-red); font-size: 1.75rem; flex-shrink: 0; }
.js-stream__label {
    font-family: var(--js-mono); font-size: 0.65rem;
    letter-spacing: 0.1em; text-transform: uppercase;
    color: var(--js-text-mid); margin-bottom: 0.2rem;
}
.js-stream__name {
    font-family: var(--js-display); font-size: 1.05rem;
    color: var(--js-text); letter-spacing: 0.06em;
}

/* ══════════════════════════════════════════════════════
   SERVICES
══════════════════════════════════════════════════════ */
.js-services {
    display: grid; grid-template-columns: repeat(3, 1fr);
    gap: 1px; background: var(--js-border);
    border: 1px solid var(--js-border);
}
.js-service {
    background: var(--js-bg-card); padding: 2.5rem 2rem;
    transition: background 0.22s;
}
.js-service:hover { background: #181818; }
.js-service__num {
    font-family: var(--js-display); font-size: 3rem; line-height: 1;
    color: var(--js-text-dim); margin-bottom: 1.5rem;
}
.js-service__title {
    font-family: var(--js-display); font-size: 1.55rem;
    letter-spacing: 0.04em; color: var(--js-text); margin-bottom: 0.75rem;
}
.js-service__desc {
    font-family: var(--js-mono); font-size: 0.68rem;
    line-height: 1.85; color: var(--js-text-mid);
}
.js-service__tag {
    display: inline-block; margin-top: 1.25rem;
    font-family: var(--js-mono); font-size: 0.6rem;
    letter-spacing: 0.1em; text-transform: uppercase;
    color: var(--js-red);
    border: 1px solid rgba(232,38,26,0.3);
    padding: 0.28rem 0.65rem;
}

/* ══════════════════════════════════════════════════════
   CTA
══════════════════════════════════════════════════════ */
.js-cta {
    padding: 7rem clamp(1.5rem, 6vw, 4rem);
    text-align: center;
}
.js-cta__pre {
    font-family: var(--js-mono); font-size: 0.65rem;
    letter-spacing: 0.2em; text-transform: uppercase;
    color: var(--js-text-dim); margin-bottom: 1.25rem;
}
.js-cta__headline {
    font-family: var(--js-display);
    font-size: clamp(4rem, 12vw, 10rem);
    line-height: 0.86; letter-spacing: 0.01em;
    color: var(--js-text); margin-bottom: 1rem;
}
.js-cta__headline em { color: var(--js-red); font-style: normal; }
.js-cta__sub {
    font-family: var(--js-mono); font-size: 0.74rem;
    line-height: 1.85; color: var(--js-text-mid);
    max-width: 42ch; margin: 0 auto 3rem;
}
.js-cta__actions { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }

/* ══════════════════════════════════════════════════════
   RESPONSIVE
══════════════════════════════════════════════════════ */
@media (max-width: 900px) {
    .js-hero__inner { grid-template-columns: 1fr; }
    .js-hero__stats { flex-direction: row; flex-wrap: wrap; }
    .js-stat { flex: 1 1 110px; text-align: left; }
    .js-bio { grid-template-columns: 1fr; gap: 2.5rem; }
    .js-services { grid-template-columns: 1fr; }
}
@media (max-width: 600px) {
    .js-disco { grid-template-columns: 1fr 1fr; }
    .js-section { padding: 4rem 1.5rem; }
    .js-cta { padding: 5rem 1.5rem; }
    .js-hero__name { letter-spacing: 0; }
}
</style>
@endpush

@section('content')
<div class="js-world js-grain">

    {{-- ══ BRIDGE BANNER ══════════════════════════════ --}}
    <div class="js-bridge">
        <div class="js-bridge__left">
            <div class="js-bridge__mark">TF</div>
            <div class="js-bridge__sep"></div>
            <div class="js-bridge__label">Tokelo Foso · Developer &amp; Designer</div>
        </div>
        <a href="{{ route('home') }}" class="js-bridge__link">
            Developer portfolio <i class="fas fa-arrow-right" style="font-size:0.55rem"></i>
        </a>
    </div>

    {{-- ══ HERO ════════════════════════════════════════ --}}
    <section class="js-hero js-grain">
        <div class="js-hero__bg">
            <div class="js-hero__lines"></div>
            <div class="js-hero__topbar"></div>
            <div class="js-hero__glow"></div>
        </div>

        <div class="js-hero__inner">
            <div>
                <div class="js-kicker">
                    <div class="js-kicker__dot"></div>
                    Maseru, Lesotho &nbsp;·&nbsp; Producer &amp; Beatmaker
                </div>
                <h1 class="js-hero__name">JUST<br><em>SLICK</em></h1>
                <p class="js-hero__desc">
                    Beats built in Maseru. Trap, hip-hop, and everything<br>
                    in between. Award-winning. Still going.<br>
                    Tag: <strong>"Slick Drop The Beat"</strong>
                </p>
                <div class="js-hero__actions">
                    <a href="#beats" class="js-btn js-btn--primary">
                        <i class="fas fa-play" style="font-size:0.6rem"></i> Hear The Work
                    </a>
                    <a href="#licensing" class="js-btn js-btn--ghost">
                        Beat Licensing
                    </a>
                </div>
            </div>

            <div class="js-hero__stats">
                <div class="js-stat">
                    <div class="js-stat__num">2013</div>
                    <div class="js-stat__lbl">Started</div>
                </div>
                <div class="js-stat">
                    <div class="js-stat__num">UMA</div>
                    <div class="js-stat__lbl">Award Winner</div>
                </div>
                <div class="js-stat">
                    <div class="js-stat__num">LS</div>
                    <div class="js-stat__lbl">Based</div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══ TICKER ══════════════════════════════════════ --}}
    <div class="js-ticker">
        <div class="js-ticker__track">
            @php
            $items = ['Trap','Hip-Hop','Amapiano','Drill','R&B','Just Slick','Slick Drop The Beat',
                      'Maseru','Lesotho','UMA Winner','Dirt Deeds','Beatmaker','Producer'];
            $all   = array_merge($items, $items, $items);
            @endphp
            @foreach($all as $t)
            <div class="js-ticker__item"><span>✦</span> {{ $t }}</div>
            @endforeach
        </div>
    </div>

    {{-- ══ BIO ═════════════════════════════════════════ --}}
    <section class="js-section js-grain" id="about">
        <div class="js-section-head">
            <div>
                <div class="js-section-label">Who Is Just Slick</div>
                <h2 class="js-section-title">THE<br>PRODUCER</h2>
            </div>
            <div class="js-section-num">01 / 04</div>
        </div>

        <div class="js-bio">

            <div class="js-bio__card">
                <div class="js-bio__card-top">
                    <div class="js-bio__avatar">
                        <img src="{{ asset('images/me.jpg') }}" alt="Just Slick"
                             onerror="this.style.display='none'">
                    </div>
                    <div>
                        <div class="js-bio__alias">Just Slick</div>
                        <div class="js-bio__real">aka Tokelo Foso</div>
                    </div>
                </div>
                <div class="js-bio__row">
                    <span class="js-bio__row-key">Tag</span>
                    <span class="js-bio__row-val js-bio__row-val--red">"Slick Drop The Beat"</span>
                </div>
                <div class="js-bio__row">
                    <span class="js-bio__row-key">Based</span>
                    <span class="js-bio__row-val">Maseru, Lesotho</span>
                </div>
                <div class="js-bio__row">
                    <span class="js-bio__row-key">Active Since</span>
                    <span class="js-bio__row-val">2013</span>
                </div>
                <div class="js-bio__row">
                    <span class="js-bio__row-key">Genres</span>
                    <span class="js-bio__row-val">Trap · Hip-Hop · Amapiano</span>
                </div>
                <div class="js-bio__row">
                    <span class="js-bio__row-key">Role</span>
                    <span class="js-bio__row-val">Producer · Beatmaker</span>
                </div>
            </div>

            <div class="js-bio__text">
                <p>
                    <strong>Just Slick</strong> is the producer side of Tokelo Foso —
                    built out of Maseru, Lesotho. Started as a rapper in 2013,
                    then shifted focus to beatmaking and found where the real work was.
                </p>
                <p>
                    The sound pulls from trap, hip-hop, and textures that don't fit
                    neatly into a single genre. Cinematic without being soft.
                    Hard without being hollow. Every beat has a point.
                </p>
                <p>
                    The <strong>Dirt Deeds</strong> compilation earned Best Compilation Album
                    at the Ultimate Music Awards — recognition that the sound translates
                    well beyond Lesotho.
                </p>

                <div class="js-award">
                    <i class="fas fa-trophy js-award__icon"></i>
                    <div>
                        <div class="js-award__label">Ultimate Music Awards</div>
                        <div class="js-award__body">
                            Best Compilation Album — Dirt Deeds<br>
                            Recognising excellence in Lesotho music.
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
{{-- ══ DISCOGRAPHY ═════════════════════════════════ --}}
<section class="js-section js-section--alt js-grain" id="beats">
    <div class="js-section-head">
        <div>
            <div class="js-section-label">Selected Work</div>
            <h2 class="js-section-title">DISCO-<br>GRAPHY</h2>
        </div>
        <div class="js-section-num">02 / 04</div>
    </div>

    @if($releases->isEmpty())
        <div style="text-align:center;padding:4rem 0;font-family:var(--js-mono);
                    font-size:.72rem;color:var(--js-text-dim);letter-spacing:.1em;">
            NO RELEASES YET — CHECK BACK SOON
        </div>
    @else
        <div class="js-disco">
            @foreach($releases as $release)
            <div class="js-record" data-index="{{ $loop->index }}">
                <div class="js-record__art">
                    <div class="js-record__type">{{ $release->type }}</div>

                    @if($release->cover_art_url)
                        <img src="{{ $release->cover_art_url }}" alt="{{ $release->title }}">
                    @else
                        <div class="js-record__initial {{ $release->is_uma_winner ? 'js-record__initial--red' : '' }}">
                            {{ $release->initials }}
                        </div>
                    @endif

                    @if($release->is_uma_winner)
                        <div style="position:absolute;bottom:.75rem;right:.75rem;
                                    background:rgba(232,38,26,.9);
                                    font-family:var(--js-mono);font-size:.52rem;
                                    letter-spacing:.08em;text-transform:uppercase;
                                    padding:.22rem .55rem;color:#fff;
                                    display:flex;align-items:center;gap:.3rem;">
                            <i class="fas fa-trophy" style="font-size:.5rem;"></i> UMA
                        </div>
                    @endif

                    {{-- Play hint overlay (JS will add this, but we scaffold it) --}}
                    @if($release->tracks->count())
                        <div class="js-record__play-hint">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="white"><path d="M8 5v14l11-7z"/></svg>
                            <div style="font-family:var(--js-mono);font-size:.55rem;
                                        letter-spacing:.1em;text-transform:uppercase;
                                        color:rgba(255,255,255,.7);margin-top:.4rem;">
                                {{ $release->tracks->count() }} track{{ $release->tracks->count() !== 1 ? 's' : '' }}
                            </div>
                        </div>
                    @endif
                </div>

                <div class="js-record__body">
                    <div class="js-record__title">{{ $release->title }}</div>
                    <div class="js-record__meta">
                        @if($release->year)<em>{{ $release->year }}</em> &nbsp;·&nbsp; @endif
                        {{ $release->note ?: $release->type }}
                    </div>

                   {{-- Streaming links + download --}}
@if($release->soundcloud_url || $release->spotify_url || $release->apple_music_url || $release->youtube_url || $release->zip_url || $release->tracks->count())
<div style="display:flex;align-items:center;gap:.85rem;margin-top:.9rem;flex-wrap:wrap;">
    @if($release->soundcloud_url)
        <a href="{{ $release->soundcloud_url }}" target="_blank" rel="noopener"
           title="SoundCloud" style="color:var(--js-orange);font-size:1rem;"
           onclick="event.stopPropagation()">
            <i class="fab fa-soundcloud"></i>
        </a>
    @endif
    @if($release->spotify_url)
        <a href="{{ $release->spotify_url }}" target="_blank" rel="noopener"
           title="Spotify" style="color:#1DB954;font-size:1rem;"
           onclick="event.stopPropagation()">
            <i class="fab fa-spotify"></i>
        </a>
    @endif
    @if($release->apple_music_url)
        <a href="{{ $release->apple_music_url }}" target="_blank" rel="noopener"
           title="Apple Music" style="color:#fc3c44;font-size:1rem;"
           onclick="event.stopPropagation()">
            <i class="fab fa-apple"></i>
        </a>
    @endif
    @if($release->youtube_url)
        <a href="{{ $release->youtube_url }}" target="_blank" rel="noopener"
           title="YouTube" style="color:#ff0000;font-size:1rem;"
           onclick="event.stopPropagation()">
            <i class="fab fa-youtube"></i>
        </a>
    @endif

    {{-- Download: ZIP if available, otherwise the single track's audio file --}}
    @if($release->zip_url)
        <a href="{{ $release->zip_url }}" download
           title="Download ZIP"
           style="color:var(--js-text-dim);font-size:.85rem;margin-left:auto;
                  display:inline-flex;align-items:center;gap:.35rem;
                  font-family:var(--js-mono);font-size:.58rem;letter-spacing:.06em;"
           onclick="event.stopPropagation()">
            <i class="fas fa-download"></i> ZIP
        </a>
    @elseif($release->tracks->count() === 1)
        @php $singleTrack = $release->tracks->first(); @endphp
        <a href="{{ asset('storage/' . $singleTrack->audio_file) }}" download
           title="Download track"
           style="color:var(--js-text-dim);margin-left:auto;
                  display:inline-flex;align-items:center;gap:.35rem;
                  font-family:var(--js-mono);font-size:.58rem;letter-spacing:.06em;"
           onclick="event.stopPropagation()">
            <i class="fas fa-download"></i> MP3
        </a>
    @elseif($release->tracks->count() > 1 && !$release->zip_url)
        {{-- Multi-track release with no ZIP — show a muted hint --}}
        <span style="margin-left:auto;font-family:var(--js-mono);font-size:.55rem;
                     color:var(--js-text-dim);letter-spacing:.06em;"
              title="No ZIP available">
            <i class="fas fa-download" style="opacity:.3;"></i>
        </span>
    @endif
</div>
@endif

                    {{-- Track list (collapsed by default, shown if tracks exist) --}}
                    @if($release->tracks->count())
                    <div class="js-tracklist" id="tl-{{ $release->id }}">
                        @foreach($release->tracks->sortBy('track_number') as $track)
                        <div class="js-track-row" data-release-idx="{{ $loop->parent->index }}" data-track-idx="{{ $loop->index }}">
                            <span class="js-track-row__num">{{ str_pad($track->track_number, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="js-track-row__title">{{ $track->title }}</span>
                            @if($track->duration_formatted !== '—')
                                <span class="js-track-row__dur">{{ $track->duration_formatted }}</span>
                            @endif
                            <a href="{{ asset('storage/' . $track->audio_file) }}" download
                               title="Download {{ $track->title }}"
                               style="color:var(--js-text-dim);display:flex;align-items:center;flex-shrink:0;
                                      transition:color .15s;padding:2px 4px;"
                               onclick="event.stopPropagation()"
                               onmouseover="this.style.color='var(--js-red)'"
                               onmouseout="this.style.color='var(--js-text-dim)'">
                                <i class="fas fa-download" style="font-size:.6rem;"></i>
                            </a>
                            <span class="js-track-row__play">
                                <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                            </span>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        {{-- SoundCloud strip — uses first release with a SC URL --}}
        @php $scRelease = $releases->firstWhere('soundcloud_url', '!=', null); @endphp
        @if($scRelease)
        <div class="js-stream" style="margin-top:1.5rem;">
            <i class="fab fa-soundcloud js-stream__icon"></i>
            <div>
                <div class="js-stream__label">Stream on SoundCloud</div>
                <div class="js-stream__name">Just Slick · Full Catalogue</div>
            </div>
            <a href="https://soundcloud.com/justslick23" target="_blank" rel="noopener"
               class="js-btn js-btn--ghost" style="margin-left:auto;">
                Open SoundCloud <i class="fas fa-external-link-alt" style="font-size:.55rem"></i>
            </a>
        </div>
        @endif
    @endif
</section>


    {{-- ══ SERVICES ════════════════════════════════════ --}}
    <section class="js-section js-grain" id="licensing">
        <div class="js-section-head">
            <div>
                <div class="js-section-label">Work Together</div>
                <h2 class="js-section-title">SERVICES</h2>
            </div>
            <div class="js-section-num">03 / 04</div>
        </div>

        <div class="js-services">
            <div class="js-service">
                <div class="js-service__num">01</div>
                <div class="js-service__title">Beat Licensing</div>
                <p class="js-service__desc">
                    Need a beat for your next project?
                    Leases and exclusive rights available.
                    Reach out with your brief and budget.
                </p>
                <div class="js-service__tag">Lease · Exclusive · Unlimited</div>
            </div>
            <div class="js-service">
                <div class="js-service__num">02</div>
                <div class="js-service__title">Custom Production</div>
                <p class="js-service__desc">
                    A beat built specifically for you —
                    your sound, your direction. Trap, hip-hop,
                    afrobeats, or something with no name yet.
                </p>
                <div class="js-service__tag">From Brief · Tailored</div>
            </div>
            <div class="js-service">
                <div class="js-service__num">03</div>
                <div class="js-service__title">Mixing &amp; Finishing</div>
                <p class="js-service__desc">
                    Got a track that needs polish? Mixing
                    and arrangement finishing to get your
                    record sounding like it belongs on radio.
                </p>
                <div class="js-service__tag">Mix · Master · Deliver</div>
            </div>
        </div>
    </section>

    {{-- ══ CTA ══════════════════════════════════════════ --}}
    <section class="js-cta js-grain" id="contact">
        <div class="js-cta__pre">04 / 04 — Hit The Inbox</div>
        <h2 class="js-cta__headline">
            LET'S<br><em>BUILD</em><br>SOMETHING
        </h2>
        <p class="js-cta__sub">
            Beat inquiry, custom production, or just want to talk music —
            the inbox is open.
        </p>
        <div class="js-cta__actions">
            <a href="mailto:hello@tokelofoso.online?subject=Beat%20Inquiry%20—%20Just%20Slick"
               class="js-btn js-btn--primary">
                <i class="fas fa-envelope" style="font-size:0.6rem"></i>
                Email Just Slick
            </a>
            <a href="{{ route('contact') }}" class="js-btn js-btn--ghost">
                Use Contact Form
            </a>
        </div>
    </section>

</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    var releases = {!! json_encode($playerData) !!};

    // Click on card art → play whole release from track 1
    document.querySelectorAll('.js-record').forEach(function (card) {
        var idx = parseInt(card.dataset.index);
        var rel = releases[idx];
        if (!rel || !rel.tracks.length) return;

        card.querySelector('.js-record__art').addEventListener('click', function () {
            window.JSPlayer.playQueue(rel.tracks, 0);
        });
        card.querySelector('.js-record__art').style.cursor = 'pointer';
    });

    // Click individual track row → play from that track
    document.querySelectorAll('.js-track-row').forEach(function (row) {
        var relIdx   = parseInt(row.dataset.releaseIdx);
        var trackIdx = parseInt(row.dataset.trackIdx);
        var rel      = releases[relIdx];
        if (!rel) return;

        row.addEventListener('click', function (e) {
            e.stopPropagation();
            window.JSPlayer.playQueue(rel.tracks, trackIdx);
        });
    });

    // Scroll-in animation
    var obs = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
            if (e.isIntersecting) {
                e.target.style.opacity   = '1';
                e.target.style.transform = 'translateY(0)';
                obs.unobserve(e.target);
            }
        });
    }, { threshold: 0.07 });

    document.querySelectorAll('.js-section,.js-bio__card,.js-bio__text,.js-record,.js-service,.js-cta')
        .forEach(function (el, i) {
            el.style.opacity    = '0';
            el.style.transform  = 'translateY(28px)';
            el.style.transition = 'opacity .65s ease, transform .65s ease';
            el.style.transitionDelay = (i * 0.05) + 's';
            obs.observe(el);
        });
});
</script>
@endsection