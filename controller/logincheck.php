<?php
session_start();
require_once '../model/user_model.php';
require_once '../model/validation.php';

if (isset($_POST['submit'])) {
    $errors = [];
    
    // Get and sanitize inputs
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $user_type = isset($_POST['user_type']) ? trim($_POST['user_type']) : '';
    
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
    
    if (login($user)) {
        // Set session variables
        $_SESSION['status'] = true;
        $_SESSION['last_activity'] = time();
        $_SESSION['expire_time'] = 30 * 60; // 30 minutes
        
        // Redirect to home page
        header('Location: ../view/home.php');
        exit();
    } else {
        $_SESSION['login_error'] = "Invalid email or password!";
        header('Location: ../view/login.php');
        exit();
    }
} else {
    $_SESSION['login_error'] = "Please submit the form properly!";
    header('Location: ../view/login.php');
    exit();
}
?>