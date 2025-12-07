<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Resources - Employify</title>
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/career-resources.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Hero Section -->
    <section class="resources-hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="hero-text">
                <span class="hero-tag">Career Resources</span>
                <h1 class="hero-title">Grow Your Career with <span class="title-highlight">Expert Guidance</span></h1>
                <p class="hero-subtitle">Access comprehensive guides, tips, and insights to advance your career and land your dream job.</p>
            </div>
            <div class="hero-search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="resourceSearch" placeholder="Search resources, topics, or keywords...">
                <button class="search-btn"><i class="fas fa-arrow-right"></i></button>
            </div>
        </div>
        <div class="hero-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
    </section>

    <main class="main-content">
        <div class="container">
            <!-- Category Filters -->
            <div class="category-filters">
                <button class="category-btn active" data-category="all">
                    <i class="fas fa-th"></i>
                    <span>All Resources</span>
                </button>
                <button class="category-btn" data-category="resume">
                    <i class="fas fa-file-alt"></i>
                    <span>Resume Tips</span>
                </button>
                <button class="category-btn" data-category="interview">
                    <i class="fas fa-comments"></i>
                    <span>Interview Prep</span>
                </button>
                <button class="category-btn" data-category="skills">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Skills Development</span>
                </button>
                <button class="category-btn" data-category="networking">
                    <i class="fas fa-users"></i>
                    <span>Networking</span>
                </button>
                <button class="category-btn" data-category="salary">
                    <i class="fas fa-dollar-sign"></i>
                    <span>Salary & Negotiation</span>
                </button>
                <button class="category-btn" data-category="remote">
                    <i class="fas fa-laptop"></i>
                    <span>Remote Work</span>
                </button>
            </div>

            <!-- Resources Grid -->
            <div class="resources-grid" id="resourcesGrid">
                <!-- Resource Card 1 -->
                <article class="resource-card" data-category="resume">
                    <div class="card-header">
                        <div class="card-icon resume-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <span class="card-category">Resume Tips</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">How to Craft a Winning Resume in 2025</h3>
                        <p class="card-date"><i class="far fa-calendar"></i> May 5, 2025</p>
                        <p class="card-excerpt">Learn the essential tips for creating a modern, effective resume that will stand out to recruiters in today's competitive job market.</p>
                        <ul class="card-topics">
                            <li><i class="fas fa-check-circle"></i> Format Selection</li>
                            <li><i class="fas fa-check-circle"></i> Keyword Optimization</li>
                            <li><i class="fas fa-check-circle"></i> Visual Design</li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <button class="read-more-btn" data-title="How to Craft a Winning Resume in 2025" data-date="May 5, 2025" data-content="A well-crafted resume is your ticket to landing your dream job. In this comprehensive guide, we'll cover everything you need to know to create a resume that stands out. From choosing the right format to highlighting your achievements, we'll help you build a document that showcases your skills and experience in the best possible light.\n\nKey Topics Covered:\n- Choosing the right resume format\n- Writing compelling bullet points\n- Highlighting relevant experience\n- Using keywords effectively\n- Formatting tips for visual appeal\n- Common mistakes to avoid\n- How to tailor your resume for different industries\n\nWhether you're a recent graduate or a seasoned professional, this guide will provide you with the tools you need to create a resume that gets noticed by recruiters and hiring managers.">
                            <span>Read Article</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </article>

                <!-- Resource Card 2 -->
                <article class="resource-card" data-category="interview">
                    <div class="card-header">
                        <div class="card-icon interview-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <span class="card-category">Interview Prep</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">The Ultimate Guide to Job Interview Success</h3>
                        <p class="card-date"><i class="far fa-calendar"></i> May 4, 2025</p>
                        <p class="card-excerpt">Discover proven strategies for acing your next job interview, from preparation to follow-up, with real-world examples and expert advice.</p>
                        <ul class="card-topics">
                            <li><i class="fas fa-check-circle"></i> Preparation Tips</li>
                            <li><i class="fas fa-check-circle"></i> Common Questions</li>
                            <li><i class="fas fa-check-circle"></i> Follow-up Strategies</li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <button class="read-more-btn" data-title="The Ultimate Guide to Job Interview Success" data-date="May 4, 2025" data-content="Discover proven strategies for acing your next job interview, from preparation to follow-up, with real-world examples and expert advice. Learn how to prepare effectively, answer common interview questions, and make a lasting impression on potential employers.">
                            <span>Read Article</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </article>

                <!-- Resource Card 3 -->
                <article class="resource-card" data-category="skills">
                    <div class="card-header">
                        <div class="card-icon skills-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <span class="card-category">Skills Development</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Top 10 Skills Employers Look for in 2025</h3>
                        <p class="card-date"><i class="far fa-calendar"></i> May 3, 2025</p>
                        <p class="card-excerpt">Stay ahead in your career by developing these critical skills that are in high demand across industries in the current job market.</p>
                        <ul class="card-topics">
                            <li><i class="fas fa-check-circle"></i> Technical Skills</li>
                            <li><i class="fas fa-check-circle"></i> Soft Skills</li>
                            <li><i class="fas fa-check-circle"></i> Industry Trends</li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <button class="read-more-btn" data-title="Top 10 Skills Employers Look for in 2025" data-date="May 3, 2025" data-content="In today's fast-paced job market, it's essential to stay ahead of the curve by developing the skills that employers are looking for. In this article, we'll cover the top 10 skills that are in high demand across industries, from technical expertise to soft skills. Whether you're a recent graduate or a seasoned professional, this guide will provide you with the tools you need to take your career to the next level.\n\nKey Topics Covered:\n- Technical skills in high demand\n- Soft skills that employers love\n- How to develop your skills\n- Tips for showcasing your skills\n- How to stay ahead in your career">
                            <span>Read Article</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </article>

                <!-- Resource Card 4 -->
                <article class="resource-card" data-category="networking">
                    <div class="card-header">
                        <div class="card-icon networking-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <span class="card-category">Networking</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Networking 101: Building Professional Connections</h3>
                        <p class="card-date"><i class="far fa-calendar"></i> May 2, 2025</p>
                        <p class="card-excerpt">Learn effective networking strategies to expand your professional network and open up new career opportunities.</p>
                        <ul class="card-topics">
                            <li><i class="fas fa-check-circle"></i> Industry Events</li>
                            <li><i class="fas fa-check-circle"></i> Online Platforms</li>
                            <li><i class="fas fa-check-circle"></i> Relationship Building</li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <button class="read-more-btn" data-title="Networking 101: Building Professional Connections" data-date="May 2, 2025" data-content="Learn effective networking strategies to expand your professional network and open up new career opportunities. From industry events to online platforms, discover the best ways to connect with professionals in your field.">
                            <span>Read Article</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </article>

                <!-- Resource Card 5 -->
                <article class="resource-card" data-category="salary">
                    <div class="card-header">
                        <div class="card-icon salary-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <span class="card-category">Salary & Negotiation</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Salary Negotiation Tips for New Graduates</h3>
                        <p class="card-date"><i class="far fa-calendar"></i> May 1, 2025</p>
                        <p class="card-excerpt">Get expert advice on how to approach salary negotiations as a new graduate, with practical tips and real-world examples.</p>
                        <ul class="card-topics">
                            <li><i class="fas fa-check-circle"></i> Market Research</li>
                            <li><i class="fas fa-check-circle"></i> Negotiation Tactics</li>
                            <li><i class="fas fa-check-circle"></i> Fair Agreements</li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <button class="read-more-btn" data-title="Salary Negotiation Tips for New Graduates" data-date="May 1, 2025" data-content="Get expert advice on how to approach salary negotiations as a new graduate, with practical tips and real-world examples. Learn how to research market rates, make your case, and reach a fair agreement.">
                            <span>Read Article</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </article>

                <!-- Resource Card 6 -->
                <article class="resource-card" data-category="remote">
                    <div class="card-header">
                        <div class="card-icon remote-icon">
                            <i class="fas fa-laptop"></i>
                        </div>
                        <span class="card-category">Remote Work</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Remote Work Survival Guide: Thriving in a Virtual Workplace</h3>
                        <p class="card-date"><i class="far fa-calendar"></i> April 30, 2025</p>
                        <p class="card-excerpt">Discover essential tips for succeeding in a remote work environment, from time management to maintaining work-life balance.</p>
                        <ul class="card-topics">
                            <li><i class="fas fa-check-circle"></i> Time Management</li>
                            <li><i class="fas fa-check-circle"></i> Communication</li>
                            <li><i class="fas fa-check-circle"></i> Work-Life Balance</li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <button class="read-more-btn" data-title="Remote Work Survival Guide: Thriving in a Virtual Workplace" data-date="April 30, 2025" data-content="Discover essential tips for succeeding in a remote work environment, from time management to maintaining work-life balance. Learn how to stay productive, communicate effectively, and build relationships with your team.">
                            <span>Read Article</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </article>
            </div>

            <!-- Empty State -->
            <div class="empty-state" id="emptyState" style="display: none;">
                <i class="fas fa-search"></i>
                <h3>No resources found</h3>
                <p>Try adjusting your search or filter criteria</p>
            </div>
        </div>
    </main>

    <!-- Resource Modal -->
    <div id="blogModal" class="modal">
        <div class="modal-content">
            <button class="close-modal" id="closeModal">
                <i class="fas fa-times"></i>
            </button>
            <div class="modal-header">
                <h2 id="modalTitle"></h2>
                <p class="modal-date" id="modalDate"></p>
            </div>
            <div class="modal-body" id="modalContent">
                <!-- Content will be loaded here -->
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" id="closeModalBtn">Close</button>
                <button class="btn btn-primary" onclick="window.print()">
                    <i class="fas fa-print"></i> Print Article
                </button>
            </div>
        </div>
    </div>
    




   
    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Employify</h3>
                <p>Find your dream job with Employify. Connect with top employers and start your career journey today.</p>
            </div>
            
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="jobs.php">Find a Job</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="career-resources.php">Career Resources</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="resume.php">CV Maker</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Contact Us</h3>
                <p>Email: info@employify.com</p>
                <p>Phone: +8801711111111</p>
                <div class="social-links">
                    <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Employify. All rights reserved.</p>
        </div>
    </footer>

    <script src="../assets/js/navbar.js"></script>
    <script src="../assets/js/blog-posts.js"></script>
</body>
</html>
