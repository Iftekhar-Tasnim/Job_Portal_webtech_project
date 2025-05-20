<?php
    session_start();
    if(isset($_COOKIE['status'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Alerts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        /* Header Styles */
        header {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        header nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }
        .logo h1 {
            margin: 0;
            font-size: 24px;
        }
        .nav-links {
            list-style: none;
            display: flex;
            gap: 15px;
            margin: 0;
            padding: 0;
        }
        .nav-links li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }
        .nav-links li a:hover {
            text-decoration: underline;
        }
        .user-actions a {
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 4px;
            margin-left: 10px;
        }
        .user-actions .login-btn {
            background: #0056b3;
        }
        .user-actions .register-btn {
            background: #28a745;
        }
        .user-actions a:hover {
            opacity: 0.9;
        }
        /* Section Navigation Styles */
        nav.section-nav {
            background: #0056b3;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin: 20px auto;
            max-width: 800px;
        }
        nav.section-nav button {
            background: none;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            padding: 10px 20px;
            margin: 0 5px;
        }
        nav.section-nav button:hover {
            background: #003d80;
            border-radius: 5px;
        }
        section {
            display: none;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        section.active {
            display: block;
        }
        h2 {
            color: #333;
            margin-top: 0;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        label {
            font-weight: bold;
        }
        input, select {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            width: 100%;
            box-sizing: border-box;
        }
        input.invalid, select.invalid {
            border-color: #dc3545;
        }
        button[type="submit"] {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button[type="submit"]:hover {
            background: #0056b3;
        }
        article {
            border-bottom: 1px solid #eee;
            padding: 10px 0;
        }
        article:last-child {
            border-bottom: none;
        }
        p {
            margin: 5px 0;
        }
        .error {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }
        .error.active {
            display: block;
        }
        /* Footer Styles */
        .footer {
            background: #007bff;
            color: white;
            padding: 20px;
            margin-top: 20px;
        }
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }
        .footer-section {
            flex: 1;
            min-width: 200px;
        }
        .footer-section h3 {
            margin-top: 0;
            font-size: 18px;
        }
        .footer-section p {
            font-size: 14px;
            line-height: 1.5;
        }
        .footer-section ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .footer-section ul li a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            line-height: 2;
        }
        .footer-section ul li a:hover {
            text-decoration: underline;
        }
        .social-links {
            margin-top: 10px;
            display: flex;
            gap: 10px;
        }
        .social-icon {
            color: white;
            font-size: 20px;
            text-decoration: none;
        }
        .social-icon:hover {
            opacity: 0.8;
        }
        .footer-bottom {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
        }
        @media (max-width: 600px) {
            .footer-content {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            .footer-section ul {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
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
    } else {
        header('location: login.html');
    }
?>