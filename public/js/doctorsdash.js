document.querySelector('.notifications button').addEventListener('click', function() {
    const notificationModal = new bootstrap.Modal(document.getElementById('notificationModal'));
    notificationModal.show();
});

document.querySelector('.mark-read-btn').addEventListener('click', function() {
    const unreadNotifications = document.querySelectorAll('.notification-item.unread');
    unreadNotifications.forEach(notification => {
        notification.classList.remove('unread');
    });
    document.querySelector('.badge').textContent = '0';
});
        

    //side bar 
    function toggleSidebar() {
        const sidebar = document.getElementById('accountSidebar');
        sidebar.classList.toggle('active');
    }

    // Add click handler to profile circle to open sidebar
    document.querySelector('.profile-circle').addEventListener('click', function() {
        toggleSidebar();
    });

    // Close sidebar when clicking outside
    document.addEventListener('click', function(event) {
        const sidebar = document.getElementById('accountSidebar');
        const profileCircle = document.querySelector('.profile-circle');
        
        if (!sidebar.contains(event.target) && !profileCircle.contains(event.target) && sidebar.classList.contains('active')) {
            toggleSidebar();
        }
    });
    //need to do it using database
     
    // Line Chart for Requests Overview
    
    