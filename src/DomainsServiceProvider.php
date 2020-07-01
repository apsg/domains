<?php

namespace Apsg\Domains;

use Apsg\Domains\Commands\SetupDomainsCommand;
use Illuminate\Support\ServiceProvider;

class DomainsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'apsg');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'apsg');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
//        $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/domains.php', 'domains');

        // Register the service the package provides.
        $this->app->singleton('domains', function ($app) {
            return new Domains;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['domains'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/domains.php' => config_path('domains.php'),
        ], 'domains.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/apsg'),
        ], 'domains.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/apsg'),
        ], 'domains.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/apsg'),
        ], 'domains.views');*/

        // Registering package commands.
        $this->commands([
            SetupDomainsCommand::class,
        ]);
    }
}
