<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile - Job Portal</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/company-profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <!-- Main Content -->
    <main class="company-profile">
        <!-- Company Banner -->
        <div class="company-banner">
            <div class="company-info">
                <div class="company-logo">
                    <img src="../assets/images/g.png" alt="Company Logo" class="logo-image">
                </div>
                <div class="company-details">
                    <h1 class="company-name">Google</h1>
                    <div class="company-stats">
                        <div class="stat-item">
                            <i class="fas fa-users"></i>
                            <span>1000+ Employees</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-building"></i>
                            <span>10+ Locations</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-star"></i>
                            <span>4.5 Rating</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Company Overview -->
        <section class="company-overview">
            <h2>Company Overview</h2>
            <div class="overview-content">
                <p class="company-description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.
                </p>
                <div class="company-highlights">
                    <div class="highlight-item">
                        <i class="fas fa-industry"></i>
                        <h3>Industry</h3>
                        <p>Information Technology</p>
                    </div>
                    <div class="highlight-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <h3>Headquarters</h3>
                        <p>Dhaka, Bangladesh</p>
                    </div>
                    <div class="highlight-item">
                        <i class="fas fa-calendar"></i>
                        <h3>Founded</h3>
                        <p>2010</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Open Positions -->
        <section class="open-positions">
            <h2>Open Positions</h2>
            <div class="job-list">
                <div class="job-card">
                    <div class="job-header">
                        <h3>Senior Software Engineer</h3>
                        <span class="job-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Dhaka
                        </span>
                    </div>
                    <div class="job-meta">
                        <span class="job-type">Full Time</span>
                        <span class="job-category">IT & Software</span>
                        <span class="job-experience">5+ Years</span>
                    </div>
                    <div class="job-footer">
                        <a href="jobs.php?id=1" class="apply-btn">Apply Now</a>
                        <button class="save-job-btn" data-job-id="1">
                            <i class="far fa-bookmark"></i> Save Job
                        </button>
                    </div>
                </div>
                <div class="job-card">
                    <div class="job-header">
                        <h3>Marketing Manager</h3>
                        <span class="job-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Chittagong
                        </span>
                    </div>
                    <div class="job-meta">
                        <span class="job-type">Full Time</span>
                        <span class="job-category">Marketing</span>
                        <span class="job-experience">3-5 Years</span>
                    </div>
                    <div class="job-footer">
                        <a href="jobs.php?id=2" class="apply-btn">Apply Now</a>
                        <button class="save-job-btn" data-job-id="2">
                            <i class="far fa-bookmark"></i> Save Job
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Company Reviews -->
        <section class="company-reviews">
            <h2>Employee Reviews</h2>
            <div class="review-grid">
                <div class="review-card">
                    <div class="review-header">
                        <div class="reviewer-info">
                            <img src="../assets/images/default-avatar.png" alt="Reviewer" class="reviewer-avatar">
                            <div class="reviewer-details">
                                <h4>John Doe</h4>
                                <span class="reviewer-position">Senior Developer</span>
                            </div>
                        </div>
                        <div class="review-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <div class="review-content">
                        <p>Great company culture and amazing opportunities for growth. The management team is supportive and encourages innovation.</p>
                    </div>
                    <div class="review-footer">
                        <span class="review-date">Reviewed on May 15, 2025</span>
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
                    <li><a href="cv-maker.php">CV Maker</a></li>
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

    <
    <script src="../assets/js/company-profile.js"></>
</body>
</html>