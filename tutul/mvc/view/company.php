<?php
    session_start();
    if(isset($_COOKIE['status'])) {
?>
<?php
    } else {
        header('location: login.html');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profiles</title>
    <!-- Add Font Awesome for social media icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f0f0f0;
            color: #333;
        }
        .container {
            display: flex;
            max-width: 1000px;
            margin: 0 auto;
        }
        header {
            background-color: #007bff;
            padding: 15px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        header nav {
            max-width: 1000px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header .logo h1 {
            color: white;
            margin: 0;
            font-size: 1.8em;
        }
        header .nav-links {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }
        header .nav-links li {
            margin-left: 20px;
        }
        header .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 1em;
        }
        header .nav-links a:hover {
            color: #f0f0f0;
        }
        header .user-actions a {
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            margin-left: 10px;
            border-radius: 5px;
        }
        header .user-actions .login-btn {
            background-color: #0056b3;
        }
        header .user-actions .login-btn:hover {
            background-color: #003d82;
        }
        header .user-actions .register-btn {
            background-color: #555;
        }
        header .user-actions .register-btn:hover {
            background-color: #777;
        }
        aside {
            width: 200px;
            background-color: #333;
            color: white;
            padding: 20px;
            height: 100vh;
        }
        aside h1 {
            font-size: 1.5em;
            margin-bottom: 20px;
        }
        aside button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #555;
            color: white;
            border: none;
            cursor: pointer;
        }
        aside button:hover {
            background-color: #777;
        }
        aside button.active {
            background-color: #007bff;
        }
        main {
            flex-grow: 1;
            padding: 20px;
        }
        section {
            display: none;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
        }
        section.active {
            display: block;
        }
        h2 {
            color: #007bff;
            margin-bottom: 15px;
        }
        article {
            margin-bottom: 20px;
        }
        textarea {
            width: 100%;
            height: 80px;
            margin-bottom: 10px;
            padding: 10px;
        }
        button[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        .comment {
            border-left: 3px solid #007bff;
            padding-left: 10px;
            margin-top: 10px;
        }
        /* Footer Styles */
        .footer {
            background-color: #333;
            color: white;
            padding: 40px 0;
            margin-top: 20px;
        }
        .footer-content {
            max-width: 1000px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .footer-section {
            flex: 1;
            min-width: 200px;
            margin: 10px;
        }
        .footer-section h3 {
            font-size: 1.2em;
            margin-bottom: 15px;
        }
        .footer-section p {
            margin: 5px 0;
        }
        .footer-section ul {
            list-style: none;
            padding: 0;
        }
        .footer-section ul li {
            margin-bottom: 10px;
        }
        .footer-section ul li a {
            color: white;
            text-decoration: none;
        }
        .footer-section ul li a:hover {
            color: #007bff;
        }
        .social-links {
            margin-top: 10px;
        }
        .social-icon {
            color: white;
            margin-right: 10px;
            font-size: 1.2em;
            text-decoration: none;
        }
        .social-icon:hover {
            color: #007bff;
        }
        .footer-bottom {
            text-align: center;
            padding: 10px 0;
            background-color: #222;
            margin-top: 20px;
        }
        .footer-bottom p {
            margin: 0;
            font-size: 0.9em;
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

    <article class="container">
        <!-- Sidebar -->
        <aside>
            <h1>Company Profiles</h1>
            <nav>
                <button class="active" onclick="showScreen('overview')">Overview</button>
                <button onclick="showScreen('reviews')">Reviews</button>
                <button onclick="showScreen('positions')">Jobs</button>
            </nav>
        </aside>

        <!-- Main Content -->
        <main>
            <!-- Employer Overview -->
            <section id="overview" class="active">
                <h2>Employer Overview</h2>
                <p>
                    <strong>Name:</strong> ExampleCorp<br>
                    <strong>Mission:</strong> Innovate with technology.<br>
                    <strong>Industry:</strong> Tech<br>
                    <strong>Culture:</strong> Collaborative and creative.
                </p>
            </section>

            <!-- Employee Reviews -->
            <section id="reviews">
                <h2>Employee Reviews</h2>
                <article>
                    <p><strong>Engineer, 2024</strong>: Great team, flexible hours.</p>
                    <p><strong>Manager, 2023</strong>: Good benefits, high workload.</p>
                </article>
                <article>
                    <h3>Add Comment</h3>
                    <form id="commentForm" onsubmit="submitComment(event)">
                        <textarea id="commentInput" placeholder="Your comment..."></textarea>
                        <button type="submit">Submit</button>
                    </form>
                </article>
                <article id="commentsContainer">
                    <p>No comments yet.</p>
                </article>
            </section>

            <!-- Open Positions -->
            <section id="positions">
                <h2>Open Positions</h2>
                <ul>
                    <li><a href="#">Software Engineer</a> - Remote</li>
                    <li><a href="#">Data Scientist</a> - SF, CA</li>
                </ul>
            </section>
        </main>
    </article>

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

    <script src="company.js"></script>
</body>
</html>