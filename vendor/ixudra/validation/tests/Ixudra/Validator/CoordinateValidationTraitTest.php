<?php
namespace Ixudra\Validation;


class CoordinateValidationTraitTest extends \PHPUnit_Framework_TestCase {

    protected $validator;


    public function setUp()
    {
        $this->validator = $this->getObjectForTrait('\Ixudra\Validation\CoordinateValidationTrait');
    }


    /**
     * @covers CoordinateValidationTrait::validateWorldCoordinate()
     */
    public function testValidateWorldCoordinate()
    {
        $this->assertTrue( $this->validator->validateWorldCoordinate(null, '50.135209', null) );
    }

    /**
     * @covers CoordinateValidationTrait::validateWorldCoordinate()
     */
    public function testValidateWorldCoordinate_returnsFalseIfCoordinateIsTooPrecise()
    {
        $this->assertFalse( $this->validator->validateWorldCoordinate(null, '50.1352393', null) );
    }

    /**
     * @covers CoordinateValidationTrait::validateWorldCoordinate()
     */
    public function testValidateWorldCoordinate_returnsFalseIfCoordinateIsNotPreciseEnough()
    {
        $this->assertFalse( $this->validator->validateWorldCoordinate(null, '50.1', null) );
    }

}
