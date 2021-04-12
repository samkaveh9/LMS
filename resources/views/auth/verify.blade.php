@extends('auth.master')
@section('content')

<form  method="POST" action="{{ route('verification.resend') }}" class="form">
    @csrf
    <a class="account-logo" href="{{ route('home') }}">
        <img src="/img/weblogo.png" alt="">
    </a>
    @if (session('resent'))
    <div class="alert alert-success" role="alert">
       لینک تایید ایمیل  به ایمیل شما ارسال شد
    </div>
    @endif
    <div class="form-content form-account">
        <p class="txt-l">
         قبل از اقدام لطفا ایمیل خود را جهت تایید لینک چک کنید.
        </p>

        <p class="txt-l">
            اگر لینکی برای شما ارسال نشد دوباره درخواست بدهید.
        </p>

        <br>
        <button type="submit" class="btn btn-recoverpass">درخواست مجدد</button>
    </div>
    <div class="form-footer">
        <a href="{{ route('home') }}" style="margin-right: 16px;">انصراف</a>
    </div>
</form>

@endsection

