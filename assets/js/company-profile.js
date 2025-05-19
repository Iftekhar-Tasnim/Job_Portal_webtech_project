// Company Profile JavaScript

// Save job functionality
document.addEventListener('DOMContentLoaded', function() {
    const saveJobBtns = document.querySelectorAll('.save-job-btn');
    
    saveJobBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const jobId = this.dataset.jobId;
            
            // Toggle save state
            if (this.classList.contains('saved')) {
                this.classList.remove('saved');
                this.innerHTML = '<i class="far fa-bookmark"></i> Save Job';
            } else {
                this.classList.add('saved');
                this.innerHTML = '<i class="fas fa-bookmark"></i> Saved';
            }
            
            // Send save request to server
            saveJob(jobId, this.classList.contains('saved'));
        });
    });
});

// Function to save job
function saveJob(jobId, isSaved) {
    // TODO: Implement actual save job functionality
    // This would typically make an AJAX request to the server
    console.log(`Job ${jobId} ${isSaved ? 'saved' : 'unsaved'}`);
}

// Filter jobs functionality
function filterJobs() {
    const locationFilter = document.getElementById('locationFilter');
    const categoryFilter = document.getElementById('categoryFilter');
    const experienceFilter = document.getElementById('experienceFilter');
    const jobCards = document.querySelectorAll('.job-card');
    
    jobCards.forEach(card => {
        const jobLocation = card.querySelector('.job-location').textContent.toLowerCase();
        const jobCategory = card.querySelector('.job-category').textContent.toLowerCase();
        const jobExperience = card.querySelector('.job-experience').textContent.toLowerCase();
        
        const locationMatch = locationFilter.value === '' || jobLocation.includes(locationFilter.value.toLowerCase());
        const categoryMatch = categoryFilter.value === '' || jobCategory.includes(categoryFilter.value.toLowerCase());
        const experienceMatch = experienceFilter.value === '' || jobExperience.includes(experienceFilter.value.toLowerCase());
        
        card.style.display = locationMatch && categoryMatch && experienceMatch ? 'block' : 'none';
    });
}

// Add event listeners for filters
window.addEventListener('DOMContentLoaded', function() {
    const filters = document.querySelectorAll('#locationFilter, #categoryFilter, #experienceFilter');
    
    filters.forEach(filter => {
        filter.addEventListener('change', filterJobs);
    });
    
    // Reset filters
    const resetBtn = document.getElementById('resetFilters');
    if (resetBtn) {
        resetBtn.addEventListener('click', function() {
            filters.forEach(filter => {
                filter.value = '';
            });
            filterJobs();
        });
    }
});

// Search functionality
function searchJobs() {
    const searchInput = document.getElementById('searchInput');
    const searchBtn = document.getElementById('searchBtn');
    const jobCards = document.querySelectorAll('.job-card');
    
    if (searchBtn) {
        searchBtn.addEventListener('click', function() {
            const searchTerm = searchInput.value.toLowerCase();
            
            jobCards.forEach(card => {
                const jobTitle = card.querySelector('.job-header h3').textContent.toLowerCase();
                const jobDescription = card.querySelector('.job-description').textContent.toLowerCase();
                
                const match = jobTitle.includes(searchTerm) || jobDescription.includes(searchTerm);
                card.style.display = match ? 'block' : 'none';
            });
        });
    }
}

// Initialize search
window.addEventListener('DOMContentLoaded', searchJobs);

// Modal functionality for job details
function initializeJobDetailsModal() {
    const jobDetailsModal = document.getElementById('jobDetailsModal');
    const closeBtn = jobDetailsModal.querySelector('.close');
    const jobCards = document.querySelectorAll('.job-card');
    
    if (jobDetailsModal && closeBtn) {
        // Close modal when clicking the X
        closeBtn.onclick = function() {
            jobDetailsModal.style.display = 'none';
        }
        
        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target == jobDetailsModal) {
                jobDetailsModal.style.display = 'none';
            }
        }
        
        // Open modal when clicking job card
        jobCards.forEach(card => {
            card.addEventListener('click', function() {
                // Get job details
                const jobId = this.querySelector('.apply-btn').href.split('id=')[1];
                
                // Set modal content
                const jobTitle = this.querySelector('.job-header h3').textContent;
                const jobDetails = this.querySelector('.job-description').textContent;
                
                document.getElementById('jobTitle').textContent = jobTitle;
                document.getElementById('jobDetails').textContent = jobDetails;
                
                // Show modal
                jobDetailsModal.style.display = 'block';
            });
        });
    }
}

// Initialize modal
window.addEventListener('DOMContentLoaded', initializeJobDetailsModal);
