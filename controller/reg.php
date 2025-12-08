<?php
session_start();
require_once '../model/user_model.php';
require_once '../model/validation.php';

// Check if form was submitted (either via submit button or hidden input)
if (isset($_POST['submit']) || isset($_POST['user_type'])) {
    $user_type = isset($_POST['user_type']) ? trim($_POST['user_type']) : '';
    
    // Clear previous errors
    unset($_SESSION['register_errors']);
    unset($_SESSION['register_success']);
    
    if ($user_type === 'applicant') {
        // Applicant Registration
        $fname = isset($_POST['First_Name']) ? trim($_POST['First_Name']) : '';
        $lname = isset($_POST['Last_Name']) ? trim($_POST['Last_Name']) : '';
        $email = isset($_POST['Email']) ? trim($_POST['Email']) : '';
        $pass = isset($_POST['Password']) ? trim($_POST['Password']) : '';
        $cpass = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';
        $phone = isset($_POST['Phone']) ? trim($_POST['Phone']) : '';
        $address = isset($_POST['Address']) ? trim($_POST['Address']) : '';
        $gender = isset($_POST['Gender']) ? trim($_POST['Gender']) : '';
        
        $errors = [];
        
        // Validation
        if (empty($fname)) {
            $errors[] = "First name is required";
        }
        
        if (empty($lname)) {
            $errors[] = "Last name is required";
        }
        
        if (empty($email)) {
            $errors[] = "Email is required";
        } else {
            $emailError = validateEmail($email);
            if ($emailError !== "") {
                $errors[] = $emailError;
            }
        }
        
        if (empty($phone)) {
            $errors[] = "Phone number is required";
        }
        
        if (empty($address)) {
            $errors[] = "Address is required";
        }
        
        if (empty($gender)) {
            $errors[] = "Gender is required";
        }
        
        if (empty($pass)) {
            $errors[] = "Password is required";
        } else {
            $passwordError = validatePassword($pass);
            if ($passwordError !== "") {
                $errors[] = $passwordError;
            }
        }
        
        if (empty($cpass)) {
            $errors[] = "Please confirm your password";
        } else if ($pass !== $cpass) {
            $errors[] = "Passwords do not match";
        }
        
        // If there are validation errors, redirect back
        if (!empty($errors)) {
            $_SESSION['register_errors'] = $errors;
            $_SESSION['form_data'] = $_POST;
            header('Location: ../view/registration.php');
            exit();
        }
        
        // Prepare user data
        $user = [
            'First_Name' => $fname,
            'Last_Name' => $lname,
            'Email' => $email,
            'Password' => $pass,
            'Phone' => $phone,
            'Address' => $address,
            'Gender' => $gender
        ];
        
        // Attempt registration
        $result = register($user);
        
        if ($result === "exists") {
            $_SESSION['register_errors'] = ["Email or phone number already exists. Please use a different email or phone number."];
            $_SESSION['form_data'] = $_POST;
            header('Location: ../view/registration.php');
            exit();
        } elseif ($result === "fail") {
            $_SESSION['register_errors'] = ["Registration failed. Please try again."];
            $_SESSION['form_data'] = $_POST;
            header('Location: ../view/registration.php');
            exit();
        } else {
            // Success
            $_SESSION['register_success'] = "Registration successful! You can now login.";
            header('Location: ../view/login.php');
            exit();
        }
        
    } else if ($user_type === 'employer') {
        // Employer Registration
        $companyName = isset($_POST['Company_Name']) ? trim($_POST['Company_Name']) : '';
        $email = isset($_POST['Email']) ? trim($_POST['Email']) : '';
        $pass = isset($_POST['Password']) ? trim($_POST['Password']) : '';
        $cpass = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';
        $phone = isset($_POST['Company_Phone']) ? trim($_POST['Company_Phone']) : '';
        $address = isset($_POST['Company_Address']) ? trim($_POST['Company_Address']) : '';
        $industry = isset($_POST['Industry']) ? trim($_POST['Industry']) : '';
        $website = isset($_POST['Company_Website']) ? trim($_POST['Company_Website']) : '';
        
        $errors = [];
        
        // Validation
        if (empty($companyName)) {
            $errors[] = "Company name is required";
        }
        
        if (empty($email)) {
            $errors[] = "Email is required";
        } else {
            $emailError = validateEmail($email);
            if ($emailError !== "") {
                $errors[] = $emailError;
            }
        }
        
        if (empty($phone)) {
            $errors[] = "Company phone number is required";
        }
        
        if (empty($address)) {
            $errors[] = "Company address is required";
        }
        
        if (empty($industry)) {
            $errors[] = "Industry is required";
        }
        
        if (empty($website)) {
            $errors[] = "Company website is required";
        } else {
            // Basic URL validation
            if (!filter_var($website, FILTER_VALIDATE_URL)) {
                $errors[] = "Please enter a valid website URL";
            }
        }
        
        if (empty($pass)) {
            $errors[] = "Password is required";
        } else {
            $passwordError = validatePassword($pass);
            if ($passwordError !== "") {
                $errors[] = $passwordError;
            }
        }
        
        if (empty($cpass)) {
            $errors[] = "Please confirm your password";
        } else if ($pass !== $cpass) {
            $errors[] = "Passwords do not match";
        }
        
        // If there are validation errors, redirect back
        if (!empty($errors)) {
            $_SESSION['register_errors'] = $errors;
            $_SESSION['form_data'] = $_POST;
            header('Location: ../view/registration.php');
            exit();
        }
        
        // Prepare user data
        $user = [
            'Company_Name' => $companyName,
            'Email' => $email,
            'Password' => $pass,
            'Company_Phone' => $phone,
            'Company_Address' => $address,
            'Industry' => $industry,
            'Company_Website' => $website
        ];
        
        // Attempt registration
        $result = registerEmployer($user);
        
        if ($result === "exists") {
            $_SESSION['register_errors'] = ["Email already exists. Please use a different email address."];
            $_SESSION['form_data'] = $_POST;
            header('Location: ../view/registration.php');
            exit();
        } elseif ($result === "fail") {
            $_SESSION['register_errors'] = ["Registration failed. Please try again."];
            $_SESSION['form_data'] = $_POST;
            header('Location: ../view/registration.php');
            exit();
        } else {
            // Success
            $_SESSION['register_success'] = "Registration successful! You can now login.";
            header('Location: ../view/login.php');
            exit();
        }
        
    } else {
        // Invalid user type
        $_SESSION['register_errors'] = ["Invalid user type. Please select either Applicant or Employer."];
        header('Location: ../view/registration.php');
        exit();
    }
} else {
    // No submit button or user_type
    $_SESSION['register_errors'] = ["Invalid request! Please submit the form properly."];
    header('Location: ../view/registration.php');
    exit();
}
?>
