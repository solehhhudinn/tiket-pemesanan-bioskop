<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'theater_id',
        'seat_number',
        'type',
        'is_available'
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function theater()
    {
        return $this->belongsTo(Theater::class);
    }
}
