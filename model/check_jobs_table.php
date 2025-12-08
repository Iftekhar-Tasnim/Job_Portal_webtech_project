<?php
/**
 * Check if jobs table exists in database
 */

require_once 'db.php';

$con = getConnection();

// Check if table exists
$result = mysqli_query($con, "SHOW TABLES LIKE 'jobs'");

if ($result && mysqli_num_rows($result) > 0) {
    echo "<h2 style='color: green;'>✓ Jobs table EXISTS in database</h2>";
    
    // Get table structure
    $structure = mysqli_query($con, "DESCRIBE jobs");
    echo "<h3>Table Structure:</h3>";
    echo "<table border='1' cellpadding='5' style='border-collapse: collapse;'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th></tr>";
    while ($row = mysqli_fetch_assoc($structure)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['Field']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Type']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Null']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Key']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Default'] ?? 'NULL') . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Count existing jobs
    $countResult = mysqli_query($con, "SELECT COUNT(*) as count FROM jobs");
    $count = mysqli_fetch_assoc($countResult);
    echo "<h3>Current Jobs in Database: " . $count['count'] . "</h3>";
    
    // Show recent jobs
    $jobsResult = mysqli_query($con, "SELECT id, title, company, status, posted_date FROM jobs ORDER BY posted_date DESC LIMIT 5");
    if (mysqli_num_rows($jobsResult) > 0) {
        echo "<h3>Recent Jobs:</h3>";
        echo "<table border='1' cellpadding='5' style='border-collapse: collapse;'>";
        echo "<tr><th>ID</th><th>Title</th><th>Company</th><th>Status</th><th>Posted Date</th></tr>";
        while ($job = mysqli_fetch_assoc($jobsResult)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($job['id']) . "</td>";
            echo "<td>" . htmlspecialchars($job['title']) . "</td>";
            echo "<td>" . htmlspecialchars($job['company']) . "</td>";
            echo "<td>" . htmlspecialchars($job['status']) . "</td>";
            echo "<td>" . htmlspecialchars($job['posted_date']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    
} else {
    echo "<h2 style='color: red;'>✗ Jobs table DOES NOT EXIST in database</h2>";
    echo "<p>You need to run the database setup script to create the table.</p>";
    echo "<p><a href='setup_db_simple.php'>Run Database Setup</a></p>";
}

mysqli_close($con);
?>

