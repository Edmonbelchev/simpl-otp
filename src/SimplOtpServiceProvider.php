<?php

namespace TechEd\SimplOtp;

use Illuminate\Support\ServiceProvider;
use TechEd\SimplOtp\Commands\RemoveOtps;

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
        $this->registerPublishing();

        $this->commands([
            RemoveOtps::class,
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

            // Register the email notification publishing
            $this->publishes([
                __DIR__.'/stubs/EmailOtpVerification.php.stub' => app_path('Notifications/EmailOtpVerification.php'),
            ], 'email');
        }
    }
}