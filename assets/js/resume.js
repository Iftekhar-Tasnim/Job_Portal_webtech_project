// Resume/CV Builder JavaScript - Comprehensive Version

document.addEventListener('DOMContentLoaded', function() {
    // ============================================
    // STATE MANAGEMENT
    // ============================================
    let experienceCount = 0;
    let educationCount = 0;
    let certificationCount = 0;
    
    const fields = {
        personal: ['fullName', 'email', 'phone', 'location', 'website', 'summary', 'jobTitle'],
        experience: [],
        education: [],
        certification: [],
        skills: ['skills'],
        languages: ['languages']
    };

    // ============================================
    // ELEMENTS
    // ============================================
    const resumeForm = document.getElementById('resumeForm');
    const progressBar = document.getElementById('progressFill');
    const progressPercentage = document.getElementById('progressPercentage');
    const previewSection = document.getElementById('previewSection');
    const previewContent = document.getElementById('previewContent');
    const previewBtn = document.getElementById('previewBtn');
    const closePreviewBtn = document.getElementById('closePreviewBtn');
    const exportBtn = document.getElementById('exportBtn');
    const resetBtn = document.getElementById('resetBtn');
    const dropZone = document.getElementById('dropZone');
    const resumeFile = document.getElementById('resumeFile');
    const uploadStatus = document.getElementById('uploadStatus');

    // ============================================
    // PROGRESS TRACKING
    // ============================================
    
    function updateProgress() {
        let filledFields = 0;
        let totalFields = 0;

        // Personal information
        fields.personal.forEach(field => {
            totalFields++;
            const element = document.getElementById(field);
            if (element && element.value.trim() !== '') {
                filledFields++;
            }
        });

        // Experience
        totalFields += 2; // At least one experience entry
        if (fields.experience.length > 0) {
            filledFields += 2;
        }

        // Education
        totalFields += 2; // At least one education entry
        if (fields.education.length > 0) {
            filledFields += 2;
        }

        // Skills
        totalFields++;
        const skills = document.getElementById('skills');
        if (skills && skills.value.trim() !== '') {
            filledFields++;
        }

        // Languages
        totalFields++;
        const languages = document.getElementById('languages');
        if (languages && languages.value.trim() !== '') {
            filledFields++;
        }

        // Resume file
        totalFields++;
        if (resumeFile.files.length > 0) {
            filledFields++;
        }

        const percentage = Math.round((filledFields / totalFields) * 100);
        progressBar.style.width = percentage + '%';
        progressPercentage.textContent = percentage + '%';
    }

    // ============================================
    // EXPERIENCE MANAGEMENT
    // ============================================
    
    function createExperienceItem() {
        experienceCount++;
        const id = `experience_${experienceCount}`;
        fields.experience.push(id);
        
        const item = document.createElement('div');
        item.className = 'dynamic-item';
        item.id = id;
        item.innerHTML = `
            <div class="dynamic-item-header">
                <span class="dynamic-item-title">Experience #${experienceCount}</span>
                <button type="button" class="btn-remove" onclick="removeItem('${id}', 'experience')">
                    <i class="fas fa-trash"></i> Remove
                </button>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="${id}_title">Job Title <span class="required">*</span></label>
                    <input type="text" id="${id}_title" name="${id}_title" placeholder="Software Developer" required>
                </div>
                <div class="form-group">
                    <label for="${id}_company">Company <span class="required">*</span></label>
                    <input type="text" id="${id}_company" name="${id}_company" placeholder="Tech Corp" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="${id}_start">Start Date</label>
                    <input type="month" id="${id}_start" name="${id}_start">
                </div>
                <div class="form-group">
                    <label for="${id}_end">End Date</label>
                    <input type="month" id="${id}_end" name="${id}_end">
                </div>
            </div>
            <div class="form-group">
                <label for="${id}_description">Description</label>
                <textarea id="${id}_description" name="${id}_description" rows="3" placeholder="Describe your responsibilities and achievements..."></textarea>
            </div>
        `;
        
        const container = document.getElementById('experienceContainer');
        container.appendChild(item);
        
        // Add event listeners for progress tracking
        const inputs = item.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.addEventListener('input', updateProgress);
        });
        
        updateProgress();
    }

    // ============================================
    // EDUCATION MANAGEMENT
    // ============================================
    
    function createEducationItem() {
        educationCount++;
        const id = `education_${educationCount}`;
        fields.education.push(id);
        
        const item = document.createElement('div');
        item.className = 'dynamic-item';
        item.id = id;
        item.innerHTML = `
            <div class="dynamic-item-header">
                <span class="dynamic-item-title">Education #${educationCount}</span>
                <button type="button" class="btn-remove" onclick="removeItem('${id}', 'education')">
                    <i class="fas fa-trash"></i> Remove
                </button>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="${id}_degree">Degree <span class="required">*</span></label>
                    <input type="text" id="${id}_degree" name="${id}_degree" placeholder="Bachelor of Science" required>
                </div>
                <div class="form-group">
                    <label for="${id}_school">School/University <span class="required">*</span></label>
                    <input type="text" id="${id}_school" name="${id}_school" placeholder="University Name" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="${id}_start">Start Date</label>
                    <input type="month" id="${id}_start" name="${id}_start">
                </div>
                <div class="form-group">
                    <label for="${id}_end">End Date</label>
                    <input type="month" id="${id}_end" name="${id}_end">
                </div>
            </div>
            <div class="form-group">
                <label for="${id}_description">Description</label>
                <textarea id="${id}_description" name="${id}_description" rows="2" placeholder="Additional details..."></textarea>
            </div>
        `;
        
        const container = document.getElementById('educationContainer');
        container.appendChild(item);
        
        // Add event listeners for progress tracking
        const inputs = item.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.addEventListener('input', updateProgress);
        });
        
        updateProgress();
    }

    // ============================================
    // CERTIFICATION MANAGEMENT
    // ============================================
    
    function createCertificationItem() {
        certificationCount++;
        const id = `certification_${certificationCount}`;
        fields.certification.push(id);
        
        const item = document.createElement('div');
        item.className = 'dynamic-item';
        item.id = id;
        item.innerHTML = `
            <div class="dynamic-item-header">
                <span class="dynamic-item-title">Certification #${certificationCount}</span>
                <button type="button" class="btn-remove" onclick="removeItem('${id}', 'certification')">
                    <i class="fas fa-trash"></i> Remove
                </button>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="${id}_name">Certification Name <span class="required">*</span></label>
                    <input type="text" id="${id}_name" name="${id}_name" placeholder="AWS Certified Solutions Architect" required>
                </div>
                <div class="form-group">
                    <label for="${id}_issuer">Issuing Organization</label>
                    <input type="text" id="${id}_issuer" name="${id}_issuer" placeholder="Amazon Web Services">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="${id}_date">Issue Date</label>
                    <input type="month" id="${id}_date" name="${id}_date">
                </div>
                <div class="form-group">
                    <label for="${id}_expiry">Expiry Date</label>
                    <input type="month" id="${id}_expiry" name="${id}_expiry">
                </div>
            </div>
        `;
        
        const container = document.getElementById('certificationContainer');
        container.appendChild(item);
        
        // Add event listeners for progress tracking
        const inputs = item.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('input', updateProgress);
        });
        
        updateProgress();
    }

    // ============================================
    // REMOVE ITEM FUNCTION (Global)
    // ============================================
    
    window.removeItem = function(id, type) {
        const item = document.getElementById(id);
        if (item) {
            item.remove();
            
            // Remove from fields array
            if (type === 'experience') {
                fields.experience = fields.experience.filter(f => f !== id);
            } else if (type === 'education') {
                fields.education = fields.education.filter(f => f !== id);
            } else if (type === 'certification') {
                fields.certification = fields.certification.filter(f => f !== id);
            }
            
            updateProgress();
            generatePreview();
        }
    };

    // ============================================
    // FORM VALIDATION
    // ============================================
    
    function validateForm() {
        let isValid = true;
        
        // Validate full name
        const fullName = document.getElementById('fullName');
        const fullNameError = document.getElementById('fullNameError');
        if (!fullName.value.trim()) {
            fullNameError.textContent = 'Full name is required';
            fullName.classList.add('error');
            isValid = false;
        } else {
            fullNameError.textContent = '';
            fullName.classList.remove('error');
        }
        
        // Validate email
        const email = document.getElementById('email');
        const emailError = document.getElementById('emailError');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email.value.trim()) {
            emailError.textContent = 'Email is required';
            email.classList.add('error');
            isValid = false;
        } else if (!emailRegex.test(email.value.trim())) {
            emailError.textContent = 'Please enter a valid email address';
            email.classList.add('error');
            isValid = false;
        } else {
            emailError.textContent = '';
            email.classList.remove('error');
        }
        
        // Validate website (optional, but if provided, should be valid)
        const website = document.getElementById('website');
        const websiteError = document.getElementById('websiteError');
        const websiteValue = website.value.trim();
        
        if (websiteValue) {
            // More flexible URL validation - accepts http://, https://, or just domain
            const urlRegex = /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/i;
            if (!urlRegex.test(websiteValue)) {
                websiteError.textContent = 'Please enter a valid website URL (e.g., https://example.com or example.com)';
                website.classList.add('error');
                isValid = false;
            } else {
                websiteError.textContent = '';
                website.classList.remove('error');
            }
        } else {
            websiteError.textContent = '';
            website.classList.remove('error');
        }
        
        return isValid;
    }

    // ============================================
    // PREVIEW GENERATION
    // ============================================
    
    function generatePreview() {
        const preview = document.querySelector('.cv-preview');
        if (!preview) return;
        
        let html = '';
        
        // Personal Information
        const fullName = document.getElementById('fullName').value || 'Your Name';
        const jobTitle = document.getElementById('jobTitle').value || '';
        const email = document.getElementById('email').value || '';
        const phone = document.getElementById('phone').value || '';
        const location = document.getElementById('location').value || '';
        const website = document.getElementById('website').value || '';
        const summary = document.getElementById('summary').value || '';
        
        html += `<h1>${fullName}</h1>`;
        if (jobTitle) html += `<p style="font-size: 1.125rem; color: var(--primary-color); margin-bottom: 16px;">${jobTitle}</p>`;
        
        let contactInfo = [];
        if (email) contactInfo.push(`<i class="fas fa-envelope"></i> ${email}`);
        if (phone) contactInfo.push(`<i class="fas fa-phone"></i> ${phone}`);
        if (location) contactInfo.push(`<i class="fas fa-map-marker-alt"></i> ${location}`);
        if (website) {
            // Ensure URL has protocol for proper linking
            let websiteUrl = website.trim();
            if (!websiteUrl.startsWith('http://') && !websiteUrl.startsWith('https://')) {
                websiteUrl = 'https://' + websiteUrl;
            }
            contactInfo.push(`<i class="fas fa-globe"></i> <a href="${websiteUrl}" target="_blank">${website}</a>`);
        }
        
        if (contactInfo.length > 0) {
            html += `<p style="margin-bottom: 24px;">${contactInfo.join(' | ')}</p>`;
        }
        
        if (summary) {
            html += `<h2>Professional Summary</h2><p>${summary}</p>`;
        }
        
        // Experience
        if (fields.experience.length > 0) {
            html += `<h2>Work Experience</h2>`;
            fields.experience.forEach(id => {
                const title = document.getElementById(`${id}_title`)?.value || '';
                const company = document.getElementById(`${id}_company`)?.value || '';
                const start = document.getElementById(`${id}_start`)?.value || '';
                const end = document.getElementById(`${id}_end`)?.value || '';
                const description = document.getElementById(`${id}_description`)?.value || '';
                
                if (title || company) {
                    html += `<div class="preview-item">`;
                    html += `<h3>${title}${company ? ` - ${company}` : ''}</h3>`;
                    if (start || end) {
                        html += `<p class="preview-meta">${start || 'Present'} - ${end || 'Present'}</p>`;
                    }
                    if (description) {
                        html += `<p>${description}</p>`;
                    }
                    html += `</div>`;
                }
            });
        }
        
        // Education
        if (fields.education.length > 0) {
            html += `<h2>Education</h2>`;
            fields.education.forEach(id => {
                const degree = document.getElementById(`${id}_degree`)?.value || '';
                const school = document.getElementById(`${id}_school`)?.value || '';
                const start = document.getElementById(`${id}_start`)?.value || '';
                const end = document.getElementById(`${id}_end`)?.value || '';
                const description = document.getElementById(`${id}_description`)?.value || '';
                
                if (degree || school) {
                    html += `<div class="preview-item">`;
                    html += `<h3>${degree}${school ? ` - ${school}` : ''}</h3>`;
                    if (start || end) {
                        html += `<p class="preview-meta">${start || 'Present'} - ${end || 'Present'}</p>`;
                    }
                    if (description) {
                        html += `<p>${description}</p>`;
                    }
                    html += `</div>`;
                }
            });
        }
        
        // Skills
        const skills = document.getElementById('skills').value;
        if (skills) {
            html += `<h2>Skills</h2>`;
            const skillsList = skills.split(',').map(s => s.trim()).filter(s => s);
            html += `<ul>`;
            skillsList.forEach(skill => {
                html += `<li>${skill}</li>`;
            });
            html += `</ul>`;
        }
        
        // Certifications
        if (fields.certification.length > 0) {
            html += `<h2>Certifications</h2>`;
            fields.certification.forEach(id => {
                const name = document.getElementById(`${id}_name`)?.value || '';
                const issuer = document.getElementById(`${id}_issuer`)?.value || '';
                const date = document.getElementById(`${id}_date`)?.value || '';
                
                if (name) {
                    html += `<div class="preview-item">`;
                    html += `<h3>${name}${issuer ? ` - ${issuer}` : ''}</h3>`;
                    if (date) {
                        html += `<p class="preview-meta">Issued: ${date}</p>`;
                    }
                    html += `</div>`;
                }
            });
        }
        
        // Languages
        const languages = document.getElementById('languages').value;
        if (languages) {
            html += `<h2>Languages</h2>`;
            const languagesList = languages.split(',').map(l => l.trim()).filter(l => l);
            html += `<ul>`;
            languagesList.forEach(lang => {
                html += `<li>${lang}</li>`;
            });
            html += `</ul>`;
        }
        
        preview.innerHTML = html || '<p style="text-align: center; color: var(--text-light);">Start filling the form to see your CV preview</p>';
    }

    // ============================================
    // EVENT LISTENERS
    // ============================================
    
    // Add buttons
    document.getElementById('addExperienceBtn').addEventListener('click', createExperienceItem);
    document.getElementById('addEducationBtn').addEventListener('click', createEducationItem);
    document.getElementById('addCertificationBtn').addEventListener('click', createCertificationItem);
    
    // Preview toggle
    previewBtn.addEventListener('click', function() {
        generatePreview();
        previewSection.classList.toggle('active');
    });
    
    closePreviewBtn.addEventListener('click', function() {
        previewSection.classList.remove('active');
    });
    
    // Export to PDF
    exportBtn.addEventListener('click', function() {
        generatePreview();
        const printWindow = window.open('', '_blank');
        printWindow.document.write(`
            <!DOCTYPE html>
            <html>
            <head>
                <title>CV - ${document.getElementById('fullName').value || 'Resume'}</title>
                <style>
                    body { font-family: 'Poppins', sans-serif; padding: 40px; line-height: 1.8; }
                    h1 { font-size: 2rem; margin-bottom: 8px; }
                    h2 { font-size: 1.5rem; color: #2563eb; margin-top: 32px; margin-bottom: 16px; padding-bottom: 8px; border-bottom: 2px solid #e5e7eb; }
                    h3 { font-size: 1.25rem; margin-top: 24px; margin-bottom: 8px; }
                    ul { list-style: none; padding: 0; }
                    ul li { padding: 8px 0; padding-left: 24px; position: relative; }
                    ul li:before { content: "•"; position: absolute; left: 0; color: #2563eb; font-weight: bold; }
                    .preview-item { margin-bottom: 24px; padding-bottom: 24px; border-bottom: 1px solid #e5e7eb; }
                    .preview-meta { color: #9ca3af; font-size: 0.875rem; }
                    @media print { body { padding: 0; } }
                </style>
            </head>
            <body>
                ${document.querySelector('.cv-preview').innerHTML}
            </body>
            </html>
        `);
        printWindow.document.close();
        setTimeout(() => {
            printWindow.print();
        }, 250);
    });
    
    // Reset form
    resetBtn.addEventListener('click', function() {
        if (confirm('Are you sure you want to reset the form? All data will be lost.')) {
            resumeForm.reset();
            document.getElementById('experienceContainer').innerHTML = '';
            document.getElementById('educationContainer').innerHTML = '';
            document.getElementById('certificationContainer').innerHTML = '';
            fields.experience = [];
            fields.education = [];
            fields.certification = [];
            experienceCount = 0;
            educationCount = 0;
            certificationCount = 0;
            updateProgress();
            generatePreview();
        }
    });
    
    // Form submission
    resumeForm.addEventListener('submit', function(e) {
        e.preventDefault();
        if (validateForm()) {
            // Collect all form data
            const formData = {
                fullName: document.getElementById('fullName').value.trim(),
                jobTitle: document.getElementById('jobTitle').value.trim(),
                email: document.getElementById('email').value.trim(),
                phone: document.getElementById('phone').value.trim(),
                location: document.getElementById('location').value.trim(),
                website: document.getElementById('website').value.trim(),
                summary: document.getElementById('summary').value.trim(),
                skills: document.getElementById('skills').value.trim(),
                languages: document.getElementById('languages').value.trim(),
                experience: [],
                education: [],
                certifications: []
            };
            
            // Collect experience data
            fields.experience.forEach(id => {
                const exp = {
                    title: document.getElementById(`${id}_title`)?.value.trim() || '',
                    company: document.getElementById(`${id}_company`)?.value.trim() || '',
                    start: document.getElementById(`${id}_start`)?.value || '',
                    end: document.getElementById(`${id}_end`)?.value || '',
                    description: document.getElementById(`${id}_description`)?.value.trim() || ''
                };
                if (exp.title || exp.company) {
                    formData.experience.push(exp);
                }
            });
            
            // Collect education data
            fields.education.forEach(id => {
                const edu = {
                    degree: document.getElementById(`${id}_degree`)?.value.trim() || '',
                    school: document.getElementById(`${id}_school`)?.value.trim() || '',
                    start: document.getElementById(`${id}_start`)?.value || '',
                    end: document.getElementById(`${id}_end`)?.value || '',
                    description: document.getElementById(`${id}_description`)?.value.trim() || ''
                };
                if (edu.degree || edu.school) {
                    formData.education.push(edu);
                }
            });
            
            // Collect certification data
            fields.certification.forEach(id => {
                const cert = {
                    name: document.getElementById(`${id}_name`)?.value.trim() || '',
                    issuer: document.getElementById(`${id}_issuer`)?.value.trim() || '',
                    date: document.getElementById(`${id}_date`)?.value || '',
                    expiry: document.getElementById(`${id}_expiry`)?.value || ''
                };
                if (cert.name) {
                    formData.certifications.push(cert);
                }
            });
            
            // Show loading state
            const submitBtn = resumeForm.querySelector('button[type="submit"]');
            const originalHTML = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
            
            // Send data to server
            const formDataToSend = new FormData();
            Object.keys(formData).forEach(key => {
                if (Array.isArray(formData[key])) {
                    formDataToSend.append(key, JSON.stringify(formData[key]));
                } else {
                    formDataToSend.append(key, formData[key]);
                }
            });
            
            fetch('../controller/save_resume.php', {
                method: 'POST',
                body: formDataToSend
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Resume saved successfully! You can view it in "My Resume" page.');
                    // Optionally redirect to view page
                    // window.location.href = 'my_resume.php';
                } else {
                    alert('Error saving resume: ' + (data.error || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error saving resume. Please try again.');
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalHTML;
            });
        }
    });
    
    // File upload
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
        handleFiles(e.dataTransfer.files);
    });
    resumeFile.addEventListener('change', () => handleFiles(resumeFile.files));
    
    function handleFiles(files) {
        const file = files[0];
        if (file) {
            const validTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            const maxSize = 5 * 1024 * 1024; // 5MB
            
            if (validTypes.includes(file.type)) {
                if (file.size <= maxSize) {
                    uploadStatus.textContent = `File selected: ${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
                    uploadStatus.className = 'upload-status success';
                    updateProgress();
                } else {
                    uploadStatus.textContent = 'File size exceeds 5MB limit.';
                    uploadStatus.className = 'upload-status error';
                }
            } else {
                uploadStatus.textContent = 'Please upload a valid PDF or DOC file.';
                uploadStatus.className = 'upload-status error';
            }
        }
    }
    
    // Real-time preview and progress updates
    const allInputs = resumeForm.querySelectorAll('input, textarea');
    allInputs.forEach(input => {
        input.addEventListener('input', function() {
            updateProgress();
            generatePreview();
            
            // Clear website error on input if it was showing
            if (input.id === 'website') {
                const websiteError = document.getElementById('websiteError');
                if (websiteError && input.value.trim() === '') {
                    websiteError.textContent = '';
                    input.classList.remove('error');
                }
            }
        });
        
        // Validate website on blur
        if (input.id === 'website') {
            input.addEventListener('blur', function() {
                const websiteValue = this.value.trim();
                const websiteError = document.getElementById('websiteError');
                
                if (websiteValue) {
                    // More flexible URL validation - accepts http://, https://, or just domain
                    const urlRegex = /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/i;
                    if (!urlRegex.test(websiteValue)) {
                        websiteError.textContent = 'Please enter a valid website URL (e.g., https://example.com or example.com)';
                        this.classList.add('error');
                    } else {
                        websiteError.textContent = '';
                        this.classList.remove('error');
                    }
                } else {
                    websiteError.textContent = '';
                    this.classList.remove('error');
                }
            });
        }
    });
    
    // Initial progress update
    updateProgress();
    generatePreview();
    
    console.log('Resume builder loaded successfully');
});
