<?php
namespace Ixudra\Validation;


trait TimeValidationTrait {

    public function validateTime($attribute, $value, $parameters)
    {
        if( strtotime( $value ) !== false ) {
            return true;
        }

        return false;
    }

    public function validateTimeFormat($attribute, $value, $parameters)
    {
        if( preg_match("/^(2[0-3]|[01]?[1-9]):([0-5]?[0-9])$/", $value) ) {
            return true;
        }

        return false;
    }

}