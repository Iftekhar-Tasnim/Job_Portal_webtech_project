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
            let content = this.dataset.content;
            
            // Fix escaped newlines - HTML data attributes escape \n as \\n
            // First decode HTML entities, then handle escaped newlines
            content = content.replace(/\\n/g, '\n');
            content = content.replace(/\\r/g, '');
            
            // Format content with proper line breaks and lists
            let formattedContent = formatContent(content);
            
            // Update modal content
            modalTitle.textContent = title;
            modalDate.innerHTML = `<i class="far fa-calendar"></i> ${date}`;
            modalContent.innerHTML = formattedContent;
            
            // Show modal
            modal.style.display = 'flex';
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });

    // Close modal functions
    function closeModalFunc() {
        if (modal) {
            modal.classList.remove('active');
            modal.style.display = 'none';
            document.body.style.overflow = '';
        }
    }

    if (closeModal) {
        closeModal.addEventListener('click', closeModalFunc);
    }

    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', closeModalFunc);
    }

    // Close modal when clicking outside
    if (modal) {
        modal.addEventListener('click', function(e) {
            // Only close if clicking the backdrop (modal itself), not the content
            if (e.target === modal) {
                closeModalFunc();
            }
        });
    }

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal && (modal.classList.contains('active') || modal.style.display === 'flex')) {
            closeModalFunc();
        }
    });

    // Format content helper function
    function formatContent(content) {
        if (!content) return '';
        
        // First, handle escaped newlines - HTML data attributes may escape them
        // Try multiple patterns to catch all variations
        content = content.replace(/\\n/g, '\n');
        content = content.replace(/\\r\\n/g, '\n');
        content = content.replace(/\\r/g, '\n');
        
        // Split by double newlines (paragraph breaks)
        // Use regex to handle various whitespace combinations
        let paragraphs = content.split(/\n\s*\n+/);
        let formatted = '';
        
        paragraphs.forEach((paragraph, index) => {
            paragraph = paragraph.trim();
            if (!paragraph) return;
            
            // Check if it's a markdown header (##)
            if (paragraph.startsWith('## ')) {
                let headerText = paragraph.replace(/^##\s+/, '').trim();
                // Add extra top margin for first header
                let marginTop = index === 0 ? '12px' : '24px';
                formatted += `<h3 style="font-size: 1.25rem; font-weight: 700; color: var(--text-primary); margin-top: ${marginTop}; margin-bottom: 12px; line-height: 1.4;">${escapeHtml(headerText)}</h3>`;
            }
            // Check if it's a list (contains lines starting with -)
            else if (paragraph.includes('\n-') || /^-\s+/.test(paragraph)) {
                // It's a list - split by newlines and filter
                let lines = paragraph.split('\n');
                let listItems = [];
                let currentItem = '';
                
                lines.forEach(line => {
                    line = line.trim();
                    if (!line) return;
                    
                    // If line starts with -, it's a new list item
                    if (/^-\s+/.test(line)) {
                        if (currentItem) {
                            listItems.push(currentItem);
                        }
                        currentItem = line.replace(/^-\s+/, '').trim();
                    } else {
                        // Continuation of previous item
                        if (currentItem) {
                            currentItem += ' ' + line;
                        } else {
                            currentItem = line;
                        }
                    }
                });
                
                if (currentItem) {
                    listItems.push(currentItem);
                }
                
                if (listItems.length > 0) {
                    formatted += '<ul style="margin: 16px 0 20px 0; padding-left: 24px; list-style-type: disc;">';
                    listItems.forEach(item => {
                        if (item.trim()) {
                            formatted += `<li style="margin-bottom: 10px; line-height: 1.7; color: var(--text-secondary);">${escapeHtml(item)}</li>`;
                        }
                    });
                    formatted += '</ul>';
                }
            } else {
                // Regular paragraph
                // Split by single newlines and join with <br>
                let lines = paragraph.split('\n').map(line => line.trim()).filter(line => line);
                if (lines.length > 0) {
                    let formattedParagraph = lines.join('<br>');
                    formatted += `<p style="margin-bottom: 18px; line-height: 1.8; color: var(--text-secondary);">${escapeHtml(formattedParagraph)}</p>`;
                }
            }
        });
        
        // If no formatting was applied, do a simple conversion
        if (!formatted) {
            formatted = `<p style="margin-bottom: 18px; line-height: 1.8; color: var(--text-secondary);">${escapeHtml(content.replace(/\n/g, '<br>'))}</p>`;
        }
        
        return formatted;
    }
    
    // Helper function to escape HTML
    function escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
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
