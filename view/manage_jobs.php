<?php
session_start();
if (!isset($_SESSION['status']) || !isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'employer') {
    header('Location: login.php');
    exit();
}

require_once '../model/company_model.php';
$employer_id = $_SESSION['user_id'];
$profile = getCompanyProfile($employer_id);
$companyName = isset($profile['Company_Name']) ? htmlspecialchars($profile['Company_Name']) : '';
$statusFilter = isset($_GET['status']) ? $_GET['status'] : 'all';
$jobs = getCompanyJobs($employer_id, $statusFilter);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Jobs - Employify</title>
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/company.css">
    <link rel="stylesheet" href="../assets/css/notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <main class="company-main">
        <div class="company-container">
            <div class="page-header">
                <h1><i class="fas fa-briefcase"></i> Manage Jobs</h1>
                <a href="post_job.php" class="btn-primary">
                    <i class="fas fa-plus"></i> Post New Job
                </a>
            </div>

            <div class="filter-section">
                <div class="filter-tabs">
                    <a href="?status=all" class="filter-tab <?php echo $statusFilter === 'all' ? 'active' : ''; ?>">
                        All (<?php echo count(getCompanyJobs($employer_id)); ?>)
                    </a>
                    <a href="?status=active" class="filter-tab <?php echo $statusFilter === 'active' ? 'active' : ''; ?>">
                        Active (<?php echo count(getCompanyJobs($employer_id, 'active')); ?>)
                    </a>
                    <a href="?status=draft" class="filter-tab <?php echo $statusFilter === 'draft' ? 'active' : ''; ?>">
                        Draft (<?php echo count(getCompanyJobs($employer_id, 'draft')); ?>)
                    </a>
                    <a href="?status=closed" class="filter-tab <?php echo $statusFilter === 'closed' ? 'active' : ''; ?>">
                        Closed (<?php echo count(getCompanyJobs($employer_id, 'closed')); ?>)
                    </a>
                </div>
            </div>

            <div class="jobs-list-container">
                <?php if (empty($jobs)): ?>
                    <div class="empty-state">
                        <i class="fas fa-briefcase"></i>
                        <p>No jobs found. Post your first job!</p>
                        <a href="post_job.php" class="btn-primary">Post Job</a>
                    </div>
                <?php else: ?>
                    <?php foreach ($jobs as $job): ?>
                        <div class="job-card-large" 
                             data-job-id="<?php echo $job['id']; ?>"
                             data-job-title="<?php echo htmlspecialchars($job['title']); ?>"
                             data-job-company="<?php echo htmlspecialchars($companyName); ?>"
                             data-job-description="<?php echo htmlspecialchars($job['description']); ?>"
                             data-job-location="<?php echo htmlspecialchars($job['location']); ?>"
                             data-job-category="<?php echo htmlspecialchars($job['category']); ?>"
                             data-job-experience="<?php echo htmlspecialchars($job['experience_level']); ?>"
                             data-job-type="<?php echo htmlspecialchars($job['job_type']); ?>">
                            <div class="job-card-header">
                                <div class="job-info">
                                    <h3><?php echo htmlspecialchars($job['title']); ?></h3>
                                    <p><?php echo htmlspecialchars($job['location']); ?> • <?php echo ucfirst(str_replace('-', ' ', $job['job_type'])); ?> • <?php echo ucfirst($job['experience_level']); ?></p>
                                </div>
                                <span class="status-badge <?php echo htmlspecialchars($job['status']); ?>">
                                    <?php echo ucfirst($job['status']); ?>
                                </span>
                            </div>
                            <div class="job-card-body">
                                <p class="job-description"><?php echo htmlspecialchars(substr($job['description'], 0, 150)) . '...'; ?></p>
                                <div class="job-meta">
                                    <span><i class="fas fa-users"></i> <?php echo $job['application_count']; ?> applications</span>
                                    <span><i class="fas fa-calendar"></i> Posted: <?php echo date('M j, Y', strtotime($job['posted_date'])); ?></span>
                                    <?php if ($job['deadline']): ?>
                                        <span><i class="fas fa-clock"></i> Deadline: <?php echo date('M j, Y', strtotime($job['deadline'])); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="job-card-actions">
                                <a href="post_job.php?edit=<?php echo $job['id']; ?>" class="btn-icon">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="view_applications.php?job=<?php echo $job['id']; ?>" class="btn-icon">
                                    <i class="fas fa-file-alt"></i> Applications (<?php echo $job['application_count']; ?>)
                                </a>
                                <button class="btn-icon btn-danger" onclick="deleteJob(<?php echo $job['id']; ?>)">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                                <?php if ($job['status'] === 'active'): ?>
                                    <button class="btn-icon" onclick="toggleJobStatus(<?php echo $job['id']; ?>, 'closed')">
                                        <i class="fas fa-times-circle"></i> Close
                                    </button>
                                <?php elseif ($job['status'] === 'closed'): ?>
                                    <button class="btn-icon" onclick="toggleJobStatus(<?php echo $job['id']; ?>, 'active')">
                                        <i class="fas fa-check-circle"></i> Activate
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

    <script src="../assets/js/navbar.js"></script>
    <script src="../assets/js/notification.js"></script>
    <script src="../assets/js/company.js"></script>
    <script>
        function deleteJob(jobId) {
            if (!confirm('Are you sure you want to delete this job? This action cannot be undone.')) {
                return;
            }
            
            const formData = new FormData();
            formData.append('action', 'delete_job');
            formData.append('job_id', jobId);
            
            fetch('../controller/company_controller.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (typeof showSuccess === 'function') {
                        showSuccess('Job deleted successfully');
                    } else {
                        alert('Job deleted successfully');
                    }
                    location.reload();
                } else {
                    if (typeof showError === 'function') {
                        showError(data.error || 'Failed to delete job');
                    } else {
                        alert(data.error || 'Failed to delete job');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                if (typeof showError === 'function') {
                    showError('An error occurred. Please try again.');
                } else {
                    alert('An error occurred. Please try again.');
                }
            });
        }
        
        function toggleJobStatus(jobId, newStatus) {
            const jobCard = document.querySelector(`[data-job-id="${jobId}"]`);
            if (!jobCard) {
                location.reload();
                return;
            }
            
            const formData = new FormData();
            formData.append('action', 'update_job');
            formData.append('job_id', jobId);
            formData.append('status', newStatus);
            formData.append('title', jobCard.dataset.jobTitle);
            formData.append('company', jobCard.dataset.jobCompany);
            formData.append('description', jobCard.dataset.jobDescription);
            formData.append('location', jobCard.dataset.jobLocation);
            formData.append('category', jobCard.dataset.jobCategory);
            formData.append('experience_level', jobCard.dataset.jobExperience);
            formData.append('job_type', jobCard.dataset.jobType);
            
            fetch('../controller/company_controller.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (typeof showSuccess === 'function') {
                        showSuccess('Job status updated');
                    }
                    location.reload();
                } else {
                    if (typeof showError === 'function') {
                        showError(data.error || 'Failed to update job status');
                    } else {
                        alert(data.error || 'Failed to update job status');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                if (typeof showError === 'function') {
                    showError('An error occurred. Please try again.');
                } else {
                    alert('An error occurred. Please try again.');
                }
            });
        }
    </script>
</body>
</html>

