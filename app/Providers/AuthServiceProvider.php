<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
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

        Gate::define('category-list', function (User $user) {
           return $user->checkPermission('list_category');
        });

        Gate::define('category-create', function (User $user) {
            return $user->checkPermission('create_category');
         });

         Gate::define('category-edit', function (User $user) {
            return $user->checkPermission('edit_category');
         });

         Gate::define('category-delete', function (User $user) {
            return $user->checkPermission('delete_category');
         });

         Gate::define('product-list', function (User $user) {
            return $user->checkPermission('list_product');
         });

         Gate::define('product-create', function (User $user) {
            return $user->checkPermission('create_product');
         });
         Gate::define('product-edit', function (User $user) {
            return $user->checkPermission('edit_product');
         });
         Gate::define('product-delete', function (User $user) {
            return $user->checkPermission('delete_product');
         });
         Gate::define('user-list', function (User $user) {
            return $user->checkPermission('list_user');
         });
         Gate::define('user-create', function (User $user) {
            return $user->checkPermission('create_user');
         });
         Gate::define('user-edit', function (User $user) {
            return $user->checkPermission('edit_user');
         });
         Gate::define('user-delete', function (User $user) {
            return $user->checkPermission('delete_user');
         });
         Gate::define('roles-list', function (User $user) {
            return $user->checkPermission('list_role');
         });
         Gate::define('roles-create', function (User $user) {
            return $user->checkPermission('create_role');
         });
         Gate::define('roles-edit', function (User $user) {
            return $user->checkPermission('edit_role');
         });
         Gate::define('order-list', function (User $user) {
            return $user->checkPermission('list_order');
         });
         Gate::define('update-order', function (User $user) {
            return $user->checkPermission('update_status');
         });
         Gate::define('delete_order', function (User $user) {
            return $user->checkPermission('delete_order');
         });

         Gate::define('is-admin', function (User $user) {
            return $user->checkAdmin(1||2);
         });

    }
}
