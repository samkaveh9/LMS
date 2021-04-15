<?php

namespace Samkaveh\User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Samkaveh\User\Http\Requests\ResetPasswordVerifyCodeRequest;
use Samkaveh\User\Http\Requests\SendResetPasswordVerifyCodeRequest;
use Samkaveh\User\Models\User;
use Samkaveh\User\Repositories\UserRepository;
use Samkaveh\User\Services\VerifyCodeService;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;


    public function showVerifyCodeRequestForm()
    {
        return view('User::Front.auth.passwords.email');
    }


    public function sendVerifyCodeEmail(SendResetPasswordVerifyCodeRequest $request)
    {
        $user = resolve(UserRepository::class)->findByEmail($request->email);

        if ($user && !VerifyCodeService::has($user->id)) {
            $user->sendResetPasswordRequestNotification();
        }

        return view('User::Front.mails.enter-verify-code');
    }

    public function checkVerifyCode(ResetPasswordVerifyCodeRequest $request)
    {
        $user = resolve(UserRepository::class)->findByEmail($request->email);

        if (!VerifyCodeService::check($user->id, $request->verify_code)) {
            return back()->withErrors(['verify_code' => 'کد معتبر نیست دوباره تلاش کنید']);
        }
        auth()->loginUsingId($user->id);
        return redirect(route('password.showResetForm'));
    }
}
