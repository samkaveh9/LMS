<?php

namespace Samkaveh\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Samkaveh\Category\Repository\CategoryRepository;
use Samkaveh\Category\Http\Requests\CategoryRequest;
use Samkaveh\Category\Models\Category;
use Samkaveh\Category\Responses\AjaxResponse;

class CategoryController extends Controller
{

    private $repository;


    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->repository = $categoryRepository;
    }


/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->repository->latest();
        return view('Category::index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Category::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $this->repository->store($request);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('Category::edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\CategoryRequest  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $this->repository->update($category ,$request);
        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->repository->destory($category);
        AjaxResponse::SuccessResponse();
    }


}