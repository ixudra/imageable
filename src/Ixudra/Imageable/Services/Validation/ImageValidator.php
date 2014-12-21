<?php namespace Ixudra\Imageable\Services\Validation;


class ImageValidator extends BaseValidator {

    protected $rules = array(
        'file_name'             => 'required|max:32|uniqueFileName',
        'title'                 => 'max:128',
        'alt'                   => 'max:256',
        'imageable_id'          => 'required|integer',
        'imageable_type'        => 'required|max:32'
    );

    protected $messages = array(
        // ...
    );

}


