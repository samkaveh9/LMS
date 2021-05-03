@extends('Dashboard::layouts.master')
@section('app')
    <p class="box__title">ایجاد جلسه</p>
    <div class="row no-gutters bg-white">
        <div class="col-12">
            <form action="{{ route('episodes.store', $course->slug) }}" method="POST" enctype="multipart/form-data" class="padding-30">
                @csrf

                <x-input type="text" name="title" placeholder="عنوان جلسه" />
                <x-input type="number" name="time" placeholder="مدت زمان جلسه" />
                <x-input type="number" name="number" placeholder="شماره جلسه" />

                <x-select name="season_id" id="season_id">
                <option value="">فصل مربوطه را انتخاب کنید</option>
                @foreach ($course->seasons as $season)
                <option value="{{ $season->id }}">{{ $season->title }}</option>
                @endforeach
                </x-select>

                <div class="w-50">
                    <p class="box__title">ایا این درس رایگان است ؟ </p>
                    <div class="notificationGroup">
                        <input id="lesson-upload-field-1" name="is_free" value="0" type="radio" checked/>
                        <label for="lesson-upload-field-1">خیر</label>
                    </div>
                    <div class="notificationGroup">
                        <input id="lesson-upload-field-2" name="is_free" value="1" type="radio" />
                        <label for="lesson-upload-field-2">بله</label>
                    </div>
                </div>


                <x-file-upload name="episode_file" placeholder="آپلود جلسه"></x-file-upload>

                <x-textarea name="body" placeholder="توضیحات دوره" class="text h"></x-textarea>
                <button class="btn btn-webamooz_net">آپلود درس</button>
                <a href="{{ route('courses.detail' ,$course->slug) }}" class="btn btn-github" style="float: left;color: white">انصراف</a>
            </form>
        </div>
    </div>
@endsection
@push('breadcrumb')
<li><a href="{{ route('courses.index') }}" title="دوره ها">دوره ها</a></li><li><a href="{{ route('courses.detail' ,$course->slug) }}" title="{{ $course->title }}">{{ $course->title }}</a></li><li><a href="#" title="ایجاد جلسه">ایجاد جلسه</a></li>
@endpush

