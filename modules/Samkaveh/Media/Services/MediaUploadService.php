<?php

namespace Samkaveh\Media\Services;

use Samkaveh\Media\Models\Media;

class MediaUploadService
{

    public static function upload($file)
    {
        $extension = strtolower($file->getClientOriginalExtension());

        switch ($extension) {
            case 'jpg':
            case 'png':
            case 'jpeg':
                $media = new Media();
                $media->files = ImageUploadService::upload($file);;
                $media->type = 'image';
                $media->user_id = auth()->id();
                $media->filename = $file->getClientOriginalName();
                $media->save();
                return $media;
                break;

            case 'avi':
            case 'mkv':
            case 'mp4':
                VideoUploadService::upload($file);
                break;
        }
    }


    public static function delete($media)
    {
        switch ($media->type) {
            case 'image':
                ImageUploadService::delete($media);
                break;
            
        }
    }





}
