<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Partner;
use App\Models\User;
use App\Policies\ArticlePolicy;
use App\Policies\PartnerPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class    => UserPolicy::class,
        Article::class => ArticlePolicy::class,
        Partner::class => PartnerPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
