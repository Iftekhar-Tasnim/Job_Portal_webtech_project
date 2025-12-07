<?php
/**
 * Password Fix Script
 * This script will reset the password for sample accounts
 * URL: http://localhost/job/model/fix_password.php
 */

require_once 'db.php';

// Database configuration
$host = "127.0.0.1";
$dbuser = "root";
$dbpass = "";
$dbname = "Employify";

echo "<!DOCTYPE html>
<html>
<head>
    <title>Fix Passwords - Employify</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
        .success { color: green; padding: 10px; background: #d4edda; border: 1px solid #c3e6cb; margin: 10px 0; }
        .error { color: red; padding: 10px; background: #f8d7da; border: 1px solid #f5c6cb; margin: 10px 0; }
        .info { color: #0c5460; padding: 10px; background: #d1ecf1; border: 1px solid #bee5eb; margin: 10px 0; }
        h1 { color: #333; }
        pre { background: #f4f4f4; padding: 10px; border-left: 3px solid #007bff; }
        .credentials { background: #fff3cd; padding: 15px; border: 1px solid #ffc107; margin: 20px 0; }
    </style>
</head>
<body>
    <h1>Fix Login Passwords</h1>";

try {
    $con = getConnection();
    
    // Password to set (plain text - will be stored as both hashed and plain for compatibility)
    $plainPassword = 'password';
    $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);
    
    echo "<h2>Resetting Passwords...</h2>";
    
    // Fix Employer Password
    echo "<h3>Employer Account</h3>";
    $employerEmail = 'employer@employify.com';
    
    // Check if employer exists
    $checkSql = "SELECT id, Email FROM employerreg WHERE Email = ?";
    $stmt = mysqli_prepare($con, $checkSql);
    mysqli_stmt_bind_param($stmt, "s", $employerEmail);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($result)) {
        // Update password - store as plain text for now (since login accepts both)
        $updateSql = "UPDATE employerreg SET Password = ? WHERE Email = ?";
        $updateStmt = mysqli_prepare($con, $updateSql);
        mysqli_stmt_bind_param($updateStmt, "ss", $plainPassword, $employerEmail);
        
        if (mysqli_stmt_execute($updateStmt)) {
            echo "<div class='success'>✓ Employer password reset successfully!</div>";
            echo "<div class='credentials'>";
            echo "<strong>Employer Login:</strong><br>";
            echo "Email: <code>$employerEmail</code><br>";
            echo "Password: <code>$plainPassword</code><br>";
            echo "</div>";
        } else {
            echo "<div class='error'>✗ Error updating employer password: " . mysqli_error($con) . "</div>";
        }
        mysqli_stmt_close($updateStmt);
    } else {
        // Create employer if doesn't exist
        echo "<div class='info'>ℹ Employer account not found. Creating new account...</div>";
        $insertSql = "INSERT INTO employerreg (Company_Name, Email, Password, Company_Phone, Company_Address, Business_Type, Company_Size, Industry) 
                      VALUES ('Tech Solutions', ?, ?, '1234567890', '123 Tech Street, Dhaka', 'IT Services', '50-100', 'Information Technology')";
        $insertStmt = mysqli_prepare($con, $insertSql);
        mysqli_stmt_bind_param($insertStmt, "ss", $employerEmail, $plainPassword);
        
        if (mysqli_stmt_execute($insertStmt)) {
            echo "<div class='success'>✓ Employer account created!</div>";
            echo "<div class='credentials'>";
            echo "<strong>Employer Login:</strong><br>";
            echo "Email: <code>$employerEmail</code><br>";
            echo "Password: <code>$plainPassword</code><br>";
            echo "</div>";
        } else {
            echo "<div class='error'>✗ Error creating employer: " . mysqli_error($con) . "</div>";
        }
        mysqli_stmt_close($insertStmt);
    }
    mysqli_stmt_close($stmt);
    
    // Fix Applicant Password
    echo "<h3>Applicant Account</h3>";
    $applicantEmail = 'applicant@employify.com';
    
    $checkSql = "SELECT id, Email FROM applicantreg WHERE Email = ?";
    $stmt = mysqli_prepare($con, $checkSql);
    mysqli_stmt_bind_param($stmt, "s", $applicantEmail);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($result)) {
        // Update password
        $updateSql = "UPDATE applicantreg SET Password = ? WHERE Email = ?";
        $updateStmt = mysqli_prepare($con, $updateSql);
        mysqli_stmt_bind_param($updateStmt, "ss", $plainPassword, $applicantEmail);
        
        if (mysqli_stmt_execute($updateStmt)) {
            echo "<div class='success'>✓ Applicant password reset successfully!</div>";
            echo "<div class='credentials'>";
            echo "<strong>Applicant Login:</strong><br>";
            echo "Email: <code>$applicantEmail</code><br>";
            echo "Password: <code>$plainPassword</code><br>";
            echo "</div>";
        } else {
            echo "<div class='error'>✗ Error updating applicant password: " . mysqli_error($con) . "</div>";
        }
        mysqli_stmt_close($updateStmt);
    } else {
        // Create applicant if doesn't exist
        echo "<div class='info'>ℹ Applicant account not found. Creating new account...</div>";
        $insertSql = "INSERT INTO applicantreg (First_Name, Last_Name, Email, Password, Phone, Address, Gender) 
                      VALUES ('John', 'Doe', ?, ?, '9876543210', '456 Main Street, Dhaka', 'Male')";
        $insertStmt = mysqli_prepare($con, $insertSql);
        mysqli_stmt_bind_param($insertStmt, "ss", $applicantEmail, $plainPassword);
        
        if (mysqli_stmt_execute($insertStmt)) {
            echo "<div class='success'>✓ Applicant account created!</div>";
            echo "<div class='credentials'>";
            echo "<strong>Applicant Login:</strong><br>";
            echo "Email: <code>$applicantEmail</code><br>";
            echo "Password: <code>$plainPassword</code><br>";
            echo "</div>";
        } else {
            echo "<div class='error'>✗ Error creating applicant: " . mysqli_error($con) . "</div>";
        }
        mysqli_stmt_close($insertStmt);
    }
    mysqli_stmt_close($stmt);
    
    mysqli_close($con);
    
    echo "<div class='info'>";
    echo "<h3>✅ Password Fix Complete!</h3>";
    echo "<p><strong>Next Steps:</strong></p>";
    echo "<ol>";
    echo "<li>Try logging in with the credentials above</li>";
    echo "<li>Go to: <a href='../view/login.php'>Login Page</a></li>";
    echo "<li>Select 'Employer Login' tab</li>";
    echo "<li>Enter the email and password shown above</li>";
    echo "</ol>";
    echo "</div>";
    
} catch (Exception $e) {
    echo "<div class='error'>✗ Error: " . $e->getMessage() . "</div>";
    echo "<p>Make sure:</p>";
    echo "<ul>";
    echo "<li>MySQL is running in XAMPP</li>";
    echo "<li>Database 'Employify' exists</li>";
    echo "<li>Tables are created (run setup script first)</li>";
    echo "</ul>";
}

echo "</body></html>";
?>

