@extends('auth.master')
@section('content')

<form action="{{ route('password.email') }}" class="form" method="POST">
    @csrf
    <a class="account-logo" href="{{ route('home') }}">
        <img src="/img/weblogo.png" alt="">
    </a>
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <div class="form-content form-account">
        <input type="email" class="txt-l txt @error('email') is-invalid @enderror" name="email" placeholder="ایمیل" value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <br>
        <button type="submit" class="btn btn-recoverpass">بازیابی</button>
    </div>
    <div class="form-footer">
        <a href="{{ route('login') }}">صفحه ورود</a>
        <a href="{{ route('home') }}" style="margin-right: 16px;">انصراف</a>
    </div>
</form>

@endsection

