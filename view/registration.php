<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration - Employify</title>
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/registration.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <main class="registration-main">
        <div class="registration-container">
            <!-- User Type Selector -->
            <div class="user-type-selector">
                <button class="type-btn active" data-type="applicant" id="applicantTypeBtn">
                    <i class="fas fa-user"></i>
                    <span>Job Seeker</span>
                </button>
                <button class="type-btn" data-type="employer" id="employerTypeBtn">
                    <i class="fas fa-building"></i>
                    <span>Employer</span>
                </button>
            </div>

            <!-- Forms Container -->
            <div class="forms-container">
                <?php
                // Display registration errors if any
                if (isset($_SESSION['register_errors'])) {
                    echo '<div class="alert-message error-alert" id="registerErrorAlert">
                            <i class="fas fa-exclamation-circle"></i>
                            <div class="alert-content">';
                    if (is_array($_SESSION['register_errors'])) {
                        foreach ($_SESSION['register_errors'] as $error) {
                            echo '<div>' . htmlspecialchars($error) . '</div>';
                        }
                    } else {
                        echo '<div>' . htmlspecialchars($_SESSION['register_errors']) . '</div>';
                    }
                    echo '</div>
                            <button class="alert-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
                          </div>';
                    unset($_SESSION['register_errors']);
                }
                
                // Display success message if any
                if (isset($_SESSION['register_success'])) {
                    echo '<div class="alert-message success-alert">
                            <i class="fas fa-check-circle"></i>
                            <span>' . htmlspecialchars($_SESSION['register_success']) . '</span>
                            <button class="alert-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
                          </div>';
                    unset($_SESSION['register_success']);
                }
                ?>

                <!-- Applicant Registration Form -->
                <div class="registration-form-wrapper active" id="applicantForm">
                    <div class="form-header">
                        <div class="form-icon applicant-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <h2>Job Seeker Registration</h2>
                        <p>Create your account and start finding your dream job</p>
                    </div>
                    <form id="applicantRegistrationForm" action="../controller/reg.php" method="POST" class="registration-form">
                        <input type="hidden" name="user_type" value="applicant">
                        <input type="hidden" name="submit" value="1">
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="applicant-first-name">
                                    <i class="fas fa-user"></i>
                                    First Name <span class="required">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="applicant-first-name"
                                    name="First_Name"
                                    placeholder="Enter your first name"
                                    required
                                    autocomplete="given-name"
                                >
                                <span class="error-message" id="applicantFirstNameError"></span>
                            </div>
                            
                            <div class="form-group">
                                <label for="applicant-last-name">
                                    <i class="fas fa-user"></i>
                                    Last Name <span class="required">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="applicant-last-name"
                                    name="Last_Name"
                                    placeholder="Enter your last name"
                                    required
                                    autocomplete="family-name"
                                >
                                <span class="error-message" id="applicantLastNameError"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="applicant-email">
                                <i class="fas fa-envelope"></i>
                                Email Address <span class="required">*</span>
                            </label>
                            <input
                                type="email"
                                id="applicant-email"
                                name="Email"
                                placeholder="Enter your email address"
                                required
                                autocomplete="email"
                            >
                            <span class="error-message" id="applicantEmailError"></span>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="applicant-phone">
                                    <i class="fas fa-phone"></i>
                                    Phone Number <span class="required">*</span>
                                </label>
                                <input
                                    type="tel"
                                    id="applicant-phone"
                                    name="Phone"
                                    placeholder="Enter your phone number"
                                    required
                                    autocomplete="tel"
                                >
                                <span class="error-message" id="applicantPhoneError"></span>
                            </div>
                            
                            <div class="form-group">
                                <label for="applicant-gender">
                                    <i class="fas fa-venus-mars"></i>
                                    Gender <span class="required">*</span>
                                </label>
                                <select id="applicant-gender" name="Gender" required>
                                    <option value="" disabled selected>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                                <span class="error-message" id="applicantGenderError"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="applicant-address">
                                <i class="fas fa-map-marker-alt"></i>
                                Address <span class="required">*</span>
                            </label>
                            <input
                                type="text"
                                id="applicant-address"
                                name="Address"
                                placeholder="Enter your address"
                                required
                                autocomplete="street-address"
                            >
                            <span class="error-message" id="applicantAddressError"></span>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="applicant-password">
                                    <i class="fas fa-lock"></i>
                                    Password <span class="required">*</span>
                                </label>
                                <div class="password-input-wrapper">
                                    <input
                                        type="password"
                                        id="applicant-password"
                                        name="Password"
                                        placeholder="Create a password"
                                        required
                                        autocomplete="new-password"
                                    >
                                    <button type="button" class="password-toggle" id="applicantPasswordToggle">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <span class="error-message" id="applicantPasswordError"></span>
                                <small class="field-hint">Minimum 8 characters</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="applicant-confirm-password">
                                    <i class="fas fa-lock"></i>
                                    Confirm Password <span class="required">*</span>
                                </label>
                                <div class="password-input-wrapper">
                                    <input
                                        type="password"
                                        id="applicant-confirm-password"
                                        name="confirm_password"
                                        placeholder="Confirm your password"
                                        required
                                        autocomplete="new-password"
                                    >
                                    <button type="button" class="password-toggle" id="applicantConfirmPasswordToggle">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <span class="error-message" id="applicantConfirmPasswordError"></span>
                            </div>
                        </div>

                        <button type="submit" class="submit-btn" id="applicantSignupButton" name="submit">
                            <span>Create Account</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </form>
                </div>

                <!-- Employer Registration Form -->
                <div class="registration-form-wrapper" id="employerForm">
                    <div class="form-header">
                        <div class="form-icon employer-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <h2>Employer Registration</h2>
                        <p>Create your company account and start posting jobs</p>
                    </div>
                    <form id="employerRegistrationForm" action="../controller/reg.php" method="POST" class="registration-form">
                        <input type="hidden" name="user_type" value="employer">
                        <input type="hidden" name="submit" value="1">
                        
                        <div class="form-group">
                            <label for="employer-company-name">
                                <i class="fas fa-building"></i>
                                Company Name <span class="required">*</span>
                            </label>
                            <input
                                type="text"
                                id="employer-company-name"
                                name="Company_Name"
                                placeholder="Enter your company name"
                                required
                                autocomplete="organization"
                            >
                            <span class="error-message" id="employerCompanyNameError"></span>
                        </div>

                        <div class="form-group">
                            <label for="employer-email">
                                <i class="fas fa-envelope"></i>
                                Company Email <span class="required">*</span>
                            </label>
                            <input
                                type="email"
                                id="employer-email"
                                name="Email"
                                placeholder="Enter your company email"
                                required
                                autocomplete="email"
                            >
                            <span class="error-message" id="employerEmailError"></span>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="employer-phone">
                                    <i class="fas fa-phone"></i>
                                    Company Phone <span class="required">*</span>
                                </label>
                                <input
                                    type="tel"
                                    id="employer-phone"
                                    name="Company_Phone"
                                    placeholder="Enter company phone"
                                    required
                                    autocomplete="tel"
                                >
                                <span class="error-message" id="employerPhoneError"></span>
                            </div>
                            
                            <div class="form-group">
                                <label for="employer-industry">
                                    <i class="fas fa-industry"></i>
                                    Industry <span class="required">*</span>
                                </label>
                                <select id="employer-industry" name="Industry" required>
                                    <option value="" disabled selected>Select Industry</option>
                                    <option value="Information Technology">Information Technology</option>
                                    <option value="Finance">Finance</option>
                                    <option value="Healthcare">Healthcare</option>
                                    <option value="Manufacturing">Manufacturing</option>
                                    <option value="Retail">Retail</option>
                                    <option value="Education">Education</option>
                                    <option value="Other">Other</option>
                                </select>
                                <span class="error-message" id="employerIndustryError"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="employer-address">
                                <i class="fas fa-map-marker-alt"></i>
                                Company Address <span class="required">*</span>
                            </label>
                            <input
                                type="text"
                                id="employer-address"
                                name="Company_Address"
                                placeholder="Enter company address"
                                required
                                autocomplete="street-address"
                            >
                            <span class="error-message" id="employerAddressError"></span>
                        </div>

                        <div class="form-group">
                            <label for="employer-website">
                                <i class="fas fa-globe"></i>
                                Company Website <span class="required">*</span>
                            </label>
                            <input
                                type="url"
                                id="employer-website"
                                name="Company_Website"
                                placeholder="https://www.example.com"
                                required
                                autocomplete="url"
                            >
                            <span class="error-message" id="employerWebsiteError"></span>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="employer-password">
                                    <i class="fas fa-lock"></i>
                                    Password <span class="required">*</span>
                                </label>
                                <div class="password-input-wrapper">
                                    <input
                                        type="password"
                                        id="employer-password"
                                        name="Password"
                                        placeholder="Create a password"
                                        required
                                        autocomplete="new-password"
                                    >
                                    <button type="button" class="password-toggle" id="employerPasswordToggle">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <span class="error-message" id="employerPasswordError"></span>
                                <small class="field-hint">Minimum 8 characters</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="employer-confirm-password">
                                    <i class="fas fa-lock"></i>
                                    Confirm Password <span class="required">*</span>
                                </label>
                                <div class="password-input-wrapper">
                                    <input
                                        type="password"
                                        id="employer-confirm-password"
                                        name="confirm_password"
                                        placeholder="Confirm your password"
                                        required
                                        autocomplete="new-password"
                                    >
                                    <button type="button" class="password-toggle" id="employerConfirmPasswordToggle">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <span class="error-message" id="employerConfirmPasswordError"></span>
                            </div>
                        </div>

                        <button type="submit" class="submit-btn" id="employerSignupButton" name="submit">
                            <span>Create Company Account</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Login Prompt -->
            <div class="login-prompt">
                <p>Already have an account? <a href="login.php">Sign in here <i class="fas fa-arrow-right"></i></a></p>
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
    <script src="../assets/js/registration.js"></script>
</body>
</html>
