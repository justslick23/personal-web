{{-- Modern Page Header Component --}}
<section class="page-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1 class="display-3 fw-bold mb-4 scroll-animate">
                    {{ $title ?? 'Page Title' }}
                </h1>
                
                @isset($breadcrumbs)
                <nav aria-label="breadcrumb" class="scroll-animate" style="animation-delay: 0.2s;">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">
                                <i class="fas fa-home me-2"></i>Home
                            </a>
                        </li>
                        @foreach ($breadcrumbs as $breadcrumb)
                            @if (!$loop->last)
                                <li class="breadcrumb-item">
                                    <a href="{{ $breadcrumb['url'] }}">
                                        {{ $breadcrumb['name'] }}
                                    </a>
                                </li>
                            @else
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span class="text-gradient">{{ $breadcrumb['name'] }}</span>
                                </li>
                            @endif
                        @endforeach
                    </ol>
                </nav>
                @endisset
            </div>
        </div>
    </div>
</section>

@push('body-scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Scroll animations for page header
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.scroll-animate').forEach(el => {
        observer.observe(el);
    });
});
</script>
@endpush