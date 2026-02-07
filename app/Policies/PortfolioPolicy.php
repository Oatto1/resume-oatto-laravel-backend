<?php

namespace App\Policies;

use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PortfolioPolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Portfolio $portfolio)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->hasRole('super-admin');
    }

    public function update(User $user, Portfolio $portfolio)
    {
        return $user->hasRole('super-admin');
    }

    public function delete(User $user, Portfolio $portfolio)
    {
        return $user->hasRole('super-admin');
    }

    public function deleteAny(User $user)
    {
        return $user->hasRole('super-admin');
    }
}
