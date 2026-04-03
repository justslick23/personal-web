{{-- ═══════════════════════════════════════════════
     JUST SLICK — Site-wide Music Player
     Include in layouts/app.blade.php before </body>
════════════════════════════════════════════════ --}}
<div id="js-player" class="jsp" aria-label="Music Player" style="display:none;">

    {{-- Progress bar (top edge) --}}
    <div class="jsp__progress-wrap" id="jsp-progress-wrap">
        <div class="jsp__progress-bar" id="jsp-bar"></div>
        <input type="range" class="jsp__progress-seek" id="jsp-seek"
               min="0" value="0" step="0.1" aria-label="Seek">
    </div>

    <div class="jsp__inner">

        {{-- Track info --}}
        <div class="jsp__info">
            <div class="jsp__art" id="jsp-art">
                <img id="jsp-art-img" src="" alt="" style="display:none;">
                <span id="jsp-art-init"></span>
            </div>
            <div class="jsp__meta">
                <div class="jsp__track-title" id="jsp-title">—</div>
                <div class="jsp__track-release" id="jsp-release">Just Slick</div>
            </div>
        </div>

        {{-- Controls --}}
        <div class="jsp__controls">
            <button class="jsp__btn" id="jsp-prev" aria-label="Previous">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M6 6h2v12H6zm3.5 6 8.5 6V6z"/>
                </svg>
            </button>
            <button class="jsp__btn jsp__btn--play" id="jsp-play" aria-label="Play">
                <svg id="jsp-icon-play" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M8 5v14l11-7z"/>
                </svg>
                <svg id="jsp-icon-pause" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="display:none;">
                    <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>
                </svg>
            </button>
            <button class="jsp__btn" id="jsp-next" aria-label="Next">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M6 18l8.5-6L6 6v12zM16 6v12h2V6h-2z"/>
                </svg>
            </button>
        </div>

        {{-- Time + Volume --}}
        <div class="jsp__right">
            <div class="jsp__time" id="jsp-time">0:00 / 0:00</div>
            <div class="jsp__vol-wrap">
                <button class="jsp__btn jsp__btn--mute" id="jsp-mute" aria-label="Mute">
                    <svg id="jsp-vol-icon" width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3A4.5 4.5 0 0 0 14 7.97v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77 0-4.28-2.99-7.86-7-8.77z"/>
                    </svg>
                </button>
                <input type="range" class="jsp__vol" id="jsp-vol"
                       min="0" max="1" step="0.02" value="0.8" aria-label="Volume">
            </div>
            <button class="jsp__btn jsp__btn--close" id="jsp-close" aria-label="Close player">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19 6.41 17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                </svg>
            </button>
        </div>

    </div>
</div>

<audio id="jsp-audio" preload="none"></audio>

<style>
:root {
    --jsp-h: 64px;
    --jsp-bg: #0d0d0d;
    --jsp-border: rgba(255,255,255,0.08);
    --jsp-red: #e8261a;
    --jsp-text: #f0ede8;
    --jsp-dim: #555550;
    --jsp-accent: #e8261a;
}

.jsp {
    position: fixed;
    bottom: 0; left: 0; right: 0;
    height: var(--jsp-h);
    background: var(--jsp-bg);
    border-top: 1px solid var(--jsp-border);
    z-index: 9999;
    transform: translateY(100%);
    transition: transform 0.35s cubic-bezier(0.4,0,0.2,1);
    font-family: 'Space Mono', monospace;
    user-select: none;
}
.jsp.jsp--visible {
    transform: translateY(0);
}

/* Progress */
.jsp__progress-wrap {
    position: absolute;
    top: -3px; left: 0; right: 0;
    height: 3px;
    background: rgba(255,255,255,0.06);
    cursor: pointer;
}
.jsp__progress-bar {
    height: 100%;
    width: 0%;
    background: var(--jsp-red);
    pointer-events: none;
    transition: width 0.1s linear;
}
.jsp__progress-seek {
    position: absolute;
    inset: -8px 0;
    width: 100%;
    height: 19px;
    opacity: 0;
    cursor: pointer;
    margin: 0;
}

/* Inner layout */
.jsp__inner {
    display: flex;
    align-items: center;
    height: 100%;
    padding: 0 1.25rem;
    gap: 1.5rem;
}

/* Art */
.jsp__art {
    width: 38px; height: 38px;
    flex-shrink: 0;
    background: #1a1a1a;
    border: 1px solid var(--jsp-border);
    display: flex; align-items: center; justify-content: center;
    overflow: hidden;
    position: relative;
}
.jsp__art img {
    width: 100%; height: 100%; object-fit: cover; display: block;
}
#jsp-art-init {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 0.95rem; color: rgba(255,255,255,0.15);
    letter-spacing: 0.05em;
}

/* Meta */
.jsp__info {
    display: flex; align-items: center; gap: 0.75rem;
    min-width: 0; flex: 1;
}
.jsp__meta { min-width: 0; }
.jsp__track-title {
    font-size: 0.68rem; font-weight: 700;
    letter-spacing: 0.06em; text-transform: uppercase;
    color: var(--jsp-text);
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    max-width: 220px;
}
.jsp__track-release {
    font-size: 0.58rem; letter-spacing: 0.08em;
    color: var(--jsp-dim); margin-top: 2px;
    text-transform: uppercase;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    max-width: 220px;
}

/* Controls */
.jsp__controls {
    display: flex; align-items: center; gap: 0.35rem;
    flex-shrink: 0;
}
.jsp__btn {
    background: none; border: none; cursor: pointer;
    color: var(--jsp-dim);
    display: flex; align-items: center; justify-content: center;
    padding: 6px;
    transition: color 0.15s;
    border-radius: 2px;
}
.jsp__btn:hover { color: var(--jsp-text); }
.jsp__btn--play {
    width: 36px; height: 36px;
    border: 1px solid rgba(232,38,26,0.4) !important;
    color: var(--jsp-red) !important;
    background: rgba(232,38,26,0.08) !important;
    padding: 0;
    transition: background 0.15s, border-color 0.15s !important;
}
.jsp__btn--play:hover {
    background: rgba(232,38,26,0.18) !important;
    border-color: var(--jsp-red) !important;
}
.jsp__btn--close { opacity: 0.4; }
.jsp__btn--close:hover { opacity: 1; color: var(--jsp-red); }

/* Right: time + vol */
.jsp__right {
    display: flex; align-items: center; gap: 0.75rem;
    flex-shrink: 0;
}
.jsp__time {
    font-size: 0.58rem; letter-spacing: 0.06em;
    color: var(--jsp-dim); white-space: nowrap;
    min-width: 80px; text-align: center;
}
.jsp__vol-wrap {
    display: flex; align-items: center; gap: 0.4rem;
}
.jsp__vol {
    width: 72px; height: 3px;
    -webkit-appearance: none; appearance: none;
    background: rgba(255,255,255,0.12);
    border-radius: 0; outline: none; cursor: pointer;
}
.jsp__vol::-webkit-slider-thumb {
    -webkit-appearance: none;
    width: 10px; height: 10px;
    background: var(--jsp-red);
    border-radius: 50%; cursor: pointer;
}
.jsp__vol::-moz-range-thumb {
    width: 10px; height: 10px;
    background: var(--jsp-red);
    border: none; border-radius: 50%; cursor: pointer;
}

/* Push page content up when player is visible */
body.jsp-active {
    padding-bottom: var(--jsp-h);
}

@media (max-width: 600px) {
    .jsp__right .jsp__vol-wrap { display: none; }
    .jsp__time { min-width: 60px; font-size: 0.54rem; }
    .jsp__track-title { max-width: 130px; }
    .jsp__track-release { display: none; }
    .jsp__inner { gap: 0.85rem; padding: 0 0.85rem; }
}
</style>

<script>
(function () {
    'use strict';

    var audio    = document.getElementById('jsp-audio');
    var player   = document.getElementById('js-player');
    var bar      = document.getElementById('jsp-bar');
    var seek     = document.getElementById('jsp-seek');
    var btnPlay  = document.getElementById('jsp-play');
    var btnPrev  = document.getElementById('jsp-prev');
    var btnNext  = document.getElementById('jsp-next');
    var btnMute  = document.getElementById('jsp-mute');
    var btnClose = document.getElementById('jsp-close');
    var volSldr  = document.getElementById('jsp-vol');
    var timeEl   = document.getElementById('jsp-time');
    var titleEl  = document.getElementById('jsp-title');
    var relEl    = document.getElementById('jsp-release');
    var artImg   = document.getElementById('jsp-art-img');
    var artInit  = document.getElementById('jsp-art-init');
    var iconPlay = document.getElementById('jsp-icon-play');
    var iconPause= document.getElementById('jsp-icon-pause');

    var queue    = [];
    var cur      = 0;
    var playing  = false;

    /* ── Helpers ── */
    function fmt(s) {
        s = Math.floor(s || 0);
        return Math.floor(s / 60) + ':' + ('0' + (s % 60)).slice(-2);
    }

    function setPlayIcon(isPlaying) {
        iconPlay.style.display  = isPlaying ? 'none' : 'block';
        iconPause.style.display = isPlaying ? 'block' : 'none';
    }

    function showPlayer() {
        player.style.display = 'flex';
        requestAnimationFrame(function () {
            player.classList.add('jsp--visible');
            document.body.classList.add('jsp-active');
        });
    }

    function hidePlayer() {
        player.classList.remove('jsp--visible');
        document.body.classList.remove('jsp-active');
        audio.pause();
        playing = false;
        setPlayIcon(false);
        setTimeout(function () { player.style.display = 'none'; }, 360);
    }

    function loadTrack(idx, autoplay) {
        var t = queue[idx];
        if (!t) return;
        cur = idx;

        audio.src = t.src;
        audio.load();

        titleEl.textContent = t.title;
        relEl.textContent   = t.release;

        if (t.art) {
            artImg.src = t.art;
            artImg.style.display = 'block';
            artInit.style.display = 'none';
        } else {
            artImg.style.display = 'none';
            artInit.textContent  = t.initials || 'JS';
            artInit.style.display = 'block';
        }

        bar.style.width = '0%';
        seek.value = 0;
        timeEl.textContent = '0:00 / 0:00';

        if (autoplay) {
            audio.play().then(function () {
                playing = true; setPlayIcon(true);
            }).catch(function () {});
        }
        showPlayer();
    }

    /* ── Transport ── */
    btnPlay.addEventListener('click', function () {
        if (!queue.length) return;
        if (playing) {
            audio.pause(); playing = false; setPlayIcon(false);
        } else {
            if (!audio.src) loadTrack(cur, true);
            else audio.play().then(function () { playing = true; setPlayIcon(true); }).catch(function(){});
        }
    });

    btnPrev.addEventListener('click', function () {
        if (audio.currentTime > 3) { audio.currentTime = 0; return; }
        loadTrack((cur - 1 + queue.length) % queue.length, playing);
    });

    btnNext.addEventListener('click', function () {
        loadTrack((cur + 1) % queue.length, playing);
    });

    btnClose.addEventListener('click', hidePlayer);

    /* ── Seek ── */
    seek.addEventListener('input', function () {
        if (audio.duration) audio.currentTime = seek.value;
    });

    /* ── Volume ── */
    audio.volume = 0.8;
    volSldr.addEventListener('input', function () {
        audio.volume = this.value;
        audio.muted  = +this.value === 0;
    });

    btnMute.addEventListener('click', function () {
        audio.muted = !audio.muted;
        volSldr.value = audio.muted ? 0 : audio.volume;
    });

    /* ── Audio events ── */
    audio.addEventListener('timeupdate', function () {
        if (!audio.duration) return;
        var pct = (audio.currentTime / audio.duration) * 100;
        bar.style.width = pct + '%';
        seek.max        = audio.duration;
        seek.value      = audio.currentTime;
        timeEl.textContent = fmt(audio.currentTime) + ' / ' + fmt(audio.duration);
    });

    audio.addEventListener('ended', function () {
        loadTrack((cur + 1) % queue.length, true);
    });

    audio.addEventListener('pause', function () { playing = false; setPlayIcon(false); });
    audio.addEventListener('play',  function () { playing = true;  setPlayIcon(true);  });

    /* ── Public API ── */
    window.JSPlayer = {
        /**
         * Play a single track immediately.
         * @param {object} t — { src, title, release, art, initials }
         */
        playTrack: function (t) {
            queue = [t]; cur = 0;
            loadTrack(0, true);
        },

        /**
         * Load a full queue (array of track objects) and play from index.
         * @param {Array}  tracks
         * @param {number} startIdx
         */
        playQueue: function (tracks, startIdx) {
            queue = tracks; cur = startIdx || 0;
            loadTrack(cur, true);
        },

        /** Add a track to the end of the current queue. */
        enqueue: function (t) {
            queue.push(t);
        },

        /** Show the player bar without playing (e.g. on page load if paused). */
        show: showPlayer,

        /** Hide and stop. */
        hide: hidePlayer,
    };

})();
</script>