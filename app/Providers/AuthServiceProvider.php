<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Policy;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        $policies = Policy::groupBy('name')->pluck('name')->all();

        foreach ($policies as $policy) {
            Gate::define($policy, function (User $user) use ($policy) {
                return $user->hasPermission($policy);
            });
        }
    }
}
