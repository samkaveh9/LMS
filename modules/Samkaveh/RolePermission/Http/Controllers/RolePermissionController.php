<?php

namespace Samkaveh\RolePermission\Http\Controllers;

use App\Http\Controllers\Controller;
use Samkaveh\RolePermission\Repository\RolePermissionRepository;
use Samkaveh\RolePermission\Http\Requests\RoleRequest;
use Samkaveh\RolePermission\Http\Requests\RoleUpdateRequest;
use Samkaveh\RolePermission\Models\RolePermission;
use Samkaveh\RolePermission\Repositories\PermissionRepository;
use Samkaveh\RolePermission\Repositories\RoleRepository;
use Samkaveh\RolePermission\Responses\AjaxResponse;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{

/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = RoleRepository::latest();
        $permissions = PermissionRepository::latest();
        return view('RolePermission::index',compact('roles','permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('RolePermission::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        RoleRepository::store($request);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $request
     * @return \Illuminate\Http\Response
     */
    public function show(RoleRequest $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RolePermission  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findById($id);
        $permissions = PermissionRepository::all();
        return view('RolePermission::edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\RoleRequest  $request
     * @param  \App\RolePermission  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        RoleRepository::update($request,$id);
        return redirect(route('role-permissions.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RolePermission  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RoleRepository::destory($id);
        return redirect(route('role-permissions.index'));
    }


}