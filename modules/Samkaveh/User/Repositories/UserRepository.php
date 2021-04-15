<?php

namespace  Samkaveh\User\Repositories;

use Samkaveh\User\Models\User;

class UserRepository 
{

    public function findByEmail($email)
    {
       return User::query()->where('email',$email)->first();
    }


}