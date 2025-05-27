<?php
    session_start();
    if(isset($_SESSION['status'])){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Job Portal</title>
    <link rel="stylesheet" href="../assets/css/contact.css">
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
    <a href="login.php" class="login-btn">Login</a>
    <a href="Registration.php" class="register-btn">Register</a>
</div>

        </nav>
    </header>

    <main class="main-content">
        <div class="container">
            <div class="contact-section">
                <div class="contact-header">
                    <h1>Contact Us</h1>
                    <p>Get in touch with us for any inquiries or support</p>
                </div>

                <div class="contact-content">
                    <div class="contact-info">
                        <div class="info-card">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="info-details">
                                <h3>Our Location</h3>
                                <p>3/4/a Ecb chattor<br>Dhaka, Bangladesh 1205</p>
                            </div>
                        </div>

                        <div class="info-card">
                            <i class="fas fa-phone"></i>
                            <div class="info-details">
                                <h3>Phone</h3>
                                <p>+880 123 456 7890<br>+880 123 456 7891</p>
                            </div>
                        </div>

                        <div class="info-card">
                            <i class="fas fa-envelope"></i>
                            <div class="info-details">
                                <h3>Email</h3>
                                <p>contact@employify.com<br>support@employify.com</p>
                            </div>
                        </div>
                    </div>

                    <div class="contact-form">
                        <form id="contactForm" class="form">
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" id="name" name="name" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" id="phone" name="phone">
                            </div>

                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <select id="subject" name="subject" required>
                                    <option value="">Select Subject</option>
                                    <option value="job">Job Inquiry</option>
                                    <option value="support">Support</option>
                                    <option value="feedback">Feedback</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea id="message" name="message" required></textarea>
                            </div>

                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="your-site-key"></div>
                            </div>

                            <button type="submit" class="submit-btn">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
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
            <p>&copy; 2025 Employify. All rights reserved.</p>
        </div>
     </footer>

    <script src="../Js/auth.js"></script>
    <script src="../Js/contact.js"></script>
</body>
</html>

<?php
    }else{
        header('location: login.php');
    }

?>