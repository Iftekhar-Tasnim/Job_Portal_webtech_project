<?php
session_start();
if (!isset($_SESSION['status']) || !isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'applicant') {
    header('Location: login.php');
    exit();
}

require_once '../model/profile_model.php';
require_once '../model/db.php';

$applicant_id = $_SESSION['user_id'];
$profile = getApplicantProfile($applicant_id);
$stats = getApplicationStats($applicant_id);
$applications = getJobApplications($applicant_id);
$savedJobs = getSavedJobs($applicant_id);

// Get default values
$firstName = isset($profile['First_Name']) ? htmlspecialchars($profile['First_Name']) : '';
$lastName = isset($profile['Last_Name']) ? htmlspecialchars($profile['Last_Name']) : '';
$fullName = trim($firstName . ' ' . $lastName);
$email = isset($profile['Email']) ? htmlspecialchars($profile['Email']) : '';
$phone = isset($profile['Phone']) ? htmlspecialchars($profile['Phone']) : '';
$location = isset($profile['Address']) ? htmlspecialchars($profile['Address']) : '';
$summary = ''; // Summary not in database yet
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Employify</title>
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/profile.css">
    <link rel="stylesheet" href="../assets/css/notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <main class="profile-main">
        <div class="profile-container">
            <!-- Profile Header -->
            <div class="profile-header">
                <div class="profile-image">
                    <img src="../assets/default-avatar.png" alt="Profile Picture" id="profilePic" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%22 height=%22100%22%3E%3Ccircle fill=%22%23ddd%22 cx=%2250%22 cy=%2250%22 r=%2250%22/%3E%3Ctext fill=%22%23999%22 x=%2250%22 y=%2250%22 text-anchor=%22middle%22 dy=%22.3em%22 font-size=%2250%22%3E%3C/text%3E%3C/svg%3E'">
                </div>
                <div class="profile-info">
                    <h1 id="userName"><?php echo $fullName ?: 'User'; ?></h1>
                    <p id="userRole">Job Seeker</p>
                    <div class="profile-actions">
                        <label for="profilePicInput" class="change-photo-btn">
                            <i class="fas fa-camera"></i> Change Photo
                        </label>
                    </div>
                    <div class="profile-stats">
                        <div class="stat-item">
                            <span class="stat-number" id="appliedJobs"><?php echo $stats['total']; ?></span>
                            <span class="stat-label">Applied Jobs</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number" id="savedJobs"><?php echo $stats['saved']; ?></span>
                            <span class="stat-label">Saved Jobs</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number" id="interviews"><?php echo $stats['interviews']; ?></span>
                            <span class="stat-label">Interviews</span>
                        </div>
                    </div>
                </div>
                <input type="file" id="profilePicInput" accept="image/*" style="display: none">
            </div>

            <div class="profile-content">
                <!-- Sidebar -->
                <div class="profile-sidebar">
                    <div class="sidebar-section active" data-section="dashboard">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </div>
                    <div class="sidebar-section" data-section="profile">
                        <i class="fas fa-user"></i>
                        <span>Profile</span>
                    </div>
                    <div class="sidebar-section" data-section="applications">
                        <i class="fas fa-file-alt"></i>
                        <span>Applications</span>
                    </div>
                    <div class="sidebar-section" data-section="saved">
                        <i class="fas fa-bookmark"></i>
                        <span>Saved Jobs</span>
                    </div>
                    <div class="sidebar-section" data-section="settings">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="profile-main-content">
                    <!-- Dashboard Section -->
                    <div class="profile-section active" id="dashboardSection">
                        <div class="section-header">
                            <h2><i class="fas fa-tachometer-alt"></i> Dashboard</h2>
                        </div>
                        
                        <div class="stats-grid">
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-briefcase"></i></div>
                                <div class="stat-info">
                                    <span class="stat-value"><?php echo $stats['total']; ?></span>
                                    <span class="stat-label">Total Applications</span>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-eye"></i></div>
                                <div class="stat-info">
                                    <span class="stat-value"><?php echo $stats['review']; ?></span>
                                    <span class="stat-label">Under Review</span>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-calendar-check"></i></div>
                                <div class="stat-info">
                                    <span class="stat-value"><?php echo $stats['interview']; ?></span>
                                    <span class="stat-label">Interviews</span>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-hand-holding-usd"></i></div>
                                <div class="stat-info">
                                    <span class="stat-value"><?php echo $stats['offer']; ?></span>
                                    <span class="stat-label">Offers</span>
                                </div>
                            </div>
                        </div>

                        <div class="recent-section">
                            <h3>Recent Applications</h3>
                            <div class="applications-list">
                                <?php if (empty($applications)): ?>
                                    <div class="empty-state">
                                        <i class="fas fa-inbox"></i>
                                        <p>No applications yet. Start applying to jobs!</p>
                                        <a href="jobs.php" class="btn-primary">Browse Jobs</a>
                                    </div>
                                <?php else: ?>
                                    <?php foreach (array_slice($applications, 0, 5) as $app): ?>
                                        <div class="application-card">
                                            <div class="app-header">
                                                <div class="app-info">
                                                    <h4><?php echo htmlspecialchars($app['title']); ?></h4>
                                                    <p><?php echo htmlspecialchars($app['company']); ?> • <?php echo htmlspecialchars($app['location']); ?></p>
                                                </div>
                                                <span class="status-badge <?php echo htmlspecialchars($app['status']); ?>">
                                                    <?php echo ucfirst($app['status']); ?>
                                                </span>
                                            </div>
                                            <div class="app-footer">
                                                <span class="app-date">Applied: <?php echo date('M j, Y', strtotime($app['applied_date'])); ?></span>
                                                <a href="jobs.php?job=<?php echo $app['job_id']; ?>" class="view-btn">View Job</a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Section -->
                    <div class="profile-section" id="profileSection">
                        <div class="section-header">
                            <h2><i class="fas fa-user"></i> Profile Information</h2>
                        </div>
                        <form class="profile-form" id="profileForm">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="fullName"><i class="fas fa-user"></i> Full Name</label>
                                    <input type="text" id="fullName" name="fullName" value="<?php echo $fullName; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                                    <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="phone"><i class="fas fa-phone"></i> Phone</label>
                                    <input type="tel" id="phone" name="phone" value="<?php echo $phone; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="location"><i class="fas fa-map-marker-alt"></i> Location</label>
                                    <input type="text" id="location" name="location" value="<?php echo $location; ?>">
                                </div>
                            </div>
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                        </form>
                    </div>

                    <!-- Applications Section -->
                    <div class="profile-section" id="applicationsSection">
                        <div class="section-header">
                            <h2><i class="fas fa-file-alt"></i> Job Applications</h2>
                            <div class="filter-controls">
                                <select id="statusFilter">
                                    <option value="all">All Status</option>
                                    <option value="applied">Applied</option>
                                    <option value="review">Under Review</option>
                                    <option value="interview">Interview</option>
                                    <option value="offer">Offer</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>
                        </div>
                        <div class="applications-list" id="applicationsList">
                            <?php if (empty($applications)): ?>
                                <div class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <p>No applications yet.</p>
                                    <a href="jobs.php" class="btn-primary">Browse Jobs</a>
                                </div>
                            <?php else: ?>
                                <?php foreach ($applications as $app): ?>
                                    <div class="application-card" data-status="<?php echo htmlspecialchars($app['status']); ?>">
                                        <div class="app-header">
                                            <div class="app-info">
                                                <h4><?php echo htmlspecialchars($app['title']); ?></h4>
                                                <p><?php echo htmlspecialchars($app['company']); ?> • <?php echo htmlspecialchars($app['location']); ?></p>
                                                <span class="job-type"><?php echo ucfirst(str_replace('-', ' ', $app['job_type'])); ?></span>
                                            </div>
                                            <span class="status-badge <?php echo htmlspecialchars($app['status']); ?>">
                                                <?php echo ucfirst($app['status']); ?>
                                            </span>
                                        </div>
                                        <div class="app-footer">
                                            <span class="app-date">Applied: <?php echo date('M j, Y', strtotime($app['applied_date'])); ?></span>
                                            <a href="jobs.php?job=<?php echo $app['job_id']; ?>" class="view-btn">View Details</a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Saved Jobs Section -->
                    <div class="profile-section" id="savedSection">
                        <div class="section-header">
                            <h2><i class="fas fa-bookmark"></i> Saved Jobs</h2>
                        </div>
                        <div class="saved-jobs-list" id="savedJobsList">
                            <?php if (empty($savedJobs)): ?>
                                <div class="empty-state">
                                    <i class="fas fa-bookmark"></i>
                                    <p>No saved jobs yet.</p>
                                    <a href="jobs.php" class="btn-primary">Browse Jobs</a>
                                </div>
                            <?php else: ?>
                                <?php foreach ($savedJobs as $job): ?>
                                    <div class="job-card">
                                        <div class="job-header">
                                            <div class="job-info">
                                                <h4><?php echo htmlspecialchars($job['title']); ?></h4>
                                                <p><?php echo htmlspecialchars($job['company']); ?> • <?php echo htmlspecialchars($job['location']); ?></p>
                                                <span class="job-type"><?php echo ucfirst(str_replace('-', ' ', $job['job_type'])); ?></span>
                                            </div>
                                        </div>
                                        <div class="job-footer">
                                            <span class="job-date">Saved: <?php echo date('M j, Y', strtotime($job['saved_date'])); ?></span>
                                            <div class="job-actions">
                                                <a href="jobs.php?job=<?php echo $job['job_id']; ?>" class="view-btn">View Job</a>
                                                <button class="remove-btn" data-job-id="<?php echo $job['job_id']; ?>">
                                                    <i class="fas fa-trash"></i> Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Settings Section -->
                    <div class="profile-section" id="settingsSection">
                        <div class="section-header">
                            <h2><i class="fas fa-cog"></i> Account Settings</h2>
                        </div>
                        <form class="settings-form" id="settingsForm">
                            <div class="form-group">
                                <label for="password"><i class="fas fa-lock"></i> New Password</label>
                                <input type="password" id="password" name="password" placeholder="Enter new password">
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword"><i class="fas fa-lock"></i> Confirm Password</label>
                                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm new password">
                            </div>
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-save"></i> Update Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

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
    <script src="../assets/js/notification.js"></script>
    <script src="../assets/js/profile.js"></script>
</body>
</html>
