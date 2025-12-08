<?php
header('Content-Type: application/json');
require_once '../model/job_model.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'get_jobs';

switch ($action) {
    case 'get_jobs':
        $filters = [
            'location' => isset($_GET['location']) ? $_GET['location'] : '',
            'category' => isset($_GET['category']) ? $_GET['category'] : '',
            'experience_level' => isset($_GET['experience']) ? $_GET['experience'] : '',
            'job_type' => isset($_GET['job_type']) ? $_GET['job_type'] : '',
            'search' => isset($_GET['search']) ? $_GET['search'] : ''
        ];
        
        $jobs = getAllJobs($filters);
        
        // Format jobs for frontend
        $formattedJobs = [];
        foreach ($jobs as $job) {
            $formattedJobs[] = [
                'id' => (int)$job['id'],
                'title' => $job['title'],
                'company' => $job['company'],
                'location' => $job['location'],
                'category' => $job['category'],
                'experience' => $job['experience_level'],
                'jobType' => $job['job_type'],
                'salary' => formatSalary($job['salary_min'], $job['salary_max']),
                'description' => $job['description'],
                'requirements' => parseRequirements($job['requirements']),
                'posted_date' => $job['posted_date'],
                'deadline' => $job['deadline']
            ];
        }
        
        echo json_encode(['success' => true, 'jobs' => $formattedJobs, 'count' => count($formattedJobs)]);
        break;
        
    case 'get_job':
        $job_id = isset($_GET['job_id']) ? intval($_GET['job_id']) : 0;
        if ($job_id <= 0) {
            echo json_encode(['success' => false, 'error' => 'Invalid job ID']);
            exit();
        }
        
        $job = getJobById($job_id);
        if ($job) {
            $formattedJob = [
                'id' => (int)$job['id'],
                'title' => $job['title'],
                'company' => $job['company'],
                'location' => $job['location'],
                'category' => $job['category'],
                'experience' => $job['experience_level'],
                'jobType' => $job['job_type'],
                'salary' => formatSalary($job['salary_min'], $job['salary_max']),
                'description' => $job['description'],
                'requirements' => parseRequirements($job['requirements']),
                'posted_date' => $job['posted_date'],
                'deadline' => $job['deadline']
            ];
            echo json_encode(['success' => true, 'job' => $formattedJob]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Job not found']);
        }
        break;
        
    case 'get_locations':
        $locations = getJobLocations();
        echo json_encode(['success' => true, 'locations' => $locations]);
        break;
        
    case 'get_count':
        $filters = [
            'location' => isset($_GET['location']) ? $_GET['location'] : '',
            'category' => isset($_GET['category']) ? $_GET['category'] : '',
            'experience_level' => isset($_GET['experience']) ? $_GET['experience'] : '',
            'job_type' => isset($_GET['job_type']) ? $_GET['job_type'] : '',
            'search' => isset($_GET['search']) ? $_GET['search'] : ''
        ];
        $count = getJobCount($filters);
        echo json_encode(['success' => true, 'count' => $count]);
        break;
        
    default:
        echo json_encode(['success' => false, 'error' => 'Invalid action']);
        break;
}

function formatSalary($min, $max) {
    if ($min && $max) {
        return '৳' . number_format($min, 0) . ' - ৳' . number_format($max, 0);
    } elseif ($min) {
        return '৳' . number_format($min, 0) . '+';
    } elseif ($max) {
        return 'Up to ৳' . number_format($max, 0);
    }
    return 'Competitive';
}

function parseRequirements($requirements) {
    if (empty($requirements)) {
        return [];
    }
    // Split by newline or bullet points
    $reqs = preg_split('/\n|•|\r\n/', $requirements);
    $reqs = array_map('trim', $reqs);
    $reqs = array_filter($reqs, function($req) {
        return !empty($req);
    });
    return array_values($reqs);
}
?>

