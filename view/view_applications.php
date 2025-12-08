<?php
session_start();
if (!isset($_SESSION['status']) || !isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'employer') {
    header('Location: login.php');
    exit();
}

require_once '../model/company_model.php';
$employer_id = $_SESSION['user_id'];
$jobFilter = isset($_GET['job']) ? intval($_GET['job']) : null;
$statusFilter = isset($_GET['status']) ? $_GET['status'] : 'all';
$applications = getJobApplications($employer_id, $jobFilter);
$allJobs = getCompanyJobs($employer_id);

// Filter by status if needed
if ($statusFilter !== 'all') {
    $applications = array_filter($applications, function($app) use ($statusFilter) {
        return $app['status'] === $statusFilter;
    });
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Applications - Employify</title>
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
                <h1><i class="fas fa-file-alt"></i> View Applications</h1>
                <a href="company_profile.php" class="btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>

            <div class="filter-section">
                <div class="filter-controls">
                    <select id="jobFilter" onchange="filterApplications()">
                        <option value="">All Jobs</option>
                        <?php foreach ($allJobs as $job): ?>
                            <option value="<?php echo $job['id']; ?>" <?php echo $jobFilter == $job['id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($job['title']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <select id="statusFilter" onchange="filterApplications()">
                        <option value="all" <?php echo $statusFilter === 'all' ? 'selected' : ''; ?>>All Status</option>
                        <option value="applied" <?php echo $statusFilter === 'applied' ? 'selected' : ''; ?>>Applied</option>
                        <option value="review" <?php echo $statusFilter === 'review' ? 'selected' : ''; ?>>Under Review</option>
                        <option value="interview" <?php echo $statusFilter === 'interview' ? 'selected' : ''; ?>>Interview</option>
                        <option value="offer" <?php echo $statusFilter === 'offer' ? 'selected' : ''; ?>>Offer</option>
                        <option value="rejected" <?php echo $statusFilter === 'rejected' ? 'selected' : ''; ?>>Rejected</option>
                    </select>
                </div>
            </div>

            <div class="applications-list-container">
                <?php if (empty($applications)): ?>
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <p>No applications found.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($applications as $app): ?>
                        <div class="application-card-large" 
                             data-status="<?php echo htmlspecialchars($app['status']); ?>"
                             data-application-id="<?php echo $app['id']; ?>">
                            <div class="app-card-header">
                                <div class="app-info">
                                    <h3><?php echo htmlspecialchars($app['First_Name'] . ' ' . $app['Last_Name']); ?></h3>
                                    <p><?php echo htmlspecialchars($app['job_title']); ?> at <?php echo htmlspecialchars($app['company']); ?></p>
                                    <div class="app-contact">
                                        <span><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($app['Email']); ?></span>
                                        <?php if ($app['Phone']): ?>
                                            <span><i class="fas fa-phone"></i> <?php echo htmlspecialchars($app['Phone']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="app-status-control">
                                    <select class="status-select" onchange="updateApplicationStatus(<?php echo $app['id']; ?>, this.value)">
                                        <option value="applied" <?php echo $app['status'] === 'applied' ? 'selected' : ''; ?>>Applied</option>
                                        <option value="review" <?php echo $app['status'] === 'review' ? 'selected' : ''; ?>>Under Review</option>
                                        <option value="interview" <?php echo $app['status'] === 'interview' ? 'selected' : ''; ?>>Interview</option>
                                        <option value="offer" <?php echo $app['status'] === 'offer' ? 'selected' : ''; ?>>Offer</option>
                                        <option value="rejected" <?php echo $app['status'] === 'rejected' ? 'selected' : ''; ?>>Rejected</option>
                                    </select>
                                </div>
                            </div>
                            <?php if ($app['cover_letter']): ?>
                                <div class="app-cover-letter">
                                    <h4>Cover Letter:</h4>
                                    <p><?php echo nl2br(htmlspecialchars($app['cover_letter'])); ?></p>
                                </div>
                            <?php endif; ?>
                            <div class="app-card-footer">
                                <span class="app-date">Applied: <?php echo date('M j, Y', strtotime($app['applied_date'])); ?></span>
                                <div class="app-actions">
                                    <?php if ($app['resume_path']): ?>
                                        <a href="<?php echo htmlspecialchars($app['resume_path']); ?>" target="_blank" class="btn-icon">
                                            <i class="fas fa-file-pdf"></i> View Resume
                                        </a>
                                    <?php endif; ?>
                                    <a href="my_resume.php?applicant=<?php echo $app['applicant_id']; ?>" class="btn-icon" target="_blank">
                                        <i class="fas fa-user"></i> View Profile
                                    </a>
                                </div>
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
        function filterApplications() {
            const jobId = document.getElementById('jobFilter').value;
            const status = document.getElementById('statusFilter').value;
            const params = new URLSearchParams();
            if (jobId) params.append('job', jobId);
            if (status !== 'all') params.append('status', status);
            window.location.href = 'view_applications.php?' + params.toString();
        }
        
        function updateApplicationStatus(applicationId, status) {
            const formData = new FormData();
            formData.append('action', 'update_application_status');
            formData.append('application_id', applicationId);
            formData.append('status', status);
            
            fetch('../controller/company_controller.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (typeof showSuccess === 'function') {
                        showSuccess('Application status updated');
                    } else {
                        alert('Application status updated');
                    }
                    // Update badge
                    const card = document.querySelector(`[data-application-id="${applicationId}"]`);
                    if (card) {
                        card.dataset.status = status;
                    }
                } else {
                    if (typeof showError === 'function') {
                        showError(data.error || 'Failed to update status');
                    } else {
                        alert(data.error || 'Failed to update status');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
</body>
</html>

