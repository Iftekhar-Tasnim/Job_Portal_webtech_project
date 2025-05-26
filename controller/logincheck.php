<?php
session_start();
require_once '../model/user_model.php';

if (isset($_POST['submit'])) {
   
    if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['user_type'])) {
        
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $user_type = trim($_POST['user_type']);

        // Validate inputs
        if (empty($email) || empty($password)) {
            $_SESSION['login_error'] = "Email and password are required!";
            header('Location: ../view/login.php?error=empty');
            exit();
        }

        
        if (!strpos($email, '@') || !strpos($email, '.')) {
            $_SESSION['login_error'] = "Invalid email format!";
            header('Location: ../view/login.php?error=invalid_email');
            exit();
        }

        if (strlen($password) < 6) {
            $_SESSION['login_error'] = "Password must be at least 6 characters long!";
            header('Location: ../view/login.php?error=short_password');
            exit();
        }

        $user = [
            'email' => $email,
            'password' => $password,
            'user_type' => $user_type
        ];

        if (login($user)) {
            // Set session timeout (30 minutes)
            $_SESSION['last_activity'] = time();
            $_SESSION['expire_time'] = 30 * 60; // 30 minutes in seconds

            // Redirect to home page after successful login
            header('Location: ../view/home.php');
            exit();
        } else {
            $_SESSION['login_error'] = "Invalid email or password!";
            header('Location: ../view/login.php?error=invalid_credentials');
            exit();
        }
    } else {
        $_SESSION['login_error'] = "Missing required fields!";
        header('Location: ../view/login.php?error=missing_fields');
        exit();
    }
} else {
    $_SESSION['login_error'] = "Invalid request! Please submit the form!";
    header('Location: ../view/login.php?error=invalid_request');
    exit();
}
?>