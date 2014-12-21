<?php namespace Ixudra\Imageable\Presenters;


use \URL;

use Laracasts\Presenter\Presenter;

class ImagePresenter extends Presenter {

    public function imageUrl()
    {
        return URL::to($this->imageable->getImagePath() .'/'. $this->file_name);
    }

}