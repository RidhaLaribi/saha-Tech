
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requests Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/stylesRequests.css">
    <script src="Requests.js" defer></script>
</head>
<body>
<div class="admin-sidebar">
        <div class="sidebar-header">
            <a href="#" class="admin-logo">
                <div class="logo-circle">
                    <i class="fas fa-university"></i>
                </div>
                <span class="fs-5 fw-bold">Requests Dashboard</span>
            </a>
        </div>
        
        <nav class="sidebar-nav">
            <a href="Dashboard.php" class="nav-link "><i class="fas fa-tachometer-alt"></i>‎  Dashboard</a>
            <a href="Requests.php" class="nav-link active"><i class="fas fa-file-alt"></i>‎  Manage Requests</a>
            <a href="News.php" class="nav-link"><i class="fas fa-users"></i>‎  News </a>
            <a href="newadmine.php" class="nav-link "><i class="fas fa-user-graduate"></i>‎ Users</a>

        </nav>
    </div>
    
    <div class="sidebar" id="accountSidebar">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="m-0">Account</h4>
            <button class="btn btn-link text-dark" onclick="toggleSidebar()">
                <i class="fas fa-times fs-4"></i>
            </button>
        </div>
        <div class="profile-section">
                <!-- i need to add admin image -->
            <img src="Admin_pic.png" alt="Profile" class="profile-image">
            <h1>Welcome,
                 {{-- <?php echo htmlspecialchars($_SESSION['username']); ?>! --}}
                </h1>
            <p>Your role is: <strong>
                {{-- <?php echo htmlspecialchars($_SESSION['role']); ?> --}}
            </strong>.</p>
            <p>Your id is :
                {{-- <?php echo htmlspecialchars($_SESSION['id']); ?> --}}
            </strong>.</p>
        </div>
        <form action="logout.php" method="POST">
            <button type="submit" class="btn btn-danger w-100 mt-4">
                <i class="fas fa-sign-out-alt me-2"></i>
                Sign Out
            </button>
        </form>
    </div>
    <div class="main-content">
    <div class="admin-header d-flex justify-content-between align-items-center p-3">
            <!-- Logo and University Name Section -->
            <div class="brand d-flex align-items-center">
                <img src="logo.png" alt="Boumerdes University Logo" 
                     class="logo me-3" 
                     style="height: 45px; width: auto; object-fit: contain;">
                <div class="university-name">
                    <h4 class="mb-0 fw-bold">Boumerdes University</h4>
                    <small class="text-muted">University of M'Hamed Bougara</small>
                </div>
            </div>
        
            <!-- Right Side Actions -->
            <div class="actions d-flex align-items-center gap-4">
                <!-- Notifications -->
                <div class="notifications">
                    <button class="btn btn-light position-relative rounded-circle p-2 shadow-sm "data-bs-toggle="modal" data-bs-target="#notificationModal">
                    <i class="fas fa-bell fs-5"></i>
                     @if($totalNotifications > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                 {{$totalNotifications}}
                                <span class="visually-hidden">unread notifications</span>
                            </span>
                         @endif
                    </button>
                </div>
        
                <!-- Profile Circle -->
                <div class="profile-circle d-flex align-items-center justify-content-center rounded-circle bg-primary text-white"
                     style="width: 40px; height: 40px; font-weight: 500;">
                    AD
                </div>
            </div>
        </div>

        
        

        <!-- Table Section -->
        <div class="table-responsive">
        <div class="d-flex justify-content-between align-items-center mb-4">
               <h5 class="mb-0">Recent requests</h5>
                
            </div>
          {{-- <?php
            include("requestmanage.php");
          ?> --}}
        </div> 
        </div>
    </div>
    

   
    <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title fw-bold" id="notificationModalLabel">
                        <i class="fas fa-bell me-2"></i> Notifications
                        <span class="badge bg-gradient ms-2">{{ $totalNotifications }}</span>
                    </h5>
                    <div class="ms-auto d-flex gap-2 align-items-center">
                        <form method="POST" action="{{route('clearnotif')}}">
                            @csrf
                            <button type="submit" class="btn btn-sm mark-read-btn">
                                <i class="fas fa-check-double me-1"></i> Mark all as read
                            </button>
                        </form>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
    
                <!-- Modal Body -->
                <div class="modal-body p-0">
                    <div class="notifications-list">
                        @if($notifications->isEmpty())
                            <p class="text-center text-muted my-3">No notifications</p>
                        @else
                            @foreach ($notifications as $notification)
                                <div class="notification-item unread">
                                    <div class="d-flex">
                                        <div class="notification-icon">
                                            <i class="fas fa-book"></i>
                                        </div>
                                        <div class="notification-content">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6 class="mb-0">New Notification available</h6>
                                                <small class="text-muted">
                                                    {{ \Carbon\Carbon::parse($notification->created_at)->format('d M Y H:i') }}
                                                </small>
                                            </div>
                                            <p class="mb-0">{{ $notification->message }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
      
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    
   
</body>
</html>