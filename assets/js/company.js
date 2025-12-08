// Company Pages JavaScript - Fully Functional

document.addEventListener('DOMContentLoaded', function() {
    initializeCompany();
    setupSidebarNavigation();
    setupFormSubmissions();
});

// Initialize company page
function initializeCompany() {
    console.log('Company page initialized');
}

// Sidebar navigation
function setupSidebarNavigation() {
    const sections = document.querySelectorAll('.sidebar-section');
    const contentSections = document.querySelectorAll('.company-section');
    
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

// Form submissions
function setupFormSubmissions() {
    // Company profile form
    const companyForm = document.getElementById('companyForm');
    if (companyForm) {
        companyForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            formData.append('action', 'update_profile');
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalHTML = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
            
            try {
                const response = await fetch('../controller/company_controller.php', {
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
                const response = await fetch('../controller/company_controller.php', {
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

console.log('Company JavaScript loaded successfully');
