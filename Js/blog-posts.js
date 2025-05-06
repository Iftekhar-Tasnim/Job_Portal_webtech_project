document.addEventListener('DOMContentLoaded', () => {
    // Modal elements
    const modal = document.getElementById('blogModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalDate = document.getElementById('modalDate');
    const modalContent = document.getElementById('modalContent');
    const closeModal = document.querySelector('.close-modal');

    // Read More functionality
    const readMoreButtons = document.querySelectorAll('.read-more-btn');
    
    readMoreButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            
            // Get data from button attributes
            const title = button.dataset.title;
            const date = button.dataset.date;
            const content = button.dataset.content;
            
            // Convert newlines to <br> tags
            let formattedContent = content.split('\n').join('<br>');
            
            // Add bullet points
            formattedContent = formattedContent.replace('- ', '<br>- ');
            
            // Update modal content
            modalTitle.textContent = title;
            modalDate.textContent = date;
            modalContent.innerHTML = formattedContent;
            
            // Show modal
            modal.style.display = 'block';
        });
    });

    // Close modal when clicking the X
    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // Close modal when clicking outside
    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });
});
