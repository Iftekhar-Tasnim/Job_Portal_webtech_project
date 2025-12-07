<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Alerts - Employify</title>
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/alert.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <nav class="section-nav">
        <button onclick="showScreen('alert-preferences')">Alert Preferences</button>
        <button onclick="showScreen('notification-center')">Notification Center</button>
        <button onclick="showScreen('recommended-jobs')">Recommended Jobs</button>
    </nav>

    <section id="alert-preferences" class="active">
        <h2>Alert Preferences</h2>
        <form id="preferences-form">
            <label for="job-title">Job Title:</label>
            <input type="text" id="job-title" placeholder="e.g., Software Engineer">
            <p class="error" id="job-title-error">Job title is required.</p>

            <label for="location">Location:</label>
            <input type="text" id="location" placeholder="e.g., New York, NY">
            <p class="error" id="location-error">Location is required.</p>

            <label for="job-type">Job Type:</label>
            <select id="job-type">
                <option value="">Select</option>
                <option value="full-time">Full-Time</option>
                <option value="part-time">Part-Time</option>
                <option value="contract">Contract</option>
            </select>
            <p class="error" id="job-type-error">Please select a job type.</p>

            <label for="notification-method">Notification Method:</label>
            <select id="notification-method">
                <option value="email">Email</option>
                <option value="app">App</option>
                <option value="both">Both</option>
            </select>
            <p class="error" id="notification-method-error">Please select a notification method.</p>

            <button type="submit">Save Preferences</button>
        </form>
    </section>

    <section id="notification-center">
        <h2>Notification Center</h2>
        <article id="notifications"></article>
    </section>

    <section id="recommended-jobs">
        <h2>Recommended Jobs</h2>
        <article id="jobs"></article>
    </section>

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
            <p>© 2025 Employify. All rights reserved.</p>
        </div>
    </footer>

    <script src="../assets/js/navbar.js"></script>
    <script src="../assets/js/alert.js"></script>
</body>
</html>