<?php
    session_start();
    if(isset($_SESSION['status'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Alerts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/alert.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <h1>Employify</h1>
            </div>
            <ul class="nav-links">
                <li><a href="./index.html">Home</a></li>
                <li><a href="./jobs.html">Find a Job</a></li>
                <li><a href="./about.html">About</a></li>
                <li><a href="./career-resources.html">Career Resources</a></li>
                <li><a href="./contact.html">Contact</a></li>
                <li><a href="./cv-maker.html">CV Maker</a></li>
            </ul>
            <div class="user-actions">
                <a href="./login.html" class="login-btn">Login</a>
                <a href="./Registration.html" class="register-btn">Register</a>
            </div>
        </nav>
    </header>

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
                    <li><a href="./index.html">Home</a></li>
                    <li><a href="./jobs.html">Find a Job</a></li>
                    <li><a href="./about.html">About</a></li>
                    <li><a href="./career-resources.html">Career Resources</a></li>
                    <li><a href="./contact.html">Contact</a></li>
                    <li><a href="./cv-maker.html">CV Maker</a></li>
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

    <script src="alert.js"></script>
</body>
</html>
<?php
    }else{
        header('location: login.php');
    }

?>