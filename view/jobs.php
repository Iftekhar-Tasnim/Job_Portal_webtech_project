<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Jobs - Job Portal</title>
    
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/jobs.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header>
        <?php include 'navbar.php'; ?>

    <!-- Main Content -->
    <div class="job-container">
        <div class="job-header">
            <h1>Job Listings</h1>
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Search jobs...">
                <button id="searchBtn"><i class="fas fa-search"></i></button>
            </div>
        </div>

        <div class="filters">
            <div class="filter-group">
                <label>Location:</label>
                <select id="locationFilter">
                    <option value="">All Locations</option>
                    <option value="dhaka">Dhaka</option>
                    <option value="chittagong">Chittagong</option>
                    <option value="sylhet">Sylhet</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Category:</label>
                <select id="categoryFilter">
                    <option value="">All Categories</option>
                    <option value="it">Information Technology</option>
                    <option value="finance">Finance</option>
                    <option value="marketing">Marketing</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Experience:</label>
                <select id="experienceFilter">
                    <option value="">All Levels</option>
                    <option value="entry">Entry Level</option>
                    <option value="mid">Mid Level</option>
                    <option value="senior">Senior Level</option>
                </select>
            </div>
            <div class="filter-group reset-group">
                <button id="resetFilters" class="reset-btn">
                    <i class="fas fa-sync-alt"></i> Reset Filters
                </button>
            </div>
        </div>

        <div class="job-list" id="jobList">
            <!-- Job listings will be dynamically added here -->
            <div class="job-card-template" style="display: none;">
                <div class="job-header">
                    <h3 class="job-title"></h3>
                    <span class="job-company"></span>
                </div>
                <div class="job-info">
                    <span class="job-location"></span>
                    <span class="job-category"></span>
                    <span class="job-experience"></span>
                </div>
                <div class="job-actions">
                    <button class="apply-btn">Apply Now</button>
                    <button class="save-btn"><i class="fas fa-bookmark"></i> Save Job</button>
                </div>
            </div>
        </div>
    </div>

    <div id="jobDetailsModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="jobTitle"></h2>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <div id="jobDetails"></div>
                <button id="saveJobBtn" class="save-btn"><i class="fas fa-bookmark"></i> Save Job</button>
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
            <p>&copy; <?php echo date('Y'); ?> Employify. All rights reserved.</p>
        </div>
    </footer>

    
    <script src="../assets/js/jobs.js"></script>
</body>
</html>