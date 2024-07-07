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

    public function create()
    {
        return view('admin.iklans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'iklan' => 'required|image',
        ]);

        $iklanPath = $request->file('iklan')->store('iklans', 'public');

        Iklan::create([
            'title' => $request->title,
            'iklan' => $iklanPath,
        ]);

        return redirect()->route('admin.iklans.index')->with('success', 'Iklan created successfully.');
    }
}