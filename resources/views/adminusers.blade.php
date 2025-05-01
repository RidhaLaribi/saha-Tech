<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Users Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/stylesRequests.css') }}">
</head>
<body>
  <x-admin-sidebar/>

  <div class="main-content">
    <div class="admin-header d-flex justify-content-between align-items-center p-3">
      <div class="brand">
        <h4 class="mb-0 fw-bold">Admin dashboard</h4>
      </div>
      <div class="actions d-flex align-items-center gap-4">
        <x-notifications-dropdown/>
        <img src="{{ asset('storage/' . (Auth::user()->doctor->pic ?? 'defaults/avatar.png')) }}"
             class="rounded-circle" style="width:60px;height:60px;cursor:pointer;"
             onclick="document.getElementById('accountSidebar').classList.toggle('active')">
      </div>
    </div>
    <x-account-sidebar :user="Auth::user()"/>

   
<div class="container py-4">
  {{-- Header --}}
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Users Management</h2>
    <div>
      <button class="btn btn-outline-primary me-2">
        <i class="fas fa-file-import"></i> Import
      </button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
        <i class="fas fa-plus"></i> Add Student
      </button>
    </div>
  </div>

  {{-- Search Bar --}}
  <div class="mb-4">
    <div class="input-group" style="max-width: 300px;">
      <span class="input-group-text bg-white border-end-0">
        <i class="fas fa-search text-muted"></i>
      </span>
      <input type="text" class="form-control border-start-0" placeholder="Search Student ID…">
    </div>
  </div>

  {{-- You can place your user list table or other content here --}}
</div>

{{-- Add Student Modal --}}
<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-3 shadow">
      <div class="modal-header border-0">
        <h5 class="modal-title"><i class="fas fa-user-graduate me-2"></i> Add Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
          @csrf

          {{-- Username --}}
          <div class="col-md-6">
            <label class="form-label">Username <span class="text-danger">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          {{-- Password --}}
          <div class="col-md-6">
            <label class="form-label">Password <span class="text-danger">*</span></label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          {{-- Student ID --}}
          <div class="col-md-6">
            <label class="form-label">Student ID <span class="text-danger">*</span></label>
            <input type="text" name="studentId" value="{{ old('studentId') }}" class="form-control @error('studentId') is-invalid @enderror">
            @error('studentId')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          {{-- Role --}}
          <div class="col-md-6">
            <label class="form-label">Role <span class="text-danger">*</span></label>
            <select name="role" class="form-select @error('role') is-invalid @enderror">
              <option value="" disabled selected>Select a role</option>
              <option value="admin">Admin</option>
              <option value="patient">Patient</option>
              <option value="doctor">Doctor</option>
            </select>
            @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          {{-- Submit Button --}}
          <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-plus-circle me-1"></i> Add Student
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>




      {{-- Admins Table --}}
      <h4>Admins</h4>
      <table class="table">
        <thead><tr><th>#</th><th>Name</th><th>Email</th></tr></thead>
        <tbody>
          @forelse($admins as $u)
            <tr><td>{{ $u->id }}</td><td>{{ $u->name }}</td><td>{{ $u->email }}</td></tr>
          @empty
            <tr><td colspan="3" class="text-center text-muted">No admins.</td></tr>
          @endforelse
        </tbody>
      </table>

      {{-- Patients Table --}}
      <h4 class="mt-4">Patients</h4>
      <table class="table">
        <thead><tr><th>#</th><th>Name</th><th>Email</th><th>Age</th><th>Sexe</th><th>Rel</th></tr></thead>
        <tbody>
          @forelse($patients as $u)
            <tr>
              <td>{{ $u->id }}</td>
              <td>{{ $u->name }}</td>
              <td>{{ $u->email }}</td>
              <td>{{ optional($u->patient)->age  ?? '—' }}</td>
              <td>{{ optional($u->patient)->sexe ?? '—' }}</td>
              <td>{{ optional($u->patient)->rel  ?? '—' }}</td>
            </tr>
          @empty
            <tr><td colspan="6" class="text-center text-muted">No patients.</td></tr>
          @endforelse
        </tbody>
      </table>

      {{-- Doctors & Their Patients --}}
      <h4 class="mt-4">Doctors & Their Patients</h4>
      <table class="table">
        <thead><tr><th>#</th><th>Name</th><th>Email</th><th>Ref</th><th>Patients</th></tr></thead>
        <tbody>
          @forelse($doctors as $d)
            <tr>
              <td>{{ $d->id }}</td>
              <td>{{ $d->name }}</td>
              <td>{{ $d->email }}</td>
              <td>{{ optional($d->doctor)->doctor_ref ?? '—' }}</td>
              <td>
                @if($d->patient->isEmpty())
                  <em class="text-muted">None</em>
                @else
                  <ul class="mb-0">
                    @foreach($d->patient as $p)
                      <li>{{ $p->name }} ({{ $p->user_id }})</li>
                    @endforeach
                  </ul>
                @endif
              </td>
            </tr>
          @empty
            <tr><td colspan="5" class="text-center text-muted">No doctors.</td></tr>
          @endforelse
        </tbody>
      </table>

    </div>
  </div>

  <script>
    const roleSelect = document.getElementById('roleSelect');
    function toggle() {
      document.querySelectorAll('.patient-field, .doctor-field')
              .forEach(e => e.classList.add('d-none'));
      if (roleSelect.value==='patient') {
        document.querySelectorAll('.patient-field').forEach(e=>e.classList.remove('d-none'));
      } else if (roleSelect.value==='doctor') {
        document.querySelectorAll('.doctor-field').forEach(e=>e.classList.remove('d-none'));
      }
    }
    roleSelect.addEventListener('change', toggle);
    document.addEventListener('DOMContentLoaded', toggle);
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/sidebar.js') }}"></script>
</body>
</html>
