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
    // Display a listing of the payments
    public function index()
    {
        $payments = Payment::with(['user', 'movie', 'theater', 'schedule'])->get();
        return view('admin.payments.index', compact('payments'));
    }

    // Display the specified payment details
    public function show(string $id)
    {
        // Retrieve the payment by ID with related models
        $payment = Payment::with(['movie', 'theater', 'schedule', 'user'])->findOrFail($id);

        // Return the view with the payment data
        return view('admin.payments.show', compact('payment'));
    }
}