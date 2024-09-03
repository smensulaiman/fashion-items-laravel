<?php

namespace App\utilities;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ImageUtils
{
    protected string $imagePath = "";

    /**
     * @param string $imagePath
     */
    public function __construct(string $imagePath = 'uploads')
    {
        $this->imagePath = $imagePath;
    }

    public function validateImage(Request $request): ImageUtils
    {
        $request->validate(['image' => ['image', 'max:2048']]);
        return $this;
    }

    public function uploadImage(UploadedFile $image): string
    {
        $filename = uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path($this->imagePath), $filename);
        return $this->imagePath . DIRECTORY_SEPARATOR . $filename;
    }
}
