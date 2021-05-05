<?php

namespace Samkaveh\Course\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Samkaveh\Category\Models\Category;
use Samkaveh\Media\Models\Media;
use Samkaveh\User\Models\User;
use Samkaveh\Course\Models\Season;
use Samkaveh\Course\Repository\CourseRepository;

class Course extends Model
{
    use HasFactory,Sluggable;

    const TYPE_FREE = 'free';
    const TYPE_CASH = 'cash';
    const STATUS_COMPLETED = 'completed';
    const STATUS_NOTCOMPLETED = 'not-completed';
    const STATUS_LOCKED = 'locked';
    const CONFIRMATION_STATUS_ACCEPTED = 'accepted';
    const CONFIRMATION_STATUS_REJECTED = 'rejected';
    const CONFIRMATION_STATUS_PENDING = 'pending';

    static $types = [self::TYPE_FREE,self::TYPE_CASH];
    static $statuses = [self::STATUS_COMPLETED, self::STATUS_NOTCOMPLETED, self::STATUS_LOCKED];
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

    public function banner()
    {
        return $this->belongsTo(Media::class,'banner_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    // public function parentCategory()
    // {
    //     return $this->belongsTo(Category::class,'parent_id');
    // }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user','course_id','user_id');
    }

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }    

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function path()
    {
        return route('front.single',$this->slug);
    }

}
