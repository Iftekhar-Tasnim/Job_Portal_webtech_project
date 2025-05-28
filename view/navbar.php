<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
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
        <li><a href="resume.php">CV Maker</a></li>
    </ul>
    <div class="user-actions">
        <?php if(isset($_SESSION['status']) && $_SESSION['status'] === true): ?>
            <div class="profile-section">
                <a href="Profile.php" class="profile-link">
                    <div class="profile-picture">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <span class="user-name"><?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Profile'; ?></span>
                </a>
                <a href="logout.php" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        <?php else: ?>
            <a href="login.php" class="login-btn">Login</a>
            <a href="registration.php" class="register-btn">Register</a>
        <?php endif; ?>
    </div>
</nav> 