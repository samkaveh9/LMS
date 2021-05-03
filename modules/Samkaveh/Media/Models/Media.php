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

    protected $guarded = [];

    const TYPE_IMG = 'image';
    const TYPE_VID = 'video';
    const TYPE_AUD = 'audio';
    const TYPE_ZIP = 'zip';
    const TYPE_DOC = 'doc';

    static $types = [self::TYPE_IMG ,self::TYPE_VID ,self::TYPE_AUD ,self::TYPE_ZIP ,self::TYPE_DOC];


    public static function booted()
    {
        static::deleting(function($media){
            MediaUploadService::delete($media);
        });
    }

    public function getThumbAttribute()
    {
        return '/storage/' .  $this->files[300];
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

}

