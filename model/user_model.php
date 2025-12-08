<?php
require_once 'db.php';

function login($user) {
    // Ensure session is started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $con = getConnection();
    $email = trim($user['email']);
    $password = trim($user['password']);
    $user_type = trim($user['user_type']);

    // First check in the appropriate registration table
    if ($user_type === 'applicant') {
        $sql = "SELECT * FROM applicantreg WHERE Email = ?";
    } else if ($user_type === 'employer') {
        $sql = "SELECT * FROM employerreg WHERE Email = ?";
    } else {
        mysqli_close($con);
        return false;
    }

    // Prepare and execute the statement
    $stmt = mysqli_prepare($con, $sql);
    if (!$stmt) {
        mysqli_close($con);
        return false;
    }
    
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // Get password from database - handle case sensitivity
        $dbPassword = isset($row['Password']) ? $row['Password'] : (isset($row['password']) ? $row['password'] : '');
        
        // Debug: Log what we're comparing (remove in production)
        error_log("Login attempt - Email: $email, User Type: $user_type, DB Password length: " . strlen($dbPassword) . ", Input password: $password");
        
        // Check if password is hashed or plain text
        // Try password_verify first (for hashed passwords)
        $passwordMatch = false;
        
        // First try: password_verify (for hashed passwords)
        if (strlen($dbPassword) > 20) {
            if (password_verify($password, $dbPassword)) {
                $passwordMatch = true;
            }
        }
        
        // Second try: direct comparison (for plain text passwords)
        if (!$passwordMatch && $password === $dbPassword) {
            $passwordMatch = true;
        }
        
        // Third try: trimmed comparison
        if (!$passwordMatch && trim($password) === trim($dbPassword)) {
            $passwordMatch = true;
        }
        
        // Fourth try: case-insensitive comparison
        if (!$passwordMatch && strtolower(trim($password)) === strtolower(trim($dbPassword))) {
            $passwordMatch = true;
        }
        
        if ($passwordMatch) {
            // Store user data in session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $row['Email'];
            $_SESSION['user_type'] = $user_type;
            
            if ($user_type === 'applicant') {
                $_SESSION['name'] = $row['First_Name'] . ' ' . $row['Last_Name'];
            } else {
                $_SESSION['name'] = isset($row['Company_Name']) ? $row['Company_Name'] : 'Employer';
            }
            
            mysqli_stmt_close($stmt);
            mysqli_close($con);
            return true;
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
    return false;
}

function register($user) {
    $con = getConnection();

    $fname = $user['First_Name'];
    $lname = $user['Last_Name'];
    $email = $user['Email'];
    $pass  = $user['Password'];
    $phone = $user['Phone'];
    $address = $user['Address'];
    $gender = $user['Gender'];
    

    // Check if email or phone already exists
    $checkSql = "SELECT * FROM applicantreg WHERE Email = ? OR Phone = ?";
    $stmt = mysqli_prepare($con, $checkSql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $email, $phone);
        mysqli_stmt_execute($stmt);
        $checkResult = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($checkResult) > 0) {
            mysqli_stmt_close($stmt);
            mysqli_close($con);
            return "exists"; // Email/phone already exists
        }
        mysqli_stmt_close($stmt);
    }

    // Use prepared statement for insert
    $sql = "INSERT INTO applicantreg (First_Name, Last_Name, Email, Password, Phone, Address, Gender)
             VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssss", $fname, $lname, $email, $pass, $phone, $address, $gender);
        $success = mysqli_stmt_execute($stmt);
        
        if (!$success) {
            error_log("Applicant registration failed: " . mysqli_stmt_error($stmt));
        }
        
        mysqli_stmt_close($stmt);
    } else {
        error_log("Failed to prepare statement for applicant registration: " . mysqli_error($con));
        $success = false;
    }
    
    mysqli_close($con);

    return ($success) ? "success" : "fail";
}

function registerEmployer($user) {
    $con = getConnection();

    $companyName = isset($user['Company_Name']) ? trim($user['Company_Name']) : '';
    $email = isset($user['Email']) ? trim($user['Email']) : '';
    $pass = isset($user['Password']) ? trim($user['Password']) : '';
    $phone = isset($user['Company_Phone']) ? trim($user['Company_Phone']) : '';
    $address = isset($user['Company_Address']) ? trim($user['Company_Address']) : '';
    $industry = isset($user['Industry']) ? trim($user['Industry']) : '';
    $website = isset($user['Company_Website']) ? trim($user['Company_Website']) : '';

    // Check if email already exists
    $checkSql = "SELECT * FROM employerreg WHERE Email = ?";
    $stmt = mysqli_prepare($con, $checkSql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $checkResult = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($checkResult) > 0) {
            mysqli_stmt_close($stmt);
            mysqli_close($con);
            return "exists"; // Email already exists
        }
        mysqli_stmt_close($stmt);
    }

    // Use prepared statement for insert
    $sql = "INSERT INTO employerreg (Company_Name, Email, Password, Company_Phone, Company_Address, Industry, Company_Website)
             VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssss", $companyName, $email, $pass, $phone, $address, $industry, $website);
        $success = mysqli_stmt_execute($stmt);
        
        if (!$success) {
            error_log("Employer registration failed: " . mysqli_stmt_error($stmt));
        }
        
        mysqli_stmt_close($stmt);
    } else {
        error_log("Failed to prepare statement for employer registration: " . mysqli_error($con));
        $success = false;
    }
    
    mysqli_close($con);

    return ($success) ? "success" : "fail";
}

function addUser($user) {
    $con = getConnection();

    $fname = $user['firstname'];
    $lname = $user['lastname'];
    $uname = $user['username'];
    $email = $user['email'];
    $pass  = $user['password'];

    // Check if username or email already exists
    $checkSql = "SELECT * FROM singup WHERE u_username = '$uname' OR u_email = '$email'";
    $checkResult = mysqli_query($con, $checkSql);

    if (mysqli_num_rows($checkResult) > 0) {
        mysqli_close($con);
        return "exists"; // Username/email already exists
    }

    $sql1 = "INSERT INTO singup (u_fname, u_lname, u_username, u_email, u_password)
             VALUES ('$fname', '$lname', '$uname', '$email', '$pass')";

    $sql2 = "INSERT INTO login (uname, pass)
             VALUES ('$uname', '$pass')";

    $success1 = mysqli_query($con, $sql1);
    $success2 = mysqli_query($con, $sql2);

    mysqli_close($con);

    return ($success1 && $success2) ? "success" : "fail";


    
}   
?>