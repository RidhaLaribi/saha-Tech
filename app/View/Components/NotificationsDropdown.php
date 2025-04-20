<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class NotificationsDropdown extends Component
{
    public $notifications;
    public $unreadCount;

    public function __construct()
    {
        if ($user = Auth::user()) {
            // All notifications (read + unread)
            $this->notifications  = $user->notifications->sortByDesc('created_at');
            // Only unread count
            $this->unreadCount    = $user->unreadNotifications->count();
        } else {
            $this->notifications  = collect();
            $this->unreadCount    = 0;
        }
    }

    public function render()
    {
        return view('components.notifications-dropdown');
    }
}
