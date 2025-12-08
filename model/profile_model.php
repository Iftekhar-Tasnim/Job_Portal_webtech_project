<?php
require_once 'db.php';

/**
 * Get applicant profile data
 */
function getApplicantProfile($applicant_id) {
    $con = getConnection();
    $sql = "SELECT * FROM applicantreg WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $applicant_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $profile = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    return $profile;
}

/**
 * Update applicant profile
 */
function updateApplicantProfile($applicant_id, $data) {
    $con = getConnection();
    
    $fullName = isset($data['fullName']) ? trim($data['fullName']) : '';
    $email = isset($data['email']) ? trim($data['email']) : '';
    $phone = isset($data['phone']) ? trim($data['phone']) : '';
    $address = isset($data['location']) ? trim($data['location']) : '';
    
    // Split full name into first and last name
    $nameParts = explode(' ', $fullName, 2);
    $firstName = $nameParts[0];
    $lastName = isset($nameParts[1]) ? $nameParts[1] : '';
    
    $sql = "UPDATE applicantreg SET 
            First_Name = ?, Last_Name = ?, Email = ?, Phone = ?, Address = ?
            WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "sssssi", $firstName, $lastName, $email, $phone, $address, $applicant_id);
    $success = mysqli_stmt_execute($stmt);
    
    if (!$success) {
        error_log("Profile update failed: " . mysqli_error($con));
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    return $success;
}

/**
 * Get job applications for applicant
 */
function getJobApplications($applicant_id, $status = null) {
    $con = getConnection();
    
    if ($status && $status !== 'all') {
        $sql = "SELECT ja.*, j.title, j.company, j.location, j.job_type, j.posted_date 
                FROM job_applications ja
                JOIN jobs j ON ja.job_id = j.id
                WHERE ja.applicant_id = ? AND ja.status = ?
                ORDER BY ja.applied_date DESC";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "is", $applicant_id, $status);
    } else {
        $sql = "SELECT ja.*, j.title, j.company, j.location, j.job_type, j.posted_date 
                FROM job_applications ja
                JOIN jobs j ON ja.job_id = j.id
                WHERE ja.applicant_id = ?
                ORDER BY ja.applied_date DESC";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "i", $applicant_id);
    }
    
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $applications = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $applications[] = $row;
    }
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    return $applications;
}

/**
 * Get saved jobs for applicant
 */
function getSavedJobs($applicant_id) {
    $con = getConnection();
    $sql = "SELECT sj.*, j.title, j.company, j.location, j.job_type, j.posted_date, j.description
            FROM saved_jobs sj
            JOIN jobs j ON sj.job_id = j.id
            WHERE sj.applicant_id = ?
            ORDER BY sj.saved_date DESC";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $applicant_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $savedJobs = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $savedJobs[] = $row;
    }
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    return $savedJobs;
}

/**
 * Get application statistics
 */
function getApplicationStats($applicant_id) {
    $con = getConnection();
    
    $stats = [
        'total' => 0,
        'applied' => 0,
        'review' => 0,
        'interview' => 0,
        'offer' => 0,
        'rejected' => 0
    ];
    
    $sql = "SELECT status, COUNT(*) as count FROM job_applications WHERE applicant_id = ? GROUP BY status";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $applicant_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $stats['total'] += $row['count'];
        $stats[$row['status']] = $row['count'];
    }
    
    mysqli_stmt_close($stmt);
    
    // Get saved jobs count
    $sql = "SELECT COUNT(*) as count FROM saved_jobs WHERE applicant_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $applicant_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $stats['saved'] = $row['count'];
    mysqli_stmt_close($stmt);
    
    // Get interviews count
    $sql = "SELECT COUNT(*) as count FROM job_applications WHERE applicant_id = ? AND status = 'interview'";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $applicant_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $stats['interviews'] = $row['count'];
    mysqli_stmt_close($stmt);
    
    mysqli_close($con);
    return $stats;
}

/**
 * Update password
 */
function updatePassword($applicant_id, $newPassword) {
    $con = getConnection();
    $sql = "UPDATE applicantreg SET Password = ? WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "si", $newPassword, $applicant_id);
    $success = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    return $success;
}

/**
 * Apply for a job
 */
function applyForJob($applicant_id, $job_id, $cover_letter = '') {
    $con = getConnection();
    
    // Check if already applied
    $checkSql = "SELECT id FROM job_applications WHERE applicant_id = ? AND job_id = ?";
    $checkStmt = mysqli_prepare($con, $checkSql);
    mysqli_stmt_bind_param($checkStmt, "ii", $applicant_id, $job_id);
    mysqli_stmt_execute($checkStmt);
    $result = mysqli_stmt_get_result($checkStmt);
    
    if (mysqli_num_rows($result) > 0) {
        mysqli_stmt_close($checkStmt);
        mysqli_close($con);
        return ['success' => false, 'error' => 'You have already applied for this job'];
    }
    mysqli_stmt_close($checkStmt);
    
    // Check if job exists and is active
    $jobSql = "SELECT id FROM jobs WHERE id = ? AND status = 'active'";
    $jobStmt = mysqli_prepare($con, $jobSql);
    mysqli_stmt_bind_param($jobStmt, "i", $job_id);
    mysqli_stmt_execute($jobStmt);
    $jobResult = mysqli_stmt_get_result($jobStmt);
    
    if (mysqli_num_rows($jobResult) == 0) {
        mysqli_stmt_close($jobStmt);
        mysqli_close($con);
        return ['success' => false, 'error' => 'Job not found or no longer available'];
    }
    mysqli_stmt_close($jobStmt);
    
    // Get resume path if available
    $resumeSql = "SELECT resume_file_path FROM resumes WHERE applicant_id = ? ORDER BY id DESC LIMIT 1";
    $resumeStmt = mysqli_prepare($con, $resumeSql);
    mysqli_stmt_bind_param($resumeStmt, "i", $applicant_id);
    mysqli_stmt_execute($resumeStmt);
    $resumeResult = mysqli_stmt_get_result($resumeStmt);
    $resume = mysqli_fetch_assoc($resumeResult);
    $resumePath = $resume ? $resume['resume_file_path'] : null;
    mysqli_stmt_close($resumeStmt);
    
    // Insert application
    $sql = "INSERT INTO job_applications (job_id, applicant_id, resume_path, cover_letter, status) 
            VALUES (?, ?, ?, ?, 'applied')";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "iiss", $job_id, $applicant_id, $resumePath, $cover_letter);
    $success = mysqli_stmt_execute($stmt);
    
    if (!$success) {
        error_log("Job application failed: " . mysqli_error($con));
        mysqli_stmt_close($stmt);
        mysqli_close($con);
        return ['success' => false, 'error' => 'Failed to submit application'];
    }
    
    $applicationId = mysqli_insert_id($con);
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    
    return ['success' => true, 'application_id' => $applicationId];
}

/**
 * Save a job
 */
function saveJob($applicant_id, $job_id) {
    $con = getConnection();
    
    // Check if already saved
    $checkSql = "SELECT id FROM saved_jobs WHERE applicant_id = ? AND job_id = ?";
    $checkStmt = mysqli_prepare($con, $checkSql);
    mysqli_stmt_bind_param($checkStmt, "ii", $applicant_id, $job_id);
    mysqli_stmt_execute($checkStmt);
    $result = mysqli_stmt_get_result($checkStmt);
    
    if (mysqli_num_rows($result) > 0) {
        mysqli_stmt_close($checkStmt);
        mysqli_close($con);
        return ['success' => false, 'error' => 'Job already saved'];
    }
    mysqli_stmt_close($checkStmt);
    
    // Check if job exists
    $jobSql = "SELECT id FROM jobs WHERE id = ?";
    $jobStmt = mysqli_prepare($con, $jobSql);
    mysqli_stmt_bind_param($jobStmt, "i", $job_id);
    mysqli_stmt_execute($jobStmt);
    $jobResult = mysqli_stmt_get_result($jobStmt);
    
    if (mysqli_num_rows($jobResult) == 0) {
        mysqli_stmt_close($jobStmt);
        mysqli_close($con);
        return ['success' => false, 'error' => 'Job not found'];
    }
    mysqli_stmt_close($jobStmt);
    
    // Insert saved job
    $sql = "INSERT INTO saved_jobs (applicant_id, job_id) VALUES (?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $applicant_id, $job_id);
    $success = mysqli_stmt_execute($stmt);
    
    if (!$success) {
        error_log("Save job failed: " . mysqli_error($con));
        mysqli_stmt_close($stmt);
        mysqli_close($con);
        return ['success' => false, 'error' => 'Failed to save job'];
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    
    return ['success' => true];
}

/**
 * Unsave a job
 */
function unsaveJob($applicant_id, $job_id) {
    $con = getConnection();
    $sql = "DELETE FROM saved_jobs WHERE applicant_id = ? AND job_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $applicant_id, $job_id);
    $success = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    return $success;
}

/**
 * Check if job is saved
 */
function isJobSaved($applicant_id, $job_id) {
    $con = getConnection();
    $sql = "SELECT id FROM saved_jobs WHERE applicant_id = ? AND job_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $applicant_id, $job_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $isSaved = mysqli_num_rows($result) > 0;
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    return $isSaved;
}

/**
 * Check if job is applied
 */
function isJobApplied($applicant_id, $job_id) {
    $con = getConnection();
    $sql = "SELECT id FROM job_applications WHERE applicant_id = ? AND job_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $applicant_id, $job_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $isApplied = mysqli_num_rows($result) > 0;
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    return $isApplied;
}
?>

