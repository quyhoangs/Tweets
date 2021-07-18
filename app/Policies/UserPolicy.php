<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;

class UserPolicy
{
    use HandlesAuthorization;

   public function edit(user $currentUser,user $user)
   {
     return $currentUser->is($user);
   }
}
