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
                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="img-fluid w-100">
                        <div class="portfolio-overlay d-flex align-items-center justify-content-center position-absolute top-0 start-0 w-100 h-100">
                            <div class="portfolio-actions">
                                <a href="{{ asset('storage/' . $project->image) }}" class="btn btn-sm btn-light rounded-circle me-2" target="_blank">
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
    
    <!-- Process Section -->
    <section id="process" class="process-section py-5">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8">
                    <div class="section-heading text-center" data-aos="fade-up">
                        <h6 class="text-primary fw-bold text-uppercase mb-2">Work Process</h6>
                        <h2 class="display-5 fw-bold mb-3">How I Bring <span class="text-primary">Ideas</span> to Life</h2>
                        <div class="section-line mx-auto bg-primary my-4" style="width: 80px; height: 3px;"></div>
                        <p class="lead">A structured approach to ensure successful project delivery and client satisfaction.</p>
                    </div>
                </div>
            </div>
            
            <div class="row g-4">
                <!-- Process Step 1 -->
                <div class="col-md-6 col-lg-3" data-aos="fade-up">
                    <div class="process-step text-center p-4 rounded-lg h-100">
                        <div class="process-icon mb-4 mx-auto">
                            <span class="step-number d-flex align-items-center justify-content-center rounded-circle bg-primary text-white mb-3">1</span>
                            <i class="fas fa-lightbulb fs-2 text-primary"></i>
                        </div>
                        <h4 class="process-title mb-3">Discovery</h4>
                        <p class="process-description mb-0">Understanding client needs, research, and conceptualizing initial ideas for the project.</p>
                    </div>
                </div>
                
                <!-- Process Step 2 -->
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="process-step text-center p-4 rounded-lg h-100">
                        <div class="process-icon mb-4 mx-auto">
                            <span class="step-number d-flex align-items-center justify-content-center rounded-circle bg-success text-white mb-3">2</span>
                            <i class="fas fa-drafting-compass fs-2 text-success"></i>
                        </div>
                        <h4 class="process-title mb-3">Planning</h4>
                        <p class="process-description mb-0">Creating wireframes, prototypes, and defining technical requirements for implementation.</p>
                    </div>
                </div>
                
                <!-- Process Step 3 -->
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="process-step text-center p-4 rounded-lg h-100">
                        <div class="process-icon mb-4 mx-auto">
                            <span class="step-number d-flex align-items-center justify-content-center rounded-circle bg-warning text-white mb-3">3</span>
                            <i class="fas fa-code fs-2 text-warning"></i>
                        </div>
                        <h4 class="process-title mb-3">Development</h4>
                        <p class="process-description mb-0">Building the solution using cutting-edge technologies and industry best practices.</p>
                    </div>
                </div>
                
                <!-- Process Step 4 -->
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="process-step text-center p-4 rounded-lg h-100">
                        <div class="process-icon mb-4 mx-auto">
                            <span class="step-number d-flex align-items-center justify-content-center rounded-circle bg-danger text-white mb-3">4</span>
                            <i class="fas fa-rocket fs-2 text-danger"></i>
                        </div>
                        <h4 class="process-title mb-3">Delivery</h4>
                        <p class="process-description mb-0">Testing, refinement, client review, and successful project deployment.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section id="stats" class="stats-section py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Stat Item 1 -->
                <div class="col-6 col-md-3" data-aos="fade-up">
                    <div class="stat-item text-center p-4 rounded-lg h-100">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-project-diagram fs-1 text-primary"></i>
                        </div>
                        <h2 class="stat-number mb-2 display-5 fw-bold">50+</h2>
                        <p class="stat-label mb-0 text-uppercase">Projects Completed</p>
                    </div>
                </div>
                
                <!-- Stat Item 2 -->
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-item text-center p-4 rounded-lg h-100">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-smile-beam fs-1 text-success"></i>
                        </div>
                        <h2 class="stat-number mb-2 display-5 fw-bold">40+</h2>
                        <p class="stat-label mb-0 text-uppercase">Happy Clients</p>
                    </div>
                </div>
                
                <!-- Stat Item 3 -->
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-item text-center p-4 rounded-lg h-100">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-clock fs-1 text-warning"></i>
                        </div>
                        <h2 class="stat-number mb-2 display-5 fw-bold">5000+</h2>
                        <p class="stat-label mb-0 text-uppercase">Hours of Work</p>
                    </div>
                </div>
                
                <!-- Stat Item 4 -->
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-item text-center p-4 rounded-lg h-100">
                        <div class="stat-icon mb-3">
                            <i class="fas fa-award fs-1 text-danger"></i>
                        </div>
                        <h2 class="stat-number mb-2 display-5 fw-bold">10+</h2>
                        <p class="stat-label mb-0 text-uppercase">Awards Won</p>
                    </div>
                </div>
            </div>
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