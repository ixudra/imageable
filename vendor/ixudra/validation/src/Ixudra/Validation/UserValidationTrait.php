<?php
namespace Ixudra\Validation;


trait UserValidationTrait {

    public function validateEmailBelongsToAuthenticatedUser($attribute, $value, $parameters)
    {
        return ( $value == \Auth::user()->email );
    }

    public function validateIdBelongsToAuthenticatedUser($attribute, $value, $parameters)
    {
        return ( $value == \Auth::user()->id );
    }

}