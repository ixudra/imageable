<?php namespace Ixudra\Imageable\Models;


use App;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

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

    protected $presenter = '\Ixudra\Imageable\Presenters\ImagePresenter';


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


    public static function getRules()
    {
        return array(
            'file'                  => 'required|mimes:jpeg,jpg,png',
            'title'                 => 'max:128',
            'alt'                   => 'max:256',
        );
    }

    public static function getDefaults()
    {
        return array(
            'file'                  => null,
            'title'                 => '',
            'alt'                   => '',
        );
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
