<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\PaymentStatusMail;
use App\Models\Payment;
use App\Models\Seat;
use App\Notifications\PaymentStatusUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdminPaymentController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 5); // Default to 5 items per page
        $search = $request->get('search'); // Get search query
    
        $query = Payment::query()->with('user', 'movie', 'theater', 'schedule');
    
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                })
                ->orWhereHas('movie', function($q) use ($search) {
                    $q->where('title', 'LIKE', "%{$search}%");
                })
                ->orWhereHas('theater', function($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                })
                ->orWhereHas('schedule', function($q) use ($search) {
                    $q->where('schedule_id', 'LIKE', "%{$search}%");
                })
                ->orWhere(function($q) use ($search) {
                    $q->where('time', 'LIKE', "%{$search}%")
                      ->orWhere('seat_count', 'LIKE', "%{$search}%")
                      ->orWhere('selected_seats', 'LIKE', "%{$search}%")
                      ->orWhere('total_price', 'LIKE', "%{$search}%")
                      ->orWhere('status', 'LIKE', "%{$search}%");
                });
            });
        }
    
        $payments = $query->paginate($perPage);
    
        return view('admin.payments.index', compact('payments', 'search', 'perPage'));
    }

    // Display the specified payment details
    public function show(string $id)
    {
        // Retrieve the payment by ID with related models
        $payment = Payment::with(['movie', 'theater', 'schedule', 'user'])->findOrFail($id);

        // Return the view with the payment data
        return view('admin.payments.show', compact('payment'));
    }

    // Update the specified payment status
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'action' => 'required|in:accept,reject'
        ]);

        // Retrieve the payment by ID
        $payment = Payment::findOrFail($id);
    
        // Get the action from the request
        $action = $request->input('action');
        $originalStatus = $payment->status;
    
        // Set the status based on the action
        if ($action === 'accept') {
            $payment->status = 'Accepted';
            $this->markSeatsAsOccupied($payment);
        } elseif ($action === 'reject') {
            $payment->status = 'Rejected';
        }
    
        // Save the payment if the status has changed
        if ($payment->status !== $originalStatus) {
            $payment->save();
            $this->notifyUser($payment);
        } else {
            Log::info('No status change for payment ID ' . $payment->id);
        }
    
        // Redirect back to the payments index with a success message
        return redirect()->route('admin.payments.index')->with('success', 'Payment status updated successfully.');
    }

    private function markSeatsAsOccupied(Payment $payment)
    {
        $selectedSeats = json_decode($payment->selected_seats, true);
        foreach ($selectedSeats as $seatNumber) {
            $seat = Seat::where('seat_number', $seatNumber)
                ->where(function ($query) use ($payment) {
                    $query->where('schedule_id', $payment->schedule_id)
                          ->orWhereNull('schedule_id');
                })
                ->first();
    
            if ($seat) {
                Log::info('Updating seat: ' . $seat->seat_number . ' for schedule ID: ' . $payment->schedule_id);
                $seat->is_available = false;
                if ($seat->save()) {
                    Log::info('Seat ' . $seat->seat_number . ' updated successfully.');
                } else {
                    Log::error('Failed to update seat: ' . $seat->seat_number);
                }
            } else {
                Log::warning('Seat not found: ' . $seatNumber . ' for schedule ID: ' . $payment->schedule_id);
            }
        }
    }      

    private function notifyUser(Payment $payment)
    {
        // Send notification to the user
        $payment->user->notify(new PaymentStatusUpdated($payment));

        // Log and send email if the user is found
        if ($payment->user) {
            Log::debug('Sending email with data:', [
                'email' => $payment->user->email,
                'status' => $payment->status,
                'userName' => $payment->user->name,
                'notification_data' => new PaymentStatusUpdated($payment)
            ]);

            // Send email to the user
            Mail::to($payment->user->email)->send(new PaymentStatusMail($payment->status, $payment->user->name, route('home')));
        } else {
            Log::error('User not found for payment ID ' . $payment->id);
        }
    }

    // Remove the specified payment from storage
    public function destroy(string $id)
    {
        // Retrieve the payment by ID
        $payment = Payment::findOrFail($id);

        // Delete the payment
        $payment->delete();

        // Redirect back to the payments index with a success message
        return redirect()->route('admin.payments.index')->with('success', 'Payment deleted successfully.');
    }
}
