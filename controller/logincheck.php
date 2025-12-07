<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 0); // Don't display, but log
ini_set('log_errors', 1);

session_start();
require_once '../model/user_model.php';
require_once '../model/validation.php';

// Debug: Log that we received the request
error_log("=== LOGIN REQUEST RECEIVED ===");
error_log("POST data: " . print_r($_POST, true));
error_log("Session ID: " . session_id());

if (isset($_POST['submit'])) {
    $errors = [];
    
    // Get and sanitize inputs
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $user_type = isset($_POST['user_type']) ? trim($_POST['user_type']) : '';
    
    error_log("Processing login - Email: $email, User Type: $user_type");
    
    // Validate email
    $emailError = validateEmail($email);
    if($emailError !== "") {
        $errors['email'] = $emailError;
    }
    
    // Validate password
    $passwordError = validatePassword($password);
    if($passwordError !== "") {
        $errors['password'] = $passwordError;
    }
    
    // Validate user type
    if(!in_array($user_type, ['applicant', 'employer'])) {
        $errors['user_type'] = "Invalid user type";
    }
    
    // If there are any errors, redirect back with error messages
    if(!empty($errors)) {
        error_log("Validation errors: " . print_r($errors, true));
        $_SESSION['login_errors'] = $errors;
        header('Location: ../view/login.php');
        exit();
    }
    
    // If validation passes, attempt login
    $user = [
        'email' => $email,
        'password' => $password,
        'user_type' => $user_type
    ];
    
    error_log("Calling login function...");
    $loginResult = login($user);
    error_log("Login result: " . ($loginResult ? 'TRUE' : 'FALSE'));
    
    if ($loginResult) {
        // Set session variables
        $_SESSION['status'] = true;
        $_SESSION['last_activity'] = time();
        $_SESSION['expire_time'] = 30 * 60; // 30 minutes
        
        error_log("Login successful! Session data: " . print_r($_SESSION, true));
        error_log("Redirecting to home.php...");
        
        // Clear all output buffers
        while (ob_get_level()) {
            ob_end_clean();
        }
        
        // Use absolute path for redirect
        $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];
        $redirectUrl = $baseUrl . '/job/view/home.php';
        
        error_log("Redirect URL: $redirectUrl");
        
        // Redirect to home page
        header('Location: ' . $redirectUrl);
        exit();
    } else {
        error_log("Login failed - Email: $email, User Type: $user_type");
        $_SESSION['login_error'] = "Invalid email or password! Please check your credentials.";
        $_SESSION['old_input'] = ['email' => $email];
        
        if (ob_get_length()) {
            ob_clean();
        }
        
        header('Location: ../view/login.php');
        exit();
    }
} else {
    error_log("No submit button in POST data");
    $_SESSION['login_error'] = "Please submit the form properly!";
    
    if (ob_get_length()) {
        ob_clean();
    }
    
    header('Location: ../view/login.php');
    exit();
}
?>
