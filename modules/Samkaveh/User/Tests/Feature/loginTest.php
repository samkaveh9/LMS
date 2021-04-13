<?php

namespace Samkaveh\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Samkaveh\User\Models\User;
use Tests\TestCase;

class loginTest extends TestCase
{

    use RefreshDatabase, WithFaker;


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_login_with_email()
    {

        $user = User::create([

            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'password' => bcrypt('Password@1')
        ]);

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'Password@1'
        ]);

        $this->assertAuthenticated();
    }


    public function test_user_can_login_with_mobile()
    {

        $user = User::create([

            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'mobile' => '9301111111',
            'password' => bcrypt('Password@1')

        ]);

        $this->post(route('login'), [
            'email' => $user->mobile,
            'password' => 'Password@1'
        ]);

        $this->assertAuthenticated();
    }
}
