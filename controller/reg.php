<?php
session_start();
//require_once 'validate_register.php';
require_once '../model/user_model.php';

if (isset($_POST['submit'])) {
    $fname  = trim($_POST['First_Name']);
    $lname  = trim($_POST['Last_Name']);
    $email  = trim($_POST['Email']);
    $pass   = trim($_POST['Password']);
    $cpass  = trim($_POST['confirm_password']);
    $phone  = trim($_POST['Phone']);
    $address  = trim($_POST['Address']);
    $gender  = trim($_POST['Gender']);  


    // $validationErrors = validateRegisterInput($fname, $lname, $uname, $email, $pass, $cpass, $terms);

    // if (!empty($validationErrors)) {
    //     $_SESSION['register_errors'] = $validationErrors;
    //     $_SESSION['form_data'] = $_POST;
    //     header('Location: ../view/register.php');
    //     exit();
    // }

    $user = [
        'First_Name' => $fname,
        'Last_Name'  => $lname,
        'Email'     => $email,
        'Password'  => $pass,
        'Phone'     => $phone,
        'Address'   => $address,
        'Gender'    => $gender
    ];

    $result = register($user);

    if ($result === "exists") {
        $_SESSION['register_errors']['email'] = "Email already exists";
    } elseif ($result === "fail") {
        $_SESSION['register_errors']['database'] = "Registration failed. Please try again.";
    } else {
        $_SESSION['status'] = true;
        $_SESSION['email'] = $email;
        header("Location: ../view/login.php");
        exit();
    }

    $_SESSION['form_data'] = $_POST;
    header('Location: ../view/login.php');
} else {
    $_SESSION['register_errors']['request'] = "Invalid request! Please submit the form.";
    header('Location: ../view/registration.php');
}