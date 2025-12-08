<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Resources - Employify</title>
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/career-resources.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Hero Section -->
    <section class="resources-hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="hero-text">
                <span class="hero-tag">Career Resources</span>
                <h1 class="hero-title">Grow Your Career with <span class="title-highlight">Expert Guidance</span></h1>
                <p class="hero-subtitle">Access comprehensive guides, tips, and insights to advance your career and land your dream job.</p>
            </div>
            <div class="hero-search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="resourceSearch" placeholder="Search resources, topics, or keywords...">
                <button class="search-btn"><i class="fas fa-arrow-right"></i></button>
            </div>
        </div>
        <div class="hero-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
    </section>

    <main class="main-content">
        <div class="container">
            <!-- Category Filters -->
            <div class="category-filters">
                <button class="category-btn active" data-category="all">
                    <i class="fas fa-th"></i>
                    <span>All Resources</span>
                </button>
                <button class="category-btn" data-category="resume">
                    <i class="fas fa-file-alt"></i>
                    <span>Resume Tips</span>
                </button>
                <button class="category-btn" data-category="interview">
                    <i class="fas fa-comments"></i>
                    <span>Interview Prep</span>
                </button>
                <button class="category-btn" data-category="skills">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Skills Development</span>
                </button>
                <button class="category-btn" data-category="networking">
                    <i class="fas fa-users"></i>
                    <span>Networking</span>
                </button>
                <button class="category-btn" data-category="salary">
                    <i class="fas fa-dollar-sign"></i>
                    <span>Salary & Negotiation</span>
                </button>
                <button class="category-btn" data-category="remote">
                    <i class="fas fa-laptop"></i>
                    <span>Remote Work</span>
                </button>
            </div>

            <!-- Resources Grid -->
            <div class="resources-grid" id="resourcesGrid">
                <!-- Resource Card 1 -->
                <article class="resource-card" data-category="resume">
                    <div class="card-header">
                        <div class="card-icon resume-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <span class="card-category">Resume Tips</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">How to Craft a Winning Resume in 2025</h3>
                        <p class="card-date"><i class="far fa-calendar"></i> May 5, 2025</p>
                        <p class="card-excerpt">Learn the essential tips for creating a modern, effective resume that will stand out to recruiters in today's competitive job market.</p>
                        <ul class="card-topics">
                            <li><i class="fas fa-check-circle"></i> Format Selection</li>
                            <li><i class="fas fa-check-circle"></i> Keyword Optimization</li>
                            <li><i class="fas fa-check-circle"></i> Visual Design</li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <button class="read-more-btn" data-title="How to Craft a Winning Resume in 2025" data-date="May 5, 2025" data-content="A well-crafted resume is your ticket to landing your dream job. In today's competitive job market, your resume needs to stand out from hundreds of other applicants. This comprehensive guide will walk you through every step of creating a resume that gets you noticed.\n\n## Choosing the Right Resume Format\n\nThere are three main resume formats: chronological, functional, and combination. The chronological format lists your work history in reverse order and is best for those with steady career progression. The functional format emphasizes skills over work history, ideal for career changers or those with employment gaps. The combination format blends both approaches.\n\n## Writing Compelling Bullet Points\n\nYour bullet points should follow the CAR method: Context, Action, Result. Start with the situation, describe what you did, and highlight the outcome. Use strong action verbs like 'achieved,' 'implemented,' 'developed,' or 'managed.' Quantify your achievements whenever possible - numbers make your impact tangible.\n\n## Highlighting Relevant Experience\n\nTailor your resume for each job application. Review the job description carefully and mirror the language used. If the job requires 'project management,' ensure your resume includes relevant project management experience. Prioritize experiences that directly relate to the position you're applying for.\n\n## Using Keywords Effectively\n\nMany companies use Applicant Tracking Systems (ATS) to screen resumes. Research industry-specific keywords and naturally incorporate them throughout your resume. Include technical skills, software proficiency, certifications, and industry terminology relevant to your field.\n\n## Formatting Tips for Visual Appeal\n\nKeep your resume clean and professional. Use consistent fonts (Arial, Calibri, or Times New Roman), maintain 1-inch margins, and ensure proper spacing. Use bold for section headers and your name. Limit your resume to one or two pages, depending on your experience level.\n\n## Common Mistakes to Avoid\n\n- Typos and grammatical errors (always proofread multiple times)\n- Including irrelevant personal information\n- Using an unprofessional email address\n- Making your resume too long or too short\n- Using outdated formats or designs\n- Failing to customize for each application\n\n## Tailoring Your Resume for Different Industries\n\nEach industry has its own expectations. Tech roles may prioritize technical skills and projects. Sales positions emphasize achievements and metrics. Creative fields value portfolios and design skills. Research your target industry and adjust your resume accordingly.\n\nRemember, your resume is a marketing document that sells your value to potential employers. Make every word count!">
                            <span>Read Article</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </article>

                <!-- Resource Card 2 -->
                <article class="resource-card" data-category="interview">
                    <div class="card-header">
                        <div class="card-icon interview-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <span class="card-category">Interview Prep</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">The Ultimate Guide to Job Interview Success</h3>
                        <p class="card-date"><i class="far fa-calendar"></i> May 4, 2025</p>
                        <p class="card-excerpt">Discover proven strategies for acing your next job interview, from preparation to follow-up, with real-world examples and expert advice.</p>
                        <ul class="card-topics">
                            <li><i class="fas fa-check-circle"></i> Preparation Tips</li>
                            <li><i class="fas fa-check-circle"></i> Common Questions</li>
                            <li><i class="fas fa-check-circle"></i> Follow-up Strategies</li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <button class="read-more-btn" data-title="The Ultimate Guide to Job Interview Success" data-date="May 4, 2025" data-content="Job interviews can be nerve-wracking, but with proper preparation, you can turn them into opportunities to shine. This comprehensive guide covers everything from pre-interview research to post-interview follow-up.\n\n## Pre-Interview Preparation\n\nResearch the company thoroughly. Understand their mission, values, recent news, products, and services. Review the job description and identify how your skills match their requirements. Prepare specific examples from your experience that demonstrate these skills.\n\n## Common Interview Questions and How to Answer Them\n\n'Tell me about yourself': Start with your current role, highlight relevant experience, and connect it to why you're interested in this position. Keep it concise (2-3 minutes).\n\n'Why do you want to work here?': Show genuine interest by mentioning specific aspects of the company that appeal to you. Connect your career goals with their mission.\n\n'What are your weaknesses?': Choose a real weakness, explain how you're working to improve it, and provide examples of your progress. Never say you don't have any weaknesses.\n\n'Where do you see yourself in 5 years?': Align your answer with the company's growth trajectory. Show ambition but also commitment to the role you're applying for.\n\n## Behavioral Interview Questions\n\nUse the STAR method (Situation, Task, Action, Result) to structure your answers. Prepare 5-7 stories that demonstrate different competencies like leadership, problem-solving, teamwork, and adaptability.\n\n## Questions to Ask the Interviewer\n\nAsking thoughtful questions shows genuine interest. Ask about team dynamics, growth opportunities, company culture, challenges the team faces, or what success looks like in this role. Avoid questions about salary, benefits, or vacation time in the first interview.\n\n## Body Language and Presentation\n\nDress professionally, arrive 10-15 minutes early, maintain eye contact, offer a firm handshake, and sit up straight. Show enthusiasm through your tone and facial expressions. Remember, first impressions matter.\n\n## Handling Difficult Questions\n\nIf asked about employment gaps, be honest and focus on what you learned during that time. If asked why you left a previous job, stay positive and focus on growth opportunities rather than criticizing former employers.\n\n## Post-Interview Follow-Up\n\nSend a thank-you email within 24 hours. Personalize it by mentioning specific points from your conversation. This demonstrates professionalism and keeps you top-of-mind with the interviewer.\n\nRemember, interviews are two-way conversations. You're also evaluating if the company is the right fit for you. Stay confident, be authentic, and let your passion for the role shine through!">
                            <span>Read Article</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </article>

                <!-- Resource Card 3 -->
                <article class="resource-card" data-category="skills">
                    <div class="card-header">
                        <div class="card-icon skills-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <span class="card-category">Skills Development</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Top 10 Skills Employers Look for in 2025</h3>
                        <p class="card-date"><i class="far fa-calendar"></i> May 3, 2025</p>
                        <p class="card-excerpt">Stay ahead in your career by developing these critical skills that are in high demand across industries in the current job market.</p>
                        <ul class="card-topics">
                            <li><i class="fas fa-check-circle"></i> Technical Skills</li>
                            <li><i class="fas fa-check-circle"></i> Soft Skills</li>
                            <li><i class="fas fa-check-circle"></i> Industry Trends</li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <button class="read-more-btn" data-title="Top 10 Skills Employers Look for in 2025" data-date="May 3, 2025" data-content="The job market is constantly evolving, and so are the skills employers value most. Here are the top 10 skills that will make you stand out in 2025:\n\n## 1. Digital Literacy and Tech Savviness\n\nIn our increasingly digital world, basic tech skills are no longer optional. Employers expect proficiency in common software, cloud platforms, and digital communication tools. Familiarize yourself with collaboration tools like Slack, Microsoft Teams, and project management software.\n\n## 2. Communication Skills\n\nBoth written and verbal communication remain critical. This includes clear email writing, effective presentation skills, active listening, and the ability to explain complex ideas simply. Practice writing concisely and speaking confidently.\n\n## 3. Critical Thinking and Problem-Solving\n\nEmployers value employees who can analyze situations, identify problems, and develop effective solutions. Practice breaking down complex problems, considering multiple perspectives, and thinking creatively.\n\n## 4. Adaptability and Flexibility\n\nThe ability to adapt to change is crucial in today's fast-paced work environment. Show that you can learn new skills quickly, handle uncertainty, and pivot when needed. Embrace change rather than resist it.\n\n## 5. Emotional Intelligence (EQ)\n\nUnderstanding and managing your emotions, as well as recognizing others' emotions, leads to better workplace relationships. Develop self-awareness, empathy, and the ability to work well with diverse teams.\n\n## 6. Data Analysis and Interpretation\n\nData-driven decision making is essential across industries. Learn to work with spreadsheets, understand basic statistics, and interpret data to make informed decisions. Even non-technical roles benefit from data literacy.\n\n## 7. Leadership and Teamwork\n\nWhether you're leading a team or collaborating as a member, strong interpersonal skills are vital. Practice delegating, motivating others, resolving conflicts, and contributing effectively to group projects.\n\n## 8. Creativity and Innovation\n\nCompanies need employees who can think outside the box and propose new ideas. Cultivate creativity by exploring different perspectives, asking 'what if' questions, and being open to experimentation.\n\n## 9. Time Management and Organization\n\nWith multiple priorities and deadlines, strong organizational skills are essential. Learn to prioritize tasks, use productivity tools, set realistic goals, and manage your time effectively.\n\n## 10. Continuous Learning Mindset\n\nThe willingness to learn and grow is perhaps the most important skill. Stay curious, seek feedback, take online courses, attend workshops, and stay updated with industry trends.\n\n## How to Develop These Skills\n\n- Take online courses (Coursera, Udemy, LinkedIn Learning)\n- Seek feedback from colleagues and mentors\n- Practice in your current role or volunteer work\n- Join professional associations and networking groups\n- Read industry publications and books\n- Find a mentor in your field\n\n## Showcasing Your Skills\n\nUpdate your resume and LinkedIn profile regularly. Use specific examples in interviews. Create a portfolio showcasing your work. Seek certifications that validate your skills. Remember, skills are only valuable if employers know you have them!">
                            <span>Read Article</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </article>

                <!-- Resource Card 4 -->
                <article class="resource-card" data-category="networking">
                    <div class="card-header">
                        <div class="card-icon networking-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <span class="card-category">Networking</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Networking 101: Building Professional Connections</h3>
                        <p class="card-date"><i class="far fa-calendar"></i> May 2, 2025</p>
                        <p class="card-excerpt">Learn effective networking strategies to expand your professional network and open up new career opportunities.</p>
                        <ul class="card-topics">
                            <li><i class="fas fa-check-circle"></i> Industry Events</li>
                            <li><i class="fas fa-check-circle"></i> Online Platforms</li>
                            <li><i class="fas fa-check-circle"></i> Relationship Building</li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <button class="read-more-btn" data-title="Networking 101: Building Professional Connections" data-date="May 2, 2025" data-content="Networking isn't about collecting business cards or adding LinkedIn connections. It's about building genuine, mutually beneficial relationships that can advance your career. Here's how to network effectively:\n\n## Why Networking Matters\n\nStudies show that 70-85% of jobs are filled through networking. Many opportunities never get posted publicly. Your network can provide referrals, industry insights, mentorship, and support throughout your career journey.\n\n## Building Your Online Presence\n\nLinkedIn is your professional digital identity. Keep your profile updated with a professional photo, compelling headline, detailed experience, and recommendations. Engage with content by commenting thoughtfully and sharing valuable insights. Join relevant groups and participate in discussions.\n\n## Attending Industry Events\n\nConferences, workshops, and meetups are excellent networking opportunities. Before attending, research speakers and attendees. Prepare a 30-second elevator pitch about who you are and what you do. Bring business cards, but focus on quality conversations over quantity.\n\n## The Art of Conversation\n\nStart with open-ended questions like 'What brings you to this event?' or 'What projects are you working on?' Listen actively and show genuine interest. Share your own experiences when relevant, but avoid dominating the conversation. Remember names and follow up afterward.\n\n## Building Genuine Relationships\n\nNetworking is a long-term investment. Don't only reach out when you need something. Share articles, congratulate on achievements, and offer help when you can. Building trust takes time, but it leads to stronger, more valuable connections.\n\n## Informational Interviews\n\nRequest informational interviews with professionals in your target field. These are low-pressure opportunities to learn about careers, companies, and industries. Come prepared with thoughtful questions and respect their time.\n\n## Following Up Effectively\n\nWithin 24-48 hours of meeting someone, send a personalized message. Reference something specific from your conversation. Connect on LinkedIn with a personalized note. If you promised to share something, do it promptly.\n\n## Maintaining Your Network\n\nRegularly check in with your network. Send holiday greetings, congratulate on promotions, share relevant opportunities, and celebrate their successes. A strong network requires ongoing maintenance.\n\n## Networking Etiquette\n\n- Be authentic and genuine\n- Give more than you take\n- Respect people's time and boundaries\n- Follow through on commitments\n- Be patient - relationships develop over time\n- Don't be pushy or overly salesy\n\n## Overcoming Networking Anxiety\n\nIf networking feels uncomfortable, start small. Attend smaller events, practice your introduction, set realistic goals (like talking to 3 people), and remember that most people feel the same way. Focus on being helpful rather than impressive.\n\nRemember, networking is about building relationships, not just collecting contacts. Quality over quantity always wins!">
                            <span>Read Article</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </article>

                <!-- Resource Card 5 -->
                <article class="resource-card" data-category="salary">
                    <div class="card-header">
                        <div class="card-icon salary-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <span class="card-category">Salary & Negotiation</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Salary Negotiation Tips for New Graduates</h3>
                        <p class="card-date"><i class="far fa-calendar"></i> May 1, 2025</p>
                        <p class="card-excerpt">Get expert advice on how to approach salary negotiations as a new graduate, with practical tips and real-world examples.</p>
                        <ul class="card-topics">
                            <li><i class="fas fa-check-circle"></i> Market Research</li>
                            <li><i class="fas fa-check-circle"></i> Negotiation Tactics</li>
                            <li><i class="fas fa-check-circle"></i> Fair Agreements</li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <button class="read-more-btn" data-title="Salary Negotiation Tips for New Graduates" data-date="May 1, 2025" data-content="Salary negotiation can be intimidating, especially for new graduates. However, negotiating your starting salary can significantly impact your lifetime earnings. Here's how to approach it confidently:\n\n## Why Negotiate?\n\nA $5,000 difference in starting salary can compound to hundreds of thousands over your career. Most employers expect some negotiation and have budgeted for it. You have the most leverage before accepting an offer.\n\n## Research Market Rates\n\nUse salary websites like Glassdoor, PayScale, and LinkedIn Salary to research typical salaries for your role, location, and experience level. Consider factors like company size, industry, and cost of living. Talk to professionals in your network for insider information.\n\n## Know Your Value\n\nIdentify what makes you valuable: relevant internships, projects, certifications, leadership experience, or unique skills. Prepare specific examples of your achievements and how they benefit the employer. Confidence in your worth is key to successful negotiation.\n\n## Timing is Everything\n\nWait until you receive a formal offer before negotiating. Express enthusiasm about the role first, then discuss compensation. Never negotiate during the initial interview unless the employer brings it up.\n\n## The Negotiation Conversation\n\nStart by thanking them for the offer and expressing excitement. Then say, 'I was hoping we could discuss the compensation package.' Present your research and make a specific counteroffer (typically 10-20% above their initial offer). Justify your request with your value proposition.\n\n## Consider the Full Package\n\nSalary is just one component. Consider benefits like health insurance, retirement contributions, vacation time, professional development budget, flexible work arrangements, and stock options. Sometimes a lower salary with better benefits is worth more.\n\n## Common Negotiation Mistakes\n\n- Accepting the first offer immediately\n- Not doing research beforehand\n- Being too aggressive or demanding\n- Focusing only on salary, ignoring benefits\n- Not getting the offer in writing\n- Burning bridges if negotiation fails\n\n## Handling Objections\n\nIf they say the budget is fixed, ask about other benefits or a review timeline. If they say you lack experience, emphasize your potential and unique contributions. Stay professional and collaborative, not confrontational.\n\n## When to Walk Away\n\nIf the offer is significantly below market rate and they're unwilling to negotiate, it might indicate larger issues with the company. Trust your research and know your minimum acceptable offer.\n\n## Getting It in Writing\n\nOnce you reach an agreement, request a written offer letter that includes salary, benefits, start date, and any other negotiated terms. Review it carefully before accepting.\n\n## Practice Makes Perfect\n\nPractice your negotiation conversation with a friend or mentor. Prepare responses to common objections. The more you practice, the more confident you'll feel.\n\nRemember, negotiation is a normal part of the hiring process. Most employers respect candidates who negotiate professionally. You have nothing to lose and potentially thousands to gain!">
                            <span>Read Article</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </article>

                <!-- Resource Card 6 -->
                <article class="resource-card" data-category="remote">
                    <div class="card-header">
                        <div class="card-icon remote-icon">
                            <i class="fas fa-laptop"></i>
                        </div>
                        <span class="card-category">Remote Work</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Remote Work Survival Guide: Thriving in a Virtual Workplace</h3>
                        <p class="card-date"><i class="far fa-calendar"></i> April 30, 2025</p>
                        <p class="card-excerpt">Discover essential tips for succeeding in a remote work environment, from time management to maintaining work-life balance.</p>
                        <ul class="card-topics">
                            <li><i class="fas fa-check-circle"></i> Time Management</li>
                            <li><i class="fas fa-check-circle"></i> Communication</li>
                            <li><i class="fas fa-check-circle"></i> Work-Life Balance</li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <button class="read-more-btn" data-title="Remote Work Survival Guide: Thriving in a Virtual Workplace" data-date="April 30, 2025" data-content="Remote work has become the new normal for many professionals. While it offers flexibility and freedom, it also presents unique challenges. Here's how to thrive in a virtual workplace:\n\n## Setting Up Your Workspace\n\nCreate a dedicated workspace that signals 'work mode' to your brain. Invest in a comfortable chair, proper lighting, and a reliable internet connection. Keep your workspace organized and free from distractions. If possible, separate your work area from your living space.\n\n## Establishing a Routine\n\nMaintain regular work hours, even if your company is flexible. Wake up at the same time, get dressed (even if it's just business casual), and follow a morning routine. Set clear boundaries between work and personal time. End your day with a ritual that signals work is done.\n\n## Time Management Strategies\n\nUse time-blocking to schedule your day. Prioritize tasks using the Eisenhower Matrix (urgent vs. important). Take regular breaks using the Pomodoro Technique (25 minutes work, 5 minutes break). Avoid multitasking - focus on one task at a time.\n\n## Communication Best Practices\n\nOver-communicate rather than under-communicate. Update your team on your progress, availability, and any blockers. Use video calls for important discussions to maintain connection. Respond to messages promptly during work hours. Set clear expectations about response times.\n\n## Staying Visible and Connected\n\nParticipate actively in team meetings and virtual events. Schedule regular one-on-ones with your manager and colleagues. Join virtual coffee chats or team building activities. Share updates about your work and celebrate team wins.\n\n## Managing Distractions\n\nIdentify your biggest distractions and create strategies to minimize them. Use website blockers during focused work time. Communicate your 'do not disturb' hours to family or roommates. Turn off non-essential notifications. Consider noise-canceling headphones.\n\n## Maintaining Work-Life Balance\n\nSet clear boundaries - when work ends, it ends. Don't check emails after hours unless it's an emergency. Take your full lunch break away from your desk. Use your vacation days. Create transition activities between work and personal time.\n\n## Staying Motivated and Productive\n\nSet daily and weekly goals. Celebrate small wins. Find an accountability partner. Change your environment occasionally (work from a coffee shop or different room). Take advantage of the flexibility to work during your most productive hours.\n\n## Professional Development\n\nRemote work shouldn't limit your growth. Seek virtual learning opportunities, attend online conferences, join remote work communities, and request feedback regularly. Advocate for yourself in performance reviews.\n\n## Dealing with Isolation\n\nCombat loneliness by scheduling regular social interactions. Join online communities related to your interests. Consider co-working spaces occasionally. Maintain relationships outside of work. Don't hesitate to reach out when you need support.\n\n## Technology and Tools\n\nMaster the tools your company uses (Slack, Teams, Zoom, etc.). Keep your software updated. Have backup plans for internet outages. Learn keyboard shortcuts to work more efficiently. Use project management tools to stay organized.\n\n## Health and Wellness\n\nTake breaks to stretch and move. Get outside during lunch breaks. Maintain regular exercise routines. Eat healthy meals (don't skip lunch!). Stay hydrated. Prioritize sleep - remote work doesn't mean working 24/7.\n\n## Building Trust Remotely\n\nDeliver on your commitments consistently. Be transparent about your work and challenges. Show initiative and take ownership. Be reliable and responsive. Build relationships beyond just work tasks.\n\nRemember, remote work success requires discipline, communication, and self-awareness. Find what works best for you and continuously refine your approach. The flexibility of remote work is a gift - use it wisely!">
                            <span>Read Article</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </article>
            </div>

            <!-- Empty State -->
            <div class="empty-state" id="emptyState" style="display: none;">
                <i class="fas fa-search"></i>
                <h3>No resources found</h3>
                <p>Try adjusting your search or filter criteria</p>
            </div>
        </div>
    </main>

    <!-- Resource Modal -->
    <div id="blogModal" class="modal">
        <div class="modal-content">
            <button class="close-modal" id="closeModal">
                <i class="fas fa-times"></i>
            </button>
            <div class="modal-header">
                <h2 id="modalTitle"></h2>
                <p class="modal-date" id="modalDate"></p>
            </div>
            <div class="modal-body" id="modalContent">
                <!-- Content will be loaded here -->
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" id="closeModalBtn">Close</button>
                <button class="btn btn-primary" onclick="window.print()">
                    <i class="fas fa-print"></i> Print Article
                </button>
            </div>
        </div>
    </div>
    




   
    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <script src="../assets/js/navbar.js"></script>
    <script src="../assets/js/blog-posts.js"></script>
</body>
</html>
