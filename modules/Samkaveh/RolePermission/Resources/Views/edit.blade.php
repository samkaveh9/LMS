@extends('Dashboard::layouts.master')
@section('app')

<div class="row no-gutters  ">
    <div class="col-6 bg-white" style="display: block;margin: auto">
        <p class="box__title">ایجاد نقش کاربری</p>
        <form action="{{ route('role-permissions.update',$role->id) }}" method="post" class="padding-30">
            @csrf
            @method('PUT')
            <input type="text" name="name" class="text" value="{{ $role->name }}" placeholder="نام نقش کاربری" required >
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
    
            <p class="box__title margin-bottom-15">انتخاب مجوز ها</p>
    
            @foreach ($permissions as $permission)
            <label class="ui-checkbox" style="margin-top: 16px">
                <input type="checkbox" class="sub-checkbox" name="permissions[{{ $permission->name }}]" data-id="1" value="{{ $permission->name }}"
                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : ''  }}
                    >
                <span class="checkmark"></span>
                @lang($permission->name)
            </label>
            @endforeach
    
            <br>
            @error('permissions')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <br>
            <button class="btn btn-webamooz_net">بروزرسانی</button>
            <a href="{{ route('role-permissions.index') }}" class="btn btn-github" style="float: left;color: white">انصراف</a>
        </form>
    </div>
</div>
@endsection

@push('breadcrumb')
<li><a href="{{ route('role-permissions.index') }}" title="نقش های کاربری">نقش های کاربری</a></li> <li><a href="#" title="نقش کاربری ها">ویرایش نقش کاربری {{ $role->name }}</a></li>
@endpush

