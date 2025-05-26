<?php
require_once 'db.php';

function login($user) {
    $con = getConnection();
    $email = $user['email'];
    $password = $user['password'];
    $user_type = $user['user_type'];

    // First check in the appropriate registration table
    if ($user_type === 'applicant') {
        $sql = "SELECT * FROM applicantreg WHERE Email = ?";
    } else {
        $sql = "SELECT * FROM employerreg WHERE Email = ?";
    }

    // Prepare and execute the statement
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // Check if password is hashed or plain text
        if (password_verify($password, $row['Password']) || $password === $row['Password']) {
            // Store user data in session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $row['Email'];
            $_SESSION['user_type'] = $user_type;
            
            if ($user_type === 'applicant') {
                $_SESSION['name'] = $row['First_Name'] . ' ' . $row['Last_Name'];
            } else {
                $_SESSION['name'] = $row['Company_Name'];
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
    

    // Check if username or email already exists
    $checkSql = "SELECT * FROM applicantreg WHERE Email = '$email' OR Phone = '$phone'";
    $checkResult = mysqli_query($con, $checkSql);

    if (mysqli_num_rows($checkResult) > 0) {
        mysqli_close($con);
        return "exists"; // Username/email already exists
    }

    $sql1 = "INSERT INTO applicantreg (First_Name, Last_Name, Email, Password, Phone, Address, Gender)
             VALUES ('$fname', '$lname', '$email', '$pass', '$phone', '$address', '$gender')";

    $success1 = mysqli_query($con, $sql1);
    
    mysqli_close($con);

    return ($success1) ? "success" : "fail";
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