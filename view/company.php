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
    <link rel="stylesheet" href="../assets/css/company.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <h1>Employify</h1>
            </div>
            <ul class="nav-links">
                <li><a href="home.php">Home</a></li>
                <li><a href="jobs.php">Find a Job</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="career-resources.php">Career Resources</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="cv-maker.php">CV Maker</a></li>
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

    <script src="company.js"></script>
</body>
</html>