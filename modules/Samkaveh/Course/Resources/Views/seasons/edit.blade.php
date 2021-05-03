@extends('Dashboard::layouts.master')
@section('app')
    <p class="box__title">ویرایش سر فصل {{ $season->title }}</p>
    <div class="row no-gutters bg-white">
        <div class="col-12">
            <form action="{{ route('seasons.update', $season->id) }}" method="POST" class="padding-30">
                @csrf
                @method('PUT')
                <x-input type="text" name="title"  placeholder="عنوان سرفصل" class="text" value="{{ $season->title }}" />
                <x-input type="text" name="number"  placeholder="شماره سرفصل" class="text" value="{{ $season->number }}" />

                    <button type="submit" class="btn btn-webamooz_net mt-2">ویرایش سر فصل</button>
                <a href="{{ route('courses.detail',$course->slug) }}" class="btn btn-github" style="float: left;color: white">انصراف</a>
            </form>
        </div>
    </div>
@endsection
@push('breadcrumb')
<li><a href="{{ route('courses.index') }}" title="دوره ها">دوره ها</a></li><li><a href="{{ route('courses.detail' ,$course->slug) }}" title="{{ $course->title }}">{{ $course->title }}</a></li><li><a href="#" title="سر فصل ها">سر فصل ها</a></li><li><a href="#" title="ویرایش سر فصل">ویرایش سر فصل  {{ $season->title }}</a></li>

@endpush

@push('scripts')
<script src="/panel/js/tagsInput.js"></script>
@endpush
