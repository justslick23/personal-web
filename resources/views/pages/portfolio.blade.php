@extends('layouts.app')
@php
use Illuminate\Support\Facades\Storage;
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

    <!-- Portfolio Categories Section -->
    <section id="categories" class="categories-section py-5 bg-dark text-light">
        <div class="container">
            <!-- Section Heading -->
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <div class="section-heading" data-aos="fade-up">
                        <h6 class="text-warning fw-bold text-uppercase mb-2">Expertise</h6>
                        <h2 class="display-5 fw-bold mb-3">Areas of <span class="text-warning">Specialization</span></h2>
                        <div class="section-line mx-auto bg-warning my-3" style="width: 80px; height: 3px;"></div>
                        <p class="lead">Browse through my different areas of expertise and specialization.</p>
                    </div>
                </div>
            </div>
    
            <!-- Category Pills -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8">
                    <div class="category-filter d-flex flex-wrap justify-content-center gap-2" data-aos="fade-up">
                        <button class="btn btn-warning rounded-pill active" data-filter="all">All Projects</button>
                        <button class="btn btn-outline-light rounded-pill" data-filter="web-app-design">Web App Design</button>
                        <button class="btn btn-outline-light rounded-pill" data-filter="poster-design">Poster Design</button>
                    </div>
                </div>
            </div>
          

            <!-- Portfolio Grid -->
            <div class="row g-4 portfolio-grid" id="filtered-projects">
                @foreach ($projects as $project)
                    <div class="col-md-6 col-lg-4 d-flex">
                        <div class="portfolio-item d-flex flex-column w-100 h-100" data-category="{{ strtolower(str_replace(' ', '-', $project->category)) }}">
                            <div class="portfolio-card bg-secondary h-100 rounded-lg overflow-hidden d-flex flex-column">
                                <div class="portfolio-image position-relative">
                                    {{-- Correct image path for cPanel hosting --}}
                                    <img src="{{  $project->image ? asset( 'storage/' . $project->image) : asset('images/default-portfolio.jpg') }}" 
                                         alt="{{ $project->title }}" 
                                         class="img-fluid w-100"
                                         style="height: 250px; object-fit: cover;">
                                    
                                    <div class="portfolio-overlay d-flex align-items-center justify-content-center position-absolute top-0 start-0 w-100 h-100">
                                        <div class="portfolio-actions">
                                            {{-- View image in new tab --}}
                                            <a href="{{ $project->image ? asset($project->image) : asset('images/default-portfolio.jpg') }}" 
                                               class="btn btn-sm btn-light rounded-circle me-2" 
                                               target="_blank"
                                               title="View Image">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
                                            {{-- Project link if available --}}
                                            @if ($project->link)
                                                <a href="{{ $project->link }}" 
                                                   class="btn btn-sm btn-primary rounded-circle" 
                                                   target="_blank"
                                                   title="Visit Project">
                                                    <i class="fas fa-link"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="portfolio-content p-4">
                                    <div class="portfolio-category mb-2">
                                        <span class="badge bg-warning rounded-pill">{{ $project->category }}</span>
                                    </div>
                                    <h4 class="portfolio-title mb-2">{{ $project->title }}</h4>
                                    <p class="portfolio-description text-muted mb-0">
                                        {{ Str::limit($project->description, 100) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Handle empty state --}}
            @if($projects->isEmpty())
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="py-5">
                            <i class="fas fa-folder-open fa-3x text-warning mb-3"></i>
                            <h4 class="text-white">No Projects Yet</h4>
                            <p class="text-muted">Portfolio projects will appear here once they are added.</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Pagination -->
            @if($projects->hasPages())
                <div class="row justify-content-center mt-5">
                    <div class="col-12 text-center">
                        {{ $projects->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            @endif
        </div>
    </section>

@endsection

<style>
    section {
        background: radial-gradient(
            circle at 50% 50%,
            rgba(12, 10, 21, 0.3),
            #0f0f1d 50%,
            #0a0a23 100%
        );
    }

    section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed; /* Parallax effect */
        filter: brightness(50%); /* Darkens only the background */
        z-index: -1; /* Places it behind content */
        padding-bottom: 100px !important;
    }

    .portfolio-overlay {
        background: rgba(0, 0, 0, 0.8);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .portfolio-item:hover .portfolio-overlay {
        opacity: 1;
    }

    .portfolio-actions .btn {
        transition: transform 0.2s ease;
    }

    .portfolio-actions .btn:hover {
        transform: scale(1.1);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .portfolio-image img {
            height: 200px !important;
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const filterButtons = document.querySelectorAll(".category-filter button");
        const items = document.querySelectorAll(".portfolio-item");

        filterButtons.forEach(button => {
            button.addEventListener("click", function () {
                const filter = this.getAttribute("data-filter").toLowerCase();

                // Update button styling
                filterButtons.forEach(btn => {
                    btn.classList.remove("btn-warning", "active");
                    btn.classList.add("btn-outline-light");
                });
                this.classList.remove("btn-outline-light");
                this.classList.add("btn-warning", "active");

                // Show/hide items with animation
                items.forEach(item => {
                    const category = item.getAttribute("data-category");
                    const parentCol = item.parentElement;
                    
                    if (filter === "all" || category === filter) {
                        parentCol.style.display = "flex";
                        // Add fade-in animation
                        item.style.opacity = "0";
                        setTimeout(() => {
                            item.style.opacity = "1";
                            item.style.transition = "opacity 0.3s ease";
                        }, 100);
                    } else {
                        parentCol.style.display = "none";
                    }
                });
            });
        });

        // Image loading error handling
        document.querySelectorAll('.portfolio-image img').forEach(img => {
            img.addEventListener('error', function() {
                this.src = '{{ asset("images/default-portfolio.jpg") }}';
                this.alt = 'Image not available';
            });
        });
    });
</script>