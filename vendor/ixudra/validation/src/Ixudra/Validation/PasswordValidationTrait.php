<?php
namespace Ixudra\Validation;


trait PasswordValidationTrait {

    public function validateValidPassword($attribute, $value, $parameters)
    {
        if( strlen($value) < 6 ) {
            return false;
        }

        if( preg_match('/\d/', $value) != 1 ) {
            return false;
        }

        if( preg_match('/[A-Z]/', $value) != 1 ) {
            return false;
        }

        if( preg_match('/[@#&?.-_%$]/', $value) != 1 ) {
            return false;
        }

        return true;
    }

    public function validateCorrectPassword($attribute, $value, $parameters)
    {
        $credentials = array(
            'email'         => \Auth::user()->email,
            'password'      => $value
        );

        return ( \Auth::validate($credentials) );
    }

}