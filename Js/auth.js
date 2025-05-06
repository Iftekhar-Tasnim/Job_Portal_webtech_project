let isLoggedIn = false;
let currentUser = null;

// Check if user is logged in
function checkAuthStatus() {
    updateAuthUI(isLoggedIn);
}

// Update UI based on login status
function updateAuthUI(isLoggedIn) {
    const userActions = document.querySelector('.user-actions');
    if (!userActions) return;

    if (isLoggedIn) {
        // Show profile and logout with user name
        userActions.innerHTML = `
            <div class="profile-section">
                <div class="profile-icon">
                    <i class="fas fa-user-circle"></i>
                </div>
                <span class="user-name">${currentUser.name}</span>
                <a href="./profile.html" class="profile-btn">Profile</a>
                <button class="logout-btn" onclick="logout()">Logout</button>
            </div>
        `;
    } else {
        // Show login and register
        userActions.innerHTML = `
            <a href="./login.html" class="login-btn">Login</a>
            <a href="./Registration.html" class="register-btn">Register</a>
        `;
    }
}

// Handle logout
function logout() {
    isLoggedIn = false;
    updateAuthUI(false);
    window.location.href = './index.html';
}

// Initialize auth system
document.addEventListener('DOMContentLoaded', () => {
    checkAuthStatus();
    
    // Check if we're on the login page and user is already logged in
    if (isLoggedIn && window.location.pathname.includes('login.html')) {
        window.location.href = './index.html';
    }
});
