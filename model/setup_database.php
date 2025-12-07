<?php
// Database Setup Script for Employify Job Portal
// This script creates the database and all necessary tables

// Database configuration
$host = "127.0.0.1";
$dbuser = "root";
$dbpass = "";
$dbname = "Employify";

// Step 1: Connect to MySQL server (without database)
$con = mysqli_connect($host, $dbuser, $dbpass);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Step 2: Create database if it doesn't exist
$createDbSql = "CREATE DATABASE IF NOT EXISTS $dbname";
if (mysqli_query($con, $createDbSql)) {
    echo "Database '$dbname' created or already exists.<br>";
} else {
    die("Error creating database: " . mysqli_error($con));
}

// Step 3: Select the database
mysqli_select_db($con, $dbname);

// Step 4: Read and execute SQL file
$sqlFile = __DIR__ . '/create_tables.sql';

if (!file_exists($sqlFile)) {
    die("Error: SQL file not found at: $sqlFile");
}

$sql = file_get_contents($sqlFile);

// Remove CREATE DATABASE and USE statements as we already handled that
$sql = preg_replace('/CREATE DATABASE.*?;/i', '', $sql);
$sql = preg_replace('/USE.*?;/i', '', $sql);

// Split SQL into individual statements
$statements = array_filter(array_map('trim', explode(';', $sql)));

$successCount = 0;
$errorCount = 0;

foreach ($statements as $statement) {
    if (!empty($statement)) {
        if (mysqli_query($con, $statement)) {
            $successCount++;
            // Extract table name if it's a CREATE TABLE statement
            if (preg_match('/CREATE TABLE.*?`?(\w+)`?/i', $statement, $matches)) {
                echo "✓ Table '{$matches[1]}' created successfully.<br>";
            }
        } else {
            $errorCount++;
            $error = mysqli_error($con);
            // Ignore "table already exists" errors
            if (strpos($error, 'already exists') === false) {
                echo "✗ Error: $error<br>";
            } else {
                echo "ℹ Table already exists (skipped).<br>";
            }
        }
    }
}

echo "<br><strong>Setup Summary:</strong><br>";
echo "Successfully executed: $successCount statements<br>";
if ($errorCount > 0) {
    echo "Errors encountered: $errorCount<br>";
}

mysqli_close($con);

echo "<br><strong>Database setup completed!</strong><br>";
echo "You can now use the application.<br>";
?> 