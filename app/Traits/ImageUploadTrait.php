<?php

namespace App\Traits;

use App\utilities\ImageUtils;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

    public function updateImage(Request $request, $inputName, $path, $oldPath): ?string
    {

        $imageUtil = new ImageUtils($path);

        if ($request->hasFile($inputName)) {
            $this->deleteImage($oldPath);
            return $imageUtil->validateImage($request)->uploadImage($request->file($inputName));
        }

        return null;
    }

    private function deleteImage(string $filePath): bool
    {
        try {
            if(!empty($filePath) && File::exists(public_path($filePath))) {
                File::delete(public_path($filePath));
            }
        }catch (Exception $exception){
            echo $exception->getMessage();
            return false;
        }
        return true;
    }

}
