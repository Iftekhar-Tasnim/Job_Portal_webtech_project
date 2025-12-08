<?php
session_start();
require_once '../model/company_model.php';

header('Content-Type: application/json');

if (!isset($_SESSION['status']) || !isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'employer') {
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit();
}

$employer_id = $_SESSION['user_id'];
$action = isset($_POST['action']) ? $_POST['action'] : '';

switch ($action) {
    case 'update_profile':
        $data = [
            'companyName' => isset($_POST['companyName']) ? trim($_POST['companyName']) : '',
            'email' => isset($_POST['email']) ? trim($_POST['email']) : '',
            'phone' => isset($_POST['phone']) ? trim($_POST['phone']) : '',
            'address' => isset($_POST['address']) ? trim($_POST['address']) : '',
            'businessType' => isset($_POST['businessType']) ? trim($_POST['businessType']) : '',
            'companySize' => isset($_POST['companySize']) ? trim($_POST['companySize']) : '',
            'website' => isset($_POST['website']) ? trim($_POST['website']) : '',
            'industry' => isset($_POST['industry']) ? trim($_POST['industry']) : ''
        ];
        
        if (empty($data['companyName']) || empty($data['email'])) {
            echo json_encode(['success' => false, 'error' => 'Company name and email are required']);
            exit();
        }
        
        if (updateCompanyProfile($employer_id, $data)) {
            echo json_encode(['success' => true, 'message' => 'Profile updated successfully']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update profile']);
        }
        break;
        
    case 'update_password':
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
        $confirmPassword = isset($_POST['confirmPassword']) ? trim($_POST['confirmPassword']) : '';
        
        if (empty($password) || empty($confirmPassword)) {
            echo json_encode(['success' => false, 'error' => 'Password fields are required']);
            exit();
        }
        
        if ($password !== $confirmPassword) {
            echo json_encode(['success' => false, 'error' => 'Passwords do not match']);
            exit();
        }
        
        if (strlen($password) < 6) {
            echo json_encode(['success' => false, 'error' => 'Password must be at least 6 characters']);
            exit();
        }
        
        if (updateCompanyPassword($employer_id, $password)) {
            echo json_encode(['success' => true, 'message' => 'Password updated successfully']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update password']);
        }
        break;
        
    case 'create_job':
        $jobData = [
            'title' => isset($_POST['title']) ? trim($_POST['title']) : '',
            'company' => isset($_POST['company']) ? trim($_POST['company']) : '',
            'description' => isset($_POST['description']) ? trim($_POST['description']) : '',
            'requirements' => isset($_POST['requirements']) ? trim($_POST['requirements']) : '',
            'location' => isset($_POST['location']) ? trim($_POST['location']) : '',
            'category' => isset($_POST['category']) ? trim($_POST['category']) : '',
            'experience_level' => isset($_POST['experience_level']) ? trim($_POST['experience_level']) : 'entry',
            'job_type' => isset($_POST['job_type']) ? trim($_POST['job_type']) : 'full-time',
            'salary_min' => isset($_POST['salary_min']) ? $_POST['salary_min'] : null,
            'salary_max' => isset($_POST['salary_max']) ? $_POST['salary_max'] : null,
            'status' => isset($_POST['status']) ? trim($_POST['status']) : 'active',
            'deadline' => isset($_POST['deadline']) && !empty($_POST['deadline']) ? $_POST['deadline'] : null
        ];
        
        if (empty($jobData['title']) || empty($jobData['description']) || empty($jobData['location'])) {
            echo json_encode(['success' => false, 'error' => 'Title, description, and location are required']);
            exit();
        }
        
        $jobId = createJob($employer_id, $jobData);
        if ($jobId) {
            echo json_encode(['success' => true, 'message' => 'Job created successfully', 'job_id' => $jobId]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to create job']);
        }
        break;
        
    case 'update_job':
        $job_id = isset($_POST['job_id']) ? intval($_POST['job_id']) : 0;
        
        if ($job_id <= 0) {
            echo json_encode(['success' => false, 'error' => 'Invalid job ID']);
            exit();
        }
        
        $jobData = [
            'title' => isset($_POST['title']) ? trim($_POST['title']) : '',
            'company' => isset($_POST['company']) ? trim($_POST['company']) : '',
            'description' => isset($_POST['description']) ? trim($_POST['description']) : '',
            'requirements' => isset($_POST['requirements']) ? trim($_POST['requirements']) : '',
            'location' => isset($_POST['location']) ? trim($_POST['location']) : '',
            'category' => isset($_POST['category']) ? trim($_POST['category']) : '',
            'experience_level' => isset($_POST['experience_level']) ? trim($_POST['experience_level']) : 'entry',
            'job_type' => isset($_POST['job_type']) ? trim($_POST['job_type']) : 'full-time',
            'salary_min' => isset($_POST['salary_min']) ? $_POST['salary_min'] : null,
            'salary_max' => isset($_POST['salary_max']) ? $_POST['salary_max'] : null,
            'status' => isset($_POST['status']) ? trim($_POST['status']) : 'active',
            'deadline' => isset($_POST['deadline']) && !empty($_POST['deadline']) ? $_POST['deadline'] : null
        ];
        
        if (updateJob($job_id, $employer_id, $jobData)) {
            echo json_encode(['success' => true, 'message' => 'Job updated successfully']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update job']);
        }
        break;
        
    case 'delete_job':
        $job_id = isset($_POST['job_id']) ? intval($_POST['job_id']) : 0;
        
        if ($job_id <= 0) {
            echo json_encode(['success' => false, 'error' => 'Invalid job ID']);
            exit();
        }
        
        if (deleteJob($job_id, $employer_id)) {
            echo json_encode(['success' => true, 'message' => 'Job deleted successfully']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to delete job']);
        }
        break;
        
    case 'update_application_status':
        $application_id = isset($_POST['application_id']) ? intval($_POST['application_id']) : 0;
        $status = isset($_POST['status']) ? trim($_POST['status']) : '';
        
        if ($application_id <= 0 || empty($status)) {
            echo json_encode(['success' => false, 'error' => 'Invalid application ID or status']);
            exit();
        }
        
        $validStatuses = ['applied', 'review', 'interview', 'offer', 'rejected'];
        if (!in_array($status, $validStatuses)) {
            echo json_encode(['success' => false, 'error' => 'Invalid status']);
            exit();
        }
        
        if (updateApplicationStatus($application_id, $employer_id, $status)) {
            echo json_encode(['success' => true, 'message' => 'Application status updated successfully']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update application status']);
        }
        break;
        
    default:
        echo json_encode(['success' => false, 'error' => 'Invalid action']);
        break;
}
?>

