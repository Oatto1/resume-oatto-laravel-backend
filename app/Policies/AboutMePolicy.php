<?php

namespace App\Policies;

use App\Models\AboutMe;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AboutMePolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, AboutMe $aboutme)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->hasRole('super-admin');
    }

    public function update(User $user, AboutMe $aboutme)
    {
        return $user->hasRole('super-admin');
    }

    public function delete(User $user, AboutMe $aboutme)
    {
        return $user->hasRole('super-admin');
    }

    public function deleteAny(User $user)
    {
        return $user->hasRole('super-admin');
    }
}
