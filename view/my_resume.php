<?php
session_start();
if(isset($_SESSION['status']) && isset($_SESSION['user_id']) && $_SESSION['user_type'] === 'applicant'){
    require_once '../model/resume_model.php';
    $applicant_id = $_SESSION['user_id'];
    $resume = getResume($applicant_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Resume - Employify</title>
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/resume.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <main class="resume-main">
        <div class="resume-container">
            <!-- Header Section -->
            <div class="resume-header">
                <div class="header-content">
                    <h1><i class="fas fa-file-alt"></i> My Saved Resume</h1>
                    <p>View and manage your saved CV</p>
                </div>
                <div class="header-actions">
                    <a href="resume.php" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit Resume
                    </a>
                    <button class="btn btn-secondary" onclick="window.print()">
                        <i class="fas fa-print"></i> Print
                    </button>
                </div>
            </div>

            <?php if ($resume): ?>
                <!-- Resume Content -->
                <div class="saved-resume-view">
                    <div class="cv-preview">
                        <h1><?php echo htmlspecialchars($resume['full_name']); ?></h1>
                        <?php if (!empty($resume['job_title'])): ?>
                            <p style="font-size: 1.125rem; color: var(--primary-color); margin-bottom: 16px;">
                                <?php echo htmlspecialchars($resume['job_title']); ?>
                            </p>
                        <?php endif; ?>
                        
                        <?php
                        $contactInfo = [];
                        if (!empty($resume['email'])) $contactInfo[] = '<i class="fas fa-envelope"></i> ' . htmlspecialchars($resume['email']);
                        if (!empty($resume['phone'])) $contactInfo[] = '<i class="fas fa-phone"></i> ' . htmlspecialchars($resume['phone']);
                        if (!empty($resume['location'])) $contactInfo[] = '<i class="fas fa-map-marker-alt"></i> ' . htmlspecialchars($resume['location']);
                        if (!empty($resume['website'])) {
                            $websiteUrl = $resume['website'];
                            if (strpos($websiteUrl, 'http://') !== 0 && strpos($websiteUrl, 'https://') !== 0) {
                                $websiteUrl = 'https://' . $websiteUrl;
                            }
                            $contactInfo[] = '<i class="fas fa-globe"></i> <a href="' . htmlspecialchars($websiteUrl) . '" target="_blank">' . htmlspecialchars($resume['website']) . '</a>';
                        }
                        if (!empty($contactInfo)) {
                            echo '<p style="margin-bottom: 24px;">' . implode(' | ', $contactInfo) . '</p>';
                        }
                        ?>
                        
                        <?php if (!empty($resume['summary'])): ?>
                            <h2>Professional Summary</h2>
                            <p><?php echo nl2br(htmlspecialchars($resume['summary'])); ?></p>
                        <?php endif; ?>
                        
                        <?php if (!empty($resume['experience']) && is_array($resume['experience'])): ?>
                            <h2>Work Experience</h2>
                            <?php foreach ($resume['experience'] as $exp): ?>
                                <div class="preview-item">
                                    <h3>
                                        <?php echo htmlspecialchars($exp['title'] ?? ''); ?>
                                        <?php if (!empty($exp['company'])): ?>
                                            - <?php echo htmlspecialchars($exp['company']); ?>
                                        <?php endif; ?>
                                    </h3>
                                    <?php if (!empty($exp['start']) || !empty($exp['end'])): ?>
                                        <p class="preview-meta">
                                            <?php echo htmlspecialchars($exp['start'] ?? 'Present'); ?> - 
                                            <?php echo htmlspecialchars($exp['end'] ?? 'Present'); ?>
                                        </p>
                                    <?php endif; ?>
                                    <?php if (!empty($exp['description'])): ?>
                                        <p><?php echo nl2br(htmlspecialchars($exp['description'])); ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        
                        <?php if (!empty($resume['education']) && is_array($resume['education'])): ?>
                            <h2>Education</h2>
                            <?php foreach ($resume['education'] as $edu): ?>
                                <div class="preview-item">
                                    <h3>
                                        <?php echo htmlspecialchars($edu['degree'] ?? ''); ?>
                                        <?php if (!empty($edu['school'])): ?>
                                            - <?php echo htmlspecialchars($edu['school']); ?>
                                        <?php endif; ?>
                                    </h3>
                                    <?php if (!empty($edu['start']) || !empty($edu['end'])): ?>
                                        <p class="preview-meta">
                                            <?php echo htmlspecialchars($edu['start'] ?? 'Present'); ?> - 
                                            <?php echo htmlspecialchars($edu['end'] ?? 'Present'); ?>
                                        </p>
                                    <?php endif; ?>
                                    <?php if (!empty($edu['description'])): ?>
                                        <p><?php echo nl2br(htmlspecialchars($edu['description'])); ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        
                        <?php if (!empty($resume['skills'])): ?>
                            <h2>Skills</h2>
                            <ul>
                                <?php
                                $skills = explode(',', $resume['skills']);
                                foreach ($skills as $skill) {
                                    $skill = trim($skill);
                                    if ($skill) {
                                        echo '<li>' . htmlspecialchars($skill) . '</li>';
                                    }
                                }
                                ?>
                            </ul>
                        <?php endif; ?>
                        
                        <?php if (!empty($resume['certifications']) && is_array($resume['certifications'])): ?>
                            <h2>Certifications</h2>
                            <?php foreach ($resume['certifications'] as $cert): ?>
                                <div class="preview-item">
                                    <h3>
                                        <?php echo htmlspecialchars($cert['name'] ?? ''); ?>
                                        <?php if (!empty($cert['issuer'])): ?>
                                            - <?php echo htmlspecialchars($cert['issuer']); ?>
                                        <?php endif; ?>
                                    </h3>
                                    <?php if (!empty($cert['date'])): ?>
                                        <p class="preview-meta">Issued: <?php echo htmlspecialchars($cert['date']); ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        
                        <?php if (!empty($resume['languages'])): ?>
                            <h2>Languages</h2>
                            <ul>
                                <?php
                                $languages = explode(',', $resume['languages']);
                                foreach ($languages as $lang) {
                                    $lang = trim($lang);
                                    if ($lang) {
                                        echo '<li>' . htmlspecialchars($lang) . '</li>';
                                    }
                                }
                                ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    
                    <div class="resume-meta">
                        <p><strong>Last Updated:</strong> <?php echo date('F j, Y g:i A', strtotime($resume['updated_at'])); ?></p>
                        <p><strong>Created:</strong> <?php echo date('F j, Y g:i A', strtotime($resume['created_at'])); ?></p>
                    </div>
                </div>
            <?php else: ?>
                <!-- No Resume Found -->
                <div class="no-resume">
                    <div class="no-resume-content">
                        <i class="fas fa-file-alt"></i>
                        <h2>No Resume Found</h2>
                        <p>You haven't created a resume yet. Start building your professional CV now!</p>
                        <a href="resume.php" class="btn btn-primary btn-large">
                            <i class="fas fa-plus"></i> Create Resume
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <!-- Footer -->
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
</body>
</html>
<?php
} else {
    header('location: login.php');
    exit();
}
?>

