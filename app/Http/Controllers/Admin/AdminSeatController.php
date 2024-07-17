<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seat;
use App\Models\Schedule;
use App\Models\Theater;
use Illuminate\Http\Request;

class AdminSeatController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 5); // Default to 5 items per page
        $search = $request->get('search'); // Get search query
    
        $query = Seat::query()->with('schedule.theater');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('schedule.theater', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                })
                ->orWhere('seat_number', 'LIKE', "%{$search}%")
                ->orWhere('type', 'LIKE', "%{$search}%");

                // Pencarian berdasarkan status is_available
                if (strtolower($search) === 'sudah di isi') {
                    $q->orWhere('is_available', 0);
                } elseif (strtolower($search) === 'belum di isi') {
                    $q->orWhere('is_available', 1);
                }
            });
        }

        
        $seats = $query->paginate($perPage);
    
        return view('admin.seats.index', compact('seats', 'search', 'perPage'));
    }

    public function create()
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

    public function edit(Seat $seat)
    {
        $theaters = Theater::all();
        return view('admin.seats.edit', compact('seat', 'theaters'));
    }

    public function update(Request $request, Seat $seat)
    {
        $request->validate([
            'theater_id' => 'required|exists:theaters,id',
            'seat_number' => 'required|string|max:255',
            'type' => 'required|in:regular,sweetbox',
            'is_available' => 'boolean'
        ]);

        $seat->update($request->all());
        return redirect()->route('admin.seats.index')->with('success', 'Seat updated successfully.');
    }

    public function destroy(Seat $seat)
    {
        $seat->delete();
        return redirect()->route('admin.seats.index')->with('success', 'Seat deleted successfully.');
    }
}
