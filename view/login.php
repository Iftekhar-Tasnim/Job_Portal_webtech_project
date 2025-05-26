<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Job Portal Login</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="main-container">
        <div class="welcome-section">
            <h2>Welcome to Job Portal</h2>
            <p>Please sign in to continue</p>
        </div>
        <div class="login-options">
            <button class="login-option active" data-type="applicant">Applicant Login</button>
            <button class="login-option" data-type="employer">Employer Login</button>
        </div>
        <div class="login-panels">
            <?php
            if (isset($_SESSION['login_error'])) {
                echo '<div class="error-message">' . htmlspecialchars($_SESSION['login_error']) . '</div>';
                unset($_SESSION['login_error']);
            }
            ?>
            <div class="login-panel active" id="applicantLogin">
                <form id="applicantLoginForm" action="../controller/logincheck.php" method="POST">
                    <input type="hidden" name="user_type" value="applicant">
                    <div class="input-group">
                        <label for="applicantEmail"><i class="fas fa-envelope"></i> Email Address</label>
                        <input type="email" id="applicantEmail" name="email" required>
                        <div class="validation-message" id="applicantEmailError">Please enter a valid email address.</div>
                    </div>
                    <div class="input-group">
                        <label for="applicantPassword"><i class="fas fa-lock"></i> Password</label>
                        <input type="password" id="applicantPassword" name="password" required>
                        <div class="validation-message" id="applicantPasswordError">Password is required.</div>
                    </div>
                    <div class="form-actions">
                        <a href="forgetpass.php" class="password-reset-link">Forgot Password?</a>
                        <button type="submit" class="submit-button" name="submit">Login as Applicant</button>
                    </div>
                </form>
            </div>
            <div class="login-panel" id="employerLogin">
                <form id="employerLoginForm" action="../controller/logincheck.php" method="POST">
                    <input type="hidden" name="user_type" value="employer">
                    <div class="input-group">
                        <label for="employerEmail"><i class="fas fa-envelope"></i> Company Email</label>
                        <input type="email" id="employerEmail" name="email" required>
                        <div class="validation-message" id="employerEmailError">Please enter a valid email address.</div>
                    </div>
                    <div class="input-group">
                        <label for="employerPassword"><i class="fas fa-lock"></i> Password</label>
                        <input type="password" id="employerPassword" name="password" required>
                        <div class="validation-message" id="employerPasswordError">Password is required.</div>
                    </div>
                    <div class="form-actions">
                        <a href="forgetpass.php" class="password-reset-link">Forgot Password?</a>
                        <button type="submit" class="submit-button" name="submit">Login as Employer</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="registration-link">
            <p>New to Job Portal? <a href="registration.php">Create an account</a></p>
        </div>
    </div>
    <script src="../assets/js/login.js"></script>
</body>
</html> 