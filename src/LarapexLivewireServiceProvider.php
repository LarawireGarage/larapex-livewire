<?php

namespace LarawireGarage\LarapexLivewire;

use Livewire\Livewire;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use LarawireGarage\LarapexLivewire\console\commands\MakeLarapexChartCommand;

class LarapexLivewireServiceProvider extends ServiceProvider
//  implements DeferrableProvider
{

    public function register()
    {
        // for bind data to application
    }
    public function boot()
    {
        // add services to application
        // Larapex Livewire
        $this->mergeConfigFrom(__DIR__ . '/../configs/larapex-livewire.php', 'larapex-livewire');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'larapex-livewire');

        $this->registerBladeDirectives();

        if ($this->app->runningInConsole()) {
            $this->registerCommands();
            $this->publishResources();
        }
    }

    public function publishResources()
    {
        $this->publishes([__DIR__ . '/../resources/js/mix' => public_path('vendor/larapex-livewire')], 'larapex-livewire-assets'); // Publish assets
        $this->publishes([__DIR__ . '/../configs/larapex-livewire.php' => config_path('larapex-livewire.php')], 'larapex-livewire-configs'); // publish configs
    }
    public function registerBladeDirectives()
    {
        Blade::directive('larapexScripts', [LarapexBladeDirectives::class, 'larapexScripts']);
    }

    public function registerCommands()
    {
        $this->commands([
            MakeLarapexChartCommand::class
        ]);
    }
}
