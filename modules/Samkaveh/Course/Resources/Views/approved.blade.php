@extends('Dashboard::layouts.master')
@section('app')
<div class="tab__box">
        <div class="tab__items">
            <a class="tab__item" href="{{ route('courses.index') }}">لیست دوره ها</a>
            <a class="tab__item is-active" href="{{ route('courses.approvedCourse') }}">دوره های تایید شده</a>
            <a class="tab__item" href="{{ route('courses.unapprovedCourse') }}">دوره های تایید نشده</a>
            <a class="tab__item" href="{{ route('courses.create') }}">ایجاد دوره جدید</a>
        </div>
    </div>
    <div class="bg-white padding-20">
        <div class="t-header-search">
            <form action="">
                <div class="t-header-searchbox font-size-13">
                    <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی دوره">
                    <div class="t-header-search-content ">
                        <input type="text"  class="text"  placeholder="نام دوره">
                        <input type="text"  class="text" placeholder="ردیف">
                        <input type="text"  class="text" placeholder="قیمت">
                        <input type="text"  class="text" placeholder="نام مدرس">
                        <input type="text"  class="text margin-bottom-20" placeholder="دسته بندی">
                        <btutton class="btn btn-webamooz_net">جستجو</btutton>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="table__box">
        <table class="table">

            <thead role="rowgroup">
            <tr role="row" class="title-row">
                <th>شناسه</th>
                <th>ردیف</th>
                <th>عنوان</th>
                <th>مدرس دوره</th>
                <th>قیمت</th>
                <th>جزئیات</th>
                <th>تراکنش ها</th>
                <th>نظرات</th>
                <th>تعداد دانشجویان</th>
                <th>وضعیت تایید</th>
                <th>درصد مدرس</th>
                <th>وضعیت دوره</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
                
         @foreach ($courses as $course)
            <tr role="row" >
              <td><a href="">{{ $course->priority }}</a></td>
              <td><img src="{{ $course->banner->thumb }}" width="80" height="80"></td>
              <td><a href="">{{ $course->title }}</a></td>
              <td><a href="">{{ $course->teacher->name }}</a></td>
              <td>{{ $course->price }}</td>
              <td><a href="{{ route('courses.detail',$course->id) }}" class="color-2b4a83">مشاهده</a></td>
              <td><a href="course-transaction.html" class="color-2b4a83" >مشاهده</a></td>
              <td><a href="" class="color-2b4a83" >مشاهده (10 نظر)</a></td>
              <td>120</td>
              <td class="status">@lang($course->status)</td>
              <td>{{ $course->percent }}%</td>
              <td class="confirmation_status">@lang($course->confirmation_status)</td>
              <td>
                    @can(Samkaveh\RolePermission\Models\Permission::PERMISSION_MANAGE_COURSES)                        
                        <a href="" onclick="updateConfirmationStatus(event, '{{ route('courses.lock', $course->slug) }}',
                            'آیا از قفل کردن این آیتم اطمینان دارید؟' , 'قفل شده', 'status')"
                            class="item-lock mlg-15" title="قفل کردن">
                        </a> 
                       
                       <a href="" onclick="updateConfirmationStatus(event, '{{ route('courses.accept', $course->slug) }}',
                            'آیا از تایید این آیتم اطمینان دارید؟' , 'تایید شده')"
                            class="item-confirm mlg-15" title="تایید">
                        </a>
                       
                        <a href="" onclick="updateConfirmationStatus(event, '{{ route('courses.reject', $course->slug) }}',
                            'آیا از رد این آیتم اطمینان دارید؟' ,'رد شده')"
                            class="item-reject mlg-15" title="رد">
                        </a>

                    <button type="submit" class="item-delete btn-link mlg-15" title="حذف"></button>
                    @endcan
                    <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                    <a href="{{ route('courses.edit', $course->slug) }}" class="item-edit" title="ویرایش"></a>                    
              </td>
            </tr>
            @endforeach

            </tbody>
        </table>
</div>
@endsection

@push('breadcrumb')
<li><a href="{{ route('courses.index') }}" title="دوره ها">دوره ها</a></li>
@endpush

@push('styles')
    <link rel="stylesheet" href="/css/jquery.toast.min.css">
@endpush

@push('scripts')
    <script src="/js/jquery.toast.min.js"></script>
@endpush

