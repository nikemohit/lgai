<?php
// ============================================
// LEAN GENIE ADVISORS - COMPLETE PHP FILE
// ============================================

// Start session for form handling
session_start();

// CSRF Token Generation
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Form Processing
$form_message = '';
$form_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $form_message = 'Security token validation failed.';
    } else {
        $form_type = isset($_POST['form_type']) ? sanitize_input($_POST['form_type']) : '';
        
        if ($form_type === 'career') {
            $name = sanitize_input($_POST['name'] ?? '');
            $phone = sanitize_input($_POST['phone'] ?? '');
            $email = sanitize_input($_POST['email'] ?? '');
            $cover = sanitize_input($_POST['cover'] ?? '');
            
            if ($name && $phone && $email && isset($_FILES['resume'])) {
                // Process career application
                $form_message = 'Thank you for applying! We will review your application and contact you within 5-7 business days.';
                // In production, save to database and send email
            }
        } elseif ($form_type === 'schedule') {
            $name = sanitize_input($_POST['name'] ?? '');
            $email = sanitize_input($_POST['email'] ?? '');
            $company = sanitize_input($_POST['company'] ?? '');
            $date = sanitize_input($_POST['date'] ?? '');
            $topic = sanitize_input($_POST['topic'] ?? '');
            
            if ($name && $email && $company && $date && $topic) {
                // Process schedule request
                $form_message = 'Thank you! Your consultation request has been received. We will confirm your appointment within 24 hours.';
                // In production, save to database and send email
            }
        } elseif ($form_type === 'contact') {
            $name = sanitize_input($_POST['name'] ?? '');
            $email = sanitize_input($_POST['email'] ?? '');
            $company = sanitize_input($_POST['company'] ?? '');
            $message = sanitize_input($_POST['message'] ?? '');
            
            if ($name && $email && $message) {
                // Process contact form
                $form_message = 'Thank you for reaching out! We will get back to you within 24 hours.';
                // In production, save to database and send email
            }
        }
    }
}

// Sanitize input function
function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

// Get current page/section
$current_section = isset($_GET['section']) ? sanitize_input($_GET['section']) : 'home';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lean Genie Advisors - Operational Excellence for SMBs</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- HEADER / NAVIGATION -->
    <header class="header">
        <div class="container header-content">
            <div class="logo" onclick="scrollToTop()">
                <span class="logo-icon">LG</span>
                <span class="logo-text">Lean Genie Advisors Inc.</span>
            </div>
            <nav class="nav-links">
                <a href="#services" class="nav-link">Services</a>
                <a href="#industries" class="nav-link">Industries</a>
                <a href="#about" class="nav-link">About</a>
                <a href="#case-studies" class="nav-link">Case Studies</a>
                <a href="#insights" class="nav-link">Insights</a>
                <a href="#global-impact" class="nav-link">Global Impact</a>
                <a href="#resources" class="nav-link">Resources</a>
                <a href="#careers" class="nav-link">Careers</a>
                <a href="#schedule" class="nav-link">Schedule Call</a>
                <a href="#contact" class="nav-link">Get in Touch</a>
            </nav>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section id="hero" class="hero">
        <div class="hero-content">
            <div class="location-badge">
                <span class="location-icon">📍</span>
                Lower Mainland, British Columbia
            </div>
            <h1 class="hero-title">
                Strategic Vision Meets
                <span class="gradient-text">Operational Excellence</span>
            </h1>
            <p class="hero-description">
                Lean Genie Advisors helps Vancouver-based SMBs streamline operations, reduce inefficiencies, and build scalable systems using Lean Six Sigma and modern business innovation.
            </p>
            <div class="hero-ctas">
                <button class="btn btn-primary" onclick="scrollToSection('#schedule')">Schedule a Consultation</button>
                <button class="btn btn-outline" onclick="scrollToSection('#services')">Explore Services</button>
            </div>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">40%</div>
                    <div class="stat-label">Faster Processing</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">25%</div>
                    <div class="stat-label">Cost Reduction</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">50%</div>
                    <div class="stat-label">Faster Onboarding</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">30%</div>
                    <div class="stat-label">Higher Utilization</div>
                </div>
            </div>
        </div>
    </section>

    <!-- SERVICES SECTION -->
    <section id="services" class="services">
        <div class="container">
            <div class="section-header">
                <h2>Our Services</h2>
                <p class="section-subtitle">What We Deliver</p>
                <p class="section-description">Structured, implementation-focused advisory designed to remove friction, improve flow, and support sustainable growth.</p>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">⚙️</div>
                    <h3>Lean Process Optimization</h3>
                    <p>Data-driven improvements that eliminate waste, reduce delays, and streamline workflows across your operations.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">📊</div>
                    <h3>Operational Excellence Systems</h3>
                    <p>SOPs, process maps, KPIs, and governance frameworks that bring clarity, consistency, and accountability.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">🚀</div>
                    <h3>Business Innovation & Strategy</h3>
                    <p>Strategic redesigns that strengthen competitiveness, improve customer experience, and unlock new opportunities.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">📈</div>
                    <h3>Analytics & Decision Support</h3>
                    <p>Dashboards and reporting systems that turn your data into clear, confident decisions.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- OUR IMPACT SECTION -->
    <section class="our-impact">
        <div class="container">
            <div class="section-header">
                <h2>Our Impact</h2>
                <p class="section-subtitle">Driving Growth Across Every Engagement</p>
                <p class="section-description">Our diverse team of experts partners with your organization to deliver measurable, lasting results — backed by data and driven by collaboration.</p>
            </div>
        </div>
    </section>

    <!-- INDUSTRIES SECTION -->
    <section id="industries" class="industries">
        <div class="container">
            <div class="section-header">
                <h2>Our Reach</h2>
                <p class="section-subtitle">Industries We Serve</p>
                <p class="section-description">Lean Genie has delivered measurable results across a wide range of industries — each with unique challenges, all solved through the same disciplined approach.</p>
            </div>
            <div class="industries-tabs">
                <div class="tabs-buttons">
                    <button class="tab-btn active" data-tab="retail">Retail Distribution</button>
                    <button class="tab-btn" data-tab="professional">Professional Services</button>
                    <button class="tab-btn" data-tab="manufacturing">Manufacturing</button>
                    <button class="tab-btn" data-tab="hospitality">Hospitality</button>
                    <button class="tab-btn" data-tab="ecommerce">E-Commerce</button>
                    <button class="tab-btn" data-tab="trades">Trades & Contracting</button>
                    <button class="tab-btn" data-tab="food">Food Production</button>
                    <button class="tab-btn" data-tab="logistics">Logistics & Delivery</button>
                    <button class="tab-btn" data-tab="health">Health & Wellness</button>
                    <button class="tab-btn" data-tab="fabrication">Custom Fabrication</button>
                </div>
                <div class="tabs-content">
                    <?php
                    $industries = [
                        'retail' => [
                            'title' => 'Retail Distribution',
                            'description' => 'Regional distributors and consumer goods companies rely on Lean Genie to streamline fulfillment, reduce motion waste, and scale throughput without adding headcount.',
                            'metric' => '38% throughput increase',
                            'case' => 'A 45-person Lower Mainland distributor eliminated picking inefficiencies and reduced labour hours per order by 22% — enabling seasonal scale without new hires.'
                        ],
                        'professional' => [
                            'title' => 'Professional Services',
                            'description' => 'Consulting firms and advisory businesses gain faster project delivery and higher billable utilization through standardized workflows and SOPs.',
                            'metric' => '42% cycle time reduction',
                            'case' => 'A 12-person Vancouver firm cut project turnaround nearly in half and boosted billable utilization by 30%.'
                        ],
                        'manufacturing' => [
                            'title' => 'Manufacturing',
                            'description' => 'Light manufacturers reduce defects, cut downtime, and boost output through standardized work, visual controls, and Gemba-driven continuous improvement.',
                            'metric' => '27% production increase',
                            'case' => 'A 60-person Fraser Valley manufacturer reduced defects by 35% and machine downtime by 20% using SMED and visual management.'
                        ],
                        'hospitality' => [
                            'title' => 'Hospitality',
                            'description' => 'Restaurant groups and hospitality operators improve service flow, cut ticket times, and increase per-shift revenue without expanding space.',
                            'metric' => '33% more service capacity',
                            'case' => 'A Metro Vancouver restaurant group with 3 locations reduced ticket times by 25% and grew average revenue per shift by 18%.'
                        ],
                        'ecommerce' => [
                            'title' => 'E-Commerce',
                            'description' => 'Online retailers scale order processing, reduce errors, and handle peak demand smoothly through lean fulfillment workflows.',
                            'metric' => '50% faster order processing',
                            'case' => 'A Burnaby apparel brand cut packing errors by 30% and grew daily order capacity by 20% — scaling confidently through peak seasons.'
                        ],
                        'trades' => [
                            'title' => 'Trades & Contracting',
                            'description' => 'Electrical, plumbing, and general contractors increase billable hours and job throughput through lean scheduling, scoping, and field reporting.',
                            'metric' => '29% job throughput increase',
                            'case' => 'A Surrey electrical contractor with 25 technicians cut rework and callbacks by 22% and added 15% more billable hours per week.'
                        ],
                        'food' => [
                            'title' => 'Food Production',
                            'description' => 'Prepared food producers reduce waste, standardize portioning, and increase daily output through workstation redesign and visual controls.',
                            'metric' => '31% waste reduction',
                            'case' => 'A Richmond prepared foods company with 35 staff cut raw material waste by nearly a third and grew production capacity by 28%.'
                        ],
                        'logistics' => [
                            'title' => 'Logistics & Delivery',
                            'description' => 'Local delivery companies increase daily capacity, reduce overtime, and improve customer satisfaction through standardized routing and dispatch workflows.',
                            'metric' => '33% more deliveries/day',
                            'case' => 'An 18-driver Vancouver logistics firm reduced delivery time per route by 26% and overtime by 19% — handling more orders with the same fleet.'
                        ],
                        'health' => [
                            'title' => 'Health & Wellness',
                            'description' => 'Physiotherapy and rehab clinics reduce wait times, balance therapist workloads, and grow appointment capacity without adding staff.',
                            'metric' => '40% wait time reduction',
                            'case' => 'A 2-clinic Burnaby physio group with 22 staff cut wait times by 40%, boosted therapist utilization by 24%, and grew daily appointments by 18%.'
                        ],
                        'fabrication' => [
                            'title' => 'Custom Fabrication',
                            'description' => 'Metal and custom fabrication shops eliminate rework, improve design-to-production handoffs, and increase weekly job throughput.',
                            'metric' => '37% less rework & scrap',
                            'case' => 'A 28-person Surrey metal fab shop cut rework by 37% and increased weekly job throughput by 29% through standardized specs and WIP controls.'
                        ]
                    ];
                    
                    foreach ($industries as $key => $industry):
                    ?>
                    <div class="tab-pane <?php echo $key === 'retail' ? 'active' : ''; ?>" data-tab="<?php echo $key; ?>">
                        <h3><?php echo $industry['title']; ?></h3>
                        <p><?php echo $industry['description']; ?></p>
                        <div class="case-highlight">
                            <span class="highlight-badge">Case Study Highlight</span>
                            <div class="highlight-metric"><?php echo $industry['metric']; ?></div>
                            <p><?php echo $industry['case']; ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT SECTION -->
    <section id="about" class="about">
        <div class="container">
            <div class="section-header">
                <h2>About Us</h2>
                <p class="section-subtitle">A Partner in Performance</p>
            </div>
            <div class="about-content">
                <p>Lean Genie Advisors is a Vancouver-based consulting practice focused on helping small and mid-sized businesses operate with enterprise-level discipline.</p>
                <p>Our approach blends Lean Six Sigma rigor with modern innovation frameworks to deliver measurable, sustainable improvements. We focus on practical implementation, not just recommendations on paper.</p>
                <p>Whether you are refining existing operations or building new capabilities, we work alongside your team to design, test, and embed better ways of working.</p>
            </div>

            <div class="about-grid">
                <div class="about-box mission-box">
                    <h3>Our Mission</h3>
                    <p>We exist to help small and mid-sized businesses operate with the discipline and efficiency of enterprise-level organizations — without the overhead.</p>
                </div>
                <div class="about-box">
                    <h3>Core Values</h3>
                    <ul class="values-list">
                        <li><strong>Practical First</strong> - We deliver implementations, not just reports. Every recommendation comes with a clear path to execution.</li>
                        <li><strong>Results Driven</strong> - We measure success by your numbers: throughput, margins, cycle times. Not by activity or deliverables.</li>
                        <li><strong>People Centered</strong> - Sustainable improvement requires your team's buy-in. We design with your people, not around them.</li>
                    </ul>
                </div>
            </div>

            <div class="stats-grid about-stats">
                <div class="stat-card">
                    <div class="stat-number">20+</div>
                    <div class="stat-label">Transformations Delivered</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">$2M+</div>
                    <div class="stat-label">Value Created</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">15+</div>
                    <div class="stat-label">Years of Excellence</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">99%</div>
                    <div class="stat-label">Client Satisfaction</div>
                </div>
            </div>

            <div class="about-story">
                <h3>Our Story</h3>
                <p>Lean Genie Advisors was founded in Vancouver, BC, by operations leaders who saw a gap: SMBs were left behind by consulting firms that favored large enterprise clients. We built a practice specifically for growing businesses that need real-world operational expertise without the big-firm price tag.</p>
                <div class="story-tags">
                    <span class="tag">Lean Six Sigma</span>
                    <span class="tag">Process Design</span>
                    <span class="tag">Remove Non-Value Added Activities</span>
                    <span class="tag">Improve Profits</span>
                    <span class="tag">Vancouver</span>
                </div>
                <button class="btn btn-primary" onclick="scrollToSection('#schedule')">Book a Free Consultation</button>
            </div>
        </div>
    </section>

    <!-- CASE STUDIES SECTION -->
    <section id="case-studies" class="case-studies">
        <div class="container">
            <div class="section-header">
                <h2>Case Studies</h2>
                <p class="section-subtitle">Impact in Action</p>
                <p class="section-description">Examples of how structured, lean-focused improvements translate into measurable business results.</p>
            </div>
            <div class="case-studies-accordion">
                <?php
                $case_studies = [
                    [
                        'number' => '01',
                        'title' => 'Retail Distribution - Increasing Throughput by 38%',
                        'location' => 'Lower Mainland, BC • 45 employees',
                        'challenge' => 'A regional distributor struggled with slow order fulfillment, inconsistent picking processes, and rising labour costs. Throughput was capped by manual workflows and unclear task ownership.',
                        'approach' => [
                            'Mapped the end to end fulfillment workflow',
                            'Introduced standardized picking routes and batch processing',
                            'Reduced motion waste and reorganized warehouse layout',
                            'Implemented a simple KPI dashboard (OTIF, pick rate, cycle time)'
                        ],
                        'results' => [
                            '38% increase in daily throughput',
                            '22% reduction in labour hours per order',
                            '15% increase in gross margin due to improved productivity',
                            'Fulfillment errors dropped by 40%'
                        ],
                        'impact' => 'The business gained the capacity to handle seasonal spikes without hiring additional staff, directly improving profitability.'
                    ],
                    [
                        'number' => '02',
                        'title' => 'Professional Services - Cutting Project Cycle Time by 42%',
                        'location' => 'Vancouver, BC • 12 employees',
                        'challenge' => 'The firm faced long project turnaround times and inconsistent client onboarding. Bottlenecks in handoffs and unclear SOPs created delays and rework.',
                        'approach' => [
                            'Conducted a full process mapping workshop',
                            'Standardized onboarding and delivery workflows',
                            'Introduced SOPs for recurring tasks',
                            'Built a KPI dashboard for utilization, cycle time, and workload balance'
                        ],
                        'results' => [
                            '42% reduction in project cycle time',
                            '30% increase in billable utilization',
                            'Higher client satisfaction and repeat business',
                            'Team workload became more predictable and balanced'
                        ],
                        'impact' => 'The firm increased revenue capacity without expanding headcount, improving profitability and client retention.'
                    ],
                    [
                        'number' => '03',
                        'title' => 'Manufacturing - Boosting Production Throughput by 27%',
                        'location' => 'Fraser Valley, BC • 60 employees',
                        'challenge' => 'Production delays, machine downtime, and inconsistent quality checks were limiting output. The team relied on tribal knowledge rather than standardized processes.',
                        'approach' => [
                            'Performed a root cause analysis on downtime and defects',
                            'Introduced standardized work instructions and visual controls',
                            'Implemented a daily Gemba walk and tiered communication',
                            'Optimized changeover processes using SMED principles'
                        ],
                        'results' => [
                            '27% increase in production throughput',
                            '35% reduction in defects',
                            '20% reduction in machine downtime',
                            'Improved operator confidence and consistency'
                        ],
                        'impact' => 'Higher throughput allowed the company to take on new contracts, increasing annual revenue without major capital investment.'
                    ]
                ];

                foreach ($case_studies as $case):
                ?>
                <div class="accordion-item">
                    <button class="accordion-header" onclick="toggleAccordion(this)">
                        <span class="case-number"><?php echo $case['number']; ?></span>
                        <span class="case-title"><?php echo $case['title']; ?></span>
                        <span class="case-location"><?php echo $case['location']; ?></span>
                    </button>
                    <div class="accordion-content">
                        <div class="case-detail">
                            <h4>Challenge</h4>
                            <p><?php echo $case['challenge']; ?></p>
                        </div>
                        <div class="case-detail">
                            <h4>What We Did</h4>
                            <ul>
                                <?php foreach ($case['approach'] as $item): ?>
                                <li><?php echo $item; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="case-detail">
                            <h4>Results</h4>
                            <ul>
                                <?php foreach ($case['results'] as $item): ?>
                                <li><?php echo $item; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="case-detail">
                            <h4>Impact</h4>
                            <p><?php echo $case['impact']; ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- INSIGHTS SECTION -->
    <section id="insights" class="insights">
        <div class="container">
            <div class="section-header">
                <h2>Insights</h2>
                <p class="section-subtitle">Insights for Leaders</p>
                <p class="section-description">What global business leaders say about the power of Lean Six Sigma.</p>
            </div>
            <div class="quote-carousel">
                <div class="quotes-container">
                    <?php
                    $quotes = [
                        [
                            'text' => '"Process discipline is what separates companies that survive a crisis from those that don\'t. Six Sigma gave us the language and the framework to fix what was broken."',
                            'author' => 'Anne Mulcahy',
                            'title' => 'Former CEO, Xerox',
                            'category' => 'Technology & Services'
                        ],
                        [
                            'text' => '"Quality is the foundation of everything we build. Six Sigma is how we keep that promise to customers — every time, in every market."',
                            'author' => 'Jeff Immelt',
                            'title' => 'Former CEO, General Electric',
                            'category' => 'Leadership'
                        ],
                        [
                            'text' => '"Lean Six Sigma isn\'t just a quality program — it\'s a cultural transformation. When you embed it into how people think, the results compound over time."',
                            'author' => 'Bob Nardelli',
                            'title' => 'Former CEO, Home Depot & Chrysler',
                            'category' => 'Retail & Automotive'
                        ],
                        [
                            'text' => '"Six Sigma is the most important initiative GE has ever undertaken. It is part of the genetic code of our future leadership."',
                            'author' => 'Jack Welch',
                            'title' => 'Former CEO, General Electric',
                            'category' => 'Manufacturing & Conglomerates'
                        ],
                        [
                            'text' => '"Six Sigma was the key driver that helped Motorola achieve unprecedented quality levels and save billions of dollars. It changed how we think about business."',
                            'author' => 'Bob Galvin',
                            'title' => 'Former CEO, Motorola',
                            'category' => 'Technology'
                        ],
                        [
                            'text' => '"Lean Six Sigma gives you the tools and discipline to actually execute your strategy — not just talk about it. The results are measurable and real."',
                            'author' => 'Larry Bossidy',
                            'title' => 'Former CEO, AlliedSignal (Honeywell)',
                            'category' => 'Aerospace & Manufacturing'
                        ]
                    ];

                    foreach ($quotes as $index => $quote):
                    ?>
                    <div class="quote-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <p class="quote-text"><?php echo $quote['text']; ?></p>
                        <p class="quote-author"><?php echo $quote['author']; ?></p>
                        <p class="quote-title"><?php echo $quote['title']; ?></p>
                        <p class="quote-category"><?php echo $quote['category']; ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="carousel-controls">
                    <button class="carousel-btn prev" onclick="previousQuote()">←</button>
                    <button class="carousel-btn next" onclick="nextQuote()">→</button>
                </div>
                <div class="carousel-dots" id="quoteDots"></div>
            </div>
        </div>
    </section>

    <!-- GLOBAL IMPACT SECTION -->
    <section id="global-impact" class="global-impact">
        <div class="container">
            <div class="section-header">
                <h2>Global Impact</h2>
                <p class="section-subtitle">Companies Transformed by Lean Six Sigma</p>
            </div>
            <div class="filter-buttons">
                <button class="filter-btn active" onclick="filterImpact('all')">All</button>
                <button class="filter-btn" onclick="filterImpact('canada')">🇨🇦 Canada</button>
                <button class="filter-btn" onclick="filterImpact('usa')">🇺🇸 USA</button>
            </div>
            <div class="impact-grid">
                <?php
                $companies = [
                    ['flag' => '🇺🇸', 'metric' => '$12B+ Saved', 'name' => 'General Electric', 'category' => 'Manufacturing & Energy', 'desc' => 'Saved over $12 billion in 5 years by embedding Six Sigma across all business units under CEO Jack Welch.', 'region' => 'usa'],
                    ['flag' => '🇺🇸', 'metric' => '$16B Saved', 'name' => 'Motorola', 'category' => 'Technology', 'desc' => 'Originated Six Sigma in the 1980s, reducing defects by 99.9966% and saving $16 billion over 11 years.', 'region' => 'usa'],
                    ['flag' => '🇺🇸', 'metric' => '$800M+ Saved', 'name' => 'Honeywell', 'category' => 'Aerospace & Manufacturing', 'desc' => 'Generated over $800 million in savings and improved operational efficiency across all divisions.', 'region' => 'usa'],
                    ['flag' => '🇺🇸', 'metric' => 'Cycle Time ↓ 50%', 'name' => '3M', 'category' => 'Consumer & Industrial', 'desc' => 'Adopted Lean Six Sigma to cut product development cycle times and reduce waste, saving hundreds of millions annually.', 'region' => 'usa'],
                    ['flag' => '🇺🇸', 'metric' => '$1B Warranty Savings', 'name' => 'Ford Motor Company', 'category' => 'Automotive', 'desc' => 'Used Lean Six Sigma to reduce warranty costs by $1 billion and improve production quality across all plants.', 'region' => 'usa'],
                    ['flag' => '🇺🇸', 'metric' => 'Fulfillment Speed ↑', 'name' => 'Amazon', 'category' => 'E-Commerce & Logistics', 'desc' => 'Applies Lean Six Sigma principles to fulfillment operations, cutting order processing time and reducing errors at scale.', 'region' => 'usa'],
                    ['flag' => '🇨🇦', 'metric' => 'Production Efficiency ↑', 'name' => 'Bombardier', 'category' => 'Aerospace & Rail', 'desc' => 'Applied Lean Six Sigma to aerospace manufacturing and rail assembly, improving production efficiency and delivery timelines.', 'region' => 'canada'],
                    ['flag' => '🇨🇦', 'metric' => 'Processing Time ↓', 'name' => 'RBC (Royal Bank of Canada)', 'category' => 'Financial Services', 'desc' => 'Used Lean Six Sigma in back-office operations to reduce processing times and improve service quality for millions of customers.', 'region' => 'canada'],
                    ['flag' => '🇨🇦', 'metric' => 'Cycle Time ↓ 30%', 'name' => 'Scotiabank', 'category' => 'Financial Services', 'desc' => 'Deployed Lean Six Sigma in loan processing and customer service workflows, reducing cycle times and operational costs.', 'region' => 'canada'],
                    ['flag' => '🇨🇦', 'metric' => 'Downtime ↓', 'name' => 'Suncor Energy', 'category' => 'Oil & Gas', 'desc' => 'Applied continuous improvement and Lean Six Sigma principles to refinery operations, improving safety and reducing operational downtime.', 'region' => 'canada'],
                    ['flag' => '🇨🇦', 'metric' => 'Defects ↓ 40%', 'name' => 'Magna International', 'category' => 'Automotive Parts', 'desc' => 'Leveraged Lean Six Sigma across global manufacturing operations, significantly reducing defects and improving supplier quality.', 'region' => 'canada'],
                    ['flag' => '🇺🇸', 'metric' => '$2.4B Saved', 'name' => 'Caterpillar Inc.', 'category' => 'Heavy Equipment', 'desc' => 'Saved over $2.4 billion since 2001 through Lean Six Sigma deployment across manufacturing and supply chain.', 'region' => 'usa']
                ];

                foreach ($companies as $company):
                ?>
                <div class="impact-card" data-region="<?php echo $company['region']; ?>">
                    <div class="impact-flag"><?php echo $company['flag']; ?></div>
                    <div class="impact-metric"><?php echo $company['metric']; ?></div>
                    <h3><?php echo $company['name']; ?></h3>
                    <p class="impact-category"><?php echo $company['category']; ?></p>
                    <p class="impact-description"><?php echo $company['desc']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- RESOURCES SECTION -->
    <section id="resources" class="resources">
        <div class="container">
            <div class="section-header">
                <h2>Resources</h2>
                <p class="section-subtitle">Explore our Resources</p>
                <p class="section-description">Our collection of services spans various needs at every stage of the transformation process. Explore how we help businesses transform across Metro Vancouver and beyond.</p>
                <p class="section-tagline">Transforming operations across Metro Vancouver and beyond</p>
            </div>
            <div class="resources-grid">
                <div class="resource-card">
                    <div class="resource-number">01</div>
                    <h3>Operational Excellence</h3>
                    <p>Transform your operations with lean principles, process optimization, and continuous improvement methodologies that deliver measurable results.</p>
                    <div class="resource-tags">
                        <span class="tag">Process Redesign</span>
                        <span class="tag">Waste Elimination</span>
                        <span class="tag">Quality Management</span>
                    </div>
                    <a href="#" class="link-more">Learn More →</a>
                </div>
                <div class="resource-card">
                    <div class="resource-number">02</div>
                    <h3>Supply Chain Optimization</h3>
                    <p>Build resilient, efficient supply chains that reduce costs, improve delivery performance, and adapt to market dynamics.</p>
                    <div class="resource-tags">
                        <span class="tag">Inventory Management</span>
                        <span class="tag">Logistics Optimization</span>
                        <span class="tag">Supplier Development</span>
                    </div>
                    <a href="#" class="link-more">Learn More →</a>
                </div>
                <div class="resource-card">
                    <div class="resource-number">03</div>
                    <h3>Digital Transformation</h3>
                    <p>Leverage AI, automation, and data analytics to modernize your business and create sustainable competitive advantages.</p>
                    <div class="resource-tags">
                        <span class="tag">AI Integration</span>
                        <span class="tag">Process Automation</span>
                        <span class="tag">Data Analytics</span>
                    </div>
                    <a href="#" class="link-more">Learn More →</a>
                </div>
                <div class="resource-card">
                    <div class="resource-number">04</div>
                    <h3>Growth Strategy</h3>
                    <p>Develop and execute growth strategies that align your organization, optimize resources, and accelerate market expansion.</p>
                    <div class="resource-tags">
                        <span class="tag">Market Analysis</span>
                        <span class="tag">Strategic Planning</span>
                        <span class="tag">Performance Metrics</span>
                    </div>
                    <a href="#" class="link-more">Learn More →</a>
                </div>
            </div>

            <div class="free-downloads">
                <div class="section-header">
                    <h3>Free Downloads</h3>
                    <p class="section-subtitle">Practical Guides for SMB Leaders</p>
                    <p class="section-description">Download our free guides to start identifying inefficiencies and unlocking profit in your business — no jargon, just actionable insights.</p>
                </div>
                <div class="downloads-grid">
                    <div class="download-card">
                        <h4>The 7 Most Common Process Bottlenecks in Growing SMBs</h4>
                        <p>Identify and eliminate the hidden constraints slowing your growth. This guide walks through the 7 most common bottlenecks we see across SMBs — with practical Lean fixes for each.</p>
                        <div class="resource-tags">
                            <span class="tag">Process Improvement</span>
                            <span class="tag">Operations</span>
                            <span class="tag">SMB Growth</span>
                        </div>
                        <a href="#" class="btn btn-primary">Download Free Guide</a>
                    </div>
                    <div class="download-card">
                        <h4>Most Common Wastes in SMBs</h4>
                        <p>A Lean-based guide to identifying non-value-added activities that are quietly costing your business time and money. Based on the proven Toyota Production System TIMWOODS framework.</p>
                        <div class="resource-tags">
                            <span class="tag">Lean Six Sigma</span>
                            <span class="tag">Waste Elimination</span>
                            <span class="tag">Efficiency</span>
                        </div>
                        <a href="#" class="btn btn-primary">Download Free Guide</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CAREERS SECTION -->
    <section id="careers" class="careers">
        <div class="container">
            <div class="section-header">
                <h2>Careers</h2>
                <p class="section-subtitle">Join Our Team</p>
                <p class="section-description">We're always looking for sharp, driven people who want to make a measurable difference in how businesses operate. Join a team that values expertise, curiosity, and real-world impact.</p>
            </div>
            <div class="benefits-grid">
                <div class="benefit-card">
                    <h3>Make a Measurable Impact</h3>
                    <p>Contribute to real business transformations that deliver quantifiable results.</p>
                </div>
                <div class="benefit-card">
                    <h3>Work with Diverse Clients</h3>
                    <p>SMBs across multiple industries in British Columbia and beyond.</p>
                </div>
                <div class="benefit-card">
                    <h3>Grow with Us</h3>
                    <p>Continuous learning, mentorship, and career development opportunities.</p>
                </div>
                <div class="benefit-card">
                    <h3>Flexible & Collaborative</h3>
                    <p>A culture that values your expertise and supports work-life balance.</p>
                </div>
            </div>

            <div class="career-form-section">
                <h3>Apply Now</h3>
                <p class="form-note">Personal Review Guarantee: We review all applications personally. Expect to hear from us within 5–7 business days.</p>
                <form method="POST" enctype="multipart/form-data" class="career-form">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="form_type" value="career">
                    
                    <div class="form-group">
                        <label for="career-name">Full Name *</label>
                        <input type="text" id="career-name" name="name" placeholder="Jane Doe" required>
                    </div>
                    <div class="form-group">
                        <label for="career-phone">Phone Number *</label>
                        <input type="tel" id="career-phone" name="phone" placeholder="+1 (604) 555-0100" required>
                    </div>
                    <div class="form-group">
                        <label for="career-email">Email Address *</label>
                        <input type="email" id="career-email" name="email" placeholder="jane@example.com" required>
                    </div>
                    <div class="form-group">
                        <label for="career-resume">Resume * (Click to upload your resume .pdf or .docx)</label>
                        <input type="file" id="career-resume" name="resume" accept=".pdf,.docx" required>
                    </div>
                    <div class="form-group">
                        <label for="career-cover">Cover Note (optional)</label>
                        <textarea id="career-cover" name="cover" placeholder="Tell us a little about yourself and why you'd like to work with Lean Genie..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Apply Now</button>
                </form>
            </div>
        </div>
    </section>

    <!-- SCHEDULE SECTION -->
    <section id="schedule" class="schedule">
        <div class="container">
            <div class="section-header">
                <h2>Schedule a Call</h2>
                <p class="section-subtitle">Book a Free 30-Min Consultation</p>
                <p class="section-description">Pick a time that works for you and let's talk about how we can improve your operations.</p>
            </div>
            <div class="schedule-content">
                <div class="schedule-info">
                    <div class="info-box">
                        <h4>Email Us</h4>
                        <a href="mailto:info@leangenieadvisors.ca">info@leangenieadvisors.ca</a>
                    </div>
                    <div class="info-box">
                        <h4>Visit Us</h4>
                        <p>Delta, British Columbia, Canada</p>
                    </div>
                </div>
                <div class="schedule-form-section">
                    <h3>Schedule a free 30-min consultation</h3>
                    <form method="POST" class="schedule-form">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        <input type="hidden" name="form_type" value="schedule">
                        
                        <div class="form-group">
                            <label for="schedule-name">Full Name *</label>
                            <input type="text" id="schedule-name" name="name" placeholder="Jane Doe" required>
                        </div>
                        <div class="form-group">
                            <label for="schedule-email">Email Address *</label>
                            <input type="email" id="schedule-email" name="email" placeholder="you@company.com" required>
                        </div>
                        <div class="form-group">
                            <label for="schedule-company">Company *</label>
                            <input type="text" id="schedule-company" name="company" placeholder="Company Name" required>
                        </div>
                        <div class="form-group">
                            <label for="schedule-date">Preferred Date & Time *</label>
                            <input type="datetime-local" id="schedule-date" name="date" required>
                        </div>
                        <div class="form-group">
                            <label for="schedule-topic">Topic of Discussion *</label>
                            <select id="schedule-topic" name="topic" required>
                                <option value="">Select a topic</option>
                                <option value="optimization">Process Optimization</option>
                                <option value="excellence">Operational Excellence Systems</option>
                                <option value="innovation">Business Innovation & Strategy</option>
                                <option value="analytics">Analytics & Decision Support</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Schedule Now</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="section-header">
                <h2>Get In Touch</h2>
                <p class="section-subtitle">Let's Build a Better Operation</p>
                <p class="section-description">Share a bit about your business and current challenges. We'll follow up with a focused, no-obligation conversation.</p>
            </div>
            <div class="contact-content">
                <div class="contact-form-section">
                    <div class="contact-needs">
                        <h3>Contact us if you need help with:</h3>
                        <ul class="needs-list">
                            <li>Inefficient Processes</li>
                            <li>Low Profit Margins</li>
                            <li>Poor KPIs</li>
                            <li>Employee Productivity Issues</li>
                            <li>Founder Stuck in Daily Firefighting</li>
                        </ul>
                    </div>
                    <form method="POST" class="contact-form">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        <input type="hidden" name="form_type" value="contact">
                        
                        <div class="form-group">
                            <label for="contact-name">Full Name *</label>
                            <input type="text" id="contact-name" name="name" placeholder="Jane Doe" required>
                        </div>
                        <div class="form-group">
                            <label for="contact-email">Email Address *</label>
                            <input type="email" id="contact-email" name="email" placeholder="you@company.com" required>
                        </div>
                        <div class="form-group">
                            <label for="contact-company">Company (Optional)</label>
                            <input type="text" id="contact-company" name="company" placeholder="Company Name">
                        </div>
                        <div class="form-group">
                            <label for="contact-message">Message *</label>
                            <textarea id="contact-message" name="message" placeholder="Tell us about your goals or current challenges..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
                <div class="contact-info-section">
                    <div class="contact-details">
                        <h3>Contact Details</h3>
                        <div class="detail-box">
                            <h4>Location</h4>
                            <p>Delta, British Columbia, Canada</p>
                        </div>
                        <div class="detail-box">
                            <h4>Email</h4>
                            <a href="mailto:info@leangenieadvisors.ca">info@leangenieadvisors.ca</a>
                        </div>
                        <div class="detail-box">
                            <h4>Hours</h4>
                            <p>Monday – Friday<br>8:00 AM – 7:00 PM PST</p>
                        </div>
                    </div>
                    <div class="why-lean-genie">
                        <h3>Why Lean Genie?</h3>
                        <ul class="checkmarks">
                            <li>✓ No-obligation initial consultation</li>
                            <li>✓ Lean Six Sigma certified methodology</li>
                            <li>✓ Focused on practical implementation</li>
                            <li>✓ Local Vancouver business expertise</li>
                        </ul>
                    </div>
                    <div class="value-differentiator">
                        <p><strong>Our Value Differentiator</strong></p>
                        <p>Plain language, implementation focused improvement for SMBs, no jargon, measurable results in 60 days.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h4>Lean Genie Advisors Inc.</h4>
                    <p>Operational excellence for modern SMBs.</p>
                    <p>Delta, British Columbia, Canada</p>
                    <a href="mailto:info@leangenieadvisors.ca">info@leangenieadvisors.ca</a>
                    <p>Mon–Fri | 8:00 AM – 7:00 PM PST</p>
                </div>
                <div class="footer-column">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#industries">Industries</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#case-studies">Case Studies</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Resources</h4>
                    <ul>
                        <li><a href="#insights">Insights</a></li>
                        <li><a href="#global-impact">Global Impact</a></li>
                        <li><a href="#resources">Resources</a></li>
                        <li><a href="#careers">Careers</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Contact</h4>
                    <ul>
                        <li><a href="#schedule">Schedule Call</a></li>
                        <li><a href="#contact">Get in Touch</a></li>
                        <li><a href="mailto:info@leangenieadvisors.ca">Email Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2026 Lean Genie Advisors Inc. All rights reserved. · Delta, BC, Canada.</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
