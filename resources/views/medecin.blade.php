<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <title>heyDoc</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <style>
    :root {
      --primary: #71BFBD;
      --secondary: #80D0C7;
      --accent: #E9C46A;
      --light: #F8F9FA;
      --dark: #212529;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: var(--light);
      color: var(--dark);
      line-height: 1.6;
      transition: background-color 0.3s, color 0.3s;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: var(--secondary);
      padding: 1rem 2rem;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .navbar__brand {
      color: var(--light);
      font-size: 1.75rem;
      letter-spacing: 0.5px;
      font-weight: 600;
    }

    .navbar__actions {
      display: flex;
      gap: 1rem;
      align-items: center;
    }

    .navbar__actions button {
      background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
      color: white;
      border: none;
      padding: 0.75rem 1.5rem;
      border-radius: 8px;
      font-weight: 500;
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .navbar__actions button:hover {
      transform: translateY(-1px);
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .container {
      width: 90%;
      max-width: 1200px;
      margin: 2rem auto;
    }

    .search-bar {
      background: white;
      border-radius: 12px;
      padding: 1.5rem;
      margin: 2rem 0;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1rem;
    }

    .search-bar__group {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    .search-bar__group select,
    .search-bar__group input {
      padding: 0.75rem;
      border: 2px solid #e2e8f0;
      border-radius: 8px;
      font-size: 1rem;
      transition: border-color 0.3s;
    }

    .search-bar__group select:focus,
    .search-bar__group input:focus {
      border-color: var(--primary);
      outline: none;
    }

    .location-wrapper {
      position: relative;
    }

    .location-wrapper input {
      padding-right: 3rem;
    }

    .location-wrapper .location-icon {
      position: absolute;
      right: 1rem;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      width: 24px;
      height: 24px;
    }

    .location-icon.loading {
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      0% {
        transform: translateY(-50%) rotate(0deg);
      }

      100% {
        transform: translateY(-50%) rotate(360deg);
      }
    }

    .search-bar__button {
      background: var(--primary);
      color: white;
      border: none;
      padding: 0.75rem 1.5rem;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.3s;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }

    .search-bar__button:hover {
      background: var(--secondary);
    }

    .tabs {
      display: flex;
      gap: 1rem;
      margin-bottom: 2rem;
    }

    .tabs button {
      padding: 0.75rem 1.5rem;
      border: none;
      border-radius: 8px;
      background: transparent;
      color: var(--dark);
      font-weight: 500;
      transition: background 0.3s, color 0.3s;
      cursor: pointer;
    }

    .tabs .active {
      background: var(--primary);
      color: white;
    }

    .doctor-list {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    .doctor-item {
      background: white;
      padding: 1.5rem;
      border-radius: 12px;
      border: 1px solid #e2e8f0;
      display: grid;
      grid-template-columns: auto 1fr auto;
      gap: 1.5rem;
      align-items: center;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .doctor-item:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
    }

    .doctor-item__avatar {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid var(--primary);
    }

    .doctor-item__name {
      font-size: 1.25rem;
      font-weight: 600;
    }

    .phone-link {
      margin-left: 8px;
      text-decoration: none;
      font-size: 1rem;
      color: var(--primary);
    }

    .doctor-item__specialty {
      color: var(--primary);
      font-weight: 600;
      margin-bottom: 0.5rem;
    }

    .doctor-item__location {
      color: #64748b;
      margin-bottom: 0.5rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .doctor-item__location a {
      text-decoration: none;
      color: var(--primary);
    }

    .doctor-item__date {
      color: var(--secondary);
      font-weight: 600;
      margin-bottom: 1rem;
    }

    .rating {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      color: #f59e0b;
      margin-bottom: 0.5rem;
    }

    .badge {
      background: var(--accent);
      color: var(--secondary);
      padding: 0.25rem 0.75rem;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 500;
    }

    .price {
      font-size: 1.25rem;
      color: var(--secondary);
      font-weight: 700;
      margin-top: 0.5rem;
    }

    .appointment-button {
      background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
      color: white;
      border: none;
      padding: 0.75rem 1.5rem;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.3s;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .appointment-button:hover {
      background: var(--secondary);
    }

    .no-results {
      text-align: center;
      padding: 2rem;
      color: #666;
      font-size: 1.2rem;
    }

    body.dark-mode .no-results {
      color: #aaa;
    }

    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.5);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }

    .modal-overlay.active {
      display: flex;
    }

    .modal {
      background: white;
      padding: 2rem;
      border-radius: 16px;
      width: 90%;
      max-width: 400px;
      position: relative;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
      border: 1px solid #e2e8f0;
      transition: background-color 0.3s, color 0.3s;
    }

    .modal-close {
      position: absolute;
      top: 1rem;
      right: 1rem;
      background: none;
      border: none;
      font-size: 1.5rem;
      cursor: pointer;
      color: var(--dark);
    }

    .modal h2 {
      font-size: 1.5rem;
      margin-bottom: 0.5rem;
      color: var(--primary);
    }

    .modal p {
      margin-bottom: 1rem;
      color: #555;
    }

    .calendar {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #e2e8f0;
      border-radius: 8px;
      font-size: 1rem;
      margin-top: 0.5rem;
      margin-bottom: 1rem;
    }

    body.dark-mode {
      background-color: #121212;
      color: #e0e0e0;
    }

    body.dark-mode .navbar {
      background: #2d2d2d;
    }

    body.dark-mode .search-bar,
    body.dark-mode .modal,
    body.dark-mode .doctor-item {
      background: #1e1e1e;
      border-color: #444;
    }

    body.dark-mode .search-bar__group select,
    body.dark-mode .search-bar__group input,
    {
    background: #2e2e2e;
    border-color: #444;
    color: #e0e0e0;
    }

    body.dark-mode .tabs button {
      padding: 0.75rem 1.5rem;
      border: none;
      border-radius: 8px;
      background: transparent;
      color: #e0e0e0;
      font-weight: 500;
      transition: background 0.3s, color 0.3s;
      cursor: pointer;
    }

    body.dark-mode .tabs .active {
      background: var(--primary);
      color: white;
    }

    body.dark-mode .doctor-item__location,
    body.dark-mode .doctor-item__date {
      color: #bbb;
    }

    .back-to-top {
      position: fixed;
      bottom: 2rem;
      right: 2rem;
      background: var(--primary);
      color: white;
      border: none;
      padding: 0.75rem;
      border-radius: 50%;
      cursor: pointer;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
      display: none;
      transition: opacity 0.3s;
      z-index: 1100;
    }

    .back-to-top.show {
      display: block;
    }

    @media (max-width: 768px) {
      .navbar {
        padding: 1rem;
        flex-direction: column;
        gap: 1rem;
      }

      .search-bar {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>

<body>
  <nav class="navbar">
    <div class="navbar__brand">heyDoc</div>
    <div class="navbar__actions">
      <button class="dark-mode-toggle" id="darkModeBtn">Dark Mode</button>
      <button id="loginBtn">inscrire</button>
    </div>
  </nav>

  <div class="container">
    <div class="search-bar">
      <div class="search-bar__group">
        <select id="specialtySelect">
          <option value="">Spécialité</option>
          <option value="Dentiste">Dentiste</option>
          <option value="Cardiologue">Cardiologue</option>
          <option value="Dermatologue">Dermatologue</option>
        </select>
      </div>
      <div class="search-bar__group">
        <div class="location-wrapper">

          <input type="text" id="locationInput" placeholder="Localisation">
          <span class="location-icon" id="locationIcon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="#212529" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="7" />
              <circle cx="12" cy="12" r="3" fill="#80D0C7" />
              <line x1="12" y1="1" x2="12" y2="3"></line>
              <line x1="12" y1="21" x2="12" y2="23"></line>
              <line x1="1" y1="12" x2="3" y2="12"></line>
              <line x1="21" y1="12" x2="23" y2="12"></line>
            </svg>
          </span>
        </div>
      </div>
      <div class="search-bar__group">
        <input type="date" id="dateInput">
      </div>
      <button class="search-bar__button" id="searchBtn">Rechercher</button>
    </div>

    <div class="tabs">
      <button class="active" data-tab="all">Tous</button>
      <button data-tab="praticien">Praticiens</button>
      <button data-tab="laboratoire">laboratoire</button>
    </div>

    <div class="doctor-list" id="doctorList"></div>
  </div>

  <button class="back-to-top" id="backToTop" title="Retour en haut">↑</button>

  <div class="modal-overlay" id="loginModal">
    <div class="modal">
      <button class="modal-close" id="closeLoginModal">&times;</button>
      <h2>Connexion</h2>
      <form>
        <input type="text" placeholder="Nom d'utilisateur" required>
        <input type="password" placeholder="Mot de passe" required>
        <button type="submit" class="search-bar__button">Se connecter</button>
      </form>
    </div>
  </div>

  <div class="modal-overlay" id="appointmentModal">
    <div class="modal">
      <button class="modal-close" id="closeAppointmentModal">&times;</button>
      <h2>Réserver un Rendez-vous</h2>
      <p>Sélectionnez votre date et créneau horaire</p>
      <input type="text" id="appointmentDate" class="calendar">
      <select id="appointmentTime" class="calendar">
        <option value="09:00">09:00 - 09:30</option>
        <option value="09:30">09:30 - 10:00</option>
        <option value="10:00">10:00 - 10:30</option>
        <option value="10:30">10:30 - 11:00</option>
        <option value="11:00">11:00 - 11:30</option>
        <option value="11:30">11:30 - 12:00</option>
      </select>
      <button class="appointment-button" id="confirmAppointment">Prendre RDV</button>
    </div>
  </div>

  <script>
    const doctors = [
      {
        id: 1,
        name: 'Dr. Samir Bentounsi',
        specialty: 'Dentiste',
        location: 'Lot 230 UV Nouvelle Ville, Constantine',
        date: '2023-02-28',
        rating: 4.5,
        price: 2000,
        type: 'doctor',
        image: 'https://via.placeholder.com/100',
        available: true,
        phone: '+213123456789'
      },
      {
        id: 2,
        name: 'Dr. Amina Belkadi',
        specialty: 'Dermatologue',
        location: 'Rue Didouche Mourad, Alger Centre',
        date: '2023-03-01',
        rating: 4.8,
        price: 2500,
        type: 'praticien',
        image: 'https://via.placeholder.com/100',
        available: true,
        phone: '+213987654321'
      },
      {
        id: 3,
        name: 'Clinique El Mountazah',
        specialty: 'Multi-spécialités',
        location: 'Cité 2004 Logements, Oran',
        date: '2023-03-05',
        rating: 4.7,
        price: 1800,
        type: 'clinique',
        image: 'https://via.placeholder.com/100',
        available: false,
        phone: '+213555123456'
      },
      {
        id: 4,
        name: 'Dr. Karim Ouali',
        specialty: 'Cardiologue',
        location: 'Sidi Mabrouk, Constantine',
        date: '2023-03-10',
        rating: 4.6,
        price: 3000,
        type: 'praticien',
        image: 'https://via.placeholder.com/100',
        available: true,
        phone: '+213666777888'
      },
      {
        id: 5,
        name: 'Clinique Ibn Sina',
        specialty: 'Chirurgie',
        location: 'Bir Mourad Raïs, Alger',
        date: '2023-03-15',
        rating: 4.9,
        price: 2200,
        type: 'clinique',
        image: 'https://via.placeholder.com/100',
        available: true,
        phone: '+213222333444'
      }
    ];

    const doctorListEl = document.getElementById('doctorList');
    const darkModeBtn = document.getElementById('darkModeBtn');
    const loginBtn = document.getElementById('loginBtn');
    const loginModal = document.getElementById('loginModal');
    const closeLoginModal = document.getElementById('closeLoginModal');
    const tabs = document.querySelectorAll('.tabs button');
    let currentTab = 'all';

    // Update tab counts
    const counts = {
      all: doctors.length,
      praticien: doctors.filter(d => d.type === 'doctor').length,
      clinique: doctors.filter(d => d.type === 'laboratoiare').length
    };

    tabs[0].innerHTML = `Tous (${counts.all})`;
    tabs[1].innerHTML = `doctors (${counts.praticien})`;
    tabs[2].innerHTML = `laboratoire (${counts.clinique})`;

    function renderDoctors(filter = 'all') {
      doctorListEl.innerHTML = '';
      const filtered = filter === 'all' ? doctors : doctors.filter(doc => doc.type === filter);

      if (filtered.length === 0) {
        doctorListEl.innerHTML = `<div class="no-results">Aucun résultat trouvé</div>`;
        return;
      }

      filtered.forEach(doctor => {
        const starRating = '★★★★★'.slice(0, Math.floor(doctor.rating)) +
          '☆'.repeat(5 - Math.ceil(doctor.rating));
        const doctorItem = document.createElement('div');
        doctorItem.className = 'doctor-item';
        doctorItem.innerHTML = `
          <img class="doctor-item__avatar" src="${doctor.image}" alt="Photo de ${doctor.name}">
          <div class="doctor-item__info">
            <div class="doctor-item__name">
              ${doctor.name}
              <a href="tel:${doctor.phone}" class="phone-link">📞</a>
            </div>
            <div class="doctor-item__specialty">
              ${doctor.specialty} • 
              <span class="rating">${starRating} ${doctor.rating}</span>
            </div>
            <div class="doctor-item__location">
              📍 <a href="https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(doctor.location)}" target="_blank">${doctor.location}</a>
            </div>
            <div class="doctor-item__date">📅 ${new Date(doctor.date).toLocaleDateString('fr-FR')}</div>
            <div class="doctor-item__extra">
              ${doctor.available ? '<span class="badge">Disponible aujourd\'hui</span>' : ''}
              <div class="price">${doctor.price} DA</div>
            </div>
          </div>
          <button class="appointment-button" onclick="openAppointmentModal(${doctor.id})">Prendre RDV</button>
        `;
        doctorListEl.appendChild(doctorItem);
      });
    }

    tabs.forEach(btn => {
      btn.addEventListener('click', () => {
        tabs.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        currentTab = btn.getAttribute('data-tab');
        renderDoctors(currentTab);
      });
    });

    darkModeBtn.addEventListener('click', () => {
      document.body.classList.toggle('dark-mode');
      darkModeBtn.textContent = document.body.classList.contains('dark-mode')
        ? 'Light Mode'
        : 'Dark Mode';
    });

    loginBtn.addEventListener('click', () => loginModal.classList.add('active'));
    closeLoginModal.addEventListener('click', () => loginModal.classList.remove('active'));
    loginModal.addEventListener('click', (e) => {
      if (e.target === loginModal) loginModal.classList.remove('active');
    });

    renderDoctors();

    const appointmentModal = document.getElementById('appointmentModal');
    const closeAppointmentModal = document.getElementById('closeAppointmentModal');
    const appointmentDate = document.getElementById('appointmentDate');
    const appointmentTime = document.getElementById('appointmentTime');
    const confirmAppointment = document.getElementById('confirmAppointment');
    let selectedDoctor = null;

    function openAppointmentModal(doctorId) {
      selectedDoctor = doctorId;
      appointmentModal.classList.add('active');
      flatpickr("#appointmentDate", {
        minDate: "today",
        maxDate: new Date().fp_incr(30),
        disable: ["2025-01-01", "2025-05-01", "2025-07-05"],
        dateFormat: "Y-m-d"
      });
    }

    function confirmAppointmentHandler() {
      if (!appointmentDate.value || !appointmentTime.value) {
        alert('Veuillez choisir une date et un créneau horaire.');
        return;
      }
      const nationalHolidays = ['2025-01-01', '2025-05-01', '2025-07-05'];
      if (nationalHolidays.includes(appointmentDate.value)) {
        alert('La date sélectionnée est un jour férié. Veuillez choisir une autre date.');
        return;
      }
      const doctorName = doctors.find(d => d.id === selectedDoctor).name;
      alert(`Rendez-vous confirmé avec ${doctorName} le ${appointmentDate.value} à ${appointmentTime.value}`);
      appointmentModal.classList.remove('active');
    }

    closeAppointmentModal.addEventListener('click', () => {
      appointmentModal.classList.remove('active');
    });
    confirmAppointment.addEventListener('click', confirmAppointmentHandler);

    const backToTop = document.getElementById('backToTop');
    window.addEventListener('scroll', () => {
      if (window.scrollY > 300) {
        backToTop.classList.add('show');
      } else {
        backToTop.classList.remove('show');
      }
    });

    backToTop.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  </script>
</body>

</html>