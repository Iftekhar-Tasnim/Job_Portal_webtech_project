<?php
    session_start();
    if(isset($_SESSION['status'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Upload - Job Portal</title>
    <link rel="stylesheet" href="../assets/css/resume.css">
</head>
<body>
    <header>
       
    </header>

    <main>
        <section id="progressSection">
            <h3>Profile Completeness</h3>
            <progress id="progressBar" value="0" max="100"></progress>
            <p id="progressText">0% Complete</p>
            <p>Complete your profile to improve your visibility!</p>
        </section>

        <section id="builderSection">
            <h3>Resume Builder</h3>
            <form id="resumeForm">
                <p>
                    <label for="fullName">Full Name</label>
                    <input type="text" id="fullName" placeholder="John Doe" required>
                    <span id="fullNameError" class="error"></span>
                </p>
                <p>
                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="john.doe@example.com" required>
                    <span id="emailError" class="error"></span>
                </p>
                <p>
                    <label for="experience">Work Experience</label>
                    <textarea id="experience" rows="4" placeholder="Describe your work experience..."></textarea>
                    <span id="experienceError" class="error"></span>
                </p>
                <p>
                    <label for="education">Education</label>
                    <textarea id="education" rows="4" placeholder="List your education..."></textarea>
                    <span id="educationError" class="error"></span>
                </p>
                <button type="submit">Save Resume</button>
            </form>
        </section>

        <section id="uploaderSection">
            <h3>Upload Existing Resume</h3>
            <p id="dropZone">Drag and drop your resume (PDF/DOC) here or click to upload</p>
            <input type="file" id="resumeFile" accept=".pdf,.doc,.docx">
            <p id="uploadStatus"></p>
        </section>
    </main>

    <footer>
        <p>© 2025 Job Portal. All rights reserved.</p>
        <p>
            <a href="#">About</a>
            <a href="#">Contact</a>
            <a href="#">Privacy Policy</a>
        </p>
    </footer>

    <script src="../assets/js/resume.js"></script>
</body>
</html>
<?php
    }else{
        header('location: login.php');
    }

?>