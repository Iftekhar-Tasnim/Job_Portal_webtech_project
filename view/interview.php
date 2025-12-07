<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interview Scheduler - Employify</title>
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/interview.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>
    
    <main>
        <h1>Interview Scheduler</h1>

        <!-- Calendar Sync Screen -->
        <section id="calendar-sync" class="active">
            <h2>Sync Your Calendar</h2>
            <p>Connect your calendar to share your availability.</p>
            <button onclick="syncCalendar()">Sync Calendar</button>
        </section>

        <!-- Availability Selector Screen -->
        <section id="availability">
            <h2>Select Your Availability</h2>
            <form>
                <label for="date-input">Date:</label>
                <input type="date" id="date-input" min="2025-05-06">
                <br>
                <label for="time-input">Time:</label>
                <input type="time" id="time-input">
            </form>
            <p id="error-message" class="error">Please select a valid date and time.</p>
            <button onclick="bookInterview()">Book Interview</button>
        </section>

        <!-- Confirmation Page -->
        <section id="confirmation">
            <h2>Booking Confirmed!</h2>
            <p id="confirmation-details"></p>
            <p id="calendar-invite">Calendar invite sent!</p>
            <button onclick="startOver()">Schedule Another Interview</button>
        </section>
    </main>

    <script src="../assets/js/navbar.js"></script>
    <script src="../assets/js/alert.js"></script>
</body>
</html>
