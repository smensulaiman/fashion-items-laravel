<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\utilities\ImageUtils;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class UserProfileController extends Controller
{
    public function index(): View
    {
        return view('frontend.dashboard.user-profile');
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $uploadPath = 'uploads/profile';
        $imageUtil = new ImageUtils($uploadPath);

        $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
        ]);

        $user->name = $request->get('name');
        $user->email = $request->get('email');

        if ($request->hasFile('image')) {
            if(File::exists(public_path($user->image))){
                File::delete(public_path($user->image));
            }

            $fileName = $imageUtil->validateImage($request)->uploadImage($request->file('image'));
            $user->image = $uploadPath . DIRECTORY_SEPARATOR . $fileName;
        }

        $user->save();

        toastr()->success('Profile updated successfully!');

        return redirect()->back()->with('status', 'profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        dd($request->all());
    }

}
