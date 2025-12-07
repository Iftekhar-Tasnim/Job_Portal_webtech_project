<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration - Employify</title>
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/registration.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  </head>
  <body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>
    <section class="login-container">
      <div class="user-type-selector">
        <button class="user-type-btn active" onclick="showForm('applicant')">
          Applicant
        </button>
        <button class="user-type-btn" onclick="showForm('employer')">
          Employer
        </button>
      </div>

      <!-- Applicant Registration Form -->
      <div id="applicant-form" class="registration-form active">
        <form action="../controller/reg.php" method="POST">
          <input type="hidden" name="user_type" value="applicant">
          <fieldset class="login-box">
            <legend class="login-title">Applicant Registration</legend>
            
            <?php
            if (isset($_SESSION['register_errors'])) {
                foreach ($_SESSION['register_errors'] as $error) {
                    echo '<div class="error-message">' . htmlspecialchars($error) . '</div>';
                }
                unset($_SESSION['register_errors']);
            }
            ?>

            <label for="applicant-first-name">First Name</label>
            <input
              type="text"
              id="applicant-first-name"
              name="First_Name"
              class="input-field"
              placeholder="First Name"
              required
            />
            <div class="error-message" id="applicantFirstNameError">
              First Name is required.
            </div>

            <label for="applicant-last-name">Last Name</label>
            <input
              type="text"
              id="applicant-last-name"
              name="Last_Name"
              class="input-field"
              placeholder="Last Name"
              required
            />
            <div class="error-message" id="applicantLastNameError">
              Last Name is required.
            </div>

            <label for="applicant-email">Email</label>
            <input
              type="email"
              id="applicant-email"
              name="Email"
              class="input-field"
              placeholder="Email"
              required
            />
            <div class="error-message" id="applicantEmailError">
              Please enter a valid email address.
            </div>

            <label for="applicant-phone">Phone Number</label>
            <input
              type="tel"
              id="applicant-phone"
              name="Phone"
              class="input-field"
              placeholder="Phone Number"
              required
            />
            <div class="error-message" id="applicantPhoneError">
              Phone number is required.
            </div>

            <label for="applicant-address">Address</label>
            <input
              type="text"
              id="applicant-address"
              name="Address"
              class="input-field"
              placeholder="Address"
              required
            />
            <div class="error-message" id="applicantAddressError">
              Address is required.
            </div>

            <label for="applicant-gender">Gender</label>
            <select id="applicant-gender" name="Gender" class="input-field" required>
              <option value="" disabled selected>Select Gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="other">Other</option>
            </select>
            <div class="error-message" id="applicantGenderError">
              Please select your gender.
            </div>

            <label for="applicant-password">Password</label>
            <input
              type="password"
              id="applicant-password"
              name="Password"
              class="input-field"
              placeholder="Password"
              required
            />
            <div class="error-message" id="applicantPasswordError">
              Password must be at least 8 characters long.
            </div>

            <label for="applicant-confirm-password">Confirm Password</label>
            <input
              type="password"
              id="applicant-confirm-password"
              name="confirm_password"
              class="input-field"
              placeholder="Confirm Password"
              required
            />
            <div class="error-message" id="applicantConfirmPasswordError">
              Passwords do not match.
            </div>

            <div class="button-container">
              <button
                type="submit"
                class="login-button"
                id="applicantSignupButton"
                name="submit"
              >
                Sign Up
              </button>
            </div>

            <p class="login_page">
              Already have an account? <a href="login.php">Login here</a>
            </p>
          </fieldset>
        </form>
      </div>

      <!-- Employer Registration Form -->
      <div id="employer-form" class="registration-form">
        <form action="../controller/reg.php" method="POST">
          <input type="hidden" name="user_type" value="employer">
          <fieldset class="login-box">
            <legend class="login-title">Employer Registration</legend>
            
            <?php
            if (isset($_SESSION['register_errors'])) {
                foreach ($_SESSION['register_errors'] as $error) {
                    echo '<div class="error-message">' . htmlspecialchars($error) . '</div>';
                }
                unset($_SESSION['register_errors']);
            }
            ?>

            <label for="employer-company-name">Company Name</label>
            <input
              type="text"
              id="employer-company-name"
              name="company_name"
              class="input-field"
              placeholder="Company Name"
              required
            />
            <div class="error-message" id="employerCompanyNameError">
              Company Name is required.
            </div>

            <label for="employer-email">Company Email</label>
            <input
              type="email"
              id="employer-email"
              name="email"
              class="input-field"
              placeholder="Company Email"
              required
            />
            <div class="error-message" id="employerEmailError">
              Please enter a valid email address.
            </div>

            <label for="employer-phone">Company Phone</label>
            <input
              type="tel"
              id="employer-phone"
              name="phone"
              class="input-field"
              placeholder="Company Phone"
              required
            />
            <div class="error-message" id="employerPhoneError">
              Company phone is required.
            </div>

            <label for="employer-address">Company Address</label>
            <input
              type="text"
              id="employer-address"
              name="address"
              class="input-field"
              placeholder="Company Address"
              required
            />
            <div class="error-message" id="employerAddressError">
              Company address is required.
            </div>

            <label for="employer-industry">Industry</label>
            <select id="employer-industry" name="industry" class="input-field" required>
              <option value="" disabled selected>Select Industry</option>
              <option value="it">Information Technology</option>
              <option value="finance">Finance</option>
              <option value="healthcare">Healthcare</option>
              <option value="manufacturing">Manufacturing</option>
              <option value="retail">Retail</option>
              <option value="other">Other</option>
            </select>
            <div class="error-message" id="employerIndustryError">
              Please select your industry.
            </div>

            <label for="employer-website">Company Website</label>
            <input
              type="url"
              id="employer-website"
              name="website"
              class="input-field"
              placeholder="Company Website"
              required
            />
            <div class="error-message" id="employerWebsiteError">
              Please enter a valid website URL.
            </div>

            <label for="employer-password">Password</label>
            <input
              type="password"
              id="employer-password"
              name="password"
              class="input-field"
              placeholder="Password"
              required
            />
            <div class="error-message" id="employerPasswordError">
              Password must be at least 8 characters long.
            </div>

            <label for="employer-confirm-password">Confirm Password</label>
            <input
              type="password"
              id="employer-confirm-password"
              name="confirm_password"
              class="input-field"
              placeholder="Confirm Password"
              required
            />
            <div class="error-message" id="employerConfirmPasswordError">
              Passwords do not match.
            </div>

            <div class="button-container">
              <button
                type="submit"
                class="login-button"
                id="employerSignupButton"
                name="submit"
              >
                Sign Up
              </button>
            </div>

            <p class="login_page">
              Already have an account? <a href="login.php">Login here</a>
            </p>
          </fieldset>
        </form>
      </div>
    </section>

    <script src="../assets/js/navbar.js"></script>
    <script src="../Js/registration.js"></script>
  </body>
</html>
