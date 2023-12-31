<?php

namespace Yormy\BlamableLaravel;

use Illuminate\Support\ServiceProvider;

class BlamableServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publish();
    }

    public function register()
    {
        // ...
        $this->mergeConfigFrom('blamable', 'blamable');
    }

    private function publish(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                'blamable' => config_path('blamable.php'),
            ], 'config');
        }
    }
}
