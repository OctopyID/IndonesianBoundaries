<?php

return [
    'basemap' => [
        'center' => [
            'lat' => -2.548926,
            'lng' => 118.0148634,
        ],

        'background' => [
            'label' => true,
            'theme' => 'voyager',
        ],

        /*
        |--------------------------------------------------------------------------
        | Map Factory Options
        |--------------------------------------------------------------------------
        |
        | You can add any options you like according to the Leaflet.
        |
        | Please visit https://leafletjs.com/reference-1.7.1.html#map-factory
        | for options availability.
        |
        */
        'options'    => [
            'zoom'            => 6,
            'zoomControl'     => true,
            'scrollWheelZoom' => true,
        ],
    ],
];