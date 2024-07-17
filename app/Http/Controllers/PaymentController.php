<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Movie;
use App\Models\Seat;
use App\Models\Theater;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $scheduleId = $request->schedule_id;
        $time = $request->time;
        $quantity = $request->quantity;
        $seatIds = json_decode($request->seat_numbers);


        $schedule = Schedule::findOrFail($scheduleId);
        $movie = Movie::findOrFail($schedule->movie_id);
        $theater = Theater::findOrFail($schedule->theater_id);
    
        if (empty($seatIds)) {
            return redirect()->back()->withErrors(['seat_numbers' => 'Please select seats.']);
        }
        
        $date = $schedule->date;
        $movieName = $movie->title;
        $theaterName = $theater->name;
        $seatNumbers = Seat::whereIn('id', $seatIds)->pluck('seat_number')->toArray();
        $seatCount = count($seatIds);

        $price = 'Rp.' . ' ' . number_format($theater->price, 0, ',', '.');
    
        Carbon::setLocale('id');
        $carbonDate = Carbon::parse($date);
        $formattedDate = $carbonDate->isoFormat('dddd, D MMMM YYYY');
        $day = $carbonDate->isoFormat('dddd');
    
        $totalPrice = $theater->price * $quantity;
        $formattedPrice = 'Rp.' . ' ' . number_format($totalPrice, 0, ',', '.');
    
        return view('payment.index', compact('scheduleId', 'price', 'formattedDate', 'day', 'time', 'quantity', 'seatNumbers', 'movieName', 'theaterName', 'formattedPrice', 'totalPrice', 'seatCount'));
    }

    public function showBarcode(Request $request)
    {
        $scheduleId = $request->input('schedule_id');
        $schedule = Schedule::findOrFail($scheduleId);
        $movie = Movie::findOrFail($schedule->movie_id);
    
        $totalPrice = $request->input('totalPrice');
        $movieId = $movie->id;
        $theaterId = $schedule->theater_id;
        $seatNumbers = $request->input('seat_numbers', []);
        $seatCount = count($seatNumbers);
        $times = $request->input('time');
        
        return view('payment.barcode', compact('totalPrice', 'movieId', 'theaterId', 'scheduleId', 'seatCount', 'seatNumbers','times'));
    }
    
    public function uploadBuktiPembayaran(Request $request)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'movie_id' => 'required|exists:movies,id',
            'total_price' => 'required|numeric',
            'theater_id' => 'required|exists:theaters,id',
            'schedule_id' => 'required|exists:schedules,id',
            'time' => 'required',
            'seat_count' => 'required|numeric|min:1',
            'selected_seats' => 'required', 
        ]);
    
        $filePath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
    
        $payment = new Payment();
        $payment->user_id = Auth::id();
        $payment->movie_id = $request->movie_id;
        $payment->theater_id = $request->theater_id;
        $payment->schedule_id = $request->schedule_id;
        $payment->time = $request->time;
        $payment->total_price = $request->total_price;
        $payment->seat_count = $request->seat_count;
        $payment->selected_seats = ($request->selected_seats); // Simpan seat_numbers
        $payment->payment_proof = $filePath;
        $payment->status = 'pending';
        $payment->save();
        
        return redirect()->route('home')->with('success', 'Bukti pembayaran berhasil diunggah. Transaksi sedang diproses.');
    }
}
