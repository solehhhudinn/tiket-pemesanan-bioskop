<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Import User model

class ProfileController extends Controller
{
    public function edit()
    {
        return view('admin.profile.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        if ($user instanceof User) {
            $user->name = $request->name;
            $user->save();
            return redirect()->route('admin.profile.edit')->with('status', 'Profile updated successfully.');
        } else {
            return redirect()->route('admin.profile.edit')->withErrors('User not found.');
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        if ($user instanceof User) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }

            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('admin.profile.edit')->with('status', 'Password updated successfully.');
        } else {
            return redirect()->route('admin.profile.edit')->withErrors('User not found.');
        }
    }
}
