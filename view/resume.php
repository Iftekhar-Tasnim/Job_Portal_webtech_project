<?php
    session_start();
    if(isset($_COOKIE['status'])) {
?>
<?php
    } else {
        header('location: login.html');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Upload - Job Portal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #f0f0f0;
        }
        header {
            background-color: #1e40af;
            color: white;
            padding: 1rem;
        }
        header nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }
        header a {
            color: white;
            text-decoration: none;
            margin-left: 1rem;
        }
        header a:hover {
            text-decoration: underline;
        }
        main {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        section {
            background-color: white;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h2, h3 {
            margin-bottom: 1rem;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        label {
            font-weight: bold;
            margin-bottom: 0.5rem;
            display: block;
        }
        input, textarea {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        textarea {
            resize: vertical;
        }
        button {
            background-color: #1e40af;
            color: white;
            padding: 0.75rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #1e3a8a;
        }
        progress#progressBar {
            width: 100%;
            background-color: #e0e0e0;
            border-radius: 4px;
            height: 1rem;
        }
        progress#progressBar::-webkit-progress-bar {
            background-color: #e0e0e0;
            border-radius: 4px;
        }
        progress#progressBar::-webkit-progress-value {
            background-color: #1e40af;
            border-radius: 4px;
        }
        progress#progressBar::-moz-progress-bar {
            background-color: #1e40af;
            border-radius: 4px;
        }
        p#dropZone {
            border: 2px dashed #ccc;
            padding: 2rem;
            text-align: center;
            border-radius: 8px;
            cursor: pointer;
        }
        p#dropZone:hover, p#dropZone.active {
            border-color: #1e40af;
        }
        input#resumeFile {
            display: none;
        }
        footer {
            background-color: #1e40af;
            color: white;
            text-align: center;
            padding: 1rem;
        }
        footer a {
            color: white;
            text-decoration: none;
            margin: 0 0.5rem;
        }
        footer a:hover {
            text-decoration: underline;
        }
        .error {
            color: red;
            font-size: 0.9rem;
            margin-top: 0.2rem;
        }
        @media (min-width: 768px) {
            main {
                display: grid;
                grid-template-columns: 1fr 2fr;
                gap: 1.5rem;
            }
            section#uploaderSection {
                grid-column: 1 / 3;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <h1>Job Portal</h1>
            <p>
                <a href="index.html">Home</a>
                <a href="#">Jobs</a>
                <a href="#">Post a Job</a>
                <a href="#">Login</a>
            </p>
        </nav>
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

    <script src="resume.js"></script>
</body>
</html>