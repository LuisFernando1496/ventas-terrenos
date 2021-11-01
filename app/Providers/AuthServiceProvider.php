<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('justFor', function(User $user, array $slugs) {
            $canAccess = false;
            // $slugs = [$one, $two, $tree];
            foreach ($slugs as $slug) {
                if($user->findRole($slug)){
                    $canAccess = true;
                }
            };
            return $canAccess
            ? Response::allow()
            : Response::deny('Esta vista no le es permitida');
        });
  
    }
}
