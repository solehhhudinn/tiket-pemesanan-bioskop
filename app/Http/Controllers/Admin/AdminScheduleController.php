<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Movie;
use App\Models\Theater;
use Illuminate\Http\Request;

class AdminScheduleController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 5); // Default to 5 items per page
        $search = $request->get('search'); // Get search query
    
        $query = Schedule::query()->with('movie', 'theater');
    
        if ($search) {
            $query->whereHas('movie', function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%");
            })
            ->orWhereHas('theater', function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%");
            })
            ->orWhere(function($q) use ($search) {
                $q->where('start_date', 'LIKE', "%{$search}%")
                  ->orWhere('end_date', 'LIKE', "%{$search}%")
                  ->orWhere('times', 'LIKE', "%{$search}%");
            });
        }
    
        $schedules = $query->paginate($perPage);
    
        return view('admin.schedules.index', compact('schedules', 'search', 'perPage'));
    }    

    public function create()
    {
        // Fetch all movies and theaters for selection in the form
        $movies = Movie::all();
        $theaters = Theater::all();
        return view('admin.schedules.create', compact('movies', 'theaters'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'theater_id' => 'required|exists:theaters,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'times' => 'required|array|min:1',
            'times.*' => 'required|date_format:H:i',
        ]);

        // Create a new schedule record
        Schedule::create([
            'movie_id' => $request->input('movie_id'),
            'theater_id' => $request->input('theater_id'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'times' => array_map(function($time) {
                return ['time' => $time];
            }, $request->input('times')),
        ]);

        // Redirect to the index page with a success message
        return redirect()->route('admin.schedules.index')->with('success', 'Schedule created successfully.');
    }

    public function edit(Schedule $schedule)
    {
        // Fetch all movies and theaters for selection in the form
        $movies = Movie::all();
        $theaters = Theater::all();
        return view('admin.schedules.edit', compact('schedule', 'movies', 'theaters'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        // Validate the request data
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'theater_id' => 'required|exists:theaters,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'times' => 'required|array|min:1',
            'times.*' => 'required|date_format:H:i',
        ]);

        // Update the schedule record
        $schedule->update([
            'movie_id' => $request->input('movie_id'),
            'theater_id' => $request->input('theater_id'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'times' => array_map(function($time) {
                return ['time' => $time];
            }, $request->input('times')),
        ]);

        // Redirect to the index page with a success message
        return redirect()->route('admin.schedules.index')->with('success', 'Schedule updated successfully.');
    }

    public function destroy(Schedule $schedule)
    {
        // Delete the schedule record
        $schedule->delete();
        // Redirect to the index page with a success message
        return redirect()->route('admin.schedules.index')->with('success', 'Schedule deleted successfully.');
    }
}
