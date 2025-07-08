<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class DashboardController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('edit-dashboard', compact('user'));
    }
    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'state' => 'required|string',
            'district' => 'required|string',
            'gender' => 'required|in:male,female,other',
            'dob' => 'required|date',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $validated['profile_image'] = $path;
        }

        $user->update($validated);

        return redirect('/')->with('success', 'Profile updated successfully!');
    }

    public function destroy()
    {
        $user = auth()->user();
        $user->delete();

        return redirect('/register')->with('success', 'Account deleted.');
    }

}
