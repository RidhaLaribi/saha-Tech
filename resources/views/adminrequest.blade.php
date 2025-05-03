<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Requests Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/stylesRequests.css">

</head>

<body>
  <x-admin-sidebar />


  <div class="main-content">
    <div class="admin-header d-flex justify-content-between align-items-center p-3">
      <!-- Logo and University Name Section -->
      <div class="brand d-flex align-items-center">


        <div class="university-name">
          <h4 class="mb-0 fw-bold">admin dashboard</h4>

        </div>
      </div>
      <div class="actions d-flex align-items-center gap-4">
        <!-- Notifications -->
        <x-notifications-dropdown />


        <!-- Profile Circle -->
        <img src="{{ asset('storage/' . (Auth::user()->doctor->pic ?? 'defaults/avatar.png')) }}" alt="Profile"
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
        <form class="row g-3 mb-4" method="GET" action="">
          <div class="col-md-4">
            <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control"
              placeholder="Search by type or specialty…">
          </div>

          <div class="col-md-3">
            <select name="type" class="form-select">
              <option value="">All Types</option>
              <option value="doctor" {{ ($type ?? '') == 'doctor' ? 'selected' : '' }}>Doctor</option>
              <option value="laboratoire" {{ ($type ?? '') == 'laboratoire' ? 'selected' : '' }}>Laboratoire</option>
            </select>
          </div>

          <div class="col-md-3">
            <input type="text" name="specialty" value="{{ $specialty ?? '' }}" class="form-control"
              placeholder="Search by specialty…">
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
                <th>Praticien</th>
                <th>Type</th>
                <th>Speciality</th>
                <th>Location</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($doctors as $doctor)
          <tr>
          <td>{{ $doctor->id }}</td>
          <td class="d-flex align-items-center">
            <img src="{{ asset('storage/image.png') }}" class="rounded-circle me-2" width="50" height="50"
            alt="Avatar">
            {{ $doctor->user->name ?? 'N/A' }}
          </td>
          <td>{{ ucfirst($doctor->type) }}</td>
          <td>{{ $doctor->specialty }}</td>
          <td>{{ $doctor->location ?? 'Non spécifiée' }}</td>
          <td>
            {{-- View Profile --}}
            <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal"
            data-bs-target="#doctorModal{{ $doctor->id }}">
            <i class="fas fa-user"></i>
            </button>

            {{-- Accept --}}
            <form action="{{ route('admin.doctor.validate', $doctor->id) }}" method="POST" class="d-inline">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-sm btn-success" title="Valider">
              <i class="fas fa-check"></i>
            </button>
            </form>

            {{-- Refuse --}}
            <form action="{{ route('admin.doctor.destroy', $doctor->id) }}" method="POST" class="d-inline"
            onsubmit="return confirm('Êtes-vous sûr de vouloir refuser cette demande ?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-danger" title="Refuser">
              <i class="fas fa-times"></i>
            </button>
            </form>
          </td>
          </tr>
        @empty
          <tr>
          <td colspan="6" class="text-center">Aucun praticien à valider.</td>
          </tr>
        @endforelse
            </tbody>
          </table>
        </div>

        {{-- Modals --}}
        @foreach($doctors as $doctor)
      <div class="modal fade" id="doctorModal{{ $doctor->id }}" tabindex="-1"
        aria-labelledby="doctorModalLabel{{ $doctor->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
          <img src="{{ asset('storage/image.png') }}" class="rounded-circle me-2" width="50" height="50"
            alt="Avatar">
          <h5 class="modal-title" id="doctorModalLabel{{ $doctor->id }}">
            {{ $doctor->user->name ?? 'N/A' }}
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">

          <ul class="list-group">
            <li class="list-group-item"><strong>Nom:</strong> {{ $doctor->user->name ?? 'N/A' }}</li>
            <li class="list-group-item"><strong>Spécialité:</strong> {{ $doctor->specialty }}</li>
            <li class="list-group-item"><strong>Type:</strong> {{ $doctor->type }}</li>
            <li class="list-group-item"><strong>Sexe:</strong> {{ ucfirst($doctor->gender) }}</li>
            <li class="list-group-item"><strong>Âge:</strong> {{ $doctor->age }}</li>
            <li class="list-group-item"><strong>Prix:</strong> {{ $doctor->price }} DA</li>
            <li class="list-group-item"><strong>Disponible:</strong> {{ $doctor->available ? 'Oui' : 'Non' }}</li>
            <li class="list-group-item"><strong>Consultation à domicile:</strong>
            {{ $doctor->home_visit ? 'Oui' : 'Non' }}</li>
            <li class="list-group-item"><strong>Adresse:</strong> {{ $doctor->location ?? 'Non spécifiée' }}</li>
            <li class="list-group-item"><strong>Référence:</strong> {{ $doctor->doctor_ref ?? 'Non spécifiée' }}
            </li>
            <li class="list-group-item"><strong>Jours de travail:</strong> {{ $doctor->work_days }}</li>
            <li class="list-group-item"><strong>Description:</strong> {{ $doctor->description }}</li>
            <li class="list-group-item"><strong>Note:</strong> {{ $doctor->rating }}/5</li>
          </ul>
          </div>
        </div>
        </div>
      </div>
    @endforeach




        <div class="mt-3">
          {{ $doctors->links() }}
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