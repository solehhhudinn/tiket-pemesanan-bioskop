<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Theater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminTheaterController extends Controller
{
    public function index()
    {
        $theaters = Theater::all();
        return view('admin.theaters.index', compact('theaters'));
    }
    public function show(Theater $theater)
    {
        return view('admin.theaters.show', compact('theater'));
    }
}