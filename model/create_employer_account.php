<?php
/**
 * Create New Employer Account
 * This script creates a new employer account with working credentials
 * URL: http://localhost/job/model/create_employer_account.php
 */

require_once 'db.php';

echo "<!DOCTYPE html>
<html>
<head>
    <title>Create Employer Account</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 700px; margin: 50px auto; padding: 20px; }
        .success { color: green; padding: 15px; background: #d4edda; border: 2px solid #28a745; margin: 10px 0; border-radius: 5px; }
        .error { color: red; padding: 15px; background: #f8d7da; border: 2px solid #dc3545; margin: 10px 0; border-radius: 5px; }
        .info { color: #0c5460; padding: 15px; background: #d1ecf1; border: 2px solid #17a2b8; margin: 10px 0; border-radius: 5px; }
        .credentials { background: #fff3cd; padding: 20px; border: 2px solid #ffc107; margin: 20px 0; border-radius: 5px; font-size: 18px; }
        h1 { color: #333; }
        code { background: #f4f4f4; padding: 4px 8px; border-radius: 3px; font-family: monospace; font-size: 16px; }
        a { color: #007bff; text-decoration: none; font-weight: bold; }
        a:hover { text-decoration: underline; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 10px; text-align: left; border: 1px solid #ddd; }
        th { background: #007bff; color: white; }
    </style>
</head>
<body>
    <h1>🔧 Create New Employer Account</h1>";

try {
    $con = getConnection();
    
    // New employer credentials
    $newEmployer = [
        'Company_Name' => 'ABC Corporation',
        'Email' => 'employer1@employify.com',
        'Password' => 'employer123',
        'Company_Phone' => '1234567890',
        'Company_Address' => '123 Business Street, Dhaka',
        'Business_Type' => 'Technology',
        'Company_Size' => '100-500',
        'Industry' => 'Information Technology'
    ];
    
    echo "<h2>Creating New Employer Account...</h2>";
    
    // Check if email already exists
    $checkSql = "SELECT id, Email, Company_Name FROM employerreg WHERE Email = ?";
    $stmt = mysqli_prepare($con, $checkSql);
    mysqli_stmt_bind_param($stmt, "s", $newEmployer['Email']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($existing = mysqli_fetch_assoc($result)) {
        // Update existing account
        echo "<div class='info'>ℹ Employer with this email already exists. Updating password...</div>";
        
        $updateSql = "UPDATE employerreg SET 
            Password = ?,
            Company_Name = ?,
            Company_Phone = ?,
            Company_Address = ?,
            Business_Type = ?,
            Company_Size = ?,
            Industry = ?
            WHERE Email = ?";
        
        $updateStmt = mysqli_prepare($con, $updateSql);
        mysqli_stmt_bind_param($updateStmt, "ssssssss", 
            $newEmployer['Password'],
            $newEmployer['Company_Name'],
            $newEmployer['Company_Phone'],
            $newEmployer['Company_Address'],
            $newEmployer['Business_Type'],
            $newEmployer['Company_Size'],
            $newEmployer['Industry'],
            $newEmployer['Email']
        );
        
        if (mysqli_stmt_execute($updateStmt)) {
            echo "<div class='success'>✅ Employer account updated successfully!</div>";
        } else {
            echo "<div class='error'>❌ Error updating account: " . mysqli_error($con) . "</div>";
        }
        mysqli_stmt_close($updateStmt);
    } else {
        // Create new account
        $insertSql = "INSERT INTO employerreg 
            (Company_Name, Email, Password, Company_Phone, Company_Address, Business_Type, Company_Size, Industry) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $insertStmt = mysqli_prepare($con, $insertSql);
        mysqli_stmt_bind_param($insertStmt, "ssssssss",
            $newEmployer['Company_Name'],
            $newEmployer['Email'],
            $newEmployer['Password'],
            $newEmployer['Company_Phone'],
            $newEmployer['Company_Address'],
            $newEmployer['Business_Type'],
            $newEmployer['Company_Size'],
            $newEmployer['Industry']
        );
        
        if (mysqli_stmt_execute($insertStmt)) {
            echo "<div class='success'>✅ New employer account created successfully!</div>";
        } else {
            echo "<div class='error'>❌ Error creating account: " . mysqli_error($con) . "</div>";
        }
        mysqli_stmt_close($insertStmt);
    }
    
    mysqli_stmt_close($stmt);
    
    // Also update the original employer account
    echo "<h2>Updating Original Employer Account...</h2>";
    $originalEmail = 'employer@employify.com';
    $originalPassword = 'password';
    
    $updateOriginalSql = "UPDATE employerreg SET Password = ? WHERE Email = ?";
    $updateOriginalStmt = mysqli_prepare($con, $updateOriginalSql);
    mysqli_stmt_bind_param($updateOriginalStmt, "ss", $originalPassword, $originalEmail);
    
    if (mysqli_stmt_execute($updateOriginalStmt)) {
        echo "<div class='success'>✅ Original employer account password updated!</div>";
    } else {
        echo "<div class='info'>ℹ Original employer account not found or already updated.</div>";
    }
    mysqli_stmt_close($updateOriginalStmt);
    
    // Verify the accounts
    echo "<h2>Verifying Accounts...</h2>";
    $verifySql = "SELECT id, Company_Name, Email, Password FROM employerreg WHERE Email IN (?, ?)";
    $verifyStmt = mysqli_prepare($con, $verifySql);
    mysqli_stmt_bind_param($verifyStmt, "ss", $newEmployer['Email'], $originalEmail);
    mysqli_stmt_execute($verifyStmt);
    $verifyResult = mysqli_stmt_get_result($verifyStmt);
    
    echo "<table>";
    echo "<tr><th>ID</th><th>Company Name</th><th>Email</th><th>Password (first 10 chars)</th></tr>";
    while ($row = mysqli_fetch_assoc($verifyResult)) {
        $passPreview = substr($row['Password'], 0, 10) . '...';
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['Company_Name']}</td>";
        echo "<td><code>{$row['Email']}</code></td>";
        echo "<td><code>$passPreview</code></td>";
        echo "</tr>";
    }
    echo "</table>";
    
    mysqli_stmt_close($verifyStmt);
    mysqli_close($con);
    
    // Display credentials
    echo "<div class='credentials'>";
    echo "<h2>📋 Login Credentials</h2>";
    echo "<h3>Option 1: New Employer Account</h3>";
    echo "<p><strong>Email:</strong> <code>{$newEmployer['Email']}</code></p>";
    echo "<p><strong>Password:</strong> <code>{$newEmployer['Password']}</code></p>";
    echo "<hr>";
    echo "<h3>Option 2: Original Employer Account</h3>";
    echo "<p><strong>Email:</strong> <code>$originalEmail</code></p>";
    echo "<p><strong>Password:</strong> <code>$originalPassword</code></p>";
    echo "</div>";
    
    echo "<div class='info'>";
    echo "<h3>📝 Next Steps:</h3>";
    echo "<ol>";
    echo "<li>Go to the <a href='../view/login.php' target='_blank'><strong>Login Page</strong></a></li>";
    echo "<li>Click on the <strong>'Employer Login'</strong> tab</li>";
    echo "<li>Try logging in with either set of credentials above</li>";
    echo "<li>If it still doesn't work, run the <a href='debug_login.php'><strong>Debug Script</strong></a> to see what's happening</li>";
    echo "</ol>";
    echo "</div>";
    
} catch (Exception $e) {
    echo "<div class='error'>";
    echo "❌ <strong>ERROR:</strong><br>";
    echo $e->getMessage();
    echo "</div>";
}

echo "</body></html>";
?>

