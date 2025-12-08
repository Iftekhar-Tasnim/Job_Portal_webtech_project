# Notification Popup System

A simple, lightweight notification popup system for displaying messages to users.

## Setup

Add these files to your page:

```html
<!-- In <head> -->
<link rel="stylesheet" href="../assets/css/notification.css">

<!-- Before </body> -->
<script src="../assets/js/notification.js"></script>
```

## Usage

### Basic Usage

```javascript
// Show a simple info notification
showNotification('This is an info message');

// Show success notification
showSuccess('Operation completed successfully!');

// Show error notification
showError('Something went wrong!');

// Show warning notification
showWarning('Please check your input.');
```

### Advanced Usage

```javascript
// Show notification with custom type and duration
showNotification('Custom message', 'info', 5000); // 5 seconds

// Show notification that doesn't auto-close
showNotification('Important message', 'warning', 0);
```

### Available Functions

- `showNotification(message, type, duration)` - Main function
  - `message`: The notification text
  - `type`: 'success', 'error', 'info', 'warning' (default: 'info')
  - `duration`: Auto-close time in milliseconds (default: 3000ms, 0 = no auto-close)

- `showSuccess(message, duration)` - Success notification
- `showError(message, duration)` - Error notification
- `showInfo(message, duration)` - Info notification
- `showWarning(message, duration)` - Warning notification

## Examples

```javascript
// After form submission
showSuccess('Your application has been submitted!');

// On error
showError('Failed to save. Please try again.');

// Info message
showInfo('New jobs matching your criteria are available.');

// Warning
showWarning('Your session will expire in 5 minutes.');
```

## Styling

The notification appears in the top-right corner and automatically closes after the specified duration. Users can also manually close it by clicking the X button.

