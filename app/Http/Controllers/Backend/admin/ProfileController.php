<?php

namespace App\Http\Controllers\Backend\admin;

use App\Http\Controllers\Controller;
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

        $request->validate([
            'name' => 'required | string | max:100',
            'email' => 'required | email', 'unique:users,email,' . $user->id,
        ]);

        if ($request->hasFile('image')) {
            if (File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }
            $filename = $imageUtil->validateImage($request)->uploadImage($request->file('image'));
            $user->image = $uploadPath . DIRECTORY_SEPARATOR . $filename;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        toastr()->success('Profile updated successfully!');

        return redirect()->back()->with('status', 'profile updated successfully!');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate(array(
           'current_password' => array('required', 'current_password'),
           'password' => array('required', 'min:6', 'confirmed'),
        ));

        $request->user()->update(array(
            'password' => bcrypt($request->password)
        ));

        toastr()->success('Password updated successfully!');

        return redirect()->back()->with('status', 'password updated successfully!');
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
