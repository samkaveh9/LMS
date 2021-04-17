@extends('Dashboard::layouts.master')
@section('app')
<div class="row no-gutters  ">
    <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
        <p class="box__title">دسته بندی ها</p>
        <div class="table__box">
            <table class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>نام دسته بندی</th>
                    <th>دسته اصلی</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr role="row" class="">
                        <td>{{  $category->id }}</td>
                        <td><a href="">{{  $category->title }}</a></td>
                        <td>{{  $category->ParentName }}</td>
                        <td>
                                <a href="{{ route('categories.edit',$category->slug) }}" class="item-edit mlg-15" title="ویرایش"></a>
                                <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                                <a href="" onclick="event.preventDefault(); deleteItem(event,'{{ route('categories.destroy',$category->slug) }}')" class="item-delete" title="حذف"></a>                            

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
        @include('Category::create')
</div>
@endsection

@push('breadcrumb')
<li><a href="{{ route('categories.index') }}" title="دسته بندی ها">دسته بندی ها</a></li>
@endpush

@push('styles')
    <link rel="stylesheet" href="/css/jquery.toast.min.css">
@endpush

@push('scripts')

<script src="/js/jquery.toast.min.js"></script>

<script>

function deleteItem(event, route){

    if(confirm('آیا از حذف این آیتم اطمینان دارید؟'))
    {
        $.post(route, { _method: "delete", _token: "{{ csrf_token() }}"})
        
        .done(function (response) {
                event.target.closest('tr').remove();
                $.toast({
                    heading: 'عملیات موفق',
                    text: response.message,
                    showHideTransition: 'slide',
                    icon: 'success'
                })
            })

        .fail()
    }
}


</script>


@endpush

