// Login Page JavaScript - Enhanced Version
// Handles tab switching, password toggle, form validation, and UX improvements

document.addEventListener('DOMContentLoaded', function() {
    // ============================================
    // ELEMENTS
    // ============================================
    const applicantBtn = document.getElementById('applicantBtn');
    const employerBtn = document.getElementById('employerBtn');
    const applicantForm = document.getElementById('applicantForm');
    const employerForm = document.getElementById('employerForm');
    const applicantLoginForm = document.getElementById('applicantLoginForm');
    const employerLoginForm = document.getElementById('employerLoginForm');
    
    // Password toggles
    const applicantPasswordToggle = document.getElementById('applicantPasswordToggle');
    const employerPasswordToggle = document.getElementById('employerPasswordToggle');
    const applicantPasswordInput = document.getElementById('applicantPassword');
    const employerPasswordInput = document.getElementById('employerPassword');

    // ============================================
    // USER TYPE TAB SWITCHING
    // ============================================
    
    function switchToApplicant() {
        applicantBtn.classList.add('active');
        employerBtn.classList.remove('active');
        applicantForm.classList.add('active');
        employerForm.classList.remove('active');
        
        // Clear form errors when switching
        clearFormErrors(applicantLoginForm);
    }
    
    function switchToEmployer() {
        employerBtn.classList.add('active');
        applicantBtn.classList.remove('active');
        employerForm.classList.add('active');
        applicantForm.classList.remove('active');
        
        // Clear form errors when switching
        clearFormErrors(employerLoginForm);
    }
    
    if (applicantBtn) {
        applicantBtn.addEventListener('click', switchToApplicant);
    }
    
    if (employerBtn) {
        employerBtn.addEventListener('click', switchToEmployer);
    }

    // ============================================
    // PASSWORD TOGGLE FUNCTIONALITY
    // ============================================
    
    function togglePassword(input, toggleBtn) {
        if (input.type === 'password') {
            input.type = 'text';
            toggleBtn.querySelector('i').classList.remove('fa-eye');
            toggleBtn.querySelector('i').classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            toggleBtn.querySelector('i').classList.remove('fa-eye-slash');
            toggleBtn.querySelector('i').classList.add('fa-eye');
        }
    }
    
    if (applicantPasswordToggle && applicantPasswordInput) {
        applicantPasswordToggle.addEventListener('click', function() {
            togglePassword(applicantPasswordInput, applicantPasswordToggle);
        });
    }
    
    if (employerPasswordToggle && employerPasswordInput) {
        employerPasswordToggle.addEventListener('click', function() {
            togglePassword(employerPasswordInput, employerPasswordToggle);
        });
    }

    // ============================================
    // FORM VALIDATION
    // ============================================
    
    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    function validatePassword(password) {
        return password.length >= 6;
    }
    
    function showFieldError(input, errorElement, message) {
        input.classList.add('error');
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.style.display = 'block';
        }
    }
    
    function clearFieldError(input, errorElement) {
        input.classList.remove('error');
        if (errorElement) {
            errorElement.textContent = '';
            errorElement.style.display = 'none';
        }
    }
    
    function clearFormErrors(form) {
        const inputs = form.querySelectorAll('input');
        inputs.forEach(input => {
            const errorId = input.id + 'Error';
            const errorElement = document.getElementById(errorId);
            clearFieldError(input, errorElement);
        });
    }
    
    // Real-time validation for applicant form
    if (applicantLoginForm) {
        const applicantEmailInput = document.getElementById('applicantEmail');
        const applicantEmailError = document.getElementById('applicantEmailError');
        const applicantPasswordError = document.getElementById('applicantPasswordError');
        
        if (applicantEmailInput) {
            applicantEmailInput.addEventListener('blur', function() {
                const email = this.value.trim();
                if (email && !validateEmail(email)) {
                    showFieldError(this, applicantEmailError, 'Please enter a valid email address');
                } else {
                    clearFieldError(this, applicantEmailError);
                }
            });
            
            applicantEmailInput.addEventListener('input', function() {
                if (this.classList.contains('error') && validateEmail(this.value.trim())) {
                    clearFieldError(this, applicantEmailError);
                }
            });
        }
        
        if (applicantPasswordInput) {
            applicantPasswordInput.addEventListener('blur', function() {
                const password = this.value;
                if (password && !validatePassword(password)) {
                    showFieldError(this, applicantPasswordError, 'Password must be at least 6 characters long');
                } else {
                    clearFieldError(this, applicantPasswordError);
                }
            });
            
            applicantPasswordInput.addEventListener('input', function() {
                if (this.classList.contains('error') && validatePassword(this.value)) {
                    clearFieldError(this, applicantPasswordError);
                }
            });
        }
        
        // Form submission validation
        applicantLoginForm.addEventListener('submit', function(e) {
            let isValid = true;
            const email = applicantEmailInput.value.trim();
            const password = applicantPasswordInput.value;
            
            // Clear previous errors
            clearFormErrors(this);
            
            // Validate email
            if (!email) {
                showFieldError(applicantEmailInput, applicantEmailError, 'Email is required');
                isValid = false;
            } else if (!validateEmail(email)) {
                showFieldError(applicantEmailInput, applicantEmailError, 'Please enter a valid email address');
                isValid = false;
            }
            
            // Validate password
            if (!password) {
                showFieldError(applicantPasswordInput, applicantPasswordError, 'Password is required');
                isValid = false;
            } else if (!validatePassword(password)) {
                showFieldError(applicantPasswordInput, applicantPasswordError, 'Password must be at least 6 characters long');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
                // Scroll to first error
                const firstError = this.querySelector('.error');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            } else {
                // Show loading state but don't disable button (it won't be sent in POST if disabled)
                const submitBtn = this.querySelector('.submit-btn');
                if (submitBtn) {
                    submitBtn.style.opacity = '0.7';
                    submitBtn.style.cursor = 'not-allowed';
                    submitBtn.innerHTML = '<span>Signing in...</span><i class="fas fa-spinner fa-spin"></i>';
                    // Disable after a short delay to allow form submission
                    setTimeout(() => {
                        submitBtn.disabled = true;
                    }, 100);
                }
            }
        });
    }
    
    // Real-time validation for employer form
    if (employerLoginForm) {
        const employerEmailInput = document.getElementById('employerEmail');
        const employerEmailError = document.getElementById('employerEmailError');
        const employerPasswordError = document.getElementById('employerPasswordError');
        
        if (employerEmailInput) {
            employerEmailInput.addEventListener('blur', function() {
                const email = this.value.trim();
                if (email && !validateEmail(email)) {
                    showFieldError(this, employerEmailError, 'Please enter a valid email address');
                } else {
                    clearFieldError(this, employerEmailError);
                }
            });
            
            employerEmailInput.addEventListener('input', function() {
                if (this.classList.contains('error') && validateEmail(this.value.trim())) {
                    clearFieldError(this, employerEmailError);
                }
            });
        }
        
        if (employerPasswordInput) {
            employerPasswordInput.addEventListener('blur', function() {
                const password = this.value;
                if (password && !validatePassword(password)) {
                    showFieldError(this, employerPasswordError, 'Password must be at least 6 characters long');
                } else {
                    clearFieldError(this, employerPasswordError);
                }
            });
            
            employerPasswordInput.addEventListener('input', function() {
                if (this.classList.contains('error') && validatePassword(this.value)) {
                    clearFieldError(this, employerPasswordError);
                }
            });
        }
        
        // Form submission validation
        employerLoginForm.addEventListener('submit', function(e) {
            let isValid = true;
            const email = employerEmailInput.value.trim();
            const password = employerPasswordInput.value;
            
            // Clear previous errors
            clearFormErrors(this);
            
            // Validate email
            if (!email) {
                showFieldError(employerEmailInput, employerEmailError, 'Email is required');
                isValid = false;
            } else if (!validateEmail(email)) {
                showFieldError(employerEmailInput, employerEmailError, 'Please enter a valid email address');
                isValid = false;
            }
            
            // Validate password
            if (!password) {
                showFieldError(employerPasswordInput, employerPasswordError, 'Password is required');
                isValid = false;
            } else if (!validatePassword(password)) {
                showFieldError(employerPasswordInput, employerPasswordError, 'Password must be at least 6 characters long');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
                // Scroll to first error
                const firstError = this.querySelector('.error');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            } else {
                // Show loading state but don't disable button (it won't be sent in POST if disabled)
                const submitBtn = this.querySelector('.submit-btn');
                if (submitBtn) {
                    submitBtn.style.opacity = '0.7';
                    submitBtn.style.cursor = 'not-allowed';
                    submitBtn.innerHTML = '<span>Signing in...</span><i class="fas fa-spinner fa-spin"></i>';
                    // Disable after a short delay to allow form submission
                    setTimeout(() => {
                        submitBtn.disabled = true;
                    }, 100);
                }
            }
        });
    }

    // ============================================
    // AUTO-HIDE ALERT MESSAGES
    // ============================================
    
    const errorAlert = document.getElementById('loginErrorAlert');
    if (errorAlert) {
        setTimeout(() => {
            errorAlert.style.opacity = '0';
            setTimeout(() => {
                errorAlert.remove();
            }, 300);
        }, 5000);
    }

    // ============================================
    // REMEMBER ME FUNCTIONALITY
    // ============================================
    
    // Load saved email if remember me was checked
    const rememberMeCheckboxes = document.querySelectorAll('input[name="remember_me"]');
    rememberMeCheckboxes.forEach(checkbox => {
        const form = checkbox.closest('form');
        const emailInput = form.querySelector('input[type="email"]');
        
        // Check if there's a saved email
        const savedEmail = localStorage.getItem('remembered_email');
        if (savedEmail && emailInput) {
            emailInput.value = savedEmail;
            checkbox.checked = true;
        }
        
        // Save email on form submit if remember me is checked
        form.addEventListener('submit', function() {
            if (checkbox.checked && emailInput.value) {
                localStorage.setItem('remembered_email', emailInput.value);
            } else {
                localStorage.removeItem('remembered_email');
            }
        });
    });

    console.log('Login page JavaScript loaded successfully');
});
