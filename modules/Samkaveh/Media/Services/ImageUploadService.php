<?php

namespace Samkaveh\Media\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageUploadService 
{

    protected static $sizes = ["300" , "600"];

    public static function upload($file)
    {
        $filename = uniqid();
        $dir =  'app\public\\';
        $extension = strtolower($file->getClientOriginalExtension());
        $file->move(storage_path($dir) , $filename . '.' . $extension);
        $path = $dir . '\\' . $filename . '.' . $extension;

        return self::resize(storage_path($path) , $dir ,$filename , $extension);
    }


    private static function resize($image,$dir,$filename,$extension)
    {
        $img = Image::make($image);
        $imgs['original'] = $filename . '.' . $extension;
        foreach (self::$sizes as $size) {
            $imgs[$size] = $filename . '_' . "$size" . '.' . $extension;
            $img->resize($size,null, function($aspect){
                $aspect->aspectRatio();
            })->save(storage_path($dir) . $filename . '_' . "$size" . '.' . $extension);
        }
        return $imgs;
    }


    public static function delete($item,$repository)
    {
        $dir =  'app\public\\';
        
        $repository->findById($item->id);

        if ($item->banner) {
            foreach ($item->banner->files as $file) {
                unlink(storage_path($dir . $file)); 
            }
        }

    }





}

