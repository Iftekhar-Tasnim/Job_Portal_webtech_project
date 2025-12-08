<?php
session_start();
if (!isset($_SESSION['status']) || !isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'employer') {
    header('Location: login.php');
    exit();
}

require_once '../model/company_model.php';
require_once '../model/db.php';

$employer_id = $_SESSION['user_id'];
$profile = getCompanyProfile($employer_id);
$stats = getCompanyStats($employer_id);
$recentJobs = array_slice(getCompanyJobs($employer_id), 0, 5);
$recentApplications = array_slice(getJobApplications($employer_id), 0, 5);

// Get default values
$companyName = isset($profile['Company_Name']) ? htmlspecialchars($profile['Company_Name']) : '';
$email = isset($profile['Email']) ? htmlspecialchars($profile['Email']) : '';
$phone = isset($profile['Company_Phone']) ? htmlspecialchars($profile['Company_Phone']) : '';
$address = isset($profile['Company_Address']) ? htmlspecialchars($profile['Company_Address']) : '';
$businessType = isset($profile['Business_Type']) ? htmlspecialchars($profile['Business_Type']) : '';
$companySize = isset($profile['Company_Size']) ? htmlspecialchars($profile['Company_Size']) : '';
$website = isset($profile['Company_Website']) ? htmlspecialchars($profile['Company_Website']) : '';
$industry = isset($profile['Industry']) ? htmlspecialchars($profile['Industry']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Dashboard - Employify</title>
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/company.css">
    <link rel="stylesheet" href="../assets/css/notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <main class="company-main">
        <div class="company-container">
            <!-- Company Header -->
            <div class="company-header">
                <div class="company-info">
                    <h1><?php echo $companyName ?: 'Company'; ?></h1>
                    <p><?php echo $industry ?: 'Industry'; ?></p>
                    <div class="company-meta">
                        <?php if ($phone): ?><span><i class="fas fa-phone"></i> <?php echo $phone; ?></span><?php endif; ?>
                        <?php if ($email): ?><span><i class="fas fa-envelope"></i> <?php echo $email; ?></span><?php endif; ?>
                        <?php if ($website): ?><span><i class="fas fa-globe"></i> <a href="<?php echo $website; ?>" target="_blank"><?php echo $website; ?></a></span><?php endif; ?>
                    </div>
                </div>
                <div class="company-actions">
                    <a href="post_job.php" class="btn-primary">
                        <i class="fas fa-plus"></i> Post New Job
                    </a>
                </div>
            </div>

            <div class="company-content">
                <!-- Sidebar -->
                <div class="company-sidebar">
                    <div class="sidebar-section active" data-section="dashboard">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </div>
                    <div class="sidebar-section" data-section="profile">
                        <i class="fas fa-building"></i>
                        <span>Company Profile</span>
                    </div>
                    <div class="sidebar-section" data-section="jobs">
                        <i class="fas fa-briefcase"></i>
                        <span>Manage Jobs</span>
                    </div>
                    <div class="sidebar-section" data-section="applications">
                        <i class="fas fa-file-alt"></i>
                        <span>Applications</span>
                    </div>
                    <div class="sidebar-section" data-section="settings">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="company-main-content">
                    <!-- Dashboard Section -->
                    <div class="company-section active" id="dashboardSection">
                        <div class="section-header">
                            <h2><i class="fas fa-tachometer-alt"></i> Dashboard</h2>
                        </div>
                        
                        <div class="stats-grid">
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-briefcase"></i></div>
                                <div class="stat-info">
                                    <span class="stat-value"><?php echo $stats['total_jobs']; ?></span>
                                    <span class="stat-label">Total Jobs</span>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon active"><i class="fas fa-check-circle"></i></div>
                                <div class="stat-info">
                                    <span class="stat-value"><?php echo $stats['active_jobs']; ?></span>
                                    <span class="stat-label">Active Jobs</span>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-users"></i></div>
                                <div class="stat-info">
                                    <span class="stat-value"><?php echo $stats['total_applications']; ?></span>
                                    <span class="stat-label">Applications</span>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-clock"></i></div>
                                <div class="stat-info">
                                    <span class="stat-value"><?php echo $stats['pending_reviews']; ?></span>
                                    <span class="stat-label">Pending Reviews</span>
                                </div>
                            </div>
                        </div>

                        <div class="recent-section">
                            <h3>Recent Jobs</h3>
                            <div class="jobs-list">
                                <?php if (empty($recentJobs)): ?>
                                    <div class="empty-state">
                                        <i class="fas fa-briefcase"></i>
                                        <p>No jobs posted yet. Post your first job!</p>
                                        <a href="post_job.php" class="btn-primary">Post Job</a>
                                    </div>
                                <?php else: ?>
                                    <?php foreach ($recentJobs as $job): ?>
                                        <div class="job-card">
                                            <div class="job-header">
                                                <div class="job-info">
                                                    <h4><?php echo htmlspecialchars($job['title']); ?></h4>
                                                    <p><?php echo htmlspecialchars($job['location']); ?> • <?php echo ucfirst(str_replace('-', ' ', $job['job_type'])); ?></p>
                                                </div>
                                                <span class="status-badge <?php echo htmlspecialchars($job['status']); ?>">
                                                    <?php echo ucfirst($job['status']); ?>
                                                </span>
                                            </div>
                                            <div class="job-footer">
                                                <span class="job-meta"><?php echo $job['application_count']; ?> applications • Posted: <?php echo date('M j, Y', strtotime($job['posted_date'])); ?></span>
                                                <a href="manage_jobs.php?job=<?php echo $job['id']; ?>" class="view-btn">Manage</a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="recent-section">
                            <h3>Recent Applications</h3>
                            <div class="applications-list">
                                <?php if (empty($recentApplications)): ?>
                                    <div class="empty-state">
                                        <i class="fas fa-inbox"></i>
                                        <p>No applications yet.</p>
                                    </div>
                                <?php else: ?>
                                    <?php foreach ($recentApplications as $app): ?>
                                        <div class="application-card">
                                            <div class="app-header">
                                                <div class="app-info">
                                                    <h4><?php echo htmlspecialchars($app['First_Name'] . ' ' . $app['Last_Name']); ?></h4>
                                                    <p><?php echo htmlspecialchars($app['job_title']); ?> • <?php echo htmlspecialchars($app['company']); ?></p>
                                                </div>
                                                <span class="status-badge <?php echo htmlspecialchars($app['status']); ?>">
                                                    <?php echo ucfirst($app['status']); ?>
                                                </span>
                                            </div>
                                            <div class="app-footer">
                                                <span class="app-date">Applied: <?php echo date('M j, Y', strtotime($app['applied_date'])); ?></span>
                                                <a href="view_applications.php?app=<?php echo $app['id']; ?>" class="view-btn">View</a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Section -->
                    <div class="company-section" id="profileSection">
                        <div class="section-header">
                            <h2><i class="fas fa-building"></i> Company Profile</h2>
                        </div>
                        <form class="company-form" id="companyForm">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="companyName"><i class="fas fa-building"></i> Company Name</label>
                                    <input type="text" id="companyName" name="companyName" value="<?php echo $companyName; ?>" required>
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
                                    <label for="website"><i class="fas fa-globe"></i> Website</label>
                                    <input type="text" id="website" name="website" value="<?php echo $website; ?>" placeholder="https://example.com">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address"><i class="fas fa-map-marker-alt"></i> Address</label>
                                <textarea id="address" name="address" rows="2"><?php echo $address; ?></textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="industry"><i class="fas fa-industry"></i> Industry</label>
                                    <input type="text" id="industry" name="industry" value="<?php echo $industry; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="businessType"><i class="fas fa-briefcase"></i> Business Type</label>
                                    <input type="text" id="businessType" name="businessType" value="<?php echo $businessType; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="companySize"><i class="fas fa-users"></i> Company Size</label>
                                <select id="companySize" name="companySize">
                                    <option value="">Select Size</option>
                                    <option value="1-10" <?php echo $companySize === '1-10' ? 'selected' : ''; ?>>1-10 employees</option>
                                    <option value="11-50" <?php echo $companySize === '11-50' ? 'selected' : ''; ?>>11-50 employees</option>
                                    <option value="51-100" <?php echo $companySize === '51-100' ? 'selected' : ''; ?>>51-100 employees</option>
                                    <option value="101-500" <?php echo $companySize === '101-500' ? 'selected' : ''; ?>>101-500 employees</option>
                                    <option value="500+" <?php echo $companySize === '500+' ? 'selected' : ''; ?>>500+ employees</option>
                                </select>
                            </div>
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                        </form>
                    </div>

                    <!-- Jobs Section (redirects to manage_jobs.php) -->
                    <div class="company-section" id="jobsSection">
                        <div class="section-header">
                            <h2><i class="fas fa-briefcase"></i> Manage Jobs</h2>
                            <a href="manage_jobs.php" class="btn-primary">
                                <i class="fas fa-external-link-alt"></i> Go to Manage Jobs
                            </a>
                        </div>
                        <p>Use the "Manage Jobs" page to view, edit, and delete your job postings.</p>
                    </div>

                    <!-- Applications Section (redirects to view_applications.php) -->
                    <div class="company-section" id="applicationsSection">
                        <div class="section-header">
                            <h2><i class="fas fa-file-alt"></i> View Applications</h2>
                            <a href="view_applications.php" class="btn-primary">
                                <i class="fas fa-external-link-alt"></i> Go to Applications
                            </a>
                        </div>
                        <p>Use the "View Applications" page to review and manage applications for your jobs.</p>
                    </div>

                    <!-- Settings Section -->
                    <div class="company-section" id="settingsSection">
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
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Us</h3>
                <p>Email: info@employify.com</p>
                <p>Phone: +8801711111111</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Employify. All rights reserved.</p>
        </div>
    </footer>

    <script src="../assets/js/navbar.js"></script>
    <script src="../assets/js/notification.js"></script>
    <script src="../assets/js/company.js"></script>
</body>
</html>
