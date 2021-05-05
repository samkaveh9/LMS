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
        return Course::where('confirmation_status', Course::CONFIRMATION_STATUS_ACCEPTED)->latest()->take(8)->get();
    }

    public function paginate()
    {
        return Course::latest()->paginate(15);
    }

    public function approvedCourse()
    {
        return Course::where('confirmation_status', Course::CONFIRMATION_STATUS_ACCEPTED)->latest()->paginate(15);
    }

    public function unapprovedCourse()
    {
        return Course::where('confirmation_status', Course::CONFIRMATION_STATUS_REJECTED)->latest()->paginate(15);
    }

    public function store($values)
    {
        return Course::create($values->only(
            'category_id','banner_id','teacher_id','title','slug',
            'priority','price','percent','type','status','body'
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

    public function getCoursesByTeacherId($id)
    {
        return Course::where('teacher_id', $id)->get();
    }

    public function updateConfirmationStatus(Course $course, string $status)
    {
        return $course->update(['confirmation_status' => $status]);
    }


    public function updateStatus(Course $course, string $status)
    {
        return $course->update(['status' => $status]);
    }

    public function getTimeForamt(Course $course)
    {
        return $course->where('confirmation_status', Course::CONFIRMATION_STATUS_ACCEPTED)->sum('time');  
    }
    
}
