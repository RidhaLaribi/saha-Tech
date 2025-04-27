<div class="notifications">
  <a href="#" class="navbar-icon b-notification smoothscroll position-relative" data-bs-toggle="modal"
    data-bs-target="#notificationModal">
    <i class="bi bi-bell"></i>
    {{-- Bell icon --}}
    @if($unreadCount > 0)
    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
      {{ $unreadCount }}
      <span class="visually-hidden">unread notifications</span>
    </span>
  @endif
  </a>
</div>







{{-- Modal --}}
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title fw-bold" id="notificationModalLabel">
          <i class="fas fa-bell me-2"></i> Notifications
          <span class="badge bg-gradient ms-2">{{ $unreadCount }}</span>
        </h5>
        <div class="ms-auto d-flex gap-2 align-items-center">
          <form method="POST" action="{{ route('clearnotif') }}">
            @csrf
            <button type="submit" class="btn btn-sm mark-read-btn">
              <i class="fas fa-check-double me-1"></i> Mark all as read
            </button>
          </form>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      </div>

      <!-- Body -->
      <div class="modal-body p-0">
        <div class="notifications-list">
          @if($notifications->isEmpty())
        <p class="text-center text-muted my-3">No notifications</p>
      @else
      @foreach($notifications as $note)
      <div class="notification-item {{ is_null($note->read_at) ? 'unread' : '' }}">
      <div class="d-flex">
      <div class="notification-icon">
      <i class="fas fa-book"></i>
      </div>
      <div class="notification-content">
      <div class="d-flex justify-content-between align-items-center">
        <h6 class="mb-0">{{ $note->data['message'] }}</h6>
        <small class="text-muted">
        {{ $note->created_at->format('d M Y H:i') }}
        </small>
      </div>
      @if(isset($note->data['url']))
      <a href="{{ $note->data['url'] }}" class="stretched-link"></a>
    @endif
      </div>
      </div>
      </div>
    @endforeach
    @endif
        </div>
      </div>
    </div>
  </div>
</div>