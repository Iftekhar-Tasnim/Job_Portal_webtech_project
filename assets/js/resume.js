let profileScore = 0;
        const maxScore = 100;
        const fields = ['fullName', 'email', 'experience', 'education', 'resumeFile'];
        const weightPerField = maxScore / fields.length;

        function validateForm() {
            let isValid = true;
            const fullName = document.getElementById('fullName').value.trim();
            const email = document.getElementById('email').value.trim();
            const experience = document.getElementById('experience').value.trim();
            const education = document.getElementById('education').value.trim();

            // Reset error messages
            document.getElementById('fullNameError').textContent = '';
            document.getElementById('emailError').textContent = '';
            document.getElementById('experienceError').textContent = '';
            document.getElementById('educationError').textContent = '';

            // Validate Full Name
            if (!fullName) {
                document.getElementById('fullNameError').textContent = 'Full Name is required';
                isValid = false;
            } else if (!/^[a-zA-Z\s]{2,}$/.test(fullName)) {
                document.getElementById('fullNameError').textContent = 'Enter a valid name (letters only, at least 2 characters)';
                isValid = false;
            }

            // Validate Email
            if (!email) {
                document.getElementById('emailError').textContent = 'Email is required';
                isValid = false;
            } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                document.getElementById('emailError').textContent = 'Enter a valid email address';
                isValid = false;
            }

            // Validate Experience
            if (!experience) {
                document.getElementById('experienceError').textContent = 'Work Experience is required';
                isValid = false;
            }

            // Validate Education
            if (!education) {
                document.getElementById('educationError').textContent = 'Education is required';
                isValid = false;
            }

            return isValid;
        }

        function updateProgress() {
            profileScore = 0;
            fields.forEach(field => {
                const element = document.getElementById(field);
                if (field === 'resumeFile') {
                    if (element.files.length > 0) profileScore += weightPerField;
                } else if (element.value.trim() !== '') {
                    profileScore += weightPerField;
                }
            });
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');
            const percentage = Math.round(profileScore);
            progressBar.value = percentage;
            progressText.textContent = `${percentage}% Complete`;
        }

        const resumeForm = document.getElementById('resumeForm');
        resumeForm.addEventListener('submit', (e) => {
            e.preventDefault();
            if (validateForm()) {
                updateProgress();
                alert('Resume saved successfully!');
                resumeForm.reset();
                updateProgress();
            }
        });

        const dropZone = document.getElementById('dropZone');
        const resumeFile = document.getElementById('resumeFile');
        const uploadStatus = document.getElementById('uploadStatus');

        dropZone.addEventListener('click', () => resumeFile.click());
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('active');
        });
        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('active');
        });
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('active');
            const files = e.dataTransfer.files;
            handleFiles(files);
        });
        resumeFile.addEventListener('change', () => handleFiles(resumeFile.files));

        function handleFiles(files) {
            const file = files[0];
            if (file && ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'].includes(file.type)) {
                uploadStatus.textContent = `File selected: ${file.name}`;
                uploadStatus.style.color = 'green';
                updateProgress();
            } else {
                uploadStatus.textContent = 'Please upload a valid PDF or DOC file.';
                uploadStatus.style.color = 'red';
            }
        }

        fields.forEach(field => {
            const element = document.getElementById(field);
            element.addEventListener('input', updateProgress);
        });