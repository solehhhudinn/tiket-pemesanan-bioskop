<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminMovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('admin.movies.index', compact('movies'));
    }

    public function create()
    {
        return view('admin.movies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'poster' => 'required|image',
            'description' => 'required',
            'trailer_url' => 'required|url',
            'director' => 'required|string|max:255',
            'starring' => 'required|string|max:255',
            'censor_rating' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'language' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'status' => 'required|integer',
        ]);

        $posterPath = $request->file('poster')->store('posters', 'public');

        Movie::create([
            'title' => $request->title,
            'poster' => $posterPath,
            'description' => $request->description,
            'trailer_url' => $request->trailer_url,
            'director' => $request->director,
            'starring' => $request->starring,
            'censor_rating' => $request->censor_rating,
            'genre' => $request->genre,
            'language' => $request->language,
            'subtitle' => $request->subtitle,
            'duration' => $request->duration,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.movies.index')->with('success', 'Movie created successfully.');
    }

    public function show(Movie $movie)
    {
        return view('admin.movies.show', compact('movie'));
    }

    public function edit(Movie $movie)
    {
        return view('admin.movies.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'poster' => 'nullable|image',
            'description' => 'required',
            'trailer_url' => 'required|url',
            'director' => 'required|string|max:255',
            'starring' => 'required|string|max:255',
            'censor_rating' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'language' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'status' => 'required|integer',
        ]);

        if ($request->hasFile('poster')) {
            // Delete the old poster if it exists
            if ($movie->poster && Storage::disk('public')->exists($movie->poster)) {
                Storage::disk('public')->delete($movie->poster);
            }

            $posterPath = $request->file('poster')->store('posters', 'public');
            $movie->poster = $posterPath;
        }

        $movie->update([
            'title' => $request->title,
            'description' => $request->description,
            'trailer_url' => $request->trailer_url,
            'director' => $request->director,
            'starring' => $request->starring,
            'censor_rating' => $request->censor_rating,
            'genre' => $request->genre,
            'language' => $request->language,
            'subtitle' => $request->subtitle,
            'duration' => $request->duration,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.movies.index')->with('success', 'Movie updated successfully.');
    }
}
