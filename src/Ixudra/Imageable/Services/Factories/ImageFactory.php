<?php namespace Ixudra\Imageable\Services\Factories;


use \Illuminate\Support\Str;
use \File;

use Ixudra\Imageable\Models\Image;

class ImageFactory {

    public function make($input, $imageable)
    {
        $image = Image::create( $this->preProcessInput( $input, $imageable ) );
        $image->uploadFile( $input[ 'file' ] );

        return $image;
    }

    public function modify($image, $input, $imageable)
    {
        $input = $this->preProcessInput( $input, $imageable );
        $image->update( $input );

        return $image;
    }

    protected function preProcessInput($input, $imageable)
    {
        $modelInput = array(
            'title'                 => $input[ 'title' ],
            'alt'                   => $input[ 'alt' ],
        );

        if( array_key_exists( 'file', $input ) && !is_null( $input[ 'file' ] ) ) {
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