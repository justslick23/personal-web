{{--
    resources/views/portfolio/_card.blade.php
    Accepts: $work (PortfolioItem model), $i (loop index for stagger)
--}}
@php
    $title    = is_array($work) ? $work['title']       : $work->title;
    $category = is_array($work) ? $work['category']    : $work->category;
    $sub      = is_array($work) ? ($work['sub'] ?? '') : ($work->sub ?? $work->category ?? '');
    $desc     = is_array($work) ? ($work['description'] ?? '') : $work->description;
    $link     = is_array($work) ? ($work['link'] ?? null) : $work->link;
    $year     = is_array($work) ? ($work['year'] ?? '') : $work->year;
    $bg       = is_array($work) ? ($work['bg']     ?? 'linear-gradient(135deg,#1a1a2e 0%,#0a0a14 100%)') : 'linear-gradient(135deg,#1a1a2e 0%,#0a0a14 100%)';
    $accent   = is_array($work) ? ($work['accent'] ?? 'var(--clr-accent)') : 'var(--clr-accent)';
    $delay    = ($i % 3) * 0.1;

    // Tags — stored as comma-separated string in DB
    $rawTags = is_array($work) ? ($work['tags'] ?? null) : $work->tags;
    if (is_array($rawTags)) {
        $tags = $rawTags;
    } elseif (is_string($rawTags) && !empty($rawTags)) {
        $tags = array_map('trim', explode(',', $rawTags));
    } else {
        $tags = [];
    }

    // Image
    $fallback  = 'https://placehold.co/800x600/161616/00e676?text=' . urlencode($title) . '&font=raleway';
    $imageFile = is_array($work) ? ($work['thumbnail'] ?? null) : $work->image;
    $imageSrc  = $imageFile ? asset('storage/' . $imageFile) : null;

    // Lightbox caption
    $caption = $title . ($sub ? ' — ' . $sub : '') . ($year ? ' (' . $year . ')' : '');
@endphp

<article
    class="pf-card scroll-reveal"
    data-category="{{ $category }}"
    style="transition-delay:{{ $delay }}s;"
>
    {{-- Thumbnail --}}
    @if($imageSrc)
        <a href="{{ $imageSrc }}"
           data-lightbox="portfolio"
           data-title="{{ $caption }}"
           class="pf-card__thumb"
           aria-label="{{ $title }}">
            <img
                class="pf-card__thumb-img"
                src="{{ $imageSrc }}"
                alt="{{ $title }}"
                loading="{{ $i < 6 ? 'eager' : 'lazy' }}"
                onerror="this.onerror=null;this.src='{{ $fallback }}'">
            <div class="pf-card__overlay"></div>
            <div class="pf-card__arrow"><i class="fas fa-expand"></i></div>
            @if($sub)<div class="pf-card__badge">{{ $sub }}</div>@endif
        </a>
    @else
        {{-- Gradient placeholder when no image --}}
        <div class="pf-card__thumb pf-card__thumb--placeholder">
            <div class="pf-card__thumb-bg" style="background:{{ $bg }};">
                @if($category === 'Software Dev')
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" style="opacity:0.18;">
                        <rect x="4" y="10" width="40" height="28" rx="4" stroke="{{ $accent }}" stroke-width="1.5"/>
                        <path d="M16 20l-6 4 6 4M32 20l6 4-6 4M22 30l4-12" stroke="{{ $accent }}" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                @else
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" style="opacity:0.18;">
                        <circle cx="24" cy="24" r="18" stroke="{{ $accent }}" stroke-width="1.5"/>
                        <path d="M24 6v36M6 24h36M10.1 10.1l27.8 27.8M37.9 10.1L10.1 37.9" stroke="{{ $accent }}" stroke-width="1" stroke-linecap="round"/>
                    </svg>
                @endif
            </div>
            @if($sub)<div class="pf-card__badge">{{ $sub }}</div>@endif
        </div>
    @endif

    {{-- Body --}}
    <div class="pf-card__body">
        <div class="pf-card__meta">
            <span class="pf-card__sub" style="color:{{ $accent }};">{{ $sub }}</span>
            @if($year)<span class="pf-card__year">{{ $year }}</span>@endif
        </div>

        <h3 class="pf-card__title">{{ $title }}</h3>

        @if($desc)
            <p class="pf-card__desc">{{ $desc }}</p>
        @endif

        @if(!empty($tags))
        <div class="pf-card__tags">
            @foreach($tags as $tag)
                <span class="pf-card__tag">{{ $tag }}</span>
            @endforeach
        </div>
        @endif

        @if($link)
            <a href="{{ $link }}" class="pf-card__ext-link" target="_blank" rel="noopener">
                Visit Project <i class="fas fa-arrow-up-right-from-square"></i>
            </a>
        @endif
    </div>
</article>