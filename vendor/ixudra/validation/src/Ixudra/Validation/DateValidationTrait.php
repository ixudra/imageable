<?php
namespace Ixudra\Validation;


trait DateValidationTrait {

    public function validatePast($attribute, $value, $parameters)
    {
        $date = $this->getValueAsDate($value);

        return ( ( $date != null ) && ( (new \DateTime()) > ($date) ) );
    }

    public function validateFuture($attribute, $value, $parameters)
    {
        $date = $this->getValueAsDate($value);

        return ( ( $date != null ) && ( (new \DateTime()) < ($date) ) );
    }

    public function validateLessThanThreeDaysOld($attribute, $value, $parameters)
    {
        $date = $this->getValueAsDate($value);

        return ( ( $date != null ) && ( (new \DateTime( date('Y-m-d H:i:s', strtotime('-3 days')) )) < ($date) ) );
    }

    public function validateTodayOrLater($attribute, $value, $parameters)
    {
        $date = null;
        try {
            $date = new \DateTime($value);
        } catch( \Exception $e ) {
            return false;
        }

        return ( ( new \DateTime( date('Y-m-d') ) ) <= ( $date ) );
    }

    protected function getValueAsDate($value)
    {
        $date = null;

        try {
            $date = new \DateTime($value);
        } catch( \Exception $e ) {

        }

        return $date;
    }

}