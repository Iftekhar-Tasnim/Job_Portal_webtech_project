<?php
session_start();
if(isset($_SESSION['status'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Builder - Employify</title>
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
                    <h1><i class="fas fa-file-alt"></i> CV Builder</h1>
                    <p>Create a professional CV that stands out to employers</p>
                </div>
                <div class="header-actions">
                    <a href="my_resume.php" class="btn btn-secondary">
                        <i class="fas fa-file-alt"></i> View Saved
                    </a>
                    <button class="btn btn-secondary" id="previewBtn">
                        <i class="fas fa-eye"></i> Preview
                    </button>
                    <button class="btn btn-primary" id="exportBtn">
                        <i class="fas fa-download"></i> Export PDF
                    </button>
                </div>
            </div>

            <!-- Progress Section -->
            <div class="progress-section">
                <div class="progress-info">
                    <span class="progress-label">Profile Completeness</span>
                    <span class="progress-percentage" id="progressPercentage">0%</span>
                </div>
                <div class="progress-bar-wrapper">
                    <div class="progress-bar" id="progressBar">
                        <div class="progress-fill" id="progressFill"></div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="resume-content">
                <!-- Form Section -->
                <div class="form-section">
                    <form id="resumeForm" class="resume-form">
                        <!-- Personal Information -->
                        <div class="form-section-card">
                            <div class="card-header">
                                <i class="fas fa-user"></i>
                                <h2>Personal Information</h2>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="fullName">
                                            <i class="fas fa-user"></i> Full Name <span class="required">*</span>
                                        </label>
                                        <input type="text" id="fullName" name="fullName" placeholder="John Doe" required>
                                        <span class="error-message" id="fullNameError"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="jobTitle">
                                            <i class="fas fa-briefcase"></i> Job Title
                                        </label>
                                        <input type="text" id="jobTitle" name="jobTitle" placeholder="Software Developer">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="email">
                                            <i class="fas fa-envelope"></i> Email <span class="required">*</span>
                                        </label>
                                        <input type="email" id="email" name="email" placeholder="john.doe@example.com" required>
                                        <span class="error-message" id="emailError"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">
                                            <i class="fas fa-phone"></i> Phone
                                        </label>
                                        <input type="tel" id="phone" name="phone" placeholder="+1 234 567 8900">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="location">
                                            <i class="fas fa-map-marker-alt"></i> Location
                                        </label>
                                        <input type="text" id="location" name="location" placeholder="City, Country">
                                    </div>
                                    <div class="form-group">
                                        <label for="website">
                                            <i class="fas fa-globe"></i> Website/Portfolio
                                        </label>
                                        <input type="text" id="website" name="website" placeholder="https://yourwebsite.com or yourwebsite.com">
                                        <span class="error-message" id="websiteError"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="summary">
                                        <i class="fas fa-align-left"></i> Professional Summary
                                    </label>
                                    <textarea id="summary" name="summary" rows="4" placeholder="Write a brief summary of your professional background and key strengths..."></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Work Experience -->
                        <div class="form-section-card">
                            <div class="card-header">
                                <i class="fas fa-briefcase"></i>
                                <h2>Work Experience</h2>
                                <button type="button" class="btn-add" id="addExperienceBtn">
                                    <i class="fas fa-plus"></i> Add Experience
                                </button>
                            </div>
                            <div class="card-body" id="experienceContainer">
                                <!-- Experience items will be added here dynamically -->
                            </div>
                        </div>

                        <!-- Education -->
                        <div class="form-section-card">
                            <div class="card-header">
                                <i class="fas fa-graduation-cap"></i>
                                <h2>Education</h2>
                                <button type="button" class="btn-add" id="addEducationBtn">
                                    <i class="fas fa-plus"></i> Add Education
                                </button>
                            </div>
                            <div class="card-body" id="educationContainer">
                                <!-- Education items will be added here dynamically -->
                            </div>
                        </div>

                        <!-- Skills -->
                        <div class="form-section-card">
                            <div class="card-header">
                                <i class="fas fa-tools"></i>
                                <h2>Skills</h2>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="skills">
                                        <i class="fas fa-tags"></i> Skills (comma-separated)
                                    </label>
                                    <input type="text" id="skills" name="skills" placeholder="JavaScript, Python, React, Node.js">
                                    <small class="field-hint">Separate skills with commas</small>
                                </div>
                            </div>
                        </div>

                        <!-- Certifications -->
                        <div class="form-section-card">
                            <div class="card-header">
                                <i class="fas fa-certificate"></i>
                                <h2>Certifications</h2>
                                <button type="button" class="btn-add" id="addCertificationBtn">
                                    <i class="fas fa-plus"></i> Add Certification
                                </button>
                            </div>
                            <div class="card-body" id="certificationContainer">
                                <!-- Certification items will be added here dynamically -->
                            </div>
                        </div>

                        <!-- Languages -->
                        <div class="form-section-card">
                            <div class="card-header">
                                <i class="fas fa-language"></i>
                                <h2>Languages</h2>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="languages">
                                        <i class="fas fa-comments"></i> Languages (comma-separated)
                                    </label>
                                    <input type="text" id="languages" name="languages" placeholder="English (Fluent), Spanish (Intermediate)">
                                    <small class="field-hint">Format: Language (Proficiency Level)</small>
                                </div>
                            </div>
                        </div>

                        <!-- Resume Upload -->
                        <div class="form-section-card">
                            <div class="card-header">
                                <i class="fas fa-upload"></i>
                                <h2>Upload Existing Resume</h2>
                            </div>
                            <div class="card-body">
                                <div class="upload-area" id="dropZone">
                                    <div class="upload-content">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                        <p>Drag and drop your resume here</p>
                                        <p class="upload-hint">or click to browse</p>
                                        <small>Supports PDF, DOC, DOCX (Max 5MB)</small>
                                    </div>
                                    <input type="file" id="resumeFile" accept=".pdf,.doc,.docx" style="display: none;">
                                </div>
                                <div class="upload-status" id="uploadStatus"></div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-large">
                                <i class="fas fa-save"></i> Save Resume
                            </button>
                            <button type="button" class="btn btn-secondary btn-large" id="resetBtn">
                                <i class="fas fa-redo"></i> Reset Form
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Preview Section -->
                <div class="preview-section" id="previewSection">
                    <div class="preview-header">
                        <h3><i class="fas fa-eye"></i> Live Preview</h3>
                        <button class="btn-close-preview" id="closePreviewBtn">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="preview-content" id="previewContent">
                        <div class="cv-preview">
                            <!-- CV preview will be generated here -->
                        </div>
                    </div>
                </div>
            </div>
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
    <script src="../assets/js/resume.js"></script>
</body>
</html>
<?php
} else {
    header('location: login.php');
    exit();
}
?>
