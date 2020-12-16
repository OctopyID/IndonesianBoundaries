<?php

return [
    'basemap' => [
        /*
        |--------------------------------------------------------------------------
        | Center Of Map
        |--------------------------------------------------------------------------
        |
        | The default setting for the center position on the rendered map
        |
        */
        'center'     => [
            'lat' => -2.548926,
            'lng' => 118.0148634,
        ],

        /*
        |--------------------------------------------------------------------------
        | Tile Layer
        |--------------------------------------------------------------------------
        |
        | Option to choose background tile layer such as theme and label.
        |
        | Available themes:
        | - matter
        | - voyager
        | - positron
        |
        | Set false or null on to disable the options.
        */
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
            'zoomAnimation'   => true,
            'scrollWheelZoom' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Path Options
    |--------------------------------------------------------------------------
    |
    | The default configuration for the path options on the layer
    | such as color and line thickness and also the fill color on the layer.
    |
    | Of course you are allowed to add options according to the
    | reference from the Leaflet.
    |
    | Please visit https://leafletjs.com/reference-1.7.1.html#path-option
    | for option availability.
    |
    */
    'layer'   => [
        'color'   => '#434C5E',
        'opacity' => 0.5,
        'weight'  => 0.5,

        'fillColor'   => '#5E81AC',
        'fillOpacity' => 0.5,
        'fillRule'    => 'nonzero',
    ],
];