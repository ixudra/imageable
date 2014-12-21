<?php
namespace Ixudra\Validation;


class ArrayValidationTraitTest extends \PHPUnit_Framework_TestCase {

    protected $validator;


    public function setUp()
    {
        $this->validator = $this->getObjectForTrait('\Ixudra\Validation\ArrayValidationTrait');
    }


    /**
     * @covers ArrayValidationTrait::validateArraySize()
     */
    public function testValidateArraySize()
    {
        $this->assertTrue( $this->validator->validateArraySize(null, array('one', 'two', 'three', 'four', 'five'), array(5)) );
    }

    /**
     * @covers ArrayValidationTrait::validateArraySize()
     */
    public function testValidateArraySize_returnsFalseIfValueIsNotArray()
    {
        $this->assertFalse( $this->validator->validateArraySize(null, 'Foo', array(5)) );
    }

    /**
     * @covers ArrayValidationTrait::validateArraySize()
     */
    public function testValidateArraySize_returnsFalseIfArrayContainsLessThanRequestedNumber()
    {
        $this->assertFalse( $this->validator->validateArraySize(null, array('one', 'two', 'three', 'four', 'five'), array(10)) );
    }

    /**
     * @covers ArrayValidationTrait::validateArraySize()
     */
    public function testValidateArraySize_returnsFalseIfArrayContainsMoreThanRequestedNumber()
    {
        $this->assertFalse( $this->validator->validateArraySize(null, array('one', 'two', 'three', 'four', 'five'), array(2)) );
    }

    /**
     * @covers ArrayValidationTrait::validateOneOrMoreSelected()
     */
    public function testValidateOneOrMoreSelected()
    {
        $this->assertTrue( $this->validator->validateOneOrMoreSelected(null, array(1 => true, 4 => false), null) );
    }

    /**
     * @covers ArrayValidationTrait::validateOneOrMoreSelected()
     */
    public function testValidateOneOrMoreSelected_returnsFalseIfZeroSelected()
    {
        $this->assertFalse( $this->validator->validateOneOrMoreSelected(null, array(1 => false, 4 => false), null) );
    }

    /**
     * @covers ArrayValidationTrait::validateOneOrMoreSelected()
     */
    public function testValidateOneOrMoreSelected_returnsFalseIfValueIsNotArray()
    {
        $this->assertFalse( $this->validator->validateOneOrMoreSelected(null, 'Foo', null) );
    }

    /**
     * @covers ArrayValidationTrait::validateOneOrMoreSelected()
     */
    public function testValidateOneOrMoreSelected_returnsFalseIfArrayIsEmpty()
    {
        $this->assertFalse( $this->validator->validateOneOrMoreSelected(null, array(), null) );
    }

}
