<?php

namespace NhamHV\Permission;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/database/migrations/' => database_path('/migrations'),
        ], 'migrations');

        $this->publishes([
            __DIR__ . '/config/permissions.php' => config_path('permissions.php'),
        ], 'config');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('NhamHVPermission', function () {
            return new Permission;
        });
        $this->app->singleton('NhamHV\Permission\PermissionInterface', 'NhamHV\Permission\Permission');

        $this->mergeConfigFrom(__DIR__ . '/config/permissions.php', 'permissions');

    }

}
