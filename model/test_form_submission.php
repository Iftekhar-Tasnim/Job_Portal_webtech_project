<?php
/**
 * Test Form Submission
 * This helps debug if the form is actually submitting
 * URL: http://localhost/job/model/test_form_submission.php
 */

echo "<!DOCTYPE html>
<html>
<head>
    <title>Test Form Submission</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; }
        .info { padding: 15px; background: #d1ecf1; border: 2px solid #17a2b8; margin: 10px 0; }
        form { background: #f8f9fa; padding: 20px; border-radius: 5px; }
        input, button { width: 100%; padding: 10px; margin: 10px 0; }
        button { background: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
    <h1>Test Employer Form Submission</h1>
    
    <div class='info'>
        <p>This form submits to the same controller as the login page.</p>
        <p>After submitting, check if you get redirected or see any errors.</p>
    </div>
    
    <form id='testEmployerForm' action='../controller/logincheck.php' method='POST'>
        <input type='hidden' name='user_type' value='employer'>
        <label>Email:</label>
        <input type='email' name='email' value='employer1@employify.com' required>
        <label>Password:</label>
        <input type='password' name='password' value='employer123' required>
        <button type='submit' name='submit'>Test Login</button>
    </form>
    
    <div class='info'>
        <h3>What to check:</h3>
        <ul>
            <li>Does the form submit? (Page should change)</li>
            <li>Do you get redirected to home.php?</li>
            <li>Do you see any error messages?</li>
            <li>Check browser console (F12) for JavaScript errors</li>
            <li>Check network tab to see if request is sent</li>
        </ul>
    </div>
    
    <script>
        document.getElementById('testEmployerForm').addEventListener('submit', function(e) {
            console.log('Form is submitting...');
            console.log('Email:', this.querySelector('[name=email]').value);
            console.log('Password:', this.querySelector('[name=password]').value);
            console.log('User Type:', this.querySelector('[name=user_type]').value);
            // Let it submit normally
        });
    </script>
</body>
</html>";
?>

