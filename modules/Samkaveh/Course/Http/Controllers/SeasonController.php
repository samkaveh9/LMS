<?php

namespace Samkaveh\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Samkaveh\Common\Responses\AjaxResponse;
use Samkaveh\Course\Http\Requests\SeasonRequest;
use Samkaveh\Course\Models\Course;
use Samkaveh\Course\Models\Season;
use Samkaveh\Course\Repository\SeasonRepository;

class SeasonController extends Controller
{

    private $repository;

    public function __construct(SeasonRepository $seasonRepository)
    {
        $this->repository = $seasonRepository;
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Course $course, SeasonRequest $request)
    {
        $this->repository->store($course,$request);
        // AjaxResponse::SuccessResponse();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function show(Season $season)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function edit(Season $season, Course $course)
    {
        return view('Course::seasons.edit',compact('season','course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function update(SeasonRequest $request, Season $season)
    {
        $this->repository->update($season,$request);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function destroy(Season $season)
    {
        $this->repository->destory($season);
        return AjaxResponse::SuccessResponse();
    }

    public function accept(Season $season, SeasonRepository $repository)
    {
        if ($repository->updateConfirmationStatus($season, Season::CONFIRMATION_STATUS_ACCEPTED));
        return AjaxResponse::SuccessResponse();

        return AjaxResponse::FailResponse();
    }

    public function reject(Season $season, SeasonRepository $repository)
    {
        if ($repository->updateConfirmationStatus($season, Season::CONFIRMATION_STATUS_REJECTED));
            return AjaxResponse::SuccessResponse();

        return AjaxResponse::FailResponse();
    }

    public function lock(Season $season, SeasonRepository $repository)
    {
        if ($repository->updateStatus($season, Season::STATUS_LOCKED));
            return AjaxResponse::SuccessResponse();

        return AjaxResponse::FailResponse();
    }

    public function unlock(Season $season, SeasonRepository $repository)
    {
        if ($repository->updateStatus($season, Season::STATUS_OPENED));
            return AjaxResponse::SuccessResponse();

        return AjaxResponse::FailResponse();
    }

}
