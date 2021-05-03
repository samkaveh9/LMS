<?php

namespace Samkaveh\Course\Http\Controllers;

use Samkaveh\Course\Models\Episode;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Samkaveh\Common\Responses\AjaxResponse;
use Samkaveh\Course\Http\Requests\EpisodeRequest;
use Samkaveh\Course\Models\Course;
use Samkaveh\Course\Models\Season;
use Samkaveh\Course\Repository\EpisodeRepository;
use Samkaveh\Course\Repository\SeasonRepository;
use Samkaveh\Media\Services\MediaUploadService;

class EpisodeController extends Controller
{

    private $repository;


    public function __construct(EpisodeRepository $episodeRepository)
    {
        $this->repository = $episodeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course, SeasonRepository $seasonRepository)
    {
        $seasons = $seasonRepository->getCourseSeasons($course);
        return view('Course::episodes.create', compact('seasons', 'course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EpisodeRequest $request, Course $course)
    {
        $request->request->add(['media_id' => MediaUploadService::privateUpload($request->file('episode_file'))->id]);
        $this->repository->store($request, $course->id);
        return redirect(route('courses.detail', $course->slug));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function show(Episode $episode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course, Episode $episode, Season $season)
    {
        return view('Course::episodes.edit', compact(['episode', 'course', 'season']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function update(EpisodeRequest $request, Course $course, Episode $episode)
    {
        if ($request->hasFile('episode_file')) {
            if ($episode->media) {
                $episode->media->delete();
            }
            $request->request->add(['media_id' => MediaUploadService::privateUpload($request->file('episode_file'))->id]);
        } else {
            $request->request->add(['media_id' => $episode->media_id]);
        }
        $this->repository->update($episode, $request);
        return redirect(route('courses.detail', $course->slug));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course, Episode $episode)
    {
        $episode->media->delete();
        $episode->delete();
        return AjaxResponse::SuccessResponse();
    }


    public function destroyMultiple(Request $request)
    {
        $ids = explode(',', $request->ids);
        foreach ($ids as $id) {
            $episode = $this->repository->findById($id);
            if ($episode->media) {
                $episode->media->delete();
            }
            $episode->delete();
        }
        return AjaxResponse::SuccessResponse();
    }

    public function acceptAll($courseId)
    {
        $this->repository->updateConfirmationStatus($courseId, Episode::CONFIRMATION_STATUS_ACCEPTED);
        return back();
    }

    public function acceptMultiple(Request $request)
    {
        // $ids = explode(',', $request->ids);
        // $ids = explode(',', $request->ids);
        dd($request->all());
        $this->repository->updateConfirmationStatus($ids ,Episode::CONFIRMATION_STATUS_ACCEPTED);
        return back();

        // $ids = explode(',', $request->ids);
        // $this->lessonRepo->updateConfirmationStatus($ids, Episode::CONFIRMATION_STATUS_ACCEPTED);
        // return back();
    }

    public function rejectMultiple(Episode $episode ,Request $request)
    {
        $ids = explode(',', $request->ids);
        $this->repository->updateConfirmationStatus($episode ,Episode::CONFIRMATION_STATUS_REJECTED);
        return back();
    }

    public function accept(Episode $episode)
    {
        $this->repository->updateConfirmationStatus($episode, Episode::CONFIRMATION_STATUS_ACCEPTED);
        return AjaxResponse::SuccessResponse();
    }

    public function reject(Episode $episode)
    {
        $this->repository->updateConfirmationStatus($episode, Episode::CONFIRMATION_STATUS_REJECTED);
        return AjaxResponse::SuccessResponse();
    }

    public function lock(Episode $episode)
    {
        $this->repository->updateStatus($episode, Episode::STATUS_LOCKED);
        return AjaxResponse::SuccessResponse();
    }

    public function unlock(Episode $episode)
    {
        $this->repository->updateStatus($episode, Episode::STATUS_OPENED);
        return AjaxResponse::SuccessResponse();
    }
}
