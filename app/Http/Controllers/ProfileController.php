<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\Role;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
            'role' => Role::find($request->user()->role_id),
            'availablePictures' => Storage::disk('public')->files('avatars'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if($request->has('avatar'))
        {
            $path = $request->file('avatar')->store('avatars', 'public');
            $request->user()->avatar = $path;
            \Log::info('Avatar uploaded: ' . $path);
        }
        else if($request->has('selected_picture'))
        {
            $request->user()->avatar = $request->input('selected_picture');
        }

        // \Log::info('User avatar updated: ' . $request->user()->avatar);
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updatePicture(Request $request)
    {
        $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'selected_picture' => 'nullable|string',
        ]);

        $user = $request->user();

        $path = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $path;
        \Log::info('Avatar uploaded: ' . $path);

        $user->save();
        \Log::info('User avatar updated: ' . $user->avatar);

        return redirect()->route('profile.edit')->with('status', 'profile-picture-updated');
    }
}
