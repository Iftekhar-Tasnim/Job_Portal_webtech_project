<?php
require_once 'db.php';

/**
 * Get company profile data
 */
function getCompanyProfile($employer_id) {
    $con = getConnection();
    $sql = "SELECT * FROM employerreg WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $employer_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $profile = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    return $profile;
}

/**
 * Update company profile
 */
function updateCompanyProfile($employer_id, $data) {
    $con = getConnection();
    
    $companyName = isset($data['companyName']) ? trim($data['companyName']) : '';
    $email = isset($data['email']) ? trim($data['email']) : '';
    $phone = isset($data['phone']) ? trim($data['phone']) : '';
    $address = isset($data['address']) ? trim($data['address']) : '';
    $businessType = isset($data['businessType']) ? trim($data['businessType']) : '';
    $companySize = isset($data['companySize']) ? trim($data['companySize']) : '';
    $website = isset($data['website']) ? trim($data['website']) : '';
    $industry = isset($data['industry']) ? trim($data['industry']) : '';
    
    $sql = "UPDATE employerreg SET 
            Company_Name = ?, Email = ?, Company_Phone = ?, Company_Address = ?, 
            Business_Type = ?, Company_Size = ?, Company_Website = ?, Industry = ?
            WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssssi", 
        $companyName, $email, $phone, $address, 
        $businessType, $companySize, $website, $industry, $employer_id
    );
    $success = mysqli_stmt_execute($stmt);
    
    if (!$success) {
        error_log("Company profile update failed: " . mysqli_error($con));
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    return $success;
}

/**
 * Get company statistics
 */
function getCompanyStats($employer_id) {
    $con = getConnection();
    
    $stats = [
        'total_jobs' => 0,
        'active_jobs' => 0,
        'draft_jobs' => 0,
        'closed_jobs' => 0,
        'total_applications' => 0,
        'pending_reviews' => 0,
        'interviews' => 0,
        'offers' => 0
    ];
    
    // Get job counts
    $sql = "SELECT status, COUNT(*) as count FROM jobs WHERE employer_id = ? GROUP BY status";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $employer_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $stats['total_jobs'] += $row['count'];
        if ($row['status'] === 'active') {
            $stats['active_jobs'] = $row['count'];
        } elseif ($row['status'] === 'draft') {
            $stats['draft_jobs'] = $row['count'];
        } elseif ($row['status'] === 'closed') {
            $stats['closed_jobs'] = $row['count'];
        }
    }
    mysqli_stmt_close($stmt);
    
    // Get application counts
    $sql = "SELECT ja.status, COUNT(*) as count 
            FROM job_applications ja
            JOIN jobs j ON ja.job_id = j.id
            WHERE j.employer_id = ?
            GROUP BY ja.status";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $employer_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $stats['total_applications'] += $row['count'];
        if ($row['status'] === 'applied' || $row['status'] === 'review') {
            $stats['pending_reviews'] += $row['count'];
        } elseif ($row['status'] === 'interview') {
            $stats['interviews'] = $row['count'];
        } elseif ($row['status'] === 'offer') {
            $stats['offers'] = $row['count'];
        }
    }
    mysqli_stmt_close($stmt);
    
    mysqli_close($con);
    return $stats;
}

/**
 * Create new job
 */
function createJob($employer_id, $jobData) {
    $con = getConnection();
    
    $title = isset($jobData['title']) ? trim($jobData['title']) : '';
    $company = isset($jobData['company']) ? trim($jobData['company']) : '';
    $description = isset($jobData['description']) ? trim($jobData['description']) : '';
    $requirements = isset($jobData['requirements']) ? trim($jobData['requirements']) : '';
    $location = isset($jobData['location']) ? trim($jobData['location']) : '';
    $category = isset($jobData['category']) ? trim($jobData['category']) : '';
    $experienceLevel = isset($jobData['experience_level']) ? trim($jobData['experience_level']) : 'entry';
    $jobType = isset($jobData['job_type']) ? trim($jobData['job_type']) : 'full-time';
    $status = isset($jobData['status']) ? trim($jobData['status']) : 'active';
    
    // Handle optional fields - convert empty strings to NULL
    $salaryMin = (isset($jobData['salary_min']) && $jobData['salary_min'] !== '' && $jobData['salary_min'] !== null) 
        ? floatval($jobData['salary_min']) : null;
    $salaryMax = (isset($jobData['salary_max']) && $jobData['salary_max'] !== '' && $jobData['salary_max'] !== null) 
        ? floatval($jobData['salary_max']) : null;
    $deadline = (isset($jobData['deadline']) && !empty($jobData['deadline'])) ? trim($jobData['deadline']) : null;
    
    // Build SQL with proper NULL handling
    $sql = "INSERT INTO jobs 
            (employer_id, title, company, description, requirements, location, category, 
             experience_level, job_type, salary_min, salary_max, status, deadline)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    
    if (!$stmt) {
        error_log("Job creation prepare failed: " . mysqli_error($con));
        mysqli_close($con);
        return false;
    }
    
    // For NULL values, we'll use a workaround: bind as string 'NULL' then update
    // Or better: use proper binding with references
    $salaryMinVal = $salaryMin;
    $salaryMaxVal = $salaryMax;
    $deadlineVal = $deadline;
    
    // Bind parameters - all as strings except employer_id (MySQL will handle type conversion)
    mysqli_stmt_bind_param($stmt, "issssssssssss", 
        $employer_id, 
        $title, 
        $company, 
        $description, 
        $requirements, 
        $location, 
        $category,
        $experienceLevel, 
        $jobType, 
        $salaryMinVal, 
        $salaryMaxVal, 
        $status, 
        $deadlineVal
    );
    
    $success = mysqli_stmt_execute($stmt);
    
    if (!$success) {
        error_log("Job creation failed: " . mysqli_error($con));
        error_log("SQL Error: " . mysqli_stmt_error($stmt));
    }
    
    $jobId = $success ? mysqli_insert_id($con) : null;
    
    // Update NULL values if needed (for salary fields)
    if ($success && $jobId) {
        $needsUpdate = false;
        $updateFields = [];
        
        if ($salaryMin === null) {
            $updateFields[] = "salary_min = NULL";
            $needsUpdate = true;
        }
        if ($salaryMax === null) {
            $updateFields[] = "salary_max = NULL";
            $needsUpdate = true;
        }
        if ($deadline === null) {
            $updateFields[] = "deadline = NULL";
            $needsUpdate = true;
        }
        
        if ($needsUpdate) {
            $updateSql = "UPDATE jobs SET " . implode(", ", $updateFields) . " WHERE id = ?";
            $updateStmt = mysqli_prepare($con, $updateSql);
            if ($updateStmt) {
                mysqli_stmt_bind_param($updateStmt, "i", $jobId);
                mysqli_stmt_execute($updateStmt);
                mysqli_stmt_close($updateStmt);
            }
        }
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    return $jobId;
}

/**
 * Update job
 */
function updateJob($job_id, $employer_id, $jobData) {
    $con = getConnection();
    
    // Verify ownership
    $checkSql = "SELECT id FROM jobs WHERE id = ? AND employer_id = ?";
    $checkStmt = mysqli_prepare($con, $checkSql);
    mysqli_stmt_bind_param($checkStmt, "ii", $job_id, $employer_id);
    mysqli_stmt_execute($checkStmt);
    $result = mysqli_stmt_get_result($checkStmt);
    
    if (mysqli_num_rows($result) == 0) {
        mysqli_stmt_close($checkStmt);
        mysqli_close($con);
        return false;
    }
    mysqli_stmt_close($checkStmt);
    
    $title = isset($jobData['title']) ? trim($jobData['title']) : '';
    $company = isset($jobData['company']) ? trim($jobData['company']) : '';
    $description = isset($jobData['description']) ? trim($jobData['description']) : '';
    $requirements = isset($jobData['requirements']) ? trim($jobData['requirements']) : '';
    $location = isset($jobData['location']) ? trim($jobData['location']) : '';
    $category = isset($jobData['category']) ? trim($jobData['category']) : '';
    $experienceLevel = isset($jobData['experience_level']) ? trim($jobData['experience_level']) : 'entry';
    $jobType = isset($jobData['job_type']) ? trim($jobData['job_type']) : 'full-time';
    $salaryMin = isset($jobData['salary_min']) ? floatval($jobData['salary_min']) : null;
    $salaryMax = isset($jobData['salary_max']) ? floatval($jobData['salary_max']) : null;
    $status = isset($jobData['status']) ? trim($jobData['status']) : 'active';
    $deadline = isset($jobData['deadline']) && !empty($jobData['deadline']) ? $jobData['deadline'] : null;
    
    $sql = "UPDATE jobs SET 
            title = ?, company = ?, description = ?, requirements = ?, location = ?, category = ?,
            experience_level = ?, job_type = ?, salary_min = ?, salary_max = ?, status = ?, deadline = ?
            WHERE id = ? AND employer_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssssddssii", 
        $title, $company, $description, $requirements, $location, $category,
        $experienceLevel, $jobType, $salaryMin, $salaryMax, $status, $deadline,
        $job_id, $employer_id
    );
    $success = mysqli_stmt_execute($stmt);
    
    if (!$success) {
        error_log("Job update failed: " . mysqli_error($con));
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    return $success;
}

/**
 * Delete job
 */
function deleteJob($job_id, $employer_id) {
    $con = getConnection();
    
    // Verify ownership
    $checkSql = "SELECT id FROM jobs WHERE id = ? AND employer_id = ?";
    $checkStmt = mysqli_prepare($con, $checkSql);
    mysqli_stmt_bind_param($checkStmt, "ii", $job_id, $employer_id);
    mysqli_stmt_execute($checkStmt);
    $result = mysqli_stmt_get_result($checkStmt);
    
    if (mysqli_num_rows($result) == 0) {
        mysqli_stmt_close($checkStmt);
        mysqli_close($con);
        return false;
    }
    mysqli_stmt_close($checkStmt);
    
    $sql = "DELETE FROM jobs WHERE id = ? AND employer_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $job_id, $employer_id);
    $success = mysqli_stmt_execute($stmt);
    
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    return $success;
}

/**
 * Get company's jobs
 */
function getCompanyJobs($employer_id, $status = null) {
    $con = getConnection();
    
    if ($status && $status !== 'all') {
        $sql = "SELECT j.*, 
                (SELECT COUNT(*) FROM job_applications WHERE job_id = j.id) as application_count
                FROM jobs j
                WHERE j.employer_id = ? AND j.status = ?
                ORDER BY j.posted_date DESC";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "is", $employer_id, $status);
    } else {
        $sql = "SELECT j.*, 
                (SELECT COUNT(*) FROM job_applications WHERE job_id = j.id) as application_count
                FROM jobs j
                WHERE j.employer_id = ?
                ORDER BY j.posted_date DESC";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "i", $employer_id);
    }
    
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $jobs = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $jobs[] = $row;
    }
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    return $jobs;
}

/**
 * Get job by ID (with ownership check)
 */
function getJobById($job_id, $employer_id) {
    $con = getConnection();
    $sql = "SELECT * FROM jobs WHERE id = ? AND employer_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $job_id, $employer_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $job = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    return $job;
}

/**
 * Get applications for company's jobs
 */
function getJobApplications($employer_id, $job_id = null) {
    $con = getConnection();
    
    if ($job_id) {
        $sql = "SELECT ja.*, j.title as job_title, j.company, 
                a.First_Name, a.Last_Name, a.Email, a.Phone
                FROM job_applications ja
                JOIN jobs j ON ja.job_id = j.id
                JOIN applicantreg a ON ja.applicant_id = a.id
                WHERE j.employer_id = ? AND ja.job_id = ?
                ORDER BY ja.applied_date DESC";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $employer_id, $job_id);
    } else {
        $sql = "SELECT ja.*, j.title as job_title, j.company, 
                a.First_Name, a.Last_Name, a.Email, a.Phone
                FROM job_applications ja
                JOIN jobs j ON ja.job_id = j.id
                JOIN applicantreg a ON ja.applicant_id = a.id
                WHERE j.employer_id = ?
                ORDER BY ja.applied_date DESC";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "i", $employer_id);
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
 * Update application status
 */
function updateApplicationStatus($application_id, $employer_id, $status) {
    $con = getConnection();
    
    // Verify ownership through job
    $checkSql = "SELECT ja.id FROM job_applications ja
                 JOIN jobs j ON ja.job_id = j.id
                 WHERE ja.id = ? AND j.employer_id = ?";
    $checkStmt = mysqli_prepare($con, $checkSql);
    mysqli_stmt_bind_param($checkStmt, "ii", $application_id, $employer_id);
    mysqli_stmt_execute($checkStmt);
    $result = mysqli_stmt_get_result($checkStmt);
    
    if (mysqli_num_rows($result) == 0) {
        mysqli_stmt_close($checkStmt);
        mysqli_close($con);
        return false;
    }
    mysqli_stmt_close($checkStmt);
    
    $sql = "UPDATE job_applications SET status = ? WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "si", $status, $application_id);
    $success = mysqli_stmt_execute($stmt);
    
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    return $success;
}

/**
 * Update password
 */
function updateCompanyPassword($employer_id, $password) {
    $con = getConnection();
    $sql = "UPDATE employerreg SET Password = ? WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "si", $password, $employer_id);
    $success = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    return $success;
}
?>

