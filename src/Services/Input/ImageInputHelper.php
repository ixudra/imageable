<?php namespace Ixudra\Imageable\Services\Input;


use Ixudra\Core\Services\Input\BaseInputHelper;
use Ixudra\Imageable\Models\Image;

class ImageInputHelper extends BaseInputHelper {

    public function getDefaultInput($prefix = '')
    {
        return $this->getPrefixedInput( Image::getDefaults(), $prefix );
    }

    public function getInputForModel($model, $prefix = '')
    {
        return $this->getPrefixedInput( $this->getAttributes( $model ), $prefix );
    }

}