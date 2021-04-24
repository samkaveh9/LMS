@extends('Dashboard::layouts.master')
@section('app')
<div class="row no-gutters  ">
    <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
        <p class="box__title">نقش های کاربری</p>
        <div class="table__box">
            <table class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>نام نقش</th>
                    <th>مجوزها</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                    <tr role="row" class="">
                        <td>{{  $role->id }}</td>
                        <td><a href="">{{  $role->name }}</a></td>
                        <td>
                            <ul>
                                @foreach ($role->permissions as $permission)
                                    <li>@lang($permission->name)</li>
                                @endforeach 
                            </ul>   
                        </td>
                        <td>
                            <form action="{{ route('role-permissions.destroy',$role->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('role-permissions.edit',$role->id) }}" class="item-edit mlg-15" title="ویرایش"></a>
                                <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                                <button type="submit" class="item-delete btn-link" title="حذف"></button>                            
                            </form>                                
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
        @include('RolePermission::create')
</div>
@endsection

@push('breadcrumb')
<li><a href="{{ route('role-permissions.index') }}" title="نقش های کاربری">نقش های کاربری</a></li>
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

