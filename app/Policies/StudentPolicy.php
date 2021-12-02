<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return $user->role === User::ADMIN_ROLE || $user->role === User::TEACHER_ROLE;
    }

    public function create(User $user)
    {
        return $user->role === User::ADMIN_ROLE;
    }
}
