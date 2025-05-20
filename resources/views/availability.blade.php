<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/stylesNews.css">
    <script src="News.js" defer></script>
</head>

<link href='fullcalendar/packages/core/main.css' rel='stylesheet' />
<link href='fullcalendar/packages/daygrid/main.css' rel='stylesheet' />


<!-- Bootstrap CSS -->


<!-- Style -->
<link rel="stylesheet" href="css/calendstyle.css">



<body>


    <x-admin-sidebar/>


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
                <img
                src="{{ asset('storage/' . (Auth::user()->doctor->pic ?? 'image.png')) }}"
                alt="Profile"
                class="profile-circle rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                style="width:60px; height:60px; object-fit: cover; cursor: pointer;border: 2px solid black;"
                onclick="document.getElementById('accountSidebar').classList.toggle('active')"
              />


      {{-- <div>
      <a href="{{ route('notifications.test') }}" class="btn btn-sm btn-outline-primary">
          Send me a test notification
        </a>
  </div> --}}
            </div>
        </div>

        <x-account-sidebar :user="Auth::user()"/>



        <div class="container-fluid py-4">
            <!-- News Management Header -->
            <div class="news-management-header d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-0">Availability Management</h4>
                    <p class="text-muted mb-0">Manage university news and announcements</p>
                </div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewsModal">
                    <i class="fas fa-plus me-2"></i>change my work infos
                </button>
            </div>

            <!-- News List -->
            <div class="row g-4">
                <div class="tab-pane fade show active" id="design-tab-pane" role="tabpanel" aria-labelledby="design-tab"
                    tabindex="0">

                    <div class="content">
                        <div id='calendar'></div>
                    </div>
                    <script src='fullcalendar/packages/core/main.js'></script>
                    <script src='fullcalendar/packages/interaction/main.js'></script>
                    <script src='fullcalendar/packages/daygrid/main.js'></script>

                    <script>


                        document.addEventListener('DOMContentLoaded', function () {
                            var calendarEl = document.getElementById('calendar');

                            var calendar = new FullCalendar.Calendar(calendarEl, {
                                plugins: ['interaction', 'dayGrid'],
                                defaultDate: '2025-04-19',
                                editable: true,
                                eventLimit: true, // allow "more" link when too many events
                                events: [

                                    // {
                                    //     title: 'Long Event',
                                    //     start: '2025-04-07T04:00:00',
                                    //     //end: '2025-12-10',
                                    //     url: 'http://google.com/',

                                    // },
                                    @if ($r != null)

                                        @foreach ($r as $re)
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   {
                                                title: 'Rendez-vous',
                                                start: '{{$re->rendezvous}}',
                                                url: 'https://youtube.com/',
                                            },
                                        @endforeach


                                    @endif





                                ]
                            });

                            calendar.render();
                        });

                    </script>





                </div>



            </div> <!-- End of News and Events Cards -->
        </div>



        <!-- add / edit Pop-up -->
        <div class="bg-light">
            <!-- Add/Edit News Modal -->
            <div class="modal fade" id="addNewsModal" tabindex="-1">
                <div class="modal-dialog responsive-modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitle">change my work infos</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="doctorProfileForm" action="{{ route("doctor.updateInfo") }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <!-- Include this in your <head> for jQuery and jQuery UI -->
                                <link rel="stylesheet"
                                    href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

                                <div class="mb-3 position-relative">
                                    <label class="form-label">Wilaya</label>
                                    <input type="text" class="form-control" name="wilaya" id="wilaya"
                                        placeholder="Type a wilaya" required autocomplete="off"
                                        value="{{ explode(',', $doctor->location)[0] ?? ''  }}">
                                    <ul id="wilaya-suggestions" class="suggestions-list" style="display: none;"></ul>

                                </div>

                                <div class="mb-3 position-relative">
                                    <label class="form-label">Ville</label>
                                    <input type="text" class="form-control" name="ville" id="ville"
                                        placeholder="Type a ville" required autocomplete="off"
                                        value="{{ explode(',', $doctor->location)[1] ?? '' }}">
                                    <ul id="ville-suggestions" class="suggestions-list" style="display: none;"></ul>
                                </div>



                                <script>
                                    const wilayas = {
                                        "Alger": ["Alger-Centre", "Birkhadem", "El Harrach"],
                                        "Annaba": ["El Hadjar", "Bordj el Kiffan", "Sidi Amar"],
                                        "Oran": ["Es-Sénia", "Bir El Djir", "Aïn El Turk"],

                                    };

                                    const wilayaInput = document.getElementById('wilaya');
                                    const villeInput = document.getElementById('ville');
                                    const wilayaSuggestions = document.getElementById('wilaya-suggestions');
                                    const villeSuggestions = document.getElementById('ville-suggestions');

                                    wilayaInput.addEventListener('input', function () {
                                        const query = this.value.toLowerCase();
                                        const filtered = Object.keys(wilayas).filter(w => w.toLowerCase().includes(query));
                                        wilayaSuggestions.innerHTML = '';
                                        if (filtered.length) {
                                            wilayaSuggestions.style.display = 'block';
                                            filtered.forEach(w => {
                                                const li = document.createElement('li');
                                                li.textContent = w;
                                                li.onclick = () => selectWilaya(w);
                                                wilayaSuggestions.appendChild(li);
                                            });
                                        } else {
                                            wilayaSuggestions.style.display = 'none';
                                        }
                                    });

                                    function selectWilaya(wilaya) {
                                        wilayaInput.value = wilaya;
                                        wilayaSuggestions.style.display = 'none';
                                        villeInput.value = '';
                                        updateVilleSuggestions(wilaya);
                                    }

                                    function updateVilleSuggestions(wilaya) {
                                        const villes = wilayas[wilaya] || [];
                                        villeSuggestions.innerHTML = '';
                                        villes.forEach(ville => {
                                            const li = document.createElement('li');
                                            li.textContent = ville;
                                            li.onclick = () => {
                                                villeInput.value = ville;
                                                villeSuggestions.style.display = 'none';
                                            };
                                            villeSuggestions.appendChild(li);
                                        });

                                        villeInput.addEventListener('input', function () {
                                            const query = this.value.toLowerCase();
                                            const filtered = villes.filter(v => v.toLowerCase().includes(query));
                                            villeSuggestions.innerHTML = '';
                                            if (filtered.length) {
                                                villeSuggestions.style.display = 'block';
                                                filtered.forEach(v => {
                                                    const li = document.createElement('li');
                                                    li.textContent = v;
                                                    li.onclick = () => {
                                                        villeInput.value = v;
                                                        villeSuggestions.style.display = 'none';
                                                    };
                                                    villeSuggestions.appendChild(li);
                                                });
                                            } else {
                                                villeSuggestions.style.display = 'none';
                                            }
                                        });
                                    }

                                    // Hide suggestions on outside click
                                    document.addEventListener('click', (e) => {
                                        if (!wilayaInput.contains(e.target)) wilayaSuggestions.style.display = 'none';
                                        if (!villeInput.contains(e.target)) villeSuggestions.style.display = 'none';
                                    });
                                </script>



                                <!-- Price -->
                                <div class="mb-3">
                                    <label class="form-label">Consultation Price (DZD)</label>
                                    <input type="number" class="form-control" name="price" placeholder="e.g. 2000"
                                        value="{{ $doctor->price  }}" required>
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" rows="3"
                                        placeholder="Describe your specialties, services..."
                                        required>{{ $doctor->description }}</textarea>
                                </div>

                                <!-- Work Dates -->
                                <div class="mb-3">
                                    <label class="form-label">Available Work Days</label>
                                    <div class="d-flex flex-wrap gap-2 mb-2" id="day-buttons">
                                        <button type="button" class="btn btn-outline-secondary"
                                            id="select-all-btn">Select All</button>
                                        <button type="button" class="btn btn-outline-primary day-btn"
                                            data-day="Monday">Mon</button>
                                        <button type="button" class="btn btn-outline-primary day-btn"
                                            data-day="Tuesday">Tue</button>
                                        <button type="button" class="btn btn-outline-primary day-btn"
                                            data-day="Wednesday">Wed</button>
                                        <button type="button" class="btn btn-outline-primary day-btn"
                                            data-day="Thursday">Thu</button>
                                        <button type="button" class="btn btn-outline-primary day-btn"
                                            data-day="Friday">Fri</button>
                                        <button type="button" class="btn btn-outline-primary day-btn"
                                            data-day="Saturday">Sat</button>
                                        <button type="button" class="btn btn-outline-primary day-btn"
                                            data-day="Sunday">Sun</button>
                                    </div>
                                    <input type="hidden" name="work_days" id="work-days" required>
                                </div>

                                <script>

                                    const preselectedDays = @json(explode(',', $doctor->work_days ?? ''));

                                    // Trim and apply to button UI
                                    window.addEventListener('DOMContentLoaded', () => {
                                        preselectedDays.forEach(day => {
                                            const trimmedDay = day.trim();
                                            const btn = document.querySelector(`.day-btn[data-day="${trimmedDay}"]`);
                                            if (btn) {
                                                btn.classList.remove('btn-outline-primary');
                                                btn.classList.add('btn-primary');
                                                selectedDays.add(trimmedDay);
                                            }
                                        });
                                        updateHiddenInput();
                                    });



                                    const selectedDays = new Set();
                                    const dayButtons = document.querySelectorAll('.day-btn');
                                    const workDaysInput = document.getElementById('work-days');
                                    const selectAllBtn = document.getElementById('select-all-btn');

                                    function updateHiddenInput() {
                                        workDaysInput.value = Array.from(selectedDays).join(', ');
                                    }

                                    dayButtons.forEach(btn => {
                                        btn.addEventListener('click', () => {
                                            const day = btn.getAttribute('data-day');
                                            if (selectedDays.has(day)) {
                                                selectedDays.delete(day);
                                                btn.classList.remove('btn-primary');
                                                btn.classList.add('btn-outline-primary');
                                            } else {
                                                selectedDays.add(day);
                                                btn.classList.remove('btn-outline-primary');
                                                btn.classList.add('btn-primary');
                                            }
                                            updateHiddenInput();
                                        });
                                    });

                                    selectAllBtn.addEventListener('click', () => {
                                        const allSelected = selectedDays.size === 7;

                                        selectedDays.clear();
                                        dayButtons.forEach(btn => {
                                            const day = btn.getAttribute('data-day');
                                            if (!allSelected) {
                                                selectedDays.add(day);
                                                btn.classList.remove('btn-outline-primary');
                                                btn.classList.add('btn-primary');
                                            } else {
                                                btn.classList.remove('btn-primary');
                                                btn.classList.add('btn-outline-primary');
                                            }
                                        });

                                        updateHiddenInput();
                                        selectAllBtn.textContent = allSelected ? "Select All" : "Deselect All";
                                    });
                                </script>


                                <!-- Home Visit Option -->
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="1" name="home_visit"
                                        id="homeVisit" {{ old('home_visit', $doctor->home_visit ?? false) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="homeVisit">
                                        I offer home visits to patients
                                    </label>
                                </div>

                                <!-- Submit Button -->
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Save Information</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

        <script src="{{ asset('js/sidebar.js') }}"></script>
</body>

</html>
