<?php namespace Ixudra\Imageable\Presenters;


use Laracasts\Presenter\Presenter;

use URL;

class ImagePresenter extends Presenter {

    public function imageUrl()
    {
        return URL::to($this->imageable->getImagePath() .'/'. $this->file_name);
    }

}