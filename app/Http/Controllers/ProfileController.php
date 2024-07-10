<?php

namespace App\Http\Controllers;

use App\utilities\ImageUtils;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function edit(): View
    {
        return view('admin.profile.index');
    }

    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $uploadPath = 'uploads/profile';
        $imageUtil = new ImageUtils($uploadPath);

        if ($request->hasFile('image')) {
            if (File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }
            $filename = $imageUtil->validateImage($request, $user->id)->uploadImage($request->file('image'));
            $user->image = $uploadPath . DIRECTORY_SEPARATOR . $filename;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('status', 'profile updated successfully!');
    }

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
}
