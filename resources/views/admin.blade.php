<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/stylesDashboard.css') }}">
</head>
<body>
  <x-admin-sidebar/>

  <div class="main-content">
    <div class="admin-header d-flex justify-content-between align-items-center p-3">
      <h4 class="mb-0 fw-bold">Admin Dashboard</h4>
      <div class="actions d-flex align-items-center gap-3">
        <x-notifications-dropdown/>
        <img
          src="{{ asset('storage/' . (Auth::user()->doctor->pic ?? 'defaults/avatar.png')) }}"
          alt="Profile"
          class="rounded-circle"
          style="width:50px; height:50px; object-fit:cover; cursor:pointer;"
          onclick="document.getElementById('accountSidebar').classList.toggle('active')"
        />
      </div>
    </div>

    <x-account-sidebar :user="Auth::user()"/>

    <div class="welcome-section px-3 mb-4">
      <h4>Welcome back, {{ Auth::user()->name }}!</h4>
      <p>Here's your overview for today.</p>
    </div>

    {{-- Stats Row --}}
    <div class="row mb-4">
      <div class="col-md-2">
        <div class="stats-card text-center">
          <div class="stats-icon text-info"><i class="fas fa-users"></i></div>
          <h6>Total Patients</h6>
          <h4>{{ $totalPatients }}</h4>
        </div>
      </div>

      <div class="col-md-2">
        <div class="stats-card text-center">
          <div class="stats-icon text-secondary"><i class="fas fa-user-md"></i></div>
          <h6>Total Doctors</h6>
          <h4>{{ $totalDoctors }}</h4>
        </div>
      </div>

      <div class="col-md-2">
        <div class="stats-card text-center">
          <div class="stats-icon text-primary"><i class="fas fa-calendar-check"></i></div>
          <h6>Total Appointments</h6>
          <h4>{{ $totalRequests }}</h4>
        </div>
      </div>

      <div class="col-md-2">
        <div class="stats-card text-center">
          <div class="stats-icon text-warning"><i class="fas fa-clock"></i></div>
          <h6>Pending</h6>
          <h4>{{ $pendingRequests }}</h4>
        </div>
      </div>

      <div class="col-md-2">
        <div class="stats-card text-center">
          <div class="stats-icon text-success"><i class="fas fa-check-circle"></i></div>
          <h6>Confirmed</h6>
          <h4>{{ $processedRequests }}</h4>
        </div>
      </div>

      <div class="col-md-2">
        <div class="stats-card text-center">
          <div class="stats-icon text-danger"><i class="fas fa-times-circle"></i></div>
          <h6>Cancelled</h6>
          <h4>{{ $rejectedRequests }}</h4>
        </div>
      </div>
    </div>

    {{-- Charts --}}
    <div class="row">
      <div class="col-lg-8 mb-4">
        <div class="chart-container p-3 bg-white rounded shadow-sm">
          <canvas id="rendezvousChart"></canvas>
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="chart-container p-3 bg-white rounded shadow-sm">
          <canvas id="rendezvousPieChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
 
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const months        = @json($months);
      const apptTotals    = @json($apptTotals);
      const patientTotals = @json($patientTotals);
      const doctorTotals  = @json($doctorTotals);
    
      // — Line chart: Appointments, New Patients, New Doctors — 
      new Chart(
        document.getElementById('rendezvousChart').getContext('2d'),
        {
          type: 'line',
          data: {
            labels: months,
            datasets: [
              {
                label: 'Appointments',
                data: apptTotals,
                tension: 0.4,
                borderColor: '#4169E1',
                backgroundColor: 'rgba(65,105,225,0.1)',
                pointRadius: 3,
                pointHoverRadius: 5,
                borderWidth: 2,
              },
              {
                label: 'New Patients',
                data: patientTotals,
                tension: 0.4,
                borderColor: '#FF8C00',
                backgroundColor: 'rgba(255,140,0,0.1)',
                pointRadius: 3,
                pointHoverRadius: 5,
                borderWidth: 2,
              },
              {
                label: 'New Doctors',
                data: doctorTotals,
                tension: 0.4,
                borderColor: '#8A2BE2',
                backgroundColor: 'rgba(138,43,226,0.1)',
                pointRadius: 5,          // larger dot
                pointHoverRadius: 7,
                borderWidth: 3,          // thicker line
              },
            ],
          },
          options: {
            responsive: true,
            plugins: {
              legend: { position: 'top' }
            },
            scales: {
              y: { beginAtZero: true }
            }
          },
        }
      );
    
      // — Pie chart: Appointment statuses — 
      new Chart(
        document.getElementById('rendezvousPieChart').getContext('2d'),
        {
          type: 'pie',
          data: {
            labels: ['Confirmed','Pending','Cancelled'],
            datasets: [{
              data: [
                {{ $pieData->confirmed }},
                {{ $pieData->pending   }},
                {{ $pieData->cancelled }}
              ],
              backgroundColor: ['#27ae60','#f1c40f','#e74c3c'],
            }],
          },
          options: { responsive: true },
        }
      );
    });
    </script>
    
</body>
</html>
