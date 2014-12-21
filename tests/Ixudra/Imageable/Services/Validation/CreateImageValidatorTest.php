<?php namespace Ixudra\Imageable\Services\Validation;


class CreateImageValidatorTest extends \PHPUnit_Framework_TestCase {

    protected $input = null;


    public function setUp()
    {
        parent::setUp();

        $this->input = array(
            'file'                  => $this->getImage(),
            'description'           => 'Foo_description',
            'imageable_type'        => 'Product'
        );
    }


    /**
     * @covers CreateImageValidator::passes()
     * @covers BaseModelValidator::make()
     * @covers BaseModelValidator::getFailures()
     * @covers BaseModelValidator::setAttributes()
     */
    public function testPasses()
    {
        $validator = $this->createValidator();

        $this->assertTrue($validator->passes());
        $this->assertCount(0, $validator->getFailures());
    }

    /**
     * @covers CreateImageValidator::fails()
     * @covers BaseModelValidator::make()
     * @covers BaseModelValidator::getFailures()
     * @covers BaseModelValidator::setAttributes()
     */
    public function testFails()
    {
        $validator = $this->createValidator();

        $this->assertFalse($validator->fails());
        $this->assertCount(0, $validator->getFailures());
    }

    /**
     * @covers CreateImageValidator::passes()
     */
    public function testPasses_failsIfFileIsNotProvided()
    {
        $this->input['file'] = '';
        $validator = $this->createValidator();

        $this->assertFalse( $validator->passes() );
        $this->assertCount(1, $validator->getFailures());
        $this->assertTrue( in_array( 'file.required', $validator->getFailures() ) );
    }

    /**
     * @covers CreateImageValidator::passes()
     */
    public function testPasses_failsIfFileHasIllegalMimeType()
    {
        $this->input['file'] = $this->getImage('uploads/testing/Penguins.gif', 'Penguins.gif', 'image/gif');
        $validator = $this->createValidator();

        $this->assertFalse( $validator->passes() );
        $this->assertCount(1, $validator->getFailures());
        $this->assertTrue( in_array( 'file.mimes', $validator->getFailures() ) );
    }

    /**
     * @covers ProductValidator::passes()
     * @covers ProductValidator::preProcessAttributes()
     */
    public function testPasses_returnsTrueIDescriptionIsNotProvided()
    {
        $this->input['description'] = '';
        $validator = $this->createValidator();

        $this->assertTrue( $validator->passes() );
    }

    /**
     * @covers ProductValidator::passes()
     * @covers ProductValidator::preProcessAttributes()
     */
    public function testPasses_returnsFalseIfDescriptionIsLongerThan256Characters()
    {
        $this->input['description'] = 'Foooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo';
        $validator = $this->createValidator();

        $this->assertFalse( $validator->passes() );
        $this->assertCount(1, $validator->getFailures());
        $this->assertTrue( in_array( 'description.max', $validator->getFailures() ) );
    }

    /**
     * @covers ProductValidator::passes()
     * @covers ProductValidator::preProcessAttributes()
     */
    public function testPasses_returnsFalseIfImageableTypeIsNotProvided()
    {
        $this->input['imageable_type'] = '';
        $validator = $this->createValidator();

        $this->assertFalse( $validator->passes() );
        $this->assertCount(1, $validator->getFailures());
        $this->assertTrue( in_array( 'imageable_type.required', $validator->getFailures() ) );
    }

    /**
     * @covers ProductValidator::passes()
     * @covers ProductValidator::preProcessAttributes()
     */
    public function testPasses_returnsFalseIfImageableTypeIsLongerThan32Characters()
    {
        $this->input['imageable_type'] = 'Foooooooooooooooooooooooooooooooo';
        $validator = $this->createValidator();

        $this->assertFalse( $validator->passes() );
        $this->assertCount(1, $validator->getFailures());
        $this->assertTrue( in_array( 'imageable_type.max', $validator->getFailures() ) );
    }


    protected function createValidator()
    {
        $validator = new CreateImageValidator();
        $validator->setAttributes($this->input);

        return $validator;
    }

    protected function getImage($path = 'uploads/testing/Penguins.jpg', $originalName = 'Penguins.jpg', $mimeType = 'image/jpg')
    {
        return new Symfony\Component\HttpFoundation\File\UploadedFile( public_path( $path ), $originalName, $mimeType, null, null, true );
    }

}
