<?php namespace Ixudra\Imageable\Models;


use Illuminate\Database\Eloquent\Model;
use Ixudra\Imageable\Presenters\ImagePresenter;
use Laracasts\Presenter\PresentableTrait;

use Config;

class Image extends Model {

    use PresentableTrait;


    protected $table = 'images';

    protected $fillable = array(
        'file_name',
        'title',
        'alt',
        'imageable_id',
        'imageable_type',
    );

    protected $guarded = array( 'id' );

    protected $hidden = array();

    protected $translationKey = 'image';

    protected $presenter = ImagePresenter::class;


    public function imageable()
    {
        return $this->morphTo();
    }


    public function update(array $attributes = array(), array $options = array())
    {
        if( array_key_exists( 'file', $attributes ) ) {
            $this->deleteFile();
            $this->uploadFile( $attributes[ 'file' ], $attributes[ 'file_name' ] );
        }

        parent::update( $attributes, $options );
    }

    public function delete()
    {
        $this->deleteFile();

        parent::delete();
    }

    protected function deleteFile()
    {
        if( file_exists( $this->getFullPath() ) ) {
            unlink( $this->getFullPath() );
        }
    }

    public function uploadFile($file, $fileName = '')
    {
        if( $fileName == '' ) {
            $fileName = $this->file_name;
        }

        $file->move( public_path( $this->imageable->getImagePath() ), $fileName );
    }


    /**
     * @codeCoverageIgnore
     */
    public static function getRules()
    {
        $rules = Config::get('imageable.rules');

        if( Config::get('imageable.restrictMimes') ) {
            $mimes = Config::get('imageable.mimes');
            if( !empty($rules[ 'file' ]) ) {
                $rules[ 'file' ] .= '|';
            }

            $rules[ 'file' ] .= 'mimes:'. implode(',', $mimes);
        }

        return $rules;
    }

    /**
     * @codeCoverageIgnore
     */
    public static function getDefaults()
    {
        return Config::get('imageable.defaults');
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

        $path = public_path( $this->imageable->getImagePath() .'/'. $fileName );

        return str_replace('//', '/', $path);
    }

}
