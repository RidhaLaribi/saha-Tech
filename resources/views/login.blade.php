<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Portail Patient - Accès & Inscription</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
  />
  <style>
    /* RESET & BASIC STYLES */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    body {
      background: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      overflow: hidden;
    }

    /* CONTAINER */
    .container {
      background: #fff;
      width: 90%;
      max-width: 900px;
      border-radius: 10px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: row;
      overflow: hidden;
      position: relative;
    }

    /* HERO SECTION */
    .hero-section {
      flex: 1;
      background: linear-gradient(135deg, #00796b, #005f56);
      color: #fff;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 2rem;
      text-align: center;
      transition: transform 0.5s;
    }
    .hero-section:hover {
      transform: scale(1.03);
    }
    .hero-section i {
      font-size: 3rem;
      margin-bottom: 10px;
      animation: float 3s ease-in-out infinite;
    }
    @keyframes float {
      0% {
        transform: translateY(0);
      }
      50% {
        transform: translateY(-10px);
      }
      100% {
        transform: translateY(0);
      }
    }
    .hero-section h1 {
      font-size: 1.8rem;
      margin-bottom: 5px;
    }
    .hero-section p {
      font-size: 1rem;
    }

    /* FORM SECTION */
    .form-section {
      flex: 1.2;
      padding: 2rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    /* FORMS */
    form {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }
    #signUpForm {
      display: none; /* hidden by default; shown on link click */
    }

    /* TWO-COLUMN GRID FOR SIGN-UP FORM */
    .form-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1rem;
      margin-bottom: 1rem;
    }

    .input-group {
      position: relative;
    }

    input,
    select {
      width: 100%;
      padding: 12px;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 1rem;
      transition: border 0.3s, box-shadow 0.3s;
      background: #fff;
    }
    input:focus,
    select:focus {
      border-color: #00796b;
      box-shadow: 0 0 0 3px rgba(0, 121, 107, 0.1);
      outline: none;
    }
    select {
      appearance: none; /* Hide default arrow in some browsers */
      background: url("data:image/svg+xml;charset=US-ASCII,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='10' viewBox='0 0 8 10'%3E%3Cpath fill='%2300796b' d='M0 0l4 5 4-5z'/%3E%3C/svg%3E")
        no-repeat;
      background-position: right 10px center;
      background-size: 10px;
    }

    .toggle-password {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #00796b;
    }

    button {
      padding: 10px 20px;
      background: #00796b;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 1rem;
      transition: background 0.3s, transform 0.3s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
    }
    button:hover {
      background: #005f56;
      transform: translateY(-3px);
    }

    .switch-form {
      text-align: center;
      margin-top: 1rem;
      font-size: 0.9rem;
    }
    .switch-form a {
      color: #00796b;
      text-decoration: none;
      font-weight: 500;
      cursor: pointer;
    }

    /* OPTIONS (REMEMBER ME, ETC.) */
    .options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 1rem;
      margin-bottom: 1rem;
    }
    .options label {
      display: flex;
      align-items: center;
      gap: 0.8rem;
      cursor: pointer;
      transition: all 0.3s ease;
      padding: 8px 12px;
      border-radius: 6px;
    }
    .options label:hover {
      background: rgba(0, 121, 107, 0.05);
    }
    .options input[type="checkbox"] {
      appearance: none;
      width: 20px;
      height: 20px;
      border: 2px solid #00796b;
      border-radius: 4px;
      cursor: pointer;
      position: relative;
      transition: all 0.3s ease;
    }
    .options input[type="checkbox"]:checked {
      background: #00796b;
      border-color: #00796b;
    }
    .options input[type="checkbox"]:checked::after {
      content: '\f00c';
      font-family: 'Font Awesome 5 Free';
      font-weight: 900;
      color: white;
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      font-size: 0.9rem;
    }
    .options label span {
      font-size: 0.95rem;
      color: #555;
    }
    .options a {
      color: #00796b;
      text-decoration: none;
    }

    /* DARK MODE */
    .dark-mode-toggle {
      position: fixed;
      top: 20px;
      left: 20px;
      cursor: pointer;
      font-size: 1.5rem;
      color: #00796b;
      z-index: 2;
    }
    .dark-mode {
      background: #2a2a2a;
      color: #fff;
    }
    .dark-mode .container {
      background: #363636;
    }
    .dark-mode input,
    .dark-mode select {
      background: #444;
      border-color: #555;
      color: #fff;
    }
    .dark-mode .options label:hover {
      background: rgba(0, 168, 150, 0.1);
    }
    .dark-mode .options input[type="checkbox"] {
      border-color: #00a896;
    }
    .dark-mode .options input[type="checkbox"]:checked {
      background: #00a896;
      border-color: #00a896;
    }
    .dark-mode .options label span {
      color: #ddd;
    }
    .dark-mode .dark-mode-toggle {
      color: #00a896;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        max-width: 500px;
      }
      .hero-section {
        display: none;
      }
    }

    /* NOTIFICATION CARD */
    .notification-card {
      position: fixed;
      bottom: 30px;
      right: 30px;
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      border-left: 4px solid #00796b;
     
      align-items: center;
      gap: 15px;
      max-width: 350px;
      animation: slideIn 0.5s ease-out;
      z-index: 1000;
    }
    .notification-card i {
      color: #00796b;
      font-size: 1.8rem;
    }
    .notification-text h3 {
      color: #00796b;
      margin-bottom: 8px;
    }
    @keyframes slideIn {
      from {
        transform: translateX(100%);
      }
      to {
        transform: translateX(0);
      }
    }
    .dark-mode .notification-card {
      background: #363636;
      border-color: #00a896;
    }
  </style>
</head>

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
      <h1>Portail Patient</h1>
      <p>Connectez-vous et accédez à vos soins</p>
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
          <input
            type="email"
            name="iden"
            placeholder="email"
            {{-- pattern="[0-9]{10}" --}}
            required
          />
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
      <form id="signUpForm" action="{{ route('sign') }}" method="POST">
        @csrf
        <h2 style="text-align: center; margin-bottom: 0.5rem; color: #00796b;">
          Création de Compte
        </h2>

        <!-- 2-COLUMN GRID LAYOUT -->
        <div class="form-grid">
          <!-- Full name -->
          <div class="input-group">
            <input
              type="text"
              name="name"
              placeholder="Nom complet"
              required
            />
          </div>

          <!-- Age -->
          <div class="input-group">
            <input
              type="number"
              name="age"
              placeholder="Âge"
              min="0"
              required
            />
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
            <input
              type="tel"
              name="telephone"
              placeholder="Téléphone (10 chiffres)"
              pattern="[0-9]{10}"
              required
            />
          </div>

          <!-- Email -->
          <div class="input-group" style="grid-column: span 2;">
            <input type="email" name="email" placeholder="Email" required />
          </div>

          <!-- Password -->
          <div class="input-group" style="grid-column: span 2;">
            <input
              type="password"
              name="password"
              placeholder="Mot de passe"
              required
            />
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
      <h3>Welcome to Sahateck Family! 🎉</h3>
      <p>{{ session('success') }}</p>
    </div>
  </div>
  {{session('success')=null}}
@endif

  <script>
    // Show/hide forms
    document.getElementById('showSignUp').addEventListener('click', (e) => {
      e.preventDefault();
      document.getElementById('signInForm').style.display = 'none';
      document.getElementById('signUpForm').style.display = 'block';
    });
    document.getElementById('showSignIn').addEventListener('click', (e) => {
      e.preventDefault();
      document.getElementById('signUpForm').style.display = 'none';
      document.getElementById('signInForm').style.display = 'block';
    });
  
    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach((icon) => {
      icon.addEventListener('click', (e) => {
        const input = e.target.previousElementSibling;
        input.type = input.type === 'password' ? 'text' : 'password';
        e.target.classList.toggle('fa-eye-slash');
      });
    });
  
    // Dark mode toggle
    document.querySelector('.dark-mode-toggle').addEventListener('click', () => {
      document.body.classList.toggle('dark-mode');
      document.querySelector('.dark-mode-toggle i').classList.toggle('fa-sun');
    });
  
    // Hide the notification card after 5 seconds
  setTimeout(function() {
    var notification = document.getElementById('welcomeNotification');
    if (notification) {
      notification.style.display = 'none';
    }
  }, 6000);
  </script>
  
  
  

</body>
</html>
