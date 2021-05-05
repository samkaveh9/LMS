<?php

namespace Samkaveh\Front\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class FrontPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
