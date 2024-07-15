<?php

namespace App\Http\Controllers;

use App\Models\Theater;
use Illuminate\Http\Request;

class TheaterController extends Controller
{
    public function index(Request $request)
    {
        $location = $request->input('location');

        // Ambil semua lokasi yang unik
        $locations = Theater::select('location')->distinct()->get();

        // Filter teater berdasarkan lokasi yang dipilih
        $theaters = Theater::when($location, function ($query, $location) {
            return $query->where('location', $location);
        })->get();

        return view('theaters', compact('theaters', 'locations', 'location'));
    }
}

