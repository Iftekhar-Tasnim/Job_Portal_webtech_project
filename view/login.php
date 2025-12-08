<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Employify</title>
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <main class="login-main">
        <div class="login-container">
            <!-- User Type Selector -->
            <div class="user-type-selector">
                <button class="type-btn active" data-type="applicant" id="applicantBtn">
                    <i class="fas fa-user"></i>
                    <span>Job Seeker</span>
                </button>
                <button class="type-btn" data-type="employer" id="employerBtn">
                    <i class="fas fa-building"></i>
                    <span>Employer</span>
                </button>
            </div>

            <!-- Login Forms Container -->
            <div class="forms-container">
                <?php
                // Display general login error if any
                if (isset($_SESSION['login_error'])) {
                    echo '<div class="alert-message error-alert" id="loginErrorAlert">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>' . htmlspecialchars($_SESSION['login_error']) . '</span>
                            <button class="alert-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
                          </div>';
                    unset($_SESSION['login_error']);
                }
                
                // Get validation errors if any
                $errors = isset($_SESSION['login_errors']) ? $_SESSION['login_errors'] : [];
                unset($_SESSION['login_errors']);
                ?>

                <!-- Applicant Login Form -->
                <div class="login-form-wrapper active" id="applicantForm">
                    <div class="form-header">
                        <div class="form-icon applicant-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <h2>Job Seeker Login</h2>
                        <p>Sign in to access your profile and job applications</p>
                    </div>
                    <form id="applicantLoginForm" action="../controller/logincheck.php" method="POST" class="login-form">
                        <input type="hidden" name="user_type" value="applicant">
                        <input type="hidden" name="submit" value="1">
                        
                        <div class="form-group">
                            <label for="applicantEmail">
                                <i class="fas fa-envelope"></i>
                                Email Address <span class="required">*</span>
                            </label>
                            <input 
                                type="email" 
                                id="applicantEmail" 
                                name="email" 
                                placeholder="Enter your email address"
                                value="<?php echo isset($_SESSION['old_input']['email']) ? htmlspecialchars($_SESSION['old_input']['email']) : ''; ?>"
                                required
                                autocomplete="email"
                            >
                            <span class="error-message" id="applicantEmailError">
                                <?php echo isset($errors['email']) ? htmlspecialchars($errors['email']) : ''; ?>
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="applicantPassword">
                                <i class="fas fa-lock"></i>
                                Password <span class="required">*</span>
                            </label>
                            <div class="password-input-wrapper">
                                <input 
                                    type="password" 
                                    id="applicantPassword" 
                                    name="password" 
                                    placeholder="Enter your password"
                                    required
                                    autocomplete="current-password"
                                >
                                <button type="button" class="password-toggle" id="applicantPasswordToggle">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <span class="error-message" id="applicantPasswordError">
                                <?php echo isset($errors['password']) ? htmlspecialchars($errors['password']) : ''; ?>
                            </span>
                        </div>

                        <div class="form-options">
                            <label class="remember-me">
                                <input type="checkbox" name="remember_me" value="1">
                                <span>Remember me</span>
                            </label>
                            <a href="forgetpass.php" class="forgot-password-link">
                                <i class="fas fa-key"></i> Forgot Password?
                            </a>
                        </div>

                        <button type="submit" class="submit-btn" name="submit">
                            <span>Sign In as Job Seeker</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </form>
                </div>

                <!-- Employer Login Form -->
                <div class="login-form-wrapper" id="employerForm">
                    <div class="form-header">
                        <div class="form-icon employer-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <h2>Employer Login</h2>
                        <p>Sign in to manage your company profile and job postings</p>
                    </div>
                    <form id="employerLoginForm" action="../controller/logincheck.php" method="POST" class="login-form">
                        <input type="hidden" name="user_type" value="employer">
                        <input type="hidden" name="submit" value="1">
                        
                        <div class="form-group">
                            <label for="employerEmail">
                                <i class="fas fa-envelope"></i>
                                Company Email <span class="required">*</span>
                            </label>
                            <input 
                                type="email" 
                                id="employerEmail" 
                                name="email" 
                                placeholder="Enter your company email"
                                value="<?php echo isset($_SESSION['old_input']['email']) ? htmlspecialchars($_SESSION['old_input']['email']) : ''; ?>"
                                required
                                autocomplete="email"
                            >
                            <span class="error-message" id="employerEmailError">
                                <?php echo isset($errors['email']) ? htmlspecialchars($errors['email']) : ''; ?>
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="employerPassword">
                                <i class="fas fa-lock"></i>
                                Password <span class="required">*</span>
                            </label>
                            <div class="password-input-wrapper">
                                <input 
                                    type="password" 
                                    id="employerPassword" 
                                    name="password" 
                                    placeholder="Enter your password"
                                    required
                                    autocomplete="current-password"
                                >
                                <button type="button" class="password-toggle" id="employerPasswordToggle">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <span class="error-message" id="employerPasswordError">
                                <?php echo isset($errors['password']) ? htmlspecialchars($errors['password']) : ''; ?>
                            </span>
                        </div>

                        <div class="form-options">
                            <label class="remember-me">
                                <input type="checkbox" name="remember_me" value="1">
                                <span>Remember me</span>
                            </label>
                            <a href="forgetpass.php" class="forgot-password-link">
                                <i class="fas fa-key"></i> Forgot Password?
                            </a>
                        </div>

                        <button type="submit" class="submit-btn" name="submit">
                            <span>Sign In as Employer</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Registration Link -->
            <div class="registration-prompt">
                <p>Don't have an account? <a href="registration.php">Create an account <i class="fas fa-arrow-right"></i></a></p>
            </div>
        </div>
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
    <script src="../assets/js/login.js"></script>
</body>
</html>
<?php
// Clear any remaining session data
unset($_SESSION['old_input']);
?> 