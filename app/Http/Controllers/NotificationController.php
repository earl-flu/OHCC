<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notifications = $user->notifications;
        // dd($user->unreadNotifications->isEmpty());
        if (!$user->isSuperAdmin()) {
            abort(403);
        };
        return view('notifications.index', compact('notifications'));
    }
}
