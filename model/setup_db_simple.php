<?php
/**
 * Simple Database Setup Script
 * Run this file in your browser to set up the database
 * URL: http://localhost/job/model/setup_db_simple.php
 */

// Database configuration
$host = "127.0.0.1";
$dbuser = "root";
$dbpass = "";
$dbname = "Employify";

echo "<!DOCTYPE html>
<html>
<head>
    <title>Database Setup - Employify</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
        .success { color: green; padding: 10px; background: #d4edda; border: 1px solid #c3e6cb; margin: 10px 0; }
        .error { color: red; padding: 10px; background: #f8d7da; border: 1px solid #f5c6cb; margin: 10px 0; }
        .info { color: #0c5460; padding: 10px; background: #d1ecf1; border: 1px solid #bee5eb; margin: 10px 0; }
        h1 { color: #333; }
        pre { background: #f4f4f4; padding: 10px; border-left: 3px solid #007bff; }
    </style>
</head>
<body>
    <h1>Employify Database Setup</h1>";

// Step 1: Connect to MySQL server
echo "<h2>Step 1: Connecting to MySQL...</h2>";
$con = @mysqli_connect($host, $dbuser, $dbpass);

if (!$con) {
    echo "<div class='error'>✗ Failed to connect to MySQL: " . mysqli_connect_error() . "</div>";
    echo "<p><strong>Solution:</strong> Make sure MySQL is running in XAMPP Control Panel.</p>";
    echo "</body></html>";
    exit;
}

echo "<div class='success'>✓ Connected to MySQL server successfully</div>";

// Step 2: Create database
echo "<h2>Step 2: Creating database '$dbname'...</h2>";
$createDbSql = "CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";

if (mysqli_query($con, $createDbSql)) {
    echo "<div class='success'>✓ Database '$dbname' created or already exists</div>";
} else {
    echo "<div class='error'>✗ Error creating database: " . mysqli_error($con) . "</div>";
    mysqli_close($con);
    echo "</body></html>";
    exit;
}

// Step 3: Select database
mysqli_select_db($con, $dbname);

// Step 4: Create tables
echo "<h2>Step 3: Creating tables...</h2>";

$tables = [
    "applicantreg" => "CREATE TABLE IF NOT EXISTS `applicantreg` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `First_Name` VARCHAR(50) NOT NULL,
        `Last_Name` VARCHAR(50) NOT NULL,
        `Email` VARCHAR(100) NOT NULL UNIQUE,
        `Password` VARCHAR(255) NOT NULL,
        `Phone` VARCHAR(20) NOT NULL,
        `Address` TEXT NOT NULL,
        `Gender` ENUM('Male', 'Female', 'Other') NOT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX `idx_email` (`Email`),
        INDEX `idx_phone` (`Phone`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
    
    "employerreg" => "CREATE TABLE IF NOT EXISTS `employerreg` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `Company_Name` VARCHAR(100) NOT NULL,
        `Email` VARCHAR(100) NOT NULL UNIQUE,
        `Password` VARCHAR(255) NOT NULL,
        `Company_Phone` VARCHAR(20) NOT NULL,
        `Company_Address` TEXT NOT NULL,
        `Business_Type` VARCHAR(50),
        `Company_Size` VARCHAR(50),
        `Company_Website` VARCHAR(255),
        `Industry` VARCHAR(100),
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX `idx_email` (`Email`),
        INDEX `idx_company_name` (`Company_Name`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
    
    "jobs" => "CREATE TABLE IF NOT EXISTS `jobs` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `employer_id` INT NOT NULL,
        `title` VARCHAR(200) NOT NULL,
        `company` VARCHAR(100) NOT NULL,
        `description` TEXT NOT NULL,
        `requirements` TEXT,
        `location` VARCHAR(100) NOT NULL,
        `category` VARCHAR(50) NOT NULL,
        `experience_level` ENUM('entry', 'mid', 'senior') NOT NULL,
        `job_type` ENUM('full-time', 'part-time', 'contract', 'internship') DEFAULT 'full-time',
        `salary_min` DECIMAL(10,2),
        `salary_max` DECIMAL(10,2),
        `status` ENUM('active', 'closed', 'draft') DEFAULT 'active',
        `posted_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `deadline` DATE,
        FOREIGN KEY (`employer_id`) REFERENCES `employerreg`(`id`) ON DELETE CASCADE,
        INDEX `idx_category` (`category`),
        INDEX `idx_location` (`location`),
        INDEX `idx_status` (`status`),
        INDEX `idx_employer` (`employer_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
    
    "job_applications" => "CREATE TABLE IF NOT EXISTS `job_applications` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `job_id` INT NOT NULL,
        `applicant_id` INT NOT NULL,
        `resume_path` VARCHAR(255),
        `cover_letter` TEXT,
        `status` ENUM('applied', 'review', 'interview', 'offer', 'rejected') DEFAULT 'applied',
        `applied_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (`job_id`) REFERENCES `jobs`(`id`) ON DELETE CASCADE,
        FOREIGN KEY (`applicant_id`) REFERENCES `applicantreg`(`id`) ON DELETE CASCADE,
        UNIQUE KEY `unique_application` (`job_id`, `applicant_id`),
        INDEX `idx_status` (`status`),
        INDEX `idx_applicant` (`applicant_id`),
        INDEX `idx_job` (`job_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
    
    "saved_jobs" => "CREATE TABLE IF NOT EXISTS `saved_jobs` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `job_id` INT NOT NULL,
        `applicant_id` INT NOT NULL,
        `saved_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (`job_id`) REFERENCES `jobs`(`id`) ON DELETE CASCADE,
        FOREIGN KEY (`applicant_id`) REFERENCES `applicantreg`(`id`) ON DELETE CASCADE,
        UNIQUE KEY `unique_saved_job` (`job_id`, `applicant_id`),
        INDEX `idx_applicant` (`applicant_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
    
    "resumes" => "CREATE TABLE IF NOT EXISTS `resumes` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `applicant_id` INT NOT NULL,
        `resume_file_path` VARCHAR(255),
        `full_name` VARCHAR(100),
        `email` VARCHAR(100),
        `phone` VARCHAR(20),
        `experience` TEXT,
        `education` TEXT,
        `skills` TEXT,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (`applicant_id`) REFERENCES `applicantreg`(`id`) ON DELETE CASCADE,
        INDEX `idx_applicant` (`applicant_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
    
    "job_alerts" => "CREATE TABLE IF NOT EXISTS `job_alerts` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `applicant_id` INT NOT NULL,
        `job_title` VARCHAR(200),
        `location` VARCHAR(100),
        `job_type` VARCHAR(50),
        `notification_method` ENUM('email', 'app', 'both') DEFAULT 'email',
        `is_active` BOOLEAN DEFAULT TRUE,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (`applicant_id`) REFERENCES `applicantreg`(`id`) ON DELETE CASCADE,
        INDEX `idx_applicant` (`applicant_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
    
    "interviews" => "CREATE TABLE IF NOT EXISTS `interviews` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `application_id` INT NOT NULL,
        `interview_date` DATETIME NOT NULL,
        `interview_type` ENUM('phone', 'video', 'in-person') DEFAULT 'in-person',
        `location` VARCHAR(255),
        `status` ENUM('scheduled', 'completed', 'cancelled', 'rescheduled') DEFAULT 'scheduled',
        `notes` TEXT,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (`application_id`) REFERENCES `job_applications`(`id`) ON DELETE CASCADE,
        INDEX `idx_application` (`application_id`),
        INDEX `idx_date` (`interview_date`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
    
    "company_reviews" => "CREATE TABLE IF NOT EXISTS `company_reviews` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `employer_id` INT NOT NULL,
        `applicant_id` INT NOT NULL,
        `rating` INT NOT NULL CHECK (`rating` >= 1 AND `rating` <= 5),
        `review_text` TEXT,
        `is_anonymous` BOOLEAN DEFAULT FALSE,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (`employer_id`) REFERENCES `employerreg`(`id`) ON DELETE CASCADE,
        FOREIGN KEY (`applicant_id`) REFERENCES `applicantreg`(`id`) ON DELETE CASCADE,
        INDEX `idx_employer` (`employer_id`),
        INDEX `idx_rating` (`rating`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
    
    "contact_messages" => "CREATE TABLE IF NOT EXISTS `contact_messages` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(100) NOT NULL,
        `email` VARCHAR(100) NOT NULL,
        `phone` VARCHAR(20),
        `subject` VARCHAR(200) NOT NULL,
        `message` TEXT NOT NULL,
        `status` ENUM('new', 'read', 'replied') DEFAULT 'new',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        INDEX `idx_status` (`status`),
        INDEX `idx_email` (`email`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
];

$successCount = 0;
$errorCount = 0;

foreach ($tables as $tableName => $sql) {
    if (mysqli_query($con, $sql)) {
        echo "<div class='success'>✓ Table '$tableName' created successfully</div>";
        $successCount++;
    } else {
        $error = mysqli_error($con);
        if (strpos($error, 'already exists') !== false) {
            echo "<div class='info'>ℹ Table '$tableName' already exists (skipped)</div>";
        } else {
            echo "<div class='error'>✗ Error creating table '$tableName': $error</div>";
            $errorCount++;
        }
    }
}

// Step 5: Insert sample data (optional)
echo "<h2>Step 4: Inserting sample data...</h2>";

// Prepare to insert/update sample data

// Always update employer password to ensure it works
$employerPassword = 'password'; // Store as plain text for sample account
$employerEmail = 'employer@employify.com';

$checkEmployer = mysqli_query($con, "SELECT id FROM employerreg WHERE Email = '$employerEmail'");
if (mysqli_num_rows($checkEmployer) > 0) {
    // Update existing employer password
    $updateSql = "UPDATE employerreg SET Password = '$employerPassword' WHERE Email = '$employerEmail'";
    if (mysqli_query($con, $updateSql)) {
        echo "<div class='success'>✓ Employer password updated to 'password'</div>";
        $row = mysqli_fetch_assoc($checkEmployer);
        $employerId = $row['id'];
    } else {
        echo "<div class='error'>✗ Error updating employer password: " . mysqli_error($con) . "</div>";
        $row = mysqli_fetch_assoc($checkEmployer);
        $employerId = $row['id'];
    }
} else {
    // Insert new employer with plain text password
    $employerSql = "INSERT INTO employerreg (Company_Name, Email, Password, Company_Phone, Company_Address, Business_Type, Company_Size, Industry) 
                    VALUES ('Tech Solutions', '$employerEmail', '$employerPassword', '1234567890', '123 Tech Street, Dhaka', 'IT Services', '50-100', 'Information Technology')";
    
    if (mysqli_query($con, $employerSql)) {
        echo "<div class='success'>✓ Sample employer created with password: 'password'</div>";
        $employerId = mysqli_insert_id($con);
    } else {
        echo "<div class='error'>✗ Error creating sample employer: " . mysqli_error($con) . "</div>";
        $employerId = 1; // Use default ID
    }
}

// Check if sample applicant exists
$checkApplicant = mysqli_query($con, "SELECT COUNT(*) as count FROM applicantreg WHERE Email = 'applicant@employify.com'");
$applicantExists = mysqli_fetch_assoc($checkApplicant)['count'] > 0;

// Always update applicant password to ensure it works
$applicantPassword = 'password'; // Store as plain text for sample account
$applicantEmail = 'applicant@employify.com';

$checkApplicant = mysqli_query($con, "SELECT id FROM applicantreg WHERE Email = '$applicantEmail'");
if (mysqli_num_rows($checkApplicant) > 0) {
    // Update existing applicant password
    $updateSql = "UPDATE applicantreg SET Password = '$applicantPassword' WHERE Email = '$applicantEmail'";
    if (mysqli_query($con, $updateSql)) {
        echo "<div class='success'>✓ Applicant password updated to 'password'</div>";
    } else {
        echo "<div class='error'>✗ Error updating applicant password: " . mysqli_error($con) . "</div>";
    }
} else {
    // Insert new applicant with plain text password
    $applicantSql = "INSERT INTO applicantreg (First_Name, Last_Name, Email, Password, Phone, Address, Gender) 
                     VALUES ('John', 'Doe', '$applicantEmail', '$applicantPassword', '9876543210', '456 Main Street, Dhaka', 'Male')";
    
    if (mysqli_query($con, $applicantSql)) {
        echo "<div class='success'>✓ Sample applicant created with password: 'password'</div>";
    } else {
        echo "<div class='error'>✗ Error creating sample applicant: " . mysqli_error($con) . "</div>";
    }
}

// Insert sample jobs
$checkJobs = mysqli_query($con, "SELECT COUNT(*) as count FROM jobs");
$jobsExist = mysqli_fetch_assoc($checkJobs)['count'] > 0;

if (!$jobsExist) {
    $jobsSql = "INSERT INTO jobs (employer_id, title, company, description, requirements, location, category, experience_level, job_type, salary_min, salary_max) VALUES
                ($employerId, 'Software Developer', 'Tech Solutions', 'We are looking for a talented software developer to join our team. You will be responsible for developing and maintaining our software products.', '3+ years of experience in software development\nProficient in Java and JavaScript\nExperience with web technologies\nStrong problem-solving skills', 'Dhaka', 'it', 'mid', 'full-time', 50000, 80000),
                ($employerId, 'Marketing Manager', 'Tech Solutions', 'We need an experienced marketing manager to lead our marketing team and develop effective marketing strategies.', '5+ years of marketing experience\nTeam management experience\nStrong communication skills\nDigital marketing expertise', 'Chittagong', 'marketing', 'senior', 'full-time', 60000, 90000),
                ($employerId, 'Accountant', 'Tech Solutions', 'Entry-level position for an accountant to assist with financial reporting and analysis.', 'Bachelor''s degree in Accounting\nBasic accounting knowledge\nAttention to detail\nGood communication skills', 'Sylhet', 'finance', 'entry', 'full-time', 30000, 45000)";
    
    if (mysqli_query($con, $jobsSql)) {
        echo "<div class='success'>✓ Sample jobs created (3 jobs)</div>";
    } else {
        echo "<div class='error'>✗ Error creating sample jobs: " . mysqli_error($con) . "</div>";
    }
} else {
    echo "<div class='info'>ℹ Sample jobs already exist</div>";
}

mysqli_close($con);

// Final summary
echo "<h2>Setup Complete!</h2>";
echo "<div class='success'>";
echo "<strong>Summary:</strong><br>";
echo "✓ Tables created: $successCount<br>";
if ($errorCount > 0) {
    echo "✗ Errors: $errorCount<br>";
}
echo "</div>";

echo "<div class='info'>";
echo "<h3>Sample Login Credentials:</h3>";
echo "<strong>Employer:</strong><br>";
echo "Email: employer@employify.com<br>";
echo "Password: password<br><br>";
echo "<strong>Applicant:</strong><br>";
echo "Email: applicant@employify.com<br>";
echo "Password: password<br>";
echo "</div>";

echo "<div class='info'>";
echo "<h3>Next Steps:</h3>";
echo "1. Access the application: <a href='../view/home.php'>Home Page</a><br>";
echo "2. Or login directly: <a href='../view/login.php'>Login Page</a><br>";
echo "3. Check database in phpMyAdmin: <a href='http://localhost/phpmyadmin' target='_blank'>phpMyAdmin</a><br>";
echo "</div>";

echo "</body></html>";
?>

