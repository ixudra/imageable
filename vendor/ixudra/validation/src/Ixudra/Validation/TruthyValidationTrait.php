<?php
namespace Ixudra\Validation;


trait TruthyValidationTrait {

    public function validateTruthy($attribute, $value, $parameters)
    {
        if( $value === true ) {
            return true;
        }

        if( $value === false ) {
            return true;
        }

        return false;
    }

    public function validateTrue($attribute, $value, $parameters)
    {
        return ( $value === true );
    }

}