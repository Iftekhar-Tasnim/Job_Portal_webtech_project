// Simple Notification Popup System

(function() {
    'use strict';

    // Create notification container if it doesn't exist
    let notificationContainer = document.getElementById('notification-container');
    if (!notificationContainer) {
        notificationContainer = document.createElement('div');
        notificationContainer.id = 'notification-container';
        document.body.appendChild(notificationContainer);
    }

    /**
     * Add notification to dropdown panel
     */
    function addToNotificationPanel(message, type = 'info') {
        const notificationList = document.getElementById('notificationList');
        const notificationBadge = document.getElementById('notificationBadge');
        
        if (!notificationList) return;
        
        // Remove empty state if exists
        const emptyState = notificationList.querySelector('.notification-empty');
        if (emptyState) {
            emptyState.remove();
        }
        
        // Create notification item
        const notificationItem = document.createElement('div');
        notificationItem.className = 'notification-item unread';
        
        const titles = {
            success: 'Success',
            error: 'Error',
            info: 'Information',
            warning: 'Warning'
        };
        
        const timeAgo = 'Just now';
        
        notificationItem.innerHTML = `
            <div class="notification-item-title">${titles[type] || titles.info}</div>
            <div class="notification-item-message">${message}</div>
            <div class="notification-item-time">${timeAgo}</div>
        `;
        
        // Add click handler to mark as read
        notificationItem.addEventListener('click', function() {
            this.classList.remove('unread');
            updateNotificationBadge();
        });
        
        // Insert at the top
        notificationList.insertBefore(notificationItem, notificationList.firstChild);
        
        // Update badge
        updateNotificationBadge();
    }
    
    /**
     * Update notification badge count
     */
    function updateNotificationBadge() {
        const notificationList = document.getElementById('notificationList');
        const notificationBadge = document.getElementById('notificationBadge');
        
        if (!notificationList || !notificationBadge) return;
        
        const unreadCount = notificationList.querySelectorAll('.notification-item.unread').length;
        
        if (unreadCount > 0) {
            notificationBadge.textContent = unreadCount > 99 ? '99+' : unreadCount;
            notificationBadge.style.display = 'flex';
        } else {
            notificationBadge.style.display = 'none';
        }
    }
    
    /**
     * Show a notification popup
     * @param {string} message - The notification message
     * @param {string} type - Type of notification: 'success', 'error', 'info', 'warning'
     * @param {number} duration - Duration in milliseconds (0 = no auto-close)
     */
    function showNotification(message, type = 'info', duration = 3000) {
        // Remove existing notifications
        const existingNotifications = notificationContainer.querySelectorAll('.notification-popup');
        existingNotifications.forEach(notif => {
            notif.classList.add('hide');
            setTimeout(() => notif.remove(), 300);
        });

        // Create notification element
        const notification = document.createElement('div');
        notification.className = `notification-popup ${type}`;

        // Set icons based on type
        const icons = {
            success: '<i class="fas fa-check-circle"></i>',
            error: '<i class="fas fa-exclamation-circle"></i>',
            info: '<i class="fas fa-info-circle"></i>',
            warning: '<i class="fas fa-exclamation-triangle"></i>'
        };

        const titles = {
            success: 'Success',
            error: 'Error',
            info: 'Information',
            warning: 'Warning'
        };

        notification.innerHTML = `
            <div class="notification-header">
                <h4 class="notification-title">
                    ${icons[type] || icons.info}
                    ${titles[type] || titles.info}
                </h4>
                <button class="notification-close" onclick="this.parentElement.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <p class="notification-message">${message}</p>
        `;

        // Add to container
        notificationContainer.appendChild(notification);

        // Show notification
        setTimeout(() => {
            notification.classList.add('show');
        }, 10);

        // Also add to notification panel
        addToNotificationPanel(message, type);

        // Auto-close if duration is set
        if (duration > 0) {
            setTimeout(() => {
                notification.classList.add('hide');
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 300);
            }, duration);
        }
    }

    // Make it globally available
    window.showNotification = showNotification;

    // Convenience functions
    window.showSuccess = function(message, duration) {
        showNotification(message, 'success', duration);
    };

    window.showError = function(message, duration) {
        showNotification(message, 'error', duration);
    };

    window.showInfo = function(message, duration) {
        showNotification(message, 'info', duration);
    };

    window.showWarning = function(message, duration) {
        showNotification(message, 'warning', duration);
    };

    console.log('Notification system loaded');
})();

