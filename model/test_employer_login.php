<?php
/**
 * Test Employer Login Directly
 * This script tests the login function directly
 * URL: http://localhost/job/model/test_employer_login.php
 */

require_once 'db.php';
require_once 'user_model.php';

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

echo "<!DOCTYPE html>
<html>
<head>
    <title>Test Employer Login</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
        .success { color: green; padding: 15px; background: #d4edda; border: 2px solid #28a745; margin: 10px 0; }
        .error { color: red; padding: 15px; background: #f8d7da; border: 2px solid #dc3545; margin: 10px 0; }
        .info { color: #0c5460; padding: 15px; background: #d1ecf1; border: 2px solid #17a2b8; margin: 10px 0; }
        pre { background: #f4f4f4; padding: 15px; border-left: 4px solid #007bff; overflow-x: auto; }
        h1 { color: #333; }
    </style>
</head>
<body>
    <h1>🧪 Test Employer Login Function</h1>";

// Test credentials
$testCredentials = [
    ['email' => 'employer@employify.com', 'password' => 'password', 'user_type' => 'employer'],
    ['email' => 'employer1@employify.com', 'password' => 'employer123', 'user_type' => 'employer']
];

foreach ($testCredentials as $index => $cred) {
    echo "<h2>Test " . ($index + 1) . ": {$cred['email']}</h2>";
    
    echo "<div class='info'>";
    echo "<strong>Testing with:</strong><br>";
    echo "Email: <code>{$cred['email']}</code><br>";
    echo "Password: <code>{$cred['password']}</code><br>";
    echo "User Type: <code>{$cred['user_type']}</code><br>";
    echo "</div>";
    
    // Test the login function
    $result = login($cred);
    
    if ($result) {
        echo "<div class='success'>";
        echo "✅ <strong>LOGIN SUCCESSFUL!</strong><br>";
        echo "Session variables set:<br>";
        echo "<pre>";
        echo "User ID: " . (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'NOT SET') . "\n";
        echo "Email: " . (isset($_SESSION['email']) ? $_SESSION['email'] : 'NOT SET') . "\n";
        echo "User Type: " . (isset($_SESSION['user_type']) ? $_SESSION['user_type'] : 'NOT SET') . "\n";
        echo "Name: " . (isset($_SESSION['name']) ? $_SESSION['name'] : 'NOT SET') . "\n";
        echo "Status: " . (isset($_SESSION['status']) ? ($_SESSION['status'] ? 'TRUE' : 'FALSE') : 'NOT SET') . "\n";
        echo "</pre>";
        echo "</div>";
    } else {
        echo "<div class='error'>";
        echo "❌ <strong>LOGIN FAILED!</strong><br>";
        echo "The login function returned FALSE.<br>";
        echo "Possible reasons:<br>";
        echo "<ul>";
        echo "<li>Email not found in employerreg table</li>";
        echo "<li>Password doesn't match</li>";
        echo "<li>Database connection issue</li>";
        echo "<li>SQL query error</li>";
        echo "</ul>";
        echo "</div>";
        
        // Check database directly
        echo "<div class='info'>";
        echo "<strong>Checking database directly...</strong><br>";
        $con = getConnection();
        $email = $cred['email'];
        $sql = "SELECT * FROM employerreg WHERE Email = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if ($row = mysqli_fetch_assoc($result)) {
            echo "✅ Found employer in database:<br>";
            echo "<pre>";
            print_r($row);
            echo "</pre>";
            echo "Password comparison:<br>";
            echo "DB Password: <code>" . htmlspecialchars($row['Password']) . "</code> (Length: " . strlen($row['Password']) . ")<br>";
            echo "Input Password: <code>" . htmlspecialchars($cred['password']) . "</code> (Length: " . strlen($cred['password']) . ")<br>";
            echo "Direct match: " . ($cred['password'] === $row['Password'] ? '✅ YES' : '❌ NO') . "<br>";
            if (strlen($row['Password']) > 20) {
                echo "password_verify: " . (password_verify($cred['password'], $row['Password']) ? '✅ YES' : '❌ NO') . "<br>";
            }
            echo "</pre>";
        } else {
            echo "❌ Employer NOT found in database with email: <code>$email</code><br>";
        }
        mysqli_stmt_close($stmt);
        mysqli_close($con);
        echo "</div>";
    }
    
    echo "<hr>";
}

echo "<div class='info'>";
echo "<h3>📝 Next Steps:</h3>";
echo "<p>If login is successful here but not on the login page, the issue is likely:</p>";
echo "<ul>";
echo "<li>JavaScript preventing form submission</li>";
echo "<li>Form not submitting to the correct URL</li>";
echo "<li>Session issues</li>";
echo "</ul>";
echo "<p><a href='../view/login.php'>Try Login Page</a> | <a href='create_employer_account.php'>Create New Account</a></p>";
echo "</div>";

echo "</body></html>";
?>

