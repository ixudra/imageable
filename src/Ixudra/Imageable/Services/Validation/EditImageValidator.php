<?php namespace Ixudra\Imageable\Services\Validation;


class EditImageValidator extends BaseValidator {

    protected $rules = array(
        'file'                  => 'mimes:jpeg,jpg,png',
        'file_name'             => 'max:32',
        'title'                 => 'max:128',
        'alt'                   => 'max:256'
    );

    protected $messages = array(
        // ...
    );

}


