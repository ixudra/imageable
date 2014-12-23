<?php namespace Ixudra\Imageable\Services\Validation;


class CreateImageValidator extends BaseValidator {

    protected $rules = array(
        'file'                  => 'required|mimes:jpeg,jpg,png',
        'file_name'             => 'required|max:32',
        'title'                 => 'max:128',
        'alt'                   => 'max:256'
    );

    protected $messages = array(
        // ...
    );

}


