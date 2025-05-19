<?php
session_start();

// If user is already logged in, redirect to appropriate dashboard
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['user_type'] === 'employer') {
        header('Location: employer-dashboard.php');
    } else {
        header('Location: applicant-dashboard.php');
    }
    exit();
}

// Demo credentials
$demo_credentials = [
    'applicant' => [
        'email' => 'demo@applicant.com',
        'password' => 'demo123',
        'name' => 'Demo Applicant'
    ],
    'employer' => [
        'email' => 'demo@employer.com',
        'password' => 'demo123',
        'name' => 'Demo Employer'
    ]
];

// Process login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $userType = $_POST['user_type'] ?? '';

    // Check against demo credentials
    if ($userType && isset($demo_credentials[$userType])) {
        $demo = $demo_credentials[$userType];
        if ($email === $demo['email'] && $password === $demo['password']) {
            // Set session variables
            $_SESSION['user_id'] = 1;
            $_SESSION['user_name'] = $demo['name'];
            $_SESSION['user_type'] = $userType;
            
            // Redirect based on user type
            if ($userType === 'employer') {
                header("Location: employer-dashboard.php");
            } else {
                header("Location: applicant-dashboard.php");
            }
            exit();
        }
    }
    
    // If login fails, set error message
    $error_message = "Invalid email or password";
}
?>
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
            <div class="login-panel active" id="applicantLogin">
                <form id="applicantLoginForm" action="process_login.php" method="POST">
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
                        <button type="submit" class="submit-button">Login as Applicant</button>
                    </div>
                </form>
            </div>
            <div class="login-panel" id="employerLogin">
                <form id="employerLoginForm" action="process_login.php" method="POST">
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
                        <button type="submit" class="submit-button">Login as Employer</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="registration-link">
            <p>New to Job Portal? <a href="Registration.php">Create an account</a></p>
        </div>
    </div>
    <script src="./Js/login.js"></script>
</body>
</html> 