<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Root Element
    |--------------------------------------------------------------------------
    |
    | This is a map element by default if it is not defined in the class or during rendering
    |
    */
    'element' => 'map',

    /*
    |--------------------------------------------------------------------------
    | Render Type
    |--------------------------------------------------------------------------
    |
    | If the value contains "partial" then the map is drawn one by one,
    | this is to avoid the "memory exhausted".
    |
    | However, if you want to draw the map at once,
    | fill it with "once" but you run the risk of experiencing "memory exhausted".
    | do with your own risk!
    |
    | - part => fetch data one by one
    | - once => fetch data in one time
    |
    | suggested : part
    |
    */
    'render'  => 'part',

    'layer' => [
        'background' => true,

        'style' => [
            'color'       => '#000000',
            'weight'      => 0.1,
            'opacity'     => 0.4,
            'fillColor'   => '#FF0000',
            'fillOpacity' => 0.3,
        ],

        'event' => [
            'click'     => 'highlight',
            'mouseover' => 'highlight',
            'mouseout'  => 'reset',
        ],
    ],

    'marker' => [
        'iconUrl'     => 'default',
        'iconSize'    => [30, 30],
        'iconAnchor'  => [12, 25],
        'popupAnchor' => [1, -34],
        'shadowSize'  => [41, 41],

        'withLabel'   => true,
    ],
];