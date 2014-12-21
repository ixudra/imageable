<?php
namespace Ixudra\Validation;


trait TelephoneValidationTrait {

    public function validateTelephoneNumber($attribute, $value, $parameters)
    {
        if( preg_match("/^0(4)?([0-9]){2}\\/([0-9]){2}\\.([0-9]){2}\\.([0-9]){2}/", $value) ) {
            return true;
        }

        return false;
    }

}