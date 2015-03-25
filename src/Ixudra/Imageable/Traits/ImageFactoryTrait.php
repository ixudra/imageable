<?php namespace Ixudra\Imageable\Traits;


trait ImageFactoryTrait {

    public function extractImageInput($input)
    {
        return array(
            'file'          => $input[ 'file' ],
            'title'         => $input[ 'title' ],
            'alt'           => $input[ 'alt' ]
        );
    }

}