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
  <x-admin-sidebar />


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
        <img src="{{ asset('storage/' . (Auth::user()->doctor->pic ?? 'image.png')) }}" alt="Profile"
          class="profile-circle rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
          style="width:60px; height:60px; object-fit: cover; cursor: pointer;border: 2px solid black;"
          onclick="document.getElementById('accountSidebar').classList.toggle('active')" />


        {{-- <div>
          <a href="{{ route('notifications.test') }}" class="btn btn-sm btn-outline-primary">
            Send me a test notification
          </a>
        </div> --}}
      </div>
    </div>

    <x-account-sidebar :user="Auth::user()" />




    <!-- Table Section -->
    <div class="table-responsive">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Recent requests</h5>

      </div>
      <div class="container">

        {{-- Filters --}}
        <form class="row g-3 mb-4">
          <div class="col-md-4">
            <input type="text" name="search" value="{{ $search }}" class="form-control"
              placeholder="Search patient name…">
          </div>
          <div class="col-md-3">
            <select name="type" class="form-select">
              <option value="">All Types</option>
              <option value="bonne_conduite" {{ $type == 'bonne_conduite' ? 'selected' : '' }}>
                Bonne Conduite
              </option>
              <option value="certificat de scolarité" {{ $type == 'certificat de scolarité' ? 'selected' : '' }}>
                Certificat de Scolarité
              </option>
              <option value="relevé de note" {{ $type == 'relevé de note' ? 'selected' : '' }}>
                Relevé de Note
              </option>
            </select>
          </div>
          <div class="col-md-3">
            <select name="status" class="form-select">
              <option value="">All Statuses</option>
              <option value="En Attente" {{ $status == 'En Attente' ? 'selected' : '' }}>En Attente</option>
              <option value="Confirmé" {{ $status == 'Confirmé' ? 'selected' : '' }}>Confirmé</option>
              <option value="Annulé" {{ $status == 'Annulé' ? 'selected' : '' }}>Annulé</option>
            </select>
          </div>
          <div class="col-md-2">
            <button class="btn btn-primary w-100">
              <i class="fas fa-filter me-1"></i> Filter
            </button>
          </div>
        </form>

        {{-- Table --}}
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead>
              <tr>
                <th>#</th>
                <th>Patient</th>
                <th>Date &amp; Time</th>
                <th>Type</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($appointments as $apt)
            <tr>
            <td>{{ $apt->id }}</td>
            <td class="d-flex align-items-center">
              <img src="{{ asset('storage/' . $apt->patient->pic) }}" class="rounded-circle me-2" width="50"
              height="50" alt="Avatar">
              {{ $apt->patient->name }}
            </td>
            <td>{{ $apt->rendezvous->format('d M Y, H:i') }}</td>
            <td>{{ $apt->type }}</td>
            <td>
              @php
          $badge = match ($apt->status) {
          'Confirmé' => 'success',
          'En Attente' => 'warning',
          'Annulé' => 'danger',
          default => 'secondary',
          };
        @endphp
              <span class="badge bg-{{ $badge }}">
              {{ $apt->status }}
              </span>
            </td>
            <td>
            <td>
              {{-- View Patient Profile --}}
              <a href="{{ route('doctor.patient.show', $apt->patient->id) }}"
              class="btn btn-sm btn-outline-primary me-1" title="Voir le profil">
              <i class="fas fa-user"></i>
              </a>
              {{-- Accept button --}}
              <form action="{{ route('doctor.appointments.update', $apt) }}" method="POST" class="d-inline">
              @csrf
              @method('PATCH')
              <input type="hidden" name="status" value="Confirmé">
              <button type="submit" class="btn btn-sm btn-success" title="Accept">
                <i class="fas fa-check"></i>
              </button>
              </form>



              {{-- Decline button --}}
              <form action="{{ route('doctor.appointments.update', $apt) }}" method="POST" class="d-inline">
              @csrf
              @method('PATCH')
              <input type="hidden" name="status" value="Annulé">
              <button type="submit" class="btn btn-sm btn-danger" title="Decline">
                <i class="fas fa-times"></i>
              </button>
              </form>
            </td>
            </tr>
        @empty
          <tr>
          <td colspan="6" class="text-center">No appointments found.</td>
          </tr>
        @endforelse
            </tbody>
          </table>

        </div>

        {{-- Pagination --}}
        <div class="mt-3">
          {{ $appointments->links() }}
        </div>
      </div>
    </div>
  </div>
  </div>




  <!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

  <script src="{{ asset('js/sidebar.js') }}"></script>
</body>

</html>