<?php

declare(strict_types=1);

namespace Yormy\BlamableLaravel;

use Illuminate\Support\ServiceProvider;

class BlamableServiceProvider extends ServiceProvider
{
    public const CONFIG_FILE = __DIR__.'/../config/blamable.php';

    public function boot(): void
    {
        $this->publish();
    }

    public function register(): void
    {
        // ...
        $this->mergeConfigFrom(self::CONFIG_FILE, 'blamable');
    }

    private function publish(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                self::CONFIG_FILE => config_path('blamable.php'),
            ], 'config');
        }
    }
}
