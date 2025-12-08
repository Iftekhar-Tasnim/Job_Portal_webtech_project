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
                <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'applicant'): ?>
                <li><a href="resume.php">CV Maker</a></li>
                <?php endif; ?>
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

