
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
                <x-notifications-dropdown />
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
    

   
      
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    
   
</body>
</html>