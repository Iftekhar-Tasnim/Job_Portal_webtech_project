// Contact Page JavaScript
// Handles form validation, submission, and character counting

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const messageTextarea = document.getElementById('message');
    const charCount = document.getElementById('charCount');
    const successMessage = document.getElementById('successMessage');
    const errorMessage = document.getElementById('errorMessage');
    const recaptchaGroup = document.getElementById('recaptchaGroup');
    const recaptchaContainer = document.getElementById('recaptchaContainer');
    const maxChars = 500;
    let recaptchaLoaded = false;
    let recaptchaWidgetId = null;
    
    // ============================================
    // RECAPTCHA INITIALIZATION
    // ============================================
    
    // Check if reCAPTCHA should be enabled
    // Set this to your actual site key or leave empty to disable
    const RECAPTCHA_SITE_KEY = ''; // Add your reCAPTCHA site key here, or leave empty to disable
    
    function initRecaptcha() {
        if (!RECAPTCHA_SITE_KEY || RECAPTCHA_SITE_KEY === '' || RECAPTCHA_SITE_KEY === 'your-site-key') {
            // reCAPTCHA not configured, hide it
            if (recaptchaGroup) {
                recaptchaGroup.style.display = 'none';
            }
            return;
        }
        
        // Load reCAPTCHA script
        if (typeof grecaptcha === 'undefined') {
            const script = document.createElement('script');
            script.src = 'https://www.google.com/recaptcha/api.js?render=explicit';
            script.async = true;
            script.defer = true;
            script.onload = function() {
                if (typeof grecaptcha !== 'undefined' && grecaptcha.ready) {
                    grecaptcha.ready(function() {
                        try {
                            recaptchaWidgetId = grecaptcha.render(recaptchaContainer, {
                                'sitekey': RECAPTCHA_SITE_KEY,
                                'theme': 'light',
                                'size': 'normal'
                            });
                            recaptchaLoaded = true;
                            if (recaptchaGroup) {
                                recaptchaGroup.style.display = 'block';
                            }
                        } catch (e) {
                            console.error('reCAPTCHA render error:', e);
                            if (recaptchaGroup) {
                                recaptchaGroup.style.display = 'none';
                            }
                        }
                    });
                }
            };
            script.onerror = function() {
                console.error('Failed to load reCAPTCHA');
                if (recaptchaGroup) {
                    recaptchaGroup.style.display = 'none';
                }
            };
            document.head.appendChild(script);
        } else {
            // reCAPTCHA already loaded
            try {
                recaptchaWidgetId = grecaptcha.render(recaptchaContainer, {
                    'sitekey': RECAPTCHA_SITE_KEY,
                    'theme': 'light',
                    'size': 'normal'
                });
                recaptchaLoaded = true;
                if (recaptchaGroup) {
                    recaptchaGroup.style.display = 'block';
                }
            } catch (e) {
                console.error('reCAPTCHA render error:', e);
                if (recaptchaGroup) {
                    recaptchaGroup.style.display = 'none';
                }
            }
        }
    }
    
    // Initialize reCAPTCHA
    initRecaptcha();

    // ============================================
    // CHARACTER COUNT FOR TEXTAREA
    // ============================================
    
    if (messageTextarea && charCount) {
        messageTextarea.addEventListener('input', function() {
            const currentLength = this.value.length;
            charCount.textContent = currentLength;
            
            // Change color if approaching limit
            const charCountElement = this.parentElement.querySelector('.char-count');
            if (charCountElement) {
                charCountElement.classList.remove('warning', 'danger');
                if (currentLength > maxChars * 0.9) {
                    charCountElement.classList.add('danger');
                } else if (currentLength > maxChars * 0.7) {
                    charCountElement.classList.add('warning');
                }
            }
            
            // Limit characters
            if (currentLength > maxChars) {
                this.value = this.value.substring(0, maxChars);
                charCount.textContent = maxChars;
            }
        });
    }

    // ============================================
    // FORM VALIDATION
    // ============================================
    
    function validateForm() {
        let isValid = true;
        
        // Clear previous errors
        hideAllErrors();
        hideMessages();

        // Validate name
        const name = document.getElementById('name').value.trim();
        if (!name) {
            showError('nameError', 'Please enter your full name');
            isValid = false;
        } else if (name.length < 2) {
            showError('nameError', 'Name must be at least 2 characters');
            isValid = false;
        }

        // Validate email
        const email = document.getElementById('email').value.trim();
        if (!email) {
            showError('emailError', 'Please enter your email address');
            isValid = false;
        } else if (!isValidEmail(email)) {
            showError('emailError', 'Please enter a valid email address');
            isValid = false;
        }

        // Validate phone (optional but check format if provided)
        const phone = document.getElementById('phone').value.trim();
        if (phone && !isValidPhone(phone)) {
            showError('phoneError', 'Please enter a valid phone number');
            isValid = false;
        }

        // Validate subject
        const subject = document.getElementById('subject').value;
        if (!subject) {
            showError('subjectError', 'Please select a subject');
            isValid = false;
        }

        // Validate message
        const message = document.getElementById('message').value.trim();
        if (!message) {
            showError('messageError', 'Please enter your message');
            isValid = false;
        } else if (message.length < 10) {
            showError('messageError', 'Message must be at least 10 characters long');
            isValid = false;
        } else if (message.length > maxChars) {
            showError('messageError', `Message must not exceed ${maxChars} characters`);
            isValid = false;
        }

        // Validate reCAPTCHA (only if it's enabled and visible)
        if (recaptchaLoaded && recaptchaGroup && recaptchaGroup.style.display !== 'none') {
            try {
                let recaptchaResponse = '';
                if (recaptchaWidgetId !== null) {
                    recaptchaResponse = grecaptcha.getResponse(recaptchaWidgetId);
                } else if (typeof grecaptcha !== 'undefined') {
                    recaptchaResponse = grecaptcha.getResponse();
                }
                
                if (!recaptchaResponse || recaptchaResponse === '') {
                    showError('recaptchaError', 'Please complete the reCAPTCHA verification');
                    isValid = false;
                } else {
                    hideError('recaptchaError');
                }
            } catch (e) {
                console.error('reCAPTCHA validation error:', e);
                // If reCAPTCHA fails, don't block form submission (optional)
                // Uncomment the next line to require reCAPTCHA even on error:
                // isValid = false;
            }
        }

        return isValid;
    }

    // ============================================
    // VALIDATION HELPERS
    // ============================================
    
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function isValidPhone(phone) {
        // Allow various phone formats
        const phoneRegex = /^[\d\s\-\+\(\)]+$/;
        return phoneRegex.test(phone) && phone.replace(/\D/g, '').length >= 10;
    }

    function showError(elementId, message) {
        const errorElement = document.getElementById(elementId);
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.style.display = 'block';
            
            // Add error class to input - find the input/select/textarea in the same form-group
            const formGroup = errorElement.closest('.form-group');
            if (formGroup) {
                const input = formGroup.querySelector('input, select, textarea');
                if (input) {
                    input.classList.add('error');
                }
            }
        }
    }

    function hideError(elementId) {
        const errorElement = document.getElementById(elementId);
        if (errorElement) {
            errorElement.style.display = 'none';
            errorElement.textContent = '';
        }
    }

    function hideAllErrors() {
        const errorElements = form.querySelectorAll('.form-group .error-message');
        errorElements.forEach(error => {
            error.style.display = 'none';
            error.textContent = '';
        });

        // Remove error class from inputs
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.classList.remove('error');
        });
    }

    function showSuccessMessage() {
        if (successMessage) {
            successMessage.style.display = 'flex';
            errorMessage.style.display = 'none';
            
            // Scroll to message
            successMessage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            
            // Hide after 5 seconds
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 5000);
        }
    }

    function showErrorMessage(message) {
        if (errorMessage) {
            const errorText = errorMessage.querySelector('span');
            if (errorText) {
                errorText.textContent = message || 'There was an error sending your message. Please try again.';
            }
            errorMessage.style.display = 'flex';
            successMessage.style.display = 'none';
            
            // Scroll to message
            errorMessage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            
            // Hide after 5 seconds
            setTimeout(() => {
                errorMessage.style.display = 'none';
            }, 5000);
        }
    }

    function hideMessages() {
        if (successMessage) successMessage.style.display = 'none';
        if (errorMessage) errorMessage.style.display = 'none';
    }

    // ============================================
    // REAL-TIME VALIDATION
    // ============================================
    
    const inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            // Validate individual field on blur
            if (this.id === 'name') {
                const name = this.value.trim();
                if (name && name.length < 2) {
                    showError('nameError', 'Name must be at least 2 characters');
                } else {
                    hideError('nameError');
                }
            } else if (this.id === 'email') {
                const email = this.value.trim();
                if (email && !isValidEmail(email)) {
                    showError('emailError', 'Please enter a valid email address');
                } else {
                    hideError('emailError');
                }
            } else if (this.id === 'phone') {
                const phone = this.value.trim();
                if (phone && !isValidPhone(phone)) {
                    showError('phoneError', 'Please enter a valid phone number');
                } else {
                    hideError('phoneError');
                }
            } else if (this.id === 'message') {
                const message = this.value.trim();
                if (message && message.length < 10) {
                    showError('messageError', 'Message must be at least 10 characters long');
                } else {
                    hideError('messageError');
                }
            }
        });

        input.addEventListener('input', function() {
            // Remove error styling on input
            this.classList.remove('error');
            const errorId = this.id + 'Error';
            hideError(errorId);
        });
    });

    // ============================================
    // FORM SUBMISSION
    // ============================================
    
    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Validate form
        if (!validateForm()) {
            showErrorMessage('Please correct the errors in the form');
            return;
        }

        // Disable submit button
        const submitBtn = form.querySelector('.submit-btn');
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span>Sending...</span><i class="fas fa-spinner fa-spin"></i>';

        // Prepare form data
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());

        // Add reCAPTCHA if available and enabled
        if (recaptchaLoaded && recaptchaGroup && recaptchaGroup.style.display !== 'none') {
            try {
                if (recaptchaWidgetId !== null) {
                    data.recaptcha = grecaptcha.getResponse(recaptchaWidgetId);
                } else if (typeof grecaptcha !== 'undefined') {
                    data.recaptcha = grecaptcha.getResponse();
                }
            } catch (e) {
                console.error('Error getting reCAPTCHA response:', e);
            }
        }

        try {
            // Simulate API call (replace with actual endpoint)
            const response = await fetch('/api/contact', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            });

            // For demo purposes, simulate success
            // In production, use actual response
            await new Promise(resolve => setTimeout(resolve, 1000));

            // Simulate success (remove in production)
            const simulateSuccess = true;
            
            if (simulateSuccess || response.ok) {
                showSuccessMessage();
                form.reset();
                
                // Reset reCAPTCHA if enabled
                if (recaptchaLoaded && recaptchaWidgetId !== null) {
                    try {
                        grecaptcha.reset(recaptchaWidgetId);
                    } catch (e) {
                        console.error('Error resetting reCAPTCHA:', e);
                    }
                } else if (typeof grecaptcha !== 'undefined') {
                    try {
                        grecaptcha.reset();
                    } catch (e) {
                        // Ignore reset errors
                    }
                }
                
                // Reset character count
                if (charCount) {
                    charCount.textContent = '0';
                }
            } else {
                throw new Error('Failed to send message');
            }

        } catch (error) {
            console.error('Error:', error);
            showErrorMessage('Error sending message. Please try again later.');
        } finally {
            // Re-enable submit button
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        }
    });

    // ============================================
    // RESET BUTTON
    // ============================================
    
    const resetBtn = form.querySelector('.reset-btn');
    if (resetBtn) {
        resetBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Reset form
            form.reset();
            
            // Clear all errors
            hideAllErrors();
            hideMessages();
            
            // Reset reCAPTCHA if enabled
            if (recaptchaLoaded && recaptchaWidgetId !== null) {
                try {
                    grecaptcha.reset(recaptchaWidgetId);
                } catch (e) {
                    console.log('reCAPTCHA reset error:', e);
                }
            } else if (typeof grecaptcha !== 'undefined') {
                try {
                    grecaptcha.reset();
                } catch (e) {
                    // Ignore reset errors
                }
            }
            
            // Reset character count
            if (charCount) {
                charCount.textContent = '0';
            }
            
            // Reset char count styling
            if (messageTextarea) {
                const charCountElement = messageTextarea.parentElement.querySelector('.char-count');
                if (charCountElement) {
                    charCountElement.classList.remove('warning', 'danger');
                }
            }
            
            // Remove error classes from inputs
            const inputs = form.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.classList.remove('error');
            });
        });
    }

    // ============================================
    // HANDLE FORM RESET EVENT
    // ============================================
    
    form.addEventListener('reset', function() {
        hideAllErrors();
        hideMessages();
        if (charCount) {
            charCount.textContent = '0';
        }
    });

    console.log('Contact form JavaScript loaded successfully');
});
