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

    public function create()
    {
        return view('admin.theaters.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'price' => 'nullable|string',
            'image' => 'nullable|image',
        ]);
        
        
        $imagePath = $request->file('image') ? $request->file('image')->store('theaters', 'public') : null;
        
        Theater::create([
            'name' => $request->name,
            'location' => $request->location,
            'price' => $request->price,
            'image' => $imagePath,
        ]);
    }
        
    public function edit(Theater $theater)
    {
        return view('admin.theaters.edit', compact('theater'));
    }
    
    public function update(Request $request, Theater $theater)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'price' => 'nullable|string',
            'image' => 'nullable|image',
        ]);
    
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($theater->image && Storage::disk('public')->exists($theater->image)) {
                Storage::disk('public')->delete($theater->image);
            }
    
            $imagePath = $request->file('image')->store('theaters', 'public');
            $theater->image = $imagePath;
        }
    
            $theater->update([
                'name' => $request->name,
                'location' => $request->location,
                'price' => $request->price,
                'image' => $theater->image,
            ]);
    
            return redirect()->route('admin.theaters.index')->with('success', 'Theater updated successfully.');
        }
}
