<?php
// Script to update resumes table structure
require_once 'db.php';

$con = getConnection();

// Check if columns exist and add them if they don't
$columns_to_add = [
    'job_title' => "ALTER TABLE resumes ADD COLUMN job_title VARCHAR(100) AFTER full_name",
    'location' => "ALTER TABLE resumes ADD COLUMN location VARCHAR(100) AFTER phone",
    'website' => "ALTER TABLE resumes ADD COLUMN website VARCHAR(255) AFTER location",
    'summary' => "ALTER TABLE resumes ADD COLUMN summary TEXT AFTER website",
    'certifications' => "ALTER TABLE resumes ADD COLUMN certifications TEXT AFTER skills",
    'languages' => "ALTER TABLE resumes ADD COLUMN languages VARCHAR(255) AFTER certifications"
];

foreach ($columns_to_add as $column => $sql) {
    // Check if column exists
    $checkSql = "SHOW COLUMNS FROM resumes LIKE '$column'";
    $result = mysqli_query($con, $checkSql);
    
    if (mysqli_num_rows($result) == 0) {
        // Column doesn't exist, add it
        if (mysqli_query($con, $sql)) {
            echo "Column '$column' added successfully.<br>";
        } else {
            echo "Error adding column '$column': " . mysqli_error($con) . "<br>";
        }
    } else {
        echo "Column '$column' already exists.<br>";
    }
}

mysqli_close($con);
echo "<br>Database update complete!";
?>

