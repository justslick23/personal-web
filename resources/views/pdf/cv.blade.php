<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tokelo Foso - CV</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* CLEAN PDF CV - NO BACKGROUNDS */
        @page {
            size: A4;
            margin: 15mm;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', Arial, sans-serif;
            font-size: 10pt;
            line-height: 1.5;
            color: #000000;
            background: white;
        }

        .cv-page {
            max-width: 210mm;
            margin: 0 auto;
            background: white;
            padding: 15mm;
        }

        /* HEADER */
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #1e40af;
        }

        .header h1 {
            font-size: 24pt;
            font-weight: 700;
            color: #1e40af;
            margin-bottom: 5px;
        }

        .header .title {
            font-size: 12pt;
            font-weight: 600;
            color: #374151;
            margin-bottom: 10px;
        }

        .header .contact {
            font-size: 9pt;
            color: #4b5563;
            line-height: 1.6;
        }

        .header .contact a {
            color: #1e40af;
            text-decoration: none;
        }

        /* SECTIONS */
        .section {
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 12pt;
            font-weight: 700;
            color: #1e40af;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 2px solid #1e40af;
        }

        /* SUMMARY */
        .summary {
            font-size: 10pt;
            line-height: 1.6;
            text-align: justify;
            color: #374151;
        }

        /* SKILLS */
        .skills-list {
            line-height: 1.8;
            color: #374151;
        }

        .skill-item {
            display: inline;
            font-size: 9.5pt;
        }

        .skill-item::after {
            content: " • ";
            margin: 0 3px;
        }

        .skill-item:last-child::after {
            content: "";
        }

        /* TECHNICAL SKILLS */
        .tech-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .tech-item {
            margin-bottom: 8px;
        }

        .tech-item strong {
            font-size: 10pt;
            font-weight: 700;
            color: #111827;
            display: block;
            margin-bottom: 4px;
        }

        .tech-item span {
            font-size: 9.5pt;
            color: #4b5563;
            line-height: 1.5;
        }

        /* ENTRIES */
        .entry {
            margin-bottom: 16px;
        }

        .entry-title {
            font-size: 10.5pt;
            font-weight: 700;
            color: #111827;
            margin-bottom: 2px;
        }

        .entry-company {
            font-size: 10pt;
            font-weight: 600;
            color: #1e40af;
            margin-bottom: 2px;
        }

        .entry-date {
            font-size: 9pt;
            color: #6b7280;
            font-style: italic;
            margin-bottom: 6px;
        }

        .entry ul {
            margin: 6px 0 0 18px;
            padding: 0;
        }

        .entry li {
            margin-bottom: 4px;
            font-size: 9.5pt;
            line-height: 1.55;
            color: #374151;
        }

        .specialization {
            font-size: 9.5pt;
            color: #4b5563;
            margin-top: 4px;
        }

        .specialization strong {
            font-weight: 600;
            color: #111827;
        }

        /* CERTIFICATIONS */
        .cert-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .cert-item {
            border-left: 3px solid #1e40af;
            padding-left: 10px;
        }

        .cert-title {
            font-size: 9.5pt;
            font-weight: 700;
            color: #111827;
            line-height: 1.3;
            margin-bottom: 2px;
        }

        .cert-issuer {
            font-size: 9pt;
            color: #4b5563;
            font-weight: 600;
        }

        .cert-date {
            font-size: 8.5pt;
            color: #6b7280;
            font-style: italic;
        }

        /* PRINT STYLES */
        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .cv-page {
                padding: 0;
                margin: 0;
            }

            .section {
                page-break-inside: avoid;
            }

            .entry {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>

<div class="cv-page">

    <!-- HEADER -->
    <header class="header">
        <h1>TOKELO FOSO</h1>
        <div class="title">Software Developer</div>
        <div class="contact">
            +266 6823 1628 | tokelo.foso23@gmail.com<br>
            <a href="https://linkedin.com/in/tokelo-foso">linkedin.com/in/tokelo-foso</a> | 
            <a href="https://tokelofoso.online">tokelofoso.online</a>
        </div>
    </header>

    <!-- PROFESSIONAL SUMMARY -->
    <section class="section">
        <h2 class="section-title">Professional Summary</h2>
        <p class="summary">
            Full-Stack Software Developer with over 3 years of experience specializing in PHP/Laravel, JavaScript/React, and Node.js. Proven ability to architect, develop, and launch scalable web applications for government, corporate, and non-profit clients. Strong problem-solver with a focus on delivering end-to-end solutions that improve efficiency, streamline processes, and enhance user experience. Bachelor's degree in Computer & Information Sciences with certifications in Microsoft Dynamics 365 and Oracle Cloud Infrastructure.
        </p>
    </section>

    <!-- CORE COMPETENCIES -->
    <section class="section">
        <h2 class="section-title">Core Competencies</h2>
        <div class="skills-list">
            <span class="skill-item">Full-Stack Development</span>
            <span class="skill-item">PHP/Laravel</span>
            <span class="skill-item">JavaScript/React.js</span>
            <span class="skill-item">Node.js</span>
            <span class="skill-item">MySQL/MongoDB</span>
            <span class="skill-item">REST APIs</span>
            <span class="skill-item">WordPress Development</span>
            <span class="skill-item">Android Development</span>
            <span class="skill-item">System Architecture</span>
            <span class="skill-item">Cloud Infrastructure</span>
            <span class="skill-item">AI Foundations</span>
            <span class="skill-item">Database Design</span>
            <span class="skill-item">Project Management</span>
            <span class="skill-item">Version Control (Git)</span>
            <span class="skill-item">Responsive Design</span>
        </div>
    </section>

    <!-- TECHNICAL SKILLS -->
    <section class="section">
        <h2 class="section-title">Technical Skills</h2>
        <div class="tech-grid">
            <div class="tech-item">
                <strong>Programming Languages</strong>
                <span>JavaScript (ES6+), PHP, Java, HTML5, CSS3, SQL</span>
            </div>
            <div class="tech-item">
                <strong>Frameworks & Libraries</strong>
                <span>React.js, Node.js, Laravel, WordPress, Bootstrap, jQuery</span>
            </div>
            <div class="tech-item">
                <strong>Databases & Cloud</strong>
                <span>MySQL, MongoDB, Oracle Cloud Infrastructure (OCI)</span>
            </div>
            <div class="tech-item">
                <strong>Tools & Platforms</strong>
                <span>Git, GitHub, Android Studio, Joget Workflow, Adobe Photoshop</span>
            </div>
        </div>
    </section>

    <!-- PROFESSIONAL EXPERIENCE -->
    <section class="section">
        <h2 class="section-title">Professional Experience</h2>

        <div class="entry">
            <div class="entry-title">Website Designer</div>
            <div class="entry-company">Computer Business Solutions, Maseru, Lesotho</div>
            <div class="entry-date">May 2022 – Present</div>
            <ul>
                <li>Led full project lifecycle from concept to deployment for custom web solutions, portals, and internal systems using PHP, Laravel, React, and WordPress</li>
                <li>Designed and developed high-impact corporate and government websites for key clients including Metropolitan Lesotho and the Government of Lesotho</li>
                <li>Engineered the CAFI Grant Management System, a custom web solution to streamline application and evaluation processes</li>
                <li>Developed and maintained websites for WASCO, MOFPMU, National University of Lesotho, and Lesotho Embassy (USA)</li>
                <li>Provided ongoing maintenance, updates, and technical support ensuring high performance and uptime</li>
            </ul>
        </div>

        <div class="entry">
            <div class="entry-title">Temporary Records Assistant</div>
            <div class="entry-company">Elizabeth Glaser Pediatric AIDS Foundation, Maseru, Lesotho</div>
            <div class="entry-date">December 2021 – April 2022</div>
            <ul>
                <li>Supported comprehensive records management using database systems, ensuring compliance with organizational standards</li>
                <li>Performed accurate data entry and maintained high standards of data integrity</li>
            </ul>
        </div>

        <div class="entry">
            <div class="entry-title">Freelance Graphic Designer</div>
            <div class="entry-company">Osmium Lesotho, Maseru, Lesotho</div>
            <div class="entry-date">June 2021 – April 2022</div>
            <ul>
                <li>Created engaging digital and print graphics for marketing campaigns, enhancing brand visibility</li>
                <li>Developed brand identity solutions including logos and marketing materials using Adobe Photoshop</li>
            </ul>
        </div>
    </section>

    <!-- KEY PROJECTS -->
    <section class="section">
        <h2 class="section-title">Key Projects</h2>

        <div class="entry">
            <div class="entry-title">Government & Public Sector Websites</div>
            <div class="entry-date">2022 – Present</div>
            <ul>
                <li>Government of Lesotho official website – Full design and development</li>
                <li>Lesotho Embassy (USA) website – Complete redesign and implementation</li>
                <li>CAFI Grant Management System – Custom Laravel application for grant processing</li>
                <li>WASCO, MOFPMU, National University of Lesotho – Website support and maintenance</li>
            </ul>
        </div>

        <div class="entry">
            <div class="entry-title">Corporate Websites & Platforms</div>
            <div class="entry-date">2022 – Present</div>
            <ul>
                <li>Metropolitan Lesotho corporate website – Full-stack development and deployment</li>
                <li>Lesotho Flour Mills website – Design and implementation</li>
                <li>Computer Business Solutions website and HR Recruitment System – Custom portal development</li>
            </ul>
        </div>
    </section>

    <!-- EDUCATION -->
    <section class="section">
        <h2 class="section-title">Education</h2>

        <div class="entry">
            <div class="entry-title">Bachelor of Computer & Information Sciences</div>
            <div class="entry-company">Monash University</div>
            <div class="entry-date">2018 – 2020</div>
            <div class="specialization"><strong>Specialization:</strong> Mobile Systems & Software Development</div>
        </div>

        <div class="entry">
            <div class="entry-title">Foundation Programme, Information Technology</div>
            <div class="entry-company">Monash South Africa</div>
            <div class="entry-date">2017 – 2018</div>
        </div>

        <div class="entry">
            <div class="entry-title">International General Certificate of Secondary Education (IGCSE)</div>
            <div class="entry-company">Machabeng College</div>
            <div class="entry-date">2014 – 2016</div>
        </div>
    </section>

    <!-- CERTIFICATIONS -->
    <section class="section">
        <h2 class="section-title">Certifications</h2>
        <div class="cert-grid">
            <div class="cert-item">
                <div class="cert-title">Oracle Cloud Infrastructure Foundations</div>
                <div class="cert-issuer">Oracle (OCI)</div>
                <div class="cert-date">September 2025</div>
            </div>
            <div class="cert-item">
                <div class="cert-title">Oracle Cloud Infrastructure AI Foundations</div>
                <div class="cert-issuer">Oracle (OCI)</div>
                <div class="cert-date">October 2025</div>
            </div>
            <div class="cert-item">
                <div class="cert-title">Microsoft Dynamics 365 Fundamentals (CRM)</div>
                <div class="cert-issuer">Microsoft</div>
                <div class="cert-date">March 2024</div>
            </div>
        </div>
    </section>

</div>

</body>
</html>