<!DOCTYPE html>
<html lang="fr">

@include('head')

<body>
  <!-- Dark mode toggle button -->
  <div class="dark-mode-toggle">
    <i class="fas fa-moon"></i>
  </div>

  <!-- Main container -->
  <div class="container">
    <!-- Left hero section -->
    <div class="hero-section">
      <i class="fas fa-heartbeat"></i>
      <h1>Patient Portal</h1>
      <p>Log in and access your care</p>
    </div>

    <!-- Right form section -->
    <div class="form-section">
      <!-- SIGN IN FORM -->
      <form id="signInForm" action="{{ route('login')}}" method="POST">
        @csrf
        <h2 style="text-align: center; margin-bottom: 0.5rem; color: #00796b;">
          Connexion
        </h2>
        <div class="input-group">
          <input type="email" name="iden" placeholder="gmail" {{-- pattern="[0-9]{10}" --}} required />
        </div>
        <div class="input-group">
          <input type="password" name="password" placeholder="password" required />
          <i class="fas fa-eye toggle-password"></i>
        </div>
        <div class="options">
          <label>
            <input type="checkbox" />
            <span>remember me</span>
          </label>
          <a href="{{ route('password.request') }}">
            Forgot your password?
          </a>


        </div>
        <button type="submit">connect</button>
        <div class="switch-form">
          youu got no account?
          <a id="showSignUp">Create accompte</a>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
          @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
          </ul>
        </div>
    @endif
      </form>

      @yield('content')
      @yield('content1')

      <!-- SIGN UP FORM (HIDDEN BY DEFAULT) -->
      <form id="signUpForm" action="{{ route('auth.sign') }}" method="POST">
        @csrf
        <h2 style="text-align: center; margin-bottom: 0.5rem; color: #00796b;">
          creation accompte
        </h2>

        <!-- 2-COLUMN GRID LAYOUT -->
        <div class="form-grid">
          <!-- Full name -->
          <div class="input-group">
            <input type="text" name="name" placeholder="full name" required />
          </div>

          <!-- Age -->
          <div class="input-group">
            <input type="number" name="age" placeholder="age" min="0" required />
          </div>

          <!-- Sexe -->
          <div class="input-group">
            <select name="sexe" required>
              <option value="" disabled selected>Sexe</option>
              <option value="Homme">Homme</option>
              <option value="Femme">Femme</option>
            </select>
          </div>

          <!-- Telephone -->
          <div class="input-group">
            <input type="tel" name="telephone" placeholder="phone-number (10 chiffres)" pattern="[0-9]{10}" required />
          </div>

          <!-- Email -->
          <div class="input-group" style="grid-column: span 2;">
            <input type="email" name="email" placeholder="Email" required />
          </div>

          <!-- Password -->
          <div class="input-group" style="grid-column: span 2;">
            <input type="password" name="password" placeholder="Password" required />
            <i class="fas fa-eye toggle-password"></i>
          </div>
        </div>

        <!-- Submit button -->
        <button type="submit">
          sign in
          <i class="fas fa-check-circle"></i>
        </button>

        <div class="switch-form">
          you already got an accompte
          <a id="showSignIn">connect</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Notification Card -->
  @if(session('success'))
    <!-- Notification Card -->
    <div class="notification-card" id="welcomeNotification">
    <i class="fas fa-heart"></i>
    <div class="notification-text">
      <h5>Welcome to HeyDoc Family! 🎉</h5>
      <p>{{ session('success') }}</p>
    </div>
    </div>
    {{session(['success' => null])}}
  @endif

  @include('script')

</body>

</html>
