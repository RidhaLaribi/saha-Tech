@auth
@props([
    'user' => null
])

@php
    $user   = $user ?? Auth::user();
    $role   = $user->role;                    // 'admin', 'doctor'
    $doctor = $user->doctor ?? null;          // only set if role==='doctor'
@endphp

<div class="sidebar" id="accountSidebar">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="m-0">Account</h4>
    <button class="btn btn-link text-dark" onclick="toggleSidebar()">
      <i class="fas fa-times fs-4"></i>
    </button>
  </div>

  <div class="profile-section text-center position-relative">
    
    <img src="{{ asset('storage/' . (
          $role==='doctor'
            ? ($doctor->pic    ?? 'image.png')
            : ($user->pic      ?? 'image.png')
        )) }}"
         alt="Profile" class="profile-image">

    
         @if(in_array($role, ['doctor', 'admin']))
         <form action="{{ route('uploadpic') }}" method="POST" enctype="multipart/form-data" class="mt-2 d-inline-block">
           @csrf
           <label for="uploadPicInput" class="d-flex align-items-center justify-content-center" style="cursor: pointer;">
             <i class="fas fa-plus fa-lg text-primary" style="font-size: 14px;"></i>
           </label>
           <input type="file" name="pic" id="uploadPicInput" class="d-none" onchange="this.form.submit()">
         </form>
       @endif
       

    {{-- Common info --}}
    <h5 class="mt-3">Welcome, {{ $user->name }}!</h5>
    <p><strong>Role:</strong> {{ ucfirst($role) }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>

    {{-- Doctor‑only details --}}
    @if($role === 'doctor' && $doctor)
      <p><strong>Specialty:</strong> {{ $doctor->specialty }}</p>
      <p><strong>Phone:</strong> {{ $user->tel }}</p>
      <p><strong>Description:</strong> {{ $doctor->description }}</p>
    @endif

    
    @if($role === 'admin')
      <p><strong>Phone:</strong> {{ $user->tel }}</p>
      
    @endif

    
    
  </div>

  <form action="{{ route('logout') }}" method="POST" class="mt-4">
    @csrf
    <button type="submit" class="btn btn-danger w-100">
      <i class="fas fa-sign-out-alt me-2"></i> Sign Out
    </button>
  </form>
</div>

<script src="{{ asset('js/sidebar.js') }}"></script>
@endauth