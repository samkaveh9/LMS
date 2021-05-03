<?php

namespace Samkaveh\Media\Contracts;

use Illuminate\Http\UploadedFile;
use Samkaveh\Media\Models\Media;

interface MediaFileContract 
{

    public static function upload(UploadedFile $file, string $filename, string $dir) :array ;

    public static function delete(Media $media);

    public static function thumb(Media $media);

}