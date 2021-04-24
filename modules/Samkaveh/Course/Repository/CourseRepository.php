<?php

namespace Samkaveh\Course\Repository;

use Samkaveh\Course\Models\Course;

class CourseRepository
{

    public function all()
    {
        return Course::all();
    }

    public function latest()
    {
        return Course::latest()->get();
    }

    public function paginate()
    {
        return Course::latest()->paginate(15);
    }

    public function store($values)
    {
        return Course::create($values->only(
            'category_id','banner_id','teacher_id','title','slug','priority','price','percent','type','status','body'
        ));
    }

    public function update($item, $values)
    {
        return $item->update($values->only(
            'category_id','banner_id','teacher_id','title','slug','priority','price','percent','type','status','body'
        ));
    }

    public function destory($item)
    {
        return $item->delete();
    }

    public function findById($id)
    {
        return Course::findOrFail($id);
    }


    public function updateConfirmationStatus(Course $course, string $status)
    {
        return $course->update(['confirmation_status' => $status]);
    }


    public function updateStatus(Course $course, string $status)
    {
        return $course->update(['status' => $status]);
    }
    
}
