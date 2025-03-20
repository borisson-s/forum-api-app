<?php

namespace App\Policies;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ThreadPolicy
{

    public function modify(User $user, Thread $thread): Response
    {
        return $user->id === $thread->user_id
            ? Response::allow()
            : Response::deny('You are not the owner of this thread.');
    }


}
