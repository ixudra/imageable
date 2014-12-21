<?php
namespace Ixudra\Validation;


class TelephoneValidationTraitTest extends \PHPUnit_Framework_TestCase {

    protected $validator;


    public function setUp()
    {
        $this->validator = $this->getObjectForTrait('\Ixudra\Validation\TelephoneValidationTrait');
    }


    /**
     * @covers TelephoneValidationTraitTest::validateTelephoneNumber()
     */
    public function testValidateTelephoneNumber_returnsTrueIfInputContainsValidTelephoneNumber()
    {
        $this->assertTrue( $this->validator->validateTelephoneNumber(null, '011/44.55.66', null) );
    }

    /**
     * @covers TelephoneValidationTraitTest::validateTelephoneNumber()
     */
    public function testValidateTelephoneNumber_returnsFalseIfTelephoneNumberIsNotCorrect()
    {
        $this->assertFalse( $this->validator->validateTelephoneNumber(null, '411/44.55.66', null) );
    }

    /**
     * @covers TelephoneValidationTraitTest::validateTelephoneNumber()
     */
    public function testValidateTelephoneNumber_returnsFalseIfTelephoneNumberFormattingIsNotCorrect_incorrectSpacers()
    {
        $this->assertFalse( $this->validator->validateTelephoneNumber(null, '011/44/55/66', null) );
    }

    /**
     * @covers TelephoneValidationTraitTest::validateTelephoneNumber()
     */
    public function testValidateTelephoneNumber_returnsFalseIfTelephoneNumberFormattingIsNotCorrect_noSpacers()
    {
        $this->assertFalse( $this->validator->validateTelephoneNumber(null, '011445566', null) );
    }

    /**
     * @covers TelephoneValidationTraitTest::validateTelephoneNumber()
     */
    public function testValidateTelephoneNumber_returnsTrueIfInputContainsValidCellphoneNumber()
    {
        $this->assertTrue( $this->validator->validateTelephoneNumber(null, '0496/44.55.66', null) );
    }

    /**
     * @covers TelephoneValidationTraitTest::validateTelephoneNumber()
     */
    public function testValidateTelephoneNumber_returnsFalseIfCellphoneNumberIsNotCorrect()
    {
        $this->assertFalse( $this->validator->validateTelephoneNumber(null, '0596/44.55.66', null) );
    }

    /**
     * @covers TelephoneValidationTraitTest::validateTelephoneNumber()
     */
    public function testValidateTelephoneNumber_returnsFalseIfCellphoneNumberFormattingIsNotCorrect_incorrectSpacers()
    {
        $this->assertFalse( $this->validator->validateTelephoneNumber(null, '0496/44/55/66', null) );
    }

    /**
     * @covers TelephoneValidationTraitTest::validateTelephoneNumber()
     */
    public function testValidateTelephoneNumber_returnsFalseIfCellphoneNumberFormattingIsNotCorrect_noSpacers()
    {
        $this->assertFalse( $this->validator->validateTelephoneNumber(null, '0496445566', null) );
    }

}
