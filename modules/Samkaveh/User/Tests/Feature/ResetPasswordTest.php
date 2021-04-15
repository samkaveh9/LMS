<?php

namespace Samkaveh\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{

    use RefreshDatabase, WithFaker;


    public function test_user_can_see_reset_password_form()
    {
         $this->get(route('password.request'))->assertOk();
    }


    public function test_user_can_see_verify_code_form_with_correct_email()
    {

        $this->call('get',route('password.sendVerifyCodeEmail'), ['email' => 'test@test.com'])
             ->assertOk();
    }

    public function test_user_cannot_see_verify_code_form_with_wrong_email()
    {

        $this->call('get',route('password.sendVerifyCodeEmail'), ['email' => 'test$test.com'])
             ->assertStatus(302);
    }

    public function test_user_banned_after_6_attempt_to_reset_password()
    {
        for ($i=0; $i < 5; $i++) { 
            $this->post(route('password.checkVerifyCode'), ['verify_code', 'email' => 'test@test.com'])->assertStatus(302);
        }
        $this->post(route('password.checkVerifyCode'), ['verify_code', 'email' => 'test@test.com'])->assertStatus(429);
    }


}
