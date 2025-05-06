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
          <input type="email" name="iden" placeholder="email" {{-- pattern="[0-9]{10}" --}} required />
        </div>
        <div class="input-group">
          <input type="password" name="password" placeholder="Mot de passe" required />
          <i class="fas fa-eye toggle-password"></i>
        </div>
        <div class="options">
          <label>
            <input type="checkbox" />
            <span>Se souvenir de moi</span>
          </label>
          <a href="#">Mot de passe oublié ?</a>
        </div>
        <button type="submit">Se Connecter</button>
        <div class="switch-form">
          Vous n'avez pas de compte ?
          <a id="showSignUp">Créer un compte</a>
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

      <!-- SIGN UP FORM (HIDDEN BY DEFAULT) -->
      <form id="signUpForm" action="{{ route('auth.sign') }}" method="POST">
        @csrf
        <h2 style="text-align: center; margin-bottom: 0.5rem; color: #00796b;">
          Création de Compte
        </h2>

        <!-- 2-COLUMN GRID LAYOUT -->
        <div class="form-grid">
          <!-- Full name -->
          <div class="input-group">
            <input type="text" name="name" placeholder="Nom complet" required />
          </div>

          <!-- Age -->
          <div class="input-group">
            <input type="number" name="age" placeholder="Âge" min="0" required />
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
            <input type="tel" name="telephone" placeholder="Téléphone (10 chiffres)" pattern="[0-9]{10}" required />
          </div>

          <!-- Email -->
          <div class="input-group" style="grid-column: span 2;">
            <input type="email" name="email" placeholder="Email" required />
          </div>

          <!-- Password -->
          <div class="input-group" style="grid-column: span 2;">
            <input type="password" name="password" placeholder="Mot de passe" required />
            <i class="fas fa-eye toggle-password"></i>
          </div>
        </div>

        <!-- Submit button -->
        <button type="submit">
          S'inscrire
          <i class="fas fa-check-circle"></i>
        </button>

        <div class="switch-form">
          Vous avez déjà un compte ?
          <a id="showSignIn">Se Connecter</a>
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
      <h5>Welcome to Sahateck Family! 🎉</h5>
      <p>{{ session('success') }}</p>
    </div>
    </div>
    {{session(['success' => null])}}
  @endif

  @include('script')

</body>

</html>