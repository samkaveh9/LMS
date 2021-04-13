@extends('User::Front.auth.master')

@section('content')
<form action="{{ route('password.update') }}" class="form" method="POST">
    @csrf
        <a class="account-logo" href="index.html">
        <img src="/img/weblogo.png" alt="">
    </a>
    <div class="form-content form-account">     
    
        <input type="hidden" name="token" value="{{ $token }}">
        
        <input type="email" name="email" class="txt txt-l @error('email') is-invalid @enderror" 
        placeholder="ایمیل" value="{{ $email ?? old('email') }}" required autocomplete="email">

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        
        <input type="password" name="password" class="txt txt-l @error('password') is-invalid @enderror"
         placeholder="رمز عبور جدید"  required autocomplete="new-password">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        <input id="password-confirm" type="password" class="txt txt-l" name="password_confirmation"
         placeholder="تایید رمز عبور جدید " required autocomplete="new-password">

        <span class="rules">رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای غیر الفبا مانند !@#$%^&*() باشد.</span>
        
        <br>
        <button class="btn continue-btn">بروزرسانی رمز عبور</button>

    </div>
</form>
@endsection
