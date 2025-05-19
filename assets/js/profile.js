document.addEventListener('DOMContentLoaded', () => {
    initializeProfile();
    setupSidebarNavigation();
    setupProfilePictureUpload();
    setupFormSubmissions();
});

function initializeProfile() {
    const userData = getUserData();
    if (userData) {
        const { name, role, profilePic, appliedJobs, savedJobs, interviews } = userData;
        document.getElementById('userName').textContent = name;
        document.getElementById('userRole').textContent = role;
        document.getElementById('profilePic').src = profilePic || './assets/default-avatar.png';
        document.getElementById('appliedJobs').textContent = appliedJobs || 0;
        document.getElementById('savedJobs').textContent = savedJobs || 0;
        document.getElementById('interviews').textContent = interviews || 0;
    }
}

function setupSidebarNavigation() {
    const sections = document.querySelectorAll('.sidebar-section');
    const contentSections = document.querySelectorAll('.profile-section');

    sections.forEach(section => {
        section.addEventListener('click', () => {
            sections.forEach(s => s.classList.remove('active'));
            contentSections.forEach(c => c.classList.remove('active'));
            section.classList.add('active');
            const contentSection = document.getElementById(`${section.id}Content`);
            if (contentSection) contentSection.classList.add('active');
        });
    });
}

function setupProfilePictureUpload() {
    const profilePicInput = document.getElementById('profilePicInput');
    const profilePic = document.getElementById('profilePic');
    const changePhotoBtn = document.querySelector('.change-photo-btn');

    if (profilePicInput && profilePic && changePhotoBtn) {
        changePhotoBtn.addEventListener('click', () => profilePicInput.click());
        
        profilePicInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    profilePic.src = e.target.result;
                    saveUserData({ profilePic: e.target.result });
                };
                reader.readAsDataURL(file);
            }
        });
    }
}

function setupFormSubmissions() {
    const profileForm = document.querySelector('.profile-form');
    if (profileForm) {
        profileForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(profileForm);
            const userData = Object.fromEntries(formData.entries());
            try {
                await saveUserData(userData);
                showSuccessMessage('Profile updated successfully!');
            } catch (error) {
                showErrorMessage('Error updating profile');
            }
        });
    }

    const settingsForm = document.querySelector('.settings-form');
    if (settingsForm) {
        settingsForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            if (password !== confirmPassword) {
                showErrorMessage('Passwords do not match');
                return;
            }
            try {
                await updatePassword(password);
                showSuccessMessage('Password updated successfully!');
            } catch (error) {
                showErrorMessage('Error updating password');
            }
        });
    }
}

function getUserData() {
    return {
        name: 'Iftekhar Tasnim',
        role: 'Software Developer',
        appliedJobs: 12,
        savedJobs: 5,
        interviews: 3
    };
}

async function saveUserData(data) {
    console.log('Saving user data:', data);
}

async function updatePassword(password) {
    console.log('Updating password');
}

function showSuccessMessage(message) {
    const successMessage = document.createElement('div');
    successMessage.className = 'success-message';
    successMessage.textContent = message;
    const form = document.querySelector('.profile-form');
    if (form) {
        form.appendChild(successMessage);
        setTimeout(() => successMessage.remove(), 3000);
    }
}

function showErrorMessage(message) {
    const errorMessage = document.createElement('div');
    errorMessage.className = 'error-message';
    errorMessage.textContent = message;
    const form = document.querySelector('.profile-form');
    if (form) {
        form.appendChild(errorMessage);
        setTimeout(() => errorMessage.remove(), 3000);
    }
}
