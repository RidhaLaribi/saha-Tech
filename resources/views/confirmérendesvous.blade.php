<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Requests Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/stylesRequests.css">
  <script src="Requests.js" defer></script>
  <style>/* force any modal-dialog with .modal-fullscreen to span full width & height */
/* custom wide modal (not fullscreen) */
.modal-dialog.modal-wide {
  max-width: 90vw;     /* or 80vw, or a fixed px like 1000px */
  margin: 1.75rem auto; /* keep vertical centering */
}

</style>
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
       <form method="GET" action="{{ route('rendconfirme') }}" class="row g-3 mb-4">
  <div class="col-md-10">
    <input
      type="text"
      name="patient_search"
      value="{{ old('search',$search) }}"
      class="form-control"
      placeholder="Search patient name…">
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
              <img src="{{ asset('storage/' . ($apt->patient->pic?? 'image.png')) }}" class="rounded-circle me-2" width="50"
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
                <a title="take an appointement to laboratoire" type="button"
                class="btn btn-primary "
                data-bs-toggle="modal"
                data-bs-target="#laboModal">
                <i class="fas fa-flask"></i>
                </a>
                {{-- View Patient Profile --}}
                <a href="{{ route('doctor.patient.show', $apt->patient->id) }}"
                class="btn btn-sm btn-outline-primary me-1" title="enter profil">
                <i class="fas fa-user"></i>
                </a>
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



{{-- 2) Single Modal --}}
<div class="modal fade" id="laboModal" tabindex="-1" aria-labelledby="laboModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-wide modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="laboModalLabel">
          laboratoire list
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
                <form method="GET" action="{{ route('rendconfirme') }}" class="mb-3 d-flex">
            <input
                type="text"
                name="labo_search"
                class="form-control me-2"
                placeholder="Rechercher un laboratoire…"
                value="{{ old('labo_search',$labo_search) }}">
            <button type="submit" class="btn btn-outline-primary">
                <i class="fas fa-search"></i>
            </button>
            </form>

        {{-- Table --}}
        <div class="table-responsive">
          <table class="table table-hover" id="laboTable">
            <thead class="table-light">
              <tr>
                <th>name</th>
                <th>speciality</th>
                <th>number</th>
                <th>price (DA)</th>
                <th>available</th>
                <th>rating</th>
                <th>home-visit</th>
                <th></th> {{-- actions --}}
              </tr>
            </thead>
            <tbody>

 @foreach($laboratoires as $labo)
                <tr>
                  <td>{{ $labo->User->name }}</td>
                  <td>{{ ucfirst($labo->specialty) }}</td>
                  <td>{{ $labo->User->tel }}</td>
                  <td>
                    {{ $labo->price ? number_format($labo->price, 0, ',', ' ') : '—' }}
                  </td>
                  <td>
                    @if($labo->available)
                      <span class="badge bg-success">yes</span>
                    @else
                      <span class="badge bg-secondary">No</span>
                    @endif
                  </td>
                  <td>
                    {{ $labo->rating ? $labo->rating . '/5' : '—' }}
                  </td>
                  <td>
                    @if($labo->home_visit)
                      <span class="badge bg-success">yes</span>
                    @else
                      <span class="badge bg-secondary">No</span>
                    @endif
                  </td>
                  <td>
                    <a href=""
                       class="btn btn-sm btn-outline-primary">
                      <i class="fas fa-calendar-plus"></i> get appointement
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal">
          Fermer
        </button>
      </div>
    </div>
  </div>
</div>

@if(request()->has('labo_search'))
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var laboModal = new bootstrap.Modal(document.getElementById('laboModal'));
      laboModal.show();
    });
  </script>
@endif

  <!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

  <script src="{{ asset('js/sidebar.js') }}"></script>


</body>

</html>
