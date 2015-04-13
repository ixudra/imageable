<?php namespace Ixudra\Imageable\Traits;


trait ImageFactoryTrait {

    public function extractImageInput($input)
    {
        $imageInput = array(
            'title'         => $input[ 'title' ],
            'alt'           => $input[ 'alt' ]
        );

        if( array_key_exists( 'file', $input ) && !is_null( $input['file'] ) ) {
            $imageInput['file'] = $input[ 'file' ];
        }

        return $imageInput;
    }

}