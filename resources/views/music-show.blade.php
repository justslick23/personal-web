@extends('layouts.app')

@section('title', $musicRelease->title . ' — Just Slick')

@push('head')
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Space+Mono:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
<style>
/* Reuse the same js-world variables */
.js-world {
    --js-bg: #080808; --js-bg-alt: #0e0e0e; --js-bg-card: #121212;
    --js-border: rgba(255,255,255,0.07); --js-border-hi: rgba(255,255,255,0.13);
    --js-red: #e8261a; --js-orange: #f07028;
    --js-text: #f0ede8; --js-text-mid: #888880; --js-text-dim: #3e3e3c;
    --js-display: 'Bebas Neue', sans-serif; --js-mono: 'Space Mono', monospace;
    background: var(--js-bg); color: var(--js-text);
}
[data-theme="light"] .js-world { background: var(--js-bg); color: var(--js-text); }

.js-btn {
    display: inline-flex; align-items: center; gap: 0.6rem;
    font-family: var(--js-mono); font-size: 0.68rem;
    font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase;
    padding: 0.85rem 1.65rem; border-radius: 0;
    transition: all 0.2s ease; cursor: pointer; text-decoration: none;
}
.js-btn--primary { background: var(--js-red); color: #fff; border: 1px solid var(--js-red); }
.js-btn--primary:hover { background: #c01e14; border-color: #c01e14; }
.js-btn--ghost { background: transparent; color: var(--js-text); border: 1px solid var(--js-border-hi); }
.js-btn--ghost:hover { border-color: var(--js-text-mid); }

/* ── Back bar ── */
.js-back {
    display: flex; align-items: center; gap: 1rem;
    padding: 1rem clamp(1.5rem, 6vw, 4rem);
    border-bottom: 1px solid var(--js-border);
    background: var(--js-bg-card);
}
.js-back a {
    font-family: var(--js-mono); font-size: 0.65rem;
    letter-spacing: 0.1em; text-transform: uppercase;
    color: var(--js-text-dim); text-decoration: none;
    display: inline-flex; align-items: center; gap: 0.5rem;
    transition: color 0.2s;
}
.js-back a:hover { color: var(--js-red); }

/* ── Hero ── */
.js-show-hero {
    display: grid;
    grid-template-columns: clamp(220px, 30vw, 380px) 1fr;
    gap: 0;
    border-bottom: 1px solid var(--js-border);
    min-height: 420px;
}
.js-show-art {
    position: relative;
    background: #1a1a1a;
    display: flex; align-items: center; justify-content: center;
    overflow: hidden;
    border-right: 1px solid var(--js-border);
}
.js-show-art img { width: 100%; height: 100%; object-fit: cover; display: block; }
.js-show-art__initial {
    font-family: var(--js-display); font-size: 8rem;
    color: rgba(232,38,26,0.15); line-height: 1;
}
.js-show-art__play {
    position: absolute; inset: 0;
    display: flex; align-items: center; justify-content: center;
    background: rgba(0,0,0,0); opacity: 0;
    transition: background 0.2s, opacity 0.2s;
    cursor: pointer;
}
.js-show-art:hover .js-show-art__play { background: rgba(0,0,0,0.55); opacity: 1; }
.js-show-art__play svg { width: 52px; height: 52px; fill: white; }

.js-show-meta {
    padding: 3rem clamp(1.5rem, 5vw, 3.5rem);
    display: flex; flex-direction: column; justify-content: space-between;
    gap: 2rem;
}
.js-show-type {
    font-family: var(--js-mono); font-size: 0.65rem;
    letter-spacing: 0.14em; text-transform: uppercase;
    color: var(--js-red); margin-bottom: 0.5rem;
}
.js-show-title {
    font-family: var(--js-display);
    font-size: clamp(3rem, 8vw, 6rem);
    line-height: 0.88; letter-spacing: 0.02em;
    color: var(--js-text); margin-bottom: 1rem;
}
.js-show-note {
    font-family: var(--js-mono); font-size: 0.7rem;
    color: var(--js-text-mid); line-height: 1.75;
    border-left: 2px solid var(--js-red);
    padding-left: 1rem; max-width: 44ch;
}
.js-show-actions { display: flex; gap: 0.75rem; flex-wrap: wrap; align-items: center; }
.js-show-links { display: flex; gap: 1.25rem; align-items: center; margin-left: 0.5rem; }
.js-show-links a { font-size: 1.25rem; transition: opacity 0.2s; }
.js-show-links a:hover { opacity: 0.7; }

@if($musicRelease->is_uma_winner)
.js-uma-badge {
    display: inline-flex; align-items: center; gap: 0.5rem;
    font-family: var(--js-mono); font-size: 0.62rem;
    letter-spacing: 0.1em; text-transform: uppercase;
    color: var(--js-red);
    border: 1px solid rgba(232,38,26,0.4);
    background: rgba(232,38,26,0.06);
    padding: 0.4rem 0.9rem;
}
@endif

/* ── Tracklist ── */
.js-show-tracks {
    padding: 4rem clamp(1.5rem, 6vw, 4rem);
    border-bottom: 1px solid var(--js-border);
}
.js-show-tracks h3 {
    font-family: var(--js-display); font-size: 2rem;
    letter-spacing: 0.06em; color: var(--js-text);
    margin-bottom: 1.5rem;
}
.js-tl-row {
    display: grid;
    grid-template-columns: 2.5rem 1fr auto auto;
    align-items: center; gap: 1rem;
    padding: 1rem 0.5rem;
    border-bottom: 1px solid var(--js-border);
    cursor: pointer; transition: background 0.15s; border-radius: 2px;
}
.js-tl-row:last-child { border-bottom: none; }
.js-tl-row:hover { background: rgba(232,38,26,0.06); }
.js-tl-row:hover .js-tl-num { display: none; }
.js-tl-row:hover .js-tl-play-icon { display: flex; }
.js-tl-num {
    font-family: var(--js-mono); font-size: 0.72rem;
    color: var(--js-text-dim); text-align: center;
}
.js-tl-play-icon {
    display: none; align-items: center; justify-content: center;
    color: var(--js-red);
}
.js-tl-title {
    font-family: var(--js-mono); font-size: 0.78rem;
    color: var(--js-text); white-space: nowrap;
    overflow: hidden; text-overflow: ellipsis;
}
.js-tl-dur {
    font-family: var(--js-mono); font-size: 0.68rem;
    color: var(--js-text-dim);
}
.js-tl-dl {
    color: var(--js-text-dim); display: flex; align-items: center;
    padding: 4px 6px; transition: color 0.15s; font-size: 0.8rem;
}
.js-tl-dl:hover { color: var(--js-red); }

/* ── Responsive ── */
@media (max-width: 780px) {
    .js-show-hero { grid-template-columns: 1fr; }
    .js-show-art { min-height: 280px; }
    .js-tl-row { grid-template-columns: 2rem 1fr auto; }
    .js-tl-dur { display: none; }
}
</style>
@endpush

@section('content')
<div class="js-world">

    {{-- Back --}}
    <div class="js-back">
        <a href="{{ route('music') }}">
            <i class="fas fa-arrow-left" style="font-size:0.6rem"></i> Back to Discography
        </a>
    </div>

    {{-- Hero --}}
    <div class="js-show-hero">
        <div class="js-show-art" id="js-art-btn">
            @if($musicRelease->cover_art_url)
                <img src="{{ $musicRelease->cover_art_url }}" alt="{{ $musicRelease->title }}">
            @else
                <div class="js-show-art__initial">{{ $musicRelease->initials }}</div>
            @endif
            @if($musicRelease->tracks->count())
            <div class="js-show-art__play">
                <svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
            </div>
            @endif
        </div>

        <div class="js-show-meta">
            <div>
                <div class="js-show-type">
                    {{ $musicRelease->type }}@if($musicRelease->year) · {{ $musicRelease->year }}@endif
                </div>
                <h1 class="js-show-title">{{ $musicRelease->title }}</h1>

                @if($musicRelease->is_uma_winner)
                <div class="js-uma-badge" style="margin-bottom:1.25rem;">
                    <i class="fas fa-trophy"></i> UMA Best Producer
                </div>
                @endif

                @if($musicRelease->note)
                <p class="js-show-note">{{ $musicRelease->note }}</p>
                @endif
            </div>

            <div>
                <div class="js-show-actions">
                    @if($musicRelease->tracks->count())
                    <button class="js-btn js-btn--primary" id="js-play-all">
                        <i class="fas fa-play" style="font-size:0.6rem"></i> Play All
                    </button>
                    @endif

                    @if($musicRelease->zip_file)
                    <a href="{{ asset('storage/' . $musicRelease->zip_file) }}" download
                    onclick="trackDownload('{{ $musicRelease->slug }}', 'zip', null)"
                    class="js-btn js-btn--ghost">
                        <i class="fas fa-download" style="font-size:0.6rem"></i> Download ZIP
                    </a>
                    @endif

                    <div class="js-show-links">
                        @if($musicRelease->soundcloud_url)
                        <a href="{{ $musicRelease->soundcloud_url }}" target="_blank" rel="noopener"
                           style="color:var(--js-orange)" title="SoundCloud">
                            <i class="fab fa-soundcloud"></i>
                        </a>
                        @endif
                        @if($musicRelease->spotify_url)
                        <a href="{{ $musicRelease->spotify_url }}" target="_blank" rel="noopener"
                           style="color:#1DB954" title="Spotify">
                            <i class="fab fa-spotify"></i>
                        </a>
                        @endif
                        @if($musicRelease->apple_music_url)
                        <a href="{{ $musicRelease->apple_music_url }}" target="_blank" rel="noopener"
                           style="color:#fc3c44" title="Apple Music">
                            <i class="fab fa-apple"></i>
                        </a>
                        @endif
                        @if($musicRelease->youtube_url)
                        <a href="{{ $musicRelease->youtube_url }}" target="_blank" rel="noopener"
                           style="color:#ff0000" title="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                        @endif
                    </div>
                </div>

                <div style="margin-top:1rem;font-family:var(--js-mono);font-size:0.6rem;
                        letter-spacing:0.1em;color:var(--js-text-dim);display:flex;gap:1.5rem;">
                <span>{{ $musicRelease->tracks->count() }} TRACK{{ $musicRelease->tracks->count() !== 1 ? 'S' : '' }}</span>
                <span><i class="fas fa-download" style="margin-right:0.35rem;color:var(--js-red);"></i>{{ $musicRelease->downloadLogs->count() }} DOWNLOAD{{ $musicRelease->downloadLogs->count() !== 1 ? 'S' : '' }}</span>
            </div>
            </div>
        </div>
    </div>

    {{-- Tracklist --}}
    @if($musicRelease->tracks->count())
    <div class="js-show-tracks">
        <h3>Tracklist</h3>
        @foreach($musicRelease->tracks->sortBy('track_number') as $track)
        <div class="js-tl-row" data-track-idx="{{ $loop->index }}">
            <div class="js-tl-num">{{ str_pad($track->track_number, 2, '0', STR_PAD_LEFT) }}</div>
            <div class="js-tl-play-icon">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
            </div>
            <div class="js-tl-title">{{ $track->title }}</div>
            @if($track->duration_formatted !== '—')
            <div class="js-tl-dur">{{ $track->duration_formatted }}</div>
            @else
            <div></div>
            @endif
            <a href="{{ asset('storage/' . $track->audio_file) }}" download
   class="js-tl-dl" title="Download {{ $track->title }}"
   onclick="event.stopPropagation(); trackDownload('{{ $musicRelease->slug }}', 'track', {{ $track->id }})">
    <i class="fas fa-download"></i>
</a>
        </div>
        @endforeach
    </div>
    @endif

</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var playerData = {!! json_encode($playerData) !!};
    var release    = playerData[0];

    function playFrom(idx) {
        if (window.JSPlayer && release.tracks.length) {
            window.JSPlayer.playQueue(release.tracks, idx);
        }
    }

    // Play all button
    var playAllBtn = document.getElementById('js-play-all');
    if (playAllBtn) playAllBtn.addEventListener('click', function () { playFrom(0); });

    // Art click
    var artBtn = document.getElementById('js-art-btn');
    if (artBtn) artBtn.addEventListener('click', function () { playFrom(0); });

    // Individual track rows
    document.querySelectorAll('.js-tl-row').forEach(function (row) {
        row.addEventListener('click', function (e) {
            playFrom(parseInt(row.dataset.trackIdx));
        });
    });
});
</script>
@endsection