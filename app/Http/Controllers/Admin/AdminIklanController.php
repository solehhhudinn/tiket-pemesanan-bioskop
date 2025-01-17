<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Iklan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminIklanController extends Controller
{
    public function index(Request $request)
    {

        $perPage = $request->get('per_page', 5); // Default to 5 items per page
        $search = $request->get('search'); // Get search query

        $query = Iklan::query();

        if ($search) {
            $query->where('title', 'LIKE', "%{$search}%");
        }

        $iklans = $query->paginate($perPage);

        return view('admin.iklans.index', compact('iklans', 'search', 'perPage'));
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

    public function show(Iklan $iklan)
    {
        return view('admin.iklans.show', compact('iklan'));
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

    public function destroy(Iklan $iklan)
    {
        // Delete the iklan file if it exists
        if ($iklan->iklan && Storage::disk('public')->exists($iklan->iklan)) {
            Storage::disk('public')->delete($iklan->iklan);
        }

        $iklan->delete();
        return redirect()->route('admin.iklans.index')->with('success', 'Iklan deleted successfully.');
    }
}
