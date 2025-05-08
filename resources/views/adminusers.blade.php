<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Users Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/stylesRequests.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>
  <x-admin-sidebar />

  <div class="main-content">
    <div class="admin-header d-flex justify-content-between align-items-center p-3">
      <div class="brand">
        <h4 class="mb-0 fw-bold">Admin dashboard</h4>
      </div>
      <div class="actions d-flex align-items-center gap-4">
        <x-notifications-dropdown />
        <img src="{{ asset('storage/' . (Auth::user()->pic ?? 'image.png')) }}" class="rounded-circle"
          style="width:70px;height:70px;cursor:pointer;"
          onclick="document.getElementById('accountSidebar').classList.toggle('active')">
      </div>
    </div>
    <x-account-sidebar :user="Auth::user()" />


    <div class=" py-4">
      {{-- Header --}}
      <div class="d-flex flex-column bg-white p-4 rounded-3 shadow-sm mb-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h4 class="mb-0">Users Management</h4>
          <div class="d-flex gap-2">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPatientModal">
              <i class="fas fa-user-injured me-1"></i> Patient
            </button>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addDoctorModal">
              <i class="fas fa-user-md me-1"></i> Practitioner
            </button>
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addAdminModal">
              <i class="fas fa-user-shield me-1"></i> Admin
            </button>
          </div>
        </div>

        {{-- Search & Filter --}}
        <form class="row g-3 mb-4" method="GET" action="{{ route('users.search') }}">
          {{-- free‑text search --}}
          <div class="col-md-6 p-4 ">
            <input type="text" name="q" value="{{ old('q', $query ?? '') }}" class="form-control"
              placeholder="Search by ID, name or role…">
          </div>

          {{-- role/type dropdown --}}
          <div class="col-md-4 p-4">
            <select name="type" class="form-select">
              <option value="" {{ empty($type) ? 'selected' : '' }}>All Roles</option>
              <option value="admin" {{ ($type ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
              <option value="doctor" {{ ($type ?? '') == 'doctor' ? 'selected' : '' }}>Doctor</option>
              <option value="patient" {{ ($type ?? '') == 'patient' ? 'selected' : '' }}>Patient</option>
              <option value="lab" {{ ($type ?? '') == 'lab' ? 'selected' : '' }}>Lab</option>
            </select>
          </div>

          {{-- submit button --}}
          <div class="col-md-2 p-4">
            <button type="submit" class="btn btn-primary w-100">
              <i class="fas fa-filter me-1"></i> Filter
            </button>
          </div>
        </form>






        {{-- Add Patient Modal --}}
        <div class="modal fade" id="addPatientModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3 shadow">
              <div class="modal-header border-0">
                <h5 class="modal-title"><i class="fas fa-user-injured me-2"></i> Add Patient</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="{{ route('users.sign') }}" method="POST" class="row g-3">
                  @csrf
                  {{-- Name --}}
                  <div class="col-md-6">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}"
                      class="form-control @error('name') is-invalid @enderror">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  {{-- Email --}}
                  <div class="col-md-6">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}"
                      class="form-control @error('email') is-invalid @enderror">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  {{-- Age --}}
                  <div class="col-md-6">
                    <label class="form-label">Age <span class="text-danger">*</span></label>
                    <input type="number" name="age" value="{{ old('age') }}"
                      class="form-control @error('age') is-invalid @enderror">
                    @error('age')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  {{-- Sexe --}}
                  <div class="col-md-6">
                    <label class="form-label">Sexe <span class="text-danger">*</span></label>
                    <select name="sexe" class="form-select @error('sexe') is-invalid @enderror">
                      <option value="" disabled selected>Choose...</option>
                      <option value="Homme" {{ old('sexe') == 'Homme' ? 'selected' : '' }}>Homme</option>
                      <option value="Femme" {{ old('sexe') == 'Femme' ? 'selected' : '' }}>Femme</option>
                    </select>
                    @error('sexe')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  {{-- Telephone --}}
                  <div class="col-md-6">
                    <label class="form-label">Telephone <span class="text-danger">*</span></label>
                    <input type="tel" name="telephone" value="{{ old('telephone') }}"
                      class="form-control @error('telephone') is-invalid @enderror">
                    @error('telephone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  {{-- Password --}}
                  <div class="col-md-6">
                    <label class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  {{-- Submit --}}
                  <div class="col-12 text-end">
                    <button type="submit" class="btn btn-success">
                      <i class="fas fa-user-plus me-1"></i> Add Patient
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        {{-- Add Doctor Modal --}}
        <div class="modal fade" id="addDoctorModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3 shadow">
              <div class="modal-header border-0">
                <h5 class="modal-title"><i class="fas fa-user-md me-2"></i> Add Doctor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="{{ route('registerpad') }}" method="POST" class="row g-3">
                  @csrf
                  {{-- Doctor Ref --}}
                  <div class="col-md-6">
                    <label class="form-label">Doctor Ref <span class="text-danger">*</span></label>
                    <input type="number" name="enum" value="{{ old('enum') }}"
                      class="form-control @error('enum') is-invalid @enderror">
                    @error('enum')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  {{-- Name --}}
                  <div class="col-md-6">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}"
                      class="form-control @error('name') is-invalid @enderror">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  {{-- Age --}}
                  <div class="col-md-4">
                    <label class="form-label">Age</label>
                    <input type="number" name="age" value="{{ old('age') }}"
                      class="form-control @error('age') is-invalid @enderror" min="18">
                    @error('age')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  {{-- Sexe --}}
                  <div class="col-md-4">
                    <label class="form-label">Sexe <span class="text-danger">*</span></label>
                    <select name="sexe" class="form-select @error('sexe') is-invalid @enderror">
                      <option value="" disabled selected>Choose...</option>
                      <option value="Homme" {{ old('sexe') == 'Homme' ? 'selected' : '' }}>Homme</option>
                      <option value="Femme" {{ old('sexe') == 'Femme' ? 'selected' : '' }}>Femme</option>
                    </select>
                    @error('sexe')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  {{-- Type --}}
                  <div class="col-md-4">
                    <label class="form-label">Type <span class="text-danger">*</span></label>
                    <select name="type" class="form-select @error('type') is-invalid @enderror">
                      <option value="" disabled selected>Choose...</option>
                      <option value="doctor" {{ old('type') == 'doctor' ? 'selected' : '' }}>Doctor</option>
                      <option value="laboratoire" {{ old('type') == 'laboratoire' ? 'selected' : '' }}>Laboratoire
                      </option>
                    </select>
                    @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  {{-- Telephone --}}
                  <div class="col-md-6">
                    <label class="form-label">Telephone <span class="text-danger">*</span></label>
                    <input type="tel" name="telephone" value="{{ old('telephone') }}"
                      class="form-control @error('telephone') is-invalid @enderror">
                    @error('telephone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  {{-- Email --}}
                  <div class="col-md-6">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}"
                      class="form-control @error('email') is-invalid @enderror">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  {{-- Spécialité --}}
                  <div class="col-md-6">

                    <label class="form-label">specialite <span class="text-danger">*</span></label>

                    <select name="specialite" required class="form-control @error('specialite') is-invalid @enderror"
                      value="{{ old('specialite') }}">
                      <option value="" disabled selected>Spécialité médicale</option>
                      <option>Cardiologie ❤️</option>
                      <option>Dermatologie 🌟</option>
                      <option>Neurologie 🧠</option>
                      <option>Pédiatrie 👶</option>
                      <option>Chirurgie 🏥</option>
                    </select>

                    @error('specialite')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  {{-- Password --}}
                  <div class="col-md-6">
                    <label class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  {{-- Submit --}}
                  <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary">
                      <i class="fas fa-user-md me-1"></i> Add Doctor
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        {{-- Add Admin Modal --}}
        <div class="modal fade" id="addAdminModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3 shadow">
              <div class="modal-header border-0">
                <h5 class="modal-title"><i class="fas fa-user-shield me-2"></i> Add Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                  @csrf
                  {{-- Pic --}}
                  <div class="col-12">
                    <label class="form-label">Avatar</label>
                    <input type="file" name="pic" accept="image/*"
                      class="form-control @error('pic') is-invalid @enderror">
                    @error('pic')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  {{-- Name --}}
                  <div class="col-md-6">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}"
                      class="form-control @error('name') is-invalid @enderror">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  {{-- Email --}}
                  <div class="col-md-6">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}"
                      class="form-control @error('email') is-invalid @enderror">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  {{-- Telephone --}}
                  <div class="col-md-6">
                    <label class="form-label">Telephone <span class="text-danger">*</span></label>
                    <input type="tel" name="tel" value="{{ old('tel') }}"
                      class="form-control @error('tel') is-invalid @enderror">
                    @error('tel')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  {{-- Password --}}
                  <div class="col-md-6">
                    <label class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>

                  {{-- Submit --}}
                  <div class="col-12 text-end">
                    <button type="submit" class="btn btn-danger">
                      <i class="fas fa-user-shield me-1"></i> Add Admin
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>




        {{-- Each table only shows if there's something to display --}}
        @unless($admins->isEmpty())
      <h4>Admins</h4>
      @include('users.tableadmins', ['admins' => $admins])
    @endunless

        @unless($patients->isEmpty())
      <h4 class="mt-4">Patients</h4>
      @include('users.table-patients', ['patients' => $patients])
    @endunless

        @unless($doctors->isEmpty())
      <h4 class="mt-4">Doctors</h4>
      @include('users.table‑doctors', ['doctors' => $doctors])
    @endunless

        {{-- @unless($labs->isEmpty())
        <h4 class="mt-4">Labs</h4>
        @include('table‑labs', ['labs'=>$labs])
        @endunless --}}

      </div>
      @if(session('success'))
      <!-- Notification Card -->
      <div class="notification-card" id="welcomeNotification">
      <i class="fas fa-heart"></i>
      <div class="notification-text">
        <h5>Welcome to Sahateck Family! 🎉</h5>
        <p>{{ session('success') }}</p>
      </div>
      </div>
      {{session(['success' => null])}}
    @endif

      <script>
        const roleSelect = document.getElementById('roleSelect');
        function toggle() {
          document.querySelectorAll('.patient-field, .doctor-field')
            .forEach(e => e.classList.add('d-none'));
          if (roleSelect.value === 'patient') {
            document.querySelectorAll('.patient-field').forEach(e => e.classList.remove('d-none'));
          } else if (roleSelect.value === 'doctor') {
            document.querySelectorAll('.doctor-field').forEach(e => e.classList.remove('d-none'));
          }
        }
        roleSelect.addEventListener('change', toggle);
        document.addEventListener('DOMContentLoaded', toggle);

        setTimeout(function () {
          var notification = document.getElementById('welcomeNotification');
          if (notification) {
            notification.style.display = 'none';
          }
        }, 6000);
      </script>
      <script><script>
          document.addEventListener('DOMContentLoaded', function() {
      const filterType   = document.getElementById('filterType');
          const globalSearch = document.getElementById('globalSearch');
          const formType     = document.getElementById('formType');
          const formQ        = document.getElementById('formQ');
          const searchForm   = document.getElementById('searchForm');

      // 1) When the dropdown changes, submit immediately
      filterType.addEventListener('change', () => {
            formType.value = filterType.value;
          searchForm.submit();
      });

      // 2) When the user presses Enter in the search box, submit
      globalSearch.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();            // prevent a normal form submit/reload
          formType.value = filterType.value;
          formQ.value    = globalSearch.value.trim();
          searchForm.submit();
        }
      });
    });
      </script>
      </script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      <script src="{{ asset('js/sidebar.js') }}"></script>
</body>

</html>