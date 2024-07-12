<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Movie;
use App\Models\Theater;
use Illuminate\Http\Request;

class AdminScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('movie', 'theater')->get();
        return view('admin.schedules.index', compact('schedules'));
    }
    public function create()
    {
        $movies = Movie::all();
        $theaters = Theater::all();
        return view('admin.schedules.create', compact('movies', 'theaters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'theater_id' => 'required|exists:theaters,id',
            'date' => 'required|date',
            'times' => 'required|array',
            'times.*' => 'required|date_format:H:i',
        ]);

        Schedule::create([
            'movie_id' => $request->input('movie_id'),
            'theater_id' => $request->input('theater_id'),
            'date' => $request->input('date'),
            'times' => array_map(function($time) {
                return ['time' => $time];
            }, $request->input('times')),
        ]);

        return redirect()->route('admin.schedules.index')->with('success', 'Schedule created successfully.');
    }

    public function edit(Schedule $schedule)
    {
        $movies = Movie::all();
        $theaters = Theater::all();
        return view('admin.schedules.edit', compact('schedule', 'movies', 'theaters'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'theater_id' => 'required|exists:theaters,id',
            'date' => 'required|date',
            'times' => 'required|array',
            'times.*' => 'required|date_format:H:i',
        ]);

        $schedule->update([
            'movie_id' => $request->input('movie_id'),
            'theater_id' => $request->input('theater_id'),
            'date' => $request->input('date'),
            'times' => array_map(function($time) {
                return ['time' => $time];
            }, $request->input('times')),
        ]);

        return redirect()->route('admin.schedules.index')->with('success', 'Schedule updated successfully.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.schedules.index')->with('success', 'Schedule deleted successfully.');
    }
}