@component('mail::message')
# کد فعالسازی حساب شما در وبسایت ما
کد فعالسازی به ایمیل شما ارسال شده **درصورتی که این درخواست توسط شما صورت نگرفته است این ایمیل را نادیده بگیرید**

@component('mail::panel')

کد فعالسازی: **{{$code}}**


@endcomponent

با تشکر<br>
{{ config('app.name') }}
@endcomponent
