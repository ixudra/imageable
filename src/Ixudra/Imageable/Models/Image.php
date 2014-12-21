<?php namespace Ixudra\Imageable\Models;


use App;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Laracasts\Presenter\PresentableTrait;

use Ixudra\Imageable\Models\Response\BaseModelResponse;

class Image extends Eloquent {

    use PresentableTrait;


    protected $table = 'images';

    protected $guarded = array('id');

    protected $validated = false;


    protected $validators = array(
        'create'            => '\Ixudra\Imageable\Services\Validation\CreateImageValidator',
        'edit'              => '\Ixudra\Imageable\Services\Validation\EditImageValidator',
        'default'           => '\Ixudra\Imageable\Services\Validation\ImageValidator'
    );

    protected $presenter = '\Ixudra\Imageable\Presenters\ImagePresenter';


    public function imageable()
    {
        return $this->morphTo();
    }


    public function make($input)
    {
        $response = new BaseModelResponse($this, $input);

        $validator = App::make( $this->getValidator('create') );
        $validator->setAttributes($input);
        if( $validator->fails() ) {
            $response->addNotifications('error', $validator->getErrors());

            return $response;
        }

        $this->validated = true;
        $this->fill(
            array(
                'file_name'             => $input[ 'file_name' ],
                'title'                 => $input[ 'title' ],
                'alt'                   => $input[ 'alt' ]
            )
        );

//        $response->addNotifications('success', array('Image created successfully'), true);

        return $response;
    }

    public function modify($input)
    {
        $response = new BaseModelResponse($this, $input);

        $validator = App::make( $this->getValidator('edit') );
        $validator->setAttributes($input);
        if( $validator->fails() ) {
            $response->addNotifications('error', $validator->getErrors());

            return $response;
        }

        $this->validated = true;
        $this->fill(
            array(
                'title'                 => $input[ 'title' ],
                'alt'                   => $input[ 'alt' ]
            )
        );

        if( array_key_exists( 'file', $input ) ) {
            $this->file_name = $input[ 'file_name' ];
        }

//        $response->addNotifications('success', array('Image edited successfully'), true);

        return $response;
    }

    public function remove()
    {
        unlink( $this->getFullPath() );
        $this->delete();

        $response = new BaseModelResponse();
//        $response->addNotifications('success', array($this->translationKey .'.delete.success'), true);

        return $response;
    }

    public function isValid($validationKey = 'default')
    {
        $validator = App::make( $this->getValidator( $validationKey ) );
        $input = $this->attributesToArray();

        $validator->setAttributes( $input );
        if( $validator->fails() ) {
            return false;
        }

        return true;
    }

    public function save(array $options = array())
    {
        $validator = 'default';
        if( array_key_exists( 'validator', $options ) ) {
            $validator = $options['validator'];
        }

        if( $this->validated || $this->isValid( $validator ) ) {
            return parent::save($options);
        }

        return false;
    }

    public function forceSave(array $options = array())
    {
        return $this->save( array( 'validator' => 'testing' ) );
    }

    public function isValidated()
    {
        return $this->validated;
    }

    protected function getValidator($validationKey = 'default')
    {
        if( !array_key_exists( $validationKey, $this->validators ) ) {
            $validationKey = 'default';
        }

        return $this->validators[ $validationKey ];
    }


    public function attachToTarget($file, $target)
    {
        $this->imageable_id = $target->id;
        $this->imageable_type = get_class($target);
        $this->save();

        $this->uploadFile( $file, $target->getImagePath(), $this->file_name );
    }

    protected function uploadFile($file, $path, $name)
    {
        $file->move(public_path( $path ), $name);
    }

    public function fileExists()
    {
        return file_exists( $this->getFullPath() );
    }

    public function getFullPath()
    {
        $fileName = $this->file_name;
        if( $this->isDirty( array( 'file_name' ) ) ) {
            $fileName = $this->getOriginal('file_name');
        }

        return public_path( $this->imageable->getImagePath() .'/'. $fileName );
    }


    public static function getDefaults()
    {
        return array(
            'name'                  => 'required|max:256',
            'path'                  => 'required|max:128',
            'imageable_id'          => 'required|integer',
            'imageable_type'        => 'required|max:32'
        );
    }

}
