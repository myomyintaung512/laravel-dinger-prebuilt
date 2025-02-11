<?php

namespace myomyintaung512\LaravelDingerPrebuilt;

use Illuminate\Support\ServiceProvider;

class DingerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/dinger.php' => config_path('dinger.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/dinger.php',
            'dinger'
        );

        $this->app->singleton('dinger', function ($app) {
            return new DingerPrebuilt(config('dinger'));
        });
    }
}
