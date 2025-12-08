<?php
require_once 'db.php';

/**
 * Check if email exists in applicant or employer table
 */
function checkEmailExists($email) {
    $con = getConnection();
    
    // Check in applicantreg
    $sql = "SELECT id, Email, 'applicant' as user_type, First_Name, Last_Name FROM applicantreg WHERE Email = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($result)) {
        mysqli_stmt_close($stmt);
        mysqli_close($con);
        return $row;
    }
    mysqli_stmt_close($stmt);
    
    // Check in employerreg
    $sql = "SELECT id, Email, 'employer' as user_type, Company_Name as First_Name, '' as Last_Name FROM employerreg WHERE Email = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($result)) {
        mysqli_stmt_close($stmt);
        mysqli_close($con);
        return $row;
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    return false;
}

/**
 * Reset password for applicant
 */
function resetApplicantPassword($email, $newPassword) {
    $con = getConnection();
    $sql = "UPDATE applicantreg SET Password = ? WHERE Email = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $newPassword, $email);
    $success = mysqli_stmt_execute($stmt);
    
    if (!$success) {
        error_log("Password reset failed for applicant: " . mysqli_error($con));
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    return $success;
}

/**
 * Reset password for employer
 */
function resetEmployerPassword($email, $newPassword) {
    $con = getConnection();
    $sql = "UPDATE employerreg SET Password = ? WHERE Email = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $newPassword, $email);
    $success = mysqli_stmt_execute($stmt);
    
    if (!$success) {
        error_log("Password reset failed for employer: " . mysqli_error($con));
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    return $success;
}

/**
 * Reset password (handles both applicant and employer)
 */
function resetPassword($email, $newPassword, $userType) {
    if ($userType === 'applicant') {
        return resetApplicantPassword($email, $newPassword);
    } else if ($userType === 'employer') {
        return resetEmployerPassword($email, $newPassword);
    }
    return false;
}
?>

