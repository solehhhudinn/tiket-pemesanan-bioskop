<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function getSchedules($date, $movieId)
{
    $schedules = Schedule::where('date', $date)->where('movie_id', $movieId)->get();

    return view('schedules.list', compact('schedules'))->render();
}

public function getSeats($scheduleId)
{
    $schedule = Schedule::find($scheduleId);

    if (!$schedule) {
        return response()->json(['message' => 'Jadwal tidak ditemukan'], 404);
    }

    // Misalkan kita memiliki model Seat yang berhubungan dengan jadwal
    $seats = $schedule->seats;

    return view('seats.map', compact('seats'))->render();
}
}
