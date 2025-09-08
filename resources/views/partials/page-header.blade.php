{{-- Modern Page Header Component --}}
<section class="page-header">
    <div class="header-overlay"></div> <!-- Neon glow overlay -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1 class="page-title scroll-animate typewriter-heading" data-speed="80">
                    {{ $title ?? 'Page Title' }}
                </h1>
                <nav aria-label="breadcrumb" class="scroll-animate">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item">
                            <a href="/" class="breadcrumb-link">
                                <i class="fas fa-home me-1"></i>Home
                            </a>
                        </li>
                        @isset($breadcrumbs)
                            @foreach ($breadcrumbs as $breadcrumb)
                                @if (!$loop->last)
                                    <li class="breadcrumb-item">
                                        <a href="{{ $breadcrumb['url'] }}" class="breadcrumb-link">
                                            {{ $breadcrumb['name'] }}
                                        </a>
                                    </li>
                                @else
                                    <li class="breadcrumb-item active text-gradient" aria-current="page">
                                        {{ $breadcrumb['name'] }}
                                    </li>
                                @endif
                            @endforeach
                        @endisset
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<style>
.page-header {
    position: relative;
    text-align: center;
    padding: 220px 0 140px;
    color: white;
    margin-top: -80px;
    overflow: hidden;
    background: linear-gradient(135deg, #05010a 0%, #0f0a1a 50%, #1a0f2a 100%);
}

/* Neon glow overlay */
.page-header .header-overlay {
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at center, rgba(0, 229, 255, 0.15), transparent 60%);
    z-index: 1;
    pointer-events: none;
}

/* Ensure container content is above overlay */
.page-header .container {
    position: relative;
    z-index: 2;
}

.page-title {
    font-size: 3rem;
    font-weight: 700;
    white-space: nowrap;
    overflow: hidden;
    border-right: 2px solid #00e5ff;
    animation: blinkCursor 1s step-end infinite, glowTitle 2s ease-in-out infinite alternate;
}

@keyframes blinkCursor {
    0%, 50% { border-color: #00e5ff; }
    51%, 100% { border-color: transparent; }
}

@keyframes glowTitle {
    0% { text-shadow: 0 0 10px #00e5ff, 0 0 20px #00e5ff, 0 0 30px #00e5ff; }
    50% { text-shadow: 0 0 15px #00e5ff, 0 0 25px #00e5ff, 0 0 35px #00e5ff; }
    100% { text-shadow: 0 0 10px #00e5ff, 0 0 20px #00e5ff, 0 0 30px #00e5ff; }
}

.breadcrumb {
    background: transparent;
    padding: 0;
    margin-top: 10px;
}

.breadcrumb-item a {
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    transition: color 0.3s ease;
}

.breadcrumb-item a:hover {
    color: #00e5ff;
}

.breadcrumb-item.active {
    color: #00e5ff;
    font-weight: 600;
}

body { padding-top: 0; }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const typewriterElements = document.querySelectorAll('.typewriter-heading');

    typewriterElements.forEach(el => {
        const text = el.textContent;
        el.textContent = '';
        const speed = parseInt(el.dataset.speed) || 100;

        let index = 0;

        function type() {
            if (index < text.length) {
                el.textContent += text.charAt(index);
                index++;
                setTimeout(type, speed);
            }
        }

        type();
    });
});
</script>
