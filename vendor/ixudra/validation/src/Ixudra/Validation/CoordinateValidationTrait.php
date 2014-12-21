<?php
namespace Ixudra\Validation;


trait CoordinateValidationTrait {

    public function validateWorldCoordinate($attribute, $value, $parameters)
    {
        if( preg_match("/^([0-9]){1,2}\\.([0-9]){2,6}$/", $value) ) {
            return true;
        }

        return false;
    }

}