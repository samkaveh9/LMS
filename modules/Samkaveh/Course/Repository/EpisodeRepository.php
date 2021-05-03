<?php

namespace Samkaveh\Course\Repository;

use Samkaveh\Course\Models\Episode;

class EpisodeRepository
{

    public function store($values,$courseId)
    {
        return Episode::create([
            'title' => $values->title,
            'time' => $values->time,
            'number' => $values->number,
            'season_id' => $values->season_id,
            'media_id' => $values->media_id,
            'course_id' => $courseId,
            'user_id' => auth()->id(),
            'confirmation_status' => Episode::CONFIRMATION_STATUS_PENDING,
            'status' => Episode::STATUS_OPENED,
            'body' => $values->body,
            'is_free' => $values->is_free
        ]);
    }

    public function update($episode ,$values)
    {
        return $episode->update([
            'title' => $values->title,
            'time' => $values->time,
            'number' => $values->number,
            'season_id' => $values->season_id,
            'media_id' => $values->media_id,
            'body' => $values->body,
            'is_free' => $values->is_free
        ]);
    }

    public function destory($item)
    {
        return $item->delete();
    }

    public function findById($id)
    {
        return Episode::findOrFail($id);
    }

    public function updateConfirmationStatus($id, string $status)
    {
        // if (is_array($episode)) {
        //     return $episode->update(['confirmation_status' => $status]);
        // }
        // return $episode->update(['confirmation_status'=> $status]);


        if (is_array($id)) {
            return Episode::query()->whereIn('id', $id)->update(['confirmation_status' => $status]);
        }
        return Episode::where('id', $id)->update(['confirmation_status'=> $status]);
    }

    public function updateStatus(Episode $episode, string $status)
    {
        return $episode->update(['status' => $status]);
    }
    
}
