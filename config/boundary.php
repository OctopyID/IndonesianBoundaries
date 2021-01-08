<?php

return [
    'basemap' => [
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
        'options'   => [
            'center' => [
                'lat' => -2.548926,
                'lng' => 118.0148634,
            ],

            'zoom'            => 6,
            'zoomControl'     => true,
            'zoomAnimation'   => true,
            'scrollWheelZoom' => true,
            'doubleClickZoom' => true,

            'dragging'    => true,
            'trackResize' => true,

            'preferCanvas' => false,
        ],

        /*
        |--------------------------------------------------------------------------
        | Tile Layer
        |--------------------------------------------------------------------------
        |
        | Option to choose background tile layer such as theme and label.
        |
        | Available themes:
        | => Light themes
        |   - voyager
        |   - positron
        |
        | => Dark themes
        |   - matter
        |
        */
        'tilelayer' => [
            'label' => true,
            'theme' => 'voyager',

            'options' => [
                'minZoom' => 0,
                'maxZoom' => 18,

                'zoomOffset'  => 0,
                'zoomReverse' => false,

                'detectRetina' => false,
                'crossOrigin'  => false,
            ],
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
    'styles'  => [
        'stroke'  => true,
        'color'   => '#434C5E',
        'opacity' => 0.5,
        'weight'  => 0.5,

        'fill'        => true,
        'fillColor'   => '#5E81AC',
        'fillOpacity' => 0.5,
        'fillRule'    => 'nonzero',

        'lineCap'  => 'round',
        'lineJoin' => 'round',
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Marker Options
    |--------------------------------------------------------------------------
    |
    | Option to change the default Marker configuration on the map.
    |
    | Please refer to https://leafletjs.com/reference-1.7.1.html#marker for more options.
    |
    */
    'marker' => [
        'options' => [
            'opacity'     => 1,
            'riseOnHover' => false,

            // Draggable Options
            'draggable'   => false,
            'autoPan'     => false,
        ],

        'icon' => [
            'iconUrl'    => 'default.red.png',
            'iconSize'   => [38, 38],
            'iconAnchor' => [0, 0],

            'shadowUrl'    => 'default.blue.png',
            'shadowSize'   => [38, 38],
            'shadowAnchor' => [-6, 3],

            'popupAnchor' => [-3, -76],
        ],
    ],
];
