<?php
session_start();
require_once '../model/resume_model.php';
require_once '../model/db.php';

header('Content-Type: application/json');

if (!isset($_SESSION['status']) || !isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'applicant') {
    echo json_encode(['success' => false, 'error' => 'Please login as an applicant to save your resume']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $applicant_id = $_SESSION['user_id'];
    
    // Get form data
    $resumeData = [
        'applicant_id' => $applicant_id,
        'full_name' => isset($_POST['fullName']) ? trim($_POST['fullName']) : '',
        'job_title' => isset($_POST['jobTitle']) ? trim($_POST['jobTitle']) : '',
        'email' => isset($_POST['email']) ? trim($_POST['email']) : '',
        'phone' => isset($_POST['phone']) ? trim($_POST['phone']) : '',
        'location' => isset($_POST['location']) ? trim($_POST['location']) : '',
        'website' => isset($_POST['website']) ? trim($_POST['website']) : '',
        'summary' => isset($_POST['summary']) ? trim($_POST['summary']) : '',
        'skills' => isset($_POST['skills']) ? trim($_POST['skills']) : '',
        'languages' => isset($_POST['languages']) ? trim($_POST['languages']) : '',
        'experience' => isset($_POST['experience']) ? json_decode($_POST['experience'], true) : [],
        'education' => isset($_POST['education']) ? json_decode($_POST['education'], true) : [],
        'certifications' => isset($_POST['certifications']) ? json_decode($_POST['certifications'], true) : [],
        'resume_file_path' => isset($_POST['resume_file_path']) ? trim($_POST['resume_file_path']) : ''
    ];
    
    // Validate required fields
    if (empty($resumeData['full_name']) || empty($resumeData['email'])) {
        echo json_encode(['success' => false, 'error' => 'Full name and email are required']);
        exit();
    }
    
    // Save resume
    $result = saveResume($resumeData);
    echo json_encode($result);
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>

