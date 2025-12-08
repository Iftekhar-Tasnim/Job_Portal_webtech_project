<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<nav class="navbar">
    <div class="nav-container">
        <!-- Logo -->
        <div class="logo">
            <a href="home.php" class="logo-link">
                <div class="logo-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <span class="logo-text">Employify</span>
            </a>
        </div>

        <!-- Navigation Links -->
        <ul class="nav-links" id="navLinks">
            <li><a href="home.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'home.php') ? 'active' : ''; ?>">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a></li>
            <li><a href="jobs.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'jobs.php') ? 'active' : ''; ?>">
                <i class="fas fa-search"></i>
                <span>Find a Job</span>
            </a></li>
            <li><a href="career-resources.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'career-resources.php') ? 'active' : ''; ?>">
                <i class="fas fa-book"></i>
                <span>Resources</span>
            </a></li>
            <li><a href="about.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'about.php') ? 'active' : ''; ?>">
                <i class="fas fa-info-circle"></i>
                <span>About</span>
            </a></li>
            <li><a href="contact.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'contact.php') ? 'active' : ''; ?>">
                <i class="fas fa-envelope"></i>
                <span>Contact</span>
            </a></li>
        </ul>

        <!-- User Actions -->
        <div class="user-actions">
            <?php if(isset($_SESSION['status']) && $_SESSION['status'] === true): ?>
                <!-- Logged In User -->
                <div class="user-menu">
                    <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'applicant'): ?>
                    <a href="resume.php" class="nav-icon-btn" title="CV Maker">
                        <i class="fas fa-file-alt"></i>
                    </a>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'applicant'): ?>
                    <div class="notification-dropdown">
                        <button class="nav-icon-btn" id="notificationBtn" title="Notifications" type="button">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge" id="notificationBadge" style="display: none;">0</span>
                        </button>
                        <div class="notification-panel" id="notificationPanel">
                            <div class="notification-panel-header">
                                <h3>Notifications</h3>
                                <button class="close-panel" onclick="closeNotificationPanel()">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="notification-panel-body" id="notificationList">
                                <div class="notification-empty">
                                    <i class="fas fa-bell-slash"></i>
                                    <p>No new notifications</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="profile-dropdown">
                        <button class="profile-trigger" id="profileTrigger" type="button">
                            <div class="profile-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <span class="profile-name"><?php echo isset($_SESSION['name']) ? htmlspecialchars(substr($_SESSION['name'], 0, 15)) : 'Profile'; ?></span>
                            <i class="fas fa-chevron-down dropdown-arrow"></i>
                        </button>
                        <div class="dropdown-menu" id="profileDropdown">
                            <div class="dropdown-header">
                                <div class="dropdown-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="dropdown-info">
                                    <div class="dropdown-name"><?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'User'; ?></div>
                                    <div class="dropdown-email"><?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?></div>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'applicant'): ?>
                            <a href="Profile.php" class="dropdown-item">
                                <i class="fas fa-user-circle"></i>
                                <span>My Profile</span>
                            </a>
                            <a href="Profile.php#applicationsSection" class="dropdown-item">
                                <i class="fas fa-briefcase"></i>
                                <span>My Applications</span>
                            </a>
                            <a href="Profile.php#savedSection" class="dropdown-item">
                                <i class="fas fa-bookmark"></i>
                                <span>Saved Jobs</span>
                            </a>
                            <a href="resume.php" class="dropdown-item">
                                <i class="fas fa-file-alt"></i>
                                <span>My Resume</span>
                            </a>
                            <?php elseif(isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'employer'): ?>
                            <a href="company_profile.php" class="dropdown-item">
                                <i class="fas fa-building"></i>
                                <span>Company Dashboard</span>
                            </a>
                            <a href="post_job.php" class="dropdown-item">
                                <i class="fas fa-plus"></i>
                                <span>Post New Job</span>
                            </a>
                            <a href="manage_jobs.php" class="dropdown-item">
                                <i class="fas fa-briefcase"></i>
                                <span>Manage Jobs</span>
                            </a>
                            <a href="view_applications.php" class="dropdown-item">
                                <i class="fas fa-file-alt"></i>
                                <span>View Applications</span>
                            </a>
                            <?php endif; ?>
                            <div class="dropdown-divider"></div>
                            <a href="logout.php" class="dropdown-item logout-item">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <!-- Guest User -->
                <div class="guest-actions">
                    <a href="login.php" class="btn-nav btn-login">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Login</span>
                    </a>
                    <a href="registration.php" class="btn-nav btn-register">
                        <i class="fas fa-user-plus"></i>
                        <span>Register</span>
                    </a>
                </div>
            <?php endif; ?>

            <!-- Mobile Menu Toggle -->
            <button class="mobile-menu-toggle" id="mobileMenuToggle" type="button" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-header">
            <?php if(isset($_SESSION['status']) && $_SESSION['status'] === true): ?>
                <div class="mobile-profile">
                    <div class="mobile-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="mobile-user-info">
                        <div class="mobile-user-name"><?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'User'; ?></div>
                        <div class="mobile-user-email"><?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?></div>
                    </div>
                </div>
            <?php else: ?>
                <div class="mobile-guest">
                    <h3>Welcome to Employify</h3>
                    <p>Sign in to access all features</p>
                </div>
            <?php endif; ?>
        </div>
        <ul class="mobile-nav-links">
            <li><a href="home.php" class="mobile-nav-link">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a></li>
            <li><a href="jobs.php" class="mobile-nav-link">
                <i class="fas fa-search"></i>
                <span>Find a Job</span>
            </a></li>
            <li><a href="career-resources.php" class="mobile-nav-link">
                <i class="fas fa-book"></i>
                <span>Career Resources</span>
            </a></li>
            <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'applicant'): ?>
            <li><a href="resume.php" class="mobile-nav-link">
                <i class="fas fa-file-alt"></i>
                <span>CV Maker</span>
            </a></li>
            <?php endif; ?>
            <li><a href="about.php" class="mobile-nav-link">
                <i class="fas fa-info-circle"></i>
                <span>About</span>
            </a></li>
            <li><a href="contact.php" class="mobile-nav-link">
                <i class="fas fa-envelope"></i>
                <span>Contact</span>
            </a></li>
        </ul>
        <div class="mobile-menu-footer">
            <?php if(isset($_SESSION['status']) && $_SESSION['status'] === true): ?>
                <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'applicant'): ?>
                <a href="Profile.php" class="mobile-btn">
                    <i class="fas fa-user-circle"></i>
                    <span>My Profile</span>
                </a>
                <?php elseif(isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'employer'): ?>
                <a href="company_profile.php" class="mobile-btn">
                    <i class="fas fa-building"></i>
                    <span>Company Dashboard</span>
                </a>
                <?php endif; ?>
                <a href="logout.php" class="mobile-btn mobile-btn-logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            <?php else: ?>
                <a href="login.php" class="mobile-btn">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Login</span>
                </a>
                <a href="registration.php" class="mobile-btn mobile-btn-primary">
                    <i class="fas fa-user-plus"></i>
                    <span>Register</span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>
