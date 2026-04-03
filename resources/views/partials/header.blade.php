{{-- =============================================
     resources/views/partials/header.blade.php
============================================== --}}
<header class="mn-header">
    <nav class="mn-nav" id="mn-nav" role="navigation" aria-label="Main navigation">
        <div class="mn-nav__inner">

            {{-- Wordmark logo --}}
            <a href="{{ route('home') }}" class="mn-nav__logo" aria-label="Tokelo Foso — Home">
                <span class="mn-nav__logo-mark">TF</span>
                <span class="mn-nav__logo-name">Toke<em>lo</em></span>
            </a>

            {{-- Desktop links --}}
            <ul class="mn-nav__links" role="list">
                <li>
                    <a href="{{ route('home') }}"
                       class="mn-nav__link {{ request()->routeIs('home') ? 'active' : '' }}">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('about') }}"
                       class="mn-nav__link {{ request()->routeIs('about*') ? 'active' : '' }}">
                        About
                    </a>
                </li>
                <li>
                    <a href="{{ route('portfolio') }}"
                       class="mn-nav__link {{ request()->routeIs('portfolio*') ? 'active' : '' }}">
                        Works
                    </a>
                </li>
                <li>
                    <a href="{{ route('contact') }}"
                       class="mn-nav__link {{ request()->routeIs('contact*') ? 'active' : '' }}">
                        Contact
                    </a>
                </li>

                {{-- Identity separator --}}
                <li aria-hidden="true" style="display:flex;align-items:center;padding:0 0.2rem;">
                    <span style="width:1px;height:14px;background:rgba(255,255,255,0.12);display:block;"></span>
                </li>

                {{-- Just Slick — distinct visual treatment --}}
                <li>
                    <a href="{{ route('music') }}"
                       class="mn-nav__link mn-nav__link--slick {{ request()->routeIs('music*') ? 'active' : '' }}">
                        <i class="fas fa-circle" style="font-size:0.38rem;vertical-align:middle;margin-right:0.3rem;color:#e8261a;"></i>Just Slick
                    </a>
                </li>
            </ul>

            {{-- Right controls --}}
            <div class="mn-nav__controls">

                {{-- Dark mode toggle --}}
                <button class="mn-nav__icon-btn mn-nav__theme-toggle"
                        id="mn-theme-toggle"
                        aria-label="Toggle dark mode"
                        title="Toggle theme">
                    <i class="fas fa-moon" id="mn-theme-icon"></i>
                </button>

                {{-- Hire me CTA --}}
                <a href="{{ route('contact') }}" class="mn-nav__cta">
                    Hit Me Up <i class="fas fa-paper-plane"></i>
                </a>

                {{-- Squiggle / availability indicator --}}
                <button class="mn-nav__icon-btn" aria-label="Availability" title="Open to work">
                    <svg width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 6 C3 2, 5 10, 7 6 C9 2, 11 10, 13 6 C15 2, 17 10, 17 6"
                              stroke="currentColor" stroke-width="1.8" stroke-linecap="round" fill="none"/>
                    </svg>
                </button>

                {{-- Hamburger (mobile only) --}}
                <button class="mn-nav__burger"
                        id="mn-burger"
                        aria-label="Toggle menu"
                        aria-expanded="false"
                        aria-controls="mn-drawer">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>

        </div>
    </nav>
</header>

{{-- Mobile Drawer --}}
<div class="mn-drawer" id="mn-drawer"
     role="dialog" aria-modal="true" aria-label="Mobile menu" hidden>
    <div class="mn-drawer__overlay" id="mn-drawer-overlay"></div>
    <div class="mn-drawer__panel">
        <button class="mn-drawer__close" id="mn-drawer-close" aria-label="Close menu">
            <i class="fas fa-xmark"></i>
        </button>
        <ul class="mn-drawer__links" role="list">
            <li><a href="{{ route('home') }}"      class="mn-drawer__link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('about') }}"     class="mn-drawer__link {{ request()->routeIs('about*') ? 'active' : '' }}">About</a></li>
            <li><a href="{{ route('portfolio') }}" class="mn-drawer__link {{ request()->routeIs('portfolio*') ? 'active' : '' }}">Works</a></li>
            <li><a href="{{ route('contact') }}"   class="mn-drawer__link {{ request()->routeIs('contact*') ? 'active' : '' }}">Contact</a></li>
            <li style="border-top:1px solid rgba(255,255,255,0.07);margin-top:0.5rem;padding-top:0.5rem;">
                <a href="{{ route('music') }}" class="mn-drawer__link mn-drawer__link--slick {{ request()->routeIs('music*') ? 'active' : '' }}">
                    <i class="fas fa-circle" style="font-size:0.38rem;vertical-align:middle;margin-right:0.5rem;color:#e8261a;"></i>Just Slick
                </a>
            </li>
        </ul>
        <div class="mn-drawer__footer">
            <a href="{{ route('contact') }}"
               class="mn-btn mn-btn--primary"
               style="width:100%;justify-content:center">
                Hire Me <i class="fas fa-paper-plane"></i>
            </a>
        </div>
    </div>
</div>

{{-- Search overlay --}}
<div class="mn-search-overlay" id="mn-search-overlay" hidden>
    <div class="mn-search-overlay__inner">
        <button class="mn-search-overlay__close" id="mn-search-close" aria-label="Close search">
            <i class="fas fa-xmark"></i>
        </button>
        <input type="search"
               class="mn-search-overlay__input"
               placeholder="Search projects, pages…"
               id="mn-search-input"
               autocomplete="off">
        <p class="mn-search-overlay__hint">Press <kbd>Esc</kbd> to close</p>
    </div>
</div>

{{-- ── Just Slick nav style — appended here to avoid a separate CSS file ── --}}
<style>
.mn-nav__link--slick {
    color: #e8261a !important;
    letter-spacing: 0.01em;
}
.mn-nav__link--slick:hover {
    color: #f07028 !important;
    background: rgba(232,38,26,0.07) !important;
}
.mn-nav__link--slick.active {
    color: #e8261a !important;
    background: rgba(232,38,26,0.08) !important;
}
.mn-nav__link--slick.active::after {
    background: #e8261a !important;
}
.mn-drawer__link--slick {
    color: #e8261a !important;
}
.mn-drawer__link--slick:hover {
    color: #f07028 !important;
}
</style>