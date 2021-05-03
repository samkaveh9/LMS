@extends('Dashboard::layouts.master')
@section('app')
<div class="row no-gutters  ">
    <div class="col-12 margin-bottom-15 border-radius-3">
        <p class="box__title">کاربران</p>
        <div class="table__box">
            <table class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">                   
                    <th>شناسه</th>
                    <th>نام و نام خانوادگی</th>
                    <th>ایمیل</th>
                    <th>شماره موبایل</th>
                    <th>سطح کاربری</th>
                    <th>تاریخ عضویت</th>
                    <th>ای پی</th>
                    <th>درحال یادگیری</th>
                    <th>وضعیت حساب</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr role="row" class="">
                        <td>{{  $user->id }}</td>
                        <td><a href="">{{  $user->name }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->mobile }}</td>
                        <td>
                            <ul>
                                @foreach ($user->roles as $role)
                                <li class="removeRole">
                                   @lang($role->name)
                                </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ \Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($user->created_at)) }}</td>
                        <td>{{ $user->ip }}</td>
                        <td>5 دوره</td>
                        <td class="confirmation_status">{{  $user->hasVerifiedEmail() ? 'تایید شده' : 'تایید نشده' }}</td>
                        
                         <td>    
                                <a href="#open-modal" onclick="setFormAction({{ $user->id }})" class="item-edit mlg-15" title="انتصاب نقش کاربری"></a>
                                <a href="" onclick="updateConfirmationStatus(event,'{{ route('users.manualVerify', $user->id) }}', 'آیا از تایید این آیتم اطمینان دارید', 'تایید شده')" class="item-confirm mlg-15" title="تایید"></a>
                                <a href="" onclick="deleteItem(event,'{{ route('users.destroy',$user->id) }}')" class="item-delete" title="حذف"></a>                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="open-modal" class="modal-window">
    <div>
      <a href="#" title="Close" class="modal-close"><b style="font-size: 1.6em">×</b></a>
        <div><small style="visibility: hidden">Check out</small></div>
    
       <form action="{{ route('users.addRole', 0) }}" method="post" id="add-role">
        @csrf
        <select name="role" id="">
            <option value="">نقش کاربری را برای کاربر مورد نظر انتخاب کنید</option>
            @foreach($roles as $role)
                <option value="{{ $role->name }}">@lang($role->name)</option>
            @endforeach
        </select>
       <button type="submit" class="btn btn-webamooz_net">افزودن</button>
       </form>
    
    </div>
  </div>
@endsection

@push('breadcrumb')
<li><a href="{{ route('users.index') }}" title="کاربران">کاربران</a></li>
@endpush

@push('styles')
    <link rel="stylesheet" href="/css/jquery.toast.min.css">
@endpush

@push('scripts')
<script src="/js/jquery.toast.min.js"></script>
<script>

    function setFormAction(userId) {
        $("#add-role").attr('action', '{{ route('users.addRole', 0) }}'.replace('/0/', '/' + userId + '/' ))
    }

</script>


@endpush

@push('styles')
    <style>
    .modal-window {
	position: fixed;
	background-color: rgba(61, 62, 59, 0.3);
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	z-index: 999;
	visibility: hidden;
	opacity: 0;
	pointer-events: none;
	transition: all 0.3s;
}

.modal-window:target {
	visibility: visible;
	opacity: 1;
	pointer-events: auto;
}

.modal-window > div {
	width: 400px;
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	padding: 2em;
	background: rgb(239, 241, 244);
}

.modal-window header {
	font-weight: bold;
}

.modal-window h1 {
	font-size: 150%;
	margin: 0 0 15px;
}

.modal-close {
	color: #aaa;
	line-height: 50px;
	font-size: 80%;
	position: absolute;
	right: 0;
	text-align: center;
	top: 0;
	width: 70px;
	text-decoration: none;
}


.modal-close:hover {
	color: black;
}

/* Demo Styles */

a {
	color: inherit;
}

.container {
	display: grid;
	justify-content: center;
	align-items: center;
	height: 100vh;
}

.modal-window > div {
	border-radius: 1rem;
}

.modal-window div:not(:last-of-type) {
	margin-bottom: 15px;
}

small {
	color: lightgray;
}

.btn {
	background-color: white;
	padding: 1em 1.5em;
	border-radius: 1rem;
	text-decoration: none;
}

.btn i {
	padding-right: 0.3em;
}
    </style>
@endpush

