<?php   

namespace Samkaveh\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Samkaveh\Common\Responses\AjaxResponse;
use Samkaveh\Media\Services\MediaUploadService;
use Samkaveh\RolePermission\Repositories\RoleRepository;
use Samkaveh\User\Models\User;
use Samkaveh\User\Repositories\UserRepository;

class UserController extends Controller
{

    public $repository;


    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RoleRepository $roleRepository)
    {
        $this->authorize('manageRole',User::class);
        $users = $this->repository->paginate();
        $roles = $roleRepository->all();
        return view('User::users.index', compact('users','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function addRole(Request $request, User $user)
    {
        $this->authorize('manageRole',User::class);

        $this->validate($request,[
            'role' => 'required|exists:roles,name'
        ]);

        $user->assignRole($request->role);
        return back();
    }


    public function removeRole($userId, $role)
    {
        $this->authorize('manageRole',User::class);
        $user = $this->repository->findById($userId);
        $user->removeRole($role);
        return AjaxResponse::SuccessResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('manageRole',User::class);
        $user = $this->repository->findById($id);
        $user->delete();
        return AjaxResponse::SuccessResponse();
    }


    public function manualVerify($id)
    {
        $this->authorize('manageRole',User::class);
        $user = $this->repository->findById($id);
        $user->markEmailAsVerified();
        return AjaxResponse::SuccessResponse();
    }

    public function profilePhoto(Request $request)
    {
        $media = MediaUploadService::upload($request->file('photo'));
        if(auth()->user()->image) auth()->user()->image->delete();
        auth()->user()->image_id = $media->id;
        auth()->user()->save();
        return back();
    }

    public function profile()
    {
        return view('User::layouts.profile');
    }

    public function updateProfile(Request $request)
    {
        $this->repository->updateProfile($request);
        // newFeedback();
        return back();

    }


}
