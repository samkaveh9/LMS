<?php   

namespace Samkaveh\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Samkaveh\Category\Repository\CategoryRepository;
use Samkaveh\Common\Responses\AjaxResponse;
use Samkaveh\Course\Repository\CourseRepository;
use Samkaveh\Course\Http\Requests\CourseRequest;
use Samkaveh\Course\Models\Course;
use Samkaveh\Course\Models\Episode;
use Samkaveh\Media\Services\MediaUploadService;
use Samkaveh\RolePermission\Models\Permission;
use Samkaveh\User\Repositories\UserRepository;

class CourseController extends Controller
{

    private $repository;


    public function __construct(CourseRepository $courseRepository)
    {
        $this->repository = $courseRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index',Course::class);
        if (auth()->user()->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES) ||
            auth()->user()->hasPermissionTo(Permission::PERMISSION_ADMIN)) {
            $courses = $this->repository->paginate();
        }else{
            $courses = $this->repository->getCoursesByTeacherId(auth()->id());
        }
        return view('Course::index', compact('courses'));
    }


    public function approvedCourse()
    {
        $this->authorize('index',Course::class);
        if (auth()->user()->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES) ||
            auth()->user()->hasPermissionTo(Permission::PERMISSION_ADMIN)) {
            $courses = $this->repository->approvedCourse();
        }else{
            $courses = $this->repository->getCoursesByTeacherId(auth()->id());
        }
        return view('Course::approved', compact('courses'));
    }

    public function unapprovedCourse()
    {
        $this->authorize('index',Course::class);
        if (auth()->user()->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES) ||
            auth()->user()->hasPermissionTo(Permission::PERMISSION_ADMIN)) {
            $courses = $this->repository->unapprovedCourse();
        }else{
            $courses = $this->repository->getCoursesByTeacherId(auth()->id());
        }
        return view('Course::unapproved', compact('courses'));
    }

        
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(UserRepository $userRepository, CategoryRepository $categoryRepository)
    {
        $this->authorize('create',Course::class);
        $teachers = $userRepository->getTeachers();
        $categories = $categoryRepository->all();
        return view('Course::create', compact('teachers', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        $request->request->add(['banner_id' => MediaUploadService::publicUpload($request->file('banner'))->id]);
        $this->repository->store($request);
        return redirect(route('courses.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course, UserRepository $userRepository, CategoryRepository $categoryRepository)
    {
        $this->authorize('edit',$course);
        $teachers = $userRepository->getTeachers();
        $categories = $categoryRepository->all();
        return view('Course::edit', compact('course', 'teachers', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\CourseRequest  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, Course $course, CourseRepository $courseRepository)
    { 
        $this->authorize('update',Course::class);
        if ($request->hasFile('banner')) {
            $request->request->add(['banner_id' => MediaUploadService::publicUpload($request->file('banner'))->id ]);
            if ($course->banner)
                $course->banner->delete();
        }else{
            $request->request->add(['banner_id' => $course->banner_id]);
        }
        $courseRepository->update($course, $request);
        return redirect(route('courses.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $this->authorize('delete',Course::class);
        if ($course->banner) {
            $course->banner->delete();
        }
        $course->delete();
        AjaxResponse::SuccessResponse();
        return back();
    }

    public function accept(Course $course)
    {
        $this->authorize('change_confirmation_status',Course::class);   
        if ($this->repository->updateConfirmationStatus($course, Course::CONFIRMATION_STATUS_ACCEPTED))
            return AjaxResponse::SuccessResponse();

        return AjaxResponse::FailResponse();
    }

    public function reject(Course $course)
    {
        $this->authorize('change_confirmation_status',Course::class);
        if ($this->repository->updateConfirmationStatus($course, Course::CONFIRMATION_STATUS_REJECTED))
            return AjaxResponse::SuccessResponse();

        return AjaxResponse::FailResponse();
    }


    public function lock(Course $course)
    {
        $this->authorize('change_confirmation_status',Course::class);
        if ($this->repository->updateStatus($course, Course::STATUS_LOCKED))
            return AjaxResponse::SuccessResponse();

        return AjaxResponse::FailResponse();
    }

    public function detail(Course $course, Episode $episode)
    {
        $this->authorize('details', $course);
        return view('Course::detail',compact('course'));
    }
}
