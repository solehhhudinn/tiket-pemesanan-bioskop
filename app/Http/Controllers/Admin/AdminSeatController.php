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
    }
 }