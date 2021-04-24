@extends('Dashboard::layouts.master')
@section('app')
<div class="tab__box">
        <div class="tab__items">
            <a class="tab__item is-active" href="courses.html">لیست دوره ها</a>
            <a class="tab__item" href="approved.html">دوره های تایید شده</a>
            <a class="tab__item" href="new-course.html">دوره های تایید نشده</a>
            <a class="tab__item" href="{{ route('courses.create') }}">ایجاد دوره جدید</a>
        </div>
    </div>
    <div class="bg-white padding-20">
        <div class="t-header-search">
            <form action="" onclick="event.preventDefault();">
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
              <td><a href="course-detail.html" class="color-2b4a83">مشاهده</a></td>
              <td><a href="course-transaction.html" class="color-2b4a83" >مشاهده</a></td>
              <td><a href="" class="color-2b4a83" >مشاهده (10 نظر)</a></td>
              <td>120</td>
              <td class="status">تایید شده</td>
              <td>{{ $course->percent }}%</td>
              <td class="confirmation_status">@lang($course->status)</td>
              <td>
                <form action="{{ route('courses.destroy', $course->slug) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <a href="" onclick="updateConfirmationStatus(event, '{{ route('courses.lock', $course->slug) }}',
                        'آیا از قفل کردن این آیتم اطمینان دارید؟' , 'قفل شده', 'status')"
                       class="item-lock mlg-15" title="قفل کردن"></a> <a href="" onclick="updateConfirmationStatus(event, '{{ route('courses.accept', $course->slug) }}',
                                'آیا از تایید این آیتم اطمینان دارید؟' , 'تایید شده')"
                               class="item-confirm mlg-15" title="تایید"></a>
                            <a href="" onclick="updateConfirmationStatus(event, '{{ route('courses.reject', $course->slug) }}',
                                'آیا از رد این آیتم اطمینان دارید؟' ,'رد شده')"
                               class="item-reject mlg-15" title="رد"></a>

                    <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                    <a href="{{ route('courses.edit', $course->slug) }}" class="item-edit mlg-15" title="ویرایش"></a>                    
                    <button type="submit" class="item-delete btn-link" title="حذف"></button>
                </form>
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
    <script>
  function updateConfirmationStatus(event, route, message, status, field = 'confirmation_status') {
    event.preventDefault();
    if(confirm(message)){
        $.post(route, { _method: "PATCH", _token: $('meta[name="_token"]').attr('content') })
            .done(function (response) {
                $(event.target).closest('tr').find('td.' + field).text(status);
                $.toast({
                    heading: 'عملیات موفق',
                    text: response.message,
                    showHideTransition: 'slide',
                    icon: 'success'
                })
            })
            .fail(function (response) {
                $.toast({
                    heading: 'عملیات ناموفق',
                    text: response.message,
                    showHideTransition: 'slide',
                    icon: 'error'
                })
            })
    }
}
}

</script>
@endpush

