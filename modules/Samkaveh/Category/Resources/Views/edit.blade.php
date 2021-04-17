@extends('Dashboard::layouts.master')
@section('app')

<div class="row no-gutters  ">
    <div class="col-6 bg-white" style="display: block;margin: auto">
        <p class="box__title">ایجاد دسته بندی جدید</p>
        <form action="{{ route('categories.update',$category->slug) }}" method="post" class="padding-30">
            @csrf
            @method('PUT')
            <input type="text" name="title" class="text" value="{{ $category->title }}" placeholder="نام دسته بندی" required >
            <p class="box__title margin-bottom-15">انتخاب دسته</p>
            <select name="parent_id" id="parent_id">
                <option value="">بدون دسته اصلی</option>
                @foreach (\Samkaveh\Category\Models\Category::orderBy('id','asc')->where('parent_id',null)->get() as $categoryItem)
                <option value="{{ $categoryItem->id }}" {{ $categoryItem->id == $category->parent_id ? 'selected' : '' }}>{{ $categoryItem->title }}</option>
                @endforeach
            </select>
            <button class="btn btn-webamooz_net">بروزرسانی</button>
            <a href="{{ route('categories.index') }}" class="btn btn-github" style="float: left;color: white">انصراف</a>
        </form>
    </div>
</div>
@endsection

@push('breadcrumb')
<li><a href="#" title="دسته بندی ها">ویرایش دسته بندی {{ $category->title }}</a></li>
@endpush

