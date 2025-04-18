<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{

    public function index()
    {
        $allNotifications = auth()->user()
                      ->notifications()
                      ->orderBy('created_at', 'desc')
                      ->get();

        $totalNotifications = $allNotifications->count();

        return view('doctors')->with([
            'notifications' => $allNotifications,
            'totalNotifications' => $totalNotifications,
        ]);
    }
    // Clear all notifications
    public function clear()
    {
        
        auth()->user()->notifications()->delete();

        return redirect()->back()->with('success', 'All notifications cleared.');
    }
    }


