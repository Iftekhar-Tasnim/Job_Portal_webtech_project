<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Profile - Employify</title>
    <link rel="stylesheet" href="../assets/css/nav-footer.css" />
    <link rel="stylesheet" href="../assets/css/profile.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  </head>
  <body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <main class="main-content">
      <div class="container">
        <div class="profile-container">
          <div class="profile-header">
            <div class="profile-image">
                <img
                  src="/assets/123.jpg"
                  alt="Profile Picture"
                  id="profilePic"
                />
            </div>
            <div class="profile-info">
              <h1 id="userName">Iftekhar Tasnim</h1>
              <p id="userRole">Software Developer</p>
              <div class="profile-actions">
                <label for="profilePicInput" class="change-photo-btn">
                  <i class="fas fa-camera"></i>
                  Change Photo
                </label>
              </div>
              <div class="profile-stats">
                <div class="stat-item">
                  <span class="stat-number" id="appliedJobs">12</span>
                  <span class="stat-label">Applied Jobs</span>
                </div>
                <div class="stat-item">
                  <span class="stat-number" id="savedJobs">5</span>
                  <span class="stat-label">Saved Jobs</span>
                </div>
                <div class="stat-item">
                  <span class="stat-number" id="interviews">3</span>
                  <span class="stat-label">Interviews</span>
                </div>
              </div>
            </div>

            <!-- Hidden file input -->
            <input
              type="file"
              id="profilePicInput"
              accept="image/*"
              style="display: none"
            />
          </div>

          <div class="profile-content">
            <div class="profile-sidebar">
              <div class="sidebar-section active" id="dashboard">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
              </div>
              <div class="sidebar-section" id="profile">
                <i class="fas fa-user"></i>
                <span>Profile</span>
              </div>
              <div class="sidebar-section" id="applications">
                <i class="fas fa-file-alt"></i>
                <span>Job Applications</span>
              </div>
              <div class="sidebar-section" id="saved">
                <i class="fas fa-heart"></i>
                <span>Saved Jobs</span>
              </div>
              <div class="sidebar-section" id="settings">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
              </div>
            </div>

            <div class="profile-main">
              <div class="profile-section active" id="applicationTracking">
                <h2>Application Tracking</h2>
                <div class="tracking-filters">
                  <div class="filter-group">
                    <label for="statusFilter">Status:</label>
                    <select id="statusFilter">
                      <option value="all">All</option>
                      <option value="applied">Applied</option>
                      <option value="review">Under Review</option>
                      <option value="interview">Interview</option>
                      <option value="offer">Offer</option>
                    </select>
                  </div>
                  <div class="filter-group">
                    <label for="dateFilter">Date Range:</label>
                    <input type="date" id="dateFilter">
                  </div>
                </div>

                <div class="tracking-actions">
                  <button class="add-reminder-btn">
                    <i class="fas fa-bell"></i>
                    Add Reminder
                  </button>
                  <button class="add-note-btn">
                    <i class="fas fa-sticky-note"></i>
                    Add Note
                  </button>
                </div>

                <div class="tracking-content">
                  <div class="tracking-stats">
                    <div class="stat-item">
                      <span class="stat-number">12</span>
                      <span class="stat-label">Total Applications</span>
                    </div>
                    <div class="stat-item">
                      <span class="stat-number">3</span>
                      <span class="stat-label">Active Interviews</span>
                    </div>
                    <div class="stat-item">
                      <span class="stat-number">5</span>
                      <span class="stat-label">Offers Received</span>
                    </div>
                  </div>

                  <div class="applications-list">
                    <div class="application-card">
                      <div class="app-header">
                        <div class="app-company">
                          <img src="/assets/g.png" alt="Company Logo">
                          <div class="company-info">
                            <h3>Google</h3>
                            <p>Senior Software Engineer</p>
                          </div>
                        </div>
                        <div class="app-status">
                          <span class="status-badge applied">Applied</span>
                          <span class="date">May 1, 2025</span>
                        </div>
                      </div>
                      <div class="app-details">
                        <div class="status-timeline">
                          <div class="timeline-item">
                            <div class="timeline-icon">
                              <i class="fas fa-paper-plane"></i>
                            </div>
                            <div class="timeline-content">
                              <p>Application Submitted</p>
                              <span class="date">May 1, 2025</span>
                            </div>
                          </div>
                          <div class="timeline-item">
                            <div class="timeline-icon">
                              <i class="fas fa-clock"></i>
                            </div>
                            <div class="timeline-content">
                              <p>Waiting for Review</p>
                              <span class="date">May 1-15, 2025</span>
                            </div>
                          </div>
                        </div>
                        <div class="app-actions">
                          <button class="reminder-btn">
                            <i class="fas fa-bell"></i>
                            Set Reminder
                          </button>
                          <button class="note-btn">
                            <i class="fas fa-sticky-note"></i>
                            Add Note
                          </button>
                        </div>
                      </div>
                    </div>

                    <div class="application-card">
                      <div class="app-header">
                        <div class="app-company">
                          <img src="/assets/m.png" alt="Company Logo">
                          <div class="company-info">
                            <h3>Microsoft</h3>
                            <p>Frontend Developer</p>
                          </div>
                        </div>
                        <div class="app-status">
                          <span class="status-badge interview">Interview</span>
                          <span class="date">May 5, 2025</span>
                        </div>
                      </div>
                      <div class="app-details">
                        <div class="status-timeline">
                          <div class="timeline-item">
                            <div class="timeline-icon">
                              <i class="fas fa-paper-plane"></i>
                            </div>
                            <div class="timeline-content">
                              <p>Application Submitted</p>
                              <span class="date">May 5, 2025</span>
                            </div>
                          </div>
                          <div class="timeline-item">
                            <div class="timeline-icon">
                              <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="timeline-content">
                              <p>Technical Interview Scheduled</p>
                              <span class="date">May 10, 2025</span>
                            </div>
                          </div>
                        </div>
                        <div class="app-actions">
                          <button class="reminder-btn">
                            <i class="fas fa-bell"></i>
                            Set Reminder
                          </button>
                          <button class="note-btn">
                            <i class="fas fa-sticky-note"></i>
                            Add Note
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="profile-section" id="profileContent">
                <h2>Profile Information</h2>
                <form class="profile-form">
                  <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input
                      type="text"
                      id="fullName"
                      name="fullName"
                      value="New Name"
                    />
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input
                      type="email"
                      id="email"
                      name="email"
                      value="newemail@example.com"
                    />
                  </div>
                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <input
                      type="tel"
                      id="phone"
                      name="phone"
                      value="+8801711111111"
                    />
                  </div>
                  <div class="form-group">
                    <label for="location">Location</label>
                    <input
                      type="text"
                      id="location"
                      name="location"
                      value="Dhaka, Bangladesh"
                    />
                  </div>
                  <div class="form-group">
                    <label for="summary">Professional Summary</label>
                    <textarea id="summary" name="summary">
Experienced software developer with expertise in frontend development and problem-solving skills.</textarea
                    >
                  </div>
                  <button type="submit" class="save-btn">Save Changes</button>
                </form>
              </div>

              <div class="profile-section" id="applicationsContent">
                <h2>Job Applications</h2>
                <div class="applications-list">
                  <div class="job-item">
                    <div class="job-title">Senior Software Engineer</div>
                    <div class="job-status">Applied</div>
                    <div class="job-date">May 1, 2025</div>
                  </div>
                  <div class="job-item">
                    <div class="job-title">Frontend Developer</div>
                    <div class="job-status">Interview Scheduled</div>
                    <div class="job-date">May 5, 2025</div>
                  </div>
                </div>
              </div>

              <div class="profile-section" id="savedContent">
                <h2>Saved Jobs</h2>
                <div class="saved-jobs-list">
                  <div class="job-item">
                    <div class="job-title">UI/UX Designer</div>
                    <div class="job-status">Saved</div>
                    <div class="job-date">May 3, 2025</div>
                  </div>
                  <div class="job-item">
                    <div class="job-title">Backend Developer</div>
                    <div class="job-status">Saved</div>
                    <div class="job-date">May 4, 2025</div>
                  </div>
                </div>
              </div>

              <div class="profile-section" id="settingsContent">
                <h2>Account Settings</h2>
                <form class="settings-form">
                  <div class="form-group">
                    <label for="password">Change Password</label>
                    <input
                      type="password"
                      id="password"
                      name="password"
                      placeholder="Enter new password"
                    />
                  </div>
                  <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input
                      type="password"
                      id="confirmPassword"
                      name="confirmPassword"
                      placeholder="Confirm new password"
                    />
                  </div>
                  <button type="submit" class="save-btn">
                    Update Settings
                  </button>
                </form>
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
          <p>
            Find your dream job with Employify. Connect with top employers and
            start your career journey today.
          </p>
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

    
    <script src="../assets/js/navbar.js"></script>
    <script src="/js/profile.js"></script>
  </body>
</html>