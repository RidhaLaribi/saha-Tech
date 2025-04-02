<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        /* NOTIFICATION CARD */
        .notification-card {
          position: fixed;
          bottom: 30px;
          right: 30px;
          background: #fff;
          padding: 20px;
          border-radius: 12px;
          box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
          border-left: 4px solid #00796b;
         
          align-items: center;
          gap: 15px;
          max-width: 350px;
          animation: slideIn 0.5s ease-out;
          z-index: 1000;
        }
        .notification-card i {
          color: #00796b;
          font-size: 1.8rem;
        }
        .notification-text h3 {
          color: #00796b;
          margin-bottom: 8px;
        }
        @keyframes slideIn {
          from {
            transform: translateX(100%);
          }
          to {
            transform: translateX(0);
          }
        }
        .dark-mode .notification-card {
          background: #363636;
          border-color: #00a896;
        }
        </style>
</head>
<body>
    <h1>done</h1>
    @if(session('success'))
    <!-- Notification Card -->
    <div class="notification-card" id="welcomeNotification">
      <i class="fas fa-heart"></i>
      <div class="notification-text">
        <h3>Welcome to Sahateck Family! 🎉</h3>
        <p>{{ session('success') }}</p>
      </div>
    </div>
  @endif
</body>
</html>