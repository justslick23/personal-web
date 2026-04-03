{{-- resources/views/partials/footer.blade.php --}}

<section class="ct-cta">
    <div class="ct-cta__noise"></div>
    <div class="mn-container">
        <div class="ct-cta__inner">
            <div class="ct-cta__left scroll-reveal">
                <h2 class="ct-cta__headline">
                    Got something<br>
                    <em style="font-style:italic;color:var(--clr-accent)">to say?</em>
                    <span class="dim"> I'm around.</span>
                </h2>
            </div>
            <span class="ct-cta__asterisk scroll-reveal scroll-reveal-delay-1">✳</span>
        </div>

        <div class="ct-cta__divider"></div>

        <div class="ct-cta__inner scroll-reveal scroll-reveal-delay-1">
            <div class="ct-cta__meta">
                <div class="ct-cta__meta-block">
                    <span class="ct-cta__meta-label">Email</span>
                    <span class="ct-cta__meta-val">
                        <a href="mailto:hello@tokelofoso.online">hello@tokelofoso.online</a>
                    </span>
                </div>
                <div class="ct-cta__meta-block">
                    <span class="ct-cta__meta-label">Phone</span>
                    <a href="tel:+26668231628" class="ct-cta__book">(+266) 6823 1628</a>
                </div>
                <div class="ct-cta__meta-block">
                    <span class="ct-cta__meta-label">Social</span>
                   {{-- ct-cta__socials --}}
                <div class="ct-cta__socials">
                    <a href="https://web.facebook.com/tokelo.foso" class="ct-cta__social" aria-label="Facebook" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.linkedin.com/in/tokelo-foso/" class="ct-cta__social" aria-label="LinkedIn" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a>
                    <a href="https://soundcloud.com/justslick23" class="ct-cta__social" aria-label="SoundCloud" target="_blank" rel="noopener"><i class="fab fa-soundcloud"></i></a>
                    <a href="https://www.instagram.com/slkstrgrm/" class="ct-cta__social" aria-label="Instagram" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>
                    <a href="https://x.com/slkstr_" class="ct-cta__social" aria-label="X" target="_blank" rel="noopener"><i class="fab fa-x-twitter"></i></a>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="mn-footer" role="contentinfo">
    <div class="mn-container">

        <div class="mn-footer__top">
            <div class="mn-footer__brand">
                <a href="{{ route('home') }}" class="mn-nav__logo" aria-label="Home">
                    <span class="mn-nav__logo-mark">TF</span>
                    <span class="mn-nav__logo-name">Tokelo<em>Foso</em></span>
                </a>
                <p class="mn-footer__tagline">
                    Developer and designer.<br>Based in Maseru, Lesotho.
                </p>
            </div>

            <nav class="mn-footer__nav" aria-label="Footer navigation">
                <div class="mn-footer__col">
                    <h6 class="mn-footer__col-title">Pages</h6>
                    <ul role="list">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About</a></li>
                        <li><a href="{{ route('portfolio') }}">Work</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
                <div class="mn-footer__col">
                    <h6 class="mn-footer__col-title">Work</h6>
                    <ul role="list">
                        <li><a href="{{ route('portfolio') }}">Web Design</a></li>
                        <li><a href="{{ route('portfolio') }}">UI / UX</a></li>
                        <li><a href="{{ route('portfolio') }}">Branding</a></li>
                        <li><a href="{{ route('portfolio') }}">Development</a></li>
                    </ul>
                </div>
                <div class="mn-footer__col">
                    <h6 class="mn-footer__col-title">Contact</h6>
                    <ul role="list">
                        <li><a href="mailto:hello@tokelofoso.online">hello@tokelofoso.online</a></li>
                        <li><a href="tel:+26668231628">(+266) 6823 1628</a></li>
                        <li>Maseru, Lesotho</li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="mn-footer__bottom">
            <p class="mn-footer__copy">
                &copy; {{ date('Y') }} Tokelo Foso.
            </p>
           {{-- mn-footer__socials --}}
<div class="mn-footer__socials">
    <a href="https://www.linkedin.com/in/tokelo-foso/" class="mn-footer__social" aria-label="LinkedIn" rel="noopener noreferrer" target="_blank"><i class="fab fa-linkedin-in"></i></a>
    <a href="https://web.facebook.com/tokelo.foso" class="mn-footer__social" aria-label="Facebook" rel="noopener noreferrer" target="_blank"><i class="fab fa-facebook-f"></i></a>
    <a href="https://soundcloud.com/justslick23" class="mn-footer__social" aria-label="SoundCloud" rel="noopener noreferrer" target="_blank"><i class="fab fa-soundcloud"></i></a>
    <a href="https://www.instagram.com/slkstrgrm/" class="mn-footer__social" aria-label="Instagram" rel="noopener noreferrer" target="_blank"><i class="fab fa-instagram"></i></a>
</div>
        </div>

    </div>
</footer>