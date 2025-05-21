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
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
      align-items: flex-end;
    }

    .search-bar:hover {
      transform: scale(1.01);
    }

    .search-bar__group {
      display: flex;
      flex-direction: column;
      min-width: 200px;
      flex: 1;
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
      display: flex;
      align-items: center;
    }

    .location-wrapper input {
      flex: 1;
      padding-right: 1rem;
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

    .search-bar__group--row {
      display: flex !important;
      flex-direction: row !important;
      align-items: flex-end !important;
      gap: 0.5rem !important;
      min-width: unset !important;
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

    .toggle-switch {
      position: relative;
      display: inline-block;
      width: 44px;
      height: 24px;
    }

    .toggle-switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .toggle-switch .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      transition: .4s;
      border-radius: 24px;
    }

    .toggle-switch .slider:before {
      position: absolute;
      content: "";
      height: 18px;
      width: 18px;
      left: 3px;
      bottom: 3px;
      background-color: white;
      transition: .4s;
      border-radius: 50%;
    }

    .toggle-switch input:checked+.slider {
      background-color: var(--primary-color);
    }

    .toggle-switch input:checked+.slider:before {
      transform: translateX(20px);
    }
  </style>
</head>


<body>
  <!-- Navbar -->
  <nav class="navbar">
    <div class="navbar__brand">
      <a href="{{ route("home") }}">

        <i class="fas fa-hospital"></i> Hey-Doc
    </div>
    </a>
    <div class="navbar__actions">
    </div>
  </nav>

  <!-- Main Container -->
  <div class="container">
    <div class="search-bar">
      <div class="search-bar__group">
        <label for="specialtySelect">Spécialité</label>
        <select id="specialtySelect">
          <option value="" disabled selected>Choisissez une spécialité</option>
          <option value="">all</option>
          <option value="génér" data-type="doctor" {{ old('specialite') == 'generaliste' ? 'selected' : '' }}>
            Médecin généraliste 🩺</option>
          <option value="car" data-type="doctor">
            Cardiologue ❤️</option>
          <option value="dermatol" data-type="doctor" {{ old('specialite') == 'dermatologue' ? 'selected' : '' }}>
            Dermatologue 🧴</option>
          <option value="gynecol" data-type="doctor" {{ old('specialite') == 'gynecologue' ? 'selected' : '' }}>
            Gynécologue 🤰</option>
          <option value="neurol" data-type="doctor" {{ old('specialite') == 'neurologue' ? 'selected' : '' }}>
            Neurologue 🧠</option>
          <option value="radiolo" data-type="doctor" {{ old('specialite') == 'radiologue' ? 'selected' : '' }}>
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
          <option value="osteopa" data-type="doctor" {{ old('specialite') == 'osteopathe' ? 'selected' : '' }}>
            Ostéopathe 🤲</option>
          <option value="kine" data-type="doctor" {{ old('specialite') == 'kine' ? 'selected' : '' }}>
            Masseur-kinésithérapeute 💆‍♂️</option>
          <option value="ortho" data-type="doctor" {{ old('specialite') == 'ortho' ? 'selected' : '' }}>Orthophoniste
            🗣️</option>
          <option value="psycholo" data-type="doctor" {{ old('specialite') == 'psychologue' ? 'selected' : '' }}>
            Psychologue 🧠</option>
          <option value="anal" data-type="laboratoire" {{ old('specialite') == 'analyse' ? 'selected' : '' }}>
            Laboratoire d’analyse 🔬</option>
          <option value="image" data-type="laboratoire" {{ old('specialite') == 'imagerie' ? 'selected' : '' }}>
            Centre d’imagerie médicale 🩻</option>
        </select>
      </div>

      <div class="search-bar__group">
        <label for="locationInput">Localisation</label>
        <div class="location-wrapper">
          <input type="text" id="locationInput" placeholder="Ville ou wilaya" />
          <button id="getLocationBtn" title="Obtenir ma position"><i class="fas fa-location-arrow"></i></button>
        </div>
      </div>

      <div class="search-bar__group" style="flex-direction: row; align-items: flex-end; gap: 0.5rem; min-width: unset;">
        <div style="display: flex; flex-direction: column;">
          <label for="nameInput">Nom du médecin</label>
          <input type="text" id="nameInput" placeholder="3 lettres minimum" minlength="3" />
        </div>
        <div style="display: flex; flex-direction: column;">
          <label for="availabilityToggle">Mobile</label>
          <label class="toggle-switch">
            <input type="checkbox" id="availabilityToggle">
            <span class="slider"></span>
          </label>
        </div>
      </div>

      <div class="search-bar__group">
        <label>&nbsp;</label>
        <button class="search-bar__button" id="searchBtn">
          <i class="fas fa-search"></i> Rechercher
        </button>
      </div>
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
      data-location="{{ strtolower($doctor->location) }}" data-home-visit="{{ $doctor->home_visit ? '1' : '0' }}"
      data-name="{{ strtolower($doctor->user->name) }}">
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
      <i class="fas fa-map-marker-alt"></i> <a
      href="https://www.google.com/maps/search/?api=1&query={{ urlencode($doctor->location) }}" target="_blank"
      rel="noopener noreferrer">
      {{ $doctor->location }}
      </a>
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
      data-doctor-price="{{ $doctor->price }}"
      data-doctor-image="{{ asset('storage/' . ($doctor->pic ?? 'image.png')) }}">
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
    <div class="booking-popup">
      <!-- Close button -->
      <button type="button" class="close-btn modal-close">&times;</button>

      <!-- Form -->
      <form method="POST" action="{{ route('appointments.store') }}">
        @csrf

        <div class="popup-grid">
          <!-- LEFT: Doctor Info -->
          <div class="popup-info">
            <img id="modalDoctorImage" class="avatar" src="" alt="Photo du médecin">
            <div class="info-text">
              <h3 id="modalDoctorName">Dr. Nom Prénom</h3>
              <p><i class="fas fa-stethoscope"></i> <span id="modalDoctorSpecialty">Spécialité</span></p>
              <p><i class="fas fa-map-marker-alt"></i> {{ $doctor->location ?? 'Lieu' }}</p>
              <p><strong><span id="modalDoctorPrice">0</span> DA</strong></p>
            </div>
          </div>

          <!-- RIGHT: Schedule Picker -->
          <div class="popup-schedule">


            <div class="day-switcher">

              <button type="button" id="prevDay">&lt;</button>

              <div id="displayDate">---</div>
              <button type="button" id="nextDay">&gt;</button>
            </div>


            <input type="hidden" name="doctor_id" id="formDoctorId">
            <input type="hidden" name="scheduled_at" id="formDateTime">

            <div class="slots-grid" id="slotsContainer">
              <!-- JS will inject 30-min slots here -->
            </div>

            <!-- In your modal form, add wherever you want the checkbox -->
            <div class="form-section">
              <label class="custom-checkbox">
                <input type="checkbox" name="reminder" id="reminderCheckbox">
                <span class="box"></span>
                <span class="label-text">In Home</span>
              </label>
            </div>
            <style>
              /* Custom styled checkbox */
              .custom-checkbox {
                display: inline-flex;
                align-items: center;
                cursor: pointer;
                user-select: none;
                gap: 0.5rem;
              }

              .custom-checkbox input {
                position: absolute;
                opacity: 0;
                pointer-events: none;
              }

              .custom-checkbox .box {
                width: 1.25rem;
                height: 1.25rem;
                border: 2px solid var(--primary-color);
                border-radius: 0.25rem;
                background: var(--white-color);
                transition: background 0.2s, border-color 0.2s;
                display: grid;
                place-items: center;
              }

              .custom-checkbox .box::before {
                content: '';
                width: 0.5rem;
                height: 0.9rem;
                border-right: 2px solid transparent;
                border-bottom: 2px solid transparent;
                transform: rotate(45deg) scale(0);
                transition: transform 0.1s ease-in-out;
              }

              .custom-checkbox input:checked+.box {
                background: var(--primary-color);
                border-color: var(--primary-color);
              }

              .custom-checkbox input:checked+.box::before {
                border-color: var(--white-color);
                transform: rotate(45deg) scale(1);
              }

              .custom-checkbox .label-text {
                font-size: 0.9rem;
                color: var(--dark-color);
              }
            </style>

          </div>
        </div>
        <div class="popup-footer">
          @if (!Auth::user() || Auth::user()->role != 'patient')
        <div class="form-section"><select name="type" required>

          <option value="emergency">Urgence</option>
        </select></div>
        <div class="form-section"><textarea name="tel" placeholder="telephone"></textarea></div>

      @else
        <div class="form-section">
        <select name="type" required>
          <option value="">Type de RDV…</option>
          <option value="consultation">Consultation générale</option>
          <option value="followup">Suivi de traitement</option>
          <option value="emergency">Urgence</option>
        </select>
        </div>
        <div class="form-section">
        <select name="pid" required>
          @foreach (Auth::user()->patient as $p)

        <option value="{{ $p->id }}">My {{  $p->rel . " " . $p->name }} </option>
      @endforeach
        </select>
        </div>
      @endif
          <button type="submit" class="appointment-btn"><i class="fas fa-calendar-check"></i>Confirmer </button>
        </div>
      </form>
    </div>
  </div>

  <style>
    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      bottom: 0;
      right: 0;
      background: rgba(0, 0, 0, 0.4);
      display: none;
      align-items: center;
      justify-content: center;
      z-index: 1000;
    }

    .modal-overlay.active {
      display: flex;
    }

    .booking-popup {
      height: 500px;

      background: #fff;
      border-radius: 12px;
      width: 800px;
      max-width: 95%;
      padding: 1.5rem;
      position: relative;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
      display: flex;
      flex-direction: column;
    }

    .close-btn {
      position: absolute;
      top: 1rem;
      right: 1rem;
      background: none;
      border: none;
      font-size: 1.5rem;
      cursor: pointer;
    }

    .popup-grid {
      display: grid;
      grid-template-columns: 1fr 1.5fr;
      padding-top: 20px;
      gap: 1.5rem;
    }

    .popup-info {
      display: flex;
      gap: 1rem;
    }

    .popup-info .avatar {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      object-fit: cover;
    }

    .info-text h3 {
      margin-bottom: .25rem;
    }

    .popup-schedule {
      display: flex;
      flex-direction: column;
    }

    .day-switcher {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1rem;
    }

    .day-switcher button {
      background: none;
      border: none;
      font-size: 1.25rem;
      cursor: pointer;
    }

    #displayDate {
      font-weight: 600;
    }

    .slots-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
      gap: .5rem;
      margin-bottom: .75rem;
    }

    .slots-grid .slot {
      padding: .5rem 0;
      text-align: center;
      border-radius: 20px;
      background: #e0f7ef;
      cursor: pointer;
      user-select: none;
      transition: background .2s;
    }

    .slots-grid .slot.selected {
      background: #80d0c7;
      color: #fff;
    }

    .more-link {
      font-size: .85rem;
      color: #007bff;
      text-decoration: none;
    }

    .popup-footer {
      margin-top: 1.5rem;
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-between;
    }

    .popup-footer .form-section {
      flex: 1;
    }

    .popup-footer select,
    .popup-footer textarea {
      width: 100%;
      padding: .75rem;
      border-radius: 8px;
      border: 2px solid #e2e8f0;
    }

    .appointment-btn {
      background: var(--gradient);
      color: #fff;
      padding: .75rem 1.5rem;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: .5rem;
      cursor: pointer;
    }
  </style>

  {{-- And this script at the bottom of your

  <body>, after flatpickr --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
      // 1) takenSlots comes from your controller: { doctorId: ['2025-05-08 14:00:00', ...], ... }
      const takenSlots = @json($takenSlots);

      const overlay = document.getElementById('appointmentModal');
      const slotsCont = document.getElementById('slotsContainer');
      const prevDay = document.getElementById('prevDay');
      const nextDay = document.getElementById('nextDay');
      const displayDt = document.getElementById('displayDate');
      let currentDate = new Date();

      // Utility to format date in French short (jeu. 08 mai)
      function fmt(d) {
        return d.toLocaleDateString('fr-FR', {
          weekday: 'short', day: '2-digit', month: 'short'
        });
      }

      //    - else allow toggle select/deselect (multiple)
      function renderSlots(date) {
        slotsCont.innerHTML = '';

        // Build date prefix, e.g. "2025-05-08 "
        const dayPrefix = date.toISOString().slice(0, 10) + ' ';
        const doctorId = document.getElementById('formDoctorId').value;
        const allTaken = takenSlots[doctorId] || [];

        // Keep only those taken on our current day, then strip the date part
        const takenTimes = allTaken
          .filter(ts => ts.startsWith(dayPrefix))
          .map(ts => ts.slice(dayPrefix.length)); // ["14:00:00", "15:30:00", ...]

        for (let h = 9; h < 17; h++) {
          [0, 30].forEach(m => {
            const hh = String(h).padStart(2, '0'),
              mm = String(m).padStart(2, '0'),
              timeStr = `${hh}:${mm}:00`,
              slotTs = dayPrefix + timeStr;

            const btn = document.createElement('div');
            btn.className = 'slot';
            btn.textContent = `${hh}:${mm}`;

            if (takenTimes.includes(timeStr)) {
              // disabled only if that exact time on this day is taken
              btn.classList.add('disabled');
              btn.style.cursor = 'not-allowed';
            } else {
              btn.addEventListener('click', () => {
                // toggle selection
                const selected = btn.classList.toggle('selected');

                // read current array from hidden input
                let arr = document.getElementById('formDateTime').value
                  .split(',')
                  .map(s => s.trim())
                  .filter(s => s);

                if (selected) {
                  arr.push(slotTs);
                } else {
                  arr = arr.filter(s => s !== slotTs);
                }

                document.getElementById('formDateTime').value = arr.join(',');
              });
            }

            slotsCont.appendChild(btn);
          });
        }
      }

      // 3) updateDay: change currentDate and rerender
      function updateDay(delta) {
        currentDate.setDate(currentDate.getDate() + delta);
        displayDt.textContent = fmt(currentDate);
        renderSlots(currentDate);
      }

      // 4) Wire prev/next
      @if (Auth::user() && Auth::user()->role === 'patient')

      prevDay.addEventListener('click', () => updateDay(-1));
      nextDay.addEventListener('click', () => updateDay(1));
    @endif

      // 5) Flatpickr optional: click date label to pick another day
      flatpickr(displayDt, {
        defaultDate: currentDate,
        clickOpens: true,
        onChange: ([d]) => { currentDate = d; updateDay(0); },
        dateFormat: "D, d M"
      });

      // 6) Open modal & inject doctor data
      document.querySelectorAll('.open-modal-btn').forEach(btn => {
        btn.addEventListener('click', () => {
          const { doctorId, doctorName, doctorSpecialty, doctorPrice, doctorImage } = btn.dataset;
          document.getElementById('modalDoctorName').textContent = doctorName;
          document.getElementById('modalDoctorSpecialty').textContent = doctorSpecialty;
          document.getElementById('modalDoctorPrice').textContent = doctorPrice;
          document.getElementById('modalDoctorImage').src = doctorImage;
          document.getElementById('formDoctorId').value = doctorId;
          // clear any previous selections
          document.getElementById('formDateTime').value = '';
          updateDay(0);
          overlay.classList.add('active');
        });
      });

      // 7) Close modal
      document.querySelectorAll('.modal-close').forEach(x =>
        x.addEventListener('click', () => overlay.classList.remove('active'))
      );


      displayDt.textContent = fmt(currentDate);
      renderSlots(currentDate);
    </script>



    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
      // Geolocation and Filtering Code
      let lastGeolocationRequest = 0;
      const GEOLOCATION_COOLDOWN = 1000;

      async function handleGeolocation() {
        const now = Date.now();
        if (now - lastGeolocationRequest < GEOLOCATION_COOLDOWN) {
          alert("Veuillez patienter entre les requêtes");
          return;
        }
        lastGeolocationRequest = now;

        const btn = document.getElementById('getLocationBtn');
        const icon = btn.querySelector('i');
        const locationInput = document.getElementById('locationInput');

        try {
          btn.disabled = true;
          icon.classList.replace('fa-location-arrow', 'fa-spinner');

          const position = await new Promise((resolve, reject) => {
            navigator.geolocation.getCurrentPosition(resolve, reject, {
              enableHighAccuracy: true,
              timeout: 10000,
              maximumAge: 0
            });
          });

          const response = await fetch(
            `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${position.coords.latitude}&lon=${position.coords.longitude}&addressdetails=1`,
            {
              headers: {
                'Accept-Language': 'fr',
                'User-Agent': 'HeyDocApp/1.0 (Contact: contact@heydoc.dz)'
              }
            }
          );

          if (!response.ok) throw new Error('Erreur API');

          const data = await response.json();
          const address = data.address || {};

          const locationName = [
            address.city,
            address.town,
            address.village,
            address.municipality,
            address.county,
            address.state,
            address.region
          ].find(name => name && name.length > 1);

          locationInput.value = locationName ||
            `${position.coords.latitude.toFixed(4)}, ${position.coords.longitude.toFixed(4)}`;

        } catch (error) {
          console.error('Erreur:', error);
          alert(`Erreur: ${error.message || 'Impossible de déterminer votre position'}`);
        } finally {
          btn.disabled = false;
          icon.classList.replace('fa-spinner', 'fa-location-arrow');
        }
      }

      // Filter Function
      function filterDoctors() {
        const specialty = document.getElementById('specialtySelect').value.toLowerCase();
        const location = document.getElementById('locationInput').value.toLowerCase();
        const nameQuery = document.getElementById('nameInput').value.trim().toLowerCase();
        const homeOnly = document.getElementById('availabilityToggle').checked;
        const type = document.querySelector('.tabs button.active').dataset.tab;

        document.querySelectorAll('.doctor-item').forEach(item => {
          const ds = item.dataset;
          const matches = [
            !specialty || ds.specialty.includes(specialty),
            !location || ds.location.includes(location),
            nameQuery.length < 3 || ds.name.includes(nameQuery),
            type === 'all' || ds.type === type,
            homeOnly ? ds.homeVisit === '1' : true
          ].every(Boolean);

          item.style.display = matches ? 'flex' : 'none';
        });
      }

      // Event Listeners
      document.addEventListener('DOMContentLoaded', () => {
        filterDoctors();
        document.getElementById('getLocationBtn').addEventListener('click', handleGeolocation);
        document.getElementById('specialtySelect').addEventListener('change', filterDoctors);
        document.getElementById('searchBtn').addEventListener('click', filterDoctors);
        document.getElementById('availabilityToggle').addEventListener('change', filterDoctors);
        document.getElementById('nameInput').addEventListener('input', filterDoctors);

        document.querySelectorAll('.tabs button').forEach(btn => {
          btn.addEventListener('click', () => {
            document.querySelector('.tabs button.active')?.classList.remove('active');
            btn.classList.add('active');
            filterDoctors();
          });
        });
      });


    </script>






  </body>

</html>