<?php
/**
 * Test script to verify job creation works
 * Run this to test if jobs are being saved to database
 */

require_once 'db.php';
require_once 'company_model.php';

// Test data
$testEmployerId = 1; // Change to your employer ID
$testJobData = [
    'title' => 'Test Software Developer',
    'company' => 'Test Company',
    'description' => 'This is a test job description.',
    'requirements' => 'Test requirements',
    'location' => 'Dhaka',
    'category' => 'it',
    'experience_level' => 'mid',
    'job_type' => 'full-time',
    'salary_min' => 50000,
    'salary_max' => 80000,
    'status' => 'active',
    'deadline' => null
];

echo "<h2>Testing Job Creation</h2>";

$jobId = createJob($testEmployerId, $testJobData);

if ($jobId) {
    echo "<p style='color: green;'>✓ SUCCESS: Job created with ID: $jobId</p>";
    
    // Verify it was saved
    $con = getConnection();
    $sql = "SELECT * FROM jobs WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $jobId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $job = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    
    if ($job) {
        echo "<p style='color: green;'>✓ VERIFIED: Job found in database</p>";
        echo "<pre>";
        print_r($job);
        echo "</pre>";
    } else {
        echo "<p style='color: red;'>✗ ERROR: Job not found in database after creation</p>";
    }
} else {
    echo "<p style='color: red;'>✗ ERROR: Failed to create job</p>";
    echo "<p>Check error logs for details.</p>";
}

echo "<hr>";
echo "<h3>Check Database</h3>";
echo "<p>You can also check the database directly:</p>";
echo "<pre>SELECT * FROM jobs WHERE employer_id = $testEmployerId ORDER BY posted_date DESC LIMIT 5;</pre>";
?>

