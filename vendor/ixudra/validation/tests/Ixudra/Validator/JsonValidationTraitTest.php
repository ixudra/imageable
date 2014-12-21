<?php
namespace Ixudra\Validation;


class JsonValidationTraitTest extends \PHPUnit_Framework_TestCase {

    protected $validator;


    public function setUp()
    {
        $this->validator = $this->getObjectForTrait('\Ixudra\Validation\JsonValidationTrait');
    }


    /**
     * @covers JsonValidationTrait::validateJson()
     */
    public function testValidateJson_returnsTrueIfJsonIsValid()
    {
        $this->assertTrue( $this->validator->validateJson(null, '{"menu": {"id": "file","value": "File","popup": {"menuitem": [{"value": "New", "onclick": "CreateNewDoc()"},{"value": "Open", "onclick": "OpenDoc()"},{"value": "Close", "onclick": "CloseDoc()"}]}}}', null) );
    }

    /**
     * @covers JsonValidationTrait::validateJson()
     */
    public function testValidateJson_returnsFalseIfJsonIsNotValid()
    {
        $this->assertFalse( $this->validator->validateJson(null, '{"menu": {"id": "file","value": "File","popup": {"menuitem": {"value": "New", "onclick": "CreateNewDoc()"},{"value": "Open", "onclick": "OpenDoc()"},{"value": "Close", "onclick": "CloseDoc()"}]}}}', null) );
    }

    /**
     * @covers JsonValidationTrait::validateJson()
     */
    public function testValidateJson_returnsFalseIfValueIsInteger()
    {
        $this->assertFalse( $this->validator->validateJson(null, 15, null) );
    }

    /**
     * @covers JsonValidationTrait::validateJson()
     */
    public function testValidateJson_returnsFalseIfValueIsJson()
    {
        $this->assertFalse( $this->validator->validateJson(null, 'Foo', null) );
    }

    /**
     * @covers JsonValidationTrait::validateJson()
     */
    public function testValidateJson_returnsFalseIfValueIsTruthy()
    {
        $this->assertFalse( $this->validator->validateJson(null, true, null) );
    }

}
