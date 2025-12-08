// Registration Page JavaScript - Comprehensive Version
// Handles tab switching, password toggle, form validation, and UX improvements

document.addEventListener('DOMContentLoaded', function() {
    // ============================================
    // ELEMENTS
    // ============================================
    const applicantTypeBtn = document.getElementById('applicantTypeBtn');
    const employerTypeBtn = document.getElementById('employerTypeBtn');
    const applicantForm = document.getElementById('applicantForm');
    const employerForm = document.getElementById('employerForm');
    const applicantRegistrationForm = document.getElementById('applicantRegistrationForm');
    const employerRegistrationForm = document.getElementById('employerRegistrationForm');

    // ============================================
    // USER TYPE TAB SWITCHING
    // ============================================
    
    function switchToApplicant() {
        applicantTypeBtn.classList.add('active');
        employerTypeBtn.classList.remove('active');
        applicantForm.classList.add('active');
        employerForm.classList.remove('active');
        
        // Clear form errors when switching
        clearFormErrors(applicantRegistrationForm);
    }
    
    function switchToEmployer() {
        employerTypeBtn.classList.add('active');
        applicantTypeBtn.classList.remove('active');
        employerForm.classList.add('active');
        applicantForm.classList.remove('active');
        
        // Clear form errors when switching
        clearFormErrors(employerRegistrationForm);
    }
    
    if (applicantTypeBtn) {
        applicantTypeBtn.addEventListener('click', switchToApplicant);
    }
    
    if (employerTypeBtn) {
        employerTypeBtn.addEventListener('click', switchToEmployer);
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
    
    // Applicant password toggles
    const applicantPasswordToggle = document.getElementById('applicantPasswordToggle');
    const applicantPasswordInput = document.getElementById('applicant-password');
    const applicantConfirmPasswordToggle = document.getElementById('applicantConfirmPasswordToggle');
    const applicantConfirmPasswordInput = document.getElementById('applicant-confirm-password');
    
    if (applicantPasswordToggle && applicantPasswordInput) {
        applicantPasswordToggle.addEventListener('click', function() {
            togglePassword(applicantPasswordInput, applicantPasswordToggle);
        });
    }
    
    if (applicantConfirmPasswordToggle && applicantConfirmPasswordInput) {
        applicantConfirmPasswordToggle.addEventListener('click', function() {
            togglePassword(applicantConfirmPasswordInput, applicantConfirmPasswordToggle);
        });
    }
    
    // Employer password toggles
    const employerPasswordToggle = document.getElementById('employerPasswordToggle');
    const employerPasswordInput = document.getElementById('employer-password');
    const employerConfirmPasswordToggle = document.getElementById('employerConfirmPasswordToggle');
    const employerConfirmPasswordInput = document.getElementById('employer-confirm-password');
    
    if (employerPasswordToggle && employerPasswordInput) {
        employerPasswordToggle.addEventListener('click', function() {
            togglePassword(employerPasswordInput, employerPasswordToggle);
        });
    }
    
    if (employerConfirmPasswordToggle && employerConfirmPasswordInput) {
        employerConfirmPasswordToggle.addEventListener('click', function() {
            togglePassword(employerConfirmPasswordInput, employerConfirmPasswordToggle);
        });
    }

    // ============================================
    // VALIDATION FUNCTIONS
    // ============================================
    
    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    function validatePassword(password) {
        return password.length >= 8;
    }
    
    function validatePhone(phone) {
        const phoneRegex = /^[\d\s\-\+\(\)]+$/;
        return phoneRegex.test(phone) && phone.replace(/\D/g, '').length >= 10;
    }
    
    function validateURL(url) {
        try {
            new URL(url);
            return true;
        } catch {
        return false;
        }
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
        const inputs = form.querySelectorAll('input, select');
        inputs.forEach(input => {
            const errorId = input.id + 'Error';
            const errorElement = document.getElementById(errorId);
            clearFieldError(input, errorElement);
        });
    }

    // ============================================
    // APPLICANT FORM VALIDATION
    // ============================================
    
    if (applicantRegistrationForm) {
        const firstNameInput = document.getElementById('applicant-first-name');
        const lastNameInput = document.getElementById('applicant-last-name');
        const emailInput = document.getElementById('applicant-email');
        const phoneInput = document.getElementById('applicant-phone');
        const addressInput = document.getElementById('applicant-address');
        const genderSelect = document.getElementById('applicant-gender');
        const passwordInput = applicantPasswordInput;
        const confirmPasswordInput = applicantConfirmPasswordInput;
        
        // Real-time validation
        if (firstNameInput) {
            firstNameInput.addEventListener('blur', function() {
                if (!this.value.trim()) {
                    showFieldError(this, document.getElementById('applicantFirstNameError'), 'First name is required');
                } else {
                    clearFieldError(this, document.getElementById('applicantFirstNameError'));
                }
            });
        }
        
        if (lastNameInput) {
            lastNameInput.addEventListener('blur', function() {
                if (!this.value.trim()) {
                    showFieldError(this, document.getElementById('applicantLastNameError'), 'Last name is required');
                } else {
                    clearFieldError(this, document.getElementById('applicantLastNameError'));
                }
            });
        }
        
        if (emailInput) {
            emailInput.addEventListener('blur', function() {
                const email = this.value.trim();
                if (!email) {
                    showFieldError(this, document.getElementById('applicantEmailError'), 'Email is required');
                } else if (!validateEmail(email)) {
                    showFieldError(this, document.getElementById('applicantEmailError'), 'Please enter a valid email address');
                } else {
                    clearFieldError(this, document.getElementById('applicantEmailError'));
                }
            });
        }
        
        if (phoneInput) {
            phoneInput.addEventListener('blur', function() {
                const phone = this.value.trim();
                if (!phone) {
                    showFieldError(this, document.getElementById('applicantPhoneError'), 'Phone number is required');
                } else if (!validatePhone(phone)) {
                    showFieldError(this, document.getElementById('applicantPhoneError'), 'Please enter a valid phone number');
                } else {
                    clearFieldError(this, document.getElementById('applicantPhoneError'));
                }
            });
        }
        
        if (passwordInput) {
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                const confirmPassword = confirmPasswordInput.value;
                
                if (password && !validatePassword(password)) {
                    showFieldError(this, document.getElementById('applicantPasswordError'), 'Password must be at least 8 characters long');
                } else {
                    clearFieldError(this, document.getElementById('applicantPasswordError'));
                }
                
                // Check password match
                if (confirmPassword && password !== confirmPassword) {
                    showFieldError(confirmPasswordInput, document.getElementById('applicantConfirmPasswordError'), 'Passwords do not match');
                } else if (confirmPassword) {
                    clearFieldError(confirmPasswordInput, document.getElementById('applicantConfirmPasswordError'));
                }
            });
        }
        
        if (confirmPasswordInput) {
            confirmPasswordInput.addEventListener('blur', function() {
                const password = passwordInput.value;
                const confirmPassword = this.value;
                
                if (!confirmPassword) {
                    showFieldError(this, document.getElementById('applicantConfirmPasswordError'), 'Please confirm your password');
                } else if (password !== confirmPassword) {
                    showFieldError(this, document.getElementById('applicantConfirmPasswordError'), 'Passwords do not match');
                } else {
                    clearFieldError(this, document.getElementById('applicantConfirmPasswordError'));
                }
            });
        }
        
        // Form submission validation
        applicantRegistrationForm.addEventListener('submit', function(e) {
            let isValid = true;
            clearFormErrors(this);
            
            // Validate all fields
            if (!firstNameInput.value.trim()) {
                showFieldError(firstNameInput, document.getElementById('applicantFirstNameError'), 'First name is required');
                isValid = false;
            }
            
            if (!lastNameInput.value.trim()) {
                showFieldError(lastNameInput, document.getElementById('applicantLastNameError'), 'Last name is required');
                isValid = false;
            }
            
            const email = emailInput.value.trim();
            if (!email) {
                showFieldError(emailInput, document.getElementById('applicantEmailError'), 'Email is required');
                isValid = false;
            } else if (!validateEmail(email)) {
                showFieldError(emailInput, document.getElementById('applicantEmailError'), 'Please enter a valid email address');
                isValid = false;
            }
            
            const phone = phoneInput.value.trim();
            if (!phone) {
                showFieldError(phoneInput, document.getElementById('applicantPhoneError'), 'Phone number is required');
                isValid = false;
            } else if (!validatePhone(phone)) {
                showFieldError(phoneInput, document.getElementById('applicantPhoneError'), 'Please enter a valid phone number');
                isValid = false;
            }
            
            if (!addressInput.value.trim()) {
                showFieldError(addressInput, document.getElementById('applicantAddressError'), 'Address is required');
                isValid = false;
            }
            
            if (!genderSelect.value) {
                showFieldError(genderSelect, document.getElementById('applicantGenderError'), 'Please select your gender');
                isValid = false;
            }
            
            const password = passwordInput.value;
            if (!password) {
                showFieldError(passwordInput, document.getElementById('applicantPasswordError'), 'Password is required');
                isValid = false;
            } else if (!validatePassword(password)) {
                showFieldError(passwordInput, document.getElementById('applicantPasswordError'), 'Password must be at least 8 characters long');
                isValid = false;
            }
            
            const confirmPassword = confirmPasswordInput.value;
            if (!confirmPassword) {
                showFieldError(confirmPasswordInput, document.getElementById('applicantConfirmPasswordError'), 'Please confirm your password');
                isValid = false;
            } else if (password !== confirmPassword) {
                showFieldError(confirmPasswordInput, document.getElementById('applicantConfirmPasswordError'), 'Passwords do not match');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
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
                    submitBtn.innerHTML = '<span>Creating account...</span><i class="fas fa-spinner fa-spin"></i>';
                    // Disable after a short delay to allow form submission
                    setTimeout(() => {
                        submitBtn.disabled = true;
                    }, 100);
                }
            }
        });
    }

    // ============================================
    // EMPLOYER FORM VALIDATION
    // ============================================
    
    if (employerRegistrationForm) {
        const companyNameInput = document.getElementById('employer-company-name');
        const emailInput = document.getElementById('employer-email');
        const phoneInput = document.getElementById('employer-phone');
        const addressInput = document.getElementById('employer-address');
        const industrySelect = document.getElementById('employer-industry');
        const websiteInput = document.getElementById('employer-website');
        const passwordInput = employerPasswordInput;
        const confirmPasswordInput = employerConfirmPasswordInput;
        
        // Real-time validation
        if (emailInput) {
            emailInput.addEventListener('blur', function() {
                const email = this.value.trim();
                if (!email) {
                    showFieldError(this, document.getElementById('employerEmailError'), 'Email is required');
                } else if (!validateEmail(email)) {
                    showFieldError(this, document.getElementById('employerEmailError'), 'Please enter a valid email address');
                } else {
                    clearFieldError(this, document.getElementById('employerEmailError'));
                }
            });
        }
        
        if (phoneInput) {
            phoneInput.addEventListener('blur', function() {
                const phone = this.value.trim();
                if (!phone) {
                    showFieldError(this, document.getElementById('employerPhoneError'), 'Phone number is required');
                } else if (!validatePhone(phone)) {
                    showFieldError(this, document.getElementById('employerPhoneError'), 'Please enter a valid phone number');
                } else {
                    clearFieldError(this, document.getElementById('employerPhoneError'));
                }
            });
        }
        
        if (websiteInput) {
            websiteInput.addEventListener('blur', function() {
                const url = this.value.trim();
                if (!url) {
                    showFieldError(this, document.getElementById('employerWebsiteError'), 'Website is required');
                } else if (!validateURL(url)) {
                    showFieldError(this, document.getElementById('employerWebsiteError'), 'Please enter a valid website URL');
                } else {
                    clearFieldError(this, document.getElementById('employerWebsiteError'));
                }
            });
        }
        
        if (passwordInput) {
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                const confirmPassword = confirmPasswordInput.value;
                
                if (password && !validatePassword(password)) {
                    showFieldError(this, document.getElementById('employerPasswordError'), 'Password must be at least 8 characters long');
                } else {
                    clearFieldError(this, document.getElementById('employerPasswordError'));
                }
                
                // Check password match
                if (confirmPassword && password !== confirmPassword) {
                    showFieldError(confirmPasswordInput, document.getElementById('employerConfirmPasswordError'), 'Passwords do not match');
                } else if (confirmPassword) {
                    clearFieldError(confirmPasswordInput, document.getElementById('employerConfirmPasswordError'));
                }
            });
        }
        
        if (confirmPasswordInput) {
            confirmPasswordInput.addEventListener('blur', function() {
                const password = passwordInput.value;
                const confirmPassword = this.value;
                
                if (!confirmPassword) {
                    showFieldError(this, document.getElementById('employerConfirmPasswordError'), 'Please confirm your password');
                } else if (password !== confirmPassword) {
                    showFieldError(this, document.getElementById('employerConfirmPasswordError'), 'Passwords do not match');
                } else {
                    clearFieldError(this, document.getElementById('employerConfirmPasswordError'));
                }
            });
        }
        
        // Form submission validation
        employerRegistrationForm.addEventListener('submit', function(e) {
            let isValid = true;
            clearFormErrors(this);
            
            // Validate all fields
            if (!companyNameInput.value.trim()) {
                showFieldError(companyNameInput, document.getElementById('employerCompanyNameError'), 'Company name is required');
                isValid = false;
            }
            
            const email = emailInput.value.trim();
            if (!email) {
                showFieldError(emailInput, document.getElementById('employerEmailError'), 'Email is required');
                isValid = false;
            } else if (!validateEmail(email)) {
                showFieldError(emailInput, document.getElementById('employerEmailError'), 'Please enter a valid email address');
                isValid = false;
            }
            
            const phone = phoneInput.value.trim();
            if (!phone) {
                showFieldError(phoneInput, document.getElementById('employerPhoneError'), 'Phone number is required');
                isValid = false;
            } else if (!validatePhone(phone)) {
                showFieldError(phoneInput, document.getElementById('employerPhoneError'), 'Please enter a valid phone number');
                isValid = false;
            }
            
            if (!addressInput.value.trim()) {
                showFieldError(addressInput, document.getElementById('employerAddressError'), 'Address is required');
                isValid = false;
            }
            
            if (!industrySelect.value) {
                showFieldError(industrySelect, document.getElementById('employerIndustryError'), 'Please select an industry');
                isValid = false;
            }
            
            const url = websiteInput.value.trim();
            if (!url) {
                showFieldError(websiteInput, document.getElementById('employerWebsiteError'), 'Website is required');
                isValid = false;
            } else if (!validateURL(url)) {
                showFieldError(websiteInput, document.getElementById('employerWebsiteError'), 'Please enter a valid website URL');
                isValid = false;
            }
            
            const password = passwordInput.value;
            if (!password) {
                showFieldError(passwordInput, document.getElementById('employerPasswordError'), 'Password is required');
                isValid = false;
            } else if (!validatePassword(password)) {
                showFieldError(passwordInput, document.getElementById('employerPasswordError'), 'Password must be at least 8 characters long');
                isValid = false;
            }
            
            const confirmPassword = confirmPasswordInput.value;
            if (!confirmPassword) {
                showFieldError(confirmPasswordInput, document.getElementById('employerConfirmPasswordError'), 'Please confirm your password');
                isValid = false;
            } else if (password !== confirmPassword) {
                showFieldError(confirmPasswordInput, document.getElementById('employerConfirmPasswordError'), 'Passwords do not match');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
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
                    submitBtn.innerHTML = '<span>Creating account...</span><i class="fas fa-spinner fa-spin"></i>';
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
    
    const errorAlert = document.getElementById('registerErrorAlert');
    if (errorAlert) {
        setTimeout(() => {
            errorAlert.style.opacity = '0';
            setTimeout(() => {
                errorAlert.remove();
            }, 300);
        }, 8000);
    }

    console.log('Registration page JavaScript loaded successfully');
});
