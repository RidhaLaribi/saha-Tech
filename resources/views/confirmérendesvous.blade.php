<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Requests Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/stylesRequests.css">
  <script src="Requests.js" defer></script>

<!-- Flatpickr CSS & Theme -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css" />
  <style>
    .modal-dialog.modal-wide {
      max-width: 90vw;
      /* or 80vw, or a fixed px like 1000px */
      margin: 1.75rem auto;
      /* keep vertical centering */
    }
  </style>


  <style>
    .modal-overlay {
      position: fixed;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      background: rgba(0, 0, 0, 0.4);
      display: none;
      align-items: center;
      justify-content: center;
      z-index: 2000;
    }

    .modal-overlay.active {
      display: flex;
    }

    .booking-popup {
      z-index: 2001;
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

    .popup-footer textarea {
      position: relative;
      z-index: 2002;
      height: 3rem;
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

    .popup-footer textarea {
      pointer-events: auto !important;
    }
  </style>
</head>

<body>
  <x-admin-sidebar />


  <div class="main-content">
    <div class="admin-header d-flex justify-content-between align-items-center p-3">
      <!-- Logo and University Name Section -->
      <div class="brand d-flex align-items-center">


        <div class="university-name">
          <h4 class="mb-0 fw-bold">Doctor dashboard</h4>

        </div>
      </div>
      <div class="actions d-flex align-items-center gap-4">
        <!-- Notifications -->
        <x-notifications-dropdown />


        <!-- Profile Circle -->
        <img src="{{ asset('storage/' . (Auth::user()->doctor->pic ?? 'image.png')) }}" alt="Profile"
          class="profile-circle rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
          style="width:60px; height:60px; object-fit: cover; cursor: pointer;border: 2px solid black;"
          onclick="document.getElementById('accountSidebar').classList.toggle('active')" />


        {{-- <div>
          <a href="{{ route('notifications.test') }}" class="btn btn-sm btn-outline-primary">
            Send me a test notification
          </a>
        </div> --}}
      </div>
    </div>

    <x-account-sidebar :user="Auth::user()" />




    <!-- Table Section -->
    <div class="table-responsive">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Recent requests</h5>

      </div>
      <div class="container">

        {{-- Filters --}}
        <form method="GET" action="{{ route('rendconfirme') }}" class="row g-3 mb-4">
          <div class="col-md-10">
            <input type="text" name="patient_search" value="{{ old('search', $search) }}" class="form-control"
              placeholder="Search patient name…">
          </div>

          <div class="col-md-2">
            <button class="btn btn-primary w-100">
              <i class="fas fa-filter me-1"></i> Filter
            </button>
          </div>
        </form>

        {{-- Table --}}
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead>
              <tr>
                <th>#</th>
                <th>Patient</th>
                <th>Date &amp; Time</th>
                <th>Type</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($appointments as $apt)
            <tr>
            <td>{{ $apt?->id }}</td>
            <td class="d-flex align-items-center">
              <img src="{{ asset('storage/' . ($apt->patient->pic?? 'image.png')) }}" class="rounded-circle me-2" width="50"
              height="50" alt="Avatar">
              {{ $apt->patient->name }}
            </td>
            <td>{{ $apt?->rendezvous->format('d M Y, H:i') }}</td>
            <td>{{ $apt?->type }}</td>
            <td>
              @php
            $badge = match ($apt?->status) {
            'Confirmé' => 'success',
            'En Attente' => 'warning',
            'Annulé' => 'danger',
            default => 'secondary',
            };
            @endphp
              <span class="badge bg-{{ $badge }}">
              {{ $apt?->status }}
              </span>
            </td>
            <td>
              <a id="tk" title="take an appointment to laboratoire" type="button" class="btn btn-primary"
              data-bs-toggle="modal" data-bs-target="#laboModal" data-patient-id="{{ $apt->patient->id }}">
              <i class="fas fa-flask"></i>
              </a>



              {{-- 2) Single Modal --}}
              <div class="modal fade" id="laboModal" tabindex="-1" aria-labelledby="laboModalLabel"
              aria-hidden="true">
              <div class="modal-dialog modal-wide modal-dialog-scrollable">
                <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="laboModalLabel">
                  laboratoire list
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                  <form method="GET" action="{{ route('rendconfirme') }}" class="mb-3 d-flex">
                  <input type="text" name="labo_search" class="form-control me-2"
                    placeholder="Rechercher un laboratoire…" value="{{ old('labo_search', $labo_search) }}">
                  <button type="submit" class="btn btn-outline-primary">
                    <i class="fas fa-search"></i>
                  </button>
                  </form>

                  {{-- Table --}}
                  <div class="table-responsive">
                  <table class="table table-hover" id="laboTable">
                    <thead class="table-light">
                    <tr>
                      <th>name</th>
                      <th>speciality</th>
                      <th>number</th>
                      <th>price (DA)</th>
                      <th>available</th>
                      <th>rating</th>
                      <th>home-visit</th>
                      <th></th> {{-- actions --}}
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($laboratoires as $labo)
                  <tr>
                  <td>{{ $labo->User->name }}</td>
                  <td>{{ ucfirst($labo->specialty) }}</td>
                  <td>{{ $labo->User->tel }}</td>
                  <td>
                  {{ $labo->price ? number_format($labo->price, 0, ',', ' ') : '—' }}
                  </td>
                  <td>
                  @if($labo->available)
              <span class="badge bg-success">yes</span>
              @else
              <span class="badge bg-secondary">No</span>
              @endif
                  </td>
                  <td>
                  {{ $labo->rating ? $labo->rating . '/5' : '—' }}
                  </td>
                  <td>
                  @if($labo->home_visit)
              <span class="badge bg-success">yes</span>
              @else
              <span class="badge bg-secondary">No</span>
              @endif
                  </td>
                  <td>
                  <button class="appointment-btn open-modal-btn bg-info"
                    data-doctor-id="{{ $labo->id }}" data-doctor-name="{{ $labo->user->name }}"
                    data-doctor-specialty="{{ $labo->specialty }}"
                    data-doctor-price="{{ $labo->price }}"
                    data-doctor-image="{{ asset('storage/' . ($labo->pic ?? 'image.png')) }}">
                    <i class="fas fa-calendar-plus"></i> take appointement
                  </button>
                  </td>
                  </tr>
            @endforeach
                    </tbody>
                  </table>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                  close
                  </button>
                </div>
                </div>
              </div>
              </div>

              <!-- Appointment Modal -->
              <div class="modal-overlay" id="appointmentModal">
              <div class="booking-popup">
                <!-- Close button -->
                <button type="button" class="close-btn modal-close">&times;</button>

                <!-- Form -->
                <form method="POST" action="{{ route('appointments.storelab') }}">
                @csrf

                <div class="popup-grid">
                  <!-- LEFT: Doctor Info -->
                  <div class="popup-info">
                  <img id="modalDoctorImage" class="avatar" src="" alt="Photo du médecin">
                  <div class="info-text">
                    <h3 id="modalDoctorName">Dr. Nom Prénom</h3>
                    <p><i class="fas fa-stethoscope"></i> <span id="modalDoctorSpecialty">Spécialité</span>
                    </p>
                    <p><i class="fas fa-map-marker-alt"></i> {{ $labo->location ?? 'Lieu' }}</p>
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


                  </div>
                </div>
                <div class="popup-footer">

                  <div class="form-section">
                  <select name="type" required>
                    <option value="">Type de RDV…</option>
                    <option value="consultation">Consultation générale</option>
                    <option value="followup">Suivi de traitement</option>
                    <option value="emergency">Urgence</option>
                  </select>
                  </div>

        <div class="form-section">
          <input type="hidden" value="{{$apt->patient->id}}" name="pid">
        </div>

                  <button type="submit" class="appointment-btn bg-info"><i
                    class="fas fa-calendar-check"></i>Confirmer </button>
                </div>
                </form>
              </div>
              </div>

                {{-- View Patient Profile --}}
                @if($apt->patient!= null)
                <a href="{{ route('doctor.patient.show', $apt->patient->id) }}"
                class="btn btn-sm btn-outline-primary me-1" title="enter profil">
                <i class="fas fa-user"></i>
                </a>
                @endif
            </td>
            </tr>


        @empty
          <tr>
          <td colspan="6" class="text-center">No appointments found.</td>
          </tr>
        @endforelse
            </tbody>
          </table>

        </div>

        {{-- Pagination --}}
        <div class="mt-3">
          {{ $appointments->links() }}
        </div>
      </div>
    </div>
  </div>
  </div>






  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

  @if(request()->has('labo_search'))
    <script>
    document.addEventListener('DOMContentLoaded', function () {
      var laboModal = new bootstrap.Modal(document.getElementById('laboModal'));
      laboModal.show();
    });
    </script>
  @endif


  <script>
    document.getElementById('tk').addEventListener('click', function () {
      const pid = this.getAttribute('data-patient-id');
      document.getElementById('formPatientId').value = pid;
    });
  </script>

  {{--
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const laboModal = document.getElementById('laboModal');
      laboModal.addEventListener('show.bs.modal', function (event) {
        // event.relatedTarget is the <a id="tk"> that was clicked
        const trigger = event.relatedTarget;
        const pid = trigger.getAttribute('data-patient-id');
        this.querySelector('#formPatientId').value = pid;
      });
    });
  </script> --}}






  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script>


    const takenSlots = @json($takenSlots);
    const overlay = document.getElementById('appointmentModal');
    const slotsCont = document.getElementById('slotsContainer');
    const prevDay = document.getElementById('prevDay');
    const nextDay = document.getElementById('nextDay');
    const displayDt = document.getElementById('displayDate');
    let currentDate = new Date();

    function fmt(d) {
      return d.toLocaleDateString('fr-FR', {
        weekday: 'short', day: '2-digit', month: 'short'
      });
    }

    function renderSlots(date) {
      slotsCont.innerHTML = '';
      const dayPrefix = date.toISOString().slice(0, 10) + ' ';
      const doctorId = document.getElementById('formDoctorId').value;
      const allTaken = takenSlots[doctorId] || [];


      const takenTimes = allTaken
        .filter(ts => ts.startsWith(dayPrefix))
        .map(ts => ts.slice(dayPrefix.length));

      for (let h = 9; h < 17; h++) {
        [0, 30].forEach(m => {
          const hh = String(h).padStart(2, '0'),
            mm = String(m).padStart(2, '0'),
            timeStr = `${hh}:${mm}:00`,
            slotTs = dayPrefix + timeStr,
            btn = document.createElement('div');

          btn.className = 'slot';
          btn.textContent = `${hh}:${mm}`;

          if (takenTimes.includes(timeStr)) {
            btn.classList.add('disabled');
            btn.style.cursor = 'not-allowed';
          } else {
            btn.addEventListener('click', () => {
              const selected = btn.classList.toggle('selected');
              let arr = document.getElementById('formDateTime').value
                .split(',').map(s => s.trim()).filter(s => s);
              if (selected) arr.push(slotTs);
              else arr = arr.filter(s => s !== slotTs);
              document.getElementById('formDateTime').value = arr.join(',');
            });
          }

          slotsCont.appendChild(btn);
        });
      }
    }

    function updateDay(delta) {
      currentDate.setDate(currentDate.getDate() + delta);
      displayDt.textContent = fmt(currentDate);
      renderSlots(currentDate);
    }

    prevDay.addEventListener('click', () => updateDay(-1));
    nextDay.addEventListener('click', () => updateDay(1));

    flatpickr(displayDt, {
      defaultDate: currentDate,
      clickOpens: true,
      onChange: ([d]) => { currentDate = d; updateDay(0); },
      dateFormat: "D, d M"
    });

    document.querySelectorAll('.open-modal-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const { doctorId, doctorName, doctorSpecialty, doctorPrice, doctorImage } = btn.dataset;

        document.getElementById('modalDoctorName').textContent = doctorName;
        document.getElementById('modalDoctorSpecialty').textContent = doctorSpecialty;
        document.getElementById('modalDoctorPrice').textContent = doctorPrice;
        document.getElementById('modalDoctorImage').src = doctorImage;
        document.getElementById('formDoctorId').value = doctorId;
        document.getElementById('formDateTime').value = '';

        updateDay(0);
        overlay.classList.add('active');
      });
    });

    document.querySelectorAll('.modal-close').forEach(x =>
      x.addEventListener('click', () => overlay.classList.remove('active'))
    );

    // initial render
    displayDt.textContent = fmt(currentDate);
    renderSlots(currentDate);
    document.querySelector('textarea[name="tel"]').addEventListener('focus', () => {
      console.log('Textarea focused');
    });
  </script>

  <!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

  <script src="{{ asset('js/sidebar.js') }}"></script>




  <!-- Your scripts at the end of <body> -->


</body>




</html>
