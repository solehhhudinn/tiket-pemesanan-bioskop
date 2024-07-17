<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notifications = $user->notifications;
        $unreadNotifications = $user->unreadNotifications;

        return view('notifications.index', compact('notifications', 'unreadNotifications'));
    }

    public function show($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);

        if (isset($notification->data['payment_id'])) {
            $payment = Payment::findOrFail($notification->data['payment_id']);
            return view('notifications.show', compact('payment'));
        } else {
            return redirect()->route('notifications.index')->with('error', 'Payment ID not found in notification.');
        }
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return response()->json(['success' => true]);
    }
}
