<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Http\Controllers\Controller;
use App\utilities\ImageUtils;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class VendorProfileController extends Controller
{
    public function index(): View
    {
        return view('vendor.dashboard.profile');
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
            if (File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }

            $user->image = $imageUtil->validateImage($request)->uploadImage($request->file('image'));
        }

        $user->save();

        toastr()->success('Profile updated successfully!');

        return redirect()->back()->with('status', 'profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        request()->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        toastr()->success('Password updated successfully!');
        return redirect()->back()->with('status', 'Password updated successfully!');
    }

}
