<?php

namespace Gamespecu\LaravelPayu;

use OpenPayU_Configuration;
use Illuminate\Support\ServiceProvider;

class LaravelPayuServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->configure();
         $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'gamespecu');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'gamespecu');
         $this->loadMigrationsFrom(__DIR__.'/../migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

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
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-payu.php', 'laravel-payu');

        // Register the service the package provides.
        $this->app->singleton('laravel-payu', function ($app) {
            return new LaravelPayu;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravel-payu'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/laravel-payu.php' => config_path('laravel-payu.php'),
        ], 'laravel-payu.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/gamespecu'),
        ], 'laravel-payu.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/gamespecu'),
        ], 'laravel-payu.views');*/

        // Publishing the translation files.
        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/gamespecu'),
        ], 'laravel-payu.lang');

        // Registering package commands.
        // $this->commands([]);
    }

    public function configure()
    {
        OpenPayU_Configuration::setEnvironment(config('laravel-payu.env'));
        OpenPayU_Configuration::setMerchantPosId(config('laravel-payu.pos_id'));
        OpenPayU_Configuration::setSignatureKey(config('laravel-payu.secondary_key'));
        OpenPayU_Configuration::setOauthClientSecret(config('laravel-payu.oauth_secret'));
    }
}
