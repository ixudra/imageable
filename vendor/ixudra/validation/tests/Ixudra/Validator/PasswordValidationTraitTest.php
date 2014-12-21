<?php
namespace Ixudra\Validation;


class PasswordValidationTraitTest extends \PHPUnit_Framework_TestCase {

    protected $validator;


    public function setUp()
    {
        $this->validator = $this->getObjectForTrait('\Ixudra\Validation\PasswordValidationTrait');
    }


    /**
     * @covers PasswordValidationTrait::validateValidPassword()
     */
    public function testValidatePassword()
    {
        $this->assertTrue( $this->validator->validateValidPassword(null, 'Abc@123', null) );
    }

    /**
     * @covers PasswordValidationTrait::validateValidPassword()
     */
    public function testValidatePassword_returnsFalseIfPasswordIsLessThanSixCharactersLong()
    {
        $this->assertFalse( $this->validator->validateValidPassword(null, 'foo', null) );
    }

    /**
     * @covers PasswordValidationTrait::validateValidPassword()
     */
    public function testValidatePassword_returnsFalseIfPasswordDoesNotContainCapitalLetter()
    {
        $this->assertFalse( $this->validator->validateValidPassword(null, 'abc@123', null) );
    }

    /**
     * @covers PasswordValidationTrait::validateValidPassword()
     */
    public function testValidatePassword_returnsFalseIfPasswordDoesNotContainSpecialCharacter()
    {
        $this->assertFalse( $this->validator->validateValidPassword(null, 'abcd123', null) );
    }

    /**
     * @covers PasswordValidationTrait::validateValidPassword()
     */
    public function testValidatePassword_returnsFalseIfPasswordDoesNotContainNumber()
    {
        $this->assertFalse( $this->validator->validateValidPassword(null, 'abc@xyz', null) );
    }

}
