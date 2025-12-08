<?php
/**
 * Add 20 Sample Jobs to Database
 * Run this file in your browser: http://localhost/job/model/add_sample_jobs.php
 */

require_once 'db.php';

$con = getConnection();

// First, get an employer ID (use the first employer in the database)
$employerQuery = "SELECT id, Company_Name FROM employerreg LIMIT 1";
$employerResult = mysqli_query($con, $employerQuery);

if (!$employerResult || mysqli_num_rows($employerResult) == 0) {
    die("<h2 style='color: red;'>Error: No employer found in database. Please create an employer account first.</h2>");
}

$employer = mysqli_fetch_assoc($employerResult);
$employerId = $employer['id'];
$companyName = $employer['Company_Name'];

echo "<!DOCTYPE html>
<html>
<head>
    <title>Add Sample Jobs</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 900px; margin: 50px auto; padding: 20px; }
        .success { color: green; padding: 10px; background: #d4edda; border: 1px solid #c3e6cb; margin: 10px 0; }
        .error { color: red; padding: 10px; background: #f8d7da; border: 1px solid #f5c6cb; margin: 10px 0; }
        .info { color: #0c5460; padding: 10px; background: #d1ecf1; border: 1px solid #bee5eb; margin: 10px 0; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 10px; text-align: left; border: 1px solid #ddd; }
        th { background: #f8f9fa; }
    </style>
</head>
<body>
    <h1>Adding 20 Sample Jobs to Database</h1>
    <div class='info'>Using Employer: <strong>{$companyName}</strong> (ID: {$employerId})</div>";

// Sample jobs data
$sampleJobs = [
    [
        'title' => 'Senior Software Engineer',
        'description' => 'We are looking for an experienced software engineer to join our development team. You will be responsible for designing and implementing scalable web applications using modern technologies.',
        'requirements' => '5+ years of experience in software development\nProficient in PHP, JavaScript, and MySQL\nExperience with RESTful APIs\nStrong problem-solving skills\nBachelor\'s degree in Computer Science or related field',
        'location' => 'Dhaka',
        'category' => 'it',
        'experience_level' => 'senior',
        'job_type' => 'full-time',
        'salary_min' => 80000,
        'salary_max' => 120000,
        'status' => 'active'
    ],
    [
        'title' => 'Frontend Developer',
        'description' => 'Join our frontend team to build beautiful and responsive user interfaces. Work with modern frameworks like React and Vue.js.',
        'requirements' => '3+ years of frontend development experience\nProficient in HTML, CSS, JavaScript\nExperience with React or Vue.js\nKnowledge of responsive design\nPortfolio of previous work',
        'location' => 'Dhaka',
        'category' => 'it',
        'experience_level' => 'mid',
        'job_type' => 'full-time',
        'salary_min' => 50000,
        'salary_max' => 80000,
        'status' => 'active'
    ],
    [
        'title' => 'Marketing Manager',
        'description' => 'Lead our marketing team and develop comprehensive marketing strategies to grow our brand presence and customer base.',
        'requirements' => '5+ years of marketing experience\nTeam management skills\nDigital marketing expertise\nStrong communication skills\nBachelor\'s degree in Marketing or related field',
        'location' => 'Chittagong',
        'category' => 'marketing',
        'experience_level' => 'senior',
        'job_type' => 'full-time',
        'salary_min' => 60000,
        'salary_max' => 90000,
        'status' => 'active'
    ],
    [
        'title' => 'Accountant',
        'description' => 'Entry-level position for an accountant to assist with financial reporting, bookkeeping, and tax preparation.',
        'requirements' => 'Bachelor\'s degree in Accounting\nBasic accounting knowledge\nAttention to detail\nGood communication skills\nProficiency in MS Excel',
        'location' => 'Sylhet',
        'category' => 'finance',
        'experience_level' => 'entry',
        'job_type' => 'full-time',
        'salary_min' => 30000,
        'salary_max' => 45000,
        'status' => 'active'
    ],
    [
        'title' => 'Graphic Designer',
        'description' => 'Create visually appealing designs for digital and print media. Work on branding, marketing materials, and web graphics.',
        'requirements' => '2+ years of graphic design experience\nProficient in Adobe Creative Suite\nStrong portfolio\nCreative thinking\nAttention to detail',
        'location' => 'Dhaka',
        'category' => 'design',
        'experience_level' => 'mid',
        'job_type' => 'full-time',
        'salary_min' => 35000,
        'salary_max' => 55000,
        'status' => 'active'
    ],
    [
        'title' => 'Sales Executive',
        'description' => 'Build relationships with clients and drive sales growth. Identify new business opportunities and maintain customer relationships.',
        'requirements' => '2+ years of sales experience\nExcellent communication skills\nCustomer-focused approach\nTarget-driven mindset\nValid driving license',
        'location' => 'Dhaka',
        'category' => 'sales',
        'experience_level' => 'mid',
        'job_type' => 'full-time',
        'salary_min' => 25000,
        'salary_max' => 40000,
        'status' => 'active'
    ],
    [
        'title' => 'HR Manager',
        'description' => 'Oversee all human resources functions including recruitment, employee relations, performance management, and policy development.',
        'requirements' => '5+ years of HR experience\nStrong interpersonal skills\nKnowledge of labor laws\nRecruitment experience\nBachelor\'s degree in HR or related field',
        'location' => 'Dhaka',
        'category' => 'hr',
        'experience_level' => 'senior',
        'job_type' => 'full-time',
        'salary_min' => 55000,
        'salary_max' => 85000,
        'status' => 'active'
    ],
    [
        'title' => 'Backend Developer',
        'description' => 'Develop and maintain server-side applications. Work with databases, APIs, and server infrastructure.',
        'requirements' => '3+ years of backend development\nProficient in PHP, Python, or Node.js\nDatabase design experience\nAPI development skills\nUnderstanding of security best practices',
        'location' => 'Dhaka',
        'category' => 'it',
        'experience_level' => 'mid',
        'job_type' => 'full-time',
        'salary_min' => 50000,
        'salary_max' => 75000,
        'status' => 'active'
    ],
    [
        'title' => 'Content Writer',
        'description' => 'Create engaging content for websites, blogs, and marketing materials. Research topics and write SEO-friendly articles.',
        'requirements' => '2+ years of content writing experience\nExcellent writing skills\nSEO knowledge\nResearch skills\nPortfolio of published work',
        'location' => 'Dhaka',
        'category' => 'marketing',
        'experience_level' => 'mid',
        'job_type' => 'part-time',
        'salary_min' => 20000,
        'salary_max' => 35000,
        'status' => 'active'
    ],
    [
        'title' => 'Data Analyst',
        'description' => 'Analyze business data to provide insights and support decision-making. Create reports and visualizations.',
        'requirements' => '2+ years of data analysis experience\nProficient in Excel and SQL\nStatistical analysis skills\nAttention to detail\nBachelor\'s degree in Statistics or related field',
        'location' => 'Dhaka',
        'category' => 'it',
        'experience_level' => 'mid',
        'job_type' => 'full-time',
        'salary_min' => 45000,
        'salary_max' => 70000,
        'status' => 'active'
    ],
    [
        'title' => 'UI/UX Designer',
        'description' => 'Design user interfaces and user experiences for web and mobile applications. Create wireframes, prototypes, and design systems.',
        'requirements' => '3+ years of UI/UX design experience\nProficient in Figma or Adobe XD\nUser research skills\nPortfolio demonstrating design process\nUnderstanding of usability principles',
        'location' => 'Dhaka',
        'category' => 'design',
        'experience_level' => 'mid',
        'job_type' => 'full-time',
        'salary_min' => 40000,
        'salary_max' => 65000,
        'status' => 'active'
    ],
    [
        'title' => 'Customer Support Representative',
        'description' => 'Provide excellent customer service through phone, email, and chat. Resolve customer issues and maintain satisfaction.',
        'requirements' => '1+ year of customer service experience\nExcellent communication skills\nPatience and empathy\nProblem-solving abilities\nMultilingual preferred',
        'location' => 'Dhaka',
        'category' => 'other',
        'experience_level' => 'entry',
        'job_type' => 'full-time',
        'salary_min' => 20000,
        'salary_max' => 30000,
        'status' => 'active'
    ],
    [
        'title' => 'Project Manager',
        'description' => 'Lead project teams and ensure successful delivery of projects on time and within budget. Coordinate resources and stakeholders.',
        'requirements' => '5+ years of project management experience\nPMP certification preferred\nStrong leadership skills\nRisk management experience\nExcellent organizational skills',
        'location' => 'Dhaka',
        'category' => 'other',
        'experience_level' => 'senior',
        'job_type' => 'full-time',
        'salary_min' => 70000,
        'salary_max' => 100000,
        'status' => 'active'
    ],
    [
        'title' => 'Software Developer Intern',
        'description' => 'Learn and contribute to software development projects. Work with experienced developers on real-world applications.',
        'requirements' => 'Currently pursuing or recently completed Computer Science degree\nBasic programming knowledge\nEagerness to learn\nGood communication skills\nPortfolio of personal projects',
        'location' => 'Dhaka',
        'category' => 'it',
        'experience_level' => 'entry',
        'job_type' => 'internship',
        'salary_min' => 15000,
        'salary_max' => 25000,
        'status' => 'active'
    ],
    [
        'title' => 'Digital Marketing Specialist',
        'description' => 'Develop and execute digital marketing campaigns across various channels including social media, email, and paid advertising.',
        'requirements' => '3+ years of digital marketing experience\nSocial media marketing expertise\nGoogle Ads and Facebook Ads experience\nAnalytics skills\nCreative thinking',
        'location' => 'Chittagong',
        'category' => 'marketing',
        'experience_level' => 'mid',
        'job_type' => 'full-time',
        'salary_min' => 40000,
        'salary_max' => 60000,
        'status' => 'active'
    ],
    [
        'title' => 'Financial Analyst',
        'description' => 'Analyze financial data, prepare reports, and provide recommendations for business decisions. Monitor financial performance.',
        'requirements' => '3+ years of financial analysis experience\nStrong analytical skills\nProficiency in Excel and financial software\nAttention to detail\nBachelor\'s degree in Finance or Accounting',
        'location' => 'Dhaka',
        'category' => 'finance',
        'experience_level' => 'mid',
        'job_type' => 'full-time',
        'salary_min' => 50000,
        'salary_max' => 75000,
        'status' => 'active'
    ],
    [
        'title' => 'DevOps Engineer',
        'description' => 'Manage infrastructure, automate deployments, and ensure system reliability. Work with cloud platforms and CI/CD pipelines.',
        'requirements' => '4+ years of DevOps experience\nKnowledge of AWS, Azure, or GCP\nDocker and Kubernetes experience\nCI/CD pipeline setup\nScripting skills (Bash, Python)',
        'location' => 'Dhaka',
        'category' => 'it',
        'experience_level' => 'senior',
        'job_type' => 'full-time',
        'salary_min' => 90000,
        'salary_max' => 130000,
        'status' => 'active'
    ],
    [
        'title' => 'Business Development Executive',
        'description' => 'Identify new business opportunities, build partnerships, and expand market presence. Develop strategic relationships.',
        'requirements' => '2+ years of business development experience\nStrong networking skills\nNegotiation abilities\nMarket research skills\nExcellent communication',
        'location' => 'Dhaka',
        'category' => 'sales',
        'experience_level' => 'mid',
        'job_type' => 'full-time',
        'salary_min' => 35000,
        'salary_max' => 55000,
        'status' => 'active'
    ],
    [
        'title' => 'Quality Assurance Engineer',
        'description' => 'Test software applications to ensure quality and functionality. Write test cases and perform manual and automated testing.',
        'requirements' => '2+ years of QA experience\nTesting methodologies knowledge\nBug tracking experience\nAttention to detail\nBasic programming knowledge',
        'location' => 'Dhaka',
        'category' => 'it',
        'experience_level' => 'mid',
        'job_type' => 'full-time',
        'salary_min' => 40000,
        'salary_max' => 60000,
        'status' => 'active'
    ],
    [
        'title' => 'Social Media Manager',
        'description' => 'Manage social media accounts, create content, and engage with audiences. Develop social media strategies and campaigns.',
        'requirements' => '2+ years of social media management\nContent creation skills\nAnalytics knowledge\nCreative thinking\nExcellent writing skills',
        'location' => 'Dhaka',
        'category' => 'marketing',
        'experience_level' => 'mid',
        'job_type' => 'full-time',
        'salary_min' => 35000,
        'salary_max' => 50000,
        'status' => 'active'
    ]
];

// Insert jobs
$successCount = 0;
$errorCount = 0;
$errors = [];

echo "<h2>Inserting Jobs...</h2>";
echo "<table>";
echo "<tr><th>#</th><th>Job Title</th><th>Location</th><th>Status</th></tr>";

foreach ($sampleJobs as $index => $job) {
    $title = mysqli_real_escape_string($con, $job['title']);
    $company = mysqli_real_escape_string($con, $companyName);
    $description = mysqli_real_escape_string($con, $job['description']);
    $requirements = mysqli_real_escape_string($con, $job['requirements']);
    $location = mysqli_real_escape_string($con, $job['location']);
    $category = mysqli_real_escape_string($con, $job['category']);
    $experienceLevel = mysqli_real_escape_string($con, $job['experience_level']);
    $jobType = mysqli_real_escape_string($con, $job['job_type']);
    $salaryMin = $job['salary_min'];
    $salaryMax = $job['salary_max'];
    $status = mysqli_real_escape_string($con, $job['status']);
    
    // Calculate deadline (30 days from now)
    $deadline = date('Y-m-d', strtotime('+30 days'));
    
    $sql = "INSERT INTO jobs 
            (employer_id, title, company, description, requirements, location, category, 
             experience_level, job_type, salary_min, salary_max, status, deadline)
            VALUES 
            ($employerId, '$title', '$company', '$description', '$requirements', '$location', '$category',
             '$experienceLevel', '$jobType', $salaryMin, $salaryMax, '$status', '$deadline')";
    
    if (mysqli_query($con, $sql)) {
        $successCount++;
        $jobId = mysqli_insert_id($con);
        echo "<tr style='background: #d4edda;'>";
        echo "<td>" . ($index + 1) . "</td>";
        echo "<td><strong>$title</strong></td>";
        echo "<td>$location</td>";
        echo "<td style='color: green;'>✓ Inserted (ID: $jobId)</td>";
        echo "</tr>";
    } else {
        $errorCount++;
        $errors[] = "Job #" . ($index + 1) . " ($title): " . mysqli_error($con);
        echo "<tr style='background: #f8d7da;'>";
        echo "<td>" . ($index + 1) . "</td>";
        echo "<td><strong>$title</strong></td>";
        echo "<td>$location</td>";
        echo "<td style='color: red;'>✗ Error</td>";
        echo "</tr>";
    }
}

echo "</table>";

// Summary
echo "<div class='info'>";
echo "<h2>Summary</h2>";
echo "<p><strong>Total Jobs:</strong> " . count($sampleJobs) . "</p>";
echo "<p style='color: green;'><strong>Successfully Inserted:</strong> $successCount</p>";
if ($errorCount > 0) {
    echo "<p style='color: red;'><strong>Errors:</strong> $errorCount</p>";
    echo "<h3>Error Details:</h3>";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li style='color: red;'>$error</li>";
    }
    echo "</ul>";
}
echo "</div>";

// Show all jobs in database
$totalJobsQuery = "SELECT COUNT(*) as total FROM jobs WHERE employer_id = $employerId";
$totalResult = mysqli_query($con, $totalJobsQuery);
$total = mysqli_fetch_assoc($totalResult);

echo "<div class='success'>";
echo "<h2>Database Status</h2>";
echo "<p><strong>Total Jobs in Database for {$companyName}:</strong> {$total['total']}</p>";
echo "</div>";

mysqli_close($con);
echo "</body></html>";
?>

