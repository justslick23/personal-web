@extends('layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'About Me',
        'breadcrumbs' => [
            ['name' => 'About', 'url' => route('about')],
        ]
    ])

 
    <section id="about-hero" class="about-hero-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="about-hero-image position-relative">
                        <img src="{{ asset('images/me.jpg') }}" alt="About Me" class="img-fluid rounded-lg shadow-lg">
                        <div class="experience-badge position-absolute bg-primary text-white py-3 px-4 rounded-lg shadow">
                            <span class="d-block text-center fs-1 fw-bold">5+</span>
                            <span class="d-block text-center">Years Experience</span>
                        </div>
                        <div class="shape-1 position-absolute bg-secondary opacity-50 rounded-circle"></div>
                        <div class="shape-2 position-absolute bg-primary opacity-50 rounded-circle"></div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="about-hero-content ps-lg-4">
                        <h6 class="text-primary fw-bold text-uppercase mb-3">About Me</h6>
                        <h2 class="display-4 fw-bold mb-4">I'm <span class="text-primary">Tokelo</span>, Creative Designer & Developer</h2>
                        <p class="lead mb-4">
                            A versatile creative professional based in Lesotho with a passion for blending technology and artistry to create meaningful digital experiences.
                        </p>
                        <div class="d-flex flex-wrap gap-3 mb-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-primary me-2"></i>
                                <span>Website Design</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-primary me-2"></i>
                                <span>Web Development</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-primary me-2"></i>
                                <span>Graphic Design</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-primary me-2"></i>
                                <span>Music Production</span>
                            </div>
                        </div>
                        <div class="d-flex gap-3">
                            <a href="#" class="btn btn-primary btn-lg rounded-pill">Get In Touch</a>
                            <a href="#" class="btn btn-outline-dark btn-lg rounded-pill">Download CV</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- My Story Section -->
<section id="my-story" class="my-story-section py-5 bg-dark text-light">
    <div class="container">
        <!-- Section Heading -->
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <div class="section-heading" data-aos="fade-up">
                    <h6 class="text-warning fw-bold text-uppercase mb-2">My Journey</h6>
                    <h2 class="display-5 fw-bold mb-3">The Story <span class="text-warning">Behind</span> My Work</h2>
                    <div class="section-line mx-auto bg-warning my-3" style="width: 80px; height: 3px;"></div>
                    <p class="lead">A glimpse into my background, passion, and vision that drives my creative work.</p>
                </div>
            </div>
        </div>

        <!-- Timeline -->
        <div class="row">
            <div class="col-lg-12">
                <div class="story-timeline position-relative">
                    
                    <!-- Timeline Item 1 -->
                    <div class="timeline-item d-flex flex-lg-row flex-column align-items-lg-center" data-aos="fade-right">
                        <div class="timeline-dot rounded-circle bg-warning"></div>
                        <div class="timeline-content bg-secondary p-4 rounded shadow-lg">
                            <span class="timeline-date text-warning fw-bold">2014 - 2016</span>
                            <h4 class="timeline-title mt-2 mb-3">Early Beginnings</h4>
                            <p class="timeline-text">
                                My journey began during my time at Machabeng College, where I first discovered my passion for digital creation. 
                                While studying for my IGCSE, I spent countless hours teaching myself graphic design and basic web development, 
                                creating posters for school events and simple websites for friends.
                            </p>
                        </div>
                    </div>

                    <!-- Timeline Item 2 -->
                    <div class="timeline-item d-flex flex-lg-row-reverse flex-column align-items-lg-center" data-aos="fade-left">
                        <div class="timeline-dot rounded-circle bg-warning"></div>
                        <div class="timeline-content bg-secondary p-4 rounded shadow-lg">
                            <span class="timeline-date text-warning fw-bold">2018 - 2020</span>
                            <h4 class="timeline-title mt-2 mb-3">Academic Foundation</h4>
                            <p class="timeline-text">
                                At Monash University, I honed my skills by pursuing a Bachelor of Computer and Information Sciences with a focus on 
                                Software Development and Mobile Systems. This formal education provided me with the technical foundation necessary 
                                to bring my creative visions to life through code.
                            </p>
                        </div>
                    </div>

                    <!-- Timeline Item 3 -->
                    <div class="timeline-item d-flex flex-lg-row flex-column align-items-lg-center" data-aos="fade-right">
                        <div class="timeline-dot rounded-circle bg-warning"></div>
                        <div class="timeline-content bg-secondary p-4 rounded shadow-lg">
                            <span class="timeline-date text-warning fw-bold">2021 - Present</span>
                            <h4 class="timeline-title mt-2 mb-3">Professional Growth</h4>
                            <p class="timeline-text">
                                My professional journey has taken me from freelance graphic design work at Osmium Lesotho to my current role 
                                as a Website Designer at Computer Business Solutions. Along the way, I've developed a unique approach that combines 
                                technical expertise with artistic vision, allowing me to create digital solutions that are both beautiful and functional.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- AOS Animation -->
<script>
    AOS.init({
        duration: 1000, 
        once: true
    });
</script>


    <!-- Philosophy Section -->
    <section id="philosophy" class="philosophy-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="philosophy-content pe-lg-4">
                        <h6 class="text-primary fw-bold text-uppercase mb-3">My Philosophy</h6>
                        <h2 class="display-5 fw-bold mb-4">The Values That <span class="text-primary">Drive</span> My Work</h2>
                        
                        <div class="philosophy-item d-flex mb-4">
                            <div class="philosophy-icon me-4">
                                <i class="fas fa-lightbulb fs-1 text-primary"></i>
                            </div>
                            <div class="philosophy-text">
                                <h4 class="mb-2">Creative Innovation</h4>
                                <p>I believe that true innovation happens at the intersection of technical skill and creative thinking. Each project is an opportunity to push boundaries and explore new possibilities.</p>
                            </div>
                        </div>
                        
                        <div class="philosophy-item d-flex mb-4">
                            <div class="philosophy-icon me-4">
                                <i class="fas fa-users fs-1 text-primary"></i>
                            </div>
                            <div class="philosophy-text">
                                <h4 class="mb-2">User-Centered Design</h4>
                                <p>People are at the heart of every project I undertake. Understanding user needs and designing intuitive experiences is fundamental to my approach.</p>
                            </div>
                        </div>
                        
                        <div class="philosophy-item d-flex">
                            <div class="philosophy-icon me-4">
                                <i class="fas fa-sync-alt fs-1 text-primary"></i>
                            </div>
                            <div class="philosophy-text">
                                <h4 class="mb-2">Continuous Growth</h4>
                                <p>The digital landscape is constantly evolving, and so am I. I'm committed to lifelong learning and staying at the forefront of industry trends and technologies.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="philosophy-image position-relative">
                        <img src="{{ asset('images/philosophy.jpg') }}" alt="My Philosophy" class="img-fluid rounded-lg shadow-lg">
                        <div class="quote-box position-absolute bg-white p-4 rounded-lg shadow">
                            <i class="fas fa-quote-left fs-1 text-primary opacity-50"></i>
                            <p class="fst-italic my-3">Design is not just what it looks like and feels like. Design is how it works.</p>
                            <p class="fw-bold mb-0">— Steve Jobs</p>
                        </div>
                        <div class="shape-3 position-absolute bg-primary opacity-10 rounded"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="skills-section py-5 bg-dark">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8">
                    <div class="section-heading text-center" data-aos="fade-up">
                        <h6 class="text-primary fw-bold text-uppercase mb-2">My Expertise</h6>
                        <h2 class="display-5 fw-bold mb-3">Professional <span class="text-primary">Skills</span> & Tools</h2>
                        <div class="section-line mx-auto bg-primary my-4" style="width: 80px; height: 3px;"></div>
                        <p class="lead">The technologies and tools I've mastered throughout my professional journey.</p>
                    </div>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-3" data-aos="fade-up">
                    <div class="skill-category bg-grey p-4 rounded-lg shadow-sm h-100">
                        <div class="skill-icon mb-4">
                            <span class="icon-circle d-flex align-items-center justify-content-center bg-primary-soft rounded-circle mb-3">
                                <i class="fas fa-laptop-code fs-3 text-primary"></i>
                            </span>
                            <h4 class="skill-title">Frontend</h4>
                        </div>
                        <div class="skill-list">
                            <div class="skill-item d-flex align-items-center mb-3">
                                <i class="fab fa-html5 text-danger me-2"></i>
                                <span>HTML5</span>
                                <div class="skill-progress ms-auto">
                                    <div class="progress" style="height: 6px; width: 60px;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 95%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="skill-item d-flex align-items-center mb-3">
                                <i class="fab fa-css3-alt text-primary me-2"></i>
                                <span>CSS3</span>
                                <div class="skill-progress ms-auto">
                                    <div class="progress" style="height: 6px; width: 60px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="skill-item d-flex align-items-center mb-3">
                                <i class="fab fa-js text-warning me-2"></i>
                                <span>JavaScript</span>
                                <div class="skill-progress ms-auto">
                                    <div class="progress" style="height: 6px; width: 60px;">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 85%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="skill-item d-flex align-items-center">
                                <i class="fab fa-react text-info me-2"></i>
                                <span>React</span>
                                <div class="skill-progress ms-auto">
                                    <div class="progress" style="height: 6px; width: 60px;">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="skill-category bg-grey p-4 rounded-lg shadow-sm h-100">
                        <div class="skill-icon mb-4">
                            <span class="icon-circle d-flex align-items-center justify-content-center bg-success-soft rounded-circle mb-3">
                                <i class="fas fa-server fs-3 text-success"></i>
                            </span>
                            <h4 class="skill-title">Backend</h4>
                        </div>
                        <div class="skill-list">
                            <div class="skill-item d-flex align-items-center mb-3">
                                <i class="fab fa-php text-indigo me-2"></i>
                                <span>PHP</span>
                                <div class="skill-progress ms-auto">
                                    <div class="progress" style="height: 6px; width: 60px;">
                                        <div class="progress-bar bg-indigo" role="progressbar" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="skill-item d-flex align-items-center mb-3">
                                <i class="fab fa-laravel text-danger me-2"></i>
                                <span>Laravel</span>
                                <div class="skill-progress ms-auto">
                                    <div class="progress" style="height: 6px; width: 60px;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 85%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="skill-item d-flex align-items-center mb-3">
                                <i class="fab fa-node-js text-success me-2"></i>
                                <span>Node.js</span>
                                <div class="skill-progress ms-auto">
                                    <div class="progress" style="height: 6px; width: 60px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 75%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="skill-item d-flex align-items-center">
                                <i class="fab fa-java text-warning me-2"></i>
                                <span>Java</span>
                                <div class="skill-progress ms-auto">
                                    <div class="progress" style="height: 6px; width: 60px;">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 70%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="skill-category bg-grey p-4 rounded-lg shadow-sm h-100">
                        <div class="skill-icon mb-4">
                            <span class="icon-circle d-flex align-items-center justify-content-center bg-warning-soft rounded-circle mb-3">
                                <i class="fas fa-paint-brush fs-3 text-warning"></i>
                            </span>
                            <h4 class="skill-title">Design</h4>
                        </div>
                        <div class="skill-list">
                            <div class="skill-item d-flex align-items-center mb-3">
                                <i class="fab fa-adobe text-danger me-2"></i>
                                <span>Photoshop</span>
                                <div class="skill-progress ms-auto">
                                    <div class="progress" style="height: 6px; width: 60px;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 95%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="skill-item d-flex align-items-center mb-3">
                                <i class="fab fa-adobe text-warning me-2"></i>
                                <span>Illustrator</span>
                                <div class="skill-progress ms-auto">
                                    <div class="progress" style="height: 6px; width: 60px;">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="skill-item d-flex align-items-center mb-3">
                                <i class="fas fa-pencil-ruler text-info me-2"></i>
                                <span>UI/UX</span>
                                <div class="skill-progress ms-auto">
                                    <div class="progress" style="height: 6px; width: 60px;">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 85%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="skill-item d-flex align-items-center">
                                <i class="fas fa-vector-square text-primary me-2"></i>
                                <span>Branding</span>
                                <div class="skill-progress ms-auto">
                                    <div class="progress" style="height: 6px; width: 60px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="skill-category bg-grey p-4 rounded-lg shadow-sm h-100">
                        <div class="skill-icon mb-4">
                            <span class="icon-circle d-flex align-items-center justify-content-center bg-info-soft rounded-circle mb-3">
                                <i class="fas fa-music fs-3 text-info"></i>
                            </span>
                            <h4 class="skill-title">Music</h4>
                        </div>
                        <div class="skill-list">
                            <div class="skill-item d-flex align-items-center mb-3">
                                <i class="fas fa-sliders-h text-purple me-2"></i>
                                <span>Production</span>
                                <div class="skill-progress ms-auto">
                                    <div class="progress" style="height: 6px; width: 60px;">
                                        <div class="progress-bar bg-purple" role="progressbar" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="skill-item d-flex align-items-center mb-3">
                                <i class="fas fa-headphones text-danger me-2"></i>
                                <span>Mixing</span>
                                <div class="skill-progress ms-auto">
                                    <div class="progress" style="height: 6px; width: 60px;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 85%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="skill-item d-flex align-items-center mb-3">
                                <i class="fas fa-file-audio text-success me-2"></i>
                                <span>Sound Design</span>
                                <div class="skill-progress ms-auto">
                                    <div class="progress" style="height: 6px; width: 60px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 80%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="skill-item d-flex align-items-center">
                                <i class="fas fa-drum text-warning me-2"></i>
                                <span>Percussion</span>
                                <div class="skill-progress ms-auto">
                                    <div class="progress" style="height: 6px; width: 60px;">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 75%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Personal Details Section -->
    <section id="personal" class="personal-section py-5">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8">
                    <div class="section-heading text-center" data-aos="fade-up">
                        <h6 class="text-primary fw-bold text-uppercase mb-2">Personal Side</h6>
                        <h2 class="display-5 fw-bold mb-3">Beyond The <span class="text-primary">Profession</span></h2>
                        <div class="section-line mx-auto bg-primary my-4" style="width: 80px; height: 3px;"></div>
                        <p class="lead">Get to know me beyond my professional skills and experience.</p>
                    </div>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up">
                    <div class="personal-card bg-white p-4 rounded-lg shadow-sm text-center h-100">
                        <div class="personal-icon mb-3">
                            <span class="icon-circle d-inline-flex align-items-center justify-content-center bg-primary-soft rounded-circle">
                                <i class="fas fa-heart fs-3 text-primary"></i>
                            </span>
                        </div>
                        <h4 class="mb-3">Things I Love</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2">Music Production & DJing</li>
                            <li class="mb-2">Exploring New Technologies</li>
                            <li class="mb-2">Photography & Visual Arts</li>
                            <li class="mb-2">Travel & Cultural Experiences</li>
                            <li>Reading Design & Tech Publications</li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="personal-card bg-white p-4 rounded-lg shadow-sm text-center h-100">
                        <div class="personal-icon mb-3">
                            <span class="icon-circle d-inline-flex align-items-center justify-content-center bg-success-soft rounded-circle">
                                <i class="fas fa-user-graduate fs-3 text-success"></i>
                            </span>
                        </div>
                        <h4 class="mb-3">Education & Learning</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2">Bachelor of Computer and Information Sciences</li>
                            <li class="mb-2">Online Courses in Advanced Web Development</li>
                            <li class="mb-2">Design Thinking Workshops</li>
                            <li class="mb-2">Sound Engineering Certificate</li>
                            <li>Self-taught in Various Creative Software</li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="personal-card bg-white p-4 rounded-lg shadow-sm text-center h-100">
                        <div class="personal-icon mb-3">
                            <span class="icon-circle d-inline-flex align-items-center justify-content-center bg-warning-soft rounded-circle">
                                <i class="fas fa-flag fs-3 text-warning"></i>
                            </span>
                        </div>
                        <h4 class="mb-3">Future Goals</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2">Launch a Creative Tech Studio</li>
                            <li class="mb-2">Mentor Young Designers & Developers</li>
                            <li class="mb-2">Release Original Music Productions</li>
                            <li class="mb-2">Collaborate on International Projects</li>
                            <li>Contribute to Open Source Communities</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section id="cta" class="cta-section py-5 bg-primary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mb-4 mb-lg-0" data-aos="fade-right">
                    <h2 class="display-5 fw-bold mb-3">Let's Work Together</h2>
                    <p class="lead mb-0">Have a project in mind? Let's discuss how I can help bring your vision to life.</p>
                </div>
                <div class="col-lg-4 text-lg-end" data-aos="fade-left">
                    <a href="#" class="btn btn-light btn-lg rounded-pill">Get In Touch</a>
                </div>
            </div>
        </div>
    </section>
@endsection

<!-- Custom CSS to add in your stylesheet -->
<style>
/* About Hero Section Styles */
/* ======== IMPROVED DARK THEME ======== */
:root {
  /* Color System - Enhanced Dark Palette */
  --primary: #4f6ef2;         /* Vibrant blue - more saturated */
  --primary-light: #6a8cff;   /* Lighter blue for hover states */
  --primary-dark: #3750d2;    /* Darker blue for pressed states */
  --accent: #9d4edd;          /* Purple accent for variety */
  
  /* Neutral Colors - More refined dark palette */
  --bg-darkest: #0d0d12;      /* Base background - near black */
  --bg-darker: #12121a;       /* Slightly lighter for sections */
  --bg-dark: #18181f;         /* For cards */
  --bg-card: #1e1e28;         /* For elevated cards */
  
  /* Text Colors - Improved contrast */
  --text-primary: #f0f2fd;    /* Main text - slightly off-white */
  --text-secondary: #b4b8c7;  /* Secondary text */
  --text-tertiary: #878a96;   /* Less important text */
  --text-muted: #5c5e67;      /* Muted text elements */
  
  /* Border Colors */
  --border-light: rgba(255, 255, 255, 0.08);
  --border-medium: rgba(255, 255, 255, 0.12);
  --border-focus: rgba(79, 110, 242, 0.5);
  
  /* Gradients & Effects */
  --gradient-primary: linear-gradient(135deg, var(--primary), var(--accent));
  --gradient-reverse: linear-gradient(135deg, var(--accent), var(--primary));
  --card-shadow: 0 10px 30px -15px rgba(0, 0, 0, 0.5);
  --text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
  
  /* Spacings */
  --space-xs: 0.25rem;
  --space-sm: 0.5rem;
  --space-md: 1rem;
  --space-lg: 1.5rem;
  --space-xl: 2.5rem;
  --space-xxl: 4rem;
}

/* ======== GLOBAL STYLES ======== */
body {
  background-color: var(--bg-darkest);
  color: var(--text-primary);
  font-family: 'Inter', 'Manrope', sans-serif;
  line-height: 1.6;
  transition: background-color 0.3s ease;
  overflow-x: hidden;
}

/* Typography Refinements */
h1, h2, h3, h4, h5, h6 {
  color: var(--text-primary);
  font-weight: 700;
  letter-spacing: -0.01em;
}

.display-4, .display-5, .display-6 {
  letter-spacing: -0.02em;
  line-height: 1.1;
}

p {
  color: var(--text-secondary);
}

.lead {
  color: var(--text-secondary);
  font-weight: 400;
}

/* Section styling - noise texture overlay for depth */
section {
  position: relative;
}

section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.05'/%3E%3C/svg%3E");
  opacity: 0.4;
  z-index: 0;
  pointer-events: none;
}

/* Section alternating backgrounds */
section:nth-of-type(odd) {
  background-color: var(--bg-darkest);
}

section:nth-of-type(even) {
  background-color: var(--bg-darker);
}

/* Container with z-index to appear above texture */
section .container {
  position: relative;
  z-index: 1;
}

/* ======== BUTTONS ======== */
.btn {
  border-radius: 8px;
  font-weight: 600;
  padding: 0.6rem 1.5rem;
  transition: all 0.2s ease-in-out;
  position: relative;
  overflow: hidden;
}

.btn-primary {
  background: var(--gradient-primary);
  border: none;
  color: white;
  box-shadow: 0 4px 10px rgba(79, 110, 242, 0.2);
}

.btn-primary:hover {
  box-shadow: 0 6px 15px rgba(79, 110, 242, 0.3);
  transform: translateY(-2px);
}

.btn-primary:active {
  transform: translateY(0);
}

.btn-outline-dark {
  background-color: transparent;
  border: 1px solid var(--border-medium);
  color: var(--text-primary);
}

.btn-outline-dark:hover {
  background-color: rgba(255, 255, 255, 0.05);
  border-color: var(--primary-light);
  color: var(--primary-light);
}

.btn-lg {
  padding: 0.7rem 1.8rem;
}

.btn-rounded {
  border-radius: 50px;
}

/* ======== ABOUT HERO SECTION ======== */
.about-hero-section {
  padding: var(--space-xxl) 0;
  background-color: var(--bg-darkest);
  position: relative;
  overflow: hidden;
}

/* Background glow effect */
.about-hero-section::after {
  content: '';
  position: absolute;
  width: 150px;
  height: 150px;
  background: var(--primary);
  filter: blur(100px);
  opacity: 0.15;
  top: 20%;
  left: 10%;
  border-radius: 50%;
  z-index: 0;
}

.about-hero-image {
  position: relative;
}

.about-hero-image img {
  border-radius: 12px;
  object-fit: cover;
  width: 100%;
  height: auto;
  filter: saturate(0.9) contrast(1.1);
  box-shadow: var(--card-shadow);
  transition: all 0.4s ease;
}

.about-hero-image:hover img {
  transform: scale(1.02);
  filter: saturate(1) contrast(1.1);
  box-shadow: 0 20px 40px -20px rgba(0, 0, 0, 0.6);
}

.experience-badge {
  background: var(--gradient-primary);
  right: -15px;
  bottom: 40px;
  padding: 1.2rem 1.5rem;
  border-radius: 12px;
  z-index: 2;
  box-shadow: 0 10px 20px -5px rgba(79, 110, 242, 0.25);
  backdrop-filter: blur(5px);
}

.shape-1, .shape-2 {
  width: 200px;
  height: 200px;
  filter: blur(40px);
  opacity: 0.1;
  z-index: -1;
}

.shape-1 {
  top: -100px;
  right: -50px;
  background: var(--primary);
}

.shape-2 {
  bottom: -100px;
  left: 10%;
  background: var(--accent);
}

.about-hero-content h2 .text-primary {
  position: relative;
  z-index: 1;
}

.about-hero-content h2 .text-primary::after {
  content: '';
  position: absolute;
  height: 30%;
  width: 110%;
  background: var(--gradient-primary);
  bottom: 5px;
  left: -5%;
  opacity: 0.2;
  z-index: -1;
  border-radius: 4px;
}

/* Skill chips */
.about-hero-content .d-flex.flex-wrap {
  gap: 0.8rem !important;
}

.about-hero-content .d-flex.align-items-center {
  background: var(--bg-dark);
  padding: 0.5rem 1rem;
  border-radius: 50px;
  border: 1px solid var(--border-light);
  transition: all 0.3s ease;
}

.about-hero-content .d-flex.align-items-center:hover {
  border-color: var(--primary);
  transform: translateY(-3px);
  box-shadow: 0 5px 15px -5px rgba(79, 110, 242, 0.15);
}

.about-hero-content .d-flex.align-items-center i {
}

/* ======== MY STORY SECTION ======== */
.my-story-section {
  background-color: var(--bg-darker);
  padding: var(--space-xxl) 0;
  position: relative;
  overflow: hidden;
}

/* Animated gradient accent */
.my-story-section::after {
  content: '';
  position: absolute;
  width: 300px;
  height: 300px;
  background: var(--accent);
  filter: blur(120px);
  opacity: 0.07;
  top: 50%;
  right: -100px;
  border-radius: 50%;
  animation: float 15s ease-in-out infinite alternate;
}

@keyframes float {
  0% { transform: translateY(0) rotate(0deg); }
  100% { transform: translateY(-50px) rotate(15deg); }
}

.section-heading .section-line {
  height: 4px;
  width: 60px;
  background: var(--gradient-primary);
  border-radius: 4px;
  margin: 1.5rem auto;
}

.section-heading h6 {
  letter-spacing: 2px;
}

.story-timeline {
  position: relative;
  padding-left: 40px;
  margin-top: 60px;
}

.story-timeline::before {
  content: '';
  position: absolute;
  left: 15px;
  top: 0;
  height: 100%;
  width: 2px;
  background: linear-gradient(to bottom, 
    rgba(79, 110, 242, 0.3) 0%,
    rgba(157, 78, 221, 0.3) 100%);
}

.timeline-item {
  position: relative;
  margin-bottom: 60px;
}

.timeline-item:last-child {
  margin-bottom: 0;
}

.timeline-dot {
  position: absolute;
  left: -15px;
  width: 30px;
  height: 30px;
  background: var(--gradient-primary);
  border-radius: 50%;
  transform: translateY(-50%);
  top: 30px;
  z-index: 2;
  box-shadow: 0 0 0 6px var(--bg-darker);
}

.timeline-content {
  background-color: var(--bg-card);
  border-radius: 12px;
  border: 1px solid var(--border-light);
  padding: 2rem;
  position: relative;
  transition: all 0.3s ease;
}

.timeline-content:hover {
  transform: translateY(-5px) translateX(5px);
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
  border-color: var(--primary-light);
}

.timeline-date {
  display: inline-block;
  padding: 0.3rem 0.8rem;
  background: rgba(157, 78, 221, 0.1);
  border-radius: 4px;
  margin-bottom: 0.8rem;
}

.timeline-title {
  margin-bottom: 1rem;
  color: var(--text-primary);
}

.timeline-text {
  color: var(--text-secondary);
  line-height: 1.7;
}

/* ======== PHILOSOPHY SECTION ======== */
.philosophy-section {
  background-color: var(--bg-darkest);
  padding: var(--space-xxl) 0;
  position: relative;
  overflow: hidden;
}

.philosophy-content {
  padding-right: 2rem;
}

.philosophy-item {
  background-color: var(--bg-card);
  padding: 1.8rem;
  border-radius: 12px;
  border: 1px solid var(--border-light);
  margin-bottom: 1.5rem;
  transition: all 0.3s ease;
  display: flex;
  align-items: flex-start;
}

.philosophy-item:hover {
  transform: translateX(8px);
  border-color: var(--primary);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}

.philosophy-icon {
  background: rgba(79, 110, 242, 0.1);
  border-radius: 12px;
  width: 60px;
  height: 60px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  transition: all 0.3s ease;
}

.philosophy-item:hover .philosophy-icon {
  background: var(--primary);
}

.philosophy-item:hover .philosophy-icon i {
  color: white !important;
}

.philosophy-text h4 {
  margin-bottom: 0.8rem;
  color: var(--text-primary);
}

.philosophy-text p {
  margin-bottom: 0;
  line-height: 1.7;
}

.philosophy-image {
  position: relative;
  z-index: 1;
}

.philosophy-image img {
  border-radius: 12px;
  box-shadow: var(--card-shadow);
  filter: saturate(0.9) contrast(1.1);
  transition: all 0.4s ease;
}

.quote-box {
  background-color: var(--bg-card);
  border: 1px solid var(--border-light);
  border-radius: 12px;
  padding: 1.8rem;
  position: absolute;
  bottom: -30px;
  right: -30px;
  max-width: 300px;
  box-shadow: var(--card-shadow);
  backdrop-filter: blur(10px);
}

.quote-box i {
  opacity: 0.2;
}

.quote-box p {
  color: var(--text-secondary);
  line-height: 1.7;
}

.quote-box p.fw-bold {
  color: var(--primary-light);
}

/* ======== SKILLS SECTION ======== */
.skills-section {
  background-color: var(--bg-darker);
  padding: var(--space-xxl) 0;
  position: relative;
}

.skill-category {
  background-color: var(--bg-card);
  border-radius: 12px;
  border: 1px solid var(--border-light);
  padding: 2rem;
  height: 100%;
  transition: all 0.3s ease;
}

.skill-category:hover {
  transform: translateY(-8px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
  border-color: var(--primary-light);
}

.icon-circle {
  width: 60px;
  height: 60px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 1.5rem;
  transition: all 0.3s ease;
}

.skill-category:hover .icon-circle {
  transform: scale(1.1);
}

.bg-grey {
  background-color: var(--bg-card);
}

.skill-title {
  margin-bottom: 1.5rem;
  position: relative;
  display: inline-block;
}

.skill-title::after {
  content: '';
  position: absolute;
  height: 3px;
  width: 40%;
  background: var(--gradient-primary);
  bottom: -8px;
  left: 0;
  border-radius: 3px;
}

.skill-item {
  padding: 0.8rem 0;
  border-bottom: 1px solid var(--border-light);
  transition: all 0.3s ease;
}

.skill-item:last-child {
  border-bottom: none;
}

.skill-item:hover {
  transform: translateX(5px);
}

.skill-item i {
  width: 20px;
  text-align: center;
}

.progress {
  background-color: rgba(255, 255, 255, 0.1);
  border-radius: 10px;
  overflow: hidden;
}

.progress-bar {
  border-radius: 10px;
  background-image: var(--gradient-primary);
}

/* ======== PERSONAL SECTION ======== */
.personal-section {
  background-color: var(--bg-darkest);
  padding: var(--space-xxl) 0;
  position: relative;
}

.personal-card {
  background-color: var(--bg-card);
  border-radius: 12px;
  border: 1px solid var(--border-light);
  padding: 2rem;
  height: 100%;
  transition: all 0.3s ease;
}

.personal-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
  border-color: var(--primary-light);
}

.personal-icon {
  margin-bottom: 1.5rem;
}

.personal-icon .icon-circle {
  width: 70px;
  height: 70px;
  border-radius: 12px;
  transition: all 0.3s ease;
}

.personal-card:hover .icon-circle {
  transform: scale(1.1) rotate(5deg);
}

.personal-card h4 {
  position: relative;
  display: inline-block;
  margin-bottom: 1.5rem;
}

.personal-card h4::after {
  content: '';
  position: absolute;
  height: 3px;
  width: 40%;
  background: var(--gradient-primary);
  bottom: -8px;
  left: 30%;
  border-radius: 3px;
}

.personal-card ul li {
  color: var(--text-secondary);
  padding: 0.6rem 0;
  border-bottom: 1px dashed var(--border-light);
  transition: all 0.2s ease;
}

.personal-card ul li:last-child {
  border-bottom: none;
}

.personal-card ul li:hover {
  color: var(--primary-light);
  transform: translateX(5px);
}

/* ======== CTA SECTION ======== */
.cta-section {
  background: linear-gradient(45deg, 
    rgba(79, 110, 242, 0.9), 
    rgba(157, 78, 221, 0.9)), 
    url('data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"%3E%3Cpath d="M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z" fill="rgba(255,255,255,0.05)" fill-opacity="0.1" fill-rule="evenodd"/%3E%3C/svg%3E');
  position: relative;
  backdrop-filter: blur(5px);
  padding: 4rem 0;
}

.cta-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="rgba(255,255,255,0.1)" fill-opacity="0.08"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');
  opacity: 0.1;
}

.cta-section h2 {
  margin-bottom: 1rem;
  color: white;
  text-shadow: var(--text-shadow);
}

.cta-section p {
  color: rgba(255, 255, 255, 0.9);
  max-width: 600px;
}

.cta-section .btn-light {
  background: white;
  color: var(--primary);
  border: none;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
  font-weight: 600;
  transition: all 0.3s ease;
}

.cta-section .btn-light:hover {
  background: white;
  color: var(--primary-dark);
  transform: translateY(-3px);
  box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
}

/* ======== RESPONSIVE STYLES ======== */
@media (max-width: 991px) {
  .about-hero-content {
    padding: 2rem 0 0;
  }
  
  .experience-badge {
    right: 20px;
    bottom: 20px;
  }
  
  .philosophy-content {
    padding-right: 0;
    margin-bottom: 3rem;
  }
  
  .quote-box {
    bottom: -20px;
    right: 20px;
    max-width: 250px;
  }
}

@media (max-width: 767px) {
  .section-heading h2, .display-4, .display-5 {
  }
  
  .about-hero-section, .my-story-section, 
  .philosophy-section, .skills-section, 
  .personal-section {
    padding: var(--space-xl) 0;
  }
  
  .timeline-content {
    margin-left: 0;
    padding: 1.5rem;
  }
  
  .quote-box {
    position: relative;
    bottom: 0;
    right: 0;
    max-width: 100%;
    margin-top: -30px;
    z-index: 2;
  }
  
  .philosophy-image {
    margin-bottom: 3rem;
  }
}

/* ======== ANIMATIONS ======== */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Custom AOS animations */
[data-aos="custom-fade-up"] {
  opacity: 0;
  transform: translateY(30px);
  transition: opacity 0.6s ease, transform 0.6s ease;
}

[data-aos="custom-fade-up"].aos-animate {
  opacity: 1;
  transform: translateY(0);
}

/* Custom scrollbar */
::-webkit-scrollbar {
  width: 10px;
}

::-webkit-scrollbar-track {
  background: var(--bg-darkest);
}

::-webkit-scrollbar-thumb {
  background: var(--bg-card);
  border-radius: 5px;
}

::-webkit-scrollbar-thumb:hover {
  background: var(--primary-dark);
}
</style>