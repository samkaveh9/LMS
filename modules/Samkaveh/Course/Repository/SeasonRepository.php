<?php

namespace Samkaveh\Course\Repository;

use Samkaveh\Course\Models\Season;

class SeasonRepository
{

    public function getCourseSeasons($course)
    {
        return Season::where('course_id',$course)
                ->where('confirmation_status',Season::CONFIRMATION_STATUS_ACCEPTED)
                ->orderBy('number','desc')
                ->get();
    }

    public function store($course,$values)
    {
        return Season::create([
            'course_id' => $course->id,
            'user_id' => auth()->id(),
            'title' => $values->title,
            'number' => $this->generateNumber($values->number,$course->id),
            'confirmation_status' => Season::CONFIRMATION_STATUS_PENDING,
        ]);
    }

    public function update($course, $values)
    {
        return $course->update([
            'title' => $values->title,
            'number' => $this->generateNumber($values->number,$course->id),
        ]);
    }

    public function destory($item)
    {
        return $item->delete();
    }

    public function findById($id)
    {
        return Season::findOrFail($id);
    }


    public function updateConfirmationStatus(Season $season, string $status)
    {
        return $season->whereId($season->id)->update(['confirmation_status' => $status]);
    }

    public function updateStatus(Season $season, string $status)
    {
        return $season->whereId($season->id)->update(['status' => $status]);
    }

    public function generateNumber($number, $courseId)
    {
        $courseRepository = resolve(CourseRepository::class);
        
        if (is_null($number)) {
            $number = $courseRepository->findById($courseId)->seasons()
            ->orderBy('number','desc')->firstOrNew([])->number ?: 0;
            $number++;
        }
         return $number;
    }
    
    
}
