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
