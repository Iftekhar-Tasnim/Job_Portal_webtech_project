<?php
require_once 'db.php';

function saveResume($resumeData) {
    $con = getConnection();
    
    $applicant_id = $resumeData['applicant_id'];
    $full_name = $resumeData['full_name'];
    $job_title = isset($resumeData['job_title']) ? $resumeData['job_title'] : '';
    $email = $resumeData['email'];
    $phone = isset($resumeData['phone']) ? $resumeData['phone'] : '';
    $location = isset($resumeData['location']) ? $resumeData['location'] : '';
    $website = isset($resumeData['website']) ? $resumeData['website'] : '';
    $summary = isset($resumeData['summary']) ? $resumeData['summary'] : '';
    $experience = isset($resumeData['experience']) ? json_encode($resumeData['experience']) : '';
    $education = isset($resumeData['education']) ? json_encode($resumeData['education']) : '';
    $skills = isset($resumeData['skills']) ? $resumeData['skills'] : '';
    $certifications = isset($resumeData['certifications']) ? json_encode($resumeData['certifications']) : '';
    $languages = isset($resumeData['languages']) ? $resumeData['languages'] : '';
    $resume_file_path = isset($resumeData['resume_file_path']) ? $resumeData['resume_file_path'] : '';
    
    // Check if resume already exists for this applicant
    $checkSql = "SELECT id FROM resumes WHERE applicant_id = ?";
    $stmt = mysqli_prepare($con, $checkSql);
    mysqli_stmt_bind_param($stmt, "i", $applicant_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $existing = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    
    if ($existing) {
        // Update existing resume
        $sql = "UPDATE resumes SET 
                full_name = ?, job_title = ?, email = ?, phone = ?, location = ?, website = ?, 
                summary = ?, experience = ?, education = ?, skills = ?, certifications = ?, 
                languages = ?, resume_file_path = ?, updated_at = CURRENT_TIMESTAMP
                WHERE applicant_id = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssssssssi", 
            $full_name, $job_title, $email, $phone, $location, $website, 
            $summary, $experience, $education, $skills, $certifications, 
            $languages, $resume_file_path, $applicant_id);
    } else {
        // Insert new resume
        $sql = "INSERT INTO resumes (applicant_id, full_name, job_title, email, phone, location, website, 
                summary, experience, education, skills, certifications, languages, resume_file_path)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "isssssssssssss", 
            $applicant_id, $full_name, $job_title, $email, $phone, $location, $website, 
            $summary, $experience, $education, $skills, $certifications, 
            $languages, $resume_file_path);
    }
    
    $success = mysqli_stmt_execute($stmt);
    $resume_id = $existing ? $existing['id'] : mysqli_insert_id($con);
    
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    
    return $success ? ['success' => true, 'id' => $resume_id] : ['success' => false, 'error' => 'Failed to save resume'];
}

function getResume($applicant_id) {
    $con = getConnection();
    
    $sql = "SELECT * FROM resumes WHERE applicant_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $applicant_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $resume = mysqli_fetch_assoc($result);
    
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    
    if ($resume) {
        // Decode JSON fields
        $resume['experience'] = json_decode($resume['experience'], true) ?: [];
        $resume['education'] = json_decode($resume['education'], true) ?: [];
        $resume['certifications'] = json_decode($resume['certifications'], true) ?: [];
    }
    
    return $resume;
}

function deleteResume($applicant_id) {
    $con = getConnection();
    
    $sql = "DELETE FROM resumes WHERE applicant_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $applicant_id);
    $success = mysqli_stmt_execute($stmt);
    
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    
    return $success;
}
?>

