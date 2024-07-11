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
}