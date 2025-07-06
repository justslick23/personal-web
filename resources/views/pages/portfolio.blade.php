@php use Illuminate\Support\Facades\Storage; @endphp

@extends('layouts.app')

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
                        <img src="{{ '/public/' . $project->image }}" alt="{{ $project->title }}" class="img-fluid w-100">
                        <div class="portfolio-overlay d-flex align-items-center justify-content-center position-absolute top-0 start-0 w-100 h-100">
                            <div class="portfolio-actions">
                                <a href="{{ '/public/' . $project->image }}" class="btn btn-sm btn-light rounded-circle me-2" target="_blank">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if ($project->link)
                                    <a href="{{ $project->link }}" class="btn btn-sm btn-primary rounded-circle" target="_blank">
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
                        <p class="portfolio-description text-muted mb-0">{{ $project->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Pagination -->
<div class="row justify-content-center mt-5">
    <div class="col-12 text-center">
        {{ $projects->links('pagination::bootstrap-4') }} <!-- Customize as needed -->
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const filterButtons = document.querySelectorAll(".category-filter button");
        const items = document.querySelectorAll(".portfolio-item");

        filterButtons.forEach(button => {
            button.addEventListener("click", function () {
                const filter = this.getAttribute("data-filter").toLowerCase();

                // Update button styling
                filterButtons.forEach(btn => btn.classList.remove("btn-warning", "active"));
                filterButtons.forEach(btn => btn.classList.add("btn-outline-light"));
                this.classList.remove("btn-outline-light");
                this.classList.add("btn-warning", "active");

                // Show/hide items
                items.forEach(item => {
                    const category = item.getAttribute("data-category");
                    if (filter === "all" || category === filter) {
                        item.parentElement.style.display = "flex";
                    } else {
                        item.parentElement.style.display = "none";
                    }
                });
            });
        });
    });
</script>

            
            
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
</style>