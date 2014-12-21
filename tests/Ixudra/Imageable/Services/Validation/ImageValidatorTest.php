<?php namespace Ixudra\Imageable\Services\Validation;


class ImageValidatorTest extends \PHPUnit_Framework_TestCase {

    protected $input = null;


    public function setUp()
    {
        parent::setUp();

        $this->input = array(
            'file'                  => $this->getImage(),
            'name'                  => 'uploads/testing/Foo_name.jpg',
            'description'           => 'Foo_description',
            'imageable_id'          => 15,
            'imageable_type'        => 'Product'
        );
    }


    /**
     * @covers ImageValidator::passes()
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
     * @covers ImageValidator::fails()
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
     * @covers ImageValidator::passes()
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
     * @covers ImageValidator::passes()
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
    public function testPasses_returnsFalseIfNameIsNotProvided()
    {
        $this->input['name'] = '';
        $validator = $this->createValidator();

        $this->assertFalse( $validator->passes() );
        $this->assertCount(1, $validator->getFailures());
        $this->assertTrue( in_array( 'name.required', $validator->getFailures() ) );
    }

    /**
     * @covers ProductValidator::passes()
     * @covers ProductValidator::preProcessAttributes()
     */
    public function testPasses_returnsFalseIfNameIsLongerThan32Characters()
    {
        $this->input['name'] = 'Foooooooooooooooooooooooooooooooo';
        $validator = $this->createValidator();

        $this->assertFalse( $validator->passes() );
        $this->assertCount(1, $validator->getFailures());
        $this->assertTrue( in_array( 'name.max', $validator->getFailures() ) );
    }

    /**
     * @covers ProductValidator::passes()
     * @covers ProductValidator::preProcessAttributes()
     */
    public function testPasses_returnsFalseIfFileExistsWithThatName()
    {
        $this->input['name'] = 'uploads/testing/Penguins.jpg';
        $validator = $this->createValidator();

        $this->assertFalse( $validator->passes() );
        $this->assertCount(1, $validator->getFailures());
        $this->assertTrue( in_array( 'name.uniqueFileName', $validator->getFailures() ) );
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
    public function testPasses_returnsFalseIfImageableIdIsNotProvided()
    {
        $this->input['imageable_id'] = '';
        $validator = $this->createValidator();

        $this->assertFalse( $validator->passes() );
        $this->assertCount(1, $validator->getFailures());
        $this->assertTrue( in_array( 'imageable_id.required', $validator->getFailures() ) );
    }

    /**
     * @covers ProductValidator::passes()
     * @covers ProductValidator::preProcessAttributes()
     */
    public function testPasses_returnsFalseIfImageableIdIsLongerThan32Characters()
    {
        $this->input['imageable_id'] = 'Foo';
        $validator = $this->createValidator();

        $this->assertFalse( $validator->passes() );
        $this->assertCount(1, $validator->getFailures());
        $this->assertTrue( in_array( 'imageable_id.integer', $validator->getFailures() ) );
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
        $validator = new ImageValidator();
        $validator->setAttributes($this->input);

        return $validator;
    }

    protected function getImage($path = 'uploads/testing/Penguins.jpg', $originalName = 'Penguins.jpg', $mimeType = 'image/jpg')
    {
        return new Symfony\Component\HttpFoundation\File\UploadedFile( public_path( $path ), $originalName, $mimeType, null, null, true );
    }

}
