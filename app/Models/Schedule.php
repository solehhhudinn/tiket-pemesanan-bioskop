<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];
    
    protected $casts = [
        'selected_seats' => 'array',
        'times' => 'array',
    ];

    public function getFormattedTimesAttribute()
    {
        return collect($this->times)->map(function ($time) {
            return \Carbon\Carbon::parse($time)->format('H:i');
        })->join(', ');
    }
}
