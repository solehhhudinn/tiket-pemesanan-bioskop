<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seat;
use App\Models\Schedule;
use App\Models\Theater;
use Illuminate\Http\Request;

class AdminSeatController extends Controller
{
    public function index()
    {
        $seats = Seat::with('schedule.theater')->get();
        return view('admin.seats.index', compact('seats'));
    }public function create()
    {
        $theaters = Theater::all();
        return view('admin.seats.create', compact('theaters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'theater_id' => 'required|exists:theaters,id',
            'seat_number' => 'required|string|max:255',
            'type' => 'required|in:regular,sweetbox',
            'is_available' => 'boolean'
        ]);
    
        $seatData = $request->only('theater_id', 'seat_number', 'type', 'is_available');
        Seat::create($seatData);
    
        return redirect()->route('admin.seats.index')->with('success', 'Seat created successfully.');
    }
 }