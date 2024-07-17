<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function getSeats($theaterId)
    {
        // Fetch seats related to the schedule
        $seats = Seat::where('theater_id', $theaterId)
                     ->select('id', 'seat_number', 'type', 'is_available')
                     ->get();
        
        $rows = [];
        foreach ($seats as $seat) {
            $row = strtoupper($seat->seat_number[0]);
            if (!isset($rows[$row])) {
                $rows[$row] = [];
            }
            $rows[$row][] = $seat;
        }

        ksort($rows);
        if (isset($rows['A'])) {
            $aRow = $rows['A'];
            unset($rows['A']);
            $rows['A'] = $aRow;
        }

        $layout = [
            'rows' => array_keys($rows),
            'columns' => count($rows ? current($rows) : []), // Get the number of columns from the first row
        ];

        return response()->json([
            'seats' => $seats,
            'layout' => $layout,
            'rows' => $rows,
        ]);
    }
}
