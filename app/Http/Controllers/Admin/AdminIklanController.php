<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Iklan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminIklanController extends Controller
{
    public function index()
    {
        $iklans = Iklan::all();
        return view('admin.iklans.index', compact('iklans'));
    }

}