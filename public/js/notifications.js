// is moved to the vue component
function markNotificationAsRead(notificationCount) {
    if (notificationCount !== 0) {
        $.get('/remsonrails/public/markAsRead');
    }
}
