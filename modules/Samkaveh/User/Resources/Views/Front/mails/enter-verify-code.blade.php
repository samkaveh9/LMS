@extends('User::Front.auth.master')
@section('content')

<form action="{{ route('password.checkVerifyCode') }}" class="form" method="post">
    @csrf

    <input type="hidden" name="email" value="{{ request()->email }}">

    <a class="account-logo" href="index.html">
        <img src="/img/weblogo.png" alt="">
    </a>
    <div class="card-header">
        <p class="activation-code-title">کد فرستاده شده به ایمیل  <span>{{ request()->email }}</span>
            را وارد کنید . ممکن است ایمیل به پوشه spam فرستاده شده باشد
        </p>
    </div>
    <div class="form-content form-content1">
        <input name="verify_code" class="activation-code-input" placeholder="فعال سازی" required autofocus>

        @error('verify_code')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        <br>
        <button class="btn i-t">تایید</button>
        <a href="#" onclick="
            event.preventDefault();
            document.getElementById('resend-code').submit()
        ">ارسال مجدد کد فعالسازی</a>

    </div>
    <div class="form-footer">
        <a href="{{ route('home') }}">برگشت به صفحه اصلی</a>
    </div>
</form>

<form action="{{ route('verification.resend') }}" method="post" id="resend-code">@csrf</form>

@endsection

@push('scripts')
<script src="/js/jquery-3.4.1.min.js"></script>
<script src="/js/activation-code.js"></script>
@endpush
