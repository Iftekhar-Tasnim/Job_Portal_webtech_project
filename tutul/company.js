function showScreen(screenId) {
    document.querySelectorAll('section').forEach(screen => {
        screen.classList.remove('active');
    });
    document.getElementById(screenId).classList.add('active');

    document.querySelectorAll('aside button').forEach(button => {
        button.classList.remove('active');
    });
    document.querySelector(`button[onclick="showScreen('${screenId}')"]`).classList.add('active');
}

function submitComment(event) {
    event.preventDefault();
    const commentInput = document.getElementById('commentInput');
    const commentText = commentInput.value.trim();
    const commentsContainer = document.getElementById('commentsContainer');

    if (commentText === '') {
        alert('Please enter a comment.');
        return;
    }

    const commentArticle = document.createElement('article');
    commentArticle.className = 'comment';
    const timestamp = new Date().toLocaleString();
    commentArticle.innerHTML = `<p><strong>Anonymous, ${timestamp}</strong>: ${commentText}</p>`;

    if (commentsContainer.querySelector('p')) {
        commentsContainer.innerHTML = '';
    }

    commentsContainer.appendChild(commentArticle);
    commentInput.value = '';
}