<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  // Show/hide forms
  document.getElementById('showSignUp').addEventListener('click', (e) => {
    e.preventDefault();
    document.getElementById('signInForm').style.display = 'none';
    document.getElementById('signUpForm').style.display = 'block';
  });
  document.getElementById('showSignIn').addEventListener('click', (e) => {
    e.preventDefault();
    document.getElementById('signUpForm').style.display = 'none';
    document.getElementById('signInForm').style.display = 'block';
  });

  // Toggle password visibility
  document.querySelectorAll('.toggle-password').forEach((icon) => {
    icon.addEventListener('click', (e) => {
      const input = e.target.previousElementSibling;
      input.type = input.type === 'password' ? 'text' : 'password';
      e.target.classList.toggle('fa-eye-slash');
    });
  });

  // Dark mode toggle
  document.querySelector('.dark-mode-toggle').addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');
    document.querySelector('.dark-mode-toggle i').classList.toggle('fa-sun');
  });

  // Hide the notification card after 5 seconds
  setTimeout(function () {
    var notification = document.getElementById('welcomeNotification');
    if (notification) {
      notification.style.display = 'none';
    }
  }, 6000);
</script>