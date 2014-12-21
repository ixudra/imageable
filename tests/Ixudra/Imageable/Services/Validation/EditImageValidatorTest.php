<?php namespace Ixudra\Imageable\Services\Validation;


class EditImageValidatorTest extends \PHPUnit_Framework_TestCase {

    protected $input = null;


    public function setUp()
    {
        parent::setUp();

        $this->input = array(
            'file'                  => $this->getImage(),
            'description'           => 'Foo_description',
        );
    }


    /**
     * @covers EditImageValidator::passes()
     * @covers BaseModelValidator::make()
     * @covers BaseModelValidator::getErrors()
     * @covers BaseModelValidator::setAttributes()
     */
    public function testPasses()
    {
        $validator = $this->createValidator();

        $this->assertTrue($validator->passes());
        $this->assertCount(0, $validator->getErrors());
    }

    /**
     * @covers EditImageValidator::fails()
     * @covers BaseModelValidator::make()
     * @covers BaseModelValidator::getErrors()
     * @covers BaseModelValidator::setAttributes()
     */
    public function testFails()
    {
        $validator = $this->createValidator();

        $this->assertFalse($validator->fails());
        $this->assertCount(0, $validator->getErrors());
    }

    /**
     * @covers EditImageValidator::passes()
     */
    public function testPasses_failsIfFileIsNotProvided()
    {
        $this->input['file'] = '';
        $validator = $this->createValidator();

        $this->assertTrue( $validator->passes() );
    }

    /**
     * @covers EditImageValidator::passes()
     */
    public function testPasses_failsIfFileHasIllegalMimeType()
    {
        $this->input['file'] = $this->getImage('uploads/testing/Penguins.gif', 'Penguins.gif', 'image/gif');
        $validator = $this->createValidator();

        $this->assertFalse( $validator->passes() );
        $this->assertCount(1, $validator->getErrors());
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
        $this->assertCount(1, $validator->getErrors());
        $this->assertTrue( in_array( 'description.max', $validator->getFailures() ) );
    }


    protected function createValidator()
    {
        $validator = new EditImageValidator();
        $validator->setAttributes($this->input);

        return $validator;
    }

    protected function getImage($path = 'uploads/testing/Penguins.jpg', $originalName = 'Penguins.jpg', $mimeType = 'image/jpg')
    {
        return new Symfony\Component\HttpFoundation\File\UploadedFile( public_path( $path ), $originalName, $mimeType, null, null, true );
    }

}
