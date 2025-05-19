<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription Praticien</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
      color: #fffbfb;
    }

    .dark-mode .container {
      background: #25282d;
    }

    .dark-mode .hero-section {
      background: linear-gradient(135deg, #005f56, #004d44);
    }

    .dark-mode input,
    .dark-mode select,
    .dark-mode select option {
      background: #585e67;
      border-color: #3d4046;
      color: #fbfbfb;
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


    .dark-mode .form-control {
      background: #2d3035;
      color: #ffffff;
      border-color: #3d4046;
    }

    .dark-mode .form-control::placeholder {
      color: white !important;
      opacity: 1;
    }

    .dark-mode .select2-container--default .select2-selection--single {
      background: #2d3035;
      border-color: #3d4046;
      color: #ffffff;
    }

    .dark-mode .select2-container--default .select2-selection--single .select2-selection__placeholder {
      color: #fdfdfd;
    }

    .dark-mode .select2-container--default .select2-selection--single .select2-selection__placeholder {
      color: #fff;
    }


    .dark-mode .select2-container--default .select2-selection--single .select2-selection__rendered {
      color: #fff;
    }


    .dark-mode .select2-container--default .select2-dropdown {
      background-color: #2d3035;
    }

    .dark-mode .select2-container--default .select2-results__option {
      background-color: #2d3035;
      color: #e0e0e0;
    }


    .dark-mode .select2-container--default .select2-results__option--highlighted[aria-selected] {
      background-color: #3d4046;
      color: #fff;
    }




    .select2-results__option[aria-disabled=true] {
      display: none;
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
      font-weight: bold;
      padding: 12px 20px;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
      display: block;
      margin: 0 auto;
      transition: background 0.3s ease;
      text-decoration: none;
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
      color: #3498db;
      /* Choose a color */
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
      <h2 class="hero-title">Practitioners Platform</h2>
      <p class="hero-text">
      Join our network of healthcare professionals to connect, collaborate, and innovate.<br>
      Together, let's improve the care of tomorrow!
      </p>
    </div>
    <div class="form-section">
      <form id="signUpForm" action="{{route('registerp')}}" method="POST">
      @csrf
      <div class="form-grid">
        <div class="input-group">
        <input type="text" class="form-control @error('enum') is-invalid @enderror" name="enum"
          placeholder="doctor_ref" required>
        @error('enum')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="input-group">
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
          placeholder="full name" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror

        </div>
        <div class="input-group">
        <input type="number" class="form-control @error('age') is-invalid @enderror" name="age" placeholder="Âge"
          min="18" max="100" required>
        @error('age')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="input-group">
        <select class="form-control @error('sexe') is-invalid @enderror" name="sexe" required>
          <option value="" disabled selected>Sexe</option>
          <option value="Homme">Homme ♂️</option>
          <option value="Femme">Femme ♀️</option>
        </select>
        @error('sexe')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="input-group">
        <input type="tel" class="form-control @error('telephone') is-invalid @enderror" name="telephone"
          placeholder="Numéro de Téléphone" pattern="[0-9]{10}" required>
        @error('telephone')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="input-group">
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
          placeholder="Email professionnel" required>
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="input-group" style="grid-column: span 2;">

        <select id="type" name="type" placeholder="Type de prestataire"
          class="form-control @error('type') is-invalid @enderror" required>
          <option value="" disabled {{ old('type') ? '' : 'selected' }}> select your type</option>
          <option value="doctor" {{ old('type') == 'doctor' ? 'selected' : '' }}>Doctor</option>
          <option value="laboratoire" {{ old('type') == 'laboratoire' ? 'selected' : '' }}>Laboratoire</option>
        </select>
        @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="input-group" style="grid-column: span 2;">

        <select id="specialite" name="specialite" placeholder="Spécialité médicale"
          class="form-control @error('specialite') is-invalid @enderror" required>
          <!-- Toutes les options, marquées par data-type -->
          <option value="" disabled {{ old('specialite') ? '' : 'selected' }}>select your speciality</option>
          <option value="generaliste" data-type="doctor" {{ old('specialite') == 'generaliste' ? 'selected' : '' }}>
          Médecin généraliste 🩺</option>
          <option value="cardiologue" data-type="doctor" {{ old('specialite') == 'cardiologue' ? 'selected' : '' }}>
          Cardiologue ❤️</option>
          <option value="dermatologue" data-type="doctor" {{ old('specialite') == 'dermatologue' ? 'selected' : '' }}>
          Dermatologue 🧴</option>
          <option value="gynecologue" data-type="doctor" {{ old('specialite') == 'gynecologue' ? 'selected' : '' }}>
          Gynécologue 🤰</option>
          <option value="neurologue" data-type="doctor" {{ old('specialite') == 'neurologue' ? 'selected' : '' }}>
          Neurologue 🧠</option>
          <option value="radiologue" data-type="doctor" {{ old('specialite') == 'radiologue' ? 'selected' : '' }}>
          Radiologue 📸</option>
          <option value="orl" data-type="doctor" {{ old('specialite') == 'orl' ? 'selected' : '' }}>ORL 👂👃</option>
          <option value="pediatre" data-type="doctor" {{ old('specialite') == 'pediatre' ? 'selected' : '' }}>Pédiatre
          👶</option>
          <option value="psychiatre" data-type="doctor" {{ old('specialite') == 'psychiatre' ? 'selected' : '' }}>
          Psychiatre 😊</option>
          <option value="pneumologue" data-type="doctor" {{ old('specialite') == 'pneumologue' ? 'selected' : '' }}>
          Pneumologue 🫁</option>
          <option value="gastro" data-type="doctor" {{ old('specialite') == 'gastro' ? 'selected' : '' }}>
          Gastro-entérologue 🍽️</option>
          <option value="endocrino" data-type="doctor" {{ old('specialite') == 'endocrino' ? 'selected' : '' }}>
          Endocrinologue ⚖️</option>
          <option value="dentiste" data-type="doctor" {{ old('specialite') == 'dentiste' ? 'selected' : '' }}>
          Chirurgien-dentiste 🦷</option>
          <option value="osteopathe" data-type="doctor" {{ old('specialite') == 'osteopathe' ? 'selected' : '' }}>
          Ostéopathe 🤲</option>
          <option value="kine" data-type="doctor" {{ old('specialite') == 'kine' ? 'selected' : '' }}>
          Masseur-kinésithérapeute 💆‍♂️</option>
          <option value="ortho" data-type="doctor" {{ old('specialite') == 'ortho' ? 'selected' : '' }}>Orthophoniste
          🗣️</option>
          <option value="psychologue" data-type="doctor" {{ old('specialite') == 'psychologue' ? 'selected' : '' }}>
          Psychologue 🧠</option>
          <option value="analyse" data-type="laboratoire" {{ old('specialite') == 'analyse' ? 'selected' : '' }}>
          Laboratoire d’analyse 🔬</option>
          <option value="imagerie" data-type="laboratoire" {{ old('specialite') == 'imagerie' ? 'selected' : '' }}>
          Centre d’imagerie médicale 🩻</option>
        </select>
        @error('specialite')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>


        <div class="input-group" style="grid-column: span 2;">
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
          placeholder="Mot de passe" required>
        <i class="fas fa-eye toggle-password"></i>
        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
      </div>
      <button type="submit">validate inscription <i class="fas fa-check-circle"></i></button>
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

  <!-- jQuery et Select2 JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>

    $(function () {
      $('#type, #specialite').select2({

        width: '100%'
      });

      // disable all specialties & their Select2 entries on load
      $('#specialite option[data-type]').prop('disabled', true);
      $('#specialite').prop('disabled', true)
        .trigger('change.select2');

      $('#type').on('change', function () {
        var chosen = this.value;

        // enable the specialite select
        $('#specialite').prop('disabled', false);

        // disable/enable options based on data-type
        $('#specialite option[data-type]').each(function () {
          var $o = $(this);
          $o.prop('disabled', $o.data('type') !== chosen);
        });

        // clear any previous choice & refresh Select2
        $('#specialite')
          .val(null)
          .trigger('change.select2');
      });

      // if returning with an old('type'), trigger the filtering
      if ($('#type').val()) {
        $('#type').trigger('change');
      }
    });
  </script>
</body>

</html>