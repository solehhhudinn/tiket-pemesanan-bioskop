<?php

namespace App\Http\Controllers;

use App\Models\Iklan;
use App\Models\Movie;
use App\Models\Schedule;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        // Ambil semua film
        $movies = Movie::where('status',Movie::STATUS_NOW_PLAYING)->get();
        
        // Ambil semua iklan
        $iklans = Iklan::all();
        
        return view('home', compact('movies', 'iklans'));
    }

    public function nowPlaying()
    {
        $nowPlayingMovies = Movie::where('status', Movie::STATUS_NOW_PLAYING)->get();
        return view('now_playing', compact('nowPlayingMovies'));
    }

    public function upcoming()
    {
        $upcomingMovies = Movie::where('status', Movie::STATUS_UPCOMING)->get();
        return view('upcoming', compact('upcomingMovies'));
    }

    public function show(Movie $movie, $id) 
    {
        // Eager loading untuk jadwal film
        $movie->load(['schedules.theater', 'schedules.times']);
        $movie = Movie::with('schedules.times')->findOrFail($id);

        // Ambil semua iklan
        $iklans = Iklan::all();
        
        return view('movies.show', compact('movie', 'iklans'));
    }

    public function trailer(Movie $movie)
    {
        return view('movies.trailer', compact('movie'));
    }
}
