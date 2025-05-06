{{-- 6) Admins table --}}
<div class="table-responsive mt-5">
  <h4>Administrateurs</h4>
  <table class="table table-hover align-middle">
    <thead>
      <tr>
        <th>#</th>
        <th>Admin</th>
        <th>Rôle</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($admins as $admin)
        <tr>
          <td>{{ $admin->id }}</td>
          <td class="d-flex align-items-center">
             <img  src="{{ asset('storage/' . ($admin->pic ?? 'image.png')) }}"   class="rounded-circle me-2" width="50" height="50" alt="Avatar"/>
               
            {{ $admin->name }}
          </td>
          <td>{{ ucfirst($admin->role) }}</td>
          <td>{{ $admin->email }}</td>
          <td>{{ $admin->tel }}</td>
          <td>
            {{-- View Profile --}}
            <button class="btn btn-sm btn-outline-primary me-1"
                    data-bs-toggle="modal"
                    data-bs-target="#adminModal{{ $admin->id }}">
              <i class="fas fa-user"></i>
            </button>
            {{-- Delete --}}
            <form action="{{ route('admins.destroy', $admin->id) }}"
                  method="POST" class="d-inline"
                  onsubmit="return confirm('Voulez-vous vraiment supprimer cet administrateur ?');">
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
          <td colspan="6" class="text-center">Aucun administrateur à afficher.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

{{-- 7) Admin Modals --}}
@foreach($admins as $admin)
  <div class="modal fade" id="adminModal{{ $admin->id }}" tabindex="-1"
       aria-labelledby="adminModalLabel{{ $admin->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <img  src="{{ asset('storage/' . ($admin->pic ?? 'image.png')) }}"  
           class="rounded-circle me-2" width="50" height="50" alt="Avatar"/>
              
          <h5 class="modal-title" id="adminModalLabel{{ $admin->id }}">
            {{ $admin->name }}
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <ul class="list-group">
            <li class="list-group-item">
              <strong>Nom&nbsp;:</strong> {{ $admin->name }}
            </li>
            <li class="list-group-item">
              <strong>Email&nbsp;:</strong> {{ $admin->email }}
            </li>
            <li class="list-group-item">
              <strong>Téléphone&nbsp;:</strong> {{ $admin->tel }}
            </li>
            <li class="list-group-item">
              <strong>Rôle&nbsp;:</strong> {{ ucfirst($admin->role) }}
            </li>
           
          </ul>
        </div>
      </div>
    </div>
  </div>
@endforeach
