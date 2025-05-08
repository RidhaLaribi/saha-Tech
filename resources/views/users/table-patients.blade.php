{{-- 4) Patients table --}}
<div class="table-responsive mt-5">
  <h4>Patients</h4>
  <table class="table table-hover align-middle">
    <thead>
      <tr>
        <th>#</th>
        <th>Patient</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Âge</th>
        <th>Sexe</th>
        <th>Relation</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($patients as $patientUser)
      @forelse($patientUser->patient as $p)
      <tr>
      <td>{{ $p->id }}</td>
      <td class="d-flex align-items-center">
      <img src="{{ asset('storage/' . ($p->pic ?? 'image.png')) }}" class="rounded-circle me-2" width="50"
      height="50" alt="Avatar" />
      {{ $p->name ?? 'Profil manquant' }}
      </td>
      <td>{{ $patientUser->email }}</td>
      <td>{{ $patientUser->tel }}</td>
      <td>{{ $p->age ? $p->age . ' ans' : '—' }}</td>
      <td>{{ $p->sexe ? ucfirst($p->sexe) : '—' }}</td>
      <td>{{ $p->rel ?? '—' }}</td>
      <td>
      {{-- View Profile --}}
      <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal"
      data-bs-target="#patientModal{{ $p->id }}">
      <i class="fas fa-user"></i>
      </button>
      {{-- Delete --}}
      <form action="{{ route('patients.destroy', $p->id) }}" method="POST" class="d-inline"
      onsubmit="return confirm('Voulez-vous vraiment supprimer ce patient ?');">
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
      <td colspan="8" class="text-center">Aucun patient associé à cet utilisateur.</td>
      </tr>
    @endforelse
    @empty
      <tr>
      <td colspan="8" class="text-center">Aucun patient à afficher.</td>
      </tr>
    @endforelse
    </tbody>
  </table>
</div>

{{-- 5) Patient Modals --}}
@foreach($patients as $patientUser)
  @foreach($patientUser->patient as $p)
    <div class="modal fade" id="patientModal{{ $p->id }}" tabindex="-1" aria-labelledby="patientModalLabel{{ $p->id }}"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
      <img src="{{ asset('storage/' . ($p->pic ?? 'image.png')) }}" class="rounded-circle me-2" width="50" height="50"
      alt="Avatar" />
      <h5 class="modal-title" id="patientModalLabel{{ $p->id }}">
      {{ $p->name }}
      </h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
      <ul class="list-group">
      <li class="list-group-item"><strong>Nom&nbsp;:</strong> {{ $p->name }}</li>
      <li class="list-group-item"><strong>Email&nbsp;:</strong> {{ $patientUser->email }}</li>
      <li class="list-group-item"><strong>Téléphone&nbsp;:</strong> {{ $patientUser->tel }}</li>
      <li class="list-group-item"><strong>Âge&nbsp;:</strong> {{ $p->age }} ans</li>
      <li class="list-group-item"><strong>Sexe&nbsp;:</strong> {{ ucfirst($p->sexe) }}</li>
      <li class="list-group-item"><strong>Relation&nbsp;:</strong> {{ $p->rel }}</li>
      </ul>
      </div>
    </div>
    </div>
    </div>
  @endforeach
@endforeach