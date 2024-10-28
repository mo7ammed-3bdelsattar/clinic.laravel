<?php

namespace App\Providers;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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

        Gate::define('admin', function() {
            $admin = auth('admin')->user();
            return $admin->type == 'admin';
        });
        Gate::define('doctor', function () {
            $admin = auth('admin')->user();
            return $admin->type == 'doctor';
        });
        Gate::define('manager', function () {
            $admin = auth('admin')->user();
            return $admin->type == 'manager';
        });
        Gate::define('patient', function (User $user) {
            return !empty($user);
        });
    }
}
