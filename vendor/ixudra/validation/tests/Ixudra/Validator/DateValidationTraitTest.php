<?php
namespace Ixudra\Validation;


class DateValidationTraitTest extends \PHPUnit_Framework_TestCase {

    protected $validator;


    public function setUp()
    {
        $this->validator = $this->getObjectForTrait('\Ixudra\Validation\DateValidationTrait');
    }


    /**
     * @covers DateValidationTrait::validatePast()
     */
    public function testValidatePast()
    {
        $this->assertTrue( $this->validator->validatePast(null, date('Y-m-d', strtotime('-1 year')), null) );
    }

    /**
     * @covers DateValidationTrait::validatePast()
     */
    public function testValidatePast_returnsFalseIfValueIsInTheFuture()
    {
        $this->assertFalse( $this->validator->validatePast(null, date('Y-m-d', strtotime('+1 year')), null) );
    }

    /**
     * @covers DateValidationTrait::validatePast()
     */
    public function testValidatePast_returnsFalseIfValueIsText()
    {
        $this->assertFalse( $this->validator->validatePast(null, 'foo', null) );
    }

    /**
     * @covers DateValidationTrait::validatePast()
     */
    public function testValidatePast_returnsFalseIfValueIsInteger()
    {
        $this->assertFalse( $this->validator->validatePast(null, 1, null) );
    }

    /**
     * @covers DateValidationTrait::validateFuture()
     */
    public function testValidateFuture()
    {
        $this->assertTrue( $this->validator->validateFuture(null, date('Y-m-d', strtotime('+1 year')), null) );
    }

    /**
     * @covers DateValidationTrait::validateFuture()
     */
    public function testValidateFuture_returnsFalseIfValueIsInThePast()
    {
        $this->assertFalse( $this->validator->validateFuture(null, date('Y-m-d', strtotime('-1 year')), null) );
    }

    /**
     * @covers DateValidationTrait::validateFuture()
     */
    public function testValidateFuture_returnsFalseIfValueIsText()
    {
        $this->assertFalse( $this->validator->validateFuture(null, 'foo', null) );
    }

    /**
     * @covers DateValidationTrait::validateFuture()
     */
    public function testValidateFuture_returnsFalseIfValueIsInteger()
    {
        $this->assertFalse( $this->validator->validateFuture(null, 1, null) );
    }

    /**
     * @covers DateValidationTrait::validateFuture()
     */
    public function testValidateFuture_returnsFalseIfValueIsNumeric()
    {
        $this->assertFalse( $this->validator->validateFuture(null, 1, null) );
    }

    /**
     * @covers DateValidationTrait::validateLessThanThreeDaysOld()
     */
    public function testValidateLessThanThreeDaysOld()
    {
        $this->assertTrue( $this->validator->validateLessThanThreeDaysOld(null, date('Y-m-d', strtotime('-1 day')), null) );
    }

    /**
     * @covers DateValidationTrait::validateLessThanThreeDaysOld()
     */
    public function testValidateLessThanThreeDaysOld_returnsFalseIfDateIsMoreThanThreeDaysOld()
    {
        $this->assertFalse( $this->validator->validateLessThanThreeDaysOld(null, date('Y-m-d', strtotime('-1 year')), null) );
    }

    /**
     * @covers DateValidationTrait::validateTodayOrLater()
     */
    public function testValidateTodayOrLater()
    {
        $this->assertTrue( $this->validator->validateTodayOrLater(null, date('Y-m-d', strtotime('+1 year')), null) );
    }

    /**
     * @covers DateValidationTrait::validateTodayOrLater()
     */
    public function testValidateTodayOrLater_returnsFalseIfValueIsInThePast()
    {
        $this->assertFalse( $this->validator->validateTodayOrLater(null, date('Y-m-d', strtotime('-1 year')), null) );
    }

    /**
     * @covers DateValidationTrait::validateTodayOrLater()
     */
    public function testValidateTodayOrLater_returnsTrueIfDateIsToday()
    {
        $this->assertTrue( $this->validator->validateTodayOrLater(null, date('Y-m-d'), null) );
    }

    /**
     * @covers DateValidationTrait::validateTodayOrLater()
     */
    public function testValidateTodayOrLater_returnsTrueIfDateIsTodayWithLargeFormat()
    {
        $this->assertTrue( $this->validator->validateTodayOrLater(null, date('Y-m-d H:i:s'), null) );
    }

}
