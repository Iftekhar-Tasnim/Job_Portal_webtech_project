// Login Page JavaScript - Simplified Version
// Only handles tab switching, NO form interference

document.addEventListener("DOMContentLoaded", function () {
  // Tab switching functionality
  const loginOptions = document.querySelectorAll(".login-option");
  const loginPanels = document.querySelectorAll(".login-panel");

  loginOptions.forEach((option) => {
    option.addEventListener("click", function () {
      const type = this.dataset.type;

      // Remove active class from all options and panels
      loginOptions.forEach((opt) => opt.classList.remove("active"));
      loginPanels.forEach((panel) => panel.classList.remove("active"));

      // Add active class to clicked option
      this.classList.add("active");

      // Show corresponding panel
      const panelId = type + "Login";
      const panel = document.getElementById(panelId);
      if (panel) {
        panel.classList.add("active");
      }
    });
  });

  // NO form event listeners - let forms submit naturally to PHP backend
  // All validation and authentication is handled by PHP
  
  console.log("Login page JavaScript loaded - forms will submit normally");
});
