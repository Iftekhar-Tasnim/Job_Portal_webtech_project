<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal - Find Your Dream Job</title>
    
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/home.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-content">
            <h1>Find Your Dream Job</h1>
            <p>Connect with top employers and start your career journey today</p>
            
        </div>
    </div>

    <!-- Features Section -->
    <div class="features-section">
        <h2>Why Choose Employify?</h2>
        <div class="features-grid">
            <div class="feature-card">
                <i class="fas fa-search"></i>
                <h3>Smart Job Search</h3>
                <p>Find jobs that match your skills and preferences</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-building"></i>
                <h3>Top Companies</h3>
                <p>Connect with leading employers in your industry</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-file-alt"></i>
                <h3>CV Builder</h3>
                <p>Create a professional CV in minutes</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-bell"></i>
                <h3>Job Alerts</h3>
                <p>Get notified about new opportunities</p>
            </div>
        </div>
    </div>

    <!-- Job Categories -->
    <div class="job-categories">
        <h2>Popular Job Categories</h2>
        <div class="categories-grid">
            <a href="" class="category-card">
                <i class="fas fa-laptop-code"></i>
                <h3>Information Technology</h3>
                <p>100+ Jobs</p>
            </a>
            <a href="" class="category-card">
                <i class="fas fa-bullhorn"></i>
                <h3>Marketing</h3>
                <p>75+ Jobs</p>
            </a>
            <a href="" class="category-card">
                <i class="fas fa-chart-line"></i>
                <h3>Finance</h3>
                <p>50+ Jobs</p>
            </a>
            <a href="../../jobs.php?category=design" class="category-card">
                <i class="fas fa-palette"></i>
                <h3>Design</h3>
                <p>45+ Jobs</p>
            </a>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="cta-section">
        <div class="cta-content">
            <h2>Ready to Start Your Career Journey?</h2>
            <p>Join thousands of job seekers who found their dream jobs through Employify</p>
            
                <a href="../../jobs.php" class="btn btn-primary">Find Jobs</a>
            
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
                    <li><a href="../../home.php">Home</a></li>
                    <li><a href="../../jobs.php">Find a Job</a></li>
                    <li><a href="../../about.php">About</a></li>
                    <li><a href="../../career-resources.php">Career Resources</a></li>
                    <li><a href="../../contact.php">Contact</a></li>
                    <li><a href="../../cv-maker.php">CV Maker</a></li>
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

    
    
</body>
</html>