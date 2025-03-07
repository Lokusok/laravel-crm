<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

final class PreviewUploader
{
    public function storePreview(UploadedFile $file): ?string
    {
        $image = Image::read($file)->resize(60, 60);

        $path = 'previews/' . Str::random() . '.' . $file->getClientOriginalExtension();

        $result = Storage::disk('public')->put(
            $path,
            $image->encodeByExtension($file->getClientOriginalExtension(), quality: 90)
        );

        if ($result) {
            return $path;
        }

        return null;
    }
}
