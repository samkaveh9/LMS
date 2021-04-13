@extends('User::Front.auth.master')

@section('content')
<form action="{{ route('register') }}" class="form" method="POST">
    @csrf
    <a class="account-logo" href="index.html">
        <img src="img/weblogo.png" alt="">
    </a>
    <div class="form-content form-account">

        <input type="text" name="name" class="txt @error('name') is-invalid @enderror"
         placeholder="نام و نام خانوادگی"  value="{{ old('name') }}" required autocomplete="name" autofocus>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror        
        
        <input type="email" name="email" class="txt txt-l @error('email') is-invalid @enderror" 
        placeholder="ایمیل" value="{{ old('email') }}" required autocomplete="email">
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        <input type="text" name="mobile" class="txt txt-l @error('mobile') is-invalid @enderror"
        placeholder="شماره موبایل (بدون صفر)"  autocomplete="mobile">
        @error('mobile')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        
        <input type="password" name="password" class="txt txt-l @error('password') is-invalid @enderror"
         placeholder="رمز عبور"  required autocomplete="new-password">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        <input id="password-confirm" type="password" class="txt txt-l" name="password_confirmation"
         placeholder="تایید رمز عبور" required autocomplete="new-password">

        <span class="rules">رمز عبور باید حداقل ۸ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای غیر الفبا مانند !@#$%^&*() باشد.</span>
        
        <br>
        <button class="btn continue-btn">ثبت نام و ادامه</button>

    </div>
    <div class="form-footer">
        <a href="{{ route('login') }}">صفحه ورود</a>
        <a href="{{ route('home') }}" style="margin-right: 16px;">انصراف</a>
    </div>
</form>
@endsection
