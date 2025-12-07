<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Jobs - Employify</title>
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/jobs.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Hero Search Section -->
    <section class="jobs-hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-title">Find Your <span class="title-highlight">Dream Job</span></h1>
                <p class="hero-subtitle">Discover thousands of opportunities from top companies</p>
            </div>
            
            <!-- Advanced Search Bar -->
            <div class="hero-search">
                <div class="search-wrapper">
                    <div class="search-input-group">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" placeholder="Job title, keywords, or company..." autocomplete="off">
                    </div>
                    <div class="search-input-group">
                        <i class="fas fa-map-marker-alt"></i>
                        <input type="text" id="locationInput" placeholder="Location" autocomplete="off">
                    </div>
                    <button id="searchBtn" class="search-btn">
                        <i class="fas fa-search"></i>
                        <span>Search</span>
                    </button>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="hero-stats">
                <div class="stat-item">
                    <div class="stat-number">10,000+</div>
                    <div class="stat-label">Active Jobs</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">5,000+</div>
                    <div class="stat-label">Companies</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">50,000+</div>
                    <div class="stat-label">Job Seekers</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="jobs-container">
        <!-- Filters Section -->
        <div class="filters-section">
            <div class="filters-header">
                <h2><i class="fas fa-filter"></i> Filter Jobs</h2>
                <button id="resetFilters" class="reset-btn">
                    <i class="fas fa-sync-alt"></i>
                    <span>Reset</span>
                </button>
            </div>
            
            <div class="filters-grid">
                <div class="filter-group">
                    <label><i class="fas fa-map-marker-alt"></i> Location</label>
                    <select id="locationFilter">
                        <option value="">All Locations</option>
                        <option value="dhaka">Dhaka</option>
                        <option value="chittagong">Chittagong</option>
                        <option value="sylhet">Sylhet</option>
                        <option value="rajshahi">Rajshahi</option>
                        <option value="khulna">Khulna</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label><i class="fas fa-briefcase"></i> Category</label>
                    <select id="categoryFilter">
                        <option value="">All Categories</option>
                        <option value="it">Information Technology</option>
                        <option value="finance">Finance & Accounting</option>
                        <option value="marketing">Marketing & Sales</option>
                        <option value="hr">Human Resources</option>
                        <option value="design">Design & Creative</option>
                        <option value="education">Education</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label><i class="fas fa-user-graduate"></i> Experience</label>
                    <select id="experienceFilter">
                        <option value="">All Levels</option>
                        <option value="entry">Entry Level</option>
                        <option value="mid">Mid Level (2-5 years)</option>
                        <option value="senior">Senior Level (5+ years)</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label><i class="fas fa-clock"></i> Job Type</label>
                    <select id="jobTypeFilter">
                        <option value="">All Types</option>
                        <option value="full-time">Full Time</option>
                        <option value="part-time">Part Time</option>
                        <option value="contract">Contract</option>
                        <option value="remote">Remote</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Results Section -->
        <div class="results-section">
            <div class="results-header">
                <h2 id="resultsCount">All Jobs</h2>
                <div class="view-toggle">
                    <button class="view-btn active" data-view="grid" title="Grid View">
                        <i class="fas fa-th"></i>
                    </button>
                    <button class="view-btn" data-view="list" title="List View">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>

            <div class="job-list" id="jobList">
                <!-- Job listings will be dynamically added here -->
            </div>

            <!-- Empty State -->
            <div class="empty-state" id="emptyState" style="display: none;">
                <div class="empty-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h3>No jobs found</h3>
                <p>Try adjusting your filters or search terms</p>
            </div>
        </div>
    </div>

    <!-- Job Details Modal -->
    <div id="jobDetailsModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title-section">
                    <h2 id="jobTitle"></h2>
                    <p id="jobCompany" class="job-company-name"></p>
                </div>
                <button class="close" id="closeModal">&times;</button>
            </div>
            <div class="modal-body">
                <div id="jobDetails"></div>
            </div>
            <div class="modal-footer">
                <button id="saveJobBtn" class="btn-secondary">
                    <i class="fas fa-bookmark"></i>
                    <span>Save Job</span>
                </button>
                <button id="applyJobBtn" class="btn-primary">
                    <i class="fas fa-paper-plane"></i>
                    <span>Apply Now</span>
                </button>
            </div>
        </div>
    </div>

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
    <script src="../assets/js/jobs.js"></script>
</body>
</html>
