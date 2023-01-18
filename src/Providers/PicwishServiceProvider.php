<?php
namespace Azlanali076\Picwish\Providers;

use Azlanali076\Picwish\Picwish;
use Illuminate\Support\ServiceProvider;

class PicwishServiceProvider extends ServiceProvider {

    public function register(){
        $this->app->bind('picwish', function($app) {
            return new Picwish();
        });
        $this->mergeConfigFrom(__DIR__.'/../../config/picwish.php','picwish');
    }
    public function boot(){
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/picwish.php' => config_path('picwish.php'),
            ], 'config');
        }
    }

}