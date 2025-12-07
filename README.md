# 🚀 Employify - Modern Job Portal Platform

A comprehensive, modern job portal platform built with PHP, MySQL, HTML5, CSS3, and JavaScript. Connect job seekers with employers through an intuitive, feature-rich interface.

![Employify](https://img.shields.io/badge/Employify-Job%20Portal-blue)
![PHP](https://img.shields.io/badge/PHP-7.0+-purple)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-orange)
![License](https://img.shields.io/badge/License-MIT-green)

## ✨ Features

### For Job Seekers
- 🔍 **Advanced Job Search** - Filter by location, category, experience level, and job type
- 📄 **Resume Builder** - Create professional, ATS-friendly resumes
- 🔔 **Job Alerts** - Get notified about new opportunities matching your criteria
- 💼 **Application Tracking** - Track your job applications in one place
- 📊 **Salary Insights** - Research salary ranges by position and location
- 📚 **Career Resources** - Access guides, tips, and expert advice
- 👤 **Profile Management** - Manage your professional profile

### For Employers
- 📝 **Job Posting** - Post job openings easily
- 👥 **Candidate Management** - Review and manage applications
- 🏢 **Company Profiles** - Showcase your company culture and values
- 📈 **Analytics** - Track job posting performance

### Platform Features
- 🎨 **Modern UI/UX** - Beautiful, responsive design with smooth animations
- 🔐 **Secure Authentication** - Role-based access (Applicant/Employer)
- 📱 **Fully Responsive** - Works seamlessly on desktop, tablet, and mobile
- ⚡ **Fast Performance** - Optimized for speed and efficiency
- ♿ **Accessible** - Built with accessibility in mind

## 🛠️ Technology Stack

- **Backend**: PHP 7.0+
- **Database**: MySQL/MariaDB
- **Frontend**: HTML5, CSS3, JavaScript (ES6+)
- **Styling**: Custom CSS with CSS Variables, Flexbox, Grid
- **Icons**: Font Awesome 6.0
- **Fonts**: Google Fonts (Poppins)
- **Architecture**: MVC (Model-View-Controller)

## 📋 Prerequisites

Before you begin, ensure you have the following installed:

- [XAMPP](https://www.apachefriends.org/) (includes Apache, MySQL, PHP)
- PHP 7.0 or higher
- MySQL 5.7 or higher
- Modern web browser (Chrome, Firefox, Edge, Safari)

## 🚀 Quick Start

### 1. Clone the Repository

```bash
git clone https://github.com/yourusername/employify.git
cd employify
```

### 2. Start XAMPP Services

1. Open **XAMPP Control Panel**
2. Start **Apache** server
3. Start **MySQL** server

### 3. Setup Database

**Option A: Automated Setup (Recommended)**
- Open browser: `http://localhost/job/model/setup_db_simple.php`
- Wait for "Setup Complete!" message

**Option B: Manual Setup**
1. Go to: `http://localhost/phpmyadmin`
2. Create database: `Employify`
3. Import: `model/create_tables.sql`

### 4. Configure Database Connection

Edit `model/db.php` if needed (default settings work with XAMPP):
```php
$host = "127.0.0.1";
$dbuser = "root";
$dbpass = "";
$dbname = "Employify";
```

### 5. Access the Application

Open your browser and navigate to:
```
http://localhost/job/view/home.php
```

## 📁 Project Structure

```
job/
├── assets/
│   ├── css/          # Stylesheets
│   ├── js/           # JavaScript files
│   └── image/         # Images and assets
├── controller/        # PHP controllers
│   ├── logincheck.php
│   ├── reg.php
│   └── registration_validation.php
├── model/             # Database models
│   ├── db.php
│   ├── user_model.php
│   ├── validation.php
│   └── setup_db_simple.php
└── view/              # PHP views/templates
    ├── home.php
    ├── jobs.php
    ├── login.php
    ├── registration.php
    ├── navbar.php
    └── ...
```

## 🔑 Default Login Credentials

### Employer Account
- **Email**: `employer@employify.com`
- **Password**: `password`

### Applicant Account
- **Email**: `applicant@employify.com`
- **Password**: `password`

> ⚠️ **Security Note**: Change default passwords in production!

See `CREDENTIALS.txt` for all test accounts.

## 📄 Pages Overview

### Main Pages
- **Home** (`home.php`) - Landing page with hero section and features
- **Find Jobs** (`jobs.php`) - Job search with filters and listings
- **About** (`about.php`) - Company information, mission, vision, team
- **Contact** (`contact.php`) - Contact form and company information
- **Career Resources** (`career-resources.php`) - Career guides and tips

### User Pages
- **Login** (`login.php`) - User authentication
- **Registration** (`registration.php`) - New user signup
- **Profile** (`Profile.php`) - User profile management
- **Resume** (`resume.php`) - Resume builder
- **Job Alerts** (`alert.php`) - Manage job alerts

### Additional Pages
- **Salary** (`salary.php`) - Salary information
- **Interview** (`interview.php`) - Interview scheduling
- **Company Profile** (`company_profile.php`) - Individual company details

## 🎨 Design Features

- **Modern Gradient Hero Sections** - Eye-catching landing sections
- **Smooth Animations** - CSS transitions and JavaScript animations
- **Responsive Grid Layouts** - Flexible, mobile-first design
- **Interactive Components** - Modals, dropdowns, tooltips
- **Consistent Design System** - CSS variables for theming
- **Accessible Forms** - Proper labels, error messages, validation

## 🔧 Configuration

### reCAPTCHA (Optional)

To enable reCAPTCHA on the contact form:
1. Get a reCAPTCHA site key from [Google reCAPTCHA](https://www.google.com/recaptcha)
2. Edit `assets/js/contact.js`
3. Set: `const RECAPTCHA_SITE_KEY = 'your-site-key-here';`

Leave empty to disable reCAPTCHA.

### Database Configuration

Edit `model/db.php` to change database settings:
```php
$host = "your-host";
$dbuser = "your-username";
$dbpass = "your-password";
$dbname = "your-database";
```

## 🧪 Testing

### Test Accounts
Multiple test accounts are available. See `CREDENTIALS.txt` for details.

### Database Testing
- Test login: `http://localhost/job/model/test_employer_login.php`
- Debug login: `http://localhost/job/model/debug_login.php`

## 📚 Documentation

- **Setup Instructions**: `SETUP_INSTRUCTIONS.md`
- **Database Setup**: `model/README_DATABASE_SETUP.md`
- **Pages Overview**: `PAGES_OVERVIEW.md`
- **Credentials**: `CREDENTIALS.txt`

## 🐛 Troubleshooting

### Common Issues

**Issue**: Database connection failed
- **Solution**: Ensure MySQL is running in XAMPP
- Check database credentials in `model/db.php`

**Issue**: Pages not loading
- **Solution**: Ensure Apache is running
- Check file paths (should be in `htdocs/job/`)

**Issue**: Login not working
- **Solution**: Run database setup script
- Check `CREDENTIALS.txt` for correct credentials

**Issue**: Styles not loading
- **Solution**: Clear browser cache
- Check CSS file paths in HTML

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 👥 Authors

- **Your Name** - *Initial work* - [YourGitHub](https://github.com/yourusername)

## 🙏 Acknowledgments

- Font Awesome for icons
- Google Fonts for typography
- All contributors and testers

## 📞 Support

For support, email info@employify.com or open an issue in the repository.

## 🔄 Changelog

### Version 2.0 (Current)
- ✨ Complete UI/UX redesign
- 🎨 Modern gradient hero sections
- 📱 Enhanced responsive design
- 🔍 Improved job search functionality
- 📄 Redesigned career resources page
- 📞 Enhanced contact form with validation
- 🏢 Redesigned about page
- 🗑️ Removed unused company.php page
- 🐛 Fixed various bugs and issues

### Version 1.0
- 🎉 Initial release
- ✅ Basic job portal functionality
- 👤 User authentication
- 📝 Job posting and applications

---

**Made with ❤️ for job seekers and employers**

