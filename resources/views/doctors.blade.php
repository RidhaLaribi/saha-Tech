
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/stylesDashboard.css">
    <script src="js/doctordash.js" defer></script>
    
</head>
<body>
{{-- <?php
       
       include("notificationmanage.php");
       include_once("pendingo.php");
       ?>   --}}
<div class="admin-sidebar">
        <div class="sidebar-header">
            <a href="#" class="admin-logo">
                <div class="logo-circle">
                    <i class="fas fa-university"></i>
                </div>
                <span class="fs-5 fw-bold"> Dashboard</span>
            </a>
        </div>
        
        <nav class="sidebar-nav">
            <a href="Dashboard.php" class="nav-link active"><i class="fas fa-tachometer-alt"></i>‎  Dashboard</a>
            <a href="Requests.php" class="nav-link "><i class="fas fa-file-alt"></i>‎  Manage Requests</a>
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
            <h1>Welcome, </h1>
            <p>Your role is:</p>
            <p>Your id is </p>
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
            <div class="actions d-flex align-items-center gap-4">
              <!-- Notifications -->
              <x-notifications-dropdown />
  
        
                <!-- Profile Circle -->
                <div class="profile-circle d-flex align-items-center justify-content-center rounded-circle bg-primary text-white"
                     style="width: 40px; height: 40px; font-weight: 500;">
                    AD
                </div>
                <a href="{{ route('notifications.test') }}" class="btn btn-sm btn-outline-primary">
                    Send me a test notification
                  </a>
            </div>
        </div>

        
       
        

        <div class="welcome-section">
            <h4 class="mb-1">Welcome back,</h4>
            <p class="mb-0">Here's your activity overview for today.</p>
        </div>

        <!-- make them dynamique  -->
     <div class="row mb-4">
  <div class="col-md-3">
    <div class="stats-card text-center">
      <div class="stats-icon text-primary"><i class="fas fa-tasks"></i></div>
      <h6>Total Requests</h6>
      <h4>{{ $totalRequests }}</h4>
    </div>
  </div>
  <div class="col-md-3">
    <div class="stats-card text-center">
      <div class="stats-icon text-warning"><i class="fas fa-clock"></i></div>
      <h6>Pending Requests</h6>
      <h4>{{ $pendingRequests }}</h4>
    </div>
  </div>
  <div class="col-md-3">
    <div class="stats-card text-center">
      <div class="stats-icon text-success"><i class="fas fa-check-circle"></i></div>
      <h6>Processed Requests</h6>
      <h4>{{ $processedRequests }}</h4>
    </div>
  </div>
  <div class="col-md-3">
    <div class="stats-card text-center">
      <div class="stats-icon text-danger"><i class="fas fa-times-circle"></i></div>
      <h6>Rejected Requests</h6>
      <h4>{{ $rejectedRequests }}</h4>
    </div>
  </div>
</div>



        <div class="row">
            <div class="col-md-6">
                <div class="chart-container">
                    <canvas id="rendezvousChart"></canvas>


                </div>
            </div>
            
            <div class="col-md-3">
                <div class="chart-container">
                    <canvas id="rendezvousPieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

   

    <script>
document.addEventListener("DOMContentLoaded", function () {
    // renamed variables
    const months        = @json($months);
    const totalRendezV  = @json($totals);
    const confirmedRV   = @json($confirmed);

    const statusCounts = {
      confirmed: {{ $pieData->confirmed }},
      pending:   {{ $pieData->pending }},
      cancelled: {{ $pieData->cancelled }},
    };

    // — Line chart for appointments —
    const ctxLine = document.getElementById('rendezvousChart').getContext('2d');
    new Chart(ctxLine, {
      type: 'line',
      data: {
        labels: months,
        datasets: [
          {
            label: 'Total RDVs',
            data: totalRendezV,
            borderColor: '#4169E1',
            backgroundColor: 'rgba(65,105,225,0.1)',
            tension: 0.4,
          },
          {
            label: 'Confirmés',
            data: confirmedRV,
            borderColor: '#27ae60',
            backgroundColor: 'rgba(39,174,96,0.1)',
            tension: 0.4,
          }
        ]
      },
      options: {
        responsive: true,
        plugins: { legend: { position: 'top' } },
        scales: { y: { beginAtZero: true } }
      }
    });

    // — Pie chart for status breakdown —
    const ctxPie = document.getElementById('rendezvousPieChart').getContext('2d');
    new Chart(ctxPie, {
      type: 'pie',
      data: {
        labels: ['Confirmé', 'En Attente', 'Annulé'],
        datasets: [{
          data: [
            statusCounts.confirmed,
            statusCounts.pending,
            statusCounts.cancelled
          ],
          backgroundColor: ['#27ae60', '#f1c40f', '#e74c3c'],
        }]
      },
      options: { responsive: true }
    });
});
</script>

      
    
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>


    
</body>
</html>
