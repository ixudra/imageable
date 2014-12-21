<?php
namespace Ixudra\Validation;


class TruthyValidationTraitTest extends \PHPUnit_Framework_TestCase {

    protected $validator;


    public function setUp()
    {
        $this->validator = $this->getObjectForTrait('\Ixudra\Validation\TruthyValidationTrait');
    }

    /**
     * @covers TruthyValidationTrait::validateTruthy()
     */
    public function testValidateTruthy_returnsTrueIfValueIsTrue()
    {
        $this->assertTrue( $this->validator->validateTruthy(null, true, null) );
    }

    /**
     * @covers TruthyValidationTrait::validateTruthy()
     */
    public function testValidateTruthy_returnsTrueIfValueIsFalse()
    {
        $this->assertTrue( $this->validator->validateTruthy(null, false, null) );
    }

    /**
     * @covers TruthyValidationTrait::validateTruthy()
     */
    public function testValidateTruthy_returnsFalseIfValueIsText()
    {
        $this->assertFalse( $this->validator->validateTruthy(null, 'foo', null) );
    }

    /**
     * @covers TruthyValidationTrait::validateTruthy()
     */
    public function testValidateTruthy_returnsFalseIfValueIsNumeric()
    {
        $this->assertFalse( $this->validator->validateTruthy(null, 1, null) );
    }

    /**
     * @covers TruthyValidationTrait::validateTrue()
     */
    public function testValidateTrue()
    {
        $this->assertTrue( $this->validator->validateTrue(null, true, null) );
    }

    /**
     * @covers TruthyValidationTrait::validateTrue()
     */
    public function testValidateTrue_returnsFalseIfValueIsFalse()
    {
        $this->assertFalse( $this->validator->validateTrue(null, false, null) );
    }

    /**
     * @covers TruthyValidationTrait::validateTrue()
     */
    public function testValidateTrue_returnsFalseIfValueIsString()
    {
        $this->assertFalse( $this->validator->validateTrue(null, 'foo', null) );
    }

    /**
     * @covers TruthyValidationTrait::validateTrue()
     */
    public function testValidateTrue_returnsFalseIfValueIsInteger()
    {
        $this->assertFalse( $this->validator->validateTrue(null, 125, null) );
    }

}
