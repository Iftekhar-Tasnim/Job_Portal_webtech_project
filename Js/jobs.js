// Sample job data (in a real application, this would come from a server)
const jobs = [
    {
        id: 1,
        title: "Software Developer",
        company: "Tech Solutions",
        location: "Dhaka",
        category: "it",
        experience: "mid",
        description: "We are looking for a talented software developer to join our team. You will be responsible for developing and maintaining our software products.",
        requirements: [
            "3+ years of experience in software development",
            "Proficient in Java and JavaScript",
            "Experience with web technologies",
            "Strong problem-solving skills"
        ]
    },
    {
        id: 2,
        title: "Marketing Manager",
        company: "Marketing Pro",
        location: "Chittagong",
        category: "marketing",
        experience: "senior",
        description: "We need an experienced marketing manager to lead our marketing team and develop effective marketing strategies.",
        requirements: [
            "5+ years of marketing experience",
            "Team management experience",
            "Strong communication skills",
            "Digital marketing expertise"
        ]
    },
    {
        id: 3,
        title: "Accountant",
        company: "Finance Corp",
        location: "Sylhet",
        category: "finance",
        experience: "entry",
        description: "Entry-level position for an accountant to assist with financial reporting and analysis.",
        requirements: [
            "Bachelor's degree in Accounting",
            "Basic accounting knowledge",
            "Attention to detail",
            "Good communication skills"
        ]
    },
    {
        id: 4,
        title: "Software Developer",
        company: "Tech Solutions",
        location: "Dhaka",
        category: "it",
        experience: "mid",
        description: "We are looking for a talented software developer to join our team. You will be responsible for developing and maintaining our software products.",
        requirements: [
            "3+ years of experience in software development",
            "Proficient in Java and JavaScript",
            "Experience with web technologies",
            "Strong problem-solving skills"
        ]
    },
    {
        id: 5,
        title: "Software Developer",
        company: "Tech Solutions",
        location: "Dhaka",
        category: "it",
        experience: "mid",
        description: "We are looking for a talented software developer to join our team. You will be responsible for developing and maintaining our software products.",
        requirements: [
            "3+ years of experience in software development",
            "Proficient in Java and JavaScript",
            "Experience with web technologies",
            "Strong problem-solving skills"
        ]
    },
    {
        id: 6,
        title: "Software Developer",
        company: "Tech Solutions",
        location: "Dhaka",
        category: "it",
        experience: "mid",
        description: "We are looking for a talented software developer to join our team. You will be responsible for developing and maintaining our software products.",
        requirements: [
            "3+ years of experience in software development",
            "Proficient in Java and JavaScript",
            "Experience with web technologies",
            "Strong problem-solving skills"
        ]
    }
];

// Saved jobs storage
let savedJobs = JSON.parse(localStorage.getItem('savedJobs')) || [];

// DOM Elements
const jobList = document.getElementById('jobList');
const searchInput = document.getElementById('searchInput');
const locationFilter = document.getElementById('locationFilter');
const categoryFilter = document.getElementById('categoryFilter');
const experienceFilter = document.getElementById('experienceFilter');
const jobDetailsModal = document.getElementById('jobDetailsModal');
const jobTitle = document.getElementById('jobTitle');
const jobDetails = document.getElementById('jobDetails');
const saveJobBtn = document.getElementById('saveJobBtn');
const closeDetailsBtn = document.getElementById('closeDetailsBtn');
const savedJobsBtn = document.getElementById('savedJobsBtn');

// Display jobs
function displayJobs(jobsToShow = jobs) {
    const jobList = document.getElementById('jobList');
    jobList.innerHTML = '';

    jobsToShow.forEach(job => {
        const jobCard = document.createElement('div');
        jobCard.className = 'job-card';
        jobCard.innerHTML = `
            <div class="job-header">
                <h3>${job.title}</h3>
                <span>${job.company}</span>
            </div>
            <div class="job-info">
                <span>${job.location}</span>
                <span>${getCategoryName(job.category)}</span>
                <span>${getExperienceLevel(job.experience)}</span>
            </div>
            <div class="job-actions">
                <button class="apply-btn" onclick="applyForJob(${job.id})">
                    Apply Now
                </button>
                <button class="save-btn" onclick="saveJob(${job.id})">
                    <i class="fas fa-bookmark"></i>
                    Save Job
                </button>
            </div>
        `;
        
        jobCard.addEventListener('click', () => showJobDetails(job.id));
        jobList.appendChild(jobCard);
    });
}

// Apply for job
function applyForJob(jobId) {
    const job = jobs.find(j => j.id === jobId);
    if (!job) return;

    // Show confirmation modal
    const modal = document.createElement('div');
    modal.className = 'apply-modal';
    modal.innerHTML = `
        <div class="modal-content">
            <h2>Apply for ${job.title}</h2>
            <p>Are you sure you want to apply for this position?</p>
            <div class="modal-actions">
                <button onclick="confirmApplication(${jobId})">Confirm</button>
                <button onclick="closeModal(this)">Cancel</button>
            </div>
        </div>
    `;
    document.body.appendChild(modal);
}

// Confirm application
function confirmApplication(jobId) {
    const job = jobs.find(j => j.id === jobId);
    if (!job) return;

    // Here you would typically make an API call to submit the application
    alert(`Application submitted for ${job.title} at ${job.company}`);
    closeModal(document.querySelector('.apply-modal'));
}

// Close modal
function closeModal(modal) {
    if (modal) {
        modal.remove();
    }
}

// Show job details
function showJobDetails(jobId) {
    const job = jobs.find(j => j.id === jobId);
    if (!job) return;

    jobTitle.textContent = job.title;
    jobDetails.innerHTML = `
        <h3>${job.company}</h3>
        <p><i class="fas fa-map-marker-alt"></i> ${job.location}</p>
        <h4>Description</h4>
        <p>${job.description}</p>
        <h4>Requirements</h4>
        <ul>
            ${job.requirements.map(req => `<li>${req}</li>`).join('')}
        </ul>
    `;

    jobDetailsModal.style.display = 'block';
    saveJobBtn.onclick = () => saveJob(jobId);
}

// Save job
function saveJob(jobId) {
    if (savedJobs.includes(jobId)) {
        savedJobs = savedJobs.filter(id => id !== jobId);
        saveJobBtn.innerHTML = '<i class="fas fa-bookmark"></i> Save Job';
    } else {
        savedJobs.push(jobId);
        saveJobBtn.innerHTML = '<i class="fas fa-check"></i> Saved';
    }
    localStorage.setItem('savedJobs', JSON.stringify(savedJobs));
}

// Filter jobs
function filterJobs() {
    const search = searchInput.value.toLowerCase();
    const location = locationFilter.value;
    const category = categoryFilter.value;
    const experience = experienceFilter.value;

    const filteredJobs = jobs.filter(job => {
        const matchesSearch = job.title.toLowerCase().includes(search) ||
                            job.company.toLowerCase().includes(search) ||
                            job.location.toLowerCase().includes(search);
        const matchesLocation = !location || job.location.toLowerCase() === location;
        const matchesCategory = !category || job.category === category;
        const matchesExperience = !experience || job.experience === experience;

        return matchesSearch && matchesLocation && matchesCategory && matchesExperience;
    });

    displayJobs(filteredJobs);
}

// Helper functions
function getCategoryName(category) {
    const categories = {
        it: 'IT',
        finance: 'Finance',
        marketing: 'Marketing'
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

// Event listeners
if (document.getElementById('searchBtn')) {
    document.getElementById('searchBtn').addEventListener('click', filterJobs);
}
if (searchInput) {
    searchInput.addEventListener('input', filterJobs);
}
if (locationFilter) {
    locationFilter.addEventListener('change', filterJobs);
}
if (categoryFilter) {
    categoryFilter.addEventListener('change', filterJobs);
}
if (experienceFilter) {
    experienceFilter.addEventListener('change', filterJobs);
}
if (closeDetailsBtn) {
    closeDetailsBtn.addEventListener('click', () => {
        jobDetailsModal.style.display = 'none';
    });
}
if (savedJobsBtn) {
    savedJobsBtn.addEventListener('click', () => {
        displayJobs(savedJobs);
    });
}

// Reset filters
const resetFiltersBtn = document.getElementById('resetFilters');
if (resetFiltersBtn) {
    resetFiltersBtn.addEventListener('click', () => {
        // Reset all filters
        if (searchInput) searchInput.value = '';
        if (locationFilter) locationFilter.value = '';
        if (categoryFilter) categoryFilter.value = '';
        if (experienceFilter) experienceFilter.value = '';
        
        // Clear saved jobs
        savedJobs = [];
        localStorage.removeItem('savedJobs');
        
        // Refresh job list
        displayJobs(jobs);
        
        // Show success message
        const message = document.createElement('div');
        message.className = 'reset-message';
        message.textContent = 'Filters reset successfully!';
        resetFiltersBtn.parentNode.appendChild(message);
        
        // Remove message after 2 seconds
        setTimeout(() => {
            message.remove();
        }, 2000);
    });
}

// Read More functionality
const readMoreButtons = document.querySelectorAll('.read-more-btn');
readMoreButtons.forEach(button => {
    button.addEventListener('click', () => {
        const post = button.closest('.post');
        post.classList.toggle('expanded');
    });
});

// Close modal
document.querySelector('.close').addEventListener('click', () => {
    jobDetailsModal.style.display = 'none';
});

window.addEventListener('click', (e) => {
    if (e.target === jobDetailsModal) {
        jobDetailsModal.style.display = 'none';
    }
});

// Initial display
displayJobs();
