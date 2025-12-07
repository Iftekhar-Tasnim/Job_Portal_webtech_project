// Career Resources Page JavaScript
// Handles modal, category filters, and search functionality

document.addEventListener('DOMContentLoaded', function() {
    // Modal elements
    const modal = document.getElementById('blogModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalDate = document.getElementById('modalDate');
    const modalContent = document.getElementById('modalContent');
    const closeModal = document.getElementById('closeModal');
    const closeModalBtn = document.getElementById('closeModalBtn');
    
    // Filter and search elements
    const categoryButtons = document.querySelectorAll('.category-btn');
    const resourceCards = document.querySelectorAll('.resource-card');
    const resourceSearch = document.getElementById('resourceSearch');
    const resourcesGrid = document.getElementById('resourcesGrid');
    const emptyState = document.getElementById('emptyState');
    
    let currentCategory = 'all';
    let searchQuery = '';

    // ============================================
    // MODAL FUNCTIONALITY
    // ============================================
    
    // Read More functionality
    const readMoreButtons = document.querySelectorAll('.read-more-btn');
    
    readMoreButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Get data from button attributes
            const title = this.dataset.title;
            const date = this.dataset.date;
            const content = this.dataset.content;
            
            // Format content with proper line breaks and lists
            let formattedContent = formatContent(content);
            
            // Update modal content
            modalTitle.textContent = title;
            modalDate.innerHTML = `<i class="far fa-calendar"></i> ${date}`;
            modalContent.innerHTML = formattedContent;
            
            // Show modal
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });

    // Close modal functions
    function closeModalFunc() {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }

    if (closeModal) {
        closeModal.addEventListener('click', closeModalFunc);
    }

    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', closeModalFunc);
    }

    // Close modal when clicking outside
    window.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModalFunc();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.classList.contains('active')) {
            closeModalFunc();
        }
    });

    // Format content helper function
    function formatContent(content) {
        // Split by double newlines for paragraphs
        let paragraphs = content.split('\n\n');
        let formatted = '';
        
        paragraphs.forEach(paragraph => {
            if (paragraph.trim()) {
                // Check if it's a list item
                if (paragraph.includes('\n- ') || paragraph.startsWith('- ')) {
                    // It's a list
                    let listItems = paragraph.split('\n').filter(item => item.trim());
                    formatted += '<ul>';
                    listItems.forEach(item => {
                        // Remove leading dash and space
                        let cleanItem = item.replace(/^-\s*/, '').trim();
                        if (cleanItem) {
                            formatted += `<li>${cleanItem}</li>`;
                        }
                    });
                    formatted += '</ul>';
                } else {
                    // Regular paragraph
                    // Replace single newlines with <br> within paragraphs
                    let formattedParagraph = paragraph.replace(/\n/g, '<br>');
                    formatted += `<p>${formattedParagraph}</p>`;
                }
            }
        });
        
        return formatted || `<p>${content.replace(/\n/g, '<br>')}</p>`;
    }

    // ============================================
    // CATEGORY FILTERING
    // ============================================
    
    categoryButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Update active state
            categoryButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Get category
            currentCategory = this.dataset.category;
            
            // Filter resources
            filterResources();
        });
    });

    // ============================================
    // SEARCH FUNCTIONALITY
    // ============================================
    
    if (resourceSearch) {
        // Search on input
        resourceSearch.addEventListener('input', function() {
            searchQuery = this.value.toLowerCase().trim();
            filterResources();
        });

        // Search button click
        const searchBtn = resourceSearch.parentElement.querySelector('.search-btn');
        if (searchBtn) {
            searchBtn.addEventListener('click', function(e) {
                e.preventDefault();
                filterResources();
            });
        }

        // Search on Enter key
        resourceSearch.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                filterResources();
            }
        });
    }

    // ============================================
    // FILTER RESOURCES FUNCTION
    // ============================================
    
    function filterResources() {
        let visibleCount = 0;
        
        resourceCards.forEach(card => {
            const cardCategory = card.dataset.category;
            const cardTitle = card.querySelector('.card-title').textContent.toLowerCase();
            const cardExcerpt = card.querySelector('.card-excerpt').textContent.toLowerCase();
            const cardCategoryText = card.querySelector('.card-category').textContent.toLowerCase();
            
            // Check category filter
            const categoryMatch = currentCategory === 'all' || cardCategory === currentCategory;
            
            // Check search query
            const searchMatch = !searchQuery || 
                cardTitle.includes(searchQuery) || 
                cardExcerpt.includes(searchQuery) ||
                cardCategoryText.includes(searchQuery);
            
            // Show/hide card
            if (categoryMatch && searchMatch) {
                card.style.display = 'flex';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
        
        // Show/hide empty state
        if (visibleCount === 0) {
            emptyState.style.display = 'block';
            resourcesGrid.style.display = 'none';
        } else {
            emptyState.style.display = 'none';
            resourcesGrid.style.display = 'grid';
        }
    }

    // ============================================
    // SMOOTH SCROLL FOR ANCHOR LINKS
    // ============================================
    
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

    console.log('Career Resources JavaScript loaded successfully');
});
