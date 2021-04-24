@extends('User::Front.auth.master')
@section('content')

<form action="{{ route('verification.verify') }}" class="form" method="post">
    @csrf
    <a class="account-logo" href="index.html">
        <img src="/img/weblogo.png" alt="">
    </a>
    <div class="card-header">
        <p class="activation-code-title">کد فرستاده شده به ایمیل  <span>{{  auth()->user()->email }}</span>
            را وارد کنید . ممکن است ایمیل به پوشه spam فرستاده شده باشد
             <p class="activation-code-title">
                اگر ایمیل شما درست نیست<a href="{{ route('users.updateProfile') }}">برای ویرایش اینجا کلیلک کنید</a>
            </p>
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
