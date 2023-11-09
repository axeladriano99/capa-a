<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


use App\Models\{Component, Permission, User};

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
        Gate::define('has_permissions', function (User $user, $componentName, $permissionName) {
            $component = Component::where('name', $componentName)->where('Enabled','E')->first();
            $permission = Permission::where('name', $permissionName)->first();
            

            if (is_null($component) || is_null($permission)) {
                return false;
            }


            if (!is_null($user->role->permissions()->where('id',$permission->id)->wherePivot('component_id', $component->id)->first())) {
                return true;
            }
            return false;
        });
    }
}
