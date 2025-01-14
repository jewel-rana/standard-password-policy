<?php

namespace JewelRana\PasswordPolicy\Providers;

use Illuminate\Support\ServiceProvider;
use JewelRana\PasswordPolicy\Observers\UserModelObserver;

class PasswordPolicyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/routes.php');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'password-policy');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->publishes([
            __DIR__.'/../../config/password-policy.php' =>  config_path('password-policy.php'),
        ], 'config');
        
        // Publish views to the application's views directory
        $this->publishes([
            __DIR__ . '/../../resources/views' => resource_path('views/vendor/password-policy'),
        ], 'views');
        if(class_exists('App\\Models\\User')) {
            \App\Models\User::observe(UserModelObserver::class);
        }
    }
}

