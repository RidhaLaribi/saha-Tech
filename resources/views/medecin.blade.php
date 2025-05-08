<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Google Fonts & Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

  <!-- Flatpickr CSS & Theme -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css" />

  <title>Hey-Doc</title>


  <style>
    :root {
      --white-color: #ffffff;
      --primary-color: #13547a;
      --secondary-color: #80d0c7;
      --accent: #80d0c7;
      --section-bg-color: #f0f8ff;
      --input-border-color: rgba(0, 0, 0, 0.15);
      --input-focus-color: var(--primary-color);
      --dark-color: #000000;
      --transition: 0.3s ease-in-out;
      --body-font-family: 'Poppins', sans-serif;
      --title-font-family: 'Montserrat', sans-serif;
      --gradient: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
    }

    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: var(--body-font-family);
      background: var(--gradient);
      color: var(--dark-color);
      line-height: 1.6;
      overflow-x: hidden;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    /* Navbar */
    .navbar {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 2rem;
      background: var(--gradient);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .navbar__brand {
      color: var(--white-color);
      font-size: 1.75rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: .5rem;
    }

    .navbar__actions {
      display: flex;
      gap: 1rem;
    }

    .navbar__actions button {
      background: var(--white-color);
      color: var(--dark-color);
      border: none;
      padding: .5rem 1rem;
      border-radius: 8px;
      font-weight: 500;
      cursor: pointer;
      transition: transform var(--transition), box-shadow var(--transition);
      display: flex;
      align-items: center;
      gap: .5rem;
    }

    .navbar__actions button:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .container {
      width: 90%;
      max-width: 1200px;
      margin: 2rem auto;
      padding: 1rem 0 2rem;
    }

    /* Search Bar */
    .search-bar {
      background: var(--section-bg-color);
      border-radius: 10px;
      padding: 1.5rem;
      margin-bottom: 1.5rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1rem;
      align-items: center;
      transition: transform var(--transition);
    }

    .search-bar:hover {
      transform: scale(1.01);
    }

    .search-bar__group {
      display: flex;
      flex-direction: column;
    }

    .search-bar__group label {
      margin-bottom: .4rem;
      font-weight: 600;
    }

    .search-bar__group select,
    .search-bar__group input {
      width: 100%;
      padding: .6rem;
      border: 2px solid var(--input-border-color);
      border-radius: 6px;
      font-size: .9rem;
      background: var(--white-color);
      transition: border-color var(--transition), box-shadow var(--transition);
    }

    .search-bar__group input:focus,
    .search-bar__group select:focus {
      border-color: var(--input-focus-color);
      box-shadow: 0 0 8px rgba(19, 84, 122, 0.3);
      outline: none;
    }

    .location-wrapper {
      position: relative;
    }

    .location-wrapper input {
      padding-right: 2.5rem;
    }

    .location-wrapper button#getLocationBtn {
      position: absolute;
      right: .75rem;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      font-size: 1rem;
      color: var(--primary-color);
      transition: color var(--transition);
    }

    .location-wrapper button#getLocationBtn:hover {
      color: var(--secondary-color);
    }

    .search-bar__button {
      background: var(--gradient);
      color: var(--white-color);
      border: none;
      padding: .75rem 1.5rem;
      border-radius: 6px;
      font-weight: 600;
      cursor: pointer;
      transition: background var(--transition), transform var(--transition), box-shadow var(--transition);
      display: flex;
      align-items: center;
      gap: .5rem;
    }

    .search-bar__button:hover {
      /* reverse gradient on hover */
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      transform: translateY(-2px);
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
    }

    /* Tabs */
    .tabs {
      display: flex;
      justify-content: center;
      gap: 1rem;
      margin-bottom: 2rem;
    }

    .tabs button {
      background: #e2e8f0;
      color: var(--dark-color);
      padding: .75rem 1.5rem;
      border: none;
      border-radius: 8px;
      font-weight: 500;
      cursor: pointer;
      transition: background var(--transition), color var(--transition);
      display: flex;
      align-items: center;
      gap: .5rem;
    }

    .tabs button.active {
      background: var(--primary-color);
      color: var(--white-color);
    }

    .tabs button:hover:not(.active) {
      background: #d1d5db;
    }

    /* Doctor Cards */
    .doctor-list {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 1.5rem;
    }

    .doctor-item {
      background: var(--white-color);
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      transition: transform var(--transition), box-shadow var(--transition);
      display: flex;
      flex-direction: column;
    }

    .doctor-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .doctor-item__avatar {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .doctor-item__info {
      padding: 1rem;
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: .75rem;
    }

    .doctor-item__name {
      font-size: 1.25rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: .5rem;
    }

    .phone-link {
      color: var(--primary-color);
      transition: color var(--transition);
    }

    .phone-link:hover {
      color: var(--secondary-color);
    }

    .doctor-item__specialty {
      color: var(--primary-color);
      font-weight: 500;
    }

    .rating {
      font-size: .9rem;
      color: #f59e0b;
      display: flex;
      align-items: center;
      gap: .25rem;
    }

    .doctor-item__location {
      font-size: .9rem;
      color: #64748b;
      display: flex;
      align-items: center;
      gap: .5rem;
    }

    .doctor-item__extra {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-top: .5rem;
      border-top: 1px solid #e2e8f0;
    }

    .price {
      font-size: 1.25rem;
      color: var(--secondary-color);
      font-weight: 700;
    }

    .appointment-btn {
      background: var(--gradient);
      color: var(--white-color);
      border: none;
      padding: .75rem;
      font-size: 1rem;
      font-weight: 600;
      border-radius: 8px;
      cursor: pointer;
      transition: transform var(--transition), box-shadow var(--transition);
      margin-top: 1rem;
    }

    .appointment-btn:hover {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      transform: scale(1.05);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    /* Modal */
    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.6);
      display: none;
      align-items: center;
      justify-content: center;
      z-index: 1000;
    }

    .modal-overlay.active {
      display: flex;
    }

    .modal {
      background: var(--white-color);
      border-radius: 12px;
      max-width: 800px;
      width: 90%;
      padding: 1.5rem;
      position: relative;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1rem;
    }

    .modal-header h2 {
      font-family: var(--title-font-family);
      font-size: 1.75rem;
    }

    .modal-close {
      background: none;
      border: none;
      font-size: 1.5rem;
      cursor: pointer;
    }

    .modal-body {
      max-height: 70vh;
      overflow-y: auto;
    }

    .doctor-profile {
      display: grid;
      grid-template-columns: 200px 1fr;
      gap: 1.5rem;
      margin-bottom: 1.5rem;
    }

    .doctor-avatar {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 10px;
    }

    .form-section {
      margin-bottom: 1.5rem;
    }

    .form-section h3 {
      margin-bottom: .75rem;
      font-size: 1.1rem;
      color: var(--primary-color);
    }

    .form-group {
      margin-bottom: 1rem;
    }

    .form-group label {
      display: block;
      margin-bottom: .5rem;
      font-weight: 500;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
      width: 100%;
      padding: .75rem;
      border: 2px solid #e2e8f0;
      border-radius: 8px;
      font-size: 1rem;
      transition: border-color var(--transition);
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
      border-color: var(--primary-color);
      outline: none;
    }

    .modal-footer {
      display: flex;
      justify-content: flex-end;
      gap: 1rem;
    }

    /* Time‑slots */
    .time-slots {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
      gap: .5rem;
      margin-top: 1rem;
    }

    .time-slot {
      padding: .5rem;
      text-align: center;
      border: 2px solid var(--secondary-color);
      border-radius: 6px;
      cursor: pointer;
      transition: background var(--transition), color var(--transition);
    }

    .time-slot.selected {
      background: var(--secondary-color);
      color: var(--white-color);
    }

    /* Back to Top */
    .back-to-top {
      position: fixed;
      bottom: 2rem;
      right: 2rem;
      background: var(--primary-color);
      color: var(--white-color);
      border: none;
      padding: 1rem;
      border-radius: 50%;
      cursor: pointer;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
      display: none;
      transition: opacity var(--transition);
      z-index: 1100;
    }

    .back-to-top.show {
      display: block;
    }

    @media (max-width:768px) {
      .navbar {
        flex-direction: column;
        align-items: flex-start;
      }

      .search-bar {
        grid-template-columns: 1fr;
      }

      .doctor-list {
        grid-template-columns: 1fr;
      }

      .doctor-profile {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar">
    <div class="navbar__brand"><i class="fas fa-hospital"></i> Hey-Doc</div>
    <div class="navbar__actions">
      <button id="darkModeBtn"><i class="fas fa-moon"></i> Dark Mode</button>
      <button id="loginBtn"><i class="fas fa-user"></i> Se connecter</button>
    </div>
  </nav>

  <!-- Main Container -->
  <div class="container">
    <!-- Search Bar -->
    <div class="search-bar">
      <div class="search-bar__group">
        <label for="specialtySelect">Spécialité</label>
        <select id="specialtySelect">
          <option value="" disabled selected>Choisissez une spécialité</option>
          <option value="Dentiste">Dentiste</option>
          <option value="Cardiologue">Cardiologue</option>
          <option value="Dermatologue">Dermatologue</option>
        </select>
      </div>
      <div class="search-bar__group">
        <label for="locationInput">Localisation</label>
        <div class="location-wrapper">
          <input type="text" id="locationInput" placeholder="Ville ou wilaya" />
          <button id="getLocationBtn" title="Obtenir ma position"><i class="fas fa-location-arrow"></i></button>
        </div>
      </div>
      <div class="search-bar__group">
        <label for="dateInput">Date</label>
        <input type="text" id="dateInput" placeholder="Sélectionnez une date" />
      </div>
      <button class="search-bar__button" id="searchBtn"><i class="fas fa-search"></i> Rechercher</button>
    </div>

    <!-- Tabs -->
    <div class="tabs">
      <button class="active" data-tab="all"><i class="fas fa-list"></i> All ({{ $counts['all'] ?? 0 }})</button>
      <button data-tab="doctor"><i class="fas fa-stethoscope"></i> doctors ({{ $counts['praticien'] ?? 0 }})</button>
      <button data-tab="laboratoire"><i class="fas fa-hospital"></i> laboratories
        ({{ $counts['clinique'] ?? 0 }})</button>
    </div>
    <!-- Doctor List -->
    <div class="doctor-list">
      @isset($doctors)
      @forelse($doctors as $doctor)
      <div class="doctor-item" data-specialty="{{ strtolower($doctor->specialty) }}" data-type="{{ $doctor->type }}"
      data-location="{{ strtolower($doctor->location) }}">
      <img src="{{ asset('storage/' . ($doctor->pic ?? 'image.png')) }}" class="doctor-item__avatar"
      alt="Dr. {{ $doctor->user->name }}">

      <div class="doctor-item__info">
      <div class="doctor-item__name">
      <i class="fas fa-user-md"></i> {{ $doctor->user->name }}
      <a href="tel:{{ $doctor->user->tel }}" class="phone-link">
        <i class="fas fa-phone"></i>
      </a>
      </div>

      <div class="doctor-item__specialty">{{ $doctor->specialty }}</div>

      @if($doctor->location)
      <div class="doctor-item__location">
      <i class="fas fa-map-marker-alt"></i> {{ $doctor->location }}
      </div>
      @endif

      <div class="doctor-item__extra">
      <div class="rating">
        {{ str_repeat('★', floor($doctor->rating)) }}{{ str_repeat('☆', 5 - ceil($doctor->rating)) }}
      </div>
      @if($doctor->price)
      <div class="price">{{ $doctor->price }} DA</div>
      @endif
      </div>

      <button class="appointment-btn open-modal-btn" data-doctor-id="{{ $doctor->id }}"
      data-doctor-name="{{ $doctor->user->name }}" data-doctor-specialty="{{ $doctor->specialty }}"
      data-doctor-price="{{ $doctor->price }}" data-doctor-image="{{ $doctor->image ?? 'default-doctor.jpg' }}">
      <i class="fas fa-calendar-plus"></i> Prendre Rendez-vous
      </button>
      </div>
      </div>
    @empty
      <div class="no-results">Aucun médecin disponible actuellement</div>
    @endforelse
    @else
      <div class="no-results">Erreur de chargement des données</div>
    @endisset
    </div>
  </div>

  <!-- Appointment Modal -->
  <div class="modal-overlay" id="appointmentModal">
    <div class="modal">
      <div class="modal-header">
        <button class="modal-close">&times;</button>
        <h2>Prendre rendez-vous avec <span id="modalDoctorName"></span></h2>
      </div>
      <div class="modal-body">
        <div class="doctor-profile">
          <img id="modalDoctorImage" class="doctor-avatar" alt="Photo du médecin">
          <div class="doctor-info">
            <div class="specialty">
              <i class="fas fa-stethoscope"></i> <span id="modalDoctorSpecialty"></span>
            </div>
            <div class="price">
              <span class="badge"><span id="modalDoctorPrice"></span> DA</span>
            </div>
          </div>
        </div>



        <input type="hidden" id="modalDoctorId" name="doctor_id">

        <div class="form-section">
          <h3>Type de rendez-vous</h3>
          <div class="form-group">
            <select name="appointment_type" required>
              <option value="">Sélectionnez le type</option>
              <option value="consultation">Consultation générale</option>
              <option value="followup">Suivi de traitement</option>
              <option value="emergency">Urgence</option>
            </select>
          </div>
        </div>

        <div class="form-section">
          <h3>Date et heure</h3>
          <div class="form-group">
            <input type="datetime-local" id="appointmentDateTime" name="appointment_date" required>
          </div>
        </div>

        <div class="form-section">
          <h3>Notes supplémentaires</h3>
          <div class="form-group">
            <textarea name="notes" placeholder="Notes supplémentaires..."></textarea>
          </div>
        </div>

        <button type="submit" class="appointment-btn full-width">
          <i class="fas fa-calendar-check"></i> Confirmer le rendez-vous
        </button>
        </form>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script>
    // Modal Handling
    document.querySelectorAll('.open-modal-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const doctorData = btn.dataset;
        document.getElementById('modalDoctorId').value = doctorData.doctorId;
        document.getElementById('modalDoctorName').textContent = doctorData.doctorName;
        document.getElementById('modalDoctorSpecialty').textContent = doctorData.doctorSpecialty;
        document.getElementById('modalDoctorPrice').textContent = doctorData.doctorPrice;
        document.getElementById('modalDoctorImage').src = doctorData.doctorImage;
        document.getElementById('appointmentModal').classList.add('active');
      });
    });

    document.querySelector('.modal-close').addEventListener('click', () => {
      document.getElementById('appointmentModal').classList.remove('active');
    });

    // Date/Time Picker
    flatpickr("#appointmentDateTime", {
      enableTime: true,
      dateFormat: "Y-m-d H:i",
      time_24hr: true,
      minDate: "today",
      locale: "fr"
    });

    // Filter Functionality
    const filterDoctors = () => {
      const specialty = document.getElementById('specialtySelect').value.toLowerCase();
      const location = document.getElementById('locationInput').value.toLowerCase();
      const type = document.querySelector('.tabs button.active').dataset.tab;

      document.querySelectorAll('.doctor-item').forEach(item => {
        const matchesSpecialty = item.dataset.specialty.includes(specialty);
        const matchesLocation = item.dataset.location.includes(location);
        const matchesType = type === 'all' || item.dataset.type === type;

        item.style.display = matchesSpecialty && matchesLocation && matchesType
          ? 'flex'
          : 'none';
      });
    };

    document.getElementById('searchBtn').addEventListener('click', filterDoctors);
    document.querySelectorAll('.tabs button').forEach(btn => {
      btn.addEventListener('click', () => {
        document.querySelector('.tabs button.active').classList.remove('active');
        btn.classList.add('active');
        filterDoctors();
      });
    });

    // Geolocation
    document.getElementById('getLocationBtn').addEventListener('click', () => {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(pos => {
          const lat = pos.coords.latitude.toFixed(4);
          const lon = pos.coords.longitude.toFixed(4);
          document.getElementById('locationInput').value = `Lat: ${lat}, Lon: ${lon}`;
        }, () => alert("Impossible de récupérer votre position"));
      } else {
        alert("Géolocalisation non supportée");
      }
    });
  </script>
</body>

</html>