# Company/Employer Profile & Pages - Implementation Plan

## Overview
Create a comprehensive profile system and necessary pages for companies/employers to manage their job postings and applications.

## Pages to Create

### 1. Company Profile Dashboard (`view/company_profile.php`)
**Purpose:** Main dashboard showing company overview and statistics
**Features:**
- Company information display
- Statistics cards:
  - Total Jobs Posted
  - Active Jobs
  - Total Applications
  - Pending Reviews
  - Interviews Scheduled
- Recent applications list
- Quick actions (Post Job, View Applications)

### 2. Post Job Page (`view/post_job.php`)
**Purpose:** Create new job listings
**Features:**
- Job title, description, requirements
- Location, category, experience level
- Job type (full-time, part-time, contract, internship)
- Salary range (min/max)
- Deadline date
- Status (active, draft)
- Form validation
- Save as draft or publish

### 3. Manage Jobs Page (`view/manage_jobs.php`)
**Purpose:** View, edit, delete, and manage posted jobs
**Features:**
- List all jobs posted by company
- Filter by status (active, closed, draft)
- Search functionality
- Edit job details
- Delete jobs
- View application count per job
- Quick status toggle (active/closed)

### 4. View Applications Page (`view/view_applications.php`)
**Purpose:** View and manage applications for company's jobs
**Features:**
- List all applications
- Filter by job, status, date
- View applicant details
- View resume/CV
- Update application status (review, interview, offer, rejected)
- Download resume
- Send messages/notes

### 5. Company Settings Page (included in company_profile.php)
**Purpose:** Update company information and account settings
**Features:**
- Update company name, email, phone
- Update company address
- Update business type, size, industry
- Update company website
- Change password
- Profile picture upload (optional)

## Backend Components

### 1. Company Model (`model/company_model.php`)
**Functions:**
- `getCompanyProfile($employer_id)` - Get company data
- `updateCompanyProfile($employer_id, $data)` - Update company info
- `getCompanyStats($employer_id)` - Get statistics
- `createJob($employer_id, $jobData)` - Create new job
- `updateJob($job_id, $employer_id, $jobData)` - Update job
- `deleteJob($job_id, $employer_id)` - Delete job
- `getCompanyJobs($employer_id, $status = null)` - Get company's jobs
- `getJobApplications($employer_id, $job_id = null)` - Get applications
- `updateApplicationStatus($application_id, $status)` - Update application status
- `updatePassword($employer_id, $password)` - Change password

### 2. Company Controller (`controller/company_controller.php`)
**Actions:**
- `update_profile` - Update company profile
- `update_password` - Change password
- `create_job` - Create new job
- `update_job` - Update existing job
- `delete_job` - Delete job
- `update_application_status` - Update application status

## Frontend Components

### 1. CSS (`assets/css/company.css`)
- Compact, eye-comforting design (similar to applicant profile)
- Responsive layout
- Form styling
- Card layouts for jobs and applications
- Status badges
- Statistics cards

### 2. JavaScript (`assets/js/company.js`)
- Form submissions
- AJAX calls for updates
- Dynamic content loading
- Status updates
- Filtering and searching
- Modal handling

## Database Tables Used
- `employerreg` - Company information
- `jobs` - Job listings
- `job_applications` - Applications for jobs
- `applicantreg` - Applicant information (for viewing applicants)

## Navigation Updates
- Add "Company Dashboard" link in navbar for employers
- Add "Post Job" quick action
- Update profile dropdown for employers

## Implementation Order
1. Create company model with all database functions
2. Create company controller
3. Create company profile dashboard page
4. Create post job page
5. Create manage jobs page
6. Create view applications page
7. Create CSS styling
8. Create JavaScript functionality
9. Update navbar for employer links
10. Test all functionality

## Design Principles
- Compact, eye-comforting design (similar to applicant profile)
- Consistent with existing design system
- Mobile responsive
- User-friendly forms
- Clear status indicators
- Efficient data display

