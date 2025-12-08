// Jobs data - loaded from database
let jobs = [];
let savedJobs = []; // Will be loaded from database
let currentView = 'grid';
const API_URL = typeof JOBS_API_URL !== 'undefined' ? JOBS_API_URL : '../controller/jobs_controller.php';
const JOB_ACTIONS_URL = '../controller/job_actions_controller.php';

// DOM Elements
const jobList = document.getElementById('jobList');
const searchInput = document.getElementById('searchInput');
const locationInput = document.getElementById('locationInput');
const locationFilter = document.getElementById('locationFilter');
const categoryFilter = document.getElementById('categoryFilter');
const experienceFilter = document.getElementById('experienceFilter');
const jobTypeFilter = document.getElementById('jobTypeFilter');
const jobDetailsModal = document.getElementById('jobDetailsModal');
const jobTitle = document.getElementById('jobTitle');
const jobCompany = document.getElementById('jobCompany');
const jobDetails = document.getElementById('jobDetails');
const saveJobBtn = document.getElementById('saveJobBtn');
const applyJobBtn = document.getElementById('applyJobBtn');
const resultsCount = document.getElementById('resultsCount');
const emptyState = document.getElementById('emptyState');

// Fetch jobs from database
async function fetchJobs(filters = {}) {
    try {
        const params = new URLSearchParams();
        if (filters.location) params.append('location', filters.location);
        if (filters.category) params.append('category', filters.category);
        if (filters.experience) params.append('experience', filters.experience);
        if (filters.job_type) params.append('job_type', filters.job_type);
        if (filters.search) params.append('search', filters.search);
        
        params.append('action', 'get_jobs');
        
        const response = await fetch(`${API_URL}?${params.toString()}`);
        const data = await response.json();
        
        if (data.success) {
            jobs = data.jobs;
            return jobs;
        } else {
            console.error('Error fetching jobs:', data.error);
            return [];
        }
    } catch (error) {
        console.error('Error fetching jobs:', error);
        if (typeof showError === 'function') {
            showError('Failed to load jobs. Please refresh the page.');
        }
        return [];
    }
}

// Display jobs
async function displayJobs(jobsToShow = jobs) {
    if (!jobList) return;
    
    jobList.innerHTML = '';
    
    // Update results count
    if (resultsCount) {
        const count = jobsToShow.length;
        resultsCount.textContent = count === 0 ? 'No Jobs Found' : `${count} Job${count !== 1 ? 's' : ''} Found`;
    }
    
    // Show/hide empty state
    if (emptyState) {
        emptyState.style.display = jobsToShow.length === 0 ? 'block' : 'none';
    }
    
    if (jobsToShow.length === 0) {
        return;
    }
    
    const isLoggedIn = document.body.dataset.loggedIn === 'true';
    const userType = document.body.dataset.userType || '';
    
    // Check applied status for all jobs in parallel
    const appliedChecks = {};
    if (isLoggedIn && userType === 'applicant') {
        const checkPromises = jobsToShow.map(async (job) => {
            try {
                const response = await fetch(`${JOB_ACTIONS_URL}?action=check_applied&job_id=${job.id}`);
                const data = await response.json();
                return { jobId: job.id, applied: data.success && data.applied };
            } catch (error) {
                console.error(`Error checking application status for job ${job.id}:`, error);
                return { jobId: job.id, applied: false };
            }
        });
        
        const results = await Promise.all(checkPromises);
        results.forEach(result => {
            appliedChecks[result.jobId] = result.applied;
        });
    }
    
    jobsToShow.forEach((job) => {
        const isSaved = savedJobs.includes(job.id);
        const isApplied = appliedChecks[job.id] || false;
        
        const jobCard = document.createElement('div');
        jobCard.className = 'job-card';
        jobCard.innerHTML = `
            <div class="job-card-header">
                <div class="job-card-title-section">
                    <h3 class="job-card-title">${escapeHtml(job.title)}</h3>
                    <div class="job-card-company">
                        <i class="fas fa-building"></i>
                        <span>${escapeHtml(job.company)}</span>
                    </div>
                    <div class="job-card-badges">
                        <span class="job-badge location">
                            <i class="fas fa-map-marker-alt"></i>
                            ${escapeHtml(job.location)}
                        </span>
                        <span class="job-badge category">
                            <i class="fas fa-briefcase"></i>
                            ${getCategoryName(job.category)}
                        </span>
                        <span class="job-badge experience">
                            <i class="fas fa-user-graduate"></i>
                            ${getExperienceLevel(job.experience)}
                        </span>
                        ${job.jobType ? `<span class="job-badge">
                            <i class="fas fa-clock"></i>
                            ${job.jobType.charAt(0).toUpperCase() + job.jobType.slice(1).replace('-', ' ')}
                        </span>` : ''}
                        ${isApplied ? `<span class="job-badge" style="background: #d1fae5; color: #065f46;">
                            <i class="fas fa-check-circle"></i>
                            Applied
                        </span>` : ''}
                    </div>
                </div>
                <button class="job-card-save ${isSaved ? 'saved' : ''}" onclick="event.stopPropagation(); saveJob(${job.id})" title="${isSaved ? 'Unsave Job' : 'Save Job'}">
                    <i class="fas fa-bookmark"></i>
                </button>
            </div>
            <p class="job-card-description">${escapeHtml(job.description || '').substring(0, 150)}${job.description && job.description.length > 150 ? '...' : ''}</p>
            <div class="job-card-footer">
                <div class="job-card-salary">${job.salary || 'Competitive'}</div>
                <div class="job-card-actions">
                    ${isApplied ? `
                        <button class="btn-apply" style="background: #10b981; cursor: default;" disabled>
                            <i class="fas fa-check"></i>
                            <span>Applied</span>
                        </button>
                    ` : `
                        <button class="btn-apply" onclick="event.stopPropagation(); applyForJob(${job.id})">
                            <i class="fas fa-paper-plane"></i>
                            <span>Apply Now</span>
                        </button>
                    `}
                </div>
            </div>
        `;
        
        jobCard.addEventListener('click', () => showJobDetails(job.id));
        jobList.appendChild(jobCard);
    });
}

// Apply for job
async function applyForJob(jobId) {
    const job = jobs.find(j => j.id === jobId);
    if (!job) {
        if (typeof showError === 'function') {
            showError('Job not found');
        } else {
            alert('Job not found');
        }
        return;
    }

    // Check if user is logged in
    const isLoggedIn = document.body.dataset.loggedIn === 'true';
    const userType = document.body.dataset.userType || '';
    
    if (!isLoggedIn || userType !== 'applicant') {
        if (confirm(`You need to login as an applicant to apply for this job. Go to login page?`)) {
            window.location.href = 'login.php';
        }
        return;
    }

    // Confirm application
    if (!confirm(`Are you sure you want to apply for "${job.title}" at ${job.company}?`)) {
        return;
    }

    // Optional: Ask for cover letter
    const coverLetter = prompt('Optional: Add a cover letter (or leave blank):', '');
    
    try {
        const formData = new FormData();
        formData.append('action', 'apply_job');
        formData.append('job_id', jobId);
        if (coverLetter) {
            formData.append('cover_letter', coverLetter);
        }
        
        const response = await fetch(JOB_ACTIONS_URL, {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            if (typeof showSuccess === 'function') {
                showSuccess(`Application submitted successfully for ${job.title} at ${job.company}!`);
            } else {
                alert(`Application submitted successfully for ${job.title} at ${job.company}!`);
            }
            // Refresh display to show "Applied" status
            await displayJobs();
            // Close modal if open
            if (jobDetailsModal && jobDetailsModal.style.display === 'block') {
                jobDetailsModal.style.display = 'none';
                document.body.style.overflow = '';
            }
        } else {
            if (typeof showError === 'function') {
                showError(data.error || 'Failed to submit application');
            } else {
                alert(data.error || 'Failed to submit application');
            }
        }
    } catch (error) {
        console.error('Error applying for job:', error);
        if (typeof showError === 'function') {
            showError('An error occurred. Please try again.');
        } else {
            alert('An error occurred. Please try again.');
        }
    }
}

// Show job details
async function showJobDetails(jobId) {
    if (!jobDetailsModal) return;
    
    // Find job in current jobs array, or fetch from API
    let job = jobs.find(j => j.id === jobId);
    
    if (!job) {
        // Fetch job details from API
        try {
            const response = await fetch(`${API_URL}?action=get_job&job_id=${jobId}`);
            const data = await response.json();
            if (data.success) {
                job = data.job;
            } else {
                if (typeof showError === 'function') {
                    showError('Job not found');
                } else {
                    alert('Job not found');
                }
                return;
            }
        } catch (error) {
            console.error('Error fetching job details:', error);
            if (typeof showError === 'function') {
                showError('Failed to load job details');
            } else {
                alert('Failed to load job details');
            }
            return;
        }
    }

    const isSaved = savedJobs.includes(jobId);
    
    // Check if already applied
    let isApplied = false;
    const isLoggedIn = document.body.dataset.loggedIn === 'true';
    const userType = document.body.dataset.userType || '';
    if (isLoggedIn && userType === 'applicant') {
        try {
            const response = await fetch(`${JOB_ACTIONS_URL}?action=check_applied&job_id=${jobId}`);
            const data = await response.json();
            if (data.success && data.applied) {
                isApplied = true;
            }
        } catch (error) {
            console.error('Error checking application status:', error);
        }
    }
    
    jobTitle.textContent = job.title;
    jobCompany.innerHTML = `<i class="fas fa-building"></i> ${job.company}`;
    
    const requirementsList = Array.isArray(job.requirements) 
        ? job.requirements 
        : (job.requirements ? [job.requirements] : []);
    
    jobDetails.innerHTML = `
        <div class="job-details-badges" style="display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 24px;">
            <span class="job-badge location">
                <i class="fas fa-map-marker-alt"></i>
                ${job.location}
            </span>
            <span class="job-badge category">
                <i class="fas fa-briefcase"></i>
                ${getCategoryName(job.category)}
            </span>
            <span class="job-badge experience">
                <i class="fas fa-user-graduate"></i>
                ${getExperienceLevel(job.experience)}
            </span>
            ${job.jobType ? `<span class="job-badge">
                <i class="fas fa-clock"></i>
                ${job.jobType.charAt(0).toUpperCase() + job.jobType.slice(1).replace('-', ' ')}
            </span>` : ''}
            ${job.salary ? `<span class="job-badge" style="background: #dbeafe; color: #1e40af;">
                <i class="fas fa-dollar-sign"></i>
                ${job.salary}
            </span>` : ''}
            ${isApplied ? `<span class="job-badge" style="background: #d1fae5; color: #065f46;">
                <i class="fas fa-check-circle"></i>
                Applied
            </span>` : ''}
        </div>
        <h3>Job Description</h3>
        <p>${job.description || 'No description available.'}</p>
        ${requirementsList.length > 0 ? `
        <h3>Requirements</h3>
        <ul>
            ${requirementsList.map(req => `<li>${req}</li>`).join('')}
        </ul>
        ` : ''}
    `;

    // Update save button
    saveJobBtn.innerHTML = isSaved 
        ? '<i class="fas fa-bookmark"></i><span>Saved</span>'
        : '<i class="far fa-bookmark"></i><span>Save Job</span>';
    saveJobBtn.className = isSaved ? 'btn-secondary saved' : 'btn-secondary';
    saveJobBtn.onclick = () => {
        saveJob(jobId);
        // Update will happen in saveJob function
    };
    
    // Update apply button
    if (isApplied) {
        applyJobBtn.innerHTML = '<i class="fas fa-check"></i><span>Already Applied</span>';
        applyJobBtn.className = 'btn-primary';
        applyJobBtn.style.background = '#10b981';
        applyJobBtn.disabled = true;
        applyJobBtn.onclick = null;
    } else {
        applyJobBtn.innerHTML = '<i class="fas fa-paper-plane"></i><span>Apply Now</span>';
        applyJobBtn.className = 'btn-primary';
        applyJobBtn.style.background = '';
        applyJobBtn.disabled = false;
        applyJobBtn.onclick = () => applyForJob(jobId);
    }
    
    jobDetailsModal.style.display = 'block';
    document.body.style.overflow = 'hidden';
}

// Load saved jobs from database
async function loadSavedJobs() {
    const isLoggedIn = document.body.dataset.loggedIn === 'true';
    const userType = document.body.dataset.userType || '';
    
    if (!isLoggedIn || userType !== 'applicant') {
        savedJobs = [];
        return;
    }
    
    try {
        // Get all jobs and check which are saved (batch check for efficiency)
        const savedJobIds = [];
        const checkPromises = jobs.map(async (job) => {
            try {
                const response = await fetch(`${JOB_ACTIONS_URL}?action=check_saved&job_id=${job.id}`);
                const data = await response.json();
                if (data.success && data.saved) {
                    return job.id;
                }
            } catch (error) {
                console.error(`Error checking job ${job.id}:`, error);
            }
            return null;
        });
        
        const results = await Promise.all(checkPromises);
        savedJobs = results.filter(id => id !== null);
    } catch (error) {
        console.error('Error loading saved jobs:', error);
        savedJobs = [];
    }
}

// Save job
async function saveJob(jobId) {
    const isLoggedIn = document.body.dataset.loggedIn === 'true';
    const userType = document.body.dataset.userType || '';
    
    if (!isLoggedIn || userType !== 'applicant') {
        if (confirm('You need to login to save jobs. Go to login page?')) {
            window.location.href = 'login.php';
        }
        return;
    }
    
    const isSaved = savedJobs.includes(jobId);
    
    try {
        const formData = new FormData();
        formData.append('action', isSaved ? 'unsave_job' : 'save_job');
        formData.append('job_id', jobId);
        
        const response = await fetch(JOB_ACTIONS_URL, {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Update local saved jobs array
            if (isSaved) {
                savedJobs = savedJobs.filter(id => id !== jobId);
            } else {
                savedJobs.push(jobId);
            }
            
            // Refresh display
            filterJobs();
            
            // Update modal if open
            if (jobDetailsModal && jobDetailsModal.style.display === 'block') {
                const saveBtn = document.getElementById('saveJobBtn');
                if (saveBtn) {
                    const newIsSaved = savedJobs.includes(jobId);
                    saveBtn.innerHTML = newIsSaved 
                        ? '<i class="fas fa-bookmark"></i><span>Saved</span>'
                        : '<i class="far fa-bookmark"></i><span>Save Job</span>';
                    saveBtn.className = newIsSaved ? 'btn-secondary saved' : 'btn-secondary';
                }
            }
        } else {
            if (typeof showError === 'function') {
                showError(data.error || 'Failed to save job');
            } else {
                alert(data.error || 'Failed to save job');
            }
        }
    } catch (error) {
        console.error('Error saving job:', error);
        if (typeof showError === 'function') {
            showError('An error occurred. Please try again.');
        } else {
            alert('An error occurred. Please try again.');
        }
    }
}

// Filter jobs
async function filterJobs() {
    const search = searchInput ? searchInput.value.trim() : '';
    const locationSearch = locationInput ? locationInput.value.trim() : '';
    const location = locationFilter ? locationFilter.value : '';
    const category = categoryFilter ? categoryFilter.value : '';
    const experience = experienceFilter ? experienceFilter.value : '';
    const jobType = jobTypeFilter ? jobTypeFilter.value : '';

    // Build filters for API
    const filters = {};
    if (location) filters.location = location;
    if (category) filters.category = category;
    if (experience) filters.experience = experience;
    if (jobType) filters.job_type = jobType;
    if (search) filters.search = search;
    if (locationSearch) filters.location = locationSearch;

    // Fetch filtered jobs from database
    const fetchedJobs = await fetchJobs(filters);
    
    // Apply client-side filtering for location search (if needed)
    let filteredJobs = fetchedJobs;
    if (locationSearch && !location) {
        filteredJobs = fetchedJobs.filter(job => 
            job.location.toLowerCase().includes(locationSearch.toLowerCase())
        );
    }
    
    if (search && !filters.search) {
        filteredJobs = filteredJobs.filter(job => 
            job.title.toLowerCase().includes(search.toLowerCase()) ||
            job.company.toLowerCase().includes(search.toLowerCase()) ||
            job.description.toLowerCase().includes(search.toLowerCase())
        );
    }

    await displayJobs(filteredJobs);
}

// Helper functions
function getCategoryName(category) {
    const categories = {
        it: 'IT & Software',
        finance: 'Finance',
        marketing: 'Marketing',
        hr: 'Human Resources',
        design: 'Design',
        education: 'Education'
    };
    return categories[category] || category;
}

function getExperienceLevel(level) {
    const levels = {
        entry: 'Entry Level',
        mid: 'Mid Level',
        senior: 'Senior Level'
    };
    return levels[level] || level;
}

// Helper function to escape HTML
function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// View toggle
function toggleView(view) {
    currentView = view;
    if (jobList) {
        if (view === 'list') {
            jobList.classList.add('list-view');
        } else {
            jobList.classList.remove('list-view');
        }
    }
    
    // Update active button
    document.querySelectorAll('.view-btn').forEach(btn => {
        if (btn.dataset.view === view) {
            btn.classList.add('active');
        } else {
            btn.classList.remove('active');
        }
    });
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Search
    if (document.getElementById('searchBtn')) {
        document.getElementById('searchBtn').addEventListener('click', filterJobs);
    }
    if (searchInput) {
        searchInput.addEventListener('input', filterJobs);
    }
    if (locationInput) {
        locationInput.addEventListener('input', filterJobs);
    }
    
    // Filters
    if (locationFilter) {
        locationFilter.addEventListener('change', filterJobs);
    }
    if (categoryFilter) {
        categoryFilter.addEventListener('change', filterJobs);
    }
    if (experienceFilter) {
        experienceFilter.addEventListener('change', filterJobs);
    }
    if (jobTypeFilter) {
        jobTypeFilter.addEventListener('change', filterJobs);
    }
    
    // Reset filters
    const resetFiltersBtn = document.getElementById('resetFilters');
    if (resetFiltersBtn) {
        resetFiltersBtn.addEventListener('click', () => {
            if (searchInput) searchInput.value = '';
            if (locationInput) locationInput.value = '';
            if (locationFilter) locationFilter.value = '';
            if (categoryFilter) categoryFilter.value = '';
            if (experienceFilter) experienceFilter.value = '';
            if (jobTypeFilter) jobTypeFilter.value = '';
            filterJobs();
        });
    }
    
    // View toggle
    document.querySelectorAll('.view-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            toggleView(btn.dataset.view);
        });
    });
    
    // Modal close
    const closeModal = document.getElementById('closeModal');
    if (closeModal) {
        closeModal.addEventListener('click', () => {
            if (jobDetailsModal) {
                jobDetailsModal.style.display = 'none';
                document.body.style.overflow = '';
            }
        });
    }
    
    // Close modal on outside click
    if (jobDetailsModal) {
        jobDetailsModal.addEventListener('click', (e) => {
            if (e.target === jobDetailsModal) {
                jobDetailsModal.style.display = 'none';
                document.body.style.overflow = '';
            }
        });
    }
    
    // Close modal on ESC key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && jobDetailsModal && jobDetailsModal.style.display === 'block') {
            jobDetailsModal.style.display = 'none';
            document.body.style.overflow = '';
        }
    });
    
    // Initial load - fetch jobs from database
    fetchJobs().then(async () => {
        await loadSavedJobs();
        await displayJobs();
    });
});
