
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Employify</title>
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/forgot-password.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>
    <div class="forgot-password-container">
        <div class="forgot-password-box">
            <h1><i class="fas fa-lock"></i> Forgot Password</h1>
            
            <!-- Progress Steps -->
            <div class="progress-steps">
                <div class="step active" id="step1">
                    <div class="step-number">1</div>
                    <div class="step-text">Verify Email</div>
                </div>
                <div class="step" id="step2">
                    <div class="step-number">2</div>
                    <div class="step-text">Reset Password</div>
                </div>
            </div>

            <!-- Email Verification Form -->
            <form id="emailForm" class="form active">
                <p class="form-text">Enter your email address to verify your account.</p>
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email Address</label>
                    <input type="email" id="email" class="form-control" placeholder="Enter your email" required>
                    <div class="error-message" id="emailError"></div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-check"></i> Verify Email
                </button>
                <div class="form-footer">
                    Remember your password? <a href="login.php">Login here</a>
                </div>
            </form>

            <!-- Reset Password Form -->
            <form id="resetPasswordForm" class="form">
                <p class="form-text">Create a new password for your account.</p>
                <div class="user-info" id="userInfo" style="display: none;">
                    <i class="fas fa-user"></i>
                    <span id="userName"></span>
                </div>
                <input type="hidden" id="userEmail" value="">
                <input type="hidden" id="userType" value="">
                <div class="form-group">
                    <label for="newPassword"><i class="fas fa-lock"></i> New Password</label>
                    <div class="password-input">
                        <input type="password" id="newPassword" class="form-control" placeholder="Enter new password" required>
                        <i class="fas fa-eye toggle-password"></i>
                    </div>
                    <div class="error-message" id="passwordError"></div>
                    <small class="form-help">Password must be at least 6 characters long</small>
                </div>
                <div class="form-group">
                    <label for="confirmPassword"><i class="fas fa-lock"></i> Confirm New Password</label>
                    <div class="password-input">
                        <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm new password" required>
                        <i class="fas fa-eye toggle-password"></i>
                    </div>
                    <div class="error-message" id="confirmPasswordError"></div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-key"></i> Reset Password
                </button>
                <div class="form-footer">
                    <a href="#" id="backToEmailLink"><i class="fas fa-arrow-left"></i> Back to Email</a>
                </div>
            </form>
        </div>
    </div>

    <script src="../assets/js/notification.js"></script>
    <script src="../assets/js/forgot-password.js"></script>
</body>
</html>

