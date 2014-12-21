<?php namespace Ixudra\Imageable\Services\Factories;


use \Str;
use \File;

use Ixudra\Imageable\Models\Image;
use Ixudra\Imageable\Models\Response\BaseModelResponse;

class ImageFactory {

    public function create($input, $imageable)
    {
        $input = $this->preProcessInput($input, $imageable);

        $image = new Image();
        $imageResponse = $image->make( $input );

        $response = new BaseModelResponse( null, $input );
        if( $imageResponse->isSuccessful() ) {
            $response->setModel($image);
            $response->addNotifications('success', array('Image created successfully'));
        } else {
            $response->addNotifications('error', array('Failure while creating image'));
        }

        return $response;
    }

    public function modify($image, $input, $imageable)
    {
        $input = $this->preProcessInput($input, $imageable);

        $imageResponse = $image->modify( $input );

        $response = new BaseModelResponse( $image, $input );
        if( $imageResponse->isSuccessful() ) {
            $response->addNotifications('success', array('Image updated successfully'));
        } else {
            $response->addNotifications('error', array('Failure while updating image'));
        }

        return $response;
    }

    protected function preProcessInput($input, $imageable)
    {
        $modelInput = array(
            'title'                 => $input[ 'image_title' ],
            'alt'                   => $input[ 'image_alt' ],
        );

        if( array_key_exists( 'image', $input ) && !is_null( $input[ 'image' ] ) ) {
            $modelInput[ 'file' ] = $input[ 'image' ];
            $modelInput[ 'file_name' ] = $this->generateUniqueName( $input[ 'image' ], $imageable->getImagePath());
        }

        return $modelInput;
    }

    protected function generateUniqueName($file, $path)
    {
        do {
            $fileName = Str::random(20) . '.' . File::extension($file->getClientOriginalName());
        } while( file_exists( public_path( $path ) .'/'. $fileName ) );

        return $fileName;
    }

}