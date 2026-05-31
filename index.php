<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ═══ PRIMARY SEO ═══ -->
    <title>Christian Digman | Computer Engineer — Philippines</title>
    <meta name="description" content="Christian Digman (DevDcii) — Full-Stack Developer, Mobile App Developer, Data Analyst based in Santa Ana, Pampanga, Philippines. Available for freelance web, mobile, and hardware projects.">
    <meta name="keywords" content="Christian Digman, DevDcii, Full-Stack Developer Philippines, Web Developer Pampanga, Mobile App Developer, Flutter Developer, React Developer, Laravel Developer, IoT Engineer, Shopify Developer, Data Analyst Philippines, Computer Engineer">
    <meta name="author" content="Christian Digman">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://devdcii.com/">

    <!-- ═══ OPEN GRAPH ═══ -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://devdcii.com/">
    <meta property="og:title" content="Christian Digman | Computer Engineer">
    <meta property="og:description" content="Full-Stack Developer, Mobile App Developer, Data Analyst based in Pampanga, Philippines. Building end-to-end web, mobile, and hardware solutions.">
    <meta property="og:image" content="https://devdcii.com/images/devdcii.png">
    <meta property="og:site_name" content="DevDcii — Christian Digman Portfolio">
    <meta property="og:locale" content="en_PH">

    <!-- ═══ TWITTER CARD ═══ -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Christian Digman | Computer Engineer">
    <meta name="twitter:description" content="Full-Stack Developer, Mobile App Developer, Data Analyst based in Pampanga, Philippines.">
    <meta name="twitter:image" content="https://devdcii.com/images/devdcii.png">

    <!-- ═══ GEO / LOCAL SEO ═══ -->
    <meta name="geo.region" content="PH-03">
    <meta name="geo.placename" content="Santa Ana, Pampanga, Philippines">
    <meta name="geo.position" content="15.0794;120.7693">
    <meta name="ICBM" content="15.0794, 120.7693">

    <!-- ═══ STRUCTURED DATA ═══ -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Person",
        "name": "Christian Digman",
        "alternateName": "DevDcii",
        "url": "https://devdcii.com",
        "image": "https://devdcii.com/images/devdcii.png",
        "jobTitle": "Full-Stack Developer & Computer Engineer",
        "description": "Full-Stack Developer, Mobile App Developer, Data Analyst and IoT Systems Engineer based in Santa Ana, Pampanga, Philippines.",
        "email": "digmanchristian0@gmail.com",
        "telephone": "+639993921960",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "Santa Ana",
            "addressRegion": "Pampanga",
            "addressCountry": "PH"
        },
        "sameAs": [
            "https://github.com/devdcii",
            "https://linkedin.com/in/christiandigman"
        ],
        "knowsAbout": [
            "Full-Stack Web Development", "React", "Laravel", "Node.js",
            "Flutter", "Mobile App Development", "IoT Systems", "ESP32",
            "Data Analytics", "Shopify Development", "Python", "PHP"
        ]
    }
    </script>

    <!-- ═══ FAVICON ═══ -->
    <link rel="icon" type="image/png" sizes="32x32" href="images/devdcii.png?v=2">
    <link rel="icon" type="image/png" sizes="16x16" href="images/devdcii.png?v=2">
    <link rel="apple-touch-icon" href="images/devdcii.png?v=2">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- NAV -->
    <nav id="navbar">
        <a href="#home" class="logo">
            <img src="images/devdcii.png" alt="DevDcii Logo" class="logo-img">
            <span class="logo-text">Dev<span class="acc">Dcii</span></span>
        </a>
        <ul class="nav-links">
            <li><a href="#home" class="active">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#techstack">Tech Stack</a></li>
            <li><a href="#projects">Projects</a></li>
            <li><a href="#certifications">Certifications</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
        <button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
    </nav>

    <!-- MOBILE MENU -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="#home" onclick="closeMobileMenu()">Home</a>
        <a href="#about" onclick="closeMobileMenu()">About</a>
        <a href="#techstack" onclick="closeMobileMenu()">Tech Stack</a>
        <a href="#projects" onclick="closeMobileMenu()">Projects</a>
        <a href="#certifications" onclick="closeMobileMenu()">Certifications</a>
        <a href="#services" onclick="closeMobileMenu()">Services</a>
        <a href="#contact" onclick="closeMobileMenu()">Contact</a>
    </div>

    <!-- HERO -->
    <section id="home" class="hero">
        <div class="hero-bg-grid"></div>
        <div class="hero-orb orb-1"></div>
        <div class="hero-orb orb-2"></div>
        <div class="hero-orb orb-3"></div>

        <div class="hero-content">
            <div class="hero-badge"><span class="badge-dot"></span> Based in Santa Ana, Pampanga, PH</div>
            <h1>Hi, I'm <span class="name">Christian Digman</span></h1>
            <p style="font-family:'Syne',sans-serif;font-size:1.5rem;font-weight:700;color:var(--white);margin-bottom:.6rem;line-height:1.3;">Computer Engineer</p>
            <p class="hero-sub">
                Full-Stack Developer <span class="dot">•</span>
                Data Analyst <span class="dot">•</span>
                Mobile App Developer
            </p>
            <div class="hero-actions">
                <button class="btn-primary" onclick="smoothScrollTo('projects')"><i class="fas fa-th-large"></i> View Projects</button>
                <button class="btn-ghost" onclick="smoothScrollTo('contact')"><i class="fas fa-paper-plane"></i> Hire Me</button>
                <a class="btn-ghost" href="assets/cv.pdf" download><i class="fas fa-download"></i> Download CV</a>
            </div>
        </div>

        <div class="hero-visual">
            <div class="profile-frame">
                <div class="ring-outer"></div>
                <div class="ring-inner"></div>
                <div class="profile-img-wrap">
                    <img src="images/team/Xii.jpg" alt="Christian Digman" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                    <div class="profile-placeholder" style="display:none"><i class="fas fa-user-circle"></i></div>
                </div>
                <div class="badge-float">
                    <div class="bf-icon"><i class="fas fa-code"></i></div>
                    <div class="bf-text"><strong>Computer Engineer</strong></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT -->
    <section id="about" class="about">
        <div class="container">
            <div style="text-align:center;margin-bottom:3rem;">
                <span class="section-label">ABOUT ME</span>
                <h2 class="section-heading" style="text-align:center;">Engineer Who <span class="gradient-text">Builds End-to-End</span></h2>
            </div>
            <div class="about-grid">
                <div class="about-left reveal-l">
                    <div class="about-photo-frame">
                        <img src="images/team/Dii.jpg" alt="Christian Digman" onerror="this.src=''">
                    </div>
                    <div class="about-badge">
                        <strong>Christian Digman</strong>
                        <span>Computer Engineer</span>
                    </div>
                </div>
                <div class="about-right reveal-r">
                    <div>
                        <span class="section-label" style="font-size:.65rem;">WHO I AM</span>
                        <p class="about-desc">I'm a <strong>Computer Engineering graduate</strong> from Holy Cross College Pampanga, with hands-on experience building full-stack web applications, IoT systems, and data-driven solutions. I specialize in taking products from concept all the way to a deployed, working solution — across web, mobile, and embedded hardware.</p>
                        <p class="about-desc" style="margin-top:.9rem;">I've worked on Shopify-embedded apps, Flutter mobile apps, ESP32-based IoT systems, and data analytics pipelines. Whether it's frontend UI, backend APIs, databases, or microcontrollers — I connect the dots end-to-end.</p>
                        <div class="about-tags" style="margin-top:1rem;">
                            <span class="tag"><i class="fas fa-code"></i> Full-Stack Web</span>
                            <span class="tag"><i class="fas fa-chart-bar"></i> Data Analytics</span>
                            <span class="tag"><i class="fas fa-microchip"></i> Hardware/IoT</span>
                            <span class="tag"><i class="fas fa-cogs"></i> Embedded Systems</span>
                            <span class="tag"><i class="fab fa-shopify"></i> Shopify Dev</span>
                            <span class="tag"><i class="fas fa-mobile-alt"></i> Mobile Application</span>
                            <span class="tag"><i class="fas fa-robot"></i> AI Automation</span>
                            <span class="tag"><i class="fas fa-database"></i> Database Design</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- EDUCATION & EXPERIENCE -->
    <section id="experience" class="edu-exp">
        <div class="container">
            <div style="text-align:center;margin-bottom:.5rem;">
                <span class="section-label">BACKGROUND</span>
                <h2 class="section-heading" style="text-align:center;">Education &amp; <span class="gradient-text">Experience</span></h2>
            </div>
            <div class="dual-timeline">
                <div class="reveal-l">
                    <div class="tl-col-head"><i class="fas fa-graduation-cap"></i> Education</div>
                    <div class="timeline">
                        <div class="tl-item">
                            <span class="tl-year">2022 – 2026</span>
                            <div class="tl-title">BS Computer Engineering</div>
                            <div class="tl-org">Holy Cross College Pampanga — Santa Ana, Pampanga</div>
                            <div class="tl-desc">Graduated with focus on Full-Stack Development, and Data Analytics.</div>
                        </div>
                        <div class="tl-item">
                            <span class="tl-year">2020 – 2022</span>
                            <div class="tl-title">STEM (Science, Technology, Engineering & Mathematics)</div>
                            <div class="tl-org">Holy Cross College Pampanga — Santa Ana, Pampanga</div>
                            <div class="tl-desc">Completed the STEM Strand with a focus on Mathematics, Science, Technology, and Engineering Fundamentals that prepared me for pursuing Computer Engineering.</div>
                        </div>
                    </div>
                </div>
                <div class="reveal-r">
                    <div class="tl-col-head"><i class="fas fa-briefcase"></i> Experience</div>
                    <div class="timeline">
                        <div class="tl-item">
                            <span class="tl-year">2026</span>
                            <div class="tl-title">Full-Stack Developer Intern</div>
                            <div class="tl-org">Codebility</div>
                        </div>
                        <div class="tl-item">
                            <span class="tl-year">2025</span>
                            <div class="tl-title">Multimedia Intern</div>
                            <div class="tl-org">Information Communication Department</div>
                        </div>
                        <div class="tl-item">
                            <span class="tl-year">2022 – 2026</span>
                            <div class="tl-title">BS Computer Engineering</div>
                            <div class="tl-org">Holy Cross College Pampanga</div>
                        </div>
                        <div class="tl-item">
                            <span class="tl-year">2022</span>
                            <div class="tl-title">Hello World! 👋🏻</div>
                            <div class="tl-org">Started My Programming Journey</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TECH STACK -->
    <section id="techstack" class="techstack">
        <div class="container">
            <div class="section-header reveal">
                <span class="section-label">TECHNOLOGIES</span>
                <h2 class="section-heading">My <span class="gradient-text">Tech Stack</span></h2>
                <p class="section-sub">Technologies and tools I use to build products from concept to deployment.</p>
            </div>
            <div class="tech-categories">

                <!-- Frontend -->
                <div class="tech-cat-card reveal">
                    <div class="cat-header">
                        <div class="cat-icon"><i class="fas fa-layer-group"></i></div>
                        <span class="cat-name">Frontend</span>
                    </div>
                    <div class="tech-pills">
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg" class="tech-icon" alt="">HTML5</span>
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg" class="tech-icon" alt="">CSS3</span>
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" class="tech-icon" alt="">JavaScript</span>
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/bootstrap/bootstrap-original.svg" class="tech-icon" alt="">Bootstrap</span>
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg" class="tech-icon" alt="">React</span>
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nextjs/nextjs-original.svg" class="tech-icon" alt="">Next.js</span>
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vitejs/vitejs-original.svg" class="tech-icon" alt="">Vite</span>
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/typescript/typescript-original.svg" class="tech-icon" alt="">TypeScript</span>
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/tailwindcss/tailwindcss-original.svg" class="tech-icon" alt="">Tailwind CSS</span>
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/flutter/flutter-original.svg" class="tech-icon" alt="">Flutter</span>
                        <span class="tech-pill"><i class="fab fa-shopify tech-icon-fa"></i>Liquid</span>
                    </div>
                </div>

                <!-- Backend -->
                <div class="tech-cat-card reveal">
                    <div class="cat-header">
                        <div class="cat-icon"><i class="fas fa-server"></i></div>
                        <span class="cat-name">Backend</span>
                    </div>
                    <div class="tech-pills">
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" class="tech-icon" alt="">PHP</span>
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg" class="tech-icon" alt="">Laravel</span>
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg" class="tech-icon" alt="">Node.js</span>
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/express/express-original.svg" class="tech-icon" alt="">Express.js</span>
                        <span class="tech-pill"><i class="fas fa-plug tech-icon-fa"></i>REST APIs</span>
                        <span class="tech-pill"><i class="fab fa-shopify tech-icon-fa"></i>Shopify API</span>
                    </div>
                </div>

                <!-- Database -->
                <div class="tech-cat-card reveal">
                    <div class="cat-header">
                        <div class="cat-icon"><i class="fas fa-database"></i></div>
                        <span class="cat-name">Database</span>
                    </div>
                    <div class="tech-pills">
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg" class="tech-icon" alt="">MySQL</span>
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/postgresql/postgresql-original.svg" class="tech-icon" alt="">PostgreSQL</span>
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/sqlite/sqlite-original.svg" class="tech-icon" alt="">SQLite</span>
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/prisma/prisma-original.svg" class="tech-icon" alt="">Prisma ORM</span>
                        <span class="tech-pill"><i class="fas fa-cloud tech-icon-fa"></i>Cloudinary</span>
                    </div>
                </div>

                <!-- Programming -->
                <div class="tech-cat-card reveal">
                    <div class="cat-header">
                        <div class="cat-icon"><i class="fab fa-python"></i></div>
                        <span class="cat-name">Programming</span>
                    </div>
                    <div class="tech-pills">
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg" class="tech-icon" alt="">Python</span>
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" class="tech-icon" alt="">JavaScript</span>
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" class="tech-icon" alt="">PHP</span>
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/cplusplus/cplusplus-original.svg" class="tech-icon" alt="">C++</span>
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/dart/dart-original.svg" class="tech-icon" alt="">Dart</span>
                    </div>
                </div>

                <!-- Hardware & IoT -->
                <div class="tech-cat-card reveal">
                    <div class="cat-header">
                        <div class="cat-icon"><i class="fas fa-microchip"></i></div>
                        <span class="cat-name">Hardware &amp; IoT</span>
                    </div>
                    <div class="tech-pills">
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/arduino/arduino-original.svg" class="tech-icon" alt="">Arduino</span>
                        <span class="tech-pill"><i class="fas fa-wifi tech-icon-fa"></i>ESP32</span>
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/raspberrypi/raspberrypi-original.svg" class="tech-icon" alt="">Raspberry Pi</span>
                        <span class="tech-pill"><i class="fas fa-broadcast-tower tech-icon-fa"></i>IoT Systems</span>
                        <span class="tech-pill"><i class="fas fa-robot tech-icon-fa"></i>AI Automation</span>
                        <span class="tech-pill"><i class="fas fa-wave-square tech-icon-fa"></i>Sensors</span>
                        <span class="tech-pill"><i class="fas fa-microchip tech-icon-fa"></i>Embedded C/C++</span>
                    </div>
                </div>

                <!-- Tools & DevOps -->
                <div class="tech-cat-card reveal">
                    <div class="cat-header">
                        <div class="cat-icon"><i class="fas fa-tools"></i></div>
                        <span class="cat-name">Tools &amp; DevOps</span>
                    </div>
                    <div class="tech-pills">
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/git/git-original.svg" class="tech-icon" alt="">Git</span>
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg" class="tech-icon" alt="">GitHub</span>
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vscode/vscode-original.svg" class="tech-icon" alt="">VS Code</span>
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/docker/docker-original.svg" class="tech-icon" alt="">Docker</span>
                        <span class="tech-pill"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vercel/vercel-original.svg" class="tech-icon" alt="">Vercel</span>
                        <span class="tech-pill"><i class="fas fa-train tech-icon-fa"></i>Railway</span>
                        <span class="tech-pill"><i class="fas fa-file-excel tech-icon-fa"></i>Excel</span>
                        <span class="tech-pill"><i class="fas fa-magic tech-icon-fa"></i>Codemagic</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- PROJECTS -->
    <section id="projects" class="projects">
        <div class="container">
            <div class="section-header reveal">
                <span class="section-label">MY WORK</span>
                <h2 class="section-heading">Featured <span class="gradient-text">Projects</span></h2>
                <p class="section-sub">Click any project to view images, videos, and full details.</p>
            </div>
            <div class="project-filters">
                <button class="filter-btn active" data-filter="all">All</button>
                <button class="filter-btn" data-filter="web">Web</button>
                <button class="filter-btn" data-filter="mobile">Mobile</button>
                <button class="filter-btn" data-filter="hardware">Hardware</button>
                <button class="filter-btn" data-filter="data analytics">Data Analytics</button>
            </div>
            <div class="projects-grid" id="projectsGrid">
                <div class="projects-loading">
                    <i class="fas fa-circle-notch fa-spin"></i>
                    <p>Loading projects...</p>
                </div>
            </div>
            <div class="projects-empty" id="projectsEmpty" style="display:none;">
                <i class="fas fa-folder-open"></i>
                <p>No projects yet. Check back soon!</p>
            </div>
        </div>
    </section>

    <!-- CERTIFICATIONS -->
    <section id="certifications" class="certifications">
        <div class="container">
            <div class="section-header reveal">
                <span class="section-label">CREDENTIALS</span>
                <h2 class="section-heading">My <span class="gradient-text">Certifications</span></h2>
                <p class="section-sub">Professional certifications and training I've completed.</p>
            </div>
            <div class="certs-grid">

                <div class="cert-card reveal">
                    <div class="cert-icon-wrap"><i class="fas fa-code cert-icon"></i></div>
                    <div class="cert-body">
                        <div class="cert-issuer">Codechum</div>
                        <h3 class="cert-title">C++ Programming 1</h3>
                        <div class="cert-meta">
                            <span class="cert-date"><i class="fas fa-calendar-alt"></i> November 2024</span>
                            <span class="cert-badge">Programming</span>
                        </div>
                    </div>
                    <a href="assets/certifications/codechum-cpp1.pdf" target="_blank" class="cert-view-btn" title="View Certificate"><i class="fas fa-external-link-alt"></i></a>
                </div>

                <div class="cert-card reveal">
                    <div class="cert-icon-wrap"><i class="fas fa-code cert-icon"></i></div>
                    <div class="cert-body">
                        <div class="cert-issuer">Codechum</div>
                        <h3 class="cert-title">C++ Programming 2</h3>
                        <div class="cert-meta">
                            <span class="cert-date"><i class="fas fa-calendar-alt"></i> February 2025</span>
                            <span class="cert-badge">Programming</span>
                        </div>
                    </div>
                    <a href="assets/certifications/codechum-cpp2.pdf" target="_blank" class="cert-view-btn" title="View Certificate"><i class="fas fa-external-link-alt"></i></a>
                </div>

                <div class="cert-card reveal">
                    <div class="cert-icon-wrap"><i class="fas fa-hard-hat cert-icon"></i></div>
                    <div class="cert-body">
                        <div class="cert-issuer">DOLE / OSHC</div>
                        <h3 class="cert-title">BOSH Safety Officer 1 (SO1)</h3>
                        <div class="cert-meta">
                            <span class="cert-date"><i class="fas fa-calendar-alt"></i> October 2025</span>
                            <span class="cert-badge">Safety</span>
                        </div>
                    </div>
                    <a href="assets/certifications/bosh-so1.pdf" target="_blank" class="cert-view-btn" title="View Certificate"><i class="fas fa-external-link-alt"></i></a>
                </div>

                <div class="cert-card reveal">
                    <div class="cert-icon-wrap"><i class="fas fa-chart-line cert-icon"></i></div>
                    <div class="cert-body">
                        <div class="cert-issuer">Six Sigma Council</div>
                        <h3 class="cert-title">Six Sigma White Belt</h3>
                        <div class="cert-meta">
                            <span class="cert-date"><i class="fas fa-calendar-alt"></i> January 2026</span>
                            <span class="cert-badge">Process</span>
                        </div>
                    </div>
                    <a href="assets/certifications/sixsigmawb.pdf" target="_blank" class="cert-view-btn" title="View Certificate"><i class="fas fa-external-link-alt"></i></a>
                </div>

                <div class="cert-card reveal">
                    <div class="cert-icon-wrap"><i class="fas fa-chart-line cert-icon"></i></div>
                    <div class="cert-body">
                        <div class="cert-issuer">Six Sigma Council</div>
                        <h3 class="cert-title">Six Sigma Yellow Belt</h3>
                        <div class="cert-meta">
                            <span class="cert-date"><i class="fas fa-calendar-alt"></i> January 2026</span>
                            <span class="cert-badge">Process</span>
                        </div>
                    </div>
                    <a href="assets/certifications/sixsigmayb.pdf" target="_blank" class="cert-view-btn" title="View Certificate"><i class="fas fa-external-link-alt"></i></a>
                </div>

                <div class="cert-card reveal">
                    <div class="cert-icon-wrap"><i class="fas fa-file-excel cert-icon"></i></div>
                    <div class="cert-body">
                        <div class="cert-issuer">Microsoft</div>
                        <h3 class="cert-title">Microsoft Excel Pro Certification</h3>
                        <div class="cert-meta">
                            <span class="cert-date"><i class="fas fa-calendar-alt"></i> April 2026</span>
                            <span class="cert-badge">Productivity</span>
                        </div>
                    </div>
                    <a href="assets/certifications/excel-pro.pdf" target="_blank" class="cert-view-btn" title="View Certificate"><i class="fas fa-external-link-alt"></i></a>
                </div>

            </div>
        </div>
    </section>

    <!-- SERVICES -->
    <section id="services" class="services">
        <div class="container">
            <div class="section-header reveal">
                <span class="section-label">WHAT I OFFER</span>
                <h2 class="section-heading">My <span class="gradient-text">Services</span></h2>
            </div>
            <div class="services-grid">

                <div class="service-card reveal">
                    <div class="service-num">01</div>
                    <div class="service-icon"><i class="fas fa-code"></i></div>
                    <h3>Web Development</h3>
                    <p>Custom web applications, dashboards, REST APIs, and database design using modern frameworks including Shopify theme &amp; app development.</p>
                    <ul class="service-list">
                        <li>React / Next.js / Vite Frontend</li>
                        <li>Laravel / Node.js Backend</li>
                        <li>MySQL / PostgreSQL / SQLite</li>
                        <li>REST API Integration</li>
                        <li>Shopify Theme &amp; App Dev</li>
                        <li>Docker &amp; Cloud Deployment</li>
                    </ul>
                </div>

                <div class="service-card featured reveal">
                    <div class="service-num">02</div>
                    <div class="service-icon"><i class="fas fa-mobile-alt"></i></div>
                    <h3>Mobile App Development</h3>
                    <p>Cross-platform mobile applications for Android and iOS using Flutter and Dart — from UI design to deployment on Google Play and the App Store.</p>
                    <ul class="service-list">
                        <li>Flutter (Android &amp; iOS)</li>
                        <li>Dart Programming</li>
                        <li>REST API Integration</li>
                        <li>Codemagic CI/CD</li>
                        <li>App Store / Play Store</li>
                    </ul>
                </div>

                <div class="service-card reveal">
                    <div class="service-num">03</div>
                    <div class="service-icon"><i class="fas fa-chart-bar"></i></div>
                    <h3>Data Analytics</h3>
                    <p>Data cleaning, reporting, and visualization using Excel, SQL, and Python to surface actionable insights for businesses and institutions.</p>
                    <ul class="service-list">
                        <li>Excel &amp; Pivot Tables</li>
                        <li>SQL / MySQL / PostgreSQL</li>
                        <li>Python Data Processing</li>
                        <li>Dashboards &amp; Reporting</li>
                    </ul>
                </div>

                <div class="service-card reveal">
                    <div class="service-num">04</div>
                    <div class="service-icon"><i class="fas fa-microchip"></i></div>
                    <h3>Hardware &amp; IoT</h3>
                    <p>End-to-end IoT solutions from firmware to cloud — ESP32 / Arduino systems, sensor integration, and real-time data dashboards.</p>
                    <ul class="service-list">
                        <li>ESP32 / Arduino Systems</li>
                        <li>Sensor Integration</li>
                        <li>Embedded C/C++ Firmware</li>
                        <li>Real-time Cloud Dashboard</li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    <!-- CONTACT -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="section-header reveal">
                <span class="section-label">REACH ME</span>
                <h2 class="section-heading">Let's <span class="gradient-text">Work Together</span></h2>
                <p class="section-sub">Fill out the form and I'll get back to you as soon as possible.</p>
            </div>
            <div class="contact-wrap">
                <div class="contact-info reveal-l">
                    <h3>Contact Information</h3>
                    <div class="contact-item">
                        <div class="ci-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <h4>Location</h4>
                            <p>San Agustin, Santa Ana, Pampanga<br>Central Luzon, Philippines</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="ci-icon"><i class="fas fa-envelope"></i></div>
                        <div>
                            <h4>Email</h4>
                            <p>digmanchristian0@gmail.com</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="ci-icon"><i class="fas fa-phone"></i></div>
                        <div>
                            <h4>Phone</h4>
                            <p>+63 999-392-1960</p>
                        </div>
                    </div>
                    <div class="contact-social">
                        <a href="mailto:digmanchristian0@gmail.com" class="cs-link"><i class="fas fa-envelope"></i></a>
                        <a href="https://github.com/devdcii" target="_blank" class="cs-link"><i class="fab fa-github"></i></a>
                        <a href="https://linkedin.com/in/christiandigman" target="_blank" class="cs-link"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="contact-form-wrap reveal-r">
                    <form id="contactForm">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Full Name <span>*</span></label>
                                <input type="text" name="full_name" placeholder="Juan dela Cruz" required>
                            </div>
                            <div class="form-group">
                                <label>Email Address <span>*</span></label>
                                <input type="email" name="email" placeholder="juan@email.com" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="tel" name="phone" placeholder="+63 9XX XXX XXXX">
                        </div>
                        <div class="form-group">
                            <label>Subject <span>*</span></label>
                            <input type="text" name="subject" placeholder="Project inquiry / Collaboration / Other" required>
                        </div>
                        <div class="form-group">
                            <label>Message <span>*</span></label>
                            <textarea name="message" rows="5" placeholder="Describe your project or inquiry..." required></textarea>
                        </div>
                        <button type="submit" class="btn-primary submit-btn" id="submitBtn">
                            <i class="fas fa-paper-plane"></i> Send Message
                        </button>
                        <div id="formMsg" class="form-message"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="#home" class="logo">
                        <img src="images/devdcii.png" alt="DevDcii Logo" class="logo-img">
                        <span class="logo-text">Dev<span class="acc">Dcii</span></span>
                    </a>
                    <p>Full-Stack Developer &amp; Computer Engineer based in Santa Ana, Pampanga, Philippines.</p>
                    <div class="footer-socials">
                        <a href="mailto:digmanchristian0@gmail.com"><i class="fas fa-envelope"></i></a>
                        <a href="https://github.com/devdcii" target="_blank"><i class="fab fa-github"></i></a>
                        <a href="https://linkedin.com/in/christiandigman" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="footer-links">
                    <h4>Navigation</h4>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#techstack">Tech Stack</a></li>
                        <li><a href="#projects">Projects</a></li>
                        <li><a href="#certifications">Certifications</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>Services</h4>
                    <ul>
                        <li><a href="#services">Web Development</a></li>
                        <li><a href="#services">Mobile App Dev</a></li>
                        <li><a href="#services">Data Analytics</a></li>
                        <li><a href="#services">Hardware/IoT</a></li>
                    </ul>
                </div>
                <div class="footer-contact">
                    <h4>Get In Touch</h4>
                    <p><i class="fas fa-map-marker-alt"></i> Santa Ana, Pampanga, PH</p>
                    <p><i class="fas fa-envelope"></i> digmanchristian0@gmail.com</p>
                    <p><i class="fas fa-phone"></i> +63 999-392-1960</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 Christian Digman. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- CHAT WIDGET -->
    <div id="chatWidget">
        <div id="chatBox">
            <div class="chat-header">
                <div class="chat-header-info">
                    <div class="chat-avatar">
                        <img src="images/team/Xii.jpg" alt="Chan" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                    </div>
                    <div>
                        <div class="chat-name">Chan Digman</div>
                        <div class="chat-status"><span class="chat-dot"></span> Online</div>
                    </div>
                </div>
                <button onclick="toggleChat()" class="chat-close-btn"><i class="fas fa-times"></i></button>
            </div>
            <div class="chat-messages" id="chatMessages">
                <div class="chat-msg bot">
                    <div class="chat-bubble">Hi! I'm Chan 👋 I can answer questions about Chan's skills, projects, and experience. Let me know how I can help!</div>
                </div>
            </div>
            <div class="chat-input-wrap">
                <input type="text" id="chatInput" placeholder="Ask me anything..." onkeydown="if(event.key==='Enter') sendChat()">
                <button onclick="sendChat()" id="chatSendBtn"><i class="fas fa-paper-plane"></i></button>
            </div>
        </div>
        <button class="chat-toggle-btn" onclick="toggleChat()" id="chatToggleBtn">
            <i class="fas fa-comment-dots"></i>
            <span>Chat with Chan</span>
        </button>
    </div>

    <!-- PROJECT MODAL -->
    <div id="projectModal" class="modal" onclick="closeProjectModal(event)">
        <div class="modal-box">
            <button class="modal-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
            <div id="modalContent" style="display:flex;flex:1;overflow:hidden;min-height:0;"></div>
        </div>
    </div>

    <script src="js/main.js"></script>
</body>

</html>