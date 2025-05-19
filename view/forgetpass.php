

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Job Portal</title>
    <link rel="stylesheet" href="../assets/css/forgot-password.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="forgot-password-container">
        <div class="forgot-password-box">
            <h1><i class="fas fa-lock"></i> Forgot Password</h1>
            
            <!-- Progress Steps -->
            <div class="progress-steps">
                <div class="step active" id="step1">
                    <div class="step-number">1</div>
                    <div class="step-text">Email Verification</div>
                </div>
                <div class="step" id="step2">
                    <div class="step-number">2</div>
                    <div class="step-text">Security Question</div>
                </div>
                <div class="step" id="step3">
                    <div class="step-number">3</div>
                    <div class="step-text">Reset Password</div>
                </div>
            </div>

            <!-- Email Verification Form -->
            <form id="emailForm" class="form active">
                <p class="form-text">Enter your email address to receive a verification code.</p>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" class="form-control" placeholder="Enter your email" required>
                    <div class="error-message" id="emailError"></div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Send Verification Code</button>
                <div class="form-footer">
                    Remember your password? <a href="login.php">Login here</a>
                </div>
            </form>

            <!-- Security Question Form -->
            <form id="securityQuestionForm" class="form">
                <p class="form-text">Please answer your security question.</p>
                <div class="form-group">
                    <label>Security Question</label>
                    <div class="security-question" id="securityQuestion"></div>
                </div>
                <div class="form-group">
                    <label for="securityAnswer">Your Answer</label>
                    <input type="text" id="securityAnswer" class="form-control" required>
                    <div class="error-message" id="answerError"></div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Verify Answer</button>
                <div class="form-footer">
                    <a href="#" id="backToEmailLink"><i class="fas fa-arrow-left"></i> Back to Email</a>
                </div>
            </form>

            <!-- Reset Password Form -->
            <form id="resetPasswordForm" class="form">
                <p class="form-text">Create a new password for your account.</p>
                <div class="form-group">
                    <label for="newPassword">New Password</label>
                    <div class="password-input">
                        <input type="password" id="newPassword" class="form-control" required>
                        <i class="fas fa-eye toggle-password"></i>
                    </div>
                    <div class="error-message" id="passwordError"></div>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm New Password</label>
                    <div class="password-input">
                        <input type="password" id="confirmPassword" class="form-control" required>
                        <i class="fas fa-eye toggle-password"></i>
                    </div>
                    <div class="error-message" id="confirmPasswordError"></div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                <div class="form-footer">
                    <a href="#" id="backToSecurityLink"><i class="fas fa-arrow-left"></i> Back to Security Question</a>
                </div>
            </form>
        </div>
    </div>

    <script src="Js/forgot-password.js"></script>
</body>
</html>

