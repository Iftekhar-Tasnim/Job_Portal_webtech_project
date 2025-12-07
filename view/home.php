<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employify - Find Your Dream Job | Connect with Top Employers</title>
    <meta name="description" content="Find your dream job with Employify. Connect with top employers, browse thousands of job opportunities, and advance your career today.">
    
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Hero Section with Search -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-title">
                    <span class="title-highlight">Find Your</span><br>
                    Dream Job Today
                </h1>
                <p class="hero-subtitle">Connect with top employers and discover thousands of opportunities. Your next career move starts here.</p>
                
                <!-- Quick Search Bar -->
                <div class="hero-search">
                    <form action="jobs.php" method="GET" class="search-form">
                        <div class="search-input-group">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" name="search" placeholder="Job title, keywords, or company..." class="search-input">
                        </div>
                        <div class="search-input-group">
                            <i class="fas fa-map-marker-alt search-icon"></i>
                            <input type="text" name="location" placeholder="Location" class="search-input">
                        </div>
                        <button type="submit" class="search-btn">
                            <span>Search Jobs</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </form>
                </div>
                
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">10,000+</span>
                        <span class="stat-label">Active Jobs</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">5,000+</span>
                        <span class="stat-label">Companies</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">50,000+</span>
                        <span class="stat-label">Job Seekers</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
    </section>

    <!-- Quick Actions -->
    <section class="quick-actions">
        <div class="container">
            <div class="action-cards">
                <a href="jobs.php" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3>Browse Jobs</h3>
                    <p>Explore thousands of opportunities</p>
                </a>
                <a href="registration.php" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h3>Create Account</h3>
                    <p>Join thousands of job seekers</p>
                </a>
                <a href="resume.php" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3>Build Resume</h3>
                    <p>Create a professional CV</p>
                </a>
                <a href="alert.php" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h3>Job Alerts</h3>
                    <p>Get notified of new opportunities</p>
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Why Choose Us</span>
                <h2 class="section-title">Everything You Need to Succeed</h2>
                <p class="section-description">We provide all the tools and resources you need to find your perfect job match.</p>
            </div>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3>Smart Job Search</h3>
                    <p>Advanced filters and AI-powered matching help you find jobs that perfectly match your skills, experience, and career goals.</p>
                    <a href="jobs.php" class="feature-link">Explore Jobs <i class="fas fa-arrow-right"></i></a>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h3>Job Alerts</h3>
                    <p>Never miss an opportunity! Set up personalized job alerts and get notified when new positions match your criteria.</p>
                    <a href="alert.php" class="feature-link">Set Up Alerts <i class="fas fa-arrow-right"></i></a>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3>Professional CV Builder</h3>
                    <p>Create a standout resume in minutes with our easy-to-use CV builder. Multiple templates and expert tips included.</p>
                    <a href="resume.php" class="feature-link">Build Resume <i class="fas fa-arrow-right"></i></a>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h3>Job Alerts</h3>
                    <p>Never miss an opportunity. Get instant notifications about new jobs that match your preferences and criteria.</p>
                    <a href="alert.php" class="feature-link">Set Alerts <i class="fas fa-arrow-right"></i></a>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Career Resources</h3>
                    <p>Access expert advice, interview tips, salary guides, and career development resources to advance your career.</p>
                    <a href="career-resources.php" class="feature-link">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Application Tracking</h3>
                    <p>Track all your job applications in one place. Monitor status, set reminders, and never lose track of opportunities.</p>
                    <a href="Profile.php" class="feature-link">View Dashboard <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Job Categories -->
    <section class="job-categories">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Browse by Category</span>
                <h2 class="section-title">Popular Job Categories</h2>
                <p class="section-description">Find opportunities in your field of expertise</p>
            </div>
            
            <div class="categories-grid">
                <a href="jobs.php?category=it" class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h3>Information Technology</h3>
                    <p class="job-count">1,250+ Jobs</p>
                    <span class="category-link">View Jobs <i class="fas fa-arrow-right"></i></span>
                </a>
                
                <a href="jobs.php?category=marketing" class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <h3>Marketing & Sales</h3>
                    <p class="job-count">850+ Jobs</p>
                    <span class="category-link">View Jobs <i class="fas fa-arrow-right"></i></span>
                </a>
                
                <a href="jobs.php?category=finance" class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Finance & Accounting</h3>
                    <p class="job-count">620+ Jobs</p>
                    <span class="category-link">View Jobs <i class="fas fa-arrow-right"></i></span>
                </a>
                
                <a href="jobs.php?category=design" class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-palette"></i>
                    </div>
                    <h3>Design & Creative</h3>
                    <p class="job-count">480+ Jobs</p>
                    <span class="category-link">View Jobs <i class="fas fa-arrow-right"></i></span>
                </a>
                
                <a href="jobs.php?category=healthcare" class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h3>Healthcare</h3>
                    <p class="job-count">720+ Jobs</p>
                    <span class="category-link">View Jobs <i class="fas fa-arrow-right"></i></span>
                </a>
                
                <a href="jobs.php?category=education" class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3>Education & Training</h3>
                    <p class="job-count">390+ Jobs</p>
                    <span class="category-link">View Jobs <i class="fas fa-arrow-right"></i></span>
                </a>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-it-works">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Simple Process</span>
                <h2 class="section-title">How It Works</h2>
                <p class="section-description">Get started in just a few simple steps</p>
            </div>
            
            <div class="steps-container">
                <div class="step-item">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3>Create Your Profile</h3>
                        <p>Sign up and build your professional profile. Add your skills, experience, and career preferences.</p>
                    </div>
                </div>
                
                <div class="step-connector"></div>
                
                <div class="step-item">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3>Search & Apply</h3>
                        <p>Browse thousands of job listings, use smart filters, and apply to positions that match your profile.</p>
                    </div>
                </div>
                
                <div class="step-connector"></div>
                
                <div class="step-item">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3>Get Hired</h3>
                        <p>Connect with employers, ace your interviews, and land your dream job. Track everything in your dashboard.</p>
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
                <p>Join thousands of job seekers who found their dream jobs through Employify. Your next opportunity is just a click away.</p>
                <div class="cta-buttons">
                    <?php if(isset($_SESSION['status']) && $_SESSION['status'] === true): ?>
                        <a href="jobs.php" class="btn btn-primary">
                            <span>Browse Jobs</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="Profile.php" class="btn btn-outline">
                            <span>View Dashboard</span>
                            <i class="fas fa-user"></i>
                        </a>
                    <?php else: ?>
                        <a href="registration.php" class="btn btn-primary">
                            <span>Get Started Free</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="jobs.php" class="btn btn-outline">
                            <span>Browse Jobs</span>
                            <i class="fas fa-search"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Employify</h3>
                <p>Find your dream job with Employify. Connect with top employers and start your career journey today.</p>
                <div class="social-links">
                    <a href="#" class="social-icon" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="social-icon" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="social-icon" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="jobs.php">Find a Job</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="career-resources.php">Career Resources</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="resume.php">CV Maker</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>For Employers</h3>
                <ul>
                    <li><a href="registration.php">Post a Job</a></li>
                    <li><a href="jobs.php">Browse Jobs</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="contact.php">Contact Sales</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Contact Us</h3>
                <div class="contact-info">
                    <p><i class="fas fa-envelope"></i> info@employify.com</p>
                    <p><i class="fas fa-phone"></i> +880 1711 111 111</p>
                    <p><i class="fas fa-map-marker-alt"></i> Dhaka, Bangladesh</p>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Employify. All rights reserved.</p>
        </div>
    </footer>

    <script src="../assets/js/navbar.js"></script>
    <script src="../assets/js/index.js"></script>
</body>
</html>
