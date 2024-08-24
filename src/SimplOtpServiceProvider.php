<?php

namespace TechEd\SimplOtp;

use Illuminate\Support\ServiceProvider;
use TechEd\SimplOtp\Commands\RemoveOtps;
use TechEd\SimplOtp\Commands\PublishFrontend;

class SimplOtpServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/simplotp.php',
            'simplotp'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'simplotp');
        $this->registerPublishing();
        $this->registerRoutes();

        $this->commands([
            RemoveOtps::class,
            PublishFrontend::class,
        ]);
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/config/simplotp.php' => config_path('simplotp.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/stubs/EmailOtpVerification.php.stub' => app_path('Notifications/EmailOtpVerification.php'),
            ], 'email');

            $this->publishes([
                __DIR__.'/resources/views' => resource_path('views/vendor/simplotp'),
            ], 'views');
        }
    }

    protected function registerRoutes()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
    }
}