// Form switching function
function showForm(formType) {
    const applicantForm = document.getElementById('applicant-form');
    const employerForm = document.getElementById('employer-form');
    const applicantBtn = document.querySelector('.user-type-btn:first-child');
    const employerBtn = document.querySelector('.user-type-btn:last-child');

    if (formType === 'applicant') {
        applicantForm.classList.add('active');
        employerForm.classList.remove('active');
        applicantBtn.classList.add('active');
        employerBtn.classList.remove('active');
    } else {
        applicantForm.classList.remove('active');
        employerForm.classList.add('active');
        applicantBtn.classList.remove('active');
        employerBtn.classList.add('active');
    }
}

// Simple validation functions
function isNotEmpty(value) {
    return value.trim() !== '';
}

function arePasswordsMatch(password, confirmPassword) {
    return password === confirmPassword;
}

function isValidEmail(email) {
    return email.includes('@') && email.includes('.');
}

// Applicant form validation
function validateApplicantForm() {
    const firstName = document.getElementById('applicant-first-name').value;
    const lastName = document.getElementById('applicant-last-name').value;
    const email = document.getElementById('applicant-email').value;
    const phone = document.getElementById('applicant-phone').value;
    const address = document.getElementById('applicant-address').value;
    const gender = document.getElementById('applicant-gender').value;
    const password = document.getElementById('applicant-password').value;
    const confirmPassword = document.getElementById('applicant-confirm-password').value;

    // Check all required fields
    if (!isNotEmpty(firstName)) {
        showError('applicantFirstNameError', 'First Name is required');
        return false;
    }
    if (!isNotEmpty(lastName)) {
        showError('applicantLastNameError', 'Last Name is required');
        return false;
    }
    if (!isNotEmpty(email)) {
        showError('applicantEmailError', 'Email is required');
        return false;
    }
    if (!isNotEmpty(phone)) {
        showError('applicantPhoneError', 'Phone number is required');
        return false;
    }
    if (!isNotEmpty(address)) {
        showError('applicantAddressError', 'Address is required');
        return false;
    }
    if (gender === '') {
        showError('applicantGenderError', 'Please select your gender');
        return false;
    }
    if (!isNotEmpty(password)) {
        showError('applicantPasswordError', 'Password is required');
        return false;
    }
    if (!isNotEmpty(confirmPassword)) {
        showError('applicantConfirmPasswordError', 'Confirm Password is required');
        return false;
    }
    if (!arePasswordsMatch(password, confirmPassword)) {
        showError('applicantConfirmPasswordError', 'Passwords do not match');
        return false;
    }

    // If all validations pass
    return true;
}

// Employer form validation
function validateEmployerForm() {
    const companyName = document.getElementById('employer-company-name').value;
    const email = document.getElementById('employer-email').value;
    const phone = document.getElementById('employer-phone').value;
    const address = document.getElementById('employer-address').value;
    const industry = document.getElementById('employer-industry').value;
    const website = document.getElementById('employer-website').value;
    const password = document.getElementById('employer-password').value;
    const confirmPassword = document.getElementById('employer-confirm-password').value;

    // Check all required fields
    if (!isNotEmpty(companyName)) {
        showError('employerCompanyNameError', 'Company Name is required');
        return false;
    }
    if (!isNotEmpty(email)) {
        showError('employerEmailError', 'Company Email is required');
        return false;
    }
    if (!isNotEmpty(phone)) {
        showError('employerPhoneError', 'Company Phone is required');
        return false;
    }
    if (!isNotEmpty(address)) {
        showError('employerAddressError', 'Company Address is required');
        return false;
    }
    if (industry === '') {
        showError('employerIndustryError', 'Please select your industry');
        return false;
    }
    if (!isNotEmpty(website)) {
        showError('employerWebsiteError', 'Company Website is required');
        return false;
    }
    if (!isNotEmpty(password)) {
        showError('employerPasswordError', 'Password is required');
        return false;
    }
    if (!isNotEmpty(confirmPassword)) {
        showError('employerConfirmPasswordError', 'Confirm Password is required');
        return false;
    }
    if (!arePasswordsMatch(password, confirmPassword)) {
        showError('employerConfirmPasswordError', 'Passwords do not match');
        return false;
    }

    // If all validations pass
    return true;
}

// Helper function to show error messages
function showError(errorId, message) {
    const errorElement = document.getElementById(errorId);
    errorElement.textContent = message;
    errorElement.style.display = 'block';
}

// Form submission handlers
function submitApplicantForm(event) {
    event.preventDefault();
    if (validateApplicantForm()) {
        alert('Applicant signup successful!');
        window.location.href = 'index.html';
    }
}

function submitEmployerForm(event) {
    event.preventDefault();
    if (validateEmployerForm()) {
        alert('Employer signup successful!');
        window.location.href = 'index.html';
    }
}

// Add event listeners
document.getElementById('applicantSignupButton').addEventListener('click', submitApplicantForm);
document.getElementById('employerSignupButton').addEventListener('click', submitEmployerForm);