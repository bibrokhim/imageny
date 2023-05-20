<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default, PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'gd',

    'sizes' => [
        'large' => [900, null], // [width, height]
        'medium' => [600, null], // null means auto
        'small' => [200, null],
    ],

    'encode' => [
        'formats' => ['webp'],
        'quality' => 85
    ],

    'per-page' => 30,

];
