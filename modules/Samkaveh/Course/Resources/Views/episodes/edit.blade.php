@extends('Dashboard::layouts.master')
@section('app')
    <p class="box__title">ویرایش جلسه {{ $episode->title }}</p>
    <div class="row no-gutters bg-white">
        <div class="col-12">
            <form action="{{ route('episodes.update' ,[$course->slug ,$episode->slug] ) }}" method="POST" enctype="multipart/form-data" class="padding-30">
                @csrf
                @method('PUT')
                <x-input type="text"  name="title" placeholder="عنوان جلسه"  value="{{ $episode->title }}" />
                <x-input type="number"  name="time" placeholder="مدت زمان جلسه"  value="{{ $episode->time }}" />
                <x-input type="number"  name="number" placeholder="شماره جلسه"  value="{{ $episode->number }}" />

                <x-select name="season_id" id="season_id">
                <option value="">فصل مربوطه را انتخاب کنید</option>
                @foreach ($course->seasons as $season)
                <option value="{{ $season->id }}" {{ $season->id == $episode->season_id ? 'selected' : '' }} >{{ $season->title }}</option>
                @endforeach
                </x-select>

                <div class="w-50">
                    <p class="box__title">ایا این درس رایگان است ؟ </p>
                    <div class="notificationGroup">
                        <input id="lesson-upload-field-1" name="is_free" value="0" type="radio" {{ $episode->is_free == 0 ? 'checked' : '' }} />
                        <label for="lesson-upload-field-1">خیر</label>
                    </div>
                    <div class="notificationGroup">
                        <input id="lesson-upload-field-2" name="is_free" value="1" type="radio" {{ $episode->is_free == 1 ? 'checked' : '' }} />
                        <label for="lesson-upload-field-2">بله</label>
                    </div>
                </div>


                <x-file-upload name="episode_file" placeholder="آپلود جلسه"></x-file-upload>

                <x-textarea name="body" placeholder="توضیحات دوره" class="text h">{{ $episode->body }}</x-textarea>
                <button class="btn btn-webamooz_net">آپلود درس</button>
                <a href="{{ route('courses.detail' ,$course->slug) }}" class="btn btn-github" style="float: left;color: white">انصراف</a>
            </form>
        </div>
    </div>
@endsection
@push('breadcrumb')
<li><a href="{{ route('courses.index') }}" title="دوره ها">دوره ها</a></li><li><a href="{{ route('courses.detail' ,$course->slug) }}" title="{{ $course->title }}">{{ $course->title }}</a></li><li><a href="#" title="ویرایش جلسه">ویرایش جلسه</a></li>
@endpush

