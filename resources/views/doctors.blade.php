<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/stylesDashboard.css">
    

</head>
{{--
<link href="css/bootstrap.min.css" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap"
  rel="stylesheet">

<link href="css/bootstrap-icons.css" rel="stylesheet"> --}}

<body>
  
    
  <x-admin-sidebar/>

    
    <div class="main-content">
        <div class="admin-header d-flex justify-content-between align-items-center p-3">
            <!-- Logo and University Name Section -->
            <div class="brand d-flex align-items-center">
                
                   
                <div class="university-name">
                    <h4 class="mb-0 fw-bold">Doctor dashboard</h4>
                    
                </div>
            </div>
            <div class="actions d-flex align-items-center gap-4">
                <!-- Notifications -->
                <x-notifications-dropdown />


                <!-- Profile Circle -->
                <img
                src="{{ asset('storage/' . (Auth::user()->doctor->pic ?? 'defaults/avatar.png')) }}"
                alt="Profile"
                class="profile-circle rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:60px; height:60px; object-fit: cover; cursor: pointer;border: 2px solid black;"
                onclick="document.getElementById('accountSidebar').classList.toggle('active')"
              />
        

      {{-- <div>
      <a href="{{ route('notifications.test') }}" class="btn btn-sm btn-outline-primary">
          Send me a test notification
        </a>
  </div> --}}
            </div>
        </div>

        <x-account-sidebar :user="Auth::user()"/>


        


        <div class="welcome-section">
            <h4 class="mb-1">Welcome back,{{ Auth::user()->name }}!</h4>
            <p class="mb-0">Here's your activity overview for today.</p>
        </div>

        <!-- make them dynamique  -->
     <div class="row mb-4">
  <div class="col-md-3">
    <div class="stats-card text-center">
      <div class="stats-icon text-primary"><i class="fas fa-tasks"></i></div>
      <h6>Total appointments</h6>
      <h4>{{ $totalRequests }}</h4>
    </div>
  </div>
  <div class="col-md-3">
    <div class="stats-card text-center">
      <div class="stats-icon text-warning"><i class="fas fa-clock"></i></div>
      <h6>Pending appointments</h6>
      <h4>{{ $pendingRequests }}</h4>
    </div>
  </div>
  <div class="col-md-3">
    <div class="stats-card text-center">
      <div class="stats-icon text-success"><i class="fas fa-check-circle"></i></div>
      <h6>Processed appointments</h6>
      <h4>{{ $processedRequests }}</h4>
    </div>
  </div>
  <div class="col-md-3">
    <div class="stats-card text-center">
      <div class="stats-icon text-danger"><i class="fas fa-times-circle"></i></div>
      <h6>Rejected appointments</h6>
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
      const months = @json($months);
      const totalRendezV = @json($totals);
      const confirmedRV = @json($confirmed);

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
    <script src="{{ asset('js/sidebar.js') }}"></script>
   


</body>

</html>