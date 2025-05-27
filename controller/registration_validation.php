<?php
session_start();
require_once '../model/validation.php';

function validateRegistration($data, $type = 'applicant') {
    $errors = [];
    
    $emailError = validateEmail($data['email'] ?? '');
    if($emailError !== "") {
        $errors['email'] = $emailError;
    }
    
    $passwordError = validatePassword($data['password'] ?? '');
    if($passwordError !== "") {
        $errors['password'] = $passwordError;
    }
    
    if(($data['password'] ?? '') !== ($data['confirm_password'] ?? '')) {
        $errors['confirm_password'] = "Passwords do not match";
    }
    
    if($type === 'applicant') {
        $firstNameError = validateName($data['First_Name'] ?? '', 'First name');
        if($firstNameError !== "") {
            $errors['First_Name'] = $firstNameError;
        }
        
        $lastNameError = validateName($data['Last_Name'] ?? '', 'Last name');
        if($lastNameError !== "") {
            $errors['Last_Name'] = $lastNameError;
        }
        
        $phoneError = validatePhone($data['Phone'] ?? '');
        if($phoneError !== "") {
            $errors['Phone'] = $phoneError;
        }
        
        $addressError = validateAddress($data['Address'] ?? '');
        if($addressError !== "") {
            $errors['Address'] = $addressError;
        }
        
        if(!isset($data['Gender']) || !in_array($data['Gender'], ['Male', 'Female', 'Other'])) {
            $errors['Gender'] = "Please select a valid gender";
        }
        
    } else {
        $companyNameError = validateCompanyName($data['Company_Name'] ?? '');
        if($companyNameError !== "") {
            $errors['Company_Name'] = $companyNameError;
        }
        
        $addressError = validateAddress($data['Company_Address'] ?? '');
        if($addressError !== "") {
            $errors['Company_Address'] = $addressError;
        }
        
        $phoneError = validatePhone($data['Company_Phone'] ?? '');
        if($phoneError !== "") {
            $errors['Company_Phone'] = $phoneError;
        }
        
        if(empty($data['Business_Type'] ?? '')) {
            $errors['Business_Type'] = "Business type is required";
        }
        
        if(empty($data['Company_Size'] ?? '')) {
            $errors['Company_Size'] = "Company size is required";
        }
    }
    
    return $errors;
}

if(isset($_POST['submit'])) {
    $user_type = $_POST['user_type'] ?? 'applicant';
    
    $_SESSION['old_input'] = $_POST;
    
    $errors = validateRegistration($_POST, $user_type);
    
    if(empty($errors)) {
        require_once '../model/user_model.php';
        
        if(register($_POST)) {
            $_SESSION['success'] = "Registration successful! Please login.";
            header('Location: ../view/login.php');
            exit();
        } else {
            $_SESSION['registration_error'] = "Registration failed. Please try again.";
            header('Location: ../view/registration.php');
            exit();
        }
    } else {
        $_SESSION['registration_errors'] = $errors;
        header('Location: ../view/registration.php');
        exit();
    }
} else {
    $_SESSION['registration_error'] = "Please submit the form properly!";
    header('Location: ../view/registration.php');
    exit();
}
?> 