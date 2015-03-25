<?php namespace Ixudra\Imageable;


use Illuminate\Support\ServiceProvider;

class ImageableServiceProvider extends ServiceProvider {

    protected $defer = false;


    public function boot()
    {
        $this->loadViewsFrom(__DIR__ .'/../../resources/views', 'imageable');

        $this->publishes(array(
            __DIR__ .'/../../resources/views' => base_path('resources/views/bootstrap'),
        ));

        $this->publishes(array(
            __DIR__ .'/../../database/migrations/' => base_path('database/migrations')
        ), 'migrations');
    }

    public function register()
    {
        //...
    }

    public function provides()
    {
        return array('Imageable');
    }

}
