// Validate contact form fields
function validateForm() {
    let isValid = true;
    
    const name = document.getElementById('name').value.trim();
    if (!name) {
        showError('nameError', 'Please enter your full name');
        isValid = false;
    } else {
        hideError('nameError');
    }

    const email = document.getElementById('email').value.trim();
    if (!email) {
        showError('emailError', 'Please enter your email address');
        isValid = false;
    } else if (!isValidEmail(email)) {
        showError('emailError', 'Please enter a valid email address');
        isValid = false;
    } else {
        hideError('emailError');
    }

    const subject = document.getElementById('subject').value;
    if (!subject) {
        showError('subjectError', 'Please select a subject');
        isValid = false;
    } else {
        hideError('subjectError');
    }

    const message = document.getElementById('message').value.trim();
    if (!message) {
        showError('messageError', 'Please enter your message');
        isValid = false;
    } else if (message.length < 10) {
        showError('messageError', 'Message must be at least 10 characters long');
        isValid = false;
    } else {
        hideError('messageError');
    }

    return isValid;
}

// Email validation
function isValidEmail(email) {
    return email.includes('@') && email.includes('.');
}

// Show error message
function showError(elementId, message) {
    const errorElement = document.getElementById(elementId);
    errorElement.textContent = message;
    errorElement.style.display = 'block';
}

// Hide error message
function hideError(elementId) {
    const errorElement = document.getElementById(elementId);
    errorElement.style.display = 'none';
}

// Form submission handler
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();

    if (!validateForm()) {
        return;
    }

    if (!grecaptcha.getResponse()) {
        showError('captchaError', 'Please verify that you are not a robot');
        return;
    }

    simulateFormSubmission();
});

// form submission
function simulateFormSubmission() {
    const submitBtn = document.querySelector('.submit-btn');
    const originalText = submitBtn.textContent;
    submitBtn.disabled = true;
    submitBtn.textContent = 'Sending...';

    setTimeout(() => {
        grecaptcha.reset();
        showConfirmationModal();
        document.getElementById('contactForm').reset();
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;
    }, 2000);
}

// Show confirmation modal
function showConfirmationModal() {
    const modal = document.getElementById('confirmationModal');
    modal.style.display = 'block';

    document.querySelector('.close').addEventListener('click', closeModal);
    window.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });
}

// Close confirmation modal
function closeModal() {
    const modal = document.getElementById('confirmationModal');
    modal.style.display = 'none';
}

// Initialize CAPTCHA
document.addEventListener('DOMContentLoaded', function() {
    grecaptcha.ready(function() {
        grecaptcha.execute('your-site-key', {action: 'contact'});
    });
});
