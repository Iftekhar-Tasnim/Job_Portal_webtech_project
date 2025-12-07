# Database Setup Guide for Employify Job Portal

## Prerequisites
- XAMPP (or any PHP/MySQL environment)
- MySQL server running
- PHP 7.0 or higher

## Quick Setup

### Method 1: Using the Setup Script (Recommended)

1. **Start XAMPP Services**
   - Open XAMPP Control Panel
   - Start Apache
   - Start MySQL

2. **Run the Setup Script**
   - Open your browser
   - Navigate to: `http://localhost/job/model/setup_database.php`
   - The script will automatically:
     - Create the database
     - Create all necessary tables
     - Insert sample data

3. **Verify Setup**
   - Check phpMyAdmin: `http://localhost/phpmyadmin`
   - You should see the `Employify` database with all tables

### Method 2: Manual Setup via phpMyAdmin

1. **Open phpMyAdmin**
   - Navigate to: `http://localhost/phpmyadmin`

2. **Create Database**
   - Click "New" in the left sidebar
   - Database name: `Employify`
   - Collation: `utf8mb4_general_ci`
   - Click "Create"

3. **Import SQL File**
   - Select the `Employify` database
   - Click "Import" tab
   - Choose file: `model/create_tables.sql`
   - Click "Go"

### Method 3: Using MySQL Command Line

1. **Open MySQL Command Line**
   ```bash
   mysql -u root -p
   ```

2. **Run SQL File**
   ```sql
   source C:/xampp/htdocs/job/model/create_tables.sql
   ```

## Database Configuration

The database configuration is in `model/db.php`:
- Host: `127.0.0.1`
- Username: `root`
- Password: `` (empty by default)
- Database: `Employify`

If your MySQL has a different password, update `model/db.php`:
```php
$dbpass = "your_password";
```

## Database Structure

### Main Tables:
1. **applicantreg** - Applicant user accounts
2. **employerreg** - Employer user accounts
3. **jobs** - Job listings
4. **job_applications** - Job applications
5. **saved_jobs** - Saved jobs by applicants
6. **resumes** - Resume data
7. **job_alerts** - Job alert preferences
8. **interviews** - Interview scheduling
9. **company_reviews** - Company reviews
10. **contact_messages** - Contact form submissions

## Sample Data

The setup script includes sample data:
- **Sample Employer**: 
  - Email: `employer@employify.com`
  - Password: `password` (hashed)
  
- **Sample Applicant**: 
  - Email: `applicant@employify.com`
  - Password: `password` (hashed)

- **Sample Jobs**: 3 sample job listings

## Troubleshooting

### Error: "Access denied for user 'root'@'localhost'"
- Check MySQL password in `model/db.php`
- Reset MySQL root password if needed

### Error: "Table already exists"
- This is normal if you run the script multiple times
- Tables won't be overwritten

### Error: "Connection refused"
- Make sure MySQL service is running in XAMPP
- Check if MySQL port (3306) is not blocked

### Error: "Unknown database 'Employify'"
- Run the setup script first
- Or manually create the database

## Next Steps

After database setup:
1. Access the application: `http://localhost/job/view/home.php`
2. Register a new account or use sample credentials
3. Start using the job portal!

## Support

If you encounter any issues:
1. Check XAMPP error logs
2. Check MySQL error logs
3. Verify file permissions
4. Ensure all services are running

