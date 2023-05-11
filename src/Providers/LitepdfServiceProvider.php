<?php
namespace Azlanali076\Litepdf\Providers;

use Azlanali076\Litepdf\Litepdf;
use Illuminate\Support\ServiceProvider;

class LitepdfServiceProvider extends ServiceProvider {

    public function register(){
        $this->app->bind('litepdf', function($app) {
            return new Litepdf();
        });
        $this->mergeConfigFrom(__DIR__.'/../../config/litepdf.php','litepdf');
    }
    public function boot(){
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/litepdf.php' => config_path('litepdf.php'),
            ], 'config');
        }
    }

}