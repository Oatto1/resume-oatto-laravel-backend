<?php

namespace App\Policies;

use App\Models\Skill;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SkillPolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Skill $skill)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->hasRole('super-admin');
    }

    public function update(User $user, Skill $skill)
    {
        return $user->hasRole('super-admin');
    }

    public function delete(User $user, Skill $skill)
    {
        return $user->hasRole('super-admin');
    }

    public function deleteAny(User $user)
    {
        return $user->hasRole('super-admin');
    }
}
