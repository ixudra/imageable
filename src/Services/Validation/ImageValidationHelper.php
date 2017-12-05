<?php namespace Ixudra\Imageable\Services\Validation;


use Ixudra\Core\Services\Validation\BaseValidationHelper;
use Ixudra\Imageable\Models\Image;

class ImageValidationHelper extends BaseValidationHelper {

    public function getFilterValidationRules()
    {
        return array(
            'query'         => ''
        );
    }

    public function getFormValidationRules($formName, $prefix = '')
    {
        return Image::getRules();
    }

}