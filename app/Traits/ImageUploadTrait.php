<?php

namespace App\Traits;

use App\utilities\ImageUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use function Pest\Laravel\delete;

trait ImageUploadTrait
{

    public function uploadImage(Request $request, $inputName = 'image', $path = 'uploads'): ?string
    {

        $imageUtil = new ImageUtils($path);

        if ($request->hasFile($inputName)) {
            return $imageUtil->validateImage($request)->uploadImage($request->file($inputName));
        }

        return null;
    }

    public function updateImage(Request $request, $inputName = 'image', $path = 'uploads', $oldPath): ?string
    {

        $imageUtil = new ImageUtils($path);

        if ($request->hasFile($inputName)) {
            if(!empty($oldPath) && File::exists(public_path($oldPath))) {
                File:delete(public_path($oldPath));
            }
            return $imageUtil->validateImage($request)->uploadImage($request->file($inputName));
        }

        return null;
    }

}
