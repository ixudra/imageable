<?php


    return array(

        'mimes'                     => array(
            'jpeg',
            'jpg',
            'png',
        ),

        'restrictMimes'             => true,

        'rules'                     => array(
            'file'                      => 'required',
            'title'                     => 'max:128',
            'alt'                       => 'max:256',
        ),

        'defaults'                  => array(
            'file'                      => null,
            'title'                     => '',
            'alt'                       => '',
        ),

    );