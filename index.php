<?php
session_start();

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
$userType = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal - Find Your Dream Job</title>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/nav-footer.css">
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
                <li><a href="./index.php" class="active">Home</a></li>
                <li><a href="./jobs.php">Find a Job</a></li>
                <li><a href="./about.php">About</a></li>
                <li><a href="./career-resources.php">Career Resources</a></li>
                <li><a href="./contact.php">Contact</a></li>
                <li><a href="./cv-maker.php">CV Maker</a></li>
            </ul>
            <div class="user-actions">
                <?php if ($isLoggedIn): ?>
                    <div class="user-menu">
                        <span class="welcome-text">Welcome, <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'User'); ?></span>
                        <?php if ($userType === 'employer'): ?>
                            <a href="./employer-dashboard.php" class="dashboard-btn">Dashboard</a>
                        <?php else: ?>
                            <a href="./applicant-dashboard.php" class="dashboard-btn">Dashboard</a>
                        <?php endif; ?>
                        <a href="./logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                <?php else: ?>
                    <a href="./login.php" class="login-btn">Login</a>
                    <a href="./Registration.php" class="register-btn">Register</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <?php if (!$isLoggedIn): ?>
            <div class="welcome-message">
                <h2>Welcome to Employify</h2>
                <p>Please login or register to access all features</p>
            </div>
        <?php endif; ?>
        
        <!-- Add your main content here -->
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

    <script src="./js/auth.js"></script>
    <script src="./js/index.js"></script>
</body>
</html> 