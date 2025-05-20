<?php
    session_start();
    if(isset($_COOKIE['status'])){

    }else{
        header(header: 'location: 1_login.php');
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interview Scheduler</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        main {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        section {
            display: none;
        }
        section.active {
            display: block;
        }
        form {
            margin: 20px 0;
            text-align: center;
        }
        label {
            margin-right: 10px;
            font-weight: bold;
        }
        input[type="date"], input[type="time"] {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin: 10px 0;
        }
        button {
            margin: 20px auto;
            padding: 10px 20px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #45a049;
        }
        p#calendar-invite {
            text-align: center;
            font-size: 18px;
            color: #4CAF50;
        }
        p.error {
            color: red;
            text-align: center;
            display: none;
        }
    </style>
</head>
<body>
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

    <script src="interview.js"></script>
</body>
</html>