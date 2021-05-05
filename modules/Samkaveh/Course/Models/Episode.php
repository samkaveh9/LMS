<?php

namespace Samkaveh\Course\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Samkaveh\Media\Models\Media;

class Episode extends Model
{
    use HasFactory, Sluggable;

    const CONFIRMATION_STATUS_ACCEPTED = 'accepted';
    const CONFIRMATION_STATUS_REJECTED = 'rejected';
    const CONFIRMATION_STATUS_PENDING = 'pending';

    const STATUS_LOCKED = 'locked';
    const STATUS_OPENED = 'opened';

    static $statuses = [self::STATUS_OPENED, self::STATUS_LOCKED];
    static $confirmation_status = [self::CONFIRMATION_STATUS_ACCEPTED, self::CONFIRMATION_STATUS_REJECTED, self::CONFIRMATION_STATUS_PENDING];

    protected $guarded = [];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {   
        return $this->belongsTo(User::class);
    }

    public function season()
    {   
        return $this->belongsTo(Season::class);
    }

    public function course()
    {   
        return $this->belongsTo(Course::class);
    }

    public function media()
    {   
        return $this->belongsTo(Media::class);
    }

    public function path()
    {   
        return $this->course->path() . '?episode=' . $this->id . '-' . $this->slug;
    }

    public function downloadLink()
    {   
        return URL::temporarySignedRoute('media.download',now()->addDay(), ['media' => $this->media_id]);
    }
}
