<?php

namespace Slexx\AssetsManager\Laravel;

use Slexx\AssetsManager\Manager;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AssetsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('assets', function() {
            return Manager::getInstance();
        });
    }

    public function boot()
    {
        Blade::directive('script', function($expression) {
            return "<?php \Slexx\AssetsManager\Laravel\BladeDirectives::script($expression); ?>";
        });
        Blade::directive('endscript', function() {
            return "<?php \Slexx\AssetsManager\Laravel\BladeDirectives::endScript(); ?>";
        });
        Blade::directive('style', function($expression) {
            return "<?php \Slexx\AssetsManager\Laravel\BladeDirectives::style($expression); ?>";
        });
        Blade::directive('endstyle', function() {
            return "<?php \Slexx\AssetsManager\Laravel\BladeDirectives::endStyle(); ?>";
        });
        Blade::directive('assets', function() {
            return "<?php \Slexx\AssetsManager\Laravel\BladeDirectives::assets(); ?>";
        });
    }
}
