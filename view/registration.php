<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration Page</title>
    <link rel="stylesheet" href="../assets/css/registration.css" />
    <script src="./Js/registration.js"></script>
  </head>
  <body>
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
        <fieldset class="login-box">
          <legend class="login-title">Applicant Registration</legend>

          <label for="applicant-first-name">First Name</label>
          <input
            type="text"
            id="applicant-first-name"
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
            class="input-field"
            placeholder="Address"
            required
          />
          <div class="error-message" id="applicantAddressError">
            Address is required.
          </div>

          <label for="applicant-gender">Gender</label>
          <select id="applicant-gender" class="input-field" required>
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
            >
              Sign Up
            </button>
          </div>

          <p class="login_page">
            Already have an account? <a href="login.php">Login here</a>
          </p>
        </fieldset>
      </div>

      <!-- Employer Registration Form -->
      <div id="employer-form" class="registration-form">
        <fieldset class="login-box">
          <legend class="login-title">Employer Registration</legend>

          <label for="employer-company-name">Company Name</label>
          <input
            type="text"
            id="employer-company-name"
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
            class="input-field"
            placeholder="Company Address"
            required
          />
          <div class="error-message" id="employerAddressError">
            Company address is required.
          </div>

          <label for="employer-industry">Industry</label>
          <select id="employer-industry" class="input-field" required>
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
            >
              Sign Up
            </button>
          </div>

          <p class="login_page">
            Already have an account? <a href="login.php">Login here</a>
          </p>
        </fieldset>
      </div>
    </section>

    <script src="../Js/registration.js"></script>
  </body>
</html>
