
let notifications = [];
let jobs = [
    { title: "Software Engineer", company: "Tech Corp", location: "San Francisco, CA", type: "Full-Time" },
    { title: "Data Analyst", company: "Data Inc", location: "New York, NY", type: "Contract" }
];

function showScreen(screenId) {
    document.querySelectorAll('section').forEach(screen => {
        screen.classList.remove('active');
    });
    document.getElementById(screenId).classList.add('active');
}

function validateForm() {
    let isValid = true;
    const jobTitle = document.getElementById('job-title');
    const location = document.getElementById('location');
    const jobType = document.getElementById('job-type');
    const notificationMethod = document.getElementById('notification-method');

    // Reset error states
    [jobTitle, location, jobType, notificationMethod].forEach(field => {
        field.classList.remove('invalid');
        document.getElementById(`${field.id}-error`).classList.remove('active');
    });

    // Validate job title
    if (!jobTitle.value.trim()) {
        jobTitle.classList.add('invalid');
        document.getElementById('job-title-error').classList.add('active');
        isValid = false;
    }

    // Validate location
    if (!location.value.trim()) {
        location.classList.add('invalid');
        document.getElementById('location-error').classList.add('active');
        isValid = false;
    }

    // Validate job type
    if (!jobType.value) {
        jobType.classList.add('invalid');
        document.getElementById('job-type-error').classList.add('active');
        isValid = false;
    }

    // Notification method is pre-selected, so no validation needed
    // but included in case future changes require it
    if (!notificationMethod.value) {
        notificationMethod.classList.add('invalid');
        document.getElementById('notification-method-error').classList.add('active');
        isValid = false;
    }

    return isValid;
}

document.getElementById('preferences-form').addEventListener('submit', (e) => {
    e.preventDefault();

    if (!validateForm()) {
        return;
    }

    const jobTitle = document.getElementById('job-title').value;
    const location = document.getElementById('location').value;
    const jobType = document.getElementById('job-type').value;
    const notificationMethod = document.getElementById('notification-method').value;

    const notification = `New job alert set for ${jobTitle} in ${location} (${jobType}) via ${notificationMethod}`;
    notifications.push(notification);
    updateNotifications();

    updateRecommendedJobs({ jobTitle, location, jobType });

    alert('Preferences saved!');

    // Reset form
    document.getElementById('preferences-form').reset();
});

function updateNotifications() {
    const notificationsArticle = document.getElementById('notifications');
    notificationsArticle.innerHTML = notifications.length ? 
        notifications.map(n => `<p>${n}</p>`).join('') :
        '<p>No notifications yet.</p>';
}

function updateRecommendedJobs(preferences) {
    const jobsArticle = document.getElementById('jobs');
    const filteredJobs = jobs.filter(job => {
        return (!preferences.jobTitle || job.title.toLowerCase().includes(preferences.jobTitle.toLowerCase())) &&
               (!preferences.location || job.location.toLowerCase().includes(preferences.location.toLowerCase())) &&
               (!preferences.jobType || job.type === preferences.jobType);
    });
    jobsArticle.innerHTML = filteredJobs.length ? 
        filteredJobs.map(job => `
            <p><strong>${job.title}</strong></p>
            <p>Company: ${job.company}</p>
            <p>Location: ${job.location}</p>
            <p>Type: ${job.type}</p>
        `).join('') :
        '<p>No matching jobs found.</p>';
}

updateNotifications();
updateRecommendedJobs({});
