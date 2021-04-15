<?php

namespace Samkaveh\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Samkaveh\User\Models\User;
use Samkaveh\User\Services\VerifyCodeService;
use Tests\TestCase;

class registrationTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_see_registration_form()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }


    public function test_user_can_register()
    {
        $this->withExceptionHandling();

       $response = $this->createNewUser();
       
        $response->assertRedirect(route('verification.notice'));

        $this->assertCount(1, User::all());
    }

    public function test_user_has_verify_email()
    {
       $this->createNewUser();
        $response = $this->get(route('home'));
        $response->assertRedirect(route('verification.notice'));
    }

    public function test_user_can_verify_account()
    {
        $user = User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'mobile' => '9232224343',
            'password' => 'Password@1',
            'password_confirmation' => 'Password@1',
        ]);

        $code = VerifyCodeService::generate();
        VerifyCodeService::store($user->id,$code,now()->addMinutes(15));
        
        auth()->loginUsingId($user->id);

        $this->assertAuthenticated();
        
        $this->post(route('verification.verify'),[
            'verify_code' => $code
        ]);

        $this->assertEquals(true,$user->fresh()->hasVerifiedEmail());
    }





    public function test_user_can_show_home_page_after_email_verified()
    {

       $this->createNewUser();


        $this->assertAuthenticated();

        auth()->user()->markEmailAsVerified();

        $response = $this->get(route('home'));

        $response->assertOk();
    }


    public function createNewUser()
    {
       return $this->post(route('register'), [

            'name' => 'test',
            'email' => 'test@test.com',
            'mobile' => '9232224343',
            'password' => 'Password@1',
            'password_confirmation' => 'Password@1',
        ]);
    }






}
