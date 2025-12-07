# 🚀 Quick Setup Guide - Employify Job Portal

## Prerequisites
- ✅ XAMPP installed and running
- ✅ PHP 7.0 or higher
- ✅ MySQL/MariaDB

## Step-by-Step Setup

### 1. Start XAMPP Services
1. Open **XAMPP Control Panel**
2. Click **Start** for **Apache**
3. Click **Start** for **MySQL**
4. Both should show green "Running" status

### 2. Run Database Setup

**Option A: Simple Setup (Recommended)**
- Open your browser
- Go to: `http://localhost/job/model/setup_db_simple.php`
- You'll see a setup page with progress
- Wait for "Setup Complete!" message

**Option B: Using phpMyAdmin**
1. Go to: `http://localhost/phpmyadmin`
2. Click "New" → Create database named: `Employify`
3. Select the database
4. Click "Import" tab
5. Choose file: `model/create_tables.sql`
6. Click "Go"

**Option C: Command Line**
```bash
mysql -u root -p
source C:/xampp/htdocs/job/model/create_tables.sql
```

### 3. Verify Database Setup
1. Open phpMyAdmin: `http://localhost/phpmyadmin`
2. Check if `Employify` database exists
3. Verify these tables are created:
   - ✅ applicantreg
   - ✅ employerreg
   - ✅ jobs
   - ✅ job_applications
   - ✅ saved_jobs
   - ✅ resumes
   - ✅ job_alerts
   - ✅ interviews
   - ✅ company_reviews
   - ✅ contact_messages

### 4. Access the Application
- **Home Page**: `http://localhost/job/view/home.php`
- **Login Page**: `http://localhost/job/view/login.php`
- **Registration**: `http://localhost/job/view/registration.php`

## 🔑 Sample Login Credentials

### Employer Account
- **Email**: `employer@employify.com`
- **Password**: `password`

### Applicant Account
- **Email**: `applicant@employify.com`
- **Password**: `password`

## 📝 Database Configuration

If you need to change database settings, edit: `model/db.php`

```php
$host = "127.0.0.1";
$dbuser = "root";
$dbpass = "";  // Change if you have MySQL password
$dbname = "Employify";
```

## 🛠️ Troubleshooting

### Error: "Connection failed"
- ✅ Check if MySQL is running in XAMPP
- ✅ Verify database credentials in `model/db.php`
- ✅ Make sure database `Employify` exists

### Error: "Access denied"
- ✅ Check MySQL root password
- ✅ Update `$dbpass` in `model/db.php` if needed

### Error: "Table already exists"
- ✅ This is normal if you run setup multiple times
- ✅ Tables won't be overwritten, it's safe to ignore

### Pages showing blank/errors
- ✅ Check Apache error logs: `C:\xampp\apache\logs\error.log`
- ✅ Enable error display in PHP (for development)
- ✅ Check file permissions

## 📁 Project Structure

```
job/
├── model/          # Database & business logic
│   ├── db.php      # Database connection
│   ├── setup_db_simple.php  # Setup script
│   └── create_tables.sql     # SQL file
├── controller/     # Request handlers
├── view/           # PHP pages
└── assets/         # CSS, JS, images
```

## ✅ Setup Checklist

- [ ] XAMPP Apache running
- [ ] XAMPP MySQL running
- [ ] Database setup script executed
- [ ] Database `Employify` created
- [ ] All tables created successfully
- [ ] Can access home page
- [ ] Can login with sample credentials

## 🎉 You're Ready!

Once setup is complete, you can:
1. Register new users (applicants/employers)
2. Post job listings (as employer)
3. Apply for jobs (as applicant)
4. Manage profiles
5. Use all features of the job portal

## 📞 Need Help?

- Check `model/README_DATABASE_SETUP.md` for detailed database info
- Review error logs in XAMPP
- Verify all services are running

---

**Happy Coding! 🚀**

