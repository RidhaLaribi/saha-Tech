<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SomeNotification;
use Illuminate\Support\Facades\Notification;



class NotificationController extends Controller
{
    /**
     * Mark all unread notifications as read.
     */
    public function clear()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return back()->with('success', 'All notifications marked as read.');
    }

    /**
     * Send a test notification into the database.
     */
    public function sendTest()
    {
        Notification::send(
            Auth::user(),
            new SomeNotification([
               'message' => '🚀 Test via façade!',
               'url'     => url('/'),
            ])
        );
    
        return back()->with('success','Sent via Notification::send()');
    }
    
}
