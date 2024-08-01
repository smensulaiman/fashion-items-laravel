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
    public function __construct(string $imagePath)
    {
        $this->imagePath = $imagePath;
    }

    public function validateImage(Request $request, $except = null): ImageUtils
    {
        $request->validate([
            'name' => 'required | string | max:100',
            'email' => 'required | email', 'unique:users,email,' . $except,
            'image' => ['image', 'max:2048'],
        ]);

        return $this;
    }

    public function uploadImage(UploadedFile $image): string
    {
        $filename = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path($this->imagePath), $filename);
        return $filename;
    }

}
