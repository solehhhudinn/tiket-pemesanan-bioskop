<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    const STATUS_NOW_PLAYING = 1;
    const STATUS_UPCOMING = 2;
}
