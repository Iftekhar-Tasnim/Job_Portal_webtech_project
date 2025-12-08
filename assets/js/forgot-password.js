// Forgot Password JavaScript - Fully Functional
document.addEventListener('DOMContentLoaded', function() {
    const emailForm = document.getElementById('emailForm');
    const resetPasswordForm = document.getElementById('resetPasswordForm');
    const backToEmailLink = document.getElementById('backToEmailLink');
    const togglePasswordIcons = document.querySelectorAll('.toggle-password');
    
    const API_URL = '../controller/password_reset_controller.php';
    
    let currentEmail = '';
    let currentUserType = '';

    // Password visibility toggle
    togglePasswordIcons.forEach(icon => {
        icon.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    });

    // Email verification form
    emailForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const email = document.getElementById('email').value.trim();
        const emailError = document.getElementById('emailError');
        const submitBtn = this.querySelector('button[type="submit"]');

        hideError(emailError);

        if (!isValidEmail(email)) {
            showError(emailError, 'Please enter a valid email address.');
            return;
        }

        // Show loading state
        const originalHTML = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Verifying...';

        try {
            const formData = new FormData();
            formData.append('action', 'check_email');
            formData.append('email', email);

            const response = await fetch(API_URL, {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                currentEmail = email;
                currentUserType = data.user_type;
                
                // Store email and user type in hidden fields
                document.getElementById('userEmail').value = email;
                document.getElementById('userType').value = data.user_type;
                
                // Show user info
                const userInfo = document.getElementById('userInfo');
                const userName = document.getElementById('userName');
                userName.textContent = data.name || email;
                userInfo.style.display = 'block';
                
                // Move to next step
                showStep(2);
                
                if (typeof showSuccess === 'function') {
                    showSuccess('Email verified successfully!');
                }
            } else {
                showError(emailError, data.error || 'Email not found in our system.');
            }
        } catch (error) {
            console.error('Error:', error);
            showError(emailError, 'An error occurred. Please try again.');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalHTML;
        }
    });

    // Reset password form
    resetPasswordForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const newPassword = document.getElementById('newPassword').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        const passwordError = document.getElementById('passwordError');
        const confirmPasswordError = document.getElementById('confirmPasswordError');
        const submitBtn = this.querySelector('button[type="submit"]');

        hideError(passwordError);
        hideError(confirmPasswordError);

        // Validation
        if (newPassword.length < 6) {
            showError(passwordError, 'Password must be at least 6 characters long.');
            return;
        }

        if (newPassword !== confirmPassword) {
            showError(confirmPasswordError, 'Passwords do not match.');
            return;
        }

        // Show loading state
        const originalHTML = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Resetting...';

        try {
            const formData = new FormData();
            formData.append('action', 'reset_password');
            formData.append('email', currentEmail);
            formData.append('new_password', newPassword);
            formData.append('confirm_password', confirmPassword);
            formData.append('user_type', currentUserType);

            const response = await fetch(API_URL, {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                if (typeof showSuccess === 'function') {
                    showSuccess(data.message || 'Password reset successfully!');
                } else {
                    alert(data.message || 'Password reset successfully!');
                }
                
                // Redirect to login after 2 seconds
                setTimeout(() => {
                    window.location.href = 'login.php';
                }, 2000);
            } else {
                showError(passwordError, data.error || 'Failed to reset password. Please try again.');
            }
        } catch (error) {
            console.error('Error:', error);
            showError(passwordError, 'An error occurred. Please try again.');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalHTML;
        }
    });

    // Back to email link
    backToEmailLink.addEventListener('click', function(e) {
        e.preventDefault();
        showStep(1);
        // Clear password fields
        document.getElementById('newPassword').value = '';
        document.getElementById('confirmPassword').value = '';
        document.getElementById('userInfo').style.display = 'none';
    });

    function showStep(stepNumber) {
        document.querySelectorAll('.form').forEach(form => {
            form.classList.remove('active');
        });

        document.querySelectorAll('.step').forEach((step, index) => {
            if (index + 1 <= stepNumber) {
                step.classList.add('active');
            } else {
                step.classList.remove('active');
            }
        });

        if (stepNumber === 1) {
            emailForm.classList.add('active');
        } else if (stepNumber === 2) {
            resetPasswordForm.classList.add('active');
        }
    }

    function isValidEmail(email) {
        if (!email || typeof email !== 'string') return false;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function showError(element, message) {
        element.textContent = message;
        element.classList.add('visible');
    }

    function hideError(element) {
        element.textContent = '';
        element.classList.remove('visible');
    }
});
