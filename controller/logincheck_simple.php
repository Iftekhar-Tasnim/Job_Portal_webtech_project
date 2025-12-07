<?php
/**
 * Simplified Login Check - For Testing
 * Use this to test if the issue is with the main controller
 */

session_start();
require_once '../model/user_model.php';
require_once '../model/validation.php';

// Simple test - just redirect on any POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $user_type = $_POST['user_type'] ?? '';
    
    echo "<!DOCTYPE html><html><head><title>Login Test</title></head><body>";
    echo "<h1>Login Test Results</h1>";
    echo "<p>Email: $email</p>";
    echo "<p>User Type: $user_type</p>";
    echo "<p>Password received: " . (strlen($password) > 0 ? 'YES' : 'NO') . "</p>";
    
    if (!empty($email) && !empty($password) && !empty($user_type)) {
        $user = [
            'email' => trim($email),
            'password' => trim($password),
            'user_type' => trim($user_type)
        ];
        
        $result = login($user);
        
        if ($result) {
            $_SESSION['status'] = true;
            $_SESSION['last_activity'] = time();
            $_SESSION['expire_time'] = 30 * 60;
            
            echo "<p style='color: green;'><strong>✅ LOGIN SUCCESSFUL!</strong></p>";
            echo "<p>Session variables set. Redirecting in 2 seconds...</p>";
            echo "<script>setTimeout(function(){ window.location.href = '../view/home.php'; }, 2000);</script>";
        } else {
            echo "<p style='color: red;'><strong>❌ LOGIN FAILED</strong></p>";
            echo "<p>Login function returned false.</p>";
        }
    } else {
        echo "<p style='color: orange;'>Missing required fields</p>";
    }
    
    echo "</body></html>";
} else {
    header('Location: ../view/login.php');
    exit();
}
?>

