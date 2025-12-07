// Sample job data (in a real application, this would come from a server)
const jobs = [
    {
        id: 1,
        title: "Senior Software Developer",
        company: "Tech Solutions Inc.",
        location: "Dhaka",
        category: "it",
        experience: "senior",
        jobType: "full-time",
        salary: "$80,000 - $120,000",
        description: "We are looking for a talented senior software developer to join our innovative team. You will be responsible for developing and maintaining our cutting-edge software products, working with modern technologies, and leading junior developers.",
        requirements: [
            "5+ years of experience in software development",
            "Proficient in JavaScript, Python, and React",
            "Experience with cloud platforms (AWS, Azure)",
            "Strong problem-solving and leadership skills",
            "Excellent communication abilities"
        ]
    },
    {
        id: 2,
        title: "Marketing Manager",
        company: "Marketing Pro",
        location: "Chittagong",
        category: "marketing",
        experience: "senior",
        jobType: "full-time",
        salary: "$60,000 - $90,000",
        description: "We need an experienced marketing manager to lead our marketing team and develop effective marketing strategies. You will oversee all marketing campaigns, manage the marketing budget, and work closely with the sales team.",
        requirements: [
            "5+ years of marketing experience",
            "Team management experience",
            "Strong communication skills",
            "Digital marketing expertise",
            "Analytics and data-driven decision making"
        ]
    },
    {
        id: 3,
        title: "Junior Accountant",
        company: "Finance Corp",
        location: "Sylhet",
        category: "finance",
        experience: "entry",
        jobType: "full-time",
        salary: "$35,000 - $50,000",
        description: "Entry-level position for an accountant to assist with financial reporting and analysis. Perfect opportunity for recent graduates to start their career in finance.",
        requirements: [
            "Bachelor's degree in Accounting",
            "Basic accounting knowledge",
            "Attention to detail",
            "Good communication skills",
            "Proficiency in Excel and accounting software"
        ]
    },
    {
        id: 4,
        title: "Frontend Developer",
        company: "Digital Innovations",
        location: "Dhaka",
        category: "it",
        experience: "mid",
        jobType: "remote",
        salary: "$50,000 - $75,000",
        description: "Join our creative team as a frontend developer. You'll work on building beautiful, responsive web applications using modern frameworks and best practices.",
        requirements: [
            "3+ years of frontend development experience",
            "Expert in React, Vue, or Angular",
            "Strong CSS and JavaScript skills",
            "Experience with responsive design",
            "Portfolio of previous work"
        ]
    },
    {
        id: 5,
        title: "UX/UI Designer",
        company: "Creative Studio",
        location: "Dhaka",
        category: "design",
        experience: "mid",
        jobType: "full-time",
        salary: "$45,000 - $70,000",
        description: "We're seeking a talented UX/UI designer to create intuitive and beautiful user experiences. You'll work closely with developers and product managers to bring designs to life.",
        requirements: [
            "3+ years of UX/UI design experience",
            "Proficiency in Figma, Sketch, or Adobe XD",
            "Strong portfolio showcasing design skills",
            "Understanding of user-centered design principles",
            "Experience with design systems"
        ]
    },
    {
        id: 6,
        title: "Data Scientist",
        company: "Analytics Pro",
        location: "Dhaka",
        category: "it",
        experience: "senior",
        jobType: "full-time",
        salary: "$90,000 - $130,000",
        description: "Lead our data science initiatives and help drive data-driven decisions. You'll work with large datasets, build predictive models, and collaborate with cross-functional teams.",
        requirements: [
            "5+ years of data science experience",
            "Expert in Python, R, and SQL",
            "Experience with machine learning frameworks",
            "Strong statistical analysis skills",
            "PhD or Master's in Data Science preferred"
        ]
    },
    {
        id: 7,
        title: "HR Specialist",
        company: "People First",
        location: "Chittagong",
        category: "hr",
        experience: "mid",
        jobType: "full-time",
        salary: "$40,000 - $60,000",
        description: "Join our HR team to help manage recruitment, employee relations, and organizational development. You'll play a key role in building our company culture.",
        requirements: [
            "3+ years of HR experience",
            "Strong interpersonal skills",
            "Knowledge of employment law",
            "Experience with HRIS systems",
            "Excellent organizational abilities"
        ]
    },
    {
        id: 8,
        title: "Sales Representative",
        company: "Growth Solutions",
        location: "Sylhet",
        category: "marketing",
        experience: "entry",
        jobType: "full-time",
        salary: "$30,000 - $45,000 + Commission",
        description: "Start your sales career with us! We're looking for motivated individuals to join our sales team and help grow our customer base.",
        requirements: [
            "Bachelor's degree preferred",
            "Strong communication skills",
            "Self-motivated and goal-oriented",
            "Ability to work in a team",
            "Willingness to learn and adapt"
        ]
    }
];

// Saved jobs storage
let savedJobs = JSON.parse(localStorage.getItem('savedJobs')) || [];
let currentView = 'grid';

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

// Display jobs
function displayJobs(jobsToShow = jobs) {
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
    
    jobsToShow.forEach(job => {
        const isSaved = savedJobs.includes(job.id);
        const jobCard = document.createElement('div');
        jobCard.className = 'job-card';
        jobCard.innerHTML = `
            <div class="job-card-header">
                <div class="job-card-title-section">
                    <h3 class="job-card-title">${job.title}</h3>
                    <div class="job-card-company">
                        <i class="fas fa-building"></i>
                        <span>${job.company}</span>
                    </div>
                    <div class="job-card-badges">
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
                    </div>
                </div>
                <button class="job-card-save ${isSaved ? 'saved' : ''}" onclick="event.stopPropagation(); saveJob(${job.id})" title="${isSaved ? 'Unsave Job' : 'Save Job'}">
                    <i class="fas fa-bookmark"></i>
                </button>
            </div>
            <p class="job-card-description">${job.description}</p>
            <div class="job-card-footer">
                <div class="job-card-salary">${job.salary || 'Competitive'}</div>
                <div class="job-card-actions">
                    <button class="btn-apply" onclick="event.stopPropagation(); applyForJob(${job.id})">
                        <i class="fas fa-paper-plane"></i>
                        <span>Apply Now</span>
                    </button>
                </div>
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

    // Show confirmation
    if (confirm(`Are you sure you want to apply for "${job.title}" at ${job.company}?`)) {
        alert(`Application submitted successfully for ${job.title} at ${job.company}!`);
    }
}

// Show job details
function showJobDetails(jobId) {
    const job = jobs.find(j => j.id === jobId);
    if (!job || !jobDetailsModal) return;

    const isSaved = savedJobs.includes(jobId);
    
    jobTitle.textContent = job.title;
    jobCompany.innerHTML = `<i class="fas fa-building"></i> ${job.company}`;
    
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
        </div>
        <h3>Job Description</h3>
        <p>${job.description}</p>
        <h3>Requirements</h3>
        <ul>
            ${job.requirements.map(req => `<li>${req}</li>`).join('')}
        </ul>
    `;

    // Update save button
    saveJobBtn.innerHTML = isSaved 
        ? '<i class="fas fa-bookmark"></i><span>Saved</span>'
        : '<i class="far fa-bookmark"></i><span>Save Job</span>';
    saveJobBtn.className = isSaved ? 'btn-secondary saved' : 'btn-secondary';
    saveJobBtn.onclick = () => {
        saveJob(jobId);
        const newIsSaved = savedJobs.includes(jobId);
        saveJobBtn.innerHTML = newIsSaved 
            ? '<i class="fas fa-bookmark"></i><span>Saved</span>'
            : '<i class="far fa-bookmark"></i><span>Save Job</span>';
        saveJobBtn.className = newIsSaved ? 'btn-secondary saved' : 'btn-secondary';
    };
    
    applyJobBtn.onclick = () => applyForJob(jobId);
    
    jobDetailsModal.style.display = 'block';
    document.body.style.overflow = 'hidden';
}

// Save job
function saveJob(jobId) {
    if (savedJobs.includes(jobId)) {
        savedJobs = savedJobs.filter(id => id !== jobId);
    } else {
        savedJobs.push(jobId);
    }
    localStorage.setItem('savedJobs', JSON.stringify(savedJobs));
    
    // Refresh display
    filterJobs();
}

// Filter jobs
function filterJobs() {
    const search = searchInput ? searchInput.value.toLowerCase() : '';
    const locationSearch = locationInput ? locationInput.value.toLowerCase() : '';
    const location = locationFilter ? locationFilter.value : '';
    const category = categoryFilter ? categoryFilter.value : '';
    const experience = experienceFilter ? experienceFilter.value : '';
    const jobType = jobTypeFilter ? jobTypeFilter.value : '';

    const filteredJobs = jobs.filter(job => {
        const matchesSearch = !search || 
            job.title.toLowerCase().includes(search) ||
            job.company.toLowerCase().includes(search) ||
            job.description.toLowerCase().includes(search);
        
        const matchesLocationSearch = !locationSearch || 
            job.location.toLowerCase().includes(locationSearch);
        
        const matchesLocation = !location || job.location.toLowerCase() === location;
        const matchesCategory = !category || job.category === category;
        const matchesExperience = !experience || job.experience === experience;
        const matchesJobType = !jobType || (job.jobType && job.jobType === jobType);

        return matchesSearch && matchesLocationSearch && matchesLocation && matchesCategory && matchesExperience && matchesJobType;
    });

    displayJobs(filteredJobs);
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
    
    // Initial display
    displayJobs();
});
