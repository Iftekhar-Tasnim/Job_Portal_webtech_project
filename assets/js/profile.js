// Profile Page JavaScript - Fully Functional

document.addEventListener('DOMContentLoaded', function() {
    initializeProfile();
    setupSidebarNavigation();
    setupProfilePictureUpload();
    setupFormSubmissions();
    setupStatusFilter();
    setupRemoveJobButtons();
});

// Initialize profile page
function initializeProfile() {
    // Profile is already loaded from PHP, just ensure UI is ready
    console.log('Profile page initialized');
    
    // Handle hash navigation from navbar
    const hash = window.location.hash;
    if (hash) {
        const targetSection = hash.substring(1); // Remove #
        const sidebarSection = document.querySelector(`.sidebar-section[data-section="${targetSection.replace('Section', '')}"]`);
        const contentSection = document.getElementById(targetSection);
        
        if (sidebarSection && contentSection) {
            // Remove active from all sections
            document.querySelectorAll('.sidebar-section').forEach(s => s.classList.remove('active'));
            document.querySelectorAll('.profile-section').forEach(s => s.classList.remove('active'));
            
            // Activate target section
            sidebarSection.classList.add('active');
            contentSection.classList.add('active');
            
            // Scroll to section
            setTimeout(() => {
                const offset = 100;
                const targetPosition = contentSection.offsetTop - offset;
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }, 100);
        }
    }
}

// Sidebar navigation
function setupSidebarNavigation() {
    const sections = document.querySelectorAll('.sidebar-section');
    const contentSections = document.querySelectorAll('.profile-section');
    
    sections.forEach(section => {
        section.addEventListener('click', function() {
            const targetSection = this.dataset.section;
            
            // Update sidebar
            sections.forEach(s => s.classList.remove('active'));
            this.classList.add('active');
            
            // Update content
            contentSections.forEach(c => c.classList.remove('active'));
            const targetContent = document.getElementById(targetSection + 'Section');
            if (targetContent) {
                targetContent.classList.add('active');
            }
        });
    });
}

// Profile picture upload
function setupProfilePictureUpload() {
    const profilePicInput = document.getElementById('profilePicInput');
    const profilePic = document.getElementById('profilePic');
    const changePhotoBtn = document.querySelector('.change-photo-btn');
    
    if (profilePicInput && profilePic && changePhotoBtn) {
        changePhotoBtn.addEventListener('click', function(e) {
            e.preventDefault();
            profilePicInput.click();
        });
        
        profilePicInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validate file type
                if (!file.type.startsWith('image/')) {
                    if (typeof showError === 'function') {
                        showError('Please select an image file');
                    } else {
                        alert('Please select an image file');
                    }
                    return;
                }
                
                // Validate file size (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    if (typeof showError === 'function') {
                        showError('Image size must be less than 2MB');
                    } else {
                        alert('Image size must be less than 2MB');
                    }
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    profilePic.src = e.target.result;
                    // In a real app, you would upload this to the server
                    if (typeof showSuccess === 'function') {
                        showSuccess('Profile picture updated! (Note: This is a preview. Save to upload to server.)');
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    }
}

// Form submissions
function setupFormSubmissions() {
    // Profile form
    const profileForm = document.getElementById('profileForm');
    if (profileForm) {
        profileForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            formData.append('action', 'update_profile');
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalHTML = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
            
            try {
                const response = await fetch('../controller/profile_controller.php', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    if (typeof showSuccess === 'function') {
                        showSuccess(data.message || 'Profile updated successfully!');
                    } else {
                        alert(data.message || 'Profile updated successfully!');
                    }
                } else {
                    if (typeof showError === 'function') {
                        showError(data.error || 'Failed to update profile');
                    } else {
                        alert(data.error || 'Failed to update profile');
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                if (typeof showError === 'function') {
                    showError('An error occurred. Please try again.');
                } else {
                    alert('An error occurred. Please try again.');
                }
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalHTML;
            }
        });
    }
    
    // Settings form
    const settingsForm = document.getElementById('settingsForm');
    if (settingsForm) {
        settingsForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            if (password !== confirmPassword) {
                if (typeof showError === 'function') {
                    showError('Passwords do not match');
                } else {
                    alert('Passwords do not match');
                }
                return;
            }
            
            if (password.length < 6) {
                if (typeof showError === 'function') {
                    showError('Password must be at least 6 characters');
                } else {
                    alert('Password must be at least 6 characters');
                }
                return;
            }
            
            const formData = new FormData(this);
            formData.append('action', 'update_password');
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalHTML = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';
            
            try {
                const response = await fetch('../controller/profile_controller.php', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    if (typeof showSuccess === 'function') {
                        showSuccess(data.message || 'Password updated successfully!');
                    } else {
                        alert(data.message || 'Password updated successfully!');
                    }
                    settingsForm.reset();
                } else {
                    if (typeof showError === 'function') {
                        showError(data.error || 'Failed to update password');
                    } else {
                        alert(data.error || 'Failed to update password');
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                if (typeof showError === 'function') {
                    showError('An error occurred. Please try again.');
                } else {
                    alert('An error occurred. Please try again.');
                }
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalHTML;
            }
        });
    }
}

// Status filter for applications
function setupStatusFilter() {
    const statusFilter = document.getElementById('statusFilter');
    const applicationsList = document.getElementById('applicationsList');
    
    if (statusFilter && applicationsList) {
        statusFilter.addEventListener('change', function() {
            const selectedStatus = this.value;
            const applicationCards = applicationsList.querySelectorAll('.application-card');
            
            applicationCards.forEach(card => {
                if (selectedStatus === 'all' || card.dataset.status === selectedStatus) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }
}

// Remove saved job
function setupRemoveJobButtons() {
    const removeButtons = document.querySelectorAll('.remove-btn');
    
    removeButtons.forEach(btn => {
        btn.addEventListener('click', async function() {
            const jobId = this.dataset.jobId;
            
            if (!confirm('Are you sure you want to remove this saved job?')) {
                return;
            }
            
            const originalHTML = this.innerHTML;
            this.disabled = true;
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Removing...';
            
            try {
                const formData = new FormData();
                formData.append('action', 'unsave_job');
                formData.append('job_id', jobId);
                
                const response = await fetch('../controller/job_actions_controller.php', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Remove from DOM
                    const jobCard = this.closest('.job-card');
                    if (jobCard) {
                        jobCard.style.opacity = '0';
                        setTimeout(() => {
                            jobCard.remove();
                            
                            // Check if list is empty
                            const savedJobsList = document.getElementById('savedJobsList');
                            if (savedJobsList && savedJobsList.querySelectorAll('.job-card').length === 0) {
                                savedJobsList.innerHTML = `
                                    <div class="empty-state">
                                        <i class="fas fa-bookmark"></i>
                                        <p>No saved jobs yet.</p>
                                        <a href="jobs.php" class="btn-primary">Browse Jobs</a>
                                    </div>
                                `;
                            }
                            
                            // Update stats
                            const savedJobsStat = document.getElementById('savedJobs');
                            if (savedJobsStat) {
                                const currentCount = parseInt(savedJobsStat.textContent) || 0;
                                savedJobsStat.textContent = Math.max(0, currentCount - 1);
                            }
                        }, 300);
                    }
                    
                    if (typeof showSuccess === 'function') {
                        showSuccess('Job removed from saved list');
                    } else {
                        alert('Job removed from saved list');
                    }
                } else {
                    this.disabled = false;
                    this.innerHTML = originalHTML;
                    if (typeof showError === 'function') {
                        showError(data.error || 'Failed to remove job');
                    } else {
                        alert(data.error || 'Failed to remove job');
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                this.disabled = false;
                this.innerHTML = originalHTML;
                if (typeof showError === 'function') {
                    showError('An error occurred. Please try again.');
                } else {
                    alert('An error occurred. Please try again.');
                }
            }
        });
    });
}

console.log('Profile JavaScript loaded successfully');
