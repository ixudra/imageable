<?php
namespace Ixudra\Validation;


trait ArrayValidationTrait {

    public function validateArraySize($attribute, $value, $parameters)
    {
        if( !is_array( $value ) ) {
            return false;
        }

        return ( sizeof($value) == $parameters[0] );
    }

    public function validateOneOrMoreSelected($attribute, $value, $parameters)
    {
        if( !is_array( $value ) ) {
            return false;
        }

        $count = 0;
        foreach( $value as $item ) {
            if( $item ) {
                ++$count;
            }
        }

        return ( $count > 0 );
    }

}