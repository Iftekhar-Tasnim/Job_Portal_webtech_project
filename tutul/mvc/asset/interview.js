
let selectedDateTime = null;

// Show specific screen
function showScreen(screenId) {
    document.querySelectorAll('section').forEach(screen => {
        screen.classList.remove('active');
    });
    document.getElementById(screenId).classList.add('active');
}

// Sync calendar (mock function)
function syncCalendar() {
    alert("Calendar synced successfully!");
    showScreen('availability');
}

// Book the interview
function bookInterview() {
    const dateInput = document.getElementById('date-input').value;
    const timeInput = document.getElementById('time-input').value;
    const errorMessage = document.getElementById('error-message');

    if (!dateInput || !timeInput) {
        errorMessage.style.display = 'block';
        return;
    }

    errorMessage.style.display = 'none';
    selectedDateTime = `${dateInput}T${timeInput}`;
    const dateTime = new Date(selectedDateTime);

    // Validate date is not in the past
    const now = new Date();
    if (dateTime < now) {
        errorMessage.textContent = "Please select a future date and time.";
        errorMessage.style.display = 'block';
        return;
    }

    document.getElementById('confirmation-details').textContent = 
        `Your interview is scheduled for ${dateTime.toLocaleString()}.`;
    showScreen('confirmation');
    sendCalendarInvite();
}

// Send calendar invite (mock function)
function sendCalendarInvite() {
    console.log(`Calendar invite sent for ${selectedDateTime}`);
}

// Start over
function startOver() {
    selectedDateTime = null;
    document.getElementById('date-input').value = '';
    document.getElementById('time-input').value = '';
    document.getElementById('error-message').style.display = 'none';
    showScreen('calendar-sync');
}