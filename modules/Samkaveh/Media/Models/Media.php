<?php

namespace Samkaveh\Media\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Samkaveh\Media\Services\MediaUploadService;

class Media extends Model
{
    use HasFactory;

    protected $casts = [
        'files' => 'json'
    ];

    protected static function booted(){
        static::deleting(function ($media) {
            MediaUploadService::delete($media);
        });
    }

    public function getThumbAttribute()
    {
        return MediaUploadService::thumb($this);
    }
}

