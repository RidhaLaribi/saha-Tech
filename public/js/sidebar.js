
    // Ensure this script runs after the DOM is ready
    document.addEventListener('DOMContentLoaded', function () {
        const sidebar = document.getElementById('accountSidebar');
        const profileCircle = document.querySelector('.profile-circle');

        // Open sidebar when profile circle is clicked
        profileCircle.addEventListener('click', function () {
            sidebar.classList.toggle('active');
        });

        // Close sidebar when clicking outside
        document.addEventListener('click', function (event) {
            if (!sidebar.contains(event.target) && !profileCircle.contains(event.target)) {
                sidebar.classList.remove('active');
            }
        });
    });

    // Optional: used when clicking the "X" button inside the sidebar
    function toggleSidebar() {
        const sidebar = document.getElementById('accountSidebar');
        sidebar.classList.toggle('active');
    }

