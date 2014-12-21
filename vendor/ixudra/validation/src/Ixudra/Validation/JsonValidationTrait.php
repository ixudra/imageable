<?php
namespace Ixudra\Validation;


trait JsonValidationTrait {

    function validateJson($attribute, $value, $parameters)
    {
        if( $value === true || $value === false ) {
            return false;
        }

        if( is_numeric($value) ) {
            return false;
        }

        json_decode($value);

        return (json_last_error() == JSON_ERROR_NONE);
    }

}