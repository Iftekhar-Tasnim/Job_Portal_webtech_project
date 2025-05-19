document.addEventListener('DOMContentLoaded', function() {
    const emailForm = document.getElementById('emailForm');
    const securityQuestionForm = document.getElementById('securityQuestionForm');
    const resetPasswordForm = document.getElementById('resetPasswordForm');
    const backToEmailLink = document.getElementById('backToEmailLink');
    const backToSecurityLink = document.getElementById('backToSecurityLink');
    const togglePasswordIcons = document.querySelectorAll('.toggle-password');
    
    const securityQuestions = {
        pet: "What was your first pet's name?",
        school: "What was your first school?",
        city: "What city were you born in?",
        friend: "What is your best friend's name?"
    };

    let currentUser = null;

    togglePasswordIcons.forEach(icon => {
        icon.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    });

    emailForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const email = document.getElementById('email').value.trim();
        const emailError = document.getElementById('emailError');

        if (!isValidEmail(email)) {
            showError(emailError, 'Please enter a valid email address.');
            return;
        }

        simulateServerRequest(() => {
            currentUser = {
                email: email,
                securityQuestion: 'pet',
                securityAnswer: 'fluffy'
            };
            showStep(2);
        });
    });

    securityQuestionForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const answer = document.getElementById('securityAnswer').value.trim();
        const answerError = document.getElementById('answerError');

        if (!answer) {
            showError(answerError, 'Please enter your answer.');
            return;
        }

        simulateServerRequest(() => {
            if (answer.toLowerCase() === currentUser.securityAnswer) {
                showStep(3);
            } else {
                showError(answerError, 'Incorrect answer. Please try again.');
            }
        });
    });

    resetPasswordForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const newPassword = document.getElementById('newPassword').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        const passwordError = document.getElementById('passwordError');
        const confirmPasswordError = document.getElementById('confirmPasswordError');

        hideError(passwordError);
        hideError(confirmPasswordError);

        if (newPassword.length < 8) {
            showError(passwordError, 'Password must be at least 8 characters long.');
            return;
        }

        if (newPassword !== confirmPassword) {
            showError(confirmPasswordError, 'Passwords do not match.');
            return;
        }

        simulateServerRequest(() => {
            alert('Your password has been reset successfully!');
            window.location.href = 'login.html';
        });
    });

    backToEmailLink.addEventListener('click', function(e) {
        e.preventDefault();
        showStep(1);
    });

    backToSecurityLink.addEventListener('click', function(e) {
        e.preventDefault();
        showStep(2);
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
            securityQuestionForm.classList.add('active');
            document.getElementById('securityQuestion').textContent = 
                securityQuestions[currentUser.securityQuestion];
        } else if (stepNumber === 3) {
            resetPasswordForm.classList.add('active');
        }
    }

    function isValidEmail(email) {
        if (!email || typeof email !== 'string') return false;
        
        const atIndex = email.indexOf('@');
        const dotIndex = email.lastIndexOf('.');
        
        return atIndex > 0 && 
               dotIndex > atIndex + 1 && 
               dotIndex < email.length - 1 &&
               email.indexOf(' ') === -1;
    }

    function showError(element, message) {
        element.textContent = message;
        element.style.display = 'block';
    }

    function hideError(element) {
        element.textContent = '';
        element.style.display = 'none';
    }

    function simulateServerRequest(callback) {
        const submitButton = document.activeElement;
        const originalText = submitButton.innerHTML;
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';

        setTimeout(() => {
            submitButton.disabled = false;
            submitButton.innerHTML = originalText;
            if (callback) callback();
        }, 1000);
    }
});
