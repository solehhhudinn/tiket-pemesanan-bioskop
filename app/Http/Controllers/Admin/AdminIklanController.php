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

    

    public function edit(Iklan $iklan)
    {
        return view('admin.iklans.edit', compact('iklan'));
    }

    public function update(Request $request, Iklan $iklan)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'iklan' => 'nullable|image',
        ]);

        if ($request->hasFile('iklan')) {
            // Delete the old iklan if it exists
            if ($iklan->iklan && Storage::disk('public')->exists($iklan->iklan)) {
                Storage::disk('public')->delete($iklan->iklan);
            }

            $iklanPath = $request->file('iklan')->store('iklans', 'public');
            $iklan->iklan = $iklanPath;
        }

        $iklan->update([
            'title' => $request->title,
            'iklan' => $iklan->iklan,
        ]);

        return redirect()->route('admin.iklans.index')->with('success', 'Iklan updated successfully.');
    }
}