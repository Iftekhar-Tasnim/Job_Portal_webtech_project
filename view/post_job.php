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

// Get job data if editing
$job = null;
$jobId = isset($_GET['edit']) ? intval($_GET['edit']) : 0;
if ($jobId > 0) {
    $job = getJobById($jobId, $employer_id);
    if (!$job) {
        header('Location: manage_jobs.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $job ? 'Edit Job' : 'Post New Job'; ?> - Employify</title>
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
                <h1><i class="fas fa-briefcase"></i> <?php echo $job ? 'Edit Job' : 'Post New Job'; ?></h1>
                <a href="manage_jobs.php" class="btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Jobs
                </a>
            </div>

            <div class="form-container">
                <form id="jobForm" class="job-form">
                    <?php if ($job): ?>
                        <input type="hidden" name="job_id" value="<?php echo $job['id']; ?>">
                    <?php endif; ?>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="title"><i class="fas fa-heading"></i> Job Title *</label>
                            <input type="text" id="title" name="title" value="<?php echo $job ? htmlspecialchars($job['title']) : ''; ?>" required placeholder="e.g., Software Developer">
                        </div>
                        <div class="form-group">
                            <label for="company"><i class="fas fa-building"></i> Company Name *</label>
                            <input type="text" id="company" name="company" value="<?php echo $job ? htmlspecialchars($job['company']) : $companyName; ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="location"><i class="fas fa-map-marker-alt"></i> Location *</label>
                            <input type="text" id="location" name="location" value="<?php echo $job ? htmlspecialchars($job['location']) : ''; ?>" required placeholder="e.g., Dhaka, Bangladesh">
                        </div>
                        <div class="form-group">
                            <label for="category"><i class="fas fa-tag"></i> Category *</label>
                            <select id="category" name="category" required>
                                <option value="">Select Category</option>
                                <option value="it" <?php echo ($job && $job['category'] === 'it') ? 'selected' : ''; ?>>IT & Software</option>
                                <option value="marketing" <?php echo ($job && $job['category'] === 'marketing') ? 'selected' : ''; ?>>Marketing</option>
                                <option value="finance" <?php echo ($job && $job['category'] === 'finance') ? 'selected' : ''; ?>>Finance</option>
                                <option value="hr" <?php echo ($job && $job['category'] === 'hr') ? 'selected' : ''; ?>>Human Resources</option>
                                <option value="sales" <?php echo ($job && $job['category'] === 'sales') ? 'selected' : ''; ?>>Sales</option>
                                <option value="design" <?php echo ($job && $job['category'] === 'design') ? 'selected' : ''; ?>>Design</option>
                                <option value="other" <?php echo ($job && $job['category'] === 'other') ? 'selected' : ''; ?>>Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="job_type"><i class="fas fa-clock"></i> Job Type *</label>
                            <select id="job_type" name="job_type" required>
                                <option value="full-time" <?php echo ($job && $job['job_type'] === 'full-time') ? 'selected' : ''; ?>>Full-Time</option>
                                <option value="part-time" <?php echo ($job && $job['job_type'] === 'part-time') ? 'selected' : ''; ?>>Part-Time</option>
                                <option value="contract" <?php echo ($job && $job['job_type'] === 'contract') ? 'selected' : ''; ?>>Contract</option>
                                <option value="internship" <?php echo ($job && $job['job_type'] === 'internship') ? 'selected' : ''; ?>>Internship</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="experience_level"><i class="fas fa-user-graduate"></i> Experience Level *</label>
                            <select id="experience_level" name="experience_level" required>
                                <option value="entry" <?php echo ($job && $job['experience_level'] === 'entry') ? 'selected' : ''; ?>>Entry Level</option>
                                <option value="mid" <?php echo ($job && $job['experience_level'] === 'mid') ? 'selected' : ''; ?>>Mid Level</option>
                                <option value="senior" <?php echo ($job && $job['experience_level'] === 'senior') ? 'selected' : ''; ?>>Senior Level</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="salary_min"><i class="fas fa-dollar-sign"></i> Salary Min</label>
                            <input type="number" id="salary_min" name="salary_min" value="<?php echo $job ? $job['salary_min'] : ''; ?>" placeholder="e.g., 50000" step="0.01">
                        </div>
                        <div class="form-group">
                            <label for="salary_max"><i class="fas fa-dollar-sign"></i> Salary Max</label>
                            <input type="number" id="salary_max" name="salary_max" value="<?php echo $job ? $job['salary_max'] : ''; ?>" placeholder="e.g., 80000" step="0.01">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description"><i class="fas fa-align-left"></i> Job Description *</label>
                        <textarea id="description" name="description" rows="6" required placeholder="Describe the job responsibilities, requirements, and what you're looking for..."><?php echo $job ? htmlspecialchars($job['description']) : ''; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="requirements"><i class="fas fa-list"></i> Requirements</label>
                        <textarea id="requirements" name="requirements" rows="4" placeholder="List the required skills, qualifications, and experience..."><?php echo $job ? htmlspecialchars($job['requirements']) : ''; ?></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="deadline"><i class="fas fa-calendar"></i> Application Deadline</label>
                            <input type="date" id="deadline" name="deadline" value="<?php echo $job && $job['deadline'] ? date('Y-m-d', strtotime($job['deadline'])) : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label for="status"><i class="fas fa-toggle-on"></i> Status</label>
                            <select id="status" name="status">
                                <option value="active" <?php echo ($job && $job['status'] === 'active') ? 'selected' : ''; ?>>Active</option>
                                <option value="draft" <?php echo ($job && $job['status'] === 'draft') ? 'selected' : ''; ?>>Draft</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-save"></i> <?php echo $job ? 'Update Job' : 'Post Job'; ?>
                        </button>
                        <a href="manage_jobs.php" class="btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

    <script src="../assets/js/navbar.js"></script>
    <script src="../assets/js/notification.js"></script>
    <script src="../assets/js/company.js"></script>
    <script>
        // Job form submission
        document.getElementById('jobForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            formData.append('action', formData.has('job_id') ? 'update_job' : 'create_job');
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalHTML = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
            
            try {
                const response = await fetch('../controller/company_controller.php', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    if (typeof showSuccess === 'function') {
                        showSuccess(data.message || 'Job saved successfully!');
                    } else {
                        alert(data.message || 'Job saved successfully!');
                    }
                    setTimeout(() => {
                        window.location.href = 'manage_jobs.php';
                    }, 1500);
                } else {
                    if (typeof showError === 'function') {
                        showError(data.error || 'Failed to save job');
                    } else {
                        alert(data.error || 'Failed to save job');
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                if (typeof showError === 'function') {
                    showError('An error occurred. Please try again.');
                } else {
                    alert('An error occurred. Please try again.');
                }
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalHTML;
            }
        });
    </script>
</body>
</html>

