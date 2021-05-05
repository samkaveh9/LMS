<?php

namespace Samkaveh\User\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Samkaveh\Course\Models\Course;
use Samkaveh\RolePermission\Models\Role;
use Samkaveh\User\Notifications\ResetPasswordRequestNotification;
use Samkaveh\User\Notifications\VerifyMailNotification;
use Spatie\Permission\Traits\HasRoles;
use Samkaveh\Course\Models\Season;
use Samkaveh\Media\Models\Media;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_BAN = 'ban';

    public static $statuses = [
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE,
        self::STATUS_BAN,
    ];

    public static $defualtUsers = [
        [
        'name' => 'Admin',
        'email' => 'admin@admin.com',
        'password' => 'demo',
        'role' => Role::ROLE_ADMIN
        ],
    ];
    
    protected $fillable = [
        'name', 'email', 'password', 'mobile'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function image()
    {
        return $this->belongsTo(Media::class,'image_id');
    }  

    public function courses()
    {
        return $this->hasMany(Course::class,'teacher_id');
    } 
    
    public function purchases()
    {
        return $this->belongsToMany(Course::class, 'course_user', 'user_id', 'course_id');
    }

    public function seasons()
    {
        return $this->hasMany(Season::class);
    } 
    
    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function getThumbAttribute()
    {
        if ($this->image) 
            return '/storage/' .  $this->image->files[300];

        return '/panel/img/pro.jpg';  
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyMailNotification());
    }


    public function sendResetPasswordRequestNotification()
    {
        $this->notify(new ResetPasswordRequestNotification());
    }

    public function hasAccessToCourse(Course $course)
    {
        if ($this->can('manage', Course::class) || 
            $this->id === $course->teacher_id || 
            $course->students->contains($this->id)) {
            
            return true;
        }
        return false;
    }

}
