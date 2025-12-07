<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Employify Job Portal</title>
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/about.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Hero Section -->
    <section class="about-hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="hero-text">
                <span class="hero-tag">About Employify</span>
                <h1 class="hero-title">Connecting Talent with <span class="title-highlight">Opportunity</span></h1>
                <p class="hero-subtitle">We're on a mission to transform the job search experience, making it easier for professionals to find their dream careers and for companies to discover exceptional talent.</p>
            </div>
        </div>
        <div class="hero-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
    </section>

    <main class="main-content">
        <!-- Stats Section -->
        <section class="stats-section">
            <div class="container">
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-number" data-target="2000000">0</div>
                        <div class="stat-label">Active Job Seekers</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="stat-number" data-target="50000">0</div>
                        <div class="stat-label">Active Jobs</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="stat-number" data-target="10000">0</div>
                        <div class="stat-label">Partner Companies</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-number" data-target="500000">0</div>
                        <div class="stat-label">Successful Placements</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mission & Vision Section -->
        <section class="mission-vision-section">
            <div class="container">
                <div class="section-header">
                    <span class="section-tag">Our Purpose</span>
                    <h2 class="section-title">Mission & Vision</h2>
                </div>
                <div class="mission-vision-grid">
                    <div class="mission-card">
                        <div class="card-icon mission-icon">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h3>Our Mission</h3>
                        <p>To empower job seekers and employers with innovative tools and resources that make the job search and hiring process more efficient, transparent, and successful for everyone involved.</p>
                        <ul class="mission-points">
                            <li><i class="fas fa-check"></i> Simplify job searching</li>
                            <li><i class="fas fa-check"></i> Connect talent with opportunity</li>
                            <li><i class="fas fa-check"></i> Support career growth</li>
                        </ul>
                    </div>
                    <div class="vision-card">
                        <div class="card-icon vision-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h3>Our Vision</h3>
                        <p>To become the world's most trusted job portal that transforms how people find meaningful careers and how companies discover exceptional talent, creating a more connected and efficient job market.</p>
                        <ul class="vision-points">
                            <li><i class="fas fa-check"></i> Global reach</li>
                            <li><i class="fas fa-check"></i> Innovation leadership</li>
                            <li><i class="fas fa-check"></i> Positive impact</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Values Section -->
        <section class="values-section">
            <div class="container">
                <div class="section-header">
                    <span class="section-tag">What We Stand For</span>
                    <h2 class="section-title">Our Core Values</h2>
                    <p class="section-description">These principles guide everything we do and shape our culture</p>
                </div>
                <div class="values-grid">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3>Integrity</h3>
                        <p>We operate with honesty, transparency, and ethical practices in all our interactions.</p>
                    </div>
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h3>Innovation</h3>
                        <p>We continuously improve our platform with cutting-edge technology and creative solutions.</p>
                    </div>
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h3>Partnership</h3>
                        <p>We build strong relationships with job seekers and employers based on trust and mutual success.</p>
                    </div>
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h3>Excellence</h3>
                        <p>We strive for the highest quality in everything we do, from user experience to customer service.</p>
                    </div>
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <h3>User-Centric</h3>
                        <p>Our users are at the heart of every decision we make and every feature we build.</p>
                    </div>
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-globe"></i>
                        </div>
                        <h3>Accessibility</h3>
                        <p>We believe everyone deserves equal access to career opportunities, regardless of background.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features-section">
            <div class="container">
                <div class="section-header">
                    <span class="section-tag">Why Choose Us</span>
                    <h2 class="section-title">What Makes Us Different</h2>
                </div>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3>Smart Job Search</h3>
                        <p>Our advanced AI-powered search algorithm helps you find the perfect job match based on your skills, experience, and career preferences.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h3>Resume Builder</h3>
                        <p>Create professional, ATS-friendly resumes with our easy-to-use builder and stand out to employers with a polished profile.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-bell"></i>
                        </div>
                        <h3>Job Alerts</h3>
                        <p>Never miss an opportunity with personalized job alerts that match your career goals, skills, and location preferences.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3>Career Insights</h3>
                        <p>Get valuable insights into salary ranges, company cultures, and industry trends to make informed career decisions.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3>Secure Platform</h3>
                        <p>Your data is protected with enterprise-grade security measures, ensuring your personal information stays safe and private.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h3>24/7 Support</h3>
                        <p>Our dedicated support team is always ready to help you with any questions or issues you may encounter.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section class="team-section">
            <div class="container">
                <div class="section-header">
                    <span class="section-tag">Meet the Team</span>
                    <h2 class="section-title">Our Leadership</h2>
                    <p class="section-description">The passionate individuals driving Employify forward</p>
                </div>
                <div class="team-grid">
                    <div class="team-member">
                        <div class="member-image">
                            <img src="../assets/image/123.jpg" alt="John Smith">
                            <div class="member-overlay">
                                <div class="social-links">
                                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="member-info">
                            <h3>John Smith</h3>
                            <p class="member-role">Chief Executive Officer</p>
                            <p class="member-bio">Visionary leader with 15+ years of experience in tech and recruitment.</p>
                        </div>
                    </div>
                    <div class="team-member">
                        <div class="member-image">
                            <img src="../assets/image/g.png" alt="Sarah Johnson">
                            <div class="member-overlay">
                                <div class="social-links">
                                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="member-info">
                            <h3>Sarah Johnson</h3>
                            <p class="member-role">Chief Technology Officer</p>
                            <p class="member-bio">Tech innovator passionate about building scalable, user-friendly platforms.</p>
                        </div>
                    </div>
                    <div class="team-member">
                        <div class="member-image">
                            <img src="../assets/image/m.png" alt="Michael Chen">
                            <div class="member-overlay">
                                <div class="social-links">
                                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="member-info">
                            <h3>Michael Chen</h3>
                            <p class="member-role">Chief Operations Officer</p>
                            <p class="member-bio">Operations expert focused on delivering exceptional user experiences.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section">
            <div class="container">
                <div class="cta-content">
                    <h2>Ready to Start Your Career Journey?</h2>
                    <p>Join millions of professionals who have found their dream jobs through Employify</p>
                    <div class="cta-buttons">
                        <a href="registration.php" class="btn btn-primary">
                            <i class="fas fa-user-plus"></i>
                            <span>Create Account</span>
                        </a>
                        <a href="jobs.php" class="btn btn-secondary">
                            <i class="fas fa-search"></i>
                            <span>Browse Jobs</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

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
    <script src="../assets/js/about.js"></script>
</body>
</html>

