<?php namespace Ixudra\Imageable;


use Illuminate\Support\ServiceProvider;

class ImageableServiceProvider extends ServiceProvider {

    protected $defer = false;


    public function register()
    {
        // Publish configuration files
        $this->mergeConfigFrom( __DIR__ .'/config/imageable.php', 'imageable' );

        $this->publishes(array(
            __DIR__ .'/config/imageable.php'        => config_path('imageable.php'),
        ), 'config');
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ .'/resources/views', 'imageable');

        $this->publishes(array(
            __DIR__ .'/resources/views'             => base_path('resources/views/bootstrap'),
        ));

        $this->publishes(array(
            __DIR__ .'/database/migrations/'        => base_path('database/migrations')
        ), 'migrations');
    }

    public function provides()
    {
        return array('Imageable');
    }

}
