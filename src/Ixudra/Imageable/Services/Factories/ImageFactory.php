<?php namespace Ixudra\Imageable\Services\Factories;


use Illuminate\Support\Str;
use Ixudra\Core\Services\Factories\BaseFactory;
use Ixudra\Imageable\Models\Image;

use File;

class ImageFactory extends BaseFactory {

    public function make($input, $imageable, $prefix = '')
    {
        $image = Image::create( $this->preProcessInput( $this->extractInput( $input, Image::getDefaults(), $prefix, true ), $imageable, $prefix ) );
        $image->uploadFile( $input[ 'file' ] );

        return $image;
    }

    public function modify($image, $input, $imageable, $prefix = '')
    {
        $input = $this->preProcessInput( $this->extractInput( $input, Image::getDefaults(), $prefix ), $imageable, $prefix );
        $image->update( $input );

        return $image;
    }

    protected function preProcessInput($input, $imageable)
    {
        $modelInput = array(
            'title'                 => $input[ 'title' ],
            'alt'                   => $input[ 'alt' ],
        );

        if( array_key_exists( 'file', $input ) && !empty( $input[ 'file' ] ) ) {
            $modelInput[ 'file' ] = $input[ 'file' ];
            $modelInput[ 'file_name' ] = $this->generateUniqueName( $input[ 'file' ], $imageable->getImagePath() );
        }

        $modelInput[ 'imageable_id' ] = $imageable->id;
        $modelInput[ 'imageable_type' ] = get_class($imageable);

        return $modelInput;
    }

    protected function generateUniqueName($file, $path)
    {
        do {
            $fileName = Str::random(20) . '.' . File::extension($file->getClientOriginalName());
        } while( file_exists( public_path( $path ) .'/'. $fileName ) );

        return $fileName;
    }

    protected function uploadFile($file, $path, $name)
    {
        $file->move( public_path( $path ), $name );
    }

}