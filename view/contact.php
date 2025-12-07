<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Employify</title>
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- reCAPTCHA will be loaded conditionally via JavaScript -->
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Hero Section -->
    <section class="contact-hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="hero-text">
                <span class="hero-tag">Get In Touch</span>
                <h1 class="hero-title">We'd Love to <span class="title-highlight">Hear From You</span></h1>
                <p class="hero-subtitle">Have a question or need assistance? Our team is here to help you. Reach out to us and we'll get back to you as soon as possible.</p>
            </div>
        </div>
        <div class="hero-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
    </section>

    <main class="main-content">
        <!-- Contact Info Section -->
        <section class="contact-info-section">
            <div class="container">
                <div class="info-cards-grid">
                    <div class="info-card">
                        <div class="info-icon location-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3>Our Location</h3>
                        <p>3/4/a Ecb chattor<br>Dhaka, Bangladesh 1205</p>
                        <a href="#" class="info-link">View on Map <i class="fas fa-arrow-right"></i></a>
                    </div>

                    <div class="info-card">
                        <div class="info-icon phone-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h3>Phone</h3>
                        <p>+880 1711 111 111<br>+880 1711 111 112</p>
                        <a href="tel:+8801711111111" class="info-link">Call Now <i class="fas fa-arrow-right"></i></a>
                    </div>

                    <div class="info-card">
                        <div class="info-icon email-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3>Email</h3>
                        <p>info@employify.com<br>support@employify.com</p>
                        <a href="mailto:info@employify.com" class="info-link">Send Email <i class="fas fa-arrow-right"></i></a>
                    </div>

                    <div class="info-card">
                        <div class="info-icon hours-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Business Hours</h3>
                        <p>Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 10:00 AM - 4:00 PM</p>
                        <span class="info-note">Sunday: Closed</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Form Section -->
        <section class="contact-form-section">
            <div class="container">
                <div class="form-container">
                    <div class="form-header">
                        <span class="section-tag">Send Us a Message</span>
                        <h2 class="section-title">Let's Start a Conversation</h2>
                        <p class="section-description">Fill out the form below and we'll get back to you within 24 hours</p>
                    </div>

                    <form id="contactForm" class="contact-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">
                                    <i class="fas fa-user"></i>
                                    Full Name <span class="required">*</span>
                                </label>
                                <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                                <span class="error-message" id="nameError"></span>
                            </div>

                            <div class="form-group">
                                <label for="email">
                                    <i class="fas fa-envelope"></i>
                                    Email Address <span class="required">*</span>
                                </label>
                                <input type="email" id="email" name="email" placeholder="Enter your email address" required>
                                <span class="error-message" id="emailError"></span>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone">
                                    <i class="fas fa-phone"></i>
                                    Phone Number
                                </label>
                                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number">
                                <span class="error-message" id="phoneError"></span>
                            </div>

                            <div class="form-group">
                                <label for="subject">
                                    <i class="fas fa-tag"></i>
                                    Subject <span class="required">*</span>
                                </label>
                                <select id="subject" name="subject" required>
                                    <option value="">Select a subject</option>
                                    <option value="job">Job Inquiry</option>
                                    <option value="support">Technical Support</option>
                                    <option value="feedback">Feedback</option>
                                    <option value="partnership">Partnership</option>
                                    <option value="other">Other</option>
                                </select>
                                <span class="error-message" id="subjectError"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message">
                                <i class="fas fa-comment-alt"></i>
                                Message <span class="required">*</span>
                            </label>
                            <textarea id="message" name="message" rows="6" placeholder="Tell us how we can help you..." required></textarea>
                            <span class="char-count"><span id="charCount">0</span> / 500 characters</span>
                            <span class="error-message" id="messageError"></span>
                        </div>

                        <div class="form-group" id="recaptchaGroup" style="display: none;">
                            <label>
                                <i class="fas fa-shield-alt"></i>
                                Security Verification
                            </label>
                            <div class="g-recaptcha" id="recaptchaContainer"></div>
                            <span class="error-message" id="recaptchaError"></span>
                            <p class="recaptcha-note">Please complete the verification to submit the form</p>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="submit-btn">
                                <span>Send Message</span>
                                <i class="fas fa-paper-plane"></i>
                            </button>
                            <button type="reset" class="reset-btn">
                                <span>Clear Form</span>
                                <i class="fas fa-redo"></i>
                            </button>
                        </div>

                        <div id="formMessages">
                            <div class="success-message" id="successMessage" style="display: none;">
                                <i class="fas fa-check-circle"></i>
                                <span>Message sent successfully! We'll get back to you soon.</span>
                            </div>
                            <div class="error-message" id="errorMessage" style="display: none;">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>There was an error sending your message. Please try again.</span>
                            </div>
                        </div>
                    </form>
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
    <script src="../assets/js/contact.js"></script>
</body>
</html>