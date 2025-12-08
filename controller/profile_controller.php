<?php
session_start();
require_once '../model/profile_model.php';

header('Content-Type: application/json');

if (!isset($_SESSION['status']) || !isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'applicant') {
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit();
}

$applicant_id = $_SESSION['user_id'];
$action = isset($_POST['action']) ? $_POST['action'] : '';

switch ($action) {
    case 'update_profile':
        $data = [
            'fullName' => isset($_POST['fullName']) ? trim($_POST['fullName']) : '',
            'email' => isset($_POST['email']) ? trim($_POST['email']) : '',
            'phone' => isset($_POST['phone']) ? trim($_POST['phone']) : '',
            'location' => isset($_POST['location']) ? trim($_POST['location']) : ''
        ];
        
        if (empty($data['fullName']) || empty($data['email'])) {
            echo json_encode(['success' => false, 'error' => 'Name and email are required']);
            exit();
        }
        
        if (updateApplicantProfile($applicant_id, $data)) {
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
        
        if (updatePassword($applicant_id, $password)) {
            echo json_encode(['success' => true, 'message' => 'Password updated successfully']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update password']);
        }
        break;
        
    default:
        echo json_encode(['success' => false, 'error' => 'Invalid action']);
        break;
}
?>

