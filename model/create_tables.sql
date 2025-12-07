-- Employify Job Portal Database Setup
-- Database: Employify

-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS Employify;
USE Employify;

-- Table for Applicant Registrations
CREATE TABLE IF NOT EXISTS applicantreg (
    id INT AUTO_INCREMENT PRIMARY KEY,
    First_Name VARCHAR(50) NOT NULL,
    Last_Name VARCHAR(50) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,
    Phone VARCHAR(20) NOT NULL,
    Address TEXT NOT NULL,
    Gender ENUM('Male', 'Female', 'Other') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (Email),
    INDEX idx_phone (Phone)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table for Employer Registrations
CREATE TABLE IF NOT EXISTS employerreg (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Company_Name VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,
    Company_Phone VARCHAR(20) NOT NULL,
    Company_Address TEXT NOT NULL,
    Business_Type VARCHAR(50),
    Company_Size VARCHAR(50),
    Company_Website VARCHAR(255),
    Industry VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (Email),
    INDEX idx_company_name (Company_Name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table for Job Listings
CREATE TABLE IF NOT EXISTS jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employer_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    company VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    requirements TEXT,
    location VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    experience_level ENUM('entry', 'mid', 'senior') NOT NULL,
    job_type ENUM('full-time', 'part-time', 'contract', 'internship') DEFAULT 'full-time',
    salary_min DECIMAL(10,2),
    salary_max DECIMAL(10,2),
    status ENUM('active', 'closed', 'draft') DEFAULT 'active',
    posted_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deadline DATE,
    FOREIGN KEY (employer_id) REFERENCES employerreg(id) ON DELETE CASCADE,
    INDEX idx_category (category),
    INDEX idx_location (location),
    INDEX idx_status (status),
    INDEX idx_employer (employer_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table for Job Applications
CREATE TABLE IF NOT EXISTS job_applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_id INT NOT NULL,
    applicant_id INT NOT NULL,
    resume_path VARCHAR(255),
    cover_letter TEXT,
    status ENUM('applied', 'review', 'interview', 'offer', 'rejected') DEFAULT 'applied',
    applied_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (job_id) REFERENCES jobs(id) ON DELETE CASCADE,
    FOREIGN KEY (applicant_id) REFERENCES applicantreg(id) ON DELETE CASCADE,
    UNIQUE KEY unique_application (job_id, applicant_id),
    INDEX idx_status (status),
    INDEX idx_applicant (applicant_id),
    INDEX idx_job (job_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table for Saved Jobs
CREATE TABLE IF NOT EXISTS saved_jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_id INT NOT NULL,
    applicant_id INT NOT NULL,
    saved_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (job_id) REFERENCES jobs(id) ON DELETE CASCADE,
    FOREIGN KEY (applicant_id) REFERENCES applicantreg(id) ON DELETE CASCADE,
    UNIQUE KEY unique_saved_job (job_id, applicant_id),
    INDEX idx_applicant (applicant_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table for Resumes
CREATE TABLE IF NOT EXISTS resumes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    applicant_id INT NOT NULL,
    resume_file_path VARCHAR(255),
    full_name VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(20),
    experience TEXT,
    education TEXT,
    skills TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (applicant_id) REFERENCES applicantreg(id) ON DELETE CASCADE,
    INDEX idx_applicant (applicant_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table for Job Alerts
CREATE TABLE IF NOT EXISTS job_alerts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    applicant_id INT NOT NULL,
    job_title VARCHAR(200),
    location VARCHAR(100),
    job_type VARCHAR(50),
    notification_method ENUM('email', 'app', 'both') DEFAULT 'email',
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (applicant_id) REFERENCES applicantreg(id) ON DELETE CASCADE,
    INDEX idx_applicant (applicant_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table for Interviews
CREATE TABLE IF NOT EXISTS interviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    application_id INT NOT NULL,
    interview_date DATETIME NOT NULL,
    interview_type ENUM('phone', 'video', 'in-person') DEFAULT 'in-person',
    location VARCHAR(255),
    status ENUM('scheduled', 'completed', 'cancelled', 'rescheduled') DEFAULT 'scheduled',
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (application_id) REFERENCES job_applications(id) ON DELETE CASCADE,
    INDEX idx_application (application_id),
    INDEX idx_date (interview_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table for Company Reviews
CREATE TABLE IF NOT EXISTS company_reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employer_id INT NOT NULL,
    applicant_id INT NOT NULL,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    review_text TEXT,
    is_anonymous BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (employer_id) REFERENCES employerreg(id) ON DELETE CASCADE,
    FOREIGN KEY (applicant_id) REFERENCES applicantreg(id) ON DELETE CASCADE,
    INDEX idx_employer (employer_id),
    INDEX idx_rating (rating)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table for Contact Messages
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'replied') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample data (optional - for testing)
-- Sample Employer (password stored as plain text 'password' for easy login)
INSERT INTO employerreg (Company_Name, Email, Password, Company_Phone, Company_Address, Business_Type, Company_Size, Industry) 
VALUES ('Tech Solutions', 'employer@employify.com', 'password', '1234567890', '123 Tech Street, Dhaka', 'IT Services', '50-100', 'Information Technology')
ON DUPLICATE KEY UPDATE Password='password', Company_Name=Company_Name;

-- Sample Applicant (password stored as plain text 'password' for easy login)
INSERT INTO applicantreg (First_Name, Last_Name, Email, Password, Phone, Address, Gender) 
VALUES ('John', 'Doe', 'applicant@employify.com', 'password', '9876543210', '456 Main Street, Dhaka', 'Male')
ON DUPLICATE KEY UPDATE Password='password', Email=Email;

-- Sample Jobs
INSERT INTO jobs (employer_id, title, company, description, requirements, location, category, experience_level, job_type, salary_min, salary_max) 
VALUES 
(1, 'Software Developer', 'Tech Solutions', 'We are looking for a talented software developer to join our team. You will be responsible for developing and maintaining our software products.', '3+ years of experience in software development\nProficient in Java and JavaScript\nExperience with web technologies\nStrong problem-solving skills', 'Dhaka', 'it', 'mid', 'full-time', 50000, 80000),
(1, 'Marketing Manager', 'Tech Solutions', 'We need an experienced marketing manager to lead our marketing team and develop effective marketing strategies.', '5+ years of marketing experience\nTeam management experience\nStrong communication skills\nDigital marketing expertise', 'Chittagong', 'marketing', 'senior', 'full-time', 60000, 90000),
(1, 'Accountant', 'Tech Solutions', 'Entry-level position for an accountant to assist with financial reporting and analysis.', 'Bachelor''s degree in Accounting\nBasic accounting knowledge\nAttention to detail\nGood communication skills', 'Sylhet', 'finance', 'entry', 'full-time', 30000, 45000)
ON DUPLICATE KEY UPDATE title=title;

