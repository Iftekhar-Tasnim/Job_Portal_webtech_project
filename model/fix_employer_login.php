<?php
/**
 * Quick Fix for Employer Login
 * This script directly updates the employer password to 'password'
 * URL: http://localhost/job/model/fix_employer_login.php
 */

require_once 'db.php';

echo "<!DOCTYPE html>
<html>
<head>
    <title>Fix Employer Login</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; }
        .success { color: green; padding: 15px; background: #d4edda; border: 2px solid #28a745; margin: 10px 0; border-radius: 5px; }
        .error { color: red; padding: 15px; background: #f8d7da; border: 2px solid #dc3545; margin: 10px 0; border-radius: 5px; }
        .info { color: #0c5460; padding: 15px; background: #d1ecf1; border: 2px solid #17a2b8; margin: 10px 0; border-radius: 5px; }
        .credentials { background: #fff3cd; padding: 20px; border: 2px solid #ffc107; margin: 20px 0; border-radius: 5px; }
        h1 { color: #333; }
        code { background: #f4f4f4; padding: 2px 6px; border-radius: 3px; font-family: monospace; }
        a { color: #007bff; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>🔧 Fix Employer Login</h1>";

try {
    $con = getConnection();
    
    $employerEmail = 'employer@employify.com';
    $plainPassword = 'password';
    
    echo "<h2>Updating Employer Password...</h2>";
    
    // Check if employer exists
    $checkSql = "SELECT id, Email, Company_Name FROM employerreg WHERE Email = ?";
    $stmt = mysqli_prepare($con, $checkSql);
    mysqli_stmt_bind_param($stmt, "s", $employerEmail);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($result)) {
        // Employer exists - update password
        $updateSql = "UPDATE employerreg SET Password = ? WHERE Email = ?";
        $updateStmt = mysqli_prepare($con, $updateSql);
        mysqli_stmt_bind_param($updateStmt, "ss", $plainPassword, $employerEmail);
        
        if (mysqli_stmt_execute($updateStmt)) {
            echo "<div class='success'>";
            echo "✅ <strong>SUCCESS!</strong> Employer password has been reset.<br><br>";
            echo "</div>";
            
            echo "<div class='credentials'>";
            echo "<h3>📋 Login Credentials:</h3>";
            echo "<strong>Email:</strong> <code>$employerEmail</code><br>";
            echo "<strong>Password:</strong> <code>$plainPassword</code><br><br>";
            echo "<strong>Company:</strong> " . htmlspecialchars($row['Company_Name']) . "<br>";
            echo "</div>";
            
            echo "<div class='info'>";
            echo "<h3>📝 Next Steps:</h3>";
            echo "<ol>";
            echo "<li>Go to the <a href='../view/login.php' target='_blank'><strong>Login Page</strong></a></li>";
            echo "<li>Click on the <strong>'Employer Login'</strong> tab</li>";
            echo "<li>Enter the email and password shown above</li>";
            echo "<li>Click 'Login as Employer'</li>";
            echo "</ol>";
            echo "</div>";
        } else {
            echo "<div class='error'>";
            echo "❌ <strong>ERROR:</strong> Failed to update password.<br>";
            echo "Error: " . mysqli_error($con);
            echo "</div>";
        }
        mysqli_stmt_close($updateStmt);
    } else {
        // Employer doesn't exist - create it
        echo "<div class='info'>ℹ Employer account not found. Creating new account...</div>";
        
        $companyName = 'Tech Solutions';
        $companyPhone = '1234567890';
        $companyAddress = '123 Tech Street, Dhaka';
        $businessType = 'IT Services';
        $companySize = '50-100';
        $industry = 'Information Technology';
        
        $insertSql = "INSERT INTO employerreg (Company_Name, Email, Password, Company_Phone, Company_Address, Business_Type, Company_Size, Industry) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = mysqli_prepare($con, $insertSql);
        mysqli_stmt_bind_param($insertStmt, "ssssssss", $companyName, $employerEmail, $plainPassword, $companyPhone, $companyAddress, $businessType, $companySize, $industry);
        
        if (mysqli_stmt_execute($insertStmt)) {
            echo "<div class='success'>";
            echo "✅ <strong>SUCCESS!</strong> Employer account created.<br><br>";
            echo "</div>";
            
            echo "<div class='credentials'>";
            echo "<h3>📋 Login Credentials:</h3>";
            echo "<strong>Email:</strong> <code>$employerEmail</code><br>";
            echo "<strong>Password:</strong> <code>$plainPassword</code><br>";
            echo "</div>";
            
            echo "<div class='info'>";
            echo "<h3>📝 Next Steps:</h3>";
            echo "<ol>";
            echo "<li>Go to the <a href='../view/login.php' target='_blank'><strong>Login Page</strong></a></li>";
            echo "<li>Click on the <strong>'Employer Login'</strong> tab</li>";
            echo "<li>Enter the email and password shown above</li>";
            echo "<li>Click 'Login as Employer'</li>";
            echo "</ol>";
            echo "</div>";
        } else {
            echo "<div class='error'>";
            echo "❌ <strong>ERROR:</strong> Failed to create employer account.<br>";
            echo "Error: " . mysqli_error($con);
            echo "</div>";
        }
        mysqli_stmt_close($insertStmt);
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    
} catch (Exception $e) {
    echo "<div class='error'>";
    echo "❌ <strong>FATAL ERROR:</strong><br>";
    echo $e->getMessage();
    echo "</div>";
    
    echo "<div class='info'>";
    echo "<h3>🔍 Troubleshooting:</h3>";
    echo "<ul>";
    echo "<li>Make sure MySQL is running in XAMPP</li>";
    echo "<li>Check if database 'Employify' exists</li>";
    echo "<li>Verify tables are created (run setup script first)</li>";
    echo "<li>Check database connection in <code>model/db.php</code></li>";
    echo "</ul>";
    echo "</div>";
}

echo "</body></html>";
?>

