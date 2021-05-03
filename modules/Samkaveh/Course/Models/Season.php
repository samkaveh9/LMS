<?php

namespace Samkaveh\Course\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    const CONFIRMATION_STATUS_ACCEPTED = 'accepted';
    const CONFIRMATION_STATUS_REJECTED = 'rejected';
    const CONFIRMATION_STATUS_PENDING = 'pending';

    const STATUS_LOCKED = 'locked';
    const STATUS_OPENED = 'opened';

    static $statuses = [self::STATUS_OPENED, self::STATUS_LOCKED];
    static $confirmation_status = [self::CONFIRMATION_STATUS_ACCEPTED, self::CONFIRMATION_STATUS_REJECTED, self::CONFIRMATION_STATUS_PENDING];

    protected $guarded = [];


    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';    
    }


}
