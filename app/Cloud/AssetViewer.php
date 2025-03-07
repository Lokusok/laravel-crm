<?php

namespace App\Cloud;

use Illuminate\Support\Facades\Storage;

class AssetViewer
{
    public static function get(string $path)
    {
        $result = Storage::cloud()->url($path);

        $result = str_replace('minio', 'localhost', $result);
        $result = str_replace('9000', '6969', $result);

        return $result;
    }
}
