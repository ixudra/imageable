<?php namespace Ixudra\Imageable\Services\Validation;


use Validator;

class BaseValidator {

    protected $attributes;

    protected $rules;

    protected $messages;

    protected $validator;


    public function setAttributes($attributes)
    {
        $this->attributes = $this->preProcessAttributes( $attributes );
    }


    public function make()
    {
        if( !$this->validator ) {
            $this->validator = Validator::make( $this->attributes, $this->rules, $this->messages );
        }

        return $this->validator;
    }

    public function fails()
    {
        if( !$this->validator ) {
            $this->make();
        }

        return $this->validator->fails();
    }

    public function passes()
    {
        if( !$this->validator ) {
            $this->make();
        }

        return $this->validator->passes();
    }

    public function getErrors()
    {
        return $this->validator->errors()->all();
    }

    public function getFailures()
    {
        return $this->validator->failures();
    }

    protected function preProcessAttributes($attributes)
    {
        return $attributes;
    }

}
