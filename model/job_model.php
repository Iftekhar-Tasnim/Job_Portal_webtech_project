<?php
require_once 'db.php';

/**
 * Get all active jobs from database
 */
function getAllJobs($filters = []) {
    $con = getConnection();
    
    $sql = "SELECT j.*, e.Company_Name as employer_company
            FROM jobs j
            LEFT JOIN employerreg e ON j.employer_id = e.id
            WHERE j.status = 'active'";
    
    $params = [];
    $types = '';
    
    // Apply filters
    if (isset($filters['location']) && !empty($filters['location'])) {
        $sql .= " AND LOWER(j.location) LIKE ?";
        $params[] = '%' . strtolower($filters['location']) . '%';
        $types .= 's';
    }
    
    if (isset($filters['category']) && !empty($filters['category'])) {
        $sql .= " AND j.category = ?";
        $params[] = $filters['category'];
        $types .= 's';
    }
    
    if (isset($filters['experience_level']) && !empty($filters['experience_level'])) {
        $sql .= " AND j.experience_level = ?";
        $params[] = $filters['experience_level'];
        $types .= 's';
    }
    
    if (isset($filters['job_type']) && !empty($filters['job_type'])) {
        $sql .= " AND j.job_type = ?";
        $params[] = $filters['job_type'];
        $types .= 's';
    }
    
    if (isset($filters['search']) && !empty($filters['search'])) {
        $sql .= " AND (LOWER(j.title) LIKE ? OR LOWER(j.company) LIKE ? OR LOWER(j.description) LIKE ?)";
        $searchTerm = '%' . strtolower($filters['search']) . '%';
        $params[] = $searchTerm;
        $params[] = $searchTerm;
        $params[] = $searchTerm;
        $types .= 'sss';
    }
    
    $sql .= " ORDER BY j.posted_date DESC";
    
    $stmt = mysqli_prepare($con, $sql);
    
    if (!empty($params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
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
 * Get job by ID
 */
function getJobById($job_id) {
    $con = getConnection();
    $sql = "SELECT j.*, e.Company_Name as employer_company
            FROM jobs j
            LEFT JOIN employerreg e ON j.employer_id = e.id
            WHERE j.id = ? AND j.status = 'active'";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $job_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $job = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    return $job;
}

/**
 * Get unique locations from jobs
 */
function getJobLocations() {
    $con = getConnection();
    $sql = "SELECT DISTINCT location FROM jobs WHERE status = 'active' ORDER BY location";
    $result = mysqli_query($con, $sql);
    $locations = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $locations[] = $row['location'];
    }
    mysqli_close($con);
    return $locations;
}

/**
 * Get job count
 */
function getJobCount($filters = []) {
    $con = getConnection();
    
    $sql = "SELECT COUNT(*) as count FROM jobs WHERE status = 'active'";
    
    $params = [];
    $types = '';
    
    // Apply same filters as getAllJobs
    if (isset($filters['location']) && !empty($filters['location'])) {
        $sql .= " AND LOWER(location) LIKE ?";
        $params[] = '%' . strtolower($filters['location']) . '%';
        $types .= 's';
    }
    
    if (isset($filters['category']) && !empty($filters['category'])) {
        $sql .= " AND category = ?";
        $params[] = $filters['category'];
        $types .= 's';
    }
    
    if (isset($filters['experience_level']) && !empty($filters['experience_level'])) {
        $sql .= " AND experience_level = ?";
        $params[] = $filters['experience_level'];
        $types .= 's';
    }
    
    if (isset($filters['job_type']) && !empty($filters['job_type'])) {
        $sql .= " AND job_type = ?";
        $params[] = $filters['job_type'];
        $types .= 's';
    }
    
    if (isset($filters['search']) && !empty($filters['search'])) {
        $sql .= " AND (LOWER(title) LIKE ? OR LOWER(company) LIKE ? OR LOWER(description) LIKE ?)";
        $searchTerm = '%' . strtolower($filters['search']) . '%';
        $params[] = $searchTerm;
        $params[] = $searchTerm;
        $params[] = $searchTerm;
        $types .= 'sss';
    }
    
    $stmt = mysqli_prepare($con, $sql);
    
    if (!empty($params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }
    
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];
    
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    
    return $count;
}
?>

