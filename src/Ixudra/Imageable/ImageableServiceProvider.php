<?php namespace Ixudra\Imageable;


use Illuminate\Support\ServiceProvider;

class ImageableServiceProvider extends ServiceProvider {

    protected $defer = false;


    public function boot()
    {
        $this->package('ixudra/imageable');
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
