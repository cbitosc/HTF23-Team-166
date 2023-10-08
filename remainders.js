// Function to send reminders as notifications
function sendReminder(title, options) {
    if ('Notification' in window && Notification.permission === 'granted') {
        // Create and display the reminder notification
        const reminderNotification = new Notification(title, options);
    }
}

// Function to schedule a reminder
function scheduleReminder() {
    // Customize the reminder content and timing here
    const reminderTitle = "Reminder";
    const reminderOptions = {
        body: "Don't forget to complete your assessment.",
        icon: "notifi.png", // Replace with the path to your app's icon
    };

    // Schedule the reminder to display after a specific time (e.g., 5 seconds)
    setTimeout(function () {
        sendReminder(reminderTitle, reminderOptions);
    }, 5000); // 5000 milliseconds (5 seconds)
}

// Call the scheduleReminder function when the page loads
window.addEventListener('load', scheduleReminder);
