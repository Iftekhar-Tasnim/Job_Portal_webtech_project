<?php
session_start();
require_once '../model/password_reset_model.php';

header('Content-Type: application/json');

$action = isset($_POST['action']) ? $_POST['action'] : '';

switch ($action) {
    case 'check_email':
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        
        if (empty($email)) {
            echo json_encode(['success' => false, 'error' => 'Email is required']);
            exit();
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'error' => 'Invalid email format']);
            exit();
        }
        
        $user = checkEmailExists($email);
        
        if ($user) {
            echo json_encode([
                'success' => true,
                'message' => 'Email found',
                'user_type' => $user['user_type'],
                'name' => $user['First_Name'] . ' ' . $user['Last_Name']
            ]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Email not found in our system']);
        }
        break;
        
    case 'reset_password':
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $newPassword = isset($_POST['new_password']) ? trim($_POST['new_password']) : '';
        $confirmPassword = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';
        $userType = isset($_POST['user_type']) ? trim($_POST['user_type']) : '';
        
        if (empty($email) || empty($newPassword) || empty($confirmPassword)) {
            echo json_encode(['success' => false, 'error' => 'All fields are required']);
            exit();
        }
        
        if ($newPassword !== $confirmPassword) {
            echo json_encode(['success' => false, 'error' => 'Passwords do not match']);
            exit();
        }
        
        if (strlen($newPassword) < 6) {
            echo json_encode(['success' => false, 'error' => 'Password must be at least 6 characters long']);
            exit();
        }
        
        // Verify email exists
        $user = checkEmailExists($email);
        if (!$user) {
            echo json_encode(['success' => false, 'error' => 'Email not found']);
            exit();
        }
        
        // Reset password
        $success = resetPassword($email, $newPassword, $userType);
        
        if ($success) {
            echo json_encode([
                'success' => true,
                'message' => 'Password reset successfully! You can now login with your new password.'
            ]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to reset password. Please try again.']);
        }
        break;
        
    default:
        echo json_encode(['success' => false, 'error' => 'Invalid action']);
        break;
}
?>

