<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tokelo Foso - Resume</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Lato', sans-serif;
            font-size: 10.5pt;
            line-height: 1.6;
            color: #333;
            background-color: #f0f2f5;
            padding: 30px;
        }

        a {
            color: #003366;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Main Container for A4 formatting */
        .resume-container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 40px 50px;
        }

        /* Header Section */
        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-family: 'Merriweather', serif;
            font-size: 26pt;
            font-weight: 700;
            color: #003366;
            margin-bottom: 5px;
        }

        .header p.subtitle {
            font-size: 14pt;
            font-weight: 400;
            color: #555;
            margin-bottom: 15px;
        }

        .header .contact-info {
            font-size: 10pt;
            color: #777;
        }

        .header .contact-info a {
            color: #003366;
        }
        
        /* Main Sections */
        .main-section {
            margin-bottom: 30px;
        }

        .main-section h2 {
            font-family: 'Merriweather', serif;
            font-size: 14pt;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
            color: #003366;
            border-bottom: 2px solid #ddd;
            padding-bottom: 5px;
        }

        .entry {
            margin-bottom: 20px;
        }

        .entry-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 5px;
        }

        .entry-title {
            font-size: 12pt;
            font-weight: 700;
            color: #000;
        }

        .entry-subtitle {
            font-style: italic;
            font-size: 11pt;
            color: #555;
        }

        .entry-date {
            font-size: 10pt;
            color: #777;
            white-space: nowrap;
        }

        ul.achievements {
            list-style-type: disc;
            margin-left: 20px;
            margin-top: 8px;
        }

        ul.achievements li {
            margin-bottom: 4px;
        }
        
        /* Skills List - Horizontal Display */
        .skills-list {
            list-style: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap; /* Allows skills to wrap to the next line */
            gap: 10px; /* Space between each skill tag */
        }

        .skills-list li {
            background-color: #e6f0ff;
            color: #003366;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 10pt;
            font-weight: 700;
            white-space: nowrap; /* Prevents skills from breaking in the middle */
        }

        /* Print Styles for A4 */
        @media print {
            @page {
                size: A4;
                margin: 1.5cm;
            }
            body {
                background-color: #fff;
                color: #000;
                padding: 0;
            }
            .resume-container {
                box-shadow: none;
                border-radius: 0;
                padding: 0;
            }
            .header h1, .header p.subtitle, .header .contact-info,
            .main-section h2, .entry-title, .entry-subtitle, .entry-date,
            .entry-details, ul.achievements li, p {
                color: #000 !important;
            }
            .skills-list li {
                background-color: #f0f2f5 !important;
                border: 1px solid #ccc;
            }
        }
    </style>
</head>
<body>

<div class="resume-container">

    <div class="header">
        <h1>Tokelo Foso</h1>
        <p class="subtitle">Software Developer</p>
        <div class="contact-info">
            +266 6823 1628 | <a href="mailto:tokelo.foso23@gmail.com">tokelo.foso23@gmail.com</a> |
            <a href="https://linkedin.com/in/tokelo-foso" target="_blank">linkedin.com/in/tokelo-foso</a> |
            <a href="https://tokelofoso.online" target="_blank">tokelofoso.online</a>
        </div>
    </div>

    <div class="main-section">
        <h2>Professional Summary</h2>
        <p>
            Full-Stack Software Developer with over 3 years of experience specializing in PHP/Laravel, JavaScript/React, and Node.js. Proven ability to architect, develop, and launch scalable web applications for government, corporate, and non-profit clients. A strong problem-solver with a focus on delivering end-to-end solutions that improve efficiency, streamline processes, and enhance user experience.
        </p>
    </div>

    <div class="main-section">
        <h2>Skills</h2>
        <ul class="skills-list">
            <li>JavaScript (ES6+)</li>
            <li>PHP</li>
            <li>Java</li>
            <li>HTML5</li>
            <li>CSS3</li>
            <li>React.js</li>
            <li>Node.js</li>
            <li>Laravel</li>
            <li>WordPress</li>
            <li>MySQL</li>
            <li>MongoDB</li>
            <li>REST APIs</li>
            <li>Android App Development</li>
            <li>Joget Workflow</li>
            <li>Full-Stack Development</li>
            <li>System Architecture</li>
            <li>Project Management</li>
        </ul>
    </div>

    <div class="main-section">
        <h2>Work Experience</h2>
        
        <div class="entry">
            <div class="entry-header">
                <div class="entry-details">
                    <div class="entry-title">Website Designer</div>
                    <div class="entry-subtitle">Computer Business Solutions | Maseru, Lesotho</div>
                </div>
                <span class="entry-date">2022 – Present</span>
            </div>
            <ul class="achievements">
                <li>Led the full project lifecycle from concept to deployment for custom web solutions, portals, and internal systems using PHP, Laravel, React, and WordPress.</li>
                <li>Designed and developed high-impact corporate and government websites for key clients, including Metropolitan Lesotho and the Government of Lesotho.</li>
                <li>Engineered the CAFI Grant Management System, a custom web solution designed to streamline the application and evaluation process for a non-profit client.</li>
                <li>Provided ongoing maintenance, updates, and technical support for a portfolio of client systems, ensuring high performance and uptime.</li>
            </ul>
        </div>
        
        <div class="entry">
            <div class="entry-header">
                <div class="entry-details">
                    <div class="entry-title">Temporary Records Assistant</div>
                    <div class="entry-subtitle">Elizabeth Glaser Pediatric AIDS Foundation</div>
                </div>
                <span class="entry-date">2021 – 2022</span>
            </div>
            <ul class="achievements">
                <li>Supported comprehensive records management, ensuring compliance with organizational and regulatory standards.</li>
            </ul>
        </div>
        
        <div class="entry">
            <div class="entry-header">
                <div class="entry-details">
                    <div class="entry-title">Graphic Designer</div>
                    <div class="entry-subtitle">Osmium Lesotho</div>
                </div>
                <span class="entry-date">2021 – 2022</span>
            </div>
            <ul class="achievements">
                <li>Created engaging digital and print graphics for marketing campaigns, contributing to enhanced brand visibility.</li>
            </ul>
        </div>
        
    </div>
    
    <div class="main-section">
        <h2>Key Projects</h2>

        <div class="entry">
            <div class="entry-header">
                <div class="entry-details">
                    <div class="entry-title">Government & Public Sector Websites</div>
                    <div class="entry-subtitle">Role: Lead Website Designer | 2022 - Present</div>
                </div>
            </div>
            <ul class="achievements">
                <li>Government of Lesotho official website</li>
                <li>Lesotho Embassy (USA) website</li>
                <li>WASCO, MOFPMU, NUL website support & maintenance</li>
                <li>CAFI Grant Management System</li>
            </ul>
        </div>

        <div class="entry">
            <div class="entry-header">
                <div class="entry-details">
                    <div class="entry-title">Corporate Websites & Platforms</div>
                    <div class="entry-subtitle">Role: Lead Developer/Designer | 2022 - Present</div>
                </div>
            </div>
            <ul class="achievements">
                <li>Metropolitan Lesotho corporate website</li>
                <li>Lesotho Flour Mills website</li>
                <li>Computer Business Solutions website & HR Recruitment System</li>
            </ul>
        </div>
    </div>

    <div class="main-section">
        <h2>Education</h2>
        
        <div class="entry">
            <div class="entry-header">
                <div class="entry-details">
                    <div class="entry-title">Bachelor of Computer & Information Sciences</div>
                    <div class="entry-subtitle">Monash University</div>
                </div>
                <span class="entry-date">2018 - 2020</span>
            </div>
        </div>
        
        <div class="entry">
            <div class="entry-header">
                <div class="entry-details">
                    <div class="entry-title">Foundation Programme, IT</div>
                    <div class="entry-subtitle">Monash South Africa</div>
                </div>
                <span class="entry-date">2017 - 2018</span>
            </div>
        </div>
        
        <div class="entry">
            <div class="entry-header">
                <div class="entry-details">
                    <div class="entry-title">IGCSE</div>
                    <div class="entry-subtitle">Machabeng College</div>
                </div>
                <span class="entry-date">2014 - 2016</span>
            </div>
        </div>
        
    </div>
    
    <div class="main-section">
        <h2>Certifications</h2>
        <p>
            <strong style="font-size: 11pt;">Microsoft Certified:</strong> Dynamics 365 Fundamentals (CRM) | Issued March 2024
        </p>
    </div>

</div>

</body>
</html>