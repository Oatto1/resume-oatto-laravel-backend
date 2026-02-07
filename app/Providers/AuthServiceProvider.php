<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Models\Portfolio;
use App\Models\Skill;
use App\Models\AboutMe;

use App\Policies\PortfolioPolicy;
use App\Policies\SkillPolicy;
use App\Policies\AboutMePolicy;
class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
   Portfolio::class => PortfolioPolicy::class,
    Skill::class => SkillPolicy::class,
    AboutMe::class => AboutMePolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
