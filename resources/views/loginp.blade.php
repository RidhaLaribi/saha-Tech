<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription Praticien</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <style>
    /* Reset and basic styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background: #f0f2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      overflow-x: hidden;
      position: relative;
    }

    /* Main Container */
    .container {
      background: #fff;
      width: 90%;
      max-width: 900px;
      padding: 2.5rem;
      border-radius: 16px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
      display: grid;
      grid-template-columns: 1fr 1.5fr;
      gap: 2rem;
      position: relative;
      overflow: hidden;
    }

    .container::before {
      content: "";
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(0, 121, 107, 0.15), transparent 70%);
      transform: rotate(20deg);
      z-index: 0;
    }

    /* Hero Section */
    .hero-section {
      background: linear-gradient(135deg, #00796b, #005f56);
      border-radius: 12px;
      padding: 2rem;
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: center;
      text-align: center;
      position: relative;
      z-index: 1;
      transition: transform 0.5s;
    }

    .hero-section:hover {
      transform: scale(1.03);
    }

    .medical-icon {
      font-size: 4rem;
      margin-bottom: 1rem;
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

    .hero-title {
      font-size: 2rem;
      margin-bottom: 0.5rem;
      font-weight: 600;
    }

    .hero-text {
      font-size: 1rem;
      opacity: 0.9;
      line-height: 1.4;
    }

    /* Form Section */
    .form-section {
      padding: 1rem;
      position: relative;
      z-index: 1;
    }

    .form-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1rem;
      margin-bottom: 1rem;
    }

    .input-group {
      margin-bottom: 1rem;
      position: relative;
    }

    input,
    select {
      width: 100%;
      padding: 12px;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      font-size: 0.95rem;
      transition: all 0.3s ease;
      background: #fff;
    }

    input:focus,
    select:focus {
      outline: none;
      border-color: #00796b;
      box-shadow: 0 0 0 3px rgba(0, 121, 107, 0.1);
    }

    select {
      appearance: none;
      background: url("data:image/svg+xml;charset=US-ASCII,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='10' viewBox='0 0 8 10'%3E%3Cpath fill='%2300796b' d='M0 0l4 5 4-5z'/%3E%3C/svg%3E") no-repeat;
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
      background: #00796b;
      color: white;
      border: none;
      padding: 14px;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
      transition: all 0.3s ease;
      grid-column: span 2;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    button:hover {
      background: #005f56;
      transform: translateY(-2px);
    }

    /* Dark Mode Styles */
    .dark-mode {
      background: #1a1d21;
      color: #e0e0e0;
    }

    .dark-mode .container {
      background: #25282d;
    }

    .dark-mode .hero-section {
      background: linear-gradient(135deg, #005f56, #004d44);
    }

    .dark-mode input,
    .dark-mode select {
      background: #2d3035;
      border-color: #3d4046;
      color: #e0e0e0;
    }

    .dark-mode-toggle {
      position: fixed;
      top: 25px;
      right: 25px;
      cursor: pointer;
      color: #00796b;
      font-size: 1.4rem;
      z-index: 2;
    }

    .dark-mode .dark-mode-toggle {
      color: #00a896;
    }

    @media (max-width: 768px) {
      .container {
        grid-template-columns: 1fr;
        max-width: 500px;
      }

      .hero-section {
        display: none;
      }
    }

    /* Notification Message Styles */
    .notification-message {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: linear-gradient(135deg, #00796b, #005f56);
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
      text-align: center;
      display: block;
      z-index: 1000;
      border: 4px solid #00796b;
      animation: fadeIn 0.5s ease-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translate(-50%, -40%);
      }

      to {
        opacity: 1;
        transform: translate(-50%, -50%);
      }
    }

    .notification-message h1 {
      font-size: 2rem;
      margin-bottom: 0.5rem;
      color: #fff;
    }

    .notification-message p {
      font-size: 1.1rem;
      margin-bottom: 1.5rem;
      line-height: 1.5;
      color: #fff;
    }

    .notification-message a {
      background: #fff;
      color: #00796b;
      border: none;
      padding: 12px 20px;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
      display: block;
      margin: 0 auto;
      transition: background 0.3s ease;
    }

    .notification-message a:hover {
      background: #e0e0e0;
    }
    .logo {
  position: absolute;
  top: 10px;
  left: 20px;
  font-size: 24px;
  font-weight: bold;
  color: #3498db; /* Choose a color */
  font-family: Arial, sans-serif;
}

  </style>
</head>

<body>
  <div class="dark-mode-toggle">
    <i class="fas fa-moon"></i>
  </div>
@if(!session('success'))
  <div class="container" id="registrationContainer">
    <div class="hero-section">
      <i class="fas fa-user-md medical-icon"></i>
      <h2 class="hero-title">Plateforme Praticiens</h2>
      <p class="hero-text">
        Rejoignez notre réseau de professionnels de la santé pour échanger, collaborer et innover.<br>
        Ensemble, améliorons les soins de demain !
      </p>
    </div>
    <div class="form-section">
      <form id="signUpForm" action="{{route('registerp')}}"  method="POST">
        @csrf
        <div class="form-grid">
          <div class="input-group">
            <input type="text" name="enum" placeholder="doctor_ref" required>
          </div>
          <div class="input-group">
            <input type="text" name="name" placeholder="full name" required>
          </div>
          <div class="input-group">
            <input type="number" name="age" placeholder="Âge" min="18" max="100" required>
          </div>
          <div class="input-group">
            <select name="sexe" required>
              <option value="" disabled selected>Sexe</option>
              <option value="Homme">Homme ♂️</option>
              <option value="Femme">Femme ♀️</option>
            </select>
          </div>
          <div class="input-group">
            <input type="tel" name="telephone" placeholder="Numéro de Téléphone" pattern="[0-9]{10}" required>
          </div>
          <div class="input-group">
            <input type="email" name="email" placeholder="Email professionnel" required>
          </div>
         
          <div class="input-group" style="grid-column: span 2;">
            <select name="specialite" required>
              <option value="" disabled selected>Spécialité médicale</option>
              <option>Cardiologie ❤️</option>
              <option>Dermatologie 🌟</option>
              <option>Neurologie 🧠</option>
              <option>Pédiatrie 👶</option>
              <option>Chirurgie 🏥</option>
            </select>
          </div>
          <div class="input-group" style="grid-column: span 2;">
          
<select name="type" id="type" required>
  <option value="clinique">Clinique</option>
  <option value="laboratoire">Laboratoire</option>
  <option value="doctor">Doctor</option>
</select>
</div>

        

           <!-- Password field moved higher (before specialty) -->
           <div class="input-group" style="grid-column: span 2;">
            <input type="password" name="password" placeholder="Mot de passe" required>
            <i class="fas fa-eye toggle-password"></i>
          </div>
        </div>
        <button type="submit">Valider l'inscription <i class="fas fa-check-circle"></i></button>
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
    </div>
  </div>
  @endif

  <!-- Notification Message -->
  @if(session('success'))
  <div class="notification-message" id="notificationMessage">
    <h1>Merci pour votre candidature ! 🎉</h1>
    <p>{{session('success')}}<br>Merci de votre confiance !</p>
    <p>check ur email for the response</p>
    <a href='{{route('home')}}'>Retour à l'accueil</a>
  </div>
@endif

  <script>
    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(icon => {
      icon.addEventListener('click', (e) => {
        const input = e.target.previousElementSibling;
        input.type = input.type === 'password' ? 'text' : 'password';
        e.target.classList.toggle('fa-eye-slash');
        e.target.classList.toggle('fa-eye');
      });
    });

    // Dark mode toggle
    document.querySelector('.dark-mode-toggle').addEventListener('click', () => {
      document.body.classList.toggle('dark-mode');
      document.querySelector('.dark-mode-toggle i').classList.toggle('fa-sun');
    });



  </script>
</body>

</html>
