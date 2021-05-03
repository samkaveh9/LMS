<?php

namespace Samkaveh\Media\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Samkaveh\Media\Contracts\MediaFileContract;
use Samkaveh\Media\Models\Media;

class ZipUploadService extends DefaultUploadService implements MediaFileContract
{
    public static function upload(UploadedFile $file, $filename, $dir): array
    {
        Storage::putFileAs($dir, $file, $filename . '.' . $file->getClientOriginalExtension());
        return ["zip" => $filename .  '.' . $file->getClientOriginalExtension()];
    }

    public static function thumb(Media $media)
    {
        return url("/img/zip-thumb.png");
    }
}
