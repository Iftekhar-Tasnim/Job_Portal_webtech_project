// Form switching function
function showStep(stepId) {
    const emailVerification = document.getElementById('email-verification');
    const securityQuestion = document.getElementById('security-question');
    const emailBtn = document.querySelector('.user-type-btn:first-child');
    const securityBtn = document.querySelector('.user-type-btn:last-child');

    if (stepId === 'email-verification') {
        emailVerification.classList.add('active');
        securityQuestion.classList.remove('active');
        emailBtn.classList.add('active');
        securityBtn.classList.remove('active');
    } else {
        emailVerification.classList.remove('active');
        securityQuestion.classList.add('active');
        emailBtn.classList.remove('active');
        securityBtn.classList.add('active');
    }
}

// Simple validation functions
function isNotEmpty(value) {
    return value.trim() !== '';
}

function isValidEmail(email) {
    return email.includes('@') && email.includes('.');
}

// Email verification form validation
function validateEmailForm() {
    const email = document.getElementById('email').value;

    if (!isNotEmpty(email)) {
        showError('emailError', 'Email is required');
        return false;
    }
    if (!isValidEmail(email)) {
        showError('emailError', 'Please enter a valid email address');
        return false;
    }

    return true;
}

// Security question form validation
function validateSecurityForm() {
    const question = document.getElementById('security-question-select').value;
    const answer = document.getElementById('security-answer').value;

    if (question === '') {
        showError('questionError', 'Please select a security question');
        return false;
    }
    if (!isNotEmpty(answer)) {
        showError('answerError', 'Please enter your answer');
        return false;
    }

    return true;
}

// Helper function to show error messages
function showError(errorId, message) {
    const errorElement = document.getElementById(errorId);
    errorElement.textContent = message;
    errorElement.style.display = 'block';
}

// Email verification button handler
function sendVerificationCode(event) {
    event.preventDefault();
    
    if (validateEmailForm()) {
        const email = document.getElementById('email').value;
        alert(`Verification code has been sent to ${email}. Please check your email.`);
        // In a real application, you would send an API request here
    }
}

// Security question verification button handler
function verifyAnswer(event) {
    event.preventDefault();
    
    if (validateSecurityForm()) {
        const question = document.getElementById('security-question-select').value;
        const answer = document.getElementById('security-answer').value;
        
        // In a real application, you would verify the answer against the database
        alert('Answer verified successfully! You can now reset your password.');
        // Redirect to password reset page
        window.location.href = 'reset-password.html';
    }
}

// Add event listeners
document.getElementById('sendCodeButton').addEventListener('click', sendVerificationCode);
document.getElementById('verifyAnswerButton').addEventListener('click', verifyAnswer);
