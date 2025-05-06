{{-- Doctors table --}}
<div class="table-responsive">
  <table class="table table-hover align-middle">
    <thead>
      <tr>
        <th>#</th>
        <th>Avatar &amp; Nom</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Spécialité</th>
       
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($doctors as $doctor)
        <tr>
          {{-- ID --}}
          <td>{{ $doctor->id }}</td>

          {{-- Avatar & Name --}}
          <td class="d-flex align-items-center">
            <img  src="{{ asset('storage/' . ($doctor->pic ?? 'image.png')) }}"   class="rounded-circle me-2" width="50" height="50" alt="Avatar"/>
            {{ $doctor->name }}
          </td>

          {{-- Email --}}
          <td>{{ $doctor->email }}</td>

          {{-- Telephone --}}
          <td>{{ $doctor->tel }}</td>

          {{-- Specialty --}}
          <td>{{ $doctor->doctor->specialty }}</td>

          <td>
            <button class="btn btn-sm btn-outline-primary me-1"
                    data-bs-toggle="modal"
                    data-bs-target="#doctorModal{{ $doctor->id }}">
              <i class="fas fa-user"></i>
            </button>

            <form action="{{ route('doctors.destroy', $doctor->doctor->id) }}"
                  method="POST" class="d-inline"
                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce praticien ?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-outline-danger">
                <i class="fas fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="9" class="text-center">Aucun praticien à afficher.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

{{-- Doctor Modals --}}
@foreach($doctors as $doctor)
  <div class="modal fade" id="doctorModal{{ $doctor->id }}" tabindex="-1"
       aria-labelledby="doctorModalLabel{{ $doctor->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <img  src="{{ asset('storage/' . ($doctor->pic ?? 'image.png')) }}"   class="rounded-circle me-2" width="50" height="50" alt="Avatar"/>

           <h5 class="modal-title" id="doctorModalLabel{{ $doctor->id }}">
            {{ $doctor->name }}
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <ul class="list-group">
            {{-- User info --}}
            <li class="list-group-item"><strong>Nom&nbsp;:</strong> {{ $doctor->name }}</li>
            <li class="list-group-item"><strong>Email&nbsp;:</strong> {{ $doctor->email }}</li>
            <li class="list-group-item"><strong>Téléphone&nbsp;:</strong> {{ $doctor->tel }}</li>

            {{-- Doctor profile --}}
            <li class="list-group-item">
              <strong>Spécialité&nbsp;:</strong> {{ $doctor->doctor->specialty }} ❤️
            </li>
            <li class="list-group-item">
              <strong>Type&nbsp;:</strong> {{ ucfirst($doctor->role) }}
            </li>
            <li class="list-group-item">
              <strong>Genre&nbsp;:</strong> {{ ucfirst($doctor->doctor->gender) }}
            </li>
            <li class="list-group-item">
              <strong>Âge&nbsp;:</strong> {{ $doctor->doctor->age }} ans
            </li>
            <li class="list-group-item">
              <strong>Prix&nbsp;:</strong> {{ $doctor->doctor->price }} DA
            </li>
            <li class="list-group-item">
              <strong>Disponible&nbsp;:</strong>
              {{ $doctor->doctor->available ? 'Oui' : 'Non' }}
            </li>
            <li class="list-group-item">
              <strong>Consultation à domicile&nbsp;:</strong>
              {{ $doctor->doctor->home_visit ? 'Oui' : 'Non' }}
            </li>
            <li class="list-group-item">
              <strong>Localisation&nbsp;:</strong>
              {{ $doctor->doctor->location ?? 'Non spécifiée' }}
            </li>
            <li class="list-group-item"><strong>Référence&nbsp;:</strong> {{ $doctor->doctor->doctor_ref }}</li>
            <li class="list-group-item"><strong>Jours de travail&nbsp;:</strong> {{ $doctor->doctor->work_days }}</li>
            <li class="list-group-item"><strong>Description&nbsp;:</strong> {{ $doctor->doctor->description }}</li>
            <li class="list-group-item"><strong>Note&nbsp;:</strong> {{ $doctor->doctor->rating }}/5</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
@endforeach
