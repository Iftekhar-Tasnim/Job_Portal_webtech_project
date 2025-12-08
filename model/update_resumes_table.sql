-- Update resumes table to include all CV builder fields
USE Employify;

ALTER TABLE resumes 
ADD COLUMN IF NOT EXISTS job_title VARCHAR(100) AFTER full_name,
ADD COLUMN IF NOT EXISTS location VARCHAR(100) AFTER phone,
ADD COLUMN IF NOT EXISTS website VARCHAR(255) AFTER location,
ADD COLUMN IF NOT EXISTS summary TEXT AFTER website,
ADD COLUMN IF NOT EXISTS certifications TEXT AFTER skills,
ADD COLUMN IF NOT EXISTS languages VARCHAR(255) AFTER certifications;

-- Update experience and education to store JSON
-- (They are already TEXT, so they can store JSON)

