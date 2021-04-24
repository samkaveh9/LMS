@extends('Dashboard::layouts.master')
@section('app')
<div class="main-content">
    <div class="user-info bg-white padding-30 font-size-13">
        <form action="{{ route('users.updateProfile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="profile__info border cursor-pointer text-center">
                <div class="avatar__img"><img src="/img/pro.jpg" class="avatar___img">
                    <input type="file" accept="image/*" class="hidden avatar-img__input">
                    <div class="v-dialog__container" style="display: block;"></div>
                    <div class="box__camera default__avatar"></div>
                </div>
                <span class="profile__name">کاربر : {{ auth()->user()->name }}</span>
            </div>
            <input name="name" class="text" placeholder="نام کاربری" value="{{ auth()->user()->name }}">
            <input name="email" class="text text-left" placeholder="ایمیل" value="{{ auth()->user()->email }}">
            <input name="mobile" class="text text-left" placeholder="شماره موبایل" value="{{ auth()->user()->mobile }}">
            <input name="card_number" class="text text-left" placeholder="شماره کارت بانکی" value="">
            <input name="shaba" class="text text-left" placeholder="شماره شبا بانکی" value="">
            <input name="username" class="text text-left" placeholder="نام کاربری و آدرس پروفایل" value="{{ auth()->user()->username }}">
            <input name="headline" class="text text-left" placeholder="عنوان" value="{{ auth()->user()->headline }}">
            <p class="input-help text-left margin-bottom-12" dir="ltr">
                https://webamooz.net/tutors/
                <a href="https//webamooz/tutors/Mohammadnikoo">MohammadNikoo</a>
            </p>
            <input name="password" class="text text-left" placeholder="رمز عبور">
            <p class="rules">رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای
                غیر الفبا مانند <strong>!@#$%^&*()</strong> باشد.</p>
            <br>

            @can(\Samkaveh\RolePermission\Models\Permission::PERMISSION_TEACH)
            <textarea name="bio" class="text" placeholder="درباره من مخصوص مدرسین">{{ auth()->user()->bio }}</textarea>                
            <br>
            <br>
            @endcan
           
            <button type="submit" class="btn btn-webamooz_net">ذخیره تغییرات</button>
        </form>
    </div>

</div>
@endsection