<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Schedule;
use App\Models\Seat;
use App\Models\Theater;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    // Menampilkan daftar tiket untuk film tertentu
public function index($id)
{
    // Mendapatkan semua film
    $movies = Movie::all();
    // Mendapatkan film yang dipilih berdasarkan ID
    $movie = Movie::findOrFail($id);

    $theater = Theater::findOrFail($id);

    // Mendapatkan jadwal untuk film yang dipilih
    $schedules = Schedule::where('movie_id', $id)
        ->with('theater')  // Memastikan relasi theater di-load
        ->get()
        ->map(function ($schedule) {
            if (is_string($schedule->times)) {
                $schedule->times = json_decode($schedule->times);  // Men-decode times dari JSON ke array jika masih berupa string
            }
            // Output untuk debugging
            logger('Schedule Date:', ['id' => $schedule->id, 'date' => $schedule->date, 'times' => $schedule->times]);
            return $schedule;
        });

    // Mendapatkan kursi untuk setiap jadwal
    $schedules->each(function($schedule) {
        $schedule->seats = Seat::where('schedule_id', $schedule->id)->get();
        // Output untuk debugging
        logger('Seats:', ['schedule_id' => $schedule->id, 'seats' => $schedule->seats]);
    });

    // Mengembalikan view dengan data yang diperlukan
    return view('tickets.index', compact(
        'movies', 'movie', 'schedules', 'theater'));
}

    // Menampilkan halaman pemilihan kursi
    public function seatSelection(Request $request, $id)
    {
        // Mendapatkan jadwal berdasarkan ID
        $schedule = Schedule::findOrFail($request->schedule_id);
        $time = $request->time;
        $quantity = $request->quantity;
        $movie = Movie::findOrFail($schedule->movie_id);

        $movieId = $movie->id;
        $theater = Theater::findOrFail($id); 

        // Mengecek apakah jadwal memiliki kursi tipe sweetbox
        $hasSweetbox = Seat::where('theater_id', $theater->id)->where('type', 'sweetbox')->exists();

        // Mengembalikan view dengan data yang diperlukan
        return view('tickets.selectSeats', compact('schedule', 'theater', 'time', 'quantity', 'hasSweetbox', 'movieId'));
    }
}
