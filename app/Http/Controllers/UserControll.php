<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserControll extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required',
        ]);

        if (auth()->attempt(['name' => $credentials['loginname'], 'password' => $credentials['loginpassword']])) {
            $request->session()->regenerate();
            return redirect('/'); // success: go to homepage or dashboard
        }

        // login failed: redirect back with error
        return back()->withErrors([
            'loginname' => 'Invalid credentials.',
        ])->withInput();
    }


    public function updateImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $user = auth()->user();

        // Delete old image if exists
        if ($user->profile_image && \Storage::disk('public')->exists($user->profile_image)) {
            \Storage::disk('public')->delete($user->profile_image);
        }

        // Store new image
        $user->profile_image = $request->file('profile_image')->store('profile_images', 'public');
        $user->save();

        return redirect()->back()->with('success', 'Profile image updated.');
    }


    public function deleteImage()
    {
        $user = auth()->user();

        if ($user->profile_image && \Storage::disk('public')->exists($user->profile_image)) {
            \Storage::disk('public')->delete($user->profile_image);
            $user->profile_image = null;
            $user->save();
        }

        return redirect()->back()->with('success', 'Profile image deleted.');
    }


    public function logout()
    {
        auth()->logout();
        return redirect("/");
    }

    public function register(Request $request)
    {
        $incomingfields = $request->validate([
            'name' => ['required', 'min:3', 'max:20', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:3', 'max:15'],
            'state' => ['required', 'string'],
            'district' => ['required', 'string'],
            'gender' => ['required', 'in:male,female,other'],
            'dob' => ['required', 'date'],
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',

        ]);
        $incomingfields['password'] = bcrypt($incomingfields['password']);

        if ($request->hasFile('profile_image')) {
            $incomingfields['profile_image'] = $request->file('profile_image')->store('profile_images', 'public');
        }

        $user = User::create($incomingfields);

        auth()->login($user);

        return redirect('/');
    }

}
