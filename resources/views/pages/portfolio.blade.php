@php
use Illuminate\Support\Str;
@endphp

@extends('layouts.app')

@section('title', 'Portfolio - Tokelo Foso')

@section('content')
@include('partials.page-header', [
    'title' => 'My Work',
    'breadcrumbs' => [['name' => 'Portfolio', 'url' => route('portfolio')]]
])

<!-- Full Width Hero with Background -->
<section class="hero-section" style="min-height: 60vh; display: flex; align-items: center; position: relative;">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-10 scroll-animate">
                <!-- Inline Filter Tabs -->
                <div class="filter-buttons d-flex justify-content-center flex-wrap gap-2">
                    <button class="filter-btn active" data-filter="all">All</button>
                    <button class="filter-btn" data-filter="web-app-design">Web Apps</button>
                    <button class="filter-btn" data-filter="poster-design">Posters</button>
                    <button class="filter-btn" data-filter="branding">Branding</button>
                    <button class="filter-btn" data-filter="ui/ux-design">UI/UX</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Masonry Portfolio Grid -->
<section class="section-padding" style="padding-top: 2rem;">
    <div class="container-fluid px-4">
        <div class="row g-4" id="filtered-projects">
            @forelse ($projects as $index => $project)
                @php
                    // UPDATED IMAGE PATH LOGIC FOR PUBLIC FOLDER
                    $imagePath = asset('images/default-portfolio.jpg');
                    if (!empty($project->image)) {
                        if (str_starts_with($project->image, 'http://') || str_starts_with($project->image, 'https://')) {
                            $imagePath = $project->image;
                        } else {
                            // Image stored in public folder (images/portfolio/)
                            $imagePath = asset($project->image);
                        }
                    }
                    
                    // Randomize heights for masonry effect
                    $heights = ['350px', '450px', '400px', '500px'];
                    $height = $heights[$index % count($heights)];
                @endphp

                <div class="col-lg-4 col-md-6 portfolio-item scroll-animate" 
                     data-category="{{ strtolower(str_replace(' ', '-', $project->category)) }}"
                     style="animation-delay: {{ $index * 0.05 }}s;">
                    <div class="modern-card p-0 overflow-hidden h-100 position-relative" style="height: {{ $height }} !important;">
                        <img src="{{ $imagePath }}" 
                             alt="{{ $project->title }}" 
                             style="width: 100%; height: 100%; object-fit: cover;"
                             onerror="this.src='{{ asset('images/default-portfolio.jpg') }}'">
                        
                        <!-- Hover Overlay with Info -->
                        <div class="portfolio-overlay" style="background: linear-gradient(to top, rgba(10, 10, 15, 0.95), transparent);">
                            <div class="position-absolute bottom-0 start-0 end-0 p-4">
                                <span class="badge px-3 py-2 mb-3" style="background: var(--accent-primary); color: var(--bg-primary);">
                                    {{ $project->category }}
                                </span>
                                <h4 class="text-gradient mb-2">{{ $project->title }}</h4>
                                <p class="text-secondary mb-3 small">
                                    {{ !empty($project->description) ? Str::limit($project->description, 80) : '' }}
                                </p>
                                <div class="d-flex gap-2">
                                    <a href="{{ $imagePath }}" class="btn-modern btn-primary-modern" target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if ($project->link)
                                        <a href="{{ $project->link }}" class="btn-modern" target="_blank">
                                            <i class="fas fa-link"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 scroll-animate">
                    <i class="fas fa-folder-open fa-4x mb-4" style="color: var(--accent-primary); opacity: 0.5;"></i>
                    <h3 class="mb-3">No Projects Yet</h3>
                    <p class="text-secondary">Portfolio projects will appear here once they are added.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($projects->hasPages())
            <div class="text-center mt-5 scroll-animate">
                {{ $projects->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>
</section>

<!-- Floating CTA -->
<section class="section-padding" style="background: var(--bg-secondary);">
    <div class="container">
        <div class="modern-card text-center py-5 scroll-animate">
            <h2 class="display-5 fw-bold mb-3">
                <span class="text-gradient">Let's Create</span> Together
            </h2>
            <p class="lead text-secondary mb-4">Have a project in mind? Let's bring it to life.</p>
            <a href="{{ route('contact') }}" class="btn-modern btn-primary-modern" style="padding: 1.25rem 3rem;">
                <i class="fas fa-rocket me-2"></i>
                Start Your Project
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.dataset.filter;

            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            portfolioItems.forEach(item => {
                const category = item.dataset.category;
                if(filter === 'all' || category === filter) { 
                    item.style.display = 'block';
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'translateY(0)';
                    }, 100);
                } else {
                    item.style.opacity = '0';
                    item.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        item.style.display = 'none';
                    }, 300);
                }
            });
        });
    });

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, { threshold: 0.1 });
    
    document.querySelectorAll('.scroll-animate').forEach(el => observer.observe(el));
});
</script>
@endpush