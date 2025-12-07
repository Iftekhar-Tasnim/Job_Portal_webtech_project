// Navbar JavaScript - Fixed Version
// Handles dropdown, mobile menu, and scroll effects

document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.querySelector('.navbar');
    const profileTrigger = document.getElementById('profileTrigger');
    const profileDropdown = document.getElementById('profileDropdown');
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    
    // Navbar scroll effect
    if (navbar) {
        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }
    
    // Profile dropdown toggle
    if (profileTrigger && profileDropdown) {
        profileTrigger.addEventListener('click', function(e) {
            e.stopPropagation();
            const isActive = profileDropdown.classList.contains('active');
            
            // Close all other dropdowns
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (menu !== profileDropdown) {
                    menu.classList.remove('active');
                }
            });
            
            // Toggle current dropdown
            profileDropdown.classList.toggle('active');
            
            // Update arrow rotation
            const arrow = this.querySelector('.dropdown-arrow');
            if (arrow) {
                if (profileDropdown.classList.contains('active')) {
                    arrow.style.transform = 'rotate(180deg)';
                } else {
                    arrow.style.transform = 'rotate(0deg)';
                }
            }
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (profileTrigger && profileDropdown) {
                if (!profileTrigger.contains(e.target) && !profileDropdown.contains(e.target)) {
                    profileDropdown.classList.remove('active');
                    const arrow = profileTrigger.querySelector('.dropdown-arrow');
                    if (arrow) {
                        arrow.style.transform = 'rotate(0deg)';
                    }
                }
            }
        });
    }
    
    // Mobile menu toggle
    if (mobileMenuToggle && mobileMenu) {
        mobileMenuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            this.classList.toggle('active');
            mobileMenu.classList.toggle('active');
            
            if (mobileMenu.classList.contains('active')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        });
        
        // Close mobile menu when clicking on a link
        const mobileLinks = mobileMenu.querySelectorAll('.mobile-nav-link, .mobile-btn');
        mobileLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (mobileMenuToggle) mobileMenuToggle.classList.remove('active');
                if (mobileMenu) mobileMenu.classList.remove('active');
                document.body.style.overflow = '';
            });
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            if (mobileMenuToggle && mobileMenu) {
                if (!mobileMenuToggle.contains(e.target) && !mobileMenu.contains(e.target)) {
                    mobileMenuToggle.classList.remove('active');
                    mobileMenu.classList.remove('active');
                    document.body.style.overflow = '';
                }
            }
        });
    }
    
    // Set active nav link based on current page
    try {
        const currentPage = window.location.pathname.split('/').pop() || 'home.php';
        const navLinks = document.querySelectorAll('.nav-link, .mobile-nav-link');
        
        navLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href) {
                const linkPage = href.split('/').pop();
                if (linkPage === currentPage || (currentPage === '' && linkPage === 'home.php')) {
                    link.classList.add('active');
                }
            }
        });
    } catch (e) {
        console.log('Error setting active nav links:', e);
    }
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href && href !== '#' && href.length > 1) {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    const offset = 80;
                    const targetPosition = target.offsetTop - offset;
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });
    
    console.log('Navbar JavaScript loaded successfully');
});
