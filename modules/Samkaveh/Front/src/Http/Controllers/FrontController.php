<?php

namespace Samkaveh\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Samkaveh\Common\Responses\AjaxResponse;
use Samkaveh\Course\Models\Course;
use Samkaveh\Front\Http\Requests\FrontRequest;
use Samkaveh\Front\Models\Front;
use Samkaveh\Front\Repository\FrontRepository;
use Samkaveh\RolePermission\Models\Permission;
use Samkaveh\User\Models\User;

class FrontController extends Controller
{

    private $repository;


    public function __construct(FrontRepository $frontRepository)
    {
        $this->repository = $frontRepository;
    }


/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Front::home');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Front  $front
     * @return \Illuminate\Http\Response
     */
    public function single(Course $course)
    {
        $episodes = $this->repository->getEpisode($course);

        if (request()->episode) {
            $episodeItem = $this->repository->getSelectedEpisode($course->id, request()->episode);
        }else{
            $episodeItem = $this->repository->getFirstEpisode($course);
        }

        return view('Front::pages.singleCourse', compact('course','episodes','episodeItem'));
    }

    public function teacher($username)
    {
        $teacher = User::permission(Permission::PERMISSION_TEACH)->where('name', $username)->first();
        return view('Front::teacher', compact('teacher'));
    }

}