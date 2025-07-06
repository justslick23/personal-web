<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $name ?? 'Tokelo Foso' }} - CV</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custom font for professional look -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* ATS-Optimized Styles */
        body {
            font-family: 'Inter', Arial, sans-serif;
            background-color: #ffffff;
            color: #333333;
            line-height: 1.6;
            font-size: 14px;
        }
        
        /* PDF-friendly styles */
        @media print {
            body { 
                background-color: white !important; 
                font-size: 12px;
            }
            .no-print { display: none !important; }
            .page-break { page-break-before: always; }
            .hero-section { 
                background: #f8f9fa !important; 
                color: #333 !important;
                -webkit-print-color-adjust: exact;
            }
            .hero-section a { color: #333 !important; }
            .custom-card { 
                box-shadow: none !important; 
                border: 1px solid #dee2e6 !important;
            }
        }

        /* ATS-friendly header */
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem 0;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }

        /* Clear section headings for ATS */
        .section-heading {
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #667eea;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ATS-friendly card styling */
        .custom-card {
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
            background: white;
        }

        .custom-card:hover {
            transform: none; /* Remove hover effects for ATS */
        }

        /* Contact information styling */
        .contact-info {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
            margin-top: 1rem;
        }

        .contact-item {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            color: white;
            text-decoration: none;
        }

        .contact-item:hover {
            color: white;
            background: rgba(255, 255, 255, 0.3);
        }

        /* Skills grid for better ATS parsing */
        .skills-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1rem;
        }

        /* List styling for ATS */
        .ats-list {
            list-style: none;
            padding-left: 0;
        }

        .ats-list li {
            margin-bottom: 0.5rem;
            padding-left: 1.5rem;
            position: relative;
        }

        .ats-list li::before {
            content: "•";
            color: #667eea;
            font-weight: bold;
            position: absolute;
            left: 0;
        }

        /* Job title and company emphasis */
        .job-title {
            font-weight: 600;
            font-size: 1.1rem;
            color: #2d3748;
        }

        .company-name {
            color: #667eea;
            font-weight: 500;
        }

        .date-range {
            color: #718096;
            font-style: italic;
            font-size: 0.9rem;
        }

        /* Education formatting */
        .degree-title {
            font-weight: 600;
            color: #2d3748;
        }

        .institution {
            color: #667eea;
            font-weight: 500;
        }

        /* Keywords highlighting for ATS */
        .keywords {
            background-color: #f7fafc;
            padding: 1rem;
            border-left: 4px solid #667eea;
            margin: 1rem 0;
        }

        .keyword-tag {
            display: inline-block;
            background-color: #e2e8f0;
            color: #2d3748;
            padding: 0.25rem 0.5rem;
            margin: 0.25rem;
            border-radius: 0.25rem;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="bg-white shadow-sm rounded p-4">

            <!-- Header Section -->
            <header class="text-center hero-section">
                <h1 class="display-4 fw-bold mb-2">{{ $name ?? 'Tokelo Foso' }}</h1>
                <h2 class="h4 mb-3">{{ $title ?? 'Mobile Systems & Software Developer | Web Designer' }}</h2>
                
                <div class="contact-info">
                    <span class="contact-item">
                        <i class="bi bi-phone-fill me-1"></i>
                        {{ $phone ?? '(+266) 6823 1628 | (+266) 2231 5041' }}
                    </span>
                    <a href="mailto:{{ $email ?? 'tokelo.foso23@gmail.com' }}" class="contact-item">
                        <i class="bi bi-envelope-fill me-1"></i>
                        {{ $email ?? 'tokelo.foso23@gmail.com' }}
                    </a>
                    <a href="{{ $website ?? 'https://tokelofoso.online' }}" target="_blank" class="contact-item">
                        <i class="bi bi-globe me-1"></i>
                        {{ $website ?? 'tokelofoso.online' }}
                    </a>
                    <span class="contact-item">
                        <i class="bi bi-geo-alt-fill me-1"></i>
                        {{ $location ?? 'Ha Matala Phase 2, Maseru, Lesotho' }}
                    </span>
                </div>
            </header>

            <!-- Professional Summary -->
            <section class="mb-4">
                <h2 class="section-heading h3">Professional Summary</h2>
                <div class="custom-card p-3">
                    <p class="mb-0">
                        {{ $summary ?? 'Highly motivated and results-oriented professional with a Bachelor\'s degree in Computer & Information Sciences, specializing in Mobile Systems & Software Development. Possessing a strong foundation in full-stack development, database management, and graphic design, complemented by a Microsoft Dynamics 365 Fundamentals Certification. Eager to leverage technical expertise and problem-solving skills to contribute to innovative projects and drive organizational success.' }}
                    </p>
                </div>
            </section>

            <!-- Core Competencies/Keywords -->
            <section class="mb-4">
                <h2 class="section-heading h3">Core Competencies</h2>
                <div class="keywords">
                    @if(isset($keywords) && is_array($keywords))
                        @foreach($keywords as $keyword)
                            <span class="keyword-tag">{{ $keyword }}</span>
                        @endforeach
                    @else
                        <span class="keyword-tag">Full-Stack Development</span>
                        <span class="keyword-tag">Mobile Application Development</span>
                        <span class="keyword-tag">Web Design</span>
                        <span class="keyword-tag">Database Management</span>
                        <span class="keyword-tag">React</span>
                        <span class="keyword-tag">Laravel</span>
                        <span class="keyword-tag">JavaScript</span>
                        <span class="keyword-tag">PHP</span>
                        <span class="keyword-tag">MySQL</span>
                        <span class="keyword-tag">Android Development</span>
                        <span class="keyword-tag">WordPress</span>
                        <span class="keyword-tag">Graphic Design</span>
                        <span class="keyword-tag">Microsoft Dynamics 365</span>
                        <span class="keyword-tag">Software Engineering</span>
                        <span class="keyword-tag">Data Management</span>
                    @endif
                </div>
            </section>

            <!-- Technical Skills -->
            <section class="mb-4">
                <h2 class="section-heading h3">Technical Skills</h2>
                <div class="skills-grid">
                    <div class="custom-card p-3">
                        <h3 class="h5 fw-semibold mb-3">Programming Languages</h3>
                        <ul class="ats-list">
                            <li>HTML5, CSS3, JavaScript (ES6+)</li>
                            <li>PHP, Java</li>
                            <li>SQL</li>
                        </ul>
                    </div>
                    <div class="custom-card p-3">
                        <h3 class="h5 fw-semibold mb-3">Frameworks & Libraries</h3>
                        <ul class="ats-list">
                            <li>React.js, Node.js</li>
                            <li>Laravel, Bootstrap</li>
                            <li>jQuery</li>
                        </ul>
                    </div>
                    <div class="custom-card p-3">
                        <h3 class="h5 fw-semibold mb-3">Databases & Tools</h3>
                        <ul class="ats-list">
                            <li>MySQL, MongoDB</li>
                            <li>Android Studio</li>
                            <li>Adobe Photoshop, WordPress</li>
                            <li>Git, GitHub</li>
                        </ul>
                    </div>
                    <div class="custom-card p-3">
                        <h3 class="h5 fw-semibold mb-3">Certifications</h3>
                        <ul class="ats-list">
                            <li>Microsoft Dynamics 365 Fundamentals</li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Professional Experience -->
            <section class="mb-4">
                <h2 class="section-heading h3">Professional Experience</h2>

                <div class="custom-card p-3 mb-3">
                    <div class="job-title">Website Designer</div>
                    <div class="company-name">Computer Business Solutions</div>
                    <div class="date-range">May 2022 – Present</div>
                    <ul class="ats-list mt-2">
                        <li>Design and develop responsive and user-friendly websites using modern web technologies including HTML5, CSS3, JavaScript, and PHP</li>
                        <li>Collaborate with clients to understand requirements and translate them into effective web solutions using frameworks like Laravel and React</li>
                        <li>Implement and maintain web applications, ensuring optimal performance, security, and cross-browser compatibility</li>
                        <li>Utilize WordPress for content management system development and customization</li>
                    </ul>
                </div>

                <div class="custom-card p-3 mb-3">
                    <div class="job-title">Temporary Records Assistant</div>
                    <div class="company-name">Elizabeth Glazer Pediatric AIDS Foundation</div>
                    <div class="date-range">December 2021 – April 2022</div>
                    <ul class="ats-list mt-2">
                        <li>Managed and organized critical records using database management systems, ensuring accuracy and accessibility of information</li>
                        <li>Performed data entry and record-keeping processes, maintaining high standards of data integrity and compliance</li>
                        <li>Contributed to efficient office operations and provided administrative support to healthcare teams</li>
                    </ul>
                </div>

                <div class="custom-card p-3">
                    <div class="job-title">Freelance Graphic Designer</div>
                    <div class="company-name">Osmium Lesotho</div>
                    <div class="date-range">June 2021 – April 2022</div>
                    <ul class="ats-list mt-2">
                        <li>Created compelling visual content for various clients, including logos, brochures, and marketing materials using Adobe Photoshop</li>
                        <li>Developed brand identity solutions and marketing collateral that met client specifications and industry standards</li>
                        <li>Managed multiple design projects simultaneously, adhering to strict deadlines and client expectations</li>
                    </ul>
                </div>
            </section>

            <!-- Education -->
            <section class="mb-4">
                <h2 class="section-heading h3">Education</h2>

                <div class="custom-card p-3 mb-3">
                    <div class="degree-title">Bachelor of Computer & Information Sciences</div>
                    <div class="institution">Monash University</div>
                    <div class="date-range">2018 – 2020</div>
                    <div class="mt-2">
                        <strong>Specialization:</strong> Mobile Systems & Software Development<br>
                        <strong>Relevant Coursework:</strong> Software Engineering, Database Systems, Mobile Application Development, Web Technologies, Data Structures and Algorithms
                    </div>
                </div>

                <div class="custom-card p-3">
                    <div class="degree-title">International General Certificate in Secondary Education (IGCSE)</div>
                    <div class="institution">Machabeng College</div>
                    <div class="date-range">2014 – 2016</div>
                </div>
            </section>

            <!-- Projects -->
            <section class="mb-4">
                <h2 class="section-heading h3">Key Projects</h2>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="custom-card p-3">
                            <h3 class="h5 fw-semibold">Budget Tracker Application</h3>
                            <ul class="ats-list">
                                <li>Developed web-based financial management application using React and Node.js</li>
                                <li>Implemented data visualization features for spending habits analysis</li>
                                <li>Integrated MySQL database for secure data storage and retrieval</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="custom-card p-3">
                            <h3 class="h5 fw-semibold">Professional Portfolio Website</h3>
                            <ul class="ats-list">
                                <li>Designed and developed responsive portfolio website using HTML5, CSS3, and JavaScript</li>
                                <li>Implemented SEO best practices and mobile-first design principles</li>
                                <li>Deployed using modern web hosting solutions</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="custom-card p-3">
                            <h3 class="h5 fw-semibold">Invoicing Management System</h3>
                            <ul class="ats-list">
                                <li>Created comprehensive invoicing application using Laravel framework</li>
                                <li>Developed client management and payment tracking features</li>
                                <li>Implemented PDF generation and email notification systems</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="custom-card p-3">
                            <h3 class="h5 fw-semibold">COVID-19 Statistics Dashboard</h3>
                            <ul class="ats-list">
                                <li>Built real-time data visualization tool using JavaScript and Chart.js</li>
                                <li>Integrated with REST APIs for live data fetching</li>
                                <li>Implemented responsive design for cross-device compatibility</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Achievements -->
            <section class="mb-4">
                <h2 class="section-heading h3">Professional Achievements</h2>
                <div class="custom-card p-3">
                    <h3 class="h5 fw-semibold">Hack4Equality Hackathon '21 - 2nd Runner Up</h3>
                    <div class="company-name">Google Developer Group (GDG) Maseru</div>
                    <ul class="ats-list mt-2">
                        <li>Collaborated in cross-functional team to develop innovative solutions for social challenges</li>
                        <li>Demonstrated strong problem-solving, teamwork, and rapid prototyping skills</li>
                        <li>Developed functional application prototype within 48-hour timeframe</li>
                    </ul>
                </div>
            </section>

            <!-- References -->
            <section>
                <h2 class="section-heading h3">References</h2>
                <div class="custom-card p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="h5 fw-semibold">Keketso Molepe</h3>
                            <div>Software Development Manager</div>
                            <div>Computer Business Solutions</div>
                            <div>Email: molepe@cbs.co.ls</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-muted">
                                <small>Additional references available upon request</small>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>