<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    // Define the relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function theater()
    {
        return $this->belongsTo(Theater::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    // Cast `selected_seats` as an array
    protected $casts = [
        'selected_seats' => 'array',
        'times' => 'array',
    ];

    // Convert times to a string representation for display
    public function getFormattedTimesAttribute()
    {
        if ($this->schedule && is_array($this->schedule->times)) {
            return collect($this->schedule->times)->map(function ($time) {
                try {
                    // Ensure $time is a string before parsing
                    return is_string($time) ? Carbon::parse($time)->format('H:i') : 'Invalid time format';
                } catch (\Exception $e) {
                    return 'Invalid time format';
                }
            })->join(', ');
        }
        return 'Tidak tersedia';
    }

    // Convert selected seats to a readable string
    public function getFormattedSeatsAttribute()
    {
        return is_array($this->selected_seats) ? implode(', ', $this->selected_seats) : 'N/A';
    }
}
