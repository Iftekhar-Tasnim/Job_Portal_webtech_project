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

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('contactForm');
    const successMessage = document.createElement('div');
    const errorMessage = document.createElement('div');

    successMessage.className = 'success-message';
    errorMessage.className = 'error-message';

    form.appendChild(successMessage);
    form.appendChild(errorMessage);

    // Form validation
    const validateForm = () => {
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const subject = document.getElementById('subject').value;
        const message = document.getElementById('message').value.trim();

        if (!name || !email || !subject || !message) {
            errorMessage.textContent = 'Please fill in all required fields';
            errorMessage.style.display = 'block';
            return false;
        }

        // Simple email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            errorMessage.textContent = 'Please enter a valid email address';
            errorMessage.style.display = 'block';
            return false;
        }

        return true;
    };

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        // Validate form
        if (!validateForm()) return;

        // Check if reCAPTCHA is completed
        const recaptchaResponse = grecaptcha.getResponse();
        if (!recaptchaResponse) {
            errorMessage.textContent = 'Please complete the reCAPTCHA';
            errorMessage.style.display = 'block';
            return;
        }

        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());

        try {
            const response = await fetch('/api/contact', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            });

            if (!response.ok) {
                throw new Error('Failed to send message');
            }

            successMessage.textContent = 'Message sent successfully!';
            successMessage.style.display = 'block';
            
            // Clear form after successful submission
            form.reset();
            grecaptcha.reset();

            // Hide success message after 3 seconds
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 3000);

        } catch (error) {
            errorMessage.textContent = 'Error sending message. Please try again.';
            errorMessage.style.display = 'block';

            // Hide error message after 3 seconds
            setTimeout(() => {
                errorMessage.style.display = 'none';
            }, 3000);
        }
    });
});

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
