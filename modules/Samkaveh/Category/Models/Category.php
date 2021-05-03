<?php

namespace Samkaveh\Category\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Samkaveh\Course\Models\Course;

class Category extends Model
{

    use Sluggable;

    
    protected $fillable = ['title', 'slug','parent_id'];

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

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getParentNameAttribute()
    {
        return (is_null($this->parent_id)) ? 'بدون دسته اصلی' : $this->parentCategory->title;
    }
    
    public function subCategories()
    {
        return $this->hasMany(Category::class,'parent_id');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class,'parent_id');
    }
    
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    
}
