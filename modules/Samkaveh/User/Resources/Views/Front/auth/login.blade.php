@extends('User::Front.auth.master')
@section('content')

<form action="{{ route('login') }}" class="form" method="POST">
    @csrf
    <a class="account-logo" href="index.html">
        <img src="img/weblogo.png" alt="">
    </a>
    <div class="form-content form-account">
        
        <input type="text" name="email" class="txt txt-l @error('email') is-invalid @enderror" 
        placeholder="ایمیل یا شماره موبایل" value="{{ old('email') }}" required autocomplete="email">
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        <input type="password" name="password" class="txt txt-l @error('password') is-invalid @enderror"
        placeholder="رمز عبور"  required autocomplete="current-password">
       @error('password')
       <span class="invalid-feedback" role="alert">
           <strong>{{ $message }}</strong>
       </span>
       @enderror

        <br>
        <button class="btn btn--login">ورود</button>
        <label class="ui-checkbox">
            مرا بخاطر داشته باش
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <span class="checkmark"></span>
        </label>
        <div class="recover-password">
            <a href="{{ route('password.request') }}">بازیابی رمز عبور</a>
        </div>
    </div>
    <div class="form-footer">
        <a href="{{ route('register') }}">صفحه ثبت نام</a>
        <a href="{{ route('home') }}" style="margin-right: 16px;">انصراف</a>
    </div>
</form>

@endsection
