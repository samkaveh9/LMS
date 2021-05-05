<?php

namespace Samkaveh\Front\Repository;

use Samkaveh\Course\Models\Course;
use Samkaveh\Course\Models\Episode;
use Samkaveh\User\Models\User;

class FrontRepository
{

   public function getTeacher(User $user)
   {
      return User::whereId($user->id)->first();
   }
    
    public function getEpisode(Course $course)
    {
       return Episode::where('course_id', $course->id)
                ->where('confirmation_status', Course::CONFIRMATION_STATUS_ACCEPTED)
                ->get();
    }

    public function getFirstEpisode(Course $course)
    {
       return Episode::where('course_id', $course->id)
                ->where('confirmation_status', Course::CONFIRMATION_STATUS_ACCEPTED)
                ->orderBy('number', 'asc')
                ->first();
    }

    public function getSelectedEpisode($courseId,$episodeId)
    {
       return Episode::where('course_id', $courseId)
                ->where('id', $episodeId)
                ->first();
    }



}
