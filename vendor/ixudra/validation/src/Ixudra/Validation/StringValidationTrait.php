<?php
namespace Ixudra\Validation;


trait StringValidationTrait {

    public function validateEmpty($attribute, $value, $parameters)
    {
        return ( $value == '' );
    }

}