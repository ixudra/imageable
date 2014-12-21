<?php
namespace Ixudra\Validation;


class StringValidationTraitTest extends \PHPUnit_Framework_TestCase {

    protected $validator;


    public function setUp()
    {
        $this->validator = $this->getObjectForTrait('\Ixudra\Validation\StringValidationTrait');
    }


    /**
     * @covers StringValidationTraitTest::validateEmpty()
     */
    public function testValidateEmpty()
    {
        $this->assertTrue( $this->validator->validateEmpty(null, '', null) );
    }

    /**
     * @covers StringValidationTraitTest::validateEmpty()
     */
    public function testValidateEmpty_returnsFalseIfValueIsNotEmpty()
    {
        $this->assertFalse( $this->validator->validateEmpty(null, 'foo', null) );
    }

}
