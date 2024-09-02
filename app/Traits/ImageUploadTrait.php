<?php

namespace App\Traits;

use App\utilities\ImageUtils;
use Illuminate\Http\Request;

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

}
