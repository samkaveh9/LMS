<?php   

namespace Samkaveh\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Samkaveh\Category\Repository\CategoryRepository;
use Samkaveh\Common\Responses\AjaxResponse;
use Samkaveh\Course\Repository\CourseRepository;
use Samkaveh\Course\Http\Requests\CourseRequest;
use Samkaveh\Course\Models\Course;
use Samkaveh\Media\Services\ImageUploadService;
use Samkaveh\Media\Services\MediaUploadService;
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
        $this->authorize('view',Course::class);
        $courses = $this->repository->paginate();
        return view('Course::index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(UserRepository $userRepository, CategoryRepository $categoryRepository)
    {
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
        $request->request->add(['banner_id' => MediaUploadService::upload($request->file('banner'))->id]);
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
    public function update(CourseRequest $request, Course $course, CourseRepository $repository)
    {
        if ($request->hasFile('banner')) {
            $request->request->add(['banner_id' => MediaUploadService::upload($request->file('banner'))->id]);
            ImageUploadService::delete($course, $repository);
        } else {

            $request->request->add(['banner_id' => $course->banner_id]);
        }
        $repository->update($course, $request);
        return redirect(route('courses.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course, CourseRepository $repository)
    {
        ImageUploadService::delete($course, $repository);
        $course->delete();
        return back();
    }

    public function accept(Course $course, CourseRepository $repository)
    {
        if ($repository->updateConfirmationStatus($course, Course::CONFIRMATION_STATUS_ACCEPTED));
        return back()->with(AjaxResponse::SuccessResponse());

        return back()->with(AjaxResponse::FailResponse());
    }

    public function reject(Course $course, CourseRepository $repository)
    {
        if ($repository->updateConfirmationStatus($course, Course::CONFIRMATION_STATUS_REJECTED));
            return back()->with(AjaxResponse::SuccessResponse());

        return back()->with(AjaxResponse::FailResponse());
    }


    public function lock(Course $course, CourseRepository $repository)
    {
        if ($repository->updateStatus($course, Course::STATUS_LOCKED));
            return back()->with(AjaxResponse::SuccessResponse());

        return back()->with(AjaxResponse::FailResponse());
    }
}
