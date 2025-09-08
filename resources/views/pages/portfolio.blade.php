@extends('layouts.app')
@php
use Illuminate\Support\Str;
@endphp

@section('content')
@section('title', 'Portfolio - Tokelo Foso')

@include('partials.page-header', [
    'title' => 'Portfolio',
    'breadcrumbs' => [
        ['name' => 'Portfolio', 'url' => route('portfolio')],
    ]
])

<!-- Hero Section -->
<section class="section-padding text-center">
    <div class="container">
        <h6 class="text-gradient text-uppercase fw-bold mb-3 text-glow scroll-animate">Expertise</h6>
        <h1 class="display-3 fw-bold mb-4 typewriter-heading scroll-animate" data-speed="80">
            Areas of <span class="text-gradient">Specialization</span>
        </h1>
        <p class="lead text-secondary mb-5 scroll-animate">Browse through my different areas of expertise and creative work.</p>
    </div>
</section>

<!-- Portfolio Section -->
<div class="container">
    <!-- Filters -->
    <div class="filter-buttons scroll-animate mb-4">
        <button class="filter-btn active" data-filter="all">All Projects</button>
        <button class="filter-btn" data-filter="web-app-design">Web App Design</button>
        <button class="filter-btn" data-filter="poster-design">Poster Design</button>
    </div>

    <!-- Portfolio Grid -->
    <section class="section-padding">
    <div class="portfolio-grid" id="filtered-projects">
        @foreach ($projects as $project)
            <div class="portfolio-item scroll-animate" data-category="{{ strtolower(str_replace(' ', '-', $project->category)) }}">
                <div class="modern-card p-0 overflow-hidden">
                    <div class="portfolio-image-container position-relative">
                        <img src="{{ $project->image ? asset('storage/' . $project->image) : asset('images/default-portfolio.jpg') }}" 
                             alt="{{ $project->title }}" 
                             class="portfolio-image">
                        
                        <div class="portfolio-overlay">
                            <div class="d-flex gap-3">
                                <a href="{{ $project->image ? asset('storage/' . $project->image) : asset('images/default-portfolio.jpg') }}" 
                                   class="btn-modern btn-sm" target="_blank" title="View Image">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if ($project->link)
                                    <a href="{{ $project->link }}" class="btn-primary-modern btn-sm" target="_blank" title="Visit Project">
                                        <i class="fas fa-link"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <span class="badge bg-primary rounded-pill px-3 py-2">{{ $project->category }}</span>
                        <h4 class="mb-3 text-gradient">{{ $project->title }}</h4>
                        <p class="text-secondary">{{ Str::limit($project->description, 120) }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Empty State -->
    @if($projects->isEmpty())
        <div class="text-center py-5 scroll-animate">
            <i class="fas fa-folder-open text-primary" style="font-size:4rem;opacity:0.5;"></i>
            <h3 class="mt-4 mb-3">No Projects Yet</h3>
            <p class="text-secondary">Portfolio projects will appear here once they are added.</p>
        </div>
    @endif

    <!-- Pagination -->
    @if($projects->hasPages())
        <div class="text-center mt-5 scroll-animate">
            <div class="pagination-wrapper">
                {{ $projects->links('pagination::bootstrap-4') }}
            </div>
        </div>
    @endif
</div>
</section>



<!-- Scripts -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Portfolio Filter
    const filterButtons = document.querySelectorAll('.filter-btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item');

    filterButtons.forEach(button => button.addEventListener('click', function() {
        const filter = this.dataset.filter;

        filterButtons.forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');

        portfolioItems.forEach(item => {
            const category = item.dataset.category;
            if(filter==='all'||category===filter){ 
                item.style.display='block';
                setTimeout(()=>{ item.style.opacity='1'; item.style.transform='translateY(0)'; },100);
            } else {
                item.style.opacity='0';
                item.style.transform='translateY(20px)';
                setTimeout(()=>{ item.style.display='none'; },300);
            }
        });
    }));
});

// Animate numbers on scroll
document.addEventListener('DOMContentLoaded', function() {
    const counters = document.querySelectorAll('.stat-item .stat-number');
    const speed = 50; // lower = faster

    function animateCounter(counter) {
        const updateCount = () => {
            const target = +counter.parentElement.dataset.count;
            const suffix = counter.parentElement.dataset.suffix || '';
            const count = +counter.innerText.replace(/\D/g,'');
            const increment = Math.ceil(target / speed);

            if(count < target) {
                counter.innerText = count + increment + suffix;
                setTimeout(updateCount, 30);
            } else {
                counter.innerText = target + suffix;
            }
        };
        updateCount();
    }

    function isInViewport(el) {
        const rect = el.getBoundingClientRect();
        return rect.top < window.innerHeight && rect.bottom >= 0;
    }

    function runCounters() {
        counters.forEach(counter => {
            if(isInViewport(counter) && !counter.classList.contains('counted')) {
                counter.classList.add('counted');
                animateCounter(counter);
            }
        });
    }

    window.addEventListener('scroll', runCounters);
    runCounters(); // run on load
});
</script>
@endsection
