<?php
/**
 * Debug Login Script
 * This will help identify why employer login is not working
 * URL: http://localhost/job/model/debug_login.php
 */

require_once 'db.php';

echo "<!DOCTYPE html>
<html>
<head>
    <title>Debug Employer Login</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 900px; margin: 50px auto; padding: 20px; }
        .success { color: green; padding: 10px; background: #d4edda; border: 1px solid #c3e6cb; margin: 10px 0; }
        .error { color: red; padding: 10px; background: #f8d7da; border: 1px solid #f5c6cb; margin: 10px 0; }
        .info { color: #0c5460; padding: 10px; background: #d1ecf1; border: 1px solid #bee5eb; margin: 10px 0; }
        .debug { background: #f8f9fa; padding: 15px; border-left: 4px solid #007bff; margin: 10px 0; }
        pre { background: #f4f4f4; padding: 10px; overflow-x: auto; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 10px; text-align: left; border: 1px solid #ddd; }
        th { background: #007bff; color: white; }
    </style>
</head>
<body>
    <h1>🔍 Debug Employer Login</h1>";

try {
    $con = getConnection();
    $employerEmail = 'employer@employify.com';
    $testPassword = 'password';
    
    echo "<h2>Step 1: Check Database Connection</h2>";
    if ($con) {
        echo "<div class='success'>✓ Database connection successful</div>";
    } else {
        echo "<div class='error'>✗ Database connection failed</div>";
        exit;
    }
    
    echo "<h2>Step 2: Check if Employer Exists in Database</h2>";
    $checkSql = "SELECT * FROM employerreg WHERE Email = ?";
    $stmt = mysqli_prepare($con, $checkSql);
    mysqli_stmt_bind_param($stmt, "s", $employerEmail);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='success'>✓ Employer found in database</div>";
        echo "<div class='debug'>";
        echo "<h3>Employer Data from Database:</h3>";
        echo "<table>";
        foreach ($row as $key => $value) {
            echo "<tr><th>$key</th><td>";
            if ($key === 'Password') {
                echo "<code>" . htmlspecialchars($value) . "</code> (Length: " . strlen($value) . ")";
            } else {
                echo htmlspecialchars($value);
            }
            echo "</td></tr>";
        }
        echo "</table>";
        echo "</div>";
        
        $dbPassword = $row['Password'];
        $dbEmail = $row['Email'];
        
        echo "<h2>Step 3: Test Password Comparison</h2>";
        echo "<div class='debug'>";
        echo "<p><strong>Test Password:</strong> <code>$testPassword</code> (Length: " . strlen($testPassword) . ")</p>";
        echo "<p><strong>DB Password:</strong> <code>" . htmlspecialchars($dbPassword) . "</code> (Length: " . strlen($dbPassword) . ")</p>";
        
        // Test 1: Direct comparison
        $directMatch = ($testPassword === $dbPassword);
        echo "<p><strong>Direct Comparison (===):</strong> " . ($directMatch ? "✅ MATCH" : "❌ NO MATCH") . "</p>";
        
        // Test 2: Case-insensitive comparison
        $caseInsensitiveMatch = (strtolower($testPassword) === strtolower($dbPassword));
        echo "<p><strong>Case-Insensitive Comparison:</strong> " . ($caseInsensitiveMatch ? "✅ MATCH" : "❌ NO MATCH") . "</p>";
        
        // Test 3: Trimmed comparison
        $trimmedMatch = (trim($testPassword) === trim($dbPassword));
        echo "<p><strong>Trimmed Comparison:</strong> " . ($trimmedMatch ? "✅ MATCH" : "❌ NO MATCH") . "</p>";
        
        // Test 4: password_verify (if hashed)
        if (strlen($dbPassword) > 20) {
            $hashVerify = password_verify($testPassword, $dbPassword);
            echo "<p><strong>password_verify() Check:</strong> " . ($hashVerify ? "✅ MATCH" : "❌ NO MATCH") . "</p>";
        } else {
            echo "<p><strong>password_verify() Check:</strong> ⚠️ Skipped (password appears to be plain text)</p>";
        }
        
        echo "</div>";
        
        echo "<h2>Step 4: Test Email Comparison</h2>";
        echo "<div class='debug'>";
        echo "<p><strong>Test Email:</strong> <code>$employerEmail</code></p>";
        echo "<p><strong>DB Email:</strong> <code>$dbEmail</code></p>";
        $emailMatch = (strtolower(trim($employerEmail)) === strtolower(trim($dbEmail)));
        echo "<p><strong>Email Match:</strong> " . ($emailMatch ? "✅ MATCH" : "❌ NO MATCH") . "</p>";
        echo "</div>";
        
        echo "<h2>Step 5: Simulate Login Function</h2>";
        echo "<div class='debug'>";
        
        // Simulate the login function logic
        $user_type = 'employer';
        $email = $employerEmail;
        $password = $testPassword;
        
        $sql = "SELECT * FROM employerreg WHERE Email = ?";
        $testStmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($testStmt, "s", $email);
        mysqli_stmt_execute($testStmt);
        $testResult = mysqli_stmt_get_result($testStmt);
        
        if ($testRow = mysqli_fetch_assoc($testResult)) {
            echo "<p>✅ Query executed successfully - found employer</p>";
            
            $passwordCheck1 = password_verify($password, $testRow['Password']);
            $passwordCheck2 = ($password === $testRow['Password']);
            
            echo "<p><strong>password_verify() result:</strong> " . ($passwordCheck1 ? "✅ TRUE" : "❌ FALSE") . "</p>";
            echo "<p><strong>Direct comparison result:</strong> " . ($passwordCheck2 ? "✅ TRUE" : "❌ FALSE") . "</p>";
            
            if ($passwordCheck1 || $passwordCheck2) {
                echo "<div class='success'><strong>✅ LOGIN SHOULD SUCCEED!</strong></div>";
                echo "<p>Both password checks passed. The login function should return TRUE.</p>";
            } else {
                echo "<div class='error'><strong>❌ LOGIN WILL FAIL!</strong></div>";
                echo "<p>Both password checks failed. This is why login is not working.</p>";
                
                echo "<h3>🔧 Solution:</h3>";
                echo "<p>Update the password in database to exactly match: <code>$testPassword</code></p>";
                echo "<p><a href='fix_employer_login.php' style='background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;'>Fix Password Now</a></p>";
            }
        } else {
            echo "<p>❌ Query did not find employer</p>";
        }
        
        mysqli_stmt_close($testStmt);
        echo "</div>";
        
    } else {
        echo "<div class='error'>✗ Employer NOT found in database with email: $employerEmail</div>";
        echo "<div class='info'>";
        echo "<h3>Available Employers in Database:</h3>";
        $allEmployers = mysqli_query($con, "SELECT id, Company_Name, Email FROM employerreg");
        if (mysqli_num_rows($allEmployers) > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Company Name</th><th>Email</th></tr>";
            while ($emp = mysqli_fetch_assoc($allEmployers)) {
                echo "<tr><td>{$emp['id']}</td><td>{$emp['Company_Name']}</td><td>{$emp['Email']}</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No employers found in database. Run the setup script first.</p>";
        }
        echo "</div>";
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    
} catch (Exception $e) {
    echo "<div class='error'>";
    echo "❌ <strong>ERROR:</strong><br>";
    echo $e->getMessage();
    echo "</div>";
}

echo "</body></html>";
?>

