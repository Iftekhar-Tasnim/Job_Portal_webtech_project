<?php

function validateEmail($email) {
    $email = trim($email);
    
    if(empty($email)) {
        return "Email is required";
    }
    
    if(!strpos($email, '@') || !strpos($email, '.')) {
        return "Invalid email format";
    }
    
    if(strlen($email) < 5) {
        return "Email is too short";
    }
    
    return "";
}

function validatePassword($password) {
    $password = trim($password);
    
    if(empty($password)) {
        return "Password is required";
    }
    
    if(strlen($password) < 6) {
        return "Password must be at least 6 characters long";
    }
    
    if(strlen($password) > 50) {
        return "Password is too long";
    }
    
    return "";
}

function validateName($name, $field = "Name") {
    $name = trim($name);
    
    if(empty($name)) {
        return "$field is required";
    }
    
    if(strlen($name) < 2) {
        return "$field is too short";
    }
    
    if(strlen($name) > 50) {
        return "$field is too long";
    }
    
   
    
    return "";
}

function validatePhone($phone) {
    $phone = trim($phone);
    $phone = str_replace(['-', ' ', '(', ')', '+'], '', $phone);
    
    if(empty($phone)) {
        return "Phone number is required";
    }
    
    if(!ctype_digit($phone)) {
        return "Phone number should contain only digits";
    }
    
    // Assuming minimum 10 digits
    if(strlen($phone) < 10 || strlen($phone) > 15) {
        return "Phone number should be between 10 and 15 digits";
    }
    
    return "";
}

function validateAddress($address) {
    $address = trim($address);
    
    if(empty($address)) {
        return "Address is required";
    }
    
    if(strlen($address) < 5) {
        return "Address is too short";
    }
    
    if(strlen($address) > 200) {
        return "Address is too long";
    }
    
    return "";
}

function validateCompanyName($name) {
    $name = trim($name);
    
    if(empty($name)) {
        return "Company name is required";
    }
    
    if(strlen($name) < 2) {
        return "Company name is too short";
    }
    
    if(strlen($name) > 100) {
        return "Company name is too long";
    }
    
    return "";
}
?> 