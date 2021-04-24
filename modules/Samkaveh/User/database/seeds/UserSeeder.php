<?php

namespace Samkaveh\User\Database\Seeds;

use Illuminate\Database\Seeder;
use Samkaveh\User\Models\User;

class UserSeeder extends Seeder
{

    public function run()
    {
        foreach (User::$defualtUsers as $user) {
            User::firstOrCreate(
                [
                    'email' => $user['email']
                ],
                [

                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => bcrypt($user['password']),
                    'email_verified_at' => now(),

                ]
            )->assignRole($user['role']);
        }
    }
}
