<?php
namespace Ixudra\Validation;


class TimeValidationTraitTest extends \PHPUnit_Framework_TestCase {

    protected $validator;


    public function setUp()
    {
        $this->validator = $this->getObjectForTrait('\Ixudra\Validation\TimeValidationTrait');
    }


    /**
     * @covers TimeValidationTrait::validateTime()
     */
    public function testValidateTime()
    {
        $this->assertTrue( $this->validator->validateTime(null, '19:00:00', null) );
    }

    /**
     * @covers TimeValidationTrait::validateTime()
     */
    public function testValidateTime_returnsTrueForShortNotation()
    {
        $this->assertTrue( $this->validator->validateTime(null, '19:00', null) );
    }

    /**
     * @covers TimeValidationTrait::validateTime()
     */
    public function testValidateTime_returnsFalseIfValueIsString()
    {
        $this->assertFalse( $this->validator->validateTime(null, 'foo', null) );
    }

    /**
     * @covers TimeValidationTrait::validateTime()
     */
    public function testValidateTime_returnsFalseIfValueIsInteger()
    {
        $this->assertFalse( $this->validator->validateTime(null, '10055223366', null) );
    }

}
