<?php
// app/Http/Controllers/ProfilePictureController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class AvatarController extends Controller
{
    public function showOptions(Request $request)
    {
        $user = $request->user();
        $availablePictures = Storage::disk('public')->files('avatars');
        return view('profile.edit', compact('user', 'availablePictures'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'avatar' => 'required|string',
        ]);

        $user = auth()->user();
        // Check if a file was uploaded
        if ($request->hasFile('avatar')) {
            // Store the uploaded file and get its path
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path; // Save the new avatar path
        } elseif ($request->input('selected_picture')) {
            // Use selected picture from the available options
            $user->avatar = $request->input('selected_picture');
        }

        $user->save(); // Save changes to the user

        return redirect()->route('profile.edit')->with('status', 'profile-picture-updated');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('picture')->store('avatars', 'public');
        return response()->json(['path' => $path]);
    }
}