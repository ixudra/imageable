<?php
namespace Ixudra\Validation;


trait FileValidationTrait {

    public function validateUniqueFileName($attribute, $value, $parameters)
    {
        if( !empty( $parameters) ) {
            $value = $parameters[ 0 ] .'/'. $value;
        }

        if( file_exists( public_path( $value ) ) ) {
            return false;
        }

        return true;
    }

}