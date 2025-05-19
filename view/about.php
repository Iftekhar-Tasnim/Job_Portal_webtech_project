<?php
    session_start();
    if(isset($_SESSION['status'])){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Employify Job Portal</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/about.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header>
    <nav>
            <div class="logo">
                <h1>Employify</h1>
            </div>
            <ul class="nav-links">
                <li><a href="home.php">Home</a></li>
                <li><a href="jobs.php">Find a Job</a></li>
                <li><a href="about.php" class="active">About</a></li>
                <li><a href="career-resources.php">Career Resources</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="cv-maker.php">CV Maker</a></li>
            </ul>
            <div class="user-actions">
                <?php if ($isLoggedIn): ?>
                    <div class="user-menu">
                        <span class="welcome-text">Welcome, <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'User'); ?></span>
                        <?php if ($userType === 'employer'): ?>
                            <a href="employer-dashboard.php" class="dashboard-btn">Dashboard</a>
                        <?php else: ?>
                            <a href="applicant-dashboard.php" class="dashboard-btn">Dashboard</a>
                        <?php endif; ?>
                        <a href="logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                <?php else: ?>
                   <a href="login.php" class="login-btn">Login</a>
                    <a href="Registration.php" class="register-btn">Register</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <section class="about-section">
            <div class="about-header">
                <h1>About Employify</h1>
                <p>Connecting talented professionals with their dream careers since 2025</p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-search"></i>
                    <h3>Smart Job Search</h3>
                    <p>Our advanced search algorithm helps you find the perfect job match based on your skills, experience, and preferences.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-file-alt"></i>
                    <h3>Resume Builder</h3>
                    <p>Create professional resumes with our easy-to-use builder and stand out to employers with a polished profile.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-bell"></i>
                    <h3>Job Alerts</h3>
                    <p>Never miss an opportunity with personalized job alerts that match your career goals and preferences.</p>
                </div>
            </div>

            <div class="mission-vision">
                <h2>Our Mission & Vision</h2>
                <div class="mission-vision-content">
                    <div class="mission">
                        <h3>Our Mission</h3>
                        <p>To empower job seekers and employers with innovative tools and resources that make the job search and hiring process more efficient and successful.</p>
                    </div>
                    <div class="vision">
                        <h3>Our Vision</h3>
                        <p>To become the leading job portal that transforms how people find meaningful careers and how companies discover exceptional talent.</p>
                    </div>
                </div>
            </div>

            <div class="team-section">
                <h2>Our Leadership Team</h2>
                <div class="team-grid">
                    <div class="team-member">
                        <img src="/assets/123.jpg" alt="CEO">
                        <h3>John Smith</h3>
                        <p>Chief Executive Officer</p>
                    </div>
                    <div class="team-member">
                        <img src="/assets/g.png" alt="CTO">
                        <h3>Sarah Johnson</h3>
                        <p>Chief Technology Officer</p>
                    </div>
                    <div class="team-member">
                        <img src="/assets/m.png" alt="COO">
                        <h3>Michael Chen</h3>
                        <p>Chief Operations Officer</p>
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
                    <li><a href="./index.php">Home</a></li>
                    <li><a href="./jobs.php">Find a Job</a></li>
                    <li><a href="./about.php">About</a></li>
                    <li><a href="./career-resources.php">Career Resources</a></li>
                    <li><a href="./contact.php">Contact</a></li>
                    <li><a href="./cv-maker.php">CV Maker</a></li>
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
            <p>&copy; 2025 Employify. All rights reserved.</p>
        </div>
    </footer>

    
    <script src="../assets/js/about.js"></script>
</body>
</html>

<?php
    }else{
        header('location: login.php');
    }

?>

