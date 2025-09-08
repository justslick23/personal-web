@extends('layouts.app')

@section('title', 'About Me - Tokelo Foso')
@section('content')

@include('partials.page-header', [
    'title' => 'About Me',
    'breadcrumbs' => [
        ['name' => 'About', 'url' => route('about')],
    ]
])

<!-- Hero Section -->
<section class="section-padding dark-bg text-light">
    <div class="container">
        <div class="row align-items-center ">
            <div class="col-lg-6 text-center mb-5 mb-lg-0 scroll-animate">
                <div class="profile-container animate-float">
                    <img src="{{ asset('images/me.jpg') }}" alt="Tokelo Foso" class="profile-image rounded-circle shadow-lg">
                </div>
            </div>
            <div class="col-lg-6 scroll-animate">
                <h6 class="text-gradient text-uppercase fw-bold mb-2">Hi, I'm Tokelo</h6>
                <h1 class="display-4 fw-bold mb-3 typewriter-heading" data-speed="100">
                    Creative Designer & Developer
                </h1>
                <p class="lead text-secondary mb-4">
                    I craft meaningful digital experiences by blending technology and creativity. Based in Lesotho, I specialize in web development, design, and music production.
                </p>
                <div class="d-flex flex-wrap gap-3 justify-content-center mt-4">
                    <a href="{{ route('contact') }}" class="btn-modern btn-primary-modern">
                        <i class="fas fa-envelope me-2"></i> Contact Me
                    </a>
                    <a href="{{ route('download.cv') }}" class="btn-modern btn-outline-light" target="_blank">
                        <i class="fas fa-download me-2"></i> Download CV
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Skills Section with FontAwesome Icons -->
<section class="section-padding dark-bg text-light">
  <div class="container">
      <div class="row justify-content-center text-center mb-5 scroll-animate">
          <div class="col-lg-8">
              <h6 class="text-gradient text-uppercase fw-bold mb-3">My Expertise</h6>
              <h2 class="display-4 fw-bold mb-4">Technologies I Use</h2>
              <p class="lead text-secondary mb-5">
                  Tools, frameworks, and creative skills I work with regularly.
              </p>
          </div>
      </div>

      <div class="row g-3 masonry-scroll scroll-animate justify-content-center">
          @foreach ([
              ['HTML5', 'fab fa-html5', 'text-orange', 1],
              ['CSS3', 'fab fa-css3-alt', 'text-blue', 1.1],
              ['JavaScript', 'fab fa-js-square', 'text-yellow', 1.2],
              ['React', 'fab fa-react', 'text-cyan', 0.9],
              ['PHP', 'fab fa-php', 'text-purple', 1],
              ['Laravel', 'fas fa-fire', 'text-red', 1.1],
              ['Node.js', 'fab fa-node', 'text-green', 0.95],
              ['Java', 'fab fa-java', 'text-red', 1],
              ['Photoshop', 'fas fa-image', 'text-blue', 1],
              ['Illustrator', 'fas fa-pencil-alt', 'text-orange', 1],
              ['UI/UX', 'fas fa-object-group', 'text-cyan', 0.9],
              ['Branding', 'fas fa-bullhorn', 'text-yellow', 1],
              ['Music Production', 'fas fa-music', 'text-pink', 1.2],
              ['MySQL', 'fas fa-database', 'text-blue', 1],
              ['WordPress', 'fab fa-wordpress', 'text-blue', 1],
              ['Joget', 'fas fa-project-diagram', 'text-purple', 1],
              ['Android', 'fab fa-android', 'text-green', 1],
          ] as $skill)
              <div class="col-4 col-sm-3 col-md-2">
                  <div class="skill-icon-card scroll-animate" style="transform: rotate({{ rand(-5,5) }}deg) scale({{ $skill[3] }});">
                      <i class="{{ $skill[1] }} fa-3x {{ $skill[2] }}"></i>
                      <div class="skill-name mt-2">{{ $skill[0] }}</div>
                  </div>
              </div>
          @endforeach
      </div>
  </div>
</section>

<style>
.masonry-scroll {
  display: flex;
  flex-wrap: wrap;
  gap: 1rem;
}

.skill-icon-card {
  background: var(--card-bg);
  border-radius: 20px;
  padding: 20px 10px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  cursor: pointer;
  box-shadow: 0 0 15px rgba(0, 245, 255, 0.2);
}

.skill-icon-card i {
  transition: transform 0.3s ease, text-shadow 0.3s ease;
}

.skill-icon-card:hover {
  transform: translateY(-8px) scale(1.1);
  box-shadow: 0 0 30px rgba(0, 255, 133, 0.8);
}

.skill-icon-card:hover i {
  transform: rotate(10deg) scale(1.2);
  text-shadow: 0 0 15px rgba(255, 255, 255, 0.7);
}

.skill-name {
  font-weight: 600;
  font-size: 0.9rem;
  color: var(--text-primary);
  text-align: center;
}

.text-orange { color: #f06529; }
.text-blue { color: #2965f1; }
.text-yellow { color: #f7df1e; }
.text-cyan { color: #61dafb; }
.text-purple { color: #6e5494; }
.text-red { color: #ff3c28; }
.text-green { color: #68a063; }
.text-pink { color: #ff69b4; }

@media (max-width: 768px) {
  .skill-icon-card i { font-size: 2.5rem !important; }
}
</style>

<!-- Journey Section as Modern Horizontal Timeline -->
<section class="section-padding dark-bg text-light">
  <div class="container">
      <div class="row justify-content-center text-center mb-5 scroll-animate">
          <div class="col-lg-8">
              <h6 class="text-gradient text-uppercase fw-bold mb-3">My Journey</h6>
              <h2 class="display-4 fw-bold mb-4">Career Timeline</h2>
              <p class="lead text-secondary">A snapshot of my growth from early learning to professional achievements.</p>
          </div>
      </div>

      <div class="timeline-container position-relative scroll-animate">
          <div class="timeline-line position-absolute top-50 start-0 w-100 translate-middle-y"></div>

          <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center">
              @foreach ([ 
                  ['2014-2016', 'Early Beginnings', 'Discovered passion for digital creation at Machabeng College.'],
                  ['2018-2020', 'Academic Foundation', 'Studied Computer & Information Sciences at Monash University.'],
                  ['2021-Present', 'Professional Growth', 'Freelance and professional work blending technical skills and creativity.']
              ] as $period)
              <div class="timeline-item text-center mb-5 mb-lg-0">
                  <div class="timeline-dot bg-gradient shadow-sm mb-3"></div>
                  <div class="timeline-card p-4 shadow-sm rounded bg-light">
                      <div class="text-gradient fs-5 fw-bold mb-2">{{ $period[0] }}</div>
                      <h5 class="mb-2 text-dark">{{ $period[1] }}</h5>
                      <p class="text-secondary mb-0">{{ $period[2] }}</p>
                  </div>
              </div>
              @endforeach
          </div>
      </div>
  </div>
</section>

<style>
/* Timeline line */
.timeline-container {
  position: relative;
  padding: 4rem 0;
}
.timeline-line {
  height: 4px;
  background: linear-gradient(90deg, #00f, #0ff);
  z-index: 1;
}

/* Timeline dots */
.timeline-dot {
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: #00f;
  border: 4px solid #fff;
  z-index: 2;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.timeline-dot:hover {
  transform: scale(1.3);
  box-shadow: 0 0 15px rgba(0, 255, 255, 0.7);
}

/* Timeline cards */
.timeline-card {
  position: relative;
  z-index: 3;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.timeline-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 15px 25px rgba(0,0,0,0.2);
}

/* Responsive adjustments */
@media (max-width: 992px) {
  .timeline-line {
      top: auto !important;
      left: 50%;
      height: 100%;
      width: 4px;
      transform: translateX(-50%);
  }
  .d-flex.flex-lg-row {
      flex-direction: column !important;
      align-items: center;
  }
  .timeline-item {
      margin-bottom: 3rem;
  }
}
</style>


<!-- Personal / Interests Section as Card Grid -->
<section class="section-padding">
    <div class="container">
        <div class="row justify-content-center text-center mb-5 scroll-animate">
            <div class="col-lg-8">
                <h6 class="text-gradient text-uppercase fw-bold mb-3">Beyond Work</h6>
                <h2 class="display-4 fw-bold mb-4">Personal Interests & Goals</h2>
                <p class="lead text-secondary">Things I love, my learning journey, and what I aim for in the future.</p>
            </div>
        </div>
        <div class="row g-4 scroll-animate">
            @foreach ([ 
                ['Things I Love', 'fas fa-heart', ['Music Production & DJing','Exploring Tech','Travel & Culture','Gaming']],
                ['Education & Learning', 'fas fa-user-graduate', ['Bachelor of Computer & Info Sciences','Online Web Dev Courses','Self-taught in Creative Software']],
                ['Future Goals', 'fas fa-flag', ['Launch a Creative Studio','Collaborate Internationally','Contribute to Open Source']]
            ] as $personal)
            <div class="col-md-6 col-lg-4">
                <div class="modern-card h-100 p-4 shadow-sm rounded text-center hover-scale">
                    <div class="text-primary fs-1 mb-3"><i class="{{ $personal[1] }}"></i></div>
                    <h4 class="mb-3">{{ $personal[0] }}</h4>
                    <ul class="list-unstyled text-secondary">
                        @foreach($personal[2] as $item)
                        <li class="mb-2">{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
