document.addEventListener("DOMContentLoaded", function () {
  const loginOptions = document.querySelectorAll(".login-option");
  const loginPanels = document.querySelectorAll(".login-panel");

  loginOptions.forEach((option) => {
    option.addEventListener("click", function () {
      const type = this.dataset.type;

      loginOptions.forEach((opt) => opt.classList.remove("active"));
      this.classList.add("active");

      loginPanels.forEach((panel) => panel.classList.remove("active"));
      document.getElementById(`${type}Login`).classList.add("active");
    });
  });

  const validateEmail = (email) => {
    if (!email || email.trim() === "") {
      return false;
    }

    if (!email.includes("@") || !email.includes(".")) {
      return false;
    }

    const parts = email.split("@");
    if (parts.length !== 2) {
      return false;
    }

    if (parts[0].trim() === "" || parts[1].trim() === "") {
      return false;
    }

    const domainParts = parts[1].split(".");
    if (domainParts.length < 2) {
      return false;
    }

    for (let part of domainParts) {
      if (part.trim() === "") {
        return false;
      }
    }

    return true;
  };

  const validatePassword = (password) => {
    if (!password || password.trim() === "") {
      return false;
    }

    if (password.trim().length < 6) {
      return false;
    }

    return true;
  };

  const applicantForm = document.getElementById("applicantLoginForm");
  const applicantEmail = document.getElementById("applicantEmail");
  const applicantPassword = document.getElementById("applicantPassword");
  const applicantEmailError = document.getElementById("applicantEmailError");
  const applicantPasswordError = document.getElementById(
    "applicantPasswordError"
  );

  document.addEventListener('DOMContentLoaded', function() {
    // Handle login option switching
    const loginOptions = document.querySelectorAll('.login-option');
    const loginPanels = document.querySelectorAll('.login-panel');

    loginOptions.forEach(option => {
        option.addEventListener('click', function() {
            const type = this.dataset.type;
            loginOptions.forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');
            loginPanels.forEach(panel => panel.classList.remove('active'));
            document.getElementById(`${type}Login`).classList.add('active');
        });
    });

    // Handle applicant login
    const applicantForm = document.getElementById('applicantLoginForm');
    if (applicantForm) {
        applicantForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('applicantEmail').value;
            const password = document.getElementById('applicantPassword').value;

            // Check demo credentials
            if (email === 'user@employify.com' && password === '1234') {
                isLoggedIn = true;
                currentUser = {
                    name: 'Job Seeker',
                    email: email
                };
                updateAuthUI(true);
                window.location.href = './index.html';
            } else {
                alert('Invalid credentials. Please use:\nEmail: user@employify.com\nPassword: 1234');
            }
        });
    }

    // Handle employer login
    const employerForm = document.getElementById('employerLoginForm');
    if (employerForm) {
        employerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('employerEmail').value;
            const password = document.getElementById('employerPassword').value;

            // Check demo credentials
            if (email === 'emp@employify.com' && password === '1234') {
                isLoggedIn = true;
                currentUser = {
                    name: 'Employer',
                    email: email
                };
                updateAuthUI(true);
                window.location.href = './index.html';
            } else {
                alert('Invalid credentials. Please use:\nEmail: emp@employify.com\nPassword: 1234');
            }
        });
    }
});

  const employerForm = document.getElementById("employerLoginForm");
  const employerEmail = document.getElementById("employerEmail");
  const employerPassword = document.getElementById("employerPassword");
  const employerEmailError = document.getElementById("employerEmailError");
  const employerPasswordError = document.getElementById(
    "employerPasswordError"
  );

  employerForm.addEventListener("submit", function (e) {
    e.preventDefault();

    let isValid = true;

    // Validate email
    if (!validateEmail(employerEmail.value)) {
      employerEmailError.style.display = "block";
      isValid = false;
    } else {
      employerEmailError.style.display = "none";
    }

    // Validate password
    if (!validatePassword(employerPassword.value)) {
      employerPasswordError.style.display = "block";
      isValid = false;
    } else {
      employerPasswordError.style.display = "none";
    }

    if (isValid) {
      // Handle employer login
      console.log("Employer login submitted");
      // Add your login logic here
    }
  });

  // Real-time validation
  const formInputs = document.querySelectorAll(
    'input[type="email"], input[type="password"]'
  );
  formInputs.forEach((input) => {
    input.addEventListener("input", function () {
      const errorDiv = this.nextElementSibling;
      if (errorDiv && errorDiv.classList.contains("validation-message")) {
        errorDiv.style.display = "none";
      }
    });
  });
});
