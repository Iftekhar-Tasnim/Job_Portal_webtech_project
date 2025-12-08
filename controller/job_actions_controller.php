<?php
session_start();
require_once '../model/profile_model.php';

header('Content-Type: application/json');

if (!isset($_SESSION['status']) || !isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'applicant') {
    echo json_encode(['success' => false, 'error' => 'Unauthorized. Please login as an applicant.']);
    exit();
}

$applicant_id = $_SESSION['user_id'];
$action = isset($_POST['action']) ? $_POST['action'] : '';

switch ($action) {
    case 'apply_job':
        $job_id = isset($_POST['job_id']) ? intval($_POST['job_id']) : 0;
        $cover_letter = isset($_POST['cover_letter']) ? trim($_POST['cover_letter']) : '';
        
        if ($job_id <= 0) {
            echo json_encode(['success' => false, 'error' => 'Invalid job ID']);
            exit();
        }
        
        $result = applyForJob($applicant_id, $job_id, $cover_letter);
        echo json_encode($result);
        break;
        
    case 'save_job':
        $job_id = isset($_POST['job_id']) ? intval($_POST['job_id']) : 0;
        
        if ($job_id <= 0) {
            echo json_encode(['success' => false, 'error' => 'Invalid job ID']);
            exit();
        }
        
        $result = saveJob($applicant_id, $job_id);
        echo json_encode($result);
        break;
        
    case 'unsave_job':
        $job_id = isset($_POST['job_id']) ? intval($_POST['job_id']) : 0;
        
        if ($job_id <= 0) {
            echo json_encode(['success' => false, 'error' => 'Invalid job ID']);
            exit();
        }
        
        if (unsaveJob($applicant_id, $job_id)) {
            echo json_encode(['success' => true, 'message' => 'Job unsaved successfully']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to unsave job']);
        }
        break;
        
    case 'check_saved':
        $job_id = isset($_GET['job_id']) ? intval($_GET['job_id']) : 0;
        
        if ($job_id <= 0) {
            echo json_encode(['success' => false, 'error' => 'Invalid job ID']);
            exit();
        }
        
        $isSaved = isJobSaved($applicant_id, $job_id);
        echo json_encode(['success' => true, 'saved' => $isSaved]);
        break;
        
    case 'check_applied':
        $job_id = isset($_GET['job_id']) ? intval($_GET['job_id']) : 0;
        
        if ($job_id <= 0) {
            echo json_encode(['success' => false, 'error' => 'Invalid job ID']);
            exit();
        }
        
        $isApplied = isJobApplied($applicant_id, $job_id);
        echo json_encode(['success' => true, 'applied' => $isApplied]);
        break;
        
    default:
        echo json_encode(['success' => false, 'error' => 'Invalid action']);
        break;
}
?>

